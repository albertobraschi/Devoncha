<?php
$product_type = $Product->get_product_type($post->ID);
if($product_type=='affiliate')
{
?>
  <a href="<?php echo get_post_meta($post->ID,'aff_link',true);?>" class="normal_button fl aff_link"><?php _e( get_post_meta($post->ID,'aff_link_text',true));?> </a>
<?php
}
else
{
	if($General->is_storetype_shoppingcart() || $General->is_storetype_digital())
	{
		if($General->is_checkoutype_cart())
		{
			if(get_option('ptthemes_add_to_cart_button_position')=='Above and Below Description')
			{
				include(TEMPLATEPATH . '/library/includes/checkout_cart_2.php');
			}else
			{
				include(TEMPLATEPATH . '/library/includes/checkout_cart.php');
			}
		}else
		{
			include(TEMPLATEPATH . '/library/includes/checkout_buynow.php');
		}
	}
	elseif($General->is_storetype_catalog())
	{
		if($_REQUEST['msg']=='inqsuccess')
		{
			_e(INQUIRY_SEND_SUCCESS_MSG);
		}
	?>
	<a href="<?php echo site_url("/?ptype=sendenquiry&pid=".$post->ID);?>" class="normal_button fl"><?php _e(SEND_INQUIRY_TEXT);?> </a>
<?php
	}
}
?>