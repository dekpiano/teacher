<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ConTeacherCourse extends CI_Controller {
var  $title = "หน้าแรก";
	public function __construct() {
		parent::__construct();
		
		if ($this->session->userdata('fullname') == '' && !$this->session->userdata('status') == 'admin') {      
			redirect('welcome','refresh');
		}
        // if($this->session->userdata('CheckStatusPassword') == ""){
        //     redirect('Teacher/Profile','refresh');
        // }

        $this->load->model('teacher/ModTeacherCourse');
        $this->DBPers = $this->load->database('personnel', TRUE);
        $this->DBaffairs = $this->load->database('affairs', TRUE);
        $this->CheckHomeVisitManager = $this->DBaffairs->select('homevisit_set_id,homevisit_set_manager')->where('homevisit_set_id',1)->get('tb_homevisit_setting')->first_row();
    }


    public function Course(){      
        $data['title'] = "แผนการสอน";
        $data['CheckHomeVisitManager'] = $this->CheckHomeVisitManager;
        $CheckYear = $this->db->get('tb_send_plan_setup')->result();
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        $data['plan'] = $this->db->where('seplan_usersend',$this->session->userdata('login_id'))
        ->where('seplan_year',$CheckYear[0]->seplanset_year)
        ->where('seplan_term',$CheckYear[0]->seplanset_term)
        ->get('tb_send_plan')->result();
        $data['planNew'] = $this->db->where('seplan_usersend',$this->session->userdata('login_id'))
        ->where('seplan_year',$CheckYear[0]->seplanset_year)
        ->where('seplan_term',$CheckYear[0]->seplanset_term)
        ->group_by('seplan_coursecode')->get('tb_send_plan')->result();
       //echo "<pre>"; print_r($data['planNew']); exit();        
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_main.php');
        $this->load->view('teacher/layout/footer_teacher.php');        
    }

    public function LoadPlan($Year,$Term){      
        $data['title'] = "ดาวน์โหลดแผนการสอน";
        $data['CheckHomeVisitManager'] = $this->CheckHomeVisitManager;
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
               
        $data['plan'] = $this->db->where('seplan_usersend',$this->session->userdata('login_id'))->get('tb_send_plan')->result();
        $data['planNew'] = $this->db->where('seplan_usersend',$this->session->userdata('login_id'))
                        ->where('seplan_year',$Year)
                        ->where('seplan_term',$Term)
                        ->group_by('seplan_coursecode')
                        ->group_by('seplan_year')
                        ->group_by('seplan_term')
                        ->get('tb_send_plan')->result();
        $data['CheckYear'] = $this->db->select('seplan_year,seplan_term')
                                        ->group_by('seplan_year')
                                        ->group_by('seplan_term')
                                        ->get('tb_send_plan')->result();

        //echo "<pre>"; print_r($data['CheckYear']); exit();        
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_loadplan.php');
        $this->load->view('teacher/layout/footer_teacher.php');
        
    }

    public function send_plan(){ 
        $data['title'] = "ส่งงาน";
        $data['CheckHomeVisitManager'] = $this->CheckHomeVisitManager;
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        $tiemstart = $data['OnOff'][0]->seplanset_startdate;
        $tiemEnd = $data['OnOff'][0]->seplanset_enddate;
        $timeNow = date('Y-m-d H:i:s');
        if($tiemstart < $timeNow  &&  $tiemEnd > $timeNow && $data['OnOff'][0]->seplanset_status == "on"){   
            $this->load->view('teacher/layout/header_teacher.php',$data);
            $this->load->view('teacher/layout/navbar_teaher.php');
            $this->load->view('teacher/course/plan/plan_send.php');
            $this->load->view('teacher/layout/footer_teacher.php');
        }else{
            $this->session->set_flashdata(array('status'=>'warning','msg'=> 'YES','messge' => "<h2>ระบบปิดอยู่ </h2><br>ยังไม่ถึงกำหนดส่งงาน  หรือ เกินกำหนดส่งงาน<br>ติดต่อหัวงานหลักสูตร"));         
            redirect('Teacher/Course','refresh');       
        }
       
    }

    public function edit_plan($id){
        $data['title'] = "แก้ไขงาน";
        $data['CheckHomeVisitManager'] = $this->CheckHomeVisitManager;
        $data['plan'] = $this->db->where('seplan_ID',$id)->get('tb_send_plan')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_edit.php');
        $this->load->view('teacher/layout/footer_teacher.php');
    }

    public function check_plan($idlear = null){
        $data['title'] = "ตรวจสอบงาน";
        $data['CheckHomeVisitManager'] = $this->CheckHomeVisitManager;
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        $DBskj = $this->load->database('skj', TRUE); 
        $data['lean'] = $DBskj->get('tb_learning')->result();       
        $data['IDlear'] = $idlear;
        $data['planNew'] = $this->db->select("skjacth_academic.tb_send_plan.*,
                                                 skjacth_personnel.tb_personnel.pers_id,
                                                skjacth_personnel.tb_personnel.pers_prefix,
                                                skjacth_personnel.tb_personnel.pers_firstname,
                                                skjacth_personnel.tb_personnel.pers_lastname")
                                                ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_send_plan.seplan_usersend')
                                        ->where('seplan_learning',$idlear)
                                        ->group_by(array('seplan_coursecode','pers_id'))
                                        ->get('tb_send_plan')->result();
        //echo '<pre>'; print_r($data['planNew']); exit();
        $data['checkplan'] = $this->db->select("*")
                            ->where('seplan_learning',$idlear)
                            ->get('tb_send_plan')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_check.php');
        $this->load->view('teacher/layout/footer_teacher.php');
    }

    public function check_plan_lear($idlear = null){
        $data['title'] = "ตรวจสอบงานตามกลุ่มสาระการเรียนรู้";
        $DBskj = $this->load->database('skj', TRUE); 
        $data['lean'] = $DBskj->where('lear_id',$idlear)->get('tb_learning')->result();
        $data['IDlear'] = $idlear;
        $check_guide = $this->session->userdata('login_id');
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        if($check_guide == "pers_052"){
            $data['planNew'] = $this->db->select("skjacth_academic.tb_send_plan.*,
                                                skjacth_personnel.tb_personnel.pers_id,
                                            skjacth_personnel.tb_personnel.pers_prefix,
                                            skjacth_personnel.tb_personnel.pers_firstname,
                                            skjacth_personnel.tb_personnel.pers_lastname")
                                            ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_send_plan.seplan_usersend')
                                            ->like('seplan_namesubject',"แนะแนว")
                                    ->group_by(array('seplan_coursecode','pers_id'))
                                    ->get('tb_send_plan')->result();
            $data['checkplan'] = $this->db->select("*")
                                    ->where('seplan_learning',"lear_009")
                                    ->or_where('seplan_learning',"lear_001")
                                    ->or_where('seplan_learning',"lear_003")
                                    ->get('tb_send_plan')->result();
        }else{

            $data['techer'] = $this->DBPers->select('pers_id,pers_prefix,pers_firstname,pers_lastname,pers_learning,pers_img')
                                    ->where('pers_learning',$idlear)
                                    ->get('tb_personnel')->result();
          
        }
       
      
        //echo '<pre>'; print_r($this->session->userdata('login_id')); exit();
      
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_check_lear.php');
        $this->load->view('teacher/layout/footer_teacher.php');
    }

    public function check_plan_lear_techer($idlear = null,$idTech = null){
        $data['title'] = "ตรวจสอบงานตามกลุ่มสาระการเรียนรู้";
        $DBskj = $this->load->database('skj', TRUE); 
        $data['lean'] = $DBskj->where('lear_id',$idlear)->get('tb_learning')->result();
        $data['IDlear'] = $idlear;
        $check_guide = $this->session->userdata('login_id');
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        if($check_guide == "pers_052"){
            $data['planNew'] = $this->db->select("skjacth_academic.tb_send_plan.*,
                                                skjacth_personnel.tb_personnel.pers_id,
                                            skjacth_personnel.tb_personnel.pers_prefix,
                                            skjacth_personnel.tb_personnel.pers_firstname,
                                            skjacth_personnel.tb_personnel.pers_lastname")
                                            ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_send_plan.seplan_usersend')
                                            ->like('seplan_namesubject',"แนะแนว")
                                    ->group_by(array('seplan_coursecode','pers_id'))
                                    ->get('tb_send_plan')->result();
            $data['checkplan'] = $this->db->select("*")
                                    ->where('seplan_learning',"lear_009")
                                    ->or_where('seplan_learning',"lear_001")
                                    ->or_where('seplan_learning',"lear_003")
                                    ->get('tb_send_plan')->result();
        }else{

            $data['planNew'] = $this->db->select("skjacth_academic.tb_send_plan.seplan_term,
                                                skjacth_academic.tb_send_plan.seplan_year,
                                                skjacth_academic.tb_send_plan.seplan_coursecode,
                                                skjacth_academic.tb_send_plan.seplan_namesubject,
                                                skjacth_academic.tb_send_plan.seplan_typesubject,
                                                skjacth_academic.tb_send_plan.seplan_gradelevel,
                                                skjacth_academic.tb_send_plan.seplan_learning,
                                                skjacth_personnel.tb_personnel.pers_id,
                                            skjacth_personnel.tb_personnel.pers_prefix,
                                            skjacth_personnel.tb_personnel.pers_firstname,
                                            skjacth_personnel.tb_personnel.pers_lastname")
                                ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_send_plan.seplan_usersend')
                                ->where('seplan_learning',$idlear)
                                ->where('pers_id',$idTech)
                                ->where('seplan_year',$data['OnOff'][0]->seplanset_year)
                                ->group_by(array('seplan_coursecode','pers_id'))
                                ->get('tb_send_plan')->result();
            $data['checkplan'] = $this->db->select("*")
                                ->where('seplan_learning',$idlear)
                                ->where('seplan_usersend',$idTech)
                                ->where('seplan_year',$data['OnOff'][0]->seplanset_year)
                                ->get('tb_send_plan')->result();
        }
       
      
        //echo '<pre>'; print_r($this->session->userdata('login_id')); exit();
      
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_check_lear_techer.php');
        $this->load->view('teacher/layout/footer_teacher.php');
    }

    function UploadPlan(){
        $exp = explode('/',$this->input->post('Year'));
        
        $CheckYear = $this->db->get('tb_send_plan_setup')->result();
        
        $CheckRegisPlan = $this->db->select('
        skjacth_academic.tb_register.SubjectCode,
        skjacth_academic.tb_subjects.SubjectName,
        skjacth_academic.tb_subjects.SubjectClass,
        skjacth_academic.tb_subjects.SubjectType,
        skjacth_academic.tb_register.TeacherID,
        skjacth_personnel.tb_personnel.pers_learning,
        skjacth_academic.tb_subjects.SubjectYear
        ')
        ->from('skjacth_academic.tb_register')
        ->join('skjacth_academic.tb_subjects','skjacth_academic.tb_subjects.SubjectCode = skjacth_academic.tb_register.SubjectCode')
        ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_register.TeacherID')
        ->where('SubjectYear',$CheckYear[0]->seplanset_term.'/'.$CheckYear[0]->seplanset_year)
        ->group_by('skjacth_academic.tb_register.SubjectCode')
        ->get()->result();

            
           
            
            foreach ($CheckRegisPlan as $key => $value) {          
                $data = $this->db->select('seplan_coursecode')
                            ->where('seplan_year',$exp[1])
                            ->where('seplan_term',$exp[0])
                            ->where('seplan_coursecode',$value->SubjectCode)
                            ->group_by('seplan_coursecode')
                            ->get('tb_send_plan')->result();
                       
                if(count($data) == 1){
                    echo "ซ้ำ";
                }else{
                    echo "ไม่ซ้ำ";
                   
                         $typePlan  = array('บันทึกตรวจใช้แผน','แบบตรวจแผนการจัดการเรียนรู้','โครงการสอน','แผนการสอนหน้าเดียว','แผนการสอนเต็ม','บันทึกหลังสอน');

                        foreach ($typePlan as $key => $v_typePlan) {                           
                                $Class = explode('.',$value->SubjectClass);
                                $Type = explode('/',$value->SubjectType);
                                $insert =  array('seplan_namesubject'=> $value->SubjectName,
                                'seplan_coursecode'=> $value->SubjectCode,
                                'seplan_typesubject'=> $Type[1],                   
                                'seplan_year'=> $exp[1],
                                'seplan_term'=> $exp[0],
                                'seplan_usersend'=> $value->TeacherID,
                                'seplan_learning'  => $value->pers_learning,
                                'seplan_status1' => "รอตรวจ",
                                'seplan_status2' => "รอตรวจ",
                                'seplan_gradelevel' => $Class[1],
                                'seplan_typeplan' => $v_typePlan
                            );
                            $result= $this->ModTeacherCourse->plan_insert($insert);
                            
                        }
                    }
                }           
                
       // echo json_encode($CheckSendPlan);
   
        
    }

    function insert_plan(){
       
       $pers = $this->DBPers->select('pers_prefix,pers_firstname,pers_lastname,pers_id,pers_position,pers_learning')
                        ->where('pers_id',$this->input->post('seplan_usersend'))
                        ->get('tb_personnel')->result();
        $CheckYear = $this->db->get('tb_send_plan_setup')->result();
        $Checkplan = $this->db->where('seplan_coursecode',$this->input->post('seplan_coursecode')) 
                        ->where('seplan_usersend',$this->input->post('seplan_usersend'))  
                        ->where('seplan_year',$CheckYear[0]->seplanset_year)
                        ->where('seplan_term',$CheckYear[0]->seplanset_term)
                        ->get('tb_send_plan')->num_rows();
        
        if($Checkplan <= 0){

            $insert = array();
            $SetPlan = $this->db->get('tb_send_plan_setup')->result();
            $status=$this->input->post('seplan_sendcomment');
            $textToStore = nl2br(htmlentities($status, ENT_QUOTES, 'UTF-8'));   
            
            $typePlan  = array('บันทึกตรวจใช้แผน','แบบตรวจแผนการจัดการเรียนรู้','โครงการสอน','แผนการสอนหน้าเดียว','แผนการสอนเต็ม','บันทึกหลังสอน');

            foreach ($typePlan as $key => $v_typePlan) {
                    
                $insert =  array('seplan_namesubject'=> $this->input->post('seplan_namesubject'),
                    'seplan_coursecode'=> $this->input->post('seplan_coursecode'),
                    'seplan_typesubject'=> $this->input->post('seplan_typesubject'),                   
                    'seplan_year'=> $SetPlan[0]->seplanset_year,
                    'seplan_term'=> $SetPlan[0]->seplanset_term,
                    'seplan_usersend'=> $this->input->post('seplan_usersend'),
                    'seplan_learning'  => $pers[0]->pers_learning,
                    'seplan_status1' => "รอตรวจ",
                    'seplan_status2' => "รอตรวจ",
                    'seplan_sendcomment' =>  $textToStore,
                    'seplan_gradelevel' => $this->input->post('seplan_gradelevel'),
                    'seplan_typeplan' => $v_typePlan
                );

                $result= $this->ModTeacherCourse->plan_insert($insert); 
            }
           $json = $this->db->select('skjacth_personnel.tb_personnel.pers_id,
           skjacth_personnel.tb_personnel.pers_prefix,
           skjacth_personnel.tb_personnel.pers_firstname,
           skjacth_personnel.tb_personnel.pers_lastname,
           skjacth_personnel.tb_personnel.pers_learning,
           skjacth_academic.tb_send_plan.*')
           ->from('skjacth_academic.tb_send_plan')
           ->join('skjacth_personnel.tb_personnel','skjacth_academic.tb_send_plan.seplan_usersend = skjacth_personnel.tb_personnel.pers_id')
           ->where('seplan_ID',$result)
           ->where('seplan_year',$CheckYear[0]->seplanset_year)
           ->where('seplan_term',$CheckYear[0]->seplanset_term)
           ->get()->result();
           //$this->output->set_content_type('application/json')->set_output($result);
            echo json_encode(array($json,"msg"=>"OK"));
        
        }else{
            echo 2;
        }
    }

    function UpdatePlan(){
      
        $status=$this->input->post('seplan_sendcomment');
        $textToStore = $status;
        $seplan_ID = $this->input->post('seplan_ID');
        $year = $this->db->get('tb_send_plan_setup')->row();
        $plan = $this->db->select('seplan_coursecode,seplan_namesubject,seplan_typeplan,seplan_file,seplan_createdate,seplan_usersend')->where('seplan_ID',$seplan_ID)->get('tb_send_plan')->row();
        $seplan_typeplan = $plan->seplan_typeplan;
        $seplan_coursecode = $plan->seplan_coursecode; 
        $seplan_namesubject = $plan->seplan_namesubject;     
        $seplan_createdate = $plan->seplan_createdate;
        $folder = $year->seplanset_year.'/'.$year->seplanset_term;

        //echo strtotime($seplan_createdate); exit();
        
        if (!is_dir('uploads/academic/course/plan/'.$folder.'/'.$seplan_namesubject)) {
            mkdir('./uploads/academic/course/plan/'.$folder.'/'.$seplan_namesubject, 0777, TRUE);
        }

        if($_FILES['seplan_file']['error'] <= 0){

            if($plan->seplan_file != null){
                unlink("./uploads/academic/course/plan/".$folder."/".$seplan_namesubject."/".$plan->seplan_file);
            }

            $filename = $_FILES["seplan_file"]['name'];
            $FileType = strtolower(pathinfo($_FILES['seplan_file']['name'],PATHINFO_EXTENSION));
            $NewFile = $seplan_coursecode."_".$seplan_namesubject."_".$seplan_typeplan."_".$plan->seplan_usersend;       

            $config['upload_path']= "uploads/academic/course/plan/".$folder."/".$seplan_namesubject."/";
            $config['allowed_types'] = '*';
            $config['remove_spaces'] = TRUE;
            $new_name = $NewFile;
            $config['file_name'] = $new_name;

            $this->load->library('upload',$config);
            $this->upload->initialize($config); 
            if($this->upload->do_upload('seplan_file')){
                $data = array($this->upload->data());
                if($seplan_createdate === "0000-00-00 00:00:00"){
                    $array = array('seplan_file' =>$data[0]['file_name'],'seplan_sendcomment' =>  $textToStore,'seplan_createdate' => date("Y-m-d H:i:s"));
                    echo $upS = $this->db->update('tb_send_plan',$array,'seplan_ID='.$seplan_ID);
                }else{
                    $array = array('seplan_file' =>$data[0]['file_name'],'seplan_sendcomment' =>  $textToStore);
                echo $upS = $this->db->update('tb_send_plan',$array,'seplan_ID='.$seplan_ID);
                }
                
            
            }else{
                $error = $this->upload->display_errors();
                echo $error;
            }
        }else{
            $update =  array('seplan_sendcomment' =>  $textToStore);
                            
                $result= $this->ModTeacherCourse->plan_update($update,$seplan_ID);
                echo $result;
        }
     }
    


     public function delete_plan($id)
   {
    $checkdata = $this->db->select('seplan_ID,seplan_file')->where('seplan_ID',$id)->get('tb_send_plan')->result();
    @unlink("./uploads/academic/course/plan/".$checkdata[0]->seplan_file);

       $this->db->delete('tb_send_plan', array('seplan_ID' => $id));
       echo 'Deleted successfully.';
   }

   // ------------------------------ ตั้งค่าตั้งค่าครูผู้สอน -----------------------------

   function setting_teacher(){         
    $data['title'] = "ตั้งค่าครูผู้สอน";
    $array = array('pers_position >=' => 'posi_003', 'pers_position <=' => 'posi_006');
    $data['pers'] = $this->DBPers->select('pers_prefix,pers_firstname,pers_lastname,pers_id,pers_position,pers_learning')
                            ->where($array)
                            ->order_by('pers_learning')
                            ->get('tb_personnel')->result();
    $data['CheckYearMain'] = $this->db->get('tb_send_plan_setup')->result();
    if($this->input->post('Year') == ""){
        $CheckYear = $this->db->get('tb_send_plan_setup')->result();
        $data['year'] = $CheckYear[0]->seplanset_year;
        $data['term'] = $CheckYear[0]->seplanset_term;
    }else{
        $CheckYear = explode('/',$this->input->post('Year'));
        $data['year'] = $CheckYear[1];
        $data['term'] = $CheckYear[0];
    }

    $data['CheckSelectYear'] = $this->db->select('seplan_year,seplan_term')
                                            ->group_by('seplan_year,seplan_term')
                                            ->order_by('seplan_year,seplan_term','desc')
                                            ->get('tb_send_plan')->result();
    $data['Plan'] = $this->db->select('skjacth_personnel.tb_personnel.pers_id,
                                        skjacth_personnel.tb_personnel.pers_prefix,
                                        skjacth_personnel.tb_personnel.pers_firstname,
                                        skjacth_personnel.tb_personnel.pers_lastname,
                                        skjacth_personnel.tb_personnel.pers_learning,
                                        skjacth_academic.tb_send_plan.*')
                                        ->from('skjacth_academic.tb_send_plan')
                                        ->join('skjacth_personnel.tb_personnel','skjacth_academic.tb_send_plan.seplan_usersend = skjacth_personnel.tb_personnel.pers_id','LEFT')
                                        ->where('seplan_year',$data['year'])
                                        ->where('seplan_term',$data['term'])
                                        ->group_by('seplan_coursecode,pers_id')->get()->result();
    //echo '<pre>';print_r($data['CheckSelectYear']); exit();
    $this->load->view('teacher/layout/header_teacher.php',$data);
    $this->load->view('teacher/layout/navbar_teaher.php');
    $this->load->view('teacher/course/plan/plan_setting_teacher.php');
    $this->load->view('teacher/layout/footer_teacher.php');
 }

 function setting_teacher_eidt(){     
    $PlanCode = $this->input->post('PlanCode');
    $PlanYear = $this->input->post('PlanYear');
    $PlanTerm = $this->input->post('PlanTerm');

    $json = $this->db->select('seplan_namesubject,
                                seplan_coursecode,
                                seplan_gradelevel,
                                seplan_typesubject,
                                seplan_year,
                                seplan_term,
                                seplan_usersend')
                                ->where('seplan_coursecode',$PlanCode)
                                ->where('seplan_year',$PlanYear)
                                ->where('seplan_term',$PlanTerm)
                                ->limit(1)
                                ->get('tb_send_plan')
                                ->result();
    echo json_encode($json);
 }

 function setting_teacher_update(){     
   // $PlanCode = $this->input->post('up_seplan_namesubject');
    $data = array('seplan_namesubject' => $this->input->post('up_seplan_namesubject'),
                        'seplan_gradelevel' => $this->input->post('up_seplan_gradelevel'),
                        'seplan_typesubject' => $this->input->post('up_seplan_typesubject'),
                        'seplan_usersend' => $this->input->post('up_seplan_usersend')
    );
    $result = $this->ModTeacherCourse->plan_setting_update_teacher($data,$this->input->post('up_seplan_coursecode'),$this->input->post('up_seplan_year'),$this->input->post('up_seplan_term'));
    
    echo ($result);
 }

 function setting_teacher_delete(){   
     
    $DelPlanCode = $this->input->post('PlanCode');
    $DelPlanTerm = $this->input->post('PlanTerm');
    $DelPlanYear = $this->input->post('PlanYear');
    $DelPlanName = $this->input->post('PlanName');

    $result = $this->ModTeacherCourse->plan_setting_delete_teacher($DelPlanCode,$DelPlanTerm,$DelPlanYear,$DelPlanName);
         
    echo $result;
  }


 //---------------------------------------------------------------------------------

     function setting_plan(){         
        $data['title'] = "ตั้งค่า";
        $data['CheckHomeVisitManager'] = $this->CheckHomeVisitManager;
        $data['SetPlan'] = $this->db->get('tb_send_plan_setup')->result();
        //print_r($date['SetPlan']); exit();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_setting_plan.php');
        $this->load->view('teacher/layout/footer_teacher.php');
     }

     function setting_UpdatePlan(){
         $dateS = str_replace('/', '-', $this->input->post('seplanset_startdate'));
         $startdate = date('Y-m-d H:i:s',strtotime($this->input->post('seplanset_startdate')));
         $dateE = str_replace('/', '-', $this->input->post('seplanset_enddate'));
         $enddate = date('Y-m-d H:i:s',strtotime($this->input->post('seplanset_enddate')));
            $data = array('seplanset_startdate' => $startdate,
            'seplanset_enddate' => $enddate,
            'seplanset_usersetup' => $this->session->userdata('login_id'),
            'seplanset_year' => $this->input->post('seplanset_year'),
            'seplanset_term' => $this->input->post('seplanset_term'),
            'seplanset_status' => $this->input->post('seplanset_status'));
        //print_r($data); exit();
            $result = $this->ModTeacherCourse->plan_setting($data,1);
            if($result > 0){
                $this->session->set_flashdata(array('status'=>'success','msg'=> 'YES','messge' => "ตั้งค่าสำเร็จ"));
               
            }else{
                $this->session->set_flashdata(array('status'=>'error','msg'=> 'YES','messge' => "ตั้งค่าไม่สำเร็จ".$result));
               
            }
            redirect('Course/Setting','refresh');
     }

     function UpdateStatus1(){
       // echo $this->input->post('status1');
        $id =  $this->input->post('planId');
        if($this->input->post('status1') == "ผ่าน"){
            $data = array('seplan_status1' => $this->input->post('status1'),
            'seplan_checkdate1' => date('Y-m-d H:i:s'),
            'seplan_inspector1' => $this->session->userdata('login_id'),
            'seplan_comment1' => ""
            );
         }else{
            $data = array('seplan_status1' => $this->input->post('status1'),
            'seplan_checkdate1' => date('Y-m-d H:i:s'),
            'seplan_inspector1' => $this->session->userdata('login_id')
            );
         }
        $result = $this->ModTeacherCourse->plan_UpdateStatus1($data,$id);
        if($result == 1){
            $data = $this->db->select('seplan_status1,seplan_status2')->where('seplan_ID',$id)->get('tb_send_plan')->result();
            echo json_encode($data);
        }
     }
     function UpdateStatus2(){
        // echo $this->input->post('status1');
         $id =  $this->input->post('planId');
         if($this->input->post('status2') == "ผ่าน"){
            $data = array('seplan_status2' => $this->input->post('status2'),
            'seplan_checkdate2' => date('Y-m-d H:i:s'),
            'seplan_inspector2' => $this->session->userdata('login_id'),
            'seplan_comment2' => ""
            );
         }else{
            $data = array('seplan_status2' => $this->input->post('status2'),
            'seplan_checkdate2' => date('Y-m-d H:i:s'),
            'seplan_inspector2' => $this->session->userdata('login_id')
            );
         }
         
                         
         $result = $this->ModTeacherCourse->plan_UpdateStatus2($data,$id);
         if($result == 1){
            $data = $this->db->select('seplan_status1,seplan_status2')->where('seplan_ID',$id)->get('tb_send_plan')->result();
            echo json_encode($data);
        }
      }

      function CheckComment1(){
        // echo $this->input->post('status1');
         $id =  $this->input->post('planId');
        $result = $this->db->select('seplan_ID,seplan_comment1')->where('seplan_ID',$id)->get('tb_send_plan')->result();
        
        echo json_encode($result);
      }

      function UpdateComment1(){
        // echo $this->input->post('status1');
         $id =  $this->input->post('planId');
         $seplan_comment1 =  $this->input->post('seplan_comment1');
         $data = array('seplan_comment1' =>  $seplan_comment1);
         $result = $this->ModTeacherCourse->plan_UpdateStatus1($data,$id);
         echo ($result);
      }

      function CheckComment2(){
        // echo $this->input->post('status1');
         $id =  $this->input->post('planId');
        $result = $this->db->select('seplan_ID,seplan_comment2')->where('seplan_ID',$id)->get('tb_send_plan')->result();
        
        echo json_encode($result);
      }

      function UpdateComment2(){
        // echo $this->input->post('status1');
         $id =  $this->input->post('planId');
         $seplan_comment2 =  $this->input->post('seplan_comment2');
         $data = array('seplan_comment2' =>  $seplan_comment2);
         $result = $this->ModTeacherCourse->plan_UpdateStatus2($data,$id);
         echo ($result);
      }


      public function report_plan($key = null){
        $data['CheckHomeVisitManager'] = $this->CheckHomeVisitManager;
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        $data['ID'] = $key;
        $data['thai'] = urldecode($key);
        $data['title'] = "รายงาน";       
        $DBskj = $this->load->database('skj', TRUE); 
        $data['lean'] = $DBskj->get('tb_learning')->result();
        $data['leanUser'] = $DBskj->where('lear_id',$this->session->userdata('pers_learning'))->get('tb_learning')->result();
        $data['setupplan'] = $this->db->get('tb_send_plan_setup')->result();
        
        if(isset($_GET['select_lean'])){
            $data['leanUser'] = $DBskj->where('lear_id',$_GET['select_lean'])->get('tb_learning')->result();
            $idLearn = $_GET['select_lean'];
        }else{
            $idLearn = $this->session->userdata('pers_learning');
        }
        if($idLearn == 'lear_009'){
            $data['checkplan'] = $this->db->select("skjacth_academic.tb_send_plan.*,
                                                    skjacth_personnel.tb_personnel.pers_id,
                                                    skjacth_personnel.tb_personnel.pers_prefix,
                                                    skjacth_personnel.tb_personnel.pers_firstname,
                                                    skjacth_personnel.tb_personnel.pers_lastname")
                                                    ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_send_plan.seplan_usersend')
                                        ->where('seplan_learning',$idLearn)  
                                        ->where('seplan_typeplan',$data['thai'])
                                        ->where('seplan_year',$data['setupplan'][0]->seplanset_year)
                                        ->where('seplan_term',$data['setupplan'][0]->seplanset_term)     
                                        ->or_where('seplan_coursecode','ก23100')                       
                                        ->or_where('seplan_coursecode','ก23101')    
                                        ->or_where('seplan_coursecode','ก23102')
                                        ->group_by('seplan_namesubject')
                                        ->group_by('seplan_coursecode')
                                        ->group_by('pers_id')
                                        ->order_by('pers_firstname')
                                        ->get('tb_send_plan')->result();
        }else{
            $data['checkplan'] = $this->db->select("skjacth_academic.tb_send_plan.*,
                                                    skjacth_personnel.tb_personnel.pers_id,
                                                    skjacth_personnel.tb_personnel.pers_prefix,
                                                    skjacth_personnel.tb_personnel.pers_firstname,
                                                    skjacth_personnel.tb_personnel.pers_lastname")
                                                    ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_send_plan.seplan_usersend')
                                        ->where('seplan_learning',$idLearn)  
                                        ->where('seplan_typeplan',$data['thai'])
                                        ->where('seplan_year',$data['setupplan'][0]->seplanset_year)
                                        ->where('seplan_term',$data['setupplan'][0]->seplanset_term)   
                                        ->group_by('seplan_namesubject')
                                        ->group_by('seplan_coursecode')
                                        ->group_by('pers_id')
                                        ->order_by('pers_firstname')
                                        ->get('tb_send_plan')->result();
        }
        

//echo '<pre>'; print_r($data['checkplan']); exit();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_report.php');
        $this->load->view('teacher/layout/footer_teacher.php');
    }

    public function report_plan_print($key = null,$leanKey = null){
       
        $data['ID'] = $key;
        $data['thai'] = urldecode($key);
        $data['title'] = "รายงาน";
        $DBskj = $this->load->database('skj', TRUE); 
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        $setupplan = $this->db->get('tb_send_plan_setup')->result();

        if($leanKey){
            $idLearn = $leanKey;

        $leade = $this->DBPers->select('pers_prefix,pers_firstname,pers_lastname,pers_groupleade,pers_learning') ->where('pers_groupleade','1')
                        ->where('pers_learning',$leanKey)
						->get('tb_personnel')->result();
         $groupleade = $leade[0]->pers_prefix.$leade[0]->pers_firstname.' '.$leade[0]->pers_lastname;
         
        }else{
            $idLearn = $this->session->userdata('pers_learning');
            $groupleade = $this->session->userdata('fullname');
        }
        $lean = $DBskj->where('lear_id',$idLearn)->get('tb_learning')->result();

        if($idLearn == 'lear_009'){
            $checkplan = $this->db->select("skjacth_academic.tb_send_plan.*,
                                                    skjacth_personnel.tb_personnel.pers_id,
                                                    skjacth_personnel.tb_personnel.pers_prefix,
                                                    skjacth_personnel.tb_personnel.pers_firstname,
                                                    skjacth_personnel.tb_personnel.pers_lastname")
                                                    ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_send_plan.seplan_usersend')
                                        ->where('seplan_learning',$idLearn)  
                                        ->where('seplan_typeplan',$data['thai'])
                                        ->where('seplan_year',$setupplan[0]->seplanset_year)
                                        ->where('seplan_term',$setupplan[0]->seplanset_term)     
                                        ->or_where('seplan_coursecode','ก23100')                       
                                        ->or_where('seplan_coursecode','ก23101')    
                                        ->or_where('seplan_coursecode','ก23102')
                                        ->group_by('seplan_namesubject')
                                        ->group_by('seplan_coursecode')
                                        ->group_by('pers_id')
                                        ->order_by('pers_firstname')
                                        ->get('tb_send_plan')->result();
        }else{
            $checkplan = $this->db->select("skjacth_academic.tb_send_plan.*,
                                                    skjacth_personnel.tb_personnel.pers_id,
                                                    skjacth_personnel.tb_personnel.pers_prefix,
                                                    skjacth_personnel.tb_personnel.pers_firstname,
                                                    skjacth_personnel.tb_personnel.pers_lastname")
                                                    ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_send_plan.seplan_usersend')
                                        ->where('seplan_learning',$idLearn)  
                                        ->where('seplan_typeplan',$data['thai'])
                                        ->where('seplan_year',$setupplan[0]->seplanset_year)
                                        ->where('seplan_term',$setupplan[0]->seplanset_term)   
                                        ->group_by('seplan_namesubject')
                                        ->group_by('seplan_coursecode')
                                        ->group_by('pers_id')
                                        ->order_by('pers_firstname')
                                        ->get('tb_send_plan')->result();
        }
           // echo '<pre>'; print_r($checkplan); exit();
    //     $this->load->view('teacher/course/plan/plan_report_print.php',$data);
    
            $spreadsheet = new Spreadsheet();
            $spreadsheet->getDefaultStyle()->getFont()->setName('TH SarabunPSK');
            $spreadsheet->getDefaultStyle()->getFont()->setSize(16);
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->getStyle('A1:I5')->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER) //Set vertical center
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER) //Set horizontal center
            ->setWrapText(true); //Set wrap

            $styleArray = [
                'font' => [
                    'bold' => true,
                ]                
            ];            
            $spreadsheet->getActiveSheet()->getStyle('A1:I5')->applyFromArray($styleArray);
            
            $f = array('A','B','C','D','E','F','G','H','I' );
            foreach ($f as $key => $v_f) {
                $spreadsheet->getActiveSheet()->getColumnDimension($v_f)->setAutoSize(true);
            }

            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
            ];

            $sheet->setCellValue('A1', 'ทะเบียนส่ง'.$data['thai']);
            $sheet->mergeCells('A1:I1');
            $sheet->setCellValue('A2', 'กลุ่มสาระการเรียนรู้'.$lean[0]->lear_namethai);
            $sheet->mergeCells('A2:I2');
            $sheet->setCellValue('A3', 'ภาคเรียนที่ '.$setupplan[0]->seplanset_term.' ปีการศึกษา '.$setupplan[0]->seplanset_year);
            $sheet->mergeCells('A3:I3');
            
            $sheet->setCellValue('A4', 'ที่');
            $sheet->mergeCells('A4:A5');
            $sheet->setCellValue('B4', 'ชื่อ-นามสกุล');
            $sheet->mergeCells('B4:B5');
            $sheet->setCellValue('C4', 'รายวิชา');
            $sheet->mergeCells('C4:D4');
            $sheet->setCellValue('C5', 'พื้นฐาน');
            $sheet->setCellValue('D5', 'เพิ่มเติม');
            $sheet->setCellValue('E4', 'ชื่อวิชา');
            $sheet->mergeCells('E4:E5');
            $sheet->setCellValue('F4', 'รหัสวิชา');
            $sheet->mergeCells('F4:F5');
            $sheet->setCellValue('G4', 'ระดับชั้น');
            $sheet->mergeCells('G4:G5');
            $sheet->setCellValue('H4', 'วัน/เดือน/ปี');
            $sheet->mergeCells('H4:H5');
            $sheet->setCellValue('I4', 'หมายเหตุ');
            $sheet->mergeCells('I4:I5');


            $start_row=6; 
            foreach ($checkplan as $key => $v_checkplan) {
                if(date('Y',strtotime($v_checkplan->seplan_createdate)) == "2021"){

                }else{

                
                if($v_checkplan->seplan_createdate === "0000-00-00 00:00:00"){
                    $createdate = "ยังไม่ได้ส่งงาน";
                }else{
                   $createdate =  $this->datethai->thai_date_fullmonth(strtotime($v_checkplan->seplan_createdate));
                }
                $sheet->getStyle('A4:I'.$start_row)->applyFromArray($styleArray);

                $sheet->setCellValue('A'.$start_row, $key+1);
                $sheet->setCellValue('B'.$start_row, $v_checkplan->pers_prefix.$v_checkplan->pers_firstname.' '.$v_checkplan->pers_lastname);
                $sheet->setCellValue('C'.$start_row, $v_checkplan->seplan_typesubject=="พื้นฐาน" ? '✓' : '');
                $sheet->setCellValue('D'.$start_row, $v_checkplan->seplan_typesubject=="เพิ่มเติม" ? '✓' : '');
                $sheet->setCellValue('E'.$start_row, $v_checkplan->seplan_namesubject);
                $sheet->setCellValue('F'.$start_row, $v_checkplan->seplan_coursecode);
                $sheet->setCellValue('G'.$start_row, 'ม.'.$v_checkplan->seplan_gradelevel);
                $sheet->setCellValue('H'.$start_row, $createdate);
                $sheet->setCellValue('I'.$start_row, '');

                $sheet->getStyle('C6:I'.$start_row)->getAlignment()
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER) //Set vertical center
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER) //Set horizontal center
                ->setWrapText(true); //Set wrap

                $start_row++; 
            }
        }
            $sheet->getStyle('A6:A'.($start_row))->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER) //Set vertical center
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER) //Set horizontal center
            ->setWrapText(true);
            $sheet->getStyle('D'.($start_row+3).':F'.($start_row+4))->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER) //Set vertical center
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER) //Set horizontal center
            ->setWrapText(true); //Set wrap
            $sheet->setCellValue('D'.($start_row+2), 'ลงชื่อ…………………………………………………….หัวหน้ากลุ่มสาระการเรียนรู้'.$lean[0]->lear_namethai);
            $sheet->mergeCells('D'.($start_row+2).':I'.($start_row+2));
            $sheet->setCellValue('D'.($start_row+3), '('.$groupleade.')');
            $sheet->mergeCells('D'.($start_row+3).':F'.($start_row+3));
            $sheet->setCellValue('D'.($start_row+4), $this->datethai->thai_date_fullmonth(strtotime(date("Y-m-d"))));
            $sheet->mergeCells('D'.($start_row+4).':F'.($start_row+4));

            $writer = new Xlsx($spreadsheet);
            
            $filename = 'name-of-the-generated-file';
            
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="แบบรายงานส่ง'. $data['thai'].'-'.$lean[0]->lear_namethai.'.xlsx"'); 
            header('Cache-Control: max-age=0');
            
            $writer->save('php://output'); // download file 
    }


    public function DownloadPlan(){

        $data['title'] = "ดาวน์โหลดแผน";  
        $data['CheckHomeVisitManager'] = $this->CheckHomeVisitManager; 
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        $data['teacher'] = $this->DBPers->select('pers_id,pers_prefix,pers_firstname,pers_lastname,pers_groupleade,pers_learning') 
                                ->where('pers_learning !=','')
						        ->get('tb_personnel')->result();    
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/course/plan/plan_download.php');
        $this->load->view('teacher/layout/footer_teacher.php');
    }

    public function DownloadPlanZip($UserId = null){
        // Load zip library
        header('Content-Type: text/html; charset=utf-8');
        $this->load->library('zip');
        $this->load->helper('download');
       
        $DataFile = $this->db->select('seplan_usersend,seplan_file')->where('seplan_usersend',$UserId)->get('tb_send_plan')->result();
        $teacher= $this->DBPers->select('pers_id,pers_prefix,pers_firstname,pers_lastname,pers_groupleade,pers_learning') 
        ->where('pers_id',$UserId)
        ->get('tb_personnel')->result();  
        
        foreach ($DataFile as $key => $v_DataFile) {
           // echo $v_DataFile->seplan_file;
          // echo '<iframe src="'.FCPATH.'/uploads/academic/course/plan/'.$v_DataFile->seplan_file.'"></iframe>';
           //force_download(FCPATH.'/uploads/academic/course/plan/'.$v_DataFile->seplan_file, NULL);
           //$this->beautify_filename($v_DataFile->seplan_file);
          
            $filepath1 = FCPATH.'/uploads/academic/course/plan/'.$v_DataFile->seplan_file;
           
            $fname = iconv('utf-8', 'tis-620', basename($filepath1));
           $this->zip->read_file($filepath1);
           
        }     
        //exit();
        // Download
        $filename = $teacher[0] ->pers_prefix.$teacher[0] ->pers_firstname.'_'.$teacher[0] ->pers_lastname;
        $this->zip->download($filename);
    }

    function beautify_filename($filename) {
        // reduce consecutive characters
        $filename = preg_replace(array(
            // "file   name.zip" becomes "file-name.zip"
            '/ +/',
            // "file___name.zip" becomes "file-name.zip"
            '/_+/',
            // "file---name.zip" becomes "file-name.zip"
            '/-+/'
        ), '-', $filename);
        $filename = preg_replace(array(
            // "file--.--.-.--name.zip" becomes "file.name.zip"
            '/-*\.-*/',
            // "file...name..zip" becomes "file.name.zip"
            '/\.{2,}/'
        ), '.', $filename);
        // lowercase for windows/unix interoperability http://support.microsoft.com/kb/100625
        $filename = mb_strtolower($filename, mb_detect_encoding($filename));
        // ".file-name.-" becomes "file-name"
        $filename = trim($filename, '.-');
        return $filename;
    }

}


?>