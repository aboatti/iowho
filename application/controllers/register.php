<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	function index()
	{

		$this->load->database();
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		$this->load->model('User');
		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]|min_length[8]|callback_password_check');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('register');
		}
		else
		{
			$userID = $this->user->createNewUser($this->input->post('email'),$this->input->post('password'));
			
			$sessionData = array('user_id' => $userID,"logged_in" => TRUE);
			
			$this->session->set_userdata($sessionData );
			$this->load->view('registersuccess');
		}
	}
	
	public function password_check($str){
		if($str == "password"){
			$this->form_validation->set_message('password_check', 'Your password cannot be "Password"');
			return false;
		}else{
			return true;
		}
	}
	/*public function index()
	{
		$this->load->view('register');
	}*/
}
?>
