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
          Ticket <?php echo ucfirst($this->uri->segment(3));?>
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

      echo form_open('admin/ticket/view/'.$this->uri->segment(4).'', $attributes);
      ?>
      <fieldset>

      		<div><strong>Replied Before:</strong><br /></div>
            <?php foreach($prev_reply as $key=>$value){ ?>    	
		          <div class="control-group" style="border:solid 1px #999; background:#F3F3F3; padding:10px; width:400px;word-wrap: break-word;"><?php echo $value['reply']; ?><br  /><strong>Dated:</strong> <?php echo date("d M Y h:i a",strtotime($value['date'])); ?><br  /><strong>By:</strong> <?php echo $value['user']; ?></div>
            <?php  } ?>          
          
          <div class="control-group">
            <label for="inputError" class="control-label">Dated</label>
            <div class="controls">
             	<?php 
					if($ticket[0]['random']!=''){
						$data_data = $this->db->select('date')->from('tbl_linkgo')->where('random', $ticket[0]['random'])->get()->result_array();
						if(sizeof($data_data)>0){
							echo date("d-M Y H:i a",strtotime($data_data[0]['date'])); 
						}else{
							echo date("d-M Y H:i a",strtotime($ticket[0]['date'])); 
						}
					}else{
						echo date("d-M Y H:i a",strtotime($ticket[0]['date'])); 
					}
				?>
            </div>
          </div>
          
          <div class="control-group">
            <label for="inputError" class="control-label">Retailer</label>
            <div class="controls">
             	<?php echo $ticket[0]['retailer']; ?>
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">By User</label>
            <div class="controls">
              <?php echo $ticket[0]['username']; ?>
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Amount</label>
            <div class="controls">
              <?php echo $ticket[0]['amount']; ?>
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Transection Id</label>
            <div class="controls">
              <?php echo $ticket[0]['transection_id']; ?>
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Unique No.</label>
            <div class="controls">
              <?php echo $ticket[0]['random']; ?>
            </div>
          </div>
          
          <div class="control-group">
            <label for="inputError" class="control-label">Description</label>
            <div class="controls" style="word-wrap: break-word; width:300px;">
              <?php echo $ticket[0]['description']; ?>
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Replied By</label>
            <div class="controls">
            <?php echo $ticket[0]['admin'];?>
            </div>
          </div>
          
          <div class="form-actions">
            <a href="<?php echo site_url().'admin/'.$this->uri->segment(2); ?>"><button class="btn" type="button">Back</button></a>
          </div>
        </fieldset>
      
      
    	<?php echo form_close(); ?>
    </div>