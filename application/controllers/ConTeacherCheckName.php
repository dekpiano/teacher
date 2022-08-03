<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConTeacherCheckName extends CI_Controller {
var  $title = "หน้าแรก";
	public function __construct() {
		parent::__construct();
		
		if (empty($this->session->userdata('fullname')) && !$this->session->userdata('status') == 'admin') {      
			redirect('welcome','refresh');
		}
        // if($this->session->userdata('CheckStatusPassword') == ""){
        //     redirect('Teacher/Profile','refresh');
        // }
//echo $this->session->userdata('fullname'); exit();
    }

    public function CheckHomeRoom(){      
        $data['title']  = "โฮมรูม";
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['teacher'] = $this->db->select('skjacth_personnel.tb_personnel.pers_prefix,
                                            skjacth_personnel.tb_personnel.pers_firstname,
                                            skjacth_personnel.tb_personnel.pers_lastname,
                                            skjacth_personnel.tb_personnel.pers_id,
                                            skjacth_academic.tb_regclass.Reg_Year,
                                            skjacth_academic.tb_regclass.Reg_Class')
                                            ->join($DBpersonnel->database.'.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_regclass.class_teacher')
                                            ->where('pers_id',$this->session->userdata('login_id'))
                                            ->get('tb_personnel')->result();
        print_r($data['teacher']); exit();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/CheckName/CheckHomeRoom.php');
        $this->load->view('teacher/layout/footer_teacher.php');
        
    }

    public function CheckTeaching(){      
        $data['title']  = "เช็คชื่อการสอน";
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['teacher'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/CheckName/CheckHomeRoom.php');
        $this->load->view('teacher/layout/footer_teacher.php');
        
    }
}


?>
