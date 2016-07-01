<style>
.payumoneydetails{ display:none;}
.mobiwikdetails{ display:none;}
</style>
<section class="profile">
    <div class="container">
      <div class="row">
        
        <div class="col-md-12">
          <?php $this->load->view('front/account_header'); ?>
          <div class="wallet-content text-center ft-16">
          <?php $this->load->view('front/account_left'); ?>
            <div class="col-md-9">
          <div class="userheadername">
          <?php echo $user_details[0]['username']; ?>'s Settings
          </div>
          <form name="frmUpdateAccountProfile" id="frmUpdateAccountProfile" method="post" enctype="multipart/form-data">
          <table class="table table-striped table-bordered table-condensed">
          	<tr>
            	<td colspan="2" align="left">
                	<div class="error_updateaccountprofile">&nbsp;</div>
                </td>
            </tr>
          	<tr>
            	<td><strong>Payment Option:</strong></td>
            	<td align="left" style="width:70%;">
	                <select name="payment_option" id="payment_option">
                        <option value="bankaccount">Bank Account</option>
                        <option value="PayUMoney">PayUMoney</option>
                        <option value="MobiWik">MobiWik</option>
                        <!--<option value="PayTm">PayTm</option>-->
                    </select>
                </td>
            </tr>
            
          	<tr class="payumoneydetails">
            	<td colspan="2" align="left" style="color:#23C670;">
                	 <strong>PayUMoney Details</strong>
                </td>
            </tr>
          	<tr class="payumoneydetails">
            	<td><strong>Email:</strong></td>
            	<td align="left" style="width:70%;">
                	<input name="payumoneyemail" id="payumoneyemail" type="text" value="<?php echo $user_details[0]['payumoneyemail']; ?>" style="width:220px;" />
                </td>
            </tr>
            <tr class="payumoneydetails">
            	<td><strong>Moblie:</strong></td>
            	<td align="left" style="width:70%;">
                	<input name="payumoneymobile" id="payumoneymobile" type="text" value="<?php echo $user_details[0]['payumoneymobile']; ?>" style="width:220px;" />
                </td>
            </tr>
          	<tr class="mobiwikdetails">
            	<td colspan="2" align="left" style="color:#23C670;">
                	 <strong>Mobiwik Details</strong>
                </td>
            </tr>
          	<tr class="mobiwikdetails">
            	<td><strong>Email:</strong></td>
            	<td align="left" style="width:70%;">
                	<input name="mobiwikemail" id="mobiwikemail" type="text" value="<?php echo $user_details[0]['mobiwikemail']; ?>" style="width:220px;" />
                </td>
            </tr>
            <tr class="mobiwikdetails">
            	<td><strong>Moblie:</strong></td>
            	<td align="left" style="width:70%;">
                	<input name="mobiwikmobile" id="mobiwikmobile" type="text" value="<?php echo $user_details[0]['mobiwikmobile']; ?>" style="width:220px;" />
                </td>
            </tr>
          	<tr class="bankdetails">
            	<td colspan="2" align="left" style="color:#23C670;">
                	 <strong>Enter Bank details</strong>
                </td>
            </tr>
          	<tr class="bankdetails">
            	<td><strong>Account Holder Name:</strong></td>
            	<td align="left" style="width:70%;">
                	<input name="bankusername" id="bankusername" type="text" value="<?php echo $user_details[0]['bankusername']; ?>" style="width:220px;" />
                </td>
            </tr>
            <tr class="bankdetails">
            	<td><strong>Bank Name:</strong></td>
            	<td align="left" style="width:70%;">
                	<input name="bankname" id="bankname" type="text" value="<?php echo $user_details[0]['bankname']; ?>" style="width:220px;" />
                </td>
            </tr>
            <tr class="bankdetails">
            	<td><strong>Account No:</strong></td>
            	<td align="left" style="width:70%;">
                	<input name="accountno" id="accountno" type="text" value="" style="width:220px;" placeholder="XXXXXXX<?php echo substr($user_details[0]['accountno'],-4); ?>" />
                </td>
            </tr>
            <tr class="bankdetails">
            	<td><strong>Branch Name:</strong></td>
            	<td align="left" style="width:70%;">
                	<input name="branch" id="branch" type="text" value="<?php echo $user_details[0]['branch']; ?>" style="width:220px;" />
                </td>
            </tr>
            <tr class="bankdetails">
            	<td><strong>IFSC:</strong></td>
            	<td align="left" style="width:70%;">
                	<input name="ifsc" id="ifsc" type="text" value="<?php echo $user_details[0]['ifsc']; ?>" style="width:220px;" />
                </td>
            </tr>
            <tr>
            	<td colspan="2">
					<strong><hr /></strong>
                </td>
            </tr>
            <tr>
            	<td><strong>Confirm Password:</strong></td>
            	<td align="left" style="width:70%;">
                	<input name="password" id="password" type="password" value="" style="width:220px;" />
                </td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit" class="btn btn-wide btn-round btn-primary">Update</button></td>
            </tr>
          </table>
          </form>
          </div>
          </div>
          <div class="my-favourite-content">
          </div>
        </div>
      </div>
    </div>
  </section>