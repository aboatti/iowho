<?php
class Register extends CI_Controller {

	function index()
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('register');
		}
		else
		{
			$this->load->view('registersuccess');
		}
	}
	/*public function index()
	{
		$this->load->view('register');
	}*/
}
?>