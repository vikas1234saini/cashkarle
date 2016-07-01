    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            User
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">Update</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Updating <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> admin updated with success.';
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

      echo form_open('admin/agent/update/'.$this->uri->segment(4).'', $attributes);
      ?>
      <fieldset>
      
          
          <div class="control-group">
            <label for="admin_first_name" class="control-label">Name</label>
            <div class="controls">
              <input type="text" id="" name="admin_first_name" value="<?php echo $agent[0]['admin_first_name']; ?>" maxlength="20" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">User name</label>
            <div class="controls">
              <input type="text" id="" name="admin_login_name" value="<?php echo $agent[0]['admin_login_name']; ?>" maxlength="10">
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>          
          <div class="control-group">
            <label for="inputError" class="control-label">Password</label>
            <div class="controls">
              <input type="text" id="" name="admin_password" value="<?php echo $agent[0]['admin_password']; ?>" maxlength="15">
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Email</label>
            <div class="controls">
              <input type="text" name="admin_email_id" value="<?php echo $agent[0]['admin_email_id']; ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>"><button class="btn" type="button">Cancel</button></a>
          </div>
        </fieldset>
    	<?php echo form_close(); ?>

    </div>
     