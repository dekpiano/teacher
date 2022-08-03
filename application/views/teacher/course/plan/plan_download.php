<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center ">
            <h2 class="no-margin-bottom"><?=$title?></h2>

        </div>
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr class="table-active">
                            <th >ชื่อ - นามสกุล</th>
                            <th >คำสั่ง</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($teacher as $key => $v_teacher) : ?>
                        <tr>
                            <td >
                                <?=$v_teacher->pers_prefix.$v_teacher->pers_firstname.' '.$v_teacher->pers_lastname?>
                            </td>
                            <td ><a href="<?=base_url('Course/DownloadPlanZip/').$v_teacher->pers_id;?>">Download</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>