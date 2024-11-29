
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
                        <td>${
                            formatThaiDate(new Date(student.member_join_date))
                        }</td>
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
                
                var total = 0;
                if (student.tcra_ma === null || student.tcra_ma.trim() === "") {
                    var ConutMa = "-";
                }else{
                    var ConutMa = student.tcra_ma.split('|').filter(item => item.trim() !== "").length;      
                    total += (isNaN(parseInt(ConutMa)) ? 0 : ConutMa); 
                }
                if (student.tcra_khad === null || student.tcra_khad.trim() === "") {
                    var CountKhad = "-";
                }else{
                    var CountKhad = student.tcra_khad.split('|').filter(item => item.trim() !== "").length;    
                    total += (isNaN(parseInt(CountKhad)) ? 0 : CountKhad);               
                }
                if (student.tcra_rapwy === null || student.tcra_rapwy.trim() === "") {
                    var CountRapwy = "-";
                }else{
                    var CountRapwy = student.tcra_rapwy.split('|').filter(item => item.trim() !== "").length;  
                    total += (isNaN(parseInt(CountRapwy)) ? 0 : CountRapwy);      
                }
                if (student.tcra_rakic === null || student.tcra_rakic.trim() === "") {
                    var CountRakic = "-";
                }else{
                    var CountRakic = student.tcra_rakic.split('|').filter(item => item.trim() !== "").length;   
                    total += (isNaN(parseInt(CountRakic)) ? 0 : CountRakic);             
                }
                if (student.tcra_kickrrm === null || student.tcra_kickrrm.trim() === "") {
                    var CountKickrrm = "-";
                }else{
                    var CountKickrrm = student.tcra_kickrrm.split('|').filter(item => item.trim() !== "").length;   
                    total += (isNaN(parseInt(CountKickrrm)) ? 0 : CountKickrrm);;                 
                }
                    
                rows += `
                    <tr class="text-center">
                        <td>${student.tcs_week_number}</td>
                        <td>${thaiDate}</td>
                        <td>
                            <button class="btn btn-${student.trca_schedule_id ?'success':'danger'} btn-sm ModalClubCheckName" data-scheduleid="${student.tcs_schedule_id}" data-datetime="${student.tcs_start_date}" data-trca_schedule_id="${student.trca_schedule_id}"> 
                            ${student.trca_schedule_id ?'✔ เช็คแล้ว':'✖ เช็คชื่อ'}
                            </button>
                        </td>
                        <td>${total}</td>
                        <td>${ConutMa}</td>
                        <td>${CountKhad}</td>
                        <td>${CountRapwy}</td>
                        <td>${CountRakic}</td>
                        <td>${CountKickrrm}</td>
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

    ViewDataRecordStudyTime(clubid,$(this).data("scheduleid"),$(this).data("trca_schedule_id"));
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
function ViewDataRecordStudyTime(clubid,scheduleid,trca_schedule_id) {
    $.ajax({
        url: '../ConTeacherClubs/ViewDataRecordStudyTime', // เปลี่ยน controller_name เป็นชื่อ Controller ของคุณ
        method: 'POST',
        data: { clubid: clubid,scheduleid:scheduleid },
        success: function (response) {
            // สมมติ Response เป็น JSON
            const data = JSON.parse(response);  
                    //console.log(da.GetStatus);
                 if(data.GetStatus !== null){
                    var StatusMa1 = data.GetStatus.tcra_ma.split('|');
                    var StatusKhad1 = data.GetStatus.tcra_khad.split('|');
                    var StatusKickrrm1 = data.GetStatus.tcra_kickrrm.split('|');
                    var StatusRakic1 = data.GetStatus.tcra_rakic.split('|');
                    var StatusRapwy1 = data.GetStatus.tcra_rapwy.split('|');
                   
                 }
                  
                 
                  
            let rows = '';
            data.StuList.forEach((student, index) => {
                if(data.GetStatus !== null){
                var StatusMa = StatusMa1.includes(student.StudentID);
                var StatusKhad = StatusKhad1.includes(student.StudentID);
                var StatusRapwy = StatusRapwy1.includes(student.StudentID);
                var StatusRakic = StatusRakic1.includes(student.StudentID);
                var StatusKickrrm = StatusKickrrm1.includes(student.StudentID);
                }

                rows += `
                    <tr class="text-center">
                        <td>${student.StudentNumber}</td>
                        <td>${student.StudentClass}</td>
                        <td>${student.FullnameStu}  </td>
                    <td> <input type="hidden" name="scheduleid" id="scheduleid" value="${scheduleid}">
                        <input type="hidden" name="clubid" id="clubid" value="${clubid}">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary ${ StatusMa ?"active":""} ${data.GetStatus ?"":"active"}"> 
                                <input type="radio"  name="status[${student.StudentID}]" id="status[${index}]" value="มา" ${StatusMa ?"checked":""} ${data.GetStatus ?"":"checked"}> มา        
                            </label>
                            <label class="btn btn-outline-primary ${ StatusKhad ?"active":""}">   
                                <input type="radio" name="status[${student.StudentID}]" id="status[${index}]" value="ขาด" ${StatusKhad ?"checked":""}> ขาด        
                            </label> 
                             <label class="btn btn-outline-primary ${ StatusRapwy ?"active":""}">   
                                <input type="radio" name="status[${student.StudentID}]" id="status[${index}]" value="ลาป่วย" ${StatusRapwy ?"checked":""}> ลาป่วย        
                            </label>
                             <label class="btn btn-outline-primary ${ StatusRakic ?"active":""}">   
                                <input type="radio" name="status[${student.StudentID}]" id="status[${index}]" value="ลากิจ" ${StatusRakic ?"checked":""}> ลากิจ        
                            </label>
                            <label class="btn btn-outline-primary ${ StatusKickrrm?"active":""}">   
                                <input type="radio" name="status[${student.StudentID}]" id="status[${index}]" value="กิจกรรม" ${StatusKickrrm ?"checked":""}> กิจกรรม        
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
            if(response.status === "success"){
                Swal.fire({
                    title: "แจ้งเตือน!",
                    text: response.message,
                    icon: "success"
                  });
                  $('#recordId').val(response.InsertedId);
            }else{
                console.log(response.message);
            }
            
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

// ------------ พิมพ์เอกสาร  --------------
$(document).on('click', '.ModalClubReport', function() {
    $('#ModalClubRegister').modal("show");
});