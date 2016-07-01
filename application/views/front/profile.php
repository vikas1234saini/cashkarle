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
                    <?php echo $user_details[0]['username']; ?>'s Settings
                </div>
                <form name="frmUpdateProfile" id="frmUpdateProfile" method="post" enctype="multipart/form-data">
                  <table class="mini">
                    <tr>
                        <td colspan="2" align="left">
                            <div class="error_updateprofile">&nbsp;</div>
                        </td>
                    </tr>
                    <tr class="payumoneydetails">
                        <td>
                             <strong>User's Details</strong>
                        </td>
                        <td>
                            <a href="<?php echo base_url('editprofile'); ?>">Update Details</a>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td align="left" style="width:70%;">
                            <?php echo $user_details[0]['username']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td align="left" style="width:70%;">
                            <?php echo $user_details[0]['email']!='undefined'?$user_details[0]['email']:""; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Mobile:</strong></td>
                        <td align="left" style="width:70%;">
                            <?php echo $user_details[0]['mobile']; ?>
                        </td>
                    </tr>
                    
                    <?php if($user_details[0]['payumoneyemail']!=='' && $user_details[0]['payumoneymobile']!==''){ ?>
                    <tr class="payumoneydetails">
                        <td colspan="2" align="left" style="color:#23C670;">
                             <strong>PayUMoney Details</strong><p style="float:right;"><a  class="green" style="text-align:left;" href="<?php echo base_url('paymentsetting'); ?>"> Update Payment Setting</a></p>
                        </td>
                    </tr>
                    <tr class="payumoneydetails">
                        <td><strong>Email:</strong></td>
                        <td align="left" style="width:70%;">
                            <strong><?php echo $user_details[0]['payumoneyemail']; ?></strong>
                        </td>
                    </tr>
                    <tr class="payumoneydetails">
                        <td><strong>Moblie:</strong></td>
                        <td align="left" style="width:70%;">
                            <strong><?php echo $user_details[0]['payumoneymobile']; ?></strong>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if($user_details[0]['mobiwikemail']!=='' && $user_details[0]['mobiwikmobile']!==''){ ?>
                    <tr class="mobiwikdetails">
                        <td colspan="2" align="left" style="color:#23C670;">
                             <strong>Mobiwik Details</strong><p style="float:right;"><a  class="green" style="text-align:left;" href="<?php echo base_url('paymentsetting'); ?>"> Update Payment Setting</a></p>
                        </td>
                    </tr>
                    
                    <tr class="mobiwikdetails">
                        <td><strong>Email:</strong></td>
                        <td align="left" style="width:70%;">
                            <strong><?php echo $user_details[0]['mobiwikemail']; ?></strong>
                        </td>
                    </tr>
                    <tr class="mobiwikdetails">
                        <td><strong>Moblie:</strong></td>
                        <td align="left" style="width:70%;">
                            <strong><?php echo $user_details[0]['mobiwikmobile']; ?></strong>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if($user_details[0]['accountno']!=''){ ?>
                    <tr class="bankdetails">
                        <td colspan="2" align="left" style="color:#23C670;">
                             <strong>Enter Bank details</strong><p style="float:right;"><a  class="green" style="text-align:left;" href="<?php echo base_url('paymentsetting'); ?>"> Update Payment Setting</a></p>
                        </td>
                    </tr>
                    <tr class="bankdetails">
                        <td><strong>Account Holder Name:</strong></td>
                        <td align="left" style="width:70%;">
                            <strong><?php echo $user_details[0]['bankusername']; ?></strong>
                        </td>
                    </tr>
                    <tr class="bankdetails">
                        <td><strong>Bank Name:</strong></td>
                        <td align="left" style="width:70%;">
                            <strong><?php echo $user_details[0]['bankname']; ?></strong>
                        </td>
                    </tr>
                    <tr class="bankdetails">
                        <td><strong>Account No:</strong></td>
                        <td align="left" style="width:70%;">
                            <strong>XXXXXXX<?php echo substr($user_details[0]['accountno'],-4); ?></strong>
                        </td>
                    </tr>
                    <tr class="bankdetails">
                        <td><strong>Branch Name:</strong></td>
                        <td align="left" style="width:70%;">
                            <strong><?php echo $user_details[0]['branch']; ?></strong>
                        </td>
                    </tr>
                    <tr class="bankdetails">
                        <td><strong>IFSC:</strong></td>
                        <td align="left" style="width:70%;">
                            <strong><?php echo $user_details[0]['ifsc']; ?></strong>
                        </td>
                    </tr>
                    <?php } ?>
                    <!--<tr>
                        <td><strong>Payment Options:</strong></td>
                        <td align="left" style="width:70%;">
                            <select name="payment_option" id="payment_option">
                                <option value="PayUMoney">PayUMoney</option>
                                <option value="PayTm">PayTm</option>
                                <option value="MobiWik">MobiWik</option>
                            </select>
                        </td>
                    </tr>--->
                   <!-- <tr>
                        <td><strong>Image:</strong></td>
                        <td align="left" style="width:70%;">
                            <input name="userfile" id="userfile" type="file" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><button type="submit" class="btn btn-wide btn-round btn-primary">Update</button></td>
                    </tr>-->
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