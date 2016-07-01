<?php
class Admin_user extends CI_Controller {
 
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
		
        $this->load->model('users_model');
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
	
            if($order_type != false){
                $filter_session_data['order_type'] = $order_type;
            }else{
				if($page!=''){
                	$order_type = $this->session->userdata('order_type');
	                $filter_session_data['order_type'] = $order_type;
				}
            }
            $data['order_type'] = $order_type;
			
			
            if($orderfor != false){
                $filter_session_data['orderfor'] = $orderfor;
            }else{
				if($page!=''){
                	$orderfor = $this->session->userdata('orderfor');
	                $filter_session_data['orderfor'] = $orderfor;
				}
            }
            $data['orderfor'] = $orderfor;
			
            //save session data into the session
            $this->session->set_userdata($filter_session_data);
			
			
            //fetch agency data into arrays
           
            $data['count_user']= $this->users_model->count_user($orderfor, $search_string, $order,null, $from_date, $to_date);
            $config['total_rows'] = $data['count_user'];
            $data['user'] = $this->users_model->get_user($orderfor, $search_string, $order, $order_type, $from_date, $to_date, $config['per_page'],$limit_end);        

        }else{

            //clean filter data inside section
			
            $filter_session_data['search_string'] = '';
            $filter_session_data['from_date'] = '';
            $filter_session_data['to_date'] = '';
            $filter_session_data['order'] = '';
            $filter_session_data['order_type'] = '';
            $filter_session_data['orderfor'] = '';
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string'] = '';
            $data['from_date'] = '';
            $data['to_date'] = '';
            $data['order'] 		= '';
            $data['order_type'] = '';
            $data['orderfor'] = '';

            //fetch sql data into arrays
            $data['count_user']	= $this->users_model->count_user($orderfor);
			
            $data['user'] 			= $this->users_model->get_user($orderfor,'', '', $order_type,'','', $config['per_page'],$limit_end);        
            $config['total_rows'] 	= $data['count_user'];

        }//!isset($agencyId) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

		$options_offer_sort1 = array();
		if($orderfor=='status'){
			$options_offer_sort1['1'] = 'Active';
			$options_offer_sort1['0'] = 'Deactive';
		}
		if($orderfor=='signup'){			
			$options_offer_sort1['email'] 		= 'Email';
			$options_offer_sort1['facebook'] 	= 'Facebook';
			$options_offer_sort1['gplus'] 		= 'Google Plus';
			$options_offer_sort1['twitter'] 	= 'Twitter';
			$options_offer_sort1['linkedin'] 	= 'Linkedin';
		}
		$data['options_offer_sort1'] = $options_offer_sort1;
        //load the view
        $data['main_content'] = 'admin/user/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add(){
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
			$this->form_validation->set_rules('username', 'name', 'trim|required');
			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'password', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()){
                $data_to_store = array(
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password')
                );
				$login_user_details = $this->session->userdata('user_details');
				$data_to_store['admin'] = $login_user_details[0]['admin_login_name'];
				$data_to_store['amin_id'] = $login_user_details[0]['admin_auto_id'];
				
                //if the insert has returned true then we show the flash message
                if($this->users_model->store_user($data_to_store)){
                    $data['flash_message'] = TRUE; 
					 $this->session->set_flashdata('flash_message', 'added');
	                redirect('admin/user/');
					die;
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
		
        //load the view
        $data['main_content'] = 'admin/user/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //user id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
			$this->form_validation->set_rules('username', 'name', 'trim|required');
			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'password', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                    'username' => $this->input->post('username'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password')
                );
				$login_user_details = $this->session->userdata('user_details');
				$data_to_store['admin'] = $login_user_details[0]['admin_login_name'];
				$data_to_store['amin_id'] = $login_user_details[0]['admin_auto_id'];
				
                //if the insert has returned true then we show the flash message
                if($this->users_model->update_user($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
	                redirect('admin/user/');
					die;
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/user/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //user data 
        $data['user'] = $this->users_model->get_user_by_id($id);
		
        //fetch agency data to populate the select field
	//	print_r($data['supervisor']);
//		echo $data['user'][0]['supervisorId'];
        //load the view
        $data['main_content'] = 'admin/user/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete user by his id
    * @return void
    */
    public function delete()
    {
        //user id 
        $id = $this->uri->segment(4);
        $this->users_model->delete_user($id);
        redirect('admin/user');
    }//edit
	
	/**
    * Update user status by id
    * @return void
    */
    public function updatestatus(){
        $id 	= $this->uri->segment(4);
        $status = $this->uri->segment(5);
		
		$data_to_store = array(
			'status' => $status
		);
		//if the insert has returned true then we show the flash message
		if($this->users_model->update_user($id, $data_to_store) == TRUE){
			$this->session->set_flashdata('flash_message', 'updated');
			redirect('admin/user/');
			die;
		}
//		echo $id."---".$status;
	}
	function getuseroption(){
		$post_data = $this->input->post();	
		if($post_data['str']=='earnedamount'){
			echo "";
		}
		if($post_data['str']=='status'){			
			echo "<option value='1'>Active</option>";
			echo "<option value='0'>Deactive</option>";
		}
		if($post_data['str']=='signup'){			
			echo "<option value='email'>Email</option>";
			echo "<option value='facebook'>Facebook</option>";
			echo "<option value='gplus'>Google Plus</option>";
			echo "<option value='twitter'>Twitter</option>";
			echo "<option value='linkedin'>Linkedin</option>";
		}
	}
}