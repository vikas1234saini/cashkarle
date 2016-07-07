<?php
class Admin_newsletter extends CI_Controller {
 
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
		
        $this->load->model('newsletter_model');
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
			
            //save session data into the session
            $this->session->set_userdata($filter_session_data);

            //fetch agency data into arrays
           
            $data['count_newsletter']= $this->newsletter_model->count_newsletter($search_string, $order,null, $from_date, $to_date);
            $config['total_rows'] = $data['count_newsletter'];
            $data['newsletter'] = $this->newsletter_model->get_newsletter($search_string, $order, $order_type, $from_date, $to_date, $config['per_page'],$limit_end);        

        }else{

            //clean filter data inside section
			
            $filter_session_data['search_string'] = '';
            $filter_session_data['order'] = '';
            $filter_session_data['order_type'] = '';
            $filter_session_data['from_date'] = '';
            $filter_session_data['to_date'] = '';
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string'] = '';
            $data['order'] 		= 'id';
            $data['order_type'] = '';
            $data['from_date'] = '';
            $data['to_date'] = '';

            //fetch sql data into arrays
            $data['count_newsletter']	= $this->newsletter_model->count_newsletter();
			
            $data['newsletter'] 			= $this->newsletter_model->get_newsletter('', '', $order_type, $from_date, $to_date, $config['per_page'],$limit_end);        
            $config['total_rows'] 	= $data['count_newsletter'];

        }//!isset($agencyId) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/newsletter/list';
        $this->load->view('includes/template', $data);  

    }//index

/*    public function add(){
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
			$this->form_validation->set_rules('title', 'title', 'required');
			$this->form_validation->set_rules('description', 'description', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()){
                $data_to_store = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description')
                );
                //if the insert has returned true then we show the flash message
                if($this->newsletter_model->store_newsletter($data_to_store)){
                    $data['flash_message'] = TRUE; 
					 $this->session->set_flashdata('flash_message', 'added');
					 $this->load->library('email');
					$this->email->set_mailtype('html');
					$this->email->from('admin@cashkarle.com', 'cashkarle');
					
			        $this->load->model('fuser_model');
					$user_list = $this->fuser_model->get_all_user();
					for($i=0;$i<sizeof($user_list);$i++){
						if($i==0){
							$this->email->to($user_list[$i]['email']); 
						}else{
							$this->email->bcc($user_list[$i]['email']); 
						}
					}
					//$this->email->cc('vikas1234saini@gmail.com');  
					$this->email->set_mailtype('html');
					
					$this->email->subject($this->input->post('title'));
					$this->email->message($this->input->post('description'));	
					
					if($this->email->send()){						
						redirect('admin/newsletter/');
						die;
					}else{
	                    $data['flash_message'] = FALSE; 
	//					$arr = array('status' => 0,'error'=>'There is some issue in recover password. Please contact cashkale team.');
					}
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
		
        //load the view
        $data['main_content'] = 'admin/newsletter/add';
        $this->load->view('includes/template', $data);  
    }       
*/

	function editor($path,$width) {
		//Loading Library For Ckeditor
		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		
		//configure base path of ckeditor folder 
		$this->ckeditor->basePath = base_url().'assets/js/ckeditor/';
		$this->ckeditor-> config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor-> config['width'] = $width;
		
		//configure ckfinder with ckeditor config 
		$this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
	}	

    public function add($for='all'){
		
		$path = '../js/ckfinder';
		$width = '850px';
		$this->editor($path, $width);
//echo $this->input->server('REQUEST_METHOD');
//die;
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            //form validation
			$this->form_validation->set_rules('title', 'title', 'required');
			$this->form_validation->set_rules('description', 'description', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()){
				if($this->input->post('userlist')!=false){
					$email_list = $this->input->post('userlist');
				}else{
					$email_list = array();
				}
				if(sizeof($email_list)>0){
					$data_to_store = array(
						'title' => $this->input->post('title'),
						'description' => $this->input->post('description'),
						'userlist' => implode(",",$email_list),
						'date' => date('Y-m-d H:i:s')
					);
					$login_user_details = $this->session->userdata('user_details');
					$data_to_store['admin'] = $login_user_details[0]['admin_login_name'];
					$data_to_store['amin_id'] = $login_user_details[0]['admin_auto_id'];
				
                	//if the insert has returned true then we show the flash message
					if($this->newsletter_model->store_newsletter($data_to_store)){
						$config = array('mailtype' => 'html');
						$this->load->library('email',$config);
	
						$this->email->from('info@cashkale.com', 'cashkale');
						$this->email->to($email_list[0]); 
						for($i=1;$i<sizeof($email_list);$i++){						
							$this->email->bcc($email_list[$i]); 
						}
						
						$this->email->subject($this->input->post('title'));
						$this->email->message($this->input->post('description'));	
						$this->email->send();
						//echo $this->email->print_debugger();
						$data['flash_message'] = TRUE; 
						$this->session->set_flashdata('flash_message', 'added');
		                redirect('admin/newsletter/');
						die;
					}else{
						$data['flash_message'] = FALSE; 
					}
				}
            }

        }
//        $this->load->model('news_model');
		$data['user_list'] = $this->newsletter_model->get_all_user($for);
		$data['for'] = $for;
//		print_r($user_list);
        //load the view
        $data['main_content'] = 'admin/newsletter/add';
        $this->load->view('includes/template', $data);  
    }       
    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //newsletter id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
			$this->form_validation->set_rules('title', 'title', 'required');
			$this->form_validation->set_rules('description', 'description', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description')
                );
				$login_user_details = $this->session->userdata('user_details');
				$data_to_store['admin'] = $login_user_details[0]['admin_login_name'];
				$data_to_store['amin_id'] = $login_user_details[0]['admin_auto_id'];
				
                //if the insert has returned true then we show the flash message
                if($this->newsletter_model->update_newsletter($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
	                redirect('admin/newsletter/');
					die;
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/newsletter/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //newsletter data 
        $data['newsletter'] = $this->newsletter_model->get_newsletter_by_id($id);
		
        //fetch agency data to populate the select field
	//	print_r($data['supervisor']);
//		echo $data['newsletter'][0]['supervisorId'];
        //load the view
        $data['main_content'] = 'admin/newsletter/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete newsletter by his id
    * @return void
    */
    public function delete()
    {
        //newsletter id 
        $id = $this->uri->segment(4);
        $this->newsletter_model->delete_newsletter($id);
        redirect('admin/newsletter');
    }//edit
	
	/**
    * Update newsletter status by id
    * @return void
    */
    public function updatestatus(){
        $id 	= $this->uri->segment(4);
        $status = $this->uri->segment(5);
		
		$data_to_store = array(
			'status' => $status
		);
		//if the insert has returned true then we show the flash message
		if($this->newsletter_model->update_newsletter($id, $data_to_store) == TRUE){
			$this->session->set_flashdata('flash_message', 'updated');
			redirect('admin/newsletter/');
			die;
		}
//		echo $id."---".$status;
	}
}