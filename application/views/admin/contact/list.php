
	<div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url()."admin/".$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        
      </ul>

     
	 <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated' || $this->session->flashdata('flash_message') == 'added')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">X</a>';
            echo '<strong>Well done!</strong> contact updated successfully.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">X</a>';
            echo '<strong>Oh snap!</strong> ';
          echo '</div>';          
        }
      }
      ?>      
      
      <div class="row">
        <div class="span12 columns">
        
          <div class="well">
          
			<?php
           
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
			$options_product_sort['email'] = 'email';
			$options_product_sort['date'] = 'date';
			$options_product_sort['id'] = 'id';
			
            echo form_open('admin/contact', $attributes);
     
              echo form_label('Search:', 'search_string');
              echo form_input('search_string', $search_string, 'style="width: 170px;
height: 26px;"');

              echo form_label('Order by:', 'order');
              echo form_dropdown('order', $options_product_sort, $order, 'class="span2"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');

              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type, 'class="span1"');

              echo form_submit($data_submit);
              echo form_button('myreset',"Reset",'class="btn btn-danger" onclick=window.location.href="'.base_url('admin/contact').'"');

	          echo form_close();
            ?>

          </div>
          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Name</th>
                <th class="yellow header headerSortDown">Email</th>
                <th class="yellow header headerSortDown">Topic</th>
                <th class="yellow header headerSortDown">Description</th>
                <th class="red header">Date</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($contact as $row)
              {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['name'].' </td>';
                echo '<td>'.$row['email'].' </td>';
                echo '<td>'.$row['option'].' </td>';
                echo '<td>'.$row['description'].' </td>';
                echo '<td>'.date("d-M-Y h:i a",strtotime($row['date'])).' </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>