<?php
class Admin_log extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct() {
        parent::__construct();
		
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }		
        $this->load->model('log_model');
    }
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
           
            $data['count_log']= $this->log_model->count_log($search_string, $order,null);
            $config['total_rows'] = $data['count_log'];
            $data['log'] = $this->log_model->get_log($search_string, $order, $order_type, $config['per_page'],$limit_end);        

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
            $data['count_log']	= $this->log_model->count_log();
			
            $data['log'] 			= $this->log_model->get_log('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] 	= $data['count_log'];

        }//!isset($agencyId) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/log/list';
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
        $data['order'] = $this->log_model->get_order_by_id($id);
		
        //fetch agency data to populate the select field
	//	print_r($data['supervisor']);
//		echo $data['order'][0]['supervisorId'];
        //load the view
        $data['main_content'] = 'admin/order/edit';
        $this->load->view('includes/template', $data);
    }//update
}