<?php
global $wpdb;
if($_REQUEST['user_id']=='')
{
	if($_POST && $_POST['aff_settings'])
	{
	$affiliate_settings = array(
						"is_active_affiliate"		=> $_POST['is_active_affiliate'],
						"aff_share_amt"				=> $_POST['aff_share_amt'],
						"affiliate_cookie_lifetime"	=> $_POST['affiliate_cookie_lifetime'],
						"affiliate_login_content_top"	=> $_POST['affiliate_login_content_top'],
						"affiliate_login_content_bottom"	=> $_POST['affiliate_login_content_bottom'],
						"affiliate_terms_conditions"	=> $_POST['affiliate_terms_conditions'],
						"send_order_app_aff_email"	=> $_POST['send_order_app_aff_email'],						
						);
	foreach($affiliate_settings as $key=>$val)
	{
	//update_option('affiliate_settings', $affiliate_settings);
	update_option($key, $val);
	}
	
	$message = "Settings Updated successfully";
	}
	//$affiliate_settings = get_option('affiliate_settings');
	$is_active_affiliate = get_option('is_active_affiliate');
	$aff_share_amt = get_option('aff_share_amt');
	$affiliate_cookie_lifetime = get_option('affiliate_cookie_lifetime');
	$affiliate_login_content_top = get_option('affiliate_login_content_top');
	$affiliate_login_content_bottom = get_option('affiliate_login_content_bottom');
	$affiliate_terms_conditions =  get_option('affiliate_terms_conditions');
	$send_order_app_aff_email = get_option('send_order_app_aff_email');
	
?>
<div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_aff_settings"><?php _e('Manage Affiliate'); ?></span>  
 </div> <!-- sub heading -->
 
 
 <div class="tabber">
                <div class="tabbertab <?php if($_REQUEST['pagetype']=='addedit'){echo 'tabbertabhide';}?>">
                         <h2> <?php _e('Settings');?> </h2>
                        <form action="<?php echo site_url();?>/wp-admin/admin.php?page=affiliates_settings" method="post">
    <input type="hidden" name="aff_settings" value="1" />
	<?php if($message){?>
	<div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
	<p><?php echo $message;?> </p>
	</div>
	<?php }?>
	<table width="80%" cellpadding="5" class="widefat post sub_table" >
	<thead>
	  <tr>
		<td><?php _e(AFF_MODULE_ACTIVE_TITLE); ?></td>
		<td>
         <select name="is_active_affiliate" class="mini">
            <option value="0" <?php if($is_active_affiliate=='0'){?> selected="selected"<?php }?>>No</option>
            <option value="1" <?php if($is_active_affiliate==1){?> selected="selected"<?php }?>>Yes</option>
          </select>  
		</td>
	  </tr>
      <tr>
		<td><?php _e(AFF_REG_LINK_TITLE); ?></td>
		<td><b><?php echo site_url();?>/?ptype=affiliate&type=reg</b>
		</td>
	  </tr>
	  <tr>
		<td><?php _e(AFF_SIGNIN_LINK_TITLE); ?></td>
		<td><b><?php echo site_url();?>/?ptype=affiliate</b>
		</td>
	  </tr>
	  <tr>
		<td><?php _e(SHARE_AMT_TITLE); ?>(%)<br><?php _e(SHARE_AMT_TITLE_DESC); ?></td>
		<td><input type="text" name="aff_share_amt" value="<?php echo $aff_share_amt;?>" />
		</td>
	  </tr>
	  <tr>
		<td><?php _e(SHARE_COOKIES_ALIVE_TITLE); ?><br><?php _e(SHARE_COOKIES_ALIVE_DESC); ?></td>
		<td><input type="text" name="affiliate_cookie_lifetime" value="<?php echo $affiliate_cookie_lifetime;?>" /></td>
	  </tr>
      <tr>
        <td><?php _e(AFF_SHARE_APP_EMAIL_TITLE); ?><br />
        <?php _e(AFF_SHARE_APP_EMAIL_DESC); ?>
        </td><td>
        <select name="send_order_app_aff_email" class="mini">
            <option value="0" <?php if($send_order_app_aff_email=='0'){?> selected="selected"<?php }?>><?php _e('No');?></option>
            <option value="1" <?php if($send_order_app_aff_email==1){?> selected="selected"<?php }?>><?php _e('Yes');?></option>
          </select>        </td>
      </tr>
	  <tr>
		<td><?php _e(LOGIN_TEXT_TOP_TITLE); ?><br><?php _e(LOGIN_TEXT_TOP_DESC); ?></td>
		<td>
		<textarea name="affiliate_login_content_top" id="affiliate_login_content_top" cols="70" rows="5"><?php echo $affiliate_login_content_top;?></textarea>
		</td>
	  </tr>
	  <tr>
		<td><?php _e(LOGIN_TEXT_BOTTOM_TITLE); ?><br><?php _e(LOGIN_TEXT_BOTTOM_DESC); ?></td>
		<td><textarea name="affiliate_login_content_bottom"  id="affiliate_login_content_bottom" cols="70" rows="5"><?php echo $affiliate_login_content_bottom;?></textarea></td>
	  </tr>
       <tr>
		<td><?php _e(TERMS_AND_CONDITIONS_TITLE); ?><br><?php _e(TERMS_AND_CONDITIONS_DESC); ?></td>
		<td><textarea name="affiliate_terms_conditions"  id="affiliate_terms_conditions" cols="70" rows="3"><?php echo $affiliate_terms_conditions;?></textarea></td>
	  </tr>
	  <tr>
		<td></td>
		<td><input type="submit" name="submit" value="<?php _e('Submit'); ?>" class="b_common action" /></td>
	  </tr>
	</thead>
	</table>
	</form>
                 </div> <!-- tab 1-->
                 
                   <div class="tabbertab">
                         <h2> <?php _e('Links');?> </h2>
                        <?php
                        if($_REQUEST['pagetype']=='addedit')
						{
							include_once(TEMPLATEPATH . '/library/includes/affiliates/admin_affiliates_frm.php');
						}
						include_once(TEMPLATEPATH . '/library/includes/affiliates/admin_affiliates.php');
						?>
                 </div> <!-- tab 1-->
                 
                 
                   <div class="tabbertab <?php if($_REQUEST['pagetype']=='addedit'){echo 'tabbertabhide';}?>">
                         <h2> <?php _e('Sale Report');?> </h2>
                        <?php include_once(TEMPLATEPATH . '/library/includes/affiliates/admin_affiliate_sale_report_default.php');?>
                 </div> <!-- tab 1-->
                 
                  <div class="tabbertab <?php if($_REQUEST['pagetype']=='addedit'){echo 'tabbertabhide';}?>">
                         <h2> <?php _e('Members');?> </h2>
                        <?php include_once(TEMPLATEPATH . '/library/includes/affiliates/admin_affiliates_report.php');?>
                 </div> <!-- tab 1-->
                 
 
 </div>  <!-- tabber #end -->
 
	
	<p></p>
<?php
}
include_once(TEMPLATEPATH . '/library/includes/affiliates/admin_affiliates_report.php');
?>
 </div>   <!-- wrapper #end -->