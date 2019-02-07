<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HistoryModel extends CI_Model {
	public function frontHistoryCount($searchText){
		if (!empty($searchText)) {
			$this->db->like('country',$searchText);
		}
		$this->db->group_by('u_id');
		$data = $this->db->get('front_history');
		if ($data->num_rows() > 0) {
			return $data->num_rows();
		}else{
			return '0';
		}
	}
	public function frontHistory($limit,$offset,$searchText){
		if (!empty($searchText)) {
			$this->db->like('country',$searchText);
		}
		$this->db->group_by('u_id');
		$this->db->order_by('id','desc');
		$this->db->limit($limit,$offset);
		$data = $this->db->get('front_history');
        //print_r($this->db->last_query());
		if ($data->num_rows() > 0) {
			return $data->result();
		}else{
			return '';
		}
	}

}

/* End of file HistoryModel.php */
/* Location: ./application/models/history/HistoryModel.php */