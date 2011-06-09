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
//$userInfo = $General->getLoginUserInfo();
global $userInfo;
global $current_user,$orderNumber;
$display_name = $current_user->data->display_name;
if(is_array($current_user->data->user_address_info))
{
	$userInfo = $current_user->data->user_address_info;	
}
$address = $userInfo['buser_add1'].', '.$userInfo['buser_add2'];
$taxable_amt_info = $General->get_tax_amount();
$taxable_amt = $taxable_amt_info[0];
$payable_amt = $General->get_payable_amount($_REQUEST['shippingmethod']);

require_once(TEMPLATEPATH . '/library/payment/authorizenet/authorizenet.class.php');

$a = new authorizenet_class;

// You login using your login, login and tran_key, or login and password.  It
// varies depending on how your account is setup.
// I believe the currently reccomended method is to use a tran_key and not
// your account password.  See the AIM documentation for additional information.

$a->add_field('x_login', $paymentOpts['loginid']);
$a->add_field('x_tran_key', $paymentOpts['transkey']);
//$a->add_field('x_password', 'CHANGE THIS TO YOUR PASSWORD');

$a->add_field('x_version', '3.1');
$a->add_field('x_type', 'AUTH_CAPTURE');
//$a->add_field('x_test_request', 'TRUE');    // Just a test transaction
$a->add_field('x_relay_response', 'FALSE');

// You *MUST* specify '|' as the delim char due to the way I wrote the class.
// I will change this in future versions should I have time.  But for now, just
// make sure you include the following 3 lines of code when using this class.

$a->add_field('x_delim_data', 'TRUE');
$a->add_field('x_delim_char', '|');     
$a->add_field('x_encap_char', '');

// Setup fields for customer information.  This would typically come from an
// array of POST values froma secure HTTPS form.
$address = $userInfo['user_add1'].', '.$userInfo['user_add2'];
$a->add_field('x_first_name', $current_user->data->display_name);
$a->add_field('x_last_name', '');
$a->add_field('x_address', $address);
$a->add_field('x_city', $userInfo['buser_city']);
$a->add_field('x_state', $userInfo['buser_state']);
$a->add_field('x_zip', $userInfo['buser_postalcode']);
$a->add_field('x_country', $userInfo['buser_country']);
$a->add_field('x_country',  $userInfo['buser_country']);
$a->add_field('x_email', $current_user->data->user_email);
$a->add_field('x_phone', $userInfo['phone']);

// Using credit card number '4007000000027' performs a successful test.  This
// allows you to test the behavior of your script should the transaction be
// successful.  If you want to test various failures, use '4222222222222' as
// the credit card number and set the x_amount field to the value of the
// Response Reason Code you want to test. 
//
// For example, if you are checking for an invalid expiration date on the
// card, you would have a condition such as:
// if ($a->response['Response Reason Code'] == 7) ... (do something)
//
// Now, in order to cause the gateway to induce that error, you would have to
// set x_card_num = '4222222222222' and x_amount = '7.00'

//  Setup fields for payment information
$a->add_field('x_method', $_REQUEST['cc_type']);
$a->add_field('x_card_num', $_REQUEST['cc_number']);
//$a->add_field('x_card_num', '4007000000027');   // test successful visa
//$a->add_field('x_card_num', '370000000000002');   // test successful american express
//$a->add_field('x_card_num', '6011000000000012');  // test successful discover
//$a->add_field('x_card_num', '5424000000000015');  // test successful mastercard
// $a->add_field('x_card_num', '4222222222222');    // test failure card number
$a->add_field('x_amount', $payable_amt);
$a->add_field('x_invoice_num', $orderNumber);
$a->add_field('x_exp_date', $_REQUEST['cc_month'].substr($_REQUEST['cc_year'],2,strlen($_REQUEST['cc_year'])));    // march of 2008
$a->add_field('x_card_code', $_REQUEST['cv2']);    // Card CAVV Security code
// Process the payment and output the results
switch ($a->process()) {
   case 1:  // Successs
	$_SESSION['display_message'] = $a->get_response_reason_text();
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
	
		///////////admin email//////////
		$subject = get_option('order_submited_success_admin_email_subject');
		$admin_message = get_option('order_submited_success_admin_email_content');
		$search_array = array('[#$to_name#]','[#$order_info#]','[#$store_name#]');
		$replace_array = array($fromEmailName,$order_info,$store_name);
		$admin_message = str_replace($search_array,$replace_array,$admin_message);	
		$General->sendEmail($toEmail,$toEmailName,$fromEmail,$fromEmailName,$subject,$admin_message,$extra='');///To admin email
	}
	
	if($orderNumber)
	{
		$General->set_ordert_status($orderNumber,'approve');
	}
	$redirectUrl = site_url()."/?ptype=payment_success&oid=".$orderNumber;
	wp_redirect($redirectUrl);
	exit;
	break;
     
   case 2:  // Declined
      $paymentFlag = 0;
	  //echo "<b>Payment Declined:</b><br>";
     // echo $a->get_response_reason_text();
     // echo "<br><br>Details of the transaction are shown below...<br><br>";
	$_SESSION['display_message'] = $a->get_response_reason_text();
	  break;
     
   case 3:  // Error
       $paymentFlag = 0;
	  //echo "<b>Error with Transaction:</b><br>";
     // echo $a->get_response_reason_text();
     // echo "<br><br>Details of the transaction are shown below...<br><br>";
     $_SESSION['display_message'] = $a->get_response_reason_text();
	  break;
}
if($paymentFlag == '0')
{
	if($_REQUEST['checkout_as_guest'])
	{
		$subpage_url = "&checkout_as_guest=".$_REQUEST['checkout_as_guest'];	
	}
	global $General;
	wp_redirect($General->get_ssl_normal_url(site_url())."/?ptype=checkout".$subpage_url);
	 exit;
}
?>