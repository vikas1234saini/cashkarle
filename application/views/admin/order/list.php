<script language="javascript" type="text/javascript">
$(document).ready(function() {
	/*$("#orderfor").change(function() {
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
	});		*/
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

      <!--<div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a  href="<?php echo site_url()."admin/".$this->uri->segment(2); ?>/add" class="btn btn-success">Add a new</a>
        </h2>
      </div>-->
	 <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated' || $this->session->flashdata('flash_message') == 'added')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">X</a>';
            echo '<strong>Well done!</strong> package '.$this->session->flashdata('flash_message').' with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">X</a>';
            echo '<strong>Oh snap!</strong> you have only 4 supervisor active once.';
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
            //save the columns names in a array that we will use as filter         
            $options_ticket_sort = array();    
            /*foreach ($supervisor as $array) {
              foreach ($array as $key => $value) {
                $options_supervisor[$key] = $key;
              }
              break;
            }*/
			
			$options_offer_sort['sitename'] = 'Site Name';
			
            echo form_open('admin/order', $attributes);
     
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
//              echo form_dropdown('orderfor', $options_offer_sort, $orderfor, 'class="span2" id="orderfor"')."&nbsp;&nbsp;";
              echo form_dropdown('orderfor', $options_offer_sort, $orderfor, 'class="span2" id="orderlist"')."&nbsp;&nbsp;";

              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type, 'class="span1"')."&nbsp;&nbsp;";

              echo form_submit($data_submit)."&nbsp;&nbsp;";
              echo form_button('myreset',"Reset",'class="btn btn-danger" onclick=window.location.href="'.base_url('admin/ticket').'"');

            echo form_close();
            ?>

			<div style="float:right"><a href="<?php echo base_url(); ?>admin/export/order?for=order&key=<?php echo $search_string; ?>&from=<?php echo $from_date; ?>&to=<?php echo $to_date; ?>&orderfor=<?php echo $orderfor; ?>">Export Data</a></div>
          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Order Id</th>
                <th class="yellow header headerSortDown">User</th>
                <th class="yellow header headerSortDown">Amount</th>
                <th class="yellow header headerSortDown">Sitename</th>
                <th class="yellow header headerSortDown">Status</th>
                <th class="yellow header headerSortDown">Date</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($order as $count=>$row)
              {
                echo '<tr>';
                echo '<td>'.($count+1).'</td>';
                echo '<td>'.$row['random'].' </td>';
                echo '<td>'.$row['username'].' </td>';
                echo '<td>'.$row['amount'].' </td>';
                echo '<td>'.$row['sitename'].' </td>';
                echo '<td>'.$row['orderStatus'].' </td>';
                echo '<td>'.date("d-M Y h:i a",strtotime($row['date'])).' </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>