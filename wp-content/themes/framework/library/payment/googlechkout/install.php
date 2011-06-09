<?php
$paymentmethodname = 'googlechkout'; 
if($_REQUEST['install']==$paymentmethodname)
{
	$paymethodinfo = array();
	$payOpts = array();
	$payOpts[] = array(
					"title"			=>	"Merchant Id",
					"fieldname"		=>	"merchantid",
					"value"			=>	"1234567890",
					"description"	=>	__('Example')." : 1234567890"
					);
												
	$paymethodinfo = array(
						"name" 		=> 'Google Checkout',
						"key" 		=> $paymentmethodname,
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'2',
						"payOpts"	=>	$payOpts,
						);
	
	update_option("payment_method_$paymentmethodname", $paymethodinfo );
	$install_message = __("Payment Method integrated successfully");
	$option_id = $wpdb->get_var("select option_id from $wpdb->options where option_name like \"payment_method_$paymentmethodname\"");
	wp_redirect("admin.php?page=paymentoptions&payact=setting&id=$option_id");
}elseif($_REQUEST['uninstall']==$paymentmethodname)
{
	delete_option("payment_method_$paymentmethodname");
	$install_message = __("this payment method cannot deleted because it is fix, you can deactive it");
}
?>