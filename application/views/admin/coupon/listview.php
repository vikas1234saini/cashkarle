
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
          <a  href="<?php echo site_url()."admin/coupon/add/".$offer_id; ?>" class="btn btn-success">Add a new</a>
        </h2>
      </div>
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
          

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="header">Id</th>
                <th class="yellow header headerSortDown">Coupon Name</th>
                <th class="yellow header headerSortDown">Offer</th>
                <th class="yellow header headerSortDown">Cashback</th>
                <th class="yellow header headerSortDown">Start Date</th>
                <th class="yellow header headerSortDown">Exp Date</th>
                <th class="yellow header headerSortDown">Added Date</th>
                <th class="red header">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
			  $counter = 0;
              foreach($coupon as $row) {
				$counter++;
                echo '<tr>';
                echo '<td>'.$counter.'</td>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['coupon_title'].' </td>';
                echo '<td>'.$row['offer_name'].' </td>';
                echo '<td>'.$row['discount']." ".$row['discount_type'].' </td>';
                echo '<td>'.date("d-m-Y",strtotime($row['added'])).' </td>';
                echo '<td>'.date("d-m-Y",strtotime($row['coupon_expiry'])).' </td>';
                echo '<td>'.date('d-M Y h:i a',strtotime($row['date'])).' </td>';
				/*if($row['status']==1){
                	echo '<td><a href="'.site_url("admin").'/coupon/updatestatus/'.$row['id'].'/0/">Active</a></td>';
				}else{
                	echo '<td><a href="'.site_url("admin").'/coupon/updatestatus/'.$row['id'].'/1/">De-active</a></td>';
				}*/
                echo '<td class="crud-actions">
                  <a href="'.site_url().'admin/coupon/update/'.$row['id'].'/'.$row['offer_id'].'" class="btn btn-info">view & edit</a>  ';
				  $login_user_details = $this->session->userdata('user_details');

				// if($login_user_details[0]['admin'] && $row['admin']!=''){
                 	echo '<a href="'.site_url().'admin/coupon/delete/'.$row['id'].'/'.$row['offer_id'].'" class="btn btn-danger">delete</a>';
				 //}
				 echo '</td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>