<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center ">
            <h2 class="no-margin-bottom">แผนการสอน</h2>
            <!-- <p class="mb-0">

                <a href="<?=base_url('Course/SendPlan');?>" class="btn btn-primary mb-2 mb-sm-0 text-white">+
                    ลงทะเบียนวิชา</a>
            </p> -->
        </div>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="">
    <div class="container-fluid">
        <?php  if($OnOff[0]->seplanset_startdate < date('Y-m-d H:i:s') && $OnOff[0]->seplanset_enddate >  date('Y-m-d H:i:s') && $OnOff[0]->seplanset_status == "on"):?>
        <div class="alert alert-success">
            <strong>แจ้งเตือน!</strong> ขณะนี้ระบบเปิดให้ส่งงาน
            <strong> ระหว่าง (<?=$this->datethai->thai_date_and_time(strtotime($OnOff[0]->seplanset_startdate));?> ถึง
                <?=$this->datethai->thai_date_and_time(strtotime($OnOff[0]->seplanset_enddate));?>) </strong>
        </div>
        <?php else: ?>
        <div class="alert alert-danger">
            <strong>แจ้งเตือน!</strong> ขณะนี้ระบบปิด <strong>เนื่องจากยังไม่ถึงกำหนดส่งงาน หรือ
                เกินกำหนดส่งงาน</strong> กำหนดส่งงาน
            (<?=$this->datethai->thai_date_and_time(strtotime($OnOff[0]->seplanset_startdate));?> ถึง
            <?=$this->datethai->thai_date_and_time(strtotime($OnOff[0]->seplanset_enddate));?>)
        </div>
        <?php endif; ?>
        <div class="recent-updates card">
            <div class="card-close">
                <a target="_blank" href="<?=base_url('uploads/academic/course/คู่มือการส่งแผนการสอนออนไลน์2.0.pdf')?>"
                    class="btn btn-outline-dark">คู่มือการใช้งาน</a>
            </div>
            <div class="card-header">
                <h3 class="h4">คำแนะนำ</h3>
            </div>
            <div class="card-body no-padding">
                <!-- Item-->
                <div class="item d-flex justify-content-between">
                    <div class="info d-flex">
                        <div class="icon"><i class="icon-rss-feed"></i></div>
                        <div class="title">
                            <h5>- แต่ละรายการที่ส่ง ส่งได้แค่ไฟล์เดียวเท่านั้น ไม่สามารถส่งแยกไฟล์ได้</h5>
                            <h5>- ให้รวมไฟล์เป็นไฟล์เดียวในแต่ละรายการ ของแต่ละวิชา เช่น แผนการสอนก็รวมตั้งแต่ แผนที่ 1
                                - แผนที่ 20 เป็นต้น</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $Y = $this->uri->segment(3).'/'.$this->uri->segment(4); ?>
        <div class="row justify-content-center">
            <div class="d-flex mb-3">
                <div class=" align-self-center" style="width: 150px;">เลือกปีการศึกษา</div>
                <select class="form-control w-auto" id="CheckYearSendPlan">
                    <?php 
                    $SelYear = array('2566/1','2566/2');
                    foreach ($SelYear as $key => $v_SelYear) : ?>
                    <option <?php echo ($Y == $v_SelYear ?"selected":"") ?> value="<?=$v_SelYear?>"><?=$v_SelYear?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>


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
                            foreach ($planNew as $key => $v_planNew): ?>
                            <tr>
                                <td scope="row"><?=$v_planNew->seplan_term?>/<?=$v_planNew->seplan_year?></td>
                                <td><?=$v_planNew->seplan_coursecode.' '.$v_planNew->seplan_namesubject?></td>
                                <td>ม.<?=$v_planNew->seplan_gradelevel?></td>
                                <td><?=$v_planNew->seplan_typesubject?></td>

                                <?php foreach($typeplan as $key => $v_typeplan): ?>
                                <?php foreach($plan as $key => $v_plan):?>
                                <?php if($v_plan->seplan_coursecode == $v_planNew->seplan_coursecode && $v_plan->seplan_typeplan == $v_typeplan):  ?>
                                <td>
                                    <?php if($v_plan->seplan_file == null): ?>
                                    <span class="badge badge-danger h6 text-white">ยังไม่ส่ง</span>
                                    <?php else: ?>
                                    <span class="badge badge-success h6 text-white">ส่งแล้ว</span>
                                    <a href="<?=base_url('uploads/academic/course/plan/'.$OnOff[0]->seplanset_year.'/'.$OnOff[0]->seplanset_term.'/'.$v_plan->seplan_namesubject.'/'.$v_plan->seplan_file)?>"
                                        target="_blank" rel="noopener noreferrer">
                                        <span class="badge badge-primary h6 text-white"><i class="fa fa-eye"
                                                aria-hidden="true" data-toggle="popover" data-trigger="hover"
                                                data-content="เปิดดู" data-placement="top"></i></span>
                                    </a>
                                    <?php endif; ?>

                                    <label class="badge badge-warning h6" style="cursor: pointer;" data-toggle="popover"
                                        data-trigger="hover" data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                        <i class="fa fa-upload Model_update" aria-hidden="true" data-toggle="modal"
                                            data-target="#ModalUpdatePlan" seplanID="<?=$v_plan->seplan_ID?>"
                                            seplanCoursecode="<?=$v_plan->seplan_coursecode?>"
                                            seplanTypeplan="<?=$v_plan->seplan_typeplan?>"
                                            seplan_sendcomment="<?=$v_plan->seplan_sendcomment?>"></i>

                                    </label>
                                    <br>
                                    <small>ผู้ส่ง : <?=$v_plan->seplan_sendcomment?></small> <br>
                                    <small>หน.ก :
                                        <?php if($v_plan->seplan_status1 == ""){
                                           echo 'รอตรวจ';
                                       }else{                                       
                                            if($v_plan->seplan_status1 == 'ผ่าน'){
                                                echo '<span class="text-success">'.$v_plan->seplan_status1.'</span>';
                                            }else{
                                                echo '<span class="text-danger">'.$v_plan->seplan_status1." (".$v_plan->seplan_comment1.")".'</span>';
                                            }
                                       } ?>
                                    </small><br>
                                    <small>หน.ง :
                                        <?php if($v_plan->seplan_status2 == ""){
                                           echo 'รอตรวจ';
                                       }else{                                       
                                            if($v_plan->seplan_status2 == 'ผ่าน'){
                                                echo '<span class="text-success">'.$v_plan->seplan_status2.'</span>';
                                            }else{
                                                echo '<span class="text-danger">'.$v_plan->seplan_status2." (".$v_plan->seplan_comment2.")".'</span>';
                                            }
                                       } ?>
                                    </small>
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
                        <input type="hidden" id="seplan_year" name="seplan_year" value="<?=$this->uri->segment(3)?>">
                        <input type="hidden" id="seplan_term" name="seplan_term" value="<?=$this->uri->segment(4)?>">

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
                ระบบปิดอยู่ ยังไม่ถึงกำหนดส่งงาน หรือ เกินกำหนดส่งงาน <br>
                ไม่สามารถเพิ่มไฟล์หรือแก้ไขไฟล์ได้ <br>
                ติดต่อหัวงานหลักสูตร
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>