<?php
class Admin_discount extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct() {
        parent::__construct();
		
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }		
        $this->load->model('category_model');
    }
 
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
        $data['order'] = $this->category_model->get_order_by_id($id);
		
        //fetch agency data to populate the select field
	//	print_r($data['supervisor']);
//		echo $data['order'][0]['supervisorId'];
        //load the view
        $data['main_content'] = 'admin/order/edit';
        $this->load->view('includes/template', $data);
    }//update
}