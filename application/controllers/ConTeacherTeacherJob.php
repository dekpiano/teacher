<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConTeacherTeacherJob extends CI_Controller {
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
        $teacher = $this->db->select('skjacth_personnel.tb_personnel.pers_prefix,
        skjacth_personnel.tb_personnel.pers_firstname,
        skjacth_personnel.tb_personnel.pers_lastname,
        skjacth_personnel.tb_personnel.pers_id,
        skjacth_academic.tb_regclass.Reg_Year,
        skjacth_academic.tb_regclass.Reg_Class')
        ->join($DBpersonnel->database.'.tb_personnel','skjacth_personnel.tb_personnel.pers_id = skjacth_academic.tb_regclass.class_teacher')
        ->where('pers_id',$this->session->userdata('login_id'))
        ->where('Reg_Year','2565')
        ->get('tb_regclass')->result();

        return $teacher;
    }

    public function CheckNameFrontSchoolMain(){
        $data['title']  = "เช็คชื่อหน้าโรงเรียน";       
        $data['teacher'] = $this->TeacRoom();
        $data['OnOff'] = $this->db->select('*')->get('tb_send_plan_setup')->result();

        
        $this->load->view('teacher/layout/header_teacher.php',$data);
        $this->load->view('teacher/layout/navbar_teaher.php');        
        $this->load->view('teacher/TeacherJob/CheckNameFrontSchool/CheckNameFrontSchoolMain.php');
        $this->load->view('teacher/layout/footer_teacher.php'); 
    }


        public function CheckNameFrontSchoolInsert(){
            $DBaffairs = $this->load->database('affairs', TRUE);
            $checkStu = $DBaffairs->where('cnfs_stuid',$this->input->post('IdStu'))
            ->where('cnfs_date',date('Y-m-d'))
            ->where('cnfs_sector','เช้า')
            ->get('tb_checknamefrontschool')->num_rows();

            if($checkStu == 0){
                $data = array('cnfs_stuid' => $this->input->post('IdStu'),
                'cnfs_date' => date('Y-m-d'),
                'cnfs_time' => date('H:i:s'),
                'cnfs_status' => 'ปกติ',
                'cnfs_sector' => 'เช้า',
                'cnfs_teacid' => $this->session->userdata('login_id')
             );
                $AddStu = $DBaffairs->insert('tb_checknamefrontschool',$data);
                if($AddStu){
                    $DataStu = $this->db->select('
                    skjacth_academic.tb_students.StudentClass,
                    skjacth_academic.tb_students.StudentCode,
                    skjacth_academic.tb_students.StudentPrefix,
                    skjacth_academic.tb_students.StudentFirstName,
                    skjacth_academic.tb_students.StudentLastName,
                    skjacth_affairs.tb_checknamefrontschool.cnfs_date,
                    skjacth_affairs.tb_checknamefrontschool.cnfs_time,
                    skjacth_affairs.tb_checknamefrontschool.cnfs_status,
                    skjacth_affairs.tb_checknamefrontschool.cnfs_ID
                    ')
                    ->from('skjacth_academic.tb_students')
                    ->join('skjacth_affairs.tb_checknamefrontschool','skjacth_affairs.tb_checknamefrontschool.cnfs_stuid = skjacth_academic.tb_students.StudentCode')
                    ->where('tb_students.StudentCode',$this->input->post('IdStu'))
                    ->where('tb_checknamefrontschool.cnfs_date',date('Y-m-d'))
                    ->get()->result();
                    echo json_encode($DataStu);
                }
            }else{
                echo json_encode(0);
            }

            
        }
}




?>
