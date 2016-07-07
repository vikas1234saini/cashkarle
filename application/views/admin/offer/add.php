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
      
      echo form_open('admin/offer/add', $attributes);
      ?>
        <fieldset>
          
          
           <div class="control-group">
            <label for="inputError" class="control-label">Title</label>
            <div class="controls">
              <input type="text" id="title" name="title" value="<?php echo set_value('title'); ?>" >
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Image Url</label>
            <div class="controls">
              <input type="text" id="image" name="image" value="<?php echo set_value('image'); ?>" >

            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Site Link</label>
            <div class="controls">
              <input type="text" id="url" name="url" value="<?php echo set_value('url'); ?>" >
            </div>
          </div>
          
          <div class="control-group" >
            <label for="inputError" class="control-label">Payout Type</label>
            <div class="controls">
               <select name="payout_type" id="payout_type">
              	<option value="cpa_flat" <?php if(set_value('payout_type')=='cpa_flat'){ ?> selected="selected" <?php }?>>Flat</option>
                <option value="cpa_pacentage" <?php if(set_value('payout_type')=='cpa_pacentage'){ ?> selected="selected" <?php }?>>Pacentage</option>
              </select>
            </div>
          </div>
          <div class="control-group" >
            <label for="inputError" class="control-label">Percent Payout</label>
            <div class="controls">
              <input type="text" id="percent_payout" name="percent_payout" value="<?php echo set_value('percent_payout'); ?>" />
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Default Payout</label>
            <div class="controls">
              <input type="text" id="default_payout" name="default_payout" value="<?php echo set_value('default_payout'); ?>" />
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Cashback</label>
            <div class="controls">
              <input type="text" id="discount" name="discount" value="<?php echo set_value('discount'); ?>" >
              <select name="discount_type" id="discount_type">
              	<option value="%" <?php if(set_value('discount')=='%'){ ?> selected="selected" <?php }?>>%</option>
                <option value="Rs" <?php if(set_value('discount')=='Rs'){ ?> selected="selected" <?php }?>>Rs</option>
                <option value="$" <?php if(set_value('discount')=='$'){ ?> selected="selected" <?php }?>>$</option>
              </select>
            </div>
          </div>
          

          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <a href="<?php echo site_url().'admin/'.$this->uri->segment(2); ?>/<?php echo $this->session->userdata('page')!=''?$this->session->userdata('page'):0; ?>"><button class="btn" type="button">Cancel</button></a>
          </div>
        </fieldset>
      <input type="hidden" value="<?php echo $this->session->userdata('page')!=''?$this->session->userdata('page'):0; ?>" name="pageno" />

      <?php echo form_close(); ?>

    </div>