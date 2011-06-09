<?php
$paymentmethodname = 'authorizenet'; 
if($_REQUEST['install']==$paymentmethodname)
{
	$payOpts = array();
	$paymethodinfo = array();
	$payOpts = array();
	$payOpts = array();
	$payOpts[] = array(
					"title"			=>	"Login ID",
					"fieldname"		=>	"loginid",
					"value"			=>	"yourname@domain.com",
					"description"	=>	__('Example')." : yourname@domain.com"
					);
	$payOpts[] = array(
					"title"			=>	"Transaction Key",
					"fieldname"		=>	"transkey",
					"value"			=>	"1234567890",
					"description"	=>	__('Example')." : 1234567890",
					);
					
	$paymethodinfo = array(
						"name" 		=> 'Authorize.net',
						"key" 		=> $paymentmethodname,
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'3',
						"payOpts"	=>	$payOpts,
						);
	
	update_option("payment_method_$paymentmethodname", $paymethodinfo );
	$install_message = __("Payment Method integrated successfully");
	$option_id = $wpdb->get_var("select option_id from $wpdb->options where option_name like \"payment_method_$paymentmethodname\"");
	wp_redirect("admin.php?page=paymentoptions&payact=setting&id=$option_id");
}elseif($_REQUEST['uninstall']==$paymentmethodname)
{
	delete_option("payment_method_$paymentmethodname");
	$install_message = __("Payment Method deleted successfully");
}
?>