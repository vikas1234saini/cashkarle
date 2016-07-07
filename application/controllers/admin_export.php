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
				
				$header_array = array('A1'=>'S.No',
									  'B1'=>'Category',
									  'C1'=>'Retailer',
									  'D1'=>'Discount Given',
									  'E1'=>'Discount By Us',
									  'F1'=>'Unit',
									  'G1'=>'Discount given more than 2500',
									  'H1'=>'Discount given by us on more than 2500');
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
									  'G'.$counter=>"",
									  'H'.$counter=>""
									  );
					foreach($header_array1 as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					}
					$counter++;
				}
				
				$downloaded 	= $this->flipkartofferdiscount_model->get_all_flipkartofferdiscount();
				foreach($downloaded as $key_d => $value_d){
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['category'],
									  'C'.$counter=>"Flipkart Offer",
									  'D'.$counter=>$value_d['discount_given'],
									  'E'.$counter=>$value_d['discount_by_us'],
									  'F'.$counter=>$value_d['discount_unit'],
									  'G'.$counter=>"",
									  'H'.$counter=>""
									  );
					foreach($header_array1 as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					}
					$counter++;
				}
				$downloaded 	= $this->amazondiscount_model->get_all_amazondiscount();
				foreach($downloaded as $key_d => $value_d){
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['category'],
									  'C'.$counter=>"Amazon",
									  'D'.$counter=>$value_d['discount_given'],
									  'E'.$counter=>$value_d['discount_by_us'],
									  'F'.$counter=>$value_d['discount_unit']
									  //'G'.$counter=>"",
									  //'H'.$counter=>""
									  );
					foreach($header_array1 as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					}
					$counter++;
				}
				
				$downloaded 	= $this->snapdealdiscount_model->get_all_snapdealdiscount();
				foreach($downloaded as $key_d => $value_d){
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['category'],
									  'C'.$counter=>"Snapdeal",
									  'D'.$counter=>$value_d['discount_given'],
									  'E'.$counter=>$value_d['discount_by_us'],
									  'F'.$counter=>""
									//  'G'.$counter=>$value_d['discount_given_2500']
									  //'H'.$counter=>$value_d['discount_by_us_2500']
									  );
					foreach($header_array1 as $key => $value){
						$this->excel->getActiveSheet()->setCellValue($key, $value);
						$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					}
					$counter++;
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
									  'D1'=>'Mobile'
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
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['username'],
									  'C'.$counter=>$value_d['email'],
									  'D'.$counter=>$value_d['mobile']
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
									  'J1'=>'Status',
									  'I1'=>'Date'
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
									  'I'.$counter=>$value_d['date'],
									  'J'.$counter=>(($value_d['status']==1)?"Closed":"Processing")
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
									  'H1'=>'Username'
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
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['title'],
									  'C'.$sitename,
									  'D'.$counter=>$value_d['payout_type'],
									  'E'.$counter=>$value_d['percent_payout'],
									  'F'.$counter=>$value_d['default_payout'],
									  'G'.$counter=>$value_d['discount']." ".$value_d['discount_type'],
									  'H'.$counter=>$value_d['admin']
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
				
				$header_array = array('A1'=>'S.No',
									  'B1'=>'Category',
									  'C1'=>'Retailer',
									  'D1'=>'Discount Given',
									  'E1'=>'Discount By Us',
									  'F1'=>'Unit',
									  'G1'=>'Discount given more than 2500',
									  'H1'=>'Discount given by us on more than 2500');
				foreach($header_array as $key => $value){
					$this->excel->getActiveSheet()->setCellValue($key, $value);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
				}
				
				$counter = 2;
				if($get_data['for']=='flipkartdiscount'){
					$downloaded 	= $this->flipkartdiscount_model->get_all_flipkartdiscount($get_data['key']);
					foreach($downloaded as $key_d => $value_d){
						$header_array1 = array('A'.$counter=>$counter-1,
										  'B'.$counter=>$value_d['category'],
										  'C'.$counter=>"Flipkart",
										  'D'.$counter=>$value_d['discount_given'],
										  'E'.$counter=>$value_d['discount_by_us'],
										  'F'.$counter=>$value_d['discount_unit'],
										  'G'.$counter=>"",
										  'H'.$counter=>""
										  );
						foreach($header_array1 as $key => $value){
							$this->excel->getActiveSheet()->setCellValue($key, $value);
							$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
						}
						$counter++;
					}
				}
				
				if($get_data['for']=='flipkartofferdiscount'){
					$downloaded 	= $this->flipkartofferdiscount_model->get_all_flipkartofferdiscount($get_data['key']);
					foreach($downloaded as $key_d => $value_d){
						$header_array1 = array('A'.$counter=>$counter-1,
										  'B'.$counter=>$value_d['category'],
										  'C'.$counter=>"Flipkart Offer",
										  'D'.$counter=>$value_d['discount_given'],
										  'E'.$counter=>$value_d['discount_by_us'],
										  'F'.$counter=>$value_d['discount_unit'],
										  'G'.$counter=>"",
										  'H'.$counter=>""
										  );
						foreach($header_array1 as $key => $value){
							$this->excel->getActiveSheet()->setCellValue($key, $value);
							$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
						}
						$counter++;
					}
				}
				if($get_data['for']=='amazondiscount'){
					$downloaded 	= $this->amazondiscount_model->get_all_amazondiscount($get_data['key']);
					foreach($downloaded as $key_d => $value_d){
						$header_array1 = array('A'.$counter=>$counter-1,
										  'B'.$counter=>$value_d['category'],
										  'C'.$counter=>"Amazon",
										  'D'.$counter=>$value_d['discount_given'],
										  'E'.$counter=>$value_d['discount_by_us'],
										  'F'.$counter=>$value_d['discount_unit']
//										  'G'.$counter=>"",
	//									  'H'.$counter=>""
										  );
						foreach($header_array1 as $key => $value){
							$this->excel->getActiveSheet()->setCellValue($key, $value);
							$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
						}
						$counter++;
					}
				}
				if($get_data['for']=='snapdealdiscount'){
					$downloaded 	= $this->snapdealdiscount_model->get_all_snapdealdiscount($get_data['key']);
					foreach($downloaded as $key_d => $value_d){
						$header_array1 = array('A'.$counter=>$counter-1,
										  'B'.$counter=>$value_d['category'],
										  'C'.$counter=>"Snapdeal",
										  'D'.$counter=>$value_d['discount_given'],
										  'E'.$counter=>$value_d['discount_by_us'],
										  'F'.$counter=>""
										 // 'G'.$counter=>$value_d['discount_given_2500'],
										  //'H'.$counter=>$value_d['discount_by_us_2500']
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
				$downloaded 	= $this->brand_model->get_all_main_brand($get_data['key']);
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
									  'D1'=>'Mobile'
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
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['username'],
									  'C'.$counter=>$value_d['email'],
									  'D'.$counter=>$value_d['mobile']
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
									  'J1'=>'Status',
									  'I1'=>'Date'
									  );
				foreach($header_array as $key => $value){
					$this->excel->getActiveSheet()->setCellValue($key, $value);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setSize(12);
					$this->excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
				}
				
				$counter = 2;
			
				$this->load->model('ticket_model');	
				$downloaded 	= $this->ticket_model->get_all_ticket($get_data['key'],$get_data['from'],$get_data['to']);
				foreach($downloaded as $key_d => $value_d){
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['ticket_id'],
									  'C'.$counter=>$value_d['transection_id'],
									  'D'.$counter=>$value_d['retailer'],
									  'E'.$counter=>$value_d['username'],
									  'F'.$counter=>$value_d['amount'],
									  'G'.$counter=>$value_d['description'],
									  'H'.$counter=>$value_d['ip'],
									  'I'.$counter=>$value_d['date'],
									  'J'.$counter=>(($value_d['status']==1)?"Closed":"Processing")
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
									  'H1'=>'Username'
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
					$header_array1 = array('A'.$counter=>$counter-1,
									  'B'.$counter=>$value_d['title'],
									  'C'.$counter=>$sitename,
									  'D'.$counter=>$value_d['payout_type'],
									  'E'.$counter=>$value_d['percent_payout'],
									  'F'.$counter=>$value_d['default_payout'],
									  'G'.$counter=>$value_d['discount']." ".$value_d['discount_type'],
									  'H'.$counter=>$value_d['admin']
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
				}
			}
		}
		$filename = $for."_".date("dMy").'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: gattachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); 
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		$objWriter->save('php://output');	
	}
}