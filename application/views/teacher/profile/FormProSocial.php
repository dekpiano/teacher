<form action="#" id="TeacherSocial"  method="post">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-facebook-square"></i>&nbsp; https://www.facebook.com/
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="เพิ่มชื่อโปรไฟล์"
                                            aria-label="Username" aria-describedby="basic-addon1" id="pers_facebook"
                                            name="pers_facebook" value="<?=$pers[0]->pers_facebook?>">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa fa-instagram"></i> &nbsp;
                                                https://www.instagram.com/</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="เพิ่มชื่อโปรไฟล์"
                                            aria-label="Username" aria-describedby="basic-addon1" id="pers_instagram"
                                            name="pers_instagram" value="<?=$pers[0]->pers_instagram?>">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa fa-youtube"></i>&nbsp;https://www.youtube.com/channel/</span>
                                        </div>
                                        <input type="text" class="form-control"
                                            placeholder="เพื่อรหัสช่อง เช่น UCUaRNnj5N5EfKc3-R7BnWbA"
                                            aria-label="Username" aria-describedby="basic-addon1" id="pers_youtube"
                                            name="pers_youtube" value="<?=$pers[0]->pers_youtube?>">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Line ID</span>
                                        </div>
                                        <input type="text" class="form-control"
                                            placeholder="ไอดีไลน์ หรือ เบอร์โทร หรือลิ้งไลน์" aria-label="Username"
                                            aria-describedby="basic-addon1" id="pers_line" name="pers_line"
                                            value="<?=$pers[0]->pers_line?>">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa fa-twitter"></i>
                                                &nbsp;https://www.twitter.com/</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="เพิ่มชื่อโปรไฟล์"
                                            aria-label="Username" aria-describedby="basic-addon1" id="pers_twitter"
                                            name="pers_twitter" value="<?=$pers[0]->pers_twitter?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>