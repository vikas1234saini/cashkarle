<style>
.jzoom {
	max-width: 250px;
	max-height: 250px;
}
</style>
<?php
	$user_details = array();
	if ($this->session->userdata('fuser_details') !== FALSE) {
		$user_details = $this->session->userdata('fuser_details');
	}
	$find = array("CPRC", "CPA","CPS","CPL"," - India");
	$replace = array("","","","","");
	$discount = "0%";
	if(isset($offer_details[0]['discount']) && $offer_details[0]['discount']!=''){
		$discount = " ".$offer_details[0]['discount']." ".$offer_details[0]['discount_type'];
	}

?>
    <div class="hero">
        <div class="container">
            <div class="row" style="margin:0px;">
            	<a href="<?php echo base_url(); ?>">Home</a> \ <a href="<?php echo base_url('top-coupon'); ?>">Coupon</a> \ <?php echo str_replace($find,$replace,$offer_details[0]['title']); ?>
            </div>
            <div class="row" >
            
            <div class="col-md-3 col-sm-7" style="margin:10px 0; border: solid #CCC 1px; padding:15px 10px; border-radius:10px;">
            	
                 <div style="height:120px; position:relative;"><img src="<?php echo $offer_details[0]['image']; ?>" style="position:absolute;    top:0;    bottom:0;    margin:auto; max-height:110px; padding-top:10px; left:0; right:0;"></div>
                 <div class="product-name" style="height:40px; text-align:center;">
						<?php 
							$discount = "";
							if(isset($offer_details[0]['discount']) && $offer_details[0]['discount']!=''){
								$discount = " ".$offer_details[0]['discount']." ".$offer_details[0]['discount_type'];
							}
    	                    $find = array("CPRC", "CPA","CPS","CPL"," - India");
	                        $replace = array("","","","","");
							if($discount!=''){
                        		echo html_entity_decode(str_replace($find,$replace,$offer_details[0]['title']))." + ".$discount ; 
							}else{
                        		echo html_entity_decode(str_replace($find,$replace,$offer_details[0]['title'])); 
							}
						?>
                </div>
            </div>
            
                <div class="col-md-8 col-sm-7" >
            <?php foreach($couponlist as $key => $value){ ?>
            	
                <div class="col-md-12 col-sm-7" style="margin:10px 0; border: solid #CCC 1px; padding:15px 10px; border-radius:10px;">
            	<div>
                
					<?php if(isset($user_details) && sizeof($user_details)>0){ ?>
                		<a href="<?php echo base_url('oprocess/'.$value['id']."/".rand(1000000,9999999).date('ymdhis'); ?>" style="cursor:pointer;" class="signinuseroffer" rel="<?php echo $value['id']; ?>" data-url="<?php echo $value['link']; ?>" target="_blank"><label class="cashback"><span class="yellow" style="color:#23C670; cursor:pointer;"><?php echo html_entity_decode($value['coupon_title']); ?></span></label><?php echo $discount; ?></a>
                    <?php }else{ ?>
                        <a href="<?php echo $value['link']; ?>" style="cursor:pointer;"><label class="cashback"><span class="yellow" style="color:#23C670; cursor:pointer;"><?php echo html_entity_decode($value['coupon_title']); ?></span></label></a>
                    <?php } ?>
                </div>
            	<div >
                	<?php echo html_entity_decode(html_entity_decode($value['coupon_description']));//echo html_entity_decode(str_replace('&amp;','&',$value['coupon_description'])); ?>
                </div>
            	<div style="margin-top:20px;" class="col-md-7 col-sm-7" >
                	<!--<div  style="padding:0px;"><strong>Promo Code: <?php echo $value['promo_id']; ?></strong></div>-->
                	<div ><strong>Added date: <?php echo date('d M Y',strtotime($value['added'])); ?></strong>,&nbsp;&nbsp;&nbsp;&nbsp;<strong>End Date: <?php echo date('d M Y',strtotime($value['coupon_expiry'])); ?></strong></div>
                </div>
                <div class="col-md-4 col-sm-7" >
                	<?php 
						$title = "Grab Offer";
						if($value['coupon_type']=='Coupon'){
							$title = "Get Coupon";
							
						}
					?>
                    <?php
						$extraval = "userid";
						if(strtolower($offer_details[0]['sitename'])=='flipkart'){
							$extraval = 'affExtParam1';
						}
					?>
					<?php if(isset($user_details) && sizeof($user_details)>0){ ?>
                       <!-- <a href="<?php echo $offer_details[0]['url']; ?><?php echo "&userid=".$user_details[0]['id'];?>" target="_blank" style="float:right; margin:20px; background:#F5A623; color:#FFF; font-size:20px; padding:10px 20px; font-weight:bold; border-radius:30px; text-decoration:none;">BUY NOW</a>-->
                       <a href="<?php echo base_url('oprocess/'.$value['id']."/".rand(1000000,9999999).date('ymdhis')); ?>" class="signinuseroffer" rel="<?php echo $value['id']; ?>" data-url="<?php echo $offer_details[0]['url']; ?><?php echo "&".$extraval."=".$user_details[0]['id'];?>" target="_blank" style="float:right; margin:20px; background:#F5A623; color:#FFF; font-size:18px; padding:5px 10px; font-weight:bold; border-radius:30px; text-decoration:none;"><?php echo $title ?></a>
                    <?php }else{ ?>
                        <a href="<?php echo $value['link']; ?>" style="float:right; margin:20px; background:#F5A623; color:#FFF; font-size:18px; padding:5px 10px; font-weight:bold; border-radius:30px; text-decoration:none;" class="sign-in-btn buybutton"><?php echo $title ?></a>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
            </div>
            </div>
        </div>
    </div>