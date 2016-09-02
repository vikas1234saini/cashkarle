<?php

class Product extends CI_Controller {
	
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();

    }
	
	function index($str,$str2) {
		
        $this->load->model('category_model');
        $this->load->model('product_model');
		$this->load->model('brand_model');
		$this->load->model('offer_model');
		
		$id_array 	= explode("-",$str);
		$id 		= $id_array[sizeof($id_array)-1];
		
		$id2 = false;
		if($str2!=false){
			$id_array2 	= explode("-",$str2);
			$id2 		= $id_array2[sizeof($id_array2)-1];
		}
		
		$data['product_details']  	= $this->product_model->get_product_by_id($id2);
		$data['category_details'] 	= $this->category_model->get_category_by_id($data['product_details'][0]['category']);
		
		$askey = str_replace("-"," ",$str2);
		if(isset($data['category_details'][0])){
			$data['relative_products']  = $this->product_model->get_product_by_relation($askey,$data['product_details'][0]['id'],$data['category_details'][0]['id']);
		}else{
			$data['relative_products']  = $this->product_model->get_product_by_relation($askey,$data['product_details'][0]['id']);
		}
		
		$data['list'] 			= $this->category_model->get_all_parent_category();
		$data['listnew'] 		= $this->category_model->get_all_main_category();
		$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
		$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
		$data['user_details'] 	= $this->session->userdata('fuser_details');
	
		$this->load->helper('data');
		$data['topuser'] = topuser();	
        //load the view
        $data['main_content'] = 'front/product_details';
        $this->load->view('includes/front_template', $data);
	}
	function offerdetails($str) {
		
        $this->load->model('category_model');
        $this->load->model('product_model');
		$this->load->model('brand_model');
		$this->load->model('offer_model');
		
		$id_array 	= explode("-",$str);
		$id 		= $id_array[sizeof($id_array)-1];
		
		
		$data['offer_details']  = $this->offer_model->get_offer_by_id($id);
		$data['category_details'] = $this->category_model->get_category_by_id($data['offer_details'][0]['category']);
		
		$data['list'] 			= $this->category_model->get_all_parent_category();
		$data['listnew'] 		= $this->category_model->get_all_main_category();
		$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
		$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
		$data['user_details'] 	= $this->session->userdata('fuser_details');
		
		$this->load->helper('data');
		$data['topuser'] = topuser();	
        //load the view
        $data['main_content'] = 'front/offer_details';
        $this->load->view('includes/front_template', $data);
	}
	function search($str){

		$post_data = $this->input->post();

        $this->load->model('category_model');
        $this->load->model('product_model');
		$this->load->model('brand_model');
		$this->load->model('offer_model');
		
		//$id_array 	= explode("-",$str);
	//	$id 		= $id_array[sizeof($id_array)-1];
		
		$askey = str_replace("-"," ",$str);
		$params = array('accessKey' => AMZ_accessKey, 'secretKey' => AMZ_secretKey, 'country' => AMZ_country, 'associateTag' => AMZ_associateTag);
		$this->load->library('AmazonECS', $params);
		$client = new AmazonECS($params);
		
//		print_r($cdata);
		$skey_array = explode("-",$str);
	
		if($skey_array[0]=='catsearch'){
			$cat_id = $data['category'] = $skey_array[sizeof($skey_array)-1];
			$data['productlist']  	= $this->product_model->get_product_by_category($cat_id);
			$skey = $data['category_name'] 	= $data['cskey'] 	= substr(str_replace("-"," ",$str),0,-2);
			$data['category_name'] = str_replace("catsearch ","",$data['category_name']);
			
			if($this->product_model->count_searchkey($skey)==0 && $_SERVER['HTTP_HOST']!='localhost'){
//			echo $askey;
				$amazon_response  = $client->category('All')->responseGroup('Large')->search($skey);
				
	//		$counter = 0;
				if(isset($amazon_response->Items) && isset($amazon_response->Items->Item)){
					foreach($amazon_response->Items->Item as $product){
						
						$cdata = array();	
						$cdata['product_main_id']	= $product->ASIN;
						$cdata['title'] 			= $product->ItemAttributes->Title;
						$cdata['description'] 		= $product->ItemAttributes->Title;
				
						$cdata['image'] 			= isset($product->MediumImage->URL)?$product->MediumImage->URL:"";
						$cdata['selling_price'] 	= isset($product->OfferSummary->LowestNewPrice)?($product->OfferSummary->LowestNewPrice->Amount/100):(isset($product->ItemAttributes->ListPrice) ? ($product->ItemAttributes->ListPrice->Amount/100):0);
						$cdata['url'] 				= isset($product->DetailPageURL)?$product->DetailPageURL:"";
						$cdata['brand'] 			= isset($product->ItemAttributes->Manufacturer)?$product->ItemAttributes->Manufacturer:"";
						$cdata['retail_price']		= isset($product->ItemAttributes->ListPrice) ? ($product->ItemAttributes->ListPrice->Amount/100):0;
						$cdata['sitename']			= "amazon";
						//$category					= isset($product->BrowseNodes)?(isset($product->BrowseNodes->BrowseNode)?(isset($product->BrowseNodes->BrowseNode->Ancestors)?(isset($product->BrowseNodes->BrowseNode->Ancestors->BrowseNode)?(isset($product->BrowseNodes->BrowseNode->Ancestors->BrowseNode->Ancestors)?():$product->BrowseNodes->BrowseNode->Ancestors->BrowseNode->Name):""):""):""):"";
						
						$this->load->helper('data');
						$topcat = array();
						
						if(isset($product->BrowseNodes)){
							if(sizeof($product->BrowseNodes->BrowseNode)==1){
								if(isset($product->BrowseNodes->BrowseNode)){
									$topcat = getAmazonCategory($product->BrowseNodes->BrowseNode);
								}
							}else{
								if(sizeof($product->BrowseNodes->BrowseNode)>0 && isset($product->BrowseNodes->BrowseNode[0])){
									$topcat = getAmazonCategory($product->BrowseNodes->BrowseNode[0]);
								}
							}
						}
						
						$cdata['category']	= $cat_id;
						if(isset($topcat['Root'])){
							$allcat = $this->category_model->get_category_by_title($topcat['Root']);
							if(sizeof($allcat)>0){
								$cdata['category']	= $allcat[0]['id'];
							}else{
								$cdata['category']	= $cat_id;
							}
						}
						
						$this->db->select('id');
						$this->db->from('tbl_product');
						$this->db->where('title',$product->ItemAttributes->Title);
						$this->db->where('url',$product->DetailPageURL);
						$query = $this->db->get();
						if( $query->num_rows()==0){
							$this->db->insert('tbl_product', $cdata);
						}
					}
				}				
				$searchdata = array();
				$searchdata['title'] = $skey;
				$insert = $this->db->insert('tbl_searchkey', $searchdata);
			}
			$data['offerlist']  = $this->offer_model->get_offer_by_title($skey);
		}elseif($skey_array[0]=='brand'){
			$data['brand'] = str_replace("-"," ",str_replace("brand-","",$str));
			$data['productlist']  	= $this->product_model->get_product_by_brand(str_replace("-"," ",str_replace("brand-","",$str)));
			$skey = $data['cskey'] 	= str_replace("-"," ",str_replace("brand-","",$str));
			
			$data['brand_set']  = 'brand_set';
			$data['offerlist']  = array();
		}else{
			
//			$data['offerlist']  = $this->offer_model->get_offer_by_title($skey);
			if($this->product_model->count_searchkey($askey)==0 && $_SERVER['HTTP_HOST']!='localhost'){
//			echo $askey;
				$amazon_response  = $client->category('All')->responseGroup('Large')->search($askey);
				
	//		$counter = 0;
				if(isset($amazon_response->Items) && isset($amazon_response->Items->Item)){
					foreach($amazon_response->Items->Item as $product){
						
						$cdata = array();	
						$cdata['product_main_id']	= $product->ASIN;
						$cdata['title'] 			= $product->ItemAttributes->Title;
						$cdata['description'] 		= $product->ItemAttributes->Title;
				
						$cdata['image'] 			= isset($product->MediumImage->URL)?$product->MediumImage->URL:"";
						$cdata['selling_price'] 	= isset($product->OfferSummary->LowestNewPrice)?($product->OfferSummary->LowestNewPrice->Amount/100):(isset($product->ItemAttributes->ListPrice) ? ($product->ItemAttributes->ListPrice->Amount/100):0);
						$cdata['url'] 				= isset($product->DetailPageURL)?$product->DetailPageURL:"";
						$cdata['brand'] 			= isset($product->ItemAttributes->Manufacturer)?$product->ItemAttributes->Manufacturer:"";
						$cdata['retail_price']		= isset($product->ItemAttributes->ListPrice) ? ($product->ItemAttributes->ListPrice->Amount/100):0;
						$cdata['sitename']			= "amazon";
						//$category					= isset($product->BrowseNodes)?(isset($product->BrowseNodes->BrowseNode)?(isset($product->BrowseNodes->BrowseNode->Ancestors)?(isset($product->BrowseNodes->BrowseNode->Ancestors->BrowseNode)?(isset($product->BrowseNodes->BrowseNode->Ancestors->BrowseNode->Ancestors)?():$product->BrowseNodes->BrowseNode->Ancestors->BrowseNode->Name):""):""):""):"";
						
						$this->load->helper('data');
						$topcat = array();
						
						if(isset($product->BrowseNodes)){
							if(sizeof($product->BrowseNodes->BrowseNode)==1){
								if(isset($product->BrowseNodes->BrowseNode)){
									$topcat = getAmazonCategory($product->BrowseNodes->BrowseNode);
								}
							}else{
								if(sizeof($product->BrowseNodes->BrowseNode)>0 && isset($product->BrowseNodes->BrowseNode[0])){
									$topcat = getAmazonCategory($product->BrowseNodes->BrowseNode[0]);
								}
							}
						}
						
						$cdata['category']	= '0';
						if(isset($topcat['Root'])){
							$allcat = $this->category_model->get_category_by_title($topcat['Root']);
							if(sizeof($allcat)>0){
								$cdata['category']	= $allcat[0]['id'];
							}else{
								$cdata['category']	= '0';
							}
						}
						
						$this->db->select('id');
						$this->db->from('tbl_product');
						$this->db->where('title',$product->ItemAttributes->Title);
						$this->db->where('url',$product->DetailPageURL);
						$query = $this->db->get();
						if( $query->num_rows()==0){
							$this->db->insert('tbl_product', $cdata);
						}
					}
				}				
				$searchdata = array();
				$searchdata['title'] = $askey;
				$insert = $this->db->insert('tbl_searchkey', $searchdata);
			}
			$skey = $data['skey'] 	= str_replace("-"," ",$str);
			
			$data['offerlist']  = $this->offer_model->get_offer_by_title($skey);
			$data['productlist']  	= $this->product_model->get_product_by_title($skey);
			
		}
		
		$data['search']  	= "search";
//		$data['category_details'] = $this->category_model->get_category_by_id($data['product_details'][0]['category']);
		
		$data['list'] 			= $this->category_model->get_all_parent_category();
		$data['listnew'] 		= $this->category_model->get_all_main_category();
		$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
		$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
		$data['user_details'] 	= $this->session->userdata('fuser_details');
		
		$this->load->helper('data');
		$data['topuser'] = topuser();
        //load the view
        $data['main_content'] = 'front/search';
        $this->load->view('includes/front_template', $data);
	}
	function searchajax(){
		if(! $this->input->is_ajax_request()) {
			redirect('404');
		}else{
				
			$this->load->model('category_model');
			$this->load->model('product_model');
			$this->load->model('offer_model');
			$data = array();
			$data['post_data']	 	= $post_data = $this->input->post();
			
			$offerdata 		= "";
			$productdata 	= "";
			
			$productlist	= $this->product_model->get_product_search($post_data);
			
			$data['query']  			= $this->db->last_query();
			$data['productlistsize']  	= sizeof($productlist);
			$offerlist  	= $this->offer_model->get_offer_search($post_data);

//			$user_details = $data['user_details'] 	= $this->session->userdata('fuser_details');
			if(sizeof($offerlist)>0){
				foreach($offerlist as $key => $value){
					
					$new_title 			= preg_replace("/[^0-9a-zA-Z ]/m", "", $value['title']);
					$new_title 			= strtolower(preg_replace("/ /", "-", $new_title));
					$find = array("CPRC", "CPA","CPS","CPL"," - India");
					$replace = array("","","","","");
					$discount = "";
					if(isset($value['discount']) && $value['discount']!=''){
						$discount = " ".$value['discount']." ".($value['discount_type']!=''?$value['discount_type']:"%");
					}
					$offerdata .= '<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="product-item  coupon-item text-center " style="height:300px;">
						
                                        	<div style="height:240px;">
							<div style="height:120px; position:relative;">';
							$offerdata .= '<a href="'.base_url("couponlist/".$new_title."-".$value['id']).'">';
							/*if($value['coupon_count']>0){
                                  $offerdata .=       '<a href="'.base_url("couponlist/".$new_title."-".$value['id']).'">'; 
						   }else{ 
								//print_r($user_details);
								if(isset($user_details) && sizeof($user_details)>0){ 
									  $offerdata .=       '<a href="'.base_url('oprocess/'.$value['id']."/".rand(1000,9999).date('ymdhis')).'" class="signinuseroffer" rel="'.$value['id'].'" data-url="'.$value['url'].'" title="'.html_entity_decode($value['title']).'" target="_blank">';
								}else{
									  $offerdata .=       ' <a href="'.$value['url'].'" class="sign-in-btn">';
								} 
							}*/
							
							$couponImage 		= $value['image']!=''?$value['image']:base_url("assets/img/noimage.png");	
							$offerdata .= '<img src="'.$couponImage.'" style="position:absolute;    top:0;    bottom:0;    margin:auto; max-height:110px; padding-top:10px; left:0; right:0;"></a></div>
							<div class="product-name" style="height:40px;">
								<p>';
								$offerdata .= '<a href="'.base_url("couponlist/".$new_title."-".$value['id']).'">';
								/*  if($value['coupon_count']>0){
                                        $offerdata .= '<a href="'.base_url("couponlist/".$new_title."-".$value['id']).'">';
                                  }else{ 
										if(isset($user_details) && sizeof($user_details)>0){ 
											  $offerdata .= '<a href="'.base_url('oprocess/'.$value['id']."/".rand(1000,9999).date('ymdhis')).'" class="signinuseroffer" rel="'.$value['id'].'" data-url="'.$value['url'].'" title="'.html_entity_decode($value['title']).'" target="_blank">';
										}else{
											$offerdata .= '<a href="'.$value['url'].'" class="sign-in-btn">';
										} 
								} */
								
								$offerdata .= str_replace($find,$replace,$value['title']).'</a></p>
							</div>
							<label class="cashback"><span class="yellow">'.($discount!=''?$discount:"0%").' </span>cashback</label>
							</div>
							<div class="view-offer">';
							$offerdata .= '<a href="'.base_url("couponlist/".$new_title."-".$value['id']).'"><btn class="btn btn-warning btn-round btn-wide fw-700">GET OFFER</btn></a>';
		/*					if($value['coupon_count']>0){
	                         	$offerdata .= '<a href="'.base_url("couponlist/".$new_title."-".$value['id']).'"><btn class="btn btn-warning btn-round btn-wide fw-700">GET OFFER</btn></a>';
                             }else{ 
									//print_r($user_details);
	      	                    if(isset($user_details) && sizeof($user_details)>0){ 
		                			$offerdata .= '<a href="'.base_url('oprocess/'.$value['id']."/".rand(1000,9999).date('ymdhis')).'" class="signinuseroffer buybutton" rel="'.$value['id'].'" data-url="'.$value['url'].'" title="'.html_entity_decode($value['title']).'" target="_blank" ><btn class="btn btn-warning btn-round btn-wide fw-700">GET OFFER</btn></a>';
		        		        }else{
                                 	$offerdata .= '<a href="'.$value['url'].'" class="sign-in-btn buybutton"><btn class="btn btn-warning btn-round btn-wide fw-700">GET OFFER</btn></a>';
								}
							}*/
								$offerdata .= '<br />
                            <div style="font-size:11px; margin-top:2px; color:#000; font-weight:800;">'.$value['coupon_count'].' Offers Available</div>
							</div>
						</div>
					</div>';			
				}
			}else {
				$offerdata .= '<div class="col-md-12 aligncenter fontbold" style="border: solid 1px #ccc; margin:10px; padding:10px;">No More Offer Found.</div>';				
			}
			
			if(sizeof($productlist)>0){
				$search_id = $data['search_id'] 	= $this->session->userdata('searchproduct');
				$counter = 0;
				foreach($productlist as $product){
					if($product['image']!=''){
						$counter++;
						if($counter>24){
							break;
						}
						$search_id[] 		= $product['id'];
						$productId 			= $product['product_main_id'];
						$title 				= $product['title'];
						$productDescription = $product['description'];
						$productImage 		= $product['image']!=''?$product['image']:base_url("assets/img/noimage.png");
						$sellingPrice 		= $product['selling_price'];
						$productUrl 		= $product['url'];
						$productBrand 		= $product['brand'];
						$maximumRetailPrice	= $product['retail_price'];
	//					$cashback			= $product['discount'];
						
						$cashback = "0";
						if($product['sitename']=='snapdeal'){
							//if($product['retail_price']>2500){
	//							$cashback		= $product['snapdeal_discount_2500'];
	//						}else{
	//							$cashback		= $product['snapdeal_discount'];
	//						}
							$cashback		= $product['snapdeal_discount'];
						}else if($product['sitename']=='flipkart'){
							$cashback		= $product['flipkart_discount'];
						}else if($product['sitename']=='amazon'){
							$cashback		= $product['amazon_discount'];
						}
						if($cashback==0 || $cashback==''){
							$cashback = "0";
						}
						$new_title = preg_replace("/[^0-9a-zA-Z ]/m", "", $title);
						$new_title = str_replace("catsearch","",strtolower(preg_replace("/ /", "-", $new_title)));
						//$categoryName 		= strtolower(preg_replace("/ /", "-", $product['categoryName']));
						
						$categoryName 		= strtolower(preg_replace("/ /", "-", ($product['categoryName']!=""?$product['categoryName']:"amazon")));
						
						$productdata .= '<div class="col-md-4 col-sm-6 col-xs-12">
											<div class="product-item text-center ">
											
												<div style="height:'.($productImage!=''?"370px":"350px").'">
												<div style="height:150px; position:relative;"><a href="'.base_url($categoryName."/".$new_title."-".$product['id']).'" ><img src="'.$productImage.'" style="overflow:hidden;max-height:150px;overflow:hidden;padding-top:5px;position:absolute;    top:0;    bottom:0;  margin:auto; left:0; right:0;"></a></div>
												<div class="product-name">
													<p>'.mb_strimwidth($title,0,30,"...").'</p>						
													<p>By: <img src="'.base_url("assets/img/".$product['sitename'].".png").'" width="70" /></p>
												</div>
												<p class="actual-price"> ACTUAL PRICE RS '.$maximumRetailPrice.'</p>
												<p class="fw-400 price" style="text-align:center !important;"> Rs '.$sellingPrice.'</p>
												<p style="font-size:18px;"><strong>+</strong></p>';
						if($cashback!=0 && $cashback!=""){
							$productdata .= '<label class="cashback"><span class="yellow">'.$cashback.'% </span>cashback</label>';
						}else{
							$productdata .= '<label class="cashback"><span class="yellow">0% </span>cashback</label>';
						}
						$productdata .= '</div><div class="view-offer">
												<btn class="btn btn-warning btn-round btn-wide fw-700"><a href="'.base_url($categoryName."/".$new_title."-".$product['id']).'" >VIEW OFFER</a></btn>
											</div>
										</div>
									</div>';			
					}
				}
				foreach($productlist as $product){
					if($product['image']==''){
						$counter++;
						if($counter>24){
							break;
						}
						
						$search_id[] 		= $product['id'];
						$productId 			= $product['product_main_id'];
						$title 				= $product['title'];
						$productDescription = $product['description'];
						$productImage 		= $product['image']!=''?$product['image']:base_url("assets/img/noimage.png");
						$sellingPrice 		= $product['selling_price'];
						$productUrl 		= $product['url'];
						$productBrand 		= $product['brand'];
						$maximumRetailPrice	= $product['retail_price'];
	//					$cashback			= $product['discount'];
						
						$cashback = "0";
						if($product['sitename']=='snapdeal'){
							//if($product['retail_price']>2500){
	//							$cashback		= $product['snapdeal_discount_2500'];
	//						}else{
	//							$cashback		= $product['snapdeal_discount'];
	//						}
							$cashback		= $product['snapdeal_discount'];
						}else if($product['sitename']=='flipkart'){
							$cashback		= $product['flipkart_discount'];
						}else if($product['sitename']=='amazon'){
							$cashback		= $product['amazon_discount'];
						}
						if($cashback==0 || $cashback==''){
							$cashback = "0";
						}
						$new_title = preg_replace("/[^0-9a-zA-Z ]/m", "", $title);
						$new_title = str_replace("catsearch","",strtolower(preg_replace("/ /", "-", $new_title)));
						//$categoryName 		= strtolower(preg_replace("/ /", "-", $product['categoryName']));
						
						$categoryName 		= strtolower(preg_replace("/ /", "-", ($product['categoryName']!=""?$product['categoryName']:"amazon")));
						
						$productdata .= '<div class="col-md-4 col-sm-6 col-xs-12">
											<div class="product-item text-center ">
											
												<div style="height:'.($productImage!=''?"370px":"350px").'">
												<div style="height:150px; position:relative;"><a href="'.base_url($categoryName."/".$new_title."-".$product['id']).'" ><img src="'.$productImage.'" style="overflow:hidden;max-height:150px;overflow:hidden;padding-top:5px;position:absolute;    top:0;    bottom:0;  margin:auto; left:0; right:0;"></a></div>
												<div class="product-name">
													<p>'.mb_strimwidth($title,0,30,"...").'</p>						
													<p>By: <img src="'.base_url("assets/img/".$product['sitename'].".png").'" width="70" /></p>
													
			
												</div>
												<p class="actual-price"> ACTUAL PRICE RS '.$maximumRetailPrice.'</p>
												<p class="fw-400 price" style="text-align:center !important;"> Rs '.$sellingPrice.'</p>
												<p style="font-size:18px;"><strong>+</strong></p>';
						if($cashback!=0 && $cashback!=""){
							$productdata .= '<label class="cashback"><span class="yellow">'.$cashback.'% </span>cashback</label>';
						}else{
							$productdata .= '<label class="cashback"><span class="yellow">0% </span>cashback</label>';
						}
						$productdata .= '</div><div class="view-offer">
												<btn class="btn btn-warning btn-round btn-wide fw-700"><a href="'.base_url($categoryName."/".$new_title."-".$product['id']).'" >VIEW OFFER</a></btn>
											</div>
										</div>
									</div>';			
					}
				}
				
				$set_check = array('searchproduct'=>$search_id);
				$this->session->set_userdata($set_check);
			}else {
				$productdata .= '<div class="col-md-12 aligncenter fontbold" style="border: solid 1px #ccc; margin:10px; padding:10px;">No More Product Found.</div>';				
			}
			$data['productlist']	= $productdata;
			$data['couponlist']  	= $offerdata;
			if(sizeof($productlist)>0){
				$data['status']  		= "1";
			}else{
				$data['status']  		= "0";
			}
			if(sizeof($offerlist)>0){
				$data['ostatus']  		= "1";
			}else{
				$data['ostatus']  		= "0";
			}
			echo json_encode($data);
			die;	
		}
	}
	function category_list($id){
		
				
		$this->load->model('category_model');
		$this->load->model('product_model');
		$this->load->model('offer_model');
		$this->load->model('brand_model');
		
		
		$data['category_details'] = $this->category_model->get_category_by_id($id);
		$data['categorylist']	= $this->category_model->get_all_category($id);
		$data['list'] 			= $this->category_model->get_all_parent_category();
		$data['listnew'] 		= $this->category_model->get_all_main_category();
		$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
		$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
		
		$this->load->helper('data');
		$data['topuser'] = topuser();
        //load the view
        $data['main_content'] = 'front/category_list';
        $this->load->view('includes/front_template', $data);
	}
	
	
	function productlist($str){

        $this->load->model('category_model');
        $this->load->model('product_model');
		$this->load->model('brand_model');
		$this->load->model('offer_model');
		
		//$id_array 	= explode("-",$str);
	//	$id 		= $id_array[sizeof($id_array)-1];
		
		$data['productlist']  	= $this->product_model->get_featured_product();
		$data['top_product']  	= "top product";
//		print_r($data['productlist']);
		
//		$data['category_details'] = $this->category_model->get_category_by_id($data['product_details'][0]['category']);
		
		$data['list'] 			= $this->category_model->get_all_parent_category();
		$data['listnew'] 		= $this->category_model->get_all_main_category();
		$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
		$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
		$data['user_details'] 	= $this->session->userdata('fuser_details');
		
		$this->load->helper('data');
		$data['topuser'] = topuser();
        //load the view
        $data['main_content'] = 'front/search';
        $this->load->view('includes/front_template', $data);
	}
	function offerlist($str){

        $this->load->model('category_model');
        $this->load->model('product_model');
		$this->load->model('brand_model');
		$this->load->model('offer_model');
		
		//$id_array 	= explode("-",$str);
	//	$id 		= $id_array[sizeof($id_array)-1];
		
		$data['offerlist']  	= $this->offer_model->get_featured_offer();

		$data['top_coupon']  	= "top coupon";
		
//		$data['category_details'] = $this->category_model->get_category_by_id($data['product_details'][0]['category']);
		
		$data['list'] 			= $this->category_model->get_all_parent_category();
		$data['listnew'] 		= $this->category_model->get_all_main_category();
		$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
		$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
		$data['user_details'] 	= $this->session->userdata('fuser_details');
		
		$this->load->helper('data');
		$data['topuser'] = topuser();
        //load the view
        $data['main_content'] = 'front/search';
        $this->load->view('includes/front_template', $data);
	}
	function process($id,$random_no){

		$data  = array();
        $this->load->model('product_model');
		$product_details 	= $data['product_details']  	= $this->product_model->get_product_by_id($id);
		$user_details 		= $data['user_details'] 		= $this->session->userdata('fuser_details');
		$data['random_no'] 			= $random_no;
		$this->db->select('id');
		$this->db->from('tbl_linkgo');
		$this->db->where('random',$random_no);
		$query = $this->db->get();
		
		$cashback = 0;
		if($product_details[0]['sitename']=='snapdeal'){
			/*if($product_details[0]['retail_price']>2500){
				$cashback		= $product_details[0]['snapdeal_discount_2500'];
			}else{
				$cashback		= $product_details[0]['snapdeal_discount'];
			}*/
			
			$cashback		= $product_details[0]['snapdeal_discount'];
		}else if($product_details[0]['sitename']=='flipkart'){
			$cashback		= $product_details[0]['flipkart_discount'];
		}else if($product_details[0]['sitename']=='amazon'){
			$cashback		= $product_details[0]['amazon_discount'];
		}
		$extraval = "affExtParam1";
		$para2 = "";
		
		if (isset($random_no) && $random_no != "") {
			$para2 = "&affExtParam2=".$random_no;
		}
		if(isset($product_details[0]['sitename']) && strtolower($product_details[0]['sitename'])=='flipkart'){
			$extraval = 'affExtParam1';
		}
		
		if(isset($product_details[0]['sitename']) && strtolower($product_details[0]['sitename'])=='snapdeal'){
			$extraval = 'aff_sub';
			$para2 = "&aff_sub2=".$random_no;
		}
		
		if(isset($product_details[0]['categoryName']) && $product_details[0]['categoryName']==''){ 
			$product_details[0]['discount'] 		= 0;
			$product_details[0]['categoryName'] 	= 'Amazon';
			$product_details[0]['categoryName'] 	= 'Amazon';
			
			$product_details[0]['snapdeal_discount_2500'] 	= 0;
			$product_details[0]['snapdeal_discount'] 		= 0;
			$product_details[0]['flipkart_discount'] 		= 0;
			$product_details[0]['amazon_discount'] 			= 0;
		}
		
		$data['main_url'] = (isset($product_details[0]['url'])?$product_details[0]['url']:(isset($product_details[0]['link'])?$product_details[0]['link']:"")) ."&".$extraval."=".$user_details[0]['id'].$para2;
		$data['cashback'] = $cashback;
		if( $query->num_rows()==0){
			$cdata = array();
			$cdata['link'] 		= $data['main_url'];
			$cdata['user_id'] 	= $user_details[0]['id'];
			$cdata['date'] 		= date('Y-m-d H:i:s');
			$cdata['url'] 		= $product_details[0]['url'];
			$cdata['random'] 	= $random_no;
			$cdata['action'] 	= base_url('process/'.$id.'/'.$random_no);
			$cdata['discount'] 	= $cashback;
			$cdata['main_id'] 	= $id;
			$cdata['sitename'] 	= $product_details[0]['sitename'];
			$this->db->insert('tbl_linkgo', $cdata);
		}else{
			
			$cdata = array();
			$cdata['link'] 		= $data['main_url'];
			$cdata['user_id'] 	= $user_details[0]['id'];
			$cdata['date'] 		= date('Y-m-d H:i:s');
			$cdata['url'] 		= $product_details[0]['url'];
			$cdata['random'] 	= $random_no;
			$cdata['action'] 	= base_url('process/'.$id.'/'.$random_no);
			$cdata['discount'] 	= $cashback;
			$cdata['main_id'] 	= $id;
			$cdata['sitename'] 	= $product_details[0]['sitename'];
			$this->db->where('random',$random_no)->update('tbl_linkgo', $cdata);
		}
		//echo "<pre>";
		//print_r($cdata);
		//die;
		//print_r($data['product_details']);
//		echo $id.",".$random;
	//	die;
        $this->load->view('front/process', $data);
	}
	function offerprocess($id){
		$data  = array();;
        $this->load->model('offer_model');
		$data['offer_details']  	= $data['product_details']  	= $this->offer_model->get_offer_by_id($id);
		$data['user_details'] 		= $this->session->userdata('fuser_details');
//		$data['offer_details']  	= $this->offer_model->get_offer_by_id_main($data['product_details'][0]['offer_id']);

        $this->load->view('front/offerprocess', $data);
	}
	
	function offercouponprocess($id){
		$data  = array();;
        $this->load->model('offer_model');
		$data['product_details']  	= $this->offer_model->get_coupon_by_id($id);
		$data['user_details'] 		= $this->session->userdata('fuser_details');
		$data['offer_details']  	= $this->offer_model->get_offer_by_id_main($data['product_details'][0]['offer_id']);

        $this->load->view('front/offerprocess', $data);
	}
	
	function couponlist($str=false){
	  	$this->load->model('category_model');
        $this->load->model('product_model');
		$this->load->model('brand_model');
		$this->load->model('offer_model');
		
		$id_array 	= explode("-",$str);
		$id 		= $id_array[sizeof($id_array)-1];
		
		//echo $id;
		$data['offer_details']  	= $this->offer_model->get_offer_by_id($id);
		$data['category_details'] 	= $this->category_model->get_category_by_id($data['offer_details'][0]['category']);
		if($data['offer_details'][0]['main_id']!=''){
			$data['couponlist'] 		= $this->offer_model->get_coupon($data['offer_details'][0]['main_id']);
		}else{
			$data['couponlist'] 		= array();
		}
		
		//print_r($data['offer_details']);
		//die;
		
		$data['list'] 			= $this->category_model->get_all_parent_category();
		$data['listnew'] 		= $this->category_model->get_all_main_category();
		$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
		$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
		$data['user_details'] 	= $this->session->userdata('fuser_details');
		
		$this->load->helper('data');
		$data['topuser'] = topuser();
		
        //load the view
        $data['main_content'] = 'front/coupon_list';
        $this->load->view('includes/front_template', $data);
	}
	
	function coupondetails(){
	  	$this->load->model('category_model');
        $this->load->model('product_model');
		$this->load->model('brand_model');
		$this->load->model('offer_model');
		
		$id_array 	= explode("-",$str);
		$id 		= $id_array[sizeof($id_array)-1];
		
		$data['couponlist'] 		= $this->offer_model->get_coupon_by_id($id);
		$data['offer_details']  	= $this->offer_model->get_offer_by_id_main($data['couponlist'][0]['offer_id']);
		$data['category_details'] 	= $this->category_model->get_category_by_id($data['offer_details'][0]['category']);
		
		//print_r($data['offer_details']);
		//die;
		
		$data['list'] 			= $this->category_model->get_all_parent_category();
		$data['listnew'] 		= $this->category_model->get_all_main_category();
		$data['brandlist'] 		= $this->brand_model->get_all_parent_brand();
		$data['brandlistnew'] 	= $this->brand_model->get_all_main_brand();
		$data['user_details'] 	= $this->session->userdata('fuser_details');
		
		$this->load->helper('data');
		$data['topuser'] = topuser();
		
        //load the view
        $data['main_content'] = 'front/coupon_details';
        $this->load->view('includes/front_template', $data);
			
	}
	
	//auto suggest
	function suggest($field='title'){
		$input = trim($this->input->get('term', TRUE));
		$return = array();
		if($input!=''){
			$return = array();
			$find = array("CPRC", "CPA","CPS","CPL"," - India","-","India","india");
			$replace = array("","","","","","","","");
					
			$result = $this->db->select('o.id,o.title,o.discount,count(c.offer_id) as coupon_count')->where("title like '%{$input}%'")->group_by('o.main_id')->order_by('coupon_count', "desc")->where("o.status",'1')->where("o.url != ",'')->where("c.coupon_expiry >= ",date('Y-m-d 23:59:59'))->where("c.added <= ",date('Y-m-d'))->where("o.sitename != ",'flipkart')->join('tbl_coupon as c', 'o.main_id = c.offer_id', 'left')->group_by('o.main_id,c.offer_id')->limit(10)->get("tbl_offer as o")->result();

			foreach($result as $r){
				$return[] = array('id'=>$r->id,'desc'=>"Up To ".$r->discount."% Cashback / ".$r->coupon_count." Coupons", 'value'=>str_replace($find,$replace,ucwords(stripslashes($r->title))), 'title'=>str_replace($find,$replace,str_replace($input,"<strong>".$input."</strong>",ucwords(stripslashes($r->$field)))));
//				$return[] = array('id'=>$r->$field, 'value'=>ucwords(stripslashes($r->$field)));
			}
			
			$result = $this->db->select('id,categoryName')->group_by("categoryName")->where("categoryName like '%{$input}%' and parentId!='0'")->limit(15-sizeof($return))->get("tbl_category")->result();
		
			foreach($result as $r){
				$return[] = array('id'=>$r->id,'desc'=>"", 'value'=>str_replace($find,$replace,ucwords(stripslashes($r->categoryName))), 'title'=>str_replace($find,$replace,str_replace($input,"<strong>".$input."</strong>",ucwords(stripslashes($r->categoryName)))));
//				$return[] = array('id'=>$r->$field, 'value'=>ucwords(stripslashes($r->$field)));
			}
			
			$result = $this->db->select('id,title')->group_by($field)->where($field." like '%{$input}%'")->limit(15-sizeof($return))->where("status",'1')->get("tbl_product")->result();
			foreach($result as $r){
				$return[] = array('id'=>$r->id,'desc'=>"", 'value'=>str_replace($find,$replace,ucwords(stripslashes($r->$field))), 'title'=>str_replace($find,$replace,str_replace($input,"<strong>".$input."</strong>",ucwords(stripslashes($r->$field)))));
//				$return[] = array('id'=>$r->$field, 'value'=>ucwords(stripslashes($r->$field)));
			}
		}
		die(json_encode($return));
	}
}