<?php
class Payment_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get payment by his is
    * @param int $payment_id 
    * @return array
    */
    public function get_payment_by_id($id)
    {
		$this->db->select('c.*,u.username');
		
		$this->db->from('tbl_payment as c');
		$this->db->join('tbl_user as u', 'u.id = c.user_id', 'left');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Fetch payment data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_payment($search_string=false, $order=false, $order_type='Asc',$from_date=false, $to_date=false, $limit_start, $limit_end, $orderfor=false)
    {
	    
		$this->db->select('c.*,u.username');
		
		$this->db->from('tbl_payment as c');
		$this->db->join('tbl_user as u', 'u.id = c.user_id', 'left');
		/*if($search_string){
			$this->db->where("(c.name like '%".$search_string."%' || c.email like '%".$search_string."%' || c.option like '%".$search_string."%' || c.description like '%".$search_string."%')");
		}*/
		
		if($from_date != false && $from_date != 0 && $from_date != ''){
			$this->db->where('(date(date) between "'.date('Y-m-d',strtotime($from_date)).'" and "'.date('Y-m-d',strtotime($to_date)).'" )');
		}
		if($order || $order==0){
			if($orderfor=='status'){
				$this->db->where('status', $order);
			}
			if($orderfor=='username'){
				$this->db->where('admin', $order);
			}
			
			
			$this->db->order_by("id", $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
			
		}
	    $this->db->where('c.payment_option', 'bankaccount');

		$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');

		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result_array();
		return $result; 	
    }

    /**
    * Count the number of rows
    * @param int $paymentName
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_payment($orderfor=false,$from_date=false, $to_date=false,$search_string=false, $order=false, $status=false)
    {
		
		$this->db->select('c.id');
		
		$this->db->from('tbl_payment as c');
		$this->db->join('tbl_user as u', 'u.id = c.user_id', 'left');
		/*if($search_string){
			$this->db->where("(c.name like '%".$search_string."%' || c.email like '%".$search_string."%' || c.option like '%".$search_string."%' || c.description like '%".$search_string."%')");
		}*/
		
		if($from_date != false && $from_date != 0 && $from_date != ''){
			$this->db->where('(date(date) between "'.date('Y-m-d',strtotime($from_date)).'" and "'.date('Y-m-d',strtotime($to_date)).'" )');
		}
		if($order || $order==0){
			if($orderfor=='status'){
				$this->db->where('status', $order);
			}
			if($orderfor=='username'){
				$this->db->where('admin', $order);
			}
			
		}
	    $this->db->where('c.payment_option', 'bankaccount');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_payment($data)
    {
		$insert = $this->db->insert('tbl_payment', $data);
	    return $insert;
	}

    /**
    * Update payment
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_payment($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_payment', $data);
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
    * Delete payment
    * @param int $id - payment id
    * @return boolean
    */
	function delete_payment($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_payment'); 
	}
 
    /**
    * Get payment by his is
    * @param int $payment_id 
    * @return array
    */
  
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_rand_payment()
    {
		
		//$sql = "SELECT * FROM tbl_category where snapdealUrl!='' and flipkartUrl!='' and  parentId!='0' order by rand() limit 1";
		
		$this->db->select('*');
		$this->db->from('tbl_payment');
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
    public function get_all_parent_payment()
    {
		
		$this->db->select('c.*,u.username');
		
		$this->db->from('tbl_payment as c');
		$this->db->join('tbl_user as u', 'u.id = c.user_id', 'left');
	//	$this->db->where('parentId', '0');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_all_main_payment()
    {
		
		$this->db->select('c.*,u.username');
		
		$this->db->from('tbl_payment as c');
		$this->db->join('tbl_user as u', 'u.id = c.user_id', 'left');
	//	$this->db->where('parentId != ', '0');
		$this->db->where('status', '1');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    public function get_all_payment($search_string=false,$from_date=false,$to_date=false,$order=false,$orderfor=false)
    {
		
		
		$this->db->select('c.*,u.username');
		
		$this->db->from('tbl_payment as c');
		$this->db->join('tbl_user as u', 'u.id = c.user_id', 'left');
		if($search_string){
			$this->db->where("(c.name like '%".$search_string."%' || c.email like '%".$search_string."%' || c.option like '%".$search_string."%' || c.description like '%".$search_string."%')");
		}
		
		if($from_date != false && $from_date != 0 && $from_date != ''){
			$this->db->where('(date(date) between "'.date('Y-m-d',strtotime($from_date)).'" and "'.date('Y-m-d',strtotime($to_date)).'" )');
		}
		if($order || $order==0){
			if($orderfor=='status'){
				$this->db->where('status', $order);
			}
			if($orderfor=='username'){
				$this->db->where('admin', $order);
			}
			if($orderfor=='topic'){
				$this->db->where('option', $order);
			}
		}
	    $this->db->where('c.payment_option', 'bankaccount');
		$query = $this->db->get();
		return $query->result_array(); 
		
    }
}
?>