<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends CI_Controller {

	function index()
	{
		redirectIfNotLoggedIn();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		$this->load->model('User');
		echo "welcome to groups!!";	
	}
	

}
	
?>
