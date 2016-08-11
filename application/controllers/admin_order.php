<?php
class Admin_order extends CI_Controller {
 
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
		
        $this->load->model('order_model');
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {

        //all the posts sent by the view
        $search_string 	= $this->input->post('search_string');        
        $orderfor 			= $this->input->post('orderfor'); 
        $order_type 	= $this->input->post('order_type'); 
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
		$filter_session_data = array();
		if($search_string !== false || $orderfor !== false || $page != ''){ 


            if($search_string != false){
                $filter_session_data['search_string'] = $search_string;
            }else{
				if($page!=''){
                	$search_string = $this->session->userdata('search_string');
	                $filter_session_data['search_string'] = $search_string;
				}
            }
            $data['search_string'] = $search_string;
			
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

            //save session data into the session
            $this->session->set_userdata($filter_session_data);

            //fetch agency data into arrays
           
            $data['count_order']= $this->order_model->count_order($from_date, $to_date,$search_string, $orderfor,null);
            $config['total_rows'] = $data['count_order'];
            $data['order'] = $this->order_model->get_order($from_date, $to_date,$search_string, $orderfor, $order_type, $config['per_page'],$limit_end);        

        }else{

            //clean filter data inside section
			
            $filter_session_data['search_string'] = '';
            $filter_session_data['orderfor'] = '';
            $filter_session_data['order_type'] = '';
			
            $filter_session_data['to_date'] = '';
            $filter_session_data['from_date'] = '';
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string'] = '';
            $data['orderfor'] 		= 'id';
            $data['order_type'] = '';
			
            $data['to_date'] = '';
            $data['from_date'] = '';

            //fetch sql data into arrays
            $data['count_order']	= $this->order_model->count_order($from_date, $to_date);
			
            $data['order'] 			= $this->order_model->get_order($from_date, $to_date,'', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] 	= $data['count_order'];

        }//!isset($agencyId) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/order/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add(){
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
			$this->form_validation->set_rules('title', 'title', 'required');
			$this->form_validation->set_rules('url', 'url', 'required');
			$this->form_validation->set_rules('image', 'image', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()){
                $data_to_store = array(
                    'title' => $this->input->post('title'),
                    'discount' => $this->input->post('discount'),
                    'image' => $this->input->post('image'),
                    'url' => $this->input->post('url')
                );
                //if the insert has returned true then we show the flash message
                if($this->order_model->store_order($data_to_store)){
                    $data['flash_message'] = TRUE; 
					 $this->session->set_flashdata('flash_message', 'added');
	                redirect('admin/order/');
					die;
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
		
        //load the view
        $data['main_content'] = 'admin/order/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //order id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
			$this->form_validation->set_rules('title', 'title', 'required');
			$this->form_validation->set_rules('url', 'url', 'required');
			$this->form_validation->set_rules('image', 'image', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                    'title' => $this->input->post('title'),
                    'discount' => $this->input->post('discount'),
                    'image' => $this->input->post('image'),
                    'url' => $this->input->post('url')
                );
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
        $data['order'] = $this->order_model->get_order_by_id($id);
		
        //fetch agency data to populate the select field
	//	print_r($data['supervisor']);
//		echo $data['order'][0]['supervisorId'];
        //load the view
        $data['main_content'] = 'admin/order/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete order by his id
    * @return void
    */
    public function delete()
    {
        //order id 
        $id = $this->uri->segment(4);
        $this->order_model->delete_order($id);
        redirect('admin/order');
    }//edit
	
	/**
    * Update order status by id
    * @return void
    */
    public function updatestatus(){
        $id 	= $this->uri->segment(4);
        $status = $this->uri->segment(5);
		
		$data_to_store = array(
			'status' => $status
		);
		//if the insert has returned true then we show the flash message
		if($this->order_model->update_order($id, $data_to_store) == TRUE){
			$this->session->set_flashdata('flash_message', 'updated');
			redirect('admin/order/');
			die;
		}
//		echo $id."---".$status;
	}
}