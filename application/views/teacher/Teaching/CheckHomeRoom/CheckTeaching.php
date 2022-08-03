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
<section class="">
    <div class="container-fluid">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-close">
                    <div class="dropdown">
                        <button type="button" id="closeCard2" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard2" class="dropdown-menu dropdown-menu-right has-shadow"><a
                                href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#"
                                class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                    </div>
                </div>
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">แบบฟอร์มเช็คชื่อโฮมรูมนักเรียนกิจกรรมหน้าเสาธง</h3>
                </div>
                <div class="card-body">
                    <p>Lorem ipsum dolor sit amet consectetur.</p>
                    <form class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">คาบที่สอน</label>
                            <div class="col-sm-9">
                                <?php $time = array('คาบที่ 1 (08.30 - 09.20)','คาบที่ 2 (09.20 - 10.10)','คาบที่ 3 (10.10 - 11.00)','คาบที่ 4 (11.00 - 11.50)','คาบที่ 5 (11.50 - 12.50)','คาบที่ 6 (12.50 - 13.40)','คาบที่ 7 (13.40 - 14.30)','คาบที่ 8 (14.30 - 15.20)','คาบที่ 9 (15.20 - 16.10)'); 
                                foreach ($time as $key => $v_time) :
                                ?>
                                <div class="i-checks">
                                    <input id="checkboxCustom<?=$key?>" type="checkbox" value="" class="checkbox-template">
                                    <label for="checkboxCustom<?=$key?>"><?=$v_time;?></label>
                                </div>
                               <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 form-control-label">Password</label>
                            <div class="col-sm-9">
                                <input id="inputHorizontalWarning" type="password" placeholder="Pasword"
                                    class="form-control form-control-warning"><small class="form-text">Example help text
                                    that remains unchanged.</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9 offset-sm-3">
                                <input type="submit" value="Signin" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>