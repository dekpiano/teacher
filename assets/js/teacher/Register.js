$(document).on('keydown', '.KeyEnter', function(e) {
    var KeyEn = $(this).index('input.KeyEnter');
    // console.log(KeyEn);
    // console.log("Key" + e.keyCode);
    if (e.keyCode == 37) {
        KeyEn = KeyEn - 1;
        $('input.KeyEnter:eq(' + KeyEn + ')').focus();
    }
    if (e.keyCode == 39) {
        KeyEn = KeyEn + 1;
        $('input.KeyEnter:eq(' + KeyEn + ')').focus();
    }
    if (e.keyCode == 38) {
        KeyEn = KeyEn - 5;
        $('input.KeyEnter:eq(' + KeyEn + ')').focus();
    }
    if (e.keyCode == 40) {
        KeyEn = KeyEn + 5;
        $('input.KeyEnter:eq(' + KeyEn + ')').focus();
    }
});

$(document).on('click', '.clickLoad', function() {
    // disable button
    $(this).prop("disabled", true);
    // add spinner to button
    $(this).html(
        '<i class="fa fa-circle-o-notch fa-spin"></i> loading...'
    );
});

$(".score").each(function() {
    $(this).keyup(function() {
        calculateSum();
    });
});

function calculateSum() {

    var sum = 0;

    //iterate through each textboxes and add the values
    $(".score").each(function() {

        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            sum += parseFloat(this.value);
        }

    });
    //.toFixed() method will roundoff the final sum to 2 decimal places
    $("#sum").val(sum.toFixed(2));
    if (sum == 100) {
        $("#sum").last().addClass("is-valid");
        $("#sum").removeClass("is-invalid")
    } else {
        $("#sum").addClass("is-invalid")
        $("#sum").removeClass("is-valid")
    }
}

$(document).on('change', '#check_room', function() {

    window.location.href = $(this).val();
});


$(document).on('keyup', '.check_score', function() {
    var num = parseInt($(this).val());
    var key = parseInt($(this).attr('check-score-key'));
    // console.log($(this).val());
    //   console.log($(this).attr('check-score-key'));

    if (num > key) {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'คุณกรอกคะแนนเกินคะแนนเก็บ<br>กรุณากรอกคะแนนใหม่',
            showConfirmButton: false,
            timer: 3000
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
                //window.location.reload();
                $(this).val("0");
            }
        })
    }
});

$(document).on('keyup', '.study_time', function() {
    var num = parseInt($(this).val());
    var key = parseInt($(this).attr('check-time'));

    if (num > key) {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'คุณกรอกเวลาเรียนเกินกำหนด ' + key + 'ชั่วโมง <br>กรุณากรอกเวลาเรียนใหม่',
            showConfirmButton: false,
            timer: 3000
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
                //window.location.reload();
                $(this).val("0");
            }
        })
    }
});


$(document).on('submit', '.form_set_score', function(e) {
    e.preventDefault();

    $('.btn').addClass('disabled')
    $.ajax({
        url: '../../../../../ConTeacherRegister/setting_score/' + $(this).attr('id'),
        type: "post",
        data: $(this).serialize(), //this is formData
        success: function(data) {
            console.log(data);
            if (data > 0) {
                $('#editteacher').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกคะแนนสำเร็จ',
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload();
                    }
                })
            } else {
                window.location.reload();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
        }
    });
});


$(".check_score").each(function() {
    $(this).keyup(function() {
        calculateTotal($(this).parent().index());
        //console.log($(this).parent().index());
    });
});

$(".study_time").each(function() {
    $(this).keyup(function() {
        calculateTotal($(this).parent().index());
        //console.log();
    });
});

function calculateTotal(index) {
    var total = 0;
    $('#tb_score tbody tr td').filter(function() {
        if ($(this).index() == index) {
            total += parseInt($(this).find('.check_score').val()) || 0;
        }
    });
    $('#tb_score tbody tr td.totalCol:eq(' + index + ')').html(total);
    // calculateSum();
    calculateRowSum();
}

function Charactor($char) {
    var re = new RegExp("^([0-9]|[ร])+$", "g");
    return re.test($char);
}

