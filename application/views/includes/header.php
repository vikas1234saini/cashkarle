<!DOCTYPE html> 
<html lang="en-US">
<head>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/favicon.ico" type="image/x-icon">
  <title>Cashkarle</title>
  <meta charset="utf-8">
	<link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/admin.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js" type="text/javascript"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.0.0/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>  
    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.4.0/lang/en-gb.js" type="text/javascript"></script>
	 <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    
    <style>	
	.error {
		color: #000;
		background-color: #ff8888;
		border-color: rgba(238, 77, 99,1);
		padding: 4px;
		padding-left:0px;
		width: 250px;
		margin-bottom: 10px;
		border: 1px solid transparent;
		border-radius: 2px;
		margin-left:10px;
		font-weight:bolder;
	}
	.dropdown-menu li ul li{ list-style:none;}
	.dropdown-menu li{ list-style:none; margin-left:10px;}
	.dropdown-menu li ul{ margin:0px;}
	</style>
    
</head>
<body>
   	<?php $login_user_details = $this->session->userdata('user_details'); ?>
	<div class="navbar navbar-fixed-top">
	  <div class="navbar-inner">
	    <div class="container">
	      <a class="brand" style="color:#999999;">Cashkarle Welcome's <?php echo $login_user_details[0]['admin_first_name']; ?></a>
	      <ul class="nav">
          
            <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Discounts<b class="caret"></b></a>
	          <ul class="dropdown-menu">
	            <li>
	              <a href="<?php echo base_url(); ?>admin/snapdealdiscount">Snapdeal</a>
	            </li>
	            <li>
	              <a href="<?php echo base_url(); ?>admin/amazondiscount">Amazon</a>
	            </li>
	            <li>
	              <a href="<?php echo base_url(); ?>admin/flipkartdiscount">Flipkart</a>
	            </li>
	            <li>
	              <a href="<?php echo base_url(); ?>admin/flipkartofferdiscount">Flipkart Offer</a>
	            </li>
	          </ul>
	        </li>
	        <!--<li <?php if($this->uri->segment(3) == 'category'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/category">Category</a>
	        </li>-->
	        <li <?php if($this->uri->segment(3) == 'brand'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/brand">Brand</a>
	        </li>
	        <li <?php if($this->uri->segment(3) == 'product'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/product">Product</a>
	        </li>
	        <li <?php if($this->uri->segment(3) == 'offer'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/offer">Offer</a>
	        </li>
	       <!-- <li <?php if($this->uri->segment(3) == 'coupon'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/coupon">Coupon</a>
	        </li>-->
	        <li <?php if($this->uri->segment(3) == 'banner'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/banner">Banner</a>
	        </li>
	        <li <?php if($this->uri->segment(3) == 'user'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/user">User</a>
	        </li>
	        <li <?php if($this->uri->segment(3) == 'ticket'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/ticket">Ticket</a>
	        </li>
	        <li <?php if($this->uri->segment(3) == 'newsletter'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/newsletter">Newsletter</a>
	        </li>
	        <li <?php if($this->uri->segment(3) == 'contact'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/contact">Contact Us</a>
	        </li>
            <?php if(strtolower($login_user_details[0]['admin_login_name'])==strtolower('admin')){ ?>
	        <li <?php if($this->uri->segment(3) == 'agent'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/agent">Admin User</a>
	        </li>
            <li <?php if($this->uri->segment(3) == 'log'){echo 'class="active"';}?>>
	          <a href="<?php echo base_url(); ?>admin/log">Cron Log</a>
	        </li>
            <?php } ?>
            <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Export<b class="caret"></b></a>
	          <ul class="dropdown-menu">
	            <li>
	              <a href="<?php echo base_url(); ?>admin/export/discount">Export Discount</a>
	              <a href="<?php echo base_url(); ?>admin/export/brand">Export Brand</a>
	              <a href="<?php echo base_url(); ?>admin/export/product">Export Product</a>
	              <a href="<?php echo base_url(); ?>admin/export/offer">Export Offer</a>
	              <a href="<?php echo base_url(); ?>admin/export/user">Export User</a>
	              <a href="<?php echo base_url(); ?>admin/export/ticket">Export Ticket</a>
	            </li>
	          </ul>
	        </li>
            <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">System<b class="caret"></b></a>
	          <ul class="dropdown-menu">
	            <li>
	              <a href="<?php echo base_url(); ?>admin/logout">Logout</a>
	            </li>
	          </ul>
	        </li>
	      </ul>
	    </div>
	  </div>
	</div>