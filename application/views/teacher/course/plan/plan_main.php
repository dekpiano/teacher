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
        <?php
        // --- Dashboard Data Calculation ---
        $typeplan_map_for_dashboard = [
            'บันทึกตรวจใช้แผน' => 'บันทึกตรวจใช้แผน',
            'แบบตรวจแผนการจัดการเรียนรู้' => 'แบบตรวจแผนฯ',
            'โครงการสอน' => 'โครงการสอน',
            'แผนการสอนหน้าเดียว' => 'แผนการสอน',
            'บันทึกหลังสอน' => 'บันทึกหลังสอน'
        ];

        $total_plans = count($planNew) * count($typeplan_map_for_dashboard);
        $submitted_count = 0;
        $dept_head_approved_count = 0;
        $curriculum_head_approved_count = 0;
        $revision_count = 0;
        $plan_type_submitted_count = array_fill_keys(array_keys($typeplan_map_for_dashboard), 0);

        foreach ($plan as $p) {
            if (!empty($p->seplan_file)) {
                $submitted_count++;
                if (isset($plan_type_submitted_count[$p->seplan_typeplan])) {
                    $plan_type_submitted_count[$p->seplan_typeplan]++;
                }
            }
            if (trim($p->seplan_status1) == 'ผ่าน') {
                $dept_head_approved_count++;
            }
            if (trim($p->seplan_status2) == 'ผ่าน') {
                $curriculum_head_approved_count++;
            }
            if (trim($p->seplan_status1) == 'ไม่ผ่าน' || trim($p->seplan_status2) == 'ไม่ผ่าน') {
                $revision_count++;
            }
        }

        $deadline = $OnOff[0]->seplanset_enddate;
        $is_system_on = ($OnOff[0]->seplanset_startdate < date('Y-m-d H:i:s') && $OnOff[0]->seplanset_enddate > date('Y-m-d H:i:s') && $OnOff[0]->seplanset_status == "on");
        ?>

        <!-- Dashboard Section -->
       
            <div class="">
                <div class="row">
                    <!-- Widget 1: Countdown -->
                    <div class="col-lg-5 mb-4">
                        <div class="card <?php echo $is_system_on ? 'bg-success' : 'bg-danger'; ?> h-100">
                            <div class="card-header">
                                <h5 class="">กำหนดส่งแผนการสอน</h5>
                            </div>
                            <div class="card-body text-center d-flex flex-column justify-content-center">
                                <?php if ($is_system_on): ?>
                                    <div class="text-white" id="countdown-timer" data-deadline="<?= $deadline ?>" style="font-size: 2.2rem; font-weight: bold; line-height: 1.2;"></div>
                                <?php else: ?>
                                    <div class="h3">ระบบปิดรับการส่งแผนแล้ว</div>
                                <?php endif; ?>
                                <div class="small mt-2 text-white">สิ้นสุด: <?= $this->datethai->thai_date_and_time(strtotime($deadline)); ?></div>
                            </div>
                        </div>
                    </div>
                    <!-- Widget 2: Overall Summary -->
                    <div class="col-lg-7 mb-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="mb-0">สรุปภาพรวม (ปีการศึกษา <?= $this->uri->segment(4); ?>/<?= $this->uri->segment(3); ?>)</h5>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col">
                                        <div class="h2 font-weight-bold"><?= $total_plans ?></div>
                                        <div class="text-muted small">ทั้งหมด</div>
                                    </div>
                                    <div class="col">
                                        <div class="h2 font-weight-bold text-info"><?= $submitted_count ?></div>
                                        <div class="text-muted small">ส่งแล้ว</div>
                                    </div>
                                    <div class="col">
                                        <div class="h2 font-weight-bold text-success"><?= $dept_head_approved_count ?></div>
                                        <div class="text-muted small">หน.สาระฯ ผ่าน</div>
                                    </div>
                                    <div class="col">
                                        <div class="h2 font-weight-bold text-primary"><?= $curriculum_head_approved_count ?></div>
                                        <div class="text-muted small">หน.หลักสูตรฯ ผ่าน</div>
                                    </div>
                                    <div class="col">
                                        <div class="h2 font-weight-bold text-danger"><?= $revision_count ?></div>
                                        <div class="text-muted small">รอแก้ไข</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Widget 3: Status by Plan Type -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">สถานะตามประเภทของแผน</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php foreach($typeplan_map_for_dashboard as $db_val => $display_val): ?>
                                <div class="col-lg col-md-4 col-sm-6 mb-3">
                                    <strong><?= $display_val ?></strong>
                                    <div class="progress" style="height: 20px;">
                                        <?php
                                            $total_subjects_for_type = count($planNew);
                                            $submitted_for_type = $plan_type_submitted_count[$db_val] ?? 0;
                                            $percentage = $total_subjects_for_type > 0 ? ($submitted_for_type / $total_subjects_for_type) * 100 : 0;
                                        ?>
                                        <div class="progress-bar font-weight-bold" role="progressbar" style="width: <?= $percentage ?>%;" aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100">
                                            <?= $submitted_for_type ?>/<?= $total_subjects_for_type ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
       
        <hr>

        <?php $Y = $this->uri->segment(3).'/'.$this->uri->segment(4); ?>
        <div class="row justify-content-center">
            <div class="d-flex mb-3">
                <div class=" align-self-center" style="width: 150px;">เลือกปีการศึกษา</div>
                <select class="form-control w-auto" id="CheckYearSendPlan">
                    <?php 
                    foreach ($CheckYearPlan as $key => $v_SelYear) : ?>
                    <option <?php echo ($Y == $v_SelYear->seplan_year.'/'.$v_SelYear->seplan_term ?"selected":"") ?> value="<?=$v_SelYear->seplan_year.'/'.$v_SelYear->seplan_term?>"><?=$v_SelYear->seplan_term.'/'.$v_SelYear->seplan_year?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>


        <?php
        // Prepare plan data for efficient lookup
        $planData = [];
        foreach ($plan as $p) {
            $key = $p->seplan_coursecode . '|' . $p->seplan_typeplan . '|' . $p->seplan_year . '|' . $p->seplan_term;
            $planData[$key] = $p;
        }

        $typeplan_map = [
            'บันทึกตรวจใช้แผน' => 'บันทึกตรวจใช้แผน',
            'แบบตรวจแผนการจัดการเรียนรู้' => 'แบบตรวจแผนการจัดการเรียนรู้',
            'โครงการสอน' => 'โครงการสอน',
            'แผนการสอนหน้าเดียว' => 'แผนการสอน',
            'บันทึกหลังสอน' => 'บันทึกหลังสอน'
        ];
        ?>

        <div class="row">
            <?php foreach ($planNew as $v_planNew) : ?>
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">
                                <strong><?= $v_planNew->seplan_coursecode ?></strong> <?= $v_planNew->seplan_namesubject ?>
                            </h5>
                            <small><?= 'ระดับชั้น ม.' . $v_planNew->seplan_gradelevel . ' | ประเภท: ' . $v_planNew->seplan_typesubject ?></small>
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($typeplan_map as $db_val => $display_val) : ?>
                                <?php
                                $lookupKey = $v_planNew->seplan_coursecode . '|' . $db_val . '|' . $v_planNew->seplan_year . '|' . $v_planNew->seplan_term;
                                $v_plan = $planData[$lookupKey] ?? null;
                                ?>
                                <li class="list-group-item">
                                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                                        <div class="flex-grow-1 mb-2 mb-md-0">
                                            <strong><?= $display_val ?></strong>
                                            <?php if ($v_plan) : ?>
                                                <div class="small text-muted mt-1">
                                                    <span class="mr-3"><i class="fa fa-user"></i> ผู้ส่ง: <?= htmlspecialchars($v_plan->seplan_sendcomment ?: '-') ?></span>
                                                    <span class="mr-3">หน.กลุ่มสาระฯ:
                                                        <?php
                                                        if (empty($v_plan->seplan_status1)) {
                                                            echo 'รอตรวจ';
                                                        } elseif ($v_plan->seplan_status1 == 'ผ่าน') {
                                                            echo '<span class="text-success font-weight-bold">ผ่าน</span>';
                                                        } else {
                                                            echo '<span class="text-danger font-weight-bold">ไม่ผ่าน</span> (' . htmlspecialchars($v_plan->seplan_comment1) . ')';
                                                        }
                                                        ?>
                                                    </span>
                                                    <span>หน.งานหลักสูตรฯ:
                                                        <?php
                                                        if (empty($v_plan->seplan_status2)) {
                                                            echo 'รอตรวจ';
                                                        } elseif ($v_plan->seplan_status2 == 'ผ่าน') {
                                                            echo '<span class="text-success font-weight-bold">ผ่าน</span>';
                                                        } else {
                                                            echo '<span class="text-danger font-weight-bold">ไม่ผ่าน</span> (' . htmlspecialchars($v_plan->seplan_comment2) . ')';
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="text-md-right" style="min-width: 130px;">
                                            <?php if ($v_plan && $v_plan->seplan_file) : ?>
                                                <span class="badge badge-success p-2 mr-1">ส่งแล้ว</span>
                                                <?php
                                                $file_ext = strtolower(pathinfo($v_plan->seplan_file, PATHINFO_EXTENSION));
                                                $file_icon = 'fa-file-o';
                                                $btn_class = 'btn-outline-secondary';
                                                if ($file_ext == 'pdf') {
                                                    $file_icon = 'fa-file-pdf-o';
                                                    $btn_class = 'btn-outline-danger';
                                                } elseif ($file_ext == 'doc' || $file_ext == 'docx') {
                                                    $file_icon = 'fa-file-word-o';
                                                    $btn_class = 'btn-outline-primary';
                                                }
                                                ?>
                                                <a href="<?= base_url('uploads/academic/course/plan/' . $OnOff[0]->seplanset_year . '/' . $OnOff[0]->seplanset_term . '/' . $v_plan->seplan_namesubject . '/' . $v_plan->seplan_file) ?>" target="_blank" class="btn btn-sm <?= $btn_class ?> mr-1" data-toggle="tooltip" data-placement="top" title="เปิดดูไฟล์: <?= htmlspecialchars($v_plan->seplan_file) ?>"><i class="fa <?= $file_icon ?>"></i></a>
                                            <?php else : ?>
                                                <span class="badge badge-danger p-2 mr-1">ยังไม่ส่ง</span>
                                            <?php endif; ?>

                                            <button class="btn btn-sm btn-warning Model_update" data-toggle="modal" data-target="#ModalUpdatePlan"
                                                data-seplan-id="<?= $v_plan ? $v_plan->seplan_ID : '' ?>"
                                                data-seplan-coursecode="<?= $v_planNew->seplan_coursecode ?>"
                                                data-seplan-typeplan="<?= $db_val ?>"
                                                data-seplan-sendcomment="<?= $v_plan ? htmlspecialchars($v_plan->seplan_sendcomment) : '' ?>"
                                                data-toggle="tooltip" data-placement="top" title="เพิ่มหรือแก้ไขไฟล์">
                                                <i class="fa fa-upload"></i>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
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

                        <input id="seplan_file" name="seplan_file" type="file" class="" accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf,application/pdf">
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

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Countdown Timer
    var countdownElement = document.getElementById('countdown-timer');
    if (countdownElement) {
        var deadline = new Date(countdownElement.getAttribute('data-deadline').replace(/-/g, '/')).getTime();

        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = deadline - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if (distance < 0) {
                clearInterval(x);
                countdownElement.innerHTML = "หมดเวลาส่งแล้ว";
            } else {
                countdownElement.innerHTML = days + "วัน " + hours + "ชั่วโมง " + minutes + "นาที " + seconds + "วิ";
            }
        }, 1000);
    }
});
</script>