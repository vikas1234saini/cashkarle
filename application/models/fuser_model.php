<?php
class Fuser_model extends CI_Model {

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */
	function validate($user_name, $password){
		$this->db->where('email', $user_name);
		$this->db->where('password', $password);
		$this->db->where('status', '1');
		$query = $this->db->get('tbl_user');
		
		if($query->num_rows >= 1){
			return $query->result_array();
		}else{
			return false;
		}
	}
	function get_user_by_id($id){
		$this->db->where('id', $id);
		$query = $this->db->get('tbl_user');
		
		if($query->num_rows >= 1){
			return $query->result_array();
		}else{
			return false;
		}
	}
	function facebook_validate($email, $fid, $name){
		$this->db->where("email = '".$email."' OR facebook='".$fid."'");
		$this->db->where('status', '1');
		$query = $this->db->get('tbl_user');
		
		if($query->num_rows >= 1){
			$data_full = $query->result_array();
			$data['facebook'] = $fid;
			$this->db->where('id', $data_full[0]['id']);
			$this->db->update('tbl_user', $data);
			return $data_full;
		}else{
			$new_member_insert_data = array(
				'email' => $email,
				'facebook' => $fid,			
				'username' => $name,			
				'status' => '1'
			);
			$insert = $this->db->insert('tbl_user', $new_member_insert_data);
			
			$this->db->where("id",$this->db->insert_id());
			$query = $this->db->get('tbl_user');
			return $query->result_array();
		}
	}
	function googleplus_validate($email, $gid, $name){
		$this->db->where("email = '".$email."' OR facebook='".$gid."'");
		$this->db->where('status', '1');
		$query = $this->db->get('tbl_user');
		
		if($query->num_rows >= 1){
			$data_full = $query->result_array();
			$data['gplus'] = $gid;
			$this->db->where('id', $data_full[0]['id']);
			$this->db->update('tbl_user', $data);
			return $data_full;
		}else{
			$new_member_insert_data = array(
				'email' => $email,
				'gplus' => $gid,			
				'username' => $name,			
				'status' => '1'
			);
			$insert = $this->db->insert('tbl_user', $new_member_insert_data);
			
			$this->db->where("id",$this->db->insert_id());
			$query = $this->db->get('tbl_user');
			return $query->result_array();
		}
	}
	function linkedin_validate($email, $lid, $name){
		$this->db->where("email = '".$email."' OR linkedin='".$lid."'");
		$this->db->where('status', '1');
		$query = $this->db->get('tbl_user');
		
		if($query->num_rows >= 1){
			$data_full = $query->result_array();
			$data['linkedin'] = $lid;
			$this->db->where('id', $data_full[0]['id']);
			$this->db->update('tbl_user', $data);
			return $data_full;
		}else{
			$new_member_insert_data = array(
				'email' => $email,
				'linkedin' => $lid,			
				'username' => $name,			
				'status' => '1'
			);
			$insert = $this->db->insert('tbl_user', $new_member_insert_data);
			
			$this->db->where("id",$this->db->insert_id());
			$query = $this->db->get('tbl_user');
			return $query->result_array();
		}
	}
	
	function twitter_validate($email, $tid, $name){
		$this->db->where("email = '".$email."' OR twitter='".$tid."'");
		$this->db->where('status', '1');
		$query = $this->db->get('tbl_user');
		
		if($query->num_rows >= 1){
			$data_full = $query->result_array();
			$data['twitter'] = $tid;
			$this->db->where('id', $data_full[0]['id']);
			$this->db->update('tbl_user', $data);
			return $data_full;
		}else{
			$new_member_insert_data = array(
				'email' => $email,
				'twitter' => $tid,			
				'username' => $name,			
				'status' => '1'
			);
			$insert = $this->db->insert('tbl_user', $new_member_insert_data);
			
			$this->db->where("id",$this->db->insert_id());
			$query = $this->db->get('tbl_user');
			return $query->result_array();
		}
	}
	

    /**
    * Store the new user's data into the database
    * @return boolean - check the insert
    */	
	function create_member(){

		$this->db->where('email', $this->input->post('email'));
		$query = $this->db->get('tbl_user');

        if($query->num_rows > 0){
			return false;
		}else{

			$new_member_insert_data = array(
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),			
				'mobile' => $this->input->post('mobile'),
				'password' => $this->input->post('password')
			);
			$insert = $this->db->insert('tbl_user', $new_member_insert_data);
		    return $insert;
		}
	      
	}//create_member
	
	
	public function update($data,$user_id) {
		$this->db->where('id', $user_id);
		if($this->db->update('tbl_user', $data)){
	   		return true;
		}else{
			return false;
		}
	}
	public function get_password($email) {
		$this->db->where('email', $email);
		$query = $this->db->get('tbl_user');
	   	return $query->result();
	}
	public function check_password($user_id,$password) {
		$this->db->where('password', $password);
		$this->db->where('id', $user_id);
	   	$this->db->from('tbl_user');
		$query = $this -> db -> get();
		
	//	echo $this->db->last_query();
		if($query -> num_rows() >= 1){
			return $query->result();
		}else{
			return false;
		}
	}
	  public function get_all_user()
    {
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('email != ', '');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
}