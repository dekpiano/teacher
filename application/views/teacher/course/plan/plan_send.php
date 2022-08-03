<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">ลงทะเบียนวิชาการสอน</h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="no-padding-bottom">
    <div class="container-fluid">
        <form class="needs-validation" novalidate id="form_insert_plan">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-close">
                            <div class="dropdown">
                                <button type="button" id="closeCard1" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" class="dropdown-toggle"><i
                                        class="fa fa-ellipsis-v"></i></button>
                                <div aria-labelledby="closeCard1" class="dropdown-menu dropdown-menu-right has-shadow">
                                    <a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a
                                        href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">ข้อมูลเบื้องต้น</h3>
                        </div>
                        <div class="card-body">


                            <div class="form-group">
                                <label class="form-control-label">ชื่อวิชา</label>
                                <input type="text" id="seplan_namesubject" name="seplan_namesubject" placeholder=""
                                    class="form-control" required>
                                <div class="invalid-feedback">กรุณากรอกชื่อวิชา</div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">รหัสวิชา</label>
                                <input type="text" id="seplan_coursecode" name="seplan_coursecode" placeholder=""
                                    class="form-control" required>
                                <div class="invalid-feedback">กรุณากรอกรหัสวิชา</div>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">ประเภทวิชา</label>
                                <div class="i-checks">
                                    <input id="seplan_typesubject" name="seplan_typesubject" type="radio"
                                        value="พื้นฐาน" class="radio-template" required>
                                    <label for="seplan_typesubject">พื้นฐาน</label>
                                    <input id="seplan_typesubject1" name="seplan_typesubject" type="radio"
                                        value="เพิ่มเติม" class="radio-template ml-3" required>
                                    <label for="seplan_typesubject1">เพิ่มเติม</label>
                                    <div class="invalid-feedback">กรุณาเลือก</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">ระดับชั้น</label>
                                <select id="seplan_gradelevel" name="seplan_gradelevel" class="form-control mb-3"
                                    required>
                                    <option value="">เลือก...</option>
                                    <option value="1">ม.1</option>
                                    <option value="2">ม.2</option>
                                    <option value="3">ม.3</option>
                                    <option value="4">ม.4</option>
                                    <option value="5">ม.5</option>
                                    <option value="6">ม.6</option>
                                </select>
                                <div class="invalid-feedback">กรุณาเลือกระดับชั้น</div>
                            </div>
                        
                        </div>
                        <div class="col-12 text-center mb-4">
                    <?php if($OnOff[0]->seplanset_status == "on"):?>

                    <input type="submit" value="ลงทะเบียน" class="btn btn-primary btn-block">

                    <?php else: ?>

                    <button type="button" class="btn btn-primary btn-block" disabled>หมดเวลาส่ง</button>

                    <?php endif; ?>
                </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">คำแนะนำ</div>
                        <div class="card-body">
                            <h4 class="card-title">การลงทะเบียนวิชาก่อนเพิ่มงาน</h4>
                            <p class="card-text">
                                ให้คุณครูเพิ่มข้อมูลแต่ละวิชาให้เรียบร้อย และกดปุ่มลงทะเบียน  แล้วระบบจะพาไปยังหน้าเพิ่มไฟล์ต่าง ๆ ที่กำหนดไว้
                            </p>
                            <h4 class="card-title">ระบบอัพเดทเป็นเวอร์ชั่นที่ 2</h4>
                            <p class="card-text">
                                ระบบพัฒนาให้สามารถใช้งานในการเพิ่มไฟล์สะดวกขึ้น และดูการส่งงานได้ง่ายขึ้น
                            </p>                          
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header text-white bg-danger">คำเตือน</div>
                        <div class="card-body">
                            <h4 class="card-title">เมื่อการลงทะเบียนแล้วนั้น ไม่สามารถแก้ข้อมูลได้อีก กรุณาตรวจสอบข้อมูลให้ถูกต้อง</h4>
                        </div>
                    </div>
                </div>
               
        </form>
    </div>


    </div>
</section>