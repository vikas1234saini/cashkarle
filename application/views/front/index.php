<?php 

	$user_details = array();
	if ($this->session->userdata('fuser_details') !== FALSE) {
		$user_details = $this->session->userdata('fuser_details');
	}
	$allbanner = $this->db->select('*')->where('status', '1')->from('tbl_banner')->order_by("order")->get()->result_array();
?>
<style>
 .banner_fluid {
   padding-left:0;
   padding-right:0;
}
.carousel-control.right,.carousel-control.left{ background:none; cursor:pointer;}

.carousel-control {
    position: absolute;
    top: 50%; /* pushes the icon in the middle of the height */
     z-index: 5;
    display: inline-block;
}
</style>
    <div class="hero-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-7">
                    <div class="image-section" style="background:none;">
                    <?php if(sizeof($allbanner)>0){ ?>
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                            	<?php foreach($allbanner as $key=>$value){ ?>
                                <div class="item <?php if($key==0){ ?>active<?php } ?>">            
					             <a href="<?php echo $value['link']; ?>"> <img src="<?php echo site_url('assets/uploads/banner/'.$value['banner']); ?>" /></a>
                                </div>
                                <?php } ?>
                            </div>
                             <div href="#myCarousel" class="left carousel-control" data-slide="prev">
                                <span>
                                    <img src="<?php echo site_url('assets/img/left.png'); ?>" />
                                </span>
                            </div>
                            <div href="#myCarousel" class="right carousel-control" data-slide="next">
                                <span>
                                    <img src="<?php echo site_url('assets/img/right.png'); ?>" />
                                </span>
                            </div>
                            
                        </div>        
                        <?php }else{ ?>
                        <div class="content-section">
                            <h2 class="fw-300"> Get Amazing Deals On Mobile Phones</h2>
                            <h1>UP TO<BR>6000 RS CASHBACK</h1>
                            <label class="coupon">CK100</label>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class=" col-md-4 col-sm-5 ofh">
                    <div class="how-to">
                        <h2 style="color:#fff;">Choose Product Buy through Us Get Cashback</h2>
                        <span class="green-line" style=" width:100%;margin-bottom:20px;"></span>
                        
	                      <?php if ($this->session->userdata('fis_logged_in') !== FALSE) { ?>
    	                    <a href="<?php echo base_url('top-product'); ?>"><span class="btn btn-round btn-warning btn-wide fw-700" style="font-size:16px;">GET STARTED</span></a>
                        <?php }else{ ?>
	                        <span class="btn btn-round btn-warning btn-wide fw-700 sign-up-btn" style="font-size:16px;">GET STARTED</span>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<section class="hot-products" style="margin-top:30px;">
        <div class="container">
            <div class="row text-center">
                <h2> Hot Products <span class="green pointer link"> <a href="<?php echo base_url('top-product'); ?>">View All</a></span></h2>
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                        
                        <?php 
                            //print_r($details);
                            $counter = 0;
                            foreach ($cdata as $product) {
                                $counter++;
                                if($counter>8){
                                    break;	
                                }
                                $productId 			= $product['productId'];
                                $title 				= $product['title'];
                                $productDescription = $product['productDescription'];
                                $productImage 		= $product['productImage']!=''?$product['productImage']:base_url("assets/img/noimage.png");
                    
                                $sellingPrice 		= $product['sellingPrice'];
                                $productUrl 		= $product['productUrl'];
                                $productBrand 		= $product['productBrand'];
                                $maximumRetailPrice	= $product['maximumRetailPrice'];
                                $cashback			= $product['cashback'];
								$sitename			= $product['sitename'];
								
								$new_title = preg_replace("/[^0-9a-zA-Z ]/m", "", $title);
								$new_title = strtolower(preg_replace("/ /", "-", $new_title));
								$categoryName 		= strtolower(preg_replace("/ /", "-", ($product['category']!=""?$product['category']:"amazon")));
//								echo ($counter)%4;
								if(!(($counter-1)%4) && $counter!=1){
						?>
                          		  </div><div class="item">
                        <?php } ?>
                                  <div class="col-md-3 col-sm-6">
                                        <div class="product-item text-center ">
                                        	<div style="height:370px;">
                                            <div style="height:150px; position:relative"><a href="<?php echo base_url($categoryName."/".$new_title."-".$product['id']); ?>"><img src="<?php echo $productImage; ?>" style="overflow:hidden;max-height:150px;overflow:hidden;padding-top:5px;position:absolute;    top:0;    bottom:0;  margin:auto; left:0; right:0;"></a></div>
                                            <div class="product-name">
                                                <p><?php echo mb_strimwidth($title,0,30,"..."); ?></p>
                                                <p>By: <img src="<?php echo base_url("assets/img/".$sitename.".png"); ?>" width="70" /></p>
                                            </div>
                                            <p class="actual-price"> ACTUAL PRICE RS <?php echo $maximumRetailPrice; ?></p>
                                            <p class="fw-400 price" style="text-align:center !important;"> Rs <?php echo $sellingPrice; ?></p>
                                            <p style="font-size:18px;" ><strong>+</strong></p>
                                            <?php if($cashback!=0 && $cashback!=""){ ?>
                                            <label class="cashback"><span class="yellow"><?php echo $cashback ?>% </span>cashback</label>
                                            <?php }else{ ?>
                                            <label class="cashback"><span class="yellow">0% </span>cashback</label>
                                            <?php } ?>
                                            </div>
                                            <div class="view-offer">
                                                <btn class="btn btn-warning btn-round btn-wide fw-700"><a href="<?php echo base_url($categoryName."/".$new_title."-".$product['id']); ?>"  >VIEW OFFER</a></btn>
                                                
                                            </div>
                                        </div>
                                    </div>
                        <?php    } ?>
                            
                        </div>
                    </div>
    </section>
    
    
	<!-- Post + Links List All -->
    
	<section class="hot-coupons text-center">
        <div class="container">
            <div class="row">
                <h1 class="fw-700">AMAZING PRICE + <span class="green">CASHBACK</span></h1>
                <span class="green-line"></span>
                <h2> Hot Coupons <span class="green pointer link"> <a href="<?php echo base_url('top-coupon'); ?>">View All</a></span></h4>
                
        
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
       		<?php 
				$counter = 0;
		   		foreach($offer as $key => $value){
					$counter++;
					if($counter>8){
						break;	
					}
//								echo ($counter)%4;
					if(!(($counter-1)%8) && $counter!=1){						
						$new_title 			= preg_replace("/[^0-9a-zA-Z ]/m", "", $value['title']);
						$new_title 			= strtolower(preg_replace("/ /", "-", $new_title));
						
			?>
                          		  </div><div class="item">
	 
				<?php } 
					$discount = "";
					if(isset($value['discount']) && $value['discount']!=''){
						$discount = " ".$value['discount']." ".($value['discount_type']!=''?$value['discount_type']:"%");
					}
				?>
                <div class="col-md-3 col-sm-6">
                    <div class="product-item  coupon-item text-center " style="height:300px;">
                                    <div style="height:240px;">
                                    <div style="height:120px; position:relative;">
                                    <?php if($value['coupon_count']>0){ ?>
                                        <a href="<?php echo base_url("couponlist/".$new_title."-".$value['id']); ?>">
                                        
                                        <?php }else{ 
										//print_r($user_details);
                    	                    if(isset($user_details) && sizeof($user_details)>0){ 
										?>
		                				      <a href="<?php echo base_url('oprocess/'.$value['id']."/".rand(1000,9999).date('ymdhis')); ?>" class="signinuseroffer" rel="<?php echo $value['id']; ?>" data-url="<?php echo $value['url']; ?>" title="<?php echo html_entity_decode($value['title']); ?>" target="_blank" >
		        		            <?php }else{ ?>
                                                <a href="<?php echo $value['url']; ?>" class="sign-in-btn">
									<?php } } ?>
                                    <img src="<?php echo $value['image']; ?>" style="position:absolute;    top:0;    bottom:0;    margin:auto; max-height:110px; padding-top:10px; left:0; right:0;"></a></div>
                                    <div class="product-name" style="height:40px;">
                                        <p>
                                        <?php if($value['coupon_count']>0){ ?>
                                        <a href="<?php echo base_url("couponlist/".$new_title."-".$value['id']); ?>">
                                        <?php }else{ 
                    	                    if(isset($user_details) && sizeof($user_details)>0){ 
										?>
		                				      <a href="<?php echo base_url('oprocess/'.$value['id']."/".rand(1000,9999).date('ymdhis')); ?>" class="signinuseroffer" rel="<?php echo $value['id']; ?>" data-url="<?php echo $value['url']; ?>" title="<?php echo html_entity_decode($value['title']); ?>" target="_blank" >
		        		            <?php }else{ ?>
                                                <a href="<?php echo $value['url']; ?>" class="sign-in-btn">
									<?php } } 
									
											$find = array("CPRC", "CPA","CPS","CPL"," - India");
											$replace = array("","","","","");
											echo str_replace($find,$replace,$value['title']); ?></a></p>
                                    </div>
                                    <?php if(isset($discount) && $discount!='' && $discount!=0){ ?>
                                    <label class="cashback"><span class="yellow"><?php echo $discount; ?> </span>cashback</label>
                                    <?php }else{ ?>
                                    <label class="cashback"><span class="yellow">0% </span>cashback</label>
                                    <?php } ?>
                                    </div>
                                    <div class="view-offer">
                                    	<?php if($value['coupon_count']>0){ ?>
	                            	           <a href="<?php echo base_url("couponlist/".$new_title."-".$value['id']); ?>"><btn class="btn btn-warning btn-round btn-wide fw-700">GET OFFER</btn></a>
                                        <?php }else{ 
										//print_r($user_details);
                    	                    if(isset($user_details) && sizeof($user_details)>0){ 
										?>
		                				      <a href="<?php echo base_url('oprocess/'.$value['id']."/".rand(1000,9999).date('ymdhis')); ?>" class="signinuseroffer buybutton" rel="<?php echo $value['id']; ?>" data-url="<?php echo $value['url']; ?>" title="<?php echo html_entity_decode($value['title']); ?>" target="_blank" ><btn class="btn btn-warning btn-round btn-wide fw-700">GET OFFER</btn></a>
		        		            <?php }else{ ?>
                                                <a href="<?php echo $value['url']; ?>" class="sign-in-btn buybutton"><btn class="btn btn-warning btn-round btn-wide fw-700">GET OFFER</btn></a>
									<?php }} ?>
                            <br />
                            <div style="font-size:11px; margin-top:2px; color:#000; font-weight:800;"><?php echo $value['coupon_count']; ?> Offers Available</div>
                                    </div>
                                </div>
                </div>
            <?php } ?>
              </div></div></div>  
            </div>
        </div>

    </section>
    <!--<section class="testimonials" style=" background:#EEEEEE;">
        <div class="container text-center">
            <h2 class="fw-300">People who have saved money from Cashkarle</h2>
            <h1 style="font-weight:700">TOP <span style="color:#16A75A">SAVERS</span></h1>
            <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-top:50px;margin-bottom:10px;">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                </ol>

                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <div class="col-md-4">
                            <img src="<?php echo base_url(); ?>assets/img/polandha.png" alt="polandha">
                            <h3 class="fw-700 green"> Sumat</h3>
                            <p class="quote" style="color:#4e4e4e">"I have saved Rs 3000 from pricekarle” just for the last month. i love this website a lot and i have suggested thid to all my friends"</p>
                        </div>
                        <div class="col-md-4">
                            <img src="<?php echo base_url(); ?>assets/img/polandha.png" alt="polandha">
                            <h3 class="fw-700 green"> Sumat</h3>
                            <p class="quote" style="color:#4e4e4e">" I have saved Rs 3000 from pricekarle” just for the last month. i love this website a lot and i have suggested thid to all my friends"</p>
                        </div>
                        <div class="col-md-4">
                            <img src="<?php echo base_url(); ?>assets/img/polandha.png" alt="polandha">
                            <h3 class="fw-700 green"> Sumat</h3>
                            <p class="quote" style="color:#4e4e4e">"I have saved Rs 3000 from pricekarle” just for the last month. i love this website a lot and i have suggested thid to all my friends"</p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="col-md-4">
                            <img src="<?php echo base_url(); ?>assets/img/polandha.png" alt="polandha">
                            <h3 class="fw-700 green"> Sumat</h3>
                            <p class="quote" style="color:#4e4e4e">"I have saved Rs 3000 from pricekarle” just for the last month. i love this website a lot and i have suggested thid to all my friends"</p>
                        </div>
                        <div class="col-md-4">
                            <img src="<?php echo base_url(); ?>assets/img/polandha.png" alt="polandha">
                            <h3 class="fw-700 green"> Sumat</h3>
                            <p class="quote" style="color:#4e4e4e">" I have saved Rs 3000 from pricekarle” just for the last month. i love this website a lot and i have suggested thid to all my friends"</p>
                        </div>
                        <div class="col-md-4">
                            <img src="<?php echo base_url(); ?>assets/img/polandha.png" alt="polandha">
                            <h3 class="fw-700 green"> Sumat</h3>
                            <p class="quote" style="color:#4e4e4e">" I have saved Rs 3000 from pricekarle” just for the last month. i love this website a lot and i have suggested thid to all my friends"</p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="col-md-4">
                            <img src="<?php echo base_url(); ?>assets/img/polandha.png" alt="polandha">
                            <h3 class="fw-700 green"> Sumat</h3>
                            <p class="quote" style="color:#4e4e4e">" I have saved Rs 3000 from pricekarle” just for the last month. i love this website a lot and i have suggested thid to all my friends"</p>
                        </div>
                        <div class="col-md-4">
                            <img src="<?php echo base_url(); ?>assets/img/polandha.png" alt="polandha">
                            <h3 class="fw-700 green"> Sumat</h3>
                            <p class="quote" style="color:#4e4e4e">" I have saved Rs 3000 from pricekarle” just for the last month. i love this website a lot and i have suggested thid to all my friends"</p>
                        </div>
                        <div class="col-md-4">
                            <img src="<?php echo base_url(); ?>assets/img/polandha.png" alt="polandha">
                            <h3 class="fw-700 green"> Sumat</h3>
                            <p class="quote" style="color:#4e4e4e">" I have saved Rs 3000 from pricekarle” just for the last month. i love this website a lot and i have suggested thid to all my friends"</p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="col-md-4">
                            <img src="<?php echo base_url(); ?>assets/img/polandha.png" alt="polandha">
                            <h3 class="fw-700 green"> Sumat</h3>
                            <p class="quote" style="color:#4e4e4e">“I have saved Rs 3000 from pricekarle” just for the last month. i love this website a lot and i have suggested thid to all my friends"</p>
                        </div>
                        <div class="col-md-4">
                            <img src="<?php echo base_url(); ?>assets/img/polandha.png" alt="polandha">
                            <h3 class="fw-700 green"> Sumat</h3>
                            <p class="quote" style="color:#4e4e4e">“I have saved Rs 3000 from pricekarle” just for the last month. i love this website a lot and i have suggested thid to all my friends"</p>
                        </div>
                        <div class="col-md-4">
                            <img src="<?php echo base_url(); ?>assets/img/polandha.png" alt="polandha">
                            <h3 class="fw-700 green"> Sumat</h3>
                            <p class="quote" style="color:#4e4e4e">“I have saved Rs 3000 from pricekarle” just for the last month. i love this website a lot and i have suggested thid to all my friends"</p>
                        </div>

                    </div>
                </div>

            </div>
            <button type="button" class="btn1 btn-success" style="height:40px; font-size:18px; padding:0 50px; margin:50px 0 50px 0;">SEE ALL</button>
        </div>

    </section>-->