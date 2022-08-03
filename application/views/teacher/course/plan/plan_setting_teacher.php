<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom"><?=$title;?></h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">เพิ่มข้อมูลทีละรายการ</h3>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate id="form_insert_plan">
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="seplan_coursecode">รหัสวิชา</label>
                                        <input type="text" class="form-control" placeholder="รหัสวิชา"
                                            id="seplan_coursecode" name="seplan_coursecode" required>
                                        <div class="invalid-feedback">กรุณากรอกรหัสวิชา</div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="seplan_namesubject">ชื่อวิชา</label>
                                        <input type="text" class="form-control" placeholder="ชื่อวิชา"
                                            id="seplan_namesubject" name="seplan_namesubject" required>
                                        <div class="invalid-feedback">กรุณากรอกชื่อวิชา</div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="seplan_gradelevel">ระดับชั้น</label>
                                        <select class="form-control" id="seplan_gradelevel" name="seplan_gradelevel"
                                            required>
                                            <option value="">เลือกระดับชั้น</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                        </select>
                                        <div class="invalid-feedback">กรุณาเลือกระดับชั้น</div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="seplan_typesubject">ประเภท</label>
                                        <select class="form-control" id="seplan_typesubject" name="seplan_typesubject"
                                            required>
                                            <option value="">เลือกประเภท</option>
                                            <option value="พื้นฐาน">พื้นฐาน</option>
                                            <option value="เพิ่มเติม">เพิ่มเติม</option>
                                        </select>
                                        <div class="invalid-feedback">กรุณาเลือประเภท</div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="seplan_usersend">ครูผู้สอน</label>
                                        <select class="form-control" id="seplan_usersend" name="seplan_usersend"
                                            required>
                                            <option value="">เลือกครูผู้สอน</option>
                                            <?php foreach ($pers as $key => $v_pers): ?>
                                            <option value="<?=$v_pers->pers_id;?>">
                                                <?=$v_pers->pers_prefix.$v_pers->pers_firstname.' '.$v_pers->pers_lastname;?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">กรุณาครูผู้สอน</div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">บันทึก</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">อัพโหลดข้อมูลทีเดียวทั้งหมด</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <form action="" method="post">
                                <div class="custom-file">
                                    <input type="file" class="" id="customFileInput" aria-describedby="customFileInput">
                                </div>
                                <div class="">
                                    <button class="btn btn-primary" type="submit" id="customFileInput">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">

            <div class="card-header d-flex align-items-center">
                <h3 class="h4">รายการวิชาที่สอน</h3>
            </div>
            <div class="card-body">
                <table class="table table-hover" id="TableShoowPlan">
                    <thead>
                        <tr>
                            <th>ปีการศึกษา</th>
                            <th>รหัสวิชา</th>
                            <th>ชื่อวิชา</th>
                            <th>ระดับชั้น</th>
                            <th>ประเภท</th>
                            <th>ครูผู้สอน</th>
                            <th>คำสั่ง</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Plan as $key => $v_Plan): ?>
                        <tr id="<?=$v_Plan->seplan_coursecode?>">
                            <td><?=$v_Plan->seplan_year?>/<?=$v_Plan->seplan_term?></td>
                            <td><?=$v_Plan->seplan_coursecode?></td>
                            <td><?=$v_Plan->seplan_namesubject?></td>
                            <td>ม.<?=$v_Plan->seplan_gradelevel?></td>
                            <td><?=$v_Plan->seplan_typesubject?></td>
                            <td><?=$v_Plan->pers_prefix?><?=$v_Plan->pers_firstname?> <?=$v_Plan->pers_lastname?>
                            </td>
                            <td width="10%"><a class="EditTeach" PlanCode="<?=$v_Plan->seplan_coursecode?>" href="#"
                                    data-toggle="modal" data-target="#editteacher">แก้ไข</a> | 
                                    <a href="javascript:void(0)" class="DeleteTeach" delplancode="<?=$v_Plan->seplan_coursecode?>" delplanyear="<?=$v_Plan->seplan_year?>" delplanterm="<?=$v_Plan->seplan_term?>"
                                    delplanname="<?=$v_Plan->seplan_namesubject?>">ลบ</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>


    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="editteacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขข้อมูล</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate id="FromUpdateTeacher">
                    <div class="row">
                    <div class="col-sm-6">
                            <div class="form-group">
                                <label for="up_seplan_year">ปีการศึกษา</label>
                                <input readonly type="text" class="form-control" placeholder="รหัสวิชา"
                                    id="up_seplan_year" name="up_seplan_year" required>
                                <div class="invalid-feedback">กรุณากรอปีการศึกษา</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="up_seplan_term">ภาคเรียน</label>
                                <input readonly type="text" class="form-control" placeholder="รหัสวิชา"
                                    id="up_seplan_term" name="up_seplan_term" required>
                                <div class="invalid-feedback">กรุณากรอภาคเรียน</div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="up_seplan_coursecode">รหัสวิชา</label>
                                <input readonly type="text" class="form-control" placeholder="รหัสวิชา"
                                    id="up_seplan_coursecode" name="up_seplan_coursecode" required>
                                <div class="invalid-feedback">กรุณากรอกรหัสวิชา</div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="up_seplan_namesubject">ชื่อวิชา</label>
                                <input type="text" class="form-control" placeholder="ชื่อวิชา"
                                    id="up_seplan_namesubject" name="up_seplan_namesubject" required>
                                <div class="invalid-feedback">กรุณากรอกชื่อวิชา</div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="up_seplan_gradelevel">ระดับชั้น</label>
                                <select class="form-control" id="up_seplan_gradelevel" name="up_seplan_gradelevel"
                                    required>
                                    <option value="">เลือกระดับชั้น</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                                <div class="invalid-feedback">กรุณาเลือกระดับชั้น</div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="seplan_typesubject">ประเภท</label>
                                <select class="form-control" id="up_seplan_typesubject" name="up_seplan_typesubject"
                                    required>
                                    <option value="">เลือกประเภท</option>
                                    <option value="พื้นฐาน">พื้นฐาน</option>
                                    <option value="เพิ่มเติม">เพิ่มเติม</option>
                                </select>
                                <div class="invalid-feedback">กรุณาเลือประเภท</div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="up_seplan_usersend">ครูผู้สอน</label>
                                <select class="form-control" id="up_seplan_usersend" name="up_seplan_usersend" required>
                                    <option value="">เลือกครูผู้สอน</option>
                                    <?php foreach ($pers as $key => $v_pers): ?>
                                    <option value="<?=$v_pers->pers_id;?>">
                                        <?=$v_pers->pers_prefix.$v_pers->pers_firstname.' '.$v_pers->pers_lastname;?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">กรุณาครูผู้สอน</div>
                            </div>
                        </div>

                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">แก้ไข</button>
            </div>
            </form>
        </div>
    </div>
</div>