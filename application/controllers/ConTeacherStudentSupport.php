<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConTeacherStudentSupport extends CI_Controller {
var  $title = "หน้าแรก";

	public function __construct() {
		parent::__construct();
		if (empty($this->session->userdata('fullname')) && !$this->session->userdata('status') == 'admin') {      
			redirect('welcome','refresh');
		}
        $this->DBpersonnel = $this->load->database('personnel', TRUE); 
        $this->DBaffairs = $this->load->database('affairs', TRUE);
        $this->CheckHomeVisitManager = $this->DBaffairs->select('homevisit_set_id,homevisit_set_manager,homevisit_set_onoff')->where('homevisit_set_id',1)->get('tb_homevisit_setting')->first_row();
    }

    public function SupStdMain(){      
        $data['title']  = "หน้าหลักเยี่ยมบ้านนักเรียน";  
        $data['CheckOnOff'] = $this->CheckHomeVisitManager;
        $schoolyear = $this->db->select('*')->get('tb_schoolyear')->result();
        $ValueSchoolYear = explode('/',$schoolyear[0]->schyear_year);
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        $data['CClass'] = $CClass = $this->db->where('class_teacher',$this->session->userdata('login_id'))->get('tb_regclass')->result();
        if(!isset($CClass[0]->Reg_Class)){
            //echo 'ยังไม่ได้ประจำชั้นเรียน กรุณาเพิ่มชั้นเรียนก่อน โดยติดต่อเจ้าหน้าที่'; exit();
            $this->session->set_flashdata(array('msg'=> 'YES','messge' => 'ยังไม่ได้ประจำชั้นเรียน กรุณาเพิ่มชั้นเรียนก่อน โดยติดต่อผู้ดูแลระบบ','status'=>'error'));
           // redirect('Teacher/SupStdMain');exit();
        }else{
            $checkStatus = strlen($CClass[0]->Reg_Class);
            if($checkStatus == 3){
                $data['AllAffairs'] = $this->DBaffairs->where('s_homevisit_teac_id',$this->session->userdata('login_id'))
                ->or_where('s_homevisit_teac_id2',$this->session->userdata('login_id'))
                ->or_where('s_homevisit_teac_id3',$this->session->userdata('login_id'))
                ->order_by('s_homevisit_year','DESC')->get('tb_homevisit_send')->result();
               //echo '<pre>'; print_r($data['AllAffairs']); exit();
            }elseif($checkStatus == 1){           
                $data['AllAffairs'] = $this->DBaffairs
                ->where('s_homevisit_year',$ValueSchoolYear[1])
                ->order_by('s_homevisit_year','DESC')
                ->get('tb_homevisit_send')->result();
            }
        }
        $data['teacher'] = $this->DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();

        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/StudentSupport/SupStdMain.php');
        $this->load->view('teacher/layout/footer_teacher.php');
        
    }

    public function SupStdAdd(){  
        $YearThis = $this->db->select('schyear_year')->get('tb_schoolyear')->row();
		$Year = explode('/',$YearThis->schyear_year); 		

        $CClass = $this->db->where('class_teacher',$this->session->userdata('login_id'))->get('tb_regclass')->result();
        $TeacherCare = $this->db->select('class_teacher')
        ->where('Reg_Class',$this->session->userdata('class'))
        ->where('Reg_Year',$Year[1])
        ->get('tb_regclass')->result();
        $Value_TeacherCare = array();
        foreach ($TeacherCare as $key => $value) {
            array_push($Value_TeacherCare,$value->class_teacher);
        }
        
        $CheckClsss = $this->DBaffairs
                        ->where('s_homevisit_class',$CClass[0]->Reg_Class)
                        ->where('s_homevisit_year',$this->input->post('s_homevisit_year'))
                        ->get('tb_homevisit_send')
                        ->num_rows();
       // echo '<pre>'; print_r(count($TeacherCare) <= 2 ? 0 : $Value_TeacherCare[2]);  exit();
        if($CheckClsss > 0){
            $this->session->set_flashdata(array('status'=>'info','msg'=>'YES','messge'=>'ข้อมูลซ้ำ ,ได้บันทึกไว้แล้ว กรุณาตรวจสอบอีกครั้ง'));
            redirect('SupStd/Main');
        }else{
            $data = array('s_homevisit_year' => $year = $this->input->post('s_homevisit_year'),
            's_homevisit_class' => $this->session->userdata('class'),
            's_homevisit_date' => date('Y-m-d H:i:s'),
            's_homevisit_statuslevelhead' => "รอตรวจ",
            's_homevisit_teac_id' => $Value_TeacherCare[0],
            's_homevisit_teac_id2' => $Value_TeacherCare[1],
            's_homevisit_teac_id3' => count($TeacherCare) <= 2 ? 0 : $Value_TeacherCare[2]); 
            $add = $this->DBaffairs->insert('tb_homevisit_send',$data);
            if($add){
            $this->session->set_flashdata(array('status'=>'success','msg'=>'YES','messge'=>'บันทึกข้อมูลไว้แล้ว และให้เพิ่มไฟล์ตามเมนูที่กำหนด โดยคลิกไอคอน <label class="badge badge-warning h6"><i class="fa fa-upload" aria-hidden="true"></i></label>  อัพโหลดไฟล์'));
            redirect('SupStd/Main');
            }
        }
        
    }
    public function Add_filecoversheet(){ 
        //echo var_dump(is_dir("./uploads/affairs/helpstd/filecoversheet/")); exit();
        $AffID= $this->input->post('AffID'); 
        $delfile = $this->DBaffairs->select('s_homevisit_id,s_homevisit_filecoversheet')->where('s_homevisit_id',$AffID)->get('tb_homevisit_send')->result();   
        if($delfile[0]->s_homevisit_filecoversheet != NULL){
            unlink('./uploads/affairs/helpstd/filecoversheet/'.$delfile[0]->s_homevisit_filecoversheet);
        }     
        $config['upload_path']= "./uploads/affairs/helpstd/filecoversheet/";
        $config['allowed_types']='*';
        $config['file_name'] = date('YmdHis').'_'.$_FILES["s_homevisit_filecoversheet"]['name'];
         
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if($this->upload->do_upload("s_homevisit_filecoversheet")){
            $data = array('upload_data' => $this->upload->data());
            $image= $data['upload_data']['file_name'];         
                      
             $arrayName = array('s_homevisit_filecoversheet' =>$image);
            $result= $this->DBaffairs->update('tb_homevisit_send',$arrayName,'s_homevisit_id='.$AffID);
            echo json_decode($AffID);
        }else{
            print_r($this->upload->display_errors()); 
        }
    }

    public function Add_homevisit_fileSDQ(){ 
        $AffID= $this->input->post('AffID'); 
        $delfile = $this->DBaffairs->select('s_homevisit_id,s_homevisit_fileSDQ')->where('s_homevisit_id',$AffID)->get('tb_homevisit_send')->result();   
        if($delfile[0]->s_homevisit_fileSDQ != NULL){
            unlink('./uploads/affairs/helpstd/fileSDQ/'.$delfile[0]->s_homevisit_fileSDQ);
        } 
        $config['upload_path']= "./uploads/affairs/helpstd/fileSDQ/";
        $config['allowed_types']='*';
        $config['file_name'] = date('YmdHis').'_'.$_FILES["s_homevisit_fileSDQ"]['name'];
         
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if($this->upload->do_upload("s_homevisit_fileSDQ")){
            $data = array('upload_data' => $this->upload->data());
            $image= $data['upload_data']['file_name']; 
           
             $arrayName = array('s_homevisit_fileSDQ' =>$image);
            $result= $this->DBaffairs->update('tb_homevisit_send',$arrayName,'s_homevisit_id='.$AffID);
            echo json_decode($AffID);
        }else{
            print_r($this->upload->display_errors()); 
        }
    }

    public function Add_homevisit_filerecordform(){ 
        $AffID= $this->input->post('AffID'); 
        $delfile = $this->DBaffairs->select('s_homevisit_id,s_homevisit_filerecordform')->where('s_homevisit_id',$AffID)->get('tb_homevisit_send')->result();   
        if($delfile[0]->s_homevisit_filerecordform != NULL){
            unlink('./uploads/affairs/helpstd/filerecordform/'.$delfile[0]->s_homevisit_filerecordform);
        } 
        $config['upload_path']= "./uploads/affairs/helpstd/filerecordform/";
        $config['allowed_types']='*';
        $config['file_name'] = date('YmdHis').'_'.$_FILES["s_homevisit_filerecordform"]['name'];
         
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if($this->upload->do_upload("s_homevisit_filerecordform")){
            $data = array('upload_data' => $this->upload->data());
            $image= $data['upload_data']['file_name']; 
           
             $arrayName = array('s_homevisit_filerecordform' =>$image);
            $result= $this->DBaffairs->update('tb_homevisit_send',$arrayName,'s_homevisit_id='.$AffID);
            echo json_decode($AffID);
        }else{
            print_r($this->upload->display_errors()); 
        }
    }

    public function Add_homevisit_filesummary(){ 
        $AffID= $this->input->post('AffID'); 
        $delfile = $this->DBaffairs->select('s_homevisit_id,s_homevisit_filesummary')->where('s_homevisit_id',$AffID)->get('tb_homevisit_send')->result();   
        if($delfile[0]->s_homevisit_filesummary != NULL){
            unlink('./uploads/affairs/helpstd/filesummary/'.$delfile[0]->s_homevisit_filesummary);
        } 
        $config['upload_path']= "./uploads/affairs/helpstd/filesummary/";
        $config['allowed_types']='*';
        $config['file_name'] = date('YmdHis').'_'.$_FILES["s_homevisit_filesummary"]['name'];
         
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if($this->upload->do_upload("s_homevisit_filesummary")){
            $data = array('upload_data' => $this->upload->data());
            $image= $data['upload_data']['file_name']; 
           
             $arrayName = array('s_homevisit_filesummary' =>$image);
            $result= $this->DBaffairs->update('tb_homevisit_send',$arrayName,'s_homevisit_id='.$AffID);
            echo json_decode($AffID);
        }else{
            print_r($this->upload->display_errors()); 
        }
    }

    public function confrim_statuslevelhead(){ 
        $AffID= $this->input->post('AffID'); 
        $status= $this->input->post('s_homevisit_statuslevelhead');  
        $jsonData = array($AffID,$status);              
   
             $arrayName = array('s_homevisit_statuslevelhead' =>$status,'s_homevisit_techlevelhead' =>$this->session->userdata('login_id'));
            $result= $this->DBaffairs->update('tb_homevisit_send',$arrayName,'s_homevisit_id='.$AffID);
            header('Content-Type: application/json');
            echo json_encode($jsonData);
      
    }

    public function confrim_statusmanager(){ 
        $AffID= $this->input->post('AffID'); 
        $status= $this->input->post('s_homevisit_statusmanager');  
        $jsonData = array($AffID,$status);              
   
             $arrayName = array('s_homevisit_statusmanager' =>$status,'	s_homevisit_techmanager' =>$this->session->userdata('login_id'));
            $result= $this->DBaffairs->update('tb_homevisit_send',$arrayName,'s_homevisit_id='.$AffID);
            header('Content-Type: application/json');
            echo json_encode($jsonData);
      
    }

    public function SupStdCheckWorkManager($year = null){ 
        $data['title']  = "เช็คงานหัวหน้างาน";
        $data['CheckOnOff'] = $this->CheckHomeVisitManager;
        $data['CClass'] = $CClass = $this->db->where('class_teacher',$this->session->userdata('login_id'))->get('tb_regclass')->result();   
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        $data['AllAffairs'] = $this->DBaffairs->where('s_homevisit_year',$year)->order_by('s_homevisit_class')->get('tb_homevisit_send')->result();

        $data['CheckYear'] = $this->DBaffairs->select('s_homevisit_year')->group_by('s_homevisit_year')->order_by('s_homevisit_class')->get('tb_homevisit_send')->result();
        $data['teacher'] = $this->DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();

        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/StudentSupport/SupStdCheckWorkManager.php');
        $this->load->view('teacher/layout/footer_teacher.php');
    }

    public function SupStdCheckWorkExecutive(){ 
        $data['title']  = "เช็คงานผู้บริหาร";
        $data['CheckHomeVisitManager'] = $this->CheckHomeVisitManager;
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        $data['CClass'] = $CClass = $this->db->where('class_teacher',$this->session->userdata('login_id'))->get('tb_regclass')->result();             
        $data['AllAffairs'] = $this->DBaffairs->where('s_homevisit_year','2566')->order_by('s_homevisit_class')->get('tb_homevisit_send')->result();
        $data['teacher'] = $this->DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();

        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/StudentSupport/SupStdCheckWorkExecutive.php');
        $this->load->view('teacher/layout/footer_teacher.php');
    }


    // ตั้งค่าระบบ
    public function Setting_Helpstd_OnOff(){
            $data = array('homevisit_set_onoff' => $this->input->post('onoff'));
      echo  $this->DBaffairs->update('tb_homevisit_setting',$data,'homevisit_set_id=1');
    }

   
}


?>