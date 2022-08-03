<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">แผนการสอน ปีการศึกษ 2564</h2>
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

                            <!-- <div class="form-group">
                                <label class="form-control-label">ประเภทการส่ง</label>
                                <select id="seplan_typeplan" name="seplan_typeplan" class="form-control mb-3" required>
                                    <option value="">เลือก...</option>
                                    <option value="แบบตรวจแผนการจัดการเรียนรู้">แบบตรวจแผนการจัดการเรียนรู้</option>
                                    <option value="บันทึกตรวจใช้แผน">บันทึกตรวจใช้แผน</option>
                                    <option value="โครงการสอน">โครงการสอน</option>
                                    <option value="แผนการสอนหน้าเดียว">แผนการสอนหน้าเดียว</option>
                                    <option value="แผนการสอนเต็ม">แผนการสอนเต็ม</option>
                                    <option value="บันทึกหลังสอน">บันทึกหลังสอน</option>
                                </select>
                                <div class="invalid-feedback">กรุณาเลือกประเภทการส่ง</div>
                            </div> -->
                            <!-- <div class="form-group">
                                <label class="form-control-label">ไฟล์งาน</label>
                                <input type="file" id="seplan_file" name="seplan_file" placeholder="Password"
                                    class="form-control" required>
                                <div class="invalid-feedback">กรุณาเลือกไฟล์</div>
                            </div> -->
                            <div class="form-group">
                                <label for="seplan_sendcomment">หมายเหตุ:</label>
                                <textarea class="form-control" rows="5" name="seplan_sendcomment"
                                    id="seplan_sendcomment"
                                    placeholder="เช่น ส่งแผนครบแล้ว หรือ ส่งแผนที่ 1 - 4 แล้ว"></textarea>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">ประเภทไฟล์งาน</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-control-label">แบบตรวจแผนการจัดการเรียนรู้</label>
                                <input type="file" id="seplan_file_CLMP1" name="seplan_file_CLMP1"
                                    placeholder="แบบตรวจแผนการจัดการเรียนรู้" class="form-control">
                                <div class="invalid-feedback">กรุณาเลือกไฟล์</div>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">บันทึกตรวจใช้แผน</label>
                                <input type="file" id="seplan_file_PAR2" name="seplan_file_PAR2"
                                    placeholder="บันทึกตรวจใช้แผน" class="form-control">
                                <div class="invalid-feedback">กรุณาเลือกไฟล์</div>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">โครงการสอน</label>
                                <input type="file" id="seplan_file_TP3" name="seplan_file_TP3" placeholder="โครงการสอน"
                                    class="form-control">
                                <div class="invalid-feedback">กรุณาเลือกไฟล์</div>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">แผนการสอนหน้าเดียว</label>
                                <input type="file" id="seplan_file_OPLP4" name="seplan_file_OPLP4"
                                    placeholder="แผนการสอนหน้าเดียว" class="form-control">
                                <div class="invalid-feedback">กรุณาเลือกไฟล์</div>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">แผนการสอนเต็ม</label>
                                <input type="file" id="seplan_file_FLP5" name="seplan_file_FLP5"
                                    placeholder="แผนการสอนเต็ม" class="form-control">
                                <div class="invalid-feedback">กรุณาเลือกไฟล์</div>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">บันทึกหลังสอน</label>
                                <input type="file" id="seplan_file_NAT6" name="seplan_file_NAT6"
                                    placeholder="บันทึกหลังสอน" class="form-control">
                                <div class="invalid-feedback">กรุณาเลือกไฟล์</div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mb-4">                  
                        <?php if($OnOff[0]->seplanset_status == "on"):?>

                        <input type="submit" value="ส่งงาน" class="btn btn-primary btn-block">

                        <?php else: ?>

                        <button type="button" class="btn btn-primary btn-block" disabled>หมดเวลาส่ง</button>

                        <?php endif; ?>
                </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header">คำแนะนำ</div>
        <div class="card-body">
            <h4 class="card-title">การส่งไฟล์งาน</h4>
            <p class="card-text">แนะนำให้คุณครู รวมไฟล์งานเป็นไฟล์เดียว ตามประเภทที่จะส่ง อย่างเช่น
                แผนการสอนหน้าเดียว ถึงคุณครูจะทำไฟล์งานแยกกันเป็นไฟล์ ก็ให้ก๊อปมาวางเป็นไฟล์เดียวกัน
                เพื่อให้ผู้ตรวจไฟล์งานจะได้ตรวจง่าย ไม่ต้องเปิดไปเปิดมา</p>
            <h4 class="card-title">ช่องหมายเหตุ</h4>
            <p class="card-text">จะเป็นการดีมากถ้าคุณครูบอกรายละเอียดเบื้องต้นเกี่ยวไฟล์ที่ส่ง เช่น
                ส่งครบตามกำหนดแล้ว หรือ ส่งแผนที่ 5 ถึงที่ 8 แล้ว เป็นต้น</p>
            <h4 class="card-title">กรณีเปลี่ยนไฟล์ใหม่หรืออัพเดทไฟล์ใหม่</h4>
            <p class="card-text">ให้คุณครูกลับไปที่หน้าแผนการสอน
                แล้วคลิกเมนูแก้ไขเพื่อแก้ไขหรือเปลี่ยนไฟล์ที่แก้ใหม่</p>
        </div>
    </div>
    </div>
</section>