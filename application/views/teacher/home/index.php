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
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">


        <div class="articles ">
            <div class="card-header d-flex align-items-center">
                <h2 class="h3">งานวิชาการ</h2>
                <div class="badge badge-rounded bg-green"></div>
            </div>
            <div class="card-body no-padding">

                <div class="services">
                    <div class="pt-3">
                        งานครูผู้สอน
                    </div>
                    <div class="g-1 row" style="padding-top:5px">
                        <div class="col-md-2 col-6">
                            <div class="card1 text-center">
                                <a href="<?=base_url('Teaching/CheckHomeRoomMain');?>">
                                    <div class="image">
                                        <img src="https://cdn-icons-png.flaticon.com/512/2666/2666505.png" width="36" />
                                    </div>
                                    <span>เช็คชื่อโฮมรูม</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="services">
                    <div class="pt-3">
                        งานวัดผล
                    </div>
                    <div class="g-1 row" style="padding-top:5px">
                        <div class="col-md-2 col-6">
                            <div class="card1 text-center">
                                <a href="<?=base_url('Register/SaveScoreMain');?>">
                                    <div class="image">
                                        <img src="https://cdn-icons-png.flaticon.com/512/2921/2921222.png" width="36" />
                                    </div>
                                    <span>บันทึกผลการเรียน</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="services">
                    <div class="pt-3">
                        งานหลักสูตร
                    </div>
                    <div class="g-1 row" style="padding-top:5px">
                        <div class="col-md-2 col-6">
                            <div class="card1 text-center">
                                <a href="<?=base_url('Course');?>">
                                    <div class="image">
                                        <img src="https://cdn-icons-png.flaticon.com/512/7679/7679989.png" width="36" />
                                    </div>
                                    <span>ส่งแผนการสอน</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="card1 text-center">
                                <a href="<?=base_url('Course/LoadPlan');?>">
                                    <div class="image">
                                        <img src="https://cdn-icons-png.flaticon.com/512/25/25407.png" width="36" />
                                    </div>
                                    <span>ดาวโหลดแผน</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="articles">
            <div class="card-header d-flex align-items-center">
                <h2 class="h3">งานกิจการนักเรียน</h2>
                <div class="badge badge-rounded bg-green"></div>
            </div>
            <div class="card-body no-padding">
                <div class="services">
                    <div class="pt-3">
                        ระบบดูแลช่วยเหลือนักเรียน
                    </div>
                    <div class="g-1 row" style="padding-top:5px">
                        <div class="col-md-2 col-6">
                            <div class="card1 text-center">
                                <a href="<?=base_url('SupStd/Main');?>">
                                    <div class="image">
                                        <img src="https://cdn-icons-png.flaticon.com/512/2666/2666505.png" width="36" />
                                    </div>
                                    <span>เยี่ยมบ้าน / SDQ</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>