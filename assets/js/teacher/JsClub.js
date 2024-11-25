
$(document).on('click', '.ModalClubRegister', function() {
    $('#ModalClubRegister').modal('show');
    const clubid = $(this).data('clubid');
    ViewClubRegister(clubid);
});

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
    ViewClubActivity(clubid);
});

function ViewClubActivity(clubid) {
    $.ajax({
        url: '../ConTeacherClubs/ViewClubActivity', // เปลี่ยน controller_name เป็นชื่อ Controller ของคุณ
        method: 'POST',
        data: { clubid: clubid },
        success: function (response) {
            // สมมติ Response เป็น JSON
            const data = JSON.parse(response);    
            console.log(data);
                  
            let rows = '';
            data.forEach((student, index) => {
                rows += `
                    <tr class="text-center">
                        <td>${student.tcs_week_number}</td>
                        <td>${student.tcs_start_date}</td>
                        <td>
                            <button class="btn btn-danger btn-sm ModalClubCheckName"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
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


$(document).on('click', '.ModalClubCheckName', function() {
    $('#ModalClubCheckName').modal('show');
   // $('#ModalClubRecordActivity').modal('hide');
    const clubid = $(this).data('clubid');
});