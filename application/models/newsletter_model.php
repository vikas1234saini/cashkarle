<?php
class Newsletter_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get newsletter by his is
    * @param int $newsletter_id 
    * @return array
    */
    public function get_newsletter_by_id($id) {
		$this->db->select('*');
		$this->db->from('tbl_newsletter');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_newsletter_by_title($str) {
		$this->db->select('*');
		$this->db->from('tbl_newsletter');
		$this->db->where("title LIKE '%".$str."%'");
		$this->db->limit(18, 0);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_newsletter_search($arr) {
		$this->db->select('*');
		$this->db->from('tbl_newsletter');
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
    * Get newsletter by his is
    * @param int $newsletter_id 
    * @return array
    */
    public function get_rand_newsletter()
    {
		
		$this->db->select('*');
		$this->db->from('tbl_newsletter');
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
    public function get_all_newsletter($parentId=0)
    {
		$this->db->select('*');
		$this->db->from('tbl_newsletter');
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
    public function get_newsletter($search_string=false, $order=false, $order_type='Asc',$from_date=false, $to_date=false, $limit_start, $limit_end)
    {
	    
		$this->db->select('*');
		
		$this->db->from('tbl_newsletter as o');
		if($search_string){
			$this->db->like('o.title', $search_string,"both");
		}

		if($from_date != false && $from_date != 0){
			$this->db->where('(date(date) between "'.date('Y-m-d',strtotime($from_date)).'" and "'.date('Y-m-d',strtotime($to_date)).'" )');
		}
		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}

		$this->db->limit($limit_start, $limit_end);

		$query = $this->db->get();
//		echo $this->db->last_query();
		$result = $query->result_array();
		return $result; 	
    }

    /**
    * Count the number of rows
    * @param int $newsletterName
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_newsletter($search_string=false, $order=false, $status=false,$from_date=false, $to_date=false)
    {
		$this->db->select('*');
		$this->db->from('tbl_newsletter');
		if($search_string!=false){
			$this->db->like('title', $search_string,"both");
		}
		
		if($from_date != false && $from_date != 0){
			$this->db->where('(date(date) between "'.date('Y-m-d',strtotime($from_date)).'" and "'.date('Y-m-d',strtotime($to_date)).'" )');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_newsletter($data)
    {
		$insert = $this->db->insert('tbl_newsletter', $data);
	    return $insert;
	}

    /**
    * Update newsletter
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_newsletter($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_newsletter', $data);
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
    * Delete newsletter
    * @param int $id - newsletter id
    * @return boolean
    */
	function delete_newsletter($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_newsletter'); 
	}
 
    /**
    * Get newsletter by his is
    * @param int $newsletter_id 
    * @return array
    */
    public function get_featured_newsletter()
    {
		$this->db->select('*');
		$this->db->from('tbl_newsletter');
		$this->db->where('featured', '1');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
    public function get_all_user($str) {
		$this->db->select('*');
		$this->db->from('tbl_newsletteruser');
		if($str!='all' && $str!=''){
			$this->db->where("email LIKE '".$str."%'");
		}
//		$this->db->limit(18, 0);
		$query = $this->db->get();
		return $query->result_array(); 
    }
}
?>