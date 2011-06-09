<?php
global $General, $Cart;
$paymentOpts = $General->get_payment_optins($_REQUEST['paymentmethod']);
$merchantid = $paymentOpts['merchantid'];
$currency_code = $General->get_currency_code();
$cartInfo = $Cart->getcartInfo();
$cart_amount = $Cart->getCartAmt();
$shipping_amt = $General->get_shipping_amt($Cart->getCartAmt_physical_prd(array(),array('freeshiping'=>1)));
$shipping_method = $General->get_shipping_method('title');
?>
<form method="POST" name="frm_payment_method"  action="https://checkout.google.com/api/checkout/v2/checkoutForm/Merchant/<?php echo $merchantid;?>"  accept-charset="utf-8">

<?php
for($i=0;$i<count($cartInfo);$i++)
{
	$product_att = preg_replace('/([(])([+-])([0-9]*)([)])/','',$cartInfo[$i]['product_att']);
?>
    <input type="hidden" name="item_name_<?php echo $i+1;?>" value="<?php echo $cartInfo[$i]['product_name'];?>"/>
    <input type="hidden" name="item_description_<?php echo $i+1;?>" value="<?php echo $cartInfo[$i]['product_name'].'  '.$product_att;?>"/>
    <input type="hidden" name="item_quantity_<?php echo $i+1;?>" value="<?php echo $cartInfo[$i]['product_qty'];?>"/>
    <input type="hidden" name="item_price_<?php echo $i+1;?>" value="<?php echo $cartInfo[$i]['product_gross_price'];?>"/>
    <input type="hidden" name="item_currency_<?php echo $i+1;?>" value="<?php echo $currency_code;?>"/>
<?php
}
?>
<?php if($shipping_amt>0){?>
<input type="hidden" name="ship_method_name_1" value="<?php echo $shipping_method;?>"/>
<input type="hidden" name="ship_method_price_1" value="<?php echo $shipping_amt?>"/>
<input type="hidden" name="ship_method_currency_1" value="<?php echo $currency_code;?>"/>
<?php }?>
<?php
if($_SESSION['couponcode'])
{
	$discount_amount = $General->get_discount_amount($_SESSION['couponcode'],$cart_amount);
}
if($discount_amount)
{
?>
    <input type="hidden" name="item_name_<?php echo $i+1;?>" value="Discount"/>
    <input type="hidden" name="item_description_<?php echo $i+1;?>" value="Discount Amount"/>
    <input type="hidden" name="item_quantity_<?php echo $i+1;?>" value="1"/>
    <input type="hidden" name="item_price_<?php echo $i+1;?>" value="<?php echo '-'.$discount_amount;?>"/>
    <input type="hidden" name="item_currency_<?php echo $i+1;?>" value="<?php echo $currency_code;?>"/>

 <?php	
}
?>

<?php
$taxable_amt_info = $General->get_tax_amount();
$taxable_amt = $taxable_amt_info[0];
$payable_amt = $General->get_payable_amount($_REQUEST['shippingmethod']);
$tax_per = 0;
if($taxable_amt && $cart_amount)
{
	$tax_per = $taxable_amt/$cart_amount;
}
if($tax_per>0){?>
<input type="hidden" name="tax_world" value="Tax Amount" />
<input type="hidden" name="tax_rate" value="<?php echo $tax_per; ?>" />
<?php }?>  

<input type="hidden" name="_charset_"/>
</form>
<div id="wrapper" class="container_16" >
		<div class="clearfix container_message">
            	<h1 class="processing_message_head">Processing for <?php echo $_REQUEST['paymentmethod'];?>, Please wait ....</h1>
         </div>
</div>
<script>
setTimeout("document.frm_payment_method.submit()",100); 
</script> 