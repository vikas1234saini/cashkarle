<?php
class Product_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_product_by_id($id)
    {
		
		$this->db->select('p.*,c.categoryName,c.discount,c.amazon_discount,c.snapdeal_discount,c.flipkart_discount,c.snapdeal_discount_2500,c.amazon_discount_mobile,c.snapdeal_discount_mobile,c.flipkart_discount_mobile');
		$this->db->from('tbl_product as p');
		$this->db->join('tbl_category as c', 'c.id = p.category', 'left');
		$this->db->where('p.id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_product_by_title($str)
    {
		$post_data = $this->input->post();
		$new_data = array();
		
		if(isset($post_data['pid']) && $post_data['pid']!=''){
			$this->db->select('p.*,c.categoryName,c.discount,c.amazon_discount,c.snapdeal_discount,c.flipkart_discount,c.snapdeal_discount_2500,c.amazon_discount_mobile,c.snapdeal_discount_mobile,c.flipkart_discount_mobile');
			$this->db->from('tbl_product as p');
			$this->db->join('tbl_category as c', 'c.id = p.category', 'left');
							   
			$this->db->where('p.id',$post_data['pid']);
			$this->db->where("p.selling_price > ","0");
		//	$this->db->where("p.retail_price > ","0");
			$query_first = $this->db->get();
			$old_data = $query_first->result_array(); 
	
		//	echo $this->db->last_query();		
			//print_r($old_data);
			//die;
			foreach($old_data as $key=>$value){
				$new_data[] =  $value;
			}
		}
		
//		if(isset($post_data['pid']) && $post_data['pid']!=''){
		$this->db->select('p.*,c.categoryName,c.discount,c.amazon_discount,c.snapdeal_discount,c.flipkart_discount,c.snapdeal_discount_2500,c.amazon_discount_mobile,c.snapdeal_discount_mobile,c.flipkart_discount_mobile');
		$this->db->from('tbl_product as p');
		$this->db->join('tbl_category as c', 'c.id = p.category', 'left');
		
		$this->db->where("c.categoryName",$str);
		if(isset($post_data['pid']) && $post_data['pid']!=''){
			$this->db->where("p.id != ",$post_data['pid']);
		}					   
		//$this->db->where('p.id',$post_data['pid']);
		$this->db->where("p.selling_price > ","0");
		//$this->db->where("p.retail_price > ","0");
		$query_first = $this->db->get();
		$old_data = $query_first->result_array(); 

		//echo $this->db->last_query();		
		//print_r($old_data);
		//die;
		
		foreach($old_data as $key=>$value){
			$new_data[] =  $value;
		}
//		}
		$this->db->select('p.*,c.categoryName,c.discount,c.amazon_discount,c.snapdeal_discount,c.flipkart_discount,c.snapdeal_discount_2500,c.amazon_discount_mobile,c.snapdeal_discount_mobile,c.flipkart_discount_mobile');
		$this->db->from('tbl_product as p');
		$this->db->join('tbl_category as c', 'c.id = p.category', 'left');
		//$this->db->where("(p.title LIKE '%".$str."%' OR p.description LIKE '%".$str."%')");
		//print_r($str);
		//$search_list = "(p.title LIKE '%".$str."%' OR p.description LIKE '%".$str."%' OR p.brand LIKE '%".$str."%' OR c.categoryName LIKE '%".$str."%' OR p.sitename LIKE '%".$str."%'";
		$search_list = "(p.title = '".$str."' ";
		$str_new = explode(" ",$str);
		$keyarray = array("("," ","-",")","&","/",".","+","@","#","$","^","*","[","]","{","}");
		foreach($str_new as $key=>$value){
//			$search_list .= " OR p.title LIKE '%".$value."%' OR p.description LIKE '%".$value."%' OR p.brand LIKE '%".$value."%' OR c.categoryName LIKE '%".$value."%' OR p.sitename LIKE '%".$value."%'";
			if(!in_array($value,$keyarray)){
				$search_list .= " OR p.title LIKE '%".$value."%'";
			}
		}
		$this->db->where($search_list.")");
//		echo $search_list;
		$array_vendor = array("amazon",'flipkart','snapdeal');
		$search_str = $str_new;
		$from_vender = "";
		foreach($search_str as $key=>$value){
			if(in_array(strtolower($value),$array_vendor)){
				$from_vender = strtolower($value);		
			}
		}
		if($from_vender!=''){
			$this->db->or_where("p.sitename",$from_vender);	
		}
		
		$this->db->where("p.selling_price > ","0");
		if(isset($post_data['pid']) && $post_data['pid']!=''){
			$this->db->where("p.id != ",$post_data['pid']);
		}
		$this->db->where("p.category != ",$str);
		//$this->db->where("p.retail_price > ","0");
		$this->db->limit(18, 0);
	    $this->db->order_by('p.id', 'desc');
	    $this->db->order_by('p.selling_price', 'desc');
	    $this->db->order_by('p.image', 'desc');
	    $this->db->group_by('p.product_main_id');
		
		$this->db->where('p.status', '1');
		$query = $this->db->get();
//		echo $this->db->last_query();
//		return $query->result_array(); 

		$final_data = $query->result_array();
		$serach_id = array();
		$new_data = array();
		foreach($final_data as $key=>$value){
			$serach_id[] = $value['id'];
			$new_data[] =  $value;
		}
		$set_check = array('searchproduct'=>$serach_id);
		$this->session->set_userdata($set_check);
		return $new_data; 
    }
    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_product_by_category($id) {
		$this->db->select('p.*,c.categoryName,c.discount,c.amazon_discount,c.snapdeal_discount,c.flipkart_discount,c.snapdeal_discount_2500,c.amazon_discount_mobile,c.snapdeal_discount_mobile,c.flipkart_discount_mobile');
		$this->db->from('tbl_product as p');
		$this->db->join('tbl_category as c', 'c.id = p.category', 'left');
		$this->db->where("p.category",$id);
		$this->db->where("p.selling_price > ","0");
		$this->db->where("p.retail_price > ","0");
		$this->db->limit(18, 0);
	    $this->db->order_by('p.image', 'desc');
	    $this->db->where('p.status', '1');
	    $this->db->group_by('p.product_main_id');
		
		$query = $this->db->get();
		$final_data = $query->result_array();
		$serach_id = array();
		$new_data = array();
		foreach($final_data as $key=>$value){
			$serach_id[] = $value['id'];
			$new_data[] =  $value;
		}
		$set_check = array('searchproduct'=>$serach_id);
		$this->session->set_userdata($set_check);
		return $new_data;
//		echo $this->db->last_query();
//		return $query->result_array();
    }
	
    public function get_product_by_brand($str) {
		$this->db->select('p.*,c.categoryName,c.discount,c.amazon_discount,c.snapdeal_discount,c.flipkart_discount,c.snapdeal_discount_2500,c.amazon_discount_mobile,c.snapdeal_discount_mobile,c.flipkart_discount_mobile');
		$this->db->from('tbl_product as p');
		$this->db->join('tbl_category as c', 'c.id = p.category', 'left');
		//$this->db->like("p.brand",$str,"both");
		$this->db->where("p.brand",$str);
		$this->db->where("p.selling_price > ","0");
		$this->db->where("p.retail_price > ","0");
	    $this->db->order_by('p.image', 'desc');
	    $this->db->where('p.status', '1');
	    $this->db->group_by('p.product_main_id');
		$this->db->limit(18, 0);
		$query = $this->db->get();
		
		$final_data = $query->result_array();
		$serach_id = array();
		$new_data = array();
		foreach($final_data as $key=>$value){
			$serach_id[] = $value['id'];
			$new_data[] =  $value;
		}
		$set_check = array('searchproduct'=>$serach_id);
		$this->session->set_userdata($set_check);
		return $new_data;
//		return $query->result_array(); 
    }
    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_product_search($arr) {
		
		if($arr['pageno']==0 || $arr['pageno']==""){
			$set_check = array('searchproduct'=>array());
			$this->session->set_userdata($set_check);	
		}
		$this->db->select('p.*,c.categoryName,c.discount,c.amazon_discount,c.snapdeal_discount,c.flipkart_discount,c.snapdeal_discount_2500,c.amazon_discount_mobile,c.snapdeal_discount_mobile,c.flipkart_discount_mobile');
		$this->db->from('tbl_product as p');
		$this->db->join('tbl_category as c', 'c.id = p.category', 'left');
		if(isset($arr['byprice'])){
			$price_array = explode("-",$arr['byprice']);
			if(isset($price_array[0])){
				$this->db->where("p.selling_price > ",$price_array[0]);
			}
			if(isset($price_array[1])){
				$this->db->where("p.selling_price < ",$price_array[1]);
			}
		}
		if(isset($arr['bycashback'])){
			$cashback_array = explode("-",$arr['bycashback']);
			if(isset($cashback_array[0])){
				if($cashback_array[0]==0 && !isset($cashback_array[1])){
					$this->db->where("((c.snapdeal_discount='0' && snapdealUrl!='') || (c.flipkart_discount='0' && flipkartUrl!=''))");
					//$this->db->where("(c.snapdeal_discount","0");
					//$this->db->where("(c.flipkart_discount","0");
					//$this->db->where("c.snapdeal_discount_2500",$cashback_array[0]);					
				}else{
					$where_cashback = "(";
					$where_cashback .=  "(c.amazon_discount >= ".$cashback_array[0];
					if(isset($cashback_array[1])){
						$where_cashback .=  " and c.amazon_discount <= ".$cashback_array[1];
					}
					$where_cashback .=  ")";
					
					/*$where_cashback .=  " || (c.snapdeal_discount_2500 >= ".$cashback_array[0];
					if(isset($cashback_array[1])){
						$where_cashback .=  " and c.snapdeal_discount_2500 <= ".$cashback_array[1];
					}
					$where_cashback .=  ")";
					$where_cashback .=  " || (c.snapdeal_discount_2500 >= ".$cashback_array[0];
					if(isset($cashback_array[1])){
						$where_cashback .=  " and c.snapdeal_discount_2500 <= ".$cashback_array[1];
					}
					$where_cashback .=  ")";*/
					$where_cashback .=  " || (c.flipkart_discount >= ".$cashback_array[0];
					if(isset($cashback_array[1])){
						$where_cashback .=  " and c.flipkart_discount <= ".$cashback_array[1];
					}
					$where_cashback .=  ")";
					$where_cashback .= ")";
					$this->db->where($where_cashback);
				}
			}
		}
		
		if(isset($arr['search_for']) && $arr['search_for']=='top_product'){
	//		$this->db->where("p.featured",'1');
		}
		if(isset($arr['bybrand'])){
			$brand = $arr['bybrand'];
			if($brand!='all'){
				$this->db->like("p.brand",$brand,"both");
			}
		}
		if(isset($arr['brand'])){
			$brand = $arr['brand'];
			if($brand!=''){
				$this->db->like("p.brand",$brand,"both");
			}
		}else{			
			$array_vendor = array("amazon",'flipkart','snapdeal');
			$search_str = explode(" ",$str);
			$from_vender = "";
			foreach($search_str as $key=>$value){
				if(in_array(strtolower($value),$array_vendor)){
					$from_vender = strtolower($value);		
				}
			}
			if($from_vender!=''){
				$this->db->where("p.sitename",$from_vender);	
			}	
		}
		if(isset($arr['category'])){
			$category = $arr['category'];
			if($category!=''){
				$this->db->where("p.category",$category);
			}
		}else{			
			$array_vendor = array("amazon",'flipkart','snapdeal');
			$search_str = explode(" ",$str);
			$from_vender = "";
			foreach($search_str as $key=>$value){
				if(in_array(strtolower($value),$array_vendor)){
					$from_vender = strtolower($value);		
				}
			}
			if($from_vender!=''){
				$this->db->where("p.sitename",$from_vender);	
			}	
		}
		if(isset($arr['search_key'])){
			$str = $arr['search_key'];
//			print_r($arr);
			if($str!=''){
				//$this->db->where("(p.title LIKE '%".$str."%' OR p.description LIKE '%".$str."%' OR p.brand LIKE '%".$str."%' OR c.categoryName LIKE '%".$str."%' OR p.sitename LIKE '%".$str."%')");
						
				//$search_list = "(p.title LIKE '%".$str."%' OR p.description LIKE '%".$str."%' OR p.brand LIKE '%".$str."%' OR c.categoryName LIKE '%".$str."%' OR p.sitename LIKE '%".$str."%'";
				$search_list = "(p.title LIKE '%".$str."%'";
				$str_new = explode(" ",$str);
				foreach($str_new as $key=>$value){
					//$search_list .= " OR p.title LIKE '%".$value."%' OR p.description LIKE '%".$value."%' OR p.brand LIKE '%".$value."%' OR c.categoryName LIKE '%".$value."%' OR p.sitename LIKE '%".$value."%'";		
					$search_list .= " OR p.title LIKE '%".$value."%' ";		
				}
				$search_list .= " OR c.categoryName = '".$value."' ";
				$this->db->where($search_list.")");
			}
		}
		
		$this->db->where("p.retail_price > ","0");
		$this->db->where("p.selling_price > ","0");
		if($arr['pageno']==1){
			$this->db->where("p.image != ","");
		}
	    $this->db->where('p.status', '1');
		$serach_id = $this->session->userdata('searchproduct');
//		print_r($serach_id);
		if(sizeof($serach_id)>0){
			$this->db->where_not_in('p.id', $serach_id);
		}
		$this->db->limit(18, $arr['pageno']*18);
		
	    $this->db->group_by('p.product_main_id');
	//    $this->db->order_by('p.image', 'IS NOT NULL');
	    $this->db->order_by('p.id', 'desc');
	    $this->db->order_by('p.selling_price', 'desc');
		$query = $this->db->get();
		
	//	echo $this->db->last_query();
		return $query->result_array();
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_product($data)
    {
		$insert = $this->db->insert('tbl_product', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_product($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_product', $data);
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
    * Delete product
    * @param int $id - product id
    * @return boolean
    */
	function delete_product($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_product'); 
	}
 
    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_rand_product()
    {
		
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where("image != ","");
//		$this->db->where('parentId != ', '0');
	    $this->db->order_by('id', 'RANDOM');
	
		$this->db->limit(20, 0);
		
		$this->db->where("selling_price > ","0");
		$this->db->where("retail_price > ","0");
	    $this->db->where('status', '1');
		$query = $this->db->get();
	//	echo $this->db->last_query();
		return $query->result_array(); 
    }
	
    public function get_product($search_string=false, $order=false, $order_type='desc', $limit_start, $limit_end, $orderfor)
    {
	    
//		$this->db->select('*');
		
	//	$this->db->from('tbl_product as o');
	
		$this->db->select('p.*,c.categoryName,c.discount,c.amazon_discount,c.snapdeal_discount,c.flipkart_discount,c.snapdeal_discount_2500,c.amazon_discount_mobile,c.snapdeal_discount_mobile,c.flipkart_discount_mobile');
		$this->db->from('tbl_product as p');
		$this->db->join('tbl_category as c', 'c.id = p.category', 'left');
		
		if($search_string){
			$this->db->like('p.title', $search_string,"both");
		}

		/*if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('p.id', $order_type);
		}*/
		
		if($order){	
			if($orderfor=='category'){
				$this->db->like('c.categoryName', $order,"both");
			}
			if($orderfor=='status'){
				$this->db->where('o.status', $order);
			}
			if($orderfor=='username'){
				$this->db->where('o.admin', $order);
			}
			
			$this->db->order_by("p.title", $order_type);
		}else{
		    $this->db->order_by('p.id', $order_type);
			
		}

		$this->db->limit($limit_start, $limit_end);

		$this->db->where("selling_price > ","0");
		$this->db->where("retail_price > ","0");
		$query = $this->db->get();
//		echo $this->db->last_query();
		$result = $query->result_array();
		return $result; 	
    }

    /**
    * Count the number of rows
    * @param int $productName
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_product($orderfor=false,$search_string=false, $order=false, $status=false)
    {
		$this->db->select('p.id');
		$this->db->join('tbl_category as c', 'c.id = p.category', 'left');
		$this->db->from('tbl_product as p');
		if($search_string!=false){
			$this->db->like('title', $search_string,"both");
		}
		
		$this->db->where("selling_price > ","0");
		$this->db->where("retail_price > ","0");
		if($order){	
			if($orderfor=='category'){
				$this->db->like('c.categoryName', $order,"both");
			}
			if($orderfor=='status'){
				$this->db->where('o.status', $order);
			}
			if($orderfor=='username'){
				$this->db->where('o.admin', $order);
			}
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }
    function count_searchkey($search_string)
    {
		$this->db->select('id');
		$this->db->from('tbl_searchkey');
		$this->db->where('title', $search_string);
		$query = $this->db->get();
		return $query->num_rows();        
    }
	function get_featured_product(){
		$this->db->select('p.*,c.categoryName,c.discount,c.amazon_discount,c.snapdeal_discount,c.flipkart_discount,c.snapdeal_discount_2500,c.amazon_discount_mobile,c.snapdeal_discount_mobile,c.flipkart_discount_mobile');
		$this->db->from('tbl_product as p');
		$this->db->join('tbl_category as c', 'c.id = p.category', 'left');
		$this->db->where("p.featured",'1');
		$this->db->where("p.retail_price > ","0");
		$this->db->where("p.selling_price > ","0");
		 $this->db->where('p.status', '1');
		$this->db->limit(35, 0);
		$this->db->order_by('id', 'RANDOM');
		$query = $this->db->get();
//		echo $this->db->last_query();
		return $query->result_array(); 	
	}
	
	function get_all_product($search_string=false,$order, $order_type,$orderfor){
		$this->db->select('p.*,c.categoryName');
		$this->db->from('tbl_product as p');
		$this->db->join('tbl_category as c', 'c.id = p.category', 'left');
		
		if($search_string!=false && $search_string!=''){
			$this->db->like('title', $search_string,"both");
		}
		
		if($order){	
			if($orderfor=='category'){
				$this->db->like('c.categoryName', $order,"both");
			}
			if($orderfor=='status'){
				$this->db->where('o.status', $order);
			}
			if($orderfor=='username'){
				$this->db->where('o.admin', $order);
			}
			
			$this->db->order_by("p.title", $order_type);
		}else{
		    $this->db->order_by('p.id', $order_type);
			
		}

		$this->db->where("selling_price > ","0");
		$this->db->where("retail_price > ","0");
		 $this->db->where('p.status', '1');
//		$this->db->where("p.featured",'1');
	//	$this->db->where("p.retail_price > ","0");
		//$this->db->where("p.selling_price > ","0");
		
	//	$this->db->limit(1500, 0);
		
		$query = $this->db->get();
		$daat = $query->result_array();
//		print_r($daat);
	//	echo $this->db->last_query();
		//die;
		return  $daat;
	}
	
    public function get_product_by_relation($str,$id,$catname=false)
    {
		$this->db->select('p.*,c.categoryName,c.discount,c.amazon_discount,c.snapdeal_discount,c.flipkart_discount,c.snapdeal_discount_2500,c.amazon_discount_mobile,c.snapdeal_discount_mobile,c.flipkart_discount_mobile');
		$this->db->from('tbl_product as p');
		$this->db->join('tbl_category as c', 'c.id = p.category', 'left');
		//$this->db->where("(p.title LIKE '%".$str."%' OR p.description LIKE '%".$str."%')");
		//print_r($str);
		//$search_list = "(p.title LIKE '%".$str."%'";
		//$search_list = "(p.title LIKE '%".$str."%' ";
	//	$str_new = explode(" ",$str);
		/*foreach($str_new as $key=>$value){
			$search_list .= " OR p.title LIKE '%".$value."%'";
//			$search_list .= " OR p.title LIKE '%".$value."%'";
		}*/
//		$this->db->where($search_list.")");
		if($catname && $catname!=''){	
			$this->db->where("p.category",$catname);	
		}
		$this->db->where("p.retail_price > ","0");
		$this->db->where("p.selling_price > ","0");
		$this->db->where('p.status', '1');
		$this->db->where("p.id != ",$id);
		$this->db->limit(4, 0);
	    $this->db->order_by('p.id', 'desc');
	    $this->db->order_by('p.selling_price', 'desc');
	    
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array(); 
    }
}
?>