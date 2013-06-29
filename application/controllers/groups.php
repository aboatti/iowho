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
	

		echo "welcome to groups!!";	
	}

	public function create()
	{	
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		//$this->load->model('User');
		
		$this->form_validation->set_rules('name', 'Group Name', 'trim|required|max_length[78]');
		$this->form_validation->set_rules('description', 'Description', 'trim|max_length[253]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('creategroup');
		}
		else
		{	
			$this->load->model('group');
			$groupID = $this->group->createGroup($this->input->post('name'),$this->input->post('description'));
			$this->group->addUser($this->session->userdata("user_id"),$groupID);
			$this->load->view("groups");
		}
		//echo "create a group"; 
	}		

}
	
?>
