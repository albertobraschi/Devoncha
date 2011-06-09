<?php get_header(); ?>
<?php
global $General;
$admin_layout_setting_option = 'ptthemes_inner_design_settings';
$sidebar_left_widget_option = 'Inner Page Sidebar Left';
$sidebar_right_widget_option = 'Inner Page Sidebar Right';
$middle_content_widget_option = '';
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/ordersuccess_page.php'))
{
	$middle_content_file_fullpath = CHILDTEMPLATEPATH . '/ordersuccess_page.php';
}else{
	$middle_content_file_fullpath = TEMPLATEPATH . "/library/includes/ordersuccess_page.php";
}
include_once(TEMPLATEPATH.'/site_layout_structure.php');
?>
<?php get_footer(); ?>