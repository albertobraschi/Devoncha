<?php
global $Cart,$General;
$itemsInCartCount = $Cart->cartCount();
$grandTotal = $General->get_amount_format($Cart->getCartAmt());
$userInfo = $General->getLoginUserInfo();
$cartInfo = $Cart->getcartInfo();
$product_tax = $General->get_product_tax();
$taxable_amt_info = $General->get_tax_amount();
$taxable_amt = $taxable_amt_info[0];
$taxable_info_desc = $taxable_amt_info[1];
$payable_amt = $General->get_payable_amount();
$discount_amt = $General->get_amount_format($General->get_discount_amount($_SESSION['couponcode'],$Cart->getCartAmt_discountable()));
$discount_info = $General->get_discount_info($_SESSION['couponcode']);
$_SESSION['redirect_page'] = '';
$_SESSION['checkout_as_guest'] = $_REQUEST['checkout_as_guest']; 
if($_SESSION['couponcode'])
{
	if(!$General->is_valid_couponcode($_SESSION['couponcode']))
	{
		wp_redirect(site_url('/?ptype=cart&msg=invalidcoupon'));
		exit;
	}
}
global $current_user;
$user_address_info = $current_user->data->user_address_info;
if($_SESSION['checkout_as_guest'] == '') //simple checkout
{
	if(!$userInfo)
	{
		$_SESSION['redirect_page'] = $_SERVER['QUERY_STRING'];
		global $General;
		wp_redirect($General->get_url_login(site_url('/?ptype=login')));
		exit;
	}else
	{
		$file_name = 'normal_checkout.php';
		//include_once(TEMPLATEPATH . '/library/includes/normal_checkout.php');  //checkout type normal
	}
}else  //single page checkout
{
	$file_name = 'single_checkout.php';
	//include_once(TEMPLATEPATH . '/library/includes/single_checkout.php');  //checkout type single page
}
?>

<?php get_header(); ?>
<?php
global $General;
$admin_layout_setting_option = 'ptthemes_checkout_design_settings';
$sidebar_left_widget_option = 'All Pages Sidebar Left';
$sidebar_right_widget_option = 'All Pages Sidebar Right';
$middle_content_widget_option = '';
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . "/$file_name"))
{
	$middle_content_file_fullpath = CHILDTEMPLATEPATH . "/$file_name";
}else{
	$middle_content_file_fullpath = TEMPLATEPATH . "/library/includes/$file_name";
}
include_once(TEMPLATEPATH.'/site_layout_structure.php');
?> 
<?php get_footer(); ?>