<?php
global $ord_db_table_name,$prd_db_table_name,$tax_db_table_name,$shippings_db_table_name,$shipping_info_db_table_name;

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
?>