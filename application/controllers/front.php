<?php

class Front extends CI_Controller {
	
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();

    }
	
	function index() {
		
        $this->load->model('category_model');
        $this->load->model('product_model');
		$this->load->model('brand_model');
		$this->load->model('offer_model');
		
		$productlist = $this->product_model->get_rand_product();
		
		$data  = array();
		$cdata = array();
		
		$counter = 0;
		foreach($productlist as $product){
			$cdata[$counter]['productId'] 			= $product['product_main_id'];
			$cdata[$counter]['title'] 				= $product['title'];
			$cdata[$counter]['productDescription'] 	= $product['description'];
	
			$cdata[$counter]['productImage'] 		= $product['image'];
			$cdata[$counter]['sellingPrice'] 		= $product['selling_price'];
			$cdata[$counter]['productUrl'] 			= $product['url'];
			$cdata[$counter]['productBrand'] 		= $product['brand'];
			$cdata[$counter]['maximumRetailPrice']	= $product['retail_price'];
			$cdata[$counter]['id']					= $product['id'];
			$cdata[$counter]['sitename']			= $product['sitename'];
			
			$cat_details = $this->category_model->get_category_by_id($product['category']);
			if(sizeof($cat_details)>0){
				$cashback = 0;
				if($product['sitename']=='snapdeal'){
					//if($product['retail_price']>2500){
//						$cashback		= $cat_details[0]['snapdeal_discount_2500'];
//					}else{
//						$cashback		= $cat_details[0]['snapdeal_discount'];
//					}
					$cashback		= $cat_details[0]['snapdeal_discount'];
				}else if($product['sitename']=='flipkart'){
					$cashback		= $cat_details[0]['flipkart_discount'];
				}else if($product['sitename']=='amazon'){
					$cashback		= $cat_details[0]['amazon_discount'];
				}
								
				$cdata[$counter]['cashback']			= $cashback;
				$cdata[$counter]['category']			= $cat_details[0]['categoryName']!=""?$cat_details[0]['categoryName']:"Other";
			}else{
				$cdata[$counter]['cashback']			= 0;
				$cdata[$counter]['category']			= "Other";
			}
			$counter++;
		}
		
		$data['cdata'] 			= $cdata;
		$data['list'] 			= $this->category_model->get_all_parent_category();
		$data['listnew'] 		= $this->category_model->get_all_main_category();
		$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
		$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
		
		$data['offer'] = $this->offer_model->get_top_offer();

		$this->load->helper('data');
		$data['topuser'] = topuser();
		$data['popshow'] = "popshow";
		
        //load the view
        $data['main_content'] = 'front/index';
        $this->load->view('includes/front_template', $data);	
		
	}
	function prductlist() {
		
        $this->load->model('category_model');
        $this->load->model('brand_model');
		
		$params = array('accessKey' => AMZ_accessKey, 'secretKey' => AMZ_secretKey, 'country' => AMZ_country, 'associateTag' => AMZ_associateTag);
		$this->load->library('AmazonECS', $params);
		$client = new AmazonECS($params);
		
		$params1 = array('affiliateId' => FLIPKART_affiliateId, 'token' => FLIPKART_token, 'response_type' => FLIPKART_response_type);
		$this->load->library('Flipkart', $params1);
		$flipkart = new Flipkart($params1);
		
		$flist = $this->category_model->get_rand_category();
		$fdetails = array();
		$sdetails = array();
		$first_cat = 6;
		foreach ($flist as $key => $data) {
			$fdetails = $flipkart->call_url($data['flipkartUrl']);	
			$sdetails = $flipkart->snapdeal_call_url($data['snapdealUrl']);	
			$first_cat = $data['id'];
		}
		$data  = array();
		$cdata = array();
		
		$data['first_cat'] = $first_cat;
		
		$counter = 0;
		if(isset($fdetails['productInfoList'])){
			foreach($fdetails['productInfoList'] as $product){
				if($counter>=2){
					break;
				}
				$cdata[$counter]['productId'] 			= $product['productBaseInfo']['productIdentifier']['productId'];
				$cdata[$counter]['title'] 				= $product['productBaseInfo']['productAttributes']['title'];
				$cdata[$counter]['productDescription'] 	= $product['productBaseInfo']['productAttributes']['productDescription'];
		
				$cdata[$counter]['productImage'] 		= array_key_exists('200x200', $product['productBaseInfo']['productAttributes']['imageUrls'])?$product['productBaseInfo']['productAttributes']['imageUrls']['200x200']:'';
				$cdata[$counter]['sellingPrice'] 		= $product['productBaseInfo']['productAttributes']['sellingPrice']['amount'];
				$cdata[$counter]['productUrl'] 			= $product['productBaseInfo']['productAttributes']['productUrl'];
				$cdata[$counter]['productBrand'] 		= $product['productBaseInfo']['productAttributes']['productBrand'];
				$cdata[$counter]['maximumRetailPrice']	= $product['productBaseInfo']['productAttributes']['maximumRetailPrice']['amount'];
				$counter++;
			}
		}
		if(isset($sdetails['products'])){
			foreach($sdetails['products'] as $product){
				if($counter>=4){
					break;
				}
				$cdata[$counter]['productId'] 			= $product['id'];
				$cdata[$counter]['title'] 				= $product['title'];
				$cdata[$counter]['productDescription'] 	= $product['description'];
		
				$cdata[$counter]['productImage'] 		= $product['imageLink'];
				$cdata[$counter]['sellingPrice'] 		= $product['mrp'];
				$cdata[$counter]['productUrl'] 			= $product['link'];
				$cdata[$counter]['productBrand'] 		= $product['brand'];
				$cdata[$counter]['maximumRetailPrice']	= $product['offerPrice'];
				
				$counter++;
			}
		}
		$data_array = array('PHP','Shoes','cloth','book','new','mobile','TV');
		shuffle ($data_array);
		$amazon_response  = $client->category('All')->responseGroup('Large')->search($data_array[0]);
		
		foreach($amazon_response->Items->Item as $product){
			if($counter>=8){
				break;
			}
			$cdata[$counter]['productId'] 			= $product->ASIN;
			$cdata[$counter]['title'] 				= $product->ItemAttributes->Title;
			$cdata[$counter]['productDescription'] 	= $product->ItemAttributes->Title;
	
			$cdata[$counter]['productImage'] 		= $product->MediumImage->URL;
			$cdata[$counter]['sellingPrice'] 		= $product->ItemAttributes->ListPrice->Amount/100;
			$cdata[$counter]['productUrl'] 			= $product->DetailPageURL;
			$cdata[$counter]['productBrand'] 		= $product->ItemAttributes->Manufacturer;
			$cdata[$counter]['maximumRetailPrice']	= $product->OfferSummary->LowestNewPrice->Amount/100;
			
			$counter++;
		}
		$data['cdata'] 		= $cdata;
		$data['list'] 		= $this->category_model->get_all_parent_category();
		$data['listnew'] 	= $this->category_model->get_all_main_category();
		$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
		$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
		
		$offer = array();
		
		$offerdetails = $flipkart->hasoffer_call_url();	
		// Print out the response details
		if($offerdetails['response']['status'] === 1) {
			$data['offer'] = $offerdetails['response']['data'];
		} else {
			$error = $offerdetails['response']['data'];
		}
		
		$this->load->helper('data');
		$data['topuser'] = topuser();
        //load the view
        $data['main_content'] = 'front/index';
        $this->load->view('includes/front_template', $data);	
	}
	function mailtest(){
		$this->load->library('email');
		$this->email->set_mailtype('html');
		$this->email->from('info@cashkarle.com', 'cashkarle');
		$this->email->to("vikas1234saini@gmail.com"); 
		//$this->email->cc('vikas1234saini@gmail.com');  
		$this->email->set_mailtype('html');
		
		$this->email->subject('Your cashkarle.com Password');
		$this->email->message("<br /><br />Welcome to <a href='".base_url()."'>cashkarle.com</a> !<br />Your Password is ");	
		
		if($this->email->send()){
			$arr = array('status' => 1);
		}else{
			$arr = array('status' => 0,'error'=>'There is some issue in recover password. Please contact cashkale team.','errorinfo'=>$this->email->print_debugger());
		}
		echo json_encode( $arr );
		echo "<br />";
		$to = "vikas1234saini@gmail.com";
		$subject = "HTML email";
		
		$message = "
		<html>
		<head>
		<title>HTML email</title>
		</head>
		<body>
		<p>This email contains HTML Tags!</p>
		<table>
		<tr>
		<th>Firstname</th>
		<th>Lastname</th>
		</tr>
		<tr>
		<td>John</td>
		<td>Doe</td>
		</tr>
		</table>
		</body>
		</html>
		";
		
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		// More headers
		$headers .= 'From: <admin@cashkarle.com>' . "\r\n";
//		$headers .= 'Cc: myboss@example.com' . "\r\n";
		
		if(mail($to,$subject,$message,$headers)){
			echo "sent";
		}else{
			echo "not sent";	
		}
	}
}