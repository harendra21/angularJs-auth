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

	public function addeditCategory(){
		$valid = $this->authModel->validate_token();
		if (!$valid) {
			$resp = array('error' => true,'status' => 'invalid', 'msg' => 'You are not logged in','data' => '');
			jsonResp($resp);
		}else{

			$msg = '';

			$json = file_get_contents('php://input');
			$post = json_decode($json)->formData;
			
			

			if(isset($post->category_id)){
				$resp = $this->categoryModel->editCategory($post);
				$msg = 'Category updated successfully';
			}else{
				$resp = $this->categoryModel->addCategory($post);
				$msg = 'Category added successfully';
			}
			
            if(!$resp){
            	$resp = array('error' => true,'status' => 'error', 'msg' => 'Something went wrong. Please try again !','data' => '');
				jsonResp($resp);
            }else{
            	$resp = array('error' => false,'status' => 'success', 'msg' => $msg,'data' => '');
				jsonResp($resp);
            }
			
		}
	}

}

/* End of file categoryCtrl.php */
/* Location: ./application/controllers/category/categoryCtrl.php */