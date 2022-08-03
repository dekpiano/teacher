<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConTeacherHome extends CI_Controller {
var  $title = "หน้าแรก";
	public function __construct() {
		parent::__construct();
		
		if (empty($this->session->userdata('fullname')) && !$this->session->userdata('status') == 'admin') {      
			redirect('welcome','refresh');
		}
        $this->DBpersonnel = $this->load->database('personnel', TRUE); 
        $this->DBaffairs = $this->load->database('affairs', TRUE);
        $this->CheckHomeVisitManager = $this->DBaffairs->select('homevisit_set_id,homevisit_set_manager')->where('homevisit_set_id',1)->get('tb_homevisit_setting')->first_row();
    }

    public function TeacherHome(){      
        $data['title']  = "หน้าแรก";
        $data['CheckHomeVisitManager'] = $this->CheckHomeVisitManager;
        $data['teacher'] = $this->DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/home/index.php');
        $this->load->view('teacher/layout/footer_teacher.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }
}


?>
