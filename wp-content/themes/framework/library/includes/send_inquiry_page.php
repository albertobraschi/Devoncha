<h1 class="head"><?php _e(SEND_INQUIRY);?> </h1>
     <div class="breadcrumb clearfix">
		<?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',' &raquo; '.__(SEND_INQUIRY).'('.$post_title.')'); } ?>
    </div>
      
<form name="enquiryfrm" action="<?php echo site_url()."/?ptype=sendenquiry";?>" method="post" >
<input type="hidden" name="productid" value="<?php echo $_REQUEST['pid'];?>" />

<div class="form  ">
    <div class="inquiry_row ">
      <label> <?php _e(YOUR_NAME_TEXT);?> <span class="indicates">*</span></label>
      <input type="text" name="yourname" value="" id="yourname" class="reg_row_textfield" />
    </div>
                
    <div class="inquiry_row ">
      <label> <?php _e(SEND_INQUIRY_EMAIL_ADDRESS);?> :  <span class="indicates">*</span></label>
      <input type="text" name="youremail" value="" id="youremail" class="reg_row_textfield" />
    </div>
    
     <div class="inquiry_row ">
      <label> <?php _e(INQUIRY_SUBJECT_TEXT);?> :  <span class="indicates">*</span></label>
       <input type="text" readonly="readonly" name="frnd_subject" value="<?php echo $post_title;?> Enquiry" id="frnd_subject" class="reg_row_textfield" />
    </div>
    
    <div class="inquiry_row ">
      <label> <?php _e(INQUIRY_SUBJECT_TEXT);?> :  <span class="indicates">*</span></label>
       <textarea name="frnd_comments" id="frnd_comments" cols="20" rows="5" class="reg_row_textarea" ><?php _e('Hello,');?> 
     </textarea>
    </div>
    
     <div class="inquiry_row ">
      
      		<a href="javascript:void(0)" class="highlight_button fl send_inquiry" onclick="check_enquery_frm()"> <?php _e(INQUIRY_SEND__EMAIL_TEXT);?> </a>
       
       <div class="row_hide"> <input type="text" readonly="readonly" name="frnd_subject" value="<?php echo $post_title;?> Enquiry" id="frnd_subject"  /></div>
       
       <a href="<?php echo site_url()."/?p=".$_REQUEST['pid'];?>" class="normal_button fl"> <?php _e(BACK_PRODUCT_DETAIL_TEXT);?></a>
       
    </div>
            
            
</div>

</form>