function calculateRowSum() {
    var TimeNum = $('.study_time').attr('check-time');
    $('table tbody tr').each(function() {

        var sum = 0;
        var study_time;
        var Check_ro = 0;
        $(this).find('td').each(function() {

            if ($(this).find('.check_score').val() == "ร") {
                Check_ro += 1;
            } else {
                sum += parseInt($(this).find('.check_score').val()) || 0;
            }
        });

        study_time = $(this).find('.study_time').val()


        $(this).find('.subtot').html(sum);
        if (80 * TimeNum / 100 > study_time) {
            $(this).find('.grade').html('มส');
        } else if (Check_ro > 0) {
            $(this).find('.grade').html('ร');
        } else {
            $(this).find('.grade').html(check_grade(sum));
        }

    });
}

function check_grade(sum) {

    if ((sum > 100) || (sum < 0)) {
        var grade = "ไม่สามารถคิดเกรดได้ คะแนนเกิน";
    } else if ((sum >= 79.5) && (sum <= 100)) {
        var grade = 4;
    } else if ((sum >= 74.5) && (sum <= 79.4)) {
        var grade = 3.5;
    } else if ((sum >= 69.5) && (sum <= 74.4)) {
        var grade = 3;
    } else if ((sum >= 64.5) && (sum <= 69.4)) {
        var grade = 2.5;
    } else if ((sum >= 59.5) && (sum <= 64.4)) {
        var grade = 2;
    } else if ((sum >= 54.5) && (sum <= 59.4)) {
        var grade = 1.5;
    } else if ((sum >= 49.5) && (sum <= 54.4)) {
        var grade = 1;
    } else if (sum <= 49.4) {
        var grade = 0;
    }



    return grade;
}
calculateRowSum();

$(document).on('click', '#chcek_score', function() {

    //console.log($(this).attr('subject-id'));

    $.post("../../../../../ConTeacherRegister/edit_score", {
        subid: $(this).attr('subject-id')
    }, function(data, status) {
        if (data == 0) {
            console.log(555);
            $(".form_set_score").attr('id', "form_insert_score");
        } else {
            $(".form_set_score").attr('id', "form_update_score");

            $('#before_middle_score').val(data[0].regscore_score);
            $('#test_midterm_score').val(data[1].regscore_score);
            $('#after_midterm_score').val(data[2].regscore_score);
            $('#final_exam_score').val(data[3].regscore_score);
            $('#sum').val(Number(data[0].regscore_score) + Number(data[1].regscore_score) + Number(data[2].regscore_score) + Number(data[3].regscore_score));
        }
    }, 'json');
});

$(document).on('submit', '.form_score', function(e) {
    e.preventDefault();

    $.ajax({
        url: '../../../../../ConTeacherRegister/insert_score',
        type: "post",
        data: $(this).serialize(), //this is formData
        success: function(data) {
            console.log(data);
            if (data > 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกคะแนนสำเร็จ',
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        //window.location.reload();
                    }
                })
            } else {
                // window.location.reload();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText);
        }
    });
});

$(document).on('submit', '.form_score_repeat', function(e) {
    e.preventDefault();

    $.ajax({
        url: '../../../../../ConTeacherRegister/insert_score_repeat',
        type: "post",
        data: $(this).serialize(), //this is formData
        success: function(data) {
            console.log(data);
            if (data > 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกคะแนนสำเร็จ',
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        //window.location.reload();
                    }
                })
            } else {
                // window.location.reload();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText);
        }
    });
});


$(document).on('click', '#chcek_report', function() {

    $("#report_RegisterYear").val($(this).attr('report-yaer'));
    $("#report_SubjectCode").val($(this).attr('report-subject'));

    $('#select_print option').remove();

    $.post("../ConTeacherRegister/checkroom_report", {
        report_yaer: $(this).attr('report-yaer'),
        report_subject: $(this).attr('report-subject')
    }, function(data, status) {

        $.each(data, function(key, val) {
            console.log(val.StudentClass);
            $('#select_print').append('<option value="' + val.StudentClass + '">' + val.StudentClass + '</option>');
        });
        $('#select_print').append('<option value="all">ทั้งหมด</option>');
    }, 'json');
});