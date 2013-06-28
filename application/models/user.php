<?php

class User extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //inserts a new user into the db and returns the new id
    function createNewUser($email,$password){
    	$this->load->library('password');
		
    	list($hashedPass,$salt) = $this->password->hashAndSalt($password);

		$data = array(
   			'email' => $email,
   			'password' => $hashedPass,
   			'salt' => $salt
		);
			
		$this->db->insert('users', $data); 
		$userID = $this->db->insert_id();
	}
	
	//validates email to password, returns true on success
	//should update to return specific error codes later
	function validateUser($email,$password){
		$query = $this->db->get_where('users', array('email' => $email));
		$row = $query->row();
		if(!$row){
			return false;
		}else{
			$salt = $row->salt;
			$storedHashedPass = $row->password;
			
			$generatedHashedPass = $this->password->hashAndSalt($password,$salt);
			
			if($storedHashedPass == $generatedHashedPass){
				return $row->id;
			}else{
				return false;
							
		}
		
	}
    
}

?>
