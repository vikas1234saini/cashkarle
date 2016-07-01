<div class="col-md-3">
  <div class="card-block">
              <div class="profile-box">
              <div id="image_thumb">
                <img class="profile-img" id="imageprofile" src="<?php echo ($user_details[0]['image']!='')?base_url('assets/uploads/user/'.$user_details[0]['image']):base_url('assets/img/user.png'); ?>" style="margin-bottom:5px;"  />
                <p style="text-align:center !important; visibility:hidden" class="imageeditlink"><a href="javascript:void(0);" class="green changeimage" style="text-align:center !important;">Change Image</a></p>
              </div>  
                <span style="display:none;">
                	<form name="frmuploadimage" id="frmuploadimage" method="post" enctype="multipart/form-data">
                       	<input name="userfile" id="userfile" type="file" />
                       	<input name="userfilebtn" id="userfilebtn" type="submit" value="userfilebtn" />
                    </form>
                </span>
                <label><i class="fa fa-user left-icon"></i>User Name</label>
                <h4 class="green fw-300" style="margin-top:0;" id="usernameleft"><?php echo $user_details[0]['username']; ?></h4>
                <label style="text-align:left;"><i class="fa fa-envelope left-icon"></i> Email</label>
                <p class="green"  id="profile-mail" style="text-align:left;">
                  <?php echo $user_details[0]['email']!='undefined'?$user_details[0]['email']:""; ?>
                </p>
               
            <?php if ($this->session->userdata('social_login') == FALSE) { ?>
            <label><i class="fa fa-unlock-alt left-icon"></i>PASSWORD</label>
            <p><a  class="green" style="text-align:left;" href="<?php echo base_url('changepassword'); ?>"> Change Password</a></p>
            <?php } ?>
            <label><i class="fa fa-credit-card left-icon"></i>Payment Setting</label>
            <p><a  class="green" style="text-align:left;" href="<?php echo base_url('paymentsetting'); ?>"> Update Payment Setting</a></p>
                <div class="border-top" style="overflow:hidden;">
            <div style="width:100px; float:left;">
              <a  class="green" style="text-align:left; margin-right:20px;" href="<?php echo base_url('editprofile'); ?>"><button type="button" class="btn btn-primary ">Edit Profile</button></a>
              </div>
            <div style="width:100px; float:left;">
              <a href="<?php echo base_url('flogout'); ?>"><button type="button" class="btn btn-primary">Log Out</button></a>
              </div>
            </div>
              </div>
              </div>
            </div>