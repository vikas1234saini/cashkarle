    <div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            Admin
          </a> 
          <span class="divider">/</span>
        </li>
        
      </ul>

      <div class="page-header users-header">
        <h2>
          Admin 
          <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-success">Add a new</a>
        </h2>
      </div>
	 <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated' || $this->session->flashdata('flash_message') == 'added')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">X</a>';
            echo '<strong>Well done!</strong> agent '.$this->session->flashdata('flash_message').' with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">X</a>';
            echo '<strong>Oh snap!</strong> you have only 4 agent active once.';
          echo '</div>';          
        }
      }
      ?>      
      <div class="row">
        <div class="span12 columns">
          <div class="well" style="display:none;">
           
            <?php
           
            /*$attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            $options_manufacture = array(0 => "all");
            foreach ($manufactures as $row)
            {
              $options_manufacture[$row['id']] = $row['name'];
            }
            //save the columns names in a array that we will use as filter         
            $options_agent = array();    
            foreach ($agent as $array) {
              foreach ($array as $key => $value) {
                $options_agent[$key] = $key;
              }
              break;
            }

            echo form_open('admin/agent', $attributes);
     
              echo form_label('Search:', 'search_string');
              echo form_input('search_string', $search_string_selected, 'style="width: 170px;
height: 26px;"');

              echo form_label('Filter by manufacturer:', 'manufacture_id');
              echo form_dropdown('manufacture_id', $options_manufacture, $manufacture_selected, 'class="span2"');

              echo form_label('Order by:', 'order');
              echo form_dropdown('order', $options_agent, $order, 'class="span2"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');

              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1"');

              echo form_submit($data_submit);

            echo form_close();*/
            ?>

          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Agent Name</th>
                <th class="yellow header headerSortDown">LoginId</th>
                <th class="green header">Password</th>
                <th class="green header">Ticket Closed</th>
                <th class="red header">Last Login Date</th>
                <th class="red header">Last Login Time</th>
                <th class="red header">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($agent as $row) {
					$counter = $this->db->select('count(id) as counter')->where('admin_id',$row['admin_auto_id'])->from('tbl_ticket')->get()->result_array();
					echo '<tr>';
						echo '<td>'.$row['admin_auto_id'].'</td>';
						echo '<td>'.$row['admin_first_name'].'</td>';
						echo '<td>'.$row['admin_login_name'].'</td>';
						echo '<td>'.$row['admin_password'].'</td>';
						echo '<td>'.$counter[0]['counter'].'</td>';
						
						echo '<td>'.date('d-M-Y',strtotime($row['last_login_date'])).'</td>';
						echo '<td>'.date('h:i a',strtotime($row['last_login_date'])).'</td>';
						
						// echo '<td>'.$row['admin'].'</td>';
						echo '<td class="crud-actions"><a href="'.site_url("admin").'/agent/update/'.$row['admin_auto_id'].'" class="btn btn-info">view & edit</a>';
						$login_user_details = $this->session->userdata('user_details');
						if($login_user_details[0]['admin']){
							echo '<a href="'.site_url("admin").'/agent/delete/'.$row['admin_auto_id'].'" class="btn btn-danger">delete</a>';
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