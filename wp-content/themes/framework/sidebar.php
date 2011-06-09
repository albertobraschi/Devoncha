<?php 
global $General,$Cart,$Product,$themeUI;
$itemsInCartCount = $Cart->cartCount();
$cartAmount = $Cart->getCartAmt();

if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/sidebar_page.php'))
{
	include(CHILDTEMPLATEPATH . '/sidebar_page.php');
}else
{
?>
<!--<div id="sidebar" class="grid_4 sidebar_left">-->
<div id="sidebar" class="grid_4 fr">
      <?php if ( function_exists('dynamic_sidebar') && (dynamic_sidebar('General Sidebar')) ) {} ?>
  <!-- widget #end -->
</div>
<!-- sidebar #end -->
<?php
}
?>