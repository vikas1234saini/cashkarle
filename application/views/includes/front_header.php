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
    body {
      margin-top: 0px;
    }
        .dropdown:hover .dropdown-menu {display: block;margin-top: 0;max-height: 438px;overflow: hidden;overflow-y: auto;}
        .megamenu:hover  {display: block;margin-top: 0;}
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
    #search-btn1 {
      background-color: #23C670;
      border-radius: 0 20px 20px 0;
      border: 1px solid #23C670;
      color: #fff;
      padding-right: 20px;
    }
        #search-btn,#search-btn1{background-color: #F5A623;border: 1px solid #F5A623;}
    
        .top-coupons a,.top-products a{ text-decoration:none; color:#FFF;}
        .top-coupons a:hover,.top-products a:hover{ text-decoration:none; color:#000; font-weight:600;}
        .profile-tab a{ text-decoration:none; color:#000;}
        .profile-tab a:hover{ text-decoration:none;}
        .userheadername{ text-align:left; margin-bottom:20px; font-size:24px; color:#23C670;}
        a{cursor:pointer;}
        .profile,.hero{margin-top:10px;}
        .view-offer{padding:5px;}
        .product-item{height:420px;}
        .ui-autocomplete{z-index:10000;}
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
        .login-credentials-holder {position: relative;width: 180px;float: right;}
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
     /*#topsort{margin-top:20px;}*/
     }
     @media (min-width: 979px) {
       /*#topsort{margin-top:120px;}*/
      /*li.dropdown:hover > ul.dropdown-menu {
      display: block;
      }
      .navbar .dropdown-menu {
       margin-top: 0px;
      }*/
    }
	
.cd-top {
  display: inline-block;
  height: 40px;
  width: 40px;
  position: fixed;
  bottom: 40px;
  right: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
  /* image replacement properties */
  overflow: hidden;
  text-indent: 100%;
  white-space: nowrap;
  background: rgba(35, 198, 112, 0.8) url(<?php echo base_url(); ?>assets/img/cd-top-arrow.svg) no-repeat center 50%;
  visibility: hidden;
  opacity: 0;
  -webkit-transition: opacity .3s 0s, visibility 0s .3s;
  -moz-transition: opacity .3s 0s, visibility 0s .3s;
  transition: opacity .3s 0s, visibility 0s .3s;
}
.cd-top.cd-is-visible, .cd-top.cd-fade-out, .no-touch .cd-top:hover {
  -webkit-transition: opacity .3s 0s, visibility 0s 0s;
  -moz-transition: opacity .3s 0s, visibility 0s 0s;
  transition: opacity .3s 0s, visibility 0s 0s;
}
.cd-top.cd-is-visible {
  /* the button becomes visible */
  visibility: visible;
  opacity: 1;
}
.cd-top.cd-fade-out {
  /* if the user keeps scrolling down, the button is out of focus and becomes less visible */
  opacity: .5;
}
.no-touch .cd-top:hover {
  background-color: #e86256;
  opacity: 1;
}
@media only screen and (min-width: 768px) {
  .cd-top {
    right: 20px;
    bottom: 20px;
  }
}
@media only screen and (min-width: 1024px) {
  .cd-top {
    height: 60px;
    width: 60px;
    right: 30px;
    bottom: 30px;
  }
}

      </style>
            <link href="<?php echo base_url(); ?>assets/css/style-overriden.css" rel="stylesheet">
      <script>
  
    var plist = 1;
    var olist = 1;
         window.fbAsyncInit = function() {
         FB.init({
          //appId      : '1059727190714180',
          appId      : '1480165375608769',
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
         api_key: 75jqwfgy47nezm
         onLoad:  Linkedin.init
      </script>
      
		<script src="<?php echo base_url(); ?>assets/js/modernizr.js"></script> <!-- Modernizr -->
   </head>
   <body>
      <div class="overlay"><img src="<?php echo base_url(); ?>assets/img/loading.gif" style="position:absolute; left:0; right:0; top:0; bottom:0; margin:auto; width:50px" /></div>
      <!-- To Nevigation Bar -->
      <section class="navigation-bar navbar-fixed-top">
         <div class="main-nav" style="overflow:visible;">
            <div class="container">
               <div class="row">
                  <div class="col-xs-4 col-md-2">
                     <a href="<?php echo base_url(); ?>" class="navbar-brand" style="color:#069;"><img src="<?php echo base_url(); ?>assets/img/logo.png" style="width:160px;z-index:999;"></a>
                  </div>
                  <div class="col-md-8 hidden-xs hidden-sm">
                     <form class="form search-bar" action="search" id="frmsearch1" name="frmsearch" method="post">
                        <div class="form-group">
                           <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                           <div class="input-group">
                              <div class="input-group-addon" id="search-icon"></div>
                              <input type="text" class="form-control search-control " id="skey1" name="key" placeholder="Search for products ,offers and Coupons" value="<?php echo isset($skey)?$skey:"";?>">
                              <div id="search-btn1" class="input-group-addon btn btn-warning"><img src="<?php echo base_url(); ?>assets/img/search-icon.png" style="width:16px;"></div>
                              <input type="submit" name="sub" value="s" id="btnsubmit1" style="display:none;" />
                              <?php if(isset($_GET['cid'])){ ?>
                              <input type="hidden" name="cid" id="cid1" value="<?php echo $_GET['cid']; ?>" />
                              <?php } ?>
                              <input type="hidden" name="pid" id="pid1" value="" />
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="col-xs-8 col-md-2">
          <div class="login-credentials-holder">
                      <?php if ($this->session->userdata('fis_logged_in') !== FALSE) { ?>
                      <span class="pull-right"><a href="<?php echo base_url('flogout'); ?>" style="color:#23C670;">Logout</a></span>
                      <span class="pull-right link-sep"><a href="<?php echo base_url('myearning'); ?>" style="color:#23C670;">My Account</a></span>
                      <?php  }else{ ?>
                      <span class="pull-right sign-up-btn">JOIN US</span>
                      <span class="pull-right sign-in-btn  link-sep">SIGN IN</span>
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
                           <div id="search-btn" class="input-group-addon btn btn-warning" >SEARCH</div>
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
              <li class="dropdown menu-large" style="overflow:hidden;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Category</a>       
                
                <ul class="dropdown-menu megamenu row">
                <?php 
                  foreach ($list as $key => $data) {
                    if($data['parentId']==0){
                      
                  ?>
               <li class="col-sm-3">
                    <ul>
                  <!--<ul class="electronics" style="height:170px;">-->
                  <?php if($data['categoryName']!=''){ ?>
                  <li class="dropdown-header"><?php echo ucwords(str_replace("_"," ",$data['categoryName'])); ?></li>
                  <?php     
              }
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
                      echo "<li class='link-view-all'><a href='".base_url('category/'.$data['id'])."' style='color:#F5A623'><strong>View All</strong></a></li></ul></li>";
                     }else{
                      echo "</ul><li>";
                     }
                     }
                     } 
                     
                     ?>
                     </ul>
              </li>
              <li class="dropdown menu-large">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Brands</a>       
                <ul class="dropdown-menu megamenu row">
                <?php 
                     foreach ($brandlist as $key => $data) {
                      if($data['parentId']==0){ 
                        
                     ?>
                     
                  <li class="col-sm-3">
                    <ul>
                     <li class="dropdown-header"><?php  echo ucwords(str_replace("_"," ",$data['brandName'])); ?> Brand</li>
                     <?php    
                        foreach ($brandlistnew as $data1) { 
                          if($data1['parentId']==$data['id']){
                            
                        ?>                    
                        <li><a href="<?php echo base_url("brand/".strtolower(str_replace(" ","-",$data1['brandName']))); ?>"><?php echo ucwords(str_replace("_"," ",$data1['brandName'])); ?></a></li>
                     <?php      } 
                        }
                        echo "</ul></li>";
                        }
                        } 
                        ?>
                  
                </ul>
              </li>
            <li class="top-products"><a  href="<?php echo base_url('top-product'); ?>">Top Products</a></li>
            <li class="top-coupons"> <a  href="<?php echo base_url('top-coupon'); ?>">Top Coupons</a></li>
            <li class="top-coupons" style="display:none;" ><a class="termunsestand" data-toggle="modal" data-target="#termmodal">Top Users</a></li>
            <li class="top-coupons" style="display:none;"><a id="frontpopbtn" data-toggle="modal" data-target="#frontpop">Firt pop</a></li>
              <!--<li><a href="#">Top Products</a></li>
              <li><a href="#">Top Coupons</a></li>
              <li><a href="#">Top Users</a></li>-->
            </ul>
            <ul class="nav navbar-nav navbar-right"><li class="top-coupons"><a data-toggle="modal" data-target="#myModal">Top Users</a></li></ul>
          </div>
        </div>
      </div>  
      <!--Navigation Added By Mudit Chauhan - End-->
    



     <!--Old Navigation Start-->
         
         <!--Old Navigation End-->

      </section>