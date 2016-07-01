<?php
class Flipkartofferdiscount_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get flipkartofferdiscount by his is
    * @param int $flipkartofferdiscount_id 
    * @return array
    */
    public function get_flipkartofferdiscount_by_id($id) {
		
		$this->db->select('o.*');
		$this->db->from('tbl_flipkartofferdiscount as o');
		
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
    public function get_flipkartofferdiscount($search_string=false, $order=false, $order_type='Asc', $limit_start, $limit_end) {
	    
		$this->db->select('o.*');
		$this->db->from('tbl_flipkartofferdiscount as o');
		
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
    * @param int $flipkartofferdiscountName
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_flipkartofferdiscount($search_string=false, $order=false, $status=false)   {
		$this->db->select('*');
		$this->db->from('tbl_flipkartofferdiscount');
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
    function store_flipkartofferdiscount($data)
    {
		$insert = $this->db->insert('tbl_flipkartofferdiscount', $data);
	    return $insert;
	}

    /**
    * Update flipkartofferdiscount
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_flipkartofferdiscount($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_flipkartofferdiscount', $data);
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
    * Delete flipkartofferdiscount
    * @param int $id - flipkartofferdiscount id
    * @return boolean
    */
	function delete_flipkartofferdiscount($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_flipkartofferdiscount'); 
	}
 
    /**
    * Get flipkartofferdiscount by his is
    * @param int $flipkartofferdiscount_id 
    * @return array
    */
    public function get_featured_flipkartofferdiscount()
    {
		
		$this->db->select('o.*,count(c.flipkartofferdiscount_id) as coupon_count');
		$this->db->from('tbl_flipkartofferdiscount as o');
		$this->db->join('tbl_coupon as c', 'o.main_id = c.flipkartofferdiscount_id', 'left');
		$this->db->group_by('o.main_id');
	    $this->db->order_by('coupon_count', "desc");
//		$this->db->where('o.featured', '1');
		$query = $this->db->get();
	//	echo $this->db->last_query();
		return $query->result_array(); 
    }
    /**
    * Get flipkartofferdiscount by his is
    * @param int $flipkartofferdiscount_id 
    * @return array
    */
    public function get_all_flipkartofferdiscount($search_string=false)
    {
		
		$this->db->select('*');
		$this->db->from('tbl_flipkartofferdiscount');
		if($search_string){
			$this->db->like('title', $search_string,"both");
		}
//		$this->db->where('o.featured', '1');
		$query = $this->db->get();
	//	echo $this->db->last_query();
		return $query->result_array(); 
    }
	
}
?>