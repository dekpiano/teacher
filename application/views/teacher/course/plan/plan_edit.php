<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">แผนการสอน ปีการศึกษ 2564</h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-6 ">
            
                <div class="card ld-over">
                <div class="ld ld-ring ld-spin"></div>
                    
                    <div class="card-header d-flex align-items-center">
   <h3 class="h4">ฟอร์มแก้ไขการส่งงาน</h3>
                    </div>
                    <div class="card-body">

                        <form class="needs-validation" novalidate id="form_update_plan">
                            <input type="text" id="seplan_ID" name="seplan_ID" placeholder=""
                                class="d-none form-control" required value="<?=$plan[0]->seplan_ID?>">
                            <div class="form-group">
                                <label class="form-control-label">ชื่อวิชา</label>
                                <input type="text" id="seplan_namesubject" name="seplan_namesubject" placeholder=""
                                    class="form-control" required value="<?=$plan[0]->seplan_namesubject?>">
                                <div class="invalid-feedback">กรุณากรอกชื่อวิชา</div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">รหัสวิชา</label>
                                <input type="text" id="seplan_coursecode" name="seplan_coursecode" placeholder=""
                                    class="form-control" required value="<?=$plan[0]->seplan_coursecode?>">
                                <div class="invalid-feedback">กรุณากรอกรหัสวิชา</div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">ประเภทวิชา</label>
                                <div class="i-checks">
                                    <input id="seplan_typesubject" name="seplan_typesubject" type="radio"
                                        value="พื้นฐาน" class="radio-template"
                                        <?=$plan[0]->seplan_typesubject == 'พื้นฐาน' ? 'checked=""' : ''?>>
                                    <label for="seplan_typesubject">พื้นฐาน</label>
                                    <input id="seplan_typesubject" name="seplan_typesubject" type="radio"
                                        value="เพิ่มเติม" class="radio-template ml-3"
                                        <?=$plan[0]->seplan_typesubject == 'เพิ่มเติม' ? 'checked=""' : ''?>>
                                    <label for="seplan_typesubject">เพิ่มเติม</label>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">ระดับชั้น</label>
                                    <select id="seplan_gradelevel" name="seplan_gradelevel" class="form-control mb-3"
                                        required>
                                        <option value="">เลือก...</option>
                                        <?php $type = array('1','2','3','4','5','6' );
                                        foreach ($type as $key => $v_type) :
                                        ?>
                                        <option <?=$v_type==$plan[0]->seplan_gradelevel ? 'selected' : ''?>
                                            value="<?=$v_type;?>">ม.<?=$v_type;?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">กรุณาเลือกระดับชั้น</div>
                                </div>
                                <div class="invalid-feedback">กรุณาเลือก</div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">ประเภทการส่ง</label>
                                <select id="seplan_typeplan" name="seplan_typeplan" class="form-control mb-3" required>
                                    <option value="">เลือก...</option>
                                    <?php $type = array('แบบตรวจแผนการจัดการเรียนรู้','บันทึกตรวจใช้แผน','โครงการสอน','แผนการสอนหน้าเดียว','แผนการสอนเต็ม','บันทึกหลังสอน' );
                              foreach ($type as $key => $v_type) :
                              ?>
                                    <option <?=$v_type==$plan[0]->seplan_typeplan ? 'selected' : ''?>
                                        value="<?=$v_type?>">
                                        <?=$v_type?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">กรุณาเลือกประเภทการส่ง</div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">ไฟล์งาน</label>
                                <input type="file" id="seplan_file" name="seplan_file" placeholder="Password"
                                    class="form-control">
                                <div class="invalid-feedback">กรุณาเลือกไฟล์</div>
                            </div>
                            <div class="form-group">
                                <label for="seplan_sendcomment">หมายเหตุ:</label>
                                <textarea wrap="hard" class="form-control" rows="5" name="seplan_sendcomment"
                                    id="seplan_sendcomment"
                                    placeholder="เช่น ส่งแผนครบแล้ว หรือ ส่งแผนที่ 1 - 4 แล้ว"><?=str_replace('<br>',"",$plan[0]->seplan_sendcomment);?></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit"  class="btn btn-primary" >ส่งงาน</button>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">คำแนะนำ</div>
                    <div class="card-body">                      
                        
                        <h4 class="card-title">การแก้ไขข้อมูล</h4>
                        <p class="card-text">ในหน้านี้ คุณครูสามารถแก้ไขข้อมูลได้ หรือจะเปลี่ยนไฟล์ได้ กรณีที่ไม่เปลี่ยนไฟล์สามารถคลิกที่ปุ่มส่งงานได้เลย</p>
                            <h4 class="card-title">ช่องหมายเหตุ</h4>
                        <p class="card-text">จะเป็นการดีมากถ้าคุณครูบอกรายละเอียดเบื้องต้นเกี่ยวไฟล์ที่ส่ง เช่น
                            ส่งครบตามกำหนดแล้ว หรือ ส่งแผนที่ 5 ถึงที่ 8 แล้ว เป็นต้น</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>