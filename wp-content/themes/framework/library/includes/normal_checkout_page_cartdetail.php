<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_cartdetail_begin.php'))
{
	include_once(CHILDTEMPLATEPATH . '/normal_checkout_cartdetail_begin.php');
}
?>
<h3 class="shipping_cart"><?php echo YOUR_SELECTION_TEXT; ?></h3>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table_spacer">
<tr>
  <td width="10%" class="title"><?php _e('Image'); ?></td>
  <td width="50%" class="title"><?php echo PRODUCT_NAME_TEXT; ?></td>
  <td width="10%" align="center" class="title"><?php echo QTY_TEXT;?></td>
  <td width="15%" align="center" class="title"><?php echo PRICE_TEXT;?></td>
  <td width="15%" align="center" class="title"><?php echo TOTAL_TEXT;?></td>
</tr>
<?php
    for($i=0;$i<count($cartInfo);$i++)
    {
    global $Product;
    $post->ID=$cartInfo[$i]['product_id'];
    $product_image_arr = $Product->get_product_image($post,'large');
    $product_image = $product_image_arr[0];
    $product_id = $cartInfo[$i]['product_id'];
    $product_name = $cartInfo[$i]['product_name'];
    $product_qty = $cartInfo[$i]['product_qty'];
    $product_att = $cartInfo[$i]['product_att'];
    $product_price = $General->get_amount_format($cartInfo[$i]['product_gross_price'],0);
    $product_price_total = $cartInfo[$i]['product_gross_price']*$cartInfo[$i]['product_qty'];
    ?>
<tr>
  <td class="row1 "><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $product_image; ?>&amp;h=60&amp;w=50&amp;zc=1&amp;q=80<?php global $thumb_url; echo $thumb_url;?>" alt=""  class="product_thum" /></td>
  <td class="row1 " ><?php echo $product_name;
      if($product_att)
      {
        echo '<br>('.$product_att .')';
      }
      $Product->show_product_model_code($product_id);
       ?> </td>
  <td align="center" class="row1 " ><?php echo $product_qty; ?></td>
  <td class="row1 tprice"  ><?php echo $product_price; ?></td>
  <td class="row1 tprice" ><?php echo $General->get_amount_format($product_price_total,0); ?></td>
</tr>
<?php
    }
    ?>
<tr>
  <td colspan="4" align="right"  ><?php echo SUB_TOTAL_AMOUNT_TEXT;?> : </td>
  <td class=" tprice">&nbsp;<?php echo $grandTotal;?></td>
</tr>
<?php
    if($discount_amt){
    ?>
<tr>
  <td colspan="4" align="right"   ><?php echo DISCOUNT_AMOUNT_TEXT;?>
    <?php if($discount_info['dis_per']=='per'){echo '('.$General->get_amount_format($discount_info['dis_amt']).'%)';}?>
    : </td>
  <td class=" tprice" >-<?php echo $discount_amt;?></td>
</tr>
<?php }?>
<?php if($taxable_amt>0){?>
<tr>
  <td colspan="4" align="right" ><?php echo $taxable_info_desc;?> : </td>
  <td class=" tprice">+<?php echo  $General->get_amount_format($taxable_amt); ?></td>
</tr>
<?php }?>
<?php
    $grandTotal1 = $General->get_shipping_amt($Cart->getCartAmt_physical_prd(array(),array('freeshiping'=>1)));
    $payableAmt = $General->get_payable_amount($_SESSION['shippingmethod']);
     if($_SESSION['shippingmethod'] && $grandTotal1>0)
     {
     ?>
    <tr>
      <td colspan="4" align="right"   ><?php echo $General->get_shipping_method('title');?> <?php _e('Amount');?> :</td>
      <td class=" tprice">+<?php echo $General->get_amount_format($grandTotal1);?></td>
    </tr>
<?php }?>
<tr>
  <td colspan="4" align="right" class="row2"  ><strong><?php echo FINAL_AMOUNT_TEXT;?> : </strong></td>
  <td class="total_price "><strong><?php echo $General->get_amount_format($payableAmt)?></strong></td>
</tr>
</table>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_cartdetail_end.php'))
{
	include_once(CHILDTEMPLATEPATH . '/normal_checkout_cartdetail_end.php');
}
?>