<script language="javascript" type="text/javascript">
var SELECT_SIZE_JS_MSG = '<?php _e('Please select '); $themeUI->get_product_att1_title($data);?>';
var SELECT_COLOR_JS_MSG = '<?php _e('Please select '); $themeUI->get_product_att2_title($data);?>';
var SELECT_ATT3_JS_MSG = '<?php _e('Please select '); $themeUI->get_product_att3_title($data);?>';
var SELECT_ATT4_JS_MSG = '<?php _e('Please select ').$themeUI->get_product_att4_title($data);?>';
var SELECT_ATT5_JS_MSG = '<?php _e('Please select ').$themeUI->get_product_att5_title($data);?>';

var PRECESSING_MSG = '<?php _e(PRECESSING_MSG);?>';
var siteurl = '<?php echo site_url(); ?>';
var ERROR_LOADING_CART_INFO_JS_MSG= '<?php _e(ERROR_LOADING_CART_INFO_JS_MSG);?>';
var ADDED_CART_SUCCESS_MSG = '<?php _e(ADDED_CART_SUCCESS_MSG);?>';
var VIEW_CART_DETAIL_TEXT = '<?php _e(VIEW_CART_DETAIL_TEXT);?>';
var CHECKOUT_TEXT  = '<?php _e('Comprar');?>';
var post_id = '<?php echo $post->ID?>';

function checkstock2(attval)
{
	if(eval('document.getElementById("shoppingcart_button_1")'))
	{
		document.getElementById("shoppingcart_button_1").style.display="";
	}
	if(eval('document.getElementById("shoppingcart_outofstock_msg1")'))
	{
		document.getElementById("shoppingcart_outofstock_msg1").innerHTML="";
	}
	if(eval('document.getElementById("shoppingcart_button_2")'))
	{
		document.getElementById("shoppingcart_button_2").style.display="";
	}
	if(eval('document.getElementById("shoppingcart_outofstock_msg2")'))
	{
		document.getElementById("shoppingcart_outofstock_msg2").innerHTML="";
	}
	<?php
	$product_color_js = $Product->get_product_custom_dl($post->ID,'size','',1);
	echo $product_color_js .= $Product->get_product_custom_dl($post->ID,'color','',1);
	?>
}
</script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/checkout_cart_2.js"></script>

<form id="shopingcartfrm2" name="shopingcartfrm">
  <input type="hidden" name="cartact" value="addtocart" />
  <input type="hidden" name="product_id" id="product_id2" value="<?php the_ID(); ?>" />
  <div>
    <input name="product_qty" id="product_qty2" type="hidden" value="1" class="textbox" />
  </div>
  <input type="hidden" name="product_att" id="product_att2" value="" />
  <input type="hidden" name="product_price" id="product_price2" value="<?php echo $product_cart_price;?>" />
  <input type="hidden" name="product_istaxable" id="product_istaxable2" value="<?php echo $data['istaxable'];?>" />
  <input type="hidden" name="product_weight" id="product_weight2" value="<?php echo $data[ 'weight']; ?>" />
  <?php
global $General;

$chk_stock = $General->check_stock($post->ID);
if($data['isshowstock'])
{
	$General->display_stock_text($chk_stock);
}
if($chk_stock=='out_of_stock')
{
	$General->get_out_of_stock_text();
}
else
{
?>
  <div class="addtocart" id="shoppingcart_button_2"><a href="javascript:void(0);" onclick="setAttributeVal2();"> <?php _e("Add to Shopping Cart");?> &raquo;  </a></div>
  <span id="shoppingcart_outofstock_msg2"></span>
 <?php }?> 
</form>
<div class="row"><span id="addtocartformspan2">
<?php if($Cart->is_product_in_cart($post->ID)){ _e('<b>'.__(ALREADY_ADDED_CART_MSG).'<Br><a href="'.site_url('/?ptype=cart').'">'.__(VIEW_CART_DETAIL_TEXT).'</a> or <a href="'.site_url('/?ptype=cart').'">'.__(CHECKOUT_TEXT).' &raquo;</a></b>');} ?>
</span> </div>