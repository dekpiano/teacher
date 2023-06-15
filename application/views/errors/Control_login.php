<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control_login extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Model_login');
	}

	public static $title = "เข้าสู่ระบบ";
	public static $description = "ระบบ Login โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์";
 	
 	public function dataAll(){
		$data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
 		$data['title'] = self::$title;
		$data['description'] = self::$description; 		

		return $data;
 	}

	public function Login_main()
	{
		if(!empty(get_cookie('username_cookie')) && !empty(get_cookie('password_cookie')) ){
					 redirect('Logout');				
		}else{
			$data = $this->dataAll();
					$this->load->view('login/loginMain.php');
		}
	}

	public function LoginStudent(){
		
        $data['title'] = "Login สำหรับนักเรียน";
        $data['description'] = "Login สำหรับนักเรียน";  
        $data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $data['banner'] = "";
		$this->load->view('user/layout/HeaderUser.php',$data);
        $this->load->view('user/Login/PageLoginStudent.php');
        $this->load->view('user/layout/FooterUser.php');
		
		// $this->load->view('login/loginStudent.php');
	}

	public function LoginTeacher1(){
		$this->load->view('login/loginTeacher.php');
	}

	public function check_student()
	{	
		    
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
 
			if($this->input->server('REQUEST_METHOD') == TRUE){
				if($this->Model_login->record_count_student($username, $password) == 1)
				{
					$result = $this->Model_login->fetch_student_login($username, $password);
					$this->session->set_userdata(array('login_id' => $result->StudentID,'StudentCode' => $result->StudentCode,'fullname'=> $result->StudentPrefix.$result->StudentFirstName.' '.$result->StudentLastName,'status'=> 'user','class' => $result->StudentClass));

					set_cookie('username_cookie',$username,'3600'); 
					set_cookie('password_cookie',$password,'3600');

					$this->session->set_userdata(array('login_id' => $result->StudentID,'StudentCode' => $result->StudentCode,'fullname'=> $result->StudentPrefix.$result->StudentFirstName.' '.$result->StudentLastName,'status'=> 'user'));

				 redirect('Student/Home');
					//echo "Yes";

				}
				else
				{
					$this->session->set_flashdata(array('status'=>'OK','msgerr'=> 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง','alert'=>'error'));
					// redirect('login');

					redirect('LoginStudent');
				}
			}
	}

	public function check_teacher()
	{	
			$username = $this->input->post('username');
			$password = md5(md5($this->input->post('password')));
			
			//print_r($password);exit();
			
			
			if($this->input->server('REQUEST_METHOD') == TRUE){
				if($this->Model_login->record_count_teacher1($username, $password) == 1)
				{

					$result = $this->Model_login->fetch_teacher_login1($username, $password);
					$this->session->set_userdata(array('login_id' => $result->pers_id,'pers_learning' => $result->pers_learning,'fullname'=> $result->pers_prefix.$result->pers_firstname.' '.$result->pers_lastname,'status'=> 'admin','class' => $result->StudentClass,'img' => $result->pers_img,'groupleade'=>$result->pers_groupleade,'CheckStatusPassword'=>$result->pers_changepassword));

					set_cookie('username_cookie',$username,'3600'); 
					set_cookie('password_cookie',$password,'3600');

				 redirect('Home');
					//echo "Yes";
				}
				else
				{					
					$this->session->set_flashdata(array('status'=>'OK','msgerr'=> 'ชื่อผู้ใช้งานหรือรหัสผ่าน ไม่ถูกต้อง หรือ ไม่ข้อมูลในระบบ กรุณาติดต่อเจ้าหน้าที่คอม','alert'=>'error'));
					// redirect('login');
					redirect('LoginTeacher');
					//print($this->Model_login->record_count_teacher1($username, $password));
				}
			}
	}	

	function LoginTeacherMain(){
		$login_button = '
			<a href="'.$google_client->createAuthUrl().'"><img src="'.base_url('assets/images/btn_google_signin.png').'" alt="Google logo"></a>
			';
		$data['login_button'] = $login_button;
		$data['title'] = "Login สำหรับครูผู้สอน";
		$data['description'] = "Login สำหรับครูผู้สอน";  
		$data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	
		$this->load->view('user/layout/HeaderUser.php',$data);
		$this->load->view('user/Login/PageLoginTeacher.php');
		$this->load->view('user/layout/FooterUser.php');
	}
	
	function LoginTeacher(){
		include_once APPPATH . "libraries/vendor/autoload.php";
		$google_client = new Google_Client();

		$google_client->setClientId('29638025169-aeobhq04v0lvimcjd27osmhlpua380gl.apps.googleusercontent.com');
		$google_client->setClientSecret('RSANANTRl84lnYm54Hi0icGa');
		$google_client->setRedirectUri('https://teacher.skj.ac.th/LoginTeacher');
		$google_client->addScope('email');
		$google_client->addScope('profile');

		$login_button = '
			<a href="'.$google_client->createAuthUrl().'"><img src="'.base_url('assets/images/btn_google_signin.png').'" alt="Google logo"></a>
			';
		
		if(isset($_GET["code"])){
			$token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
			if(!isset($token["error"])){				
				$this->session->set_userdata('access_token',$token['access_token']);
				$google_service = new Google_Service_Oauth2($google_client);

				$data = $google_service->userinfo->get();
				$current_datetime = date('Y-m-d H:i:s');			

				// echo $this->Model_login->check_login_teacher($data['email']); 
				if($this->Model_login->check_login_teacher($data['email']) == 1)
   				 {
					$google_client->setAccessToken($token['access_token']);
					$user_data = array(				 
						'pers_username' => $data['email'],
						'updated_at' => $current_datetime,
						'login_oauth_uid' => $data['id']
					);			
				   $this->Model_login->Update_user_data($user_data, $data['email']);

				   $result = $this->Model_login->fetch_teacher_login($data['email']);
				   $this->session->set_userdata(array('login_id' => $result->pers_id,'pers_learning' => $result->pers_learning,'fullname'=> $result->pers_prefix.$result->pers_firstname.' '.$result->pers_lastname,'status'=> 'admin','img' => $result->pers_img,'groupleade'=>$result->pers_groupleade));
				   redirect('Home');
				}else{
					$this->session->unset_userdata('access_token');

					$this->session->set_flashdata(array('msg'=>'OK','messge'=> 'ระบบนี้ใช้ได้แค่อีเมลโรงเรียนที่ลงทะเบียนเท่านั้น กรุณาติดต่อเจ้าหน้าที่คอม','alert'=>'error'));
				
				}
			}
		}
					
			
			$data['login_button'] = $login_button;
			$data['title'] = "Login สำหรับครูผู้สอน";
			$data['description'] = "Login สำหรับครูผู้สอน";  
			$data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$data['banner'] = "";

			// $this->load->view('user/layout/HeaderUser.php',$data);
			// $this->load->view('user/Login/PageLoginTeacher.php');
			// $this->load->view('user/layout/FooterUser.php');
			
			$this->load->view('login/loginTeacher.php',$data);
		
		
		
	}

	public function LoginAdmin()
	{	
			$username = $this->input->post('username');
			$password = md5(md5($this->input->post('password')));
			
		
			if($this->input->server('REQUEST_METHOD') == TRUE){
				if($this->Model_login->record_count_teacher1($username, $password) == 1)
				{

					$result = $this->Model_login->fetch_teacher_login1($username, $password);
					$this->session->set_userdata(array('login_id' => $result->pers_id,'pers_learning' => $result->pers_learning,'fullname'=> $result->pers_prefix.$result->pers_firstname.' '.$result->pers_lastname,'status'=> 'admin','class' => $result->StudentClass,'img' => $result->pers_img,'groupleade'=>$result->pers_groupleade,'CheckStatusPassword'=>$result->pers_changepassword));

					set_cookie('username_cookie',$username,'3600'); 
					set_cookie('password_cookie',$password,'3600');

				 redirect('Admin/Home');
					//echo "Yes";

				}
				else
				{					
					//$this->session->set_flashdata(array('status'=>'OK','msgerr'=> 'ชื่อผู้ใช้งานหรือรหัสผ่าน ไม่ถูกต้อง หรือ ไม่ข้อมูลในระบบ กรุณาติดต่อเจ้าหน้าที่คอม','alert'=>'error'));
					// redirect('login');
					redirect('welcome');
					//print($this->Model_login->record_count_teacher1($username, $password));
				}
			}
	}	


	public function logout()
	{
		
		delete_cookie('username_cookie'); 
		delete_cookie('password_cookie'); 
		$this->session->sess_destroy();
		redirect('LoginStudent', 'refresh');
	}

	public function LogoutTeacher()
	{
		delete_cookie('username_cookie'); 
		delete_cookie('password_cookie'); 
		$this->session->sess_destroy();
		redirect('LoginTeacher', 'refresh');
	}


	function logoutGoogle()
	{
	$this->session->unset_userdata('access_token');

	$this->session->unset_userdata('user_data');
	$this->session->sess_destroy();

	redirect('LoginTeacher', 'refresh');
	}

}