<?php
	$extraval = "aff_sub";
	$para2 = "";
	if ($this->session->userdata('random_no') != FALSE && $this->session->userdata('random_no') != "") {
		$para2 = "&aff_sub2=".$this->session->userdata('random_no');
	}	
	if(isset($offer_details) && strtolower($offer_details[0]['id'])=='56'){
		$extraval = 'affExtParam1';
		if ($this->session->userdata('random_no') != FALSE && $this->session->userdata('random_no') != "") {
			$para2 = "&affExtParam2=".$this->session->userdata('random_no');
		}
	}
//	print_r($offer_details);
?>
<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
       	<meta http-equiv="refresh" content="3;<?php echo isset($product_details[0]['url'])?$product_details[0]['url']:(isset($product_details[0]['link'])?$product_details[0]['link']:"") ?><?php echo "&".$extraval."=".$user_details[0]['id'].$para2;?>" />
        <title>CashKarle</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/css/prettify.css" rel="stylesheet" id="bootstrap-css">
        <link href="<?php echo base_url(); ?>assets/css/livicons-help.css" rel="stylesheet" id="bootstrap-css">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-switch.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/jQueryThemes/start/jquery-ui-1.8.9.custom.css" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/style-overriden.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <section class="intermediary divider card-block">
            <div class="">
             <div class="row">
                 <div class="col-xs-12">
                     <div class="block">
                        <div class="block_inner">
            	<div style="text-align:center; border-bottom:solid 20px #E1E1E1; padding:20px 0; color:#999">
                	Hey, <span style="color:#57A4F4; font-weight:bolder;"><?php echo ucfirst($user_details[0]['username']); ?></span> Please wait while we transferring you in <br /> <span style="color:#57A4F4; font-weight:bolder;">few</span> Second(s)
                </div>
            	<div class="inter_h clearfix text-center">
                	<img class="fl" src="<?php echo base_url(); ?>assets/img/plogo.png" width="200"  alt="CashKarle.com"  />
                    <img class="fl" src="<?php echo base_url(); ?>assets/img/intermediary.gif" width="50" height="50" alt="loading..." />
                    <?php if(isset($product_details[0]['sitename']) && $product_details[0]['sitename']!='hasoffer'){ ?>
                    <img class="fl" src="<?php echo base_url("assets/img/".$product_details[0]['sitename'].".png"); ?>" width="150" alt="<?php echo $product_details[0]['sitename']; ?>" />
                    <?php }else{ ?>
                   <?php //echo isset($product_details[0]['title'])?$product_details[0]['title']:(isset($product_details[0]['coupon_title'])?$product_details[0]['coupon_title']:"") ?>
                     <img class="fl" src="<?php echo $offer_details[0]['image']!=''?$offer_details[0]['image']:base_url("assets/img/noimage.png"); ?>" style="max-width:150px;" alt="<?php echo isset($product_details[0]['title'])?$product_details[0]['title']:(isset($product_details[0]['coupon_title'])?$product_details[0]['coupon_title']:""); ?>" />
                   
                    <?php } ?>
                    </div>
                    <?php 
					$find = array("CPRC", "CPA","CPS","CPL"," - India");
					$replace = array("","","","","");
//					echo str_replace($find,$replace,$value['title']);
					?>
                    <div style="text-align:center; border-bottom:solid 1px #E1E1E1; padding:20px 0; color:#999">
                    	Transferring you to <span style="color:#57A4F4; font-weight:bolder;"><?php echo str_replace($find,$replace,ucfirst(isset($offer_details[0]['title'])?$offer_details[0]['title']:"")); ?></span>
                    </div>
                    
                    <div style="text-align:center; border-bottom:solid 1px #E1E1E1; padding:20px 0; color:#999">
                    	Shop and get cashback upto <span style="color:#57A4F4; font-weight:bolder; font-size:16px; font-weight:bold;"><?php echo $offer_details[0]['discount'] ?> <?php echo ($offer_details[0]['discount_type']!=''?$offer_details[0]['discount_type']:"%"); ?></span>
                        <br /><br />
                        Please allow upto <strong>48 hours</strong> for cashback to track in your Cashkarle account
                        <br /><br />
                        <span style="font-size:36px; font-family:cursive; color:#000; font-weight:bolder;">Enjoy Savings</span>
                    </div>
                    <!--<h1>CONGRATULATIONS, NOTHING MORE TO DO!</h1><h2>Enjoy saving on <?php echo isset($product_details[0]['title'])?$product_details[0]['title']:(isset($product_details[0]['coupon_title'])?$product_details[0]['coupon_title']:"") ?> via CashKarle.com, India's No.1 Coupon &amp; Cashback website!</h2>-->
                    <p class="mt mb text-center"><a class="link" href="<?php echo isset($product_details[0]['url'])?$product_details[0]['url']:(isset($product_details[0]['link'])?$product_details[0]['link']:"") ?><?php echo "&".$extraval."=".$user_details[0]['id'].$para2;?>" rel="nofollow" title="Click to earn cashback" style="text-decoration:none; color:#57A4F4;">Click here</a>&nbsp;&nbsp;if you are not automatically redirected within few seconds.</p></div>
                    </div>
                 </div>
             </div>
            </div>
        </section>
        <style>
            body {background-color: #eee;}
            /*Card*/
            .card-block {background-color: #fff;border: 1px solid #dbdbdb;transition: all 0.3s ease;padding: 15px;position: absolute;top: 10%;right: 10%;bottom: 10%;left: 10%;box-shadow: 0px 0px 29px #968E8E;}
            .card-block:hover {border: 1px solid #23C670;}
            @media only screen and (max-width: 500px) and (min-width: 1px){/*----------------------------- Megenta ---------------------*/
                /*body {background: #FF1B78!important;}*/
                .card-block{top: 15px;right: 15px;bottom: 15px;left: 15px;}
            }
            @media only screen and (max-width: 684px) and (min-width: 501px){/*----------------------------- Pink ---------------------*/
                /*body {background: #FF8484!important;}*/
                .card-block{top: 15px;right: 15px;bottom: 15px;left: 15px;}
            }
            @media only screen and (max-width: 767px) and (min-width: 685px){/*--------------------------- Yellow ---------------------*/
                /*body {background: #FFF784!important;}*/
            }
            @media (min-width: 768px) {/*----------------------------------------------------------------- Green ---------------------*/
                /*body {background: #BCFF84!important;}*/
            }
            @media (min-width: 992px) {/*----------------------------------------------------------------- Blue ---------------------*/
                /*body {background: #84E0FF!important;}*/
            }
            @media (min-width: 1200px) {/*---------------------------------------------------------------- Purple ---------------------*/
                /*body {background: #DD84FF!important;}*/
            }
        </style>
    </body>
</html>