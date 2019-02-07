<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ProfileModel extends CI_Model {
	public function updateProfile($data){
		$email = $data->email;
		$fName = $data->fName;
		$mName = $data->mName;
		$lName = $data->lName;
		$image = $data->image;
		$this->db->set('m01_user_first_name',$fName);
		$this->db->set('m01_user_middle_name',$mName);
		$this->db->set('m01_user_last_name',$lName);
		if (!empty($image)) {
			$this->db->set('m01_user_image',$image);
		}
		$this->db->where('m01_user_email',$email);
		return $this->db->update('m01_user');
	}
}
/* End of file profileModel.php */
/* Location: ./application/models/profile/profileModel.php */