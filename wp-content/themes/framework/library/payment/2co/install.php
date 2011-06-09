<?php
$paymentmethodname = '2co';
if($_REQUEST['install']==$paymentmethodname)
{
	$payOpts = array();
	$paymethodinfo = array();
	$payOpts = array();
	$payOpts[] = array(
					"title"			=>	"Vendor ID",
					"fieldname"		=>	"vendorid",
					"value"			=>	"1303908",
					"description"	=>	__('Enter Vendor ID Example')." : 1303908"
					);
	$payOpts[] = array(
					"title"			=>	"Notify Url",
					"fieldname"		=>	"ipnfilepath",
					"value"			=>	site_url()."/?ptype=notifyurl&pmethod=2co",
					"description"	=>	__('Example')." : http://mydomain.com/2co_notifyurl.php",
					);
					
	$paymethodinfo = array(
						"name" 		=> '2CO (2Checkout)',
						"key" 		=> $paymentmethodname,
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'5',
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