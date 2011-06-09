<?php
/***********************************************************
DoDirectPaymentReceipt.php

Submits a credit card transaction to PayPal using a
DoDirectPayment request.

The code collects transaction parameters from the form
displayed by DoDirectPayment.php then constructs and sends
the DoDirectPayment request string to the PayPal server.
The paymentType variable becomes the PAYMENTACTION parameter
of the request string.

After the PayPal server returns the response, the code
displays the API request and response in the browser.
If the response from PayPal was a success, it displays the
response parameters. If the response was an error, it
displays the errors.

Called by DoDirectPayment.php.

Calls CallerService.php and APIError.php.

***********************************************************/

//require_once 'CallerService.php';
//require_once 'constants.php';
require_once(TEMPLATEPATH.'/library/payment/'.$paymentmethod.'/constants.php');
require_once(TEMPLATEPATH.'/library/payment/'.$paymentmethod.'/CallerService.php');
global $General;
session_start();

$API_UserName=API_USERNAME;

$API_Password=API_PASSWORD;

$API_Signature=API_SIGNATURE;

$API_Endpoint =API_ENDPOINT;

$subject = SUBJECT;

/**
 * Get required parameters from the web form for the request
 */
 
global $General, $Cart;
$paymentOpts = $General->get_payment_optins($_REQUEST['paymentmethod']);
$userInfo = $General->getLoginUserInfo();
$user_address_info = unserialize(get_user_option('user_address_info', $userInfo['ID']));
$taxable_amt_info = $General->get_tax_amount();
$taxable_amt = $taxable_amt_info[0];
$payable_amt = $General->get_payable_amount($_REQUEST['shippingmethod']);

$paymentType =urlencode( $_POST['paymentType']);
$firstName =urlencode( $userInfo['display_name']);
$lastName =urlencode( $user_address_info['last_name']);
$creditCardType =urlencode( $_POST['creditCardType']);
$creditCardNumber = urlencode($_POST['creditCardNumber']);
$expDateMonth =urlencode( $_POST['expDateMonth']);

// Month must be padded with leading zero
$padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);

$expDateYear =urlencode( $_POST['expDateYear']);
$cvv2Number = urlencode($_POST['cvv2Number']);
$address1 = urlencode($user_address_info['user_add1']);
$address2 = urlencode($user_address_info['user_add2']);
$city = urlencode($user_address_info['user_city']);
$state =urlencode( $user_address_info['user_state']);
$zip = urlencode($user_address_info['user_postalcode']);
$amount = urlencode($payable_amt);
//$currencyCode=urlencode($_POST['currency']);
$currencyCode=$General->get_currency_code();
$paymentType=urlencode($_POST['paymentType']);

/* Construct the request string that will be sent to PayPal.
   The variable $nvpstr contains all the variables and is a
   name value pair string with & as a delimiter */
$nvpstr="&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".         $padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=$state".
"&ZIP=$zip&COUNTRYCODE=US&CURRENCYCODE=$currencyCode";

$getAuthModeFromConstantFile = true;
//$getAuthModeFromConstantFile = false;
$nvpHeader = "";

if(!$getAuthModeFromConstantFile) {
	//$AuthMode = "3TOKEN"; //Merchant's API 3-TOKEN Credential is required to make API Call.
	//$AuthMode = "FIRSTPARTY"; //Only merchant Email is required to make EC Calls.
	$AuthMode = "THIRDPARTY"; //Partner's API Credential and Merchant Email as Subject are required.
} else {
	if(!empty($API_UserName) && !empty($API_Password) && !empty($API_Signature) && !empty($subject)) {
		$AuthMode = "THIRDPARTY";
	}else if(!empty($API_UserName) && !empty($API_Password) && !empty($API_Signature)) {
		$AuthMode = "3TOKEN";
	}else if(!empty($subject)) {
		$AuthMode = "FIRSTPARTY";
	}
}

switch($AuthMode) {
	
	case "3TOKEN" : 
			$nvpHeader = "&PWD=".urlencode($API_Password)."&USER=".urlencode($API_UserName)."&SIGNATURE=".urlencode($API_Signature);
			break;
	case "FIRSTPARTY" :
			$nvpHeader = "&SUBJECT=".urlencode($subject);
			break;
	case "THIRDPARTY" :
			$nvpHeader = "&PWD=".urlencode($API_Password)."&USER=".urlencode($API_UserName)."&SIGNATURE=".urlencode($API_Signature)."&SUBJECT=".urlencode($subject);
			break;		
	
}

$nvpstr = $nvpHeader.$nvpstr;

/* Make the API call to PayPal, using API signature.
   The API response is stored in an associative array called $resArray */
$resArray=hash_call("doDirectPayment",$nvpstr);

/* Display the API response back to the browser.
   If the response from PayPal was a success, display the response parameters'
   If the response was an error, display the errors received using APIError.php.
   */
$ack = strtoupper($resArray["ACK"]);
$resArray=$_SESSION['reshash'];
if($ack=='SUCCESS')
{
	$paymentFlag = 1;
	$_SESSION['display_message'] = $resArray['L_LONGMESSAGE0'];
	$General->set_ordert_status($orderNumber,'approve');
	$redirectUrl = site_url()."/?ptype=payment_success&oid=".$orderNumber;
}
else //Failure
{
	if(isset($_SESSION['curl_error_no'])) 
	{ 
		$paymentFlag = 0;
		$errorCode= $_SESSION['curl_error_no'] ;
		$errorMessage=$_SESSION['curl_error_msg'] ;	
		session_unset();	
		$_SESSION['display_message'] = $errorMessage;
	}else
	{
		$paymentFlag = 0;
		$_SESSION['display_message'] = $resArray['L_LONGMESSAGE0'];	
	}
}


if($paymentFlag == 0)
{
	global $General;
	 wp_redirect($General->get_ssl_normal_url(site_url())."/?ptype=checkout");
	 exit;
}
?>