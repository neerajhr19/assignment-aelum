<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {
	public function index()
	{
		$this->load->view('user_form');
	}

	public function form_submit(){
		// submit form data
		session_start();
		// validate captcha
		if($_POST['captcha']==$_SESSION['captcha_text']){
			$response = array("success"=>1,"message"=>"Form submitted.");
		}else{
			$response = array("success"=>0,"message"=>"Captcha not match");
		}
		header("Content-type: application/json");
		echo json_encode($response);
	}

	public function refreshcapcha(){        		// create captcha
        $this->load->helper('captcha');
        $vals = array(
          'img_path'      => 'assets/captcha/',
          'img_url'       => base_url('assets/captcha/'),
          'img_width'     => '150',
          'img_height'    => 50,
          'expiration'    => 7200,
          'word_length'   => 6,
          'font_path'     => 'assets/captcha/fonts/Boogaloo-Regular.ttf',
          'font_size'     => '20',
          'pool'          => '23456789ABCDEFGHJKMNPQRSTUVWXYZ',
          'colors'        => array(
              'background' => array(105,105,105),
              'border' => array(255,255,255),
              'text' => array(0, 0, 0),
              'grid' => array(255, 255, 255)
            )
        );
        $cap = create_captcha($vals);
        $path = 'assets/captcha/' . $cap['filename'];
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $cap_image = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $cap['newImage']=$cap_image;
        unlink('assets/captcha/' . $cap['filename']);
		session_start();
		$_SESSION['captcha_text'] = $cap['word'];
        header('Content-type: application/json');
        echo json_encode($cap);
    }

}
