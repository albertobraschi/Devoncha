<?php
if($_POST)
{
	update_option('order_submited_success_admin_email_subject',$_POST['order_submited_success_admin_email_subject']);
	update_option('order_submited_success_admin_email_content',$_POST['order_submited_success_admin_email_content']);
	update_option('order_submited_success_admin_email_flag',$_POST['order_submited_success_admin_email_flag']);
	
	update_option('order_payment_success_client_email_subject',$_POST['order_payment_success_client_email_subject']);
	update_option('order_payment_success_client_email_content',$_POST['order_payment_success_client_email_content']);
	update_option('order_payment_success_client_email_flag',$_POST['order_payment_success_client_email_flag']);
	
	update_option('order_approval_client_email_subject',$_POST['order_approval_client_email_subject']);
	update_option('order_approval_client_email_content',$_POST['order_approval_client_email_content']);
	update_option('order_approval_client_email_flag',$_POST['order_approval_client_email_flag']);
	
	update_option('order_rejection_client_email_subject',$_POST['order_rejection_client_email_subject']);
	update_option('order_rejection_client_email_content',$_POST['order_rejection_client_email_content']);
	update_option('order_rejection_client_email_flag',$_POST['order_rejection_client_email_flag']);
	
	update_option('order_shipping_client_email_subject',$_POST['order_shipping_client_email_subject']);
	update_option('order_shipping_client_email_content',$_POST['order_shipping_client_email_content']);
	update_option('order_shipping_client_email_flag',$_POST['order_shipping_client_email_flag']);
	
	update_option('order_success_ipn_client_email_subject',$_POST['order_success_ipn_client_email_subject']);
	update_option('order_success_ipn_client_email_content',$_POST['order_success_ipn_client_email_content']);
	update_option('order_success_ipn_client_email_flag',$_POST['order_success_ipn_client_email_flag']);
	
	update_option('order_success_ipn_supplier_email_subject',$_POST['order_success_ipn_supplier_email_subject']);
	update_option('order_success_ipn_supplier_email_content',$_POST['order_success_ipn_supplier_email_content']);
	update_option('order_success_ipn_supplier_email_flag',$_POST['order_success_ipn_supplier_email_flag']);

	update_option('registration_success_email_subject',$_POST['registration_success_email_subject']);
	update_option('registration_success_email_content',$_POST['registration_success_email_content']);
	update_option('registration_success_email_flag',$_POST['registration_success_email_flag']);
	
	update_option('registration_success_aff_email_subject',$_POST['registration_success_aff_email_subject']);
	update_option('registration_success_aff_email_content',$_POST['registration_success_aff_email_content']);
	update_option('registration_success_aff_email_flag',$_POST['registration_success_aff_email_flag']);

	update_option('order_cancellation_msg_content',$_POST['order_cancellation_msg_content']);
	update_option('order_payment_success_paypal_msg_content',$_POST['order_payment_success_paypal_msg_content']);
	update_option('order_payment_success_prebank_msg_content',$_POST['order_payment_success_prebank_msg_content']);
	update_option('order_payment_success_msg_content',$_POST['order_payment_success_msg_content']);
}
?>
<style>
h2 {
	color:#464646;
	font-family:Georgia, "Times New Roman", "Bitstream Charter", Times, serif;
	font-size:24px;
	font-size-adjust:none;
	font-stretch:normal;
	font-style:italic;
	font-variant:normal;
	font-weight:normal;
	line-height:35px;
	margin:0;
	padding:14px 15px 3px 0;
	text-shadow:0 1px 0 #FFFFFF;
}
</style>
<h2><?php _e('Manage Notifications'); ?></h2>
<p><?php _e('Different emails and messages are displayed on the site or, being sent to your user at different times such as, when they post a classified etc. You may customize the default messages, email messages as per your wish from here. ');?></p>
<?php if($_REQUEST['msg']=='success'){?>
<div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
<p><?php _e('updated successfully.'); ?></p>
</div>
<?php }?>
<h3><?php _e('Emails');?></h3>
<form action="<?php echo site_url();?>/wp-admin/admin.php?page=notification" name="emails" method="post">
<table width="100%" cellpadding="5" class="widefat post fixed" >
<thead>
<tr>
<th width="150" align="left"><strong><?php _e('Email Type'); ?></strong></th>
<th width="230" align="left"><strong><?php _e('Email Subject'); ?></strong></th>
<th align="left"><strong><?php _e('Email Description'); ?></strong></th>
</tr>
</thead>

