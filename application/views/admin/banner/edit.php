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
            echo '<strong>Well done!</strong> banner updated with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> Please upload valid image.';
          echo '</div>';          
        }
      }
      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '','enctype'=>'multipart/form-data');
     /* $options_manufacture = array('' => "Select");
      foreach ($manufactures as $row)
      {
        $options_manufacture[$row['supervisorId']] = $row['name'];
      }*/

      //form validation
      echo validation_errors();

      echo form_open('admin/banner/update/'.$this->uri->segment(4).'', $attributes);
	  $data_hide = "";
	   if($banner[0]['id']=='56'){
		   $data_hide = 'style="display:none;" ';
	   }
      ?>
      <fieldset>
     
          <div class="control-group">
            <label for="inputError" class="control-label">Link</label>
            <div class="controls">
              <input type="text" id="link" name="link" value="<?php echo $banner[0]['link']; ?>" >
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Banner</label>
            <div class="controls">
              <input type="file" id="banner" name="banner" ><br />
              <strong>Please Upload 800 by 400 image for better view. Image must be bigger than 700 by 300</strong>
              <br />
              <img width="100px" src="<?php echo site_url('assets/uploads/banner/'.$banner[0]['banner']); ?>" />
            </div>
          </div>
          
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <a href="<?php echo site_url()."admin/".$this->uri->segment(2); ?>"><button class="btn" type="button">Cancel</button></a>
          </div>
        </fieldset>
      
    	<?php echo form_close(); ?>

    </div>
     