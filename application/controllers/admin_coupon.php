<?php
class Admin_coupon extends CI_Controller {
 
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
		
        $this->load->model('coupon_model');
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {

        //all the posts sent by the view
        $search_string 	= $this->input->post('search_string');        
        $order 			= $this->input->post('order'); 
        $order_type 	= $this->input->post('order_type'); 

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
           
            $data['count_coupon']= $this->coupon_model->count_coupon($search_string, $order,null);
            $config['total_rows'] = $data['count_coupon'];
            $data['coupon'] = $this->coupon_model->get_coupon($search_string, $order, $order_type, $config['per_page'],$limit_end);        

        }else{

            //clean filter data inside section
			
            $filter_session_data['search_string'] = '';
            $filter_session_data['order'] = '';
            $filter_session_data['order_type'] = '';
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string'] = '';
            $data['order'] 		= 'id';
            $data['order_type'] = '';

            //fetch sql data into arrays
            $data['count_coupon']	= $this->coupon_model->count_coupon();
            $data['coupon'] 			= $this->coupon_model->get_coupon('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] 	= $data['count_coupon'];

        }//!isset($agencyId) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        $this->load->model('offer_model');
		$data['alloffer'] = $this->offer_model->get_just_all_offer();	
        //load the view
        $data['main_content'] = 'admin/coupon/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add(){
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
			$this->form_validation->set_rules('coupon_title', 'coupon', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()){
                $data_to_store = array(
                    'coupon_title' => $this->input->post('coupon_title'),
                    'discount' => $this->input->post('discount'),
                    'offer_id' => $this->input->post('offer_id'),
                    'offer_name' => $this->input->post('offer_name'),
                    'coupon_description' => $this->input->post('coupon_description'),
                    'added' => date("Y-m-d",strtotime($this->input->post('added'))),
                    'coupon_expiry' => date("Y-m-d",strtotime($this->input->post('coupon_expiry'))),
                    'link' => $this->input->post('link')
					
                );
				$login_user_details = $this->session->userdata('user_details');
				$data_to_store['admin'] = $login_user_details[0]['admin_login_name'];
				$data_to_store['admin_id'] = $login_user_details[0]['admin_auto_id'];
				
                //if the insert has returned true then we show the flash message
                if($this->coupon_model->store_coupon($data_to_store)){
                    $data['flash_message'] = TRUE; 
					 $this->session->set_flashdata('flash_message', 'added');
	                redirect('admin/couponoffer/'.$this->input->post('offer_id'));
					die;
                }else{
                    $data['flash_message'] = FALSE; 
                }
				
                redirect('admin/coupon/add/'.$id.'');
            }
        }
		
        $this->load->model('offer_model');
		$data['alloffer'] = $this->offer_model->get_just_all_offer();	
       // $data['parentcat'] = $this->coupon_model->get_all_coupon();
        //load the view
        $data['main_content'] = 'admin/coupon/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //coupon id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
			$this->form_validation->set_rules('discount', 'discount', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {
    
                $data_to_store = array(
                    'discount_type' => $this->input->post('discount_type'),
                    'discount' => $this->input->post('discount'),
                    'offer_id' => $this->input->post('offer_id'),
                    'offer_name' => $this->input->post('offer_name')
                );
				$login_user_details = $this->session->userdata('user_details');
				$data_to_store['admin'] = $login_user_details[0]['admin_login_name'];
				$data_to_store['admin_id'] = $login_user_details[0]['admin_auto_id'];
				
                //if the insert has returned true then we show the flash message
                if($this->coupon_model->update_coupon($id, $data_to_store) == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
	                redirect('admin/couponoffer/'.$this->input->post('offer_id'));
					die;
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/coupon/update/'.$id.'');
            }//validation run
        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //coupon data 
        $data['coupon'] = $this->coupon_model->get_coupon_by_id($id);
		
       	//$data['parentcat'] = $this->coupon_model->get_all_coupon();
        //fetch agency data to populate the select field
		//print_r($data['supervisor']);
		//echo $data['coupon'][0]['supervisorId'];

        $this->load->model('offer_model');
		$data['alloffer'] = $this->offer_model->get_just_all_offer();	
        //load the view
        $data['main_content'] = 'admin/coupon/edit';
        $this->load->view('includes/template', $data);
		
    }//update

    /**
    * Delete coupon by his id
    * @return void
    */
    public function delete()
    {
        //coupon id 
        $id = $this->uri->segment(4);
        $offer_id = $this->uri->segment(5);

        $this->coupon_model->delete_coupon($id);
        redirect('admin/couponoffer/'.$offer_id);
    }//edit
	
	/**
    * Update coupon status by id
    * @return void
    */
    public function updatestatus(){
        $id 	= $this->uri->segment(4);
        $status = $this->uri->segment(5);
		
		$data_to_store = array(
			'status' => $status
		);
		//if the insert has returned true then we show the flash message
		if($this->coupon_model->update_coupon($id, $data_to_store) == TRUE){
			$this->session->set_flashdata('flash_message', 'updated');
			redirect('admin/coupon/');
			die;
		}
//		echo $id."---".$status;
	}
	
	function couponoffer($offer){
		
        $data['coupon'] 		= $this->coupon_model->get_all_coupon_offer($offer);
        $data['main_content'] = 'admin/coupon/listview';
        $this->load->view('includes/template', $data);
	}
}