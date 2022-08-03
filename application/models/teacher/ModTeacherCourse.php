<?php
class ModTeacherCourse extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
    }

    function plan_insert($data){        
        $result = $this->db->insert('tb_send_plan',$data);
        return $this->db->insert_id();
;
    }

    function plan_update($data,$id){        
        $result = $this->db->update('tb_send_plan',$data,'seplan_ID='.$id);
        return $result;
    }

    function plan_setting($data,$id){
        $result = $this->db->update('tb_send_plan_setup',$data,'seplanset_ID='.$id);
        return $result;
    }

    function plan_setting_update_teacher($data,$id,$year,$term){
        $IF = array('seplan_coursecode'=>$id,'seplan_year' => $year,'seplan_term' => $term);
        $result = $this->db->update('tb_send_plan',$data,$IF);
        return $result;
    }

    function plan_setting_delete_teacher($id,$year,$term,$name){
        $IF = array('seplan_coursecode'=>$id,'seplan_year' => $year,'seplan_term' => $term);
        $result = $this->db->delete('tb_send_plan',$IF);

        $dir_path = 'uploads/academic/course/plan/'.$year.'/'.$term.'/'.$name;
        $del_path = './uploads/academic/course/plan/'.$year.'/'.$term.'/'.$name;
        if(is_dir($dir_path))
        {
            delete_files($del_path, true);
            rmdir($del_path);
        }       
       return $id;
    }



    function plan_UpdateStatus1($data,$id){
        $result = $this->db->update('tb_send_plan',$data,'seplan_ID='.$id);
        return $result;
    }
    function plan_UpdateStatus2($data,$id){
        $result = $this->db->update('tb_send_plan',$data,'seplan_ID='.$id);
        return $result;
    }

    function plan_UpdateComment1($data,$id){
        $result = $this->db->update('tb_send_plan',$data,'seplan_ID='.$id);
        return $result;
    }

    function plan_UpdateComment2($data,$id){
        $result = $this->db->update('tb_send_plan',$data,'seplan_ID='.$id);
        return $result;
    }
 
}