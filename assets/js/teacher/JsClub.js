
function formatThaiDate(date) {
    if (!date || isNaN(date.getTime())) {
        // กรณีที่ไม่ได้เลือกวันที่หรือวันที่ไม่ถูกต้อง
        return "ยังไม่ได้เลือกวันที่";
    }
    const monthsThai = [
        "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", 
        "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", 
        "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
    ];

    const day = date.getDate(); // วันที่
    const month = date.getMonth(); // ดัชนีของเดือน (0-11)
    const year = date.getFullYear() + 543; // เพิ่มปีพุทธศักราช (พ.ศ.)

    return `${day} ${monthsThai[month]} ${year}`; // จัดรูปแบบวันที่
}

$(document).on('click', '.ModalClubRegister', function() {
    $('#ModalClubRegister').modal('show');
    const clubid = $(this).data('clubid');
    ViewClubRegister(clubid);
});

// ดูข้อมูลของชุมนุม
function ViewClubRegister(clubid) {
    console.log(666);
    $.ajax({
        url: '../ConTeacherClubs/ViewClubRegister', // เปลี่ยน controller_name เป็นชื่อ Controller ของคุณ
        method: 'POST',
        data: { clubid: clubid },
        success: function (response) {
            // สมมติ Response เป็น JSON
            const data = JSON.parse(response);
            
                      
            let rows = '';
            data.forEach((student, index) => {
                rows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${student.StudentCode}</td>
                        <td>${student.FullnameStu}</td>
                        <td>${student.StudentClass}</td>
                        <td>${student.StudentNumber}</td>
                        <td>${student.member_join_date}</td>
                    </tr>
                `;
            });
            $('#TbViewClubRegister tbody').html(rows);
        },
        error: function (error) {
            console.error('Error fetching data:', error.responseText);
        },
    });
}

$(document).on('click', '.ModalClubRecordActivity', function() {
    $('#ModalClubRecordActivity').modal('show');
    const clubid = $(this).data('clubid');
    ViewClubActivity();
});

// ---------------- บันทึกเวลาเรียน -----------------------------------
// ----------------- ดูกิจกรรม ------------------
function ViewClubActivity(clubid) {
    $.ajax({
        url: '../ConTeacherClubs/ViewClubActivity', // เปลี่ยน controller_name เป็นชื่อ Controller ของคุณ
        method: 'POST',
        data: { clubid: clubid },
        success: function (response) {
            // สมมติ Response เป็น JSON
            const data = JSON.parse(response);    
            let rows = '';
            data.forEach((student, index) => {
                const today = new Date(student.tcs_start_date);
                const thaiDate = formatThaiDate(today);
                
                if (student.tcra_ma === null || student.tcra_ma.trim() === "") {
                    var count = 0;
                }else{
                    var count = student.tcra_ma.split('|').filter(item => item.trim() !== "").length;
                    console.log("จำนวนรายการที่ไม่ว่าง: " + count);
                }
                   
                    
                rows += `
                    <tr class="text-center">
                        <td>${student.tcs_week_number}</td>
                        <td>${thaiDate}</td>
                        <td>
                            <button class="btn btn-${student.trca_schedule_id ?'success':'danger'} btn-sm ModalClubCheckName" data-clubid="${student.tcs_week_number}" data-scheduleid="${student.tcs_schedule_id}" data-datetime="${student.tcs_start_date}"> 
                            ${student.trca_schedule_id ?'✔ เช็คแล้ว':'✖ เช็คชื่อ'}
                            </button>
                        </td>
                        <td></td>
                        <td>${count}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                `;
            });
            $('#TbViewClubRegister tbody').html(rows);
        },
        error: function (error) {
            console.error('Error fetching data:', error.responseText);
        },
    });
}

//--------------- Modal บันทึกเวลาเรียน -----------
$(document).on('click', '.ModalClubCheckName', function() {
    $('#ModalClubCheckName').modal('show');
    $('#ModalClubRecordActivity').modal('hide');
    const clubid = $(".ModalClubRecordActivity").data('clubid');
    const today = new Date($(this).data("datetime"));
    const thaiDate = formatThaiDate(today);
    $('#ShowDatetime').text(thaiDate);
    $('#recordId').val("");

    ViewDataRecordStudyTime(clubid,$(this).data("scheduleid"),clubid);
    CheckRecoedActivity($(this).data("scheduleid"));
});

function CheckRecoedActivity(recoedID){

    $.post("../ConTeacherClubs/CheckRecoedActivity", {recoedID:recoedID}, function (response) {      
        if(response > 0){
            $('#recordId').val(response);
        }else{
            $('#recordId').val("");
        }
        
    }, 'json');
}


//--------------- ดูบันทึกเวลาเรียน -----------
function ViewDataRecordStudyTime(clubid,today,clubid) {
    $.ajax({
        url: '../ConTeacherClubs/ViewDataRecordStudyTime', // เปลี่ยน controller_name เป็นชื่อ Controller ของคุณ
        method: 'POST',
        data: { clubid: clubid },
        success: function (response) {
            // สมมติ Response เป็น JSON
            const data = JSON.parse(response);    
                  
            let rows = '';
            data.forEach((student, index) => {
                rows += `
                    <tr class="text-center">
                        <td>${student.StudentNumber}</td>
                        <td>${student.StudentClass}</td>
                        <td>${student.FullnameStu}  </td>
                    <td> <input type="hidden" name="scheduleid" id="scheduleid" value="${today}">
                        <input type="hidden" name="clubid" id="clubid" value="${clubid}">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary active">   
                                <input type="radio" checked name="status[${student.StudentID}]" id="status[${index}]" value="มา"> มา        
                            </label>
                            <label class="btn btn-outline-primary ">   
                                <input type="radio" name="status[${student.StudentID}]" id="status[${index}]" value="ขาด"> ขาด        
                            </label> 
                             <label class="btn btn-outline-primary ">   
                                <input type="radio" name="status[${student.StudentID}]" id="status[${index}]" value="ลาป่วย"> ลาป่วย        
                            </label>
                             <label class="btn btn-outline-primary ">   
                                <input type="radio" name="status[${student.StudentID}]" id="status[${index}]" value="ลากิจ"> ลากิจ        
                            </label>
                            <label class="btn btn-outline-primary ">   
                                <input type="radio" name="status[${student.StudentID}]" id="status[${index}]" value="กิจกรรม"> กิจกรรม        
                            </label>
                        </div>
                    </td> 
                    </tr>
                `;
            });
            $('#TbClubRecordStudyTime tbody').html(rows);
        },
        error: function (error) {
            console.error('Error fetching data:', error.responseText);
        },
    });
}

$(document).on('submit', '#FormRecordActivity', function(e) {
    e.preventDefault();

    const url = $('#recordId').val() === '' 
    ? '../ConTeacherClubs/ClubInsertRecodeActivity' // Insert เมื่อ ID ว่าง
    : '../ConTeacherClubs/ClubUpdateRecodeActivity'; // Update เมื่อมี ID

    $.ajax({
        url: url, 
        type: 'POST',
        data: $(this).serialize(),
        dataType:'json',
        success: function(response) {
           // console.log(response);
            if(response){
                Swal.fire({
                    title: "แจ้งเตือน!",
                    text: response.message,
                    icon: "success"
                  });
            }
            $('#recordId').val(response.InsertedId);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText);
        }
    });
});

$('#ModalClubCheckName').on('hidden.bs.modal', function (event) {
    $('#ModalClubRecordActivity').modal('show');
    ViewClubActivity();
})