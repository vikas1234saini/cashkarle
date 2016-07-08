<?php 
$tdisocunt = 0.00;
foreach($orderlist as $key=>$row){ 
	$tdisocunt = $tdisocunt+(($row['amount']*0.2)/100);
}
?>
<section class="profile">
    <div class="container">
      <div class="row">
        
        <div class="col-md-12">
          <?php $this->load->view('front/account_header'); ?>
          <div class="wallet-content ft-16 col-md-9">
            <div class="card-block" style="margin-bottom:20px;">
              <div class="userheadername">
	              Your Missing Cashback / Rewards Tickets
              </div>
				      <div>
                Missing any Cashback or Rewards? Simply add a new Ticket with details of your transaction, and we will speak with the retailer to see why it did not track. Below is a list of your existing Tickets and their status. For any other questions, please feel free to Contact Us
              </div>
              <div style="float:right; margin:20px; overflow:hidden; width:100%; text-align:right;">
              	<a href="<?php echo base_url('addticket'); ?>"><button type="submit" class="btn btn-wide btn-round btn-primary">Add Ticket</button></a>
              </div>
              <div class="clearfix"></div>
            </div>
			<?php if(sizeof($ticketlist)>0){ ?>
            <div class="card-block">
                  <div class="userheadername">
                      Cashback / Rewards Tickets
                  </div>
                  <div class="table-scroll-holder">
                <table class="mini">
                    <thead>
                      <tr>
                        <th class="yellow header headerSortDown">Date</th>
                        <th class="yellow header headerSortDown">Retailer Name</th>
                        <th class="yellow header headerSortDown">Amount</th>
                        <th class="yellow header headerSortDown">Transection Id</th>
                        <th class="yellow header headerSortDown">Attachment</th>
                        <th class="yellow header headerSortDown">Status</th>
                        <th class="yellow header headerSortDown">Details</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php  
					  	foreach($ticketlist as $key=>$row){ 
							if($row['date']!='0000-00-00 00:00:00'){
					  ?>
                        <tr>
                        <td><?php echo date("d M Y",strtotime($row['added_date'])); ?></td>
                        <td><?php echo $row['retailer']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['transection_id']; ?></td>
                        <td><?php if($row['attachment']!=''){ ?><a  data-toggle="modal" data-target="#ticketimage" rel="<?php echo base_url("assets/uploads/attachment/".$row['attachment']); ?>" class="tickimage">View Attachement</a><?php } ?>&nbsp;</td>
                        <td><?php echo $row['status']!='1'?"Processing":"Closed<br /><a href='#' data-toggle='modal' data-target='#reopenticket' class='reopenticketlink' rel='".$row['id']."'>Re-open</a>"; ?></td>
                        <td><a  data-toggle="modal" data-target="#ticketdetails" rel="<?php echo $row['id']; ?>" class="tickdetails">Details</a></td>
                        </tr>
                      <?php }} ?>
                    </tbody>
                  </table>
                  </div>
                </div>
                <?php } ?>
          </div>
          
          <div class="wallet-content ft-16 col-md-3">
            <div class="card-block">
          	<div class="profile-box">
            	<h4 class="green">Cashback Earnings</h4>
                <table class="mini">
                  <tr>
                    <td>Total Earnings</td>
                    <td><span class="indianRs">Rs.</span><?php echo isset($tdisocunt)?round($tdisocunt,2):"0.00"; ?></td>
                  </tr>
                  <tr>
                    <td>Paid Earnings</td>
                    <td><span class="indianRs">Rs.</span>0.00</td>
                  </tr>
                  <tr>
                    <td>Cashback Available for payment</td>
                    <td>Rs. 0.00</td>
                  </tr>
                  <tr>
                    <td>Cashback for retailer approval</td>
                    <td>Rs. <?php echo isset($tdisocunt)?round($tdisocunt-(isset($payment[0])?$payment[0]['payment']:0),2):"0.00"; ?></td>
                  </tr>
                </table>
          	</div>
            <div class="clearfix"></div>
          </div>
          <div class="my-favourite-content">
          </div>
          </div>

        </div>
      </div>
    </div>
  </section>