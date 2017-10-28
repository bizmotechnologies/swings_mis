<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

//Database setup controller
class Db_setup extends CI_Controller
{
	public function index(){
				
		$this->load->view('pages/admin_login.php');
	}

			
}
?>