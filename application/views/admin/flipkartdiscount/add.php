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
      
      echo form_open('admin/flipkartdiscount/add', $attributes);
      ?>
        <fieldset>
          
          
           <div class="control-group">
            <label for="inputError" class="control-label">Title</label>
            <div class="controls">
              <input type="text" id="category" name="category" value="<?php echo set_value('category'); ?>" >
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Discount Given</label>
            <div class="controls">
              <input type="text" id="discount_given" name="discount_given" value="<?php echo set_value('discount_given'); ?>" >

            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Discount By Us</label>
            <div class="controls">
              <input type="text" id="discount_by_us" name="discount_by_us" value="<?php echo set_value('discount_by_us'); ?>" >
             <!-- <select name="discount_unit" id="discount_unit">
              	<option value="%">%</option>
                <option value="Rs">Rs</option>
                <option value="$">$</option>
              </select>-->
            </div>
          </div>

          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <a href="<?php echo site_url().'admin/'.$this->uri->segment(2); ?>"><button class="btn" type="button">Cancel</button></a>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>