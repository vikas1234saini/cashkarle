<?php
class Flipkartdiscount_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get flipkartdiscount by his is
    * @param int $flipkartdiscount_id 
    * @return array
    */
    public function get_flipkartdiscount_by_id($id) {
		
		$this->db->select('o.*');
		$this->db->from('tbl_flipkartdiscount as o');
		
		$this->db->where('o.id', $id);
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
    public function get_flipkartdiscount($search_string=false, $order=false, $order_type='Asc', $limit_start, $limit_end) {
	    
		$this->db->select('o.*');
		$this->db->from('tbl_flipkartdiscount as o');
		
		if($search_string){
			$this->db->like('o.category', $search_string,"both");
		}
		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('o.id', $order_type);
		}
		$this->db->limit($limit_start, $limit_end);

		$query = $this->db->get();
//		echo $this->db->last_query();
		$result = $query->result_array();
		return $result; 	
    }

    /**
    * Count the number of rows
    * @param int $flipkartdiscountName
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_flipkartdiscount($search_string=false, $order=false, $status=false)   {
		$this->db->select('*');
		$this->db->from('tbl_flipkartdiscount');
		if($search_string!=false){
			$this->db->like('category', $search_string,"both");
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_flipkartdiscount($data)
    {
		$insert = $this->db->insert('tbl_flipkartdiscount', $data);
	    return $insert;
	}

    /**
    * Update flipkartdiscount
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_flipkartdiscount($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_flipkartdiscount', $data);
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
    * Delete flipkartdiscount
    * @param int $id - flipkartdiscount id
    * @return boolean
    */
	function delete_flipkartdiscount($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_flipkartdiscount'); 
	}
 
    /**
    * Get flipkartdiscount by his is
    * @param int $flipkartdiscount_id 
    * @return array
    */
    public function get_featured_flipkartdiscount()
    {
		
		$this->db->select('o.*,count(c.flipkartdiscount_id) as coupon_count');
		$this->db->from('tbl_flipkartdiscount as o');
		$this->db->join('tbl_coupon as c', 'o.main_id = c.flipkartdiscount_id', 'left');
		$this->db->group_by('o.main_id');
	    $this->db->order_by('coupon_count', "desc");
//		$this->db->where('o.featured', '1');
		$query = $this->db->get();
	//	echo $this->db->last_query();
		return $query->result_array(); 
    }
    /**
    * Get flipkartdiscount by his is
    * @param int $flipkartdiscount_id 
    * @return array
    */
    public function get_all_flipkartdiscount($search_string=false)
    {
		
		$this->db->select('*');
		$this->db->from('tbl_flipkartdiscount');
		if($search_string){
			$this->db->like('title', $search_string,"both");
		}
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
}
?>