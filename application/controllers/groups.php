<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		redirectIfNotLoggedIn();
		$this->load->model('group');
	}	
	public function index()
	{
		$this->load->model('User');
		$groups = $this->User->getUserGroups($this->session->userdata("user_id"));
		$data['groups'] = $groups;
		$this->load->view("groups",$data);
	}

	public function create()
	{	
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		//$this->load->model('User');
		
		$this->form_validation->set_rules('name', 'Group Name', 'trim|required|valid_email|');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('creategroup');
		}
		else
		{	
			$groupID = $this->group->createGroup($this->input->post('name'),$this->input->post('description'));
			$this->group->addUser($this->session->userdata("user_id"),$groupID);
			redirect("/groups");
		}
		//echo "create a group"; 
	}		
	
	public function invite()
	{	
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		//$this->load->model('User');
		
		$this->form_validation->set_rules('email', 'Friend\'s email', 'trim|required|max_length[78]|callback_existing_user');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('invite_to_group');
		}
		else
		{	
			$groupID = $this->group->createGroup($this->input->post('name'),$this->input->post('description'));
			$this->group->addUser($this->session->userdata("user_id"),$groupID);
			redirect("/groups");
		}
		//echo "create a group"; 
	}
	
	private function existing_user($str){
		$this->load->model('User');
		if(!isUser($str)){
			$this->form_validation->set_message('password_check', 'This person is not a member"');
			return false;
		}else{
			return true;
		}
	}
}
	
?>
