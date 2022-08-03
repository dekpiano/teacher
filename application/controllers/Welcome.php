<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->session->unset_userdata('access_token');
		$this->session->sess_destroy();
	
		$data['title'] = "หน้าแรก";
        $data['description'] = "หน้าแรก";  
        $data['full_url'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $data['banner'] = "";
		
		$this->load->view('user/layout/HeaderUser.php',$data);
        $this->load->view('user/PageWelcomeAcademic.php');
		$this->load->view('user/layout/FooterUser.php');
	}

	public function LoginStudent()
	{
		$this->load->view('login/loginMain.php');
	}

	public function ClosePage()
	{
		$this->load->view('errors/ClosePage.php');
	}
}