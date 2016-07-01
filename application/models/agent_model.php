<?php
class Agent_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get agent by his is
    * @param int $agent_id 
	
    * @return array
    */
    public function get_agent_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('admin_auto_id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	public function username_check($str){
		$this->db->select('admin_login_name');
		$this->db->from('admin');
		$this->db->where('admin_login_name', $str);
		$query = $this->db->get();
		return $query->result_array(); 
	}
    /**
    * Fetch agent data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_agent($agentName=null, $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('a.*');
		
		$this->db->from('admin as a');
	//	$this->db->join('tbl_ticket as t', 'a.admin_auto_id = t.admin_id', 'left');
		
		if($agentName != null && $agentName != 0){
			$this->db->where('a.admin_login_name', $agentName);
		}
		if($search_string){
			$this->db->like('a.admin_login_name', $search_string);
		}

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('a.admin_auto_id', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');


		$query = $this->db->get();
	//	echo $this->db->last_query();
		return $query->result_array(); 	
    }

    /**
    * Count the number of rows
    * @param int $agentName
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_agent($agentName=null, $search_string=null, $order=null, $status=null)
    {
		$this->db->select('*');
		$this->db->from('admin as a');
		if($agentName != null && $agentName != 0){
			$this->db->where('a.admin_login_name', $agentName);
		}
		if($search_string){
			$this->db->like('a.admin_login_name', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('admin_auto_id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_agent($data)
    {
		$insert = $this->db->insert('admin', $data);
	    return $insert;
	}

    /**
    * Update agent
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_agent($id, $data)
    {
		$this->db->where('admin_auto_id', $id);
		$this->db->update('admin', $data);
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
    * Delete agent
    * @param int $id - agent id
    * @return boolean
    */
	function delete_agent($id){
		$this->db->where('admin_auto_id', $id);
		$this->db->delete('admin'); 
	}
	  public function get_agent_details()
    {
		$this->db->select('admin_first_name,admin_auto_id,admin_login_name');
		$this->db->from('admin');
//		$this->db->where('admin', '0');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    public function get_all_agent()
    {
		
		$this->db->select('*');
		$this->db->from('admin');
		$query = $this->db->get();
		return $query->result_array(); 
    }
}
?>	
