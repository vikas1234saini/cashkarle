<?php
class Coupon_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get coupon by his is
    * @param int $coupon_id 
    * @return array
    */
    public function get_coupon_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('tbl_coupon');
		$this->db->where('id >= ', $id);
		$this->db->where('coupon_expiry >= ', date('Y-m-d'));
		$this->db->where('added <= ', date('Y-m-d'));
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Fetch coupon data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_coupon($search_string=false, $order=false, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('*');
		
		$this->db->from('tbl_coupon as c');
		if($search_string){
			$this->db->where("(c.coupon_title LIKE '%".$search_string."%' OR c.offer_name LIKE '%".$search_string."%')");
		}

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('c.id', $order_type);
		}
//	    $this->db->where('c.parentId != ', '0');

		$this->db->limit($limit_start, $limit_end);
		$this->db->where('c.added <= ', date('Y-m-d'));
		$this->db->where('c.coupon_expiry >= ', date('Y-m-d'));
		//$this->db->limit('4', '4');

		$query = $this->db->get();
//		echo $this->db->last_query();
		$result = $query->result_array();
		return $result; 	
    }

    /**
    * Count the number of rows
    * @param int $couponName
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_coupon($search_string=false, $order=false, $status=false)
    {
		$this->db->select('*');
		$this->db->from('tbl_coupon');
		if($search_string!=false){
			$this->db->where("(coupon_title LIKE '%".$search_string."%' OR offer_name LIKE '%".$search_string."%')");
		}
		
		$this->db->where('coupon_expiry >= ', date('Y-m-d'));
		$this->db->where('added <= ', date('Y-m-d'));
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_coupon($data)
    {
		$insert = $this->db->insert('tbl_coupon', $data);
	    return $insert;
	}

    /**
    * Update coupon
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_coupon($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_coupon', $data);
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
    * Delete coupon
    * @param int $id - coupon id
    * @return boolean
    */
	function delete_coupon($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_coupon'); 
	}
 
    /**
    * Get coupon by his is
    * @param int $coupon_id 
    * @return array
    */
    public function get_all_coupon($parentId=0)
    {
		$this->db->select('*');
		$this->db->from('tbl_coupon');
		$this->db->where('parentId', $parentId);
		
		$this->db->where('coupon_expiry >= ', date('Y-m-d'));
		$this->db->where('added <= ', date('Y-m-d'));
		$query = $this->db->get();
		return $query->result_array(); 
    }
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_rand_coupon()
    {
		
		//$sql = "SELECT * FROM tbl_category where snapdealUrl!='' and flipkartUrl!='' and  parentId!='0' order by rand() limit 1";
		
		$this->db->select('*');
		$this->db->from('tbl_coupon');
		$this->db->where('status', '1');
		
		$this->db->where('coupon_expiry >= ', date('Y-m-d'));
		$this->db->where('added <= ', date('Y-m-d'));
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
    public function get_all_parent_coupon()
    {
		$this->db->select('*');
		$this->db->from('tbl_coupon');
		$this->db->where('coupon_expiry >= ', date('Y-m-d'));
		$this->db->where('added <= ', date('Y-m-d'));
		$this->db->where('parentId', '0');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_all_main_coupon() {
		$this->db->select('c.*,cp.couponName as parentName');
		
		$this->db->from('tbl_coupon as c');
		$this->db->join('tbl_coupon as cp', 'cp.id = c.parentId', 'left');
		$this->db->where('c.parentId != ', '0');
		$this->db->where('c.status', '1');
		$this->db->where('c.coupon_expiry >= ', date('Y-m-d'));
		$this->db->where('c.added <= ', date('Y-m-d'));
		$query = $this->db->get();
		return $query->result_array();
    }
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_all_coupon_offer($offer_id=false) {
		
		
		$this->db->select('*');
		$this->db->from('tbl_coupon');
		$this->db->where('coupon_expiry >= ', date('Y-m-d'));
		$this->db->where('added <= ', date('Y-m-d'));
		$this->db->where('offer_id', $offer_id);
		$query = $this->db->get();
		return $query->result_array(); 
		
    }
}
?>