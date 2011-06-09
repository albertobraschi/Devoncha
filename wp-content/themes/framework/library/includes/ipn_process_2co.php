<?php
global $Cart,$General;
foreach ($_POST as $field=>$value)
{
	$ipnData["$field"] = $value;
}

$invoice    = intval($ipnData['x_invoice_num']);
$pnref      = $ipnData['x_trans_id'];
$amount     = doubleval($ipnData['x_amount']);
$result     = intval($ipnData['x_response_code']);
$respmsg    = $ipnData['x_response_reason_text'];
$customer_email    = $ipnData['x_email'];
$customer_name = $ipnData['x_first_name'];

$fromEmail = $General->get_site_emailId();
$fromEmailName = $General->get_site_emailName();
$subject = "Acknowledge for #$invoice payment";

if ($result == '1')
{
	// Valid IPN transaction.
	$General->set_ordert_status($invoice,'approve');
	$message = "<p>Dear '.$customer_name.',</p>
			<p>
			payment for order #$invoice completed successfully.<br>
			</p>
			<p>
			<b>You may find detail below:</b>
			</p>
			<p>----</p>
			<p>Order Id : '.$invoice.'</p>
			<p>Order Amount :       '.number_format($amount,2).'</p>
			<p>Transaction ID :       '.$pnref.'</p>
			<p>Result Code : '.$result.'</p>
			<p>Response Message : '.$respmsg.'</p>
			<p>----</p><br><br>
			<p>Thank you.</p>
			'";
	$General->sendEmail($fromEmail,$fromEmailName,$customer_email,$customer_name,$subject,$message,$extra='');///To payment email
	return true;
}
else if ($result != '1')
{
	$message = "<p>Dear '.$customer_name.',</p>
			<p>
			payment for order #$invoice incompleted.<br>
			because of $respmsg
			</p>
			<p>
			<b>You may find detail below:</b>
			</p>
			<p>----</p>
			<p>Order Id : '.$invoice.'</p>
			<p>Order Amount :       '.number_format($amount,2).'</p>
			<p>Transaction ID :       '.$pnref.'</p>
			<p>Result Code : '.$result.'</p>
			<p>Response Message : '.$respmsg.'</p>
			<p>----</p><br><br>
			<p>Thank you.</p>
			'";
	$General->sendEmail($fromEmail,$fromEmailName,$customer_email,$customer_name,$subject,$message,$extra='');///To payment email
	return false;
}
?>