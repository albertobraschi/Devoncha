<?php
global $General, $Cart,$orderNumber;
$paymentOpts = $General->get_payment_optins($_REQUEST['paymentmethod']);
$instId = $paymentOpts['instId'];
$accId1 = $paymentOpts['accId1'];
$currency_code = $General->get_currency_code();
$cartInfo = $Cart->getcartInfo();
$amount = $Cart->getCartAmt();
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
	//$itemArr[] = $cartInfo[$i]['product_qty'].' X '.$cartInfo[$i]['product_name']."($product_att)";
}
$item_name = implode(', ',$itemArr);
$payable_amt = $General->get_payable_amount($_REQUEST['shippingmethod']);
?>
<form action="https://select.worldpay.com/wcc/purchase" method="post" target="_top" name="frm_payment_method">	
<input type="hidden" value="<?php echo $payable_amt;?>" name="amount"/>
<input type="hidden" value="<?php echo $instId;?>" name="instId"/>
<input type="hidden" value="<?php echo $accId1;?>" name="accId1"/>
<input type="hidden" value="<?php echo $orderNumber;?>" name="cartId"/>
<input type="hidden" value="<?php echo $item_name;?>" name="desc"/>
<input type="hidden" value="<?php echo $currency_code;?>" name="currency"/>
<input type="hidden" value="" name="testMode"/>
</form>
 
 
  <div class="wrapper" >
    <div class="clearfix container_message">
            <h1 class="processing_message_head">Processing for <?php echo $_REQUEST['paymentmethod'];?>, Please wait ....</h1>
    </div>

<script>
setTimeout("document.frm_payment_method.submit()",100);
</script>