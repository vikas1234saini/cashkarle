<section class="profile">
    <div class="container">
      <div class="row">
        
        <div class="col-md-12">
        <?php 
			$this->load->view('front/account_header'); 
			$this->load->view('front/account_left');
		?>
            
          <div class="wallet-content text-center ft-16 col-md-9">
            <div class="card-block">
            <div class="userheadername">
              <span id="usernametop"><?php echo $user_details[0]['username']; ?></span>'s Settings
            </div>
            <form name="frmUpdateProfile" id="frmUpdateProfile" method="post" enctype="multipart/form-data">
              <table class="mini">
              	<tr>
                	<td colspan="2" align="left">
                    	<div class="error_updateprofile">&nbsp;</div>
                    </td>
                </tr>
              	<tr>
                	<td><strong>Name:</strong></td>
                	<td align="left" style="width:70%;">
                    	<input name="username" id="username" type="text" value="<?php echo $user_details[0]['username']; ?>" style="width:220px;" />
                    </td>
                </tr>
              	<tr>
                	<td><strong>Email:</strong></td>
                	<td align="left" style="width:70%;">
                    	<strong><?php echo $user_details[0]['email']!='undefined'?$user_details[0]['email']:""; ?></strong>
                    </td>
                </tr>
              	<tr>
                	<td><strong>Mobile:</strong></td>
                	<td align="left" style="width:70%;">
                    	<input name="mobile" id="mobile" type="text" value="<?php echo $user_details[0]['mobile']; ?>" style="width:220px;" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit" class="btn btn-wide btn-round btn-primary">Update</button></td>
                </tr>
              </table>
            </form>
            </div>
          </div>
          <!--<div class="wallet-content text-center ft-16">
            <p  class="alert_no_money">
              You dont have money in your wallet.<br>
              Start Shopping to add money.
            </p>
            <button type="button" class="btn btn-wide btn-round btn-primary"> SHOP NOW</button>
          </div>-->
          <div class="my-favourite-content">

          </div>
        </div>
      </div>
    </div>
  </section>