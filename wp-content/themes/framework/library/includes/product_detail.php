<?php 
session_start();
ob_start();
global $Product,$Cart, $General;
$data = get_post_meta( $post->ID, 'key', true );
$product_price = $Product->get_product_price($post->ID);
$product_cart_price = $Product->get_product_price_no_currency($post->ID);
$product_qty = $Product->get_product_qty($post->ID);
$product_size = $Product->get_product_custom_dl($post->ID,'size','size','',$themeUI->get_product_att1_title($data,0));
$product_color = $Product->get_product_custom_dl($post->ID,'color','color','',$themeUI->get_product_att2_title($data,0));
$product_attribute3 = $Product->get_product_custom_dl($post->ID,'attribute3','attribute3','',$themeUI->get_product_att3_title($data,0));
$product_attribute4 = $Product->get_product_custom_dl($post->ID,'attribute4','attribute4','',$themeUI->get_product_att4_title($data,0));
$product_attribute5 = $Product->get_product_custom_dl($post->ID,'attribute5','attribute5','',$themeUI->get_product_att5_title($data,0));
$product_attribute6 = $Product->get_product_custom_dl($post->ID,'attribute6','attribute6','',$themeUI->get_product_att6_title($data,0));
$product_attribute7 = $Product->get_product_custom_dl($post->ID,'attribute7','attribute7','',$themeUI->get_product_att7_title($data,0));
$product_attribute8 = $Product->get_product_custom_dl($post->ID,'attribute8','attribute8','',$themeUI->get_product_att8_title($data,0));
$product_attribute9 = $Product->get_product_custom_dl($post->ID,'attribute9','attribute9','',$themeUI->get_product_att9_title($data,0));
$product_attribute10 = $Product->get_product_custom_dl($post->ID,'attribute10','attribute10','',$themeUI->get_product_att10_title($data,0));
$product_tax = $General->get_product_tax();
$customarray = array('size','color');
?>
<?php get_header(); ?>
<?php $Product->get_js_header_prd_detail();?>
<?php
global $General;
$admin_layout_setting_option = 'ptthemes_product_detail_design_settings';
$sidebar_left_widget_option = 'Product Detail Sidebar Left';
$sidebar_right_widget_option = 'Product Detail Sidebar Right';
$middle_content_widget_option = '';
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/product_detail.php'))
{
	$middle_content_file_fullpath = CHILDTEMPLATEPATH . '/product_detail.php';
}else{
	$middle_content_file_fullpath = TEMPLATEPATH . "/library/includes/product_detail_page.php";
}
include_once(TEMPLATEPATH.'/site_layout_structure.php');
?> 
<?php get_footer(); ?>