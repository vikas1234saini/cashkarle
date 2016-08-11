<script language="javascript" type="text/javascript">
$(document).ready(function() {
	$("#orderfor").change(function() {
								  //alert($(this).val());
		var str = $(this).val();						  
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url('admin/getpaymentorder'); ?>",
			data:"str="+str,
			success: function(res) {
				$('#orderlist').html(res);
			}
		});
	});		
	
});		
</script>

	<script src="<?php echo  base_url('assets/js/calendar/DateTimePicker.js'); ?>" type="text/javascript"></script>
    <style>
	#calBorder{ z-index:100000 !important;}
	select{ width:100px !important;}
	</style>
	<div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url()."admin/".$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        
      </ul>

     
	 <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated' || $this->session->flashdata('flash_message') == 'added')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">X</a>';
            echo '<strong>Well done!</strong> payment updated successfully.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">X</a>';
            echo '<strong>Oh snap!</strong> ';
          echo '</div>';          
        }
      }
      ?>      
      
      <div class="row">
        <div class="span12 columns">
        
          <div class="well">
          
			<?php
           
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
		   
			$options_offer_sort['no'] = '--Select--';
			$options_offer_sort['username'] = 'Username';
			$options_offer_sort['status'] = 'Status';
			
            echo form_open('admin/payment', $attributes);
     

            //  echo form_label('Search:', 'search_string');
              //echo form_input('search_string', $search_string, 'style="width: 170px; height: 26px;"')."&nbsp;&nbsp;";
?>

	<label>From Date:</label>
    <input type="text" class="input_new" name="from_date" id="from_date" placeholder="From date" value="<?php echo isset($from_date)?$from_date:""; ?>" readonly="readonly" onclick="DisableBeforeToday = false; NewCssCal('from_date','DDMMYYYY')" style="width: 170px; height: 26px;">
    <label>To Date:</label>
    <input type="text" class="input_new" name="to_date" id="to_date" placeholder="To date" value="<?php echo isset($to_date)?$to_date:""; ?>" readonly="readonly" onclick="DisableBeforeToday = false; NewCssCal('to_date','DDMMYYYY')" style="width: 170px; height: 26px;">
<?php
              echo form_label('Order by:', 'order');
              echo form_dropdown('orderfor', $options_offer_sort, $orderfor, 'class="span2" id="orderfor"')."&nbsp;&nbsp;";
              echo form_dropdown('order', $options_offer_sort1, $order, 'class="span2" id="orderlist"')."&nbsp;&nbsp;";

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');

              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type, 'class="span1"')."&nbsp;&nbsp;";

              echo form_submit($data_submit)."&nbsp;&nbsp;";
              echo form_button('myreset',"Reset",'class="btn btn-danger" onclick=window.location.href="'.base_url('admin/payment').'"');

	          echo form_close();
            ?>

			<div style="float:right"><a href="<?php echo base_url(); ?>admin/export/payment?for=payment&key=<?php echo $search_string; ?>&from=<?php echo $from_date; ?>&to=<?php echo $to_date; ?>&order=<?php echo $order; ?>&orderfor=<?php echo $orderfor; ?>">Export Data</a></div>
          </div>
          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Name</th>
                <th class="yellow header headerSortDown">Name in Bank</th>
                <th class="yellow header headerSortDown">Bank Name</th>
                <th class="yellow header headerSortDown">Account Number</th>
                <th class="yellow header headerSortDown">Branch</th>
                <th class="yellow header headerSortDown">IFSC</th>
                <th class="red header">Date</th>
                <th class="red header">Action</th>
                <th class="red header">Username</th>
                <!--<th class="red header">View</th>-->
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($payment as $row)
              {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['username'].' </td>';
                echo '<td>'.$row['bankusername'].' </td>';
                echo '<td>'.$row['bankname'].' </td>';
                echo '<td>'.$row['accountno'].' </td>';
                echo '<td>'.$row['branch'].' </td>';
                echo '<td>'.$row['ifsc'].' </td>';
                echo '<td>'.date("d-M-Y h:i a",strtotime($row['date'])).' </td>';
				
				if($row['status']==1){
                	echo '<td>DONE</td>';
				}else{
                	echo '<td><a href="'.site_url("admin").'/payment/updatestatus/'.$row['id'].'/1/">Not DONE</a></td>';
				}
                echo '<td>'.$row['admin'].' </td>';
				
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>