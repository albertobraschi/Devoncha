<?php get_header(); ?>
<?php
global $General;
$admin_layout_setting_option = 'ptthemes_blog_detail_design_settings';
$sidebar_left_widget_option = 'Blog Detail Sidebar Left';
$sidebar_right_widget_option = 'Blog Detail Sidebar Right';
$middle_content_widget_option = '';
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/blog_detail.php'))
{
	$middle_content_file_fullpath = CHILDTEMPLATEPATH . '/blog_detail.php';
}else{
	$middle_content_file_fullpath = TEMPLATEPATH . "/library/includes/blog_detail_page.php";
}
include_once(TEMPLATEPATH.'/site_layout_structure.php');
?> 
<?php get_footer(); ?>