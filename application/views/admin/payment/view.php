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
          <a href="#">View</a>
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
        if($this->session->flashdata('flash_message') == 'viewd')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> payment viewd with success.';
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

      echo form_open('admin/payment/view/'.$this->uri->segment(4).'', $attributes);
      ?>
      <fieldset>
          
          
          <div class="control-group">
            <label for="inputError" class="control-label"><strong>Date</strong></label>
            <div class="controls">
             	<?php echo date("d-m-Y",strtotime($payment[0]['date'])); ?>
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label"><strong>Name</strong></label>
            <div class="controls">
            
            
             	<?php echo $payment[0]['name']; ?>
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label"><strong>Email</strong></label>
            <div class="controls">
            
            
             	<?php echo $payment[0]['email']; ?>
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label"><strong><strong>Option</strong></strong></label>
            <div class="controls">
            
            
             	<?php echo $payment[0]['option']; ?>
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label"><strong>Username</strong></label>
            <div class="controls">
            
            
             	<?php echo $payment[0]['admin']; ?>
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label"><strong>Description</strong></label>
            <div class="controls">
              <?php echo $payment[0]['description']; ?>
            </div>
          </div>
          
          <div class="form-actions">
            <a href="<?php echo site_url().'admin/'.$this->uri->segment(2); ?>/<?php echo $this->session->userdata('page')!=''?$this->session->userdata('page'):0; ?>"><button class="btn" type="button">Back</button></a>
          </div>
        </fieldset>
      
      
      <input type="hidden" value="<?php echo $this->session->userdata('page')!=''?$this->session->userdata('page'):0; ?>" name="pageno" />
    	<?php echo form_close(); ?>

    </div>
     