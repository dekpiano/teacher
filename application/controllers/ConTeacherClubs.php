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

        $result = $this->db->get('tb_club_settings_schedule')->result_array();

        echo json_encode($result);

    }
}


?>
