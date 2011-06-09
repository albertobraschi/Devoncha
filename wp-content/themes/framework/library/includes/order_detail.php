<?php
global $Cart,$General,$wpdb;
$userInfo = $General->getLoginUserInfo();
if(!$userInfo)
{
	global $General;
	wp_redirect($General->get_url_login(site_url('/?ptype=login')));
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
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/order_detail_page.php'))
{
	$middle_content_file_fullpath = CHILDTEMPLATEPATH . '/order_detail_page.php';
}else{
	$middle_content_file_fullpath = TEMPLATEPATH . "/library/includes/order_detail_page.php";
}
include_once(TEMPLATEPATH.'/site_layout_structure.php');
?> 
<?php get_footer(); ?>