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
            echo '<strong>Well done!</strong> product updated with success.';
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

      echo form_open('admin/product/update/'.$this->uri->segment(4).'', $attributes);
      ?>
      <fieldset>
     
          <div class="control-group">
            <label for="inputError" class="control-label">Title</label>
            <div class="controls">
              <input type="text" id="title" name="title" value="<?php echo $product[0]['title']; ?>" >
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Image Url</label>
            <div class="controls">
              <input type="text" id="image" name="image" value="<?php echo $product[0]['image']; ?>" >
              <br />
              <img width="100px" src="<?php echo $product[0]['image']; ?>" />
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Site Link</label>
            <div class="controls">
              <input type="text" id="url" name="url" value="<?php echo $product[0]['url']; ?>" >
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Discount(%)</label>
            <div class="controls">
              <input type="text" id="discount" name="discount" value="<?php echo $product[0]['discount']; ?>" >
            </div>
          </div>
          
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <a href="<?php echo site_url()."admin/".$this->uri->segment(2); ?>/<?php echo $this->session->userdata('page')!=''?$this->session->userdata('page'):0; ?>"><button class="btn" type="button">Cancel</button></a>
          </div>
        </fieldset>

      <input type="hidden" value="<?php echo $this->session->userdata('page')!=''?$this->session->userdata('page'):0; ?>" name="pageno" />      
    	<?php echo form_close(); ?>

    </div>
     