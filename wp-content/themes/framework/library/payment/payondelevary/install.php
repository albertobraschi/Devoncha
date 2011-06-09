<?php
$paymentmethodname = 'payondelevary'; 
if($_REQUEST['install']==$paymentmethodname)
{
	$paymethodinfo = array();
	$payOpts = array();
	$paymethodinfo = array(
						"name" 		=> 'Pay Cash On Delivery',
						"key" 		=> $paymentmethodname,
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'7',
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