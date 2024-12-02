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
<div class="modal fade" id="ModalClubSetLearnActivity" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">กำหนดการจัดกิจกรรมการเรียนรู้</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" id="FormSetLearnActivity">
                <input type="hidden" name="ClubId" id="ClubId" value="">
                    <table class="w-100" id="activityTable">
                        <thead>
                            <tr class="text-center">
                                <th>ลำดับที่</th>
                                <th>กิจกรรม</th>
                                <th>เวลา/ชั่วโมง</th>
                                <th width="50"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>
                                    <input type="text" class="form-control text-center" name="activity[]"
                                        placeholder="กรอกข้อมูลกิจกรรม">
                                </td>
                                <td width="30">
                                    <input type="text" class="form-control text-center" name="hours[]"
                                        placeholder="เวลา/ชั่วโมง">
                                </td>
                                <td></td>
                            </tr>

                        </tbody>

                    </table>
                    <div class="mt-3 d-flex justify-content-between">
                        <button class="btn btn-secondary addRow" id="addRow">+เพิ่มกิจกรรม</button>
                        <button class="btn btn-primary" type="submit" id="SubAddSetLearnActivity">บันทึกกิจกรรม</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>