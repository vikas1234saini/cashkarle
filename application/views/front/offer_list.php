    <div class="hero">
        <div class="container">
            <div class="row" style="margin:0px;">
            	<a href="<?php echo base_url(); ?>">Home</a> \ Top Coupons
            </div>
            <div class="row">
            	
                <div class="col-md-12 col-sm-7">
                	<div class="col-md-12 col-sm-7">
                    	
                       
                        <div style="padding-left:20px;" class="couponlist"><h4 class="fontbold"> Top Coupons</h4></div>
                        <div class="couponlist row" id="couponlist">
                        <?php 
							if(sizeof($offerlist)>0){
                                foreach($offerlist as $key => $value){
									
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
		                				      <a href="<?php echo base_url('oprocess/'.$value['id']."/".rand(1000000,9999999).date('ymdhis')); ?>" class="signinuseroffer" rel="<?php echo $value['id']; ?>" data-url="<?php echo $value['url']; ?>" title="<?php echo html_entity_decode($value['title']); ?>" target="_blank" >
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
		                				      <a href="<?php echo base_url('oprocess/'.$value['id']."/".rand(1000000,9999999).date('ymdhis')); ?>" class="signinuseroffer" rel="<?php echo $value['id']; ?>" data-url="<?php echo $value['url']; ?>" title="<?php echo html_entity_decode($value['title']); ?>" target="_blank" >
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
		                				      <a href="<?php echo base_url('oprocess/'.$value['id']."/".rand(1000000,9999999).date('ymdhis')); ?>" class="signinuseroffer buybutton" rel="<?php echo $value['id']; ?>" data-url="<?php echo $value['url']; ?>" title="<?php echo html_entity_decode($value['title']); ?>" target="_blank" ><btn class="btn btn-warning btn-round btn-wide fw-700">GET OFFER</btn></a>
		        		            <?php }else{ ?>
                                                <a href="<?php echo $value['url']; ?>" class="sign-in-btn buybutton"><btn class="btn btn-warning btn-round btn-wide fw-700">GET OFFER</btn></a>
									<?php }} ?>
                            <br />
                            <div style="font-size:11px; margin-top:2px; color:#000; font-weight:800;"><?php echo $value['coupon_count']; ?> Offers Available</div>
                                    </div>
                                </div>
                            </div>
						<?php    
								} 
							}else {
								echo '<div class="col-md-12 aligncenter fontbold" style="border: solid 1px #ccc; margin:10px; padding:10px;">No Coupon Found.</div>';
							}
						?>
                       </div>     
                     </div>   
                </div>
            </div>
        </div>
    </div>
    