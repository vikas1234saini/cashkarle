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

?>
    <div class="hero">
        <div class="container">
            <div class="row" style="margin:0px;">
            	<a href="<?php echo base_url(); ?>">Home</a> \ <a href="<?php echo base_url('top-coupon'); ?>">Coupon</a> \ <?php echo str_replace($find,$replace,$offer_details[0]['title']); ?>
            </div>
            <div class="row" style="margin:20px 0;">
            	<div class="col-md-3 col-sm-5 ofh" style="border:#CCC solid 1px; height:450px; text-align:center; margin-top:0px;">
                    <div><img src="<?php echo $offer_details[0]['image']; ?>" style="max-width:250px; max-height:250px; margin-top:20px;" /></div>
                    <?php if(isset($offer_details[0]['discount']) && $offer_details[0]['discount']!=0){ ?>
        	            <br/>
    	                <label class="cashback"><span class="yellow"><?php echo $offer_details[0]['discount']; ?>% </span>cashback</label>
                    <?php }else{ ?>
            	        <br/>
	                    <label class="cashback"><span class="yellow">0% </span>cashback</label>
                    <?php } ?>
                </div>
                <div class="col-md-8 col-sm-7" style="border:#CCC solid 1px; height:450px; margin-left:10px; margin-top:0px;">
                	<h2 style="margin-bottom:30px;"><strong><?php echo str_replace($find,$replace,$offer_details[0]['title']); ?></strong></h2>                    
                    <div><span style="color:#23C670;"><strong>OFFER BY</strong></span></div>
                    <div class="col-md-6 col-sm-5 ofh" >
                        <div><?php echo str_replace($find,$replace,$offer_details[0]['title']); ?></div>
                        <br />
                        <?php if($offer_details[0]['discount']!='' && $offer_details[0]['discount']!=0){ ?>
                        <div>
                        	<label class="cashback" style="color:#23C670; padding:20px 0; font-size:24px;"><?php echo $offer_details[0]['discount']; ?>% cashback</label>
                        </div>
                        <?php }else{?>
                        <div>
                        	<label class="cashback" style="color:#23C670; padding:20px 0; font-size:24px;">0% cashback</label>
                        </div>
                        <?php }?>
                        
                        <div><span style="color:#999; font-size:16px;"><strong>Terms & Condition</strong></span></div>
                        <div style="height:50px; margin-top:20px;"><span style="color:#999; font-size:16px; border:solid 1px #CCC; padding:5px 40px; overflow:hidden;">HOW IT WORKS?</span></div>
                        
						<?php if ($this->session->userdata('fis_logged_in') !== FALSE) { }else{ ?>
            	            <div>Please login if you want to avail this offer.</div>
                        <?php } ?>
                    </div>
                    <?php
						$extraval = "userid";
						if(strtolower($offer_details[0]['sitename'])=='flipkart'){
							$extraval = 'affExtParam1';
						}
					?>
                    <div class="col-md-12">
                    	<?php if(isset($user_details) && sizeof($user_details)>0){ ?>
	                       <!-- <a href="<?php echo $offer_details[0]['url']; ?><?php echo "&userid=".$user_details[0]['id'];?>" target="_blank" style="float:right; margin:20px; background:#F5A623; color:#FFF; font-size:20px; padding:10px 20px; font-weight:bold; border-radius:30px; text-decoration:none;">BUY NOW</a>-->
                           <a href="<?php echo base_url('oprocess/'.$offer_details[0]['id']."/".rand(1000000,9999999).date('ymdhis')); ?>" class="signinuseroffer" date-url="<?php echo $offer_details[0]['url']; ?><?php echo "&".$extraval."=".$user_details[0]['id'];?>" rel="<?php echo $offer_details[0]['id'] ?>" target="_blank" style="float:right; margin:20px; background:#F5A623; color:#FFF; font-size:20px; padding:10px 20px; font-weight:bold; border-radius:30px; text-decoration:none;">BUY NOW</a>
                        <?php }else{ ?>
	                        <a href="<?php echo $offer_details[0]['url']; ?>" style="float:right; margin:20px; background:#F5A623; color:#FFF; font-size:20px; padding:10px 20px; font-weight:bold; border-radius:30px; text-decoration:none;" class="sign-in-btn buybutton">BUY NOW</a>
                        
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>