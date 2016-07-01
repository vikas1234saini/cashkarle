<?php
class Admin_flipkartofferdiscount extends CI_Controller {
 
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
		
        $this->load->model('flipkartofferdiscount_model');
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
           
            $data['count_flipkartofferdiscount']= $this->flipkartofferdiscount_model->count_flipkartofferdiscount($search_string, $order,null);
            $config['total_rows'] = $data['count_flipkartofferdiscount'];
            $data['flipkartofferdiscount'] = $this->flipkartofferdiscount_model->get_flipkartofferdiscount($search_string, $order, $order_type, $config['per_page'],$limit_end);        

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
            $data['count_flipkartofferdiscount']	= $this->flipkartofferdiscount_model->count_flipkartofferdiscount();
			
            $data['flipkartofferdiscount'] 			= $this->flipkartofferdiscount_model->get_flipkartofferdiscount('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] 	= $data['count_flipkartofferdiscount'];

        }//!isset($agencyId) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/flipkartofferdiscount/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add(){
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
			$this->form_validation->set_rules('category', 'category', 'required');
			$this->form_validation->set_rules('discount_given', 'discount_given', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()){
                $data_to_store = array(
                    'category' => $this->input->post('category'),
                    'discount_given' => $this->input->post('discount_given'),
                    'discount_by_us' => $this->input->post('discount_by_us')
                );
				$login_user_details = $this->session->userdata('user_details');
				$data_to_store['admin'] = $login_user_details[0]['admin_login_name'];
				$data_to_store['amin_id'] = $login_user_details[0]['admin_auto_id'];
				
                //if the insert has returned true then we show the flash message
                if($this->flipkartofferdiscount_model->store_flipkartofferdiscount($data_to_store)){
                    $data['flash_message'] = TRUE; 
					 $this->session->set_flashdata('flash_message', 'added');
	                redirect('admin/flipkartofferdiscount/');
					die;
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
		
        //load the view
        $data['main_content'] = 'admin/flipkartofferdiscount/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //flipkartofferdiscount id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
			
            //form validation
			$this->form_validation->set_rules('category', 'category', 'required');
			$this->form_validation->set_rules('discount_given', 'discount_given', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()){
                $data_to_store = array(
                    'category' => $this->input->post('category'),
                    'discount_given' => $this->input->post('discount_given'),
                    'discount_by_us' => $this->input->post('discount_by_us')
                );
				$login_user_details = $this->session->userdata('user_details');
				$data_to_store['admin'] = $login_user_details[0]['admin_login_name'];
				$data_to_store['amin_id'] = $login_user_details[0]['admin_auto_id'];
				
                //if the insert has returned true then we show the flash message
                if($this->flipkartofferdiscount_model->update_flipkartofferdiscount($id, $data_to_store) == TRUE){			
					$data_update = array();
					$data_update['flipkartoffer_discount'] 		= $this->input->post('discount_by_us');
					$this->db->where('flipkartoffer_group', $id);
					$this->db->update('tbl_category', $data_update);
					
                    $this->session->set_flashdata('flash_message', 'updated');
	                redirect('admin/flipkartofferdiscount/');
					die;
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/flipkartofferdiscount/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //flipkartofferdiscount data 
        $data['flipkartofferdiscount'] = $this->flipkartofferdiscount_model->get_flipkartofferdiscount_by_id($id);
		
		
        //fetch agency data to populate the select field
	//	print_r($data['supervisor']);
//		echo $data['flipkartofferdiscount'][0]['supervisorId'];
        //load the view
        $data['main_content'] = 'admin/flipkartofferdiscount/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete flipkartofferdiscount by his id
    * @return void
    */
    public function delete()
    {
        //flipkartofferdiscount id 
        $id = $this->uri->segment(4);
        $this->flipkartofferdiscount_model->delete_flipkartofferdiscount($id);
        redirect('admin/flipkartofferdiscount');
    }//edit
	
	/**
    * Update flipkartofferdiscount status by id
    * @return void
    */
    public function updatestatus(){
        $id 	= $this->uri->segment(4);
        $status = $this->uri->segment(5);
		
		$data_to_store = array(
			'status' => $status
		);
		//if the insert has returned true then we show the flash message
		if($this->flipkartofferdiscount_model->update_flipkartofferdiscount($id, $data_to_store) == TRUE){
			$this->session->set_flashdata('flash_message', 'updated');
			redirect('admin/flipkartofferdiscount/');
			die;
		}
//		echo $id."---".$status;
	}
}