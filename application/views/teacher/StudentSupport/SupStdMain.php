<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom"><?=$title;?></h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">

        <?php  if(isset($CClass[0]->Reg_Class)):
    $IfLen = strlen($CClass[0]->Reg_Class); 
    $CheckOnOffSystem = "YES"; //ตัวแปรเพิ่มปิดระบบ
    ?>
        <div class="statistic align-items-center bg-white has-shadow">
            <div class="text">
                <strong>คุณใช้งานในสถานะ :
                    <?=$IfLen != 1 ? 'ครูที่ปรึกษา '.$this->session->userdata('class') : 'หัวหน้าระดับ ม.'.$CClass[0]->Reg_Class ?>
                    <div class="float-right">
                        <small><a target="_blank"
                                href="<?=base_url('uploads/affairs/helpstd/คู่มือ/คู่มือการใช้งานระบบส่งงานเยี่ยมบ้านSDQ.pdf')?>">คู่มือการใช้งาน</a>
                            | <a target="_blank"
                                href="https://drive.google.com/file/d/1H3Y4uPQ-2kV6T1CsoPn0wvPo3kABFULd/view?fbclid=IwAR2RsE-vTgd4ocwToAzgynJorRX2h2mCkXBZOgAuwB0xns2SK2MAj7wLX5k">โหลดไฟล์ต้นฉบับ</a></small>
                    </div>
                </strong>

            </div>


        </div>

        <div class="card">
            <div class="card-close">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalAddHelp">+
                    ส่งงาน</button>
            </div>
            <div class="card-header d-flex align-items-center">
                <h3 class="h4">ตารางส่งงานเยี่ยมบ้าน / SDQ</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ปีการศึกษา</th>
                                <th>ระดับชั้น</th>
                                <!-- <th>ใบปะหน้า</th>
                                <th>SDQ</th> -->
                                <th>แบบบันทึกรายงานเยี่ยมบ้าน</th>
                                <!-- <th>สรุปข้อมูล</th> -->
                                <th>หัวหน้าระดับ</th>
                                <th>หัวหน้างาน</th>
                            </tr>
                        </thead>
                        <!-- สำหรับหัวหน้าระดับ -->
                        <?php if($IfLen == 1):?>
                        <tbody>
                            <?php 
                                foreach ($AllAffairs as $key => $v_Aff) : 
                                    $c = explode('/',$v_Aff->s_homevisit_class);
                                    //echo $c[0];
                                    if($c[0] == $CClass[0]->Reg_Class):
                            ?>
                            <tr>
                                <th scope="row"><?=$v_Aff->s_homevisit_year?></th>
                                <td>ม.<?=$v_Aff->s_homevisit_class?></td>
                                <!-- <td>
                                    <form class="add_filecoversheet"
                                        id="add_filecoversheet<?=$v_Aff->s_homevisit_id;?>">
                                        <div class="CheckTruefilecoversheet<?=$v_Aff->s_homevisit_id;?>">
                                            <?php if($v_Aff->s_homevisit_filecoversheet != NULL): ?>
                                            <span class="badge badge-success h6 text-white">ส่งแล้ว</span>
                                            <a href="<?=base_url('uploads/affairs/helpstd/filecoversheet/'.$v_Aff->s_homevisit_filecoversheet)?>"
                                                target="_blank" rel="noopener noreferrer">
                                                <span class="badge badge-primary h6 text-white"><i class="fa fa-eye"
                                                        aria-hidden="true" data-toggle="popover" data-trigger="hover"
                                                        data-content="เปิดดู" data-placement="top"></i></span>
                                            </a>
                                            <?php else : ?>
                                            <span class="badge badge-danger h6 text-white">ยังไม่ส่ง</span>
                                            <?php endif; ?>
                                            <?php if($IfLen == 3):?>
                                            <input type="hidden" id="AffID" name="AffID"
                                                value="<?=$v_Aff->s_homevisit_id?>">
                                            <label class="badge badge-warning h6" style="cursor: pointer;"
                                                data-toggle="popover" data-trigger="hover"
                                                data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <input id="s_homevisit_filecoversheet" name="s_homevisit_filecoversheet"
                                                    type="file" class="d-none">
                                            </label>
                                            <?php endif; ?>
                                        </div>
                                    </form>

                                </td>
                                <td>
                                    <form class="add_homevisit_fileSDQ"
                                        id="add_homevisit_fileSDQ<?=$v_Aff->s_homevisit_id;?>">
                                        <div class="CheckTruehomevisit_fileSDQ<?=$v_Aff->s_homevisit_id;?>">
                                            <?php if($v_Aff->s_homevisit_fileSDQ != NULL): ?>
                                            <span class="badge badge-success h6 text-white">ส่งแล้ว</span>
                                            <a href="<?=base_url('uploads/affairs/helpstd/fileSDQ/'.$v_Aff->s_homevisit_fileSDQ)?>"
                                                target="_blank" rel="noopener noreferrer">
                                                <span class="badge badge-primary h6 text-white"><i class="fa fa-eye"
                                                        aria-hidden="true" data-toggle="popover" data-trigger="hover"
                                                        data-content="เปิดดู" data-placement="top"></i></span>
                                            </a>
                                            <?php else : ?>
                                            <span class="badge badge-danger h6 text-white">ยังไม่ส่ง</span>
                                            <?php endif; ?>
                                            <?php if($IfLen == 3):?>
                                            <input type="hidden" id="AffID" name="AffID"
                                                value="<?=$v_Aff->s_homevisit_id?>">
                                            <label class="badge badge-warning h6" style="cursor: pointer;"
                                                data-toggle="popover" data-trigger="hover"
                                                data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <input id="s_homevisit_fileSDQ" name="s_homevisit_fileSDQ" type="file"
                                                    class="d-none">
                                            </label>
                                            <?php endif; ?>
                                        </div>
                                    </form>
                                </td> -->
                                <td>

                                    <form class="add_homevisit_filerecordform"
                                        id="add_homevisit_filerecordform<?=$v_Aff->s_homevisit_id;?>">
                                        <div class="CheckTruehomevisit_filerecordform<?=$v_Aff->s_homevisit_id;?>">
                                            <?php if($v_Aff->s_homevisit_filerecordform != NULL): ?>
                                            <span class="badge badge-success h6 text-white">ส่งแล้ว</span>
                                            <a href="<?=base_url('uploads/affairs/helpstd/filerecordform/'.$v_Aff->s_homevisit_filerecordform)?>"
                                                target="_blank" rel="noopener noreferrer">
                                                <span class="badge badge-primary h6 text-white"><i class="fa fa-eye"
                                                        aria-hidden="true" data-toggle="popover" data-trigger="hover"
                                                        data-content="เปิดดู" data-placement="top"></i></span>
                                            </a>
                                            <?php else : ?>
                                            <span class="badge badge-danger h6 text-white">ยังไม่ส่ง</span>
                                            <?php endif; ?>
                                            <?php if($IfLen == 3):?>
                                            <input type="hidden" id="AffID" name="AffID"
                                                value="<?=$v_Aff->s_homevisit_id?>">
                                            <label class="badge badge-warning h6" style="cursor: pointer;"
                                                data-toggle="popover" data-trigger="hover"
                                                data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <input id="s_homevisit_filerecordform" name="s_homevisit_filerecordform"
                                                    type="file" class="d-none">
                                            </label>
                                            <?php endif; ?>
                                        </div>
                                    </form>
                                </td>
                                <!-- <td>
                                    <form class="add_homevisit_filesummary"
                                        id="add_homevisit_filesummary<?=$v_Aff->s_homevisit_id;?>">
                                        <div class="CheckTruehomevisit_filesummary<?=$v_Aff->s_homevisit_id;?>">
                                            <?php if($v_Aff->s_homevisit_filesummary != NULL): ?>
                                            <span class="badge badge-success h6 text-white">ส่งแล้ว</span>
                                            <a href="<?=base_url('uploads/affairs/helpstd/filesummary/'.$v_Aff->s_homevisit_filesummary)?>"
                                                target="_blank" rel="noopener noreferrer">
                                                <span class="badge badge-primary h6 text-white"><i class="fa fa-eye"
                                                        aria-hidden="true" data-toggle="popover" data-trigger="hover"
                                                        data-content="เปิดดู" data-placement="top"></i></span>
                                            </a>
                                            <?php else : ?>
                                            <span class="badge badge-danger h6 text-white">ยังไม่ส่ง</span>
                                            <?php endif; ?>
                                            <?php if($IfLen == 3):?>
                                            <input type="hidden" id="AffID" name="AffID"
                                                value="<?=$v_Aff->s_homevisit_id?>">
                                            <label class="badge badge-warning h6" style="cursor: pointer;"
                                                data-toggle="popover" data-trigger="hover"
                                                data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <input id="s_homevisit_filesummary" name="s_homevisit_filesummary"
                                                    type="file" class="d-none">
                                            </label>
                                            <?php endif; ?>
                                        </div>
                                    </form>
                                </td> -->
                                <td>
                                    <?php 
                                    if($IfLen == 1):
                                        $statuslevelhead = $v_Aff->s_homevisit_statuslevelhead;
                                      if($statuslevelhead == "รอตรวจ" || $statuslevelhead == "ไม่ผ่าน") {
                                            $valid = 'is-invalid';
                                      }elseif($statuslevelhead == "ผ่าน"){
                                        $valid = 'is-valid';
                                      }
                                    ?>
                                    <form class="ConfrimStatus" method="post">
                                        <input type="hidden" id="AffID" name="AffID"
                                            value="<?=$v_Aff->s_homevisit_id?>">
                                        <select name="s_homevisit_statuslevelhead"
                                            id="s_homevisit_statuslevelhead<?=$v_Aff->s_homevisit_id?>"
                                            class="form-control mb-3 <?=$valid?>">
                                            <option <?=$statuslevelhead == "รอตรวจ" ? "selected" : "" ?> value="รอตรวจ">
                                                รอตรวจ</option>
                                            <option <?=$statuslevelhead == "ผ่าน" ? "selected" : "" ?> value="ผ่าน">ผ่าน
                                            </option>
                                            <option <?=$statuslevelhead == "ไม่ผ่าน" ? "selected" : "" ?>
                                                value="ไม่ผ่าน">ไม่ผ่าน</option>
                                        </select>
                                    </form>
                                    <?php else : echo $statuslevelhead; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo $v_Aff->s_homevisit_statusmanager; ?>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                        <?php endif; ?>
                        <?php if($IfLen == 3):?>
                        <tbody>
                            <?php 
                                foreach ($AllAffairs as $key => $v_Aff) : 
                                    $c = explode('/',$v_Aff->s_homevisit_class);
                                    //echo $c[0];
                                   // if($c[0] == $CClass[0]->Reg_Class):
                            ?>
                            <tr>
                                <th scope="row"><?=$v_Aff->s_homevisit_year?></th>
                                <td>ม.<?=$v_Aff->s_homevisit_class?></td>
                                <!-- <td>
                                    <form class="add_filecoversheet"
                                        id="add_filecoversheet<?=$v_Aff->s_homevisit_id;?>">
                                        <div class="CheckTruefilecoversheet<?=$v_Aff->s_homevisit_id;?>">
                                            <?php if($v_Aff->s_homevisit_filecoversheet != NULL): ?>
                                            <span class="badge badge-success h6 text-white">ส่งแล้ว</span>
                                            <a href="<?=base_url('uploads/affairs/helpstd/filecoversheet/'.$v_Aff->s_homevisit_filecoversheet)?>"
                                                target="_blank" rel="noopener noreferrer">
                                                <span class="badge badge-primary h6 text-white"><i class="fa fa-eye"
                                                        aria-hidden="true" data-toggle="popover" data-trigger="hover"
                                                        data-content="เปิดดู" data-placement="top"></i></span>
                                            </a>
                                            <?php else : ?>
                                            <span class="badge badge-danger h6 text-white">ยังไม่ส่ง</span>
                                            <?php endif; ?>
                                            <?php if($IfLen == 3):?>
                                            <?php if($CheckOnOffSystem === "YES"):?>
                                            <input type="hidden" id="AffID" name="AffID"
                                                value="<?=$v_Aff->s_homevisit_id?>">

                                            <?php if($CheckOnOff->homevisit_set_onoff == 'on'): ?>
                                            <label class="badge badge-warning h6" style="cursor: pointer;"
                                                data-toggle="popover" data-trigger="hover"
                                                data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <input id="s_homevisit_filecoversheet" name="s_homevisit_filecoversheet"
                                                    type="file" class="d-none">
                                            </label>
                                            <?php else: ?>
                                            <label class="badge badge-warning h6 SendCheckOnOff"
                                                style="cursor: pointer;" data-toggle="popover" data-trigger="hover"
                                                data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                            </label>
                                            <?php endif; ?>
                                            <?php else :?>
                                            <span class="badge badge-warning h6" data-toggle="modal"
                                                data-target="#ModalAddHelp">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                            </span>
                                            <?php endif;?>
                                            <?php endif; ?>
                                        </div>
                                    </form>

                                </td>
                                <td>
                                    <form class="add_homevisit_fileSDQ"
                                        id="add_homevisit_fileSDQ<?=$v_Aff->s_homevisit_id;?>">
                                        <div class="CheckTruehomevisit_fileSDQ<?=$v_Aff->s_homevisit_id;?>">
                                            <?php if($v_Aff->s_homevisit_fileSDQ != NULL): ?>
                                            <span class="badge badge-success h6 text-white">ส่งแล้ว</span>
                                            <a href="<?=base_url('uploads/affairs/helpstd/fileSDQ/'.$v_Aff->s_homevisit_fileSDQ)?>"
                                                target="_blank" rel="noopener noreferrer">
                                                <span class="badge badge-primary h6 text-white"><i class="fa fa-eye"
                                                        aria-hidden="true" data-toggle="popover" data-trigger="hover"
                                                        data-content="เปิดดู" data-placement="top"></i></span>
                                            </a>
                                            <?php else : ?>
                                            <span class="badge badge-danger h6 text-white">ยังไม่ส่ง</span>
                                            <?php endif; ?>
                                            <?php if($IfLen == 3):?>
                                            <?php if($CheckOnOffSystem === "YES"):?>
                                            <input type="hidden" id="AffID" name="AffID"
                                                value="<?=$v_Aff->s_homevisit_id?>">
                                            <?php if($CheckOnOff->homevisit_set_onoff == 'on'): ?>
                                            <label class="badge badge-warning h6" style="cursor: pointer;"
                                                data-toggle="popover" data-trigger="hover"
                                                data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <input id="s_homevisit_fileSDQ" name="s_homevisit_fileSDQ" type="file"
                                                    class="d-none">
                                            </label>
                                            <?php else :?>
                                            <label class="badge badge-warning h6 SendCheckOnOff"
                                                style="cursor: pointer;" data-toggle="popover" data-trigger="hover"
                                                data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <?php endif;?>
                                                <?php else :?>
                                                <span class="badge badge-warning h6" data-toggle="modal"
                                                    data-target="#ModalAddHelp">
                                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                                </span>
                                                <?php endif;?>
                                                <?php endif; ?>
                                        </div>
                                    </form>
                                </td> -->
                                <td>

                                    <form class="add_homevisit_filerecordform"
                                        id="add_homevisit_filerecordform<?=$v_Aff->s_homevisit_id;?>">
                                        <div class="CheckTruehomevisit_filerecordform<?=$v_Aff->s_homevisit_id;?>">
                                            <?php if($v_Aff->s_homevisit_filerecordform != NULL): ?>
                                            <span class="badge badge-success h6 text-white">ส่งแล้ว</span>
                                            <a href="<?=base_url('uploads/affairs/helpstd/filerecordform/'.$v_Aff->s_homevisit_filerecordform)?>"
                                                target="_blank" rel="noopener noreferrer">
                                                <span class="badge badge-primary h6 text-white"><i class="fa fa-eye"
                                                        aria-hidden="true" data-toggle="popover" data-trigger="hover"
                                                        data-content="เปิดดู" data-placement="top"></i></span>
                                            </a>
                                            <?php else : ?>
                                            <span class="badge badge-danger h6 text-white">ยังไม่ส่ง</span>
                                            <?php endif; ?>
                                            <?php if($IfLen == 3):?>
                                            <?php if($CheckOnOffSystem === "YES"):?>
                                            <input type="hidden" id="AffID" name="AffID"
                                                value="<?=$v_Aff->s_homevisit_id?>">
                                            <?php if($CheckOnOff->homevisit_set_onoff == 'on'): ?>
                                            <label class="badge badge-warning h6" style="cursor: pointer;"
                                                data-toggle="popover" data-trigger="hover"
                                                data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <input id="s_homevisit_filerecordform" name="s_homevisit_filerecordform"
                                                    type="file" class="d-none">
                                            </label>
                                            <?php else :?>
                                            <label class="badge badge-warning h6 SendCheckOnOff"
                                                style="cursor: pointer;" data-toggle="popover" data-trigger="hover"
                                                data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <?php endif;?>
                                                <?php else :?>
                                                <span class="badge badge-warning h6" data-toggle="modal"
                                                    data-target="#ModalAddHelp">
                                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                                </span>
                                                <?php endif;?>
                                                <?php endif; ?>
                                        </div>
                                    </form>
                                </td>
                                <!-- <td>
                                    <form class="add_homevisit_filesummary"
                                        id="add_homevisit_filesummary<?=$v_Aff->s_homevisit_id;?>">
                                        <div class="CheckTruehomevisit_filesummary<?=$v_Aff->s_homevisit_id;?>">
                                            <?php if($v_Aff->s_homevisit_filesummary != NULL): ?>
                                            <span class="badge badge-success h6 text-white">ส่งแล้ว</span>
                                            <a href="<?=base_url('uploads/affairs/helpstd/filesummary/'.$v_Aff->s_homevisit_filesummary)?>"
                                                target="_blank" rel="noopener noreferrer">
                                                <span class="badge badge-primary h6 text-white"><i class="fa fa-eye"
                                                        aria-hidden="true" data-toggle="popover" data-trigger="hover"
                                                        data-content="เปิดดู" data-placement="top"></i></span>
                                            </a>
                                            <?php else : ?>
                                            <span class="badge badge-danger h6 text-white">ยังไม่ส่ง</span>
                                            <?php endif; ?>
                                            <?php if($IfLen == 3):?>
                                            <?php if($CheckOnOffSystem === "YES"):?>
                                            <input type="hidden" id="AffID" name="AffID"
                                                value="<?=$v_Aff->s_homevisit_id?>">
                                            <?php if($CheckOnOff->homevisit_set_onoff == 'on'): ?>
                                            <label class="badge badge-warning h6" style="cursor: pointer;"
                                                data-toggle="popover" data-trigger="hover"
                                                data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <input id="s_homevisit_filesummary" name="s_homevisit_filesummary"
                                                    type="file" class="d-none">
                                            </label>
                                            <?php else :?>
                                            <label class="badge badge-warning h6 SendCheckOnOff"
                                                style="cursor: pointer;" data-toggle="popover" data-trigger="hover"
                                                data-content="เพิ่มหรือแก้ไขไฟล์" data-placement="top">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <?php endif;?>
                                                <?php else :?>
                                                <span class="badge badge-warning h6" data-toggle="modal"
                                                    data-target="#ModalAddHelp">
                                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                                </span>
                                                <?php endif;?>
                                                <?php endif; ?>
                                        </div>
                                    </form>
                                </td> -->
                                <td>
                                    <?php if($IfLen == 1):?>
                                    <form class="ConfrimStatus needs-validation" method="post" novalidate>
                                        <input type="hidden" id="AffID" name="AffID"
                                            value="<?=$v_Aff->s_homevisit_id?>">
                                        <select name="s_homevisit_statuslevelhead" id="s_homevisit_statuslevelhead"
                                            class="form-control mb-3 ">
                                            <option
                                                <?=$v_Aff->s_homevisit_statuslevelhead == "รอตรวจ" ? "selected" : "" ?>
                                                value="รอตรวจ">รอตรวจ</option>
                                            <option
                                                <?=$v_Aff->s_homevisit_statuslevelhead == "ผ่าน" ? "selected" : "" ?>
                                                value="ผ่าน">ผ่าน</option>
                                            <option
                                                <?=$v_Aff->s_homevisit_statuslevelhead == "ไม่ผ่าน" ? "selected" : "" ?>
                                                value="ไม่ผ่าน">ไม่ผ่าน</option>
                                        </select>
                                    </form>
                                    <?php else : echo $v_Aff->s_homevisit_statuslevelhead; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo $v_Aff->s_homevisit_statusmanager; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="statistic d-flex align-items-center bg-white has-shadow">
            <div class="icon bg-red"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></div>
            <div class="text"><strong>คุณยังไม่ได้ประจำชั้นเรียน กรุณาเพิ่มเข้าประจำชั้นเรียนก่อน โดยติดต่อผู้ดูแลระบบ
                </strong></div>
        </div>

        <?php endif; ?>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="ModalAddHelp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เลือกปีการศึกษา</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php if($CheckOnOffSystem === "YES"): ?>
            <form action="<?=base_url('SupStdMain/Add')?>" method="post">
                <div class="modal-body">
                    <select class="form-control mb-3" id="s_homevisit_year" name="s_homevisit_year">
                        <?php $d = date('Y')+543; 
                    for ($i=$d; $i <= $d+1; $i++):
                    ?>
                        <option value="<?=$i;?>"><?=$i;?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
            <?php else: ?>
            <div class="modal-body">
                <h2>ระบบปิดให้ส่งงาน ไม่สามารถเพิ่มงานหรือแก้ไขงานได้ในขณะนี้ (ติดต่อหัวหน้างาน)</h2>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="update_filecoversheet" id="update_filecoversheet<?=$v_Aff->s_homevisit_id;?>">

                    <input id="s_homevisit_filecoversheet_up" name="s_homevisit_filecoversheet_up" type="file"
                        class="form-control-file">
                </form>
            </div>

        </div>
    </div>
</div>