<?php get_header(); 

global $Product,$Cart,$General;
$itemsInCartCount = $Cart->cartCount();
$cartAmount = $Cart->getCartAmt();
$admin_layout_setting_option = 'ptthemes_home_design_settings';
$header_widget_option = 'Front Page Slider';
$header_file_fullpath = '';
$sidebar_left_widget_option = 'Front Page Sidebar Left';
$sidebar_right_widget_option = 'Front Page Sidebar Right';
$middle_content_widget_option = 'Front Page Middle Content';
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/home_page.php'))
{
	$middle_content_file_fullpath = CHILDTEMPLATEPATH . '/home_page.php';
}else{
	$middle_content_file_fullpath = "";
}
include_once(TEMPLATEPATH.'/site_layout_structure.php');
get_footer(); ?>