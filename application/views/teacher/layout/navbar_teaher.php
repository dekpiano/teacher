<div class="page-content d-flex align-items-stretch">
    <!-- Side Navbar -->
    <nav class="side-navbar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img
                    src="https://academic.skj.ac.th/uploads/General/Personnel/<?=$this->session->userdata('img');?>"
                    alt="..." class="img-fluid rounded-circle"></div>
            <div class="title">
                <h1 class="h4"><?=$this->session->userdata('fullname');?> </h1>
                <p>ครูประจำชั้น ม.<?=$this->session->userdata('class');?></p>
            </div>
        </div>
        <ul class="list-unstyled">
            <li class=" <?=$this->uri->segment(1) == 'Home' ? 'active' : '' ?>">
                <a href="<?=base_url('Home');?>"> <i class="icon-home"></i>หน้าแรก </a>
            </li>
        </ul>
        <span class="heading">งานวิชาการ</span>
        <ul class="list-unstyled">
            <!-- <li><a href="#TeacherJob" aria-expanded="false" data-toggle="collapse"> <i
                        class="icon-interface-windows"></i>งานครูเวร </a>
                <ul id="TeacherJob"
                    class="collapse list-unstyled <?=$this->uri->segment(1) == 'Teaching' ? 'show' : '' ?>">
                    <li
                        class="<?=$this->uri->segment(2) == 'CheckHomeRoomMain' || $this->uri->segment(2) == 'CheckHomeRoomAdd'|| $this->uri->segment(2) == 'CheckHomeRoomStatistics' ? 'active' : '' ?>">
                        <a href="<?=base_url('Teaching/CheckHomeRoomMain');?>">เช็ตชื่อหน้าประตูโรงเรียน</a>
                    </li>
                    <li class="<?=$this->uri->segment(2) == 'CheckTeaching' ? 'active' : '' ?>"><a href="<?=base_url('Teaching/CheckTeaching');?>">เช็ดชื่อการสอน</a></li>
                    <li class="<?=$this->uri->segment(2) == 'RoomOnlineMain' ? 'active' : '' ?>"><a href="<?=base_url('Teaching/RoomOnlineMain');?>">ห้องเรียนออนไลน์</a></li>
                </ul>
            </li> -->

            <li><a href="#TeacherLarn" aria-expanded="false" data-toggle="collapse"> <i
                        class="icon-interface-windows"></i>งานครูผู้สอน </a>
                <ul id="TeacherLarn"
                    class="collapse list-unstyled <?=$this->uri->segment(1) == 'Teaching' ? 'show' : '' ?>">
                    <li
                        class="<?=$this->uri->segment(2) == 'CheckHomeRoomMain' || $this->uri->segment(2) == 'CheckHomeRoomAdd'|| $this->uri->segment(2) == 'CheckHomeRoomDashboard' ? 'active' : '' ?>">
                        <a href="<?=base_url('Teaching/CheckHomeRoomMain');?>">เช็ตชื่อโฮมรูม</a>
                    </li>
                    <!-- <li class="<?=$this->uri->segment(2) == 'CheckTeaching' ? 'active' : '' ?>"><a href="<?=base_url('Teaching/CheckTeaching');?>">เช็ดชื่อการสอน</a></li>
                    <li class="<?=$this->uri->segment(2) == 'RoomOnlineMain' ? 'active' : '' ?>"><a href="<?=base_url('Teaching/RoomOnlineMain');?>">ห้องเรียนออนไลน์</a></li> -->
                </ul>
            </li>

            <li><a href="#TeacherSaveScore" aria-expanded="false" data-toggle="collapse"> <i
                        class="icon-interface-windows"></i>งานวัดผล </a>
                <ul id="TeacherSaveScore"
                    class="collapse list-unstyled <?=$this->uri->segment(1) == 'Register' ? 'show' : '' ?>">
                    <li
                        class="<?=$this->uri->segment(2) == 'SaveScoreMain' || $this->uri->segment(2) =='SaveScoreAdd' ? 'active' : '' ?>">
                        <a href="<?=base_url('Register/SaveScoreMain');?>">บันทึกผลการเรียน (ปกติ)</a></li>
                    <li
                        class="<?=$this->uri->segment(2) == 'LearnRepeatMain' || $this->uri->segment(2) =='LearnRepeatAdd' ? 'active' : '' ?>">
                        <a href="<?=base_url('Register/LearnRepeatMain');?>">บันทึกผลการเรียน (ซ้ำ)</a></li>
                </ul>
            </li>

            <li class=" <?=$this->uri->segment(1) == 'Course' ? 'active' : '' ?>">
                <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i
                        class="icon-interface-windows"></i>งานหลักสูตร </a>
                <ul id="exampledropdownDropdown"
                    class="collapse list-unstyled  <?=$this->uri->segment(1) == 'Course' ? 'show' : '' ?>">
                    <?php if($this->session->userdata('login_id') == 'pers_003' || $this->session->userdata('login_id') == 'pers_002') : ?>
                    <?php else : ?>
                    <li
                        class="<?=$this->uri->segment(1) == 'Course' && $this->uri->segment(2) == '' ? 'active' : '' ?>">
                        <a href="<?=base_url('Course');?>"><i class="fa fa-file" aria-hidden="true"></i>
                            ส่งแผนการสอน</a>
                    </li>
                    <li
                        class="<?=$this->uri->segment(1) == 'Course' && $this->uri->segment(2) == 'LoadPlan' ? 'active' : '' ?>">
                        <a
                            href="<?=base_url('Course/LoadPlan/'.$OnOff[0]->seplanset_year.'/'.$OnOff[0]->seplanset_term.'/All');?>"><i
                                class="fa fa-file" aria-hidden="true"></i>
                            ดาวน์โหลดแผน <?=$this->session->userdata('groupleade');?></a>
                    </li>
                    <?php endif; ?>

                    <?php if($this->session->userdata('groupleade') == "หัวหน้ากลุ่มสาระ" || $this->session->userdata('login_id') == 'pers_003' || $this->session->userdata('login_id') == 'pers_002' || $this->session->userdata('login_id') == 'pers_021') : ?>
                    <span class="heading">สำหรับหัวหน้า</span>
                    <li
                        class="<?=$this->uri->segment(1) == 'Course' && $this->uri->segment(2) == 'CheckPlan' ? 'active' : '' ?>">
                        <a href="<?=base_url('Course/CheckPlan');?>"> <i class="icon-flask"></i>ตรวจงาน /
                            ดาวน์โหลด </a>
                    </li>
                    <li
                        class="<?=$this->uri->segment(1) == 'Course' && $this->uri->segment(2) == 'ReportPlan' ? 'active' : '' ?>">
                        <a href="<?=base_url('Course/ReportPlan');?>"> <i class="fa fa-print"
                                aria-hidden="true"></i>รายงาน </a>
                        <!-- <a href="<?=base_url('Course/DownloadPlan');?>"> <i class="fa fa-print" aria-hidden="true"></i>ดาวน์โหลดแผน </a> -->
                    </li>
                    <li
                        class="<?=$this->uri->segment(1) == 'Course' && $this->uri->segment(2) == 'SettingTeacher' ? 'active' : '' ?>">
                        <?php if($this->session->userdata('login_id') == 'pers_014' || $this->session->userdata('login_id') == 'pers_021'): ?>
                        <a href="<?=base_url('Course/SettingTeacher');?>"> <i class="fa fa-cogs"></i>ตั้งค่าครูผู้สอน
                        </a>
                        <a href="<?=base_url('Course/Setting');?>"> <i class="fa fa-cogs"></i>ตั้งค่าระบบ </a>
                        <?php endif; ?>
                    </li>

                    <?php endif; ?>
                </ul>
            </li>
            <li class=" <?=$this->uri->segment(1) == 'p' ? 'active' : '' ?>">
                <a href="#"> <i class="icon-interface-windows"></i>งานประกันภายใน </a>
            </li>
        </ul>
        <span class="heading">งานกิจการนักเรียน</span>
        <ul class="list-unstyled">
            <li>
                <a href="#HelpStudent" aria-expanded="false" data-toggle="collapse"> <i
                        class="icon-interface-windows"></i>ระบบดูแลช่วยเหลือนักเรียน </a>
                <ul id="HelpStudent"
                    class="collapse list-unstyled <?=$this->uri->segment(1) == 'SupStd' ? 'show' : '' ?>">
                    <li class="<?=$this->uri->segment(2) == 'Main' ? 'active' : '' ?>">
                        <a href="<?=base_url('SupStd/Main');?>">เยี่ยมบ้าน / SDQ</a>
                    </li>
                    <?php if('pers_006' == $this->session->userdata('login_id') || 'pers_021' == $this->session->userdata('login_id')): ?>
                    <span class="heading">ตรวจงาน</span>
                    <li class="<?=$this->uri->segment(2) == 'CheckWorkManager' ? 'active' : '' ?>">
                        <a href="<?=base_url('SupStd/CheckWorkManager/2565');?>">หัวหน้างาน</a>
                    </li>
                    <!-- <li class="<?=$this->uri->segment(2) == 'CheckWorkExecutive' ? 'active' : '' ?>">
                        <a href="<?=base_url('SupStd/CheckWorkExecutive');?>">ผู้บริหาร</a>
                    </li> -->
                    <?php endif; ?>
                </ul>
            </li>
        </ul>

        <span class="heading">งานงบประมาณและแผน</span>
        <ul class="list-unstyled">
            <li class=" <?=$this->uri->segment(2) == 'Cooperative' ? 'active' : '' ?>">
                <a href="<?=base_url('BudgetPlan/Cooperative/Home')?>"> <i
                        class="icon-interface-windows"></i>สหกรณ์โรงเรียน(ครู) </a>
            </li>
        </ul>

    </nav>

    <div class="content-inner">