<?php
global $General,$wpdb;
global $current_user,$wpdb,$prd_db_table_name,$ord_db_table_name;

$oid = $_REQUEST['oid'];
$pid = $_REQUEST['pid'];
$userid = $wpdb->get_var("select uid from $ord_db_table_name where oid=\"$oid\"");
if($userid == $current_user->data->ID)
{
	$data = get_post_meta($pid, 'key', true );
	$product_image = $data['productimage'];
	$digital_product = $data['digital_product'];
	wp_redirect($digital_product);
	exit;
}else
{
	echo "<h2>Invalid Download link. You cannot download you have to login to download the product.</h2>";
}
?>