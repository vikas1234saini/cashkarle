<style>
	.jzoom {
		max-width: 250px;
		max-height: 250px;
	}
	.morecontent span {
	    display: none;
	}
	.morelink {
		text-align:right;
	}
	.more{ display:none;}
</style>
<?php
	$user_details = array();
	if ($this->session->userdata('fuser_details') !== FALSE) {
		$user_details = $this->session->userdata('fuser_details');
	}
	$find = array("CPRC", "CPA","CPS","CPL"," - India");
	$replace = array("","","","","");
	$discount = "0.2%";
	if(isset($offer_details[0]['discount']) && $offer_details[0]['discount']!=''){
		$discount = " ".$offer_details[0]['discount']." ".($offer_details[0]['discount_type']!=''?$offer_details[0]['discount_type']:"%");
	}
	//	echo $offer_details[0]['id'];
	if($offer_details[0]['id']=='56'){	
		$discount = " 0.2%";
	}

?>
    <div class="hero">
        <div class="container">
            
            <div class="row" style="margin:0px;">
            	<div class="breadcrumb-holder">
            		<a href="<?php echo base_url(); ?>">Home</a> \ <a href="<?php echo base_url('top-coupon'); ?>">Coupon</a> \ <?php echo str_replace($find,$replace,$offer_details[0]['title']); ?>
            	</div>
            </div>

            <div class="row" >
            
	            <div class="col-sm-4 col-xs-12" style="margin-bottom:15px;">
	            	<div class="card-block">
	            		<div style="height:120px; position:relative;">
		                 <?php  if(isset($user_details) && sizeof($user_details)>0){ ?>
		  				      <a href="<?php echo base_url('oprocess/'.$offer_details[0]['id']."/".rand(1000000,9999999).date('ymdhis')); ?>" class="signinuseroffer" rel="<?php echo $offer_details[0]['id']; ?>" data-url="<?php echo $offer_details[0]['url']; ?>" title="<?php echo html_entity_decode($offer_details[0]['title']); ?>" target="_blank" >
						<?php }else{ ?>
		                            <a href="<?php echo $offer_details[0]['url']; ?>" class="sign-in-btn buybutton">
		                <?php } ?>
		                 		<img src="<?php echo $offer_details[0]['image']!=''?$offer_details[0]['image']:base_url("assets/img/noimage.png"); ?>" style="position:absolute;    top:0;    bottom:0;    margin:auto; max-height:110px; padding-top:10px; left:0; right:0; cursor:pointer;" ></a>
		                 </div>
		                 <div id="product_name_img" class="product-name" style="height:auto; padding-bottom:10px; text-align:center; font-weight:bold;">
								<?php
									if(isset($offer_details[0]['discount']) && $offer_details[0]['discount']!=''){
										$discount = " ".$offer_details[0]['discount']." ".($offer_details[0]['discount_type']!=''?$offer_details[0]['discount_type']:"%");
									}
		    	                    $find = array("CPRC", "CPA","CPS","CPL"," - India");
			                        $replace = array("","","","","");
									if($discount!=''){
		                        		echo html_entity_decode(str_replace($find,$replace,$offer_details[0]['title'])) ." + ".$discount ." Cashback" ; 
									}else{
		                        		echo html_entity_decode(str_replace($find,$replace,$offer_details[0]['title'])); 
									}
									
								?>
		                        <div style="text-align:left; width:100%; font-weight:normal;">
		                        <br />                        
									<?php 
		                                $desc = explode("<br>",$offer_details[0]['description']);
		                                echo html_entity_decode(str_replace($find,$replace,isset($desc[0])?$desc[0]:"")); 
		                            ?>
		                        </div>
		                </div>
	            	</div>
	            </div>
            
                <div class="col-sm-8 col-xs-12" >
		            <?php 
						$old_dis  = $discount;
						foreach($couponlist as $key => $value){ 					
							if($value['offer_id']=='412'){	
								$discount = "0.2%";
							}else{
								if($value['discount']!=''){
									$discount = $value['discount']." ".$value['discount_type'];
								}else{
									$discount = $old_dis;
								}
							}
					?>
            	
                <div class="">
					<div class="card-block offer-repeater">
	            		<!--Coupon Heading-->
	            		<div>
							<?php if(isset($user_details) && sizeof($user_details)>0){ ?>
		                		<a href="<?php echo base_url('ocprocess/'.$value['id']."/".rand(1000000,9999999).date('ymdhis')); ?>" style="cursor:pointer;" name="<?php echo $value['coupon_code']; ?>"  class="signinuseroffer" rel="<?php echo $value['id']; ?>" target="_blank" data-url="<?php echo $value['link']; ?>"><label class="cashback"><span class="yellow" style="color:#23C670; cursor:pointer;"><?php echo html_entity_decode($value['coupon_title']); ?> <?php echo $discount!=''?"+ ".$discount." more cashback":""; ?></span></label></a>
		                    <?php }else{ ?>
		                        <a href="<?php echo $value['link']; ?>" style="cursor:pointer;" class="sign-in-btn buybutton"><label class="cashback"><span class="yellow" style="color:#23C670; cursor:pointer;"><?php echo html_entity_decode($value['coupon_title']); ?> <?php echo $discount!=''?"+ ".$discount." more cashback":""; ?></span></label></a>
		                    <?php } ?>
	                	</div>
		            	
		            	<div class="more">
		                	<?php echo str_replace($value['coupon_code'],"XXXXXX",html_entity_decode(html_entity_decode($value['coupon_description']))); ?>
		                </div>
						<!--End Date-->
		            	<div class="coupon-end-date" >
		                	<!--<div  style="padding:0px;"><strong>Promo Code: <?php echo $value['promo_id']; ?></strong></div>-->
		                	<div ><!--<strong>Added date: <?php echo date('d M Y',strtotime($value['added'])); ?></strong>,&nbsp;&nbsp;&nbsp;&nbsp;--><strong>End Date: <?php echo date('d M Y',strtotime($value['coupon_expiry'])); ?></strong></div>
		                </div>
		                <!--Grab Offer-->
		                <div class="coupon-button" >
		                	<?php 
							//print_r($value);
								$title = "Grab Offer";
								if($value['coupon_type']=='Coupon'){
									$title = "Get Coupon";	
								}
							?>
							<?php
								if($value['coupon_type']!='Coupon'){
									if(isset($user_details) && sizeof($user_details)>0){ 
							?>
				                       <a href="<?php echo base_url('ocprocess/'.$value['id']."/".rand(1000000,9999999).date('ymdhis')); ?>" data-url="<?php echo $value['link']; ?>" class="signinuseroffer" rel="<?php echo $value['id']; ?>" target="_blank" name="<?php echo $value['coupon_code']; ?>"  style="float:right; margin:20px; background:#F5A623; color:#FFF; font-size:15px; padding:5px 10px; font-weight:bold; border-radius:30px; text-decoration:none;"><?php echo $title ?></a>
		        		            <?php }else{ ?>
		                		        <a href="<?php echo $value['link']; ?>" style="float:right; margin:20px; background:#F5A623; color:#FFF; font-size:15px; padding:5px 10px; font-weight:bold; border-radius:30px; text-decoration:none;" class="sign-in-btn buybutton"><?php echo $title ?></a>
		                    
		                    <?php 	}
									
								}else{ 
								
									if(isset($user_details) && sizeof($user_details)>0){ 
							?>
				                      <a href="<?php echo base_url('ocprocess/'.$value['id']."/".rand(1000000,9999999).date('ymdhis')); ?>" class="signinusercoupon" rel="<?php echo $value['id']; ?>" name="<?php echo $value['coupon_code']; ?>" data-url="<?php echo $value['link']; ?>" title="<?php echo html_entity_decode($value['coupon_title']); ?>" target="_blank" style="float:right; margin:5px; background:#F5A623; color:#FFF; font-size:15px; padding:5px 10px; font-weight:bold; border-radius:30px; text-decoration:none;"><?php echo $title ?></a><span id="couponcodedisplay<?php echo $value['id']; ?>" style="font-size:12px; text-align:center; line-height:30px; overflow:hidden; float:left;">Coupon code shown here</span>
		        		            <?php }else{ ?>
		                		        <a href="<?php echo $value['link']; ?>" style="float:right; margin:20px; background:#F5A623; color:#FFF; font-size:15px; padding:5px 10px; font-weight:bold; border-radius:30px; text-decoration:none;" class="sign-in-btn buybutton"><?php echo $title ?></a>
							<?php } } ?>
		                </div>
		                <div class="clearfix"></div>
	                </div>
	                <div class="clearfix"></div>
            	</div>
            	<div class="clearfix"></div>
            	<?php } ?>
            </div>
            </div>
        </div>
    </div>