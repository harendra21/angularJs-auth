<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require APPPATH . '/libraries/REST_Controller.php';
class AuthCtrl extends CI_Controller {

	

	private $token = null;

    public function __construct(){
        parent::__construct();
		$this->load->model('auth/authModel');
		
       
        if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
            die();
        }

        $this->token = substr($this->input->get_request_header('Authorization'), 6);
        
    }


	public function login(){
		$json = file_get_contents('php://input');
		$post = json_decode($json)->fromData;

		$loginEmail = $post->loginEmail;
		$loginPassword = $post->loginPassword;

		if (empty($loginEmail)) {
			$resp = array('error' => true,'status' => 'error', 'msg' => 'Please enter a valid email.','data' => null);
			jsonResp($resp);
		}else if (empty($loginPassword)) {
			$resp = array('error' => true,'status' => 'error', 'msg' => 'Please enter a valid password.','data' => null);
			jsonResp($resp);
		}else if (strlen($loginPassword) < 8) {
			$resp = array('error' => true,'status' => 'error', 'msg' => 'Password should must be 8 charectrs long.Please enter a valid password.','data' => null);
			jsonResp($resp);
		}else{
			$checkEmail = $this->authModel->checkLoginEmail($loginEmail);
			if (!$checkEmail) {
				$resp = array('error' => true,'status' => 'error', 'msg' => 'This email is not register with us.Please enter a valid email or register.','data' => null);
				jsonResp($resp);
			}else{
				$doLogin = $this->authModel->doLogin($loginEmail,$loginPassword);
				if (empty($doLogin)) {
					$resp = array('error' => true,'status' => 'error', 'msg' => 'Email or Password is/are wrong.','data' => null);
					jsonResp($resp);
				}else{
					$token = $this->genrate_token($doLogin->id);
					$data_array = array(
					    'm01_login_user_id' => $doLogin->id,
					    'm01_login_token' => $token,
					    'm01_login_at' => date('Y-m-d H:i:s'),
					    'm01_login_status' => '1'
					);
					$this->db->insert('m01_user_login_details',$data_array);
					$insertID = $this->db->insert_id();
					$resp = array('error' => false,'status' => 'success', 'msg' => 'You have successfully logged in.','data' => $token);
					jsonResp($resp);
				}
			}
		}
	}


	public function genrate_token($id){
        $tokenData = array();
		$tokenData['id'] = $id; //TODO: Replace with data for token
        $tokenData['timestamp'] = now();
        $output['token'] = AUTHORIZATION::generateToken($tokenData);
		return $output['token'];
	}
	public function loginUserDetails(){
		// $json = file_get_contents('php://input');
		// $post = json_decode($json)->fromData;

		// $token = $post->token;

		
		$valid = $this->authModel->validate_token();
		if (!$valid) {
			$resp = array('error' => true,'status' => 'invalid', 'msg' => 'You are not logged in','data' => '');
			jsonResp($resp);
		}else{
			$user = $this->authModel->getUserDetailByToken($this->token);
			$resp = array('error' => false,'status' => 'success', 'msg' => 'User Details.','data' => $user);
			jsonResp($resp);
		}
		// die();
		// $userInfo = $this->authModel->loginUserDetails($loginEmail);
		// if ($userInfo) {
		// 	$data = $userInfo;
		// 	$resp = array('error' => false,'status' => 'success', 'msg' => 'You have successfully logged in.','data' => $data);
		// 	jsonResp($resp);
		// }
				

	}

}

/* End of file AuthCtrl.php */
/* Location: ./application/controllers/auth/AuthCtrl.php */