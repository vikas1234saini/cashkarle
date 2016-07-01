
<section class="profile">
    <div class="container">
      <div class="row">
        
        <div class="col-md-12">
        
		<?php $this->load->view('front/account_header'); ?>
            
          <div class="wallet-content text-center ft-16 ">
          <div class="userheadername">
          Add Ticket
          </div>
          <form name="frmAddTicket" id="frmAddTicket" method="post" enctype="multipart/form-data">
          <table class="table table-striped table-bordered table-condensed">
          	<tr>
            	<td colspan="2" align="left">
                	<div class="error_addticket">&nbsp;</div>
                </td>
            </tr>
          	<tr>
            	<td><strong>Date:</strong></td>
            	<td align="left" style="width:70%;">
                	<div id='datetimepicker1'><input name="date" id="date" type="text"  style="width:220px;" readonly="readonly" />&nbsp;&nbsp;<span class="glyphicon glyphicon-calendar"></span></div>
                </td>
            </tr>
            <tr>
            	<td><strong>Retailer Name:</strong></td>
            	<td align="left" style="width:70%;">
                    <select name="retailer" id="retailer">
	                    <!--<option value="Amazon">Amazon</option>
                        <option value="Flipkart">Flipkart</option>
                        
                        <option value="Sanpdeal">Snapdeal</option>
                        <option value="Coupons">Coupons (Has Offer)</option>-->
                    </select>
                </td>
            </tr>
          	<tr>
            	<td><strong>Amount:</strong></td>
            	<td align="left" style="width:70%;">
                	<input name="amount" id="amount" type="text"  style="width:220px;" onkeypress="return isNumber(event)" />
                </td>
            </tr>
          	<tr>
            	<td><strong>Transection Id:</strong></td>
            	<td align="left" style="width:70%;">
                	<input name="transection_id" id="transection_id" type="text"  style="width:220px;" />
                </td>
            </tr>
          	<tr>
            	<td><strong>Attachment:</strong></td>
            	<td align="left" style="width:70%;">
                	<input name="ticketuserfile" id="ticketuserfile" type="file"  style="width:220px;" />
                </td>
            </tr>
          	<tr>
            	<td><strong>Description:</strong></td>
            	<td align="left" style="width:70%;">
                	<textarea name="description" id="description"  style="width:220px;" ></textarea>
                </td>
            </tr>
          	<tr>
            	<td colspan="2" align="left">
		          	<strong>All Retailers accept tickets for which transaction did in last 10 Days</strong>
                </td>
            </tr>
          	<tr>
            	<td colspan="2" align="left">
		          	<input type="checkbox" name="terms" id="terms" value="check" />  <a href="<?php echo base_url('terms'); ?>" target="_blank">I Agree Terms and Conditions</a>
                    <br />
                    <span style="color:#F00; display:none;" id="errorcheck">Please check Terms and Conditions</span>
                </td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit" class="btn btn-wide btn-round btn-primary" onclick="if(!document.getElementById('terms').checked){document.getElementById('errorcheck').style.display='block';return false}">Add</button></td>
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