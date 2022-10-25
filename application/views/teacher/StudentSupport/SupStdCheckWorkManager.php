<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">หน้าแรก</h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">

        <?php  if(isset($CClass[0]->Reg_Class)):
    $IfLen = strlen($CClass[0]->Reg_Class); 
    ?>
        <div class="statistic d-flex align-items-center bg-white has-shadow">
            <div class="icon bg-red"><i class="fa fa-tasks"></i></div>
            <div class="text">
                <strong>
                    สำหรับหัวหน้างาน
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

            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="h4">งานเยี่ยมบ้าน / SDQ</h3>
                </div>
                <div>
                    <select name="account" class="form-control w-auto" id="homevisit_ckeck_year">
                        <?php foreach ($CheckYear as $key => $v_CheckYear): ?>
                        <option <?=$this->uri->segment(3) == $v_CheckYear->s_homevisit_year ?"selected":""?> value="<?= $v_CheckYear->s_homevisit_year?>">ปี <?= $v_CheckYear->s_homevisit_year?></option>
                        <?php endforeach; ?>
                    </select>
                </div>




            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ปีการศึกษา</th>
                                <th>ระดับชั้น</th>
                                <th>ใบปะหน้า</th>
                                <th>SDQ</th>
                                <th>แบบบันทึก</th>
                                <th>สรุปข้อมูล</th>
                                <th>หัวหน้าระดับ</th>
                                <th>หัวหน้างาน</th>
                            </tr>
                        </thead>
                        <!-- สำหรับหัวหน้างาน -->

                        <tbody>
                            <?php 
                                foreach ($AllAffairs as $key => $v_Aff) :                                                                 
                            ?>
                            <tr>
                                <th scope="row"><?=$v_Aff->s_homevisit_year?></th>
                                <td>ม.<?=$v_Aff->s_homevisit_class?></td>
                                <td>
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

                                        </div>
                                    </form>
                                </td>
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

                                        </div>
                                    </form>
                                </td>
                                <td>
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

                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <?php echo $v_Aff->s_homevisit_statuslevelhead; ?>

                                </td>
                                <td>
                                    <?php 
                                   
                                    $statusmanager = $v_Aff->s_homevisit_statusmanager;
                                      if($statusmanager == "ไม่ผ่าน") {
                                            $valid = 'is-invalid';
                                      }elseif($statusmanager == "ผ่าน"){
                                        $valid = 'is-valid';
                                      }elseif($statusmanager == "รอตรวจ" || $statusmanager == ""){
                                        $valid = "";
                                      }
                                    ?>

                                    <form class="ConfrimStatusManager" method="post">
                                        <input type="hidden" id="AffID" name="AffID"
                                            value="<?=$v_Aff->s_homevisit_id?>">
                                        <select name="s_homevisit_statusmanager"
                                            id="s_homevisit_statusmanager<?=$v_Aff->s_homevisit_id?>"
                                            class="form-control mb-3 <?=$valid?>">
                                            <option
                                                <?=$v_Aff->s_homevisit_statusmanager == "รอตรวจ" ? "selected" : "" ?>
                                                value="รอตรวจ">รอตรวจ</option>
                                            <option <?=$v_Aff->s_homevisit_statusmanager == "ผ่าน" ? "selected" : "" ?>
                                                value="ผ่าน">ผ่าน</option>
                                            <option
                                                <?=$v_Aff->s_homevisit_statusmanager == "ไม่ผ่าน" ? "selected" : "" ?>
                                                value="ไม่ผ่าน">ไม่ผ่าน</option>
                                        </select>
                                    </form>

                                </td>
                            </tr>

                            <?php endforeach; ?>
                        </tbody>


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