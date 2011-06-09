<?php
global $wpdb,$General;
$url = 'https://www.paypal.com/cgi-bin/webscr';
$postdata = '';
foreach($_POST as $i=> $v) 
{
	$postdata .= $i.'='.urlencode($v).'&amp;';
}
$postdata .= 'cmd=_notify-validate';
 
$web = parse_url($url);
if ($web['scheme'] == 'https') 
{
	$web['port'] = 443;
	$ssl = 'ssl://';
}
else 
{
	$web['port'] = 80;
	$ssl = '';
}
$fp = @fsockopen($ssl.$web['host'], $web['port'], $errnum, $errstr, 30);
 
if (!$fp) 
{
	echo $errnum.': '.$errstr;
}
else
{
	fputs($fp, "POST ".$web['path']." HTTP/1.1\r\n");
	fputs($fp, "Host: ".$web['host']."\r\n");
	fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
	fputs($fp, "Content-length: ".strlen($postdata)."\r\n");
	fputs($fp, "Connection: close\r\n\r\n");
	fputs($fp, $postdata . "\r\n\r\n");
 
	while(!feof($fp)) 
	{
		$info[] = @fgets($fp, 1024);
	}
	fclose($fp);
	$info = implode(',', $info);
	if (eregi('VERIFIED', $info)) 
	{
		$fromEmail = $General->get_site_emailId();
		$fromEmailName = $General->get_site_emailName();
		$paymentOpts = $General->get_payment_optins('paypal');
		$merchantid = $paymentOpts['merchantid'];
		
		$item_name            = $_POST['item_name'];
		$item_number          = $_POST['item_number'];
		$quantity             = $_POST['quantity'];
		$payment_amount       = $_POST['mc_gross'];
		$fee                  = $_POST['mc_fee'];
		$tax                  = $_POST['tax'];
		$payment_currency     = $_POST['mc_currency'];
		$exchange_rate        = $_POST['exchange_rate'];
		$payment_status       = $_POST['payment_status'];
		$payment_type         = $_POST['payment_type'];
		$payment_date         = $_POST['payment_date'];
		$txn_id               = $_POST['txn_id'];
		$txn_type             = $_POST['txn_type']; // 'cart', 'send_money' or 'web_accept' (manual page 46)
		$custom               = $_POST['custom'];   // Any custom data
		$receiver_email       = $_POST['receiver_email'];
		$first_name           = $_POST['first_name'];
		$last_name            = $_POST['last_name'];
		$payer_business_name  = $_POST['payer_business_name'];
		$payer_email          = $_POST['payer_email'];
		$address_street       = $_POST['address_street'];
		$address_zip          = $_POST['address_zip'];
		$address_city         = $_POST['address_city'];
		$address_state        = $_POST['address_state'];
		$address_country      = $_POST['address_country'];
		$address_country_code = $_POST['address_country_code'];
		$residence_country    = $_POST['residence_country'];
		$orderId = $custom;
		$General->set_ordert_status($orderId,'approve');
		
		///////////email start//////////
		$store_name = get_option('blogname');
		$transaction_details .= "<p>--------------------------------------------------</p>";
		$transaction_details .= "<p>Payment Details for Order ID #$orderId</p>";
		$transaction_details .= "<p>--------------------------------------------------</p>";
		$transaction_details .= " <p>Order Information: <br/><br/> $item_name </p>";
		$transaction_details .= "<p>--------------------------------------------------</p>";
		$transaction_details .= "<p>Trans ID: $txn_id</p>";
		$transaction_details .= " <p> Status: $payment_status</p>";
		$transaction_details .= " <p>  Type: $payment_type</p>";
		$transaction_details .= " <p> Date: $payment_date</p>";
		$transaction_details .= " <p> Method: $txn_type</p>";
		$transaction_details .= " <p> Receiver Email: $receiver_email</p>";
		$transaction_details .= " <p> Payer Email: $payer_email</p>";
		$transaction_details .= " <p> Payment Currency: $payment_currency</p>";
		$transaction_details .= " <p> Payment Date: $payment_date</p>";
		$transaction_details .= "<p>--------------------------------------------------</p>";
		
		$supplier_subject = get_option('order_success_ipn_supplier_email_subject');
		$supplier_message = get_option('order_success_ipn_supplier_email_content');
		$search_array = array('[#$to_name#]','[#$transaction_details#]','[#$store_name#]');
		$replace_array = array($fromEmailName,$transaction_details,'Pay Pal');
		$supplier_message = str_replace($search_array,$replace_array,$supplier_message);
		
		if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/ipn_process_before_email_customer.php'))
		{
			include_once(CHILDTEMPLATEPATH . '/ipn_process_before_email_customer.php');
		}
		//////////////////email end/////////
		if(get_option('order_success_ipn_supplier_email_flag')!='inactive')
		{
			$General->sendEmail($fromEmail,$fromEmailName,$payer_email,$first_name,$supplier_subject,$supplier_message,$extra='');///To admin email
		}
		if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/ipn_process_before_email_admin.php'))
		{
			include_once(CHILDTEMPLATEPATH . '/ipn_process_before_email_admin.php');
		}
		
		$customer_subject = get_option('order_success_ipn_client_email_subject');
		$customer_message = get_option('order_success_ipn_client_email_content');
		$search_array = array('[#$to_name#]','[#$transaction_details#]','[#$store_name#]');
		$replace_array = array($fromEmailName,$transaction_details,'Pay Pal');
		$customer_message = str_replace($search_array,$replace_array,$customer_message);
		if(get_option('order_success_ipn_client_email_flag')!='inactive')
		{
			$General->sendEmail($payer_email,$first_name,$fromEmail,$fromEmailName,$customer_subject,$customer_message,$extra='');///To client email
		}
	}
	else
	{
		// invalid, log error or something
	}
}
?>