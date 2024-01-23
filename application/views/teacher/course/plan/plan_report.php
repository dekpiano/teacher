<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center ">
            <h2 class="no-margin-bottom">รายงาน</h2>

        </div>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body statistic">
                        <div class="media align-items-center">
                            <div class="icon bg-red"><i class="fa fa-file-text" aria-hidden="true"></i></div>
                            <div class="media-body overflow-hidden">
                                <h5 class="card-text mb-0"> รายงานแบบตรวจแผนการจัดการเรียนรู้</h5>
                            </div>
                        </div><a href="<?=base_url('Course/ReportPlan/แบบตรวจแผนการจัดการเรียนรู้');?>" class="tile-link"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body statistic">
                        <div class="media align-items-center">
                            <div class="icon bg-red"><i class="fa fa-file-text" aria-hidden="true"></i></div>
                            <div class="media-body overflow-hidden">
                                <h5 class="card-text mb-0"> รายงานแบบบันทึกตรวจใช้แผน</h5>
                            </div>
                        </div><a href="<?=base_url('Course/ReportPlan/บันทึกตรวจใช้แผน');?>" class="tile-link"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body statistic">
                        <div class="media align-items-center">
                            <div class="icon bg-red"><i class="fa fa-file-text" aria-hidden="true"></i></div>
                            <div class="media-body overflow-hidden">
                                <h5 class="card-text mb-0"> รายงานโครงการสอน</h5>
                            </div>
                        </div><a href="<?=base_url('Course/ReportPlan/โครงการสอน');?>" class="tile-link"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body statistic">
                        <div class="media align-items-center">
                            <div class="icon bg-red"><i class="fa fa-file-text" aria-hidden="true"></i></div>
                            <div class="media-body overflow-hidden">
                                <h5 class="card-text mb-0"> รายงานแผนการสอนหน้าเดียว</h5>
                            </div>
                        </div><a href="<?=base_url('Course/ReportPlan/แผนการสอนหน้าเดียว');?>"
                            class="tile-link"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body statistic">
                        <div class="media align-items-center">
                            <div class="icon bg-red"><i class="fa fa-file-text" aria-hidden="true"></i></div>
                            <div class="media-body overflow-hidden">
                                <h5 class="card-text mb-0"> รายงานบันทึกหลังสอน</h5>
                            </div>
                        </div><a href="<?=base_url('Course/ReportPlan/บันทึกหลังสอน');?>" class="tile-link"></a>
                    </div>
                </div>
            </div>           
        </div>
        

        <?php if(isset($ID)): ?>
            <?php if($this->session->userdata('login_id') == 'pers_014' || $this->session->userdata('login_id') == 'pers_051' || $this->session->userdata('login_id') == 'pers_021'): ?>
        <form method="get" action="<?=base_url('Course/ReportPlan/'.$this->uri->segment('3'));?>" class="needs-validation mb-2" novalidate>
        <div class="form-row justify-content-center">
            <div class="col-auto my-1">
            <select class="form-control" id="select_lean" name="select_lean" required>
                            <option value="">เลือกกลุ่มสาระการเรียนรู้</option>
                            <?php foreach ($lean as $key => $v_lean) : ?>
                            <option value="<?=$v_lean->lear_id?>"><?=$v_lean->lear_namethai?></option>
                            <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">กรุณาเลือกกลุ่มสาระการเรียนรู้</div>
            </div>  
            <div class="col-auto my-1">
            <select class="form-control" id="CheckYear" name="CheckYear" required>
                            <option value="">เลือกปีการศึกษา</option>
                            <?php foreach ($CheckYear as $key => $v_CheckYear) : ?>
                            <option value="<?=$v_CheckYear->seplan_term.'-'.$v_CheckYear->seplan_year?>"><?=$v_CheckYear->seplan_term.'/'.$v_CheckYear->seplan_year?></option>
                            <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">กรุณาเลือกปีการศึกษา</div>
            </div>  

            <div class="col-auto my-1">
            <button type="submit" class="btn btn-primary">ค้นหา</button>
            </div>
        </div>
        </form>
        <?php endif; ?>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="" class="table table-hover table-bordered" style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <td colspan="9">ทะเบียนส่ง<?=$thai;?></td>
                            </tr>
                            <tr class="text-center">
                                <td colspan="9">กลุ่มสาระการเรียนรู้<?=@$leanUser[0]->lear_namethai?></td>
                            </tr>
                            <tr class="text-center">
                                <td colspan="9">ภาคเรียนที่ <?=$seplanset_term?> ปีการศึกษา
                                    <?= $seplanset_year ?></td>
                            </tr>
                            <tr class="text-center">
                                <th rowspan="2">ที่</th>
                                <th rowspan="2">ชื่อ-นามสกุล</th>
                                <th colspan="2">รายวิชา</th>
                                <th rowspan="2">ชื่อวิชา</th>
                                <th rowspan="2">รหัสวิชา</th>
                                <th rowspan="2">ระดับชั้น</th>
                                <th rowspan="2">วัน/เดือน/ปี</th>
                                <th rowspan="2">หมายเหตุ</th>
                            </tr>
                            <tr class="text-center">
                                <th>พื้นฐาน</th>
                                <th>เพิ่มเติม</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($checkplan as $key => $v_checkplan):
                                $bg_alert = '';
                                if($v_checkplan->seplan_status1 == "ผ่าน" && $v_checkplan->seplan_status2 == "ผ่าน"){
                                    $bg_alert = "table-success";
                                }
                                if(date('Y',strtotime($v_checkplan->seplan_createdate)) == "2021"){

                                }else{

                                
                            ?>

                            <tr id="bgC<?=$v_checkplan->seplan_ID;?>">
                                <!-- class="<?=$bg_alert;?>" -->
                                <td><?=$key+1;?></td>
                                <td><?=$v_checkplan->pers_prefix.$v_checkplan->pers_firstname.' '.$v_checkplan->pers_lastname;?>
                                </td>
                                <td><?=$v_checkplan->seplan_typesubject=="พื้นฐาน" ? '&#10004;' : ''?></td>
                                <td><?=$v_checkplan->seplan_typesubject=="เพิ่มเติม" ? '&#10004;' : ''?></td>
                                <td><?=$v_checkplan->seplan_namesubject;?></td>
                                <td><?=$v_checkplan->seplan_coursecode;?></td>
                                <td>ม.<?=$v_checkplan->seplan_gradelevel;?></td>

                                <td>
                                    <?php if($v_checkplan->seplan_createdate === "0000-00-00 00:00:00"):?>
                                        ยังไม่ได้ส่ง
                                    <?php else:?>
                                    <?=$this->datethai->thai_date_fullmonth(strtotime($v_checkplan->seplan_createdate));?>
                                    <?php endif; ?>
                                </td>

                                <td></td>
                            </tr>
                            <?php } endforeach; ?>
                        </tbody>

                    </table>
                    <div class="text-center">
                        <?php if(isset($_GET['select_lean'])): ?>
                        <a class="btn btn-primary" href="<?=base_url('ConTeacherCourse/report_plan_print/'.$thai.'/'.$_GET['select_lean'].'/'.$_GET['CheckYear'])?>"><i
                                class="fa fa-print" aria-hidden="true"></i> ดาวโหลดรายงาน .xlsx</a> 
                        <?php else: ?>  
                            <a class="btn btn-primary" href="<?=base_url('ConTeacherCourse/report_plan_print/'.$thai)?>"><i
                                class="fa fa-print" aria-hidden="true"></i> ดาวโหลดรายงาน .xlsx</a> 
                        <?php endif; ?>                   
                    </div>
                    <!-- <div class="text-red text-center mt-3">
                                หมายเหตุ**  ข้อมูลจะปรากฏในตารางก็ต่อเมื่อ หัวหน้ากลุ่มสาระและหัวหน้ากลุ่มงานหลักสูตร ตรวจว่าผ่าน ทั้งคู่
                    </div> -->


                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>
</section>