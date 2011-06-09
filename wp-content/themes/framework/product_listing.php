<?php
/*
Template Name: Product Listing Page
*/
?>
<?php get_header(); ?>
<?php
global $General;
$admin_layout_setting_option = 'ptthemes_product_design_settings';
$sidebar_left_widget_option = 'Product Listing Sidebar Left';
$sidebar_right_widget_option = 'Product Listing Sidebar Right';
$middle_content_widget_option = '';
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/product_listing.php'))
{
	$middle_content_file_fullpath = CHILDTEMPLATEPATH . '/product_listing.php';
}else{
	$middle_content_file_fullpath = TEMPLATEPATH . "/library/includes/product_listing_page.php";
}
include_once(TEMPLATEPATH.'/site_layout_structure.php');
?> 
<?php get_footer(); ?>
