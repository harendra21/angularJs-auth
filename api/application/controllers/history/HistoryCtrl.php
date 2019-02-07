<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HistoryCtrl extends CI_Controller {

	public function __construct(){
		parent::__construct();
			$this->load->model('history/HistoryModel');
			$this->load->model('auth/authModel');
			if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
	            die();
	        }

        //$this->token = substr($this->input->get_request_header('Authorization'), 6);
	} 
	public function getFrontHistory(){
		$valid = $this->authModel->validate_token();
		if (!$valid) {
			$resp = array('error' => true,'status' => 'invalid', 'msg' => 'You are not logged in','data' => '');
			jsonResp($resp);
		}else{
			$page 			= $_GET['page']-1;
			$perPage 		= $_GET['size'];
			$searchText 	= $_GET['search'];
			$offset 		= $page*$perPage;
			$count 			= $this->HistoryModel->frontHistoryCount($searchText);
			$history 		= $this->HistoryModel->frontHistory($perPage,$offset,$searchText);
			
            $historyData = array('count' => $count, 'history' => $history);
            $resp = array('error' => false,'status' => 'success', 'msg' => 'History.','data' => $historyData);
            jsonResp($resp);
			
		}
	}
}

/* End of file HistoryCtrl.php */
/* Location: ./application/controllers/history/HistoryCtrl.php */