<!-- Modal -->
<div class="modal fade" id="ModalClubReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ข้อมูลลงทะเบียน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <h3 class="h2">กิจกรรมชุมนุม : <?=$CheckClub->club_name;?></h3>
                            <h5>
                                ครูที่ปรึกษาชุมนุม <?=$CheckClub->advisors?>
                            </h5>
                        </div>
                        <div>
                            <button class="btn btn-warning">พิมพ์รายชื่อ</button>
                        </div>


                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="TbViewClubRegister">
                                <thead>
                                    <tr class="bg-primary text-white">
                                        <th>ลำดับที่</th>
                                        <th>เลขประจำตัว</th>
                                        <th>ชื่อ - นามสกุล</th>
                                        <th>ชั้น</th>
                                        <th>เลขที่</th>
                                        <th>วันที่ลงทะเบียน</th>
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
</div>