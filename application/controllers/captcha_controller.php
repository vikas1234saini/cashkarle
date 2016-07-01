<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Captcha_Controller extends CI_Controller {
	// Load Helper in and Start session.
	function __construct() {
		parent::__construct();
		$this->load->helper('captcha');
		$this->load->library('session');
		$this->load->helper('url');
	//	session_start();
	}
	// For new image on click refresh button.
	public function captcha_refresh(){
		$vals = array(
			'img_path'	=> './captcha/',
			'img_url'	=> base_url('captcha')."/",
			'img_width'	=> 100,
			'img_height' => 30,
			'expiration' => 7200
		);
		$captcha = create_captcha($vals);
	   	$this->session->set_userdata('captcha', $captcha['word']);
		echo $captcha['image'];
	
	}
}
?>