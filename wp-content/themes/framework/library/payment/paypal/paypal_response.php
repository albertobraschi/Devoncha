<?php
global $General, $Cart;
//$orderNumber; // order number
$paymentOpts = $General->get_payment_optins($_REQUEST['paymentmethod']);
$merchantid = $paymentOpts['merchantid'];
$returnUrl = $paymentOpts['returnUrl'];
$cancel_return = $paymentOpts['cancel_return'];
$notify_url = $paymentOpts['notify_url'];
$currency_code = $General->get_currency_code();
$cartInfo = $Cart->getcartInfo();
$itemArr = array();
for($i=0;$i<count($cartInfo);$i++)
{
	$product_att = preg_replace('/([(])([+-])([0-9]*)([)])/','',$cartInfo[$i]['product_att']);
	$itemstr = '';
	$itemstr .= $cartInfo[$i]['product_qty'].' X '.$cartInfo[$i]['product_name'];
	if($product_att)
	{
		$itemstr .="($product_att)";
	}
	$itemArr[] = $itemstr;
	
}
$item_name = implode(', ',$itemArr);
$amount = $Cart->getCartAmt();
$payable_amt = $General->get_payable_amount($_REQUEST['shippingmethod']);
?>
<form name="frm_payment_method" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<?php /*?><form name="frm_payment_method" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"><?php */?>
<input type="hidden" value="<?php echo $payable_amt;?>" name="amount"/>
<input type="hidden" value="<?php echo $returnUrl;?>&oid=<?php echo $orderNumber;?>" name="return"/>
<input type="hidden" value="<?php echo $cancel_return;?>&oid=<?php echo $orderNumber;?>" name="cancel_return"/>
<input type="hidden" value="<?php echo $notify_url;?>" name="notify_url"/>
<input type="hidden" value="_xclick" name="cmd"/>
<input type="hidden" value="<?php echo $item_name;?>" name="item_name"/>
<input type="hidden" value="<?php echo $merchantid;?>" name="business"/>
<input type="hidden" value="<?php echo $currency_code;?>" name="currency_code"/>
<input type="hidden" value="<?php echo $orderNumber;?>" name="custom" />
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="no_shipping" value="1">
</form>

<div id="wrapper" class="container_16" >
		<div class="clearfix container_message">
            	<h1 class="processing_message_head">Processing for <?php echo $_REQUEST['paymentmethod'];?>, Please wait ....</h1>
         </div>
</div>
<script>
setTimeout("document.frm_payment_method.submit()",100); 
</script> 