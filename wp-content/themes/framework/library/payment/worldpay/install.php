<?php
$paymentmethodname = 'worldpay'; 
if($_REQUEST['install']==$paymentmethodname)
{
	$paymethodinfo = array();
	$payOpts = array();	
	$payOpts[] = array(
					"title"			=>	"Instant Id",
					"fieldname"		=>	"instId",
					"value"			=>	"123456",
					"description"	=>	__('Example')." : 123456"
					);
	$payOpts[] = array(
					"title"			=>	"Account Id",
					"fieldname"		=>	"accId1",
					"value"			=>	"12345",
					"description"	=>	__('Example')." : 12345"
					);
											
	$paymethodinfo = array(
						"name" 		=> 'Worldpay',
						"key" 		=> $paymentmethodname,
						"isactive"	=>	'1', // 1->display,0->hide\
						"display_order"=>'4',
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