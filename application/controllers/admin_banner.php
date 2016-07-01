<?php
class Admin_banner extends CI_Controller {
 
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
		
        $this->load->model('banner_model');
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
           
            $data['count_banner']= $this->banner_model->count_banner($search_string, $order,null);
            $config['total_rows'] = $data['count_banner'];
            $data['banner'] = $this->banner_model->get_banner($search_string, $order, $order_type, $config['per_page'],$limit_end);        

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
            $data['count_banner']	= $this->banner_model->count_banner();
			
            $data['banner'] 			= $this->banner_model->get_banner('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] 	= $data['count_banner'];

        }//!isset($agencyId) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/banner/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add(){
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            //form validation
			$this->form_validation->set_rules('link', 'link', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run()){
                $data_to_store = array(
                    'link' => $this->input->post('link')
                );
				$error = array();
				if(isset($_FILES["banner"]['name']) && $_FILES["banner"]['name']!=''){
					
					$config['upload_path'] 		= APPPATH.'../assets/uploads/banner/';
					$config['allowed_types'] 	= 'gif|jpg|png';
					$config['max_size']			= '100000';
					$config['max_width']  		= '1920';
					$config['max_height']  		= '1024';
					$config['min_width']  		= '700';
					$config['min_height']  		= '300';
					$config['overwrite'] 		= TRUE;
					
					$new_name 	= time().$_FILES["banner"]['name'];
					$config['file_name'] = $new_name;
			
					$this->load->library('upload', $config);
			
					if ( ! $this->upload->do_upload('banner')){
						$error = array('error' => $this->upload->display_errors());
					}else{
						list($width, $height, $type, $attr) = getimagesize(APPPATH.'../assets/uploads/banner/'.$config['file_name']);
						if($width>800 && $height>400){
							$this->load->library('image_lib');
					
							$config['image_library'] = 'gd2';
							$config['source_image'] = APPPATH.'../assets/uploads/banner/'.$config['file_name'];
							$config['new_image'] 	= APPPATH.'../assets/uploads/banner/'.$config['file_name'];
							$config['x_axis'] = '0';
							$config['y_axis'] = '0';
							$config['maintain_ratio'] = FALSE;
							$config['width'] = 800;
							$config['height'] = 400;
							$this->image_lib->initialize($config); 
							if (!$this->image_lib->crop()){
								$error = array('error' => $this->image_lib->display_errors());
							}else{						
								$data_to_store['banner'] 	= $config['file_name'];	
							}
						}else{						
							$data_to_store['banner'] 	= $config['file_name'];	
						}
					}
				}
				$login_user_details = $this->session->userdata('user_details');
				$data_to_store['admin'] = $login_user_details[0]['admin_login_name'];
				$data_to_store['amin_id'] = $login_user_details[0]['admin_auto_id'];
				
                //if the insert has returned true then we show the flash message
                if(sizeof($error)==0 && $this->banner_model->store_banner($data_to_store)){
                    $data['flash_message'] = TRUE; 
					 $this->session->set_flashdata('flash_message', 'added');
	                redirect('admin/banner/');
					die;
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
		
        //load the view
        $data['main_content'] = 'admin/banner/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //banner id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
			$this->form_validation->set_rules('link', 'link', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                    'link' => $this->input->post('link')
                );
				
				if(isset($_FILES["banner"]['name']) && $_FILES["banner"]['name']!=''){
					
					$config['upload_path'] 		= APPPATH.'../assets/uploads/banner/';
					$config['allowed_types'] 	= 'gif|jpg|png';
//					$config['max_size']			= '100000';
					$config['max_width']  		= 1920;
					$config['max_height']  		= 1300;
					$config['min_width']  		= 700;
					$config['min_height']  		= 300;
					$config['overwrite'] 		= TRUE;
					
					$new_name 	= time().$_FILES["banner"]['name'];
					$config['file_name'] = $new_name;
					
					$img_size 	= getimagesize($_FILES["banner"]['tmp_name']);
//					$minimum 	= array('width' => '640', 'height' => '480');
	//				$width		= $img_size[0];
		//			$height 	= $img_size[1];
//			print_r($img_size);
					$this->load->library('upload', $config);
					if($img_size[0]>=700 && $img_size[1]>=300){
						if ( ! $this->upload->do_upload('banner')){
							$error = array('error' => $this->upload->display_errors());
						}else{
							list($width, $height, $type, $attr) = getimagesize(APPPATH.'../assets/uploads/banner/'.$config['file_name']);
							if($width>800 && $height>400){
								$this->load->library('image_lib');
						
								$config['image_library'] = 'gd2';
								$config['source_image'] = APPPATH.'../assets/uploads/banner/'.$config['file_name'];
								$config['new_image'] 	= APPPATH.'../assets/uploads/banner/'.$config['file_name'];
								$config['x_axis'] = '0';
								$config['y_axis'] = '0';
								$config['maintain_ratio'] = FALSE;
								$config['width'] = 800;
								$config['height'] = 400;
								$this->image_lib->initialize($config); 
								if (!$this->image_lib->crop()){
									$error = array('error' => $this->image_lib->display_errors());
								}else{						
									$data_to_store['banner'] 	= $config['file_name'];	
								}
							}else{						
								$data_to_store['banner'] 	= $config['file_name'];	
							}
						}
					}else{
						$error = array('error' => "Image must be greater than equal to 700 by 300.");	
					}
				}
				$login_user_details = $this->session->userdata('user_details');
				$data_to_store['admin'] = $login_user_details[0]['admin_login_name'];
				$data_to_store['amin_id'] = $login_user_details[0]['admin_auto_id'];
		//		print_r($error);
	//			die;
                //if the insert has returned true then we show the flash message
                if(sizeof($error)==0 && $this->banner_model->update_banner($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
	                redirect('admin/banner/');
					die;
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/banner/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //banner data 
        $data['banner'] = $this->banner_model->get_banner_by_id($id);
		
		
        //fetch agency data to populate the select field
	//	print_r($data['supervisor']);
//		echo $data['banner'][0]['supervisorId'];
        //load the view
        $data['main_content'] = 'admin/banner/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete banner by his id
    * @return void
    */
    public function delete()
    {
        //banner id 
        $id = $this->uri->segment(4);
        $this->banner_model->delete_banner($id);
        redirect('admin/banner');
    }//edit
	
	/**
    * Update banner status by id
    * @return void
    */
    public function updatestatus(){
        $id 	= $this->uri->segment(4);
        $status = $this->uri->segment(5);
		
		$data_to_store = array(
			'status' => $status
		);
		//if the insert has returned true then we show the flash message
		if($this->banner_model->update_banner($id, $data_to_store) == TRUE){
			$this->session->set_flashdata('flash_message', 'updated');
			redirect('admin/banner/');
			die;
		}
//		echo $id."---".$status;
	}
    public function orderset(){
		
		$post_data = $this->input->post();	
		$id = explode("_",$post_data['id']);
		$data_to_store = array(
			'order' => $post_data['orderset']
		);
		//print_r($id);
		//print_r($post_data);
		//if the insert has returned true then we show the flash message
		if($this->banner_model->update_banner($id[1], $data_to_store) == TRUE){
//			echo $this->db->last_query();
//			$this->session->set_flashdata('flash_message', 'updated');
			echo "{'done'}";
			die;
		}
		echo "{'not done'}";
//		echo $id."---".$status;
	}
}