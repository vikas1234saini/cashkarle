<?php 
$tdisocunt = 0.00;
foreach($orderlist as $key=>$row){ 
	$tdisocunt = $tdisocunt+(($row['amount']*0.2)/100);
}
?>
<style>
.payumoneydetails{ display:none;}
.mobiwikdetails{ display:none;}
.paytm{ display:none;}
</style>
<section class="profile">
    <div class="container">
      <div class="row">
        
        <div class="col-md-12">
          <?php $this->load->view('front/account_header'); ?>
          <div class="wallet-content ft-16 col-md-12">
           <!--<div class="userheadername" style="margin-top:40px;">
                All Cashback  (Rs.200.00)
            </div>
           <div class="userheadername" style="margin-top:40px;">
                Confirmed Cashback (Rs.100.00)
            </div>-->
              <div class="userheadername">
                  My Account
              </div>
              <div class="userheadername" style="margin-top:40px;">
               <!-- All Cashback  (Rs.200.00)-->
            </div>
           <div class="userheadername" style="margin-top:40px;">
              <div class="card-block">
                <!--Confirmed Cashback (Rs.100.00)-->
                Cashback Savings (Rs. <span id="amountset"><?php echo isset($tdisocunt)?round($tdisocunt-(isset($payment[0])?$payment[0]['payment']:0),2):"0.00"; ?></span>)
              </div>
            </div>
          <div class="card-block">
          <form name="frmAddPayment" id="frmAddPayment" method="post" enctype="multipart/form-data">
          <!--<div style="width:100%; overflow:hidden;">
          	<div style="float:left; margin:20px;">
            	<div style="margin:30px;">
                	<input name="amount" id="amount" type="text" value="" style="width:220px;" placeholder="Amount To Transfer" />
                </div>
            	<div><a href="javascript:void(0);" rel="bankaccount" class="changepayment" ><button type="button" class="btn btn-wide btn-round btn-primary banktransfer">Bank Tansfer</button></a></div>
            </div>
          	<div style="float:left; margin:20px; text-align:center; width:100px;">
            	<strong>100.00 INR</strong>
                <br />
	            <strong>OR Use Via Wallet</strong>
            </div>
          	<div style="float:left; margin:20px;">
            	<div style="margin:30px;">
                	<input name="amountwallet" id="amountwallet" type="text" value="" style="width:220px;" placeholder="Amount To Transfer" />
                </div>
            	<div>
                	<a href="javascript:void(0);" style="margin:10px;" class="payumoneytransfer changepayment" rel="payumoney" ><img src="<?php echo base_url(); ?>assets/img/payumoney.png" width="80px" /></a>
                	<a href="javascript:void(0);" style="margin:10px;" class="mobiwiktransfer changepayment" rel="mobiwik"><img src="<?php echo base_url(); ?>assets/img/mobikwik.png" width="80px" /></a>
                	<a href="javascript:void(0);" style="margin:10px;" class="paytmetransfer changepayment" rel="paytm"><img src="<?php echo base_url(); ?>assets/img/paytm.png" width="80px" /></a>
                </div>
            </div>
          </div>  -->
          <div class="table-scroll-holder">
            <table class="mini" id="maintable">
            	<tr>
              	<td colspan="2" align="left">
                  	<div class="error_updateaccountprofile">&nbsp;</div>
                  </td>
              </tr>
              
            	<tr>
              	<td><strong>Amount:</strong></td>
              	<td align="left" style="width:70%;">
                  	<input name="amount" id="amount" type="text" value="" style="width:220px;" placeholder="Amount To Transfer" />
                  </td>
              </tr>
            	<tr >
              	<td><strong>Payment Option:</strong></td>
              	<td align="left" style="width:70%;">
                  
              	<div>
                  <a href="javascript:void(0);" rel="bankaccount" class="changepayment" ><button type="button" class="btn btn-wide btn-round btn-primary banktransfer">Bank Tansfer</button></a> 
                  	<a href="javascript:void(0);" style="margin:10px;" class="payumoneytransfer changepayment" rel="payumoney" ><img src="<?php echo base_url(); ?>assets/img/payumoney.png" width="80px" /></a>
                  	<a href="javascript:void(0);" style="margin:10px;" class="mobiwiktransfer changepayment" rel="mobiwik"><img src="<?php echo base_url(); ?>assets/img/mobikwik.png" width="80px" /></a>
                  	<a href="javascript:void(0);" style="margin:10px;" class="paytmetransfer changepayment" rel="paytm"><img src="<?php echo base_url(); ?>assets/img/paytm.png" width="80px" /></a>
                  </div>
  	                <select name="payment_option" id="payment_option" style="display:none;">
                          <option value="bankaccount">Bank Account</option>
                          <option value="PayUMoney">PayUMoney</option>
                          <option value="MobiWik">MobiWik</option>
                          <option value="PayTm">PayTm</option>
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
              
            	<tr class="paytm">
              	<td colspan="2" align="left" style="color:#23C670;">
                  	 <strong>PayTm Details</strong>
                  </td>
              </tr>
            	<tr class="paytm">
              	<td><strong>Email:</strong></td>
              	<td align="left" style="width:70%;">
                  	<input name="paytmemail" id="paytmemail" type="text" value="" style="width:220px;" />
                  </td>
              </tr>
              <tr class="paytm">
              	<td><strong>Moblie:</strong></td>
              	<td align="left" style="width:70%;">
                  	<input name="paytmmobile" id="paytmmobile" type="text" value="" style="width:220px;" />
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
                  	<input name="accountno" id="accountno" type="text" value="" placeholder="XXXXXXX<?php echo substr($user_details[0]['accountno'],-4); ?>" style="width:220px;" />
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
                  <td colspan="2" align="center"><button type="submit" class="btn btn-wide btn-round btn-primary">Send Payment</button></td>
              </tr>
            </table>
          </div>
          <input type="hidden" name="earningpayment" id="earningpayment" value="<?php echo isset($earning[0])?round($earning[0]['discount']-(isset($payment[0])?$payment[0]['payment']:0),2):"0.00"; ?>" />
          </form>
          </div>
          </div>
          <div class="my-favourite-content">
          </div>
        </div>
      </div>
    </div>
  </section>