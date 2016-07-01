<?php
class Ticket_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get ticket by his is
    * @param int $ticket_id 
    * @return array
    */
    public function get_ticket_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('tbl_ticket');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Fetch ticket data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_ticket($orderfor=false,$search_string=false, $order=false, $order_type='Asc',$from_date=false, $to_date=false, $limit_start, $limit_end)
    {
	    
		$this->db->select('t.*,u.username');
		
		$this->db->from('tbl_ticket as t');
		if($search_string){
			$this->db->like('t.retailer', $search_string,"both");
		}

		if($from_date != false && $from_date != 0){
			$this->db->where('(date(t.date) between "'.date('Y-m-d',strtotime($from_date)).'" and "'.date('Y-m-d',strtotime($to_date)).'" )');
		}
		if($order || $order==0){			
			if($orderfor=='offerby'){
				$this->db->like('t.retailer', $order,"both");
			}
			if($orderfor=='status'){
				$this->db->where('t.status', $order);
			}
			if($orderfor=='username'){
				$this->db->where('t.admin', $order);
			}
			$this->db->order_by("t.id", $order_type);

		}else{
		    $this->db->order_by('t.id', $order_type);
		}
//	    $this->db->where('c.parentId != ', '0');

		$this->db->limit($limit_start, $limit_end);
		$this->db->join('tbl_user as u', 'u.id = t.user_id', 'left');
		//$this->db->limit('4', '4');

		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result_array();
		return $result; 	
    }

    /**
    * Count the number of rows
    * @param int $ticketName
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_ticket($orderfor=false,$search_string=false, $order=false, $status=false,$from_date=false, $to_date=false)
    {
		$this->db->select('*');
		$this->db->from('tbl_ticket');
		if($search_string!=false){
			$this->db->like('retailer', $search_string,"both");
		}
		
		if($from_date != false && $from_date != 0){
			$this->db->where('(date(date) between "'.date('Y-m-d',strtotime($from_date)).'" and "'.date('Y-m-d',strtotime($to_date)).'" )');
		}
		
		
		if($order){	
			if($orderfor=='offerby'){
				$this->db->like('retailer', $order,"both");
			}
			if($orderfor=='status'){
				$this->db->where('status', $order);
			}
			if($orderfor=='username'){
				$this->db->where('admin', $order);
			}
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_ticket($data)
    {
		$insert = $this->db->insert('tbl_ticket', $data);
	    return $insert;
	}

    /**
    * Update ticket
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_ticket($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_ticket', $data);
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
    * Delete ticket
    * @param int $id - ticket id
    * @return boolean
    */
	function delete_ticket($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_ticket'); 
	}
 
    /**
    * Get ticket by his is
    * @param int $ticket_id 
    * @return array
    */
  
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_rand_ticket()
    {
		
		//$sql = "SELECT * FROM tbl_category where snapdealUrl!='' and flipkartUrl!='' and  parentId!='0' order by rand() limit 1";
		
		$this->db->select('*');
		$this->db->from('tbl_ticket');
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
    public function get_all_parent_ticket()
    {
		$this->db->select('*');
		$this->db->from('tbl_ticket');
	//	$this->db->where('parentId', '0');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_all_main_ticket()
    {
		$this->db->select('*');
		$this->db->from('tbl_ticket');
	//	$this->db->where('parentId != ', '0');
		$this->db->where('status', '1');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    public function get_all_ticket($search_string=false,$from_date=false,$to_date=false)
    {
		
		$this->db->select('t.*,u.username');
		
		$this->db->from('tbl_ticket as t');
		$this->db->join('tbl_user as u', 'u.id = t.user_id', 'left');
		if($search_string){
			$this->db->like('retailer', $search_string,"both");
		}
		if($from_date != false && $from_date != 0){
			$this->db->where('(date(t.date) between "'.date('Y-m-d',strtotime($from_date)).'" and "'.date('Y-m-d',strtotime($to_date)).'" )');
		}
		$query = $this->db->get();
		return $query->result_array(); 
    }
	public function get_all_reply_by_ticket($id){
		$this->db->select('*');
		
		$this->db->from('tbl_reply');
		$this->db->where('ticket_id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
}
?>