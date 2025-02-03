
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
    $('#ModalClubReport').modal("show");
});


function CheckStatusInTableAttendanceActivity(){
    let resultMa;
   
    $('#TbReportAttendanceActivity tbody tr').each(function(index, row) {
        let countMa = 0,CountKhad=0,CountRapwy=0,CountRakic=0,CountKickrrm=0;
        $(row).find('.GetStatus').each(function(_, cell) {
            const cellValue = $(cell).text().trim();
            if (cellValue === 'ม') {
                countMa++;
            }else if(cellValue === 'ข'){
                CountKhad++;
            }else if(cellValue === 'ลป'){
                CountRapwy++;
            }else if(cellValue === 'ลก'){
                CountRakic++;
            }else if(cellValue === 'ก'){
                CountKickrrm++;
            }
        })  
            var Total = (countMa+CountKhad+CountRapwy+CountRakic+CountKickrrm);
        $(row).find('.ShowNumMa').text(countMa);
        $(row).find('.ShowNumKhad').text(CountKhad);
        $(row).find('.ShowNumRapwy').text(CountRapwy);
        $(row).find('.ShowNumRakic').text(CountRakic);
        $(row).find('.ShowNumkickrrm').text(CountKickrrm);
        $(this).find(".ShowNumToTal").text(Total);
        $(this).find(".ShowNumAverage").text(parseFloat(((countMa+CountRapwy+CountRakic+CountKickrrm)/Total)*100).toFixed(2));
            
    });
    
}
CheckStatusInTableAttendanceActivity();


//--------------------------- กำหนดการจัดกิจกรรมการเรียนรู้ ----------------------------
$(document).on('click', '.ModalClubSetLearnActivity', function() {
    $('#ModalClubSetLearnActivity').modal("show");
    const clubid = $(".ModalClubSetLearnActivity").data('clubid');
    $('#ClubId').val(clubid);

    $.ajax({
        url: '../ConTeacherClubs/ClubEditRecodeActivity/'+clubid, // URL ที่เรียกไปยัง Controller
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            $('#activityTable tbody').empty(); // ล้างข้อมูลเก่าก่อน
            let rowCount = 0;
            let row = '';
            response.forEach(function (item) {
                rowCount++;
                const names = item.act_name.split('|'); // แยกข้อมูลชื่อกิจกรรม
                const hours = item.act_number_hours.split('|'); // แยกข้อมูลจำนวนชั่วโมง
                const length = Math.max(names.length, hours.length);

               
                for (let i = 0; i < length; i++) {
                    const name = names[i] ? names[i] : '-'; // ใช้ '-' ถ้าไม่มีข้อมูล
                    const hour = hours[i] ? hours[i] : '-'; // ใช้ '-' ถ้าไม่มีข้อมูล
                    console.log(name);
                 row += `
                    <tr>
                        <td class="text-center">${i+1}</td>
                        <td><input type="text" class="form-control" name="activity[]" value="${name}" placeholder="กรอกข้อมูลกิจกรรม"></td>
                        <td style="justify-items: center"><input type="text" class="form-control text-center" style="width:50px;" name="hours[]" value="${hour}" placeholder="เวลา/ชั่วโมง"></td>
                        <td>
                            <button type="button" class="btn btn-sm  btn-danger remove-row"><i class="bi bi-trash-fill"></i></button>
                        </td>
                    </tr>
                `;
                }

                $('#activityTable tbody').append(row); // เพิ่มแถวใหม่
            });
        }
    });

});
// เพิ่มฟอร์มแต่ละข้อ
$(document).on("click",".addRow",function (e) {
    e.preventDefault();
    
    let rowCount = $("#activityTable tbody tr").length + 1; // นับจำนวนแถวปัจจุบัน
    let newRow = `
        <tr> 
            <td class="text-center">${rowCount} </td>
            <td><input type="text" class="form-control" name="activity[]" placeholder="กรอกข้อมูลกิจกรรม"></td>
            <td style="justify-items: center"><input type="text" class="form-control text-center" style="width:50px;" name="hours[]" placeholder="เวลา/ชั่วโมง"></td>
            <td>
                <button type="button" class="btn btn-sm btn-danger remove-row"><i class="bi bi-trash-fill"></i></button>
            </td>
        </tr>
    `;

    $("#activityTable tbody").append(newRow); // เพิ่มแถวใหม่
    
});
// ลบแถว
$(document).on("click", ".remove-row", function () {
    let currentRow = $(this).closest("tr"); // แถวปัจจุบัน
    let prevRow = currentRow.prev(); // แถวก่อนหน้า

    // ลบแถวปัจจุบัน
    currentRow.remove();

    // แสดงปุ่ม "เพิ่มกิจกรรม" ในแถวก่อนหน้า (ถ้ามี)
    prevRow.find(".add-row").show();

    // อัปเดตลำดับแถวใหม่
    $("#activityTable tbody tr").each(function (index) {
        $(this).find("td:first").text(index + 1);
    });
});

$(document).on("submit","#FormSetLearnActivity",function (e) {
    e.preventDefault();
    
    $.ajax({
        url: '../ConTeacherClubs/ClubSetLearnActivity', 
        type: 'POST',
        data: $(this).serialize(),
        dataType:'json',
        success: function(response) {
           console.log(response);
            if(response === 1){
                Swal.fire({
                    title: "แจ้งเตือน!",
                    text: "กำหนดการจัดกิจกรรมการเรียนรู้ สำเร็จ!",
                    icon: "success"
                  });
                  
            }else{
                console.log(response);
            }
            
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText);
        }
    });
});

//--------------------------- กำหนดวัตุประสงค์กิจกรรม----------------------------
$(document).on('click', '.ModalClubSetObjective', function() {
    $('#ModalClubSetObjective').modal("show");
    const clubid = $(".ModalClubSetObjective").data('clubid');
    $('#ClubId').val(clubid);


});