<div class="hero">
        <div class="container">
            <div class="row" style="margin:0px;">
            	<a href="<?php echo base_url(); ?>">Home</a> \ <a href="#"><?php echo $category_details[0]['categoryName']; ?></a>
            </div>
            <div class="row" style="margin:20px 0;">
                <div class="col-md-12 col-sm-7" style=" margin-left:10px; margin-top:0px;">
				  <div >
                                <div>
                                    <ul class="electronics">
	                                   <p><?php echo ucwords(str_replace("_"," ",$category_details[0]['categoryName'])); ?></p>
                            <?php 		
										foreach ($categorylist as $data1) { 
												
							?>                    
					                            <li class="col-md-3"><a href="<?php echo base_url( strtolower(str_replace(" ","-",$data1['categoryName']))."-".$data1['id']); ?>"><?php echo ucwords(str_replace("_"," ",$data1['categoryName'])); ?></a></li>
                            
                            <?php 			
										}
										
										echo "</ul></div>";
							?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>