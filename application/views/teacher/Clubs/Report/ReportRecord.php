<style>
.subheader {
    text-align: center;
}

.vertical-text {
    writing-mode: vertical-lr;
    /* หมุนข้อความแนวตั้ง */
    transform: rotate(180deg);
    /* หมุนกลับด้าน (หากต้องการให้อ่านจากล่างขึ้นบน) */
    text-align: center;
}
</style>
<style>
/* กำหนดตำแหน่งของแถวหัวตาราง */
thead th {
    position: sticky;
    background-color: #f8f9fa;
    /* สีพื้นหลังของหัวตาราง */
    z-index: 99;
    /* เพื่อให้หัวตารางอยู่เหนือข้อมูล */
}

/* ระบุตำแหน่งเฉพาะสำหรับแต่ละแถว */
thead tr:first-child th {
    top: 0;
    /* ตรึงแถวแรกให้อยู่ด้านบน */
}

thead tr:nth-child(2) th {
    top: 40px;
    /* ความสูงของแถวแรก */
}

thead tr:nth-child(3) th {
    top: 80px;
    /* ความสูงของแถวแรก + แถวที่สอง */
}

.table-wrapper {
    max-height: 600px;
    /* กำหนดความสูงของตาราง */
    overflow-y: auto;
    /* ทำให้เลื่อนในแนวตั้งได้ */
    overflow-x: auto;
    /* ทำให้เลื่อนในแนวนอนได้ */
}

/* ตรึงคอลัมน์ด้านซ้าย */
.sticky-col {
    position: sticky;
    left: 0;
    /* คอลัมน์แรกติดซ้าย */
    background-color: #fff;
    /* สีพื้นหลังคอลัมน์ */
    z-index: 0;
    /* ให้สูงกว่าหัวตาราง */
    position: relative;
}
</style>


<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">รายงานการบันทึกเวลาเรียน</h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class=" p-4">

    <div class="container-fluid">
        <div class="crad">
            <div class="card-body">
                <?php $ExYear =  explode('/',$GetSchedule[0]->tcs_academic_year); ?>
                <div class="subheader" style="font-size:18px;">กิจกรรม คอมพิวเตอร์และหุ่นยนต์ ระดับชั้นมัธยมศึกษา
                    ตอนปลาย
                </div>
                <div class="subheader" style="font-size:18px;">เวลาเรียน 2 ชั่วโมง/สัปดาห์ รวมเวลาเรียน 40 ชั่วโมง</div>
            </div>
        </div>


        <div class="table-responsive table-wrapper table-hover">

            <table class="table bg-white table-bordered" id="TbReportAttendanceActivity"
                style="table-layout: fixed;width:auto;">
                <thead>
                    <tr class="text-center bg-light thead">
                        <th rowspan="3" width="50" class="vertical-text">เลขที่</th>
                        <th rowspan="3" width="80" class=""> เลขประจำตัว</th>
                        <th rowspan="3" width="200" class="">ชื่อ - นามสกุล</th>
                        <th rowspan="3" width="50" class=""> ชั้น</th>
                        <th colspan="<?=count($GetSchedule)?>">การบันทึกเวลาเรียน ภาคเรียนที่
                            <?=$ExYear[1]?>
                            ปีการศึกษา
                            <?=$ExYear[0]?></th>
                        <th colspan="7">สรุปเวลาเรียนกิจกรรม</th>
                    </tr>
                    <tr class="text-center bg-light thead">
                        <?php foreach ($GetSchedule as $key => $v_GetSchedule) : ?>
                        <th><?=$v_GetSchedule->tcs_week_number?></th>
                        <?php endforeach; ?>
                        <th rowspan="2" class="vertical-text">มา</th>
                        <th rowspan="2" class="vertical-text">ขาด</th>
                        <th rowspan="2" class="vertical-text">ลาป่วย</th>
                        <th rowspan="2" class="vertical-text">ลากิจ</th>
                        <th rowspan="2" class="vertical-text">กิจกรรม</th>
                        <th rowspan="2" class="vertical-text">รวม</th>
                        <th rowspan="2">%</th>

                    </tr>
                    <tr class="text-center bg-light thead">
                        <?php foreach ($GetSchedule as $key => $v_GetSchedule) : ?>
                        <th width="32"><?=$this->datethai->thai_date_short(strtotime($v_GetSchedule->tcs_start_date))?>
                        </th>
                        <?php endforeach; ?>
                    </tr>

                </thead>
                <tbody>


                    <?php foreach ($GetStudent as $key => $v_GetStudent) : ?>
                    <tr>
                        <td class="text-center sticky-col"><?=$v_GetStudent->StudentNumber?></td>
                        <td class="text-center sticky-col"><?=$v_GetStudent->StudentCode?></td>
                        <td class="text-center sticky-col" style="white-space: nowrap"><?=$v_GetStudent->FullnameStu?>
                        </td>
                        <td class="text-center sticky-col"><?=$v_GetStudent->StudentClass?></td>
                        <?php foreach ($GetSchedule as $key => $v_GetSchedule) : ?>
                        <?php 
                $Status = "";$BgColor="";
                $ExMa = explode('|',$v_GetSchedule->tcra_ma);
                if(in_array($v_GetStudent->member_student_id,$ExMa)){
                    $Status = "ม";
                    $BgColor = "bg-success text-white";
                }
                $ExKhad = explode('|',$v_GetSchedule->tcra_khad);
                if(in_array($v_GetStudent->member_student_id,$ExKhad)){
                    $Status =  "ข";
                    $BgColor = "bg-danger text-white";
                }
                $ExRapwy = explode('|',$v_GetSchedule->tcra_rapwy);
                if(in_array($v_GetStudent->member_student_id,$ExRapwy)){
                    $Status =  "ลป";
                    $BgColor = "bg-warning";
                }
                $ExRakic = explode('|',$v_GetSchedule->tcra_rakic);
                if(in_array($v_GetStudent->member_student_id,$ExRakic)){
                    $Status =  "ลก";
                    $BgColor = "bg-warning";
                }
                $ExKickrrm = explode('|',$v_GetSchedule->tcra_kickrrm);
                if(in_array($v_GetStudent->member_student_id,$ExKickrrm)){
                    $Status =  "ก";
                    $BgColor = "bg-gray";
                }
                ?>
                        <td class="GetStatus text-center <?=$BgColor?>">
                            <?=$Status;?>
                        </td>
                        <?php endforeach; ?>
                        <td class="text-center ShowNumMa"></td>
                        <td class="text-center ShowNumKhad"></td>
                        <td class="text-center ShowNumRapwy"></td>
                        <td class="text-center ShowNumRakic"></td>
                        <td class="text-center ShowNumkickrrm"></td>
                        <td class="text-center ShowNumToTal"></td>
                        <td class="text-center ShowNumAverage"></td>
                    </tr>
                    <?php endforeach; ?>



                </tbody>
            </table>
        </div>
    </div>
</section>

