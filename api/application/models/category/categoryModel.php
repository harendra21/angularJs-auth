<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends CI_Model {

	public function categoryCount($searchText){
		if (!empty($searchText)) {
			$this->db->like('category_name',$searchText);
		}
		
		$data = $this->db->get('category');
		if ($data->num_rows() > 0) {
			return $data->num_rows();
		}else{
			return '0';
		}
	}
	public function category($limit,$offset,$searchText){
		if (!empty($searchText)) {
			$this->db->like('category_name',$searchText);
		}
		
		$this->db->order_by('category_id','desc');
		$this->db->limit($limit,$offset);
		$data = $this->db->get('category');
        //print_r($this->db->last_query());
		if ($data->num_rows() > 0) {
			return $data->result();
		}else{
			return '';
		}
	}

}

/* End of file categoryModel.php */
/* Location: ./application/models/category/categoryModel.php */