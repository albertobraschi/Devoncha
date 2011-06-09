<?php get_header(); ?>
<?php
global $General;
$admin_layout_setting_option = 'ptthemes_checkout_design_settings';
$sidebar_left_widget_option = 'All Pages Sidebar Left';
$sidebar_right_widget_option = 'All Pages Sidebar Right';
$middle_content_widget_option = '';
$file_name = 'payment_cancel.php';;
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . "/$file_name"))
{
	$middle_content_file_fullpath = CHILDTEMPLATEPATH . "/$file_name";
}else{
	$middle_content_file_fullpath = TEMPLATEPATH . "/library/includes/$file_name";
}
include_once(TEMPLATEPATH.'/site_layout_structure.php');
?> 
<?php get_footer(); ?>
 
   