<?php
class Log_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get log by his is
    * @param int $log_id 
    * @return array
    */
    public function get_log_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('tbl_log');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Fetch log data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_log($search_string=false, $order=false, $order_type='Asc',$from_date=false, $to_date=false, $limit_start, $limit_end)
    {
	    
		$this->db->select('*');
		
		$this->db->from('tbl_log as c');
		if($search_string){
			$this->db->where("(c.for like '%".$search_string."%')");
		}
		if($from_date != false && $from_date != 0){
			$this->db->where('(date(c.date) between "'.date('Y-m-d',strtotime($from_date)).'" and "'.date('Y-m-d',strtotime($to_date)).'" )');
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
    * @param int $logName
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_log($from_date=false, $to_date=false,$search_string=false, $order=false, $status=false)
    {
		$this->db->select('*');
		$this->db->from('tbl_log as c');
		if($search_string){
			$this->db->where("(c.for like '%".$search_string."%')");
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
    function store_log($data)
    {
		$insert = $this->db->insert('tbl_log', $data);
	    return $insert;
	}

    /**
    * Update log
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_log($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_log', $data);
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
    * Delete log
    * @param int $id - log id
    * @return boolean
    */
	function delete_log($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_log'); 
	}
 
    /**
    * Get log by his is
    * @param int $log_id 
    * @return array
    */
  
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_rand_log()
    {
		
		//$sql = "SELECT * FROM tbl_category where snapdealUrl!='' and flipkartUrl!='' and  parentId!='0' order by rand() limit 1";
		
		$this->db->select('*');
		$this->db->from('tbl_log');
//		$this->db->where('status', '1');
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
    public function get_all_parent_log()
    {
		$this->db->select('*');
		$this->db->from('tbl_log');
	//	$this->db->where('parentId', '0');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_all_main_log()
    {
		$this->db->select('*');
		$this->db->from('tbl_log');
	//	$this->db->where('parentId != ', '0');
	//	$this->db->where('status', '1');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    public function get_all_log()
    {
		
		$this->db->select('t.*');
		
		$this->db->from('tbl_log as t');
		$query = $this->db->get();
		return $query->result_array(); 
    }
}
?>