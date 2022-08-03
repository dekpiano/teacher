<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom"><?=$title;?></h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">


        <div class="col-lg-4">
            <div class="card">
                <div class="card-close">
                    <div class="dropdown">
                        <button type="button" id="closeCard1" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard1" class="dropdown-menu dropdown-menu-right has-shadow"><a
                                href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#"
                                class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                    </div>
                </div>
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">ฟอร์ม<?=$title;?>ระบบ</h3>
                </div>
                <div class="card-body">

                    <form method="post" action="<?=base_url('ConTeacherCourse/setting_UpdatePlan')?>"
                        class="needs-validation" novalidate id="form_insert_settingplan">
                        <div class="form-group">
                            <div class="i-checks">
                                <input id="seplanset_status" name="seplanset_status" type="radio" value="on"
                                    class="radio-template"
                                    <?=$SetPlan[0]->seplanset_status == 'on' ? 'checked=""' : ''?>>
                                <label for="seplanset_status">ระบบเปิด</label>
                                <input id="seplanset_status" name="seplanset_status" type="radio" value="off"
                                    class="radio-template ml-3"
                                    <?=$SetPlan[0]->seplanset_status == 'off' ? 'checked=""' : ''?>>
                                <label for="seplanset_status">ระบบปิด</label>
                            </div>

                            <div class="invalid-feedback">กรุณาเลือก</div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">วันเริ่มต้น</label>
                            <input type="text" id="seplanset_startdate" name="seplanset_startdate" placeholder=""
                                class="form-control" required autocomplete="off"
                                value="<?=date('d-m-Y H:i:s',strtotime($SetPlan[0]->seplanset_startdate));?>">
                            <div class="invalid-feedback">กรุณาเลือกวันเริ่มต้น</div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">วันสิ้นสุด</label>
                            <input type="text" id="seplanset_enddate" name="seplanset_enddate" placeholder=""
                                class="form-control" required autocomplete="off"
                                value="<?=date('d-m-Y H:i:s',strtotime($SetPlan[0]->seplanset_enddate));?>">
                            <div class="invalid-feedback">กรุณาเลือกวันสิ้นสุด</div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">ปีการศึกษา</label>
                            <select id="seplanset_year" name="seplanset_year" class="form-control mb-3" required>
                                <option value="">เลือก...</option>
                                <?php 
                                    $d = date('Y')+543;  
                                    for($i = $d-2; $i <= $d+2; $i++):
                              ?>
                                <option <?=$SetPlan[0]->seplanset_year == $i ? 'selected' : ''?> value="<?=$i?>"><?=$i?>
                                </option>
                                <?php endfor; ?>
                            </select>
                            <div class="invalid-feedback">กรุณาเลือกประเภทการส่ง</div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">ภาคเรียน</label>
                            <select id="seplanset_term" name="seplanset_term" class="form-control mb-3" required>
                                <option value="">เลือก...</option>
                                <option <?=$SetPlan[0]->seplanset_term == '1' ? 'selected' : ''?> value="1">1</option>
                                <option <?=$SetPlan[0]->seplanset_term == '2' ? 'selected' : ''?> value="2">2</option>
                                <option <?=$SetPlan[0]->seplanset_term == '3' ? 'selected' : ''?> value="3">3</option>
                            </select>
                            <div class="invalid-feedback">กรุณาเลือกประเภทการส่ง</div>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="ตั้งค่า" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>