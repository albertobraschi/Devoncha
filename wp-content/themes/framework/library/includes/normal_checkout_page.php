<?php $Cart->is_shopping_cart_empty();//will redirect to empty cart page if no item in your bag  ?>
<?php get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery-1.2.6.min.js"></script>
 <div class="checkout_page">
 <h1 class="head"><?php _e(NORMAL_CHEKCOUT_PAGE_TITLE); ?></h1>
<div class="breadcrumb clearfix">
  <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',' &raquo; '.__(NORMAL_CHEKCOUT_PAGE_TITLE)); } ?>
</div>
<div id="checkout_content">
<form method="post" name="checkout_frm" id="checkout_frm" action="<?php echo $General->get_ssl_normal_url(site_url('/?ptype=payment&paymentmethod='.$_POST['paymentmethod'])); ?>">
  <input type="hidden" name="coupon_code" value="<?php echo $_SESSION['couponcode'];?>" />
  <?php if($_GET['msg']=='nopaymethod'){ echo "<div style='color:red'>".SELECT_PAYMETHOD_MSG."</div><br>";}?>
  <?php $General->display_message_checkcout(); ?>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_page_payment_above.php'))
{
	include_once(CHILDTEMPLATEPATH . '/normal_checkout_page_payment_above.php');
}
?>  
<?php 
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_page_payment.php'))
{
	include(CHILDTEMPLATEPATH . '/normal_checkout_page_payment.php');
}else
{
	include(TEMPLATEPATH . '/library/includes/normal_checkout_page_payment.php'); //product detail page
}
?>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_page_cartdetail_above.php'))
{
	include_once(CHILDTEMPLATEPATH . '/normal_checkout_page_cartdetail_above.php');
}
?>  
<?php 
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_page_cartdetail.php'))
{
	include(CHILDTEMPLATEPATH . '/normal_checkout_page_cartdetail.php');
}else
{
	include(TEMPLATEPATH . '/library/includes/normal_checkout_page_cartdetail.php'); //product detail page
}
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_page_comments.php'))
{
	include(CHILDTEMPLATEPATH . '/normal_checkout_page_comments.php');
}else
if(file_exists(TEMPLATEPATH . '/library/includes/normal_checkout_page_comments.php'))
{
	include_once(TEMPLATEPATH . '/library/includes/normal_checkout_page_comments.php');
}
?>
 <?php $General->show_term_and_condition(); //show term and condition checkbox with a syntex set from wp-admin->general settings?>
  <div class="button_bar" >
    <input type="hidden" name="shippingmethod" id="shippingmethod" value="<?php echo $_SESSION['shippingmethod'];?>" />
     <a  href="javascript:void(0);" onclick="history.back();" class="normal_input_btn fl"><?php _e(''.BACK_BUTTON); ?></a>
    <input type="submit" name="confirm" value="<?php echo CONFIRM_BUTTON; ?> &raquo;" class="highlight_input_btn fr" onclick="return accepttermandconditions();" />
</div>
<?php
if(file_exists(TEMPLATEPATH . '/library/includes/normal_checkout_page_cartdetail_checkoutbutton.php'))
{
	include_once(TEMPLATEPATH . '/library/includes/normal_checkout_page_cartdetail_checkoutbutton.php');
}		
?>
 <?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_page_cartdetail_checkoutbutton.php'))
{
	include_once(CHILDTEMPLATEPATH . '/normal_checkout_page_cartdetail_checkoutbutton.php');
}
?>
</form>
</div> <!-- content #end -->
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_sidebar_above.php'))
{
	include_once(CHILDTEMPLATEPATH . '/normal_checkout_sidebar_above.php');
}
?> 
 <?php 
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_sidebar.php'))
{
	include(CHILDTEMPLATEPATH . '/normal_checkout_sidebar.php');
}else
{
	include(TEMPLATEPATH . '/library/includes/normal_checkout_sidebar.php'); //product detail page
}
?>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_sidebar_below.php'))
{
	include_once(CHILDTEMPLATEPATH . '/normal_checkout_sidebar_below.php');
}
?>
</div>
<script type="application/javascript">
function  accepttermandconditions_top(){return true;}
function accepttermandconditions_bottom(){return true;}
</script>