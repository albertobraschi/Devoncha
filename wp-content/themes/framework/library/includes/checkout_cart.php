<script language="javascript" type="text/javascript">
var SELECT_SIZE_JS_MSG = '<?php _e('Favor Selecionar '); $themeUI->get_product_att1_title($data);?>';
var SELECT_COLOR_JS_MSG = '<?php _e('Please select '); $themeUI->get_product_att2_title($data);?>';
var SELECT_ATT3_JS_MSG = '<?php _e('Please select '); $themeUI->get_product_att3_title($data);?>';
var SELECT_ATT4_JS_MSG = '<?php _e('Please select ').$themeUI->get_product_att4_title($data);?>';
var SELECT_ATT5_JS_MSG = '<?php _e('Please select ').$themeUI->get_product_att5_title($data);?>';
var PRECESSING_MSG = '<?php _e(PRECESSING_MSG);?>';
var siteurl = '<?php echo site_url(); ?>';
var ERROR_LOADING_CART_INFO_JS_MSG= '<?php echo ERROR_LOADING_CART_INFO_JS_MSG;?>';
var ADDED_CART_SUCCESS_MSG = '<?php echo ADDED_CART_SUCCESS_MSG;?>';
var VIEW_CART_DETAIL_TEXT = '<?php echo VIEW_CART_DETAIL_TEXT;?>';
var CHECKOUT_TEXT  = '<?php _e('Comprar');?>';
var post_id = '<?php echo $post->ID?>';
var request_url = '<?php echo $_SERVER['REQUEST_URI'];?>';	
var post_id = <?php echo $post->ID?>;
function checkstock(attval)
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
function checkstock(attval)
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
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/checkout_cart.js"></script>
<form id="shopingcartfrm" name="shopingcartfrm" action="">
<div class="row">
  <input type="hidden" name="cartact" value="addtocart" />
  <input type="hidden" name="product_id" id="product_id" value="<?php the_ID(); ?>" />
<?php if(get_option('ptthemes_qty_txt_showhide')=='Hide'){?>
<input name="product_qty" id="product_qty" type="hidden" maxlength="<?php echo get_option('ptthemes_max_qty_decimal');?>" value="1" class="textbox" />
<?php }else{?>
<label class="pfield"> <?php _e('Qtd');?> : </label>  <input name="product_qty" id="product_qty" type="text" onkeypress="return isNumberKey(event)" maxlength="<?php echo get_option('ptthemes_max_qty_decimal');?>" value="1" class="textbox" />
<?php }?>
<input type="hidden" name="product_att" id="product_att" value="" />
<input type="hidden" name="product_price" id="product_price" value="<?php echo $product_cart_price;?>" />
<input type="hidden" name="product_istaxable" id="product_istaxable" value="<?php echo $data['istaxable'];?>" />
<input type="hidden" name="product_weight" id="product_weight" value="<?php echo $data[ 'weight']; ?>" />
</div>
<?php
global $General;
$chk_stock = $General->check_stock($post->ID);
if($data['isshowstock']){ $General->display_stock_text($chk_stock);}
if($chk_stock=='out_of_stock'){
if(!$data['isshowstock']){$General->get_out_of_stock_text();}
}else{?>
<div class="addtocart" id="shoppingcart_button_1"><a href="javascript:void(0);" onclick="setAttributeVal();"> <?php _e("Add to Shopping Cart");?> &raquo;  </a></div>
<span id="shoppingcart_outofstock_msg1"></span>
<?php }?>
</form>
<span id="addtocartformspan">
<?php if($Cart->is_product_in_cart($post->ID)){echo '<b>'.__(ALREADY_ADDED_CART_MSG).'<Br><a href="'.site_url('/?ptype=cart').'">'.__(VIEW_CART_DETAIL_TEXT).'</a> or <a href="'.site_url('/?ptype=cart').'">'.__(CHECKOUT_TEXT).' &raquo;</a></b>';}?>
</span>