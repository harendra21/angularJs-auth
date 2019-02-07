<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeCtrl extends CI_Controller {

	public function index(){
		echo '{"msg" : "Welcome"}';
	}
	public function fileUpload(){
		if ($_GET['type'] == 'image') {
			if ($_GET['for'] == 'profile') {
				$folder = 'uploads/user/';
			}
			if(!empty($_FILES['file']['name'])){
				$this->load->helper('fileUpload');
			    $upload_img = imageUpload('file',$folder,'',TRUE,$folder.'thumbs/','100','100');
			    echo $upload_img;  
			}else{
			    $thumb_src = '';
			    $message = '';
			}
		}
	}
}
/* End of file HomeCtrl.php */
/* Location: ./application/controllers/HomeCtrl.php */