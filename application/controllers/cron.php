<?php
class Cron extends CI_Controller {
	
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();

    }
	function addproduct($id) {
		
		set_time_limit(0);
		$this->load->model('category_model');
        $this->load->model('brand_model');
		
		$params = array('accessKey' => AMZ_accessKey, 'secretKey' => AMZ_secretKey, 'country' => AMZ_country, 'associateTag' => AMZ_associateTag);
		$this->load->library('AmazonECS', $params);
		$client = new AmazonECS($params);
		
		$params1 = array('affiliateId' => FLIPKART_affiliateId, 'token' => FLIPKART_token, 'response_type' => FLIPKART_response_type);
		$this->load->library('Flipkart', $params1);
		$flipkart = new Flipkart($params1);
		
		$flist = $this->category_model->get_category_by_id($id);
		echo "<pre>";
		print_r($flist);
		
		$add_count = 0 ;
		foreach ($flist as $key => $data) {
				
			$fdetails = array();
			$sdetails = array();			
			$cdata = array();
			$counter = 0;
			
			if($data['flipkartUrl']!=''){
				$fdetails = $flipkart->call_url($data['flipkartUrl']);	
			}
			if($data['snapdealUrl']!=''){
				$sdetails = $flipkart->snapdeal_call_url($data['snapdealUrl']);	
			}
			if(isset($fdetails['productInfoList'])){
				foreach($fdetails['productInfoList'] as $product){
					$cdata['product_main_id'] 	= $product['productBaseInfo']['productIdentifier']['productId'];
					$cdata['title'] 			= $product['productBaseInfo']['productAttributes']['title'];
					$cdata['description'] 		= $product['productBaseInfo']['productAttributes']['productDescription'];
			
					$cdata['image'] 			= array_key_exists('200x200', $product['productBaseInfo']['productAttributes']['imageUrls'])?$product['productBaseInfo']['productAttributes']['imageUrls']['200x200']:'';
					$cdata['selling_price'] 	= $product['productBaseInfo']['productAttributes']['sellingPrice']['amount'];
					$cdata['url'] 				= $product['productBaseInfo']['productAttributes']['productUrl'];
					$cdata['brand'] 			= $product['productBaseInfo']['productAttributes']['productBrand'];
					$cdata['retail_price']		= $product['productBaseInfo']['productAttributes']['maximumRetailPrice']['amount'];
					$cdata['sitename']			= "flipkart";
					$cdata['category']			= $data['id'];
					
					$this->db->select('id');
					$this->db->from('tbl_product');
					$this->db->where('product_main_id',$product['productBaseInfo']['productIdentifier']['productId']);
					$this->db->where('sitename',"flipkart");
					$query = $this->db->get();	
					
					
					if( $query->num_rows() == 0){
						$cdata['date'] = date('Y-m-d H:i:s');
						$this->db->insert('tbl_product', $cdata);
						$add_count++;
					}else{
						$this->db->where('product_main_id',$product['productBaseInfo']['productIdentifier']['productId']);
						$this->db->where('sitename',"flipkart");
						$this->db->update('tbl_product', $cdata);
					}
					
		//			$counter++;
				}
			}
			if(isset($sdetails['products'])){
				foreach($sdetails['products'] as $product){
					$cdata['product_main_id']	= $product['id'];
					$cdata['title'] 			= $product['title'];
					$cdata['description'] 	= $product['description'];
			
					$cdata['image'] 			= $product['imageLink'];
					$cdata['selling_price'] 	= $product['offerPrice'];
					$cdata['url'] 			= $product['link'];
					$cdata['brand'] 			= $product['brand'];
					$cdata['retail_price']	= $product['mrp'];
					$cdata['sitename']		= "snapdeal";
					$cdata['category']		= $data['id'];
					
					//$this->db->insert('tbl_product', $cdata);
					
					$this->db->select('id');
					$this->db->from('tbl_product');
					$this->db->where('product_main_id',$product['id']);
					$this->db->where('sitename',"snapdeal");
					$query = $this->db->get();	
					
					
					if( $query->num_rows() == 0){
						$cdata['date'] = date('Y-m-d H:i:s');
						$this->db->insert('tbl_product', $cdata);
						$add_count++;
					}else{
						$this->db->where('product_main_id',$product['id']);
						$this->db->where('sitename',"snapdeal");
						$this->db->update('tbl_product', $cdata);
					}
//					$counter++;
				}
			}
		}
		$add_data = array();
		$add_data['for'] = 'product';
		$add_data['date'] = date('Y-m-d H:i:s');
		$add_data['added'] = $add_count;
		$this->db->insert('tbl_log',$add_data);
/*		$offer = array();
		
		$offerdetails = $flipkart->hasoffer_call_url();	
		// Print out the response details
		if($offerdetails['response']['status'] === 1) {
			$data['offer'] = $offerdetails['response']['data'];
		} else {
			$error = $offerdetails['response']['data'];
		}
*/	
	}
	
	
	function addoffer($id) {
		$this->load->model('category_model');
        $this->load->model('brand_model');
		
		$params = array('accessKey' => AMZ_accessKey, 'secretKey' => AMZ_secretKey, 'country' => AMZ_country, 'associateTag' => AMZ_associateTag);
		$this->load->library('AmazonECS', $params);
		$client = new AmazonECS($params);
		
		$params1 = array('affiliateId' => FLIPKART_affiliateId, 'token' => FLIPKART_token, 'response_type' => FLIPKART_response_type);
		$this->load->library('Flipkart', $params1);
		$flipkart = new Flipkart($params1);
		
		
		$offer = array();
		
		$offerdetails = $flipkart->hasoffer_call_url();	
		echo "<pre>";
		print_r($offerdetails);
		echo "</pre>";
		die;
		// Print out the response details
		if($offerdetails['response']['status'] === 1) {
			$offer = $offerdetails['response']['data'];
		} else {
			$error = $offerdetails['response']['data'];
		}
		$add_count = 0 ;
		if(sizeof($offer)>0){
			foreach($offer as $key => $value){		 
			
				
				if(isset($value['Offer']) && $value['Offer']['id']!=''){
			
					$this->db->select('id');
					$this->db->from('tbl_offer');
					$this->db->where('main_id',$value['Offer']['id']);
					$this->db->where('sitename',"hasoffer");
					$query = $this->db->get();	
						
					$cdata['main_id']						= $value['Offer']['id'];
					$cdata['title'] 						= $value['Offer']['name'];
					$cdata['description'] 					= $value['Offer']['description'];
					$cdata['payout_type'] 					= $value['Offer']['payout_type'];
					$cdata['percent_payout'] 				= $value['Offer']['percent_payout'];
					$cdata['expiration_date'] 				= $value['Offer']['expiration_date'];
					$cdata['default_payout'] 				= $value['Offer']['default_payout'];
					$cdata['terms_and_conditions'] 			= $value['Offer']['terms_and_conditions'];
					$cdata['require_terms_and_conditions'] 	= $value['Offer']['require_terms_and_conditions'];
//					$cdata['image'] 						= $image_link;
	//				$cdata['url'] 							= $ref_url;
					$cdata['sitename']						= "hasoffer";	
					
					if( $query->num_rows() == 0){
						$cdata['date'] = date('Y-m-d H:i:s');
						$this->db->insert('tbl_offer', $cdata);
						$add_count++;
					}else{
						$this->db->where('main_id',$value['Offer']['id']);
						$this->db->update('tbl_offer', $cdata);
						
					}
				}
				
			}
		}
		
		$add_data = array();
		$add_data['for'] = 'Offer Retailer';
		$add_data['date'] = date('Y-m-d H:i:s');
		$add_data['added'] = $add_count;
		$this->db->insert('tbl_log',$add_data);
		die;
	}
	function updateofferurl(){
		
		set_time_limit(0);
		$this->load->model('offer_model');
		$alloffer  	= $this->offer_model->get_just_all_offer();
		$add_count = 0 ;
		foreach($alloffer as $key=>$value){
			if($value['main_id']!=''){
			// Specify method arguments
				$args = array(
					'NetworkId' => 'vcm',
					'Target' => 'Affiliate_Offer',
					'Method' => 'generateTrackingLink',
					'api_key' => HASOFFERS_API_KEY,
					'offer_id' => $value['main_id']
				);
		
				// Initialize cURL
				$curlHandle = curl_init();
			 
				// Configure cURL request
				curl_setopt($curlHandle, CURLOPT_URL, HASOFFERS_API_URL . '?' . http_build_query($args));		 
				// Make sure we can access the response when we execute the call
				curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($curlHandle, CURLOPT_TIMEOUT, 3600);
			 
				// Execute the API call
				$jsonEncodedApiResponse = curl_exec($curlHandle);
			 
				// Ensure HTTP call was successful
				if($jsonEncodedApiResponse === false) {
					throw new \RuntimeException(
						'API call failed with cURL error: ' . curl_error($curlHandle)
					);
				}
			 
				// Clean up the resource now that we're done with cURL
				curl_close($curlHandle);
			 
				// Decode the response from a JSON string to a PHP associative array
				$apiResponse = json_decode($jsonEncodedApiResponse, true);
			 
				// Make sure we got back a well-formed JSON string and that there were no
				// errors when decoding it
				$jsonErrorCode = json_last_error();
				if($jsonErrorCode !== JSON_ERROR_NONE) {
					throw new \RuntimeException(
						'API response not well-formed (json error code: ' . $jsonErrorCode . ')'
					);
				}
				
				$ref_url = "";
				// Print out the response details
				if($apiResponse['response']['status'] === 1) {
					$ref_url = $apiResponse['response']['data']['click_url'];
				} else {
					$error_ref = $apiResponse['response']['data'];
				}
				if($ref_url!=''){
					// Specify API URL
					$cdata = array();
					$cdata['url'] 	= $ref_url;
				
					$this->db->where('main_id',$value['main_id']);
					$this->db->update('tbl_offer', $cdata);			
				}
			}
		}
	}
	function updateofferimage(){
		set_time_limit(0);
		$this->load->model('offer_model');
		$alloffer  	= $this->offer_model->get_just_all_offer();
		foreach($alloffer as $key=>$value){
			if($value['main_id']!=''){
			 
				// Specify method arguments
				$args = array(
					'NetworkId' => 'vcm',
					'Target' => 'Affiliate_Offer',
					'Method' => 'getThumbnail',
					'api_key' => HASOFFERS_API_KEY,
					'ids' => array(
						$value['main_id']
					)
				);
				
				// Initialize cURL
				$curlHandle = curl_init();
			 
				// Configure cURL request
				curl_setopt($curlHandle, CURLOPT_URL, HASOFFERS_API_URL . '?' . http_build_query($args));
			 
				// Make sure we can access the response when we execute the call
				curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($curlHandle, CURLOPT_TIMEOUT, 3600);
			 
				// Execute the API call
				$jsonEncodedApiResponse = curl_exec($curlHandle);
			 
				// Ensure HTTP call was successful
				if($jsonEncodedApiResponse === false) {
					throw new \RuntimeException(
						'API call failed with cURL error: ' . curl_error($curlHandle)
					);
				}
			 
				// Clean up the resource now that we're done with cURL
				curl_close($curlHandle);
			 
				// Decode the response from a JSON string to a PHP associative array
				$apiResponse = json_decode($jsonEncodedApiResponse, true);
			 
				// Make sure we got back a well-formed JSON string and that there were no
				// errors when decoding it
				$jsonErrorCode = json_last_error();
				if($jsonErrorCode !== JSON_ERROR_NONE) {
					throw new \RuntimeException(
						'API response not well-formed (json error code: ' . $jsonErrorCode . ')'
					);
				}
			
				$image_url = array();
				// Print out the response details
				if(sizeof($apiResponse['response']['data'])>0 && $apiResponse['response']['status'] === 1) {
					$image_url = $apiResponse['response']['data'][0]['Thumbnail'];
				} else {
					$error_image = $apiResponse['response']['data'];
				}
				
				$image_link = "";
				foreach($image_url as $data){
					$image_link = $data['url'];
				}
				if($image_link!=''){
					// Specify API URL
					$cdata = array();
					$cdata['image'] 	= $image_link;
				
					$this->db->where('main_id',$value['main_id']);
					$this->db->update('tbl_offer', $cdata);			
				}
			}
		}
	}
	function getoffer($for=false){
		$this->load->model('category_model');
        $this->load->model('brand_model');
		
//		$params = array('accessKey' => AMZ_accessKey, 'secretKey' => AMZ_secretKey, 'country' => AMZ_country, 'associateTag' => AMZ_associateTag);
	//	$this->load->library('AmazonECS', $params);
		//$client = new AmazonECS($params);
		
		$params1 = array('affiliateId' => FLIPKART_affiliateId, 'token' => FLIPKART_token, 'response_type' => FLIPKART_response_type);
		$this->load->library('Flipkart', $params1);
		$flipkart = new Flipkart($params1);
		
		$furl = 'https://affiliate-api.flipkart.net/affiliate/offers/v1/dotd/json';
		
		$fdetails = $flipkart->call_url($furl);	
		$add_count = 0 ;
		if(isset($fdetails['dotdList'])){
			foreach($fdetails['dotdList'] as $key=>$value){
				echo "<pre>";
				print_r($value);
				echo "</pre>";
				/*$cdata['main_id']		= "";
				$cdata['title'] 		= $value['title'];
				$cdata['description'] 	= $value['description'];
				$cdata['image'] 		= isset($value['imageUrls'])?$value['imageUrls'][1]['url']:"";
				$cdata['url'] 			= $value['url'];
				$cdata['sitename']		= "flipkart";*/
				
				$cdata =	array();
//				$cdata['promo_id'] 				= $value['promo_id'];
				$cdata['offer_id'] 				= '412';
				$cdata['offer_name'] 			= $value['title'];
				$cdata['coupon_title'] 			= $value['title'];
				$cdata['coupon_description'] 	= $value['description'];
				$cdata['link'] 					= $value['url'];
				$cdata['category'] 				= isset($value['category'])?$value['category']:"";
				$cdata['coupon_expiry'] 		= date('Y-m-d',strtotime("+15 day"));
				$cdata['added'] 				= date('Y-m-d');
				
				$this->db->select('id');
				$this->db->from('tbl_coupon');
				$this->db->where('coupon_title',$cdata['coupon_title']);
//				$this->db->where('link',$cdata['url']);
				$this->db->where('offer_id',"412");
				$query = $this->db->get();
				if( $query->num_rows()==0){
					
					$cdata['date'] = date('Y-m-d H:i:s');
					$this->db->insert('tbl_coupon', $cdata);
					echo "insert<br />";
					$add_count++;
				}else{
					$this->db->where('coupon_title',$cdata['coupon_title']);
	//				$this->db->where('link',$cdata['url']);
					$this->db->where('offer_id',"412");					
					$this->db->update('tbl_coupon', $cdata);
					echo "update<br />";
				}
	
			}
		}
		
		$add_data = array();
		$add_data['for'] = 'flipkart coupon';
		$add_data['date'] = date('Y-m-d H:i:s');
		$add_data['added'] = $add_count;
		$this->db->insert('tbl_log',$add_data);
		
	}
	function getcoupon($id=false){
		
		set_time_limit(0);
		$curlHandle = curl_init();
			 
		// Configure cURL request
		curl_setopt($curlHandle, CURLOPT_URL, "http://tools.vcommission.com/addons/coupons_list.php?aff_id=34214");
	 
		// Make sure we can access the response when we execute the call
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, TRUE);
	 
		// Execute the API call
		$jsonEncodedApiResponse = curl_exec($curlHandle);
	 
		// Ensure HTTP call was successful
		if($jsonEncodedApiResponse === false) {
			throw new \RuntimeException(
				'API call failed with cURL error: ' . curl_error($curlHandle)
			);
		}
	 
		// Clean up the resource now that we're done with cURL
		curl_close($curlHandle);
	 
		// Decode the response from a JSON string to a PHP associative array
		$apiResponse = json_decode($jsonEncodedApiResponse, true);
	 
		// Make sure we got back a well-formed JSON string and that there were no
		// errors when decoding it
		$jsonErrorCode = json_last_error();
		if($jsonErrorCode !== JSON_ERROR_NONE) {
			throw new \RuntimeException(
				'API response not well-formed (json error code: ' . $jsonErrorCode . ')'
			);
		}	
	///	echo "<pre>";
