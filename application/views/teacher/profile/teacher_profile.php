<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center ">
            <h2 class="no-margin-bottom">โปรไฟล์</h2>
        </div>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="">
    <div class="container-fluid">

        <?php if($pers[0]->pers_changepassword == ""): ?>
        <h2>กรุณาเปลี่ยนรหัสผ่านใหม่ ก่อนใช้งาน</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">New Password</h5>

                <form>
                    <div class="form-group">

                        <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน"
                            minlength=8>

                    </div>
                    <div class="form-group">

                        <input type="password" class="form-control" id="confrim_password" name="confrim_password"
                            placeholder="ยืนยันรหัสผ่าน" minlength=8>
                    </div>
                    <div class="progress progress-striped active">
                        <div id="jak_pstrength" class="progress-bar" role="progressbar" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        </div>
                    </div>
                    <div class="mt-3 text-danger alert_comfirm"></div>

                    <button type="button" id="submit_password" class="btn btn-primary">เปลี่ยนรหัสผ่าน</button>
                </form>

            </div>
        </div>
        <?php else: ?>

        <div class="row">
            <div class="col-md-5 col-xl-4">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Settings</h5>
                    </div>
                    <div class="list-group list-group-flush" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <a class="list-group-item list-group-item-action active" id="v-pills-home-tab"
                            data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                            aria-selected="true">
                            บัญชี
                        </a>
                        <a class="list-group-item list-group-item-action" id="v-pills-profile-tab" data-toggle="pill"
                            href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                            รหัสผ่าน
                        </a>
                        <a class="list-group-item list-group-item-action" id="social-tab" data-toggle="pill"
                            href="#social" role="tab" aria-controls="social" aria-selected="false">
                            ติดต่อ Social
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-7 col-xl-8">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Public info</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="">ชื่อผู้ใช้งาน</label>
                                                <input readonly type="text" class="form-control" id=""
                                                    value="<?=$pers[0]->pers_username?>">
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="Biography">เกี่ยวกันตนเอง</label>
                                                <input type="text" class="form-control" id="Biography"
                                                    placeholder="ชีวประวัติสั้น ๆ">
                                            </div> -->
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <img alt="Andrew Jones"
                                                    src="https://academic.skj.ac.th/uploads/General/Personnel/<?=$pers[0]->pers_img?>"
                                                    class="rounded-circle img-responsive mt-2" width="128" height="128">

                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Private info</h5>
                            </div>
                            <div class="card-body">
                            <?php $this->load->view('teacher/profile/FormProAccount.php') ?>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab">
                            <div class="card">
                                <div class="card-body">
                                    <?php $this->load->view('teacher/profile/FormProResetPassword.php') ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                            <div class="card">
                                <div class="card-body">
                                    <?php $this->load->view('teacher/profile/FormProSocial.php') ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                            aria-labelledby="v-pills-settings-tab">
                            .777.
                        </div>
                    </div>

                </div>

            </div>

            <?php endif; ?>

        </div>
</section>