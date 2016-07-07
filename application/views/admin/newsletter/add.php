<script language="javascript" type="text/javascript">
$(document).ready(function() {
	$("#checkAll").click(function () {
     	$('input:checkbox').not(this).prop('checked', this.checked);
 	});
});		
</script>
<style>
.search_link{ margin:0 10px;}
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
          Send Email
        </h2>
      </div>
 
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Email send successfully.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      <table>
      
            	<tr>
                	<td align="center">
                        <a href="<?php echo base_url('admin/newsletter/add/all'); ?>" class="search_link">All</a>
                        <a href="<?php echo base_url('admin/newsletter/add/a'); ?>" class="search_link">A</a>
                        <a href="<?php echo base_url('admin/newsletter/add/b'); ?>" class="search_link">B</a>
                        <a href="<?php echo base_url('admin/newsletter/add/c'); ?>" class="search_link">C</a>
                        <a href="<?php echo base_url('admin/newsletter/add/d'); ?>" class="search_link">D</a>
                        <a href="<?php echo base_url('admin/newsletter/add/e'); ?>" class="search_link">E</a>
                        <a href="<?php echo base_url('admin/newsletter/add/f'); ?>" class="search_link">F</a>
                        <a href="<?php echo base_url('admin/newsletter/add/g'); ?>" class="search_link">G</a>
                        <a href="<?php echo base_url('admin/newsletter/add/h'); ?>" class="search_link">H</a>
                        <a href="<?php echo base_url('admin/newsletter/add/i'); ?>" class="search_link">I</a>
                        <a href="<?php echo base_url('admin/newsletter/add/j'); ?>" class="search_link">J</a>
                        <a href="<?php echo base_url('admin/newsletter/add/k'); ?>" class="search_link">K</a>
                        <a href="<?php echo base_url('admin/newsletter/add/l'); ?>" class="search_link">L</a>
                        <a href="<?php echo base_url('admin/newsletter/add/m'); ?>" class="search_link">M</a>
                        <a href="<?php echo base_url('admin/newsletter/add/n'); ?>" class="search_link">N</a>
                        <a href="<?php echo base_url('admin/newsletter/add/o'); ?>" class="search_link">O</a>
                        <a href="<?php echo base_url('admin/newsletter/add/p'); ?>" class="search_link">P</a>
                        <a href="<?php echo base_url('admin/newsletter/add/q'); ?>" class="search_link">Q</a>
                        <a href="<?php echo base_url('admin/newsletter/add/r'); ?>" class="search_link">R</a>
                        <a href="<?php echo base_url('admin/newsletter/add/s'); ?>" class="search_link">S</a>
                        <a href="<?php echo base_url('admin/newsletter/add/t'); ?>" class="search_link">T</a>
                        <a href="<?php echo base_url('admin/newsletter/add/u'); ?>" class="search_link">U</a>
                        <a href="<?php echo base_url('admin/newsletter/add/v'); ?>" class="search_link">V</a>
                        <a href="<?php echo base_url('admin/newsletter/add/w'); ?>" class="search_link">W</a>
                        <a href="<?php echo base_url('admin/newsletter/add/x'); ?>" class="search_link">X</a>
                        <a href="<?php echo base_url('admin/newsletter/add/y'); ?>" class="search_link">Y</a>
                        <a href="<?php echo base_url('admin/newsletter/add/z'); ?>" class="search_link">Z</a>
                    </td>
                </tr>
      </table>
      
      <?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');
      //form validation
      echo validation_errors();
      echo form_open('admin/newsletter/add/'.$for, $attributes);
      ?>
      <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header" style="width:20px;"><input type="checkbox" checked="checked" id="checkAll" /></th>
              <!--  <th class="yellow header headerSortDown">Name</th>-->
                <th class="yellow header headerSortDown">Email</th>
              </tr>
            </thead>
            <tbody>
              <?php
			  if(sizeof($user_list)>0){
				  foreach($user_list as $row){
					echo '<tr>';
					if(isset($_POST['userlist']) && in_array($row['email'],$_POST['userlist'])){
						echo '<td><input type="checkbox" name="userlist[]" value="'.$row['email'].'" checked="checked" /></td>';
					}else{
						if(isset($_POST) && sizeof($_POST)>0){
							echo '<td><input type="checkbox" name="userlist[]" value="'.$row['email'].'" /></td>';
						}else{
							echo '<td><input type="checkbox" name="userlist[]" value="'.$row['email'].'" checked="checked" /></td>';
						}
					}
					//echo '<td>'.$row['title'].' </td>';
					echo '<td>'.$row['email'].' </td>';
					echo '</tr>';
				  }
			  }else{
					echo '<tr>';
					echo '<td colspan="3" align="center" style=" text-align:center;"><strong>No User Found.</strong></td>';
					echo '</tr>';
				  
			  }
              ?>      
            </tbody>
          </table>
        <fieldset>
           <div class="control-group">
            <label for="inputError" class="control-label">Title</label>
            <div class="controls">
              <input type="text" id="title" name="title" value="<?php echo set_value('title'); ?>" >
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Description</label>
            <div class="controls">
            	<?php echo $this->ckeditor->editor('description',set_value('description'));?> <?php echo form_error('description','<p class="error">'); ?>
            </div>
          </div>
          

          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Send Mail</button>
            <!--<a href="<?php echo site_url().'admin/'.$this->uri->segment(2); ?>"><button class="btn" type="button">Cancel</button></a>-->
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>