<?php
$subject = stripslashes(get_option('order_submited_success_admin_email_subject'));
$content = stripslashes(get_option('order_submited_success_admin_email_content'));
$subject_default = __('New order has been placed - Payment Pending');
$content_default = __('<p>Dear [#$to_name#],</p>
<p>Order received successfully but payment is not confirmed yet.</p>
<p>This Email is just for your information.</p>
<p>[#$order_info#]</p>
<p>We hope you enjoyed shopping with us.</p>
<p>Thank you </p>
');
if(!$subject){ update_option('order_submited_success_admin_email_subject',$subject_default);}
if(!$content){ update_option('order_submited_success_admin_email_content',$content_default); }
?>
<tr>
<td><?php _e('New Order admin Notification');?>
<br /><br />
<?php _e('Active/Inactive email?');?>
<?php $email_flag = get_option('order_submited_success_admin_email_flag');?>
<select name="order_submited_success_admin_email_flag">
<option value="active" <?php if($email_flag=='active'){echo 'selected="selected"';}?> ><?php _e('Active');?></option>
<option value="inactive" <?php if($email_flag=='inactive'){echo 'selected="selected"';}?>><?php _e('Inactive');?></option>
</select>
</td>
<td><textarea rows="6" cols="25" name="order_submited_success_admin_email_subject"><?php if($subject){echo $subject;}else{ echo $subject_default;}?></textarea></td>
<td><textarea cols="100" rows="6" name="order_submited_success_admin_email_content"><?php if($content){echo $content;}else{ echo $content_default;}?></textarea></td>
</tr>


<?php
$subject = stripslashes(get_option('order_payment_success_client_email_subject'));
$content = stripslashes(get_option('order_payment_success_client_email_content'));
$subject_default = __('Thank you for shopping - Payment Pending');
$content_default = __('<p>Dear [#$to_name#],</p>
<p>Order received successfully but payment is not confirmed yet.</p>
<p>This Email is just for your information. </p>
<p>[#$order_info#]</p>
<p>Thank you for shopping at [#$store_name#].</p>');
if(!$subject){ update_option('order_payment_success_client_email_subject',$subject_default);}
if(!$content){ update_option('order_payment_success_client_email_content',$content_default); }
?>
<tr>
<td><?php _e('New Order Customer Notification');?>
<br /><br />
<?php _e('Active/Inactive email?');?>
<?php $email_flag = get_option('order_payment_success_client_email_flag');?>
<select name="order_payment_success_client_email_flag">
<option value="active" <?php if($email_flag=='active'){echo 'selected="selected"';}?> ><?php _e('Active');?></option>
<option value="inactive" <?php if($email_flag=='inactive'){echo 'selected="selected"';}?>><?php _e('Inactive');?></option>
</select>
</td>
<td><textarea rows="6" cols="25" name="order_payment_success_client_email_subject"><?php if($subject){echo $subject;}else{ echo $subject_default;}?></textarea></td>
<td><textarea cols="100" rows="6" name="order_payment_success_client_email_content"><?php if($content){echo $content;}else{ echo $content_default;}?></textarea></td>
</tr>

<?php
$subject = stripslashes(get_option('order_approval_client_email_subject'));
$content = stripslashes(get_option('order_approval_client_email_content'));
$subject_default = __('Order Approval Email');
$content_default = __('<p>Dear [#$user_name#],</p>
<p>Your order has been approved</p>
<p>This Email is just for your information.</p>
<p>[#$order_info#]</p>
<br>
<p>We hope you enjoyed shopping with us. </p>
<p>Thank you </p>
<p>[#$store_name#]</p>');
if(!$subject){ update_option('order_approval_client_email_subject',$subject_default);}
if(!$content){ update_option('order_approval_client_email_content',$content_default); }
?>
<tr>
<td><?php _e('Order Approval to Customer');?>
<br /><br />
<?php _e('Active/Inactive email?');?>
<?php $email_flag = get_option('order_approval_client_email_flag');?>
<select name="order_approval_client_email_flag">
<option value="active" <?php if($email_flag=='active'){echo 'selected="selected"';}?> ><?php _e('Active');?></option>
<option value="inactive" <?php if($email_flag=='inactive'){echo 'selected="selected"';}?>><?php _e('Inactive');?></option>
</select>
</td>
<td><textarea rows="6" cols="25" name="order_approval_client_email_subject"><?php if($subject){echo $subject;}else{ echo $subject_default;}?></textarea></td>
<td><textarea cols="100" rows="6" name="order_approval_client_email_content"><?php if($content){echo $content;}else{ echo $content_default;}?></textarea></td>
</tr>

<?php
$subject = stripslashes(get_option('order_rejection_client_email_subject'));
$content = stripslashes(get_option('order_rejection_client_email_content'));
$subject_default = __('Order Rejection Email');
$content_default = __('<p>Dear [#$user_name#],</p>
<p>Your order has been rejected because of some reason.</p>
<p>This email is just for your information.</p>
<p>[#$order_info#]</p>
<br>
<p>Apologize for the inconvenience.</p>
<p>[#$store_name#]</p>');
if(!$subject){ update_option('order_rejection_client_email_subject',$subject_default);}
if(!$content){ update_option('order_rejection_client_email_content',$content_default); }
?>
<tr>
<td><?php _e('Order Rejection to Customer');?>
<br /><br />
<?php _e('Active/Inactive email?');?>
<?php $email_flag = get_option('order_rejection_client_email_flag');?>
<select name="order_rejection_client_email_flag">
<option value="active" <?php if($email_flag=='active'){echo 'selected="selected"';}?> ><?php _e('Active');?></option>
<option value="inactive" <?php if($email_flag=='inactive'){echo 'selected="selected"';}?>><?php _e('Inactive');?></option>
</select>
</td>
<td><textarea rows="6" cols="25" name="order_rejection_client_email_subject"><?php if($subject){echo $subject;}else{ echo $subject_default;}?></textarea></td>
<td><textarea cols="100" rows="6" name="order_rejection_client_email_content"><?php if($content){echo $content;}else{ echo $content_default;}?></textarea></td>
</tr>
<?php
$subject = stripslashes(get_option('order_shipping_client_email_subject'));
$content = stripslashes(get_option('order_shipping_client_email_content'));
$subject_default = __('Order Shipped Email');
$content_default = __('<p>Dear [#$user_name#],</p>
<p>Your order has been shipped successfully.</p>
<p>This Email is just for your information.</p>
<p>[#$order_info#]</p>
<br>
<p>We hope you enjoyed the shopping.</p>
<p>[#$store_name#]</p>');
if(!$subject){ update_option('order_shipping_client_email_subject',$subject_default);}
if(!$content){ update_option('order_shipping_client_email_content',$content_default); }
?>
<tr>
<td><?php _e('Order Shipped to Customer');?>
<br /><br />
<?php _e('Active/Inactive email?');?>
<?php $email_flag = get_option('order_shipping_client_email_flag');?>
<select name="order_shipping_client_email_flag">
<option value="active" <?php if($email_flag=='active'){echo 'selected="selected"';}?> ><?php _e('Active');?></option>
<option value="inactive" <?php if($email_flag=='inactive'){echo 'selected="selected"';}?>><?php _e('Inactive');?></option>
</select>
</td>
<td><textarea rows="6" cols="25" name="order_shipping_client_email_subject"><?php if($subject){echo $subject;}else{ echo $subject_default;}?></textarea></td>
<td><textarea cols="100" rows="6" name="order_shipping_client_email_content"><?php if($content){echo $content;}else{ echo $content_default;}?></textarea></td>
</tr>

<?php
$subject = stripslashes(get_option('order_success_ipn_client_email_subject'));
$content = stripslashes(get_option('order_success_ipn_client_email_content'));
$subject_default = __('Order Payment Successfully Received');
$content_default = __('<p>Dear [#$user_name#],</p>
<p>Your order payment has been successfully received.</p>
<p>This Email is just for your information.</p>								
<p>[#$transaction_details#]</p>
<br>
<p>We hope you enjoyed shopping. Thank you!</p>
<p>[#$store_name#]</p>');
if(!$subject){ update_option('order_success_ipn_client_email_subject',$subject_default);}
if(!$content){ update_option('order_success_ipn_client_email_content',$content_default); }
?>
<tr>
<td><?php _e('Payment Success - Paypal IPN Customer Email');?>
<br /><br />
<?php _e('Active/Inactive email?');?>
<?php $email_flag = get_option('order_success_ipn_client_email_flag');?>
<select name="order_success_ipn_client_email_flag">
<option value="active" <?php if($email_flag=='active'){echo 'selected="selected"';}?> ><?php _e('Active');?></option>
<option value="inactive" <?php if($email_flag=='inactive'){echo 'selected="selected"';}?>><?php _e('Inactive');?></option>
</select>
</td>
<td><textarea rows="6" cols="25" name="order_success_ipn_client_email_subject"><?php if($subject){echo $subject;}else{ echo $subject_default;}?></textarea></td>
<td><textarea cols="100" rows="6" name="order_success_ipn_client_email_content"><?php if($content){echo $content;}else{ echo $content_default;}?></textarea></td>
</tr>

<?php
$subject = stripslashes(get_option('order_success_ipn_supplier_email_subject'));
$content = stripslashes(get_option('order_success_ipn_supplier_email_content'));
$subject_default = __('Order Payment Success');
$content_default = __('<p>Dear [#$user_name#],</p>
<p>Check New Order Information below: </p>
<p>[#$transaction_details#]</p>
<br>
<p>[#$store_name#]</p>');
if(!$subject){ update_option('order_success_ipn_supplier_email_subject',$subject_default);}
if(!$content){ update_option('order_success_ipn_supplier_email_content',$content_default); }
?>
<tr>
<td><?php _e('Payment Success - Paypal IPN Supplier Email');?>
<br /><br />
<?php _e('Active/Inactive email?');?>
<?php $email_flag = get_option('order_success_ipn_supplier_email_flag');?>
<select name="order_success_ipn_supplier_email_flag">
<option value="active" <?php if($email_flag=='active'){echo 'selected="selected"';}?> ><?php _e('Active');?></option>
<option value="inactive" <?php if($email_flag=='inactive'){echo 'selected="selected"';}?>><?php _e('Inactive');?></option>
</select>
</td>
<td><textarea rows="6" cols="25" name="order_success_ipn_supplier_email_subject"><?php if($subject){echo $subject;}else{ echo $subject_default;}?></textarea></td>
<td><textarea cols="100" rows="6" name="order_success_ipn_supplier_email_content"><?php if($content){echo $content;}else{ echo $content_default;}?></textarea></td>
</tr>

<?php
$subject = stripslashes(get_option('registration_success_email_subject'));
$content = stripslashes(get_option('registration_success_email_content'));
$subject_default = __('Log In Details');
$content_default = __('<p>Dear [#$user_name#],</p>
<p>You can log in  with the following information:</p>
<p>Username: [#$user_login#]</p>
<p>Password: [#$user_password#]</p>
<br>
<p>We hope you enjoy shopping with us. Thank you.</p>
<p>[#$store_name#]</p>');
if(!$subject){ update_option('registration_success_email_subject',$subject_default);}
if(!$content){ update_option('registration_success_email_content',$content_default);}
?>
<tr>
<td><?php _e('Customer Registration Email');?>
<br /><br />
<?php _e('Active/Inactive email?');?>
<?php $email_flag = get_option('registration_success_email_flag');?>
<select name="registration_success_email_flag">
<option value="active" <?php if($email_flag=='active'){echo 'selected="selected"';}?> ><?php _e('Active');?></option>
<option value="inactive" <?php if($email_flag=='inactive'){echo 'selected="selected"';}?>><?php _e('Inactive');?></option>
</select>
</td>
<td><textarea rows="6" cols="25" name="registration_success_email_subject"><?php if($subject){echo $subject;}else{ echo $subject_default;}?></textarea></td>
<td><textarea cols="100" rows="6" name="registration_success_email_content"><?php if($content){echo $content;}else{ echo $content_default;}?></textarea></td>
</tr>

<?php
$subject = stripslashes(get_option('registration_success_aff_email_subject'));
$content = stripslashes(get_option('registration_success_aff_email_content'));
$subject_default = __('Affiliate Log In Details');
$content_default = __('<p>Dear [#$user_name#],</p>
<p>You can log in  with the following information:</p>
<p>Username: [#$user_login#]</p>
<p>Password: [#$user_password#]</p>
<br>
<p>We hope you enjoy shopping. We look forward to working with you. Thank you.</p>
<p>[#$store_name#]</p>');
if(!$subject){ update_option('registration_success_aff_email_subject',$subject_default);}
if(!$content){ update_option('registration_success_aff_email_content',$content_default);}
?>
<tr>
<td><?php _e('Affiliate Registration Email');?>
<br /><br />
<?php _e('Active/Inactive email?');?>
<?php $email_flag = get_option('registration_success_aff_email_flag');?>
<select name="registration_success_aff_email_flag">
<option value="active" <?php if($email_flag=='active'){echo 'selected="selected"';}?> ><?php _e('Active');?></option>
<option value="inactive" <?php if($email_flag=='inactive'){echo 'selected="selected"';}?>><?php _e('Inactive');?></option>
</select>
</td>
<td><textarea rows="6" cols="25" name="registration_success_aff_email_subject"><?php if($subject){echo $subject;}else{ echo $subject_default;}?></textarea></td>
<td><textarea cols="100" rows="6" name="registration_success_aff_email_content"><?php if($content){echo $content;}else{ echo $content_default;}?></textarea></td>
</tr>

<tr>
  <td>&nbsp;</td>
  <td><input type="submit" name="Submit" value="<?php _e('Save')?>"> <td>
  </td>
</tr>
</table>

<h3><?php _e('Messages')?></h3>
<table width="100%" cellpadding="5" class="widefat post fixed" >
<thead>
<tr>
  <th width="250"  align="left"><strong><?php _e('Title'); ?></strong></th>
  <th align="left" width="80%"><strong><?php _e('Description'); ?></strong></th>
</tr>
</thead>
<?php
$title = __('Order Success for zero amount order or pay on delivery');
$content_default = __('<p>Thank you, your order has been successfully received.</p>
<p>Thank you for shopping at [#$store_name#].</p>');
$content = stripslashes(get_option('order_payment_success_msg_content'));
if(!$content){ update_option('order_payment_success_msg_content',$content_default);}
?>
<tr>
  <td><?php echo $title;?></td>
  <td><textarea cols="100" rows="6" name="order_payment_success_msg_content"><?php if($content){echo $content;}else{ echo $content_default;}?></textarea></td>
</tr>

<?php
$title = __('Payment Success Return from Paypal');
$content_default = __('<h4>Your payment received successfully and we will ship you order as soon as possible.</h4>
<p>Thank you for shopping at [#$store_name#].</p>');
$content = stripslashes(get_option('order_payment_success_paypal_msg_content'));
if(!$content){ update_option('order_payment_success_paypal_msg_content',$content_default);}
?>
<tr>
  <td><?php echo $title;?></td>
  <td><textarea cols="100" rows="6" name="order_payment_success_paypal_msg_content"><?php if($content){echo $content;}else{ echo $content_default;}?></textarea></td>
</tr>

<?php
$title = __('Payment Success Prebank Trasfer');
$content_default = __('<p>Thank you, your order has been successfully received.</p>
<p>To complete the order please transfer amount of <u><b>[#$order_amt#]</b></u> with the following information :</p>
<p>Your Order Number : #[#$orderId#]</p>
<p>Bank Name : [#$bank_name#]</p>
<p>Account Number : [#$account_number#]</p>
<p>Please include the order number as reference : Order number is #[#$orderId#]</p>
<p>Upon receipt of payment we will process and ship your order.</p>
<p>You can view order detail information from your member area. Member area User ID and password has been sent to your Email address.</p>
<p>Thank you for shopping with [#$store_name#].</p>');
$content = stripslashes(get_option('order_payment_success_prebank_msg_content'));
if(!$content){ update_option('order_payment_success_prebank_msg_content',$content_default);}
?>
<tr>
  <td><?php echo $title;?></td>
  <td><textarea cols="100" rows="6" name="order_payment_success_prebank_msg_content"><?php if($content){echo $content;}else{ echo $content_default;}?></textarea></td>
</tr>

<?php
$title = __('Order Cancellation');
$content_default = __('<p>Apologies for cancellation of your order</p>
<p>Thank you for visiting [#$store_name#].
</p>');
$content = stripslashes(get_option('order_cancellation_msg_content'));
if(!$content){ update_option('order_cancellation_msg_content',$content_default);}
?>
<tr>
  <td><?php echo $title;?></td>
  <td><textarea cols="100" rows="6" name="order_cancellation_msg_content"><?php if($content){echo $content;}else{ echo $content_default;}?></textarea></td>
</tr>

<tr>
  <td>&nbsp;</td>
  <td><input type="submit" name="Submit" value="<?php _e('Save')?>"> <td>
  </td>
</tr>
</table>
</form>
<br /><br />