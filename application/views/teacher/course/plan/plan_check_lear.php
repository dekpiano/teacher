<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center ">
            <h2 class="no-margin-bottom"><?=$title?><?=$lean[0]->lear_namethai?></h2>
        </div>
    </div>
</header>
<div class="breadcrumb-holder container-fluid">
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('Course/CheckPlan')?>">กลุ่มสาระ</a></li>
        <li class="breadcrumb-item active"><?=$lean[0]->lear_namethai?></li>
    </ul>
</div>
<!-- Dashboard Counts Section-->
<section class="">
    <div class="container-fluid">
        <div class="articles card">
            <div class="card-header d-flex align-items-center">
                <h2 class="h3">กลุ่มสาระการเรียนรู้<?=$lean[0]->lear_namethai?> </h2>
                <!-- <div class="badge badge-rounded bg-green">4 New </div> -->
            </div>
            <?php  foreach ($techer as $key => $v_techer): ?>

            <div class="card-body no-padding">
                <div class="item d-flex align-items-center">
                    <div class="image"><img src="https://academic.skj.ac.th/uploads/General/Personnel/<?=$v_techer->pers_img?>"
                            alt="..." class="img-fluid rounded-circle"></div>
                    <div class="text"><a href="<?=base_url('Course/CheckPlan/'.$lean[0]->lear_id.'/'.$v_techer->pers_id)?>">
                            <h3 class="h5">
                                <?=$v_techer->pers_prefix.$v_techer->pers_firstname.' '.$v_techer->pers_lastname?></h3>
                        </a><small><?=$lean[0]->lear_namethai?></small>
                    </div>
                </div>

            </div>
            <?php endforeach; ?>
        </div>



    </div>
</section>
