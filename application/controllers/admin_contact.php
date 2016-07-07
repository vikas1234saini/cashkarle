<?php
class Admin_contact extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct() {
        parent::__construct();
		
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }		
        $this->load->model('contact_model');
    }
	 public function index()
    {

        //all the posts sent by the view
        $search_string 	= $this->input->post('search_string');        
        $order 			= $this->input->post('order'); 
        $order_type 	= $this->input->post('order_type'); 
        $orderfor 			= $this->input->post('orderfor'); 
        $from_date 	= $this->input->post('from_date');           
        $to_date 	= $this->input->post('to_date');     

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

        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 
		if($search_string !== false || $order !== false || $page != ''){ 
		
			$filter_session_data['page'] = $page;
            if($search_string != false){
                $filter_session_data['search_string'] = $search_string;
            }else{
				if($page!=''){
                	$search_string = $this->session->userdata('search_string');
	                $filter_session_data['search_string'] = $search_string;
				}
            }
            $data['search_string'] = $search_string;
			
            if($order != false){
                $filter_session_data['order'] = $order;
            }else{
				if($page!=''){
                	$order = $this->session->userdata('order');
	                $filter_session_data['order'] = $order;
				}
            }
            $data['order'] = $order;
	
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
           
            $data['count_contact']= $this->contact_model->count_contact($orderfor, $from_date, $to_date,$search_string, $order,null);
            $config['total_rows'] = $data['count_contact'];
            $data['contact'] = $this->contact_model->get_contact($search_string, $order, $order_type, $from_date, $to_date, $config['per_page'],$limit_end,$orderfor);        

        }else{

            //clean filter data inside section
			
            $filter_session_data['page'] = '';
            $filter_session_data['search_string'] = '';
            $filter_session_data['order'] = '';
            $filter_session_data['orderfor'] = '';
            $filter_session_data['order_type'] = 'desc';
            $filter_session_data['from_date'] = '';
            $filter_session_data['to_date'] = '';
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string'] = '';
            $data['order'] 		= 'id';
            $data['orderfor'] 		= '';
            $data['order_type'] = 'desc';
            $data['from_date'] = '';
            $data['to_date'] = '';

            //fetch sql data into arrays
            $data['count_contact']	= $this->contact_model->count_contact($orderfor, $from_date, $to_date);
			
            $data['contact'] 		= $this->contact_model->get_contact('', '', 'desc', $from_date, $to_date, $config['per_page'],$limit_end,$orderfor);        
            $config['total_rows'] 	= $data['count_contact'];

        }//!isset($agencyId) && !isset($search_string) && !isset($order)


		$options_offer_sort1 = array();
//		if($orderfor=='username'){
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
	//	}
		if($orderfor=='status'){			
			$options_offer_sort1 = array();
			$options_offer_sort1['1'] = 'Replied';
			$options_offer_sort1['0'] = 'Active';
		}
		$data['options_offer_sort1'] = $options_offer_sort1;
    
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/contact/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function snapdeal(){
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //if the form has passed through the validation
            if ($this->form_validation->run()){
    
                //if the insert has returned true then we show the flash message
                if($this->order_model->update_order($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
	                redirect('admin/order/');
					die;
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/order/update/'.$id.'');
            }//validation run
        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //order data 
        $data['order'] = $this->contact_model->get_order_by_id($id);
		
        //fetch agency data to populate the select field
	//	print_r($data['supervisor']);
//		echo $data['order'][0]['supervisorId'];
        //load the view
        $data['main_content'] = 'admin/order/edit';
        $this->load->view('includes/template', $data);
    }//update
		/**
    * Update product status by id
    * @return void
    */
    public function updatestatus(){
        $id 	= $this->uri->segment(4);
        $status = $this->uri->segment(5);
		
		$data_to_store = array(
			'status' => $status
		);
		$login_user_details = $this->session->userdata('user_details');
		$data_to_store['admin'] = $login_user_details[0]['admin_login_name'];
		$data_to_store['admin_id'] = $login_user_details[0]['admin_auto_id'];
		$data_to_store['rdate'] = date('Y-m-d H:i:s');
		
		//if the insert has returned true then we show the flash message
		if($this->contact_model->update_contact($id, $data_to_store) == TRUE){
			$this->session->set_flashdata('flash_message', 'updated');
			redirect('admin/contact/');
			die;
		}
//		echo $id."---".$status;
	}
	function getcontactorder(){
		$post_data = $this->input->post();	
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
			echo "<option value='1'>Replied</option>";
			echo "<option value='0'>Active</option>";
		}
	}


    /**
    * Update item by his id
    * @return void
    */
    public function view()
    {
        //product id 
        $id = $this->uri->segment(4);
  
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['contact'] = $this->contact_model->get_contact_by_id($id);
		
        //fetch agency data to populate the select field
	//	print_r($data['supervisor']);
//		echo $data['product'][0]['supervisorId'];
        //load the view
        $data['main_content'] = 'admin/contact/view';
        $this->load->view('includes/template', $data);            

    }//update

}