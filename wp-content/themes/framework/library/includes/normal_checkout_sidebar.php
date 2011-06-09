<div id="checkout_sidebar">
<?php 
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_sidebar_begin_sidebar.php'))
{
	include(CHILDTEMPLATEPATH . '/normal_checkout_sidebar_begin_sidebar.php');
}
?>
<?php
if($_SESSION['shippingmethod'])
{
?>
<div class="shipping_method">
<p> <strong> <?php echo SHIPPING_MEHTOD_TEXT;?> : </strong> <br />
<span class="method"> <?php echo $General->get_shipping_method('title');?> </span> </p>
</div>
<?php }?>
<div class="checkout_address">
<div class="address_info fl">
<h3><?php echo BILLING_ADDRESS_TEXT;?> <span>(<a href="<?php echo site_url('/?ptype=myaccount&type=editprofile'); ?>"><u><?php  echo CHECKOUT_EDIT_LINK;?></u></a>)</span></h3>
<div class="address_row"> <b><?php echo $userInfo['display_name'];?></b></div>
<div class="address_row"><?php echo $user_address_info['user_add1'];?></div>
<div class="address_row"><?php echo $user_address_info['user_add2'];?></div>
<div class="address_row"><?php echo $user_address_info['user_city'];?>, <?php echo $user_address_info['user_state'];?>,</div>
<div class="address_row"><?php echo $user_address_info['user_country'];?> - <?php echo $user_address_info['user_postalcode'];?></div>
<?php if($user_address_info['phone']!='' ){?> <div class="address_row"><?php _e(PHONE_NUMBER_TEXT);?> : <?php echo $user_address_info['phone'];?></div>  <?php }?>
</div>
<?php 
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_sidebar_btwn_sidebar.php'))
{
	include(CHILDTEMPLATEPATH . '/normal_checkout_sidebar_btwn_sidebar.php');
}
?>
<?php if(!$General->is_storetype_digital()){?>
<div class="address_info fr">
<h3><?php echo SHIPPING_ADDRESS_TEXT;?> <span>(<a href="<?php echo site_url('/?ptype=myaccount&type=editprofile'); ?>"><u><?php echo CHECKOUT_EDIT_LINK;?></u></a>)</span> </h3>
<div class="address_row"> <b><?php echo $user_address_info['buser_name'];?></b></div>
<div class="address_row"><?php echo $user_address_info['buser_add1'];?> </div>
<div class="address_row"><?php echo $user_address_info['buser_add2'];?></div>
<div class="address_row"><?php echo $user_address_info['buser_city'];?>, <?php echo $user_address_info['buser_state'];?>, </div>
<div class="address_row"><?php echo $user_address_info['buser_country'];?> - <?php echo $user_address_info['buser_postalcode'];?></div>
</div>
<?php }?>
</div>
<?php 
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_sidebar_below_sidebar.php'))
{
	include(CHILDTEMPLATEPATH . '/normal_checkout_sidebar_below_sidebar.php');
}
?>
<!-- checkout Address -->
<div class="payment_method"><img src="<?php bloginfo('template_directory'); ?>/images/payment_method.png" alt=""   /> </div>

<?php if ( function_exists('dynamic_sidebar') && (dynamic_sidebar('Checkout Page Sidebar Right')) ) { }?>
</div>
<?php 
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_sidebar_end_sidebar.php'))
{
	include(CHILDTEMPLATEPATH . '/normal_checkout_sidebar_end_sidebar.php');
}
?>