<script language="javascript" type="text/javascript">
$(document).ready(function() {
	$("#orderfor").change(function() {
								  //alert($(this).val());
		var str = $(this).val();						  
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url('admin/getticketoption'); ?>",
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
     <script>

	$(document).ready(function(){
		$( "#mysubmit" ).click(function() {
			from_date =$('#from_date').val();
			to_date = $('#to_date').val();
			var fromdate = from_date.split('-');
			from_date = new Date();
			from_date.setFullYear(fromdate[2],fromdate[1]-1,fromdate[0]);
			var todate = to_date.split('-');
			to_date = new Date();
			to_date.setFullYear(todate[2],todate[1]-1,todate[0]);
			if (from_date > to_date ) {
				alert("Invalid Date Range!\nFrom Date cannot be after To Date!")
				return false;
			}													
		});
	});
	</script>
	<div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url()."admin/".$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        
      </ul>

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a  href="<?php echo site_url()."admin/".$this->uri->segment(2); ?>/add" class="btn btn-success">Add a new</a>
        </h2>
      </div>
	 <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated' || $this->session->flashdata('flash_message') == 'added')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">X</a>';
            echo '<strong>Well done!</strong> Ticket updated successfully.';
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
           
            $options_ticket = array(0 => "all");
            foreach ($ticket as $row)
            {
          //    $options_ticket[$row['id']] = $row['ticketName'];
            }
            //save the columns names in a array that we will use as filter         
            $options_ticket_sort = array();    
            /*foreach ($supervisor as $array) {
              foreach ($array as $key => $value) {
                $options_supervisor[$key] = $key;
              }
              break;
            }*/
			
			$options_offer_sort['no'] = '-- Select --';
			$options_offer_sort['offerby'] = 'Retailer';
			$options_offer_sort['username'] = 'Username';
			$options_offer_sort['status'] = 'Status';
			
            echo form_open('admin/ticket', $attributes);
     
              echo form_label('Search:', 'search_string');
             echo form_input('search_string', $search_string, 'style="width: 170px;height: 26px;"');

              
?>
	<label>From Date:</label>
    <input type="text" class="input_new" name="from_date" id="from_date" placeholder="From date" value="<?php echo isset($from_date)?$from_date:""; ?>" readonly="readonly" onclick="DisableBeforeToday = false; NewCssCal('from_date','DDMMYYYY')" style="width: 170px; height: 26px;">
    <label>To Date:</label>
    <input type="text" class="input_new" name="to_date" id="to_date" placeholder="To date" value="<?php echo isset($to_date)?$to_date:""; ?>" readonly="readonly" onclick="DisableBeforeToday = false; NewCssCal('to_date','DDMMYYYY')" style="width: 170px; height: 26px;">
<?php
              $data_submit = array('name' => 'mysubmit','id' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');
			  
              echo form_label('Order by:', 'order');
              echo form_dropdown('orderfor', $options_offer_sort, $orderfor, 'class="span2" id="orderfor"')."&nbsp;&nbsp;";
              echo form_dropdown('order', $options_offer_sort1, $order, 'class="span2" id="orderlist"')."&nbsp;&nbsp;";

              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type, 'class="span1"')."&nbsp;&nbsp;";

              echo form_submit($data_submit)."&nbsp;&nbsp;";
              echo form_button('myreset',"Reset",'class="btn btn-danger" onclick=window.location.href="'.base_url('admin/ticket').'"');

            echo form_close();
            ?>

			<div style="float:right"><a href="<?php echo base_url(); ?>admin/export/ticket?for=user&key=<?php echo $search_string; ?>&from=<?php echo $from_date; ?>&to=<?php echo $to_date; ?>&order=<?php echo $order; ?>&orderfor=<?php echo $orderfor; ?>">Export Data</a></div>
          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">User Name</th>
                <th class="yellow header headerSortDown">Ticket Id</th>
                <th class="yellow header headerSortDown">Retailer</th>
                <th class="yellow header headerSortDown">Unique Number</th>
                <th class="yellow header headerSortDown">Transection Id</th>
                <th class="yellow header headerSortDown">Status</th>
                <th class="yellow header headerSortDown">Close Ticket</th>
                <th class="yellow header headerSortDown">Closed Date</th>
                <th class="yellow header headerSortDown">Added Date</th>
                <th class="yellow header headerSortDown">Username</th>
                <th class="red header">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($ticket as $row)
              {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['username'].' </td>';
                echo '<td>'.$row['ticket_id'].' </td>';
                echo '<td>'.$row['retailer'].' </td>';
                echo '<td>'.$row['random'].' </td>';
                echo '<td>'.$row['transection_id'].' </td>';
				if($row['status']==1){
					echo "<td>Closed</td>";
				}elseif($row['status']==2){
					echo "<td>Re-opened</td>";
				}else{
                	echo '<td>Processing</td>';
				}
				if($row['status']==1){
					echo "<td>&nbsp;</td>"; 
				}else{
                	echo '<td><a href="'.site_url("admin").'/ticket/updatestatus/'.$row['id'].'/1/"><button>Close Ticket</button></a></td>';
				}
                echo '<td>'.(($row['close_date']!='1970-01-01 00:00:00' && $row['close_date']!='')?date("d-M Y h:i a",strtotime($row['close_date'])):" ").' </td>';
                echo '<td>'.(($row['added_date']!='1970-01-01 00:00:00' && $row['added_date']!='')?date("d-M Y h:i a",strtotime($row['added_date'])):" ").' </td>';
                echo '<td>'.$row['admin'].' </td>';
				if($row['status']!='1'){
                echo '<td class="crud-actions">
                 <!--<a href="'.site_url().'admin/ticket/update/'.$row['id'].'" class="btn btn-info">view & edit</a> -->
                 <a href="'.site_url().'admin/ticket/reply/'.$row['id'].'" class="btn btn-danger">Reply</a>
                 <a href="'.site_url().'admin/ticket/view/'.$row['id'].'" class="btn btn-danger">View</a>';
				}else{
//                echo '<td class="crud-actions">                <a href="'.site_url().'admin/ticket/reply/'.$row['id'].'" class="btn btn-danger">Reply</a>';
					echo '<td class="crud-actions"><a href="'.site_url().'admin/ticket/view/'.$row['id'].'" class="btn btn-danger">View</a></td>';
					
				}
				  $login_user_details = $this->session->userdata('user_details');
				 if($login_user_details[0]['admin']){
                 	//echo '<a href="'.site_url().'admin/ticket/delete/'.$row['id'].'" class="btn btn-danger">delete</a>';
				 }
                echo '</td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>