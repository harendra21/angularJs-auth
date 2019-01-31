<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

	public function checkLoginEmail($email){
		$chkEmail = $this->db->where('user_email',$email)->order_by('user_id','DESC')->get('admin_user')->num_rows();
		if ($chkEmail > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function doLogin($email,$password){
		$password = md5($password);
		$userData = $this->db->select('user_id as id')->where('user_email',$email)->where('user_password',$password)->order_by('user_id','DESC')->get('admin_user');
		
		if ($userData->num_rows() > 0) {
			return $userData->row();
		}else{
			return '';
		}
	}

	public function loginUserDetails($email){
		$userData = $this->db->select('user_email as email,user_first_name as fName,user_middle_name as mName, user_last_name as lName, user_role as role, user_image as image,user_last_login as lastLogin')->where('user_email',$email)->order_by('user_id','DESC')->get('admin_user');
		
		if ($userData->num_rows() > 0) {
			return $userData->row();
		}else{
			return '';
		}
	}

	public function validateUser($token){
		//print_r($token);
		$user = $this->db->where('m01_login_token',$token)->get('m01_user_login_details')->row();
		
		$logDetailID 	= $user->m01_login_detail_id;
	    $loginUserID 	= $user->m01_login_user_id;
	    $loginTime 		= $user->m01_login_at;
	    $loginStatus 	= $user->m01_login_status;

	    $currTime = date("Y-m-d H:i:s");

	    $validLoginTime = date("Y-m-d H:i:s",strtotime('+4 hours',strtotime($loginTime)));

	    if($validLoginTime <= $currTime){
	    	return false;
	    }else{
	    	$this->db->set('m01_login_at',$currTime);
	    	$this->db->where('m01_login_token',$token);
	    	$this->db->update('m01_user_login_details');

	    	return true;
	    }
	}

	public function getUserDetailByToken($token){
		$user = $this->db->where('m01_login_token',$token)->get('m01_user_login_details')->row();
		$loginUserID 	= $user->m01_login_user_id;
		$userData = $this->db->select('user_email as email,user_first_name as fName,user_middle_name as mName, user_last_name as lName, user_role as role, user_image as image,user_last_login as lastLogin')->where('user_id',$loginUserID)->order_by('user_id','DESC')->get('admin_user')->row();
		return $userData;
	}
	

}

/* End of file authModel.php */
/* Location: ./application/models/auth/authModel.php */