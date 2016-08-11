<?php
class Order_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get order by his is
    * @param int $order_id 
    * @return array
    */
    public function get_order_by_id($id) {
		$this->db->select('*');
		$this->db->from('tbl_order');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_order_by_title($str) {
		$this->db->select('*');
		$this->db->from('tbl_order');
		$this->db->where("sitename LIKE '%".$str."%'");
		$this->db->limit(18, 0);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_order_search($arr) {
		$this->db->select('*');
		$this->db->from('tbl_order');
		if(isset($arr['bybrand'])){
			$brand = $arr['bybrand'];
			if($brand!='all'){
				$this->db->like("brand",$brand,"both");
			}
		}
		if(isset($arr['search_for']) && $arr['search_for']=='top_coupon'){
			$this->db->where("featured",'1');
		}
		if(isset($arr['bycashback'])){
			$cahsback_array = explode("-",$arr['bycashback']);
			if(isset($cahsback_array[0])){
				$this->db->where("discount > ",$cahsback_array[0]);
			}
			if(isset($cahsback_array[1])){
				$this->db->where("discount < ",$cahsback_array[1]);
			}
		}
		$this->db->limit(18, $arr['pageno']*18);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	/**
    * Get order by his is
    * @param int $order_id 
    * @return array
    */
    public function get_rand_order()
    {
		
		$this->db->select('*');
		$this->db->from('tbl_order');
//		$this->db->where('parentId != ', '0');
	    $this->db->order_by('id', 'RANDOM');
	
		$this->db->limit(20, 0);
		
		$query = $this->db->get();
	//	echo $this->db->last_query();
		return $query->result_array(); 
    }
	 /**
    * Get brand by his is
    * @param int $brand_id 
    * @return array
    */
    public function get_all_order($user_id=false,$search_string=false,$from_date=false,$to_date=false,$orderfor=false)
    {
		
		$this->db->select('o.*,u.username');
		
		$this->db->from('tbl_order as o');
		$this->db->join('tbl_user as u', 'u.id = o.user_id', 'left');
//		$this->db->where('withdraw', '0');
		if($user_id!=false){
			$this->db->where('o.user_id', $user_id);
		}
		if($search_string){
			$this->db->like('o.sitename', $search_string,"both");
		}
		if($from_date != false && $from_date != 0){
			$this->db->where('(date(o.date) between "'.date('Y-m-d',strtotime($from_date)).'" and "'.date('Y-m-d',strtotime($to_date)).'" )');
		}
	    $this->db->order_by('o.date', 'desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    public function get_all_earning($user_id=false)
    {
		$this->db->select('sum(discount) as discount, orderStatus');
		$this->db->from('tbl_order');
		$this->db->where("(orderStatus = 'tentative' OR orderStatus = 'approved' OR orderStatus = 'Approved')");
		if($user_id!=false){
			$this->db->where('user_id', $user_id);
		}
		
	  //  $this->db->order_by('date', 'desc');
	    $this->db->group_by('user_id');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    public function get_all_payment($user_id=false)
    {
		$this->db->select('sum(amount) as payment');
		$this->db->from('tbl_payment');
		if($user_id!=false){
			$this->db->where('user_id', $user_id);
		}
		
	    $this->db->group_by('user_id');
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
    public function get_order($from_date=false, $to_date=false,$search_string=false, $order=false, $order_type='Desc', $limit_start, $limit_end)
    {
	    
		$this->db->select('o.*,u.username');
		
		$this->db->from('tbl_order as o');
		$this->db->join('tbl_user as u', 'u.id = o.user_id', 'left');
		if($search_string){
			$this->db->like('o.sitename', $search_string,"both");
		}
		if($from_date != false && $from_date != 0){
			$this->db->where('(date(o.date) between "'.date('Y-m-d',strtotime($from_date)).'" and "'.date('Y-m-d',strtotime($to_date)).'" )');
		}
		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', "desc");
		}

		$this->db->limit($limit_start, $limit_end);

		$query = $this->db->get();
//		echo $this->db->last_query();
		$result = $query->result_array();
		return $result; 	
    }

    /**
    * Count the number of rows
    * @param int $orderName
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_order($from_date=false, $to_date=false,$search_string=false, $order=false, $status=false)
    {
		
		$this->db->select('c.*,u.username');
		
		$this->db->from('tbl_order as c');
		$this->db->join('tbl_user as u', 'u.id = c.user_id', 'left');
		
		if($search_string!=false){
			$this->db->like('c.sitename', $search_string,"both");
		}
		if($from_date != false && $from_date != 0){
			$this->db->where('(date(c.date) between "'.date('Y-m-d',strtotime($from_date)).'" and "'.date('Y-m-d',strtotime($to_date)).'" )');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_order($data)
    {
		$insert = $this->db->insert('tbl_order', $data);
	    return $insert;
	}

    /**
    * Update order
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_order($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_order', $data);
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
    * Delete order
    * @param int $id - order id
    * @return boolean
    */
	function delete_order($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_order'); 
	}
 
    /**
    * Get order by his is
    * @param int $order_id 
    * @return array
    */
    public function get_featured_order()
    {
		$this->db->select('*');
		$this->db->from('tbl_order');
		$this->db->where('featured', '1');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    public function get_all_ticket()
    {
		
		$user_details	= $this->session->userdata('fuser_details');
		$this->db->select('*');
		$this->db->from('tbl_ticket');
		
		$this->db->where('user_id', $user_details[0]['id']);
	    $this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
    function addticket($data)
    {
		$insert = $this->db->insert('tbl_ticket', $data);
	    return $insert;
	}
	
}
?>