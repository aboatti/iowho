<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function index()
	{
	
		$this->load->database();
		$this->load->helper(array('form', 'url'));
		
		$this->load->library('form_validation');
		
		$this->load->model('User');
		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('login');
		}
		else
		{
			
			if($userID = $this->User->validateUser($this->input->post('email'),$this->input->post('password'))){
				$sessionData = array('user_id' => $userID,"logged_in" => TRUE);
				$this->load->view('loginsuccess');				
			}else{
				$this->form_validation->set_message('login', 'Login Failed');
				$this->load->view('login');
			}
		}
	}

}
	
?>