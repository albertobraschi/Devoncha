<?php
global $wpdb,$Cart,$General;
if($_REQUEST['pagetype'] == 'delete' && $_REQUEST['code'] != '')
{
	$couponsql = "select option_value from $wpdb->options where option_name='discount_coupons'";
	$couponinfo = $wpdb->get_results($couponsql);
	if($couponinfo)
	{
		foreach($couponinfo as $couponinfoObj)
		{
			$option_value = unserialize($couponinfoObj->option_value);
			unset($option_value[$_REQUEST['code']]);
			$option_value_str = serialize($option_value);
			$updatestatus = "update $wpdb->options set option_value= '$option_value_str' where option_name='discount_coupons'";
			$wpdb->query($updatestatus);
		}
	}
	$location = site_url("/wp-admin/admin.php?page=managecoupon&msg=delsuccess");
	wp_redirect($location);exit;
}
?>
<div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_coupon_detail"> <?php _e('Gerenciar Cupons'); ?></span>  
    
    
 </div> <!-- sub heading -->
<div id="page" >


<?php if($_REQUEST['msg']=='success'){?>
<div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
  <p><?php _e('Coupon updated successfully.'); ?></p>
</div>
<?php }?>
<?php if($_REQUEST['msg']=='delsuccess'){?>
<div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
  <p><?php _e('Coupon deleted successfully.'); ?></p>
</div>
<?php }?>
<p><a href="<?php echo site_url('/wp-admin/admin.php?page=managecoupon&pagetype=addedit')?>"><strong><?php _e('[ + Adicionar Cupom ]'); ?></strong></a> </p>
<table width="100%" cellpadding="5" class="widefat post" >
  <thead>
    <tr>
      <th width="150" align="left"><strong><?php _e('Código do Cupom'); ?></strong></th>
      <th width="150" align="left"><strong><?php _e('Tipo de Disconto'); ?></strong></th>
      <th width="150" align="left"><strong><?php _e('Valor do Disconto'); ?></strong></th>
      <th width="85" align="left"><strong><?php _e('Editar'); ?></strong></th>
      <th width="85" align="left"><strong><?php _e('Apagar'); ?></strong></th>
      <th align="left">&nbsp;</th>
    </tr>
    <?php
$couponsql = "select option_value from $wpdb->options where option_name='discount_coupons'";
$couponinfo = $wpdb->get_results($couponsql);
if($couponinfo)
{
	foreach($couponinfo as $couponinfoObj)
	{
		$option_value = unserialize($couponinfoObj->option_value);
		foreach($option_value as $key=>$value)
		{
?>
    <tr>
      <td><?php echo $value['couponcode'];?></td>
      <td><?php echo $value['dis_per'];?></td>
      <td><?php echo $value['dis_amt'];?></td>
      <td><a href="<?php echo site_url('/wp-admin/admin.php?page=managecoupon&pagetype=addedit&code='.$key);?>"><?php _e('Edit'); ?></a> </td>
      <td><a href="<?php echo site_url('/wp-admin/admin.php?page=managecoupon&pagetype=delete&code='.$key);?>"><?php _e('Delete'); ?></a></td>
      <td>&nbsp;</td>
    </tr>
    <?php
		}
	}
}
?>
  </thead>
</table>
 
</div> <!-- page #end -->
 </div>   <!-- wrapper #end --> 
 
 
