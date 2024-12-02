<style>
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 24px;
}

th,
td {
    border: 1px solid black;
    padding: 8px;
    text-align: center;
}

th {
    background-color: #f2f2f2;
}

.header {
    font-weight: bold;
    text-align: center;
}

.subheader {
    text-align: center;
    font-weight: bold;
}

.vertical-text {
    text-rotate:90;
    /* หมุนกลับด้าน (หากต้องการให้อ่านจากล่างขึ้นบน) */
    text-align: center;
    white-space: nowrap;
}
</style>

<!-- Dashboard Counts Section-->

        <?php $ExYear =  explode('/',$GetSchedule[0]->tcs_academic_year); ?>
        <div class="subheader" style="font-size:22px;">บันทึกเวลาเรียน </div>
        <div class="subheader" style="font-size:18px;">กิจกรรมชุมนุม คอมพิวเตอร์และหุ่นยนต์ ระดับชั้นมัธยมศึกษา ตอนปลาย</div>
        <div class="subheader" style="font-size:18px;">เวลาเรียน 2 ชั่วโมง/สัปดาห์ รวมเวลาเรียน 40 ชั่วโมง</div>
     

            <table class="table" id="TbReportAttendanceActivity1">
                <thead>
                    <tr >
                        <th rowspan="3" class="vertical-text">เลขที่</th>
                        <th rowspan="3"> เลขประจำตัว</th>
                        <th rowspan="3" width="200">ชื่อ - นามสกุล</th>
                        <th rowspan="3"> ชั้น</th>
                        <th colspan="<?=count($GetSchedule)?>" width="481">การบันทึกเวลาเรียน ภาคเรียนที่
                            <?=$ExYear[1]?>
                            ปีการศึกษา
                            <?=$ExYear[0]?></th>
                        <th colspan="7">สรุปเวลาเรียนกิจกรรม</th>
                    </tr>
                    <tr>
                        <?php foreach ($GetSchedule as $key => $v_GetSchedule) : ?>
                        <th width="32"><?=$v_GetSchedule->tcs_week_number?></th>
                        <?php endforeach; ?>
                        <th rowspan="2" class="vertical-text">มา</th>
                        <th rowspan="2" class="vertical-text">ขาด</th>
                        <th rowspan="2" class="vertical-text">ลาป่วย/ลากิจ/กิจกรรม</th>                     
                        <th rowspan="2" class="vertical-text">รวม</th>
                        <th rowspan="2">%</th>
                        <th rowspan="2" class="vertical-text">ผลการประเมิน (ผ/มผ)</th>

                    </tr>
                    <tr>
                        <?php foreach ($GetSchedule as $key => $v_GetSchedule) : ?>
                        <th width="32" class="vertical-text"><?=$this->datethai->thai_date_short_Full(strtotime($v_GetSchedule->tcs_start_date))?>
                        </th>
                        <?php endforeach; ?>
                    </tr>

                </thead>
                <tbody>


                    <?php foreach ($GetStudent as $key => $v_GetStudent) : ?>
                    <tr>
                        <td><?=$v_GetStudent->StudentNumber?></td>
                        <td><?=$v_GetStudent->StudentCode?></td>
                        <td style="white-space: nowrap;text-align:left;"><?=$v_GetStudent->FullnameStu?></td>
                        <td><?=$v_GetStudent->StudentClass?></td>
                        <?php  $countMa = 0;$CountKhad = 0;$CountRapwy = 0;$CountRakic = 0;$CountKickrrm = 0; 
                            
                        ?>
                        <?php foreach ($GetSchedule as $key => $v_GetSchedule) : ?>
                        <?php 
                $Status = "";
                $ToTal = ($countMa+$CountKhad+$CountRapwy+$CountRakic+$CountKickrrm);
                $Age = number_format((($countMa+$CountRapwy+$CountRakic+$CountKickrrm)/($ToTal == 0 ?"1":$ToTal))*100,2);
                $ExMa = explode('|',$v_GetSchedule->tcra_ma);
                if(in_array($v_GetStudent->member_student_id,$ExMa)){
                    $Status = "/";
                    $countMa++;
                }
                $ExKhad = explode('|',$v_GetSchedule->tcra_khad);
                if(in_array($v_GetStudent->member_student_id,$ExKhad)){
                    $Status =  "ข";
                    $CountKhad++;
                }
                $ExRapwy = explode('|',$v_GetSchedule->tcra_rapwy);
                if(in_array($v_GetStudent->member_student_id,$ExRapwy)){
                    $Status =  "ลป";
                    $CountRapwy++;
                }
                $ExRakic = explode('|',$v_GetSchedule->tcra_rakic);
                if(in_array($v_GetStudent->member_student_id,$ExRakic)){
                    $Status =  "ลก";
                    $CountRakic++;
                }
                $ExKickrrm = explode('|',$v_GetSchedule->tcra_kickrrm);
                if(in_array($v_GetStudent->member_student_id,$ExKickrrm)){
                    $Status =  "ก";
                    $CountKickrrm++;
                }
                ?>
                        <td class="bg-primary">
                            <?=$Status;?>
                        </td>
                        <?php endforeach; ?>
                        <td class="text-center ShowNumMa"><?=$countMa;?></td>
                        <td class="text-center ShowNumKhad"><?=$CountKhad;?></td>
                        <td class="text-center ShowNumRapwy"><?=$CountRapwy+$CountRakic+$CountKickrrm;?></td>                     
                        <td class="text-center ShowNumToTal"><?=$ToTal?></td>
                        <td class="text-center ShowNumAverage"><?=$Age;?></td>
                        <td>
                            <?php if($Age >= 80){echo "ผ";}else{echo "มผ";} ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>


                </tbody>
            </table>
