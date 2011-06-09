<?php 
session_start();
ob_start();
global $Cart,$General;
$_REQUEST['coupon_code'] = $_REQUEST['eval_coupon_code'];
$_SESSION['checkout_as_guest'] = $_REQUEST['checkout_as_guest']; 
$shippingmehod_arr = $General->get_shipping_method();
if($shippingmehod_arr)
{
	$shippingmethod_code = $shippingmehod_arr->shipping_id;
	$shippingmethod = $shippingmehod_arr;
	$shipping_amt = $General->get_shipping_amt($Cart->getCartAmt_physical_prd(array(),array('freeshiping'=>1)));
	$payable_amt = $General->get_payable_amount($shippingmethod_code);
}
$_SESSION['shippingmethod'] = $shippingmethod_code;
$itemsInCartCount = $Cart->cartCount();
$cartInfo = $Cart->getcartInfo();
$grandTotal = $General->get_amount_format($Cart->getCartAmt());
$product_tax = $General->get_product_tax();
$taxable_amt_info = $General->get_tax_amount_included();
if($taxable_amt_info[0]>0)
{
	$taxable_amt = $taxable_amt_info[0];
	$taxable_info_desc = $taxable_amt_info[1];
}else
{
	$taxable_amt_info = $General->get_tax_amount();
	$taxable_amt = $taxable_amt_info[0];
	$taxable_info_desc = $taxable_amt_info[1];

}
$payable_amt = $General->get_payable_amount();
$couponInfo = $General->get_coupon_deduction();
$cart_discount_amt = $General->get_amount_format($General->get_discount_amount($_SESSION['couponcode'],$Cart->getCartAmt_discountable()));
get_header();
$admin_layout_setting_option = 'ptthemes_cart_design_settings';
$sidebar_left_widget_option = 'My Cart Sidebar Left';
$sidebar_right_widget_option = 'My Cart Sidebar Right';
$middle_content_widget_option = '';

if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/cart_detail_page.php'))
{
	$middle_content_file_fullpath = CHILDTEMPLATEPATH . '/cart_detail_page.php';
}else{
	$middle_content_file_fullpath = TEMPLATEPATH . "/library/includes/cart_detail_page.php";
}
include_once(TEMPLATEPATH.'/site_layout_structure.php');
get_footer();
?>