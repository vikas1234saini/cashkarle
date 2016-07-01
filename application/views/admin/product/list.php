
	<div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url()."admin/".$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        
      </ul>

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a  href="<?php echo site_url()."admin/".$this->uri->segment(2); ?>/add" class="btn btn-success">Add a new</a>
        </h2>
      </div>
	 <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated' || $this->session->flashdata('flash_message') == 'added')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">X</a>';
            echo '<strong>Well done!</strong> package '.$this->session->flashdata('flash_message').' with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">X</a>';
            echo '<strong>Oh snap!</strong> you have only 4 supervisor active once.';
          echo '</div>';          
        }
      }
      ?>      
      <div class="row">
        <div class="span12 columns">
          <div class="well">
           
            <?php
           
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            //save the columns names in a array that we will use as filter         
            $options_product_sort = array();    
            /*foreach ($supervisor as $array) {
              foreach ($array as $key => $value) {
                $options_supervisor[$key] = $key;
              }
              break;
            }*/
			$options_product_sort['title'] = 'title';
			$options_product_sort['id'] = 'id';
			
            echo form_open('admin/product', $attributes);
     
              echo form_label('Search:', 'search_string');
              echo form_input('search_string', $search_string, 'style="width: 170px;
height: 26px;"');

              echo form_label('Order by:', 'order');
              echo form_dropdown('order', $options_product_sort, $order, 'class="span2"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');

              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type, 'class="span1"');

              echo form_submit($data_submit);
              echo form_button('myreset',"Reset",'class="btn btn-danger" onclick=window.location.href="'.base_url('admin/product').'"');

            echo form_close();
            ?>

			<div style="float:right"><a href="<?php echo base_url(); ?>admin/export/discount?for=product&key=<?php echo $search_string; ?>">Export Data</a></div>
          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Title</th>
                <th class="yellow header headerSortDown">Image</th>
                <th class="yellow header headerSortDown">Site Url</th>
                <th class="yellow header headerSortDown">Category</th>
                <th class="yellow header headerSortDown">Status</th>
                <th class="yellow header headerSortDown">Featured</th>
                <th class="yellow header headerSortDown">Username</th>
                <!--<th class="red header">Actions</th>-->
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($product as $row)
              {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['title'].' </td>';
                echo '<td align="center"><img style="max-width:100px;max-height:100px;" src="'.$row['image'].'" /> </td>';
                echo '<td>'.$row['url'].' </td>';
                echo '<td>'.$row['categoryName'].' </td>';
				if($row['status']==1){
                	echo '<td><a href="'.site_url("admin").'/product/updatestatus/'.$row['id'].'/0/">Active</a></td>';
				}else{
                	echo '<td><a href="'.site_url("admin").'/product/updatestatus/'.$row['id'].'/1/">De-active</a></td>';
				}
				if($row['featured']==1){
                	echo '<td><a href="'.site_url("admin").'/product/updatefeatured/'.$row['id'].'/0/">Active</a></td>';
				}else{
                	echo '<td><a href="'.site_url("admin").'/product/updatefeatured/'.$row['id'].'/1/">De-active</a></td>';
				}
                echo '<td>'.$row['admin'].' </td>';
                /*echo '<td class="crud-actions">
                  <a href="'.site_url().'admin/product/update/'.$row['id'].'" class="btn btn-info">view & edit</a>  ';
				  $login_user_details = $this->session->userdata('user_details');
				 if($login_user_details[0]['admin']){
                 	//echo '<a href="'.site_url().'admin/product/delete/'.$row['id'].'" class="btn btn-danger">delete</a>';
				 }*/
                echo '</td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>