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


<!-- Dashboard Counts Section-->
<div class="container-fluid mt-5">

    <div class="row">
        <div class="col-lg-4 col-12">
            <div class="statistic d-flex align-items-center bg-white has-shadow">
                <div class="icon bg-red"><i class="fa fa-plus"></i></div>
                <a href="<?=base_url('Teaching/CheckHomeRoomAdd');?>">
                    <div class="text"><strong>บันทึกข้อมูลโฮมรูม</strong></div>
                </a>
            </div>

        </div>
        <div class="col-lg-4 col-12">
            <div class="statistic d-flex align-items-center bg-white has-shadow">
                <div class="icon bg-red"><i class="fa fa-line-chart"></i></div>
                <a href="<?=base_url('Teaching/CheckHomeRoomStatistics');?>">
                    <div class="text"><strong>สถิติข้อมูลทั้งหมดโฮมรูม</strong></div>
                </a>
            </div>

        </div>
    </div>

</div>


<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
        <h2>สถิติการมาเข้าแถวตอนเช้า วันที่
            <?=$this->datethai->thai_date_fullmonth(strtotime(date('Y-m-d')))?>
            <input type="text" name="DateToDay" id="DateToDay" value="<?=date('Y-m-d');?>" style="display:none">
        </h2>
        <?php 
        
                if(date('Y-m-d',strtotime(@$ChkHomeRoom->chk_home_date)) === date('Y-m-d')){
                    $ChkHomeRoom->chk_home_ma !== "" ? $stu_ma =  count(explode('|', $ChkHomeRoom->chk_home_ma)) : $stu_ma = 0;
                    $ChkHomeRoom->chk_home_khad !== "" ? $stu_khad =  count(explode('|', $ChkHomeRoom->chk_home_khad)) : $stu_khad = 0;
                    $ChkHomeRoom->chk_home_la !== "" ? $stu_la =  count(explode('|', $ChkHomeRoom->chk_home_la)) : $stu_la = 0;
                    $ChkHomeRoom->chk_home_sahy !== "" ? $stu_sahy =  count(explode('|', $ChkHomeRoom->chk_home_sahy)) : $stu_sahy = 0;
                    $ChkHomeRoom->chk_home_kid !== "" ? $stu_kid =  count(explode('|', $ChkHomeRoom->chk_home_kid)) : $stu_kid = 0;
                    $ChkHomeRoom->chk_home_hnee !== "" ? $stu_hnee =  count(explode('|', $ChkHomeRoom->chk_home_hnee)) : $stu_hnee = 0;
                }
                else{
                    $stu_ma =  0;
                    $stu_khad =  0;
                    $stu_la =  0;
                    $stu_sahy =  0;
                    $stu_kid =  0;
                    $stu_hnee =  0;
                }
             
        
        
        // if($ChkHomeRoom){

        // }
        ?>
        <div class="row bg-white has-shadow">
            <!-- Item -->
            <div class="col-xl-2 col-sm-6">
                <div class="item d-flex align-items-center ShowStudent" homeroom-id="<?=@$ChkHomeRoom->chk_home_id;?>"
                    homeroom-keyword="chk_home_ma">
                    <div class="icon bg-violet"><i class="icon-user"></i></div>
                    <div class="title"><b>มา</b>
                        <div class="progress">
                            <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                        </div>
                    </div>
                    <div class="number">
                        <strong><?=$stu_ma;?></strong>    
                        <div class="text-center" style="font-size: 14px;">ช:<?=$BoyMa;?> | ญ:<?=$GirlMa;?></div>                 
                    </div>                    
                </div>
                 
            </div>
            <!-- Item -->
            <div class="col-xl-2 col-sm-6">
                <div class="item d-flex align-items-center ShowStudent" homeroom-id="<?=@$ChkHomeRoom->chk_home_id;?>"
                    homeroom-keyword="chk_home_khad">
                    <div class="icon bg-red"><i class="icon-user"></i></div>
                    <div class="title"><span>ขาด</span>
                        <div class="progress">
                            <div role="progressbar" style="width: 70%; height: 4px;" aria-valuenow="70"
                                aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                        </div>
                    </div>
                    <div class="number">
                        <strong><?=$stu_khad;?></strong>
                        <div class="text-center" style="font-size: 14px;">ช:<?=$BoyKhad;?> | ญ:<?=$GirlKhad;?></div>
                    </div>
                    
                </div>
                
            </div>
            <!-- Item -->
            <div class="col-xl-2 col-sm-6">
                <div class="item d-flex align-items-center ShowStudent" homeroom-id="<?=@$ChkHomeRoom->chk_home_id;?>"
                    homeroom-keyword="chk_home_sahy">
                    <div class="icon bg-green"><i class="icon-user"></i></div>
                    <div class="title"><span>สาย<br></span>
                        <div class="progress">
                            <div role="progressbar" style="width: 40%; height: 4px;" aria-valuenow="40"
                                aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                        </div>
                    </div>
                    <div class="number">
                        <strong><?=$stu_sahy;?></strong>
                        <div class="text-center" style="font-size: 14px;">ช:<?=$BoySahy;?> | ญ:<?=$GirlSahy;?></div> 
                    </div>     
                                  
                </div>
                
            </div>
            <!-- Item -->
            <div class="col-xl-2 col-sm-6">
                <div class="item d-flex align-items-center ShowStudent" homeroom-id="<?=@$ChkHomeRoom->chk_home_id;?>"
                    homeroom-keyword="chk_home_la">
                    <div class="icon bg-orange"><i class="icon-user"></i></div>
                    <div class="title"><span>ลา<br></span>
                        <div class="progress">
                            <div role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="50"
                                aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                        </div>
                    </div>
                    <div class="number">                    
                        <strong><?=$stu_la;?></strong>
                        <div class="text-center" style="font-size: 14px;">ช:<?=$BoyLa;?> | ญ:<?=$GirlLa;?></div>
                    </div>
                   
                </div>
                
            </div>
            <!-- Item -->
            <div class="col-xl-2 col-sm-6">
                <div class="item d-flex align-items-center ShowStudent" homeroom-id="<?=@$ChkHomeRoom->chk_home_id;?>"
                    homeroom-keyword="chk_home_kid">
                    <div class="icon" style="background: #6df2ff !important;
    color: #fff;"><i class="icon-user"></i></div>
                    <div class="title"><span>กิจกรรม<br></span>
                        <div class="progress">
                            <div role="progressbar" style="width: 50%; height: 4px;background: #6df2ff ;"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar"></div>
                        </div>
                    </div>
                    <div class="number">
                        <strong><?=$stu_kid;?></strong>
                        <div class="text-center" style="font-size: 14px;">ช:<?=$BoyKid?> | ญ:<?=$GirlKid;?></div>
                    </div>
                    
                </div>
                
            </div>
            <!-- Item -->
            <div class="col-xl-2 col-sm-6">
                <div class="item d-flex align-items-center ShowStudent" homeroom-id="<?=@$ChkHomeRoom->chk_home_id;?>"
                    homeroom-keyword="chk_home_hnee">
                    <div class="icon bg-orange" style="background: #ff6df4 !important;
    color: #fff;"><i class="icon-user"></i></div>
                    <div class="title"><span>ไม่เข้าแถว<br></span>
                        <div class="progress">
                            <div role="progressbar" style="width: 50%; height: 4px;background-color: #ff6df4;"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar"></div>
                        </div>
                    </div>
                    <div class="number">
                        <strong><?=$stu_hnee;?></strong>
                        <div class="text-center" style="font-size: 14px;">ช:<?=$BoyHnee;?> | ญ:<?=$GirlHnee;?></div>
                    </div>
                   
                </div>
                
            </div>
        </div>
    </div>
</section>

<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="bar-chart-example card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">สถิติการมาเข้าแถวตอนเช้า</h3>
                </div>
                <div class="card-body">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class=""></div>
                        </div>
                    </div>
                    <canvas id="barChartExample" width="565" height="250"
                        style="display: block; width: 565px; height: 282px;" class="chartjs-render-monitor">

                    </canvas>
                </div>
            </div>
        </div>
    </div>
</section>

