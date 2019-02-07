<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileCtrl extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('auth/authModel');
		$this->load->model('profile/profileModel');
		if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
            die();
        }
	}

	public function updateProfile(){
		$valid = $this->authModel->validate_token();
		if (!$valid) {
			$resp = array('error' => true,'status' => 'invalid', 'msg' => 'You are not logged in','data' => '');
			jsonResp($resp);
		}else{
			$json = file_get_contents('php://input');
			$post = json_decode($json);
						
			$resp = $this->profileModel->updateProfile($post);
			
			if (!$resp) {
				$resp = array('error' => true,'status' => 'error', 'msg' => 'Something went wrong. Please try again','data' => '');
				jsonResp($resp);
			}else{
				$resp = array('error' => false,'status' => 'success', 'msg' => 'Profile is updated successfully !','data' => '');
				jsonResp($resp);
			}
		}
	}

	public function send_sms(){
		$this->load->helper('sendsms');
		$resp = send_sms();
		print_r($resp);
	}
}
/* End of file profileCtrl.php */
/* Location: ./application/controllers/profile/profileCtrl.php */