<?php
$blogCatArray = $General->get_blog_sub_cats_str();
$cat = intval( get_query_var('cat') );
global $Product,$Cart,$General;
if(is_tag())
{
get_header();
	
global $General;
$admin_layout_setting_option = 'ptthemes_blog_design_settings';
$sidebar_left_widget_option = 'Blog Listing Sidebar Left';
$sidebar_right_widget_option = 'Blog Listing Sidebar Right';
$middle_content_widget_option = '';

	$middle_content_file_fullpath = TEMPLATEPATH . '/tags.php';

include_once(TEMPLATEPATH.'/site_layout_structure.php');

 get_footer();
		
}else
{
	if(in_array($cat,$blogCatArray))
	{
		include(TEMPLATEPATH . '/blog_listing.php');
	}else
	{
		include(TEMPLATEPATH . '/product_listing.php');
	}
}

?>
