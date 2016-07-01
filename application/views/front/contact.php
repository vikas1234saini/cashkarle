<style>
p {
	text-align:justify;
}
</style>

    <div class="hero">
        <div class="container">
            
            <div class="row" style="margin:0px;">
            <div class="card-block" style="margin-bottom:20px;">
            <p><strong>Contact Us</strong></p>
            <form name="frmContactUs" id="frmContactUs" method="post" enctype="multipart/form-data">
	          <table class="mini" id="maintable">
    	      	<tr>
        	    	<td colspan="2" align="left">
            	    	<div class="error_contactus" style="color:#F00;"><strong><?php echo isset($error) && $error!=''?$error:""; ?></strong></div>
                	</td>
	            </tr>
            
    	      	<tr>
        	    	<td><strong>Name:</strong></td>
            		<td align="left" style="width:70%;">
                		<input name="name" id="name" type="text" value="" style="width:220px;" placeholder="Name" value="<?php echo set_value('name'); ?>" />
	                </td>
    	        </tr>
                
    	      	<tr>
        	    	<td><strong>Email:</strong></td>
            		<td align="left" style="width:70%;">
                		<input name="email" id="email" type="text" value="" style="width:220px;" placeholder="Email" value="<?php echo set_value('email'); ?>" />
	                </td>
    	        </tr>
          	<tr >
            	<td><strong>Topics:</strong></td>
            	<td align="left" style="width:70%;">
                    <select name="option" id="option">
                    	<option value="Bank Account" <?php if(set_value('description')=='Bank Account'){ ?> selected="selected" <?php } ?>>Business query</option>
                        <option value="General Query" <?php if(set_value('description')=='General Query'){ ?> selected="selected" <?php } ?>>General Query</option>
                        <option value="Media" <?php if(set_value('description')=='Media'){ ?> selected="selected" <?php } ?>>Media</option>
                        <option value="Partnerships" <?php if(set_value('description')=='Partnerships'){ ?> selected="selected" <?php } ?>>Partnerships</option>
                        <option value="Others" <?php if(set_value('description')=='Others'){ ?> selected="selected" <?php } ?>>Others</option>
                    </select>
                </td>
            </tr>
    	      	<tr>
        	    	<td><strong>Description:</strong></td>
            		<td align="left" style="width:70%;">
                		<textarea name="description" id="description" style="width:280px;" cols="10" placeholder="Description"><?php echo set_value('description'); ?></textarea>
	                </td>
    	        </tr>
<div class="main_popup1_1">
					<td><strong>Captach:</strong></td>
            		<td align="left" style="width:70%;">
<span id="captcha_image"><?php echo $cap_image;?></span><span><a href="javascript:void(0)" class="refresh"><img src="<?php echo base_url(); ?>assets/img/refresh.png" alt="reload" width="30" /></a></span>			<input type="text" name="captcha" id="captcha" class="main_input_pass form-group" placeholder="Enter text on image" >
			</td>            
            <tr>
                <td colspan="2" align="center"><button type="submit" class="btn btn-wide btn-round btn-primary">Submit</button></td>
            </tr>
          </table>
          </form>
</div>
            </div>
        </div>
    </div>