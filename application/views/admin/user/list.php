<script language="javascript" type="text/javascript">
$(document).ready(function() {
	$("#orderfor").change(function() {
								  //alert($(this).val());
		var str = $(this).val();						  
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url('admin/getuseroption'); ?>",
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
				alert("Invalid Date Range! \nFrom Date cannot be after To Date!")
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
           
            $options_user = array(0 => "all");
            foreach ($user as $row)
            {
              $options_user[$row['id']] = $row['username'];
            }
            //save the columns names in a array that we will use as filter         
            $options_user_sort = array();    
            /*foreach ($supervisor as $array) {
              foreach ($array as $key => $value) {
                $options_supervisor[$key] = $key;
              }
              break;
            }*/
			
			$options_offer_sort['earnedamount'] = 'Earned Amount';
			$options_offer_sort['signup'] 		= 'Signup';
			$options_offer_sort['status'] 		= 'Status';
			
            echo form_open('admin/user', $attributes);
     
			  ?>
              <label>From Date:</label>
    <input type="text" class="input_new" name="from_date" id="from_date" placeholder="From date" value="<?php echo isset($from_date)?$from_date:""; ?>" readonly="readonly" onclick="DisableBeforeToday = false; NewCssCal('from_date','DDMMYYYY')" style="width: 170px; height: 26px;">
    <label>To Date:</label>
    <input type="text" class="input_new" name="to_date" id="to_date" placeholder="To date" value="<?php echo isset($to_date)?$to_date:""; ?>" readonly="readonly" onclick="DisableBeforeToday = false; NewCssCal('to_date','DDMMYYYY')" style="width: 170px; height: 26px;">
              <?php

              echo form_label('Search:', 'search_string');
              echo form_input('search_string', $search_string, 'style="width: 170px; height: 26px;"');
			  
              echo form_label('Order by:', 'order');
              echo form_dropdown('orderfor', $options_offer_sort, $orderfor, 'class="span2" id="orderfor"')."&nbsp;&nbsp;";
              echo form_dropdown('order', $options_offer_sort1, $order, 'class="span2" id="orderlist"')."&nbsp;&nbsp;";

              $data_submit = array('name' => 'mysubmit','id' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');

              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type, 'class="span1"')."&nbsp;&nbsp;";

              echo form_submit($data_submit)."&nbsp;&nbsp;";
              echo form_button('myreset',"Reset",'class="btn btn-danger" onclick=window.location.href="'.base_url('admin/user').'"');

            echo form_close();
            ?>

			<div style="float:right"><a href="<?php echo base_url(); ?>admin/export/user?for=user&key=<?php echo $search_string; ?>&from=<?php echo $from_date; ?>&to=<?php echo $to_date; ?>">Export Data</a></div>
          </div>
			<div style="padding-top:20px;padding-bottom:20px; font-size:14px;">
            	<strong>Total Earnigns: <?php echo round($total_payment[0]['payment'],2); ?></strong>
            </div>
          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Name</th>
                <th class="yellow header headerSortDown">Email</th>
                <th class="yellow header headerSortDown">Password</th>
                <th class="yellow header headerSortDown">Signup Mode</th>
                <th class="yellow header headerSortDown">Earned</th>
                <th class="yellow header headerSortDown">Username</th>
                <th class="yellow header headerSortDown">Status</th>
  <!--              <th class="red header">Actions</th>-->
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($user as $row)
              {
				  if($row['id']!=''){
					echo '<tr>';
					echo '<td>'.$row['id'].'</td>';
					echo '<td>'.$row['username'].' </td>';
					echo '<td>'.$row['email'].' </td>';
					echo '<td>********</td>';
					if($row['facebook']!=''){
						echo '<td>Facebook</td>';
					}elseif($row['twitter']!=''){
						echo '<td>Twitter</td>';
					}elseif($row['linkedin']!=''){
						echo '<td>Linkedin</td>';
					}elseif($row['gplus']!=''){
						echo '<td>Google Plus</td>';
					}else{
						echo '<td>Email</td>';
					}
					echo '<td>'.round($row['payment'],2).' </td>';
					echo '<td>'.$row['admin'].' </td>';
					if($row['status']==1){
						echo '<td><a href="'.site_url("admin").'/user/updatestatus/'.$row['id'].'/0/">Active</a></td>';
					}else{
						echo '<td><a href="'.site_url("admin").'/user/updatestatus/'.$row['id'].'/1/">De-active</a></td>';
					}
		//			echo '<td class="crud-actions">					  <a href="'.site_url().'admin/user/update/'.$row['id'].'" class="btn btn-info">view & edit</a>  ';
					  $login_user_details = $this->session->userdata('user_details');
					 if($login_user_details[0]['admin']){
						//echo '<a href="'.site_url().'admin/user/delete/'.$row['id'].'" class="btn btn-danger">delete</a>';
					 }
//					echo '</td>';
					echo '</tr>';
				  }
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>