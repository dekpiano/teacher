<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center ">
            <h2 class="no-margin-bottom"><?=$title?><?=$lean[0]->lear_namethai?></h2>
        </div>
    </div>
</header>
<div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('Course/CheckPlan')?>">กลุ่มสาระ</a></li>
        <li class="breadcrumb-item"><a href="<?=base_url('Course/CheckPlan/'.$lean[0]->lear_id)?>"><?=$lean[0]->lear_namethai?></a></li>
        <li class="breadcrumb-item active"><?=$planNew[0]->pers_prefix.$planNew[0]->pers_firstname.' '.$planNew[0]->pers_lastname?></li>
    </ul>
</div>
<!-- Dashboard Counts Section-->
<section class="">
    <div class="container-fluid">
        <div class="articles card">
            <div class="card-header d-flex align-items-center">
                <h2 class="h3">ส่งแผนของ <?=$planNew[0]->pers_prefix.$planNew[0]->pers_firstname.' '.$planNew[0]->pers_lastname?> </h2>
                <!-- <div class="badge badge-rounded bg-green">4 New </div> -->
            </div>
            
        </div>

        <?php  $typeplan = array('บันทึกตรวจใช้แผน','แบบตรวจแผนการจัดการเรียนรู้','โครงการสอน','แผนการสอนหน้าเดียว','บันทึกหลังสอน'); ?>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tb_checkplan" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th class="w-auto">ปีการศึกษา</th>
                                <th class="w-25">รหัสชื่อวิชา</th>
                                <th class="w-auto">ระดับ</th>
                                <th class="w-auto">ผู้ส่ง</th>
                                <th class="w-auto">แบบตรวจแผน</th>
                                <th class="w-auto">บันทึกตรวจใช้แผน</th>
                                <th class="w-auto">โครงการสอน</th>
                                <th class="w-auto">แผนการสอนหน้าเดียว</th>
                                <th class="w-auto">บันทึกหลังสอน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  foreach ($planNew as $key => $v_planNew): ?>
                            <tr>
                                <td scope="row"><?=$v_planNew->seplan_term?>/<?=$v_planNew->seplan_year?></td>
                                <td><?=$v_planNew->seplan_coursecode.' '.$v_planNew->seplan_namesubject?>
                                    (<?=$v_planNew->seplan_typesubject?>)</td>
                                <td>ม.<?=$v_planNew->seplan_gradelevel?></td>
                                <td><?=$v_planNew->pers_prefix.$v_planNew->pers_firstname.' '.$v_planNew->pers_lastname;?>
                                </td>

                                <?php foreach($typeplan as $key => $v_typeplan): ?>
                                <?php foreach($checkplan as $key => $v_plan): ?>
                                <?php if($v_plan->seplan_coursecode == $v_planNew->seplan_coursecode && $v_plan->seplan_typeplan == $v_typeplan && $v_planNew->pers_id == $v_plan->seplan_usersend):  ?>
                                <td>
                                    <?php if($v_plan->seplan_file == null): ?>
                                    <span class="badge badge-danger h6 text-white">ยังไม่ส่ง</span>
                                    <?php else: ?>
                                    <span class="badge badge-success h6 text-white">ส่งแล้ว</span>
                                    <a href="<?=base_url('uploads/academic/course/plan/'.$v_plan->seplan_year.'/'.$v_plan->seplan_term.'/'.$v_plan->seplan_namesubject.'/'.$v_plan->seplan_file)?>"
                                        target="_blank" rel="noopener noreferrer">
                                        <span class="badge badge-primary h6 text-white"><i class="fa fa-eye"
                                                aria-hidden="true" data-toggle="popover" data-trigger="hover"
                                                data-content="เปิดดู" data-placement="top"></i></span>
                                    </a>
                                    <?php endif; ?>

                                    <br>
                                    <small><b>ผู้ส่ง :</b> <?=$v_plan->seplan_sendcomment?></small> <br>
                                    <small><b>หน.ก : </b>
                                        <?php 
                                        if($v_plan->seplan_status1 == "ผ่าน"){ 
                                            $textColor="text-success";
                                        }elseif($v_plan->seplan_status1 == "ไม่ผ่าน"){
                                            $textColor="text-danger";
                                        }else{
                                            $textColor="";
                                        } 

                                        if($v_plan->seplan_status2 == "ผ่าน"){
                                            $textColor2="text-success";
                                        }elseif($v_plan->seplan_status2 == "ไม่ผ่าน"){
                                            $textColor2="text-danger";
                                        }
                                        else{
                                            $textColor2="";
                                        }
                                        ?>
                                        <?php if($this->session->userdata('login_id') == 'pers_014' && $this->session->userdata('pers_learning') != $IDlear): ?>
                                        <span class="<?=$textColor;?>"> <?php echo $v_plan->seplan_status1;?></span>
                                        <?php else: ?>
                                        <select id="seplan_status1" name="seplan_status1"
                                            data-planId="<?=$v_plan->seplan_ID;?>"
                                            class="bgC<?=$v_plan->seplan_ID;?> seplan_status1 <?=$textColor;?> ">
                                            <option <?=$v_plan->seplan_status1 == "รอตรวจ" ? 'selected' : ''?>
                                                value="รอตรวจ">รอตรวจ</option>
                                            <option <?=$v_plan->seplan_status1 == "ผ่าน" ? 'selected' : ''?>
                                                value="ผ่าน">ผ่าน</option>
                                            <option <?=$v_plan->seplan_status1 == "ไม่ผ่าน" ? 'selected' : ''?>
                                                value="ไม่ผ่าน">ไม่ผ่าน</option>
                                        </select>
                                        <div class="IDCom0<?=$v_plan->seplan_ID;?> TbShowComment1">
                                            <?=$v_plan->seplan_status1 == "ไม่ผ่าน" ? '<a href="#" class="show_comment1" data-toggle="modal" data-planId="'.$v_plan->seplan_ID.'" data-target="#addcomment1">หมายเหตุ</a>' : ''?>
                                        </div>
                                       
                                        <?php endif; ?>
                                    </small>
                                    <br>
                                    <small><b>หน.ง : </b>
                                        <?php if($this->session->userdata('login_id') == 'pers_014'):?>
                                        <select id="seplan_status2" name="seplan_status2"
                                            planId="<?=$v_plan->seplan_ID;?>"
                                            class="bgCC<?=$v_plan->seplan_ID;?>  seplan_status2 <?=$textColor2;?>">
                                            <option <?=$v_plan->seplan_status2 == "รอตรวจ" ? 'selected' : ''?>
                                                value="รอตรวจ">รอตรวจ</option>
                                            <option <?=$v_plan->seplan_status2 == "ผ่าน" ? 'selected' : ''?>
                                                value="ผ่าน">ผ่าน</option>
                                            <option <?=$v_plan->seplan_status2 == "ไม่ผ่าน" ? 'selected' : ''?>
                                                value="ไม่ผ่าน">ไม่ผ่าน</option>
                                        </select>
                                        <div class="IDCom<?=$v_plan->seplan_ID;?> TbShowComment2">
                                            <?=$v_plan->seplan_status2 == "ไม่ผ่าน" ? '<a href="#" class="show_comment2" data-toggle="modal" data-planId="'.$v_plan->seplan_ID.'" data-target="#addcomment2">หมายเหตุ</a>' : ''?>
                                        </div>
                                        <?php else: echo $v_plan->seplan_status2; ?>
                                        <?php endif; ?>
                                </td>
                                <?php endif; ?>
                                <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <?php  endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
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