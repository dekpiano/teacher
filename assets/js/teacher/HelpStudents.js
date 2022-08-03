// เพิ่มไฟล์เยื่ยมบ้าน
$('.add_filecoversheet').change(function(e) {
    e.preventDefault();
    $.ajax({
        url: '../ConTeacherStudentSupport/Add_filecoversheet',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            if (data > 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกข้อมูลไว้แล้ว',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload();
                    }
                })


            }
        }
    });
});

$('.add_homevisit_fileSDQ').change(function(e) {
    e.preventDefault();
    $.ajax({
        url: '../ConTeacherStudentSupport/Add_homevisit_fileSDQ',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            if (data > 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกข้อมูลไว้แล้ว',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload();
                    }
                })


            }
        }
    });
});

$('.add_homevisit_filerecordform').change(function(e) {
    e.preventDefault();
    $.ajax({
        url: '../ConTeacherStudentSupport/Add_homevisit_filerecordform',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            if (data > 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกข้อมูลไว้แล้ว',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload();
                    }
                })


            }
        }
    });
});

$('.add_homevisit_filesummary').change(function(e) {
    e.preventDefault();
    $.ajax({
        url: '../ConTeacherStudentSupport/Add_homevisit_filesummary',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            if (data > 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกข้อมูลไว้แล้ว',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload();
                    }
                })


            }
        }
    });
});

$('.ConfrimStatus').change(function(e) {
    e.preventDefault();
    $.ajax({
        url: '../ConTeacherStudentSupport/confrim_statuslevelhead',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {

            if (data) {
                if (data[1] == 'ผ่าน') {
                    $('#s_homevisit_statuslevelhead' + data[0]).addClass('is-valid');
                    $('#s_homevisit_statuslevelhead' + data[0]).removeClass('is-invalid');
                } else {
                    $('#s_homevisit_statuslevelhead' + data[0]).addClass('is-invalid');
                    $('#s_homevisit_statuslevelhead' + data[0]).removeClass('is-valid');
                }

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกข้อมูลไว้แล้ว',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        // window.location.reload();
                    }
                })



            }
        }
    });
});

$('.ConfrimStatusManager').change(function(e) {
    e.preventDefault();
    $.ajax({
        url: '../ConTeacherStudentSupport/confrim_statusmanager',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {

            if (data) {
                if (data[1] == 'ผ่าน') {
                    $('#s_homevisit_statusmanager' + data[0]).addClass('is-valid');
                    $('#s_homevisit_statusmanager' + data[0]).removeClass('is-invalid');
                } else {
                    $('#s_homevisit_statusmanager' + data[0]).addClass('is-invalid');
                    $('#s_homevisit_statusmanager' + data[0]).removeClass('is-valid');
                }

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกข้อมูลไว้แล้ว',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        // window.location.reload();
                    }
                })



            }
        }
    });
});


$(document).on("change", "#homevisit_set_onoff", function() {
    //alert($(this).prop('checked'));
    $.post("../ConTeacherStudentSupport/Setting_Helpstd_OnOff", { onoff: $(this).prop('checked') }, function(data, status) {
        if (data == 1) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'เปลี่ยนแปลงสำเร็จ',
                showConfirmButton: false,
                timer: 1500
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    // window.location.reload();
                }
            })
        } else {
            alertify.error('เปลี่ยนแปลงข้อมูลไม่สำเร็จ');
        }
    });
});