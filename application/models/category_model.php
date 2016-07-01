<?php
class Category_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_category_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    public function get_category_by_title($title=false)
    {
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->like('categoryName', $title,'both');
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Fetch category data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_category($search_string=false, $order=false, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('c.*,cp.categoryName as parentName');
		
		$this->db->from('tbl_category as c');
		if($search_string){
			$this->db->like('c.categoryName', $search_string,"both");
		}

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}
	    $this->db->where('c.parentId != ', '0');

		$this->db->limit($limit_start, $limit_end);
		$this->db->join('tbl_category as cp', 'cp.id = c.parentId', 'left');
		//$this->db->limit('4', '4');

		$query = $this->db->get();
//		echo $this->db->last_query();
		$result = $query->result_array();
		return $result; 	
    }

    /**
    * Count the number of rows
    * @param int $categoryName
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_category($search_string=false, $order=false, $status=false)
    {
		$this->db->select('*');
		$this->db->from('tbl_category');
		if($search_string!=false){
			$this->db->like('categoryName', $search_string,"both");
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_category($data)
    {
		$insert = $this->db->insert('tbl_category', $data);
	    return $insert;
	}

    /**
    * Update category
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_category($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_category', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

    /**
    * Delete category
    * @param int $id - category id
    * @return boolean
    */
	function delete_category($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_category'); 
	}
 
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_all_parent_category()
    {
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->where('parentId', '0');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_all_main_category()
    {
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->where('parentId != ', '0');
		$this->db->where('status', '1');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_all_category($parentId=0)
    {
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->where('parentId', $parentId);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_rand_category()
    {
		
		//$sql = "SELECT * FROM tbl_category where snapdealUrl!='' and flipkartUrl!='' and  parentId!='0' order by rand() limit 1";
		
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->where('snapdealUrl != ', '');
		$this->db->where('flipkartUrl != ', '');
		$this->db->where('status', '1');
//		$this->db->where('parentId != ', '0');
	    $this->db->order_by('id', 'RANDOM');
	
		$this->db->limit(1, 0);
		
		$query = $this->db->get();
	//	echo $this->db->last_query();
		return $query->result_array(); 
    }
}
?>