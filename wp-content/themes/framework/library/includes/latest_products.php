<?php get_header(); 
global $Product,$Cart,$General;
$itemsInCartCount = $Cart->cartCount();
$cartAmount = $Cart->getCartAmt();

if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/library/includes/latest_products_page.php'))
{
	include(CHILDTEMPLATEPATH . '/library/includes/latest_products_page.php');
}else
{
	include(TEMPLATEPATH . '/library/includes/latest_products_page.php');
}
?>