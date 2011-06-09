$(document).ready(function(){
$("a.zoom").fancybox();
$('.hide').hide();
$('body').append('<div id="infoBacking"></div><div id="infoHolder" class="large"></div>');
$('#infoBacking').css({position:'absolute', left:0, top:0, display:'none', textAlign:'center', background:'', zIndex:'600'});
$('#infoHolder').css({left:0, top:0, display:'none', textAlign:'center', zIndex:'600', position:'absolute'});
if($.browser.msie){$('#infoHolder').css({position:'absolute'});}


$('.more').mouseover(function() {$(this).css({textDecoration:'none'});} );
$('.more').mouseout(function() {$(this).css({textDecoration:'none'});} );

$('.more').click(function(){

if ($('.' + $(this).attr("title")).length > 0) {

	browserWindow()
	getScrollXY()

	if (height<totalY) { height=totalY; }

	$('#infoBacking').css({width: totalX + 'px', height: height + 'px', top:'0px', left:scrOfX + 'px', opacity:0.85});
	$('#infoHolder').css({width: width + 'px', top:scrOfY + 25 + 'px', left:scrOfX + 'px'});
	source = $(this).attr("title");

	$('#infoHolder').html('<div id="info">' + $('.' + source).html() + '<p class="clear"><span class="close">Close X</span></p></div>');

	$('#infoBacking').css({display:'block'});
	$('#infoHolder').show();
	$('#info').fadeIn('slow');
}

$('.close').click(function(){
	$('#infoBacking').hide();
	$('#infoHolder').fadeOut('fast');
});

});

/* find browser window size */
function browserWindow () {
	width = 0
	height = 0;
	if (document.documentElement) {
		width = document.documentElement.offsetWidth;
		height = document.documentElement.offsetHeight;
	} else if (window.innerWidth && window.innerHeight) {
		width = window.innerWidth;
		height = window.innerHeight;
	}
	return [width, height];
}
/* find total page height */
function getScrollXY() {
	scrOfX = 0; 
	scrOfY = 0;
	if( typeof( window.pageYOffset ) == 'number' ) {
		scrOfY = window.pageYOffset;
		scrOfX = window.pageXOffset;
	} else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
		scrOfY = document.body.scrollTop;
		scrOfX = document.body.scrollLeft;
	} else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) {
		scrOfY = document.documentElement.scrollTop;
		scrOfX = document.documentElement.scrollLeft;
	}
	totalY = (window.innerHeight != null? window.innerHeight : document.documentElement && document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body != null ? document.body.clientHeight : null);

	totalX = (window.innerWidth != null? window.innerWidth : document.documentElement && document.documentElement.clientWidth ? document.documentElement.clientWidth : document.body != null ? document.body.clientWidth : null);
	
	return [ scrOfX, scrOfY, totalY, totalX ];
}

return false;
});

function set_donation_amt(donationamt)
{
	document.getElementById('product_price').value = donationamt;
}

function isNumberKey(evt)
{
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57))
	return false;

 return true;
}
