<?php
class Banner_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get banner by his is
    * @param int $banner_id 
    * @return array
    */
    public function get_banner_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('tbl_banner');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Fetch banner data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_banner($search_string=false, $order=false, $order_type='Asc', $limit_start, $limit_end) {
	    
		$this->db->select('c.*');
		
		$this->db->from('tbl_banner as c');
		if($search_string){
			$this->db->like('c.link', $search_string,"both");
		}

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}
//	    $this->db->where('c.parentId != ', '0');

		$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');

		$query = $this->db->get();
//		echo $this->db->last_query();
		$result = $query->result_array();
		return $result; 	
    }

    /**
    * Count the number of rows
    * @param int $link
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_banner($search_string=false, $order=false, $status=false)
    {
		$this->db->select('*');
		$this->db->from('tbl_banner');
		if($search_string!=false){
			$this->db->like('link', $search_string,"both");
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_banner($data)
    {
		$insert = $this->db->insert('tbl_banner', $data);
	    return $insert;
	}

    /**
    * Update banner
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_banner($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_banner', $data);
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
    * Delete banner
    * @param int $id - banner id
    * @return boolean
    */
	function delete_banner($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_banner'); 
	}
 
    /**
    * Get banner by his is
    * @param int $banner_id 
    * @return array
    */
    public function get_all_banner($parentId=0)
    {
		$this->db->select('*');
		$this->db->from('tbl_banner');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_anner_banner()
    {
		
		//$sql = "SELECT * FROM tbl_category where snapdealUrl!='' and flipkartUrl!='' and  parentId!='0' order by anner() limit 1";
		
		$this->db->select('*');
		$this->db->from('tbl_banner');
		$this->db->where('status', '1');
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
    public function get_all_parent_banner()
    {
		$this->db->select('*');
		$this->db->from('tbl_banner');
		$this->db->where('parentId', '0');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_all_main_banner()
    {
		$this->db->select('c.*');
		
		$this->db->from('tbl_banner as c');
		$this->db->where('c.status', '1');
		$query = $this->db->get();
		return $query->result_array(); 
    }
}
?>