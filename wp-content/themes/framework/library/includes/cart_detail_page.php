<script>
function evaluate_coupon_amt()
{
	var coupon_code = document.getElementById('coupon_code').value;
	if(coupon_code == '')
	{
		alert('Please Enter Coupon Code');
		return false;
	}else
	{
		document.getElementById('eval_coupon_code').value = coupon_code;
		document.evaluate_coupon.submit();
	}
}
</script>
 <?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/cart_detail_pag_above_title.php'))
{
	include_once(CHILDTEMPLATEPATH . '/cart_detail_pag_above_title.php');
}
?>
      <h1 class="head"><?php echo SHOPPING_CART_PAGE_TITLE; ?> (<?php echo $itemsInCartCount;?>)</h1>
    <div class="breadcrumb clearfix">
      <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',' &raquo; '.SHOPPING_CART_PAGE_TITLE); } ?>
    </div>
 <?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/cart_detail_pag_below_title.php'))
{
	include_once(CHILDTEMPLATEPATH . '/cart_detail_pag_below_title.php');
}
?>
  <?php
	if($itemsInCartCount>0)
	{
	?>
    <?php if($_GET['msg']=='emptycart'){ echo "<div style='color:red'>".CART_EMPTY_MSG."</div><br>";}?>
    <form action="<?php echo site_url('/?ptype=cart&cartact=upd'); ?>" method="post" name="updatecart" class="updatecart">
      <input type="hidden" name="cartprdid" value="<?php echo $i; ?>" />
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table">
        <tr>
          <td colspan="2" class="title"><?php echo PRODUCTS_TEXT;?></td>
          <td width="103" align="center" class="title"><?php echo PRICE_TEXT;?></td>
          <td width="262" align="center" class="title"><?php echo QTY_TEXT;?></td>
          <td width="101" align="center" class="title"><?php echo TOTAL_TEXT;?></td>
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
          <td width="64" valign="top" class="row1 bnone" ><a href="<?php echo get_permalink($product_id);?>"><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $product_image; ?>&amp;h=60&amp;w=50&amp;zc=1&amp;q=80<?php global $thumb_url; echo $thumb_url;?>" alt=""  class="product_thum" /></a></td>
          <td width="892" valign="top" class="row1"><a href="<?php echo get_permalink($product_id);?>"><strong><?php echo $product_name;?> </strong></a>
            <?php
			$Product->show_product_model_code($product_id);
			if($product_att!=''){ echo '<br>('.$product_att.')'; }
		   ?>
            <br />
            <a href="<?php echo site_url('/?ptype=cart&cartact=rmv&prm='.$i); ?>" title="Remove from Cart" class="remove_item"><?php echo REMOVE_ITEM_TEXT;?></a> </td>
          <td align="center" valign="top" class="row1 tprice" ><?php echo $product_price; ?></td>
          <td align="center" valign="top" class="row1 tprice"   ><?php $Product->cart_detail_product_qty($product_id,$product_qty);?>
          <span class="cart_detail_outofstock"><?php if(is_string($General->cart_detail_outofstock($product_id))){echo $General->cart_detail_outofstock($product_id);} ?></span>
          </td>
          <td valign="top" class="row1 tprice"><?php echo $General->get_amount_format($product_price_total,0); ?></td>
        </tr>
        <?php }?>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/cart_detail_page_below_product_list.php'))
{
	include_once(CHILDTEMPLATEPATH . '/cart_detail_page_below_product_list.php');
}
?>
        <tr>
          <td colspan="2" align="right" class="row1" ></td>
          <td colspan="2" align="right" class="row1" >
            <?php if(get_option('ptthemes_qty_txt_cart_showhide')=='Editable'){?>
            <a  href="javascript:void(0);" onclick="document.updatecart.submit();" class="normal_button b_update_cart " ><?php echo UPDATE_CART_TEXT; ?></a>
            <?php }?>          </td>
          <td align="left" class="row1 tprice" >&nbsp;</td>
        </tr>
        <tr>
          <td align="right" ></td>
          <td align="right" >&nbsp;</td>
          <td colspan="2" align="right"  ><?php echo SUB_TOTAL_AMOUNT_TEXT;?></td>
          <td align="left" class=" tprice" >&nbsp;<?php echo  $grandTotal; ?></td>
        </tr>
        <?php 
				  if($cart_discount_amt){?>
        <tr>
          <td colspan="4" align="right" ><?php echo $couponInfo;?> : </td>
          <td align="left" class=" tprice" >-<?php echo  $cart_discount_amt; ?></td>
        </tr>
        <?php }?>
        <?php if($taxable_amt>0) {?>
        <tr>
          <td align="right" ></td>
          <td colspan="3" align="right"  ><?php echo $taxable_info_desc;?> </td>
          <td align="left" class=" tprice" >+<?php echo  $General->get_amount_format($taxable_amt); ?></td>
        </tr>
        <?php }?>
        <?php if($shipping_amt>0) { ?>
        <tr>
          <td align="right"  ></td>
          <td colspan="3" align="right" ><?php echo $General->get_shipping_method('title');?> <?php _e('Amount');?> :</td>
          <td align="left" class=" tprice" >+<?php echo  $General->get_amount_format($shipping_amt);?></td>
        </tr>
        <?php }?>
        <tr>
          <td colspan="4" align="right" class="total_amount_title"  ><strong><?php echo TOTAL_AMOUNT_TEXT;?> : </strong></td>
          <td  class="total_price"><?php echo  $General->get_amount_format($payable_amt); ?></td>
        </tr>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/cart_detail_page_below_amount_total.php'))
{
	include_once(CHILDTEMPLATEPATH . '/cart_detail_page_below_amount_total.php');
}
?>
      </table>
    </form>
    <a href="javascript:void(0);" onclick="document.checkout_frm.submit();" class="highlight_button fr checkout_spacer" ><?php echo CHECKOUT_TEXT;?></a>   
    <?php
