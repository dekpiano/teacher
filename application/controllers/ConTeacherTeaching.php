<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConTeacherTeaching extends CI_Controller {
var  $title = "หน้าแรก";
	public function __construct() {
		parent::__construct();
		
		if (empty($this->session->userdata('fullname')) && !$this->session->userdata('status') == 'admin') {      
			redirect('welcome','refresh');
		}
        $this->load->model('teacher/ModTeacherTeaching');
        $this->DBaffairs= $this->load->database('affairs', TRUE);
    }

    public function TeacRoom(){
        $DBpersonnel = $this->load->database('personnel', TRUE);
        $SchoolYear = $this->db->select('schyear_year')->where('schyear_id',1)->get('tb_schoolyear')->result();
        $SubSchoolYear = explode('/',$SchoolYear[0]->schyear_year);
        $teacher = $this->db->select('skjacth_personnel.tb_personnel.pers_prefix,
        skjacth_personnel.tb_personnel.pers_firstname,
        skjacth_personnel.tb_personnel.pers_lastname,
        skjacth_personnel.tb_personnel.pers_id,
        skjacth_academic.tb_regclass.Reg_Year,
        skjacth_academic.tb_regclass.Reg_Class')
        ->join($DBpersonnel->database.'.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_regclass.class_teacher')
        ->where('pers_id',$this->session->userdata('login_id'))
        ->where('Reg_Year',$SubSchoolYear[1])
        ->get('tb_regclass')->result();

        return $teacher;
    }
    public function CheckHomeRoomMain(){
        $data['title']  = "หน้าแรกโฮมรูม";       
        $data['teacher'] = $this->TeacRoom();
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();

        //ครูห้วหน้าระดับ
        if($data['teacher'][0]->Reg_Class == "1" || $data['teacher'][0]->Reg_Class == "2"|| $data['teacher'][0]->Reg_Class == "3" || $data['teacher'][0]->Reg_Class == "4" || $data['teacher'][0]->Reg_Class == "5" || $data['teacher'][0]->Reg_Class == "6"){
            redirect('Teaching/CheckHomeRoomDashboard/'.date('d-m-Y'));
        }else{
            //ครูที่ปรึกษา
            $checif = array('chk_home_term'=>'1',
            'chk_home_yaer'=>'2566',
            'chk_home_room'=> $data['teacher'][0]->Reg_Class
                );                                        
        $data['ChkHomeRoom'] = $this->DBaffairs->select('*')
        ->where($checif)
        ->order_by('chk_home_date','DESC')
        ->get('tb_checkhomeroom')->row();

        $checkMa = explode('|',@$data['ChkHomeRoom']->chk_home_ma);
        $checkKhad = explode('|',@$data['ChkHomeRoom']->chk_home_khad);
        $checkLa = explode('|',@$data['ChkHomeRoom']->chk_home_la);
        $checkSahy = explode('|',@$data['ChkHomeRoom']->chk_home_sahy);
        $checkKid = explode('|',@$data['ChkHomeRoom']->chk_home_kid);
        $checkHnee = explode('|',@$data['ChkHomeRoom']->chk_home_hnee);

        $ArrayStatus = array('Ma'=>$checkMa ,
                            'Khad' => $checkKhad,
                            'La' => $checkLa,
                            'Sahy' => $checkSahy,
                            'Kid' => $checkKid,
                            'Hnee' => $checkHnee
                        );

        foreach ($ArrayStatus as $key_AStatus => $v_AStatus) {
            $boy[$key_AStatus] = 0;
            $girl[$key_AStatus]=0;
        }
        
        //$boyma = 0;$girlma=0;$boykhad = 0;$girlkhad=0;

        foreach ($ArrayStatus as $key_AStatus => $v_AStatus) {            
            foreach ($v_AStatus as $key_value => $value) {
                $CheckStu = $this->db->select('StudentPrefix')->where('StudentCode',$value)->get('tb_students')->result();
                if(@$CheckStu[0]->StudentPrefix == "นาย" || @$CheckStu[0]->StudentPrefix == "เด็กชาย"){
                    $boy[$key_AStatus] += 1;
                }elseif(@$CheckStu[0]->StudentPrefix == "นางสาว" || @$CheckStu[0]->StudentPrefix == "เด็กหญิง"){
                    $girl[$key_AStatus] +=1;
                }
                else{
                    
                }
            }
        }
        foreach ($ArrayStatus as $key_AStatus => $v_AStatus) {
            $data['Boy'.$key_AStatus] = $boy[$key_AStatus];
            $data['Girl'.$key_AStatus] = $girl[$key_AStatus];
        }
     
        //exit();

        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');        
        $this->load->view('teacher/Teaching/CheckHomeRoom/CheckHomeRoomMain.php');
        $this->load->view('teacher/layout/footer_teacher.php'); 
        }
       
    }

    public function bar_chart_js(){
        $KeyDay = $this->input->post('KeyDay');
        $data['teacher'] = $this->TeacRoom();
        $data['showHR'] = $this->DBaffairs->where('chk_home_date',date('Y-m-d', strtotime($KeyDay)))
                                ->like('chk_home_room',$data['teacher'][0]->Reg_Class, 'after')
                                ->order_by('chk_home_room','ASC')
                                ->get('tb_checkhomeroom')                                
                                ->result();
        $data1 = [];
        //$data1['label'][] = [1,2,3,4];
        $home_room=[];
        $home_ma=[];$home_khad=[];$home_sahy=[];  $home_la=[]; $home_kid=[]; $home_hnee=[];
        foreach($data['showHR'] as $row) {           
                $home_room[] = $row->chk_home_room;
                $row->chk_home_ma !== "" ? $home_ma[] += count(explode('|', $row->chk_home_ma)) : $home_ma[] += 0;
                $row->chk_home_khad !== "" ? $home_khad[] +=  count(explode('|', $row->chk_home_khad)) : $home_khad[] += 0;
                $row->chk_home_sahy !== "" ? $home_sahy[] +=  count(explode('|', $row->chk_home_sahy)) : $home_sahy[] += 0;
                $row->chk_home_la !== "" ? $home_la[] +=  count(explode('|', $row->chk_home_la)) : $home_la[] += 0;            
                $row->chk_home_kid !== "" ? $home_kid[] +=  count(explode('|', $row->chk_home_kid)) : $home_kid[] += 0;
                $row->chk_home_hnee !== "" ? $home_hnee[] +=  count(explode('|', $row->chk_home_hnee)) : $home_hnee[] += 0;
                
        }     
        $data1['ma'] =$home_ma;
        $data1['khad'] =($home_khad);
        $data1['la'] =($home_la);
        $data1['sahy'] =($home_sahy);
        $data1['hnee'] =($home_hnee);
        $data1['kid'] =($home_kid); 
        $data1['room'] =($home_room); 
        echo json_encode($data1) ;
    }


    public function CheckHomeRoomDashboard($key){ 
        $data['title'] = "แดชบอร์ดโฮมรูม";
        $data['teacher'] = $this->TeacRoom();
        $data['Time'] = $this->DBaffairs->select('set_homeroom_time')->where('set_homeroom_id',1)->get('tb_checkhomeroom_setting')->result();
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        
        $data['showHR'] = $this->DBaffairs->where('chk_home_date',date('Y-m-d', strtotime($key)))                       ->like('chk_home_room',$data['teacher'][0]->Reg_Class, 'after')
                                ->order_by('chk_home_room','ASC')
                                ->get('tb_checkhomeroom')                                
                                ->result();

        $data['shoKhod'] = $this->DBaffairs->select('chk_home_room,chk_home_khad,chk_home_la,chk_home_sahy,chk_home_kid,chk_home_hnee')
        ->where('chk_home_date',date('Y-m-d', strtotime($key)))                       
        ->like('chk_home_room',$data['teacher'][0]->Reg_Class, 'after')
        ->order_by('chk_home_room','ASC')
        ->get('tb_checkhomeroom')                                
        ->result();  

       // echo '<pre>'; print_r($data['shoKhod']);
        $all = [];
        foreach ($data['shoKhod'] as $key => $value) {
            $home_khad = explode('|',$value->chk_home_khad);
            $home_la = explode('|',$value->chk_home_la);
            $home_sahy = explode('|',$value->chk_home_sahy);
            $home_kid = explode('|',$value->chk_home_kid);
            $home_hnee = explode('|',$value->chk_home_hnee);
            $subboy = [];
            $Boy = 0; $Gird = 0;
            $status = array($home_khad,$home_la,$home_sahy,$home_kid,$home_hnee);
            foreach ($status as $key => $v_status) {
                for ($i=0; $i < count($v_status); $i++) { 
                    $checkSex = $this->db->select('StudentPrefix')->where('StudentCode',$v_status[$i])->get('tb_students')->result();
                    if(@$checkSex[0]->StudentPrefix == 'นาย' || @$checkSex[0]->StudentPrefix == 'เด็กชาย'){
                        $Boy +=1;
                    }elseif(@$checkSex[0]->StudentPrefix == 'นางสาว' || @$checkSex[0]->StudentPrefix == 'เด็กหญิง'){
                        $Gird += 1;
                    }
                }
            }
            
            $subboy['Room'] = $value->chk_home_room;
            $subboy['home_khad'] = $Boy.'/'.$Gird;                    
            $all[] = $subboy;
        } 

        $data['all'] = $all; 

        // echo '<pre>'; print_r($all);        
        // exit();
       
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');        
        $this->load->view('teacher/Teaching/CheckHomeRoom/CheckHomeRoomDashboard.php');
        $this->load->view('teacher/layout/footer_teacher.php'); 
    }

    function ChartHomeRoomAll(){
        $data['teacher'] = $this->TeacRoom();
        $checif = array('chk_home_term'=>'1',
                            'chk_home_yaer'=>'2566'
                        );                                        
        $ChkHomeRoom = $this->DBaffairs->select('*')
                ->where($checif)
                ->where('chk_home_date',date('Y-m-d',strtotime($this->input->post('key'))))
                ->order_by('chk_home_date','DESC')
                ->get('tb_checkhomeroom')->result();
    
        $home_ma=0;$home_khad=0;$home_sahy=0;  $home_la=0; $home_kid=0; $home_hnee=0;
        for ($i=0; $i < count($ChkHomeRoom); $i++) {  
            $ChkHomeRoom[$i]->chk_home_ma !== "" ? $home_ma += count(explode('|', $ChkHomeRoom[$i]->chk_home_ma)) : $home_ma += 0;
            $ChkHomeRoom[$i]->chk_home_khad !== "" ? $home_khad +=  count(explode('|', $ChkHomeRoom[$i]->chk_home_khad)) : $home_khad += 0;
            $ChkHomeRoom[$i]->chk_home_sahy !== "" ? $home_sahy +=  count(explode('|', $ChkHomeRoom[$i]->chk_home_sahy)) : $home_sahy += 0;
            $ChkHomeRoom[$i]->chk_home_la !== "" ? $home_la +=  count(explode('|', $ChkHomeRoom[$i]->chk_home_la)) : $home_la += 0;            
            $ChkHomeRoom[$i]->chk_home_kid !== "" ? $home_kid +=  count(explode('|', $ChkHomeRoom[$i]->chk_home_kid)) : $home_kid += 0;
            $ChkHomeRoom[$i]->chk_home_hnee !== "" ? $home_hnee +=  count(explode('|', $ChkHomeRoom[$i]->chk_home_hnee)) : $home_hnee += 0;
        }
      
        $data = [$home_ma,$home_khad,$home_sahy,$home_la,$home_kid,$home_hnee];
        echo json_encode($data);

    }

    public function CHR_CheckStudent(){
        $data['title']  = "หน้าแรกโฮมรูม";       
        $data['teacher'] = $this->TeacRoom();

        $re = $this->ModTeacherTeaching->Mo_CHR_CheckStudent($this->input->post('keyword'),$this->input->post('id'));

        echo json_encode($re);

    }

    function ChartHomeRoom(){
        $data['teacher'] = $this->TeacRoom();
        $checif = array('chk_home_term'=>'1',
                            'chk_home_yaer'=>'2566',
                            'chk_home_room'=> @$data['teacher'][0]->Reg_Class,
                            'chk_home_date' => $this->input->post('DateToDay')
                        );                                        
        $ChkHomeRoom = $this->DBaffairs->select('*')
                ->where($checif)
                ->order_by('chk_home_date','DESC')
                ->get('tb_checkhomeroom')->row();
        
        $data = [];
            $ChkHomeRoom->chk_home_ma !== "" ? $data[] =  count(explode('|', $ChkHomeRoom->chk_home_ma)) : $data[] = 0;
            $ChkHomeRoom->chk_home_khad !== "" ? $data[] =  count(explode('|', $ChkHomeRoom->chk_home_khad)) : $data[] = 0;
            $ChkHomeRoom->chk_home_sahy !== "" ? $data[] =  count(explode('|', $ChkHomeRoom->chk_home_sahy)) : $data[] = 0;
            $ChkHomeRoom->chk_home_la !== "" ? $data[] =  count(explode('|', $ChkHomeRoom->chk_home_la)) : $data[] = 0;            
            $ChkHomeRoom->chk_home_kid !== "" ? $data[] =  count(explode('|', $ChkHomeRoom->chk_home_kid)) : $data[] = 0;
            $ChkHomeRoom->chk_home_hnee !== "" ? $data[] =  count(explode('|', $ChkHomeRoom->chk_home_hnee)) : $data[] = 0;
            
        echo json_encode($data);
    }

    public function CheckHomeRoomAdd(){      
        $data['title']  = "เช็คชื่อโฮมรูม";
        $data['teacher'] = $this->TeacRoom();

        $SchoolYear = $this->db->select('schyear_year')->where('schyear_id',1)->get('tb_schoolyear')->result();
        $data['SubSchoolYear'] = explode('/',$SchoolYear[0]->schyear_year);

        //print_r($data['teacher']);exit();
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        $data['studentAdd'] = $this->db->select('StudentID,
                                                StudentNumber,
                                                StudentClass,
                                                StudentCode,
                                                StudentPrefix,
                                                StudentFirstName,
                                                StudentLastName,
                                                StudentStatus')
                                                ->where('StudentClass','ม.'.$data['teacher'][0]->Reg_Class) 
                                                ->where('StudentStatus','1/ปกติ') 
                                                ->order_by('StudentNumber','asc')    
                                                ->get('tb_students')->result(); 
         
        $checif = array('chk_home_term'=>'1',
                        'chk_home_yaer'=>'2566',
                        'chk_home_room'=> $data['teacher'][0]->Reg_Class
                       );                                        
        $data['ChkHomeRoom1'] = $this->DBaffairs->select('*')
                                ->where($checif)
                                ->order_by('chk_home_date','DESC')
                                ->get('tb_checkhomeroom')->row();
 //echo '<pre>'; print_r($data['ChkHomeRoom1']); exit();
        if(date("Y-m-d",strtotime(@$data['ChkHomeRoom1']->chk_home_date)) != date("Y-m-d")){
            $data['Action'] = base_url('ConTeacherTeaching/Insert_CheckHomeRoom');
            $data['ButtonName'] = "บันทึกข้อมูล";
            $data['ButtonClass'] = "primary";

        }else{
            $data['Action'] = base_url('ConTeacherTeaching/Update_CheckHomeRoom');
            $data['ButtonName'] = "อัพเดตข้อมูล";
            $data['ButtonClass'] = "warning";

            $data['ChkHomeRoom'] = $this->DBaffairs->select('*')
                                ->where($checif)
                                ->order_by('chk_home_date','DESC')
                                ->get('tb_checkhomeroom')->result();
        }   
        $data['ChkHomeRoomSet'] = $this->DBaffairs->where('set_homeroom_id',1)->get('tb_checkhomeroom_setting')->result();

        //echo "<pre>"; print_r($data['ChkHomeRoom']);

        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/Teaching/CheckHomeRoom/CheckHomeRoomAdd.php');
        $this->load->view('teacher/layout/footer_teacher.php');       
    }

    public function Insert_CheckHomeRoom(){  
        
        $status = $this->input->post('status');
      // echo '<pre>'; print_r($this->input->post('status'));
      $ma = array();
      $khad = array();
      $la = array();
      $sahy = array();
      $kid = array();
      $hnee = array();
       foreach ($status as $key => $value) {          
           if($value == 'มา'){
                array_push($ma,$key);
            }elseif($value == 'ขาด'){
                array_push($khad,$key);
            }elseif($value == 'สาย'){
                array_push($sahy,$key);
            }elseif($value == 'ลา'){
                array_push($la,$key);
            }elseif($value == 'กิจกรรม'){
                array_push($kid,$key);
            }elseif($value == 'หนี'){
                array_push($hnee,$key);
            }            
       } 
       $chk_home_ma =  implode("|",$ma);
       $chk_home_khad =  implode("|",$khad);
       $chk_home_la =  implode("|",$la);
       $chk_home_sahy =  implode("|",$sahy);
       $chk_home_kid =  implode("|",$kid);
       $chk_home_hnee =  implode("|",$hnee);
    //    echo $this->input->post('chk_home_teacher');
    //    echo $this->input->post('chk_home_room');

       $data = array('chk_home_date' => date('Y-m-d'),
                    'chk_home_time' => date('H:i:s'),
                    'chk_home_teacher' => $this->input->post('chk_home_teacher'),
                    'chk_home_room' => $this->input->post('chk_home_room'),
                    'chk_home_ma' => $chk_home_ma,
                    'chk_home_khad' => $chk_home_khad,
                    'chk_home_la' => $chk_home_la,
                    'chk_home_sahy' => $chk_home_sahy,
                    'chk_home_kid' => $chk_home_kid,
                    'chk_home_hnee' => $chk_home_hnee,
                    'chk_home_term' =>$this->input->post('chk_home_term'),
                    'chk_home_yaer' => $this->input->post('chk_home_yaer'));
       $result = $this->ModTeacherTeaching->CheckHomeRoomInsert($data); 
      if($result == 1){
        $this->session->set_flashdata(array('msg'=> 'YES','messge' => 'บันทึกข้อมูลสำเร็จ','status'=>'success'));
      }else{
        $this->session->set_flashdata(array('msg'=> 'YES','messge' => 'บันทึกข้อมูลไม่สำเร็จ','status'=>'error'));
      }
      redirect('Teaching/CheckHomeRoomAdd');
    }

    public function Update_CheckHomeRoom(){  
        
        $status = $this->input->post('status');
      // echo '<pre>'; print_r($this->input->post('status'));
      $ma = array();
      $khad = array();
      $la = array();
      $sahy = array();
      $kid = array();
      $hnee = array();
       foreach ($status as $key => $value) {          
           if($value == 'มา'){
                array_push($ma,$key);
            }elseif($value == 'ขาด'){
                array_push($khad,$key);
            }elseif($value == 'สาย'){
                array_push($sahy,$key);
            }elseif($value == 'ลา'){
                array_push($la,$key);
            }elseif($value == 'กิจกรรม'){
                array_push($kid,$key);
            }elseif($value == 'หนี'){
                array_push($hnee,$key);
            }            
       } 
       $chk_home_ma =  implode("|",$ma);
       $chk_home_khad =  implode("|",$khad);
       $chk_home_la =  implode("|",$la);
       $chk_home_sahy =  implode("|",$sahy);
       $chk_home_kid =  implode("|",$kid);
       $chk_home_hnee =  implode("|",$hnee);
    //    echo $this->input->post('chk_home_teacher');
    //    echo $this->input->post('chk_home_room');

       $data = array('chk_home_date' => date('Y-m-d'),
                    'chk_home_time' => date('H:i:s'),
                    'chk_home_teacher' => $this->input->post('chk_home_teacher'),
                    'chk_home_room' => $this->input->post('chk_home_room'),
                    'chk_home_ma' => $chk_home_ma,
                    'chk_home_khad' => $chk_home_khad,
                    'chk_home_la' => $chk_home_la,
                    'chk_home_sahy' => $chk_home_sahy,
                    'chk_home_kid' => $chk_home_kid,
                    'chk_home_hnee' => $chk_home_hnee,
                    'chk_home_term' =>$this->input->post('chk_home_term'),
                    'chk_home_yaer' => $this->input->post('chk_home_yaer'));
                    $id = $this->input->post('chk_home_id');
       $result = $this->ModTeacherTeaching->CheckHomeRoomUpdate($data,$id); 
      if($result == 1){
        $this->session->set_flashdata(array('msg'=> 'YES','messge' => 'อัพเดตข้อมูลสำเร็จ','status'=>'success'));
      }else{
        $this->session->set_flashdata(array('msg'=> 'YES','messge' => 'อัพเดตข้อมูลไม่สำเร็จ','status'=>'error'));
      }
      redirect('Teaching/CheckHomeRoomAdd');
    }

    public function CheckHomeRoomStatistics(){
        $data['title']  = "สถิติโฮมรูม";
        $data['teacher'] = $this->TeacRoom();
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        $checif = array('chk_home_term'=>'1',
                        'chk_home_yaer'=>'2566',
                        'chk_home_room'=> $data['teacher'][0]->Reg_Class
                       );                                        
        $data['ChkHomeRoom'] = $this->DBaffairs->select('*')
                                ->where($checif)
                                ->order_by('chk_home_date','DESC')
                                ->get('tb_checkhomeroom')->result();

        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/Teaching/CheckHomeRoom/CheckHomeRoomStatistics.php');
        $this->load->view('teacher/layout/footer_teacher.php'); 
    }

    public function CheckTeaching(){      
        $data['title']  = "เช็คชื่อการสอน";
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['teacher'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/Teaching/CheckHomeRoom/CheckHomeRoom.php');
        $this->load->view('teacher/layout/footer_teacher.php');
        
    }

        

    // ห้องเรียนออนไลน์

    public function RoomOnlineMain(){      
        $data['title']  = "หน้าหลักห้องเรียนออนไลน์";
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();
        $DBpersonnel = $this->load->database('personnel', TRUE); 
        $data['teacher'] = $DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        $data['RoomOnline'] =$this->db->get('tb_room_online')->result();
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/Teaching/RoomOnline/RoomOnlineMain.php');
        $this->load->view('teacher/layout/footer_teacher.php');        
    }

    function AddRoomOnline(){ 
        $insert =  array('roomon_coursecode'=> $this->input->post('roomon_coursecode'),
            'roomon_coursename'=> $this->input->post('roomon_coursename'),
            'roomon_classlevel'=> $this->input->post('roomon_classlevel'),    
            'roomon_teachid'=> $this->session->userdata('login_id'),
            'roomon_linkroom' => $this->input->post('roomon_linkroom'),
            'roomon_year' => $this->input->post('roomon_year'),
            'roomon_term' => $this->input->post('roomon_term'),
            'roomon_datecreate' => date('Y-m-d H:i:s')
        );
        echo $result = $this->ModTeacherTeaching->RoomOnlineInsert($insert); 
    }

    function EditRoomOnline(){
        $edit = $this->db->where('roomon_id ',$this->input->post('roomid'))->get('tb_room_online')->result();
        echo json_encode($edit); 
    }

    function UpdateRoomOnline(){ 
        //echo $this->input->post('roomon_year'); exit();
        $update =  array('roomon_coursecode'=> $this->input->post('roomon_coursecode'),
            'roomon_coursename'=> $this->input->post('roomon_coursename'),
            'roomon_classlevel'=> $this->input->post('roomon_classlevel'), 
            'roomon_linkroom' => $this->input->post('roomon_linkroom'),
            'roomon_year' => $this->input->post('roomon_year'),
            'roomon_term' => $this->input->post('roomon_term')
        );
        $id = $this->input->post('roomon_id');
        echo $result = $this->ModTeacherTeaching->RoomOnlineUpdate($update, $id); 
    }

    function DeleteRoomOnline(){
        $id = $this->input->post('roomid');
        echo $result = $this->ModTeacherTeaching->RoomOnlineDelete($id); 
    }

}


?>
