<?php
class ModTeacherProfile extends CI_Model
{
	protected $DBPers;
	public function __construct()
	{
		parent::__construct();	
		$this->DBPers = $this->load->database('personnel', TRUE);	
	}

	public function personnel_update($data)	{
	
		return $this->DBPers->update('tb_personnel',$data,"pers_id='".$this->session->userdata('login_id')."'");
	}
		

	public function teacher_resetpassword($data,$id)
	{		
		return $this->DBPers->update('tb_personnel',$data,"pers_id='".$id."'");
	}

	public function teacher_changepassword($data)
	{		
        $this->DBPers->update('tb_personnel',array('pers_changepassword' => 'YES'),"pers_id='".$this->session->userdata('login_id')."'");
		return $this->DBPers->update('tb_personnel',$data,"pers_id='".$this->session->userdata('login_id')."'");
	}

	public function teacher_UpdateSocial($data)
	{
		return $this->DBPers->update('tb_personnel',$data,"pers_id='".$this->session->userdata('login_id')."'");
	}

	public function teacher_profile_Privateinfo($data)
	{
		return $this->DBPers->update('tb_personnel',$data,"pers_id='".$this->session->userdata('login_id')."'");
	}

	public function teacher_ChangeNumber($data,$id)
	{
		return $this->DBPers->update('tb_personnel',$data,"pers_id='".$id."'");
	}

	public function teacher_CheckName($frist,$last)
	{
		return $this->DBPers->select('pers_firstname,pers_lastname')
						->where('pers_firstname',$frist)
						->where('pers_lastname',$last)
						->from('tb_personnel')
						->get()->num_rows();
	}


}