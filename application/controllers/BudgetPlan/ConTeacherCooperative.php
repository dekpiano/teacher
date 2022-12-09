<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConTeacherCooperative extends CI_Controller {
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

    public function CooperativeMain(){      
        $data['title']  = "สหกรณ์โรงเรียน";
        $data['CheckHomeVisitManager'] = $this->CheckHomeVisitManager;
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        $data['teacher'] = $this->DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/BudgetPlan/Cooperative/CooperativeMain.php');
        $this->load->view('teacher/layout/footer_teacher.php');
        
    }

    public function CooperativeShareCapital(){      
        $data['title']  = "ทุนเรือนหุ้ม";
        $data['CheckHomeVisitManager'] = $this->CheckHomeVisitManager;
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        $data['teacher'] = $this->DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/BudgetPlan/Cooperative/CooperativeMain.php');
        $this->load->view('teacher/layout/footer_teacher.php');        
    }
}


?>
