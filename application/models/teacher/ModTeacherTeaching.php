<?php
class ModTeacherTeaching extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->DBAffairs= $this->load->database('affairs', TRUE);
    }

    function RoomOnlineInsert($data){        
        $result = $this->db->insert('tb_room_online',$data);
        return $result;
    }
    function RoomOnlineUpdate($data,$id){        
        $result = $this->db->update('tb_room_online',$data,'roomon_id="'.$id.'"');
        return $result;
    }
    public function RoomOnlineDelete($data)
	{		
				$this->db->where('roomon_id', $data);
		return 	$this->db->delete('tb_room_online');
	}

    public function CheckHomeRoomInsert($data){
        $result = $this->DBAffairs->insert('tb_checkhomeroom',$data);
        return $result;
    }

    public function CheckHomeRoomUpdate($data,$id){
        $result = $this->DBAffairs->update('tb_checkhomeroom',$data,'chk_home_id="'.$id.'"');
        return $result;
    }

    public function Mo_CHR_CheckStudent($data,$id){
        $chk_home = $this->DBAffairs->select("$data,chk_home_id")
                                    ->where('chk_home_id',$id)
                                    ->get('tb_checkhomeroom')->result();
        $ho = count(explode("|",$chk_home[0]->$data));
        $ho1 = explode("|",$chk_home[0]->$data);

        $data = array();
        for ($i=0; $i < $ho; $i++) {            

            $result = $this->db->select('StudentNumber,StudentClass,StudentCode,StudentPrefix,StudentFirstName,StudentLastName')
                            ->where('StudentCode',$ho1[$i])
                            ->get('tb_students')->result();
                      
            array_push($data,$result);      

        }        
        return $data;
    }

 
}