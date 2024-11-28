<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConTeacherClubs extends CI_Controller {
var  $title = "ชุมนุม";
	public function __construct() {
		parent::__construct();
		
		if (empty($this->session->userdata('fullname')) && !$this->session->userdata('status') == 'admin') {      
			redirect('welcome','refresh');
		}
        $this->DBpersonnel = $this->load->database('personnel', TRUE); 
        $this->DBaffairs = $this->load->database('affairs', TRUE);
        $this->CheckHomeVisitManager = $this->DBaffairs->select('homevisit_set_id,homevisit_set_manager')->where('homevisit_set_id',1)->get('tb_homevisit_setting')->first_row();
    }

    public function ClubsMain(){      
        $data['title']  = "ระบบงานชุมนุม";
        $TeacherID = $this->session->userdata('login_id');
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        $data['teacher'] = $this->DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $data['ClubOnOff'] = $this->db->where('c_onoff_id',1)->get('tb_club_onoff')->row();


        $data['CheckClub'] = $this->db->select('
            skjacth_academic.tb_clubs.*,
            GROUP_CONCAT(CONCAT(tb_personnel.pers_prefix,tb_personnel.pers_firstname," ",tb_personnel.pers_lastname) SEPARATOR ", ") as advisors
        ')
        ->from('skjacth_academic.tb_clubs')
        ->join('skjacth_personnel.tb_personnel',"FIND_IN_SET(skjacth_personnel.tb_personnel.pers_id, REPLACE(skjacth_academic.tb_clubs.club_faculty_advisor, '|', ','))> 0",'left')
        ->where("FIND_IN_SET('$TeacherID', REPLACE(tb_clubs.club_faculty_advisor, '|', ',')) >",0)
        ->group_by('skjacth_academic.tb_clubs.club_id')->get()->row();

        $data['SummaryRegis'] = $this->db->select('
            tb_clubs.club_id,
            tb_clubs.club_name,
            tb_clubs.club_max_participants,
            Count(tb_club_members.member_id) AS RegisStudents,
            (tb_clubs.club_max_participants - Count(tb_club_members.member_id)) AS RemainingSpots
        ')->from('tb_clubs')
        ->join('tb_club_members','tb_club_members.member_club_id = tb_clubs.club_id','left')
        ->where('tb_clubs.club_id',$data['CheckClub']->club_id)
        ->group_by('tb_clubs.club_id')
        ->get()->row();

        //print_r($date['SummaryRegis']); exit();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/Clubs/ClubMain.php');
        $this->load->view('teacher/layout/footer_teacher.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }

    public function ViewClubRegister(){

        $this->db->select('
        tb_club_members.member_join_date,
        tb_club_members.member_id,
        tb_students.StudentNumber,
        tb_students.StudentClass,
        tb_students.StudentCode,
        CONCAT(tb_students.StudentPrefix,tb_students.StudentFirstName," ",tb_students.StudentLastName) AS FullnameStu
        ');
        $this->db->from('tb_club_members');
        $this->db->join('tb_students','tb_students.StudentID = tb_club_members.member_student_id');
        $this->db->where('member_club_id', $this->input->post('clubid'));
        $this->db->order_by('StudentClass,StudentCode','ASC');

        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);
    }

    public function ViewClubActivity(){
        $data['ClubOnOff'] = $this->db->where('c_onoff_id',1)->get('tb_club_onoff')->row();
        $result = $this->db->select('
            tb_club_recoed_activity.trca_schedule_id,
            tb_club_settings_schedule.tcs_schedule_id,
            tb_club_settings_schedule.tcs_start_date,
            tb_club_settings_schedule.tcs_week_number,
            tb_club_settings_schedule.tcs_week_status,
            tb_club_settings_schedule.tcs_academic_year,
            tb_club_recoed_activity.tcra_ma,
            tb_club_recoed_activity.tcra_khad,
            tb_club_recoed_activity.tcra_rapwy,
            tb_club_recoed_activity.tcra_rakic,
            tb_club_recoed_activity.tcra_kickrrm
        ')
        ->from('tb_club_settings_schedule')
        ->join('tb_club_recoed_activity','tb_club_recoed_activity.trca_schedule_id = tb_club_settings_schedule.tcs_schedule_id','left')
        ->where('tcs_academic_year',$data['ClubOnOff']->c_onoff_year)
        ->get()->result_array();

        echo json_encode($result);

    }

    public function ViewDataRecordStudyTime(){

        $this->db->select('
        tb_club_members.member_join_date,
        tb_club_members.member_id,
        tb_students.StudentNumber,
        tb_students.StudentID,
        tb_students.StudentClass,
        tb_students.StudentCode,
        CONCAT(tb_students.StudentPrefix,tb_students.StudentFirstName," ",tb_students.StudentLastName) AS FullnameStu
        ');
        $this->db->from('tb_club_members');
        $this->db->join('tb_students','tb_students.StudentID = tb_club_members.member_student_id','left');
        $this->db->where('member_club_id', $this->input->post('clubid'));
        $this->db->order_by('StudentClass,StudentCode','ASC');

        $query = $this->db->get();
        $result = $query->result_array();

        $GetStatus = $this->db->where('trca_schedule_id',$this->input->post('scheduleid'))
        ->where('tcra_club_id',$this->input->post('clubid'))
        ->get('tb_club_recoed_activity')->row();

        echo json_encode(["StuList" => $result,"GetStatus" => $GetStatus]);
    }

    public function ClubInsertRecodeActivity(){

        if(!empty($this->input->post())){
            $status = $this->input->post('status');
            // สร้าง Array สำหรับจัดกลุ่ม
                $groupedData = array();

                foreach ($status as $key => $value) {
                    // ตรวจสอบว่ามีคีย์ของสถานะในกลุ่มหรือยัง ถ้าไม่มีก็สร้าง
                    if (!isset($groupedData[$value])) {
                        $groupedData[$value] = array();
                    }
                    // เพิ่มคีย์ (ID) เข้าไปในกลุ่มที่ตรงกับสถานะ
                    $groupedData[$value][] = $key;
                }
                $CkeckMa = ($groupedData['มา'] ?? '');
                $Ma = is_array($CkeckMa) ? implode("|", $CkeckMa) : '';
                $CkeckKhad = ($groupedData['ขาด'] ?? '');
                $Khad = is_array($CkeckKhad) ? implode("|", $CkeckKhad) : '';
                $CkeckRapwy = ($groupedData['ลาป่วย'] ?? '');
                $Rapwy = is_array($CkeckRapwy) ? implode("|", $CkeckRapwy) : '';
                $CkeckRakic = ($groupedData['ลากิจ'] ?? '');
                $Rakic = is_array($CkeckRakic) ? implode("|", $CkeckRakic) : '';
                $CkeckKickrrm = ($groupedData['กิจกรรม'] ?? '');
                $Kickrrm = is_array($CkeckKickrrm) ? implode("|", $CkeckKickrrm) : '';
            

            $data = [
                'tcra_club_id' =>  $this->input->post('clubid'),
                'tcra_teac_id' => $this->session->userdata('login_id'),
                'trca_schedule_id' => $this->input->post('scheduleid'), // วันที่
                'tcra_ma'      => $Ma,           // สถานะ "มา" จะเก็บในรูปแบบ "3691|3706|3713"
                'tcra_khad'     => $Khad,                 // กำหนดค่าว่างถ้าไม่มีข้อมูล
                'tcra_rapwy'  => $Rapwy,                 // กำหนดค่าว่างถ้าไม่มีข้อมูล
                'tcra_rakic'   => $Rakic,
                'tcra_kickrrm'   => $Kickrrm                   // กำหนดค่าว่างถ้าไม่มีข้อมูล
            ];
            $result = $this->db->insert('tb_club_recoed_activity', $data);
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'บันทึกข้อมูลสำเร็จ',"InsertedId"=>$this->db->insert_id()]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล']);
            }
        }else {
            echo json_encode(['status' => 'error', 'message' => 'ไม่มีข้อมูลส่งมา']);
        }

    }

    public function CheckRecoedActivity(){
       
        $result = $this->db->where('trca_schedule_id',$this->input->post('recoedID'))->get('tb_club_recoed_activity')->row();

        echo $result->tcra_id ?? "";
    }

    public function ClubUpdateRecodeActivity(){

        if(!empty($this->input->post())){
            $status = $this->input->post('status');
            // สร้าง Array สำหรับจัดกลุ่ม
                $groupedData = array();

                foreach ($status as $key => $value) {
                    // ตรวจสอบว่ามีคีย์ของสถานะในกลุ่มหรือยัง ถ้าไม่มีก็สร้าง
                    if (!isset($groupedData[$value])) {
                        $groupedData[$value] = array();
                    }
                    // เพิ่มคีย์ (ID) เข้าไปในกลุ่มที่ตรงกับสถานะ
                    $groupedData[$value][] = $key;
                }
                $CkeckMa = ($groupedData['มา'] ?? '');
                $Ma = is_array($CkeckMa) ? implode("|", $CkeckMa) : '';
                $CkeckKhad = ($groupedData['ขาด'] ?? '');
                $Khad = is_array($CkeckKhad) ? implode("|", $CkeckKhad) : '';
                $CkeckRapwy = ($groupedData['ลาป่วย'] ?? '');
                $Rapwy = is_array($CkeckRapwy) ? implode("|", $CkeckRapwy) : '';
                $CkeckRakic = ($groupedData['ลากิจ'] ?? '');
                $Rakic = is_array($CkeckRakic) ? implode("|", $CkeckRakic) : '';
                $CkeckKickrrm = ($groupedData['กิจกรรม'] ?? '');
                $Kickrrm = is_array($CkeckKickrrm) ? implode("|", $CkeckKickrrm) : '';
            

            $data = [
                'tcra_club_id' =>  $this->input->post('clubid'),
                'tcra_teac_id' => $this->session->userdata('login_id'),
                'trca_schedule_id' => $this->input->post('scheduleid'), // วันที่
                'tcra_ma'      => $Ma,           // สถานะ "มา" จะเก็บในรูปแบบ "3691|3706|3713"
                'tcra_khad'     => $Khad,                 // กำหนดค่าว่างถ้าไม่มีข้อมูล
                'tcra_rapwy'  => $Rapwy,                 // กำหนดค่าว่างถ้าไม่มีข้อมูล
                'tcra_rakic'   => $Rakic,
                'tcra_kickrrm'   => $Kickrrm                   // กำหนดค่าว่างถ้าไม่มีข้อมูล
            ];
            $this->db->where('tcra_id',$this->input->post("recordId"));
            $result = $this->db->update('tb_club_recoed_activity', $data);
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'แก้ไขข้อมูลสำเร็จ',"InsertedId"=>$this->input->post("recordId")]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล']);
            }
        }else {
            echo json_encode(['status' => 'error', 'message' => 'ไม่มีข้อมูลส่งมา']);
        }

    }

}


?>
