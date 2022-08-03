<style>
@keyframes click-wave {
    0% {
        height: 40px;
        width: 40px;
        opacity: 0.15;
        position: relative;
    }

    100% {
        height: 200px;
        width: 200px;
        margin-left: -80px;
        margin-top: -80px;
        opacity: 0;
    }
}

.option-input {
    -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    -o-appearance: none;
    appearance: none;
    position: relative;
    top: 13.33333px;
    right: 0;
    bottom: 0;
    left: 0;
    height: 40px;
    width: 40px;
    transition: all 0.15s ease-out 0s;
    background: #cbd1d8;
    border: none;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    margin-right: 0.5rem;
    outline: none;
    position: relative;
    z-index: 1000;
}

.option-input:hover {
    background: #9faab7;
}

.option-input:checked {
    background: #E91E63;
}

.option-input:checked::before {
    height: 40px;
    width: 40px;
    position: absolute;
    content: "\f111";
    font-family: "Font Awesome 5 Free";
    display: inline-block;
    font-size: 26.66667px;
    text-align: center;
    line-height: 40px;
}

.option-input:checked::after {
    -webkit-animation: click-wave 0.25s;
    -moz-animation: click-wave 0.25s;
    animation: click-wave 0.25s;
    background: #E91E63;
    content: '';
    display: block;
    position: relative;
    z-index: 100;
}

.option-input.radio {
    border-radius: 50%;
}

.option-input.radio::after {
    border-radius: 50%;
}
</style>
<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center ">
            <h2 class="no-margin-bottom"><?=$title;?></h2>
            <p class="mb-0">
            </p>
        </div>
    </div>
</header>
<div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('Teaching/CheckHomeRoomMain');?>">หน้าแรก</a></li>
        <li class="breadcrumb-item active">บันทึกข้อมูลโฮมรูม</li>
    </ul>
