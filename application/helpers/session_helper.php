<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('redirectIfNotLoggedIn'))
{
	function redirectIfNotLoggedIn(){	
		$CI =& get_instance();
		$CI->load->library('session');
		$CI->load->helper('url');
		if(!$CI->session->userdata('logged_in')){
			redirect("/login");
		}
					
	}
}

?>

