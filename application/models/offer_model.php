<?php
class Offer_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get offer by his is
    * @param int $offer_id 
    * @return array
    */
    public function get_offer_by_id($id) {
		
		$this->db->select('o.*');
		$this->db->from('tbl_offer as o');
		
//		$this->db->where("o.status",'1');
		$this->db->where('o.id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    public function get_offer_by_id_main($id) {
		
		$this->db->select('o.*,count(c.offer_id) as coupon_count');
		$this->db->from('tbl_offer as o');
		$this->db->join('tbl_coupon as c', 'o.main_id = c.offer_id', 'left');
		$this->db->group_by('o.main_id');
	    $this->db->order_by('coupon_count', "desc");
		$this->db->where("o.id != ",'56');
		$this->db->where('c.coupon_expiry >= ', date('Y-m-d'));
		$this->db->where('c.added <= ', date('Y-m-d'));
		
		$this->db->where("o.status",'1');
		$this->db->where('o.main_id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_offer_by_title($str) {
		
		$this->db->select('o.*,count(c.offer_id) as coupon_count');
		$this->db->from('tbl_offer as o');
		$this->db->join('tbl_coupon as c', 'o.main_id = c.offer_id', 'left');
		$this->db->where('c.coupon_expiry >= ', date('Y-m-d 23:59:59'));
		$this->db->where('c.added <= ', date('Y-m-d'));
		$this->db->group_by('o.main_id,c.offer_id');
	    $this->db->order_by('coupon_count', "desc");
		$this->db->where("o.sitename != ",'flipkart');
		$this->db->where("o.id != ",'56');
		$this->db->where("o.status",'1');
		$this->db->where("o.url != ",'');
		$this->db->where("o.id != ",'138');
		
//		$this->db->where("title LIKE '%".$str."%'");

		$search_list = "(title LIKE '%".$str."%' ";
		$str_new = explode(" ",$str);
		$find = array("CPRC", "CPA","CPS","CPL"," - India","India","for","For","Offer","offer","Coupons","Coupon","coupons","coupon","a","from","an","at","the");
		foreach($str_new as $key=>$value){
//			$search_list .= " OR p.title LIKE '%".$value."%' OR p.description LIKE '%".$value."%' OR p.brand LIKE '%".$value."%' OR c.categoryName LIKE '%".$value."%' OR p.sitename LIKE '%".$value."%'";
			if(!in_array($value,$find) && $value!=''){
				$search_list .= " OR o.title LIKE '%".$value."%' OR c.coupon_title LIKE '%".$value."%' OR c.coupon_description LIKE '%".$value."%'";
			}
		}
		$this->db->where($search_list.")");
		$this->db->limit(18, 0);
		$query = $this->db->get();
		//echo $this->db->last_query();
		$final_data = $query->result_array();
		$serach_id = array();
		$new_data = array();
		foreach($final_data as $key=>$value){
			$serach_id[] = $value['id'];
			$new_data[] =  $value;
		}
		$set_check = array('searchoffer'=>$serach_id);
		$this->session->set_userdata($set_check);
		return $new_data;
	//	return $query->result_array(); 
    }
	
    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_offer_search($arr) {
		if($arr['pageno']==0 || $arr['pageno']==""){
			$set_check = array('searchproduct'=>array());
			$this->session->set_userdata($set_check);	
		}		
		$this->db->select('o.*,count(c.offer_id) as coupon_count');
		$this->db->from('tbl_offer as o');
		$this->db->join('tbl_coupon as c', 'o.main_id = c.offer_id', 'left');
		$this->db->group_by('o.main_id,c.offer_id');
	    $this->db->order_by('coupon_count', "desc");
		$this->db->where("o.status",'1');
		$this->db->where("o.sitename != ",'flipkart');
		$this->db->where("o.id != ",'56');
		$this->db->where('c.coupon_expiry >= ', date('Y-m-d 23:59:59'));
		$this->db->where('c.added <= ', date('Y-m-d'));
		$this->db->where("o.id != ",'138');
		$str = "";
		//print_r($arr);
		if(isset($arr['category']) && $arr['category']!=''){
			$str = str_replace("-"," ",$arr['category_name']);
//			$this->db->like("c.category",$category,"both");
		}
		if(isset($arr['search_key']) && $arr['search_key']!=''){
			$str = $arr['search_key'];
		}
		if($str!=''){
			$search_list = "(title LIKE '%".$str."%' ";
			$str_new = explode(" ",$str);
			$find = array("CPRC", "CPA","CPS","CPL"," - India","India","for","For","Offer","offer","Coupons","Coupon","coupons","coupon","a","from","an","at","the");
			foreach($str_new as $key=>$value){
	//			$search_list .= " OR p.title LIKE '%".$value."%' OR p.description LIKE '%".$value."%' OR p.brand LIKE '%".$value."%' OR c.categoryName LIKE '%".$value."%' OR p.sitename LIKE '%".$value."%'";
				if(!in_array($value,$find) && $value!=''){
					$search_list .= " OR o.title LIKE '%".$value."%' OR c.coupon_title LIKE '%".$value."%' OR c.coupon_description LIKE '%".$value."%'";
				}
			}
			$this->db->where($search_list.")");
		}
		/*if(isset($arr['category']) && $arr['category']!=''){
			$category = $arr['category_name'];
			$this->db->like("c.category",$category,"both");
		}
		if(isset($arr['bybrand'])){
			$brand = $arr['bybrand'];
			if($brand!='all'){
				$this->db->like("brand",$brand,"both");
			}
		}*/
		if(isset($arr['search_for']) && $arr['search_for']=='top_coupon'){
			//$this->db->where("o.featured",'1');
		}
		if(isset($arr['bycashback'])){
			$cahsback_array = explode("-",$arr['bycashback']);
			if(isset($cahsback_array[0])){
				if(isset($cahsback_array[1])){
					$this->db->where("o.discount >= ",$cahsback_array[0]);
				}else{
					$this->db->where("o.discount",$cahsback_array[0]);
				}
			}
			if(isset($cahsback_array[1])){
				$this->db->where("o.discount <= ",$cahsback_array[1]);
			}
		}else{
			//$where = "c.offer_id is  NULL";
			//$this->db->or_where($where);	
		}
		$this->db->limit(18, $arr['pageno']*18);

		$query = $this->db->get();
		
	//	echo $this->db->last_query();
		//die;
//		return $query->result_array(); 
		$final_data = $query->result_array();
		$serach_id = array();
		$new_data  = array();
		foreach($final_data as $key=>$value){
			$serach_id[] = $value['id'];
			$new_data[] =  $value;
		}
		$set_check = array('searchoffer'=>$serach_id);
		$this->session->set_userdata($set_check);
		return $new_data;
    }
	/**
    * Get offer by his is
    * @param int $offer_id 
    * @return array
    */
    public function get_rand_offer()
    {
		
		$this->db->select('o.*,count(c.offer_id) as coupon_count');
		$this->db->from('tbl_offer as o');
		$this->db->join('tbl_coupon as c', 'o.main_id = c.offer_id', 'left');
		$this->db->where('c.coupon_expiry >= ', date('Y-m-d'));
		$this->db->where('c.added <= ', date('Y-m-d'));
		$this->db->group_by('o.main_id');
	    $this->db->order_by('id', 'RANDOM');
		$this->db->where("o.status",'1');
		$this->db->where("o.id != ",'56');
	
		$this->db->limit(20, 0);
		
		$query = $this->db->get();
		return $query->result_array(); 
    }
	public function get_top_offer($parentId=0){
//		$this->db->select('*');
	//	$this->db->from('tbl_offer');
	
		$this->db->select('o.*,count(c.offer_id) as coupon_count');
		$this->db->from('tbl_offer as o');
		$this->db->join('tbl_coupon as c', 'o.main_id = c.offer_id', 'left');
		$this->db->group_by('o.main_id');
	    $this->db->order_by('coupon_count', "desc");
		$this->db->where("o.url != ",'');
		$this->db->where("o.status",'1');
		$this->db->where('c.coupon_expiry >= ', date('Y-m-d'));
		$this->db->where('c.added <= ', date('Y-m-d'));
		$this->db->where("o.id != ",'56');
		$this->db->limit(10, 0);
		
		$query = $this->db->get();
		return $query->result_array(); 
    }
	 /**
    * Get brand by his is
    * @param int $brand_id 
    * @return array
    */
    public function get_all_offer($parentId=0){
//		$this->db->select('*');
	//	$this->db->from('tbl_offer');
	
		$this->db->select('o.*,count(c.offer_id) as coupon_count');
		$this->db->from('tbl_offer as o');
		$this->db->join('tbl_coupon as c', 'o.main_id = c.offer_id', 'left');
		$this->db->group_by('o.main_id');
		$this->db->where("o.url != ",'');
	    $this->db->order_by('coupon_count', "desc");
		$this->db->where('c.coupon_expiry >= ', date('Y-m-d'));
		$this->db->where('c.added <= ', date('Y-m-d'));
		$this->db->where("o.status",'1');
		$this->db->where("o.id != ",'56');

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
    public function get_offer($search_string=false, $order=false, $order_type='desc', $limit_start, $limit_end,$orderfor=false)
    {
	    
		$this->db->select('o.*');
		$this->db->from('tbl_offer as o');
		$this->db->where("o.id != ",'56');
		
		if($search_string){
			$this->db->like('o.title', $search_string,"both");
		}
		if($order){
			
			if($orderfor=='offerby'){
				$this->db->like('o.title', $order,"both");
			}
			if($orderfor=='status'){
				$this->db->where('o.status', $order);
			}
			if($orderfor=='payouttype'){
				$this->db->where('o.payout_type', $order);
			}
			if($orderfor=='username'){
				$this->db->where('o.admin', $order);
			}
			$this->db->order_by("title", $order_type);
		}else{
		    $this->db->order_by('o.id', $order_type);
		}
		$this->db->limit($limit_start, $limit_end);

		$query = $this->db->get();
//		echo $this->db->last_query();
		$result = $query->result_array();
		return $result; 	
    }

    public function get_offer_all($search_string=false, $order=false, $order_type='Asc',$orderfor=false) {
	    
		$this->db->select('o.*');
		$this->db->from('tbl_offer as o');
		$this->db->where("o.id != ",'56');
		
		if($search_string){
			$this->db->like('o.title', $search_string,"both");
		}
		if($order){
			
			if($orderfor=='offerby'){
				$this->db->like('o.title', $order,"both");
			}
			if($orderfor=='status'){
				$this->db->where('o.status', $order);
			}
			if($orderfor=='payouttype'){
				$this->db->where('o.payout_type', $order);
			}
			if($orderfor=='username'){
				$this->db->where('o.admin', $order);
			}
			$this->db->order_by("title", $order_type);
		}else{
		    $this->db->order_by('o.id', $order_type);
		}

		$query = $this->db->get();
//		echo $this->db->last_query();
		$result = $query->result_array();
		return $result; 	
    }
    /**
    * Count the number of rows
    * @param int $offerName
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_offer($orderfor=false, $search_string=false, $order=false, $status=false)
    {
		$this->db->select('*');
		$this->db->from('tbl_offer as o');
		if($search_string!=false){
			$this->db->like('title', $search_string,"both");
		}
		
		if($order){	
			if($orderfor=='offerby'){
				$this->db->like('o.title', $order,"both");
			}
			if($orderfor=='status'){
				$this->db->where('o.status', $order);
			}
			if($orderfor=='payouttype'){
				$this->db->where('o.payout_type', $order);
			}
			if($orderfor=='username'){
				$this->db->where('o.admin', $order);
			}
		}
		$this->db->where("id != ",'56');
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_offer($data)
    {
		$insert = $this->db->insert('tbl_offer', $data);
	    return $insert;
	}

    /**
    * Update offer
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_offer($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_offer', $data);
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
    * Delete offer
    * @param int $id - offer id
    * @return boolean
    */
	function delete_offer($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_offer'); 
	}
 
    /**
    * Get offer by his is
    * @param int $offer_id 
    * @return array
    */
    public function get_featured_offer()
    {
		
		$this->db->select('o.*,count(c.offer_id) as coupon_count');
		$this->db->from('tbl_offer as o');
		$this->db->join('tbl_coupon as c', 'o.main_id = c.offer_id', 'left');
		$this->db->group_by('o.main_id');
	    $this->db->order_by('coupon_count', "desc");
		$this->db->where("o.status",'1');
		$this->db->where("o.sitename != ",'flipkart');
		$this->db->where("o.id != ",'56');
//		$where = "c.offer_id is  NULL";
	//	$this->db->or_where($where);
		$this->db->where('c.coupon_expiry >= ', date('Y-m-d'));
		$this->db->where('c.added <= ', date('Y-m-d'));
//		$this->db->where('o.featured', '1');
		$this->db->limit(18, 0);
		$query = $this->db->get();
	//	echo $this->db->last_query();
		return $query->result_array(); 
    }
    /**
    * Get offer by his is
    * @param int $offer_id 
    * @return array
    */
    public function get_just_all_offer()
    {
		
		$this->db->select('*');
		$this->db->from('tbl_offer');
	//	$this->db->where("o.status",'1');
//		$this->db->where('o.featured', '1');
		$query = $this->db->get();
	//	echo $this->db->last_query();
		return $query->result_array(); 
    }
	
    /**
    * Get offer by his is
    * @param int $offer_id 
    * @return array
    */
    public function get_just_all_offer_ticket()
    {
		
		$this->db->select('retailer as title');
		$this->db->from('tbl_ticket');
	//	$this->db->where("o.status",'1');
//		$this->db->where('o.featured', '1');
		$query = $this->db->get();
	//	echo $this->db->last_query();
		return $query->result_array(); 
    }
    /**
    * Get offer by his is
    * @param int $offer_id 
    * @return array
    */
	
    public function get_coupon($offer_id=false,$title=false){
		$this->db->select('*');
		$this->db->from('tbl_coupon');
		
		if($offer_id!=false){
			$this->db->where('offer_id', $offer_id);
		}
		if($title!=false){
			$this->db->like('coupon_title', $title,"both");
		}
		
		$this->db->where('coupon_expiry >= ', date('Y-m-d'));
		$this->db->where('added <= ', date('Y-m-d'));
		$query = $this->db->get();
		
		//echo $this->db->last_query();
		//die;
		
		return $query->result_array(); 
    }
	
    public function get_coupon_by_id($id=false){
		$this->db->select('*');
		$this->db->from('tbl_coupon');
		if($id!=false){
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query->result_array(); 
    }
    /**
    * Get offer by his is
    * @param int $offer_id 
    * @return array
    */
	
    public function get_coupon_count($offer_id=false){
		$this->db->select('id');
		$this->db->from('tbl_coupon');
		if($offer_id!=false){
			$this->db->where('offer_id', $offer_id);
		}
		$this->db->where('coupon_expiry >= ', date('Y-m-d'));
		$this->db->where('added <= ', date('Y-m-d'));
		$query = $this->db->get();
		return $query->num_row(); 
    }
}
?>