<?php

class User extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('password');
    }
    
    //inserts a new user into the db and returns the new id
    function createNewUser($email,$password)
    {
		list($hashedPass,$salt) = $this->password->hashAndSalt($password);

		$data = array(
   			'email' => $email,
   			'password' => $hashedPass,
   			'salt' => $salt
		);
			
		$this->db->insert('users', $data); 
		$userID = $this->db->insert_id();
		return $userID;
	}
	
	//validates email to password, returns true on success
	//should update to return specific error codes later
	function validateUser($email,$password){
		$query = $this->db->get_where('users', array('email' => $email));
		$row = $query->row() ;
		if(!$row){
			return false;
		}else{
			$salt = $row->salt;
			$storedHashedPass = $row->password;
			
			list($generatedHashedPass,$salt) = $this->password->hashAndSalt($password,$salt);
			
			if($storedHashedPass == $generatedHashedPass){
				return $row->id;
			}else{
				return false;
			}
		}   
	}
	
	//returns an array of all the groups the member is in
	function getUserGroups($userID){
		$this->db->select('groups.name,groups.description,groups.id');
		$this->db->from('groups');
		$this->db->join('group_members', 'group_members.group_id = groups.id');
		$this->db->where('group_members.user_id',$userID);
		$query = $this->db->get();
		
		$groups = array();
		foreach($query->result_array() as $row){
			$groups[] = $row;
		}
		
		return $groups;
	}
}
?>
