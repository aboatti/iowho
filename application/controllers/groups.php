<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		redirectIfNotLoggedIn();
	//	$this->load->model('Groups');
	}	
	public function index()
	{
		$this->load->database();
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		$this->load->model('User');
		echo "welcome to groups!!";	
	}

	public function create()
	{
		echo "create a group";
	}		

}
	
?>
