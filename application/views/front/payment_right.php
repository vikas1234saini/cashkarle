<?php 
$tdisocunt = 0.00;
$cdisocunt = 0.00;
$pdisocunt = 0.00;
$condisocunt = 0.00;
foreach($orderlist as $key=>$row){ 
	//echo $row['discount']."-----".$row['amount']."<br />";
	if($row['discount']>=$row['discount_by_cashkarle']){
		//$tdisocunt = $tdisocunt+(($row['amount']*($row['discount']))/100);	
		//$tdisocunt = $tdisocunt+$row['discount_by_cashkarle'];	
	}else{
		//$tdisocunt = $tdisocunt+(($row['amount']*($row['discount']))/100);	
	}
	$status = '';

	$tdisocunt = $tdisocunt+$row['discount_by_cashkarle'];
	if(strtolower($row['orderStatus'])=='tentative'){
		$status = 'Pending';
		$pdisocunt = $pdisocunt+$row['discount_by_cashkarle'];
	}elseif(strtolower($row['orderStatus'])=='approved'){
		$condisocunt = $condisocunt+$row['discount_by_cashkarle'];
		$status = 'Confirmed';
	}elseif(strtolower($row['orderStatus'])=='failed'){
		$cdisocunt = $cdisocunt+$row['discount_by_cashkarle'];
		$status = 'Cancelled';
	}
	if(strtotime("+90 days", strtotime($row['date']))<=strtotime(date('Y-m-d')) || (strtolower($status)!='confirmed' && strtolower($status)!='approved') || $row['sitename']=='Added By Cashkarle'){}else{
		$pdisocunt = $pdisocunt+$row['discount_by_cashkarle'];
	}
}
?>
          	<div class="profile-box">
            	<h4 class="green">Cashback Earnings</h4>
                <?php 
					$totalpayment = isset($tdisocunt)?round($tdisocunt,2):"0.00";
					$paidpayment = isset($payment[0])?round($payment[0]['payment'],2):"0.00";
					$avilpayment = isset($tdisocunt)?round($tdisocunt-(isset($payment[0])?$payment[0]['payment']:0),2):"0.00";
					$pandingpayment = isset($pdisocunt)?round($pdisocunt,2):"0.00";
				?>
                <table class="mini">
                  <tr>
                    <td>Total Earnings</td>
                    <td><span class="indianRs">Rs.</span><?php echo round(($totalpayment-$paidpayment-$cdisocunt),2); ?></td>
                  </tr>
                  <tr>
                    <td>Paid Earnings</td>
                    <td><span class="indianRs">Rs.</span><?php echo $paidpayment; ?></td>
                  </tr>
                  <tr>
                    <td>Cashback Available for payment</td>
                    <td>Rs. <?php echo round(($avilpayment-$cdisocunt-$pandingpayment),2); ?></td>
                  </tr>
                  <tr>
                    <td>Cashback for retailer approval</td>
                    <td>Rs. <?php echo $pandingpayment; ?></td>
                  </tr>
                </table>
          	</div>
            <div class="clearfix"></div>
          </div>
          