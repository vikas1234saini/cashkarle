<?php $login_user_details = $this->session->userdata('user_details'); ?>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
	$("#showcashback").click(function() {
		$('#cashbackdiv').show();		
		$(this).hide();
		return false;
	});		
	$("#hidecashback").click(function() {
		$('#showcashback').show();		
		$('#cashbackdiv').hide();		
		$('#cashback').val("");	
		return false;
//		$(this).hide();
	});		
	 /*$("#cashback").keydown(function(event) {
    	// Allow only backspace and delete
    	if ( event.keyCode == 46 || event.keyCode == 8 ) {
    		// let it happen, don't do anything
    	}
    	else {
    		// Ensure that it is a number and stop the keypress
    		if (event.keyCode < 48 || event.keyCode > 57 ) {
    			event.preventDefault();	
    		}	
    	}
    });*/
	 $("#cashback").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
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
        
        <li class="active">
          <a href="#">Reply</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(3));?>
        </h2>
      </div>

 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> ticket updated with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'supervisorId' => '','enctype'=>'multipart/form-data');
     /* $options_manufacture = array('' => "Select");
      foreach ($manufactures as $row)
      {
        $options_manufacture[$row['supervisorId']] = $row['name'];
      }*/

      //form validation
      echo validation_errors();

      echo form_open('admin/ticket/reply/'.$this->uri->segment(4).'', $attributes);
      ?>
      <fieldset>
      		<div><strong>Replied Before:</strong><br /></div>
            <?php foreach($prev_reply as $key=>$value){ ?>    	
		          <div class="control-group" style="border:solid 1px #999; background:#F3F3F3; padding:10px; width:400px;word-wrap: break-word;"><?php echo $value['reply']; ?><br  /><strong>Dated:</strong> <?php echo date("d M Y h:i a",strtotime($value['date'])); ?><br  /><strong>By:</strong> <?php echo $value['user']; ?></div>
            <?php  } ?>
          
          <div class="control-group">
            <label for="inputError" class="control-label">Reply:</label>
            <div class="controls">
              <textarea id="reply" name="reply"><?php echo set_value('reply'); ?></textarea>
              
	            <?php if(strtolower($login_user_details[0]['admin_login_name'])==strtolower('admin')){ ?>
              <br />
              <a href="javascript:void(0);" id="showcashback">Add Cashback</a>
              <br />
              <div style="display:none;" id="cashbackdiv">
              
              	<a href="javascript:void(0);" id="hidecashback">Remove Cashback</a>
              	<br />
                    <input type="text" name="cashback" id="cashback" placeholder="Add Amount" />
                    <br />
                    <input type="checkbox" name="cashback_now" id="cashback_now" value="now" /> <label for="cashback_now" style="display:inline;">Cashback auto confirm now.</label>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Reply</button>
            <a href="<?php echo site_url().'admin/'.$this->uri->segment(2); ?>"><button class="btn" type="button">Cancel</button></a>
          </div>
        </fieldset>
    	<?php echo form_close(); ?>
    </div>