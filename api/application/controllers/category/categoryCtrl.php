<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryCtrl extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('auth/authModel');
		$this->load->model('category/categoryModel');
		if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
            die();
        }
	}

	public function getCategory(){
		$valid = $this->authModel->validate_token();
		if (!$valid) {
			$resp = array('error' => true,'status' => 'invalid', 'msg' => 'You are not logged in','data' => '');
			jsonResp($resp);
		}else{
			$page 			= $_GET['page']-1;
			$perPage 		= $_GET['size'];
			$searchText 	= $_GET['search'];
			$offset 		= $page*$perPage;
			$count 			= $this->categoryModel->categoryCount($searchText);
			$category 		= $this->categoryModel->category($perPage,$offset,$searchText);
			
            $catData = array('count' => $count, 'category' => $category);
            $resp = array('error' => false,'status' => 'success', 'msg' => 'History.','data' => $catData);
            jsonResp($resp);
			
		}
	}

}

/* End of file categoryCtrl.php */
/* Location: ./application/controllers/category/categoryCtrl.php */