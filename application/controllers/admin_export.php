<?php
class Admin_export extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()  {
        parent::__construct();
		
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
		
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index(){
        $for = $this->uri->segment(3);
		if(!$this->session->userdata('is_logged_in') || $for==''){
            redirect('admin/login');
        }
		$get_data = $this->input->get();
		
		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle($for);
		if($get_data==false){
			if($for=='discount'){
				
				$this->load->model('flipkartdiscount_model');
				$this->load->model('flipkartofferdiscount_model');
				$this->load->model('amazondiscount_model');
				$this->load->model('snapdealdiscount_model');
				
				if($get_data['for']=='flipkartdiscount'){
					$for = $get_data['for'];	
					$header_array = array('A1'=>'S.No',
										  'B1'=>'Category',
										  'C1'=>'Retailer',
										  'D1'=>'Discount Given',
										  'E1'=>'Discount By Us',
										  'F1'=>'Unit',
										  'G1'=>'Discount given for mobile',
										  'H1'=>'Discount given by us for mobile',
										  'I1'=>'Username');
					foreach($header_array as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
					}
					
					$counter = 2;
					$downloaded 	= $this->flipkartdiscount_model->get_all_flipkartdiscount();
					foreach($downloaded as $key_d => $value_d){
						$header_array1 = array('A'.$counter=>$counter-1,
										  'B'.$counter=>$value_d['category'],
										  'C'.$counter=>"Flipkart",
										  'D'.$counter=>$value_d['discount_given'],
										  'E'.$counter=>$value_d['discount_by_us'],
										  'F'.$counter=>$value_d['discount_unit'],
										  'G'.$counter=>$value_d['discount_given_mobile'],
										  'H'.$counter=>$value_d['discount_by_us_mobile'],
										  'I'.$counter=>$value_d['admin']
										  );
						foreach($header_array1 as $key => $value){
							$this->excel->getActiveSheet()->setCellValue($key, $value);
							$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
						}
						$counter++;
					}
				}
				
				/*if($get_data['for']=='flipkartofferdiscount'){
					$downloaded 	= $this->flipkartofferdiscount_model->get_all_flipkartofferdiscount($get_data['key']);
					foreach($downloaded as $key_d => $value_d){
						$header_array1 = array('A'.$counter=>$counter-1,
										  'B'.$counter=>$value_d['category'],
										  'C'.$counter=>"Flipkart Offer",
										  'D'.$counter=>$value_d['discount_given'],
										  'E'.$counter=>$value_d['discount_by_us'],
										  'F'.$counter=>$value_d['discount_unit'],
										  'G'.$counter=>$value_d['discount_given_mobile'],
										  'H'.$counter=>$value_d['discount_by_us_mobile']
										  );
						foreach($header_array1 as $key => $value){
							$this->excel->getActiveSheet()->setCellValue($key, $value);
							$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
						}
						$counter++;
					}
				}*/
				if($get_data['for']=='amazondiscount'){
					$for = $get_data['for'];
					$header_array = array('A1'=>'S.No',
										  'B1'=>'Category',
										  'C1'=>'Retailer',
										  'D1'=>'Discount Given',
										  'E1'=>'Discount By Us',
										  'F1'=>'Unit',
										  'G1'=>'Username');
					foreach($header_array as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
					}
					
					$counter = 2;
					$downloaded 	= $this->amazondiscount_model->get_all_amazondiscount();
					foreach($downloaded as $key_d => $value_d){
						$header_array1 = array('A'.$counter=>$counter-1,
										  'B'.$counter=>$value_d['category'],
										  'C'.$counter=>"Amazon",
										  'D'.$counter=>$value_d['discount_given'],
										  'E'.$counter=>$value_d['discount_by_us'],
										  'F'.$counter=>$value_d['discount_unit'],
										  'G'.$counter=>$value_d['admin']
										  );
						foreach($header_array1 as $key => $value){
							$this->excel->getActiveSheet()->setCellValue($key, $value);
							$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
						}
						$counter++;
					}
				}
				if($get_data['for']=='snapdealdiscount'){
					$for = $get_data['for'];
					$header_array = array('A1'=>'S.No',
										  'B1'=>'Category',
										  'C1'=>'Retailer',
										  'D1'=>'Discount Given',
										  'E1'=>'Discount By Us',
										  'F1'=>'Unit',
										  'G1'=>'Discount given for mobile',
										  'H1'=>'Discount given by us for mobile',
										  'I1'=>'Username');
					foreach($header_array as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
					}
					
					$counter = 2;
					$downloaded 	= $this->snapdealdiscount_model->get_all_snapdealdiscount();
					foreach($downloaded as $key_d => $value_d){
						$header_array1 = array('A'.$counter=>$counter-1,
										  'B'.$counter=>$value_d['category'],
										  'C'.$counter=>"Snapdeal",
										  'D'.$counter=>$value_d['discount_given'],
										  'E'.$counter=>$value_d['discount_by_us'],
										  'F'.$counter=>"",
										  'G'.$counter=>$value_d['discount_given_mobile'],
										  'H'.$counter=>$value_d['discount_by_us_mobile'],
										  'I'.$counter=>$value_d['admin']
										  );
						foreach($header_array1 as $key => $value){
							$this->excel->getActiveSheet()->setCellValue($key, $value);
							$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
						}
						$counter++;
					}
				}
			}
			if($for=='brand'){
				$header_array = array('A1'=>'S.No',
									  'B1'=>'Brand',
									  'C1'=>'Category',
									  'D1'=>'Discount',
									  'E1'=>'Status'
									  );
				foreach($header_array as $key => $value){
					$this->excel->getActiveSheet()->setCellValue($key, $value);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
				}
				
				$counter = 2;
			
				$this->load->model('brand_model');	
				$downloaded 	= $this->brand_model->get_all_main_brand();
				foreach($downloaded as $key_d => $value_d){
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['brandName'],
									  'C'.$counter=>$value_d['parentName'],
									  'D'.$counter=>$value_d['discount'],
									  'E'.$counter=>$value_d['status']
									  );
					foreach($header_array1 as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					}
					$counter++;
				}
			}
			if($for=='user'){
				$header_array = array('A1'=>'S.No',
									  'B1'=>'Name',
									  'C1'=>'Email',
									  'D1'=>'Mobile',
									  'E1'=>'Signup Mode',
									  'F1'=>'Earned',
									  'G1'=>'Username',
									  'H1'=>'Staus'
									  );
				foreach($header_array as $key => $value){
					$this->excel->getActiveSheet()->setCellValue($key, $value);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
				}
				
				$counter = 2;
			
				$this->load->model('users_model');	
				$downloaded 	= $this->users_model->get_all_user();
				foreach($downloaded as $key_d => $value_d){
					$signup_mode = "";
					if($value_d['facebook']!=''){
						$signup_mode = 'Facebook';
					}elseif($value_d['twitter']!=''){
						$signup_mode = 'Twitter';
					}elseif($value_d['linkedin']!=''){
						$signup_mode = 'Linkedin';
					}elseif($value_d['gplus']!=''){
						$signup_mode = 'Google Plus';
					}else{
						$signup_mode = 'Email';
					}
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['username'],
									  'C'.$counter=>$value_d['email'],
									  'D'.$counter=>$value_d['mobile'],
									  'E'.$counter=>$signup_mode,
									  'F'.$counter=>round($value_d['payment'],2),
									  'G'.$counter=>$value_d['admin'],
									  'H'.$counter=>($value_d['status']=='1'?"Active":"De-active")
									  );
					foreach($header_array1 as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					}
					$counter++;
				}
			}
			if($for=='ticket'){
				
				$header_array = array('A1'=>'S.No',
									  'B1'=>'Ticket Id',
									  'C1'=>'Transection Id',
									  'D1'=>'Retailer',
									  'E1'=>'User',
									  'F1'=>'Amount',
									  'G1'=>'Description',
									  'H1'=>'IP',
									  'I1'=>'Status',
									  'J1'=>'Added Date',
									  'K1'=>'Closed Date',
									  'L1'=>'Transection Date',
									  'M1'=>'Username',
									  'N1'=>'Unique No.'
									  );
				foreach($header_array as $key => $value){
					$this->excel->getActiveSheet()->setCellValue($key, $value);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
				}
				
				$counter = 2;
			
				$this->load->model('ticket_model');	
				$downloaded 	= $this->ticket_model->get_all_ticket();
				foreach($downloaded as $key_d => $value_d){
					
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['ticket_id'],
									  'C'.$counter=>$value_d['transection_id'],
									  'D'.$counter=>$value_d['retailer'],
									  'E'.$counter=>$value_d['username'],
									  'F'.$counter=>$value_d['amount'],
									  'G'.$counter=>$value_d['description'],
									  'H'.$counter=>$value_d['ip'],
									  'I'.$counter=>(($value_d['status']==1)?"Closed":"Processing"),
									  'J'.$counter=>$value_d['added_date'],
									  'K'.$counter=>$value_d['close_date'],
									  'L'.$counter=>$value_d['date'],
									  'M'.$counter=>$value_d['admin'],
									  'N'.$counter=>$value_d['random']
									  );
					foreach($header_array1 as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					}
					$counter++;
				}
			}
			if($for=='contact'){
				
				$header_array = array('A1'=>'S.No',
									  'B1'=>'Name',
									  'C1'=>'Email',
									  'D1'=>'Topic',
									  'E1'=>'Description',
									  'F1'=>'Date',
									  'G1'=>'Replied',
									  'H1'=>'Username'
									  );
				foreach($header_array as $key => $value){
					$this->excel->getActiveSheet()->setCellValue($key, $value);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
				}
				
				$counter = 2;
			
				$this->load->model('contact_model');	
				$downloaded 	= $this->contact_model->get_all_contact();
				foreach($downloaded as $key_d => $value_d){
					
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['name'],
									  'C'.$counter=>$value_d['email'],
									  'D'.$counter=>$value_d['option'],
									  'E'.$counter=>$value_d['description'],
									  'F'.$counter=>(date("d-M-Y h:i a",strtotime($value_d['date']))),
									  'G'.$counter=>(($value_d['status']==1)?"Replied":"Not Replied"),
									  'H'.$counter=>$value_d['admin']
									  );
					foreach($header_array1 as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					}
					$counter++;
				}
			}
			
			if($for=='order'){
				
				$header_array = array('A1'=>'S.No',
									  'B1'=>'Order Id',
									  'C1'=>'Username',
									  'D1'=>'Amount',
									  'E1'=>'Sitename',
									  'F1'=>'Status',
									  'G1'=>'Date',
									  );
				foreach($header_array as $key => $value){
					$this->excel->getActiveSheet()->setCellValue($key, $value);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
				}
				
				$counter = 2;
			
				$this->load->model('order_model');	
				$downloaded 	= $this->contact_model->get_all_order();
				foreach($downloaded as $key_d => $value_d){
					
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['random'],
									  'C'.$counter=>$value_d['username'],
									  'D'.$counter=>$value_d['amount'],
									  'E'.$counter=>$value_d['sitename'],
									  'F'.$counter=>$value_d['status'],
									  'G'.$counter=>(date("d-M-Y h:i a",strtotime($value_d['date'])))
									  );
					foreach($header_array1 as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					}
					$counter++;
				}
			}
			if($for=='payment'){
				
				$header_array = array('A1'=>'S.No',
									  'B1'=>'Name',
									  'C1'=>'Name in Bank',
									  'D1'=>'Bank Name',
									  'E1'=>'Account No.',
									  'F1'=>'Branch',
									  'G1'=>'IFSC',
									  'H1'=>'Date',
									  'I1'=>'Status',
									  'J1'=>'Username'
									  );
				foreach($header_array as $key => $value){
					$this->excel->getActiveSheet()->setCellValue($key, $value);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
				}
				
				$counter = 2;
			
				$this->load->model('payment_model');	
				$downloaded 	= $this->payment_model->get_all_payment();
				foreach($downloaded as $key_d => $value_d){
					
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['username'],
									  'C'.$counter=>$value_d['bankusername'],
									  'D'.$counter=>$value_d['bankname'],
									  'E'.$counter=>$value_d['accountno'],
									  'F'.$counter=>$value_d['branch'],
									  'G'.$counter=>$value_d['ifsc'],
									  'H'.$counter=>(date("d-M-Y h:i a",strtotime($value_d['date']))),
									  'I'.$counter=>(($value_d['status']==1)?"DONE":"Not DONE"),
									  'J'.$counter=>$value_d['admin']
									  );
					foreach($header_array1 as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					}
					$counter++;
				}
			}
			if($for=='offer'){
				
				set_time_limit(0);
				$header_array = array('A1'=>'S.No',
									  'B1'=>'Title',
									  'C1'=>'Offer By',
									  'D1'=>'Payout Type',
									  'E1'=>'Percent Payout',
									  'F1'=>'Default Payout',
									  'G1'=>'Cashback',
									  'H1'=>'Username',
									  'I1'=>'Date',
									  'J1'=>'Status'
									  
									  );
				foreach($header_array as $key => $value){
					$this->excel->getActiveSheet()->setCellValue($key, $value);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
				}
				
				$counter = 2;
			
				$this->load->model('offer_model');
				$downloaded 	= $this->offer_model->get_offer_all(false, false, false,false);
				foreach($downloaded as $key_d => $value_d){
					$sitename = 'hasoffer';
					$sitename = ($value_d['sitename']=='hasoffer'?"Vcommission":$value_d['sitename']);
					$date = (date("d-M Y h:i a",strtotime($value_d['date'])));
					$status = ($value_d['status']==1)?"Active":"De-active";
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['title'],
									  'C'.$counter=>$sitename,
									  'D'.$counter=>$value_d['payout_type'],
									  'E'.$counter=>$value_d['percent_payout'],
									  'F'.$counter=>$value_d['default_payout'],
									  'G'.$counter=>$value_d['discount']." ".$value_d['discount_type'],
									  'H'.$counter=>$value_d['admin'],
									  'I'.$counter=>$date,
									  'J'.$counter=>$status
									  );
					foreach($header_array1 as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					}
					$counter++;
				}
			}
			//echo $for;
			if($for=='product'){
				set_time_limit(0);
				$header_array = array('A1'=>'S.No',
									  'B1'=>'Title',
									  'C1'=>'Category',
									  'D1'=>'Description',
									  'E1'=>'Selling Price',
									  'F1'=>'Retail Price',
									  'G1'=>'Brand',
									  'H1'=>'Sitename',
									  'I1'=>'In Stock'
									  );
				foreach($header_array as $key => $value){
					$this->excel->getActiveSheet()->setCellValue($key, $value);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
				}
				
				$counter = 2;
			
				//echo "test";
				$this->load->model('product_model');	
				$downloaded 	= $this->product_model->get_all_product();
				//echo "test";
				//print_r($downloaded);
				//die;
				foreach($downloaded as $key_d => $value_d){
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['title'],
									  'C'.$counter=>$value_d['categoryName'],
									  'D'.$counter=>$value_d['description'],
									  'E'.$counter=>$value_d['selling_price'],
									  'G'.$counter=>$value_d['retail_price'],
									  'H'.$counter=>$value_d['brand'],
									  'I'.$counter=>$value_d['sitename'],
									  'J'.$counter=>$value_d['instock']
									  );
					foreach($header_array1 as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					}
					$counter++;
				}
			}
		}else{
			if($for=='discount'){
				
				$this->load->model('flipkartdiscount_model');
				$this->load->model('flipkartofferdiscount_model');
				$this->load->model('amazondiscount_model');
				$this->load->model('snapdealdiscount_model');
				
				if($get_data['for']=='flipkartdiscount'){
					$for = $get_data['for'];	
					$header_array = array('A1'=>'S.No',
										  'B1'=>'Category',
										  'C1'=>'Retailer',
										  'D1'=>'Discount Given',
										  'E1'=>'Discount By Us',
										  'F1'=>'Unit',
										  'G1'=>'Discount given for mobile',
										  'H1'=>'Discount given by us for mobile',
										  'I1'=>'Username');
					foreach($header_array as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
					}
					
					$counter = 2;
					$downloaded 	= $this->flipkartdiscount_model->get_all_flipkartdiscount($get_data['key']);
					foreach($downloaded as $key_d => $value_d){
						$header_array1 = array('A'.$counter=>$counter-1,
										  'B'.$counter=>$value_d['category'],
										  'C'.$counter=>"Flipkart",
										  'D'.$counter=>$value_d['discount_given'],
										  'E'.$counter=>$value_d['discount_by_us'],
										  'F'.$counter=>$value_d['discount_unit'],
										  'G'.$counter=>$value_d['discount_given_mobile'],
										  'H'.$counter=>$value_d['discount_by_us_mobile'],
										  'I'.$counter=>$value_d['admin']
										  );
						foreach($header_array1 as $key => $value){
							$this->excel->getActiveSheet()->setCellValue($key, $value);
							$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
						}
						$counter++;
					}
				}
				
				/*if($get_data['for']=='flipkartofferdiscount'){
					$downloaded 	= $this->flipkartofferdiscount_model->get_all_flipkartofferdiscount($get_data['key']);
					foreach($downloaded as $key_d => $value_d){
						$header_array1 = array('A'.$counter=>$counter-1,
										  'B'.$counter=>$value_d['category'],
										  'C'.$counter=>"Flipkart Offer",
										  'D'.$counter=>$value_d['discount_given'],
										  'E'.$counter=>$value_d['discount_by_us'],
										  'F'.$counter=>$value_d['discount_unit'],
										  'G'.$counter=>$value_d['discount_given_mobile'],
										  'H'.$counter=>$value_d['discount_by_us_mobile']
										  );
						foreach($header_array1 as $key => $value){
							$this->excel->getActiveSheet()->setCellValue($key, $value);
							$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
						}
						$counter++;
					}
				}*/
				if($get_data['for']=='amazondiscount'){
					$for = $get_data['for'];
					$header_array = array('A1'=>'S.No',
										  'B1'=>'Category',
										  'C1'=>'Retailer',
										  'D1'=>'Discount Given',
										  'E1'=>'Discount By Us',
										  'F1'=>'Unit',
										  'G1'=>'Username');
					foreach($header_array as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
					}
					
					$counter = 2;
					$downloaded 	= $this->amazondiscount_model->get_all_amazondiscount($get_data['key']);
					foreach($downloaded as $key_d => $value_d){
						$header_array1 = array('A'.$counter=>$counter-1,
										  'B'.$counter=>$value_d['category'],
										  'C'.$counter=>"Amazon",
										  'D'.$counter=>$value_d['discount_given'],
										  'E'.$counter=>$value_d['discount_by_us'],
										  'F'.$counter=>$value_d['discount_unit'],
										  'G'.$counter=>$value_d['admin']
										  );
						foreach($header_array1 as $key => $value){
							$this->excel->getActiveSheet()->setCellValue($key, $value);
							$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
						}
						$counter++;
					}
				}
				if($get_data['for']=='snapdealdiscount'){
					$for = $get_data['for'];
					$header_array = array('A1'=>'S.No',
										  'B1'=>'Category',
										  'C1'=>'Retailer',
										  'D1'=>'Discount Given',
										  'E1'=>'Discount By Us',
										  'F1'=>'Unit',
										  'G1'=>'Discount given for mobile',
										  'H1'=>'Discount given by us for mobile',
										  'I1'=>'Username');
					foreach($header_array as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
					}
					
					$counter = 2;
					$downloaded 	= $this->snapdealdiscount_model->get_all_snapdealdiscount($get_data['key']);
					foreach($downloaded as $key_d => $value_d){
						$header_array1 = array('A'.$counter=>$counter-1,
										  'B'.$counter=>$value_d['category'],
										  'C'.$counter=>"Snapdeal",
										  'D'.$counter=>$value_d['discount_given'],
										  'E'.$counter=>$value_d['discount_by_us'],
										  'F'.$counter=>"",
										  'G'.$counter=>$value_d['discount_given_mobile'],
										  'H'.$counter=>$value_d['discount_by_us_mobile'],
										  'I'.$counter=>$value_d['admin']
										  );
						foreach($header_array1 as $key => $value){
							$this->excel->getActiveSheet()->setCellValue($key, $value);
							$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
						}
						$counter++;
					}
				}
			}
			if($for=='brand'){
				$header_array = array('A1'=>'S.No',
									  'B1'=>'Brand',
									  'C1'=>'Category',
//									  'D1'=>'Discount',
									  'D1'=>'Status'
									  );
				foreach($header_array as $key => $value){
					$this->excel->getActiveSheet()->setCellValue($key, $value);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
				}
				
				$counter = 2;
			
				$this->load->model('brand_model');	
				$downloaded 	= $this->brand_model->get_all_main_brand($get_data['key']);
				foreach($downloaded as $key_d => $value_d){
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['brandName'],
									  'C'.$counter=>$value_d['parentName'],
									  //'D'.$counter=>$value_d['discount'],
									  'D'.$counter=>$value_d['status']
									  );
					foreach($header_array1 as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					}
					$counter++;
				}
			}
			if($for=='user'){
				$header_array = array('A1'=>'S.No',
									  'B1'=>'Name',
									  'C1'=>'Email',
									  'D1'=>'Mobile',
									  'E1'=>'Signup Mode',
									  'F1'=>'Earned',
									  'G1'=>'Username',
									  'H1'=>'Staus'
									  );
				foreach($header_array as $key => $value){
					$this->excel->getActiveSheet()->setCellValue($key, $value);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
				}
				
				$counter = 2;
			
				$this->load->model('users_model');	
				$downloaded 	= $this->users_model->get_all_user($get_data['key'],$get_data['from'],$get_data['to']);
				foreach($downloaded as $key_d => $value_d){
					$signup_mode = "";
					if($value_d['facebook']!=''){
						$signup_mode = 'Facebook';
					}elseif($value_d['twitter']!=''){
						$signup_mode = 'Twitter';
					}elseif($value_d['linkedin']!=''){
						$signup_mode = 'Linkedin';
					}elseif($value_d['gplus']!=''){
						$signup_mode = 'Google Plus';
					}else{
						$signup_mode = 'Email';
					}
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['username'],
									  'C'.$counter=>$value_d['email'],
									  'D'.$counter=>$value_d['mobile'],
									  'E'.$counter=>$signup_mode,
									  'F'.$counter=>round($value_d['payment'],2),
									  'G'.$counter=>$value_d['admin'],
									  'H'.$counter=>($value_d['status']=='1'?"Active":"De-active")
									  );
					foreach($header_array1 as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					}
					$counter++;
				}
			}
			if($for=='ticket'){
				$header_array = array('A1'=>'S.No',
									  'B1'=>'Ticket Id',
									  'C1'=>'Transection Id',
									  'D1'=>'Retailer',
									  'E1'=>'User',
									  'F1'=>'Amount',
									  'G1'=>'Description',
									  'H1'=>'IP',
									  'I1'=>'Status',
									  'J1'=>'Added Date',
									  'K1'=>'Closed Date',
									  'L1'=>'Transection Date',
									  'M1'=>'Username',
									  'N1'=>'Unique No.'
									  );
				foreach($header_array as $key => $value){
					$this->excel->getActiveSheet()->setCellValue($key, $value);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
				}
				
				$counter = 2;
			
				$this->load->model('ticket_model');	
				$downloaded 	= $this->ticket_model->get_all_ticket($get_data['key'],$get_data['from'],$get_data['to'],$get_data['order'],$get_data['orderfor']);
				foreach($downloaded as $key_d => $value_d){
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['ticket_id'],
									  'C'.$counter=>$value_d['transection_id'],
									  'D'.$counter=>$value_d['retailer'],
									  'E'.$counter=>$value_d['username'],
									  'F'.$counter=>$value_d['amount'],
									  'G'.$counter=>$value_d['description'],
									  'H'.$counter=>$value_d['ip'],
									  'I'.$counter=>(($value_d['status']==1)?"Closed":"Processing"),
									  'J'.$counter=>$value_d['added_date'],
									  'K'.$counter=>$value_d['close_date'],
									  'L'.$counter=>$value_d['date'],
									  'M'.$counter=>$value_d['admin'],
									  'N'.$counter=>$value_d['random']
									  );
					foreach($header_array1 as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					}
					$counter++;
				}
			}
			
			if($for=='contact'){
				
				$header_array = array('A1'=>'S.No',
									  'B1'=>'Name',
									  'C1'=>'Email',
									  'D1'=>'Topic',
									  'E1'=>'Description',
									  'F1'=>'Date',
									  'G1'=>'Replied',
									  'H1'=>'Username'
									  );
				foreach($header_array as $key => $value){
					$this->excel->getActiveSheet()->setCellValue($key, $value);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
				}
				
				$counter = 2;
			
				$this->load->model('contact_model');	
				$downloaded 	= $this->contact_model->get_all_contact($get_data['key'],$get_data['from'],$get_data['to'],$get_data['order'],$get_data['orderfor']);
				foreach($downloaded as $key_d => $value_d){
					
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['name'],
									  'C'.$counter=>$value_d['email'],
									  'D'.$counter=>$value_d['option'],
									  'E'.$counter=>$value_d['description'],
									  'F'.$counter=>(date("d-M-Y h:i a",strtotime($value_d['date']))),
									  'G'.$counter=>(($value_d['status']==1)?"Replied":"Not Replied"),
									  'H'.$counter=>$value_d['admin']
									  );
					foreach($header_array1 as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					}
					$counter++;
				}
				
			}
			
			
			if($for=='order'){
				
				$header_array = array('A1'=>'S.No',
									  'B1'=>'Order Id',
									  'C1'=>'Username',
									  'D1'=>'Amount',
									  'E1'=>'Sitename',
									  'F1'=>'Status',
									  'G1'=>'Date',
									  );
				foreach($header_array as $key => $value){
					$this->excel->getActiveSheet()->setCellValue($key, $value);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
				}
				
				$counter = 2;
			
				$this->load->model('order_model');	
				$downloaded 	= $this->order_model->get_all_order(false,$get_data['key'],$get_data['from'],$get_data['to'],$get_data['orderfor']);
				foreach($downloaded as $key_d => $value_d){
					
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['random'],
									  'C'.$counter=>$value_d['username'],
									  'D'.$counter=>$value_d['amount'],
									  'E'.$counter=>$value_d['sitename'],
									  'F'.$counter=>$value_d['orderStatus'],
									  'G'.$counter=>(date("d-M-Y h:i a",strtotime($value_d['date'])))
									  );
					foreach($header_array1 as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					}
					$counter++;
				}
			}
			if($for=='payment'){
				
				$header_array = array('A1'=>'S.No',
									  'B1'=>'Name',
									  'C1'=>'Name in Bank',
									  'D1'=>'Bank Name',
									  'E1'=>'Account No.',
									  'F1'=>'Branch',
									  'G1'=>'IFSC',
									  'H1'=>'Date',
									  'I1'=>'Status',
									  'J1'=>'Username'
									  );
				foreach($header_array as $key => $value){
					$this->excel->getActiveSheet()->setCellValue($key, $value);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
				}
				
				$counter = 2;
			
				$this->load->model('payment_model');	
				$downloaded 	= $this->payment_model->get_all_payment($get_data['key'],$get_data['from'],$get_data['to'],$get_data['order'],$get_data['orderfor']);
				foreach($downloaded as $key_d => $value_d){
					
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['username'],
									  'C'.$counter=>$value_d['bankusername'],
									  'D'.$counter=>$value_d['bankname'],
									  'E'.$counter=>$value_d['accountno'],
									  'F'.$counter=>$value_d['branch'],
									  'G'.$counter=>$value_d['ifsc'],
									  'H'.$counter=>(date("d-M-Y h:i a",strtotime($value_d['date']))),
									  'I'.$counter=>(($value_d['status']==1)?"DONE":"Not DONE"),
									  'J'.$counter=>$value_d['admin']
									  );
					foreach($header_array1 as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					}
					$counter++;
				}
			}
			if($for=='offer'){
				set_time_limit(0);
				$header_array = array('A1'=>'S.No',
									  'B1'=>'Title',
									  'C1'=>'Offer By',
									  'D1'=>'Payout Type',
									  'E1'=>'Percent Payout',
									  'F1'=>'Default Payout',
									  'G1'=>'Cashback',
									  'H1'=>'Username',
									  'I1'=>'Date',
									  'J1'=>'Status'
									  );
				foreach($header_array as $key => $value){
					$this->excel->getActiveSheet()->setCellValue($key, $value);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
				}
				
				$counter = 2;
		
				$this->load->model('offer_model');	
				$downloaded 	= $this->offer_model->get_offer_all($get_data['key'], $get_data['order'], $get_data['order_type'],$get_data['orderfor']);
				
				foreach($downloaded as $key_d => $value_d){
					$sitename = 'hasoffer';
					$sitename = ($value_d['sitename']=='hasoffer'?"Vcommission":$value_d['sitename']);
					$date = (date("d-M Y h:i a",strtotime($value_d['date'])));
					$status = ($value_d['status']==1)?"Active":"De-active";
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['title'],
									  'C'.$counter=>$sitename,
									  'D'.$counter=>$value_d['payout_type'],
									  'E'.$counter=>$value_d['percent_payout'],
									  'F'.$counter=>$value_d['default_payout'],
									  'G'.$counter=>$value_d['discount']." ".$value_d['discount_type'],
									  'H'.$counter=>$value_d['admin'],
									  'I'.$counter=>$date,
									  'J'.$counter=>$status
									  );
					foreach($header_array1 as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					}
					$counter++;
				}
			}
			//echo $for;
			if($for=='product'){
				set_time_limit(0);
				ini_set('memory_limit', '1024M');
				
				/*try {
					$error = 'Always throw this error';
					throw new Exception($error);
				
					// Code following an exception is not executed.
					echo 'Never executed';*/

				
					$header_array = array('A1'=>'S.No',
										  'B1'=>'Title',
										  'C1'=>'Category',
										  'D1'=>'Description',
										  'E1'=>'Selling Price',
										  'F1'=>'Retail Price',
										  'G1'=>'Brand',
										  'H1'=>'Sitename',
										  'I1'=>'In Stock'
										  );
					foreach($header_array as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
					}
					
					$counter = 2;
				
					//echo "test";
					$this->load->model('product_model');	
					$downloaded 	= $this->product_model->get_all_product($get_data['key'], $get_data['order'], $get_data['order_type'],$get_data['orderfor']);
					
					//echo "test";
					//print_r($downloaded);
					//die;
					foreach($downloaded as $key_d => $value_d){
						$header_array1 = array('A'.$counter=>$counter-1,
										  'B'.$counter=>$value_d['title'],
										  'C'.$counter=>$value_d['categoryName'],
										  'D'.$counter=>$value_d['description'],
										  'E'.$counter=>$value_d['selling_price'],
										  'F'.$counter=>$value_d['retail_price'],
										  'G'.$counter=>$value_d['brand'],
										  'H'.$counter=>$value_d['sitename'],
										  'I'.$counter=>$value_d['instock']
										  );
						foreach($header_array1 as $key => $value){
							$this->excel->getActiveSheet()->setCellValue($key, $value);
							$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
						}
						$counter++;
						//error_log($value_d['id']);
					}
				
				/*} catch (Exception $e) {
					echo "<pre>";
					print_r($e);
					echo 'Caught exception: ',  $e->getMessage(), "\n";
				}	*/
			}
		}
//		die;
		$filename = $for."_".date("dMy").'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: gattachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); 
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		$objWriter->save('php://output');	
	}
}