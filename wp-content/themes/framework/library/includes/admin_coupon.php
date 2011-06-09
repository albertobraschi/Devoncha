<?php
global $wpdb;
if($_POST['couponact'] == 'addcoupon')
{
	$couponcode = $_POST['couponcode'];
	$coupondisc = $_POST['coupondisc'];
	$couponamt = $_POST['couponamt'];
	if($couponcode)
	{
		$discount_coupons['couponcode'] = $couponcode;
		$discount_coupons['dis_per'] = $coupondisc;
		$discount_coupons['dis_amt'] = $couponamt;
		
		$option_value = get_option('discount_coupons');
		if($option_value)
		{
			if($_POST['code'] != '')
			{
				$option_value[$_POST['code']]  = $discount_coupons;
			}else
			{
				for($i=0;$i<count($option_value);$i++)
				{
					if($option_value[$i]['couponcode'] == $couponcode)
					{
						$location = site_url("/wp-admin/admin.php?page=managecoupon&pagetype=addedit&msg=exist");
						wp_redirect($location);exit;
					}
				}
				$option_value[]  = $discount_coupons;
			}			
			$option_value_str = $option_value;
			update_option('discount_coupons',$option_value_str);
		}else
		{
			$option_value[] = $discount_coupons;
			$option_value_str = $option_value;
			update_option('discount_coupons',$option_value_str);
		}
		$location = site_url("/wp-admin/admin.php?page=managecoupon&msg=success");
		wp_redirect($location);
		exit;
	}
}
if($_REQUEST['code']!='')
{
	$option_value = get_option('discount_coupons');
	$coupon = $option_value[$_REQUEST['code']];
}
?>
<div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_mange_coupon"><?php if($_REQUEST['code']!=''){_e('Editar Cupom');}else{_e('Adicionar Cupom');}?></span>  
    
    
 </div> <!-- sub heading -->
 <div id="page" >

<form action="<?php echo site_url('/wp-admin/admin.php?page=managecoupon&pagetype=addedit&code='.$_REQUEST['code'])?>" method="post" name="coupon_frm">
  <input type="hidden" name="couponact" value="addcoupon">
  <input type="hidden" name="code" value="<?php echo $_REQUEST['code'];?>">
 
  <?php if($_REQUEST['msg']=='exist'){?>
  <div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
    <p><?php _e('Este código de Cupom já existe, favor escolher outro.');?></p>
  </div>
  <?php }?>
  <table width="85%" cellpadding="3" cellspacing="3" class="widefat post sub_table" >
    <tr>
      <td width="30%"><?php _e('Código Cupom');?></td>
      <td width="70%">:
        <input type="text" name="couponcode" value="<?php echo $coupon['couponcode']?>"></td>
    </tr>
    <tr>
      <td><?php _e('Tipo de Desconto');?></td>
      <td>:
        <input type="radio" id="coupondiscper" name="coupondisc" value="per" <?php if($coupon['dis_per'] == 'per' || $coupon['dis_per']==''){?>checked="checked"<?php }?> />
        <?php _e('Porcentagem');?>(%)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="coupondiscamt" name="coupondisc" <?php if($coupon['dis_per'] == 'amt'){?> checked="checked"<?php }?> value="amt" />
        <?php _e('Valor');?>
        <!--<input type="text" name="coupondisc" value="">
--></td>
    </tr>
    
    <tr>
      <td><?php _e('Valor');?></td>
      <td>:
        <input type="text" name="couponamt" id="couponamt" value="<?php echo $coupon['dis_amt']?>"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="<?php _e('Submit');?>" onclick="return check_frm();" class="b_common action" >
        &nbsp;
        <input type="button" name="cancel" value="<?php _e('Cancel');?>" onClick="window.location.href='<?php echo site_url('/wp-admin/admin.php?page=managecoupon')?>'" class="b_normal action" ></td>
    </tr>
  </table>
</form>
<script>
function check_frm()
{
	if(document.getElementById('coupondiscper').checked)
	{
		if(document.getElementById('couponamt').value > 100)
		{
			alert("<?php _e('Percentage should be less than or equal to 100');?>");
			return false;
		}
	}
	return true;
}
</script>

</div> <!-- page #end -->
 </div>   <!-- wrapper #end -->