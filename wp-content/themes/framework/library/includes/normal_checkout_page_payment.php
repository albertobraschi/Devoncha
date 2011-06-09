<?php 
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_payment_begin.php'))
{
	include(CHILDTEMPLATEPATH . '/normal_checkout_payment_begin.php');
}
?>
 <?php
		$paymentsql = "select * from $wpdb->options where option_name like 'payment_method_%' order by option_id";
		$paymentinfo = $wpdb->get_results($paymentsql);
		if($paymentinfo)
		{
		?>
  <h3 class="shipping_cart"> <?php _e('Select Payment Method');?></h3>
  <table width="100%" class="table ">
	<?php
			$paymentOptionArray = array();
			$paymethodKeyarray = array();
			foreach($paymentinfo as $paymentinfoObj)
			{
				$paymentInfo = unserialize($paymentinfoObj->option_value);
				if($paymentInfo['isactive'])
				{
					$paymethodKeyarray[] = $paymentInfo['key'];
					$paymentOptionArray[$paymentInfo['display_order']][] = $paymentInfo;
				}
			}
			ksort($paymentOptionArray);
			foreach($paymentOptionArray as $key=>$paymentInfoval)
			{
				for($i=0;$i<count($paymentInfoval);$i++)
				{
					$paymentInfo = $paymentInfoval[$i];
					$jsfunction = 'onclick="showoptions(this.value);"';
					$chked = '';
					if($key==1)
					{
						$chked = 'checked="checked"';
					}
				?>
	<tr>
	  <td width="1%"  align="center" valign="middle" class="row3" id="<?php echo $paymentInfo['key'];?>"><input <?php echo $jsfunction;?>  type="radio" value="<?php echo $paymentInfo['key'];?>" id="<?php echo $paymentInfo['key'];?>_id" name="paymentmethod" <?php echo $chked;?> /></td>
	  <td valign="middle" class="row3"><?php echo $paymentInfo['name']?></td>
	  <?php
					if(file_exists(TEMPLATEPATH.'/library/payment/'.$paymentInfo['key'].'/'.$paymentInfo['key'].'.php'))
					{
					?>
	  <?php
						include_once(TEMPLATEPATH.'/library/payment/'.$paymentInfo['key'].'/'.$paymentInfo['key'].'.php');
						?>
	  <?php
					}
				 ?>
	  <?php
				}
			}
			
		?>
<?php 
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_payment_radio.php'))
{
	include(CHILDTEMPLATEPATH . '/normal_checkout_payment_radio.php');
}
?> 
	<tr>
	  <td  align="center" >&nbsp;</td>
	  <td >&nbsp;</td>
  </table>
  <?php
		}
		?>
<?php 
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_payment_end.php'))
{
	include(CHILDTEMPLATEPATH . '/normal_checkout_payment_end.php');
}
?>