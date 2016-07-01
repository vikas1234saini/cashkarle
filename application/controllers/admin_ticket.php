<?php
class Admin_ticket extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
		
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
		
        $this->load->model('ticket_model');
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {

        //all the posts sent by the view
        $search_string 	= $this->input->post('search_string');           
        $from_date 	= $this->input->post('from_date');           
        $to_date 	= $this->input->post('to_date');        
        $order 			= $this->input->post('order'); 
        $order_type 	= $this->input->post('order_type'); 
        $orderfor	 	= $this->input->post('orderfor'); 

        //pagination settings
        $config['per_page'] = 30;
        $config['base_url'] = base_url().'admin/'.$this->uri->segment(2);
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
		$filter_session_data = array();

        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 
		if($from_date !== false || $order !== false || $page != ''){ 


            if($search_string != false){
                $filter_session_data['search_string'] = $search_string;
            }else{
				if($page!=''){
                	$search_string = $this->session->userdata('search_string');
	                $filter_session_data['search_string'] = $search_string;
				}
            }
            $data['search_string'] = $search_string;
			
            if($from_date != false){
                $filter_session_data['from_date'] = $from_date;
            }else{
				if($page!=''){
                	$from_date = $this->session->userdata('from_date');
	                $filter_session_data['from_date'] = $from_date;
				}
            }
            $data['from_date'] = $from_date;
			
            if($to_date != false){
                $filter_session_data['to_date'] = $to_date;
            }else{
				if($page!=''){
                	$to_date = $this->session->userdata('to_date');
	                $filter_session_data['to_date'] = $to_date;
				}
            }
            $data['to_date'] = $to_date;
			
            if($order != false){
                $filter_session_data['order'] = $order;
            }else{
				if($page!=''){
                	$order = $this->session->userdata('order');
	                $filter_session_data['order'] = $order;
				}
            }
			
            $data['order'] = $order;
			
			
	
            if($orderfor != false){
                $filter_session_data['orderfor'] = $orderfor;
            }else{
				if($page!=''){
                	$orderfor = $this->session->userdata('orderfor');
	                $filter_session_data['orderfor'] = $orderfor;
				}
            }
            $data['orderfor'] = $orderfor;
	
            if($order_type != false){
                $filter_session_data['order_type'] = $order_type;
            }else{
				if($page!=''){
                	$order_type = $this->session->userdata('order_type');
	                $filter_session_data['order_type'] = $order_type;
				}
            }
            $data['order_type'] = $order_type;
			
            //save session data into the session
            $this->session->set_userdata($filter_session_data);

            //fetch agency data into arrays
           
            $data['count_ticket']= $this->ticket_model->count_ticket($orderfor,$search_string, $order,null, $from_date, $to_date);
            $config['total_rows'] = $data['count_ticket'];
            $data['ticket'] = $this->ticket_model->get_ticket($orderfor,$search_string, $order, $order_type, $from_date, $to_date, $config['per_page'],$limit_end);        

        }else{

            //clean filter data inside section
			
            $filter_session_data['search_string'] = '';
            $filter_session_data['from_date'] = '';
            $filter_session_data['to_date'] = '';
            $filter_session_data['order'] = '';
            $filter_session_data['orderfor'] = '';
            $filter_session_data['order_type'] = '';
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string'] = '';
            $data['from_date'] = '';
            $data['to_date'] = '';
            $data['order'] 		= '';
            $data['orderfor'] 		= '';
            $data['order_type'] = '';

            //fetch sql data into arrays
            $data['count_ticket']	= $this->ticket_model->count_ticket($orderfor);
			
            $data['ticket'] 			= $this->ticket_model->get_ticket($orderfor,'', '', $order_type,'','', $config['per_page'],$limit_end);        
            $config['total_rows'] 	= $data['count_ticket'];

        }//!isset($agencyId) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

		$options_offer_sort1 = array();
		if($orderfor=='offerby'){
			
	        $this->load->model('offer_model');
			$allofferby = $this->offer_model->get_just_all_offer();	
			
			$find = array("CPRC", "CPA","CPS","CPL"," - India"," - UAE"," - Qatar");
			$replace = array("","","","","");
			$inarray = array();
			foreach($allofferby as $key=>$value){
				$strinval = str_replace($find,$replace,$value['title']);
				if(!in_array($strinval,$inarray)){
					$options_offer_sort1[$strinval]= $strinval;
					$inarray[] = $strinval; 
				}
			}
		}
		if($orderfor=='username'){
	        $this->load->model('agent_model');
			$allofferby = $this->agent_model->get_all_agent();	
			
			$inarray = array();
			foreach($allofferby as $key=>$value){
				$strinval = $value['admin_login_name'];
				if(!in_array($strinval,$inarray)){
					$options_offer_sort1[$strinval]= $strinval;
					$inarray[] = $strinval; 
				}
			}
		}
		if($orderfor=='status'){			
			$options_offer_sort1['0'] = 'Opened';
			$options_offer_sort1['1'] = 'Closeed';
			$options_offer_sort1['2'] = 'Re-opened';
		}
		$data['options_offer_sort1'] = $options_offer_sort1;
        //load the view
        $data['main_content'] = 'admin/ticket/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add(){
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
			$this->form_validation->set_rules('retailer', 'retailer', 'required');
			$this->form_validation->set_rules('transection_id', 'transection id', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()){
				
				$post_data = $this->input->post();	
                //$user_details = $this->session->userdata('fuser_details');
				$post_data_new = array();
				
				if(isset($_FILES["ticketuserfile"]['name']) && $_FILES["ticketuserfile"]['name']!=''){
					
					$config['upload_path'] 		= APPPATH.'../assets/uploads/attachment/';
					$config['allowed_types'] 	= 'gif|jpg|png';
					$config['max_size']			= '100000';
					$config['max_width']  		= '1024';
					$config['max_height']  		= '768';
					$config['overwrite'] 		= TRUE;
					
					$new_name 	= time().$_FILES["ticketuserfile"]['name'];
					$config['file_name'] = $new_name;
			
					$this->load->library('upload', $config);
			
					if ( ! $this->upload->do_upload('ticketuserfile')){
						$error = array('error' => $this->upload->display_errors());
					}else{
						$post_data_new['attachment'] 	= $config['file_name'];
					}
				}
	//			$user_details	= $this->session->userdata('fuser_details');
				
				$post_data_new['retailer'] 			= $post_data['retailer'];
				$post_data_new['date'] 				= date("Y-m-d",strtotime($post_data['date']));
				$post_data_new['amount'] 			= $post_data['amount'];
				$post_data_new['transection_id'] 	= $post_data['transection_id'];
				$post_data_new['description'] 		= $post_data['description'];
				//$post_data_new['user_id'] 			= $user_details[0]['id'];
				$post_data_new['ticket_id'] 		= rand(10000000,99999999);
				
				$login_user_details = $this->session->userdata('user_details');
				$post_data_new['admin'] = $login_user_details[0]['admin_login_name'];
				$post_data_new['admin_id'] = $login_user_details[0]['admin_auto_id'];
				
				if($this->order_model->store_ticket($post_data_new)){
					$data['success'] 	= '1';
					$data['data'] 		= $post_data_new;
					/*$config = array('mailtype' => 'html');
					$this->load->library('email',$config);
					$description = "Hello ".$user_details[0]['username']."<br/><br/>";
					$description .= "Your ticket id is:".$post_data_new['ticket_id']."<br/><br/>";
					$description .= "Thanks<br/>Cashkarle";
					
					$this->email->from('info@cashkarle.com', 'cashkarle');
					$this->email->to($user_details[0]['email']); 
					
					$this->email->subject("Ticket Added To Cashkarle");
					$this->email->message($description);	
					$this->email->send();*/
					
                    $data['flash_message'] = TRUE; 
					$this->session->set_flashdata('flash_message', 'added');
	                redirect('admin/ticket/');
					die;
                }else{
                    $data['flash_message'] = FALSE; 
                }
            }
        }
		
        $this->load->model('offer_model');
        $data['offerlist'] = $this->offer_model->get_all_offer();
		
        //load the view
        $data['main_content'] = 'admin/ticket/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //ticket id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
			$this->form_validation->set_rules('retailer', 'retailer', 'required');
			$this->form_validation->set_rules('transection_id', 'transection id', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
				$post_data = $this->input->post();	
				$post_data_new = array();
				if(isset($_FILES["ticketuserfile"]['name']) && $_FILES["ticketuserfile"]['name']!=''){
					$config['upload_path'] 		= APPPATH.'../assets/uploads/attachment/';
					$config['allowed_types'] 	= 'gif|jpg|png';
					$config['max_size']			= '100000';
					$config['max_width']  		= '1024';
					$config['max_height']  		= '768';
					$config['overwrite'] 		= TRUE;
					
					$new_name 	= time().$_FILES["ticketuserfile"]['name'];
					$config['file_name'] = $new_name;
			
					$this->load->library('upload', $config);
			
					if ( ! $this->upload->do_upload('ticketuserfile')){
						$error = array('error' => $this->upload->display_errors());
					}else{
						$post_data_new['attachment'] 	= $config['file_name'];
					}
				}
	//			$user_details	= $this->session->userdata('fuser_details');
				
				$post_data_new['retailer'] 			= $post_data['retailer'];
				$post_data_new['date'] 				= date("Y-m-d",strtotime($post_data['date']));
				$post_data_new['amount'] 			= $post_data['amount'];
				$post_data_new['transection_id'] 	= $post_data['transection_id'];
				$post_data_new['description'] 		= $post_data['description'];
				//$post_data_new['user_id'] 			= $user_details[0]['id'];
				$post_data_new['ticket_id'] 		= rand(10000000,99999999);
			//	print_r($post_data_new);
				//die;
				$login_user_details = $this->session->userdata('user_details');
				$post_data_new['admin'] = $login_user_details[0]['admin_login_name'];
				$post_data_new['admin_id'] = $login_user_details[0]['admin_auto_id'];
				
                //if the insert has returned true then we show the flash message
                if($this->ticket_model->update_ticket($id, $post_data_new) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
	                redirect('admin/ticket/');
					die;
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/ticket/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //ticket data 
        $data['ticket'] = $this->ticket_model->get_ticket_by_id($id);
        $this->load->model('offer_model');
        $data['offerlist'] = $this->offer_model->get_all_offer();
		
        //fetch agency data to populate the select field
	//	print_r($data['supervisor']);
//		echo $data['ticket'][0]['supervisorId'];
        //load the view
        $data['main_content'] = 'admin/ticket/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete ticket by his id
    * @return void
    */
    public function delete()
    {
        //ticket id 
        $id = $this->uri->segment(4);
        $this->ticket_model->delete_ticket($id);
        redirect('admin/ticket');
    }//edit
	
	/**
    * Update ticket status by id
    * @return void
    */
    public function updatestatus(){
        $id 	= $this->uri->segment(4);
        $status = $this->uri->segment(5);
		
		$post_data_new = array(
			'status' => $status
		);
		$login_user_details = $this->session->userdata('user_details');
		$post_data_new['admin'] = $login_user_details[0]['admin_login_name'];
		$post_data_new['admin_id'] = $login_user_details[0]['admin_auto_id'];
		
		//if the insert has returned true then we show the flash message
		if($this->ticket_model->update_ticket($id, $post_data_new) == TRUE){
			$this->session->set_flashdata('flash_message', 'updated');
			redirect('admin/ticket/');
			die;
		}
//		echo $id."---".$status;
	}
	public function reply(){
		
        //ticket id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
            //form validation
			$this->form_validation->set_rules('reply', 'reply', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {
				
				$post_data = $this->input->post();	
                //$user_details = $this->session->userdata('fuser_details');
				$post_data_new = array();
				
				$post_data_new['reply'] 			= $post_data['reply'];
				$post_data_new['date'] 				= date("Y-m-d H:i:s");
				$post_data_new['ticket_id'] 		= $id;
//				$post_data_new['status'] 			= "1";
				
				$login_user_details 		= $this->session->userdata('user_details');
				$post_data_new['admin'] 	= $login_user_details[0]['admin_login_name'];
				$post_data_new['user'] 		= $login_user_details[0]['admin_login_name'];
				$post_data_new['admin_id'] 	= $login_user_details[0]['admin_auto_id'];
				
				if($this->db->insert("tbl_reply",$post_data_new)){
					$data['success'] 	= '1';
					$data['data'] 		= $post_data_new;
					
					$post_data_new = array();
				//	$post_data_new['date'] 			= date("Y-m-d",strtotime($post_data['date']));
					$post_data_new['ticket_id'] 	= $id;
					$post_data_new['status'] 		= '1';
					
					$login_user_details = $this->session->userdata('user_details');
					
					$post_data_new['admin'] = $login_user_details[0]['admin_login_name'];
					$post_data_new['admin_id'] = $login_user_details[0]['admin_auto_id'];
					
					//if the insert has returned true then we show the flash message
					$this->ticket_model->update_ticket($id, $post_data_new);
					
					/*$config = array('mailtype' => 'html');
					$this->load->library('email',$config);
					$description = "Hello ".$user_details[0]['username']."<br/><br/>";
					$description .= "Your ticket id is:".$post_data_new['ticket_id']."<br/><br/>";
					$description .= "Thanks<br/>Cashkarle";
					
					$this->email->from('info@cashkarle.com', 'cashkarle');
					$this->email->to($user_details[0]['email']); 
					
					$this->email->subject("Ticket Added To Cashkarle");
					$this->email->message($description);	
					$this->email->send();*/
					
                    $data['flash_message'] = TRUE; 
					$this->session->set_flashdata('flash_message', 'added');
	                redirect('admin/ticket/');
					die;
                }else{
                    $data['flash_message'] = FALSE; 
                }
            
				
			}//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //ticket data 
        $data['prev_reply'] = $this->ticket_model->get_all_reply_by_ticket($id);
    
        $data['main_content'] = 'admin/ticket/reply';
        $this->load->view('includes/template', $data);
	}
	
	function getticketoption(){
		$post_data = $this->input->post();	
		if($post_data['str']=='offerby'){
	        $this->load->model('offer_model');
			$allofferby = $this->offer_model->get_just_all_offer();	
			
			$find = array("CPRC", "CPA","CPS","CPL"," - India"," - UAE"," - Qatar");
			$replace = array("","","","","");
			$inarray = array();
			foreach($allofferby as $key=>$value){
				$strinval = str_replace($find,$replace,$value['title']);
				if(!in_array($strinval,$inarray)){
					echo "<option value='".$strinval."'>".$strinval."</option>";
					$inarray[] = $strinval; 
				}
			}
		}
		if($post_data['str']=='username'){
	        $this->load->model('agent_model');
			$allofferby = $this->agent_model->get_all_agent();	
			
			$inarray = array();
			foreach($allofferby as $key=>$value){
				$strinval = $value['admin_login_name'];
				if(!in_array($strinval,$inarray)){
					echo "<option value='".$strinval."'>".$strinval."</option>";
					$inarray[] = $strinval; 
				}
			}
		}
		if($post_data['str']=='status'){			
			echo "<option value='0'>Opened</option>";
			echo "<option value='1'>Closed</option>";
			echo "<option value='2'>Re-opened</option>";
		}
	}
}