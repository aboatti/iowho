<?php

class Group extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    //inserts a group into the db and returns the new id
    function createGroup($name,$description)
    {
		$userID = $this->session->userdata("user_id");
		$data = array(
   			'name' => $name,
   			'description' => $description,
   			'created' => date("Y-m-d H:i:s"),
   			'creator' => $userID
		);
			
		$this->db->insert('groups', $data); 
		$groupID = $this->db->insert_id();
		
		return $groupID;
	}
	
	//adds a user to a group
	function addUser($userID,$groupID){
		
		$data = array(
   			'group_id' => $groupID,
   			'user_id' => $userID,
		);
		
		$this->db->insert('group_members', $data); 
	}
}
?>
