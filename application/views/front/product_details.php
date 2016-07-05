<style>
    .jzoom {
        max-width: 150px;
        max-height: 150px;
    }
</style>

<?php 
//$category_details[0]['discount'] = 5;
if(sizeof($category_details)==0){
//$category_details[0]['categoryName'] = 'amazon';
}
?>
<div class="container">
        <!-- Breadcrumb Start-->
        <div class="row">
            <div class="col-xs-12 breadcrumb-holder">
                <?php
                    if(sizeof($category_details)==0){ 
                        $category_details[0]['discount']        = 0;
                        $category_details[0]['categoryName']    = 'Amazon';
                        $category_details[0]['categoryName']    = 'Amazon';
                        $category_details[0]['snapdeal_discount_2500']  = 0;
                        $category_details[0]['snapdeal_discount']       = 0;
                        $category_details[0]['flipkart_discount']       = 0;
                        $category_details[0]['amazon_discount']         = 0;
                ?>
                    <a href="<?php echo base_url(); ?>">Home</a> \ Amazon \ <?php echo $product_details[0]['title']; ?>
                <?php }else{ ?>
                    <a href="<?php echo base_url(); ?>">Home</a> \ <a href="<?php echo base_url( strtolower(str_replace(" ","-",$category_details[0]['categoryName']))."-".$category_details[0]['id']); ?>"><?php echo $category_details[0]['categoryName']; ?></a> \ <?php echo $product_details[0]['title']; ?>
                <?php } ?>
            </div>
        </div>
        <!-- Breadcrumb End-->
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <div class="card-block product-image">
                    <img src="<?php echo $product_details[0]['image']!=''?$product_details[0]['image']:base_url("assets/img/noimage.png"); ?>" class="img-responsive" />
                    <div class="clearfix"></div>
                    <?php 
                        $cashback = 0;
                        if($product_details[0]['sitename']=='snapdeal'){
                            /*if($product_details[0]['retail_price']>2500){
                                $cashback       = $category_details[0]['snapdeal_discount_2500'];
                            }else{
                                $cashback       = $category_details[0]['snapdeal_discount'];
                            }*/
                            $cashback       = $category_details[0]['snapdeal_discount'];
                        }else if($product_details[0]['sitename']=='flipkart'){
                            $cashback       = $category_details[0]['flipkart_discount'];
                        }else if($product_details[0]['sitename']=='amazon'){
                            $cashback       = $category_details[0]['amazon_discount'];
                        }
                
                        if($cashback!='' && $cashback!=0){ ?>
                    <div class="clearfix"></div>
                    <label class="cashback"><span class="yellow"><?php echo $cashback; ?>% </span>cashback</label>
                    <?php }else{ ?>
                    <div class="clearfix"></div>
                    <label class="cashback"><span class="yellow">0% </span>cashback</label>
                    <?php } ?>
                </div>
            </div>
            <div class="col-sm-8 col-xs-12">
                <div class="card-block product-brief-details">
                    <h2><?php echo $product_details[0]['title']; ?></h2>
                    
                    <div class="row-fluid">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 product-brief-details-left">
                            <div class="offer-by-holder">
                                <div class="green-label-h3">Offer By</div>
                                <div class="offer-by-brand-logo">
                                    <img src="<?php echo base_url("assets/img/".$product_details[0]['sitename'].".png"); ?>" class="img-responsive" />
                                </div>
                                <div class="clearfix"></div>
                                <div class="cash-back-holder">
                                    <?php if($cashback!='' && $cashback!=0){ ?>
                                        <label class="cashback"><?php echo $cashback; ?>% cashback</label>
                                    <?php }else{?>
                                        <label class="cashback">0% cashback</label>
                                    <?php }?>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="stock-available-not"><?php echo str_replace("'","",$product_details[0]['instock']); ?></div>
                            <div class="clearfix"></div>
