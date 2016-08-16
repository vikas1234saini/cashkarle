<?php
class Fuser extends CI_Controller {
	
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();

    }
    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	
	function index()
	{
	}

    /**
    * encript the password 
    * @return mixed
    */	
    function __encrip_password($password) {
        return md5($password);
    }	

    /**
    * check the username and the password with the database
    * @return void
    */
	function validate_credentials() {

		if($this->input->is_ajax_request()) {
			$this->load->model('fuser_model');
	
			$user_name = $this->input->post('login_email');
			$password = $this->input->post('login_password');
	
			$is_valid = $this->fuser_model->validate($user_name, $password);
			
			$post_data = $this->input->post();
			
			if($is_valid){
				$data = array(
					'fuser_name' => $user_name,
					'fuser_details' => $is_valid,
					'fis_logged_in' => true
				);
				$this->session->set_userdata($data);
				
				$data['status']  	= '1';	
				$data['post_data'] 	= $post_data;
				echo json_encode($data);
				die;	
			} else {
				$data['status']  	= '0';	
				$data['error'] 	= "Username and password not matched.";
				$data['post_data'] 	= $post_data;
				echo json_encode($data);
				die;	
			}
		}
	}
	
    /**
    * Create new user and store it in the database
    * @return void
    */	
	function create_member() {
		
		if($this->input->is_ajax_request()) {
			$this->load->library('form_validation');
			$post_data = $this->input->post();
			// field name, error message, validation rules
			$this->form_validation->set_rules('username', 'Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
			$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
			$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			
			if($this->form_validation->run() == FALSE){
				$data['status']  	= '0';	
				$data['error'] 		= validation_errors();
				$data['post_data'] 	= $post_data;
				echo json_encode($data);
				die;
			}else{			
				$this->load->model('fuser_model');
				
				if($query = $this->fuser_model->create_member()){
					$is_valid = $this->fuser_model->validate($this->input->post('email'), $this->input->post('password'));
//					echo $this->input->post('username');
	//				echo $this->input->post('password');
					
					$data_new = array(
						'fuser_name' => $this->input->post('username'),
						'fuser_details' => $is_valid,
						'fis_logged_in' => true
					);
					$this->session->set_userdata($data_new);
					
					$data['status']  = '1';	
					$data['error']	 = 'User created successful.';
							
					$subject = 'Hey '.$this->input->post('username').', CashKarle Welcomes you.';
					$html = "<div style='font-family: \"Bodoni MT\", Didot, \"Didot LT STD\", \"Hoefler Text\", Garamond, \"Times New Roman\", serif; font-size:20px;'><i><div style='width:100%; text-align:center;'><img src='". base_url()."assets/img/plogo.png' width='200'  alt='CashKarle.com' align='center' /></div>";
					$html .= "Hey ".$this->input->post('username').",<br /><br />";
					$html .= "Congratulations! Now you are the part of Biggest Saving Community. <br/>Come on our website whenever you want to shop anything from Snapdeal,Flipkart Paytm and Many more.we will give you Coupons, Cashbacks and rewards points for your shopping.<br/><br/>";
					$html .= "<a href='".base_url()."' style='text-decoration:none;' ><div style='width:200px; color:#fff; text-align:center; height:30px;line-height:30px; background: #449d44;    font-size: 16px;    font-weight: bold;    padding: 5px;'>Sign in to your account</div></a><br /><br />";
					$html .= "<strong>Regards,<br />CashKarle.com<br />Enjoy Savings</strong></i></div>";
					//$this->email->message($html);	
						
					// Always set content-type when sending HTML email
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					
					// More headers
					$headers .= 'From: Cashkarle <info@cashkarle.com>' . "\r\n";
			//		$headers .= 'Cc: myboss@example.com' . "\r\n";
					$to = $this->input->post('email');
					if(mail($to,$subject,$html,$headers)){
						$arr = array('status' => 1);
					}else{
						$arr = array('status' => 0,'error'=>'There is some issue in recover password. Please contact cashkale team.');
					}
					echo json_encode($data);
					die;
				}else {							
					$data['status']  = '0';	
					$data['error']	 = '<div class="alert alert-error error"><a class="close" data-dismiss="alert">×</a><strong> Email already exist</strong></div>';
					echo json_encode($data);
					die;	
				}
			}
		}else{
			redirect('404');
		}
	}
	
	/**
    * Destroy the session, and logout the user.
    * @return void
    */		
	function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}
	
	public function forgot_password() {
		
		if($this->input->is_ajax_request()) {
			$this->load->helper('url');
			$data = array();
			
			$this->load->model ('fuser_model','user');
			$post_data = $this->input->post();
			
			$password_data = $this->user->get_password($post_data['forgotemail']);
		//	print_r($password_data);
			if(sizeof($password_data)==0){
				$arr = array('success' => 0,'error'=>'Email not registered.');					
				echo json_encode( $arr );
				die;
			}
			/*$this->load->library('email');
			$this->email->set_mailtype('html');
			$this->email->from('info@cashkarle.com', 'cashkarle');
			$this->email->to($post_data['forgotemail']); 
			//$this->email->cc('vikas1234saini@gmail.com');  
			$this->email->set_mailtype('html');
			
			$this->email->subject();*/
			$subject = 'Hey '.$password_data[0]->username.',Your CashKarle account password';
			$html = "<div style='font-family: \"Bodoni MT\", Didot, \"Didot LT STD\", \"Hoefler Text\", Garamond, \"Times New Roman\", serif; font-size:20px;'><i><div style='width:100%; text-align:center; '><img src='". base_url()."assets/img/plogo.png' width='200'  alt='CashKarle.com' align='center' /></div>";
			$html .= "Hey ".$password_data[0]->username.",<br /><br />";
			$html .= "Your CashKarle account password is:   ".$password_data[0]->password."<br /><br />";
			$html .= "<a href='".base_url()."'>Click here</a> to sign in to your CashKarle.com account with your existing password.<br /><br />";
			$html .= "If you have any Concern  <a href='".base_url('contact')."'>Click Here</a> to contact our support team.<br /><br />";
			$html .= "<strong>Regards,<br />CashKarle.com<br />Enjoy Savings</strong></i></div>";
			//$this->email->message($html);	
				
			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			
			// More headers
			$headers .= 'From: Cashkarle <info@cashkarle.com>' . "\r\n";
	//		$headers .= 'Cc: myboss@example.com' . "\r\n";
			$to = $post_data['forgotemail'];
			if(mail($to,$subject,$html,$headers)){
				$arr = array('status' => 1);
			}else{
				$arr = array('status' => 0,'error'=>'There is some issue in recover password. Please contact cashkale team.');
			}
			echo json_encode( $arr );
			die;
		}else{
			redirect('404');
		}
	}
	function facebook(){
		if($this->input->is_ajax_request()) {
			$this->load->helper('url');
			$this->load->model('fuser_model');
	
			$post_data = $this->input->post();
			
			$email 	= $post_data['email'];
			$fid  	= $post_data['id'];
			$name  	= $post_data['name'];
			
			$is_valid = $this->fuser_model->facebook_validate($email, $fid, $name);
			
			if($is_valid){
				$data = array(
					'fuser_name' => $email,
					'fuser_details' => $is_valid,
					'fis_logged_in' => true,
					'social_login' => true
				);
				$this->session->set_userdata($data);
				
				$data['status']  	= '1';	
				$data['post_data'] 	= $post_data;
				echo json_encode($data);
				die;	
			} else {
				$data['status']  	= '0';	
				$data['error'] 	= "Username and password not matched.";
				$data['post_data'] 	= $post_data;
				echo json_encode($data);
				die;	
			}
		}
	}
	function googleplus(){
		if($this->input->is_ajax_request()) {
			$this->load->helper('url');
			$this->load->model('fuser_model');
	
			$post_data = $this->input->post();
			
			$email 	= $post_data['email'];
			$fid  	= $post_data['id'];
			$name  	= $post_data['name'];
			
			$is_valid = $this->fuser_model->googleplus_validate($email, $fid, $name);
			
			if($is_valid){
				$data = array(
					'fuser_name' => $email,
					'fuser_details' => $is_valid,
					'fis_logged_in' => true,
					'social_login' => true
				);
				$this->session->set_userdata($data);
				
				$data['status']  	= '1';	
				$data['post_data'] 	= $post_data;
				echo json_encode($data);
				die;	
			} else {
				$data['status']  	= '0';	
				$data['error'] 	= "Username and password not matched.";
				$data['post_data'] 	= $post_data;
				echo json_encode($data);
				die;	
			}
		}
	}
	function linkedin(){
		if($this->input->is_ajax_request()) {
			$this->load->helper('url');
			$this->load->model('fuser_model');
	
			$post_data = $this->input->post();
			
			$email 	= $post_data['email'];
			$fid  	= $post_data['id'];
			$name  	= $post_data['name'];
			
			$is_valid = $this->fuser_model->linkedin_validate($email, $fid, $name);
			
			if($is_valid){
				$data = array(
					'fuser_name' => $email,
					'fuser_details' => $is_valid,
					'fis_logged_in' => true,
					'social_login' => true
				);
				$this->session->set_userdata($data);
				
				$data['status']  	= '1';	
				$data['post_data'] 	= $post_data;
				echo json_encode($data);
				die;	
			} else {
				$data['status']  	= '0';	
				$data['error'] 	= "Username and password not matched.";
				$data['post_data'] 	= $post_data;
				echo json_encode($data);
				die;	
			}
		}
	}
	function twitter(){
		if($this->input->is_ajax_request()) {
			$this->load->helper('url');
			$this->load->model('fuser_model');
	
			$post_data = $this->input->post();
			
			$email 	= $post_data['email'];
			$fid  	= $post_data['id'];
			$name  	= $post_data['name'];
			
			$is_valid = $this->fuser_model->twitter_validate($email, $fid, $name);
			
			if($is_valid){
				$data = array(
					'fuser_name' => $email,
					'fuser_details' => $is_valid,
					'fis_logged_in' => true,
					'social_login' => true
				);
				$this->session->set_userdata($data);
				
				$data['status']  	= '1';	
				$data['post_data'] 	= $post_data;
				echo json_encode($data);
				die;	
			} else {
				$data['status']  	= '0';	
				$data['error'] 	= "Username and password not matched.";
				$data['post_data'] 	= $post_data;
				echo json_encode($data);
				die;	
			}
		}
	}
	
	public function get_twitter_login_url()
	{
		//echo require_once APPPATH ;
		
		require_once FCPATH.APPPATH . 'libraries/twitter/twitteroauth.php';
		//$this->load->library('twitteroauth');
		//die;
		$twitteroauth = new TwitterOAuth(TWITTER_KEY, TWITTER_SECRET);

		// Requesting authentication tokens, the parameter is the URL we will be redirected to
		$request_token = $twitteroauth->getRequestToken(TWITTER_REDIRECT);
		$this->session->set_userdata( 'twitter', array(
			'oauth_token'			=> $request_token['oauth_token'],
			'oauth_token_secret'	=> $request_token['oauth_token_secret']
		) );

		// If everything goes well..
		if ($twitteroauth->http_code == 200){
			// Generate the URL
			$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
			redirect($url);
		}else{
			$data = array(
				'status'	=> 'error',
				'message'	=> 'There seems to be error while trying to access twitter!'
			);
		}

		echo json_encode($data);
		exit();
	}
	public function twitterlogin(){
		if(isset($_GET['denied']) ){
			redirect(base_url());
		}
		require_once FCPATH.APPPATH . 'libraries/twitter/twitteroauth.php';
		
    	$twitterSession = $this->session->userdata('twitter');
		
		$twitteroauth = new TwitterOAuth(TWITTER_KEY, TWITTER_SECRET,$twitterSession['oauth_token'], $twitterSession['oauth_token_secret']);

		// Request the access token
		$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
		
		// Let's get the user's info
		$user_info = $twitteroauth->get('https://api.twitter.com/1.1/account/verify_credentials.json');
		{//preparing for save
			$name = explode(" ", $user_info->name);
			$data["twitter_id"] 	= $user_info->id;
			$data["twitter_token"] =  $access_token['oauth_token'];
			$data["twitter_token_secret"] =  $access_token['oauth_token_secret'];
			$data1["twitter_token"] =  $access_token['oauth_token'];
			$data1["twitter_token_secret"] =  $access_token['oauth_token_secret'];
			
//			print_r($user_info);
		}
		$this->load->model('fuser_model');		
		$is_valid = $this->fuser_model->twitter_validate('', $user_info->id, $user_info->name);

		if($is_valid){
			$data = array(
				'fuser_name' => $user_info->name,
				'fuser_details' => $is_valid,
				'fis_logged_in' => true,
				'social_login' => true
			);
			$this->session->set_userdata($data);
			
		}
		redirect(base_url());
		
	}
	public function linkdincancel(){
		redirect(base_url());
		die;
	}
	public function profile() {
		/*if ($this->session->userdata('fis_logged_in') == FALSE) {
			redirect(base_url());
			die;
		}else{
			if($this->input->server('REQUEST_METHOD')=="POST"){
				$merchantTransactionId = rand(1000000,9999999);
				$user_details 	= $this->session->userdata('fuser_details');				
				$hash_string 	= "9aAO5oZM|".$user_details[0]['mobile']."|".$user_details[0]['email']."|".$this->input->post('amount')."|".$merchantTransactionId."|Co5Z6jFrib";
//				echo $hash_string."<br />";
			    $hash = strtolower(hash('sha512', $hash_string));
			//	echo $hash."<br />";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "https://test.payumoney.com/auth/ext/cashbackVault/requestPMPoints");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, "email=".$user_details[0]['email']."&mobile=".$user_details[0]['mobile']."&hash=".$hash."&amount=".$this->input->post('amount')."&key=9aAO5oZM&merchantTransactionId=".$merchantTransactionId);
		//		echo "email=".$user_details[0]['email']."&mobile=".$user_details[0]['mobile']."&hash=".$hash."&amount=".$this->input->post('amount')."&key=9aAO5oZM&merchantTransactionId=".$merchantTransactionId;
				$result = json_decode(curl_exec($ch));
				
//				print_r($result);
				if(!$result->status){
					$data['message'] = $result->message;
				}
				curl_close($ch);
				//die;
			}
			$this->load->model('category_model');
			$this->load->model('product_model');
			$this->load->model('offer_model');
			$this->load->model('order_model');
			$this->load->model('brand_model');
			
			$data['list'] 			= $this->category_model->get_all_parent_category();
			$data['listnew'] 		= $this->category_model->get_all_main_category();
			$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
			$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
			$data['user_details']	= $this->session->userdata('fuser_details');
			$data['orderlist'] 		= $this->order_model->get_all_order();
			$data['menuopen']	= "myaccount";
//			print_r($data['orderlist']);

			$this->load->helper('data');
			$data['topuser'] = topuser();			
			
			//load the view
    	    $data['main_content'] = 'front/profile';
	        $this->load->view('includes/front_template', $data);
		}*/
		if ($this->session->userdata('fis_logged_in') == FALSE) {
			redirect(base_url());
			die;
		}else{
				
			$this->load->model('category_model');
			$this->load->model('product_model');
			$this->load->model('offer_model');
			$this->load->model('order_model');
			$this->load->model('brand_model');
			
			$data['list'] 			= $this->category_model->get_all_parent_category();
			$data['listnew'] 		= $this->category_model->get_all_main_category();
			$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
			$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
			$data['user_details']	= $this->session->userdata('fuser_details');
			$data['orderlist'] 		= $this->order_model->get_all_order();
			$data['menuopen']	= "myaccount";
			$this->load->helper('data');
			$data['topuser'] = topuser();
		
			//load the view
    	    $data['main_content'] = 'front/profile';
	        $this->load->view('includes/front_template', $data);
		}
	}
	public function change_password() {	
		if ($this->session->userdata('fis_logged_in') == FALSE) {
			redirect(base_url());
			die;
		}else{
			$this->load->model('category_model');
			$this->load->model('product_model');
			$this->load->model('offer_model');
			$this->load->model('order_model');
			$this->load->model('brand_model');
			
			$data['list'] 			= $this->category_model->get_all_parent_category();
			$data['listnew'] 		= $this->category_model->get_all_main_category();
			$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
			$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
			$data['user_details']	= $this->session->userdata('fuser_details');
			$data['orderlist'] 		= $this->order_model->get_all_order();
			$data['menuopen']		= "myaccount";

			$this->load->helper('data');
			$data['topuser'] = topuser();			
			
			//load the view
    	    $data['main_content'] = 'front/change_password';
	        $this->load->view('includes/front_template', $data);
		}
	}
	public function change_password_post(){
		$post_data = $this->input->post();	
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('txtOldPassword', 'Old Password', 'trim|required|callback_password_check');
		$this->form_validation->set_rules('txtNewPassword', 'New Password', 'trim|required|matches[txtConfirmPassword]');
		$this->form_validation->set_rules('txtConfirmPassword', 'Confirm New Password', 'trim|required');

		
		$this->load->model('fuser_model');
		if ($this->form_validation->run() == FALSE){
			$data['success'] 	= '2';
			$data['data'] 		= $post_data;
			$data['error'] 		= validation_errors();
		}else{
			$user_details = $this->session->userdata('fuser_details');
			$post_data_new = array();
			$post_data_new['password'] = $post_data['txtNewPassword'];
			
			if($this->fuser_model->update($post_data_new,$user_details[0]['id'])){
				$data['success'] 	= '1';
				$data['data'] 		= $post_data;
			}else{
				$data['success'] = '1';
				$data['error'] = "Not able to change password.";
				$data['data'] = $post_data;
			}
		}
		echo json_encode($data);
		die;
	
	}
	
	public function password_check($str){
		if ($str != ''){			
			$user_details = $this->session->userdata('fuser_details');
			$this->load->model('fuser_model');
			if($this->fuser_model->check_password($user_details[0]['id'],$str)){
				return TRUE;
			}else{
				$this->form_validation->set_message('password_check', '%s not correct.');
				return FALSE;
			}
		}else{
			return TRUE;
		}
	}
	public function edit_profile(){
		if ($this->session->userdata('fis_logged_in') == FALSE) {
			redirect(base_url());
			die;
		}else{
				
			$this->load->model('category_model');
			$this->load->model('product_model');
			$this->load->model('offer_model');
			$this->load->model('order_model');
			$this->load->model('brand_model');
			
			$data['list'] 			= $this->category_model->get_all_parent_category();
			$data['listnew'] 		= $this->category_model->get_all_main_category();
			$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
			$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
			$data['user_details']	= $this->session->userdata('fuser_details');
			$data['orderlist'] 		= $this->order_model->get_all_order();
			$data['menuopen']	= "myaccount";
			$this->load->helper('data');
			$data['topuser'] = topuser();
		
			//load the view
    	    $data['main_content'] = 'front/edit_profile';
	        $this->load->view('includes/front_template', $data);
		}	
		
	}
	public function update_post(){
		$post_data = $this->input->post();	
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'name', 'trim|required');
		$this->form_validation->set_rules('mobile', 'mobile', 'trim|required]');

		$this->load->model('fuser_model');
		if ($this->form_validation->run() == FALSE){
			$data['success'] 	= '2';
			$data['data'] 		= $post_data;
			$data['error'] 		= validation_errors();
		}else{
			
			$user_details = $this->session->userdata('fuser_details');
			$post_data_new = array();
			
			
			$post_data_new['username'] 	= $post_data['username'];
			$post_data_new['mobile'] 	= $post_data['mobile'];
			//$post_data_new['payment_option'] 	= $post_data['payment_option'];
			
			if($this->fuser_model->update($post_data_new,$user_details[0]['id'])){
				$user_data = $this->fuser_model->get_user_by_id($user_details[0]['id']);
				$data['success'] 	= '1';
				$data['data'] 		= $post_data;
				$data_new = array(
					'fuser_name' => $user_data[0]['username'],
					'fuser_details' => $user_data,
					'fis_logged_in' => true,
					'social_login' => false
				);
				$this->session->set_userdata($data_new);
			}else{
				$data['success'] = '2';
				$data['error'] = "Not able to update profile.";
				$data['data'] = $post_data;
			}
		}
		echo json_encode($data);
		die;
	
	}
	
	public function update_account(){
		$post_data = $this->input->post();	
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('password', 'password', 'trim|required|callback_password_check');

		$this->load->model('fuser_model');
		if ($this->form_validation->run() == FALSE){
			$data['success'] 	= '2';
			$data['data'] 		= $post_data;
			$data['error'] 		= validation_errors();
		}else{
			
			$user_details = $this->session->userdata('fuser_details');
			$post_data_new = array();
			
			$post_data_new['bankusername'] 	= $post_data['bankusername'];
			$post_data_new['ifsc'] 			= $post_data['ifsc'];
			$post_data_new['bankname'] 		= $post_data['bankname'];
			if($post_data['accountno']!=''){
				$post_data_new['accountno'] 	= $post_data['accountno'];
			}
			$post_data_new['branch'] 		= $post_data['branch'];
			$post_data_new['payumoneyemail'] 	= $post_data['payumoneyemail'];
			$post_data_new['payumoneymobile']	= $post_data['payumoneymobile'];
			$post_data_new['mobiwikemail'] 	= $post_data['mobiwikemail'];
			$post_data_new['mobiwikmobile']	= $post_data['mobiwikmobile'];
			
			if($this->fuser_model->update($post_data_new,$user_details[0]['id'])){
				$user_data = $this->fuser_model->get_user_by_id($user_details[0]['id']);
				$data['success'] 	= '1';
				$data['data'] 		= $post_data;
				$data_new = array(
					'fuser_name' => $user_data[0]['username'],
					'fuser_details' => $user_data,
					'fis_logged_in' => true,
					'social_login' => false
				);
				$this->session->set_userdata($data_new);
			}else{
				$data['success'] = '2';
				$data['error'] = "Not able to update profile.";
				$data['data'] = $post_data;
			}
		}
		echo json_encode($data);
		die;
	
	}
	
	public function update_image(){
		$post_data = $this->input->post();	
		
		$this->load->library('form_validation');

		$this->load->model('fuser_model');
		$user_details = $this->session->userdata('fuser_details');
		$post_data_new = array();
		
		$config['upload_path'] 		= APPPATH.'../assets/uploads/user/';
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['max_size']			= '100000';
		$config['max_width']  		= '1024';
		$config['max_height']  		= '768';
		$config['overwrite'] 		= TRUE;
	
		$new_name 	= time()."_".str_replace(" ","_",$_FILES["userfile"]['name']);
		$config['file_name'] = $new_name;

		$this->load->library('upload', $config);
		$post_data_new = array();
		if ( !$this->upload->do_upload()){
			//$error = array('error' => $this->upload->display_errors());
			$data['success'] = '2';
			$data['error'] = $this->upload->display_errors();
			$data['data'] = $post_data;
			echo json_encode($data);
			die;
		}else{
			$post_data_new['image'] 	= $config['file_name'];
		}
		
//		$post_data_new['username'] 	= $post_data['username'];
	//	$post_data_new['mobile'] 	= $post_data['mobile'];
		$post_data_new['payment_option'] 	= $post_data['payment_option'];
		
		if($this->fuser_model->update($post_data_new,$user_details[0]['id'])){
			$user_data = $this->fuser_model->get_user_by_id($user_details[0]['id']);
			$data['success'] 	= '1';
			$data['src'] 		= base_url('assets/uploads/user/'.$config['file_name']);
			$data['data'] 		= $post_data;
			$data_new = array(
				'fuser_name' => $user_data[0]['username'],
				'fuser_details' => $user_data,
				'fis_logged_in' => true,
				'social_login' => false
			);
			$this->session->set_userdata($data_new);
		}else{
			$data['success'] = '2';
			$data['error'] = "Not able to upload image.";
			$data['data'] = $post_data;
		}
		echo json_encode($data);
		die;
	}
	
	public function payments() {	
		if ($this->session->userdata('fis_logged_in') == FALSE) {
			redirect(base_url());
			die;
		}else{
			$this->load->model('category_model');
			$this->load->model('product_model');
			$this->load->model('offer_model');
			$this->load->model('order_model');
			$this->load->model('brand_model');
			
			$data['list'] 			= $this->category_model->get_all_parent_category();
			$data['listnew'] 		= $this->category_model->get_all_main_category();
			$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
			$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
			$data['user_details']	= $this->session->userdata('fuser_details');
//			$data['orderlist'] 		= $this->order_model->get_all_order();
			$data['orderlist'] 		= $this->order_model->get_all_order($data['user_details']['0']['id']);
			
			$data['earning'] 		= $this->order_model->get_all_earning($data['user_details']['0']['id']);
			$data['payment'] 		= $this->order_model->get_all_payment($data['user_details']['0']['id']);
//			print_r($data['payment']);
			$data['menuopen']	= "mypayment";
			$this->load->helper('data');
			$data['topuser'] = topuser();			
			
			//load the view
    	    $data['main_content'] = 'front/payments';
	        $this->load->view('includes/front_template', $data);
		}	
	}
	public function myearning() {	
		if ($this->session->userdata('fis_logged_in') == FALSE) {
			redirect(base_url());
			die;
		}else{
			
			if($this->input->server('REQUEST_METHOD')=="POST"){
				$merchantTransactionId = rand(1000000,9999999);
				$user_details 	= $this->session->userdata('fuser_details');				
				$hash_string 	= "9aAO5oZM|".$user_details[0]['mobile']."|".$user_details[0]['email']."|".$this->input->post('amount')."|".$merchantTransactionId."|Co5Z6jFrib";
//				echo $hash_string."<br />";
			    $hash = strtolower(hash('sha512', $hash_string));
			//	echo $hash."<br />";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "https://test.payumoney.com/auth/ext/cashbackVault/requestPMPoints");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, "email=".$user_details[0]['email']."&mobile=".$user_details[0]['mobile']."&hash=".$hash."&amount=".$this->input->post('amount')."&key=9aAO5oZM&merchantTransactionId=".$merchantTransactionId);
		//		echo "email=".$user_details[0]['email']."&mobile=".$user_details[0]['mobile']."&hash=".$hash."&amount=".$this->input->post('amount')."&key=9aAO5oZM&merchantTransactionId=".$merchantTransactionId;
				$result = json_decode(curl_exec($ch));
				
//				print_r($result);
				if(!$result->status){
					$data['message'] = $result->message;
				}
				curl_close($ch);
				//die;
			}
			$this->load->model('category_model');
			$this->load->model('product_model');
			$this->load->model('offer_model');
			$this->load->model('order_model');
			$this->load->model('brand_model');
			
			$data['list'] 			= $this->category_model->get_all_parent_category();
			$data['listnew'] 		= $this->category_model->get_all_main_category();
			$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
			$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
			$data['user_details']	= $this->session->userdata('fuser_details');
			$data['orderlist'] 		= $this->order_model->get_all_order($data['user_details']['0']['id']);
			$data['earning'] 		= $this->order_model->get_all_earning($data['user_details']['0']['id']);
			$data['payment'] 		= $this->order_model->get_all_payment($data['user_details']['0']['id']);
//			print_r($data['earning']);
			$data['menuopen']	= "myearning";
			
			$this->load->helper('data');
			$data['topuser'] = topuser();
			
			//load the view
    	    $data['main_content'] = 'front/myearning';
	        $this->load->view('includes/front_template', $data);
		}	
	}
	public function missingcashback() {	
		if ($this->session->userdata('fis_logged_in') == FALSE) {
			redirect(base_url());
			die;
		}else{
			$this->load->model('category_model');
			$this->load->model('product_model');
			$this->load->model('offer_model');
			$this->load->model('order_model');
			$this->load->model('brand_model');
			
			$data['list'] 			= $this->category_model->get_all_parent_category();
			$data['listnew'] 		= $this->category_model->get_all_main_category();
			$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
			$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
			$data['user_details']	= $this->session->userdata('fuser_details');
			$data['ticketlist'] 		= $this->order_model->get_all_ticket();
			$data['orderlist'] 		= $this->order_model->get_all_order($data['user_details']['0']['id']);
			$data['earning'] 		= $this->order_model->get_all_earning($data['user_details']['0']['id']);
			$data['payment'] 		= $this->order_model->get_all_payment($data['user_details']['0']['id']);
			$data['menuopen']	= "missing";
			$this->load->helper('data');
			$data['topuser'] = topuser();			
			
			//load the view
    	    $data['main_content'] = 'front/missingcashback';
	        $this->load->view('includes/front_template', $data);
		}	
	}
	public function addticket() {	
		if ($this->session->userdata('fis_logged_in') == FALSE) {
			redirect(base_url());
			die;
		}else{
			$this->load->model('category_model');
			$this->load->model('product_model');
			$this->load->model('offer_model');
			$this->load->model('order_model');
			$this->load->model('brand_model');
			
			$data['list'] 			= $this->category_model->get_all_parent_category();
			$data['listnew'] 		= $this->category_model->get_all_main_category();
			$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
			$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
			$data['user_details']	= $this->session->userdata('fuser_details');
			$data['ticketlist'] 	= $this->order_model->get_all_ticket();
			$data['ip'] 			= $_SERVER["REMOTE_ADDR"];
			$data['added_date']		= date('Y-m-d H:i:s');
			
			$this->load->helper('data');
			$data['topuser'] = topuser();
			$data['menuopen']	= "missing";
			
			//load the view
    	    $data['main_content'] = 'front/addticket';
	        $this->load->view('includes/front_template', $data);
		}	
	}
	
	public function addticketpost(){
		$post_data = $this->input->post();	
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('amount', 'amount', 'trim|required');
		$this->form_validation->set_rules('date', 'date', 'trim|required]');
		$this->form_validation->set_rules('retailer', 'retailer', 'trim|required]');

		$this->load->model('order_model');
		if ($this->form_validation->run() == FALSE){
			$data['success'] 	= '2';
			$data['data'] 		= $post_data;
			$data['error'] 		= validation_errors();
		}else{
			$user_details = $this->session->userdata('fuser_details');
			$post_data_new = array();
			
			$config['upload_path'] 		= APPPATH.'../assets/uploads/attachment/';
			$config['allowed_types'] 	= 'gif|jpg|png';
			$config['max_size']			= '100000';
			$config['max_width']  		= '1920';
			$config['max_height']  		= '1300';
		 	$config['overwrite'] 		= TRUE;
			
			$new_name 	= time().$_FILES["ticketuserfile"]['name'];
			$config['file_name'] = $new_name;
	
			$this->load->library('upload', $config);
	
			if ( ! $this->upload->do_upload('ticketuserfile')){
				$error = array('error' => $this->upload->display_errors());
			}else{
				$post_data_new['attachment'] 	= $config['file_name'];
			}
			
			$last_ticket = $this->db->select('id')->from('tbl_ticket')->order_by('id', "desc")->get()->result_array(); 
			
			$ticket_id = date('Ym').str_pad(($last_ticket[0]['id']+1), 4, "0", STR_PAD_LEFT);
			
//			$user_details	= $this->session->userdata('fuser_details');
			$ticket_rand = explode("__",$post_data['retailer']);
			$post_data_new['retailer'] 			= isset($ticket_rand[0])?$ticket_rand[0]:"";
			$post_data_new['random'] 			= isset($ticket_rand[1])?$ticket_rand[1]:"";
			$post_data_new['date'] 				= date("Y-m-d",strtotime($post_data['date']));
			$post_data_new['amount'] 			= $post_data['amount'];
			$post_data_new['transection_id'] 	= $post_data['transection_id'];
			$post_data_new['description'] 		= $post_data['description'];
			$post_data_new['user_id'] 			= $user_details[0]['id'];
			$post_data_new['ticket_id'] 		= $ticket_id;
			$post_data_new['ip'] 				= $_SERVER["REMOTE_ADDR"];
			$post_data_new['added_date']		= date('Y-m-d H:i:s');
			
			if($this->order_model->addticket($post_data_new)){
				$data['success'] 	= '1';
				$data['data'] 		= $post_data_new;
		/*		$config = array('mailtype' => 'html');
				$this->load->library('email',$config);
				$description = "Hello ".$user_details[0]['username']."<br/><br/>";
				$description .= "Your ticket id is:".$post_data_new['ticket_id']."<br/><br/>";
				$description .= "Thanks<br/>Cashkarle";
				
				$this->email->from('info@cashkarle.com', 'cashkarle');
				$this->email->to($user_details[0]['email']); 
				
				$this->email->subject("Ticket Added To Cashkarle");
				$this->email->message($description);	
				$this->email->send();*/
				
					
				$subject = 'Hey '.$user_details[0]['username'].', We have Received Missing Ticket';
				$html = "<div style='font-family: \"Bodoni MT\", Didot, \"Didot LT STD\", \"Hoefler Text\", Garamond, \"Times New Roman\", serif; font-size:20px;'><i><div style='width:100%; text-align:center; '><div style='width:100%; text-align:center;'><img src='". base_url()."assets/img/plogo.png' width='200'  alt='CashKarle.com' align='center' /></div>";
				$html .= "Hey ".$user_details[0]['username'].",<br /><br />";
				$html .= "We have received your Ticket and your Ticket no. is ".$ticket_id." . Our team will get in touch with you shortly.<br/><br/>Thanks for being a part of CashKarle.com. <br /><br />";
				$html .= "<strong>Regards,<br />CashKarle.com<br />Enjoy Savings</strong></i></div>";
				//$this->email->message($html);	
					
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				
				// More headers
				$headers .= 'From: Cashkarle <info@cashkarle.com>' . "\r\n";
		//		$headers .= 'Cc: myboss@example.com' . "\r\n";
				$to = $user_details[0]['email'];
				if(mail($to,$subject,$html,$headers)){
					$arr = array('status' => 1);
				}else{
					$arr = array('status' => 0,'error'=>'There is some issue in recover password. Please contact cashkale team.');
				}
			}else{
				$data['success'] = '0';
				$data['error'] = "Not able to add ticket.";
				$data['data'] = $post_data_new;
			}
		}
		echo json_encode($data);
		die;
	}
	function paymentpost(){
		$post_data = $this->input->post();	

		$this->load->library('form_validation');

		$this->form_validation->set_rules('password', 'password', 'trim|required|callback_password_check');

		if ($this->form_validation->run() == FALSE){
			$data['success'] 	= '2';
			$data['data'] 		= $post_data;
			$data['error'] 		= validation_errors();
		}else{
			$user_details = $this->session->userdata('fuser_details');
		
			$data['success'] 	= '1';
			$data['data'] 		= $post_data;
			$config = array('mailtype' => 'html');
			$this->load->library('email',$config);
			$description = "Hello ".$user_details[0]['username']."<br/><br/>";
			if(isset($post_data['amount']) && $post_data['amount']!=''){
				$description .= "Payment Of: ".$post_data['amount']."<br/><br/>";
			}else{
				if(isset($post_data['amountwallet']) && $post_data['amountwallet']!=''){
					$description .= "Payment Of: ".$post_data['amountwallet']."<br/><br/>";
				}
				
			}
			$description .= "Thanks<br/>Cashkarle";
			
			$post_data_new = array(
				'amount' => $post_data['amount'],
				'payment_option' => $post_data['payment_option'],
				'payumoneyemail' => $post_data['payumoneyemail'],
				'payumoneymobile' => $post_data['payumoneymobile'],
				'paytmemail' => $post_data['paytmemail'],
				'mobiwikemail' => $post_data['mobiwikemail'],
				'mobiwikmobile' => $post_data['mobiwikmobile'],
				'bankusername' => $post_data['bankusername'],
				'bankname' => $post_data['bankname'],
				'accountno' => $post_data['accountno'],
				'branch' => $post_data['branch'],
				'ifsc' => $post_data['ifsc'],
				'user_id' => $user_details[0]['id'],
				'date' => date('Y-m-d H:i:s')
			);
			
			$this->db->insert('tbl_payment', $post_data_new);
		
			$this->email->from('info@cashkarle.com', 'cashkarle');
			if($post_data['paytmemail']!=''){
				$this->email->to($post_data['paytmemail']); 
			}elseif($post_data['mobiwikemail']!=''){
				$this->email->to($post_data['mobiwikemail']); 
			}elseif($post_data['payumoneyemail']!=''){
				$this->email->to($post_data['payumoneyemail']); 
			}else{
				$this->email->to($user_details[0]['email']); 
			}
			
			$this->email->subject("payment to your account from Cashkarle");
			$this->email->message($description);	
			$this->email->send();
		}
		echo json_encode($data);
		die;
	}
	function paymentsetting(){
		if ($this->session->userdata('fis_logged_in') == FALSE) {
			redirect(base_url());
			die;
		}else{
			$this->load->model('category_model');
			$this->load->model('product_model');
			$this->load->model('offer_model');
			$this->load->model('order_model');
			$this->load->model('brand_model');
			
			$data['list'] 			= $this->category_model->get_all_parent_category();
			$data['listnew'] 		= $this->category_model->get_all_main_category();
			$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
			$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
			$data['user_details']	= $this->session->userdata('fuser_details');
//			$data['ticketlist'] 		= $this->order_model->get_all_ticket();
			
			$data['menuopen']	= "myaccount";
			$this->load->helper('data');
			$data['topuser'] = topuser();
			
			//load the view
    	    $data['main_content'] = 'front/payment_setting';
	        $this->load->view('includes/front_template', $data);
		}		
	}
	function addlink(){
		$post_data = $this->input->post();
		//print_r($post_data);
		$post_data_new 	= array();
		if(isset($post_data['id'])){
			$this->load->model('product_model');
			$this->load->model('offer_model');
			if($post_data['for']=='product'){
				$product_details  	= $this->product_model->get_product_by_id($post_data['id']);
				$post_data_new['link'] 		= $product_details[0]['url'];
			}else if($post_data['for']=='coupon'){
				$product_details  	= $this->offer_model->get_coupon_by_id($post_data['id']);
				$post_data_new['link'] 		= $product_details[0]['link'];
			}else if($post_data['for']=='offer'){
				$product_details  	= $this->offer_model->get_offer_by_id($post_data['id']);
				$post_data_new['link'] 		= $product_details[0]['url'];
			}else{
				$product_details  	= $this->offer_model->get_coupon_by_id($post_data['id']);
				$post_data_new['link'] 		= $product_details[0]['link'];	
			}
			$user_details	= $this->session->userdata('fuser_details');
			
			$post_data_new['user_id']	= $user_details[0]['id'];
		}else{
			$post_data_new['link'] 		= $post_data['link'];
			$post_data_new['user_id']	= 0;
		}
		$post_data_new['url'] 		= $post_data['url'];
		$post_data_new['action'] 	= $post_data['formaction'];
		$random_no 					= explode("/",$post_data['formaction']);
		$post_data_new['random'] 	= $random_no[sizeof($random_no)-1];

		$data_new = array(
			'random_no' => $random_no[sizeof($random_no)-1]
		);
		$this->session->set_userdata($data_new);
		
		$this->db->insert('tbl_linkgo', $post_data_new);
		echo json_encode($post_data_new);
		die;
	}
	
	function getlistretailer(){
		
		$user_details	= $this->session->userdata('fuser_details');
		
//		$post_data_new['user_id']	= $user_details[0]['id'];
		$post_data = $this->input->post();
		$post_data_new 	= array();
		$golink = $this->db->select('*')->from('tbl_linkgo')->where("user_id",$user_details[0]['id'])->where("date >=",date('Y-m-d 00:00:00',strtotime($post_data['date'])))->where("date <=",date('Y-m-d 23:59:59',strtotime($post_data['date'])))->get()->result_array(); 
		$datasite = array();
		$option = "";
		foreach($golink as $key_count=>$val){
			$key = "";
			if (strpos($val['link'], 'snapdeal') !== false){
			    $key = 'Snapdeal';
			}
			if (strpos($val['link'], 'amazon') !== false){
			    $key = 'Amazon';
			}
			if (strpos($val['link'], 'flipkart') !== false){
			    $key = 'Flipkart';
			}
			if (strpos($val['link'], 'vcommission') !== false){
				$linkbreak = explode("offer_id=",$val['link']);
				$linkbreak2 = explode("&",$linkbreak[1]);
				
			    $id = $linkbreak2[0];
				$offer = $this->db->select('title')->from('tbl_offer')->like('url',"=".$linkbreak2[0]."&",'both')->get()->result_array(); 
				
				$find = array("CPRC", "CPA","CPS","CPL"," - India");
				$replace = array("","","","","");
				$key = str_replace($find,$replace,$offer[0]['title']);				
				if (strpos($key, 'flipkart') !== false || strpos($key, 'Flipkart') !== false){
					$key = 'Flipkart';
				}
			}
			//if(!in_array($key,$datasite)){
				if($key!=''){
					$datasite[] = $key;
					$option .= "<option value='".$key."__".$val['random']."'>".$key."(".date("d-M Y h:i a",strtotime($val['date'])).")</option>";
				}
			//}
		}
//		print_r($datasite);
		//print_r($golink);
		//echo $this->db->last_query();
		$post_data_new['option'] = $option;
		$post_data_new['success'] = '0';		
		if($option!=''){
			$post_data_new['success'] = '1';		
		}
		echo json_encode($post_data_new);
		die;
	}
	function contact(){
		
		$this->load->library('form_validation');
		$this->load->model('category_model');
		$this->load->model('product_model');
		$this->load->model('offer_model');
		$this->load->model('order_model');
		$this->load->model('brand_model');
		
		$data['list'] 			= $this->category_model->get_all_parent_category();
		$data['listnew'] 		= $this->category_model->get_all_main_category();
		$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
		$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
		$data['user_details']	= $this->session->userdata('fuser_details');
//			$data['ticketlist'] 		= $this->order_model->get_all_ticket();
		
		$data['menuopen']	= "myaccount";
		$this->load->helper('data');
		$data['topuser'] = topuser();

		$this->load->helper('captcha');
		$vals = array(
			'img_path'	=> './captcha/',
			'img_url'	=> base_url('captcha')."/",
			'img_width'	=> '150',
			'img_height' => 40,
			'expiration' => 7200
			);
		$captcha = create_captcha($vals);
		$data['cap_image'] 	= $captcha['image'];
		$this->session->set_userdata('captcha', $captcha['word']);
		//load the view
		$data['main_content'] = 'front/contact';
		$this->load->view('includes/front_template', $data);
	}
	function addcontact(){
				
		$this->load->library('form_validation');
		
		
		$post_data = $this->input->post();
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('captcha', 'captcha', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|email]');

		$this->load->model('order_model');
		if ($this->form_validation->run() == FALSE){
			$data['success'] 	= '2';
			$data['data'] 		= $post_data;
			$data['error'] 		= validation_errors();
		}else{
//			$user_details = $this->session->userdata('fuser_details');
			$post_data_new = array();
			
			$post_data_new['name'] 			= $post_data['name'];
			$post_data_new['option'] 		= $post_data['option'];
			$post_data_new['email'] 		= $post_data['email'];
			$post_data_new['description'] 	= $post_data['description'];
			$post_data_new['date']			= date('Y-m-d H:i:s');
			$captcha1 = $this->session->userdata('captcha');
//			echo 	$captcha."!=".$post_data['captcha'];
			if($captcha1!=$post_data['captcha']){
				//$arr = array('success' => 2,'error'=>'Image text not matched');
				//echo json_encode( $arr );
				$data['success'] = '2';
				$data['error'] = "Image text not matched.";
				$data['data'] = $post_data_new;
			}	else{
				
				if($this->db->insert('tbl_contactus', $post_data_new)){
					
					$data['success'] 	= '1';
					$data['data'] 		= $post_data_new;
					$config = array('mailtype' => 'html');
					$this->load->library('email',$config);
					$description = "Name:".$post_data_new['name']."<br/>";
					$description .= "Topic:".$post_data_new['option']."<br/>";
					$description .= "Email:".$post_data_new['email']."<br/>";
					$description .= "Description:".$post_data_new['description']."<br/><br/>";
					$description .= "Thanks<br/>Cashkarle";
					
					$this->email->from('info@cashkarle.com', 'Contact Us');
					$this->email->to("help@cashkarle.com"); 
				//$this->email->to("vikas1234saini@gmail.com"); 
					
					$this->email->subject("Contact us form cashkarle");
					$this->email->message($description);
		
					if($this->email->send()){
							
					
					}
					$data['success'] = '1';
					$data['error'] = "Your query  has been raised. we will revert you shortly";
					$data['data'] = $post_data_new;
				}else{
					$data['success'] = '2';
					$data['error'] = "Not able to send message.";
					$data['data'] = $post_data_new;
				}
			}
			
		}

		echo json_encode($data);
		die;
		$this->load->model('category_model');
		$this->load->model('product_model');
		$this->load->model('offer_model');
		$this->load->model('order_model');
		$this->load->model('brand_model');
		
		$data['list'] 			= $this->category_model->get_all_parent_category();
		$data['listnew'] 		= $this->category_model->get_all_main_category();
		$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
		$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
		$data['user_details']	= $this->session->userdata('fuser_details');
//			$data['ticketlist'] 		= $this->order_model->get_all_ticket();
		
		$data['menuopen']	= "myaccount";
		$this->load->helper('data');
		$data['topuser'] = topuser();

		$this->load->helper('captcha');
		$vals = array(
			'img_path'	=> './captcha/',
			'img_url'	=> base_url('captcha')."/",
			'img_width'	=> '150',
			'img_height' => 40,
			'expiration' => 7200
			);
		$captcha = create_captcha($vals);
		$data['cap_image'] 	= $captcha['image'];
		$this->session->set_userdata('captcha', $captcha['word']);
		//load the view
		$data['main_content'] = 'front/contact';
		$this->load->view('includes/front_template', $data);
	}
	function terms(){
		
			$this->load->model('category_model');
			$this->load->model('product_model');
			$this->load->model('offer_model');
			$this->load->model('order_model');
			$this->load->model('brand_model');
			
			$data['list'] 			= $this->category_model->get_all_parent_category();
			$data['listnew'] 		= $this->category_model->get_all_main_category();
			$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
			$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
			$data['user_details']	= $this->session->userdata('fuser_details');
//			$data['ticketlist'] 		= $this->order_model->get_all_ticket();
			
			$data['menuopen']	= "myaccount";
			$this->load->helper('data');
			$data['topuser'] = topuser();
			
			//load the view
    	    $data['main_content'] = 'front/terms';
	        $this->load->view('includes/front_template', $data);
	}
	function newslettersub(){
		$post_data = $this->input->post();
		$post_data_new = array();
		$post_data_new['email'] = $post_data['txtEmail'];
		$post_data_new['date'] 	= date('Y-m-d H:i:s');
//		print_r($post_data);
		$newsletter = $this->db->select('id')->from('tbl_newsletteruser')->where('email',$post_data['txtEmail'])->get()->result_array(); 
	//	print_r($newsletter);
//		echo sizeof($newsletter);
		if(sizeof($newsletter)==0){
			if($this->db->insert('tbl_newsletteruser', $post_data_new)){
				$data['success'] 	= '1';
				$data['data'] 		= $post_data;
			
				
				$subject = 'Thanks you for updates';
				$html = "<div style='font-family: \"Bodoni MT\", Didot, \"Didot LT STD\", \"Hoefler Text\", Garamond, \"Times New Roman\", serif; font-size:20px;'><i><div style='width:100%; text-align:center;'><img src='". base_url()."assets/img/plogo.png' width='200'  alt='CashKarle.com' align='center' /></div>";
				//$html .= "Hey ".$this->input->post('username').",<br /><br />";
				$html .= "Hey There ,<br /><br />Thanks for being a part of CashKarle. We would like to welcome you to our earning Community, From now you will get Offers and Cashback updates on your email.<br />We are India’s top cash back & coupons website. We have tied up with all websites like Snapdeal, Amazon, Flipkart & many more. <br />Every time when you visit our partnered sites via CashKarle and shopped, you will get extra Cashback.<br />";
			//	$html .= "<a href='".base_url()."' style='text-decoration:none;' ><div style='width:200px; color:#fff; text-align:center; height:30px;line-height:30px; background: #449d44;    font-size: 16px;    font-weight: bold;    padding: 5px;'>Sign in to your account</div></a><br /><br />";
				$html .= "To get Cashback <a href='".base_url()."' style='text-decoration:none;' ><div style='   font-size: 24px;    font-weight: bold;    padding: 5px;'>Click Here</div></a><br />";
				$html .= "If you have any query, Kindly <a href='".base_url('contact')."'  style='text-decoration:none;'><div style='font-size: 24px;    font-weight: bold;    padding: 5px;'>Contact Us</div></a>.<br /><br />";
				$html .= "<strong>Warm Regards,<br />CashKarle.com<br />Enjoy Savings</strong></i></div>";
				//$this->email->message($html);	
				
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				
				// More headers
				$headers .= 'From: Cashkarle <info@cashkarle.com>' . "\r\n";
		//		$headers .= 'Cc: myboss@example.com' . "\r\n";
				$to = $post_data['txtEmail'];
				if(mail($to,$subject,$html,$headers)){
					$arr = array('status' => 1);
				}else{
					$arr = array('status' => 0,'error'=>'There is some issue in recover password. Please contact cashkale team.');
				}
			/*	$this->load->library('email');
				$this->email->set_mailtype('html');
				$this->email->from('info@cashkarle.com', 'cashkarle');
				$this->email->to($post_data['txtEmail']); 
				//$this->email->cc('vikas1234saini@gmail.com');  
				$this->email->set_mailtype('html');
				
				$this->email->subject('Thanks For newsletter subscription');
				$this->email->message("<br /><br />Welcome to <a href='".base_url()."'>cashkarle.com</a> !<br />You will recive latest updates form our side");	
				
				$this->email->send();*/
			}else{
				$data['success'] = '2';
				$data['error'] = "Not able to add email.";
				$data['data'] = $post_data;
			}
		}else{		
			$data['success'] = '2';
			$data['error'] = "Email already exist.";
			$data['data'] = $post_data;	
		}		
		echo json_encode($data);
		die;
	}
	function paytmPaytemt(){
		$this->load->helper('data');
		
				
		$checkSum = "";
		$paramList = array();
		$paramList['request'] = array( 'requestType' =>'null',
				'merchantGuid' => PAYTM_Merchant_Guid,
				'merchantOrderId' => rand(1000000,9999999),     
				'salesWalletGuid'=>PAYTM_Sales_Guid,
				'payeeEmailId'=>'vikas1234saini@gmail.com',       
				'payeePhoneNumber'=>'7777777777',
				'payeeSsoId'=>'',
				'appliedToNewUsers'=>'Y',
				'amount'=>'1',
				'currencyCode'=>'INR');
				
		$paramList['metadata'] = 'vikas Testing Data';
		$paramList['ipAddress'] = '192.168.40.11';
		$paramList['operationType'] = 'SALES_TO_USER_CREDIT';
		$paramList['platformName'] = 'PayTM';
		
		$data_string = json_encode($paramList); 
		
		//Here checksum string will return by getChecksumFromArray() function.
		$checkSum = getChecksumFromString($data_string,PAYTM_Merchant_key);
		
		$ch = curl_init();                    // initiate curl
		$url  = PAYTM_URL."wallet-web/salesToUserCredit"; // where you want to post data
		
		
		$headers = array('Content-Type:application/json','mid:'.PAYTM_Merchant_Guid,'checksumhash:'.$checkSum);
		
		$ch = curl_init();  // initiate curl
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);  // tell curl you want to post something
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string); // define what you want to post
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return the output in string format
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);     
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);    
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$output = curl_exec ($ch); // execute
		$info = curl_getinfo($ch);
		
		echo "test";
		print_r($info)."<br />";
		
		echo $output;
		//print_r($data);
		echo "test";
	}
	function ticket_info(){
		$post_data = $this->input->post();	
		$this->load->model('ticket_model');
		$ticketdetails = $this->ticket_model->get_ticket_by_id($post_data['id']);
		$data_html = "<div><strong>Ticket No:  ".$ticketdetails[0]['ticket_id']."</strong></div>";
		$data_html .= "<div><strong>Dated:  ".date("d M Y h:i a",strtotime($ticketdetails[0]['added_date']))."</strong></div>";
		$data_html .= "<div style='word-wrap: break-word;'><strong>Description:  ".$ticketdetails[0]['description']."</strong></div>";
		$data_html .= "<div><strong>Retailer:  ".$ticketdetails[0]['retailer']."</strong></div>";
		$data_html .= "<div><strong>Transection Id:  ".$ticketdetails[0]['transection_id']."</strong></div>";
		if($ticketdetails[0]['random']!=''){
			$data_data = $this->db->select('date')->from('tbl_linkgo')->where('random', $ticketdetails[0]['random'])->get()->result_array();
			if(sizeof($data_data)>0){
				//$data_html .=  date("d-M Y H:i a",strtotime($data_data[0]['date'])); 
				$data_html .= "<div><strong>Transection Date:  ".date("d M Y h:i a",strtotime($data_data[0]['date']))."</strong></div>";
			}else{
			$data_html .= "<div><strong>Transection Date:  ".date("d M Y h:i a",strtotime($ticketdetails[0]['date']))."</strong></div>";
			}
		}else{
			$data_html .= "<div><strong>Transection Date:  ".date("d M Y h:i a",strtotime($ticketdetails[0]['date']))."</strong></div>";
		}
		
        $prev_reply = $this->ticket_model->get_all_reply_by_ticket($ticketdetails[0]['id']);
		if(sizeof($prev_reply)>0){
			$data_html .= "<div style='margin-bottom:10px;margin-top:20px;'><strong>Response:</strong></div>";
		}
		foreach($prev_reply as $key=>$value){
			$data_html .= "<div style='border:solid 1px; padding:10px; margin:10px;word-wrap: break-word;'><div>".$value['reply']."</div>";
			$data_html .= "<div><strong>Dated:  ".date("d M Y h:i a",strtotime($value['date']))."</strong></div>";
			$data_html .= "<div><strong>By:  ".$value['user']."</strong></div></div></div>";
			
		}
		echo $data_html;
//		print_r($ticketdetails);
	}
	function reopen(){
		$post_data = $this->input->post();	
		$post_data_new = array();
		
		$post_data_new['reply'] 	= $post_data['reply'];
		$post_data_new['date'] 		= date("Y-m-d H:i:s");
		$post_data_new['ticket_id'] = $post_data['id'];
//		$post_data_new['status'] 			= "2";
		
		$user_details	= $this->session->userdata('fuser_details');	
		
		$post_data_new['user'] 	= $user_details[0]['username'];
		
		if($this->db->insert("tbl_reply",$post_data_new)){
			$post_data_new = array();
			$post_data_new['status'] 		= '2';
			
			$this->load->model('ticket_model');
			//if the insert has returned true then we show the flash message
			$this->ticket_model->update_ticket($post_data['id'], $post_data_new);		
			
			$data['status']  	= '1';	
			$data['post_data'] 	= $post_data;
			echo json_encode($data);
			die;	
		}
	}
	function pauumoney(){
		$merchantTransactionId = rand(1000000,9999999);
		$user_details 	= $this->session->userdata('fuser_details');				
//		$hash_string 	= "9aAO5oZM|".$user_details[0]['mobile']."|".$user_details[0]['email']."|".$this->input->post('amount')."|".$merchantTransactionId."|Co5Z6jFrib";
		$hash_string 	= "9aAO5oZM|9468446525|vikas1234saini@gmail.com|10|".$merchantTransactionId."|Co5Z6jFrib";
//				echo $hash_string."<br />";
		$hash = strtolower(hash('sha512', $hash_string));
	//	echo $hash."<br />";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://test.payumoney.com/auth/ext/cashbackVault/requestPMPoints");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "email=vikas1234saini@gmail.com&mobile=9468446525&hash=".$hash."&amount=10&key=9aAO5oZM&merchantTransactionId=".$merchantTransactionId);
		$result = json_decode(curl_exec($ch));
		
				print_r($result);
		if(!$result->status){
			$data['message'] = $result->message;
		}
		curl_close($ch);	
	}
}