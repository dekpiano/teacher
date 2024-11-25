<style>
    
</style>
<!-- Modal -->
<div class="modal fade" id="ModalClubRecordActivity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">บันทึกเวลาเรียน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between bg-secondary text-white">
                        <div>
                            <h3 class="h2">กิจกรรมชุมนุม : <?=$CheckClub->club_name;?></h3>
                            <h5>
                                ครูที่ปรึกษาชุมนุม <?=$CheckClub->advisors?>
                            </h5>
                        </div>
                        <div>
                            <button class="btn btn-warning ">พิมพ์รายชื่อ</button>
                        </div>


                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="TbViewClubRegister">
                                <thead>
                                    <tr class="text-center">
                                        <th rowspan="2" class="align-content-center">ครั้งที่</th>
                                        <th rowspan="2" class="align-content-center">วัน/เดือน/ปี ที่เรียน</th>
                                        <th rowspan="2" class="align-content-center">สถานะเช็คชื่อ</th>
                                        <th rowspan="2" class="align-content-center">จำนวนนักเรียน (คน)</th>
                                        <th class="text-center" colspan="5">รายละเอียด</th>
                                    </tr>
                                    <tr>
                                        <td>มา</td>
                                        <td>ขาด	</td>
                                        <td>ลาป่วย</td>
                                        <td>ลากิจ</td>
                                        <td>กิจกรรม</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>5</td>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>2</td>
                                    <td>8</td>
                                    <td>5</td>
                                    <td>2</td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="ModalClubCheckName" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">บันทึกเวลาเรียน</h5>
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
                                        <th>ครั้งที่</th>
                                        <th>วัน/เดือน/ปี ที่เรียน</th>
                                        <th>สถานะเช็คชื่อ</th>
                                        <th>จำนวนนักเรียน (คน)</th>
                                        <th>รายละเอียด</th>
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