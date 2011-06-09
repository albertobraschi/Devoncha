<?php
$paymentmethodname = 'paypal_pro_express';
if($_REQUEST['install']==$paymentmethodname)
{
	$payOpts = array();
	$paymethodinfo = array();
	$payOpts[] = array(
					"title"			=>	"API User Name",
					"fieldname"		=>	"api_username",
					"value"			=>	"sdk-three_api1.sdk.com",
					"description"	=>	__('Example')." : sdk-three_api1.sdk.com"
					);
	$payOpts[] = array(
					"title"			=>	"API Password",
					"fieldname"		=>	"api_password",
					"value"			=>	"QFZCWN5HZM8VBG7Q",
					"description"	=>	__('Example')." : QFZCWN5HZM8VBG7Q"
					);
	$payOpts[] = array(
					"title"			=>	"API Signature",
					"fieldname"		=>	"api_signature",
					"value"			=>	"A.d9eRKfd1yVkRrtmMfCFLTqa6M9AyodL0SJkhYztxUi8W9pCXF6.4NI",
					"description"	=>	__('Example')." : A.d9eRKfd1yVkRrtmMfCFLTqa6M9AyodL0SJkhYztxUi8W9pCXF6.4NI"
					);
	$payOpts[] = array(
					"title"			=>	"Cancel Url",
					"fieldname"		=>	"cancel_return",
					"value"			=>	site_url()."/?ptype=cancel_return&pmethod=paypal",
					"description"	=>	__('Example')." : http://mydomain.com/cancel_return.php",
					);
	$payOpts[] = array(
					"title"			=>	"Return Url",
					"fieldname"		=>	"returnUrl",
					"value"			=>	site_url()."/?ptype=return&pmethod=paypal",
					"description"	=>	__('Example')." : http://mydomain.com/return.php",
					);
	
												
	$paymethodinfo = array(
						"name" 		=> 'Paypal Pro Express',
						"key" 		=> $paymentmethodname,
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'8',
						"payOpts"	=>	$payOpts,
						);
	update_option( 'payment_method_paypal_pro_express', $paymethodinfo );
	$install_message = __("Payment Method integrated successfully");
	$option_id = $wpdb->get_var("select option_id from $wpdb->options where option_name like \"payment_method_$paymentmethodname\"");
	wp_redirect("admin.php?page=paymentoptions&payact=setting&id=$option_id");
}elseif($_REQUEST['uninstall']==$paymentmethodname)
{
	delete_option("payment_method_$paymentmethodname");
	$install_message = __("Payment Method deleted successfully");
}
?>