 <script type='text/javascript'>
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
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
          <a href="#">Update</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Updating <?php echo ucfirst($this->uri->segment(3));?>
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

      echo form_open('admin/ticket/update/'.$this->uri->segment(4).'', $attributes);
      ?>
      <fieldset>
          
          
          <div class="control-group">
            <label for="inputError" class="control-label">Date</label>
            <div class="controls">
             	<div id='datetimepicker1'><input name="date" id="date" type="text"  value="<?php echo date("d-m-Y",strtotime($ticket[0]['date'])); ?>" readonly="readonly" />&nbsp;&nbsp;<span class="glyphicon glyphicon-calendar"></span></div>
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Main Ticket</label>
            <div class="controls">
            
            <select name="retailer" id="retailer">
            <option value="0">-- Select Retailer --</option>
            <?php		
				$find = array("CPRC", "CPA","CPS","CPL"," - India","-","India","india");
				$replace = array("","","","","","","","");
				foreach ($offerlist as $row){
					if($ticket[0]['retailer']==str_replace($find,$replace,$row['title'])){
						echo '<option value="'.str_replace($find,$replace,$row['title']).'" selected="selected">'.str_replace($find,$replace,$row['title']).'</option>';
					}else{
						echo '<option value="'.str_replace($find,$replace,$row['title']).'">'.str_replace($find,$replace,$row['title']).'</option>';
					}
				}
			?>
            </select>
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Amount</label>
            <div class="controls">
              <input type="text" id="amount" name="amount" value="<?php echo $ticket[0]['amount']; ?>" onkeypress="return isNumber(event)" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Transection Id</label>
            <div class="controls">
              <input type="text" id="transection_id" name="transection_id" value="<?php echo $ticket[0]['transection_id']; ?>" >
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Attachment</label>
            <div class="controls">
              <input name="ticketuserfile" id="ticketuserfile" type="file" >
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Description</label>
            <div class="controls">
              <textarea type="text" id="description" name="description"><?php echo $ticket[0]['description']; ?></textarea>
            </div>
          </div>
          
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <a href="<?php echo site_url().'admin/'.$this->uri->segment(2); ?>"><button class="btn" type="button">Cancel</button></a>
          </div>
        </fieldset>
      
      
    	<?php echo form_close(); ?>

    </div>
     