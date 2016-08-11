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
        
        <li class="active">
          <a href="#">New</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Adding <?php echo ucfirst($this->uri->segment(3));?>
        </h2>
      </div>
 
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new specialisation created with success.';
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
      $attributes = array('class' => 'form-horizontal', 'id' => '');
   
      //form validation
      echo validation_errors();
      
      echo form_open('admin/coupon/add', $attributes);
      ?>
        <fieldset>
          
      
     	
          <div class="control-group">
            <label for="inputError" class="control-label">Retailer</label>
            <div class="controls">
            <select name="offer_id" id="offer_id" onchange="document.getElementById('offer_name').value=this.options[this.selectedIndex].innerHTML">
            <option value="">-- Select Retailer --</option>
            <?php		
				$find = array("CPRC", "CPA","CPS","CPL"," - India"," - UAE"," - Qatar");
				$replace = array("","","","","");
				$offer_set = set_value('offer_id')!=false?set_value('offer_id'):$old_offer_id;
				foreach ($alloffer as $row){
					if($row['main_id']!=''){
						if($offer_set==$row['main_id']){
							echo '<option value="'.$row['main_id'].'" selected="selected">'.str_replace($find,$replace,$row['title']).'</option>';
						}else{
							echo '<option value="'.$row['main_id'].'">'.str_replace($find,$replace,$row['title']).'</option>';
						}
					}
				}
			?>
            </select>
            <input type="hidden" name="offer_name" id="offer_name" value="<?php echo set_value('offer_name'); ?>" />
            </div>
          </div>     
          
          <div class="control-group">
            <label for="inputError" class="control-label">Coupon</label>
            <div class="controls">
              <input type="text" id="coupon_title" name="coupon_title" value="<?php echo set_value('coupon_title'); ?>" >
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Coupon Description</label>
            <div class="controls">
              <input type="text" id="coupon_description" name="coupon_description" value="<?php echo set_value('coupon_description'); ?>" >
            </div>
          </div>
           <div class="control-group">
            <label for="inputError" class="control-label">Start Date</label>
            <div class="controls">
             	<div id='datetimepicker1'><input name="added" id="added" type="text"  value="<?php echo set_value('added'); ?>" readonly="readonly" onclick="DisableBeforeToday = false; NewCssCal('added','DDMMYYYY')" /></div>
            </div>
          </div>
           <div class="control-group">
            <label for="inputError" class="control-label">Coupon Expiry</label>
            <div class="controls">
             	<div id='datetimepicker1'><input name="coupon_expiry" id="coupon_expiry" type="text"  value="<?php echo set_value('coupon_expiry'); ?>" readonly="readonly" onclick="DisableBeforeToday = false; NewCssCal('coupon_expiry','DDMMYYYY')" /></div>
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Link</label>
            <div class="controls">
              <input type="text" id="link" name="link" value="<?php echo set_value('link'); ?>" >
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Cashback</label>
            <div class="controls">
              <input type="text" id="discount" name="discount" value="<?php echo set_value('discount'); ?>" >
                <select name="discount_type" id="discount_type">
              	<option value="%" <?php if(set_value('discount_type')=='%'){ ?> selected="selected" <?php }?>>%</option>
                <option value="Rs" <?php if(set_value('discount_type')=='Rs'){ ?> selected="selected" <?php }?>>Rs</option>
                <option value="$" <?php if(set_value('discount_type')=='$'){ ?> selected="selected" <?php }?>>$</option>
              </select>
            </div>
          </div>
          
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <a href="<?php echo site_url().'admin/offer'; ?>"><button class="btn" type="button">Cancel</button></a>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>