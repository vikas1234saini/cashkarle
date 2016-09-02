<?php
	$user_details = array();
	if ($this->session->userdata('fuser_details') !== FALSE) {
		$user_details = $this->session->userdata('fuser_details');
	}
?>
    <div class="hero">
        <div class="container">
            <div class="row" style="margin:0px;">
	            <?php if(isset($search)){ ?>
    	        	<a href="<?php echo base_url(); ?>">Home</a> \ <?php echo isset($skey)?$skey:""; ?>
                <?php }elseif(isset($top_coupon)){ ?>
    	        	<a href="<?php echo base_url(); ?>">Home</a> \ Top Coupon
                <?php }else{ ?>
    	        	<a href="<?php echo base_url(); ?>">Home</a> \ Top Product
                <?php } ?>
            </div>
            <div class="row">
                <!--Filters Section-->
                <div id="filter-panel-wrapper" class="filter-panel-slide-in">
            	   <button id="filter-panel-wrapper-toggle">Filters <i class="fa fa-filter"></i></button>
                   <div class="col-md-2 col-sm-3 ofh searchside" style="padding-right:0px;">
                    <form name="frmsearchatt" id="frmsearchatt" method="post">
                    	<?php if(isset($search)){ ?>
                            <div class="green fontbold font16" id="topsort">Sort By</div>
                            <div class="borderbottom font13">
                                <div><input type="radio" name="onlypc" id="onlyp" value="onlyproduct" /><label for="onlyp">Only Products</label></div>
                                <div><input type="radio" name="onlypc" id="onlyc" value="onlycoupon" /><label for="onlyc">Only Coupons</label></div>
                                <div><input type="radio" name="onlypc" id="onlyboth" value="onlyboth" /><label for="onlyboth">Both</label></div>
                            </div>
                        <?php } ?>
                    	<?php if(isset($search) || isset($top_product)){ ?>
                        <div class="green fontbold font16" style="margin-top:20px;">By Price</div>
                        <div class="borderbottom font13">
                            <div><input type="radio" name="byprice" id="b100" value="1-100" /><label for="b100">Below 100</label></div>
                            <div><input type="radio" name="byprice" id="100500" value="100-500" /><label for="100500">100-500</label></div>
                            <div><input type="radio" name="byprice" id="5001000" value="500-1000" /><label for="5001000">500-1000</label></div>
                            <div><input type="radio" name="byprice" id="10005000" value="1000-5000" /><label for="10005000">1000-5000</label></div>
                            <div><input type="radio" name="byprice" id="50001" value="5000-200000" /><label for="50001">Above 5000</label></div>
                        </div>
                        <?php } ?>
                        
                    	<?php 
							if(!isset($brand_set)){ 
						
                    		if(isset($search) || isset($top_product)){ 
						?>
                        <div class="green fontbold font16" style="margin-top:20px;">By Brand</div>
                        <div class="borderbottom font13 filter-by-brand">
                            <div><input type="radio" name="bybrand" id="allbarnd" value="all" /><label for="allbarnd">All</label></div>
                            <?php foreach($brandlistnew as $key=>$value){ ?>
	                            <div><input type="radio" name="bybrand" id="<?php echo $value['id']; ?>" value="<?php echo $value['brandName']; ?>" /><label for="<?php echo $value['id']; ?>"><?php echo $value['brandName']; ?></label></div>
                            <?php } ?>
                        </div>
                        <?php }} ?>
                        <div class="green fontbold font16" style="margin-top:20px;">By Cashback</div>
                        <div class="borderbottom font13">
                            <div><input type="radio" name="bycashback" id="c0" value="0" /><label for="c0">No Cashback</label></div>
                            <div><input type="radio" name="bycashback" id="c010" value="0-10" /><label for="c010">Below 10%</label></div>
                            <div><input type="radio" name="bycashback" id="c1020" value="10-20" /><label for="c1020">10% - 20%</label></div>
                            <div><input type="radio" name="bycashback" id="c2030" value="20-30" /><label for="c2030">20% - 30%</label></div>
                            <div><input type="radio" name="bycashback" id="c30" value="30-100" /><label for="c30">30% & Above</label></div>
                        </div>
                     <input type="hidden" name="category" value="<?php echo isset($category)?$category:"" ?>" />
                     <input type="hidden" name="category_name" value="<?php echo isset($category_name)?$category_name:"" ?>" />
                     <input type="hidden" name="pageno" id="pageno" value="1" />
                     <input type="hidden" name="search_key" value="<?php echo isset($skey)?$skey:"" ?>" />
                     <input type="hidden" name="search_for" value="<?php echo isset($search)?"search":(isset($top_product)?"top_product":"top_coupon"); ?>" />
                     <input type="hidden" name="brand" value="<?php echo isset($brand)?$brand:"" ?>" />
                     <div style="padding:10px; text-align:center;" ><input class="btn btn-warning btn-wide fw-700" type="button" onclick="window.location.reload();" name="btnreset" id="btnreset" value="Reset" /></div>
                     <input type="submit" style="display:none;" name="btnsubmitsearch" id="btnsubmitsearch" value="submit" />
                    </form>
                    </div>
                </div>
                <!--Product/Coupons Section-->
                <div class="col-md-10 col-sm-9">
                
                	
                    	<?php if(isset($search)){ ?>
                    	<div class="font16 aligncenter fontbold">Search Result For</div>
                        <div class="sitecolor font20 aligncenter ">"<?php echo str_replace("catsearch","Category",(isset($skey)?$skey:(isset($cskey)?$cskey:""))); ?>"</div>
                        <div class="lightcolor font13 fontbold" style="margin:20px;">Showing top products and coupons matching your search for <span class="sitecolor">"<?php echo str_replace("catsearch ","",(isset($skey)?$skey:(isset($cskey)?$cskey:""))); ?>"</span></div>
                        <?php } ?>
                        
                       <?php if(isset($offerlist) && sizeof($offerlist)>0){ ?> 
                        <div style="padding-left:20px; width:100%; float:left;" class="couponlist row"><h4 class="fontbold">Top Coupons</h4></div>
                        <div class="couponlist row" id="couponlist">
                        <?php 
							if(sizeof($offerlist)>0){
                                foreach($offerlist as $key => $value){
									$new_title 			= preg_replace("/[^0-9a-zA-Z ]/m", "", $value['title']);
									$new_title 			= strtolower(preg_replace("/ /", "-", $new_title));
									
									$discount = "";
									if(isset($value['discount']) && $value['discount']!=''){
										$discount = " ".$value['discount']." ".($value['discount_type']!=''?$value['discount_type']:"%");
									}
                        ?>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="product-item  coupon-item text-center " style="height:300px;">
                                    <div style="height:240px;">
                                    <div style="height:120px; position:relative;">
                                        <a href="<?php echo base_url("couponlist/".$new_title."-".$value['id']); ?>">
                                    <?php /*if($value['coupon_count']>0){ ?>
                                        <a href="<?php echo base_url("couponlist/".$new_title."-".$value['id']); ?>">
                                        <?php }else{ 
                    	                    if(isset($user_details) && sizeof($user_details)>0){
										?>
		                				      <a href="<?php echo base_url('oprocess/'.$value['id']."/".rand(1000,9999).date('ymdhis')); ?>" class="signinuseroffer" rel="<?php echo $value['id']; ?>" data-url="<?php echo $value['url']; ?>" title="<?php echo html_entity_decode($value['title']); ?>" target="_blank" >
		        		            <?php }else{ ?>
                                                <a href="<?php echo $value['url']; ?>" class="sign-in-btn buybutton">
									<?php } } */
										$productImg = $value['image']!=''?$value['image']:base_url("assets/img/noimage.png");
									?>
                                    <img src="<?php echo $productImg; ?>" style="position:absolute;    top:0;    bottom:0;    margin:auto; max-height:110px; padding-top:10px; left:0; right:0;"></a></div>
                                    <div class="product-name" style="height:40px;">
                                        <p>
                                        <a href="<?php echo base_url("couponlist/".$new_title."-".$value['id']); ?>">
                                        <?php /*if($value['coupon_count']>0){ ?>
                                        <a href="<?php echo base_url("couponlist/".$new_title."-".$value['id']); ?>">
                                        <?php }else{ 
                    	                    if(isset($user_details) && sizeof($user_details)>0){ 
										?>
		                				      <a href="<?php echo base_url('oprocess/'.$value['id']."/".rand(1000,9999).date('ymdhis')); ?>" class="signinuseroffer" rel="<?php echo $value['id']; ?>" data-url="<?php echo $value['url']; ?>" title="<?php echo html_entity_decode($value['title']); ?>" target="_blank" >
		        		            <?php }else{ ?>
                                                <a href="<?php echo $value['url']; ?>" class="sign-in-btn buybutton">
									<?php } } */
									
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
                                     <a href="<?php echo base_url("couponlist/".$new_title."-".$value['id']); ?>"><btn class="btn btn-warning btn-round btn-wide fw-700">GET OFFER</btn></a>
                                    	<?php /*if($value['coupon_count']>0){ ?>
	                            	           <a href="<?php echo base_url("couponlist/".$new_title."-".$value['id']); ?>"><btn class="btn btn-warning btn-round btn-wide fw-700">GET OFFER</btn></a>
                                        <?php }else{ 
										//print_r($user_details);
                    	                    if(isset($user_details) && sizeof($user_details)>0){ 
										?>
		                				      <a href="<?php echo base_url('oprocess/'.$value['id']."/".rand(1000,9999).date('ymdhis')); ?>" class="signinuseroffer buybutton" rel="<?php echo $value['id']; ?>" data-url="<?php echo $value['url']; ?>" title="<?php echo html_entity_decode($value['title']); ?>" target="_blank" ><btn class="btn btn-warning btn-round btn-wide fw-700">GET OFFER</btn></a>
		        		            <?php }else{ ?>
                                                <a href="<?php echo $value['url']; ?>" class="sign-in-btn buybutton"><btn class="btn btn-warning btn-round btn-wide fw-700">GET OFFER</btn></a>
									<?php }}*/ ?>
                            <br />
                            <div style="font-size:11px; margin-top:2px; color:#000; font-weight:800;"><?php echo $value['coupon_count']; ?> Offers Available</div>
                                    </div>
                                </div>
                            </div>
						<?php    
								} 
							}else {
								echo '<div class="col-md-12 aligncenter fontbold" style="border: solid 1px #ccc; margin:10px; padding:10px;">No Coupon Found.</div>';
								echo '<script>olist = 0;</script>';
							}
						?>
                       </div>
                       <?php } ?>     
	                <?php if(isset($productlist)){ ?>
                        <div style="padding-left:20px;" class="productlist"><h4 class="fontbold">Top Products</h4></div>
                        <div class="productlist" id='productlist'>
                        <?php
                            $counter = 0;
							if(sizeof($productlist)>0){
								foreach ($productlist as $product) {
									if($product['image']!=''){
										$counter++;
										if($counter>18){
											break;	
										}
										$productId 			= $product['product_main_id'];
										$title 				= $product['title'];
										$productDescription = $product['description'];
										$productImage 		= $product['image']!=''?$product['image']:base_url("assets/img/noimage.png");
										$sellingPrice 		= $product['selling_price'];
										$productUrl 		= $product['url'];
										$productBrand 		= $product['brand'];
										$maximumRetailPrice	= $product['retail_price'];
										$sitename			= $product['sitename'];
										$cashback			= $product['discount'];
										
										$cashback = 0;
										if($product['sitename']=='snapdeal'){
											/*if($product['retail_price']>2500){
												$cashback		= $product['snapdeal_discount_2500'];
											}else{
												$cashback		= $product['snapdeal_discount'];
											}*/
											$cashback		= $product['snapdeal_discount'];
										}else if($product['sitename']=='flipkart'){
											$cashback		= $product['flipkart_discount'];
										}else if($product['sitename']=='amazon'){
											$cashback		= $product['amazon_discount'];
										}
										/*if($sitename=='snapdeal'){
											if($maximumRetailPrice>2500){
												$cashback		= $product['snapdeal_discount_2500'];
											}else{
												$cashback		= $product['snapdeal_discount'];
											}
										}else if($sitename=='flipkart'){
											$cashback		= $product['flipkart_discount'];
										}else if($sitename=='amazon'){
											$cashback		= $product['amazon_discount'];
										}*/
										
										$new_title 			= preg_replace("/[^0-9a-zA-Z ]/m", "", $title);
										$new_title 			= strtolower(preg_replace("/ /", "-", $new_title));
										$categoryName 		= strtolower(preg_replace("/ /", "-", ($product['categoryName']!=""?$product['categoryName']:"amazon")));
										
						?>
									  <div class="col-md-4 col-sm-6 col-xs-12">
											<div class="product-item text-center ">
                                            
                                        	<div style="height:<?php if($productImage!=''){?>370px<?php }else{ ?>350px<?php } ?>;">
												<div style="height:150px; position:relative"><a href="<?php echo base_url($categoryName."/".$new_title."-".$product['id']); ?>" ><img src="<?php echo $productImage; ?>" style="overflow:hidden;max-height:150px;overflow:hidden;padding-top:5px;position:absolute;    top:0;    bottom:0;  margin:auto; left:0; right:0;"></a></div>
												<div class="product-name">
													<p><?php echo mb_strimwidth($title,0,30,"..."); ?></p>
			                                        <p>By: <img src="<?php echo base_url("assets/img/".$sitename.".png"); ?>" width="70" /></p>
			
												</div>
												<p class="actual-price"> ACTUAL PRICE RS <?php echo $maximumRetailPrice; ?></p>
												<p class="fw-400 price" style="text-align:center !important;"> Rs <?php echo $sellingPrice; ?></p>
                                                <p style="font-size:18px;"><strong>+</strong></p>
												<?php if($cashback!=0 && $cashback!=""){ ?>
												<label class="cashback"><span class="yellow"><?php echo $cashback ?>% </span>cashback</label>
												<?php }else{ ?>
												<label class="cashback"><span class="yellow">0% </span>cashback</label>
												<?php } ?>
                                                </div>
												<div class="view-offer">
													<btn class="btn btn-warning btn-round btn-wide fw-700"><a href="<?php echo base_url($categoryName."/".$new_title."-".$product['id']); ?>" >VIEW OFFER</a></btn>
												</div>
											</div>
										</div>
						<?php    
								}
								}
								foreach ($productlist as $product) {
									if($product['image']==''){
										$counter++;
										if($counter>18){
											break;	
										}
										$productId 			= $product['product_main_id'];
										$title 				= $product['title'];
										$productDescription = $product['description'];
										$productImage 		= $product['image']!=''?$product['image']:base_url("assets/img/noimage.png");
										$sellingPrice 		= $product['selling_price'];
										$productUrl 		= $product['url'];
										$productBrand 		= $product['brand'];
										$maximumRetailPrice	= $product['retail_price'];
										$sitename			= $product['sitename'];
										$cashback			= $product['discount'];
										
										$cashback = 0;
										if($product['sitename']=='snapdeal'){
											/*if($product['retail_price']>2500){
												$cashback		= $product['snapdeal_discount_2500'];
											}else{
												$cashback		= $product['snapdeal_discount'];
											}*/
											$cashback		= $product['snapdeal_discount'];
										}else if($product['sitename']=='flipkart'){
											$cashback		= $product['flipkart_discount'];
										}else if($product['sitename']=='amazon'){
											$cashback		= $product['amazon_discount'];
										}
										/*if($sitename=='snapdeal'){
											if($maximumRetailPrice>2500){
												$cashback		= $product['snapdeal_discount_2500'];
											}else{
												$cashback		= $product['snapdeal_discount'];
											}
										}else if($sitename=='flipkart'){
											$cashback		= $product['flipkart_discount'];
										}else if($sitename=='amazon'){
											$cashback		= $product['amazon_discount'];
										}*/
										
										$new_title 			= preg_replace("/[^0-9a-zA-Z ]/m", "", $title);
										$new_title 			= strtolower(preg_replace("/ /", "-", $new_title));
										$categoryName 		= strtolower(preg_replace("/ /", "-", ($product['categoryName']!=""?$product['categoryName']:"amazon")));
										
						?>
									  <div class="col-md-4 col-sm-6 col-xs-12">
											<div class="product-item text-center ">
                                            
                                        	<div style="height:<?php if($productImage!=''){?>370px<?php }else{ ?>350px<?php } ?>;">
												<div style="height:150px; position:relative"><a href="<?php echo base_url($categoryName."/".$new_title."-".$product['id']); ?>" ><img src="<?php echo $productImage; ?>" style="overflow:hidden;max-height:150px;overflow:hidden;padding-top:5px;position:absolute;    top:0;    bottom:0;  margin:auto; left:0; right:0;"></a></div>
												<div class="product-name">
													<p><?php echo mb_strimwidth($title,0,30,"..."); ?></p>
			                                        <p>By: <img src="<?php echo base_url("assets/img/".$sitename.".png"); ?>" width="70" /></p>
			
												</div>
												<p class="actual-price"> ACTUAL PRICE RS <?php echo $maximumRetailPrice; ?></p>
												<p class="fw-400 price" style="text-align:center !important;"> Rs <?php echo $sellingPrice; ?></p>
                                                <p style="font-size:18px;"><strong>+</strong></p>
												<?php if($cashback!=0 && $cashback!=""){ ?>
												<label class="cashback"><span class="yellow"><?php echo $cashback ?>% </span>cashback</label>
												<?php }else{ ?>
												<label class="cashback"><span class="yellow">0% </span>cashback</label>
												<?php } ?>
                                                </div>
												<div class="view-offer">
													<btn class="btn btn-warning btn-round btn-wide fw-700"><a href="<?php echo base_url($categoryName."/".$new_title."-".$product['id']); ?>" >VIEW OFFER</a></btn>
												</div>
											</div>
										</div>
						<?php    
								}
								}
							}else {
								echo '<div class="col-md-12 aligncenter fontbold" style="border: solid 1px #ccc; margin:10px; padding:10px;">No Product Found.</div>';
								echo '<script>plist = 0;</script>';
							}
						?>
                       </div>
                       <?php } ?>
                      <div class="loaderlist" id='loaderlist'>
                      
                      </div>
                </div>
                
            </div>
        </div>
    </div>