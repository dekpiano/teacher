<!-- Page Header-->
<style>
.services .card1 {
    padding: 10px;
    border: none;
    cursor: pointer;
    border: groove;
}

.services .card1:hover {
    background-color: #fff;
}

.services .card1 span {
    font-size: 14px;
}

.g-1 {
    padding: 10px 15px;
    margin: 0;
}
</style>
<header class="page-header">
    <div class="container-fluid d-flex justify-content-between">
        <h2 class="no-margin-bottom"><?=$title?> </h2>
        <h2><u>สถานะ : <?=$onoff[0]->onoff_detail?></u> ปีการศึกษา <?=$onoff[0]->onoff_year?></h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">

        <div class="col-lg-12">
            <?php if($onoff[0]->onoff_status == 'off'): ?>
            <div class="alert alert-danger" role="alert">
                ทางวิชาการขอ ปรับปรุง หรือ อัพเดตข้อมูลสักครู่... กรุณารอ ^/\^ !
            </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-close">
                    <div class="dropdown">
                        <button type="button" id="closeCard3" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard3" class="dropdown-menu dropdown-menu-right has-shadow"><a
                                href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#"
                                class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                    </div>
                </div>
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">รายวิชาที่สอน</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <!-- <th>ปีการศึกษา</th> -->
                                    <!-- <th>ชั้นที่สอน</th> -->
                                    <th>วิชา</th>
                                    <th>หน่วยกิจ</th>
                                    <th>ชั่วโมง</th>
                                    <th>บันทึกผลการเรียน</th>
                                    <th>รายงาน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($check_subject as $key => $v_check_subject) : ?>
                                <tr>
                                    <!-- <th><?=$v_check_subject->RegisterYear?></th> -->
                                    <!-- <td><?=$v_check_subject->RegisterClass?></td> -->
                                    <td><?=$v_check_subject->SubjectCode?> <?=$v_check_subject->SubjectName?></td>
                                    <td><?=$v_check_subject->SubjectUnit?></td>
                                    <td><?=$v_check_subject->SubjectHour?></td>
                                    <td>
                                        <?php if($onoff[0]->onoff_status == 'off'): ?>
                                        <a href="#" data-toggle="modal" data-target="#AlertNoReg"
                                            class="btn btn-danger btn-sm"><i class="fa fa-pencil"
                                                aria-hidden="true"></i> ยังไม่เปิดให้บันทึก</a>
                                        <?php else: ?>
                                        <a href="<?=base_url('Register/LearnRepeatAdd/'.$v_check_subject->RegisterYear.'/'.$v_check_subject->SubjectCode.'/all')?>"
                                            class="btn btn-primary btn-sm clickLoad"><i class="fa fa-pencil"
                                                aria-hidden="true"></i> บันทึกผลการเรียน</a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <form action="<?=base_url('Register/ReportLearnRepeat');?>" method="post"
                                            target="_blank">
                                            <input type="text" name="report_RegisterYear" id="report_RegisterYear"
                                                style="display:none" value="<?=$v_check_subject->RegisterYear;?>">
                                            <input type="text" name="report_SubjectCode" id="report_SubjectCode"
                                                style="display:none" value="<?=$v_check_subject->SubjectCode;?>">

                                            <input type="text" name="select_print" id="select_print"
                                                style="display:none" value="all">


                                            <button type="submit" class="btn btn-warning"><i class="fa fa-print"
                                                    aria-hidden="true"></i> พิมพ์รายงาน</button>

                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="AlertNoReg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">บันทึกผลการเรียน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                ขณะนี้! ระบบยังไม่เปิดให้ลงผลการเรียน รอสักครู่... <br>
                ทางฝ่ายวิชาการจะแจ้งให้ทราบอีกครั้ง
            </div>

        </div>
    </div>
</div>