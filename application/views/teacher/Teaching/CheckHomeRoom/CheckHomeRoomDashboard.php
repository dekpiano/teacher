<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center ">
            <h2 class="no-margin-bottom"><?=$title;?> ห้องเรียนชั้น ม.<?=$teacher[0]->Reg_Class;?></h2>
            <p class="mb-0">

            </p>
        </div>
    </div>
</header>
<div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('Teaching/CheckHomeRoomMain');?>">หน้าแรก</a></li>
        <li class="breadcrumb-item active">สถิติโฮมรูม</li>
    </ul>
</div>
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-2">
                <p>ค้นหาตามวันที่</p>
                <input type="text" class="form-control show_date" id="show_date" value="<?=$this->uri->segment(3)?>"
                    style="text-align: center" autocomplete="off">
            </div>
        </div>


        <div class="card mb-0 h-100 mb-3">
            <div class="card-header d-flex align-items-center">
                <div class="card-close">
                    <div class="dropdown">
                        <button class="dropdown-toggle text-sm" type="button" id="closeCard1" data-bs-toggle="dropdown"
                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                        <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="closeCard1"><a
                                class="dropdown-item py-1 px-3 remove" href="#"> <i class="fas fa-times"></i>Close</a><a
                                class="dropdown-item py-1 px-3 edit" href="#"> <i class="fas fa-cog"></i>Edit</a></div>
                    </div>
                </div>
                <h3 class="h4 mb-0">สถิตินักเรียน วันที่ <?=$this->datethai->thai_date_fullmonth(strtotime($this->uri->segment(3)))?></h3>
            </div>
            <div class="card-body">
                <canvas id="myChart" style="height:40vh; width:80vw"></canvas>
            </div>
        </div>



        <div class="card">
            <div class="card-header">
               <h3>สถิตินักเรียน รายประเภท วันที่ <?=$this->datethai->thai_date_fullmonth(strtotime($this->uri->segment(3)))?></h3> 
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  mb-0 text-left ShowDashborad" id="ShowDashborad">
                        <thead>
                            <tr>
                                <th class="cell">ระดับชั้น</th>
                                <th class="cell text-center">มา</th>
                                <th class="cell text-center">ขาด</th>
                                <th class="cell text-center">สาย</th>
                                <th class="cell text-center">ลา</th>
                                <th class="cell text-center">กิจกรรม</th>
                                <th clv_showHRass="cell">ไม่เข้า</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($showHR as $key => $v_showHR) : 
                                      $v_showHR->chk_home_ma !== "" ? $data_ma =  count(explode('|', $v_showHR->chk_home_ma)) : $data_ma = 0;
                                      $v_showHR->chk_home_khad !== "" ? $data_khad =  count(explode('|', $v_showHR->chk_home_khad)) : $data_khad = 0;
                                      $v_showHR->chk_home_sahy !== "" ? $data_sahy =  count(explode('|', $v_showHR->chk_home_sahy)) : $data_sahy = 0;
                                      $v_showHR->chk_home_la !== "" ? $data_la =  count(explode('|', $v_showHR->chk_home_la)) : $data_la = 0;            
                                      $v_showHR->chk_home_kid !== "" ? $data_kid =  count(explode('|', $v_showHR->chk_home_kid)) : $data_kid = 0;
                                      $v_showHR->chk_home_hnee !== "" ? $data_hnee =  count(explode('|', $v_showHR->chk_home_hnee)) : $data_hnee = 0;    
                                    ?>
                            <tr>
                                <td class="cell">มัธยมศึกษาปีที่ <?=$v_showHR->chk_home_room?>
                                    นักเรียน <?=$data_ma+$data_khad+$data_sahy+$data_la+$data_kid+$data_hnee?> คน
                                </td>
                                <td class="cell ShowStudentLeader text-center" homeroom-id="<?=$v_showHR->chk_home_id?>"
                                    homeroom-keyword="chk_home_ma">
                                    <?=$data_ma;?></span>
                                </td>
                                <td class="cell ShowStudentLeader text-center" homeroom-id="<?=$v_showHR->chk_home_id?>"
                                    homeroom-keyword="chk_home_khad">
                                    <?=$data_khad;?>
                                </td>
                                <td class="cell ShowStudentLeader text-center" homeroom-id="<?=$v_showHR->chk_home_id?>"
                                    homeroom-keyword="chk_home_sahy">
                                    <?=$data_sahy;?>
                                </td>
                                <td class="cell ShowStudentLeader text-center" homeroom-id="<?=$v_showHR->chk_home_id?>"
                                    homeroom-keyword="chk_home_la">
                                    <?=$data_la;?>
                                </td>
                                <td class="cell ShowStudentLeader text-center" homeroom-id="<?=$v_showHR->chk_home_id?>"
                                    homeroom-keyword="chk_home_kid">
                                    <?=$data_kid;?>
                                </td>
                                <td class="cell ShowStudentLeader text-center" homeroom-id="<?=$v_showHR->chk_home_id?>"
                                    homeroom-keyword="chk_home_hnee">
                                    <?=$data_hnee;?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">รวม</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!--//table-responsive-->
            </div>
        </div>

        <div class="card">
            <div class="card-header">
              <h3>สถิตินักเรียนที่ขาดเข้าแถว วันที่ <?=$this->datethai->thai_date_fullmonth(strtotime($this->uri->segment(3)))?></h3>  
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  mb-0 text-left ShowDashborad" id="ShowDashborad">
                        <thead>
                            <tr>
                                <th class="cell">ระดับชั้น</th>
                                <th class="cell text-center">ชายขาด</th>
                                <th class="cell text-center">หญิงขาด</th>
                                <th class="cell text-center"> ขาดรวม </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($all as $key => $v_showHR) : ?>
                            <tr>
                                <td class="cell">
                                    มัธยมศึกษาปีที่ <?=$v_showHR['Room']?>
                                </td>
                                <?php $subB = explode('/',$v_showHR['home_khad'])?>
                                <td class="text-center">
                                    <?=$subB[0]?>
                                </td>
                                <td class="text-center">
                                    <?=$subB[1]?>
                                </td>
                                <td class="text-center">
                                    <?=$subB[0]+$subB[1]?>
                                </td>

                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <th>รวม</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!--//table-responsive-->
            </div>
        </div>

    </div>
</section>