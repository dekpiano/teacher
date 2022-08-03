//
$('#showAlert').modal('show');
$(document).on("click", ".ShowAddRoomOnline", function() {
    $('#AddRoomOnline').modal('show');
    $('#FormRoomOnline').addClass('Add_RoomOnline');
    $('#FormRoomOnline').removeClass('Update_RoomOnline');
    $('#FormRoomOnline')[0].reset();
});
$(document).on("click", ".ShowEditRoomOnline", function() {
    $('#AddRoomOnline').modal('show');
    $('#FormRoomOnline').addClass('Update_RoomOnline');
    $('#FormRoomOnline').removeClass('Add_RoomOnline');
    // alert($(this).attr('roomid'));
    $.post("../ConTeacherTeaching/EditRoomOnline", { roomid: $(this).attr('roomid') }, function(data, status) {
        //console.log(data[0].roomon_classlevel);
        $('#roomon_id').val(data[0].roomon_id);
        $('#roomon_coursecode').val(data[0].roomon_coursecode);
        $('#roomon_coursename').val(data[0].roomon_coursename);
        $('#roomon_classlevel').val(data[0].roomon_classlevel);
        $('#roomon_linkroom').val(data[0].roomon_linkroom);
        $('#roomon_year').val(data[0].roomon_year);
        $('#roomon_term').val(data[0].roomon_term);
    }, "json");
});
$(document).on("click", ".ShowDeleteRoomOnline", function() {
    $('#DeleteRoomOnline').modal('show');
    $('#del_roomon_id').val($(this).attr('roomid'));
});

$(document).on("submit", ".Add_RoomOnline", function(e) {
    e.preventDefault(e);
    $.ajax({
        url: '../ConTeacherTeaching/AddRoomOnline',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            //console.log(data);
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

$(document).on("submit", ".Update_RoomOnline", function(e) {
    e.preventDefault(e);
    $.ajax({
        url: '../ConTeacherTeaching/UpdateRoomOnline',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            //console.log(data);
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

$(document).on("submit", ".FormDeleteRoomOnline", function(e) {
    e.preventDefault(e);
    $.post("../ConTeacherTeaching/DeleteRoomOnline", { roomid: $("#del_roomon_id").val() }, function(data, status) {
        if (data == 1) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'ลบข้อมูลสำเร็จ',
                showConfirmButton: false,
                timer: 1500
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    window.location.reload();
                }
            })
        } else {
            alertify.error('ลบข้อมูลไม่สำเร็จ');
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