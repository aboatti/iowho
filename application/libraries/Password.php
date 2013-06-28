<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Password {

	//Hashes and salts a password
	//returns array
    public function hashAndSalt($password,$salt = -1)
    {
    	$cryptographically_strong = false;
		if($salt == -1){	
			while(!$cryptographically_strong){
				$salt = openssl_random_pseudo_bytes(32,$cryptographically_strong);
			}
			$salt   = bin2hex($salt);
		}
			
		$password = hash("sha256",$salt.$password);
		
		return array($password,$salt);
    }
}
