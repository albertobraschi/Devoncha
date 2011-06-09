<?php
$_SESSION['CART_INFORMATION'] = array();
$_SESSION['eval_coupon_code'] = '';
$_SESSION['couponcode'] = '';
$_SESSION['client_order_desc'] = '';

// To send HTML mail, the Content-type header must be set

$fromEmail = $General->get_site_emailId();
$fromEmailName = $General->get_site_emailName();
$subject = __("Payment Pending - Thank you for order");
$message = "";
//$userInfo = $General->getLoginUserInfo();
$toEmailName = $userInfo['display_name'];
$toEmail = $userInfo['user_email'];
if($_REQUEST['user_fname']){$toEmailName=$_REQUEST['user_fname'];}
if($_REQUEST['user_email']){$toEmail=$_REQUEST['user_email'];}

$store_name = get_option('blogname');
$order_info = $General->get_order_detailinfo_tableformat($last_order_id,1);
if($General->is_send_order_confirm_email())
{
$subject = get_option('order_payment_success_client_email_subject');
$client_message = get_option('order_payment_success_client_email_content');
/////////////customer email//////////////
$search_array = array('[#$to_name#]','[#$order_info#]','[#$store_name#]');
$replace_array = array($toEmailName,$order_info,$store_name);
$client_message = str_replace($search_array,$replace_array,$client_message);	
$General->sendEmail($fromEmail,$fromEmailName,$toEmail,$toEmailName,$subject,$client_message,$extra='');///To clidne email
}
if($General->is_send_order_confirm_email_admin())
{
///////////admin email//////////
$subject = get_option('order_submited_success_admin_email_subject');
$admin_message = get_option('order_submited_success_admin_email_content');
$search_array = array('[#$to_name#]','[#$order_info#]','[#$store_name#]');
$replace_array = array($fromEmailName,$order_info,$store_name);
$admin_message = str_replace($search_array,$replace_array,$admin_message);	
$General->sendEmail($toEmail,$toEmailName,$fromEmail,$fromEmailName,$subject,$admin_message,$extra='');///To admin email
}
?>