<?php
class Admin_product extends CI_Controller {
 
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
		
        $this->load->model('product_model');
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
           
            $data['count_product']= $this->product_model->count_product($search_string, $order,null);
            $config['total_rows'] = $data['count_product'];
            $data['product'] = $this->product_model->get_product($search_string, $order, $order_type, $config['per_page'],$limit_end);        

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
            $data['count_product']	= $this->product_model->count_product();
			
            $data['product'] 			= $this->product_model->get_product('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] 	= $data['count_product'];

        }//!isset($agencyId) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/product/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add(){
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
			$this->form_validation->set_rules('title', 'title', 'required');
			$this->form_validation->set_rules('url', 'url', 'required');
			$this->form_validation->set_rules('image', 'image', 'required');
			$this->form_validation->set_rules('category', 'category', 'required');
			$this->form_validation->set_rules('retail_price', 'mrp', 'required');
			$this->form_validation->set_rules('selling_price', 'discounted price', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()){
                $data_to_store = array(
                    'title' => $this->input->post('title'),
        //            'discount' => $this->input->post('discount'),
                    'image' => $this->input->post('image'),
                    'url' => $this->input->post('url'),
                    'category' => $this->input->post('category'),
                    'retail_price' => $this->input->post('retail_price'),
                    'selling_price' => $this->input->post('selling_price')
                );
				$login_user_details = $this->session->userdata('user_details');
				$data_to_store['admin'] = $login_user_details[0]['admin_login_name'];
				$data_to_store['amin_id'] = $login_user_details[0]['admin_auto_id'];
				
                //if the insert has returned true then we show the flash message
                if($this->product_model->store_product($data_to_store)){
                    $data['flash_message'] = TRUE; 
					 $this->session->set_flashdata('flash_message', 'added');
	                redirect('admin/product/');
					die;
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
		
        //load the view
        $data['main_content'] = 'admin/product/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //product id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
			$this->form_validation->set_rules('title', 'title', 'required');
			$this->form_validation->set_rules('url', 'url', 'required');
			$this->form_validation->set_rules('image', 'image', 'required');
			$this->form_validation->set_rules('category', 'category', 'required');
			$this->form_validation->set_rules('retail_price', 'mrp', 'required');
			$this->form_validation->set_rules('selling_price', 'discounted price', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                    'title' => $this->input->post('title'),
          //          'discount' => $this->input->post('discount'),
                    'image' => $this->input->post('image'),
                    'url' => $this->input->post('url'),
                    'category' => $this->input->post('category'),
                    'retail_price' => $this->input->post('retail_price'),
                    'selling_price' => $this->input->post('selling_price')
                );
				$login_user_details = $this->session->userdata('user_details');
				$data_to_store['admin'] = $login_user_details[0]['admin_login_name'];
				$data_to_store['amin_id'] = $login_user_details[0]['admin_auto_id'];
				
                //if the insert has returned true then we show the flash message
                if($this->product_model->update_product($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
	                redirect('admin/product/');
					die;
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/product/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['product'] = $this->product_model->get_product_by_id($id);
		
        //fetch agency data to populate the select field
	//	print_r($data['supervisor']);
//		echo $data['product'][0]['supervisorId'];
        //load the view
        $data['main_content'] = 'admin/product/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
        //product id 
        $id = $this->uri->segment(4);
        $this->product_model->delete_product($id);
        redirect('admin/product');
    }//edit
	
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
		$data_to_store['amin_id'] = $login_user_details[0]['admin_auto_id'];
		
		//if the insert has returned true then we show the flash message
		if($this->product_model->update_product($id, $data_to_store) == TRUE){
			$this->session->set_flashdata('flash_message', 'updated');
			redirect('admin/product/');
			die;
		}
//		echo $id."---".$status;
	}
}