<?php
global $Cart,$General,$wpdb,$wpdb,$prd_db_table_name,$ord_db_table_name;
$userInfo = $General->getLoginUserInfo();
if(!$userInfo)
{
	wp_redirect($General->get_url_login(site_url()).'/?ptype=login');
	exit;
}
?>
<?php get_header(); ?>
<?php
global $General;
$admin_layout_setting_option = 'ptthemes_all_pages_settings';
$sidebar_left_widget_option = 'All Pages Sidebar Left';
$sidebar_right_widget_option = 'All Pages Sidebar Right';
$middle_content_widget_option = '';
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/my_account.php'))
{
	$middle_content_file_fullpath = CHILDTEMPLATEPATH . '/my_account.php';
}else{
	$middle_content_file_fullpath = TEMPLATEPATH . "/library/includes/my_account.php";
}
include_once(TEMPLATEPATH.'/site_layout_structure.php');
?> 
<?php get_footer(); ?>