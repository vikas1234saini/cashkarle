    <div class="hero">
        <div class="container">
            <div class="row" style="margin:0px;">
            	<a href="<?php echo base_url(); ?>">Home</a> \ Top Products
            </div>
            <div class="row">
            	
                <div class="col-md-12 col-sm-7">
                	<div class="col-md-12 col-sm-7">
                        <div style="padding-left:20px;" class="productlist"><h4 class="fontbold"> Top Products /*Mudit*/</h4></div>
                        <div class="productlist" id='productlist'>
                        <?php 
                            //print_r($details);
                            $counter = 0;
//							print_r($productlist);
							if(sizeof($productlist)>0){
								foreach ($productlist as $product) {
									$counter++;
									if($counter>12){
										break;	
									}
									$productId 			= $product['product_main_id'];
									$title 				= $product['title'];
									$productDescription = $product['description'];
									$productImage 		= $product['image']!=''?$product['image']:base_url("assets/img/noimage.png");
									$sellingPrice 		= $product['selling_price'];
									$productUrl 		= $product['url'];
									$productBrand 		= $product['brand'];
									$maximumRetailPrice	= $product['retail_price'];
									$sitename			= $product['sitename'];
									$cashback			= $product['discount'];
									$new_title 			= preg_replace("/[^0-9a-zA-Z ]/m", "", $title);
									$new_title 			= strtolower(preg_replace("/ /", "-", $new_title));
									$categoryName 		= strtolower(preg_replace("/ /", "-", $product['categoryName']));
						?>
									  <div class="col-md-3">
											<div class="product-item text-center ">
												<a href="<?php echo base_url($categoryName."/".$new_title."-".$product['id']); ?>"><img src="<?php echo $productImage; ?>" style="overflow:hidden;max-height:150px;overflow:hidden;padding-top:15px;"></a>
												<div class="product-name">
													<p><?php echo $title; ?></p>										
			                                        <p>By: <img src="<?php echo base_url("assets/img/".$sitename.".png"); ?>" width="70" /></p>
			
												</div>
												<p class="fw-400 price"> Rs <?php echo $sellingPrice; ?></p>
												<p class="actual-price"> ACTUAL PRICE RS <?php echo $maximumRetailPrice; ?></p>
												<?php if($cashback!=0 && $cashback!=""){ ?>
												<label class="cashback"><span class="yellow"><?php echo $cashback ?>% </span>cashback</label>
												<?php }else{ ?>
												<label class="cashback"><span class="yellow">0.2% </span>cashback</label>
												<?php } ?>
												<div class="view-offer">
													<btn class="btn btn-warning btn-round btn-wide fw-700"><a href="<?php echo base_url($categoryName."/".$new_title."-".$product['id']); ?>" >VIEW OFFER</a></btn>
												</div>
											</div>
										</div>
						<?php    
								} 
							}else {
								echo '<div class="col-md-12 aligncenter fontbold" style="border: solid 1px #ccc; margin:10px; padding:10px;">No Product Found.</div>';
							}
						?>
                       </div>
                            
                     </div>   
                </div>
            </div>
        </div>
    </div>
    