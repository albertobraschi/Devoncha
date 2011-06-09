<?php

require_once(TEMPLATEPATH.'/library/payment/'.$paymentmethod.'/CallerService.php');
require_once(TEMPLATEPATH.'/library/payment/'.$paymentmethod.'/constants.php');

session_start();


$API_UserName=API_USERNAME;

$API_Password=API_PASSWORD;

$API_Signature=API_SIGNATURE;

$API_Endpoint =API_ENDPOINT;

$subject = SUBJECT;

/* An express checkout transaction starts with a token, that
   identifies to PayPal your transaction
   In this example, when the script sees a token, the script
   knows that the buyer has already authorized payment through
   paypal.  If no token was found, the action is to send the buyer
   to PayPal to first authorize payment
   */

$token = $_REQUEST['token'];

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

if(! isset($token)) {

		/* The servername and serverport tells PayPal where the buyer
		   should be directed back to after authorizing payment.
		   In this case, its the local webserver that is running this script
		   Using the servername and serverport, the return URL is the first
		   portion of the URL that buyers will return to after authorizing payment
		   */
		   global $General, $Cart;
			$paymentOpts = $General->get_payment_optins($_REQUEST['paymentmethod']);
			$userInfo = $General->getLoginUserInfo();
			$user_address_info = unserialize(get_user_option('user_address_info', $userInfo['ID']));
			$taxable_amt_info = $General->get_tax_amount();
			$taxable_amt = $taxable_amt_info[0];
			$payable_amt = $General->get_payable_amount($_REQUEST['shippingmethod']);
			$cartInfo = $Cart->getcartInfo();
			$cart_amount = $Cart->getCartAmt();
			$shipping_amt = $General->get_shipping_amt($Cart->getCartAmt_physical_prd(array(),array('freeshiping'=>1)));
			$shipping_method = $General->get_shipping_method('title');

		   $serverName = $_SERVER['SERVER_NAME'];
		   $serverPort = $_SERVER['SERVER_PORT'];
		   $url=dirname('http://'.$serverName.':'.$serverPort.$_SERVER['REQUEST_URI']);


		   $currencyCodeType=$General->get_currency_code();
		   $currencyCodeType = $General->get_currency_code();
		   $paymentType=$_REQUEST['paymentType'];
   

           $personName        = urlencode( $userInfo['display_name']);
		   $SHIPTOSTREET      = urlencode($user_address_info['user_add1']).','.urlencode($user_address_info['user_add2']);
		   $SHIPTOCITY        = urlencode($user_address_info['user_city']);
		   $SHIPTOSTATE	      = urlencode($user_address_info['user_state']);
		   $SHIPTOCOUNTRYCODE = urlencode($user_address_info['user_postalcode']);
		   $SHIPTOZIP         = urlencode($user_address_info['user_postalcode']);
		$query_str1 = array();
		for($i=0;$i<count($cartInfo);$i++)
		{
		$product_att = preg_replace('/([(])([+-])([0-9]*)([)])/','',$cartInfo[$i]['product_att']);
		$query_str1[] = "L_NAME$i=".$cartInfo[$i]['product_name'].'  '.$product_att."&L_AMT$i=".$cartInfo[$i]['product_gross_price']."&L_QTY$i=".$cartInfo[$i]['product_qty'];
		}
		if($query_str1)
		{
			$query_str = implode('&',$query_str1);	
		}
		
		$query_str .= "&L_SHIPPINGOPTIONAMOUNT=$shipping_amt&L_SHIPPINGOPTIONlABEL=$shipping_method&L_SHIPPINGOPTIONNAME=$shipping_method";
		
		 /* The returnURL is the location where buyers return when a
			payment has been succesfully authorized.
			The cancelURL is the location buyers are sent to when they hit the
			cancel button during authorization of payment during the PayPal flow
			*/

		  $returnURL = $paymentOpts['returnUrl'];
		  $cancelURL = $paymentOpts['cancel_return'];		
		  //$returnURL =urlencode($url.'/ReviewOrder.php?currencyCodeType='.$currencyCodeType.'&paymentType='.$paymentType);
		  // $cancelURL =urlencode("$url/SetExpressCheckout.php?paymentType=$paymentType" );

		 /* Construct the parameter string that describes the PayPal payment
			the varialbes were set in the web form, and the resulting string
			is stored in $nvpstr
			*/
           $maxamt= $payable_amt;
           $nvpstr="";
		   
           /*
            * Setting up the Shipping address details
            */
           $shiptoAddress = "&SHIPTONAME=$personName&SHIPTOSTREET=$SHIPTOSTREET&SHIPTOCITY=$SHIPTOCITY&SHIPTOSTATE=$SHIPTOSTATE&SHIPTOCOUNTRYCODE=$SHIPTOCOUNTRYCODE&SHIPTOZIP=$SHIPTOZIP";
           
           $nvpstr="&ADDRESSOVERRIDE=1$shiptoAddress&$query_str&MAXAMT=".(string)$maxamt."&AMT=".(string)$amt."&ITEMAMT=".(string)$itemamt."&CALLBACKTIMEOUT=4&ReturnUrl=".$returnURL."&CANCELURL=".$cancelURL ."&CURRENCYCODE=".$currencyCodeType."&PAYMENTACTION=".$paymentType;
		   $nvpstr = $nvpHeader.$nvpstr;
           
		 	/* Make the call to PayPal to set the Express Checkout token
			If the API call succeded, then redirect the buyer to PayPal
			to begin to authorize payment.  If an error occured, show the
			resulting errors
			*/
		   $resArray=hash_call("SetExpressCheckout",$nvpstr);
		   $_SESSION['reshash']=$resArray;

		   $ack = strtoupper($resArray["ACK"]);

		   $ack = strtoupper($resArray["ACK"]);
			$resArray=$_SESSION['reshash'];

			if($ack=='SUCCESS')
			{
				$paymentFlag = 1;
				$token = urldecode($resArray["TOKEN"]);
					$payPalURL = PAYPAL_URL.$token;
					header("Location: ".$payPalURL);
				//$redirectUrl = site_url()."/?ptype=payment_success&oid=".$orderNumber;
			}
			else //Failure
			{
				if(isset($_SESSION['curl_error_no'])) 
				{ 
					$paymentFlag = 0;
					$errorCode= $_SESSION['curl_error_no'] ;
					$errorMessage=$_SESSION['curl_error_msg'] ;	
					//session_unset();	
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

} else {
		 /* At this point, the buyer has completed in authorizing payment
			at PayPal.  The script will now call PayPal with the details
			of the authorization, incuding any shipping information of the
			buyer.  Remember, the authorization is not a completed transaction
			at this state - the buyer still needs an additional step to finalize
			the transaction
			*/

		   $token =urlencode( $_REQUEST['token']);

		 /* Build a second API request to PayPal, using the token as the
			ID to get the details on the payment authorization
			*/
		   $nvpstr="&TOKEN=".$token;

		   $nvpstr = $nvpHeader.$nvpstr;
		 /* Make the API call and store the results in an array.  If the
			call was a success, show the authorization details, and provide
			an action to complete the payment.  If failed, show the error
			*/
		   $resArray=hash_call("GetExpressCheckoutDetails",$nvpstr);
		   $_SESSION['reshash']=$resArray;
		   $ack = strtoupper($resArray["ACK"]);

		   if($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING')
			{
				$paymentFlag = 1;
 			}else
			{
				$paymentFlag = 0;
				$_SESSION['display_message'] = $resArray['L_LONGMESSAGE0'];	
			}
			
			if($paymentFlag == 0)
			{
				global $General;
				 wp_redirect($General->get_ssl_normal_url(site_url())."/?ptype=checkout");
				 exit;
			}

		   
}
?>