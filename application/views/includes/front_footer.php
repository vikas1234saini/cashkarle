<style>
footer{ background:#282728; color:#FFF;}
footer p { text-align:justify;}
.bottom-footer a{ color:#FFF;}
.overlay{ z-index:100000;}
</style>
    <!-- Footer -->
    

    <!--<section class="features text-center">
        <div class="container">
            <h3 class="green fw-600" style="margin:0;"> Whats so unique about us ?</h3>
            <h1 class="fw-300" style="margin:0;">Things we do better than others</h1>
        </div>

    </section>-->
    <footer>
        <div class="container">
            <div class="top-footer" style="margin-top:20px;padding-bottom:20px;border-bottom:1px solid #dbdbdb;overflow:hidden;">
                <div class="col-md-4 text-left">
                    <img src="<?php echo base_url(); ?>assets/img/logo.png" width=150px>
                    <p style="margin-top:10px;">
                    </p>
                </div>
                <div class="col-md-5">
                    <h3 style="margin-top:0">Subscribe to Newsletter</h3>
                    <div class="input-group">
						
                        <input type="text" class="form-control cfc" id="txtEmail" name="txtEmail" placeholder="Email" >
                        <span class="input-group-addon cao" id="basic-addon1" style="cursor:pointer;">SUBMIT</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <h3 style="margin-top:0">Follow us on</h3>
                    <div>
                    <a href="https://www.facebook.com/cashkarle" style="color:#FFF"><i class="fa fa-facebook" style="margin:10px;"></i></a>
                    <a href="https://twitter.com/cashkarle" style="color:#FFF"><i class="fa fa-twitter" style="margin:10px;"></i></a>
                    <a href="https://www.linkedin.com/company/cashkarle.com" style="color:#FFF"><i class="fa fa-linkedin" style="margin:10px;"></i></a>
                    <a href="https://plus.google.com/+CashKarleComRewari" style="color:#FFF"><i class="fa fa-google-plus" style="margin:10px;"></i></a>
                    </div>
                    
                </div>
            </div>
            <div class="middle-footer">
                <div class="col-md-12">
                   Cashkarle
                </div>                
            </div>
            <div class="col-md-12" style="padding-bottom:10px;">
                <div class="bottom-footer" style="padding:20px;border-top:1px solid #dbdbdb;padding-left:0;">
        	        <div class="col-md-8">CASHKARLE .2015</div>
		            <div class="col-md-4" style="text-align:right;"><a href="<?php echo base_url('terms'); ?>">Terms and Conditions</a> | <a href="<?php echo base_url('contact'); ?>">Contact Us</a></div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Login Form  -->
		<section class="sign-in">
			<div class="container">
                <div class="row">
	                <div class="col-md-6 col-md-offset-3" id="forgotpassword">
                        <div class="sign-up-form" style="margin-top:30%;">
                            <div class="form text-center ">
                            
                                <form action="" method="post" id="frmForgotPassword" name="frmForgotPassword">
                            
                                    <span class="pull-right sign-in-close-btn pointer">CLOSE</span>
    
                                    <h2 class="text-left green" style="margin-top:0;">Forgot Passsword</h2>
						            <div class="error_forgot" style="color:#F00;"></div>
                                    <input class="form-control cfc" placeholder="Email" name="forgotemail" id="forgotemail" type="text"><br /><br />
						            <button type="submit" class="btn btn-warning btn-round" style="width:80%;height:40px;font-size:16px;" id="forgot_btn">Get Password</button><br>
                                    <p class="ft-11" style="margin-bottom:0;margin-top:20px;">Sign In <a class="sign-in-btn"> Click Here</a></p>
                                    <p  class="ft-11" style="margin-bottom:0;margin-top:5px;">Dont have an Account?<a class="sign-up-btn"> Sign Up Now </a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-4" id="login">
                        <div class="sign-up-form" style="margin-top:10px; padding:20px;">
                            <div class="form text-center ">
                            
                                <form action="" method="post" id="frmLogin" name="frmLogin">
                            
                                    <span class="pull-right sign-in-close-btn pointer" style="height:30px;">CLOSE</span>
    
                                    <h2 class="text-left green" style="margin-top:0; margin-bottom:10px; font-size:20px; padding-bottom:10px; margin-bottom:10px;">Sign In</h2>
                                    <div class="fw-300 text-left" style="font-size:12px;color:#4e4e4d">Sign in to your account to avail Special Offers</div>
                                    <div id="fblogin">
	                                    <div style="margin:10px;"><center><a href="#" onclick="FBLogin();" ><img src="<?php echo base_url(); ?>assets/img/sign-in-facebook.png" width="200" border="0" /></a></center></div>
	                                    <div style="margin:10px;"><center><a href="<?php echo base_url('twitterloginlink'); ?>" ><img src="<?php echo base_url(); ?>assets/img/twitter-button.png" width="200" border="0" /></a></center></div>
                                        <div style="margin:10px;"><center><div class="g-signin2" id="google_plus" onclick="renderButton();" data-width="200" data-theme="dark" data-height="38" data-longtitle="true"></div></center></div>
	                                    <div style="margin:10px; height:35px;"><center><script type="in/Login"></script></center></div>
             
	                                    <!--<center><div class="g-signin2" id="google_plus" onclick="renderButton();" data-width="250" data-theme="dark" data-height="50" data-longtitle="true"></center>-->
                                    </div>
						            <div class="error_login" style="color:#F00;"></div>
                                    <input class="form-control cfc" placeholder="Email" name="login_email" id="login_email" type="text" style="height:30px; margin-top:10px;">
                                    <input class="form-control cfc" placeholder="Password" name="login_password" id="login_password" type="password" style="height:30px; margin-top:10px;">
                                    <div class="text-left" style="margin-top:10px;margin-bottom:10px;font-size:14px;">
                                    <input type="checkbox"><span class="cbt">Remember Password</span></input>
                                    </div>                                    
						            <button type="submit" class="btn btn-warning btn-round" style="width:70%;height:35px;font-size:15px;" id="login_btn">Sign In</button><br>
                                    <div class="wihtoutlogin" style="display:none;">
						            <a href="#" class="wihtoutlogina" target="_blank"><button type="button" class="btn btn-warning btn-round" style="width:100%; margin-top:10px;height:40px;font-size:16px;">CONTINUE WITHOUT CASHBACK</button></a>
                                    </div>
                                    <div class="singuplink">
                                        <p class="ft-11" style="margin-bottom:0;margin-top:10px;">Forgot Passowrd <a class="forgot-password-btn"> Click Here</a></p>
                                        <p  class="ft-11" style="margin-bottom:0;margin-top:5px;">Dont have an Account?<a class="sign-up-btn"> Sign Up Now </a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <div class="col-md-6 col-md-offset-3" id="signup">
                    <div class="sign-up-form" style="margin-top:2%; padding:20px;">
                            <div class="form text-center ">
                                <form action="" method="post" id="frmSignup" name="frmSignup">
                                    <span class="pull-right sign-in-close-btn pointer">CLOSE</span>
    
                                    <h2 class="text-left green" style="margin-top:0;">Sign Up</h2>
                                    <p class="fw-300 text-left" style="font-size:14px;color:#4e4e4d">Sign up with us for amazing deals and cashback</p>
                                    
						            <div class="error_signup" style="color:#F00;"></div>
                                    <input class="form-control cfc" placeholder="Name" name="username" id="username" style="margin-top:10px;">
                                    <input class="form-control cfc" placeholder="Email" name="email" id="email" style="margin-top:10px;">
                                    <input class="form-control cfc" placeholder="Mobile" name="mobile" id="mobile" style="margin-top:10px;">
                                    <input class="form-control cfc" placeholder="Password" name="password" id="password" type="password" style="margin-top:5px;">
                                    <input class="form-control cfc" placeholder=" Retype Password" name="confirm_password" id="confirm_password" type="password" style="margin-top:10px;">
                                    <div class="text-left" style="margin-top:5px;margin-bottom:5px;font-size:14px;">
                                    <input type="checkbox" name="newsletter" id="newsletter"><span class="cbt">Subscribe for Newsletter</span></input>
                                    </div>
                                    
						            <button type="submit" class="btn btn-warning btn-round" style="width:80%;height:40px;font-size:16px;" id="register_btn">Sign Up</button><br>
                                    <p class="ft-11" style="margin-bottom:0;margin-top:20px;">Already have an account <a class="sign-in-btn">  Sign in Here</a></p>
                                </form>
                            </div>
                        </div>
                    
                </div>
			 
			</div>
    </section>
    <div id="termmodal"  class="modal fade in" data-backdrop="static">
      <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div id="couponsection" style="text-align:center; display:none;">
              	<div id="coupontitle"></div>
              	<div id="couponcode">
                	<input type="text" name="couponcodetext" id="couponcodetext" value="" style="height:50px; width:200px; border:dashed 1px  #16A75A;; text-align:center; font-size:18px; font-weight:700; color:#16A75A;" /> &nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="copyBlock">Copy Code</a><span id="copyAnswer"></span>
                </div>
              </div>
            <h2 class="fw-300">Important steps to ensure your Cashback tracks!</h2>
        </div>
          <div class="modal-body">
              <section class="testimonials" >
                <div class="row">
                    <div>
                    	<ul>
                           <!-- <li>Please do not enter referral codes while downloading Snapdeal app else Cashback won't track</li>
                            <li>Do not visit any coupon or price comparison site after clicking-out from CashKarle</li>
                            <li>Only use coupon codes listed on CashKarle (not those emailed or SMS'ed to you by Snapdeal directly)</li>
                            <li>Snapdeal does not accept Missing Cashback tickets</li>
                            <li>Higher Cashback is paid for orders via Snapdeal Android App</li>-->
                        </ul>
                    </div>
                    <!--<button type="button" class="btn1 btn-success" style="height:40px; font-size:18px; padding:0 50px; margin:50px 0 50px 0;">SEE ALL</button>-->
                </div>
        
            </section>
          </div>
          <div class="modal-footer">
          	<form method="post" name="frmunderstand" id="frmunderstand" target="_blank">
            	<input type="hidden" name="id" id="product_offer_id"  value="" />
            	<input type="hidden" name="for" id="product_offer_for" value="" />
            	<input type="hidden" name="code" id="product_offer_coupon" value="" />
            	<input type="hidden" name="url" id="product_offer_url" value="" />
            	<input type="hidden" name="formaction" id="product_offer_action" value="" />
	            <button type="submit" class="btn btn-warning btn-round btn-wide fw-700">I UNDERSTAND, VISIT RETAILER</button>
            </form>
            <button type="button" class="btn btn-default" id="closeterms" style="display:none;" data-dismiss="modal">Close</button>
          </div>
        </div>
    
      </div>
    </div>
    
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog" style="width:100%;">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body">
              <section class="testimonials" style=" background:#EEEEEE;">
                <div class="container text-center">
                    <h2 class="fw-300">People who have saved money from Cashkarle</h2>
                    <h1 style="font-weight:700">TOP <span style="color:#16A75A">Users</span></h1>
                    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-top:50px;margin-bottom:10px;">
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>
                        </ol>
        
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                            	<?php for($i=0;$i<sizeof($topuser);$i++){ ?>
                                <div class="col-md-4">
                                    <img src="<?php echo ($topuser[$i]['image']!='')?base_url('assets/uploads/user/'.$topuser[$i]['image']):base_url('assets/img/user.png'); ?>" alt="polandha" style="max-height:166px; max-width:166px;">
                                    <h3 class="fw-700 green"> <?php echo $topuser[$i]['username']; ?></h3>
                                    <p class="quote" style="color:#4e4e4e">"I have saved Rs <?php echo round((($topuser[$i]['tamount']*0.2)/100),2); ?> from cashkarle" just for the last month. i love this website a lot and i have suggested thid to all my friends"</p>
                                </div>
                                <?php } ?>
                            </div>
        
                        </div>
        
                    </div>
                    <!--<button type="button" class="btn1 btn-success" style="height:40px; font-size:18px; padding:0 50px; margin:50px 0 50px 0;">SEE ALL</button>-->
                </div>
        
            </section>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
    
      </div>
    </div>
    <div id="errormessage" class="modal fade" role="dialog">
      <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body">
              <section class="testimonials" >
                <div class="row">
                    <div style="padding:20px;" id="errormessage_text">
                    </div>
                </div>
        
            </section>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning btn-round btn-wide fw-700" id="dismisbutton" data-dismiss="modal">Ok</button>
            <a href="<?php echo base_url('missingcashback'); ?>" style="display:none;" id="dismislink"><button type="button" class="btn btn-warning btn-round btn-wide fw-700" >Ok</button></a>
            
          </div>
        </div>
    
      </div>
    </div>
    <div id="frontpop" class="modal fade" role="dialog">
      <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body">
              <section class="testimonials" >
                <div class="row">
                    <div style="padding:20px; font-size:14px;">
                    we are under development so we will show cashback on all stores for only testing purpose. So don't consider this cashback information for business purpose
                    </div>
                </div>
        
            </section>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning btn-round btn-wide fw-700" data-dismiss="modal">Ok</button>
          </div>
        </div>
    
      </div>
    </div>
    <div id="ticketimage" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lr">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body">
              <section class="testimonials" >
                <div class="row">
                    <div style="padding:20px; font-size:14px; text-align:center;">
	                    <img src="" id="ticketimagesrc" style="max-height:400px; max-width:90%;" />
                    </div>
                </div>
        
            </section>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning btn-round btn-wide fw-700" data-dismiss="modal">Ok</button>
          </div>
        </div>
    
      </div>
    </div>
    <div id="howitwork" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lr">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
              
            <h2 class="fw-300">How It Work</h2>
        </div>
          <div class="modal-body">
              <section class="testimonials" >
                <div class="row">
                    <div style="padding:20px; font-size:14px; text-align:center;">
                    </div>
                </div>
        
            </section>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning btn-round btn-wide fw-700" data-dismiss="modal">Ok</button>
          </div>
        </div>
    
      </div>
    </div>
    <div id="ticketdetails" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lr">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body">
              <section class="testimonials" >
                <div class="row">
                    <div style="padding:20px; " id="ticketdetailsdiv">
                    </div>
                </div>
        
            </section>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning btn-round btn-wide fw-700" data-dismiss="modal">Ok</button>
          </div>
        </div>
    
      </div>
    </div>
    <div id="reopenticket" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lr">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body">
              <section class="testimonials" >
                <div class="row">
                    <div style="padding:20px;">                    
                        <form method="post" name="frmreopen" id="frmreopen">
                            <input type="hidden" name="id" id="ticket_id_reopen"  value="" />
                            <strong>Description:</strong><br />  <textarea name="reply" id="description_reopen" cols="60"></textarea><br /><br />
                            <button type="submit" class="btn btn-warning btn-round btn-wide fw-700">Re-open</button>
                        </form>
                    </div>
                </div>
        
            </section>
          </div>
          <!--<div class="modal-footer">
            <button type="button" class="btn btn-warning btn-round btn-wide fw-700" data-dismiss="modal">Ok</button>
          </div>-->
        </div>
    
      </div>
    </div>
    
    <li style="display:none;" id="errormessage_link" data-toggle="modal" data-target="#errormessage" >&nbsp;</li>
	<style>
        .sign-in{
            position: fixed;height:100%;width:100%;top:0;background-color:rgba(0,0,0,0.8);
            z-index:10001;
            color:#4e4e4e;
			display:none;
            overflow: auto;
        }
        .sign-in.show{display:block;}
        
        .sign-up-form{padding:30px;background-color:#fff;border-radius:10px;margin-bottom:30px;overflow: auto;}
        .sign-in .form-control{height:50px;margin-top:20px;border-radius:0;}
        .ft-12{font-size:12px;}
        .ft-11{font-size:11px;}
        .sign-in h2{margin-bottom:20px;border-bottom: 1px solid #dbdbdb;padding-bottom:20px;}
        .cbt{font-size:12px;position: relative;margin-left:5px;bottom:3px;}
        .sign-in-close-btn{height:60px;width:100px;text-align:right;}
        .glyphicon-time{ display:none;}
    </style>


    <script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/js/jzoom.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js" type="text/javascript"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.0.0/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>  
    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.4.0/lang/en-gb.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/prettify.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-switch.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/raphael-min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/livicons-help.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript">
		$('.carousel-control').hide();
		$('#myCarousel').carousel();
		$('#myCarousel').mouseover(function() {
			$('.carousel-control').toggle();}).mouseout(function() {
				$('.carousel-control').toggle();});
		</script>
        
    <script type='text/javascript'>
		function isNumber(evt) {
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
			return true;
		}
		var buynow = "";
		/*$(function(){
			$('.dropdown').hover(function() {
				$(this).addClass('open');
			},
			function() {
				$(this).removeClass('open');
			});
		});*/
		$(document).ready(function() {
								   
			var offset = 300,
				//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
				offset_opacity = 1200,
				//duration of the top scrolling animation (in ms)
				scroll_top_duration = 700,
				//grab the "back to top" link
				$back_to_top = $('.cd-top');
		
			//hide or show the "back to top" link
			$(window).scroll(function(){
				( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
				if( $(this).scrollTop() > offset_opacity ) { 
					$back_to_top.addClass('cd-fade-out');
				}
			});
		
			//smooth scroll to top
			$back_to_top.on('click', function(event){
				event.preventDefault();
				$('body,html').animate({
					scrollTop: 0 ,
					}, scroll_top_duration
				);
			});
	
			$("a.refresh").click(function() {
				jQuery.ajax({
					type: "POST",
					url: "<?php echo base_url('captcha_refresh'); ?>",
					beforeSubmit:function(res) {
						jQuery("#captcha_image").html("loading");
					},
					success: function(res) {
						if (res){
							jQuery("#captcha_image").html(res);
						}
					}
				});
			});		
			$("a.tickimage").click(function() {
				$('#ticketimagesrc').attr("src",$(this).attr('rel'));
			});	
			$("a.reopenticketlink").click(function() {
				$('#ticket_id_reopen').val($(this).attr('rel'));
			});	
			
			$("a.tickdetails").click(function() {
				var new_id = $(this).attr('rel');							  
				jQuery.ajax({
					type: "POST",
					url: "<?php echo base_url('ticket_info'); ?>",
					data: "id="+new_id,
					beforeSubmit:function(res) {
						jQuery("#ticketdetailsdiv").html("loading");
					},
					success: function(res) {
						if (res){
							jQuery("#ticketdetailsdiv").html(res);
						}
					}
				});
			});		
			
			
			/*$('.dropdown').hover(
				function() {
					$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn();
				}, 
				function() {
					$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut();
				}
			);
		
			$('.dropdown-menu').hover(
				function() {
					$(this).stop(true, true);
				},
				function() {
					$(this).stop(true, true).delay(200).fadeOut();
				}
			);		*/			   
			$('#skey').blur(function(){
				$('#frmsearch').attr('action',"<?php echo base_url('search'); ?>/"+$('#skey').val().trim().replace(/ /gi,"-"));					   
            });
			$('#skey').keypress(function(event){	
				var keycode = (event.keyCode ? event.keyCode : event.which);
				if(keycode == '13'){
					$('#frmsearch').attr('action',"<?php echo base_url('search'); ?>/"+$('#skey').val().trim().replace(/ /gi,"-"));
				}
			
			});
			$( "#skey" ).autocomplete({
			  minLength: 2,
			  source: '<?php echo base_url("suggest"); ?>',
			  focus: function( event, ui ) {
				$( "#skey" ).val( ui.item.label );
				return false;
			  },
			  select: function( event, ui ) {
				//$( "#project" ).val( ui.item.label );
				//$( "#project-id" ).val( ui.item.value );
				//$( "#project-description" ).html( ui.item.desc );
				//$( "#project-icon" ).attr( "src", "images/" + ui.item.icon );
				
		 		$('#pid').val(ui.item.id);
				$('#frmsearch').attr('action',"<?php echo base_url('search'); ?>/"+$('#skey').val().trim().replace(/ /gi,"-"));
				//alert($('#pid').val());
		 		$('#search-btn').trigger('click');
				return false;
			  }
			}).autocomplete( "instance" )._renderItem = function( ul, item ) {
			  return $( "<li>" )
				.append( "<a><span>" + item.title + "</span><span style='float:right; margin-left:30px; font-size:10px; color:#F5A623'><strong>" + item.desc + "</strong></span></a>" )
				.appendTo( ul );
			};
			
			$('#search-btn1').click(function(){
				$('#frmsearch1').attr('action',"<?php echo base_url('search'); ?>/"+$('#skey1').val().trim().replace(/ /gi,"-"));					   
				$(this).closest('form').submit();
            });
			$('#search-btn').click(function(){
				$('#frmsearch').attr('action',"<?php echo base_url('search'); ?>/"+$('#skey').val().trim().replace(/ /gi,"-"));					   
				$(this).closest('form').submit();
            });
			$('#skey1').blur(function(){
				$('#frmsearch1').attr('action',"<?php echo base_url('search'); ?>/"+$('#skey1').val().trim().replace(/ /gi,"-"));					   
            });
			$('#skey1').keypress(function(event){	
				var keycode = (event.keyCode ? event.keyCode : event.which);
				if(keycode == '13'){
					$('#frmsearch1').attr('action',"<?php echo base_url('search'); ?>/"+$('#skey1').val().trim().replace(/ /gi,"-"));
				}
			});
			$( "#skey1" ).autocomplete({
			  minLength: 2,
			  source: '<?php echo base_url("suggest"); ?>',
			  focus: function( event, ui ) {
				$( "#skey1" ).val( ui.item.label );
				return false;
			  },
			  select: function( event, ui ) {
				//$( "#project" ).val( ui.item.label );
				//$( "#project-id" ).val( ui.item.value );
				//$( "#project-description" ).html( ui.item.desc );
				//$( "#project-icon" ).attr( "src", "images/" + ui.item.icon );
				
		 		$('#pid1').val(ui.item.id);
				$('#frmsearch1').attr('action',"<?php echo base_url('search'); ?>/"+$('#skey1').val().trim().replace(/ /gi,"-"));
			//alert($('#pid').val());
		 		$('#search-btn1').trigger('click');
				return false;
			  }
			}).autocomplete( "instance" )._renderItem = function( ul, item ) {
			  return $( "<li>" )
				.append( "<a><span>" + item.title + "</span><span style='float:right; margin-left:30px; font-size:10px; color:#F5A623'><strong>" + item.desc + "</strong></span></a>" )
				.appendTo( ul );
			};
			// Configure/customize these variables.
			var showChar = 200;  // How many characters are shown by default
			var ellipsestext = "...";
			var moretext = "<img src='<?php echo base_url(); ?>assets/img/plus.png' width='25px' />";
			var lesstext = "<img src='<?php echo base_url(); ?>assets/img/minus.png' width='25px' />";
			
			$('.more').each(function() {
				var content = $(this).html();
		 
				if(content.length > showChar) {
		 
					var c = content.substr(0, showChar);
					var h = content.substr(showChar, content.length - showChar);
		 
					var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span><a href="" class="morelink">' + moretext + '</a></span>';
		 
					$(this).html(html);
					$('.more').show();
				}
		 
			});
		 
			$(".morelink").click(function(){
				if($(this).hasClass("less")) {
					$(this).removeClass("less");
					$(this).html(moretext);
				} else {
					$(this).addClass("less");
					$(this).html(lesstext);
				}
				$(this).parent().prev().toggle();
				$(this).prev().toggle();
				return false;
			});
		});
        $(document).ready(function() {
			<?php if(isset($popshow) && $popshow!=''){					   ?>
				$('#frontpopbtn').click();
			<?php } ?>
			
	        $('.buybutton').click(function(){
				$('.wihtoutlogin').show();
				$('.singuplink').hide();
				$('.wihtoutlogina').attr('href',$(this).attr('href'));
				buynow = "done";
				return false;
            });
			
	        $('#amount').blur(function(){
				var oldval = $('#amountset').html();
				var newval = parseFloat($('#earningpayment').val())-parseFloat($(this).val());
				if(oldval<150){
					//$('#amountset').html($('#earningpayment').val());				
					$(this).val("");
					$('#errormessage_text').html("<span style='color:red;'><strong>Amount must be greater than 150Rs.</strong></span>");
					$('#errormessage_link').click();
				}else if(newval<0){
					$('#amountset').html($('#earningpayment').val());				
					$(this).val("");
					$('#errormessage_text').html("<span style='color:red;'><strong>Amount must be less than earning amount.</strong></span>");
					$('#errormessage_link').click();
				}else{
					$('#amountset').html(parseFloat(newval).toFixed(2));				
				}
            });
			
	        $('.wihtoutlogina').click(function(){
                var data_link = $(this).attr('href');
				//alert(data_link);
				$.ajax({
					url: "<?php echo base_url("addlink"); ?>",
					type: "POST",
					data: "link="+data_link,
			        dataType: 'json',
					success: function(data) {
						console.log(data);
					}
				});	
				//return false;
            });
	        $('.jzoom').jzoom({bgColor: "#222"});
			var date = new Date();
			//yesterday = new Date(yesterday);
			$('#datetimepicker1').datetimepicker({
									   viewMode: 'days',
									   format: 'DD-MM-YYYY',
									   defaultDate: new Date(date.getTime() - (3 * 24 * 60 * 60 * 1000)),
									   maxDate: new Date(date.getTime() - (3 * 24 * 60 * 60 * 1000)),
									   minDate: new Date(date.getTime() - (13 * 24 * 60 * 60 * 1000)),
									   showTimepicker: false,
									   autoclose: true
									}).on('dp.change', function (e) {
										//alert('test');
											$('.bootstrap-datetimepicker-widget').hide();
											$.ajax({
												url: "<?php echo base_url("getlistretailer"); ?>",
												type: "POST",
												data: "date="+$('#date').val(),
												dataType: 'json',
												success: function(data) {
													
													console.log(data);
													if(data.success==1){									
														$('#retailer').html(data.option);
														//$('.error_changepassword').html("<span style='color:green;'><strong>Password has been changed.</strong></span>");
														//$('.error_changepassword').show();
													}else{					
														$('#retailer').html('');
														$('#errormessage_text').html("<span style='color:green;'><strong>No retailer found for date.</strong></span>");
														$('#errormessage_link').click();
													}
												}
											});	
									
									  });					   
            $('.carousel').carousel({
                interval: 4000
            });

          /*  $('input[name="my-checkbox"]').bootstrapSwitch('state', true);
            $('input[name="my-checkbox').on('switchChange.bootstrapSwitch', function(event, state) {

                if (this.checked) {
                    //alert("I am checked");
                    $(".poersonalized").show(300);
                } else {
                    $(".poersonalized").hide(300);

                }
            });*/
            $('.sign-in-btn').click(function(){
                $('.sign-in,.sign-up-form,.forgot-password-form').addClass('show');
                $('#login').slideDown(300);
                $('#signup').hide();
                $('#forgotpassword').hide();
				
            });
            $('.sign-in-close-btn').click(function(){
                $('.sign-in,.sign-up-form,.forgot-password-form').removeClass('show');

            });
            $('.sign-up-btn').click(function(){
                $('.sign-in,.sign-up-form,.forgot-password-form').addClass('show');
                $('#login').hide();
                $('#signup').slideDown(300);
                $('#forgotpassword').hide();
            });
            $('.forgot-password-btn').click(function(){
                $('.sign-in,.sign-up-form,.forgot-password-form').addClass('show');
                $('#login').hide();
                $('#forgotpassword').slideDown(300);
                $('#signup').hide();
            });


        });

		var flag = 0;
        $(function() {	   
            $('#image_thumb').on('mouseover', function() {
				$('.imageeditlink').css("visibility","visible"); 
            });
            $('#image_thumb').on('mouseout', function() {
				$('.imageeditlink').css("visibility","hidden"); 
            });
            $('.category').on('mouseover', function() {
                $('.brands-item,.brands').removeClass('expand');
                $('.category-item,.category').addClass('expand');
            });
			$('#frmsearch').on('submit', function() {
				if($('#skey').val()==''){	  
					alert('Please enter search key.');
					return false;
				}else{
					//window.location.href = 	"<?php echo base_url('search'); ?>/"+$('#skey').val().replace(/ /gi,"-");
					return true;
				}
            });
			$('#frmsearch1').on('submit', function() {
		  //alert($('#skey1').val());
				if($('#skey1').val()==''){	  
					alert('Please enter search key.');
					return false;
				}else{
			//window.location.href = 	"<?php echo base_url('search'); ?>/"+$('#skey').val().replace(/ /gi,"-");
					return true;
				}
            });

			
			$('#basic-addon1').on('click', function() {
				
				$.ajax({
					url: "<?php echo base_url("newslettersub"); ?>",
					type: "POST",
					data: "txtEmail="+$('#txtEmail').val(),
			        dataType: 'json',
					beforeSend: function(){
					 	$('.overlay').show();
				    },
					success: function(data) {
					 	$('.overlay').hide();
						if(data.success==1){		
							$('#errormessage_text').html("<span style='color:green;'><strong>You have successfully subscribed for newsletter.</strong></span>");
							$('#errormessage_link').click();
							$('#txtEmail').val("");
							//$('.error_changepassword').html("<span style='color:green;'><strong>Password has been changed.</strong></span>");
							//$('.error_changepassword').show();
						}else if(data.success==2){
							
							$('#errormessage_text').html("<span style='color:red;'><strong>"+data.error+"</strong></span>");
							$('#errormessage_link').click();
                            //$('.error_changepassword').html("<span style='color:red;'><strong>"+data.error+"</strong></span>");
                            //$('.error_changepassword').show();
						}
						
					}
				});	
			});
			$('#signinuserproduct').on('click', function() {
				$('#couponsection').hide();
				$('#frmunderstand').attr('action',$(this).attr('href'));
				$('#product_offer_id').val($(this).attr('rel'));
				$('#product_offer_for').val("product");
				$('#product_offer_url').val($(this).attr('data-url'));
				$('#product_offer_action').val($(this).attr('href'));
				
				$('.termunsestand').click();
				return false;
            });
				
			$('.signinuseroffer').on('click', function() {
				$('#couponsection').hide();									   
				$('#frmunderstand').attr('action',$(this).attr('href'));
				$('#product_offer_action').val($(this).attr('href'));
				$('#product_offer_id').val($(this).attr('rel'));
				$('#product_offer_for').val("offer");
				$('#product_offer_url').val($(this).attr('data-url'));
				$('.termunsestand').click();
				return false;
            });
			$('.signinusercoupon').on('click', function() {			   
				$('#frmunderstand').attr('action',$(this).attr('href'));
				$('#product_offer_action').val($(this).attr('href'));
				$('#couponsection').show();
				$('#coupontitle').html("<h3>"+$(this).attr('title')+"</h3>");
				$('#couponcodetext').val($(this).attr('name'));
				$('#product_offer_id').val($(this).attr('rel'));
				$('#product_offer_coupon').val($(this).attr('name'));
				$('#product_offer_for').val("coupon");
				$('#product_offer_url').val($(this).attr('data-url'));
//				alert('test');
//				document.getElementById("couponcodetext").select();
				document.getElementById("copyBlock").innerHTML = 'Copy Code';
				$('.termunsestand').click();
				return false;
            });
			
			$('#frmunderstand').on('submit', function() {
                //var data_link = $(this).attr('href');
				var off_id = $('#product_offer_id').val();
				if($('#product_offer_coupon').val()!=''){
					$('#couponcodedisplay'+off_id).html("<h4 style='padding:5px;width:150px; border:dashed 1px  #16A75A;; text-align:center; font-size:18px; font-weight:700; color:#16A75A;'>"+$('#product_offer_coupon').val()+"</h4>");
				}
				$('#couponsection').hide();
				$('#closeterms').click();
				$.ajax({
					url: "<?php echo base_url("addlink"); ?>",
					type: "POST",
					data: $(this).serialize(),
			        dataType: 'json',
					success: function(data) {
						console.log(data);
					}
				});	
                //return false;
            });
			
			
			$('#frmreopen').on('submit', function() {
				if($('#description_reopen').val()==''){					
					alert('Please enter description.');
					return false;
				}
				$.ajax({
					url: "<?php echo base_url("reopen"); ?>",
					type: "POST",
					data: $(this).serialize(),
			        dataType: 'json',
					beforeSend: function(){
						 $('.overlay').show();
				    },
					success: function(data) {
						console.log(data);
						 $('.overlay').hide();
						
			//		    $('#reopenticket').dialog("close");
//						$('#errormessage_text').html("<span style='color:green;'><strong>Ticket has been reopened.</strong></span>");
	//					$('#errormessage_link').click();	
		//				$('#description_reopen').val("");
						
						window.location.href = '<?php echo base_url('missingcashback'); ?>';
						
					}
				});	
                return false;
            });
			
			$('#frmsearchatt').on('submit', function(event) {
				event.preventDefault();
				$.ajax({
					url: "<?php echo base_url("searchajax"); ?>",
					type: "POST",
					data: $(this).serialize(),
			        dataType: 'json',
					beforeSend: function(){
						 $('.overlay').show();
				    },
					success: function(data) {
						console.log(data);
						 $('.overlay').hide();
					//	 if(plist == 1){
							$('#productlist').html(data.productlist);
						// }
						 //if(olist == 1){
							$('#couponlist').html(data.couponlist);
						 //}
						if(data.ostatus=='0'){
							olist = 0;		
						}
						if(data.status=='0'){
							plist = 0;		
						}
                    //    $('#pageno').val(parseInt($('#pageno').val())+1);

						$('#pageno').val("0");
					}
				});									 
				return false;
            });
			$(window).scroll(function(){
				if($(window).scrollTop() == ($(document).height() - $(window).height()) && flag==0){
                    //setTimeout(function(){ flag = 0; }, 5000);
					$.ajax({
						url: "<?php echo base_url("searchajax"); ?>",
						type: "POST",
						data: $('#frmsearchatt').serialize(),
						dataType: 'json',
						 beforeSend: function(){
							 
							flag=1;
							// Code to display spinner
							$('#productlist').append('<div style="width:100%; text-align:center;" class="loader"><img src="<?php echo base_url(); ?>assets/img/loading.gif" /></div>');
						},
						success: function(data) {
							if(data.status=='1'){
								flag=0;
							}
							if($('#productlist')){
								
								 if(plist == 1){
									$('#productlist').append(data.productlist);
							 	}
							}
							if($('#couponlist')){
								
								 if(olist == 1){
									$('#couponlist').append(data.couponlist);
							 	}
							}
							if(data.ostatus=='0'){
								olist = 0;		
							}
							if(data.status=='0'){
								plist = 0;		
							}
							$('.loader').hide();
							$('#pageno').val(parseInt($('#pageno').val())+1);
							
						}
					});			
                    //console.log("test"+$(window).scrollTop() +"=="+ ($(document).height() - $(window).height()));
				}
			});
			$('input[type=radio][name=bycahback]').change(function(e) {
				e.preventDefault();												   
                //$(this).closest('form').submit();
				$("#btnsubmitsearch").click();
			});
			$('input[type=radio][name=bybrand]').change(function(e) {
				e.preventDefault();
	           //$(this).closest('form').submit();
				$("#btnsubmitsearch").click();
			});
			$('input[type=radio][name=onlypc]').change(function(e) {
				e.preventDefault();												
				if(this.value=='onlyproduct'){
					$('.productlist').show();
					$('.couponlist').hide();
				}else if(this.value=='onlycoupon'){
					$('.productlist').hide();
					$('.couponlist').show();
				}else{
					$('.productlist').show();
					$('.couponlist').show();
				}
                //$(this).closest('form').submit();
			});
			$('input[type=radio][name=byprice]').change(function(e) {
				e.preventDefault();												 
                //$(this).closest('form').submit();c

				$("#btnsubmitsearch").click();
			});
			$('input[type=radio][name=bycashback]').change(function(e) {
				e.preventDefault();													
                //$(this).closest('form').submit();
				$("#btnsubmitsearch").click();
			});
			
			$.validator.addMethod("alphanum", function(value, element) {
				return this.optional(element) || /^[a-z0-9 \.\-]+$/i.test(value);
			}, "Please enter letters, numbers, or dashes.");
			
			$.validator.addMethod("firstcharcheck", function(value, element) {
				var check_first = true;
				if(value.charAt(0)==0){
					check_first = false;
				}
				return this.optional(element) || check_first;
			}, "First char shold not be zero.");
			<?php if ($this->session->userdata('fis_logged_in') !== FALSE) { ?>
				$("#frmChangePassword").validate({
					rules: {
						txtOldPassword:{required: true},
						txtNewPassword:{	required: true,	minlength: 6, maxlength: 16	},
						txtConfirmPassword:{ required: true,minlength: 6, maxlength: 16,						
							equalTo: '#txtNewPassword'
						}
					},
					messages:{
						  txtOldPassword:{required: 'Please enter old password'},
						  txtNewPassword:{required: 'Please enter new password'},
						  txtConfirmPassword:{required: 'Please repeat the new password',	equalTo: 'Password mismatch detected'}
					},
					highlight: function (element) {
						$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
					},
					unhighlight: function (element) {
						$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
					},
					submitHandler: function() { 
						//alert("Submitted!");
						 $.ajax({
							url: '<?php echo base_url(); ?>changepasswordpost',
							type: 'post',
							dataType: 'json',
							data: $('form#frmChangePassword').serialize(),
							success: function(data) {
								if(data.success==1){		
									$('#errormessage_text').html("<span style='color:green;'><strong>Password has been changed.</strong></span>");
									$('#errormessage_link').click();
									$('#txtOldPassword').val("");
									$('#txtNewPassword').val("");
									$('#txtConfirmPassword').val("");
									$('.error_changepassword').html("");
									$('.error_changepassword').hide();
									//$('.error_changepassword').html("<span style='color:green;'><strong>Password has been changed.</strong></span>");
									//$('.error_changepassword').show();
								}else if(data.success==2){
									$('.error_changepassword').html("<span style='color:red;'><strong>"+data.error+"</strong></span>");
									$('.error_changepassword').show();
								}
							}
						});
					}
				});
				$("#frmUpdateProfile").validate({
					rules: {
						username:{required: true},
						mobile:{required: true,	}
					},
					messages:{
						  username:{required: 'Please enter username'},
						  mobile:{required: 'Please enter mobile'}
					},
					highlight: function (element) {
						$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
					},
					unhighlight: function (element) {
						$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
					},
					submitHandler: function() { 
						//alert("Submitted!");
						var fd = new FormData($('#frmUpdateProfile')[0]); 
						 $.ajax({
							url: '<?php echo base_url(); ?>updateprofile',
							dataType: 'json',
							processData: false,
							contentType: false,
							type: 'POST',
							data: fd,
							beforeSend: function(){
							 $('.overlay').show();
						   },
							//data: new FormData($('#frmUpdateProfile')[0]),
							success: function(data) {
								$('.overlay').hide();
								if(data.success==1){								
									$('#errormessage_text').html("<span style='color:green;'><strong>Profile has been updated.</strong></span>");
									$('#errormessage_link').click();
									$('#usernameleft').html($('#username').val());
									$('#usernametop').html($('#username').val());
                                    //$('.error_updateprofile').html("<span style='color:green;'><strong>Profile has been changed.</strong></span>");
                                   //$('.error_updateprofile').show();
								}else if(data.success==2){
									$('.error_updateprofile').html("<span style='color:red;'><strong>"+data.error+"</strong></span>");
									$('.error_updateprofile').show();
								}
							}
						});
					}
				});
				
				$("#frmUpdateAccountProfile").validate({
					rules: {
						password:{required: true}
					},
					messages:{
						  password:{required: 'Please enter password'}
					},
					highlight: function (element) {
						$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
					},
					unhighlight: function (element) {
						$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
					},
					submitHandler: function() { 
						//alert("Submitted!");
						var fd = new FormData($('#frmUpdateAccountProfile')[0]); 
						 $.ajax({
							url: '<?php echo base_url(); ?>updateaccount',
							dataType: 'json',
							processData: false,
							contentType: false,
							type: 'POST',
							data: fd,
							//data: new FormData($('#frmUpdateProfile')[0]),
							success: function(data) {
								if(data.success==1){								
									$('#errormessage_text').html("<span style='color:green;'><strong>Account Details has been changed.</strong></span>");
									$('#errormessage_link').click();
                                    //$('.error_updateaccountprofile').html("<span style='color:green;'><strong>Account Details has been changed.</strong></span>");
	                               //$('.error_updateaccountprofile').show();
								}else if(data.success==2){
									$('.error_updateaccountprofile').html("<span style='color:red;'><strong>"+data.error+"</strong></span>");
									$('.error_updateaccountprofile').show();
								}
							}
						});
					}
				});
				
				$("#frmAddTicket").validate({
					rules: {
						amount:{required: true},
						retailer:{required: true},
						date:{required: true},
						transection_id:{required: true}
					},
					messages:{
						  date:{required: '&nbsp;&nbsp;Please enter date'},
						  retailer:{required: '&nbsp;&nbsp;Please enter retailer'},
						  amount:{required: '&nbsp;&nbsp;Please enter amount'},
						  transection_id:{required: '&nbsp;&nbsp;please enter transection id'}
					},
					highlight: function (element) {
						$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
					},
					unhighlight: function (element) {
						$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
					},
					submitHandler: function() { 
						//alert("Submitted!");
						
						var fd = new FormData($('#frmAddTicket')[0]); 
						 $.ajax({
							url: '<?php echo base_url(); ?>addticketpost',
							type: 'post',
							dataType: 'json',
							processData: false,
							contentType: false,
							type: 'POST',
							data: fd,
							beforeSend: function(){
							 $('.overlay').show();
						   },
							//data: $('form#frmAddTicket').serialize(),
							success: function(data) {
								 $('.overlay').hide();
								if(data.success==1){				
									$('#dismisbutton').hide();	
									$('#dismislink').show();
									$('#errormessage_text').html("<span style='color:green;'><strong>Your ticket has been submitted.</strong></span>");
									$('#errormessage_link').click();
									
									//setTimeout(function(){ window.location.href = '<?php echo base_url('missingcashback'); ?>'; }, 3000);
								}else if(data.success==2){
									$('.error_addticket').html("<span style='color:red;'><strong>"+data.error+"</strong></span>");
									$('.error_addticket').show();
								}
							}
						});
					}
				});
				
			<?php }else{ ?>
			
			$("#frmSignup").validate({
				errorElement: 'p',
				rules: {
					username:{required: true,alphanum:true},
					email:{required: true,email: true},
					password:{	required: true,	minlength: 6, maxlength: 16	},
					mobile:{required: true,number: true,maxlength: 12,minlength: 10},
					confirm_password:{ required: true,minlength: 6, maxlength: 16,						
						equalTo: '#password'
					}
				},
				messages:{
					  username:{ required: 'Please enter name',alphanum:"Please enter letters, numbers, or dashes."},
					  email:{ required: 'Please enter email'},
					  password:{required: 'Please enter new password'},
					  mobile:{required: 'Please enter mobile',number:"Please enter number only"},
					  confirm_password:{required: 'Please repeat the new password',	equalTo: 'Password mismatch detected'}
				},
				highlight: function (element) {
					$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
				},
				unhighlight: function (element) {
					$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
				},
				submitHandler: function() { 
					$("#btnSubmitRegister").hide();
					 $.ajax({
						url: '<?php echo base_url('create_user'); ?>',
						type: 'post',
						dataType: 'json',
						data: $('form#frmSignup').serialize(),
						success: function(data) {
                            //console.log(data);
							$("#btnSubmitRegister").show();
						   	if(data.status==1){
								location.reload();
								$("input[type=text], textarea").val("");
								$('.error_signup').html('');
								$('.error_signup').hide();
						  	}else{
								$('.error_signup').html(data.error);
								$('.error_signup').show();		
							}
						}
					});
				}
			});
			$("#frmLogin").validate({
				rules: {
					login_email:{required: true,email: true},
					login_password:{	required: true,	minlength: 6, maxlength: 16	}
				},
				messages:{
					  login_email:{ required: 'Please enter email'},
					  login_password:{required: 'Please enter new password'}
				},
				highlight: function (element) {
					$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
				},
				unhighlight: function (element) {
					$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
				},
				submitHandler: function() { 
	           //$("#btnSubmitRegister").hide();
					//alert("Submitted!");
					 $.ajax({
						url: '<?php echo base_url('flogin'); ?>',
						type: 'post',
						dataType: 'json',
						data: $('form#frmLogin').serialize(),
						success: function(data) {
							if(data.status==1){
								if(buynow!=''){
									$('.wihtoutlogina')[0].click();
								}
								window.location = window.location.pathname;
							}else{
								$('.error_login').html(data.error);
								$('.error_login').show();		
							}
						}
					});
				}
			});
			
			$("#frmForgotPassword").validate({
				rules: {
					forgotemail:{required: true,email: true}
				},
				messages:{
					forgotemail:{required: 'Please enter email'},
				},
				highlight: function (element) {
					$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
				},
				unhighlight: function (element) {
					$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
				},
				submitHandler: function() { 
					//alert("Submitted!");
					 $.ajax({
						url: '<?php echo base_url('forgot_password'); ?>',
						type: 'post',
						dataType: 'json',
						data: $('form#frmForgotPassword').serialize(),
						beforeSend: function(){
						 $('.overlay').show();
					   },
						success: function(data) {
							//console.log(data);
    						$('.overlay').hide();
							if(data.status==1){	
							
								$("#forgotemail").val('');
								$("#frmForgotPassword .sign-in-close-btn").click();
								$("#forgotpassword").hide();
								$('#errormessage_text').html("<span style='color:green;'><strong>Password has beed sent to your email.</strong></span>");
								$('#errormessage_link').click();
							} else {
								$('.error_forgot').html(data.error);
								$('.error_forgot').show();
							}
						}
					});
				}
			});
			
			<?php } ?>
			$("#frmContactUs").validate({
					rules: {
						name:{required: true},
						email:{required: true},
						option:{required: true}
					},
					messages:{
						  name:{required: '&nbsp;&nbsp;Please enter name'},
						  email:{required: '&nbsp;&nbsp;Please enter email'},
						  option:{required: '&nbsp;&nbsp;Please enter topic'}
					},
					highlight: function (element) {
						$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
					},
					unhighlight: function (element) {
						$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
					},
					submitHandler: function() { 
						//alert("Submitted!");
						
						var fd = new FormData($('#frmContactUs')[0]); 
						 $.ajax({
							url: '<?php echo base_url('addcontact'); ?>',
							type: 'post',
							dataType: 'json',
							processData: false,
							contentType: false,
							type: 'POST',
							data: fd,
							beforeSend: function(){
							 $('.overlay').show();
						   },
							//data: $('form#frmAddTicket').serialize(),
							success: function(data) {
								 $('.overlay').hide();
								if(data.success==1){				
									$('#errormessage_text').html("<span style='color:green;'><strong>Your query  has been raised. we will revert you shortly</strong></span>");
									$('#errormessage_link').click();				
									//window.location.href = '<?php echo base_url('missingcashback'); ?>'
								}else if(data.success==2){
													
									$('#errormessage_text').html("<span style='color:green;'><strong>"+data.error+"</strong></span>");
									$('#errormessage_link').click();
									//$('.error_addticket').html("<span style='color:red;'><strong>"+data.error+"</strong></span>");
									//$('.error_addticket').show();
								}
							}
						});
					}
				});
        });
        $('html').click(function() {
            $('.category-item,.category').removeClass('expand');
        });
        $('.category,.category-item').click(function(event) {
            event.stopPropagation();
        });
        $(function() {
			$('#frmAddPayment').on("submit",function() {
				if($('#earningpayment').val()=="" || $('#earningpayment').val()=="0"){
					$('#errormessage_text').html("<span style='color:red;'><strong>No payment to transfer.</strong></span>");
					$('#errormessage_link').click();
					return false;
				}else if($('#amount').val()=="" || $('#amount').val()=="0"){
					$('#errormessage_text').html("<span style='color:red;'><strong>Amount should not be blank.</strong></span>");
					$('#errormessage_link').click();
					return false;
				}
				$.ajax({
					url: "<?php echo base_url("paymentpost"); ?>",
					type: "POST",
					data: $(this).serialize(),
			        dataType: 'json',
					beforeSend: function(){
					 $('.overlay').show();
				   },
					success: function(data) {
						 $('.overlay').hide();
						if(data.success==1){									
							$('#errormessage_text').html("<span style='color:green;'><strong>Payment has been transferred.</strong></span>");
							$('#errormessage_link').click();
						}else if(data.success==2){				
				
							$('.error_updateaccountprofile').html("<span style='color:red;'><strong>"+data.error+"</strong></span>");
							$('.error_updateaccountprofile').show();
						}
					}
				});	
				return false;
			});	   
			
			
			$('.changeimage').click(function() {		   
				$('#userfile').click();	
			});
			$('.changepayment').click(function() {	
				$('.payumoneydetails').hide();
				$('.mobiwikdetails').hide();
				$('.bankdetails').hide();
				$('.paytm').hide();						 
				$('#maintable').show();						 
				
				if($(this).attr('rel')=="bankaccount"){				
					document.getElementById('payment_option').value='bankaccount';
					$('.bankdetails').show();
				}
				if($(this).attr('rel')=="payumoney"){				
					document.getElementById('payment_option').value='PayUMoney';
					$('.payumoneydetails').show();
				}
				if($(this).attr('rel')=="mobiwik"){				
					document.getElementById('payment_option').value='PayUMoney';
					$('.mobiwikdetails').show();
				}
				if($(this).attr('rel')=="paytm"){				
					document.getElementById('payment_option').value='PayTm';
					$('.paytm').show();
				}
			});
			$('.paymentimage').click(function() {
				$('#userfile').click();							 
			});
			$('#payment_option').change(function() {
				$('.payumoneydetails').hide();
				$('.mobiwikdetails').hide();
				$('.bankdetails').hide();
				$('.paytm').hide();
				if($(this).val()=="bankaccount"){				
					$('.bankdetails').show();
				}
				if($(this).val()=="MobiWik"){				
					$('.mobiwikdetails').show();
				}
				if($(this).val()=="PayUMoney"){				
					$('.payumoneydetails').show();
				}
				if($(this).val()=="PayTm"){				
					$('.paytm').show();
				}
			});
			
			$("#userfile").change(function() {
				var file = this.files[0];
				var imagefile = file.type;
				var match= ["image/jpeg","image/png","image/jpg"];
				if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))	{
					alert('Please upload a valid image file.');
					return false;
				}else{
					//$('#userfilebtn').click();
					
					var fd = new FormData($("#frmuploadimage")[0]); 
					 $.ajax({
						url: '<?php echo base_url(); ?>updateimage',
						dataType: 'json',
						processData: false,
						contentType: false,
						type: 'POST',
						data: fd,
						beforeSend: function(){
						 $('.overlay').show();
					   },
						success: function(data) {
							 $('.overlay').hide();
							if(data.success==1){				
								$('#imageprofile').attr("src",data.src);
							}else if(data.success==2){
								alert(data.error);
							}
						}
					});				
				}
			});
			
			$("#frmuploadimage").on('submit',function() {
												 		   
				 return false;
			});
            $('.brands').on('mouseover', function() {
                $('.category-item,.category').removeClass('expand');
                $('.brands-item,.brands').addClass('expand');
            });
            $('.profile').on('mouseover', function() {
                $('.category-item,.category').removeClass('expand');
                $('.brands-item,.brands').removeClass('expand');
            });
            $('.hero').on('mouseover', function() {
                $('.category-item,.category').removeClass('expand');
                $('.brands-item,.brands').removeClass('expand');
            });
			
            $('.main-nav').on('mouseover', function() {
                $('.category-item,.category').removeClass('expand');
                $('.brands-item,.brands').removeClass('expand');
            });
            $('.main-nav,.top-products,.top-coupons').on('mouseover', function() {
                $('.category-item,.category').removeClass('expand');
                $('.brands-item,.brands').removeClass('expand');
            });
			
        });
        $('html').click(function() {
            $('.brands-item,.brands').removeClass('expand');
        });

        $('.brands,.brands-item').click(function(event) {
            event.stopPropagation();
        });
		// This is called with the results from from FB.getLoginStatus().
		function statusChangeCallback(response) {
		
		  if (response.status === 'connected') {
			  // Logged into your app and Facebook.
			  // we need to hide FB login button
                //$('#fblogin').hide();
			  //fetch data from facebook
			  getUserInfo();
		  } else if (response.status === 'not_authorized') {
			  // The person is logged into Facebook, but not your app.			  
				$('.error_login').html("Please try again for login.");
				$('.error_login').show();
		  } else {
			  // The person is not logged into Facebook, so we're not sure if
			  // they are logged into this app or not.			  
				$('.error_login').html("Please try again for login.");
				$('.error_login').show();
		  }
		}
		
		// This function is called when someone finishes with the Login
		// Button.  See the onlogin handler attached to it in the sample code below.
		function checkLoginState() {
		  FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		  });
		}
		function FBLogin()
		{
			  FB.login(function(response) {
				 if (response.authResponse) {
					 getUserInfo(); //Get User Information.
				  } else {				  
						$('.error_login').html("Please try again for login.");
						$('.error_login').show();
				  }
			   },{scope: 'public_profile,email'});
		}
		function getUserInfo() {
			FB.api('/me?fields=id,name,email', function(response) {
				console.log(response);				   
			  $.ajax({
					type: "POST",
					dataType: 'json',
					data: response,
					url: '<?php echo base_url('facebook'); ?>',
					success: function(msg) {						
						 console.log(msg);
						 if(msg.status!= 1) {
							$('.error_login').html("Please try again for login.");
							$('.error_login').show();
						 } else {
							$('.error_login').hide();
							window.location = window.location.pathname;
						 }
					}
			  });
		
			});
		}
    </script>
    <script>
		function onGoogleFinal(googleUser) {
		  $.ajax({
				type: "POST",
				dataType: 'json',
				data: "name="+googleUser.getBasicProfile().getName()+"&email="+googleUser.getBasicProfile().getEmail()+"&id="+googleUser.getBasicProfile().getId(),
				url: '<?php echo base_url('googleplus'); ?>',
				success: function(msg) {						
					 console.log(msg);
					 if(msg.status!= 1) {
						$('.error_login').html("Please try again for login.");
						$('.error_login').show();
					 } else {
						$('.error_login').hide();
						window.location = window.location.pathname;
					 }
				}
		  });
		}
		function onGoogleFailure(error) {
		  console.log(error);
		}
		function renderButton() {
		  gapi.signin2.render('google_plus', {
			'scope': 'https://www.googleapis.com/auth/plus.login',
			'width': 250,
			'height': 50,
			'longtitle': true,
			'theme': 'dark',
			'onsuccess': onGoogleFinal,
			'onfailure': onGoogleFailure
		  });
		}
	  </script>
	<!-- Old Code for Filter Toggle - Added By Mudit
       <script>
          var $slider = document.getElementById('filter-panel-wrapper');
          var $toggle = document.getElementById('filter-panel-wrapper-toggle');

          $toggle.addEventListener('click', function() {
            var isOpen = $slider.classList.contains('slide-in');

            $slider.setAttribute('class', isOpen ? 'slide-out' : 'slide-in');
        });
       </script>
        -->
       <!-- Code Provide By Amit for Filter Toggle-->
        <script>
        var $slider = document.getElementById('filter-panel-wrapper');
        var $toggle = document.getElementById('filter-panel-wrapper-toggle');
if($toggle && $slider)
{
        $toggle.addEventListener('click', function() {
            var isOpen = $slider.classList.contains('slide-in');

            $slider.setAttribute('class', isOpen ? 'slide-out' : 'slide-in');
        });
		}
    </script>
      
<script>    
    function OnLinkedInAuth() {
        IN.API.Profile("me").fields("first-name", "last-name", "email-address", "id").result(ShowProfileData);
    }
    function ShowProfileData(profiles) {
    var member = profiles.values[0];
    var id=member.id;
    var name=member.firstName+" "+member.lastName; 
    var email=member.email; 
	  $.ajax({
			type: "POST",
			dataType: 'json',
			data: "name="+name+"&email="+email+"&id="+id,
			url: '<?php echo base_url('linkedin'); ?>',
			success: function(msg) {
				 if(msg.status!= 1) {
					$('.error_login').html("Please try again for login.");
					$('.error_login').show();
				 } else {
					$('.error_login').hide();
					window.location = window.location.pathname;
				 }
			}
	  });
    //use information captured above
    }
        (function($){		
			window.Linkedin = {
				init : function(){
					console.log('The Linkedin JS has loaded.');
					console.log('You can now login.');
					$('a[id*=li_ui_li_gen_]').css({marginBottom:'20px'}).html('<img src="<?php echo base_url(); ?>assets/img/linkedin-register-large.png" width="200" border="0" />'); 
					$('.IN-widget').bind('click', function(){
						IN.Event.on(IN, "auth", OnLinkedInAuth);
					});
				}, onAuthCallback : function(){
				}, onLogoutCallback : function(){
				}, userData : function(p_oUserInfo){
					$.ajax({
						type: "POST",
						dataType: 'json',
						data: "name="+p_oUserInfo.firstName + ' ' + p_oUserInfo.lastName+"&email="+p_oUserInfo.email+"&id="+p_oUserInfo.id,
						url: '<?php echo base_url('linkedin'); ?>',
						success: function(msg) {						
							 console.log(msg);
							 if(msg.status!= 1) {
								$('.error_login').html("Please try again for login.");
								$('.error_login').show();
							 } else {
								$('.error_login').hide();
								window.location = window.location.pathname;
							 }
						}
				  });
				}
			};    
	}(jQuery));
		
		var textarea = document.getElementById("couponcodetext");
		var answer = document.getElementById("copyAnswer");
		var copy   = document.getElementById("copyBlock");
		copy.addEventListener('click', function(e) {
		   // Select some text (you could also create a range)
		   textarea.select(); 
		
		   // Use try & catch for unsupported browser
		   try {
			   // The important part (copy selected text)
			   var successful = document.execCommand('copy');
			   if(successful) copyBlock.innerHTML = 'Copied!';
			   else copyBlock.innerHTML = 'Unable to copy!';
		   } catch (err) {
			   copyBlock.innerHTML = 'Unsupported Browser!';
		   }
		});
</script>
<script src="https://apis.google.com/js/platform.js" async defer></script>

	<a href="#0" class="cd-top">Top</a>
</body>
</html>