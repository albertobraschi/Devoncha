function setAttributeVal()
{
var postformflag = 1;
if(eval(document.getElementById('size')))
{
    var size = document.getElementById('size').value;
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
    if(eval(document.getElementById('color')))
    {
        var color = document.getElementById('color').value;
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
   if(eval(document.getElementById('attribute3')))
    {
        var attribute3 = document.getElementById('attribute3').value;
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
    if(eval(document.getElementById('attribute4')))
    {
        var attribute4 = document.getElementById('attribute4').value;
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
    if(eval(document.getElementById('attribute5')))
    {
        var attribute5 = document.getElementById('attribute5').value;
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
       // document.getElementById('cart_information_span').innerHTML = PRECESSING_MSG;
    }
	if(eval(document.getElementById('cart_information_span1')))
    {
        //document.getElementById('cart_information_span1').innerHTML = PRECESSING_MSG;
    }
    if(eval(document.getElementById('addtocartformspan')))
    {
       // document.getElementById('addtocartformspan').innerHTML = PRECESSING_MSG;
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
    document.getElementById('product_att').value = attstr;
    postform();
}
}

function postform()
{
	var product_qty = document.getElementById('product_qty').value;
	$.ajax({
		url: siteurl+'/?ptype=cart&pid='+post_id+'&qty='+product_qty+'&cartact=stock_chk',
		type: 'GET',
		dataType: 'html',
		timeout: 20000,
		error: function(){
			//alert('Error loading cart information');
		},
		success: function(html){
			if(html=='unlimited')
			{
				addtocart();
			}else
			if(html>0)
			{
				addtocart();
			}else
			{
				document.getElementById('addtocartformspan').innerHTML = html;
			}
		}
	});
return false;
}
function addtocart()
{
	dataString = $("#shopingcartfrm").serialize();
$.ajax({
    url: siteurl+'/?ptype=cart&'+dataString,
    type: 'GET',
    dataType: 'html',
    timeout: 9000,
    error: function(){
        alert(ERROR_LOADING_CART_INFO_JS_MSG);
    },
    success: function(html){
        if(eval(document.getElementById('cart_information_span')))
        {
            document.getElementById('cart_information_span').innerHTML=html;
        }
		if(eval(document.getElementById('cart_information_span1')))
        {
            document.getElementById('cart_information_span1').innerHTML=html;
        }
        if(eval(document.getElementById('addtocartformspan')))
        {
            document.getElementById('addtocartformspan').innerHTML = '<strong>'+ADDED_CART_SUCCESS_MSG+'<Br><a href="'+siteurl+'/?ptype=cart">'+VIEW_CART_DETAIL_TEXT+'</a> or <a href="'+siteurl+'/?ptype=cart">'+CHECKOUT_TEXT+' &raquo;</a></strong>';
        }
    }
});	
}
function refresh_cartinfo_sidebar()
{
	$.ajax({
		url: siteurl+'/?page=cart&cartact=cart_refresh',
		type: 'GET',
		dataType: 'html',
		timeout: 20000,
		error: function(){
			//alert('Error loading cart information');
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
		url: siteurl+'/?ptype=cart&pid='+post_id+'&'+dataString+'&cartact=stock_chk',
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
			}else
			{
				document.getElementById('addtocartformspan').innerHTML = html;
			}
		}
	});
}