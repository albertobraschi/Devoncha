<?php $Cart->is_shopping_cart_empty();//will redirect to empty cart page if no item in your bag  ?>

<?php get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery-1.2.6.min.js"></script>
   
     	<form method="post" name="checkout_frm" id="checkout_frm" action="<?php echo $General->get_ssl_normal_url(site_url()); ?>/?ptype=payment&paymentmethod=<?php echo $_SESSION['paymentmethod'];?>">
        <input type="hidden" name="checkout_as_guest" value="<?php echo $_REQUEST['checkout_as_guest'];?>" />
        <div id="page"> 
     	<h1 class="head"><?php _e(NORMAL_CHEKCOUT_PAGE_TITLE); ?></h1>
    <div class="breadcrumb clearfix">
      <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',' &raquo; '.__(NORMAL_CHEKCOUT_PAGE_TITLE)); } ?>
    </div>
    
     	
          <div id="checkout_content">
        
          <input type="hidden" name="coupon_code" value="<?php echo $_SESSION['couponcode'];?>" />
          <?php if($_GET['msg']=='nopaymethod'){ _e("<div style='color:red'>Select Payment method to continue.</div><br>");}?>
          <?php if($_GET['msg']=='emptyuser'){ _e("<div style='color:red'>Invalid User Name or Email.</div><br>");}?>
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
		if(file_exists(TEMPLATEPATH . '/library/includes/normal_checkout_page_comments.php'))
		{
			include_once(TEMPLATEPATH . '/library/includes/normal_checkout_page_comments.php');
		}
		?>
        <?php $General->show_term_and_condition(); //show term and condition checkbox with a syntex set from wp-admin->general settings?>
          <div class="button_bar" >
            <input type="hidden" name="shippingmethod" id="shippingmethod" value="<?php echo $_SESSION['shippingmethod'];?>" />
           <a  href="javascript:void(0);" onclick="history.back();" class="normal_input_btn fl"><?php _e('&laquo; '.BACK_BUTTON); ?></a> 
             <input type="submit" name="confirm" value="<?php _e(CONFIRM_BUTTON); ?> &raquo;" class="highlight_input_btn fr" onClick="return check_user_info();" />
            <!--<a  href="javascript:void(0);" onclick="document.checkout_frm.submit();" class="highlight_button  fr" >Confirm </a>-->
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
        </div>  <!-- content #end -->
       
      <?php
	if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_sidebar_above.php'))
	{
		include_once(CHILDTEMPLATEPATH . '/normal_checkout_sidebar_above.php');
	}
	?>
      <div id="checkout_sidebar">
        <?php
                 if($_SESSION['shippingmethod'])
				 {
				 ?>
        <div class="shipping_method">
          <p> <strong> <?php _e(SHIPPING_MEHTOD_TEXT); ?> : </strong> <br />
            <span class="method"> <?php echo $General->get_shipping_method('title');?> </span> </p>
        </div>
        <?php }?>
        <?php 
		if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/checkout_userinfo.php'))
		{
			include(CHILDTEMPLATEPATH . '/checkout_userinfo.php');
		}else
		{
			include(TEMPLATEPATH . '/library/includes/checkout_userinfo.php'); //product detail page
		}
		?>
        <?php //include_once(TEMPLATEPATH . '/library/includes/checkout_userinfo.php');  //checkout type single page?>
        <!-- checkout Address -->
        <div class="payment_method"><img src="<?php bloginfo('template_directory'); ?>/images/payment_method.png" alt=""   /> </div>
        
        <?php if ( function_exists('dynamic_sidebar') && (dynamic_sidebar('Checkout Page Sidebar Right')) ) { }?>
      </div>
   	<?php
	if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_sidebar_below.php'))
	{
		include_once(CHILDTEMPLATEPATH . '/normal_checkout_sidebar_below.php');
	}
	?>		
  	
  </div> 
  </form>
<!--  #end -->
<script type="application/javascript">
function  accepttermandconditions_top()
{
//PLEASE ENTER THE JAVASCRIPT CODE FOR THIS PAGE WHILE SUBMIT FORM TO CHECK BEFORE TERM AND CONDITON ALERT	
/*
if(1){alert(123);return true;}eles{return false;}
*/
return true;
}
function accepttermandconditions_bottom()
{
//PLEASE ENTER THE JAVASCRIPT CODE FOR THIS PAGE WHILE SUBMIT FORM TO CHECK AFTER TERM AND CONDITON ALERT
/*
if(1){alert(123);return true;}eles{return false;}
*/
return true;
}
</script>