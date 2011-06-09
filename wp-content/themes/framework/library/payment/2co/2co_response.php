<?php
global $General, $Cart;
$paymentOpts = $General->get_payment_optins($_REQUEST['paymentmethod']);
$merchantid = $paymentOpts['vendorid'];
if($merchantid == '')
{
	$merchantid = '1303908';
}
$ipnfilepath = $paymentOpts['ipnfilepath'];
if($ipnfilepath == '')
{
	$ipnfilepath = site_url()."/?ptype=notifyurl&pmethod=2co";
}
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
//$userInfo = $General->getLoginUserInfo();
$toEmailName = $userInfo['display_name'];
$toEmail = $userInfo['user_email'];

$currency_code = $General->get_currency_code();
?>

<form method="post" action="https://www.2checkout.com/checkout/purchase" name="frm_payment_method">
<input type="hidden" value="73453" name="c_prod"/>
<input type="hidden" value="<?php echo $item_name;?>" name="c_name"/>
<input type="hidden" value="<?php echo $item_name;?>" name="c_description"/>
<input type="hidden" value="<?php echo $payable_amt;?>" name="c_price"/>
<input type="hidden" value="1" name="id_type"/>
<input type="hidden" value="<?php echo $orderNumber;?>" name="cart_order_id"/>
<input type="hidden" value="<?php echo $payable_amt;?>" name="total"/>
<input type="hidden" value="<?php echo $merchantid;?>" name="sid"/>
<input type="hidden" name="c_tangible" value="N">
<input type='hidden' name='x_receipt_link_url' value='<?php echo $ipnfilepath;?>' />
<input type='hidden' name='x_amount' value='<?php echo $payable_amt;?>' />
<input type='hidden' name='x_login' value='<?php echo $merchantid;?>' />
<input type='hidden' name='x_invoice_num' value='<?php echo $orderNumber;?>' />
<input type='hidden' name='x_first_name' value='<?php echo $toEmailName;?>' />
<input type='hidden' name='x_email' value='<?php echo $toEmail;?>' />
<input type="hidden" name="tco_currency" value="<?php echo $currency_code;?>" />

<!--<input type="submit" value="Buy from 2CO" name="purchase" class="submit"/>-->
</form>

 <div class="wrapper" >
		<div class="clearfix container_message">
            	<h1 class="processing_message_head">Processing for <?php echo $_REQUEST['paymentmethod'];?>, Please wait ....</h1>
            </div>

<script>
setTimeout("document.frm_payment_method.submit()",500); 
</script>


        

 