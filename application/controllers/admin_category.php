<?php
class Admin_category extends CI_Controller {
 
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
		
        $this->load->model('category_model');
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
           
            $data['count_category']= $this->category_model->count_category($search_string, $order,null);
            $config['total_rows'] = $data['count_category'];
            $data['category'] = $this->category_model->get_category($search_string, $order, $order_type, $config['per_page'],$limit_end);        

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
            $data['count_category']	= $this->category_model->count_category();
			
            $data['category'] 			= $this->category_model->get_category('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] 	= $data['count_category'];

        }//!isset($agencyId) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/category/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add(){
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
			$this->form_validation->set_rules('categoryName', 'category name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()){
                $data_to_store = array(
                    'categoryName' => $this->input->post('categoryName'),
//                    'discount' => $this->input->post('discount'),
                    'parentId' => $this->input->post('parentId')
                );
                //if the insert has returned true then we show the flash message
                if($this->category_model->store_category($data_to_store)){
                    $data['flash_message'] = TRUE; 
					 $this->session->set_flashdata('flash_message', 'added');
	                redirect('admin/category/');
					die;
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
		
        $data['parentcat'] = $this->category_model->get_all_category();
        //load the view
        $data['main_content'] = 'admin/category/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //category id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
			$this->form_validation->set_rules('categoryName', 'category name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                    'categoryName' => $this->input->post('categoryName'),
  //                  'discount' => $this->input->post('discount'),
                    'parentId' => $this->input->post('parentId')
                );
                //if the insert has returned true then we show the flash message
                if($this->category_model->update_category($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
	                redirect('admin/category/');
					die;
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/category/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //category data 
        $data['category'] = $this->category_model->get_category_by_id($id);
        $data['parentcat'] = $this->category_model->get_all_category();
		
        //fetch agency data to populate the select field
	//	print_r($data['supervisor']);
//		echo $data['category'][0]['supervisorId'];
        //load the view
        $data['main_content'] = 'admin/category/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete category by his id
    * @return void
    */
    public function delete()
    {
        //category id 
        $id = $this->uri->segment(4);
        $this->category_model->delete_category($id);
        redirect('admin/category');
    }//edit
	
	/**
    * Update category status by id
    * @return void
    */
    public function updatestatus(){
        $id 	= $this->uri->segment(4);
        $status = $this->uri->segment(5);
		
       	$count_category = $this->category_model->count_category(null, null, null,'1');

		$data_to_store = array(
			'status' => $status
		);
		//if the insert has returned true then we show the flash message
		if($this->category_model->update_category($id, $data_to_store) == TRUE){
			$this->session->set_flashdata('flash_message', 'updated');
			redirect('admin/category/');
			die;
		}
//		echo $id."---".$status;
	}
}