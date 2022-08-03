<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConTeacherRegister extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		if (empty($this->session->userdata('fullname')) && !$this->session->userdata('status') == 'admin') {      
			redirect('welcome','refresh');
		}
        $this->DBpersonnel = $this->load->database('personnel', TRUE); 
        $this->DBaffairs = $this->load->database('affairs', TRUE);
        $this->CheckHomeVisitManager = $this->DBaffairs->select('homevisit_set_id,homevisit_set_manager')->where('homevisit_set_id',1)->get('tb_homevisit_setting')->first_row();
    }

    function check_grade($sum) {
        if (($sum > 100) || ($sum < 0)) {
             $grade = "ไม่สามารถคิดเกรดได้ คะแนนเกิน";
        } else if (($sum >= 79.5) && ($sum <= 100)) {
             $grade = 4;
        } else if (($sum >= 74.5) && ($sum <= 79.4)) {
             $grade = 3.5;
        } else if (($sum >= 69.5) && ($sum <= 74.4)) {
             $grade = 3;
        } else if (($sum >= 64.5) && ($sum <= 69.4)) {
             $grade = 2.5;
        } else if (($sum >= 59.5) && ($sum <= 64.4)) {
             $grade = 2;
        } else if (($sum >= 54.5) && ($sum <= 59.4)) {
             $grade = 1.5;
        } else if (($sum >= 49.5) && ($sum <= 54.4)) {
             $grade = 1;
        } else if ($sum <= 49.4) {
             $grade = 0;
        }
        return $grade;
    }

    public function SaveScoreMain(){      
        $data['title']  = "หน้าบันทึกผลการเรียนหลัก";
        $data['teacher'] = $this->DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        
        $data['check_subject'] = $this->db->select('
                                    tb_register.SubjectCode,
                                    tb_register.RegisterYear,
                                    tb_register.RegisterClass,
                                    tb_register.TeacherID,
                                    tb_subjects.SubjectName,
                                    tb_subjects.SubjectID,
                                    tb_subjects.SubjectUnit,
                                    tb_subjects.SubjectHour
                                ')
                                ->from('tb_register')
                                ->join('tb_subjects','tb_subjects.SubjectCode = tb_register.SubjectCode')
                                ->where('TeacherID',$this->session->userdata('login_id'))
                                ->group_by('tb_register.SubjectCode')
                                ->get()->result();
        
        //echo '<pre>'; print_r($data['check_subject']);exit();
        
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/register/SaveScore/SaveScoreMain.php');
        $this->load->view('teacher/layout/footer_teacher.php');        
    }

    public function SaveScoreAdd($term,$yaer,$subject,$room){      
        $data['title']  = "บันทึกผลการเรียน";
        $data['teacher'] = $this->DBpersonnel->select('pers_id,pers_img')->where('pers_id',$this->session->userdata('login_id'))->get('tb_personnel')->result();
        
       
        
        $data['check_room'] = $this->db->select('
                                    tb_students.StudentClass,
                                ')
                                ->from('tb_register')
                                ->join('tb_subjects','tb_subjects.SubjectCode = tb_register.SubjectCode')
                                ->join('tb_students','tb_students.StudentID = tb_register.StudentID')
                                ->where('TeacherID',$this->session->userdata('login_id'))
                                ->where('RegisterYear',$term.'/'.$yaer)
                                ->where('tb_register.SubjectCode',urldecode($subject))
                                // ->where('tb_students.StudentClass','ม.6/3')
                                ->order_by('tb_students.StudentClass','ASC')
                                ->group_by('tb_students.StudentClass')
                                ->get()->result();
        
        //echo '<pre>'; print_r($room);exit();
        if($room == "all"){  
        $data['check_student'] = $this->db->select('
                                    tb_register.SubjectCode,
                                    tb_register.RegisterYear,
                                    tb_register.RegisterClass,
                                    tb_register.Score100,
                                    tb_register.TeacherID,
                                    tb_subjects.SubjectName,
                                    tb_register.StudyTime,
                                    tb_subjects.SubjectID,
                                    tb_subjects.SubjectUnit,
                                    tb_subjects.SubjectHour,
                                    tb_students.StudentID,
                                    tb_students.StudentPrefix,
                                    tb_students.StudentFirstName,
                                    tb_students.StudentLastName,
                                    tb_students.StudentNumber,
                                    tb_students.StudentClass,
                                    tb_students.StudentCode,
                                    tb_students.StudentStatus
                                ')
                                ->from('tb_register')
                                ->join('tb_subjects','tb_subjects.SubjectCode = tb_register.SubjectCode')
                                ->join('tb_students','tb_students.StudentID = tb_register.StudentID')
                                ->where('TeacherID',$this->session->userdata('login_id'))
                                ->where('RegisterYear',$term.'/'.$yaer)
                                ->where('tb_register.SubjectCode',urldecode($subject))
                                ->order_by('tb_students.StudentClass','ASC')
                                ->order_by('tb_students.StudentNumber','ASC')
                                ->get()->result();
       
        }else{
            $sub_checkroom = explode('-',$room);
            $sub_room = $sub_checkroom[0].'/'.$sub_checkroom[1];
            $data['check_student'] = $this->db->select('
                                    tb_register.SubjectCode,
                                    tb_register.RegisterYear,
                                    tb_register.RegisterClass,
                                    tb_register.Score100,
                                    tb_register.TeacherID,
                                    tb_register.StudyTime,
                                    tb_subjects.SubjectName,
                                    tb_subjects.SubjectID,
                                    tb_subjects.SubjectUnit,
                                    tb_subjects.SubjectHour,
                                    tb_students.StudentID,
                                    tb_students.StudentPrefix,
                                    tb_students.StudentFirstName,
                                    tb_students.StudentLastName,
                                    tb_students.StudentNumber,
                                    tb_students.StudentClass,
                                    tb_students.StudentCode,
                                    tb_students.StudentStatus
                                ')
                                ->from('tb_register')
                                ->join('tb_subjects','tb_subjects.SubjectCode = tb_register.SubjectCode')
                                ->join('tb_students','tb_students.StudentID = tb_register.StudentID')
                                ->where('TeacherID',$this->session->userdata('login_id'))
                                ->where('RegisterYear',$term.'/'.$yaer)
                                ->where('tb_register.SubjectCode',urldecode($subject))
                                ->where('tb_students.StudentClass','ม.'.$sub_room)
                                ->order_by('tb_students.StudentClass','ASC')
                                ->order_by('tb_students.StudentNumber','ASC')
                                ->get()->result();

        }

        $check_idSubject = $this->db->where('SubjectCode',urldecode($subject))->where('SubjectYear',$term.'/'.$yaer)->get('tb_subjects')->row();
        $data['set_score'] = $this->db->where('regscore_subjectID',$check_idSubject->SubjectID)->get('tb_register_score')->result();

      
        
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');
        $this->load->view('teacher/register/SaveScore/SaveScoreAdd.php');
        $this->load->view('teacher/layout/footer_teacher.php');        
    }

    public function insert_score(){ 

        foreach ($this->input->post('StudentID') as $num => $value) {
            // print_r($value);
            // print_r($this->input->post('SubjectCode'));
            $study_time = $this->input->post('study_time');
            // print_r(); exit();
            $Grade = $this->check_grade(array_sum($this->input->post($value)));

            $key = array('StudentID' => $value,'SubjectCode' => $this->input->post('SubjectCode'), 'RegisterYear' => $this->input->post('RegisterYear'));
            $data = array('Score100' => implode("|",$this->input->post($value)),'Grade'  => $Grade,'StudyTime' => $study_time[$num]);
           echo $this->db->update('tb_register',$data,$key);
        }
        
        
    }

    public function setting_score($key){      
       

        if($key == "form_insert_score"){
            $list = array('before_middle','test_midterm','after_midterm','final_exam');
            $score = array('before_middle_score','test_midterm_score','after_midterm_score','final_exam_score');
            for ($i=0; $i <= 3 ; $i++) { 
                $data = array('regscore_subjectID' => $this->input->post("regscore_subjectID"),
                'regscore_namework' => $this->input->post($list[$i]),
                'regscore_score' => $this->input->post($score[$i]) ); 
                $this->db->insert('tb_register_score',$data);           
            }
            echo 1;
        }elseif($key == "form_update_score"){
            $list = array('before_middle','test_midterm','after_midterm','final_exam');
            $score = array('before_middle_score','test_midterm_score','after_midterm_score','final_exam_score');
            for ($i=0; $i <= 3 ; $i++) { 
                $data = array(
                    'regscore_score' => $this->input->post($score[$i]) 
                ); 
                $uplist = array('regscore_namework' => $this->input->post($list[$i]),
                              'regscore_subjectID' =>$this->input->post("regscore_subjectID"));
                $this->db->update('tb_register_score',$data,$uplist);           
            }
            echo 1;
        }
       
    }
    
    public function edit_score(){  
        $edit_score = $this->db->where('regscore_subjectID',$this->input->post('subid'))->get('tb_register_score')->result();
        if($edit_score){
            echo json_encode($edit_score);
        }else{
            echo 0;
        }
        
    }

    public function checkroom_report(){
        $check_room = $this->db->select('
                                    tb_students.StudentClass,
                                ')
                                ->from('tb_register')
                                ->join('tb_subjects','tb_subjects.SubjectCode = tb_register.SubjectCode')
                                ->join('tb_students','tb_students.StudentID = tb_register.StudentID')
                                ->where('TeacherID',$this->session->userdata('login_id'))
                                ->where('RegisterYear',$this->input->post('report_yaer'))
                                ->where('tb_register.SubjectCode',$this->input->post('report_subject'))
                                // ->where('tb_students.StudentClass','ม.6/3')
                                ->order_by('tb_students.StudentClass','ASC')
                                ->group_by('tb_students.StudentClass')
                                ->get()->result();

        echo json_encode($check_room);                    

    }

    public function report_pt(){ 
        require_once (APPPATH. '../vendor/vendor/autoload.php');

        $live_mpdf = new \Mpdf\Mpdf(
            array(
                'format' => 'A4',
                'mode' => 'utf-8',
                'default_font' => 'thsarabun',
                'default_font_size' => 16
            )
        );

        if($this->input->post('select_print') == "all"){
            
            $data['re_subjuct'] = $this->db
                            ->where('SubjectYear',$this->input->post('report_RegisterYear'))
                            ->where('SubjectCode',$this->input->post('report_SubjectCode'))
                            ->get('tb_subjects')->result();
            $data['re_room'] = $data['re_subjuct'][0]->SubjectClass; 
            $data['re_teacher'] = "";
            $data['set_score'] = $this->db->where('regscore_subjectID',$data['re_subjuct'][0]->SubjectID)->get('tb_register_score')->result();

            $data['check_student'] = $this->db->select('
                                    tb_register.SubjectCode,
                                    tb_register.RegisterYear,
                                    tb_register.RegisterClass,
                                    tb_register.Score100,
                                    tb_register.Grade,
                                    tb_register.TeacherID,
                                    tb_register.StudyTime,
                                    tb_subjects.SubjectName,
                                    tb_subjects.SubjectID,
                                    tb_subjects.SubjectUnit,
                                    tb_subjects.SubjectHour,
                                    tb_students.StudentID,
                                    tb_students.StudentPrefix,
                                    tb_students.StudentFirstName,
                                    tb_students.StudentLastName,
                                    tb_students.StudentNumber,
                                    tb_students.StudentClass,
                                    tb_students.StudentCode,
                                    tb_students.StudentStatus
                                ')
                                ->from('tb_register')
                                ->join('tb_subjects','tb_subjects.SubjectCode = tb_register.SubjectCode')
                                ->join('tb_students','tb_students.StudentID = tb_register.StudentID')
                                ->where('TeacherID',$this->session->userdata('login_id'))
                                ->where('RegisterYear',$this->input->post('report_RegisterYear'))
                                ->where('tb_register.SubjectCode',$this->input->post('report_SubjectCode'))
                                ->order_by('tb_students.StudentClass','ASC')
                                ->order_by('tb_students.StudentNumber','ASC')
                                ->get()->result();

            //echo "<pre>";print_r($data['check_student']); exit();

        }else{
             $data['re_subjuct'] = $this->db
                            ->where('SubjectYear',$this->input->post('report_RegisterYear'))
                            ->where('SubjectCode',$this->input->post('report_SubjectCode'))
                            ->get('tb_subjects')->result();
            $data['re_room'] = $this->input->post('select_print');
            $sub_room = explode(".",$this->input->post('select_print'));
            $sub_Year =  explode("/",$this->input->post('report_RegisterYear'));

            $data['re_teacher'] = $this->db->select('skjacth_personnel.tb_personnel.pers_id,
                                                    skjacth_academic.tb_regclass.Reg_Class,
                                                    skjacth_academic.tb_regclass.Reg_Year,
                                                    skjacth_personnel.tb_personnel.pers_prefix,
                                                    skjacth_personnel.tb_personnel.pers_firstname,
                                                    skjacth_personnel.tb_personnel.pers_lastname')
                                ->from('tb_regclass')
                                ->join('skjacth_personnel.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_regclass.class_teacher','left')
                                ->where('Reg_Year',$sub_Year[1])
                                ->where('Reg_Class',$sub_room[1])
                                ->get()->result(); 
          

        $data['set_score'] = $this->db->where('regscore_subjectID',$data['re_subjuct'][0]->SubjectID)->get('tb_register_score')->result();
        
        $data['check_student'] = $this->db->select('
                                    tb_register.SubjectCode,
                                    tb_register.RegisterYear,
                                    tb_register.RegisterClass,
                                    tb_register.Score100,
                                    tb_register.Grade,
                                    tb_register.TeacherID,
                                    tb_register.StudyTime,
                                    tb_subjects.SubjectName,
                                    tb_subjects.SubjectID,
                                    tb_subjects.SubjectUnit,
                                    tb_subjects.SubjectHour,
                                    tb_students.StudentID,
                                    tb_students.StudentPrefix,
                                    tb_students.StudentFirstName,
                                    tb_students.StudentLastName,
                                    tb_students.StudentNumber,
                                    tb_students.StudentClass,
                                    tb_students.StudentCode,
                                    tb_students.StudentStatus
                                ')
                                ->from('tb_register')
                                ->join('tb_subjects','tb_subjects.SubjectCode = tb_register.SubjectCode')
                                ->join('tb_students','tb_students.StudentID = tb_register.StudentID')
                                ->where('TeacherID',$this->session->userdata('login_id'))
                                ->where('RegisterYear',$this->input->post('report_RegisterYear'))
                                ->where('tb_register.SubjectCode',$this->input->post('report_SubjectCode'))
                                ->where('tb_students.StudentClass',$this->input->post('select_print'))
                                ->order_by('tb_students.StudentClass','ASC')
                                ->order_by('tb_students.StudentNumber','ASC')
                                ->get()->result();
           
        //echo '<pre>';print_r($data['check_student']); exit();
        }


        $data['test'] = $this->input->post('report_RegisterYear'); //true
        $ReportFront = $this->load->view('teacher/register/report/ReportFront',$data,true);        
        $live_mpdf->WriteHTML($ReportFront);

        $live_mpdf->AddPage(); 
        $ReportSummary = $this->load->view('teacher/register/report/ReportSummary',$data,true); 
        $live_mpdf->WriteHTML($ReportSummary);
        $live_mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE); 
    }


}


?>