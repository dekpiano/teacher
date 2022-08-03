

<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center ">
            <h2 class="no-margin-bottom">ตรวจสอบงาน</h2>

        </div>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="">
    <div class="container-fluid">

        <div class="row">
            <?php foreach ($lean as $key => $v_lean): ?>
            <?php if($this->session->userdata('pers_learning') == $v_lean->lear_id || $this->session->userdata('login_id') == 'pers_014' || $this->session->userdata('login_id') == 'pers_002' || $this->session->userdata('login_id') == 'pers_003'): ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body statistic">
                        <div class="media align-items-center">
                            <div class="icon bg-red"><i class="fa fa-tasks"></i></div>
                            <div class="media-body overflow-hidden">
                                <h5 class="card-text mb-0"> <?=$v_lean->lear_namethai?></h5>
                                <small><?=$v_lean->lear_nameeng?></small>

                            </div>
                        </div><a href="<?=base_url('Course/CheckPlan/');?><?=$v_lean->lear_id?>"
                            class="tile-link"></a>
                    </div>
                </div>

            </div>
            <?php endif; endforeach; ?>

        </div>
    </div>
</section>

<div id="addcomment1" tabindex="-1" aria-labelledby="exampleModalLabel" class="modal fade text-left" aria-hidden="true"
    style="display: none;">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

                <form id="form-comment1" class="form-comment1">
                    <div class="form-group">
                        <label for="seplan_comment1">หมายเหตุ:</label>
                        <textarea wrap="hard" class="form-control seplan_comment1" rows="5" name="seplan_comment1"
                            id="seplan_comment1"
                            placeholder="ไม่ผ่านเพราะ เช่น ปรับชื่อรายชื่อ หน้า 5 หรือ ลืมใส่ข้อมูลต้องกรอก"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" id="sub_comment1" data-planId class="btn btn-primary">บันทึก</button>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div id="addcomment2" tabindex="-1" aria-labelledby="exampleModalLabel" class="modal fade text-left" aria-hidden="true"
    style="display: none;">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

                <form id="form-comment2" class="form-comment2">
                    <div class="form-group">
                        <label for="seplan_comment2">หมายเหตุ:</label>
                        <textarea wrap="hard" class="form-control seplan_comment2" rows="5" name="seplan_comment2"
                            id="seplan_comment2"
                            placeholder="ไม่ผ่านเพราะ เช่น ปรับชื่อรายชื่อ หน้า 5 หรือ ลืมใส่ข้อมูลต้องกรอก"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" id="sub_comment2" data-planId class="btn btn-primary">บันทึก</button>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>