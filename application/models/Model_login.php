<?php
class Model_login extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
	}

	public function record_count_student($username,$password)
	{
		$this->db->where('StudentCode',$username);
		$this->db->where('StudentIDNumber',$password);
		return $this->db->count_all_results('tb_students');
	}

	public function fetch_student_login($username,$password)
	{
		$this->db->where('StudentCode',$username);
		$this->db->where('StudentIDNumber',$password);
		$query = $this->db->get('tb_students');
		return $query->row();
	}

	public function record_count_teacher1($username,$password)
	{
		$DBpersonnel = $this->load->database('personnel', TRUE); 
		$DBpersonnel->where('pers_username',$username);
		$DBpersonnel->where('pers_password',$password);
		return $DBpersonnel->count_all_results('tb_personnel');
	}

	public function fetch_teacher_login1($username,$password)
	{
		$DBpersonnel = $this->load->database('personnel', TRUE); 
		$DBpersonnel->where('pers_username',$username);
		$DBpersonnel->where('pers_password',$password);
		$query = $DBpersonnel->get('tb_personnel');
		return $query->row();
	}

	public function record_count_admin($username,$password)
	{
		$DBpersonnel = $this->load->database('personnel', TRUE); 
		$DBpersonnel->where('pers_username',$username);
		$DBpersonnel->where('pers_password',$password);
		return $DBpersonnel->count_all_results('tb_personnel');
	}

	public function fetch_admin_login($username,$password)
	{
		$DBpersonnel = $this->load->database('personnel', TRUE); 
		$DBpersonnel->where('pers_username',$username);
		$DBpersonnel->where('pers_password',$password);
		$query = $DBpersonnel->get('tb_personnel');
		return $query->row();
	}

	public function check_login_teacher($email)
	{
		$DBpersonnel = $this->load->database('personnel', TRUE); 
		$DBpersonnel->where('pers_username',$email);
		$query = $DBpersonnel->get('tb_personnel');
		return $query->num_rows();
	}

	function fetch_teacher_login($id)
	{
		$YearThis = $this->db->select('schyear_year')->get('tb_schoolyear')->row();
		$Year = explode('/',$YearThis->schyear_year); 		
		$DBpersonnel = $this->load->database('personnel', TRUE); 
		$query = $DBpersonnel->select('
		skjacth_academic.tb_regclass.Reg_Class,
		skjacth_academic.tb_regclass.Reg_Year,
		skjacth_personnel.tb_personnel.pers_id,
		skjacth_personnel.tb_personnel.pers_prefix,
		skjacth_personnel.tb_personnel.pers_firstname,
		skjacth_personnel.tb_personnel.pers_lastname,
		skjacth_personnel.tb_personnel.pers_position,
		skjacth_personnel.tb_personnel.pers_department,
		skjacth_personnel.tb_personnel.pers_learning,
		skjacth_personnel.tb_personnel.pers_img,
		skjacth_personnel.tb_personnel.pers_groupleade
		')
		->from('skjacth_personnel.tb_personnel')
		->join('skjacth_academic.tb_regclass','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_regclass.class_teacher')
		->where('pers_username', $id)
		->where('Reg_Year', $Year[1])
		->get();
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	function Update_user_data($data, $id)
		{
		$DBpersonnel = $this->load->database('personnel', TRUE); 
		$DBpersonnel->where('pers_username', $id);
		$DBpersonnel->update('tb_personnel', $data);
		}

}