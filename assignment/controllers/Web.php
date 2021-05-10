<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {
	public function index()
	{
		$this->load->view('user_form');
	}

	public function form_submit(){
		session_start();
		if($_POST['captcha']==$_SESSION['captcha_text']){
			$response = array("success"=>1,"message"=>"Form submitted.");
		}else{
			$response = array("success"=>0,"message"=>"Captcha not match");
		}
		header("Content-type: application/json");
		echo json_encode($response);
	}
}
