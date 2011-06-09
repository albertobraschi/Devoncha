<?php
global $Cart;
$Cart->empty_cart();
?>
<script>
 function setAttributeVal()
 {
 	var postformflag = 1;
	if(eval(document.getElementById('size')))
	{
		var size = document.getElementById('size').value;
		if(size == '')
		{
			alert('<?php _e(SELECT_SIZE_JS_MSG);?>');
			postformflag = 0;
		}
	}else
	{
		var size = '';
	}
	if(postformflag)
	{
		if(eval(document.getElementById('color')))
		{
			var color = document.getElementById('color').value;
			if(color == '')
			{
				alert('<?php _e(SELECT_COLOR_JS_MSG);?>');
				postformflag = 0;
			}
		}else
		{
			var color = 0;
		}
	}
	if(postformflag)
	{
		var attstr = '';
		if(size != '' && color != '')
		{
			attstr = size+','+color;
		}else
		if(size != '' && color == '')
		{
			attstr = size;
		}else
		if(size == '' && color != '')
		{
			attstr = color;
		}
		document.getElementById('product_att').value = attstr;
		postform();
	}
 }

function postform()
{
	dataString = $("#shopingcartfrm").serialize();
	$.ajax({
		url: '<?php echo site_url('/?ptype=cart&'); ?>'+dataString,
		type: 'GET',
		dataType: 'html',
		timeout: 9000,
		error: function(){
			alert('<?php _e(ERROR_LOADING_CART_INFO_JS_MSG);?>');
		},
		success: function(html){
			window.location.href="<?php echo site_url('/?ptype=cart&paymentmethod=paypal'); ?>";
			<?php /*?>window.location.href="<?php echo site_url('/?ptype=cart'); ?>";<?php  //un-comment this code if you want to buynow+ cart<?php */?>
		}
	});
	return false;
}
</script>

<form id="shopingcartfrm" name="shopingcartfrm" action="">
  <input type="hidden" name="cartact" value="addtocart" />
  <input type="hidden" name="product_id" id="product_id" value="<?php the_ID(); ?>" />
  <input name="product_qty" id="product_qty" type="hidden" value="1" class="textbox" />
  <input type="hidden" name="product_att" id="product_att" value="" />
  <input type="hidden" name="product_price" id="product_price" value="<?php echo $product_cart_price;?>" />
  <input type="hidden" name="product_istaxable" id="product_istaxable" value="<?php echo $data['istaxable'];?>" />
  <input type="hidden" name="product_weight" id="product_weight" value="<?php echo $data[ 'weight']; ?>" />
  <div class="b_buynow"> <a href="javascript:void(0);" onclick="setAttributeVal();" > <?php _e(BUY_NOW_TEXT);?> </a></div>
  
</form>
