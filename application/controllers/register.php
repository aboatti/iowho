<?php
class Register extends CI_Controller {

	function index()
	{

		$this->load->database();
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]|min_length[8]|callback_password_check');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('register');
		}
		else
		{
			$cryptographically_strong = false;
			
			while(!$cryptographically_strong){
				$salt = openssl_random_pseudo_bytes(64,$cryptographically_strong);
			}
			$salt   = bin2hex($salt);
			
			$password = hash("sha256",$salt.$this->input->post('password'));
			
			$email = $this->input->post('email');
			
			$sql = "INSERT INTO users (email,password,salt) values (?,?,?)";
			$this->db->query($sql, array($this->db->escape($email), $password, $salt));
			
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