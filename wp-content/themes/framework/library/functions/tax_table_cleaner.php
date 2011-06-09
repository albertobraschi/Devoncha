<?php
global $ord_db_table_name,$prd_db_table_name,$tax_db_table_name,$shippings_db_table_name,$shipping_info_db_table_name;
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
?>