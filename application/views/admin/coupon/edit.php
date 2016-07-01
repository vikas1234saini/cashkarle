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
            echo '<strong>Well done!</strong> coupon updated with success.';
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
      $attributes = array('class' => 'form-horizontal', 'supervisorId' => '');
     /* $options_manufacture = array('' => "Select");
      foreach ($manufactures as $row)
      {
        $options_manufacture[$row['supervisorId']] = $row['name'];
      }*/

      //form validation
      echo validation_errors();

      echo form_open('admin/coupon/update/'.$this->uri->segment(4).'', $attributes);
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
				foreach ($alloffer as $row){
					if($row['main_id']!=''){
						
						if($coupon[0]['offer_id']==$row['main_id']){
							echo '<option value="'.$row['main_id'].'" selected="selected">'.str_replace($find,$replace,$row['title']).'</option>';
						}else{
							echo '<option value="'.$row['main_id'].'">'.str_replace($find,$replace,$row['title']).'</option>';
						}
					}
				}
			?>
            </select>
            <input type="hidden" name="offer_name" id="offer_name" value="<?php echo $coupon[0]['offer_name']; ?>" />
            </div>
          </div> 
          <div class="control-group">
            <label for="inputError" class="control-label">Coupon</label>
            <div class="controls">
              <?php echo $coupon[0]['coupon_title']; ?>
            </div>
          </div> 
          <div class="control-group">
            <label for="inputError" class="control-label">Cashback</label>
            <div class="controls">
              <input type="text" id="discount" name="discount" value="<?php echo $coupon[0]['discount']; ?>" />
              <select name="discount_type" id="discount_type">
              	<option value="%" <?php if($coupon[0]['discount_type']=='%'){ ?> selected="selected" <?php }?>>%</option>
                <option value="Rs" <?php if($coupon[0]['discount_type']=='Rs'){ ?> selected="selected" <?php }?>>Rs</option>
                <option value="$" <?php if($coupon[0]['discount_type']=='$'){ ?> selected="selected" <?php }?>>$</option>
              </select>
            </div>
          </div>
          
          
          

          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <a href="<?php echo site_url()."admin/couponoffer/".$coupon[0]['offer_id']; ?>"><button class="btn" type="button">Cancel</button></a>
          </div>
        </fieldset>
		<input type="hidden" name="offer_id" value="<?php echo $coupon[0]['offer_id']; ?>" />      
    	<?php echo form_close(); ?>

    </div>
     