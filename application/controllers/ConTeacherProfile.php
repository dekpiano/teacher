<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConTeacherProfile extends CI_Controller {
    protected $DBPers;
	public function __construct() {
		parent::__construct();
		
		if (empty($this->session->userdata('fullname')) && !$this->session->userdata('status') == 'admin') {      
			redirect('welcome','refresh');
		}
        $this->load->model('teacher/ModTeacherProfile');
        $this->DBPers = $this->load->database('personnel', TRUE);	
    }

    public function ProfileMain(){      
        $data['title']  = "หน้าแรก";
        $data['pers'] = $this->DBPers->select('*')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/profile/teacher_profile.php');
        $this->load->view('teacher/layout/footer_teacher.php');

        // delete_cookie('username_cookie'); 
		// delete_cookie('password_cookie'); 
        // $this->session->sess_destroy();
        
    }

	public function chang_date_thai($value)
	{		
		$date  = explode(" ",$value);
		list($d,$m,$y) = explode("-",$date[0]);			
		$date1 = ($y-543).'-'.$m.'-'.$d;
		return $date1;	
	}

	public function chang_date_thai_pass($value)
	{		
		$date  = explode(" ",$value);
		list($d,$m,$y) = explode("-",$date[0]);			
		$date1 = $d.$m.($y);
		return $date1;	
	}

	public function chang_date_eng($value)
	{
		$date  = explode(" ",$value);
		list($y,$m,$d) = explode("-",$date[0]);			
		$date1 = $d.$m.($y+543);
		return $date1;
		
	}

    	
	public function reset_password($id)
	{	
		$data = $this->DBPers->where('pers_id',$id)->get('tb_personnel')->result();
		$date_thai = $this->chang_date_eng($data[0]->pers_britday);
		//print_r($date_thai);exit();
		$reset = array('pers_password' => md5(md5($date_thai)));
		$this->ModTeacherProfile->teacher_resetpassword($reset,$id);
		redirect('admin/control_admin_teacher/edit_teacher/'.$id);
	}

	public function change_pass()
	{
		$reset = array('pers_password' => md5(md5($this->input->post('password'))));
		echo $this->ModTeacherProfile->teacher_changepassword($reset);

        $this->session->set_userdata('CheckStatusPassword','YES');		
	}


	function profile_teacher(){
		$data['title'] = $this->title;
		$data['menu'] =	$this->db->get('tb_adminmenu')->result();		
		$this->DBPers->select('*');
		$this->DBPers->from('tb_personnel');
		$this->DBPers->join($this->DBSKJ->database.'.tb_position','tb_personnel.pers_position = tb_position.posi_id');
		$this->DBPers->join($this->DBSKJ->database.'.tb_learning','tb_personnel.pers_learning = tb_learning.lear_id','LEFT');
		$this->DBPers->where('pers_id',$this->session->userdata('login_id'));
		$data['pers'] =	$this->DBPers->get()->result();

		$this->load->view('admin/layout/header.php',$data);
		$this->load->view('admin/layout/navber.php');

		$this->load->view('admin/teacher/admin_teacher_profile.php');

		$this->load->view('admin/layout/footer.php');
	}

	function updateSocial_teacher(){

		$pers_facebook = ($this->input->post('pers_facebook') == '' ? '' : $this->input->post('pers_facebook') );
		$pers_instagram = ($this->input->post('pers_instagram') == '' ? '' : $this->input->post('pers_instagram') );
		$pers_youtube = ($this->input->post('pers_youtube') == '' ? '' : $this->input->post('pers_youtube') );
		$pers_line = ($this->input->post('pers_line') == '' ? '' : $this->input->post('pers_line') );
		$pers_twitter = ($this->input->post('pers_twitter') == '' ? '' : $this->input->post('pers_twitter') );

		$data = array('pers_facebook' =>  $pers_facebook,
						'pers_instagram' => $pers_instagram,
						'pers_youtube' => $pers_youtube,
						'pers_line' => $pers_line ,
						'pers_twitter' => $pers_twitter);
		$this->ModTeacherProfile->teacher_UpdateSocial($data);
		$this->session->set_flashdata(array('msg'=> 'YES','messge' => 'อัปเดพข้อมูลสำเร็จ','status'=>'success'));
		redirect('Teacher/Profile');
	}

	function profile_update_Privateinfo_personnel(){
		$data = array(	
			'pers_prefix' => $this->input->post('pers_prefix'),
			'pers_firstname' => $this->input->post('pers_firstname'),
			'pers_lastname' => $this->input->post('pers_lastname'),
			'pers_britday' => $this->chang_date_thai($this->input->post('pers_britday')),
			'pers_address' => $this->input->post('pers_address'),
			'pers_phone' => $this->input->post('pers_phone'),
			'pers_userEdit' => $this->session->userdata('login_id')
		);
			if($this->ModTeacherProfile->personnel_update($data) == 1){
				echo "1";
			}

	}

}




?>
