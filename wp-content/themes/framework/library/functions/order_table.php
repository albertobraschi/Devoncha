<?php
global $ord_db_table_name,$prd_db_table_name,$tax_db_table_name,$shippings_db_table_name,$shipping_info_db_table_name;
if($wpdb->get_var("SHOW TABLES LIKE \"$ord_db_table_name\"") != $ord_db_table_name)
{
 $sql = 'DROP TABLE `' . $ord_db_table_name . '`';  // drop the existing table
  $wpdb->query($sql);
   $sql = "CREATE TABLE `".$ord_db_table_name."` (
	`oid` bigint(20) NOT NULL AUTO_INCREMENT,
	`uid` bigint(20) NOT NULL,
	`ord_date` datetime NOT NULL,
	`ord_desc_client` text NOT NULL,
	`ord_desc_admin` text NOT NULL,
	`billing_name` varchar(255) NOT NULL,
	`billing_add` text NOT NULL,
	`shipping_name` varchar(255) NOT NULL,
	`shipping_add` text NOT NULL,
	`ostatus` varchar(100) NOT NULL DEFAULT 'pending',
	`payment_method` varchar(255) NOT NULL,
	`shipping_method` varchar(255) NOT NULL,
	`coupon_code` varchar(255) NOT NULL,
	`currency_code` varchar(255) NOT NULL,
	`cart_amount` float(25,2) NOT NULL DEFAULT '0.00000',
	`discount_amt` float(25,5) NOT NULL DEFAULT '0.00000',
	`shipping_amt` float(25,2) NOT NULL DEFAULT '0.00000',
	`tax_amount` float(25,2) NOT NULL DEFAULT '0.00000',
	`tax_desc` varchar(255) NOT NULL,
	`payable_amt` float(25,5) NOT NULL DEFAULT '0.00000',
	`aff_uid` bigint(20) NOT NULL,
	`aff_commission` float(20,2) NOT NULL,
	`ip_address` varchar(255) NOT NULL,
	PRIMARY KEY (`oid`)
	) ENGINE = MYISAM ;";
  $wpdb->query($sql);
}

if($wpdb->get_var("SHOW TABLES LIKE '$prd_db_table_name'") != $prd_db_table_name)
{
   $sql = 'DROP TABLE `' . $prd_db_table_name . '`';  // drop the existing table
	$wpdb->query($sql);
   $sql = "CREATE TABLE IF NOT EXISTS `".$prd_db_table_name."` (
	 `opid` bigint(20) NOT NULL AUTO_INCREMENT,
	  `oid` bigint(20) NOT NULL,
	  `pid` int(11) NOT NULL,
	  `prd_qty` int(11) NOT NULL,
	  `pdesc` text NOT NULL,
	  `price` float(25,2) NOT NULL DEFAULT '0.00000',
	  `grossprice` float(25,2) NOT NULL DEFAULT '0.00000',
	  `pmodel` varchar(255) NOT NULL,
	  `pweight` varchar(255) NOT NULL,
	  PRIMARY KEY (`opid`)
	) ENGINE = MYISAM ;";
  $wpdb->query($sql);
}
if($wpdb->get_var("SHOW TABLES LIKE '$tax_db_table_name'") != $tax_db_table_name)
{
   $sql = 'DROP TABLE `' . $tax_db_table_name . '`';  // drop the existing table
	$wpdb->query($sql);
   $sql = "CREATE TABLE IF NOT EXISTS `" . $tax_db_table_name . "` (
  `tax_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_title` varchar(255) NOT NULL,
  `tax_desc` text NOT NULL,
  `tax_state` varchar(255) NOT NULL,
  `tax_country` varchar(255) NOT NULL,
  `tax_status` tinyint(4) NOT NULL DEFAULT '1',
  `tax_amount` float(15,2) NOT NULL,
  `amount_type` varchar(100) NOT NULL DEFAULT 'per' COMMENT 'per/amt',
  PRIMARY KEY (`tax_id`)
) ENGINE=MYISAM;";
  $wpdb->query($sql);
}

if($wpdb->get_var("SHOW TABLES LIKE '$shippings_db_table_name'") != $shippings_db_table_name)
{
$sql = 'DROP TABLE `' . $shippings_db_table_name . '`';  // drop the existing table
$wpdb->query($sql);
$sql = "CREATE TABLE IF NOT EXISTS `" . $shippings_db_table_name . "` (
 `shipping_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`title` VARCHAR( 255 ) NOT NULL ,
`sdesc` TEXT NOT NULL,
`default_status` tinyint(4) NOT NULL
) ENGINE=MYISAM";
$wpdb->query($sql);
  
$datasql = "INSERT INTO `".$shippings_db_table_name."` (`shipping_id`, `title`, `sdesc`, `default_status`) VALUES
(1, 'Flat Rate Shipping', '', 0),
(2, 'Free Shipping', '', 1),
(3, 'Price Based Shipping', '', 0),
(4, 'Weight Based Shipping', '', 0)";
$wpdb->query($datasql);
}

if($wpdb->get_var("SHOW TABLES LIKE '$shipping_info_db_table_name'") != $shipping_info_db_table_name)
{
$sql = 'DROP TABLE `' . $shipping_info_db_table_name . '`';  // drop the existing table
$wpdb->query($sql);
$sql = "CREATE TABLE IF NOT EXISTS `" . $shipping_info_db_table_name . "` (
`sinfo_id` int(11) NOT NULL AUTO_INCREMENT,
`shipping_id` int(11) NOT NULL,
`ship_type_range` varchar(255) NOT NULL,
`country` varchar(100) NOT NULL,
`state` varchar(100) NOT NULL,
`amount` float(25,2) NOT NULL,
PRIMARY KEY (`sinfo_id`)
) ENGINE=MYISAM;";
$wpdb->query($sql);

$insert_sql = "INSERT INTO `".$shipping_info_db_table_name."` (`sinfo_id`, `shipping_id`, `ship_type_range`, `country`, `state`, `amount`) VALUES
(1, 1, '', '', '', 20.00),
(2, 2, '', '', '', 0.00),
(3, 3, '10->100', '', '', 1.00),
(4, 3, '101->200', '', '', 10.00),
(5, 3, '201->300', '', '', 20.00),
(6, 3, '301->500', '', '', 50.00),
(7, 3, '501->1000', '', '', 60.00),
(8, 4, '1->10', '', '', 10.00),
(9, 4, '11->51', '', '', 20.00),
(10, 4, '51->100', '', '', 30.00),
(11, 4, '101->150', '', '', 40.00),
(12, 4, '151->200', '', '', 40.00)";
$wpdb->query($insert_sql);
}
?>