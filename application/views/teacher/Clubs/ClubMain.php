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

.callout {
    padding: 15px;
    margin: 10px 0;
    border: 1px solid #eee;
    border-left-width: 5px;
    border-radius: 4px;
}

.callout-success {
    border-left-color: #28a745;
    background-color: #d4edda;
    color: #155724;
}

.callout-violet {
    background-color: #f3e8fd;
    /* สีพื้นหลังอ่อน */
    border-left-color: #8a2be2;
    /* สีขอบซ้าย */
    color: #4b0082;
    /* สีข้อความ */
}


.cardDek {
    position: relative;
    padding: 20px;
    background: #fff;
    border: 2px solid transparent;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, border-color 0.3s ease;
    cursor: pointer;
  }

  .cardDek::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 4px;
    background: #796AEE;
    transition: width 0.3s ease, left 0.3s ease;
    border-radius: 2px;
  }

  .cardDek:hover {
    transform: translateY(-5px);
    border-color: #796AEE;
  }

  .cardDek:hover::before {
    width: 100%;
    left: 0;
  }

  .cardDek h3 {
    margin: 0;
    color: #333;
  }
</style>
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">ยินดีต้อนรับสู่ระบบงานสารสนเทศ SKJ</h2>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="no-padding-bottom p-4">
    
<?php $checkOnoff =  $ClubOnOff->c_onoff_regisend > date('Y-m-d H:i:s') ?"success":"red" ?>
                <?php $checkOnoffThai =  $ClubOnOff->c_onoff_regisend > date('Y-m-d H:i:s') ?"เปิด":"ปิด" ?>
                <?php $ExYear = explode('/', $ClubOnOff->c_onoff_year);?>
                <div class="callout callout-violet">
                        <p>
                        <h1>ชุมนุม <?=$CheckClub->club_name;?> ยินดีต้อนรับ ... </h1>
                        </p>
                        ครูที่ปรึกษาชุมนุม <?=$CheckClub->advisors?></h3>
                    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="">
                <div class="articles ">
                   

                    <div class="card mb-0">
                        <div class="card-header d-flex align-items-center bg-<?=$checkOnoff;?> text-white">
                            กำหนดการลงทะเบียน ภาคเรียนที่ <?=$ExYear[1]?> ปีการศึกษา <?=$ExYear[0]?>
                        </div>
                        <div class="card-body row justify-content-between align-items-center">

                            <div class="col-md-6 d-flex justify-content-center">
                                <div class="text-right">
                                    <div>
                                        เปิดวันที่
                                        <b><?=$this->datethai->thai_date_and_time(strtotime($ClubOnOff->c_onoff_regisstart))?></b>
                                    </div>
                                    <div>
                                        ถึงวันที่
                                        <b><?=$this->datethai->thai_date_and_time(strtotime($ClubOnOff->c_onoff_regisend))?></b>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6  text-center">

                                <div>
                                    <button class="btn text-white bg-<?=$checkOnoff;?>">สถานะ :
                                        <?=$checkOnoffThai;?>ลงทะเบียนชุมนุม</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <section class="dashboard-counts no-padding-bottom pt-2">
                        <div class="">
                            <div class="row bg-white has-shadow">
                                <!-- Item -->
                                <div class="col-xl-4 col-sm-6">
                                    <div class="item d-flex align-items-center">
                                        <div class="icon bg-violet"><i class="icon-user"></i></div>
                                        <div class="title"><span>จำนวนที่<br>เปิดรับทั้งหมด</span>
                                            <div class="progress">
                                                <div role="progressbar" style="width: 25%; height: 4px;"
                                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"
                                                    class="progress-bar bg-violet"></div>
                                            </div>
                                        </div>
                                        <div class="number"><strong><?=$SummaryRegis->club_max_participants?></strong>
                                        </div>
                                    </div>
                                </div>
                                <!-- Item -->
                                <div class="col-xl-4 col-sm-6">
                                    <div class="item d-flex align-items-center">
                                        <div class="icon bg-red"><i class="icon-padnote"></i></div>
                                        <div class="title"><span>จำนวนที่<br>ลงทะเบียน</span>
                                            <div class="progress">
                                                <div role="progressbar" style="width: 70%; height: 4px;"
                                                    aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                                    class="progress-bar bg-red"></div>
                                            </div>
                                        </div>
                                        <div class="number"><strong><?=$SummaryRegis->RegisStudents?></strong></div>
                                    </div>
                                </div>
                                <!-- Item -->
                                <div class="col-xl-4 col-sm-6">
                                    <div class="item d-flex align-items-center">
                                        <div class="icon bg-green"><i class="icon-bill"></i></div>
                                        <div class="title"><span>จำนวนที่<br>ว่างคงเหลือ</span>
                                            <div class="progress">
                                                <div role="progressbar" style="width: 40%; height: 4px;"
                                                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                                    class="progress-bar bg-green"></div>
                                            </div>
                                        </div>
                                        <div class="number"><strong><?=$SummaryRegis->RemainingSpots?></strong></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>

                </div>

            </div>
        </div>
        <div class="col-md-3">

            <div class="statistic cardDek d-flex align-items-center bg-white has-shadow ModalClubRecordActivity" data-clubid="<?=$CheckClub->club_id?>">
                <div class="icon bg-red"><i class="fa fa-tasks"></i></div>
                <div class="text"><strong>บันทึกเวลาเรียน</strong></div>
            </div>
            <div class="statistic cardDek d-flex align-items-center bg-white has-shadow ModalClubRegister" data-clubid="<?=$CheckClub->club_id?>">
                <div class="icon bg-green"><i class="fa fa-calendar-o"></i></div>
                <div class="text"><strong>ข้อมูลของชุมนุม</strong></div>
            </div>
            <div class="statistic cardDek d-flex align-items-center bg-white has-shadow ModalClubReport">
                <div class="icon bg-orange"><i class="fa fa-paper-plane-o"></i></div>
                <div class="text"><strong>พิมพ์เอกสาร</strong></div>
            </div>

        </div>
    </div>


</section>


<!-- //----  Modal ต่าง ๆ -->
 <?php $this->load->view('teacher/Clubs/ClubRegisterModal.php') ?>
 <?php $this->load->view('teacher/Clubs/ClubModalRecordActivity.php') ?>
 <?php $this->load->view('teacher/Clubs/ClubReportModal.php') ?>