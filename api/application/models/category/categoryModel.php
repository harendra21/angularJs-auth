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
		$this->db->where('category_status !=','deleted');
		$this->db->limit($limit,$offset);
		$data = $this->db->get('category');
        //print_r($this->db->last_query());
		if ($data->num_rows() > 0) {
			return $data->result();
		}else{
			return '';
		}
	}

	public function editCategory($data){
		$category_id = $data->category_id;
		$category_name = $data->category_name;
		$category_description = $data->category_description;
		$category_page_title = $data->category_page_title;
		$category_meta_keyword = $data->category_meta_keyword;
		$category_meta_description = $data->category_meta_description;
		$category_status = $data->category_status;
		$data_array = array(
	        'm01_category_name' => $category_name,
	        'm01_category_description' => $category_description,
	        'm01_category_url' => str_replace(' ', '-', strtolower($category_name)),
	        'm01_category_page_title' => $category_page_title,
	        'm01_category_meta_keyword' => $category_meta_keyword,
	        'm01_category_meta_description' => $category_meta_description,
	        'm01_category_status' => $category_status
		);
		$this->db->where('m01_category_id',$category_id);
		return $this->db->update('m01_category',$data_array);
	}

	public function addCategory($data){
		$category_name = $data->category_name;
		$category_description = $data->category_description;
		$category_page_title = $data->category_page_title;
		$category_meta_keyword = $data->category_meta_keyword;
		$category_meta_description = $data->category_meta_description;
		$category_status = $data->category_status;
		$data_array = array(
	        'm01_category_name' => $category_name,
	        'm01_category_description' => $category_description,
	        'm01_category_url' => str_replace(' ', '-', strtolower($category_name)),
	        'm01_category_page_title' => $category_page_title,
	        'm01_category_meta_keyword' => $category_meta_keyword,
	        'm01_category_meta_description' => $category_meta_description,
	        'm01_category_status' => $category_status
		);
		
		return $this->db->insert('m01_category',$data_array);
	}

}

/* End of file categoryModel.php */
/* Location: ./application/models/category/categoryModel.php */