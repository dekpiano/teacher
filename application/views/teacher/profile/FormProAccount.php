<form id="Privateinfo">
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label for="pers_prefix">ชื่อคำนำหน้า</label>
                                            <select class="custom-select d-block w-100" required name="pers_prefix"
                                                id="pers_prefix">
                                                <option value="">เลือก...</option>
                                                <?php $data_prefix = array('นาย','นาง','นางสาว','ว่าที่ร้อยตรี','ว่าที่ร้อยตรีหญิง','Mr.','Mrs.','Miss.');
                              foreach ($data_prefix as $key => $v_prefix):?>
                                                <?php if($action != 'insert_personnel') :?>
                                                <option <?=$pers[0]->pers_prefix == $v_prefix ? 'selected' : '' ;?>
                                                    value="<?=$v_prefix;?>"><?=$v_prefix;?></option>
                                                <?php else: ?>
                                                <option value="<?=$v_prefix;?>"><?=$v_prefix;?></option>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="pers_firstname">ชื่อ</label>
                                            <input type="text" class="form-control" id="pers_firstname"
                                                placeholder="First name" name="pers_firstname"
                                                value="<?=$pers[0]->pers_firstname?>">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="pers_lastname">นามสกุล</label>
                                            <input type="text" class="form-control" id="pers_lastname"
                                                placeholder="Last name" name="pers_lastname"
                                                value="<?=$pers[0]->pers_lastname?>">
                                        </div>

                                        <div class="form-group col-lg-4">
                                            <label for="pers_britday">วันเกิด เดือน ปี พ.ศ.</label>
                                            <?php 
                                        $britday =  @$pers[0]->pers_britday; 
                                        $dated = date("d-m-", strtotime($britday));
                                        $datey = date("Y", strtotime($britday))+543;
                                        $d =  $dated.$datey;
                                    ?>
                                            <input autocomplete="off" type="text" class="form-control "
                                                id="pers_britday" name="pers_britday" placeholder="" value="<?=$d?>"
                                                required="" data-inputmask="'mask': '99-99-9999'">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="pers_username">Email</label>
                                            <input type="email" readonly class="form-control" id="pers_username"
                                                placeholder="Email" name="pers_username"
                                                value="<?=$pers[0]->pers_username?>">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="pers_phone">เบอร์โทร</label>
                                            <input type="text" class="form-control" id="pers_phone"
                                                placeholder="เบอร์โทรศัพท์" name="pers_phone"
                                                value="<?=$pers[0]->pers_phone?>"
                                                data-inputmask="'mask': '99-9999-9999'">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="pers_address">ที่อยู่</label>
                                        <input type="text" class="form-control" id="pers_address" placeholder=""
                                            name="pers_address" value="<?=$pers[0]->pers_address?>">
                                    </div>

                            </div>
                            <button type="button" id="update_Privateinfo" class="btn btn-primary">Save changes</button>
                            </form>