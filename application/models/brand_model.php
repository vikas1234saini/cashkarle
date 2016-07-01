<?php
class Brand_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get brand by his is
    * @param int $brand_id 
    * @return array
    */
    public function get_brand_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('tbl_brand');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Fetch brand data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_brand($search_string=false, $order=false, $order_type='Asc', $limit_start, $limit_end) {
	    
		$this->db->select('c.*,cp.brandName as parentName');
		
		$this->db->from('tbl_brand as c');
		if($search_string){
			$this->db->like('c.brandName', $search_string,"both");
		}

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}
//	    $this->db->where('c.parentId != ', '0');

		$this->db->limit($limit_start, $limit_end);
		$this->db->join('tbl_brand as cp', 'cp.id = c.parentId', 'left');
		//$this->db->limit('4', '4');

		$query = $this->db->get();
//		echo $this->db->last_query();
		$result = $query->result_array();
		return $result; 	
    }

    /**
    * Count the number of rows
    * @param int $brandName
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_brand($search_string=false, $order=false, $status=false)
    {
		$this->db->select('*');
		$this->db->from('tbl_brand');
		if($search_string!=false){
			$this->db->like('brandName', $search_string,"both");
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_brand($data)
    {
		$insert = $this->db->insert('tbl_brand', $data);
	    return $insert;
	}

    /**
    * Update brand
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_brand($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_brand', $data);
//		echo $this->db->last_query();
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
    * Delete brand
    * @param int $id - brand id
    * @return boolean
    */
	function delete_brand($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_brand'); 
	}
 
    /**
    * Get brand by his is
    * @param int $brand_id 
    * @return array
    */
    public function get_all_brand($parentId=0)
    {
		$this->db->select('*');
		$this->db->from('tbl_brand');
		$this->db->where('parentId', $parentId);
		
		$query = $this->db->get();
		return $query->result_array(); 
    }
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_rand_brand()
    {
		
		//$sql = "SELECT * FROM tbl_category where snapdealUrl!='' and flipkartUrl!='' and  parentId!='0' order by rand() limit 1";
		
		$this->db->select('*');
		$this->db->from('tbl_brand');
		$this->db->where('status', '1');
//		$this->db->where('parentId != ', '0');
	    $this->db->order_by('id', 'RANDOM');
	
		$this->db->limit(1, 0);
		
		$query = $this->db->get();
	//	echo $this->db->last_query();
		return $query->result_array(); 
    }
	
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_all_parent_brand()
    {
		$this->db->select('*');
		$this->db->from('tbl_brand');
		$this->db->where('parentId', '0');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_all_main_brand($search_string=false)
    {
		$this->db->select('c.*,cp.brandName as parentName');
		
		$this->db->from('tbl_brand as c');
		$this->db->join('tbl_brand as cp', 'cp.id = c.parentId', 'left');
		$this->db->where('c.parentId != ', '0');
		if($search_string){
			$this->db->like('brandName', $search_string,"both");
		}
		$this->db->where('c.status', '1');
		$query = $this->db->get();
		return $query->result_array(); 
    }
}
?>