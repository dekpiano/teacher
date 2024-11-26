
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
                rows += `
                    <tr class="text-center">
                        <td>${student.tcs_week_number}</td>
                        <td>${thaiDate}</td>
                        <td>
                            <button class="btn btn-danger btn-sm ModalClubCheckName" data-clubid="${student.tcs_week_number}" data-scheduleid="${student.tcs_schedule_id}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
</svg> เช็คชื่อ</button>
                        </td>
                        <td></td>
                        <td></td>
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

    ViewDataRecordStudyTime(clubid,$(this).data("scheduleid"),clubid);
});

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
    //console.log($(this).serialize());

    $.ajax({
        url: '../ConTeacherClubs/ClubInsertRecodeActivity', 
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {

            console.log(response);
            
        },
        error: function() {
            $responseMessage.text('Error submitting the form. Please try again.');
        }
    });

});