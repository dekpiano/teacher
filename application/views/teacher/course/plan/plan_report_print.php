<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=export.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!-- Dashboard Counts Section-->
<section class="">
    <div class="container-fluid">


        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="" class="table table-hover table-bordered" style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <td colspan="9">ทะเบียนส่งโครงการสอน</td>
                            </tr>
                            <tr class="text-center">
                                <td colspan="9">กลุ่มสาระการเรียนรู้<?=$lean[0]->lear_namethai?></td>
                            </tr>
                            <tr class="text-center">
                                <td colspan="9">ภาคเรียนที่ <?=$setupplan[0]->seplanset_term?> ปีการศึกษา <?=$setupplan[0]->seplanset_year?></td>
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
                                <th>เพิ่มเติม</th>
                                <th>พื้นฐาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($checkplan as $key => $v_checkplan):
                                $bg_alert = '';
                                if($v_checkplan->seplan_status1 == "ผ่าน" && $v_checkplan->seplan_status2 == "ผ่าน"){
                                    $bg_alert = "table-success";
                                }
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

                                <td> <?php if($v_checkplan->seplan_createdate === "0000-00-00 00:00:00"):?>
                                        ยังไม่ได้ส่ง
                                    <?php else:?>
                                    <?=$this->datethai->thai_date_fullmonth(strtotime($v_checkplan->seplan_createdate));?>
                                    <?php endif; ?>
                                </td>

                                <td></td>


                            </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>


    </div>
</section>