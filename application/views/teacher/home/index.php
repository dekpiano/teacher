<!-- Page Header-->
<style>
.services .card1 {
    padding: 10px;
    border: none;
    cursor: pointer;
    border: groove;
}

.services .card1:hover {
    background-color: #fff;
}

.services .card1 span {
    font-size: 14px;
}

.g-1 {
    padding: 10px 15px;
    margin: 0;
}
</style>
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">ยินดีต้อนรับสู่ระบบงานสารสนเทศ SKJ</h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="no-padding-bottom">
    <div class="container-fluid">


        <div class="articles ">
            <div class="card-header d-flex align-items-center bg-primary text-white">
                <h2 class="h3">งานวิชาการ</h2>
                <div class="badge badge-rounded bg-green"></div>
            </div>
            <div class="card-body no-padding">

                <!-- <div class="services">
                    <div class="pt-3">
                        งานครูเวร
                    </div>
                    <hr>
                    <div class="row" style="padding-top:5px">
                        <div class="col-md-4 ">
                            <div class="statistic d-flex align-items-center bg-white has-shadow">
                                <div class="icon">
                                    <img src="https://cdn-icons-png.flaticon.com/512/2666/2666505.png" width="36" />
                                </div>
                                <div>
                                    <a class="Loader" href="<?=base_url('TeacherJob/CheckNameFrontSchool');?>">
                                        <div class="text">
                                            <h4 class="m-0">เช็คชื่อหน้าประตูโรงเรียน</h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="services">
                    <div class="pt-3">
                        งานครูผู้สอน
                    </div>
                    <hr>
                    <div class="row" style="padding-top:5px">
                        <div class="col-md-4 ">
                            <div class="statistic d-flex align-items-center bg-white has-shadow">
                                <div class="icon">
                                    <img src="https://cdn-icons-png.flaticon.com/512/2666/2666505.png" width="36" />
                                </div>
                                <div>
                                    <a class="Loader" href="<?=base_url('Teaching/CheckHomeRoomMain');?>">
                                        <div class="text">
                                            <h4 class="m-0">เช็คชื่อโฮมรูม</h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="services">
                    <div class="pt-3">
                        งานวัดผล
                    </div>
                    <hr>
                    <div class="row" style="padding-top:5px">
                        <div class="col-md-4 ">
                            <div class="statistic d-flex align-items-center bg-white has-shadow">
                                <div class="icon">
                                    <img src="https://cdn-icons-png.flaticon.com/512/2921/2921222.png" width="36" />
                                </div>
                                <div>
                                    <a class="Loader" href="<?=base_url('Register/SaveScoreMain');?>">
                                        <div class="text">
                                            <h4 class="m-0">บันทึกผลการเรียน(ปกติ)</h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="statistic d-flex align-items-center bg-white has-shadow">
                                <div class="icon">
                                    <img src="https://cdn-icons-png.flaticon.com/512/2921/2921222.png" width="36" />
                                </div>
                                <div>
                                    <a class="Loader" href="<?=base_url('Register/LearnRepeatMain');?>">
                                        <div class="text">
                                            <h4 class="m-0">บันทึกผลการเรียน(ซ้ำ)</h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="statistic d-flex align-items-center bg-white has-shadow">
                                <div class="icon">
                                    <img src="https://cdn-icons-png.flaticon.com/512/1705/1705312.png" width="36" />
                                </div>
                                <div>
                                    <a class="Loader" target="_blank"
                                        href="https://www.canva.com/design/DAFM6-tONMU/rh78MScz3cQZpBUxpCCFcQ/view?utm_content=DAFM6-tONMU&utm_campaign=designshare&utm_medium=link&utm_source=publishsharelink">
                                        <div class="text">
                                            <h4 class="m-0">คู่มือบันทึกผลการเรียน</h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


                <div class="services">
                    <div class="pt-3">
                        งานหลักสูตร
                    </div>
                    <hr>
                    <div class="row" style="padding-top:5px">

                        <div class="col-md-4 ">
                            <div class="statistic d-flex align-items-center bg-white has-shadow">
                                <div class="icon">
                                    <img src="https://cdn-icons-png.flaticon.com/512/7679/7679989.png" width="36" />
                                </div>
                                <div>
                                    <a class="Loader" href="<?=base_url('Course/SendPlanAll/'.$OnOff[0]->seplanset_year.'/'.$OnOff[0]->seplanset_term);?>">
                                        <div class="text">
                                            <h4 class="m-0">ส่งแผนการสอน</h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="statistic d-flex align-items-center bg-white has-shadow">
                                <div class="icon">
                                    <img src="https://cdn-icons-png.flaticon.com/512/25/25407.png" width="36" />
                                </div>
                                <div>
                                    <a class="Loader"
                                        href="<?=base_url('Course/LoadPlan/'.$OnOff[0]->seplanset_year.'/'.$OnOff[0]->seplanset_term).'/All';?>">
                                        <div class="text">
                                            <h4 class="m-0">ดาวโหลดแผน</h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="articles mt-5 mb-3">
            <div class="card-header d-flex align-items-center bg-primary text-white">
                <h2 class="h3">งานกิจการนักเรียน</h2>
                <div class="badge badge-rounded bg-green"></div>
            </div>
            <div class="card-body no-padding">
                <div class="services">
                    <div class="pt-3">
                        ระบบดูแลช่วยเหลือนักเรียน
                    </div>
                    <hr>
                    <div class="row" style="padding-top:5px">
                        <div class="col-md-4 ">
                            <div class="statistic d-flex align-items-center bg-white has-shadow">
                                <div class="icon">
                                    <img src="https://cdn-icons-png.flaticon.com/512/2666/2666505.png" width="36" />
                                </div>
                                <div>
                                    <a class="Loader" href="<?=base_url('SupStd/Main');?>">
                                        <div class="text">
                                            <h4 class="m-0">เยี่ยมบ้าน / SDQ</h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>