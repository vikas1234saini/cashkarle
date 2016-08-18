
	<div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url()."admin/".$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        
      </ul>

      <!-- <div class="page-header users-header">
       <h2>
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a  href="<?php echo site_url()."admin/".$this->uri->segment(2); ?>/add" class="btn btn-success">Add a new</a>
        </h2>
      </div>-->
	 <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated' || $this->session->flashdata('flash_message') == 'added')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">X</a>';
            echo '<strong>Well done!</strong> coupon '.$this->session->flashdata('flash_message').' with success.';
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
           
            $options_coupon = array(0 => "all");
            foreach ($coupon as $row)
            {
              $options_coupon[$row['id']] = $row['coupon_title'];
            }
            //save the columns names in a array that we will use as filter         
            $options_coupon_sort = array();    
            /*foreach ($supervisor as $array) {
              foreach ($array as $key => $value) {
                $options_supervisor[$key] = $key;
              }
              break;
            }*/
			$options_coupon_sort['coupon_title'] = 'coupon_title';
			$options_coupon_sort['id'] = 'id';
			
            echo form_open('admin/coupon', $attributes);
     
              echo form_label('Search:', 'search_string');
              echo form_input('search_string', $search_string, 'style="width: 170px;
height: 26px;"');

              echo form_label('Order by:', 'order');
              echo form_dropdown('order', $options_coupon_sort, $order, 'class="span2"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');

              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type, 'class="span1"');

              echo form_submit($data_submit);
              echo form_button('myreset',"Reset",'class="btn btn-danger" onclick=window.location.href="'.base_url('admin/coupon').'"');

            echo form_close();
            ?>

			<div style="float:right"><a href="<?php echo base_url(); ?>admin/export/discount?for=offer&key=<?php echo $search_string; ?>">Export Data</a></div>
          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Coupon Title</th>
                <th class="yellow header headerSortDown" width="150px">Description</th>
                <th class="yellow header headerSortDown">Coupon Code</th>
                <th class="yellow header headerSortDown">Offer</th>
                <th class="yellow header headerSortDown">Cashback</th>
                <th class="yellow header headerSortDown">Username</th>
                <th class="yellow header headerSortDown">Date</th>
                <th class="red header">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($coupon as $row)
              {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['coupon_title'].' </td>';
                echo '<td>'.$row['coupon_description'].' </td>';
                echo '<td>'.$row['coupon_code'].' </td>';
                echo '<td>'.$row['offer_name'].' </td>';
                echo '<td>'.$row['discount']." ".$row['discount_type'].' </td>';
                echo '<td>'.$row['admin'].' </td>';
                echo '<td>'.date('d-M Y h:i a',strtotime($row['date'])).' </td>';
				/*if($row['status']==1){
                	echo '<td><a href="'.site_url("admin").'/coupon/updatestatus/'.$row['id'].'/0/">Active</a></td>';
				}else{
                	echo '<td><a href="'.site_url("admin").'/coupon/updatestatus/'.$row['id'].'/1/">De-active</a></td>';
				}*/
                echo '<td class="crud-actions">
                  <a href="'.site_url().'admin/coupon/update/'.$row['id'].'" class="btn btn-info">view & edit</a>  ';
				  $login_user_details = $this->session->userdata('user_details');
				 if($login_user_details[0]['admin'] && $row['admin']!=''){
                 	echo '<a href="'.site_url().'admin/coupon/delete/'.$row['id'].'" class="btn btn-danger">delete</a>';
				 }
                echo '</td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>