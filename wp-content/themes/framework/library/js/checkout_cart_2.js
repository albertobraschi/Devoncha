function setAttributeVal2()
 {
 	var postformflag = 1;
	if(eval(document.getElementById('size2')))
	{
		var size = document.getElementById('size2').value;
		if(size == '')
		{
			alert(SELECT_SIZE_JS_MSG);
			postformflag = 0;
		}
	}else
	{
		var size = '';
	}
	if(postformflag)
	{
		if(eval(document.getElementById('color2')))
		{
			var color = document.getElementById('color2').value;
			if(color == '')
			{
				alert(SELECT_COLOR_JS_MSG);
				postformflag = 0;
			}
		}else
		{
			var color = 0;
		}
	}
	if(postformflag)
	{
		if(eval(document.getElementById('attribute32')))
		{
			var attribute3 = document.getElementById('attribute32').value;
			if(attribute3 == '')
			{
				alert(SELECT_ATT3_JS_MSG);
				postformflag = 0;
			}
		}else
		{
			var attribute3 = 0;
		}
	}
	if(postformflag)
	{
		if(eval(document.getElementById('attribute42')))
		{
			var attribute4 = document.getElementById('attribute42').value;
			if(attribute4 == '')
			{
				alert(SELECT_ATT4_JS_MSG);
				postformflag = 0;
			}
		}else
		{
			var attribute4 = 0;
		}
	}
	if(postformflag)
	{
		if(eval(document.getElementById('attribute52')))
		{
			var attribute5 = document.getElementById('attribute52').value;
			if(attribute5 == '')
			{
				alert(SELECT_ATT5_JS_MSG);
				postformflag = 0;
			}
		}else
		{
			var attribute5 = 0;
		}
	}
	if(postformflag)
	{
		if(eval(document.getElementById('attribute62')))
		{
			var attribute6 = document.getElementById('attribute62').value;
		}
		if(eval(document.getElementById('attribute72')))
		{
			var attribute7 = document.getElementById('attribute72').value;
		}
		if(eval(document.getElementById('attribute82')))
		{
			var attribute8 = document.getElementById('attribute82').value;
		}
		if(eval(document.getElementById('attribute92')))
		{
			var attribute9 = document.getElementById('attribute92').value;
		}
		if(eval(document.getElementById('attribute102')))
		{
			var attribute10 = document.getElementById('attribute102').value;
		}
	}
	if(postformflag)
	{
		if(eval(document.getElementById('cart_information_span')))
		{
			document.getElementById('cart_information_span').innerHTML = PRECESSING_MSG;
		}
		if(eval(document.getElementById('addtocartformspan2')))
		{
			document.getElementById('addtocartformspan2').innerHTML = PRECESSING_MSG;
		}
		if(eval(document.getElementById('cart_information_header_span2')))
		{
			document.getElementById('cart_information_header_span2').innerHTML = PRECESSING_MSG;
		}
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
		
		if(attribute3){
		if(attstr!='')
		{
			attstr = attstr+','+attribute3;	
		}else
		{
			attstr = attribute3;
		}
	}
	
	if(attribute4){
		if(attstr!='')
		{
			attstr = attstr+','+attribute4;	
		}else
		{
			attstr = attribute4;
		}
	}
	
	if(attribute5){
		if(attstr!='')
		{
			attstr = attstr+','+attribute5;	
		}else
		{
			attstr = attribute5;
		}
	}
	if(attribute6){
		if(attstr!='')
		{
			attstr = attstr+','+attribute6;	
		}else
		{
			attstr = attribute6;
		}
	}
	if(attribute7){
		if(attstr!='')
		{
			attstr = attstr+','+attribute7;	
		}else
		{
			attstr = attribute7;
		}
	}
	if(attribute8){
		if(attstr!='')
		{
			attstr = attstr+','+attribute8;	
		}else
		{
			attstr = attribute8;
		}
	}
	if(attribute9){
		if(attstr!='')
		{
			attstr = attstr+','+attribute9;	
		}else
		{
			attstr = attribute9;
		}
	}
	if(attribute10){
		if(attstr!='')
		{
			attstr = attstr+','+attribute10;	
		}else
		{
			attstr = attribute10;
		}
	}
	
		document.getElementById('product_att2').value = attstr;
		postform1();
	}
 }

function postform1()
{
	dataString = $("#shopingcartfrm2").serialize();
	$.ajax({
		url: siteurl+'/?ptype=cart&'+dataString,
		type: 'GET',
		dataType: 'html',
		timeout: 9000,
		error: function(){
			alert(ERROR_LOADING_CART_INFO_JS_MSG);
		},
		success: function(html){
			chekc_stock();
			if(eval(document.getElementById('cart_content_sidebar')))
			{
				refresh_cartinfo_sidebar1();
			}
			if(eval(document.getElementById('cart_information_span')))
			{
				document.getElementById('cart_information_span').innerHTML=html;
			}
			if(eval(document.getElementById('cart_information_header_span')))
			{
				document.getElementById('cart_information_header_span').innerHTML=html;
			}	
			if(eval(document.getElementById('addtocartformspan2')))
			{
				document.getElementById('addtocartformspan2').innerHTML = '<strong>'+ADDED_CART_SUCCESS_MSG+'<Br><a href="'+siteurl+'/?ptype=cart">'+VIEW_CART_DETAIL_TEXT+'</a> or <a href="'+siteurl+'/?ptype=cart">'+CHECKOUT_TEXT+' &raquo;</a></strong>';
			}
		}
	});
	return false;
}
function refresh_cartinfo_sidebar1()
{
	$.ajax({
		url: siteurl+'/?ptype=cart&cartact=cart_refresh',
		type: 'GET',
		dataType: 'html',
		timeout: 9000,
		error: function(){
			alert(ERROR_LOADING_CART_INFO_JS_MSG);
		},
		success: function(html){
			if(eval(document.getElementById('cart_content_sidebar')))
			{
				document.getElementById('cart_content_sidebar').innerHTML=html;
			}
		}
	});
	return false;
}
function chekc_stock()
{
	dataString = $("#shopingcartfrm").serialize();
	$.ajax({
		url: siteurl+'/?ptype=cart&pid='+post_id+dataString+'&cartact=stock_chk',
		type: 'GET',
		dataType: 'html',
		timeout: 20000,
		error: function(){
			//alert('Error loading cart information');
		},
		success: function(html){
			if(html=='unlimited')
			{
				
			}else
			if(html>0)
			{
				//alert(html);	
			}else
			{
				document.getElementById('addtocartformspan2').innerHTML = html;
			}
		}
	});
}