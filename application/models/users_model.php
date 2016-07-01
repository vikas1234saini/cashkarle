<?php

class Users_model extends CI_Model {

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */
	function validate($user_name, $password)
	{
		$this->db->where('admin_login_name', $user_name);
		$this->db->where('admin_password', $password);
//		$this->db->where('admin_status', 'Active');
		$query = $this->db->get('admin');
		
		if($query->num_rows == 1)
		{
			$data = array();
			$data['last_login_date'] = date('Y-m-d H:i:s');			
			$this->db->where('admin_login_name', $user_name);
			$this->db->where('admin_password', $password);
			$this->db->update('admin', $data);
			return $query->result_array();
		}		
	}

    /**
    * Serialize the session data stored in the database, 
    * store it in a new array and return it to the controller 
    * @return array
    */
	function get_db_session_data()
	{
		$query = $this->db->select('user_data')->get('ci_sessions');
		$user = array(); /* array to store the user data we fetch */
		foreach ($query->result() as $row)
		{
		    $udata = unserialize($row->user_data);
		    /* put data in array using username as key */
		    $user['user_data'] = $udata['user_data']; 
		    $user['is_logged_in'] = $udata['is_logged_in']; 
		}
		return $user;
	}
	
    /**
    * Store the new user's data into the database
    * @return boolean - check the insert
    */	
	function create_member()
	{

		$this->db->where('admin_login_name', $this->input->post('username'));
		$query = $this->db->get('admin');

        if($query->num_rows > 0){
        	echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
			  echo "Username already taken";	
			echo '</strong></div>';
		}else{

			$new_member_insert_data = array(
				'admin_first_name' => $this->input->post('first_name'),
				'admin_last_name' => $this->input->post('last_name'),
				'admin_email_id' => $this->input->post('email_address'),			
				'admin_login_name' => $this->input->post('username'),
				'admin_login_password' => md5($this->input->post('password'))						
			);
			$insert = $this->db->insert('admin', $new_member_insert_data);
		    return $insert;
		}
	      
	}//create_member
	
	/**
    * Fetch user data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_user($orderfor=false,$search_string=false, $order=false, $order_type='Asc',$from_date=false, $to_date=false, $limit_start, $limit_end)
    {
	    
		$this->db->select('c.*,sum(amount) as payment');
		
		$this->db->from('tbl_user as c');
		$this->db->join('tbl_payment as p', 'p.user_id = c.id', 'left');
		if($search_string){
			$this->db->like('c.username', $search_string,"both");
		}

		if($from_date != false && $from_date != 0){
			$this->db->where('(date(c.date) between "'.date('Y-m-d',strtotime($from_date)).'" and "'.date('Y-m-d',strtotime($to_date)).'" )');
		}
		if($order){
			
			if($orderfor=='earnedamount'){
//				$this->db->like('c.title', $order,"both");
				$this->db->order_by("payment", $order_type);
			}
			if($orderfor=='status'){
				$this->db->where('c.status', $order);
				$this->db->order_by("c.username", $order_type);
			}
			if($orderfor=='signup'){
				$this->db->where($order." != ", "");
				$this->db->order_by("c.username", $order_type);
			}
			
//			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('c.id', $order_type);
		}
//	    $this->db->where('c.parentId != ', '0');

		$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');
		$this->db->group_by('c.id');
		$query = $this->db->get();
//		echo $this->db->last_query();
		$result = $query->result_array();
		return $result; 	
    }

    /**
    * Count the number of rows
    * @param int $userName
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_user($orderfor=false, $search_string=false, $order=false, $status=false,$from_date=false, $to_date=false)
    {
		$this->db->select('*');
		$this->db->from('tbl_user');
		if($search_string!=false){
			$this->db->like('username', $search_string,"both");
		}
		if($from_date != false && $from_date != 0){
			$this->db->where('(date(date) between "'.date('Y-m-d',strtotime($from_date)).'" and "'.date('Y-m-d',strtotime($to_date)).'" )');
		}
		if($order){
			
			if($orderfor=='status') {
				$this->db->where('status', $order);
			}
			if($orderfor=='signup') {
				$this->db->where($order." != ", "");
			}
			
//			$this->db->order_by($order, $order_type);
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_user($data)
    {
		$insert = $this->db->insert('tbl_user', $data);
	    return $insert;
	}

    /**
    * Update user
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_user($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('tbl_user', $data);
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
    * Delete user
    * @param int $id - user id
    * @return boolean
    */
	function delete_user($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_user'); 
	}
 
    /**
    * Get user by his is
    * @param int $user_id 
    * @return array
    */
    public function get_all_user($title=false,$from_date=false,$to_date=false)
    {
		$this->db->select('*');
		$this->db->from('tbl_user');
		
		if($title!=false){
			$this->db->like('username', $title,"both");
		}
		if($from_date != false && $from_date != 0){
			$this->db->where('(date(date) between "'.date('Y-m-d',strtotime($from_date)).'" and "'.date('Y-m-d',strtotime($to_date)).'" )');
		}
		$query = $this->db->get();
		return $query->result_array(); 
    }
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_rand_user()
    {
		
		//$sql = "SELECT * FROM tbl_category where snapdealUrl!='' and flipkartUrl!='' and  parentId!='0' order by rand() limit 1";
		
		$this->db->select('*');
		$this->db->from('tbl_user');
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
    public function get_all_parent_user()
    {
		$this->db->select('*');
		$this->db->from('tbl_user');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    /**
    * Get category by his is
    * @param int $category_id 
    * @return array
    */
    public function get_all_main_user()
    {
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('status', '1');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	    /**
    * Get user by his is
    * @param int $user_id 
    * @return array
    */
    public function get_user_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

}