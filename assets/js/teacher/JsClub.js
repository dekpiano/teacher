
$(document).on('click', '.ModalClubRegister', function() {
    $('#ModalClubRegister').modal('show');
    const clubid = $(this).data('clubid');
    ViewClubRegister(clubid);
});

function ViewClubRegister(clubid) {
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
   
});

function ViewClubRegister(clubid) {
    $.ajax({
        url: '../ConTeacherClubs/ViewClubActivity', // เปลี่ยน controller_name เป็นชื่อ Controller ของคุณ
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


$(document).on('click', '.ModalClubCheckName', function() {
    $('#ModalClubCheckName').modal('show');
    const clubid = $(this).data('clubid');
});