<?php
class Admin_offer extends CI_Controller {
 
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
		
        $this->load->model('offer_model');
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index(){

        //all the posts sent by the view
        $search_string 	= $this->input->post('search_string');        
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

        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 
		if($search_string !== false || $order !== false || $page != ''){
            $filter_session_data['page'] = $page;
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
			
            //save session data into the session
            $this->session->set_userdata($filter_session_data);

            //fetch agency data into arrays
           
            $data['count_offer']= $this->offer_model->count_offer($orderfor,$search_string, $order,null);
            $config['total_rows'] = $data['count_offer'];
            $data['offer'] = $this->offer_model->get_offer($search_string, $order, $order_type, $config['per_page'],$limit_end,$orderfor);        

        }else{

            //clean filter data inside section
            $filter_session_data['page'] = '';
            $filter_session_data['search_string'] = '';
            $filter_session_data['order'] = '';
            $filter_session_data['orderfor'] = '';
            $filter_session_data['order_type'] = 'desc';
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string'] 	= '';
            $data['order'] 			= '';
            $data['orderfor'] 		= '';
            $data['order_type'] 	= 'desc';

            //fetch sql data into arrays
            $data['count_offer']	= $this->offer_model->count_offer($orderfor);
			
            $data['offer'] 			= $this->offer_model->get_offer('', '', 'desc', $config['per_page'],$limit_end,$orderfor);        
            $config['total_rows'] 	= $data['count_offer'];

        }//!isset($agencyId) && !isset($search_string) && !isset($order)
//		$data['options_offer_sort1'] = array();
		$options_offer_sort1 = array();
	//	if($orderfor=='offerby'){
			$allofferby = $this->offer_model->get_just_all_offer();	
			
			$find = array("CPRC", "CPA","CPS","CPL"," - India"," - UAE"," - Qatar");
			$replace = array("","","","","");
			$inarray = array();
			foreach($allofferby as $key=>$value){
				$strinval = str_replace($find,$replace,$value['title']);
				if(!in_array($strinval,$inarray)){
					$options_offer_sort1[$strinval]= $strinval;
					$inarray[] = $strinval; 
				}
			}
		//}
		if($orderfor=='username'){
	        $this->load->model('agent_model');
			$allofferby = $this->agent_model->get_all_agent();	
			
			$inarray = array();
			foreach($allofferby as $key=>$value){
				$strinval = $value['admin_login_name'];
				if(!in_array($strinval,$inarray)){
					$options_offer_sort1[$strinval]= $strinval;
					$inarray[] = $strinval; 
				}
			}
		}
		if($orderfor=='status'){
			
			$options_offer_sort1 = array();
			$options_offer_sort1['1'] = 'Active';
			$options_offer_sort1['0'] = 'Deactive';
		}
		if($orderfor=='payouttype'){			
		
			$inarray = array();
			$options_offer_sort1['cpa_percentage'] 	= 'cpa_percentage';
			$options_offer_sort1['cpa_flat'] 		= 'cpa_flat';
		}
		$data['options_offer_sort1'] = $options_offer_sort1;
		
        //initializate the panination helper 
        $this->pagination->initialize($config);   
		
        //load the view
        $data['main_content'] = 'admin/offer/list';
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
                    'discount_type' => $this->input->post('discount_type'),
                    'image' => $this->input->post('image'),
                    'url' => $this->input->post('url'),
                    'percent_payout' => $this->input->post('percent_payout'),
                    'payout_type' => $this->input->post('payout_type'),
                    'default_payout' => $this->input->post('default_payout'),
                    'sitename' => 'hasoffer'
                );
				$login_user_details = $this->session->userdata('user_details');
				$data_to_store['admin'] = $login_user_details[0]['admin_login_name'];
				$data_to_store['amin_id'] = $login_user_details[0]['admin_auto_id'];
				
                //if the insert has returned true then we show the flash message
                if($this->offer_model->store_offer($data_to_store)){
                    $data['flash_message'] = TRUE; 
					 $this->session->set_flashdata('flash_message', 'added');
	                if($this->input->post('pageno')!=''){
	                	redirect('admin/offer/'.$this->input->post('pageno'));
					}else{
	                	redirect('admin/offer/');
					}
					die;
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
		
        //load the view
        $data['main_content'] = 'admin/offer/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //offer id 
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
                    'discount_type' => $this->input->post('discount_type'),
                    'image' => $this->input->post('image'),
                    'url' => $this->input->post('url')
                );
				$login_user_details = $this->session->userdata('user_details');
				$data_to_store['admin'] = $login_user_details[0]['admin_login_name'];
				$data_to_store['amin_id'] = $login_user_details[0]['admin_auto_id'];
				
                //if the insert has returned true then we show the flash message
                if($this->offer_model->update_offer($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					if($this->input->post('pageno')!=''){
	                	redirect('admin/offer/'.$this->input->post('pageno'));
					}else{
	                	redirect('admin/offer/');
					}
					die;
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/offer/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //offer data 
        $data['offer'] = $this->offer_model->get_offer_by_id($id);
		
		
        //fetch agency data to populate the select field
	//	print_r($data['supervisor']);
//		echo $data['offer'][0]['supervisorId'];
        //load the view
        $data['main_content'] = 'admin/offer/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete offer by his id
    * @return void
    */
    public function delete()
    {
        //offer id 
        $id = $this->uri->segment(4);
        $this->offer_model->delete_offer($id);
        redirect('admin/offer');
    }//edit
	
	/**
    * Update offer status by id
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
		if($this->offer_model->update_offer($id, $data_to_store) == TRUE){
			$this->session->set_flashdata('flash_message', 'updated');
			redirect('admin/offer/');
			die;
		}
//		echo $id."---".$status;
	}
	function getofferorder(){
		$post_data = $this->input->post();	
		if($post_data['str']=='offerby'){
			$allofferby = $this->offer_model->get_just_all_offer();	
			
			$find = array("CPRC", "CPA","CPS","CPL"," - India"," - UAE"," - Qatar");
			$replace = array("","","","","");
			$inarray = array();
			foreach($allofferby as $key=>$value){
				$strinval = str_replace($find,$replace,$value['title']);
				if(!in_array($strinval,$inarray)){
					echo "<option value='".$strinval."'>".$strinval."</option>";
					$inarray[] = $strinval; 
				}
			}
		}
		if($post_data['str']=='username'){
	        $this->load->model('agent_model');
			$allofferby = $this->agent_model->get_all_agent();	
			
			$inarray = array();
			foreach($allofferby as $key=>$value){
				$strinval = $value['admin_login_name'];
				if(!in_array($strinval,$inarray)){
					echo "<option value='".$strinval."'>".$strinval."</option>";
					$inarray[] = $strinval; 
				}
			}
		}
		if($post_data['str']=='status'){			
			echo "<option value='1'>Active</option>";
			echo "<option value='0'>Deactive</option>";
		}
		if($post_data['str']=='payouttype'){			
			echo "<option value='cpa_percentage'>cpa_percentage</option>";
			echo "<option value='cpa_flat'>cpa_flat</option>";
		}
	}
}