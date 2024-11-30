<style>
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 20px;
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
}
.vertical-text {
        writing-mode: vertical-lr; /* หมุนข้อความแนวตั้ง */
        transform: rotate(180deg); /* หมุนกลับด้าน (หากต้องการให้อ่านจากล่างขึ้นบน) */
        text-align: center;
    }
</style>

<?php $ExYear =  explode('/',$GetSchedule[0]->tcs_academic_year); ?>
<div class="subheader" style="font-size:22px;">บันทึกเวลาเรียน </div>
<div class="subheader" style="font-size:18px;">กิจกรรม คอมพิวเตอร์และหุ่นยนต์ ระดับชั้นมัธยมศึกษา ตอนปลาย</div>
<div class="subheader" style="font-size:18px;">เวลาเรียน 2 ชั่วโมง/สัปดาห์ รวมเวลาเรียน 40 ชั่วโมง</div>
<table width="651">
    <tbody>

        <tr>
            <td rowspan="3" width="31" class="vertical-text">เลขที่</td>
            <td rowspan="3"> เลขประจำตัว</td>
            <td rowspan="3" width="139">ชื่อ - นามสกุล</td>
            <td rowspan="3"> ชั้น</td>
            <td colspan="<?=count($GetSchedule)?>" width="481">การบันทึกเวลาเรียน ภาคเรียนที่ <?=$ExYear[1]?> ปีการศึกษา <?=$ExYear[0]?></td>
            <td colspan="7">สรุปเวลาเรียนกิจกรรม</td>
        </tr>
        <tr>
            <?php foreach ($GetSchedule as $key => $v_GetSchedule) : ?>
            <td width="32"><?=$v_GetSchedule->tcs_week_number?></td>
            <?php endforeach; ?>
            <td rowspan="2" class="vertical-text">มา</td>
            <td rowspan="2" class="vertical-text">ขาด</td>
            <td rowspan="2" class="vertical-text">ลาป่วย</td>
            <td rowspan="2" class="vertical-text">ลากิจ</td>
            <td rowspan="2" class="vertical-text">กิจกรรม</td>
            <td rowspan="2" class="vertical-text">รวม</td>
            <td rowspan="2">%</td>

        </tr>
        <tr>
            <?php foreach ($GetSchedule as $key => $v_GetSchedule) : ?>
            <td width="32"><?=$this->datethai->thai_date_short(strtotime($v_GetSchedule->tcs_start_date))?></td>
            <?php endforeach; ?>            
        </tr>

    </tbody>
</table>