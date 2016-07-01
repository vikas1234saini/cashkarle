          <ul class="unstyled profile-tab">
            <li <?php if($menuopen	== "myaccount"){ ?>class="active" <?php } ?>><a href="<?php echo base_url('profile'); ?>">My Account</a></li>
            <li <?php if($menuopen	== "myearning"){ ?>class="active" <?php } ?>><a href="<?php echo base_url('myearning'); ?>">My Savings</a></li>
            <li <?php if($menuopen	== "mypayment"){ ?>class="active" <?php } ?>><a href="<?php echo base_url('payments'); ?>">Payments</a></li>
            <li <?php if($menuopen	== "missing"){ ?>class="active" <?php } ?>><a href="<?php echo base_url('missingcashback'); ?>">Missing Cashback</a></li>
          </ul>
