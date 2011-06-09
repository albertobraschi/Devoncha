<?php /*?><?php
global $General, $Cart;
$paymentOpts = $General->get_payment_optins($_POST['paymentmethod']);
$merchantid = $paymentOpts['merchantid'];
$currency_code = $General->get_currency_code();
$cartInfo = $Cart->getcartInfo();
//$amount = $Cart->getCartAmt();
?>
<form method="POST" name="frm_payment_method"  action="https://checkout.google.com/api/checkout/v2/checkoutForm/Merchant/<?php echo $merchantid;?>"  accept-charset="utf-8">

<?php
for($i=0;$i<count($cartInfo);$i++)
{
	$product_att = preg_replace('/([(])([+-])([0-9]*)([)])/','',$cartInfo[$i]['product_att']);
?>
    <input type="hidden" name="item_name_<?php echo $i+1;?>" value="<?php echo $cartInfo[$i]['product_name'];?>"/>
    <input type="hidden" name="item_description_<?php echo $i+1;?>" value="<?php echo $product_att;?>"/>
    <input type="hidden" name="item_quantity_<?php echo $i+1;?>" value="<?php echo $cartInfo[$i]['product_gross_price'];?>"/>
    <input type="hidden" name="item_price_<?php echo $i+1;?>" value="<?php echo $cartInfo[$i]['product_qty'];?>"/>
    <input type="hidden" name="item_currency_<?php echo $i+1;?>" value="<?php echo $currency_code;?>"/>

<!--<!--  <input type="hidden" name="ship_method_name_1" value="UPS Ground"/>
  <input type="hidden" name="ship_method_price_1" value="10.99"/>
  <input type="hidden" name="ship_method_currency_1" value="USD"/>

  <input type="hidden" name="tax_rate" value="0.0875"/>
  <input type="hidden" name="tax_us_state" value="NY"/>-->-->
<?php
}
?>
  <input type="hidden" name="_charset_"/>
  <input type="image" name="Google Checkout" alt="Fast checkout through Google"
src="http://checkout.google.com/buttons/checkout.gif?merchant_id=1234567890&w=180&h=46&style=white&variant=text&loc=en_US"
height="46" width="180"/>
</form>
<?php */?>