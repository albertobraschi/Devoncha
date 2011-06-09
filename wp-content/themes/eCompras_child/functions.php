<?php 
/*************************************************************
* Do not modify unless you know what you're doing, SERIOUSLY!
*************************************************************/
// Theme variables
global $wpdb;
$themename_child = 'eCompras Child';
define('CHILDTEMPLATEPATH',dirname(__FILE__));
$child_functions_path = CHILDTEMPLATEPATH. '/library/functions/';
require_once (TEMPLATEPATH . '/library/functions/theme_variables.php');
// Theme admin functions
require_once (TEMPLATEPATH . '/admin/admin_functions.php');
// Theme admin options
//require_once ($child_functions_path . 'admin_options.php');
require_once (CHILDTEMPLATEPATH . '/child_language.php');

//load_theme_textdomain('default');
//load_textdomain( 'default', CHILDTEMPLATEPATH.'/en_US.mo' );  //UNCOMMENT THE PHP CODE. ENSURE YOUR LANGUAGE MO FILE IS AT ROOT OF THEME FOLDER AND YOU HAVE CHANGED THE mo FILE NAME IN THIS CODE

if('themes.php' == basename($_SERVER['SCRIPT_FILENAME']) && $_REQUEST['activated']=='true') 
{
	add_action( 'after_setup_theme', 'ecommerce_frmwork_child_setup' );
}
if(!function_exists( 'ecommerce_frmwork_child_setup' ) ){
function ecommerce_frmwork_child_setup()
{
	global $wpdb;
	$dummy_image_path = get_stylesheet_directory_uri().'/images/dummy/';	
	update_option("ptthemes_add_to_cart_button_position",'Below Description');
	update_option("ptthemes_related_prd_single",'Show');
	update_option("ptthemes_related_prd_number",'4');
	update_option("ptthemes_home_design_settings",'Full page');
	update_option("ptthemes_inner_design_settings",'With Right Sidebar');
	update_option("ptthemes_product_design_settings",'With Right Sidebar');///
	update_option("ptthemes_blog_design_settings",'With Right Sidebar');///
	update_option("ptthemes_product_detail_design_settings",'With Right Sidebar');///
	update_option("ptthemes_blog_detail_design_settings",'With Right Sidebar');
	update_option("ptthemes_store_design_settings",'With Right Sidebar');
	update_option("ptthemes_cart_design_settings",'With Right Sidebar');
	update_option("ptthemes_checkout_design_settings",'With Right Sidebar');
	update_option("ptthemes_all_pages_settings",'With Right Sidebar');
	update_option("ptthemes_image_width",'150');
	update_option("ptthemes_image_height",'150');
	update_option("ptthemes_prd_listing_format",'grid');
	update_option("ptthemes_storeprd_number",'16');
	update_option("ptthemes_prdlisttitle_showhide",'true');
	update_option("ptthemes_prdlisttitle_order",'2');
	update_option("ptthemes_prdlistimage_showhide",'true');
	update_option("ptthemes_prdlistimage_border",'true');
	update_option("ptthemes_prdlistprice_showhide",'true');
	update_option("ptthemes_prdlistprice_order",'3');
	update_option("ptthemes_prdlistcontent_showhide",'true');
	update_option("ptthemes_prdlistcontent_order",'4');
	update_option("ptthemes_prdlistbutton_showhide",'true');
	update_option("ptthemes_prdlistbutton_order",'5');
	update_option("ptthemes_storelink_display",'Show');
	
/////////////// WIDGET SETTINGS START ///////////////

$latest_info = array();
$latest_info[1] = array(
					"title"				=>	'Latest Products',
					"display_prds_no"	=>	'10',
					"list_type"			=>	'Grid',
					"show_store_link"	=>	'#',
					"image_width"		=>	'150',
					"image_height"		=>	'150',
					);
$latest_info['_multiwidget'] = '1';

update_option('widget_latest_product_info',$latest_info);
$latest_info = get_option('widget_latest_product_info');
krsort($latest_info);
foreach($latest_info as $key1=>$val1)
{
	$latest_info_key = $key1;
	if(is_int($latest_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-3"] = array('latest_product_info-'.$latest_info_key);
$recent_info = array();
$recent_info[1] = array(
					"title"				=>	'',
					"number"			=>	'5',
					);
$recent_info['_multiwidget'] = '1';

update_option('widget_recent-posts',$recent_info);
$recent_info = get_option('widget_recent-posts');
krsort($recent_info);
foreach($recent_info as $key1=>$val1)
{
	$recent_info_key = $key1;
	if(is_int($recent_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-5"] = array('recent-posts-'.$recent_info_key);
$recent_info = array();
$recent_info = get_option('widget_recent-posts');
$recent_info[3] = array(
					"title"				=>	'',
					"number"			=>	'5',
					);
$recent_info['_multiwidget'] = '1';

update_option('widget_recent-posts',$recent_info);
$recent_info = get_option('widget_recent-posts');
krsort($recent_info);
foreach($recent_info as $key1=>$val1)
{
	$recent_info_key = $key1;
	if(is_int($recent_info_key))
	{
		break;
	}
}
$comments_info = array();
$comments_info = get_option('widget_recent-comments');
$comments_info[2] = array(
					"title"				=>	'Recent Comments',
					"number"				=>	'5',
					);
$comments_info['_multiwidget'] = '1';

update_option('widget_recent-comments',$comments_info);
$comments_info = get_option('widget_recent-comments');
krsort($comments_info);
foreach($comments_info as $key1=>$val1)
{
	$comments_info_key = $key1;
	if(is_int($comments_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-8"] = array('recent-posts-'.$recent_info_key,'recent-comments-'.$comments_info_key);
$recent_info = array();
$recent_info = get_option('widget_recent-posts');
$recent_info[2] = array(
					"title"				=>	'',
					"number"			=>	'5',
					);
$recent_info['_multiwidget'] = '1';

update_option('widget_recent-posts',$recent_info);
$recent_info = get_option('widget_recent-posts');
krsort($recent_info);
foreach($recent_info as $key1=>$val1)
{
	$recent_info_key = $key1;
	if(is_int($recent_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-7"] = array('recent-posts-'.$recent_info_key);

$cart_info = array();
$cart_info[1] = array(
					"title"				=>	'Shopping Cart',
					);
$cart_info['_multiwidget'] = '1';

update_option('widget_shopping_cart_info',$cart_info);
$cart_info = get_option('widget_shopping_cart_info');
krsort($cart_info);
foreach($cart_info as $key1=>$val1)
{
	$cart_info_key = $key1;
	if(is_int($cart_info_key))
	{
		break;
	}
}
$cat_info = array();
$cat_info[1] = array(
					"title"				=>	'Our Products',
					);
$cat_info['_multiwidget'] = '1';

update_option('widget_browse_by_cats',$cat_info);
$cat_info = get_option('widget_browse_by_cats');
krsort($cat_info);
foreach($cat_info as $key1=>$val1)
{
	$cat_info_key = $key1;
	if(is_int($cat_info_key))
	{
		break;
	}
}
$links_info = array();
$links_comments_info[1] = array(
					"images"			=>	'1',
					"name"			 	=>	'1',
					"description"		 =>	'1',
					"rating"			 =>	'0',
					"category"			 =>	'0',
					);
$links_comments_info['_multiwidget'] = '1';
update_option('widget_links',$links_comments_info);
$links_comments_info = get_option('widget_links');
krsort($links_comments_info);
foreach($links_comments_info as $key1=>$val1)
{
	$links_info_key = $key1;
	if(is_int($links_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-6"] = array('shopping_cart_info-'.$cart_info_key,'browse_by_cats-'.$cat_info_key,'links-'.$links_info_key);
$srch_info = array();
$srch_info[1] = array(
					"title"				=>	'Search',
					);
$srch_info['_multiwidget'] = '1';

update_option('widget_search',$srch_info);
$srch_info = get_option('widget_search');
krsort($srch_info);
foreach($srch_info as $key1=>$val1)
{
	$srch_info_key = $key1;
	if(is_int($srch_info_key))
	{
		break;
	}
}
$popularposts_info = array();
$popularposts_info = array(
					"name"				=>	'Popular Post',
					"number"			=>	'5',
					);

update_option('widget_popularposts',$popularposts_info);
$popularposts_info = get_option('widget_popularposts');

$wp_sidebar_widgets["sidebar-9"] = array('pt-popular-posts','search-'.$srch_info_key);
$cart_info = array();
$cart_info = get_option('widget_shopping_cart_info');
$cart_info[2] = array(
					"title"				=>	'Shopping Cart',
					);
$cart_info['_multiwidget'] = '1';

update_option('widget_shopping_cart_info',$cart_info);
$cart_info = get_option('widget_shopping_cart_info');
krsort($cart_info);
foreach($cart_info as $key1=>$val1)
{
	$cart_info_key = $key1;
	if(is_int($cart_info_key))
	{
		break;
	}
}
$category_info = array();
$category_info[1] = array(
					"title"				=>	'Categories',
					"count"				=>	'0',
					"hierarchical"		=>	'0',
					"dropdown"			=>	'0',
					);
$category_info['_multiwidget'] = '1';

update_option('widget_categories',$category_info);
$category_info = get_option('widget_categories');
krsort($category_info);
foreach($category_info as $key1=>$val1)
{
	$category_info_key = $key1;
	if(is_int($category_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-10"] = array('shopping_cart_info-'.$cart_info_key,'categories-'.$category_info_key);
$cat_info = array();
$cat_info = get_option('widget_browse_by_cats');
$cat_info[2] = array(
					"title"				=>	'Our Products',
					);
$cat_info['_multiwidget'] = '1';

update_option('widget_browse_by_cats',$cat_info);
$cat_info = get_option('widget_browse_by_cats');
krsort($cat_info);
foreach($cat_info as $key1=>$val1)
{
	$cat_info_key = $key1;
	if(is_int($cat_info_key))
	{
		break;
	}
}
$comments_info = array();
$comments_info[1] = array(
					"title"				=>	'Recent Comments',
					"number"				=>	'5',
					);
$comments_info['_multiwidget'] = '1';

update_option('widget_recent-comments',$comments_info);
$comments_info = get_option('widget_recent-comments');
krsort($comments_info);
foreach($comments_info as $key1=>$val1)
{
	$comments_info_key = $key1;
	if(is_int($comments_info_key))
	{
		break;
	}
}

$wp_sidebar_widgets["sidebar-11"] = array('recent-comments-'.$comments_info_key,'browse_by_cats-'.$cat_info_key);
$recent_info = array();
$recent_info = get_option('widget_recent-posts');
$recent_info[3] = array(
					"title"				=>	'',
					"number"			=>	'5',
					);
$recent_info['_multiwidget'] = '1';

update_option('widget_recent-posts',$recent_info);
$recent_info = get_option('widget_recent-posts');
krsort($recent_info);
foreach($recent_info as $key1=>$val1)
{
	$recent_info_key = $key1;
	if(is_int($recent_info_key))
	{
		break;
	}
}
$comments_info = array();
$comments_info = get_option('widget_recent-comments');
$comments_info[2] = array(
					"title"				=>	'Recent Comments',
					"number"				=>	'5',
					);
$comments_info['_multiwidget'] = '1';

update_option('widget_recent-comments',$comments_info);
$comments_info = get_option('widget_recent-comments');
krsort($comments_info);
foreach($comments_info as $key1=>$val1)
{
	$comments_info_key = $key1;
	if(is_int($comments_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-12"] = array('recent-posts-'.$recent_info_key,'recent-comments-'.$comments_info_key);


$category_info = array();
$category_info = get_option('widget_categories');
$category_info[2] = array(
					"title"				=>	'Categories',
					"count"				=>	'0',
					"hierarchical"		=>	'0',
					"dropdown"			=>	'0',
					);
$category_info['_multiwidget'] = '1';

update_option('widget_categories',$category_info);

$category_info = get_option('widget_categories');
krsort($category_info);
foreach($category_info as $key1=>$val1)
{
	$category_info_key = $key1;
	if(is_int($category_info_key))
	{
		break;
	}
}
//'categories-'.$category_info_key
$archive_info = array();
$archive_info[1] = array(
					"title"				=>	'Archives',
					"count"				=>	'0',
					"dropdown"			=>	'0',
					);
$archive_info['_multiwidget'] = '1';

update_option('widget_archives',$archive_info);
$archive_info = get_option('widget_archives');
krsort($archive_info);
foreach($archive_info as $key1=>$val1)
{
	$archive_info_key = $key1;
	if(is_int($archive_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-14"] = array('categories-'.$category_info_key,'archives-'.$archive_info_key);

$text_info = array();
$text_info[1] = array(
					"title"				=>	'About Us',
					"text"				=>	'<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor.</p>',
					);
$text_info['_multiwidget'] = '1';

update_option('widget_text',$text_info);
$text_info = get_option('widget_text');
krsort($text_info);
foreach($text_info as $key1=>$val1)
{
	$text_info_key = $key1;
	if(is_int($text_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-15"] = array('text-'.$text_info_key);
$archive_info = array();
$archive_info = get_option('widget_archives');
$archive_info[2] = array(
					"title"				=>	'Archives',
					"count"				=>	'0',
					"dropdown"			=>	'0',
					);
$archive_info['_multiwidget'] = '1';

update_option('widget_archives',$archive_info);
$archive_info = get_option('widget_archives');
krsort($archive_info);
foreach($archive_info as $key1=>$val1)
{
	$archive_info_key = $key1;
	if(is_int($archive_info_key))
	{
		break;
	}
}
$category_info = array();
$category_info = get_option('widget_categories');
$category_info[2] = array(
					"title"				=>	'Categories',
					"count"				=>	'0',
					"hierarchical"		=>	'0',
					"dropdown"			=>	'0',
					);
$category_info['_multiwidget'] = '1';

update_option('widget_categories',$category_info);
$category_info = get_option('widget_categories');
krsort($category_info);
foreach($category_info as $key1=>$val1)
{
	$category_info_key = $key1;
	if(is_int($category_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-16"] = array('archives-'.$archive_info_key,'categories-'.$category_info_key);
$links_info = array();
$links_comments_info = get_option('widget_links');
$links_comments_info[2] = array(
					"images"			=>	'1',
					"name"			 	=>	'1',
					"description"		 =>	'1',
					"rating"			 =>	'0',
					"category"			 =>	'0',
					);
$links_comments_info['_multiwidget'] = '1';
update_option('widget_links',$links_comments_info);
$links_comments_info = get_option('widget_links');
krsort($links_comments_info);
foreach($links_comments_info as $key1=>$val1)
{
	$links_info_key = $key1;
	if(is_int($links_info_key))
	{
		break;
	}
}
$srch_info = array();
$srch_info = get_option('widget_search');
$srch_info[2] = array(
					"title"				=>	'Search',
					);
$srch_info['_multiwidget'] = '1';

update_option('widget_search',$srch_info);
$srch_info = get_option('widget_search');
krsort($srch_info);
foreach($srch_info as $key1=>$val1)
{
	$srch_info_key = $key1;
	if(is_int($srch_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-17"] = array('links-'.$links_info_key,'search-'.$srch_info_key);
$cat_info = array();
$cat_info = get_option('widget_browse_by_cats');
$cat_info[3] = array(
					"title"				=>	'Our Products',
					);
$cat_info['_multiwidget'] = '1';

update_option('widget_browse_by_cats',$cat_info);
$cat_info = get_option('widget_browse_by_cats');
krsort($cat_info);
foreach($cat_info as $key1=>$val1)
{
	$cat_info_key = $key1;
	if(is_int($cat_info_key))
	{
		break;
	}
}
$text_info = array();
$text_info = get_option('widget_text');
$text_info[2] = array(
					"title"				=>	'Payment Method',
					"text"				=>	'<p>Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis.  </p>',
					);
$text_info['_multiwidget'] = '1';

update_option('widget_text',$text_info);
$text_info = get_option('widget_text');
krsort($text_info);
foreach($text_info as $key1=>$val1)
{
	$text_info_key = $key1;
	if(is_int($text_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-18"] = array('browse_by_cats-'.$cat_info_key,'text-'.$text_info_key);
$cart_info = array();
$cart_info = get_option('widget_shopping_cart_info');
$cart_info[3] = array(
					"title"				=>	'Shopping Cart',
					);
$cart_info['_multiwidget'] = '1';

update_option('widget_shopping_cart_info',$cart_info);
$cart_info = get_option('widget_shopping_cart_info');
krsort($cart_info);
foreach($cart_info as $key1=>$val1)
{
	$cart_info_key = $key1;
	if(is_int($cart_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-28"] = array('shopping_cart_info-'.$cart_info_key);
$feature_cat_name = 'Feature';
$feature_cat_id = $wpdb->get_var("SELECT term_id FROM $wpdb->terms where name=\"$feature_cat_name\"");
$home_slider_info[1] = array(
					"title"				=>	'Slider',
					"category"			=>	$feature_cat_id,
					"post_number"		=>	'5',
					"post_link"			=>	'',
					"auto_rotate"		=>	'Yes',
					"speed"				=>	'5000',
					"image_width"		=>	'250',
					"image_height"		=>	'250',
					"content_lenght"	=>	'350',
					);
$home_slider_info['_multiwidget'] = '1';

update_option('widget_widget_posts1',$home_slider_info);
$home_slider_widget_info = get_option('widget_widget_posts1');
krsort($home_slider_widget_info);
foreach($home_slider_widget_info as $key1=>$val1)
{
	$home_slider_widget_info_key = $key1;
	if(is_int($home_slider_widget_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-29"] = array('widget_posts1-'.$home_slider_widget_info_key);
$text_info = array();
$text_info[1] = array(
					"title"				=>	'',
					"advt1"				=>	$dummy_image_path.'ad-290x300.png',
					"advt_link1"		=>	'http://www.addfiorese.com.br',
					);
$text_info['_multiwidget'] = '1';

update_option('widget_widget_text',$text_info);
$text_info = get_option('widget_widget_text');
krsort($text_info);
foreach($text_info as $key1=>$val1)
{
	$text_info_key = $key1;
	if(is_int($text_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-30"] = array('widget_text-'.$text_info_key);
update_option('sidebars_widgets',$wp_sidebar_widgets);
//echo "<pre>";
//print_r(get_option('widget_widget_posts1'));
//print_r(get_option('widget_widget_posts1'));
//print_r(get_option('widget_widget_text'));
/////////////// WIDGET SETTINGS END ///////////////

}
}
////////////////////////////////////////////////////////////////
///IF YOU DON'T WANT DEFAULT DATA/DUMMY DATA INSERT CODE, PLEASE REMOVE THIS CODE
////////////DUMMY DATA INSERT CODE START////
function autoinstall_admin_header()
{
	global $wpdb;
	if('themes.php' == basename($_SERVER['SCRIPT_FILENAME']) && $_REQUEST['template']=='' && $_GET['page']=='') 
	{
	if($_REQUEST['dummy']=='del')
	{
		delete_dummy_data();	
		$dummy_deleted = '<p><b>All Dummy data has been removed from your database successfully!</b></p>';
	}
	if($_REQUEST['dummy_insert'])
	{
		require_once (CHILDTEMPLATEPATH . '/auto_install.php');
	}
	if($_REQUEST['activated']=='true')
	{
		$theme_actived_success = '<p class="message">Theme activated successfully.</p>';	
	}
	$post_counts = $wpdb->get_var("select count(post_id) from $wpdb->postmeta where (meta_key='pt_dummy_content' || meta_key='tl_dummy_content') and meta_value=1");
	if($post_counts>0)
	{
		$dummy_data_msg = '<p> <b>Sample data has been populated on your site. Wish to delete sample data?</b> <br />  <a class="button_delete" href="'.get_option('siteurl').'/wp-admin/themes.php?dummy=del">Yes Delete Please!</a><p>';
	}else
	{
		$dummy_data_msg = '<p> <b>Would you like to auto install this theme and populate sample data on your site?</b> <br />  <a class="button_insert" href="'.get_option('siteurl').'/wp-admin/themes.php?dummy_insert=1">Yes, insert sample data please</a></p>';
	}
	
	
	$theme_active_message = '
	<style>
	.highlight { width:60% !important; background:#FFFFE0 !important; overflow:hidden; display:table; border:2px solid #558e23 !important; padding:15px 20px 0px 20px !important; -moz-border-radius:11px  !important;  -webkit-border-radius:11px  !important;   } 
	.highlight p { color:#444 !important; font:15px Arial, Helvetica, sans-serif !important; text-align:center;  } 
	.highlight p.message { font-size:13px !important; }
	.highlight p a { color:#ff7e00; text-decoration:none !important; } 
	.highlight p a:hover { color:#000; }
	.highlight p a.button_insert 
		{ display:block; width:230px; margin:10px auto 0 auto;  background:#5aa145; padding:10px 15px; color:#fff; border:1px solid #4c9a35; -moz-border-radius:5px;  -webkit-border-radius:5px;  } 
	.highlight p a:hover.button_insert { background:#347c1e; color:#fff; border:1px solid #4c9a35;   } 
	.highlight p a.button_delete 
		{ display:block; width:140px; margin:10px auto 0 auto; background:#dd4401; padding:10px 15px; color:#fff; border:1px solid #9e3000; -moz-border-radius:5px;  -webkit-border-radius:5px;  } 
	.highlight p a:hover.button_delete { background:#c43e03; color:#fff; border:1px solid #9e3000;   } 
	#message0 { display:none !important;  }
	
	
	</style>
	<div class="updated highlight fade"> '.$theme_actived_success.$dummy_deleted.$dummy_data_msg.'</div>';
	echo $theme_active_message;	
	}
}
add_action("admin_head", "autoinstall_admin_header"); // please comment this line if you wish to DEACTIVE SAMPLE DATA INSERT.
function delete_dummy_data()
{
	global $wpdb;
	delete_option('sidebars_widgets'); //delete widgets
	$productArray = array();
	$pids_sql = "select p.ID from $wpdb->posts p join $wpdb->postmeta pm on pm.post_id=p.ID where (meta_key='pt_dummy_content' || meta_key='tl_dummy_content') and meta_value=1";
	$pids_info = $wpdb->get_results($pids_sql);
	foreach($pids_info as $pids_info_obj)
	{
		wp_delete_post($pids_info_obj->ID);
	}
}
////////////DUMMY DATA INSERT CODE END////
?>