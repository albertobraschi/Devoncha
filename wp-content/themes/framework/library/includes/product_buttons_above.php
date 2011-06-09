<?php
if($data['affiliate_link'])
{
?>
  <a href="<?php echo $data['affiliate_link'];?>" class="normal_button fl aff_link"><?php _e($data['affiliate_link_text']);?> </a>
<?php
}else
{
	if($General->is_storetype_shoppingcart() || $General->is_storetype_digital())
	{
		if($General->is_checkoutype_cart())
		{
			include(TEMPLATEPATH . '/library/includes/checkout_cart.php');
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