<!--                            <a href="<?php echo base_url("terms"); ?>" class="tnc" target="_blank"><i class="fa fa-link"></i><span> Terms & Condition</span></a>-->
                            <a href="#" class="how-it-works howitwork" data-toggle="modal" data-target="#howitwork">How it Works</a>
                            <div class="clearfix"></div>
                            <?php if ($this->session->userdata('fis_logged_in') !== FALSE) { }else{ ?>
                                <div class="alert alert-warning" role="alert">
                                    <i class="fa fa-warning"></i>
                                    <span>Please login if you want to avail this offer.</span>
                                </div>
                            <?php } ?>
                            <div class="clearfix"></div>
                        </div>
                        <?php 
                            if($cashback==0 || $cashback==""){
                                $cashback = 0;
                            }
                        ?>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pricing-holder-right">
                            <table class="mini">
                                <tr>
                                    <td>Original Price</td>
                                    <td>Rs <?php echo $product_details[0]['retail_price']; ?></td>
                                </tr>
                                <tr>
                                    <td>Offer Price</td>
                                    <td>Rs <?php echo $product_details[0]['selling_price']; ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>[minus]</td>
                                </tr>
                                <tr>
                                    <td>Cashkarle Cashback <?php echo $cashback; ?>%</td>
                                    <td>Rs <?php $offer = round($product_details[0]['selling_price']*($cashback/100),0); echo $offer; ?></td>
                                </tr>
                                <tr>
                                    <td>TOTAL</td>
                                    <td>Rs <?php echo ($product_details[0]['selling_price']-$offer); ?></td>
                                </tr>
                            </table>
                            <div class="clearfix"></div>
                            <div>
                                <?php
                                    $extraval = "affExtParam1";
                                    if(strtolower($product_details[0]['sitename'])=='flipkart'){
                                        $extraval = 'affExtParam1';
                                    }
                                ?>
                                <?php  if(isset($user_details[0]) && sizeof($user_details)>0){ ?>
                                    <a href="<?php echo base_url('process/'.$product_details[0]['id']."/".rand(1000,9999).date('ymdhis')); ?>" id="signinuserproduct" data-url="<?php echo $product_details[0]['url']; ?><?php if(isset($user_details) && sizeof($user_details)>0){ echo "&".$extraval."=".$user_details[0]['id']; }?>" rel="<?php echo $product_details[0]['id'] ?>" target="_blank" style="float:right; margin:20px 0px 20px 20px; background:#F5A623; color:#FFF; font-size:20px; padding:10px 20px; font-weight:bold; border-radius:30px; text-decoration:none;">BUY NOW</a>
                                <?php }else{ ?>
                                    <a href="<?php echo base_url('process/'.$product_details[0]['id']."/".rand(1000,9999).date('ymdhis')); ?>" style="float:right; margin:20px 0px 20px 20px; background:#F5A623; color:#FFF; font-size:20px; padding:10px 20px; font-weight:bold; border-radius:30px; text-decoration:none;" class="sign-in-btn buybutton">BUY NOW</a>
                                <?php } ?>
                                <!--<a href="<?php echo $product_details[0]['url']; ?><?php if(isset($user_details) && sizeof($user_details)>0){ echo "&".$extraval."=".$user_details[0]['id']; }?>" target="_blank" style="float:right; margin:20px; background:#F5A623; color:#FFF; font-size:20px; padding:10px 20px; font-weight:bold; border-radius:30px; text-decoration:none;">BUY NOW</a>-->
                            </div>        
                            <div class="clearfix"></div>    
                        </div>
                        
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <?php
                
                $data_com = $this->db->select('p.*,c.categoryName,c.discount,c.amazon_discount,c.snapdeal_discount,c.flipkart_discount,c.snapdeal_discount_2500')->join('tbl_category as c', 'c.id = p.category', 'left')->from('tbl_product as p')->where('title', $product_details[0]['title'])->where('sitename != ', $product_details[0]['sitename'])->get()->result_array();
            //  print_r($data_com);
                if(sizeof($data_com)>0){
            ?>
            
            <div class="row" style="margin:20px 0; overflow:hidden;">
                <h4 style="text-align:left;margin-left:15px; #23C670"> <strong>Product price on other websites</strong></h4>
            </div>
            <div class="row" style="margin:5px 0; padding:5px; background:#F5A623; color:#FFF; font-weight:bolder;">
                <div class="col-md-5 col-sm-7">Title</div>
                <div class="col-md-3 col-sm-7" >Site Name</div>
                <div class="col-md-2 col-sm-7" >Price</div>
                <div class="col-md-2 col-sm-7" >View Offer</div>
            </div>
            <?php 
                foreach ($data_com as $product) { 
                
                    $new_title          = preg_replace("/[^0-9a-zA-Z ]/m", "", $product['title']);
                    $new_title          = strtolower(preg_replace("/ /", "-", $new_title));
                    $categoryName       = strtolower(preg_replace("/ /", "-", ($product['categoryName']!=""?$product['categoryName']:"amazon")));
            ?>
            <div class="row" style="margin:5px 0; padding:5px; border-bottom:solid 1px #CCC;  font-weight:bolder;">
                <div class="col-md-5 col-sm-7"><?php echo $product['title'] ?></div>
                <div class="col-md-3 col-sm-7" ><?php echo $product['sitename'] ?></div>
                <div class="col-md-2 col-sm-7" ><?php echo $product['retail_price']; ?></div>
                <div class="col-md-2 col-sm-7" ><btn class="btn btn-warning btn-round btn-wide fw-700"><a href="<?php echo base_url($categoryName."/".$new_title."-".$product['id']); ?>" style="color:#FFF;"  >VIEW OFFER</a></btn></div>
            </div>
            
            <?php }} ?>
            <div class="row" style="margin:20px 0;">
                <h4 style="text-align:left;margin-left:15px; #23C670"> <strong>Realtive Products</strong></h4>
            </div>
            <div class="row" style="margin:20px 0;">
            
                <?php 
                    //print_r($details);
                    $counter = 0;
                    foreach ($relative_products as $product) {
                        
                        $productId          = $product['product_main_id'];
                        $title              = $product['title'];
                        $productDescription = $product['description'];
                        $productImage       = $product['image']!=''?$product['image']:base_url("assets/img/noimage.png");
                        $sellingPrice       = $product['selling_price'];
                        $productUrl         = $product['url'];
                        $productBrand       = $product['brand'];
                        $maximumRetailPrice = $product['retail_price'];
                        $cashback           = $product['discount'];
                        $sitename           = $product['sitename'];
                        $new_title          = preg_replace("/[^0-9a-zA-Z ]/m", "", $title);
                        $new_title          = strtolower(preg_replace("/ /", "-", $new_title));
                        $categoryName       = strtolower(preg_replace("/ /", "-", ($product['categoryName']!=""?$product['categoryName']:"amazon")));
                        
                        $cashback = 0;
                        if($product['sitename']=='snapdeal'){
                            /*if($product['retail_price']>2500){
                                $cashback       = $product['snapdeal_discount_2500'];
                            }else{
                                $cashback       = $product['snapdeal_discount'];
                            }*/
                            $cashback       = $product['snapdeal_discount'];
                        }else if($product['sitename']=='flipkart'){
                            $cashback       = $product['flipkart_discount'];
                        }else if($product['sitename']=='amazon'){
                            $cashback       = $product['amazon_discount'];
                        }
                        
                ?>
                          <div class="col-md-3 col-sm-6">
                                <div class="product-item text-center ">
                                    <div style="height:370px;">
                                    <div style="height:150px; position:relative "><a href="<?php echo base_url($categoryName."/".$new_title."-".$product['id']); ?>"><img src="<?php echo $productImage; ?>" style="overflow:hidden;max-height:150px;overflow:hidden;padding-top:5px;position:absolute;    top:0;    bottom:0;  margin:auto; left:0; right:0;"></a></div>
                                    <div class="product-name">
                                                <p><?php echo mb_strimwidth($title,0,30,"..."); ?></p>
                                                <p>By: <img src="<?php echo base_url("assets/img/".$sitename.".png"); ?>" width="70" /></p>
                                            </div>
                                    <p class="actual-price"> ACTUAL PRICE RS <?php echo $maximumRetailPrice; ?></p>
                                    <p class="fw-400 price" style="text-align:center !important;"> Rs <?php echo $sellingPrice; ?></p>
                                    <p style="font-size:18px;"><strong>+</strong></p>
                                    <?php if($cashback!=0 && $cashback!=""){ ?>
                                    <label class="cashback"><span class="yellow"><?php echo $cashback ?>% </span>cashback</label>
                                    <?php }else{ ?>
                                    <label class="cashback"><span class="yellow">0% </span>cashback</label>
                                    <?php } ?>
                                    </div>
                                    <div class="view-offer">
                                        <btn class="btn btn-warning btn-round btn-wide fw-700"><a href="<?php echo base_url($categoryName."/".$new_title."-".$product['id']); ?>"  >VIEW OFFER</a></btn>
                                    </div>
                                </div>
                            </div>
                <?php } ?>
            </div>
</div>
