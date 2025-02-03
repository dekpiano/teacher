<style>
    table {
    
    table-layout: auto; /* ปรับขนาดคอลัมน์อัตโนมัติตามข้อมูล */
  }
  th, td {
   
    white-space: nowrap; /* ป้องกันข้อมูลตัดบรรทัด */
  }
</style>
<!-- Modal -->
<div class="modal fade" id="ModalClubRecordActivity" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">สถิติกิจกรรมชุมนุม</h5>
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
                            <a href="<?=base_url('Clubs/Report/AttendanceActivity')?>" class="btn btn-warning "><i class="bi bi-journal-text"></i> สรุปเวลาเรียนกิจกรรม</a>
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
<div class="modal fade" id="ModalClubCheckName" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">บันทึกเวลาเรียน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-center text-center">
                        <div>
                            <h1>บันทึกเวลาเรียน</h1>
                            <p class="h2">กิจกรรมชุมนุม : <?=$CheckClub->club_name;?></p>
                            <p>
                                ครูที่ปรึกษาชุมนุม <?=$CheckClub->advisors?>
                            </p> <br>
                            <p class="h1">ประจำวันที่ <span id="ShowDatetime"></span></p>
                        </div>

                       

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form id="FormRecordActivity">
                                <input type="hidden" id="recordId" name="recordId" value="">
                            <table class="table table-striped table-hover" id="TbClubRecordStudyTime">
                                <thead>
                                    <tr class="bg-primary text-white text-center">
                                        <th>เลขที่</th>
                                        <th>ชั้น</th>
                                        <th>ชื่อ - นามสกุล</th>
                                        <td>สถานะ</td>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" >บันทึกเวลาเรียน</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>