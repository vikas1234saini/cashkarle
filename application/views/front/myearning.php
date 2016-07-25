<?php 
$tdisocunt = 0.00;
foreach($orderlist as $key=>$row){ 
//echo $row['discount']."-----".$row['amount']."<br />";
	if($row['discount']>=$row['discount_by_cashkarle']){
//		$tdisocunt = $tdisocunt+(($row['amount']*($row['discount']))/100);	
		$tdisocunt = $tdisocunt+$row['discount_by_cashkarle'];	
	}else{
		//$tdisocunt = $tdisocunt+(($row['amount']*($row['discount']))/100);	
	}
}
?>
<section class="profile">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <!--Tabs-->
          <?php $this->load->view('front/account_header'); ?>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-8 col-xs-12">

          <div class="wallet-content ft-16 card-block" style="margin-bottom:15px;">
            <?php if(isset($message) && $message!=''){ ?>
              <div style="color:#063;"><strong><?php echo $message; ?></strong></div>
                <?php } ?>
                  <div class="userheadername">
                      <?php echo $user_details[0]['username']; ?>'s Savings
                  </div>
    				      <!--<div>
                  <form action="" method="post">
                      <input type="hidden" name="wallet" id="wallet" value="PayUMoney">
                      <button type="submit" class="btn btn-wide btn-round btn-primary">Request Cashback Payment</button>
                      <input name="amount" type="hidden" value="100" />
                  </form>
                  </div>    -->      
                <div class="userheadername" style="margin-top:40px;">
	                Cashback Savings (Rs. <?php echo isset($tdisocunt)?round($tdisocunt-(isset($payment[0])?$payment[0]['payment']:0),2):"0.00"; ?>)
                </div>
                
				<?php  
					$month = array();
					
					$count = 1;
                    foreach($orderlist as $key=>$row){ 
						if(!in_array(date('M',strtotime($row['date'])),$month)){
							if(sizeof($month)>0){
								echo '</tbody></table>';		
								$count = 1;
							}
							$month[] = date('M',strtotime($row['date']));
                ?>
                            <table class="table table-striped table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <td colspan="7"><strong><?php echo date('M Y',strtotime($row['date'])); ?></strong></td>
                                </tr>
                              <tr>
                                <th class="header">#</th>
<!--                                <th class="yellow header headerSortDown">Order Id</th>-->
                                <th class="yellow header headerSortDown">Retailer Name</th>
                                <th class="yellow header headerSortDown">Amount</th>
                                <th class="yellow header headerSortDown">Cashback</th>
                                <th class="yellow header headerSortDown">Purchase Date</th>
                                <th class="yellow header headerSortDown">Expected Cashback Date</th>
                                <th class="yellow header headerSortDown">Status</th>
                              </tr>
                            </thead>
                            <tbody>
                <?php } ?>
                <?php 
					$status = '';
					if(strtolower($row['orderStatus'])=='tentative'){
						$status = 'Pending';
					}
					if(strtolower($row['orderStatus'])=='approved'){
						$status = 'Confirmed';
					}
					if(strtolower($row['orderStatus'])=='failed'){
						$status = 'Cancelled';
					}
				?>
                    <tr>
                        <td><?php echo $count++; ?></td>
<!--                        <td><?php echo $row['main_id']; ?></td>-->
                        <td><?php echo $row['sitename']; ?></td>
                        <td><?php echo round($row['amount'],2); ?></td>
                        <td><?php echo round($row['discount_by_cashkarle'],2);//echo round((($row['amount']*0.2)/100),2); ?></td>
                        <td><?php echo date('d M Y',strtotime($row['date'])); ?></td>
                        <td><?php echo date('d M Y',strtotime("+90 days", strtotime($row['date']))); ?></td>
                        <?php if(strtotime("+90 days", strtotime($row['date']))<=strtotime(date('Y-m-d')) || (strtolower($status)!='confirmed' && strtolower($status)!='approved') || $row['sitename']=='Added By Cashkarle'){ ?>
	                        <td><?php echo $status; ?></td>
                        <?php }else{ ?>
	                        <td>Pending</td>
                        <?php } ?>
                    </tr>
              <?php } ?> 
                </tbody>
              </table>                   
                
          </div>
        </div>
          
          <div class="col-sm-4 col-xs-12">
          <div class="wallet-content ft-16 card-block">
          	<div class="profile-box">
            	<h4 class="green">Cashback Earnings</h4>

                <!--<ul style="list-style:none; text-align:left; padding:0px;">
                  <li style="float:left; text-align:left; width:100%;">
                      <span class="txt fl green" style="color:#F5A623;"></span>
                      <span class="txt"><span class="indianRs"></span></span>
                    </li>
                    <li style="float:left; text-align:left;">
                      <span class="txt fl green" style="color:#F5A623;"></span>
                        <span class="txt"><span class="indianRs">Rs.</span></span>
                    </li>
                    <li style="float:left; text-align:left;">
                      <span class="txt fl green" style="color:#F5A623;"></span>
                        <span class="txt"><span class="indianRs"></span></span>
                    </li>
                </ul>-->
                <table class="mini">
                  <tr>
                    <td>Total Savings</td>
                    <td>Rs. <?php echo isset($tdisocunt)?round($tdisocunt,2):"0.00"; ?></td>
                  </tr>
                  <tr>
                    <td>Paid Savings</td>
                    <td>Rs. 0.00</td>
                  </tr>
                  <tr>
                    <td>Cashback Available for payment</td>
                    <td>Rs. 0.00</td>
                  </tr>
                  <tr>
                    <td>CashBack for retailer approval</td>
                    <td>Rs. <?php echo isset($tdisocunt)?round($tdisocunt-(isset($payment[0])?$payment[0]['payment']:0),2):"0.00"; ?></td>
                  </tr>
                </table>
                <div class="clearfix"></div>
          	</div>
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
        </div>

          <div class="my-favourite-content">
          </div>
        </div>
      </div>
    </div>
  </section>