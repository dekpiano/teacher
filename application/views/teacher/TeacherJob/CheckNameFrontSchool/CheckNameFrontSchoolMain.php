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
    <div class="">

        <div class="col-lg-12">
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
                    <h3 class="h4">แบบฟอร์ม <?=$title;?></h3>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div style="width: 100%" id="reader"></div>
                        </div>
                        <div class="col-md-8">                          
                            <table class="table table-striped" id="AddStu">
                                <thead>
                                    <tr>                                        
                                        <th scope="col">ห้อง</th>
                                        <th scope="col">เลขประจำตัว</th>
                                        <th scope="col">ชื่อ - นามสกุล</th>
                                        <th scope="col">วันที่</th>
                                        <th scope="col">เวลา</th>
                                        <th scope="col">สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>                                
                                    
                                </tbody>
                            </table>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>