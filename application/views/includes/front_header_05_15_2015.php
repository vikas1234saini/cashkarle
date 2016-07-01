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
        /*
        .dropdown-menu li div{ float:left; clear: none; width:200px;}
        .dropdown-menu li div span a:hover{ text-decoration:underline;}
        .dropdown:hover .dropdown-menu {display: block;margin-top: 0;}
        ul p {margin: 0 0 2px; font-size:14px;}
        .category-item ul li,.brands-item ul li{ padding:2px; font-size:12px;}
        .category-nav ul li:hover{ font-weight:bold;}
        .category-item,.brands-item{ padding:10px;}
        .category-item ul li a,.brands-item ul li a{ text-decoration:none; color:#9FA6AB;}
        .category-item ul li a:hover,.brands-item ul li a:hover{ text-decoration:none; color:#FFF;}
        .navigation-bar{position: fixed;width: 100%;top: 0px;z-index: 100;}
        .category-nav ul li {width: 100%;height: 100%;}
        .ui-menu .ui-menu-item a {text-decoration: none;display: block;padding: .2em .4em;line-height: 2;zoom: 1;font-size: 11px;}
        .category-item p, .brands-item p{ font-size:12px;}
        .navbar-toggle {background-color:#AAA;}
        .navbar-toggle .icon-bar {background: #000;}
        */
        .navbar-brand{ padding:0px;}
        .well{ height:300px;}
        .col-md-3{ margin-top:0px;}
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
        #search-btn{background-color: #F5A623;border: 1px solid #F5A623;}
        .top-coupons a,.top-products a{ text-decoration:none; color:#FFF;}
        .top-coupons a:hover,.top-products a:hover{ text-decoration:none; color:#000; font-weight:600;}
        .profile-tab a{ text-decoration:none; color:#000;}
        .profile-tab a:hover{ text-decoration:none;}
        .userheadername{ text-align:left; margin-bottom:20px; font-size:24px; color:#23C670;}
        a{cursor:pointer;}
        .profile,.hero{margin-top:130px;}
        .view-offer{padding:5px;}
        .product-item{height:420px;}
        .ui-autocomplete{z-index:101;}
        .product-name p{ position:relative;}
        .overlay {position: fixed;top: 0;left: 0;right: 0;bottom: 0;background-color: rgba(0, 0, 0, 0.85);z-index: 9999;color: white;display: none;}

        /**/

        .navbar-default {color: #fff;background-color: #444244;border-color: transparent;font-size: 13px;text-transform: uppercase;}
        .navbar-default .navbar-nav > li > a{color:#fff;}
        .navbar-default .navbar-nav > .dropdown > a .caret{border-top-color: #fff;border-bottom-color: #fff;}
        .navbar-default .navbar-brand{color:#fff;}
        .menu-large {position: static !important;}
        .megamenu {padding: 20px 0px;width: 90%;left: 50%;margin-left: -45%;}
        .megamenu> li > ul {padding: 0;margin: 0;}
        .megamenu> li > ul > li {list-style: none;}
        .megamenu> li > ul > li > a {display: block;padding: 3px 20px;clear: both;font-weight: normal;line-height: 19px;color: #22649F;white-space: normal;font-size: 13px;text-transform: capitalize;}
        .megamenu> li > ul > li.link-view-all > a {border: none;color: #FF7800;}
        .megamenu> li > ul > li.link-view-all > a:hover {text-decoration: underline;color: #FF7800;}
        .megamenu> li ul > li > a:hover,.megamenu> li ul > li > a:focus {text-decoration: none;color: #262626;background-color: #f5f5f5;}
        .megamenu.disabled > a,.megamenu.disabled > a:hover,.megamenu.disabled > a:focus {color: #999999;}
        .megamenu.disabled > a:hover,.megamenu.disabled > a:focus {text-decoration: none;background-color: transparent;background-image: none;filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);cursor: not-allowed;}
        .megamenu.dropdown-header {display: block;padding: 3px 20px;line-height: 20px;white-space: nowrap;font-size: 14px;text-transform: uppercase;font-weight: 600;color: #575558;}
        .navbar .nav>li>a {padding: 15px;}
        .navbar-default .navbar-nav>li>a:hover, .navbar-default .navbar-nav>li>a:focus {color: #333;background-color: #fff;}
        .navbar-default .navbar-nav > .dropdown > a:hover .caret, .navbar-default .navbar-nav > .dropdown > a:focus .caret {border-top-color: #333;border-bottom-color: #333;}
        .dropdown-menu .divider {display: block;height: 1px;width: 100%;clear: both;margin: 0;background-color: transparent;}
        .dropdown-header {font-size: 13px;background: #BDBDBD;color: #333;font-weight: bold;}
        .login-credentials-holder {position: relative;width: 160px;float: right;}
      	.login-credentials-holder span {}
		.search-bar {width: 95%;margin: auto;}
        @media (max-width: 768px) {
          .megamenu{margin-left: 0 ;margin-right: 0 ;}
          .megamenu> li {margin-bottom: 30px;}
          .megamenu> li:last-child {margin-bottom: 0;}
          .megamenu.dropdown-header {padding: 3px 15px !important;}
          .navbar-nav .open .dropdown-menu .dropdown-header{color:#fff;}
          .navbar-default .navbar-collapse, .navbar-default .navbar-form {border-color: transparent;background: #343434;}
          .megamenu> li > ul > li > a {color: #FFFFFF;}
		  .search-bar {width: 75%;float: left;margin-left: 15px;}
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
                  <div class="col-xs-8 col-md-2">
					<div class="login-credentials-holder">
	                    <?php if ($this->session->userdata('fis_logged_in') !== FALSE) { ?>
	                    <span class=""><a href="<?php echo base_url('flogout'); ?>" style="color:#23C670;">Logout</a></span>
	                    <span class="" style=" border-right: 1px solid #dbdbdb;"><a href="<?php echo base_url('myearning'); ?>" style="color:#23C670;">My Account</a></span>
	                    <?php  }else{ ?>
	                    <span class="pull-right sign-up-btn">JOIN US</span>
	                    <span class="pull-right sign-in-btn" style=" border-right: 1px solid #dbdbdb;">SIGN IN</span>
	                    <?php } ?>
                     </div>
                  </div>
               </div>
            </div>
        </div>


      <!--Navigation Added By Mudit Chauhan - Start-->
      <div class="navbar navbar-default navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <!--<a class="navbar-brand" href="#">Logo</a>-->
            <div class="hidden-md hidden-lg">
                  <form class="form search-bar" action="search" id="frmsearch" name="frmsearch" method="post">
                     <div class="form-group">
                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                        <div class="input-group">
                           <div class="input-group-addon" id="search-icon"></div>
                           <input type="text" class="form-control search-control " id="skey" name="key" placeholder="Search for products ,offers and Coupons" value="<?php echo isset($skey)?$skey:"";?>">
                           <div id="search-btn" class="input-group-addon btn btn-warning"  onclick="$(this).closest('form').submit();">SEARCH</div>
                           <input type="submit" name="sub" value="s" id="btnsubmit" style="display:none;" />
                           <?php  if(isset($_GET['cid'])){ ?>
                           <input type="hidden" name="cid" id="cid" value="<?php echo $_GET['cid']; ?>" />
                           <?php } ?>
                           <input type="hidden" name="pid" id="pid" value="" />
                        </div>
                     </div>
                  </form>
               </div>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="dropdown menu-large">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Category <b class="caret"></b></a>       
                <ul class="dropdown-menu megamenu row">
                  <li class="col-sm-3">
                    <ul>
                      <li class="dropdown-header">Electronics</li>
                      <li><a href="#">Gaming</a></li>
                      <li><a href="#">Watches</a></li>
                      <li><a href="#">Tvs Audio Video</a></li>
                      <li><a href="#">Bags Luggage</a></li>
                      <li><a href="#">Mobiles Tablets</a></li>
                      <li><a href="#">Refurbished Products</a></li>
                      <li class="link-view-all"><a href="#">View All</a></li>
                    </ul>
                  </li>
                  <li class="col-sm-3">
                    <ul>
                      <li class="dropdown-header">Babies & Toys</li>
                      <li><a href="#">Babay Care</a></li>
                      <li><a href="#">Tweens Boys</a></li>
                      <li><a href="#">Kids Doctor</a></li>
                      <li><a href="#">Boy Clothing  (2-8 Yrs)</a></li>
                      <li><a href="#">Infant Wear</a></li>
                      <li><a href="#">Toys Games</a></li>
                      <li class="link-view-all"><a href="#">View All</a></li>
                    </ul>
                  </li>
                  <li class="col-sm-3">
                    <ul>
                      <li class="dropdown-header">Books & Media</li>
                      <li><a href="#">Books</a></li>
                      <li><a href="#">Musical Instruments</a></li>
                      <li><a href="#">Digital Entertainment</a></li>
                      <li><a href="#">Movies Music</a></li>
                      <li><a href="#">Home Entertainment</a></li>
                      <li class="link-view-all"><a href="#">View All</a></li>
                    </ul>
                  </li>
                  <li class="col-sm-3">
                    <ul>
                      <li class="dropdown-header">Clothing</li>
                      <li><a href="#">Mens Clothing</a></li>
                      <li><a href="#">Womens Clothing</a></li>
                      <li><a href="#">Womens Ethinic Wear</a></li>
                      <li><a href="#">Girls Clothing (2-8 Yrs)</a></li>
                      <li><a href="#">Girls Clothing (8-14 Yrs)</a></li>
                      <li><a href="#">Kids Clothing</a></li>
                      <li class="link-view-all"><a href="#">View All</a></li>
                    </ul>
                  </li>
                  <li class="col-sm-3">
                    <ul>
                      <li class="dropdown-header">Assessories & Bags</li>
                      <li><a href="#">Jewellery</a></li>
                      <li><a href="#">Fashion Jewellery</a></li>
                      <li><a href="#">Precious Jewellery</a></li>
                      <li><a href="#">Gifting Events</a></li>
                      <li><a href="#">Fashion Accessories</a></li>
                      <li><a href="#">Bags Wallets Belts</a></li>
                      <li class="link-view-all"><a href="#">View All</a></li>
                    </ul>
                  </li>
                  <li class="col-sm-3">
                    <ul>
                      <li class="dropdown-header">Health & Beauty</li>
                      <li><a href="#">Fragrances</a></li>
                      <li><a href="#">Sports Fitness</a></li>
                      <li><a href="#">Eyewear</a></li>
                      <li><a href="#">Beauty Personal Care</a></li>
                      <li><a href="#">Hobbies</a></li>
                      <li><a href="#">Gourmet</a></li>
                      <li class="link-view-all"><a href="#">View All</a></li>
                    </ul>
                  </li>
                  <li class="col-sm-3">
                    <ul>
                      <li class="dropdown-header">Home & Kitchen</li>
                      <li><a href="#">Furniture</a></li>
                      <li><a href="#">Home Furnishing</a></li>
                      <li><a href="#">Home Improvement</a></li>
                      <li><a href="#">The Designer Studio</a></li>
                      <li><a href="#">Appliances</a></li>
                      <li><a href="#">Stationery</a></li>
                      <li class="link-view-all"><a href="#">View All</a></li>
                    </ul>
                  </li>
                  <li class="col-sm-3">
                    <ul>
                      <li class="dropdown-header">Shoes</li>
                      <li><a href="#">Kids Footwear</a></li>
                      <li><a href="#">Womens Footwear</a></li>
                      <li><a href="#">Mens Footwear</a></li>
                    </ul>
                  </li>
                  <li class="divider"></li>
                  <li class="col-sm-3">
                    <ul>
                      <li class="dropdown-header">More</li>
                      <li><a href="#">Automotive</a></li>
                      <li><a href="#">Real Estate</a></li>
                      <li><a href="#">Automobiles</a></li>
                      <li><a href="#">Office Equipment</a></li>
                      <li><a href="#">Click And Collect</a></li>
                      <li><a href="#">Snapdeal Select</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="dropdown menu-large">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Brands <b class="caret"></b></a>       
                <ul class="dropdown-menu megamenu row">
                  <li class="col-sm-3">
                    <ul>
                      <li class="dropdown-header">Electronics Brands</li>
                      <li><a href="#">Samsung</a></li>
                      <li><a href="#">Sony</a></li>
                      <li><a href="#">MeSleep</a></li>
                      <li><a href="#">Panasonic</a></li>
                      <li><a href="#">LG</a></li>
                      <li><a href="#">Videocon</a></li>
                      <li><a href="#">Lenovo</a></li>
                    </ul>
                  </li>
                  <li class="col-sm-3">
                    <ul>
                      <li class="dropdown-header">Education Brand</li>
                      <li><a href="#">Books</a></li>
                      <li><a href="#">HP</a></li>
                      <li><a href="#">Little Sparkles</a></li>
                      <li><a href="#">Easyfix</a></li>
                    </ul>
                  </li>
                  <li class="col-sm-3">
                    <ul>
                      <li class="dropdown-header">Wears & Shoes Brand</li>
                      <li><a href="#">Adidas</a></li>
                      <li><a href="#">Reebok</a></li>
                      <li><a href="#">Nike</a></li>
                      <li><a href="#">Armaan</a></li>
                      <li><a href="#">Sparx</a></li>
                    </ul>
                  </li>
                  <li class="col-sm-3">
                    <ul>
                      <li class="dropdown-header">Babies Brand</li>
                      <li><a href="#">Mee Mee</a></li>
                      <li><a href="#">Tom & Jerry</a></li>
                      <li><a href="#">Baby League</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li><a href="#">Top Products</a></li>
              <li><a href="#">Top Coupons</a></li>
              <li><a href="#">Top Users</a></li>
            </ul>
          </div>
        </div>
      </div>  
      <!--Navigation Added By Mudit Chauhan - End-->
		



		 <!--Old Navigation Start-->
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
                           <?php  if(isset($_GET['cid'])){ ?>
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
                  <?php       } 
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
                     <p><?php  echo ucwords(str_replace("_"," ",$data['brandName'])); ?> Brand</p>
                     <?php    
                        foreach ($brandlistnew as $data1) { 
                          if($data1['parentId']==$data['id']){
                            
                        ?>                    
                     <li><a href="<?php echo base_url("brand/".strtolower(str_replace(" ","-",$data1['brandName']))); ?>"><?php echo ucwords(str_replace("_"," ",$data1['brandName'])); ?></a></li>
                     <?php      } 
                        }
                        echo "</ul></div>";
                        }
                        } 
                        ?>
                  </div>
               </div>
            </div>
         </div>
         <!--Old Navigation End-->

      </section>