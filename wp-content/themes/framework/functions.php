<?php 
/*************************************************************
* Do not modify unless you know what you're doing, SERIOUSLY!
*************************************************************/
error_reporting(E_ERROR);

//load_theme_textdomain('default');
//load_textdomain( 'default', TEMPLATEPATH.'/localization/ar_AE.mo' );

global $blog_id;
if(get_option('upload_path') && !strstr(get_option('upload_path'),'wp-content/uploads'))
{
	$upload_folder_path = "wp-content/blogs.dir/$blog_id/files/";
}else
{
	$upload_folder_path = "wp-content/uploads/";
}
global $blog_id;
if($blog_id){ $thumb_url = '&amp;bid='."$blog_id";}

if ( function_exists( 'add_theme_support' ) ){
	add_theme_support( 'post-thumbnails' );
	}
/* Admin framework version 2.0 by Zeljan Topic */
define('MSG_NOTIFICATION_DIR', ABSPATH . "wp-content/themes/".get_option('template')."/library/notification/");

require_once (TEMPLATEPATH . '/library/functions/theme_variables.php'); // Theme variables
////////////////////////////////////////////////////////////////////////////////////////////
global $wpdb,$table_prefix;
$ord_db_table_name = $table_prefix . "orders";
$prd_db_table_name = $table_prefix . "order_products";
$country_db_table_name = $table_prefix . "country";
$state_db_table_name = $table_prefix . "state";
$tax_db_table_name = $table_prefix . "tax";
$shippings_db_table_name = $table_prefix . "shippings";
$shipping_info_db_table_name = $table_prefix . "shipping_info";

if('themes.php' == basename($_SERVER['SCRIPT_FILENAME'])) 
{
	if($_REQUEST['activated']=='true')
	{
		include_once($functions_path.'order_table.php');  //Create Order and Order Detail Tables
		include_once($functions_path.'country_table.php'); //Create Country Table and insert country data
		include_once($functions_path.'state_table.php'); //Create State Tabele and insert State data
	}
}
$order_table_column =  $wpdb->get_results('SHOW COLUMNS FROM wp_orders');
$ip_address_flag = 1;
$currency_code_flag = 1;
foreach($order_table_column as $order_table_column_obj)
{
	if($order_table_column_obj->Field=='ip_address')
	{
		$ip_address_flag = 0;	
	}
	if($order_table_column_obj->Field=='currency_code')
	{
		$currency_code_flag = 0;	
	}
}
if($ip_address_flag)
{
	$wpdb->query('ALTER TABLE `' . $ord_db_table_name . '` ADD `ip_address` VARCHAR( 255 ) NULL');	
}
if($currency_code_flag)
{
	$wpdb->query('ALTER TABLE `' . $ord_db_table_name . '` ADD `currency_code` VARCHAR( 255 ) NOT NULL AFTER `coupon_code`');
}


require_once (TEMPLATEPATH . '/library/functions/duplicate_posts.php'); // duplicat posts

//********PLEASE REMOVE COMMENT BELOW LINES TO CLEAR OLD DATA FROM DATABASE AND INSERT FRESH TABLE*********//
//include_once($functions_path.'order_table_cleaner.php'); //Delete Old order information and insert new order table
//include_once($functions_path.'shipping_table_cleaner.php'); //Delete Old shipping information and insert new order table
//include_once($functions_path.'tax_table_cleaner.php'); //Delete Old tax information and insert new order table
//********PLEASE REMOVE COMMENT ABOVE LINES TO CLEAR OLD DATA FROM DATABASE AND INSERT FRESH TABLE*********//


//** ADMINISTRATION FILES **//
// Theme admin functions
require_once (TEMPLATEPATH . '/admin/admin_functions.php');
// Theme admin options
require_once (TEMPLATEPATH . '/admin/admin_options.php');
// Theme admin Settings
require_once (TEMPLATEPATH . '/admin/admin_settings.php');
//** FRONT-END FILES **//

// Widgets
require_once ($functions_path . 'widgets_functions.php');
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/widgets_functions.php'))
{
	include(CHILDTEMPLATEPATH . '/widgets_functions.php');
}
// Custom
require_once ($functions_path . 'custom_functions.php');
// Comments
require_once ($functions_path . 'comments_functions.php');
// Yoast's plugins
//require_once ($functions_path . 'yoast-breadcrumbs.php');
//require_once ($functions_path . 'yoast-posts.php');
require_once ($functions_path . 'yoast-canonical.php');
require_once ($functions_path . 'yoast-breadcrumbs.php');

/////////shopping cart new function files
require($functions_path . "general_functions.php");
require($functions_path . "cart.php");
require($functions_path . "product.php");
require($functions_path . "custom.php");
require(TEMPLATEPATH . "/product_menu.php");
require($functions_path . "theme_ui.php");	
require(TEMPLATEPATH . "/message.php");
require(TEMPLATEPATH . "/library/captcha/captcha_function.php");
if($_GET['act']=='stateajax')
{
	global $wpdb,$state_db_table_name;
	$cid = $_REQUEST['cid'];
	$sid = $_REQUEST['sid'];
	$sql = "select state,title from $state_db_table_name where country=\"$cid\" order by title";
	$stateinfo = $wpdb->get_results($sql);
	$option_str = '<option value="">'. __('Todos os Estados').'</option>';
	foreach($stateinfo as $stateinfoObj)
	{
	 $state_id = $stateinfoObj->state;
	 $title = $stateinfoObj->title;
		if($sid==$state_id)
		{
			$option_str .= '<option value="'.$state_id.'" selected>'. $title.'</option>';
		}else
		{
			$option_str .= '<option value="'.$state_id.'">'. $title.'</option>';	 
		}	 
	}
	echo $option_str;
	exit;
}
if($_GET['act']=='stateajaxfrontend')
{
	global $wpdb,$state_db_table_name;
	$cid = $_REQUEST['cid'];
	$sid = $_REQUEST['sid'];
	$stype = $_REQUEST['stype'];
    $sql = "select s.state,s.title from $state_db_table_name as s ,$country_db_table_name as c where s.country=c.country and c.title='".$cid."' order by s.title";
	$stateinfo = $wpdb->get_results($sql);
	$option_str = '<select name="'.$stype.'"  id="'.$stype.'" class="reg_row_textfield"><option value="">'. __('Selecione um Estado').'</option>';
	foreach($stateinfo as $stateinfoObj)
	{
	 $title = $stateinfoObj->title;
		if($sid==$title)
		{
			$option_str .= '<option value="'.$title.'" selected>'. $title.'</option>';
		}else
		{
			$option_str .= '<option value="'.$title.'">'. $title.'</option>';	 
		}	 
	}
	$option_str .= '</select>';
	echo $option_str;
	exit;
}
?>