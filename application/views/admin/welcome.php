    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("welcome"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#"><?php echo $this->session->userdata('user_name') ?></a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Welcome <?php echo $this->session->userdata('user_name') ?>
        </h2>
      </div>
 

    </div>