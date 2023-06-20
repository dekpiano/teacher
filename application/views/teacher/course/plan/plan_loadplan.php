<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center ">
            <h2 class="no-margin-bottom">แผนการสอน</h2>
        </div>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="">
    <div class="container-fluid">

        <?php  $typeplan = array('แบบตรวจแผนการจัดการเรียนรู้','บันทึกตรวจใช้แผน','โครงการสอน','แผนการสอนหน้าเดียว','บันทึกหลังสอน'); ?>
        <div class="card p-3">
            <div cass="card-body">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="mr-2">
                        <select name="SelTeacher" id="SelTeacher" class="form-control w-auto">
                            <option value="All">เลือกทั้งหมด</option>
                            <?php foreach ($SelTeacher as $key => $v_SelTeacher): ?>
                            <option <?=$this->uri->segment(5) == $v_SelTeacher->pers_id ?"selected":""?> value="<?=$v_SelTeacher->pers_id?>">
                                <?=$v_SelTeacher->pers_prefix.$v_SelTeacher->pers_firstname.' '.$v_SelTeacher->pers_lastname?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mr-2">                      
                        <select name="CheckYear" id="CheckYear" class="form-control w-auto">
                            <?php foreach ($CheckYear as $key => $v_CheckYear): ?>
                            <option
                                <?=$this->uri->segment(3) == $v_CheckYear->seplan_year && $this->uri->segment(4) == $v_CheckYear->seplan_term ?"selected":""?>
                                value="<?=$v_CheckYear->seplan_year.'/'.$v_CheckYear->seplan_term;?>">
                                <?=$v_CheckYear->seplan_term.'/'.$v_CheckYear->seplan_year;?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mr-2"> 
                    <button type="button" id="SearchPlan" class="btn btn-primary"> ค้นหาแผน</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div cass="card-body">
                <div class="p-3">
                    <table class="table table-hover" id="tb_plan">
                        <thead>
                            <tr>
                                <th scope="col">ปีการศึกษา</th>
                                <th scope="col">รหัสชื่อวิชา</th>
                                <th scope="col">ระดับ</th>
                                <th scope="col">ประเภท</th>
                                <th scope="col">แบบตรวจแผน</th>
                                <th scope="col">บันทึกตรวจใช้แผน</th>
                                <th scope="col">โครงการสอน</th>
                                <th scope="col">แผนการสอนหน้าเดียว</th>
                                <th scope="col">บันทึกหลังสอน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($planNew as $key => $v_planNew):?>
                            <tr>
                                <td scope="row"><?=$v_planNew->seplan_year?>/<?=$v_planNew->seplan_term?></td>
                                <td><?=$v_planNew->seplan_coursecode.' '.$v_planNew->seplan_namesubject?></td>
                                <td>ม.<?=$v_planNew->seplan_gradelevel?></td>
                                <td><?=$v_planNew->seplan_typesubject?></td>

                                <?php foreach($typeplan as $key => $v_typeplan): ?>
                                <?php foreach($plan as $key => $v_plan): ?>
                                <?php if($v_plan->seplan_coursecode == $v_planNew->seplan_coursecode && $v_plan->seplan_typeplan == $v_typeplan && $v_plan->seplan_year == $v_planNew->seplan_year && $v_plan->seplan_term == $v_planNew->seplan_term):  ?>
                                <td>
                                    <a href="<?=base_url('uploads/academic/course/plan/'.$v_plan->seplan_year.'/'.$v_plan->seplan_term.'/'.$v_plan->seplan_namesubject.'/'.$v_plan->seplan_file)?>"
                                        target="_blank" rel="noopener noreferrer">
                                        <span class="badge badge-primary h6 text-white"><i class="fa fa-eye"
                                                aria-hidden="true" data-toggle="popover" data-trigger="hover"
                                                data-content="เปิดดู" data-placement="top"></i></span>
                                    </a>
                                </td>
                                <?php endif; ?>
                                <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

</section>
