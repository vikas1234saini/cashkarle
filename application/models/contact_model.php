<?php
class Contact_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get contact by his is
    * @param int $contact_id 
    * @return array
    */
    public function get_contact_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('tbl_contactus');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Fetch contact data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_contact($search_string=false, $order=false, $order_type='Asc',$from_date=false, $to_date=false, $limit_start, $limit_end, $orderfor=false)
    {
	    
		$this->db->select('*');
		
		$this->db->from('tbl_contactus as c');
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
			
			$this->db->order_by("id", $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
			
		}
//	    $this->db->where('c.parentId != ', '0');

		$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');

		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result_array();
		return $result; 	
    }

    /**
    * Count the number of rows
    * @param int $contactName
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_contact($orderfor=false,$from_date=false, $to_date=false,$search_string=false, $order=false, $status=false)
    {
		$this->db->select('id');
		$this->db->from('tbl_contactus as c');
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
		}
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_contact($data)
    {
		$insert = $this->db->insert('tbl_contactus', $data);
	    return $insert;
	}

    /**
    * Update contact
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_contact($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_contactus', $data);
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
    * Delete contact
    * @param int $id - contact id
    * @return boolean
    */
	function delete_contact($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_contactus'); 
	}
 
    /**
    * Get contact by his is
    * @param int $contact_id 
    * @return array
    */
  
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_rand_contact()
    {
		
		//$sql = "SELECT * FROM tbl_category where snapdealUrl!='' and flipkartUrl!='' and  parentId!='0' order by rand() limit 1";
		
		$this->db->select('*');
		$this->db->from('tbl_contactus');
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
    public function get_all_parent_contact()
    {
		$this->db->select('*');
		$this->db->from('tbl_contactus');
	//	$this->db->where('parentId', '0');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_all_main_contact()
    {
		$this->db->select('*');
		$this->db->from('tbl_contactus');
	//	$this->db->where('parentId != ', '0');
		$this->db->where('status', '1');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    public function get_all_contact()
    {
		
		$this->db->select('t.*,u.username');
		
		$this->db->from('tbl_contactus as t');
		$this->db->join('tbl_user as u', 'u.id = t.user_id', 'left');
		$query = $this->db->get();
		return $query->result_array(); 
    }
}
?>