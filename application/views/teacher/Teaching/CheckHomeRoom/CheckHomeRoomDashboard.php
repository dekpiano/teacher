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
            <div class="col-lg-4">
                <p>ค้นหาตามวันที่</p>
                <input type="text" class="form-control show_date" id="show_date" value="<?=$this->uri->segment(4)?>"
                    style="text-align: center">
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  mb-0 text-left" id="ShowDashborad">
                        <thead>
                            <tr>
                                <th class="cell">ระดับชั้น</th>
                                <th class="cell">มา</th>
                                <th class="cell">ขาด</th>
                                <th class="cell">สาย</th>
                                <th class="cell">ลา</th>
                                <th class="cell">กิจกรรม</th>
                                <th clv_showHRass="cell">ไม่เข้าเรียน</th>
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
                                <td class="cell">มัธยมศึกษาปีที่ <?=$v_showHR->chk_home_room?></td>
                                <td class="cell ShowStudentLeader" homeroom-id="<?=$v_showHR->chk_home_id?>"
                                    homeroom-keyword="chk_home_ma">
                                    <?=$data_ma;?></span>
                                </td>
                                <td class="cell ShowStudentLeader" homeroom-id="<?=$v_showHR->chk_home_id?>"
                                    homeroom-keyword="chk_home_khad">
                                    <?=$data_khad;?>
                                </td>
                                <td class="cell ShowStudentLeader" homeroom-id="<?=$v_showHR->chk_home_id?>"
                                    homeroom-keyword="chk_home_sahy">
                                    <?=$data_sahy;?>
                                </td>
                                <td class="cell ShowStudentLeader" homeroom-id="<?=$v_showHR->chk_home_id?>"
                                    homeroom-keyword="chk_home_la">
                                    <?=$data_la;?>
                                </td>
                                <td class="cell ShowStudentLeader" homeroom-id="<?=$v_showHR->chk_home_id?>"
                                    homeroom-keyword="chk_home_kid">
                                    <?=$data_kid;?>
                                </td>
                                <td class="cell ShowStudentLeader" homeroom-id="<?=$v_showHR->chk_home_id?>"
                                    homeroom-keyword="chk_home_hnee">
                                    <?=$data_hnee;?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">รวม</th>
                                <th></th>
                                <th></th>
                                <th></th>
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