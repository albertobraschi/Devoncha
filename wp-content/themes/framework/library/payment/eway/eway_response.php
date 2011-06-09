<?php
session_start();
ob_start();
?>

 <div class="wrapper" >
		<div class="clearfix container_message">
            	<h1 class="processing_message_head">Processing for <?php echo $_REQUEST['paymentmethod'];?>, Please wait ....</h1>
            </div>

<?php
/*  Demonstration on using authorizenet.class.php.  This just sets up a
*  little test transaction to the authorize.net payment gateway.  You
*  should read through the AIM documentation at authorize.net to get
*  some familiarity with what's going on here.  You will also need to have
*  a login and password for an authorize.net AIM account and PHP with SSL and
*  curl support.
*
*  Reference http://www.authorize.net/support/AIM_guide.pdf for details on
*  the AIM API.
*/
global $General, $Cart;
$paymentOpts = $General->get_payment_optins($_REQUEST['paymentmethod']);
$userInfo = $General->getLoginUserInfo();
$user_address_info = unserialize(get_user_option('user_address_info', $userInfo['ID']));
$taxable_amt_info = $General->get_tax_amount();
$taxable_amt = $taxable_amt_info[0];
$payable_amt = $General->get_payable_amount($_REQUEST['shippingmethod']);

require_once(TEMPLATEPATH . '/library/payment/eway/eway.class.php');

$a = new eway_class;

list($fname,$lname) = explode(' ',$_REQUEST['cardholder_name']);
$ccexp = $_REQUEST['cc_month'].substr($_REQUEST['cc_year'], 2, 2);
$address = $user_address_info['user_add1'].','.$user_address_info['user_add2'];
$ewayCustomerID = $paymentOpts['ewayCustomerID'];
//set parameters
$a->set('ewayCustomerID', $ewayCustomerID);
$a->set('email',$userInfo['user_email']);
$a->set('fname', $fname);
$a->set('lname', $lname);
$a->set('ccno', $_REQUEST['cc_number']);
$a->set('ccexp', $ccexp);
$a->set('amount', str_replace(',','',number_format($payable_amt,2)));
$a->set('address', $address);
$a->set('zip', $user_address_info['user_postalcode']);
$a->set('iid', $orderNumber);
//$a->set('mode', 'test');
$response = $a->processCard();
if($response['x_response_code']==1)  //success
{
	$_SESSION['display_message'] = 'Transaction success';
	$x_trans_id = $response['x_trans_id'];
	$General->set_ordert_status($orderNumber,'approve');

	$subject = get_option('order_approval_client_email_subject');
	$admin_message = get_option('order_approval_client_email_content');
	
	$order_info = $General->get_order_detailinfo_tableformat($orderNumber);
	
	$fromEmail = $General->get_site_emailId();
	$fromEmailName = $General->get_site_emailName();
	$toEmailName = $current_user->data->display_name;
	$toEmail = $current_user->data->user_email;
	$search_array = array('[#$user_name#]','[#$to_name#]','[#$order_info#]','[#$store_name#]');
	$replace_array = array($toEmailName,$toEmailName,$order_info,$fromEmailName);
	$client_message = str_replace($search_array,$replace_array,$admin_message);
	if($fromEmail && $toEmail)
	{
		$General->sendEmail($fromEmail,$fromEmailName,$toEmail,$toEmailName,$subject,$client_message,$extra='');///approve/reject email	
	}
	$redirectUrl = site_url()."/?ptype=payment_success&oid=".$orderNumber;
	wp_redirect($redirectUrl);
	exit;
}elseif($response['x_response_code']==2) //failed
{
	if($_REQUEST['checkout_as_guest'])
	{
		$suburl = '&checkout_as_guest=1';	
	}
	$_SESSION['display_message'] = 'Transaction fail:'.$response['x_response_reason_text'];
	wp_redirect($General->get_ssl_normal_url(site_url())."/?ptype=checkout".$suburl);
	exit;
}elseif($response['x_response_code']==3) //failed
{	$_SESSION['display_message'] = 'Transaction fail : No Merchant';
	if($_REQUEST['checkout_as_guest'])
	{
		$suburl = '&checkout_as_guest=1';	
	}
	wp_redirect($General->get_ssl_normal_url(site_url())."/?ptype=checkout".$suburl);
	 exit;
}else
{	$_SESSION['display_message'] = 'Transaction fail';
	if($_REQUEST['checkout_as_guest'])
	{
		$suburl = '&checkout_as_guest=1';	
	}
	wp_redirect($General->get_ssl_normal_url(site_url())."/?ptype=checkout".$suburl);
	 exit;
}
exit;
?>