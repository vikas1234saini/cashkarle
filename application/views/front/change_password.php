<section class="profile">
    <div class="container">
      <div class="row">
        
        <div class="col-md-12">
          <?php 
		  	$this->load->view('front/account_header'); 
		  	$this->load->view('front/account_left'); 
			?>
          <div class="wallet-content text-center ft-16 col-md-9">
          <form name="frmChangePassword" id="frmChangePassword" method="post">
          <table class="table table-striped table-bordered table-condensed">
          	<tr>
            	<td colspan="2">
                	<div class="error_changepassword">&nbsp;</div>
                </td>
            </tr>
          	<tr>
            	<td>
                	<strong>Old Password:</strong>
                </td>
            	<td align="left" style="width:70%;">
                	<input name="txtOldPassword" id="txtOldPassword" type="password" />
                </td>
            </tr>
          	<tr>
            	<td>
                	<strong>New Password:</strong>
                </td>
            	<td align="left" style="width:70%;">
                	<input name="txtNewPassword" id="txtNewPassword" type="password" />
                </td>
            </tr>
          	<tr>
            	<td>
                	<strong>Confirm Password:</strong>
                </td>
            	<td align="left" style="width:70%;">
                	<input name="txtConfirmPassword" id="txtConfirmPassword" type="password" />
                </td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit" class="btn btn-wide btn-round btn-primary"> Change Password</button></td>
            </tr>
          </table>
          </form>
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