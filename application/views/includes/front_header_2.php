<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico" type="image/x-icon">
      <link rel="icon" href="<?php echo base_url(); ?>assets/img/favicon.ico" type="image/x-icon">
      <title>Cash Karle</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
      <link href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
      <link href="<?php echo base_url(); ?>assets/css/prettify.css" rel="stylesheet" id="bootstrap-css">
      <link href="<?php echo base_url(); ?>assets/css/livicons-help.css" rel="stylesheet" id="bootstrap-css">
      <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
      <link href="<?php echo base_url(); ?>assets/css/bootstrap-switch.css" rel="stylesheet">
      <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jQueryThemes/start/jquery-ui-1.8.9.custom.css" type="text/css" />
      <meta name="google-signin-client_id" content="<?php echo GMAIL_CLIENT_ID; ?>">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
      <style>
         .dropdown-menu li div{ float:left; clear: none; width:200px;}
         .dropdown-menu li div span a:hover{ text-decoration:underline;}
         .well{ height:300px;}
         .col-md-3{ margin-top:0px;}
         .dropdown:hover .dropdown-menu {
         display: block;
         margin-top: 0;
         }
         ul p {margin: 0 0 2px; font-size:14px;}
         .category-item ul li,.brands-item ul li{ padding:2px; font-size:12px;}
         .category-nav ul li:hover{ font-weight:bold;}
         .category-item,.brands-item{ padding:10px;}
         .sitecolor{color:#23C670}
         .aligncenter{text-align:center;}
         .font12{ font-size:12px;}
         .font13{ font-size:13px;}
         .font14{ font-size:14px;}
         .font15{ font-size:15px;}
         .font16{ font-size:16px;}
         .font17{ font-size:17px;}
         .font18{ font-size:18px;}
         .font19{ font-size:19px;}
         .font20{ font-size:20px;}
         .fontbold{ font-weight:bold;}
         .lightcolor{ color:#CCC;}
         .view-offer a{ color:#FFF; text-decoration:none;}
         .searchside label{ font-weight:normal; margin-left:10px;}
         .borderbottom{ border-bottom:solid 1px #ccc; padding-bottom:10px; padding-top:10px;}
         .pull-right{ cursor:pointer;}
         .error{ color:#F00; text-align:left; font-weight:normal;}
         .category-item ul li a,.brands-item ul li a{ text-decoration:none; color:#9FA6AB;}
         .category-item ul li a:hover,.brands-item ul li a:hover{ text-decoration:none; color:#FFF;}
         #search-btn{background-color: #F5A623;border: 1px solid #F5A623;}
         .navbar-brand{ padding:0px;}
         .top-coupons a,.top-products a{ text-decoration:none; color:#FFF;}
         .top-coupons a:hover,.top-products a:hover{ text-decoration:none; color:#000; font-weight:600;}
         .profile-tab a{ text-decoration:none; color:#000;}
         .profile-tab a:hover{ text-decoration:none;}
         .userheadername{ text-align:left; margin-bottom:20px; font-size:24px; color:#23C670;}
         a{ cursor:pointer;}
         .navigation-bar{    position: fixed;    width: 100%;    top: 0px;    z-index: 100;}
         .profile,.hero{  margin-top:130px;}
         .view-offer{ padding:5px;}
         .product-item{ height:420px;}
         .ui-autocomplete{z-index:101;}
         .ui-menu .ui-menu-item a {
         text-decoration: none;
         display: block;
         padding: .2em .4em;
         line-height: 2;
         zoom: 1;
         font-size: 11px;
         }
         .product-name p{ position:relative;}
         .category-item p, .brands-item p{ font-size:12px;}
         .overlay {
         position: fixed;
         top: 0;
         left: 0;
         right: 0;
         bottom: 0;
         background-color: rgba(0, 0, 0, 0.85);
         z-index: 9999;
         color: white;
         display: none;
         }
         @media only screen and (max-width: 768px) {
         .category-nav ul li {
         width: 100%;
         height: 100%;
         }
         }
         .navbar-toggle {
         background-color:#AAA;
         }
         .navbar-toggle .icon-bar {
         background: #000;
         }
         .yamm .nav,
         .yamm .collapse,
         .yamm .dropup,
         .yamm .dropdown {
         position: static;
         }
         .yamm .container {
         position: relative;
         }
         .yamm .dropdown-menu {
         left: auto;
         }
         .yamm .yamm-content {
         padding: 20px 30px;
         }
         .yamm .dropdown.yamm-fw .dropdown-menu {
         left: 0;
         right: 0;
         }
      </style>
      <script>
         window.fbAsyncInit = function() {
         FB.init({
          appId      : '1059727190714180',
          xfbml      : true,
          version    : 'v2.5'
         });
         };
         
         (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));
      </script>
      <script type="text/javascript" src="http://platform.linkedin.com/in.js">
         api_key: 756nemw7pseelx
         onLoad:  Linkedin.init
      </script>
   </head>
   <body>
      <div class="overlay"><img src="<?php echo base_url(); ?>assets/img/loading.gif" style="position:absolute; left:0; right:0; top:0; bottom:0; margin:auto; width:50px" /></div>
      <!-- To Nevigation Bar -->
      <section class="navigation-bar">
         <div class="main-nav" style="overflow:visible;">
            <div class="container">
               <div class="row">
                  <div class="col-xs-4 col-md-2">
                     <a href="<?php echo base_url(); ?>" class="navbar-brand" style="color:#069;"><img src="<?php echo base_url(); ?>assets/img/logo.png" style="width:160px;z-index:999;"></a>
                  </div>
                  <div class="col-md-8 hidden-xs hidden-sm">
                     <form class="form search-bar" action="search" id="frmsearch" name="frmsearch" method="post">
                        <div class="form-group">
                           <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                           <div class="input-group">
                              <div class="input-group-addon" id="search-icon"></div>
                              <input type="text" class="form-control search-control " id="skey" name="key" placeholder="Search for products ,offers and Coupons" value="<?php echo isset($skey)?$skey:"";?>">
                              <div id="search-btn" class="input-group-addon btn btn-warning"  onclick="$(this).closest('form').submit();">SEARCH</div>
                              <input type="submit" name="sub" value="s" id="btnsubmit" style="display:none;" />
                              <?php if(isset($_GET['cid'])){ ?>
                              <input type="hidden" name="cid" id="cid" value="<?php echo $_GET['cid']; ?>" />
                              <?php } ?>
                              <input type="hidden" name="pid" id="pid" value="" />
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="col-xs-8 col-md-2 pull-right">
                     <?php if ($this->session->userdata('fis_logged_in') !== FALSE) { ?>
                     <span class="pull-right"><a href="<?php echo base_url('flogout'); ?>" style="color:#23C670;">Logout</a></span>
                     <span class="pull-right" style=" border-right: 1px solid #dbdbdb;"><a href="<?php echo base_url('myearning'); ?>" style="color:#23C670;">My Account</a></span>
                     <?php  }else{ ?>
                     <span class="pull-right sign-up-btn">JOIN US</span>
                     <span class="pull-right sign-in-btn" style=" border-right: 1px solid #dbdbdb;">SIGN IN</span>
                     <?php } ?>
                  </div>
               </div>
            </div>
         </div>Mudit
         <div class="category-nav text-center">
            <div class="container">
               <div class="navbar-header pull-right">
                  <button type="button" class="navbar-toggle" style="margin-left" data-toggle="collapse" data-target="#myNavbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>                        
                  </button>
               </div>
               <div class="hidden-md hidden-lg hidden-xl" style="width:80%">
                  <form class="form search-bar" action="search" id="frmsearch" name="frmsearch" method="post">
                     <div class="form-group">
                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                        <div class="input-group">
                           <div class="input-group-addon" id="search-icon"></div>
                           <input type="text" class="form-control search-control " id="skey" name="key" placeholder="Search for products ,offers and Coupons" value="<?php echo isset($skey)?$skey:"";?>">
                           <div id="search-btn" class="input-group-addon btn btn-warning"  onclick="$(this).closest('form').submit();">SEARCH</div>
                           <input type="submit" name="sub" value="s" id="btnsubmit" style="display:none;" />
                           <?php if(isset($_GET['cid'])){ ?>
                           <input type="hidden" name="cid" id="cid" value="<?php echo $_GET['cid']; ?>" />
                           <?php } ?>
                           <input type="hidden" name="pid" id="pid" value="" />
                        </div>
                     </div>
                  </form>
               </div>
               <div class="collapse navbar-collapse" id="myNavbar">
                  <ul class="unstyled nav navbar-nav" style="overflow:hidden;position:relative;">
                     <li class="category">Category</li>
                     <li class="brands">Brands</li>
                     <li class="top-products" onclick="window.location.href='<?php echo base_url('top-product'); ?>'">Top Products</li>
                     <li class="top-coupons" onclick="window.location.href='<?php echo base_url('top-coupon'); ?>'">Top Coupons</li>
                     <li class="top-coupons" data-toggle="modal" data-target="#myModal" style="float:right;">Top Users</li>
                     <li style="display:none;" class="termunsestand" data-toggle="modal" data-target="#termmodal" style="float:right;">Top Users</li>
                     <li style="display:none;" id="frontpopbtn" data-toggle="modal" data-target="#frontpop" style="float:right;">Firt pop</li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="container">
         <div class="category-drop-down" style="position:relative;">
         <div class="row" id="category-menu">
            <div class="category-item">
               <?php 
                  foreach ($list as $key => $data) {
                  	if($data['parentId']==0){
                  		
                  ?>
               <div class="col-md-3">
                  <ul class="electronics" style="height:170px;">
                  <p><?php echo ucwords(str_replace("_"," ",$data['categoryName'])); ?></p>
                  <?php 		
                     $counter_cat = 0;
                     foreach ($listnew as $data1) { 
                     	if($data1['parentId']==$data['id']){
                     		$counter_cat++;
                     		if($counter_cat>6){
                     			continue;
                     		}
                     		
                     ?>                    
                  <li><a href="<?php echo base_url( strtolower(str_replace(" ","-",$data1['categoryName']))."-".$data1['id']); ?>"><?php echo mb_strimwidth(ucwords(str_replace("_"," ",$data1['categoryName'])),0,28,'...'); ?></a></li>
                  <?php 			} 
                     }
                     if($counter_cat>5){
                     	echo "<li><a href='".base_url('category/'.$data['id'])."' style='color:#F5A623'><strong>View All</strong></a></li></ul></div>";
                     }else{
                     	echo "</ul></div>";
                     }
                     }
                     } 
                     ?>
               </div>
               <div class="brands-item">
                  <?php
                     foreach ($brandlist as $key => $data) {
                     	if($data['parentId']==0){	
                     ?>
                  <div class="col-md-3">
                     <ul class="electronics">
                     <p><?php echo ucwords(str_replace("_"," ",$data['brandName'])); ?> Brand</p>
                     <?php 		
                        foreach ($brandlistnew as $data1) { 
                        	if($data1['parentId']==$data['id']){
                        		
                        ?>                    
                     <li><a href="<?php echo base_url("brand/".strtolower(str_replace(" ","-",$data1['brandName']))); ?>"><?php echo ucwords(str_replace("_"," ",$data1['brandName'])); ?></a></li>
                     <?php 			} 
                        }
                        echo "</ul></div>";
                        }
                        } 
                        ?>
                  </div>
               </div>
            </div>
         </div>
      </section>