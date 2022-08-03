<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center ">
            <h2 class="no-margin-bottom">แผนการสอน</h2>  
        </div>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="">
    <div class="container-fluid">
    
        <?php  $typeplan = array('บันทึกตรวจใช้แผน','แบบตรวจแผนการจัดการเรียนรู้','โครงการสอน','แผนการสอนหน้าเดียว','บันทึกหลังสอน'); ?>
        <div class="card">
            <div cass="card-body">
                <div class="p-3">
                    <table class="table table-hover" id="tb_plan">
                        <thead>
                            <tr>
                                <th scope="col">ปีการศึกษา</th>
                                <th scope="col">รหัสชื่อวิชา</th>
                                <th scope="col">ระดับ</th>
                                <th scope="col">ประเภท</th>
                                <th scope="col">แบบตรวจแผน</th>
                                <th scope="col">บันทึกตรวจใช้แผน</th>
                                <th scope="col">โครงการสอน</th>
                                <th scope="col">แผนการสอนหน้าเดียว</th>
                                <th scope="col">บันทึกหลังสอน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($planNew as $key => $v_planNew):?>
                            <tr>
                                <td scope="row"><?=$v_planNew->seplan_term?>/<?=$v_planNew->seplan_year?></td>
                                <td><?=$v_planNew->seplan_coursecode.' '.$v_planNew->seplan_namesubject?></td>
                                <td>ม.<?=$v_planNew->seplan_gradelevel?></td>
                                <td><?=$v_planNew->seplan_typesubject?></td>

                                <?php foreach($typeplan as $key => $v_typeplan): ?>
                                <?php foreach($plan as $key => $v_plan): ?>
                                <?php if($v_plan->seplan_coursecode == $v_planNew->seplan_coursecode && $v_plan->seplan_typeplan == $v_typeplan):  ?>
                                <td>
                          
                                    <a href="<?=base_url('uploads/academic/course/plan/'.$v_plan->seplan_year.'/'.$v_plan->seplan_term.'/'.$v_plan->seplan_namesubject.'/'.$v_plan->seplan_file)?>"
                                        target="_blank" rel="noopener noreferrer">
                                        <span class="badge badge-primary h6 text-white"><i class="fa fa-eye"
                                                aria-hidden="true" data-toggle="popover" data-trigger="hover"
                                                data-content="เปิดดู" data-placement="top"></i></span>
                                    </a>
                                  

                                    
                                </td>
                                <?php endif; ?>
                                <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

</section>


<!-- Modal -->
<div class="modal fade" id="ModalUpdatePlan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">เลือกไฟล์</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php if($OnOff[0]->seplanset_startdate < date('Y-m-d H:i:s') && $OnOff[0]->seplanset_enddate >  date('Y-m-d H:i:s') && $OnOff[0]->seplanset_status == "on"): ?>
            <form class="update_seplan" style="display: contents;">
                <div class="modal-body">

                    <div class="form-group">
                        <input type="hidden" id="seplan_ID" name="seplan_ID" value="">
                        <input type="hidden" id="seplan_typeplan" name="seplan_typeplan" value="">
                        <input type="hidden" id="seplan_coursecode" name="seplan_coursecode" value="">
                        <input id="seplan_file" name="seplan_file" type="file" class="">
                    </div>
                    <div class="form-group">
                        <label for="seplan_sendcomment">หมายเหตุ</label>
                        <textarea class="form-control" id="seplan_sendcomment" name="seplan_sendcomment" rows="5"
                            placeholder="เช่น ส่งแผนครบแล้ว หรือ ส่งแผนที่ 1 - 4 แล้ว"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">ส่งไฟล์</button>
                </div>
            </form>


            <?php else: ?>
            <div class="modal-body">
                ระบบปิดอยู่  ยังไม่ถึงกำหนดส่งงาน หรือ เกินกำหนดส่งงาน <br>
                ไม่สามารถเพิ่มไฟล์หรือแก้ไขไฟล์ได้ <br>
                ติดต่อหัวงานหลักสูตร
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>