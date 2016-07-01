
	<div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url()."admin/".$this->uri->segment(2); ?>">
            Flipkart Offer Discount
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
            $options_flipkartofferdiscount_sort = array();    
            /*foreach ($supervisor as $array) {
              foreach ($array as $key => $value) {
                $options_supervisor[$key] = $key;
              }
              break;
            }*/
			$options_flipkartofferdiscount_sort['title'] = 'title';
			$options_flipkartofferdiscount_sort['id'] = 'id';
			$options_flipkartofferdiscount_sort['sitename'] = 'sitename';
			
            echo form_open('admin/flipkartofferdiscount', $attributes);
     
              echo form_label('Search:', 'search_string');
              echo form_input('search_string', $search_string, 'style="width: 170px;
height: 26px;"');

              echo form_label('Order by:', 'order');
              echo form_dropdown('order', $options_flipkartofferdiscount_sort, $order, 'class="span2"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');

              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type, 'class="span1"');

              echo form_submit($data_submit);
              echo form_button('myreset',"Reset",'class="btn btn-danger" onclick=window.location.href="'.base_url('admin/flipkartofferdiscount').'"');

            echo form_close();
            ?>

			<div style="float:right"><a href="<?php echo base_url(); ?>admin/export/discount?for=flipkartofferdiscount&key=<?php echo $search_string; ?>">Export Data</a></div>
          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Cashkarle Category</th>
                <th class="yellow header headerSortDown">Category</th>
                <th class="yellow header headerSortDown">Discount By Flipkartoffer</th>
                <!--<th  style="width:200px; word-wrap: break-word;" class="yellow header headerSortDown">Site Url</th>-->
                <th class="yellow header headerSortDown">Discount By CashKarle</th>
                <th class="yellow header headerSortDown">Username</th>
               <!-- <th class="yellow header headerSortDown">Featured</th>-->
                <th class="red header">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($flipkartofferdiscount as $row)
              {
				  
					$cat_list = $this->db->select('categoryName')->from('tbl_category')->where('flipkartoffer_group', $row['id'])->get()->result_array();
					$allcategory = "";
					foreach($cat_list as $rowcat){
						if($allcategory!=''){
							$allcategory .= ', ';
						}
						$allcategory .= $rowcat['categoryName'];
					}
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$allcategory.'</td>';
                echo '<td>'.$row['category'].' </td>';
                echo '<td>'.$row['discount_given'].' </td>';
                echo '<td>'.$row['admin'].' </td>';
              //  echo '<td style="width:200px; word-wrap: break-word;">'.$row['url'].' </td>';
                echo '<td>'.$row['discount_by_us'].' </td>';
				/*if($row['featured']==1){
                	echo '<td><a href="'.site_url("admin").'/flipkartofferdiscount/updatefeatured/'.$row['id'].'/0/">Active</a></td>';
				}else{
                	echo '<td><a href="'.site_url("admin").'/flipkartofferdiscount/updatefeatured/'.$row['id'].'/1/">De-active</a></td>';
				}*/
                echo '<td class="crud-actions">
                  <a href="'.site_url().'admin/flipkartofferdiscount/update/'.$row['id'].'" class="btn btn-info">view & edit</a>  ';
				  $login_user_details = $this->session->userdata('user_details');
				 if($login_user_details[0]['admin']){
                 	//echo '<a href="'.site_url().'admin/flipkartofferdiscount/delete/'.$row['id'].'" class="btn btn-danger">delete</a>';
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