global $themeUI,$current_user;
if($themeUI->is_on_guest_checkout() && !$current_user->data->ID)
{?>
<a class="highlight_button checkout_spacer fr guest_checkout_spacer " href="<?php global $General; echo $General->get_ssl_normal_url(site_url('/?ptype=checkout&checkout_as_guest=1'));?>"><?php _e(GUEST_CHECKOUT_TEXT); ?></a>
<?php }?> 
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/cart_detail_page_above_coupon.php'))
{
	include_once(CHILDTEMPLATEPATH . '/cart_detail_page_above_coupon.php');
}
?>
    <form action="<?php global $General; echo $General->get_ssl_normal_url(site_url('/?ptype=checkout')); ?>" method="post" name="checkout_frm" >
      	<?php
        $shipping_info = $General->get_shipping_method();
		if($shipping_info)
		{
			$shipping_id = $shipping_info->shipping_id;
			$title = $shipping_info->title;
		?>
      <table width="100%" <?php if($shippingcount==1){ ?> style="display:none;"<?php }?> class="checkout_frm">
        <tr>
          <td colspan="2" class="shipping_title"><strong><?php echo SHIPPING_METHODS_TEXT;?></strong></td>
        </tr>
        <tr>
          <td><?php echo $title;?></td>
          <td><input type="radio" value="<?php echo $shipping_id;?>" name="shippingmethod" checked="checked" style="display:none;" /></td>
        </tr>
      </table>
      <?php	}?>
      <br />
      <div class="button_bar2">
        <?php if($General->is_show_coupon()){	?>
        <div class="coupon_code">
          <table border="0" cellpadding="5" cellspacing="5">
            <?php if($_REQUEST['msg']=='invalidcoupon'){?>
            <tr>
              <td colspan="2" style="color:#FF0000"><?php echo INVALID_COUPON_MSG;?><br />
                <br /></td>
            </tr>
            <?php }?>
            <tr>
              <td ><?php echo DISCOUNT_CODE_TEXT;?> : </td>
              <td><input type="text" class="coupon_text fl" value="<?php echo $_SESSION['eval_coupon_code'];?>" name="coupon_code" id="coupon_code" />
                <a href="javascript:void(0);"  onclick="evaluate_coupon_amt();"  class="fl normal_button" ><?php echo RECALCULATE_TEXT;?></a> </td>
            </tr>
          </table>
        </div>
       <?php }?>
        </div>
        <div>
        <a href="<?php echo site_url(); ?>" class="fl continue_spacer">&laquo; <?php echo CONTINUE_SHOPPING_TEXT;?> </a> 
         </div>
      <!-- button bar #end -->
    </form>
 <?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/cart_detail_page_below_coupon.php'))
{
	include_once(CHILDTEMPLATEPATH . '/cart_detail_page_below_coupon.php');
}
?>
    <form action="<?php ?>" method="post" name="evaluate_coupon" class="evaluate_coupon">
      <input type="hidden" name="cartact" value="eval_coupon" />
      <input type="hidden" name="eval_coupon_code" id="eval_coupon_code" value="" />
    </form>
    <?php }else{?>
 <?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/cart_detail_page_above_cart_empty_msg.php'))
{
	include_once(CHILDTEMPLATEPATH . '/cart_detail_page_above_cart_empty_msg.php');
}
?>
  		    <h3><?php echo CART_EMPTY_MSG;?> </h3>
          <a href="<?php echo site_url();?>" class="highlight_button fl"><?php echo CONTINUE_SHOPPING_TEXT;?> </a>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/cart_detail_page_below_cart_empty_msg.php'))
{
	include_once(CHILDTEMPLATEPATH . '/cart_detail_page_below_cart_empty_msg.php');
}
?>
          <?php  $_SESSION['couponcode'] = ''; }?>