</div>
<!-- Dashboard Counts Section-->
<section class="">
    <div class="container">
        <?php if(empty(@$ChkHomeRoom[0]->chk_home_ma)): ?>
        <div class="alert alert-danger" role="alert">
            <div class="row">
                <div class="col-auto mr-auto">
                    <strong>แจ้งเตือน!</strong> ห้องเรียนชั้น ม.<?=$teacher[0]->Reg_Class;?> ยังไม่ได้เช็คโฮมรูม
                    มีเวลาถึง เวลา 09.00 น.
                </div>

                <div class="col-auto">
                    <a href="<?=base_url('Teaching/CheckHomeRoomMain')?>" class="btn btn-outline-primary">
                        ไปดูสถิติ
                    </a>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="alert alert-success" role="alert">
            <div class="row">
                <div class="col-auto mr-auto">
                    <strong>แจ้งเตือน!</strong> บันทึกข้อมูลโฮมรูมเรียบร้อยแล้ว สามารถอัพเดตข้อมูลได้ถึง เวลา 09.00 น.
                </div>

                <div class="col-auto">
                    <a href="<?=base_url('Teaching/CheckHomeRoomMain')?>" class="btn btn-outline-primary">
                        ไปดูสถิติ
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="articles card">
            <div class="card-header align-items-center">
                <div class="row">
                    <div class="col-lg-8">
                        <h2 class="h3">แบบฟอร์มเช็คชื่อโฮมรูมนักเรียนกิจกรรมหน้าเสาธง ชั้น
                            ม.<?=$teacher[0]->Reg_Class;?></h2>
                    </div>

                    <div class="col-lg-4">
                        <h3>
                            <?=$this->datethai->thai_date_and_time(strtotime(date('d-m-Y H:i:s')));?>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="card-body no-padding">

                <form class="form-horizontal" action="<?=$Action;?>" method="post">

                    <div class="row justify-content-md-center mt-3">
                        <?php foreach ($student as $key => $v_stu) : ?>

                        <input type="hidden" name="chk_home_teacher" id="chk_home_teacher"
                            value="<?=$this->session->userdata('login_id')?>">
                        <input type="hidden" name="chk_home_room" id="chk_home_room"
                            value="<?=$teacher[0]->Reg_Class;?>">
                        <input type="hidden" name="chk_home_term" id="chk_home_term" value="1">
                        <input type="hidden" name="chk_home_yaer" id="chk_home_yaer" value="2565">

                        <div class="item align-items-center col-lg-4 d-flex offset-lg-2" style="padding: 5px 20px;">
                            <div class="image"><img src="https://cdn-icons-png.flaticon.com/512/1946/1946429.png"
                                    alt="..." class="img-fluid rounded-circle"></div>
                            <div class="text">
                                <a href="#">
                                    <h3 class="h5"><?=$v_stu->StudentNumber?>.
                                        <?=$v_stu->StudentPrefix?><?=$v_stu->StudentFirstName?>
                                        <?=$v_stu->StudentLastName?></h3>
                                </a>
                                <small>เลขประจำตัว <?=$v_stu->StudentCode?></small>
                            </div>
                        </div>
                        <div class="col-lg-6 align-self-center mb-4 text-center">
                            <?php                                             
                                            $chkMa = explode("|",@$ChkHomeRoom[0]->chk_home_ma);
                                            $chkLa = explode("|",@$ChkHomeRoom[0]->chk_home_la);
                                            $chkSahy = explode("|",@$ChkHomeRoom[0]->chk_home_sahy);
                                            $chkKid = explode("|",@$ChkHomeRoom[0]->chk_home_kid);
                                            $chkHnee = explode("|",@$ChkHomeRoom[0]->chk_home_hnee);
                                            $chkKhad = explode("|",@$ChkHomeRoom[0]->chk_home_khad);
                                            ?>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-primary active">
                                    <input type="radio" name="status[<?=$v_stu->StudentCode?>]" id="status[<?=$key?>]"
                                        value="มา" autocomplete="off"
                                        <?php if(in_array($v_stu->StudentCode, $chkMa)){echo "checked";}?>> มา
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="status[<?=$v_stu->StudentCode?>]" id="status[<?=$key?>]"
                                        value="ขาด" autocomplete="off" <?php 
                                                    if($chkKhad[0] == ""){
                                                        echo "checked";
                                                    }else{
                                                        if(in_array($v_stu->StudentCode, $chkKhad)){echo "checked";}  
                                                    }
                                                    ?>>
                                    ขาด
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="status[<?=$v_stu->StudentCode?>]" id="status[<?=$key?>]"
                                        value="สาย" autocomplete="off"
                                        <?php if(in_array($v_stu->StudentCode, $chkSahy)){echo "checked";}?>>
                                    สาย
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="status[<?=$v_stu->StudentCode?>]" id="status[<?=$key?>]"
                                        value="ลา" autocomplete="off"
                                        <?php if(in_array($v_stu->StudentCode, $chkLa)){echo "checked";}?>>
                                    ลา
                                </label>
                                <label class="btn btn-outline-primary">
                                    <input type="radio" name="status[<?=$v_stu->StudentCode?>]" id="status[<?=$key?>]"
                                        value="กิจกรรม" autocomplete="off"
                                        <?php if(in_array($v_stu->StudentCode, $chkKid)){echo "checked";}?>>
                                    กิจกรรม
                                </label>
                                <label class="btn btn-outline-primary w-auto">
                                    <input type="radio" name="status[<?=$v_stu->StudentCode?>]" id="status[<?=$key?>]"
                                        value="หนี" autocomplete="off"
                                        <?php if(in_array($v_stu->StudentCode, $chkHnee)){echo "checked";}?>>
                                    ไม่เข้า
                                </label>
                            </div>
                        </div>

                        <?php endforeach; ?>
                        <input type="hidden" name="chk_home_id" id="chk_home_id"
                            value="<?=@$ChkHomeRoom[0]->chk_home_id?>">
                    </div>
                    <?php                     
                        if(date("H:i",strtotime($ChkHomeRoomSet[0]->set_homeroom_time)) > date("H:i:s")):
                    ?>
                    <div class="text-center m-3">
                        <button type="submit" class="btn btn-<?=$ButtonClass;?>"><?=$ButtonName;?></button>
                    </div>
                    <?php else: ?>
                    <div class="container">
                        <div class="alert alert-danger text-center">
                            <strong>แจ้งเตือน!</strong> ขณะนี้เลยเวลาเช็คชื่อโฮมรูมแล้ว ไม่สามารถกดปุ่มยืนยันได้
                            กรุณารอในวันถัดไป ถึงเวลา 09.00
                            น.
                            ของทุกวัน... (ติดต่องานกิจกรรมนักเรียน)
                        </div>
                    </div>
                    <?php endif; ?>
                </form>
            </div>

        </div>


    </div>
</section>