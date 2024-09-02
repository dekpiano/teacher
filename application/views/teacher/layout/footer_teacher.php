          <!-- Page Footer-->
          <footer class="main-footer">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-sm-6">
                          <p>ระบบงานวิชาการ โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์ &copy; 2021</p>
                      </div>
                      <div class="col-sm-6 text-right">
                          <p>Design by <a href="https://www.facebook.com/dekpiano/" class="external">Dekpiano</a></p>
                          <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                      </div>
                  </div>
              </div>
          </footer>
          </div>
          </div>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="ShowStudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">รายชื่อนักเรียน</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <table class="table table-hover" id="TB_showstudent">
                              <thead>
                                  <tr>
                                      <th scope="col">เลขที่</th>
                                      <th scope="col">เลขประจำตัว</th>
                                      <th scope="col">ชื่อ - นามสกุล</th>
                                  </tr>
                              </thead>
                              <tbody>

                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>

          <!-- JavaScript files-->
          <script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>
          <script src="<?=base_url()?>assets/vendor/popper.js/umd/popper.min.js"> </script>
          <script src="<?=base_url()?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
          <script src="<?=base_url()?>assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
          <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
          <script src="<?=base_url()?>assets/vendor/jquery-validation/jquery.validate.min.js"></script>
          <script
              src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
          </script>

          <!-- Main File -->
          <script src="<?=base_url()?>assets/js/front.js"></script>
          <script src="<?=base_url()?>assets/js/jquery.datetimepicker.js"></script>
          <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

          <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
          <!-- DataTable -->
          <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
          <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
          <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
          <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
          <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>


          <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

          <script src="<?=base_url()?>assets/js/teacher/SendCourse.js?v=27"></script>
          <script src="<?=base_url()?>assets/js/teacher/Teaching.js?v=1"></script>

          <?php if($this->uri->segment(1) === "TeacherJob"): ?>
          <script src="<?=base_url()?>assets/js/html5-qrcode.min.js?v=2"></script>
          <script src="<?=base_url()?>assets/js/teacher/TeacherJob.js?v=1"></script>
          <?php endif; ?>

          <?php if($this->uri->segment(1) === "Teaching"): ?>
          <script src="<?=base_url()?>assets/js/teacher/TeachHomeroom.js?v=17"></script>
          <script src="<?=base_url()?>assets/js/teacher/RaedQrcode.js?v=1"></script>
          <!-- <script src="<?=base_url()?>assets/js/charts-custom.js?v=17"></script>        -->
          <?php endif; ?>

          <?php if($this->uri->segment(1) === "Register"): ?>
          <script src="<?=base_url()?>assets/js/teacher/Register.js?v=26"></script>
          <?php endif; ?>

          <?php if($this->uri->segment(1) === "SupStd"): ?>
          <script src="<?=base_url()?>assets/js/teacher/HelpStudents.js?v=14"></script>
          <?php endif; ?>

          <?php if($this->uri->segment(1) === "Profile"): ?>
          <script src="<?=base_url()?>assets/js/teacher/TeacherProfile.js?v=3"></script>
          <?php endif; ?>

          </body>

          <script>
// $(window).on('load', function() {
//     $(".se-pre-con").fadeOut(1000);
// });

$('.Loader').on('click', function() {
    $.LoadingOverlay("show");    
});
$.LoadingOverlay("hide");

$(function() {
    $("#show_date").datepicker({
        dateFormat: "dd-mm-yy", //กำหนดรูปแบบวันที่ ปี - เดือน - วัน
        changeMonth: true, // กำหนดให้เปลี่ยนเดือนได้
        changeYear: true, //กำหนดให้เปลี่ยนปีได้
        dayNamesMin: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"], //กำหนดชื่อย่อของวัน เป็น ภาษาไทย
        monthNamesShort: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม",
            "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
        ],
    });
});
          </script>

          </script>

          <?php if($this->session->flashdata('msg') == 'YES'):?>
          <script>
Swal.fire({
    icon: '<?=$this->session->flashdata('status');?>',
    title: "แจ้งเตือน",
    html: '<?=$this->session->flashdata('messge');?>',
    confirmButtonText: "ตกลง",
});
          </script>
          <?php endif; $this->session->mark_as_temp('msg',20); ?>


          <script>
$(document).ready(function() {
    jQuery('#seplanset_startdate').datetimepicker({
        lang: 'th',
        format: 'd-m-Y H:i:s'
    });
    jQuery('#seplanset_enddate').datetimepicker({
        lang: 'th',
        format: 'd-m-Y H:i:s'
    });

    $('[data-toggle="popover"]').popover();

    $('#example').DataTable({
        "order": [
            [6, "desc"]
        ]
    });
    $('#tb_checkplan').DataTable({
        "order": [
            [0, "desc"],
            [2, "asc"]
        ]
    });
    $('#TableShoowPlan').DataTable({
        "order": [
            [1, "desc"]
        ]
    });
    $('#tb_plan').DataTable({
        "order": [
            [0, "desc"]
        ]
    });
    $('#tb_RoomOnline').DataTable({
        "order": [
            [2, "desc"]
        ]
    });


    $('#tb_reprotplan').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excelHtml5',
            text: '<i class="fa fa-file-excel-o"></i> ',
            title: 'รายงาน',
            titleAttr: 'Exportar a Excel',
            className: 'btn btn-success'
        }]
    });



});
          </script>

          <script>
// Disable form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
          </script>

          </html>