<h5 class="card-title">New Password <small class="text-danger"></small>รหัสผ่านนี้ใช้สำหรับ ไม่ Login ผ่าน Gmail</small> </h5>
                                <form>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="รหัสผ่าน" minlength=8>
                                    </div>
                                    <div class="form-group">

                                        <input type="password" class="form-control" id="confrim_password"
                                            name="confrim_password" placeholder="ยืนยันรหัสผ่าน" minlength=8>
                                    </div>
                                    <div class="progress progress-striped active">
                                        <div id="jak_pstrength" class="progress-bar" role="progressbar"
                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                        </div>
                                    </div>
                                    <div class="mt-3 text-danger alert_comfirm"></div>

                                    <button type="button" id="submit_password"
                                        class="btn btn-primary">เปลี่ยนรหัสผ่าน</button>
                                </form>