<?php
class Admin_agent extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('agent_model');

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {

        //all the posts sent by the view
        $manufacture_id = $this->input->post('manufacture_id');        
        $search_string 	= $this->input->post('search_string');        
        $order 			= $this->input->post('order'); 
        $order_type 	= $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 20;
        $config['base_url'] = base_url().'admin/agent';
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
		$filter_session_data = array();
		
        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

        //if order type was changed
        if($order_type){
            $filter_session_data['order_type'] = $order_type;
        }
        else{
            //we have something stored in the session? 
            if($this->session->userdata('order_type')){
                $order_type = $this->session->userdata('order_type');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Asc';    
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;        


        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data

        //filtered && || paginated
        if($search_string !== false && $order !== false || $this->uri->segment(3) == true){ 
           
            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */
            if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;

            if($order){
                $filter_session_data['order'] = $order;
            }
            else{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            $this->session->set_userdata($filter_session_data);


            $data['count_agent']= $this->agent_model->count_agent(false, $search_string, $order);
            $config['total_rows'] = $data['count_agent'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['agent'] = $this->agent_model->get_agent(false, $search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['agent'] = $this->agent_model->get_agent(false, $search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['agent'] = $this->agent_model->get_agent(false, '', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['agent'] = $this->agent_model->get_agent(false, '', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            $data['count_agent']= $this->agent_model->count_agent();
            $data['agent'] = $this->agent_model->get_agent('', '', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_agent'];

        }//!isset($manufacture_id) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/agent/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add(){
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
			$this->form_validation->set_rules('admin_first_name', 'Agent Name', 'trim|required');
            $this->form_validation->set_rules('admin_login_name', 'Login Name', 'trim|required|callback_username_check');
            $this->form_validation->set_rules('admin_password', 'password', 'trim|required');
            $this->form_validation->set_rules('admin_email_id', 'email', 'trim|required|email');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			
			
            //if the form has passed through the validation
            if ($this->form_validation->run()){
                $data_to_store = array(
                    'admin_first_name' => $this->input->post('admin_first_name'),
                    'admin_login_name' => $this->input->post('admin_login_name'),
                    'admin_password' => $this->input->post('admin_password'),
                    'admin_email_id' => $this->input->post('admin_email_id'),       
                    'admin_status' => $this->input->post('admin_status'),            
                    'admin_join_date' => date('Y-m-d H:i:s')
                );
				
			//	$login_user_details = $this->session->userdata('user_details');
				//$data_to_store['admin'] = $login_user_details[0]['admin_login_name'];
				//$data_to_store['amin_id'] = $login_user_details[0]['admin_auto_id'];
				
                //if the insert has returned true then we show the flash message
                if($this->agent_model->store_agent($data_to_store)){
                    $data['flash_message'] = TRUE; 
					 $this->session->set_flashdata('flash_message', 'added');
	                redirect('admin/agent/');
					die;
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
		
        $data['agent_list'] 	= $this->agent_model->get_agent_details();
        //load the view
        $data['main_content'] = 'admin/agent/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //agent id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
			$this->form_validation->set_rules('admin_first_name', 'Agent Name', 'required');
            $this->form_validation->set_rules('admin_login_name', 'Login Name', 'required');
            $this->form_validation->set_rules('admin_password', 'password', 'required');
            $this->form_validation->set_rules('admin_email_id', 'email', 'required|email');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                    'admin_first_name' => $this->input->post('admin_first_name'),
                    'admin_login_name' => $this->input->post('admin_login_name'),
                    'admin_password' => $this->input->post('admin_password'),
                    'admin_email_id' => $this->input->post('admin_email_id'),          
                );
			//	$login_user_details = $this->session->userdata('user_details');
		//		$data_to_store['admin'] = $login_user_details[0]['admin_login_name'];
	//			$data_to_store['amin_id'] = $login_user_details[0]['admin_auto_id'];
//				
                //if the insert has returned true then we show the flash message
                if($this->agent_model->update_agent($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
	                redirect('admin/agent/');
					die;
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/agent/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //agent data 
        $data['agent'] = $this->agent_model->get_agent_by_id($id);
        //load the view
        $data['agent_list'] 	= $this->agent_model->get_agent_details();
        $data['main_content'] = 'admin/agent/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete agent by his id
    * @return void
    */
    public function delete()
    {
        //agent id 
        $id = $this->uri->segment(4);
        $this->agent_model->delete_agent($id);
        redirect('admin/agent');
    }//edit
	
	/**
    * Update agent status by id
    * @return void
    */
    public function updatestatus(){
        $id 	= $this->uri->segment(3);
        $status = $this->uri->segment(4);
		
       	$count_agent = $this->agent_model->count_agent(null, null, null,'1');

		if($count_agent>=4 && $status==1){
			$this->session->set_flashdata('flash_message', 'errors');
			redirect('admin/agent/');
			die;
		}
		$data_to_store = array(
			'status' => $status, 
			'updateDate' => date('Y-m-d H:i:s')
		);
		//if the insert has returned true then we show the flash message
		if($this->agent_model->update_agent($id, $data_to_store) == TRUE){
			$this->session->set_flashdata('flash_message', 'updated');
			redirect('admin/agent/');
			die;
		}
//		echo $id."---".$status;
	}
	
	public function username_check($str){
		if ($str != ''){
			if(sizeof($this->agent_model->username_check($str))==0){
				return TRUE;
			}else{
				$this->form_validation->set_message('username_check', '%s already exist.');
				return FALSE;
			}
		}else{
			return TRUE;
		}
	}
}