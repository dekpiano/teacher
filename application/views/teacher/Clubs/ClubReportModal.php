<style>
.service-box {
    position: relative;
    background: #17a2b8;
    /* Default color */
    color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
}

.service-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

.service-box .icon {
    font-size: 50px;
    opacity: 0.2;
    position: absolute;
    top: 20px;
    right: 20px;
}

.service-box h4 {
    font-size: 20px;
    font-weight: bold;
}

.service-box p {
    margin-bottom: 15px;
}



/* Colors for boxes */
.service-blue {
    background: #007bff;
}

.service-green {
    background: #28a745;
}

.service-yellow {
    background: #ffc107;
}

.service-red {
    background: #dc3545;
}

/* Animation */
@keyframes pulse {

    0%,
    100% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.05);
    }
}

.service-box:hover {
    animation: pulse 0.6s ease-in-out;
}
</style>
<!-- Modal -->
<div class="modal fade" id="ModalClubRegister" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">งานเอกสาร</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <h3 class="h2">แบบรายงานกิจกรรมชุมนุม : <?=$CheckClub->club_name;?></h3>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <!-- Box 1 -->
                                <div class="col-md-6 col-lg-6 mb-4">
                                    <div class="service-box service-blue">
                                        <i class="bi bi-journal-text"></i>
                                        <p>รายละเอียด</p>
                                        <h4>ใบรายชื่อนักเรียน</h4>
                                        <div class="actions">
                                            <a href="#" class="btn btn-light  w-100"><i class="bi bi-printer-fill"></i>
                                                PDF</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Box 2 -->
                                <div class="col-md-6 col-lg-6 mb-4">
                                    <div class="service-box service-green">
                                        <i class="bi bi-journal-text"></i>
                                        <p>รายละเอียด</p>
                                        <h4>ข้อมูลเวลาเรียน</h4>
                                        <div class="actions">
                                            <a href="#" class="btn btn-light w-100"><i class="bi bi-printer-fill"></i>
                                                PDF</a>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