//		print_r($apiResponse);
		//echo "</pre>";
		$add_count = 0 ;
		if(sizeof($apiResponse)>0){
			foreach($apiResponse as $key => $value){		 
				$this->db->select('id');
				$this->db->from('tbl_coupon');
				$this->db->where('promo_id',$value['promo_id']);
				$query = $this->db->get();
				
				$cdata =	array();
				$cdata['exclusive']				= $value['exclusive'];
				$cdata['featured'] 				= $value['featured'];
				$cdata['promo_id'] 				= $value['promo_id'];
				$cdata['offer_id'] 				= $value['offer_id'];
				$cdata['offer_name'] 			= $value['offer_name'];
				$cdata['coupon_title'] 			= $value['coupon_title'];
				$cdata['category'] 				= $value['category'];
				$cdata['coupon_description'] 	= $value['coupon_description'];
				$cdata['coupon_type'] 			= $value['coupon_type'];
				$cdata['coupon_code'] 			= $value['coupon_code'];
				$cdata['link'] 					= $value['link'];
				$cdata['coupon_expiry'] 		= $value['coupon_expiry'];
				$cdata['added'] 				= $value['added'];
				
				if( $query->num_rows()==0){
					$this->db->insert('tbl_coupon', $cdata);
					$add_count++;
				}elseif($value['coupon_expiry']>=date('Y-m-d')){
					$this->db->where('promo_id',$value['promo_id']);
					$this->db->update('tbl_coupon', $cdata);
				}
				
			}
		}
		
		$add_data = array();
		$add_data['for'] = 'coupon';
		$add_data['date'] = date('Y-m-d H:i:s');
		$add_data['added'] = $add_count;
		$this->db->insert('tbl_log',$add_data);
	}
	function updatecategory(){
		
		set_time_limit(0);
		$this->load->model('category_model');
        $this->load->model('brand_model');
		
		$params = array('accessKey' => AMZ_accessKey, 'secretKey' => AMZ_secretKey, 'country' => AMZ_country, 'associateTag' => AMZ_associateTag);
		$this->load->library('AmazonECS', $params);
		$client = new AmazonECS($params);
		
		$params1 = array('affiliateId' => FLIPKART_affiliateId, 'token' => FLIPKART_token, 'response_type' => FLIPKART_response_type);
		$this->load->library('Flipkart', $params1);
		$flipkart = new Flipkart($params1);
				
		$home = $flipkart->api_home();
		$home = json_decode($home, TRUE);
		
		$list = $home['apiGroups']['affiliate']['apiListings'];
		//echo "<pre>";
		//print_r($list);
		
		$json = file_get_contents('http://affiliate-feeds.snapdeal.com/feed/74971.json');
		$obj = json_decode($json);
		
		$list_s = $obj->apiGroups->Affiliate->listingsAvailable;
		//print_r($list_s);
		$add_count = 0 ;			
		foreach ($list as $key => $data) {
			foreach ($list_s as $key1 => $data1) {
	//				echo $data['availableVariants']['v0.1.0']['get']."==".$data1->listingVersions->v1->get;
				if(strtolower($key)==strtolower($key1)){
					$sql = "SELECT id FROM tbl_category where categoryName='".ucfirst(strtolower(str_replace("_"," ",$key1)))."'";
					$result = $this->db->query($sql);
					
					if ($result->num_rows == 0) {					
						$sql = "INSERT INTO tbl_category (categoryName, snapdealUrl, snapdealName, flipkartUrl, flipkartName, amazonUrl, amazonName) VALUES ('".ucfirst(strtolower(str_replace("_"," ",$key1)))."', '".$data1->listingVersions->v1->get."', '".$key1."', '".$data['availableVariants']['v0.1.0']['get']."', '".$key."','','')";	
						echo $sql."<br />";
						$this->db->query($sql);
						$add_count++;
					}else{
						$row = $result->result_array();
						$sql = "Update tbl_category set snapdealUrl='".$data1->listingVersions->v1->get."', snapdealName='".$key1."', flipkartUrl='".$data['availableVariants']['v0.1.0']['get']."', flipkartName='".$key."' where id='".ucfirst(strtolower(str_replace("_"," ",$row[0]['id'])))."'";
						echo $sql."<br />";
						$this->db->query($sql);
					}
				}		
			}
			
		}
		foreach ($list_s as $key1 => $data1) {
			$sql = "SELECT id FROM tbl_category where categoryName='".ucfirst(strtolower(str_replace("_"," ",$key1)))."'";
			$result = $this->db->query($sql);
			
			if ($result->num_rows == 0) {					
				$sql = "INSERT INTO tbl_category (categoryName, snapdealUrl, snapdealName, flipkartUrl, flipkartName, amazonUrl, amazonName) VALUES ('".ucfirst(strtolower(str_replace("_"," ",$key1)))."', '".$data1->listingVersions->v1->get."', '".$key1."', '', '','','')";	
				echo $sql."<br />";
				$this->db->query($sql);
				$add_count++;
			}else{
				$row = $result->result_array();
				$sql = "Update tbl_category set snapdealUrl='".$data1->listingVersions->v1->get."', snapdealName='".$key1."' where id='".ucfirst(strtolower(str_replace("_"," ",$row[0]['id'])))."'";
				echo $sql."<br />";
				$this->db->query($sql);
			}
		}
		foreach ($list as $key => $data) {
			$sql = "SELECT id FROM tbl_category where categoryName='".ucfirst(strtolower(str_replace("_"," ",$key)))."'";
			$result = $this->db->query($sql);
			
			if ($result->num_rows == 0) {					
				$sql = "INSERT INTO tbl_category (categoryName, snapdealUrl, snapdealName, flipkartUrl, flipkartName, amazonUrl, amazonName) VALUES ('".ucfirst(strtolower(str_replace("_"," ",$key)))."', '', '', '".$data['availableVariants']['v0.1.0']['get']."', '".$key."','','')";	
				echo $sql."<br />";
				
				$this->db->query($sql);
				$add_count++;
			}else{
				$row = $result->result_array();
				$sql = "Update tbl_category set flipkartUrl='".$data['availableVariants']['v0.1.0']['get']."', flipkartName='".$key."' where id='".ucfirst(strtolower(str_replace("_"," ",$row[0]['id'])))."'";
				echo $sql."<br />";
				$this->db->query($sql);
			}
		}
		
		$add_data = array();
		$add_data['for'] = 'category';
		$add_data['date'] = date('Y-m-d H:i:s');
		$add_data['added'] = $add_count;
		$this->db->insert('tbl_log',$add_data);
	//	print_r($list_s);
		die;
	}
	function flipkartorder($status='tentative'){
		$params1 = array('affiliateId' => FLIPKART_affiliateId, 'token' => FLIPKART_token, 'response_type' => FLIPKART_response_type);
		$this->load->library('Flipkart', $params1);
		$flipkart = new Flipkart($params1);
		$url = 'https://affiliate-api.flipkart.net/affiliate/report/orders/detail/json?startDate='.date('Y-m-d',strtotime('-30 days')).'&endDate='.date('Y-m-d').'&status='.$status.'&offset=0';
echo $url ;
		$fdetails = $flipkart->call_url($url);
		print_r($fdetails);
		$add_count = 0 ;
		foreach($fdetails['orderList'] as $key=>$value){
//		if($value['affExtParam1']=='26'){				
			$this->db->select('id');
			$this->db->from('tbl_order');
			$this->db->where('random',$value['affExtParam2']);
			$this->db->where('user_id',$value['affExtParam1']);
	//		$this->db->where('main_id',$value['productId']);
		//	$this->db->where('sitename',"flipkart");
			$query = $this->db->get();	
			
			$this->db->select('*');
			$this->db->from('tbl_linkgo');
			$this->db->where('random',$value['affExtParam2']);
			$this->db->where('user_id',$value['affExtParam1']);
			//$this->db->where('sitename',"flipkart");
			$golink_data_query = $this->db->get();
			$golink_data = $golink_data_query->result_array();	
			$new_discount = 0;
			
			if(sizeof($golink_data)>0){
				$amount	= isset($value['sales'])?$value['sales']['amount']:$value['price'];
				$discount_g = (($golink_data[0]['discount']!='')?$golink_data[0]['discount']:0);
				$pamount = (($amount*$discount_g)/100);
				if($pamount<$value['tentativeCommission']['amount']){
					$new_discount = $pamount;
				}
			}
			if( $query->num_rows() == 0){
				$cdata = array();
				$cdata['user_id'] 			= $value['affExtParam1'];
				$cdata['main_id'] 			= $value['productId'];
				$cdata['date'] 				= date("Y-m-d H:i:s",strtotime($value['orderDate']));
				$cdata['sitename']			= 'flipkart';
				$cdata['commissionRate']	= $value['commissionRate'];
				$cdata['discount']			= $value['tentativeCommission']['amount'];
				$cdata['amount']			= isset($value['sales'])?$value['sales']['amount']:$value['price'];
				$cdata['price']				= $value['price'];
				$cdata['random']			= $value['affExtParam2'];
				$cdata['orderStatus'] 		= $value['status'];
				$cdata['discount_by_cashkarle'] 		= $new_discount;
				
				$this->db->insert('tbl_order', $cdata);
				$add_count++;
			}else{			
				$cdata = array();
				$cdata['orderStatus'] 		= $value['status'];
				$cdata['amount']			= isset($value['sales'])?$value['sales']['amount']:$value['price'];
				$cdata['discount_by_cashkarle'] 		= $new_discount;
				
				echo $cdata['amount']."<br />";
				$this->db->where('random',$value['affExtParam2']);
				$this->db->where('user_id',$value['affExtParam1']);
				$this->db->where('main_id',$value['productId']);
				$this->db->where('sitename',"flipkart");
				$this->db->update('tbl_order', $cdata);
			}
	//	}
		}
		
		$add_data = array();
		$add_data['for'] = 'flipkart order '.$status;
		$add_data['date'] = date('Y-m-d H:i:s');
		$add_data['added'] = $add_count;
		$this->db->insert('tbl_log',$add_data);
		echo "<pre>";
		print_r($fdetails);
		echo "</pre>";
	}
	function snapdealorder(){
		$params1 = array('affiliateId' => FLIPKART_affiliateId, 'token' => FLIPKART_token, 'response_type' => FLIPKART_response_type);
		$this->load->library('Flipkart', $params1);
		$flipkart = new Flipkart($params1);
		$url = 'http://affiliate-feeds.snapdeal.com/feed/api/order?startDate='.date('Y-m-d',strtotime('-30 days')).'&endDate='.date('Y-m-d').'&status=approved';
echo $url;
		$sdetails = $flipkart->snapdeal_call_url($url);	
		$add_count = 0 ;
		foreach($sdetails['productDetails'] as $key=>$value){
						
			$this->db->select('id');
			$this->db->from('tbl_order');
			$this->db->where('random',$value['affiliateSubId2']);
			$this->db->where('user_id',$value['affiliateSubId1']);
			$this->db->where('main_id',$value['orderCode']);
			$this->db->where('sitename',"snapdeal");
			$query = $this->db->get();	
			
			$this->db->select('*');
			$this->db->from('tbl_linkgo');
			$this->db->where('random',$value['affiliateSubId2']);
			$this->db->where('user_id',$value['affiliateSubId1']);
			$this->db->where('sitename',"snapdeal");
			$golink_data_query = $this->db->get();
			$golink_data = $golink_data_query->result_array();	
			$new_discount = 0;
			
			if(sizeof($golink_data)>0){
				$amount	= isset($value['sales'])?$value['sales']['amount']:$value['price'];
				$discount_g = (($golink_data[0]['discount']!='')?$golink_data[0]['discount']:0);
				$pamount = (($amount*$discount_g)/100);
				if($pamount<$value['commissionEarned']){
					$new_discount = $pamount;
				}
			}
			
			if( $query->num_rows() == 0){
				$cdata = array();
				$cdata['user_id'] 			= $value['affiliateSubId1'];
				$cdata['main_id'] 			= $value['orderCode'];
				$cdata['date'] 				= date("Y-m-d H:i:s",strtotime($value['dateTime']));
				$cdata['sitename']			= 'snapdeal';
				$cdata['commissionRate']	= $value['commissionRate'];
				$cdata['discount']			= $value['commissionEarned'];
				$cdata['price']				= $value['sale'];
				$cdata['amount']			= $value['price'];
				$cdata['random']			= $value['affiliateSubId2'];
				$cdata['orderStatus'] 		= "Approved";
				$cdata['discount_by_cashkarle'] 		= $new_discount;
				
				$this->db->insert('tbl_order', $cdata);
				$add_count++;
			}else{			
				$cdata = array();
				$cdata['orderStatus'] 		= "Approved";
				$cdata['discount_by_cashkarle'] 		= $new_discount;
				
				$this->db->where('random',$value['affiliateSubId2']);
				$this->db->where('user_id',$value['affiliateSubId1']);
				$this->db->where('main_id',$value['orderCode']);
				$this->db->where('sitename',"snapdeal");
				$this->db->update('tbl_order', $cdata);
			}
		}
		
		$add_data = array();
		$add_data['for'] = 'snapdeal order';
		$add_data['date'] = date('Y-m-d H:i:s');
		$add_data['added'] = $add_count;
		$this->db->insert('tbl_log',$add_data);
		echo "test";
		echo "<pre>";
		print_r($sdetails);
		echo "</pre>";
		echo "test1";
	}
	
	function hasofferorder(){
		$params1 = array('affiliateId' => FLIPKART_affiliateId, 'token' => FLIPKART_token, 'response_type' => FLIPKART_response_type);
		$this->load->library('Flipkart', $params1);
		$flipkart = new Flipkart($params1);

		$hasoffer_report = $flipkart->hasoffer_call_url('report');	
		$find = array("CPRC", "CPA","CPS","CPL"," - India");
		$replace = array("","","","","");
		$add_count = 0 ;
		if(isset($hasoffer_report['response'])){
			foreach($hasoffer_report['response']['data']['data'] as $key=>$value){
							
				$this->db->select('id');
				$this->db->from('tbl_order');
		//		$this->db->where('random',$value['Stat']['affiliate_info2']);
			//	$this->db->where('user_id',$value['Stat']['affiliate_info1']);
				$this->db->where('main_id',$value['Stat']['id']);
//				$this->db->where('sitename',"hasoffer");
				$query = $this->db->get();	
			
				
				$this->db->select('*');
				$this->db->from('tbl_linkgo');
				$this->db->where('random',$value['Stat']['affiliate_info2']);
				$this->db->where('user_id',$value['Stat']['affiliate_info1']);
				//$this->db->where('sitename',"hasoffer");
				$golink_data_query = $this->db->get();
				$golink_data = $golink_data_query->result_array();	
				$new_discount = 0;
				
				if(sizeof($golink_data)>0){
					$amount	= isset($value['sales'])?$value['sales']['amount']:$value['Stat']['sale_amount'];
					$discount_g = (($golink_data[0]['discount']!='')?$golink_data[0]['discount']:0);
					$pamount = (($amount*$discount_g)/100);
					if($pamount<$value['Stat']['approved_payout']){
						$new_discount = $pamount;
					}
				}	
				
				if( $query->num_rows() == 0){
					$cdata = array();
					$cdata['user_id'] 			= $value['Stat']['affiliate_info1'];
					$cdata['main_id'] 			= $value['Stat']['id'];
					$cdata['date'] 				= $value['Stat']['datetime'];
					$cdata['sitename']			= str_replace($find,$replace,$value['Offer']['name']);
					$cdata['commissionRate']	= "";
					$cdata['discount']			= $value['Stat']['approved_payout'];
					$cdata['price']				= $value['Stat']['sale_amount'];
					$cdata['amount']			= $value['Stat']['sale_amount'];
					$cdata['random']			= $value['Stat']['affiliate_info2'];
					$cdata['orderStatus'] 		= $value['Stat']['conversion_status'];
					$cdata['discount_by_cashkarle'] 		= $new_discount;
					
					$this->db->insert('tbl_order', $cdata);
					$add_count++;
				}else{			
					$cdata = array();
					$cdata['orderStatus'] 		= "Approved";
					$cdata['sitename']			= str_replace($find,$replace,$value['Offer']['name']);
					$cdata['discount_by_cashkarle'] 		= $new_discount;
					
//					$this->db->where('random',$value['Stat']['affiliate_info2']);
	//				$this->db->where('user_id',$value['Stat']['affiliate_info1']);
					$this->db->where('main_id',$value['Stat']['id']);
	//				$this->db->where('sitename',"hasoffer");
					$this->db->update('tbl_order', $cdata);
				}
			}
		}
		
		$add_data = array();
		$add_data['for'] = 'vcomission order';
		$add_data['date'] = date('Y-m-d H:i:s');
		$add_data['added'] = $add_count;
		$this->db->insert('tbl_log',$add_data);
		echo "test";
		echo "<pre>";
		print_r($hasoffer_report);
		echo "</pre>";
		echo "test1";
	}
}