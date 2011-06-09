<?php
$dummy_image_path = get_stylesheet_directory_uri().'/images/dummy/';
set_time_limit(0);
global  $wpdb;

/////////////// GENERAL SETTINGS START ///////////////
$shoppingcart_general_settings = get_option('shoppingcart_general_settings');
if(!$shoppingcart_general_settings || ($shoppingcart_general_settings && count($shoppingcart_general_settings)==0))
{
	$cartinfo = array(
						"currency"				=> 'USD',
						"currencysym"			=> '$',
						"site_email"			=>   get_option('admin_email'),
						"site_email_name"		=>	get_option('blogname'),
						"tax"					=>	'0.00',
						"is_show_weight"		=>	'1',
						"store_type"			=>	'cart',
						"imagepath"				=>	"",		
						"is_show_coupon"		=>	"1",
						"dash_noof_orders"		=>	"10",
						"is_show_tellafrnd"		=>	"1",
						"is_show_addcomment"	=>	"0",
						"checkout_type"			=>	"cart",
						"is_show_relproducts"	=>	"1",
						"digitalproductpath"	=>	"",
						"is_show_blogpage"		=>	"1",
						"is_show_storepage"		=>	"1",
						"is_show_category"		=>	"1",
						"checkout_method"		=>	"normal",
						"is_show_termcondition"	=>	'1',
						"termcondition"			=>	'Accept Terms and Conditions',
						"loginpagecontent"		=>	'If you are an existing customer of [#$store_name#] or have previously registered you may sign in below or request a new password. Otherwise please enter your information below and an account will be created for you.',												
						"bill_address1"			=>	"1",
						"bill_address2"			=>	"1",																	
						"bill_city"				=>	"1",
						"bill_state"			=>	"1",
						"bill_country"			=>	"1",
						"bill_zip"				=>	"1",
						"is_active_affiliate"	=>	"0",
						"send_email_guest"		=>	"1",						
						);
	foreach($cartinfo as $key=>$val)
	{
		update_option($key,$val);
	}
}
/////////////// GENERAL SETTINGS END ///////////////
/////////////// PAYMENT SETTINGS START ///////////////
	$paymethodinfo = array();
	$payOpts = array();
	$payOpts[] = array(
					"title"			=>	"Merchant Id",
					"fieldname"		=>	"merchantid",
					"value"			=>	"myaccount@paypal.com",
					"description"	=>	"Example : myaccount@paypal.com",
					);
	$payOpts[] = array(
					"title"			=>	"Cancel Url",
					"fieldname"		=>	"cancel_return",
					"value"			=>	get_option('siteurl')."/?ptype=cancel_return&pmethod=paypal",
					"description"	=>	"Example : http://mydomain.com/cancel_return.php",
					);
	$payOpts[] = array(
					"title"			=>	"Return Url",
					"fieldname"		=>	"returnUrl",
					"value"			=>	get_option('siteurl')."/?ptype=return&pmethod=paypal",
					"description"	=>	"Example : http://mydomain.com/return.php",
					);
	$payOpts[] = array(
					"title"			=>	"Notify Url",
					"fieldname"		=>	"notify_url",
					"value"			=>	get_option('siteurl')."/?ptype=notifyurl&pmethod=paypal",
					"description"	=>	"Example : http://mydomain.com/notifyurl.php",
					);								
	$paymethodinfo[] = array(
						"name" 		=> 'Paypal',
						"key" 		=> 'paypal',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'1',
						"payOpts"	=>	$payOpts,
						);
	//////////pay settings end////////
	//////////google checkout start////////
	$payOpts = array();
	$payOpts[] = array(
					"title"			=>	"Merchant Id",
					"fieldname"		=>	"merchantid",
					"value"			=>	"1234567890",
					"description"	=>	"Example : 1234567890"
					);
	$paymethodinfo[] = array(
						"name" 		=> 'Google Checkout',
						"key" 		=> 'googlechkout',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'2',
						"payOpts"	=>	$payOpts,
						);
//////////google checkout end////////
//////////authorize.net start////////
$payOpts = array();
	$payOpts[] = array(
					"title"			=>	"Login ID",
					"fieldname"		=>	"loginid",
					"value"			=>	"yourname@domain.com",
					"description"	=>	"Example : yourname@domain.com"
					);
	$payOpts[] = array(
					"title"			=>	"Transaction Key",
					"fieldname"		=>	"transkey",
					"value"			=>	"1234567890",
					"description"	=>	"Example : 1234567890",
					);
	$paymethodinfo[] = array(
						"name" 		=> 'Authorize.net',
						"key" 		=> 'authorizenet',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'3',
						"payOpts"	=>	$payOpts,
						);
//////////authorize.net end////////
//////////worldpay start////////
	$payOpts = array();	
	$payOpts[] = array(
					"title"			=>	"Instant Id",
					"fieldname"		=>	"instId",
					"value"			=>	"123456",
					"description"	=>	"Example : 123456"
					);
	$payOpts[] = array(
					"title"			=>	"Account Id",
					"fieldname"		=>	"accId1",
					"value"			=>	"12345",
					"description"	=>	"Example : 12345"
					);
	$paymethodinfo[] = array(
						"name" 		=> 'Worldpay',
						"key" 		=> 'worldpay',
						"isactive"	=>	'1', // 1->display,0->hide\
						"display_order"=>'4',
						"payOpts"	=>	$payOpts,
						);
//////////worldpay end////////
//////////2co start////////
	$payOpts = array();
	$payOpts[] = array(
					"title"			=>	"Vendor ID",
					"fieldname"		=>	"vendorid",
					"value"			=>	"1303908",
					"description"	=>	"Enter Vendor ID Example : 1303908"
					);
	$payOpts[] = array(
					"title"			=>	"Notify Url",
					"fieldname"		=>	"ipnfilepath",
					"value"			=>	get_option('siteurl')."/?ptype=notifyurl&pmethod=2co",
					"description"	=>	"Example : http://mydomain.com/2co_notifyurl.php",
					);
	$paymethodinfo[] = array(
						"name" 		=> '2CO (2Checkout)',
						"key" 		=> '2co',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'5',
						"payOpts"	=>	$payOpts,
						);
//////////2co end////////
//////////pre bank transfer start////////
	$payOpts = array();
	$payOpts[] = array(
					"title"			=>	"Bank Information",
					"fieldname"		=>	"bankinfo",
					"value"			=>	"ICICI Bank",
					"description"	=>	"Enter the bank name to which you want to transfer payment"
					);
	$payOpts[] = array(
					"title"			=>	"Account ID",
					"fieldname"		=>	"bank_accountid",
					"value"			=>	"AB1234567890",
					"description"	=>	"Enter your bank Account ID",
					);
	$paymethodinfo[] = array(
						"name" 		=> 'Pre Bank Transfer',
						"key" 		=> 'prebanktransfer',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'6',
						"payOpts"	=>	$payOpts,
						);				
//////////pre bank transfer end////////
//////////pay cash on devivery start////////
	$payOpts = array();
	$paymethodinfo[] = array(
						"name" 		=> 'Pay Cash On Delivery',
						"key" 		=> 'payondelevary',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'7',
						"payOpts"	=>	$payOpts,
						);
//////////pay cash on devivery end////////
for($i=0;$i<count($paymethodinfo);$i++)
{
	$payment_method_info = array();
	$payment_method_info  = get_option('payment_method_'.$paymethodinfo[$i]['key']);
	if(!$payment_method_info)
	{
		update_option('payment_method_'.$paymethodinfo[$i]['key'],$paymethodinfo[$i]);
	}
}
/////////////// PAYMENT SETTINGS END ///////////////
/////////////// SHIPPING METHIDS START /////////////// 
$shippingmethodinfo = array();
$payOpts = array();
$payOpts[] = array(
				"title"			=>	"Enable Free Shipping?",
				"fieldname"		=>	"free_shipping_amt",
				"value"			=>	"0",
				"description"	=>	"Example : shipping amt = 0 ",
				);
$payOpts = array();
$shippingmethodinfo[] = array(
					"name" 		=> 'Free Shipping',
					"key" 		=> 'free_shipping',
					"isactive"	=>	'1', // 1->display,0->hide
					"payOpts"	=>	$payOpts,
					);
///////////////////////////////////////
$payOpts = array();
$payOpts[] = array(
				"title"			=>	"Shipping Amount",
				"fieldname"		=>	"flat_rate_amt",
				"value"			=>	"0",
				"description"	=>	"Example : enter a value that will be added as default for shipping when someone goes throught checkout"
				);
$shippingmethodinfo[] = array(
					"name" 		=> 'Flat Rate Shipping',
					"key" 		=> 'flat_rate',
					"isactive"	=>	'0', // 1->display,0->hide
					"payOpts"	=>	$payOpts,
					);
///////////////////////////////////////
$payOpts = array();
$payOpts[] = array(
				"title"			=>	"Price Shipping 1",
				"fieldname"		=>	"price_shipping1",
				"value"			=>	"10->100=1",
				"description"	=>	'Example : if total price is between $10 and $100 then shipping price is $1 so the equation is -> <strong>10->100=1</strong>'
				);
$payOpts[] = array(
				"title"			=>	"Price Shipping 2",
				"fieldname"		=>	"price_shipping2",
				"value"			=>	"101->200=10",
				"description"	=>	'Example : if total price is between $101 and $200 then shipping price is $10 so the equation is -> <strong>101->200=10</strong>'
				);
$payOpts[] = array(
				"title"			=>	"Price Shipping 3",
				"fieldname"		=>	"price_shipping3",
				"value"			=>	"201->300=20",
				"description"	=>	'Example : if total price is between $201 and $300 then shipping price is $20 so the equation is -> <strong>201->300=20</strong>'
				);
$payOpts[] = array(
				"title"			=>	"Price Shipping 4",
				"fieldname"		=>	"price_shipping4",
				"value"			=>	"301->500=50",
				"description"	=>	'Example : if total price is between $301 and $500 then shipping price is $50 so the equation is -> <strong>301->500=50</strong>'
				);
$payOpts[] = array(
				"title"			=>	"Price Shipping 5",
				"fieldname"		=>	"price_shipping5",
				"value"			=>	"501->1000=60",
				"description"	=>	'Example : if total price is between $301 and $500 then shipping price is $60 so the equation is -> <strong>301->500=60</strong>'
				);
$shippingmethodinfo[] = array(
					"name" 		=> 'Price Base Shipping',
					"key" 		=> 'price_base',
					"isactive"	=>	'0', // 1->display,0->hide
					"payOpts"	=>	$payOpts,
					);
///////////////////////////////////////
$payOpts = array();
$payOpts[] = array(
				"title"			=>	"Weight Shipping 1",
				"fieldname"		=>	"price_shipping1",
				"value"			=>	"1->10=10",
				"description"	=>	"Example : if total weight is between 1 lbs and 10 lbs then shipping price is $10 so the equation is -> <strong>1->10=10</strong>"
				);
$payOpts[] = array(
				"title"			=>	"Weight Shipping 2",
				"fieldname"		=>	"price_shipping2",
				"value"			=>	"11->51=20",
				"description"	=>	"Example : if total weight is between 11 lbs and 51 lbs then shipping price is $20 so the equation is -> <strong>11->51=20</strong>"
				);
$payOpts[] = array(
				"title"			=>	"Weight Shipping 3",
				"fieldname"		=>	"price_shipping3",
				"value"			=>	"51->100=30",
				"description"	=>	"Example : if total weight is between 51 lbs and 100 lbs then shipping price is $30 so the equation is -> <strong>51->100=30</strong>"
				);
$payOpts[] = array(
				"title"			=>	"Weight Shipping 4",
				"fieldname"		=>	"price_shipping4",
				"value"			=>	"101->150=40",
				"description"	=>	"Example : if total weight is between 101 lbs and 150 lbs then shipping price is $40 so the equation is -> <strong>101->150=40</strong>"
				);
$payOpts[] = array(
				"title"			=>	"Weight Shipping 5",
				"fieldname"		=>	"price_shipping5",
				"value"			=>	"151->200=40",
				"description"	=>	"Example : if total weight is between 101 lbs and 150 lbs then shipping price is $40 so the equation is -> <strong>151->200=40</strong>"
				);
$shippingmethodinfo[] = array(
					"name" 		=> 'Weight Base Shipping',
					"key" 		=> 'weight_base',
					"isactive"	=>	'0', // 1->display,0->hide
					"payOpts"	=>	$payOpts,
					);
						
for($i=0;$i<count($shippingmethodinfo);$i++)
{
	$shipping_method_info = array();
	$shipping_method_info  = get_option('shipping_method_'.$shippingmethodinfo[$i]['key']);
	if(!$shipping_method_info)
	{
		update_option('shipping_method_'.$shippingmethodinfo[$i]['key'],$shippingmethodinfo[$i]);
	}
}
/////////////// SHIPPING METHIDS END ///////////////
/////////////// DISCOUNT COUPON START ///////////////
$discount_coupons = array();
$discount_coupons  = get_option('discount_coupons');
if(!$discount_coupons)
{
	$discount_coupons_arr[] = array(
						"couponcode"	=>	'FRIENDS',
						"dis_per"		=>	'per',
						"dis_amt"		=>	'15',
						);
	$discount_coupons_arr[] = array(
						"couponcode"	=>	'SPECIAL',
						"dis_per"		=>	'amt',
						"dis_amt"		=>	'100',
						);
	update_option('discount_coupons',$discount_coupons_arr);
}
/////////////// DISCOUNT COUPON END ///////////////

/////////////// TERMS START ///////////////
require_once(ABSPATH.'wp-admin/includes/taxonomy.php');
$category_array = array('Blog','Feature','Electronics','Beauty &amp; Fragrance','Books',array('Digital Products','Icons','Wordpress Theme'),'Kids',array('Men','Coats &amp; Jackets','Hats, Gloves &amp; Scarves','Shirts and Ties'),array('Shoe','Boots','Sandals'));
insert_category($category_array);
function insert_category($category_array)
{
	for($i=0;$i<count($category_array);$i++)
	{
		$parent_catid = 0;
		if(is_array($category_array[$i]))
		{
			$cat_name_arr = $category_array[$i];
			for($j=0;$j<count($cat_name_arr);$j++)
			{
				$catname = $cat_name_arr[$j];
				$last_catid = wp_create_category( $catname, $parent_catid);
				if($j==0)
				{
					$parent_catid = $last_catid;
				}
			}
			
		}else
		{
			$catname = $category_array[$i];
			wp_create_category( $catname, $parent_catid);
		}
	}
}
/////////////// TERMS END ///////////////

$post_info = array();
////post start 1///
$image_array = array();
$post_meta = array();
$post_meta = array(
					"tl_dummy_content"	=> '1',
				);
$post_info[] = array(
					"post_title"	=>	'Sample Lorem Ipsum Post',
					"post_content"	=>	'What is Lorem Ipsum?<br><br>
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
Why do we use it?<br><br>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &acute;Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &acute;lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
<br><br>Where does it come from?',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Blog'),
					"post_tags"		=>	array()
					);
////post end///
////post start 1///
$image_array = array();
$post_meta = array();
$post_meta = array(
					"tl_dummy_content"	=> '1',
				);
$post_info[] = array(
					"post_title"	=>	'Sample Blog Post',
					"post_content"	=>	'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Blog'),
					"post_tags"		=>	array()
					);
////post end///
////post start 1///
$image_array = array();
$post_meta = array();
$post_meta = array(
					"tl_dummy_content"	=> '1',
				);
$post_info[] = array(
					"post_title"	=>	'What is Lorem Ipsum?',
					"post_content"	=>	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
Why do we use it?<br><br>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &acute;Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &acute;lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
<br><br>Where does it come from?',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Blog'),
					"post_tags"		=>	array()
					);
////post end///
$post_meta = array(
					"tl_dummy_content"	=> '1',
				);
$post_info[] = array(
					"post_title"	=>	'Letraset sheets',
					"post_content"	=>	'When an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
Why do we use it?<br><br>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &acute;Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &acute;lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br><br>Where does it come from?',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Blog'),
					"post_tags"		=>	array()
					);
////post end///
$post_meta = array(
					"tl_dummy_content"	=> '1',
				);
$post_info[] = array(
					"post_title"	=>	'Why do we use it?',
					"post_content"	=>	' It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
Why do we use it?<br><br>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &acute;Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &acute;lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Blog'),
					"post_tags"		=>	array()
					);
////post end///
//====================================================================================//
$image_array = array();
$image_array[0] = "dummy/mouse.jpg";
$post_meta = array();
$post_meta1 = array(
				   "price"					=> '70',	
					"specialprice"			=> '50',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"	=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Kensington PocketMouse',
					"post_content"	=>	'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam, justo convallis luctus rutrum, erat nulla fermentum diam. Nam blandit lacus. Quisque ornare risus quis ligula.Phasellus tristique purus a augue condimentum adipiscing. Aenean sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at, odio. Donec et ipsum et sapien vehicula nonummy.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Electronics','Feature'),
					"post_tags"		=>	array('Mouse')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/13.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '400',	
					"specialprice"			=> '350',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"	=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Mac Pro',
					"post_content"	=>	'The Quad-Core Intel Xeon processor in the Mac Pro is based on the next-generation Intel Core microarchitecture, also known as Nehalem, and includes the following features:<br><br>
* 8MB of fully shared L3 cache per processor, which boosts performance by keeping data and instructions in a fast-access cache that is available to all four processor cores.<br>
* An integrated memory controller, which allows faster access to data stored in memory by significantly increasing memory bandwidth and reducing memory latency by up to 40%.<br>
* Turbo Boost, a dynamic performance technology that automatically speeds up the cores in use when other cores arent needed.<br>
* Hyper-Threading technology allows two threads to run simultaneously on each processor core, providing eight virtual cores for increased performance.<br><br>
Which processor speed is right for you? The more time you spend using processor-intensive applications - such as video processing, image editing, 3D rendering, and others - the more youll benefit from a higher-speed processor.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Electronics','Feature'),
					"post_tags"		=>	array('Mac')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/12.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '232',	
					"specialprice"			=> '',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"	=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'iPod Classic',
					"post_content"	=>	'Say youre listening to a song you really like and want to hear other tracks that go great with it. With a few clicks, the Genius feature finds other songs on your iPod classic that sound great with the one youre listening to, then makes a Genius playlist for you. Or get even more sets of customized songs when you use the new Genius Mixes feature in iTunes. Just sync your iPod classic to iTunes, and Genius automatically searches your library to create perfect mixes youll love.<br><br>
Finding exactly what you want to watch or listen to is easy. Use the Click Wheel to browse by album art with Cover Flow or navigate your songs and videos by playlist, artist, album, genre, and more. You can also search for specific titles and artists. Want to mix things up? Click Shuffle Songs for a different experience every time.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Electronics','Feature'),
					"post_tags"		=>	array('iPod')
					);
////post end///

$image_array = array();
$image_array[0] = "dummy/09.jpg";
$post_meta = array();
$post_meta1 = array(
				  	"price"					=> '355',	
					"specialprice"			=> '',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"	=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'iPod',
					"post_content"	=>	'Say you find yourself in the middle of an impromptu shopping cart race. Or in the dining hall when a colossal food fight breaks out. Now you can prove it really happened with the iPod nano video camera. Shoot high-quality video in portrait or landscape - perfect for posting on the web or emailing friends. iPod nano also includes a microphone that captures clean audio you can listen to during playback on the built-in speaker.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Electronics','Feature'),
					"post_tags"		=>	array('iPod')
					);
////post end///

$image_array = array();
$image_array[0] = "dummy/05.jpg";
$post_meta = array();
$post_meta1 = array(
				  	"price"					=> '222',	
					"specialprice"			=> '',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"	=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'iPod Apple',
					"post_content"	=>	'If youre somewhere with a wireless network, iPod touch instantly recognizes it. If it free Wi-Fi, youre good to go. Launch any one of your Wi-Fi-dependent apps, such as Safari or iTunes, and youre on. Some wireless networks may require a password, but iPod touch has that covered, too. Just enter the password once, and iPod touch remembers it. So the next time youre within range of that network, youre connected automatically.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Electronics','Feature'),
					"post_tags"		=>	array('iPod')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/24.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '350',	
					"specialprice"			=> '',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"	=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'iMac',
					"post_content"	=>	'<h4>LED backlighting. One bright idea.<h4>
Full brightness with no waiting. That the big advantage of the LED-backlit iMac display. Unlike most displays that take time to warm up before they reach maximum brightness, an LED-backlit display is instantly on and uniformly bright. LED backlighting also gives you greater control over screen brightness. So you can finely tune the iMac display to suit the ambient light in even the dimmest room.
More pixels. Better picture.<br><br>
The new iMac offers some prime pixel real estate. The 21.5-inch, 1920-by-1080 display has 17 percent more pixels than the previous 20-inch iMac. The 27-inch, 2560-by-1440 display has a whopping 78 percent more pixels than the 21.5-inch iMac. And a 1000:1 contrast ratio gives you more vibrant colors and blacker blacks. All that in a widescreen display with a 16:9 aspect ratio - the same as an HD TV.
Stunning from every angle.<br><br>
The new iMac display looks great from any seat in the house, thanks to a premium display technology called in-plane switching (IPS). IPS gives you a bright picture with excellent color consistency - even if youre viewing the display from the side.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Electronics','Feature'),
					"post_tags"		=>	array('iMac')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/04.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '350',	
					"specialprice"			=> '',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"	=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Zebronics Antibiotic',
					"post_content"	=>	'Antibiotic 3 LED Fans(1Side,1Black,Hop) Transparent Side Panel Temperature Display USB & Audio Port<br><br>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam, justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at, odio. Donec et ipsum et sapien vehicula nonummy.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Electronics','Feature'),
					"post_tags"		=>	array('')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/01.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '250',	
					"specialprice"			=> '',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"	=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Creative Inspire 2.1 Speakers',
					"post_content"	=>	'# Based on our most popular subwoofer speaker systems<br>
# Creative Inspire 2.1 2500 speakers feature more power<br>
# performance<br><br>
# high quality audio typically found in high-end home stereo systems<br>
# This extraordinary subwoofer speaker system is perfect for music listening and gaming on your PC<br>
# Creative Inspire 2.1 2500 features a heavily reinforced wood subwoofer<br>
# two satellite speakers featuring Image Focusing Plate (IFP) design for broad sound dispersion without sacrificing tonal balance<br>
# 1 Years Limited Warranty',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Electronics','Feature'),
					"post_tags"		=>	array('Speakers')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/untitled-2.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '500',	
					"specialprice"			=> '',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"	=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Acer Entra E961 Athlon',
					"post_content"	=>	'Environmental awareness A design concept focusing on environmental protection results in less waste from packaging, higher performance with lower power consumption for reduced carbon dioxide emissions, and more efficient delivery.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Electronics','Feature'),
					"post_tags"		=>	array('Speakers')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/untitled-1.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '950',	
					"specialprice"			=> '850',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"	=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Dell Studio One 19',
					"post_content"	=>	'It One for All The new Studio One 19 desktop has packed everything you need and want into one beautiful design with optional multi-touch screen capabilities. Whether you are perusing your photos, youll be impressed with the crystal clear clarity on its 18.5" HD widescreen display. With a variety of performance features and colorful personalisation options, the Studio One 19 desktop was designed to fit seamlessly in your home while complementing your style.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Electronics','Feature'),
					"post_tags"		=>	array('')
					);
////post end///
//====================================================================================//
$image_array = array();
$image_array[0] = "dummy/perfum_01.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '95',	
					"specialprice"			=> '80',	
					"size"					=> 'small,mideum',
					"color"					=> 'golden,silver,white',
					"posttype"				=> 'product',
					"tl_dummy_content"	=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Couture Couture',
					"post_content"	=>	'Juicy Couture is busting out with a decadent new scent. An it girl fragrance named Couture Couture. Go Couture Yourself with natural orange flower and a succulent pink grape accord, star jasmine, amber, vanilla and creamy sandlewood. Spoil her the Couture Couture way with this Set includes a 3.4 oz. Eau de Parfum Spray, 6.7 oz. Body Creme and a 1.4 oz. Dusting Powder Shaker with Powder Puff.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Beauty &amp; Fragrance'),
					"post_tags"		=>	array('')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/perfum_02.jpg";
$image_array[1] = "dummy/perfum_03.jpg";
$image_array[2] = "dummy/perfum_04.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '150',	
					"specialprice"			=> '100',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"	=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Queen by Queen',
					"post_content"	=>	'This Queen by Queen Latifah gift set includes a 3.4 oz. Eau de Parfum Spray & 3 oz. Body Lotion & Body Butter.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Beauty &amp; Fragrance'),
					"post_tags"		=>	array('')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/perfum_03.jpg";
$image_array[1] = "dummy/perfum_07.jpg";
$image_array[2] = "dummy/perfum_04.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '100',	
					"specialprice"			=> '70',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"	=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Gabbana the One Set',
					"post_content"	=>	'This set includes a Eau de Parfum Spray, 2.5 oz. Body Lotion, 3.3 oz. Shower Gel, 3.3 oz.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Beauty &amp; Fragrance'),
					"post_tags"		=>	array('')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/perfum_04.jpg";
$image_array[1] = "dummy/perfum_02.jpg";
$image_array[2] = "dummy/perfum_03.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '100',	
					"specialprice"			=> '70',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"		=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Jessica Simpson Fancy',
					"post_content"	=>	'This Fancy Jessica Simpson gift set includes a 3.4 oz. Eau de Parfum Spray and a 6 oz. Body Lotion.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Beauty &amp; Fragrance'),
					"post_tags"		=>	array('')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/perfum_05.jpg";
$image_array[1] = "dummy/perfum_06.jpg";
$image_array[2] = "dummy/perfum_08.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '150',	
					"specialprice"			=> '90',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"		=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Thierry Mugler Angel',
					"post_content"	=>	'Filled with hidden treasures and temptations to indulge a privileged few. With Perfuming Body Lotion and the classic Eau de Parfum Spray embrace you in silken layers of heavenly ANGEL. A delicate application of the sparkling perfumed Diamond Wax gives a final lavish touch to a journey of absolute seduction. .8 fl. oz. Eau de Parfum Refillable Limited Edition Spray 3.4 oz. net wt. Perfuming Body Lotion .07 oz. net wt. Perfumed Diamond Wax<br><h3>Donna Karan Cashmere</h3><br>The Donna Karen Cashmere Mist Cashmere Necessities Set includes a 1.7 oz. Eau de Toilette Spray & a 3.4 oz. Body Lotion.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Beauty &amp; Fragrance'),
					"post_tags"		=>	array('')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/perfum_09.jpg";
$image_array[1] = "dummy/perfum_06.jpg";
$image_array[2] = "dummy/perfum_08.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '150',	
					"specialprice"			=> '90',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"		=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Clinique Get Happy',
					"post_content"	=>	'This set contains: Clinique Happy Perfume Spray 1.0 oz/30 ml & Clinique Happy Body Smoother 2.5 fl oz/75 ml',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Beauty &amp; Fragrance'),
					"post_tags"		=>	array('')
					);
////post end///
//===================================================================================//
$image_array = array();
$image_array[0] = "dummy/book1.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '95',	
					"specialprice"			=> '80',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"		=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Essential ActionScript 3.0',
					"post_content"	=>	'A detailed description of the product. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
<p><b>Specifications</b></p><br>Publisher: O\'Reilly Media, Inc.<br>Language: English<br>ISBN-10: 3613006111<br>ISBN-13: 178-4852006223<br>Paperback: 537 pages',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Beauty &amp; Fragrance'),
					"post_tags"		=>	array('')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/book2.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '150',	
					"specialprice"			=> '100',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"		=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'HTML &amp; XHTML',
					"post_content"	=>	'A detailed description of the product. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
<p><b>Specifications<b></p>Publisher: O Reilly Media, Inc.<br>Language: English<br>ISBN-10: 3613006111<br>ISBN-13: 178-4852006223<br>Paperback: 537 pages',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Beauty &amp; Fragrance'),
					"post_tags"		=>	array('')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/book3.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '200',	
					"specialprice"			=> '150',	
					"size"					=> 'Java Cookbook,JavaScript Guide,JavaScript Good Parts',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"		=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Java',
					"post_content"	=>	'A detailed description of the product. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<p><b>Specifications</b></p>Publisher: O Reilly Media, Inc.<br>Language: English<br>ISBN-10: 3613006111<br>ISBN-13: 178-4852006223<br>Paperback: 537 pages',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Beauty &amp; Fragrance'),
					"post_tags"		=>	array('')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/book5.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '100',	
					"specialprice"			=> '60',	
					"size"					=> 'MySQL Cookbook,SQL In a Nutshell',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"		=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'MySQL',
					"post_content"	=>	'A detailed description of the product. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<p><b>Specifications</b></p>Publisher: O Reilly Media, Inc.<br>Language: English<br>ISBN-10: 3613006111<br>ISBN-13: 178-4852006223<br>Paperback: 537 pages',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Beauty &amp; Fragrance'),
					"post_tags"		=>	array('')
					);
////post end///
//==========================================================================================================//
$image_array = array();
$image_array[0] = "dummy/icons-07-icon-sets.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '10',	
					"specialprice"			=> '7',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"		=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'iMod',
					"post_content"	=>	'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam, justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam ante ac quam.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Digital Products','Icons'),
					"post_tags"		=>	array('')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/free-high-quality-icon-sets-218.jpg";
$image_array[1] = "dummy/icons-01-icon-sets.jpg";
$image_array[2] = "dummy/free-high-quality-icon-sets-196.jpg";
$image_array[3] = "dummy/free-high-quality-icon-sets-106.jpg";
$image_array[4] = "dummy/free-high-quality-icon-sets-108.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '10',	
					"specialprice"			=> '7',	
					"size"					=> 'Stock icons,178 Amazing,E-Commerce,DesignWorkPlan',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"		=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Stock icons',
					"post_content"	=>	'Maecenas urna purus, fermentum id, molestie in, commodo porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at, odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Digital Products','Icons'),
					"post_tags"		=>	array('')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/flags-icon-sets.jpg";
$image_array[1] = "dummy/icons-22-icon-sets.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '10',	
					"specialprice"			=> '7',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"		=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Country Flag Icons',
					"post_content"	=>	'Maecenas urna purus, fermentum id, molestie in, commodo porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at, odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Digital Products','Icons'),
					"post_tags"		=>	array('')
					);
////post end///
////post end///
$image_array = array();
$image_array[0] = "dummy/icons-19-icon-sets.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '8',	
					"specialprice"			=> '5',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"		=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Mini Social Networking Icon set',
					"post_content"	=>	'Maecenas urna purus, fermentum id, molestie in, commodo porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at, odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Digital Products','Icons'),
					"post_tags"		=>	array('')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/icons-19-icon-sets.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '8',	
					"specialprice"			=> '5',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"		=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Mini Social Networking Icon set',
					"post_content"	=>	'Maecenas urna purus, fermentum id, molestie in, commodo porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at, odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Digital Products','Icons'),
					"post_tags"		=>	array('')
					);
////post end///
//=====================================================================================//
$image_array = array();
$image_array[0] = "dummy/template_01.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '70',	
					"specialprice"			=> '50',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"		=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'eBusiness',
					"post_content"	=>	'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam, justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam ante ac quam.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Wordpress Theme'),
					"post_tags"		=>	array('')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/template_02.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '70',	
					"specialprice"			=> '49',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"		=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'eBook',
					"post_content"	=>	'Maecenas urna purus, fermentum id, molestie in, commodo porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at, odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Wordpress Theme'),
					"post_tags"		=>	array('')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/template_02.jpg";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '70',	
					"specialprice"			=> '49',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"		=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[1] = array(
					"post_title"	=>	'eProducts',
					"post_content"	=>	'Maecenas urna purus, fermentum id, molestie in, commodo porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at, odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Wordpress Theme'),
					"post_tags"		=>	array('')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/template_04.png";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '60',	
					"specialprice"			=> '45',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"		=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Gourmet',
					"post_content"	=>	'Maecenas urna purus, fermentum id, molestie in, commodo porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at, odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Wordpress Theme'),
					"post_tags"		=>	array('')
					);
////post end///
////post end///
$image_array = array();
$image_array[0] = "dummy/template_06.png";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '60',	
					"specialprice"			=> '45',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"		=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Snippet',
					"post_content"	=>	'Maecenas urna purus, fermentum id, molestie in, commodo porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at, odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Wordpress Theme'),
					"post_tags"		=>	array('')
					);
////post end///
$image_array = array();
$image_array[0] = "dummy/template_06.png";
$post_meta = array();
$post_meta1 = array(
					"price"					=> '60',	
					"specialprice"			=> '45',	
					"size"					=> '',
					"color"					=> '',
					"posttype"				=> 'product',
					"tl_dummy_content"		=> '1',
				);
$post_meta = array('key'=>$post_meta1,);
$post_info[] = array(
					"post_title"	=>	'Snippet Theme',
					"post_content"	=>	'Maecenas urna purus, fermentum id, molestie in, commodo porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at, odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti.',
					"post_meta"		=>	$post_meta,
					"post_image"	=>	$image_array,
					"post_category"	=>	array('Wordpress Theme'),
					"post_tags"		=>	array('')
					);

////post end///
//===============================================================================//
insert_posts($post_info);
function insert_posts($post_info)
{
	global $wpdb,$current_user;
	for($i=0;$i<count($post_info);$i++)
	{
		$post_title = $post_info[$i]['post_title'];
		
		$post_count = $wpdb->get_var("SELECT count(ID) FROM $wpdb->posts where post_title like \"$post_title\" and post_type='post' and post_status in ('publish','draft')");
		if(!$post_count)
		{
			
			$post_info_arr = array();
			$catids_arr = array();
			$my_post = array();
			$post_info_arr = $post_info[$i];
			if($post_info_arr['post_category'])
			{
				for($c=0;$c<count($post_info_arr['post_category']);$c++)
				{
					$catids_arr[] = get_cat_ID($post_info_arr['post_category'][$c]);
				}
			}else
			{
				$catids_arr[] = 1;
			}
			$my_post['post_title'] = $post_info_arr['post_title'];
			$my_post['post_content'] = $post_info_arr['post_content'];
			if($post_info_arr['post_author'])
			{
				$my_post['post_author'] = $post_info_arr['post_author'];
			}else
			{
				$my_post['post_author'] = 1;
			}
			$my_post['post_status'] = 'publish';
			$my_post['post_category'] = $catids_arr;
			$my_post['tags_input'] = $post_info_arr['post_tags'];
			$last_postid = wp_insert_post( $my_post );
			$post_meta = $post_info_arr['post_meta'];
			if($post_meta)
			{
				foreach($post_meta as $mkey=>$mval)
				{
					update_post_meta($last_postid, $mkey, $mval);
				}
			}
			
			$post_image = $post_info_arr['post_image'];
			update_post_meta($last_postid, 'tl_dummy_content', 1);
			if($post_image)
			{
				for($m=0;$m<count($post_image);$m++)
				{
					$menu_order = $m+1;
					$image_name_arr = explode('/',$post_image[$m]);
					$img_name = $image_name_arr[count($image_name_arr)-1];
					$img_name_arr = explode('.',$img_name);
					$post_img = array();
					$post_img['post_title'] = $img_name_arr[0];
					$post_img['post_status'] = 'attachment';
					$post_img['post_parent'] = $last_postid;
					$post_img['post_type'] = 'attachment';
					$post_img['post_mime_type'] = 'image/jpeg';
					$post_img['menu_order'] = $menu_order;
					$last_postimage_id = wp_insert_post( $post_img );
					update_post_meta($last_postimage_id, '_wp_attached_file', $post_image[$m]);					
					$post_attach_arr = array(
										"width"	=>	580,
										"height" =>	480,
										"hwstring_small"=> "height='150' width='150'",
										"file"	=> $post_image[$m],
										//"sizes"=> $sizes_info_array,
										);
					wp_update_attachment_metadata( $last_postimage_id, $post_attach_arr );
				}
			}
		}
	}
}
/////////////// WIDGET SETTINGS START ///////////////

$latest_info = array();
$latest_info[1] = array(
					"title"				=>	'Latest Products',
					"display_prds_no"	=>	'10',
					"list_type"			=>	'Grid',
					"show_store_link"	=>	'#',
					"image_width"		=>	'150',
					"image_height"		=>	'150',
					);
$latest_info['_multiwidget'] = '1';

update_option('widget_latest_product_info',$latest_info);
$latest_info = get_option('widget_latest_product_info');
krsort($latest_info);
foreach($latest_info as $key1=>$val1)
{
	$latest_info_key = $key1;
	if(is_int($latest_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-3"] = array('latest_product_info-'.$latest_info_key);
$recent_info = array();
$recent_info[1] = array(
					"title"				=>	'',
					"number"			=>	'5',
					);
$recent_info['_multiwidget'] = '1';

update_option('widget_recent-posts',$recent_info);
$recent_info = get_option('widget_recent-posts');
krsort($recent_info);
foreach($recent_info as $key1=>$val1)
{
	$recent_info_key = $key1;
	if(is_int($recent_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-5"] = array('recent-posts-'.$recent_info_key);
$recent_info = array();
$recent_info = get_option('widget_recent-posts');
$recent_info[3] = array(
					"title"				=>	'',
					"number"			=>	'5',
					);
$recent_info['_multiwidget'] = '1';

update_option('widget_recent-posts',$recent_info);
$recent_info = get_option('widget_recent-posts');
krsort($recent_info);
foreach($recent_info as $key1=>$val1)
{
	$recent_info_key = $key1;
	if(is_int($recent_info_key))
	{
		break;
	}
}
$comments_info = array();
$comments_info = get_option('widget_recent-comments');
$comments_info[2] = array(
					"title"				=>	'Recent Comments',
					"number"				=>	'5',
					);
$comments_info['_multiwidget'] = '1';

update_option('widget_recent-comments',$comments_info);
$comments_info = get_option('widget_recent-comments');
krsort($comments_info);
foreach($comments_info as $key1=>$val1)
{
	$comments_info_key = $key1;
	if(is_int($comments_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-8"] = array('recent-posts-'.$recent_info_key,'recent-comments-'.$comments_info_key);
$recent_info = array();
$recent_info = get_option('widget_recent-posts');
$recent_info[2] = array(
					"title"				=>	'',
					"number"			=>	'5',
					);
$recent_info['_multiwidget'] = '1';

update_option('widget_recent-posts',$recent_info);
$recent_info = get_option('widget_recent-posts');
krsort($recent_info);
foreach($recent_info as $key1=>$val1)
{
	$recent_info_key = $key1;
	if(is_int($recent_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-7"] = array('recent-posts-'.$recent_info_key);

$cart_info = array();
$cart_info[1] = array(
					"title"				=>	'Shopping Cart',
					);
$cart_info['_multiwidget'] = '1';

update_option('widget_shopping_cart_info',$cart_info);
$cart_info = get_option('widget_shopping_cart_info');
krsort($cart_info);
foreach($cart_info as $key1=>$val1)
{
	$cart_info_key = $key1;
	if(is_int($cart_info_key))
	{
		break;
	}
}
$cat_info = array();
$cat_info[1] = array(
					"title"				=>	'Our Products',
					);
$cat_info['_multiwidget'] = '1';

update_option('widget_browse_by_cats',$cat_info);
$cat_info = get_option('widget_browse_by_cats');
krsort($cat_info);
foreach($cat_info as $key1=>$val1)
{
	$cat_info_key = $key1;
	if(is_int($cat_info_key))
	{
		break;
	}
}
$links_info = array();
$links_comments_info[1] = array(
					"images"			=>	'1',
					"name"			 	=>	'1',
					"description"		 =>	'1',
					"rating"			 =>	'0',
					"category"			 =>	'0',
					);
$links_comments_info['_multiwidget'] = '1';
update_option('widget_links',$links_comments_info);
$links_comments_info = get_option('widget_links');
krsort($links_comments_info);
foreach($links_comments_info as $key1=>$val1)
{
	$links_info_key = $key1;
	if(is_int($links_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-6"] = array('shopping_cart_info-'.$cart_info_key,'browse_by_cats-'.$cat_info_key,'links-'.$links_info_key);
$srch_info = array();
$srch_info[1] = array(
					"title"				=>	'Search',
					);
$srch_info['_multiwidget'] = '1';

update_option('widget_search',$srch_info);
$srch_info = get_option('widget_search');
krsort($srch_info);
foreach($srch_info as $key1=>$val1)
{
	$srch_info_key = $key1;
	if(is_int($srch_info_key))
	{
		break;
	}
}
$popularposts_info = array();
$popularposts_info = array(
					"name"				=>	'Popular Post',
					"number"			=>	'5',
					);

update_option('widget_popularposts',$popularposts_info);
$popularposts_info = get_option('widget_popularposts');

$wp_sidebar_widgets["sidebar-9"] = array('pt-popular-posts','search-'.$srch_info_key);
$cart_info = array();
$cart_info = get_option('widget_shopping_cart_info');
$cart_info[2] = array(
					"title"				=>	'Shopping Cart',
					);
$cart_info['_multiwidget'] = '1';

update_option('widget_shopping_cart_info',$cart_info);
$cart_info = get_option('widget_shopping_cart_info');
krsort($cart_info);
foreach($cart_info as $key1=>$val1)
{
	$cart_info_key = $key1;
	if(is_int($cart_info_key))
	{
		break;
	}
}
$category_info = array();
$category_info[1] = array(
					"title"				=>	'Categories',
					"count"				=>	'0',
					"hierarchical"		=>	'0',
					"dropdown"			=>	'0',
					);
$category_info['_multiwidget'] = '1';

update_option('widget_categories',$category_info);
$category_info = get_option('widget_categories');
krsort($category_info);
foreach($category_info as $key1=>$val1)
{
	$category_info_key = $key1;
	if(is_int($category_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-10"] = array('shopping_cart_info-'.$cart_info_key,'categories-'.$category_info_key);
$cat_info = array();
$cat_info = get_option('widget_browse_by_cats');
$cat_info[2] = array(
					"title"				=>	'Our Products',
					);
$cat_info['_multiwidget'] = '1';

update_option('widget_browse_by_cats',$cat_info);
$cat_info = get_option('widget_browse_by_cats');
krsort($cat_info);
foreach($cat_info as $key1=>$val1)
{
	$cat_info_key = $key1;
	if(is_int($cat_info_key))
	{
		break;
	}
}
$comments_info = array();
$comments_info[1] = array(
					"title"				=>	'Recent Comments',
					"number"				=>	'5',
					);
$comments_info['_multiwidget'] = '1';

update_option('widget_recent-comments',$comments_info);
$comments_info = get_option('widget_recent-comments');
krsort($comments_info);
foreach($comments_info as $key1=>$val1)
{
	$comments_info_key = $key1;
	if(is_int($comments_info_key))
	{
		break;
	}
}

$wp_sidebar_widgets["sidebar-11"] = array('recent-comments-'.$comments_info_key,'browse_by_cats-'.$cat_info_key);
$recent_info = array();
$recent_info = get_option('widget_recent-posts');
$recent_info[3] = array(
					"title"				=>	'',
					"number"			=>	'5',
					);
$recent_info['_multiwidget'] = '1';

update_option('widget_recent-posts',$recent_info);
$recent_info = get_option('widget_recent-posts');
krsort($recent_info);
foreach($recent_info as $key1=>$val1)
{
	$recent_info_key = $key1;
	if(is_int($recent_info_key))
	{
		break;
	}
}
$comments_info = array();
$comments_info = get_option('widget_recent-comments');
$comments_info[2] = array(
					"title"				=>	'Recent Comments',
					"number"				=>	'5',
					);
$comments_info['_multiwidget'] = '1';

update_option('widget_recent-comments',$comments_info);
$comments_info = get_option('widget_recent-comments');
krsort($comments_info);
foreach($comments_info as $key1=>$val1)
{
	$comments_info_key = $key1;
	if(is_int($comments_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-12"] = array('recent-posts-'.$recent_info_key,'recent-comments-'.$comments_info_key);


$category_info = array();
$category_info = get_option('widget_categories');
$category_info[2] = array(
					"title"				=>	'Categories',
					"count"				=>	'0',
					"hierarchical"		=>	'0',
					"dropdown"			=>	'0',
					);
$category_info['_multiwidget'] = '1';

update_option('widget_categories',$category_info);
$category_info = get_option('widget_categories');
krsort($category_info);
foreach($category_info as $key1=>$val1)
{
	$category_info_key = $key1;
	if(is_int($category_info_key))
	{
		break;
	}
}
//'categories-'.$category_info_key
$archive_info = array();
$archive_info[1] = array(
					"title"				=>	'Archives',
					"count"				=>	'0',
					"dropdown"			=>	'0',
					);
$archive_info['_multiwidget'] = '1';

update_option('widget_archives',$archive_info);
$archive_info = get_option('widget_archives');
krsort($archive_info);
foreach($archive_info as $key1=>$val1)
{
	$archive_info_key = $key1;
	if(is_int($archive_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-14"] = array('categories-'.$category_info_key,'archives-'.$archive_info_key);

$text_info = array();
$text_info[1] = array(
					"title"				=>	'About Us',
					"text"				=>	'<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor.</p>',
					);
$text_info['_multiwidget'] = '1';

update_option('widget_text',$text_info);
$text_info = get_option('widget_text');
krsort($text_info);
foreach($text_info as $key1=>$val1)
{
	$text_info_key = $key1;
	if(is_int($text_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-15"] = array('text-'.$text_info_key);
$archive_info = array();
$archive_info = get_option('widget_archives');
$archive_info[2] = array(
					"title"				=>	'Archives',
					"count"				=>	'0',
					"dropdown"			=>	'0',
					);
$archive_info['_multiwidget'] = '1';

update_option('widget_archives',$archive_info);
$archive_info = get_option('widget_archives');
krsort($archive_info);
foreach($archive_info as $key1=>$val1)
{
	$archive_info_key = $key1;
	if(is_int($archive_info_key))
	{
		break;
	}
}
$category_info = array();
$category_info = get_option('widget_categories');
$category_info[2] = array(
					"title"				=>	'Categories',
					"count"				=>	'0',
					"hierarchical"		=>	'0',
					"dropdown"			=>	'0',
					);
$category_info['_multiwidget'] = '1';

update_option('widget_categories',$category_info);
$category_info = get_option('widget_categories');
krsort($category_info);
foreach($category_info as $key1=>$val1)
{
	$category_info_key = $key1;
	if(is_int($category_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-16"] = array('archives-'.$archive_info_key,'categories-'.$category_info_key);
$links_info = array();
$links_comments_info = get_option('widget_links');
$links_comments_info[2] = array(
					"images"			=>	'1',
					"name"			 	=>	'1',
					"description"		 =>	'1',
					"rating"			 =>	'0',
					"category"			 =>	'0',
					);
$links_comments_info['_multiwidget'] = '1';
update_option('widget_links',$links_comments_info);
$links_comments_info = get_option('widget_links');
krsort($links_comments_info);
foreach($links_comments_info as $key1=>$val1)
{
	$links_info_key = $key1;
	if(is_int($links_info_key))
	{
		break;
	}
}
$srch_info = array();
$srch_info = get_option('widget_search');
$srch_info[2] = array(
					"title"				=>	'Search',
					);
$srch_info['_multiwidget'] = '1';

update_option('widget_search',$srch_info);
$srch_info = get_option('widget_search');
krsort($srch_info);
foreach($srch_info as $key1=>$val1)
{
	$srch_info_key = $key1;
	if(is_int($srch_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-17"] = array('links-'.$links_info_key,'search-'.$srch_info_key);
$cat_info = array();
$cat_info = get_option('widget_browse_by_cats');
$cat_info[3] = array(
					"title"				=>	'Our Products',
					);
$cat_info['_multiwidget'] = '1';

update_option('widget_browse_by_cats',$cat_info);
$cat_info = get_option('widget_browse_by_cats');
krsort($cat_info);
foreach($cat_info as $key1=>$val1)
{
	$cat_info_key = $key1;
	if(is_int($cat_info_key))
	{
		break;
	}
}
$text_info = array();
$text_info = get_option('widget_text');
$text_info[2] = array(
					"title"				=>	'Payment Method',
					"text"				=>	'<p>Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis.  </p>',
					);
$text_info['_multiwidget'] = '1';

update_option('widget_text',$text_info);
$text_info = get_option('widget_text');
krsort($text_info);
foreach($text_info as $key1=>$val1)
{
	$text_info_key = $key1;
	if(is_int($text_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-18"] = array('browse_by_cats-'.$cat_info_key,'text-'.$text_info_key);
$cart_info = array();
$cart_info = get_option('widget_shopping_cart_info');
$cart_info[3] = array(
					"title"				=>	'Shopping Cart',
					);
$cart_info['_multiwidget'] = '1';

update_option('widget_shopping_cart_info',$cart_info);
$cart_info = get_option('widget_shopping_cart_info');
krsort($cart_info);
foreach($cart_info as $key1=>$val1)
{
	$cart_info_key = $key1;
	if(is_int($cart_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-28"] = array('shopping_cart_info-'.$cart_info_key);
$feature_cat_name = 'Feature';
$feature_cat_id = $wpdb->get_var("SELECT term_id FROM $wpdb->terms where name=\"$feature_cat_name\"");
$home_slider_info[1] = array(
					"title"				=>	'Slider',
					"category"			=>	$feature_cat_id,
					"post_number"		=>	'5',
					"post_link"			=>	'',
					"auto_rotate"		=>	'Yes',
					"speed"				=>	'5000',
					"image_width"		=>	'250',
					"image_height"		=>	'250',
					"content_lenght"	=>	'350',
					);
$home_slider_info['_multiwidget'] = '1';

update_option('widget_widget_posts1',$home_slider_info);
$home_slider_widget_info = get_option('widget_widget_posts1');
krsort($home_slider_widget_info);
foreach($home_slider_widget_info as $key1=>$val1)
{
	$home_slider_widget_info_key = $key1;
	if(is_int($home_slider_widget_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-29"] = array('widget_posts1-'.$home_slider_widget_info_key);
$text_info = array();
$text_info[1] = array(
					"title"				=>	'',
					"advt1"				=>	$dummy_image_path.'ad-290x300.png',
					"advt_link1"		=>	'http://www.addfiorese.com.br',
					);
$text_info['_multiwidget'] = '1';

update_option('widget_widget_text',$text_info);
$text_info = get_option('widget_widget_text');
krsort($text_info);
foreach($text_info as $key1=>$val1)
{
	$text_info_key = $key1;
	if(is_int($text_info_key))
	{
		break;
	}
}
$wp_sidebar_widgets["sidebar-30"] = array('widget_text-'.$text_info_key);
update_option('sidebars_widgets',$wp_sidebar_widgets);
//echo "<pre>";
//print_r(get_option('widget_widget_posts1'));
//print_r(get_option('widget_widget_posts1'));
//print_r(get_option('widget_widget_text'));
/////////////// WIDGET SETTINGS END ///////////////
/////////////// Design Settings START ///////////////
update_option("ptthemes_alt_stylesheet",'1-default.css');
update_option("ptthemes_feedburner_url",'http://feeds.feedburner.com/addfiorese');
update_option("ptthemes_storelink_display",'Show');
update_option("ptthemes_blogcatheader_display",'Show');
update_option("ptthemes_pageheader_display",'Show');
update_option("ptthemes_catheader_display",'Show');
update_option("ptthemes_storelink_display",'Hide');
update_option("ptthemes_breadcrumbs",'true');
update_option("ptthemes_prd_listing_format",'grid');
update_option("ptthemes_storeprd_number",'16');
update_option("ptthemes_prdlisttitle_showhide",'true');
update_option("ptthemes_prdlisttitle_order",'2');
update_option("ptthemes_prdlistimage_border",'true');
update_option("ptthemes_prdlistprice_showhide",'true');
update_option("ptthemes_prdlistprice_order",'3');
update_option("ptthemes_prdlistcontent_showhide",'true');
update_option("ptthemes_prdlistcontent_order",'4');
update_option("ptthemes_prdlistbutton_showhide",'true');
update_option("ptthemes_prdlistbutton_order",'5');
update_option("ptthemes_prd_listing_format_cat",'grid');
update_option("ptthemes_qty_txt_showhide",'Show');
update_option("ptthemes_qty_txt_cart_showhide",'Show');
update_option("ptthemes_max_qty_decimal",'2');
update_option("ptthemes_prd_weight_showhide",'Show');
update_option("ptthemes_tellfrnd_showhide",'Show');
update_option("ptthemes_addcomment_showhide",'Show');
update_option("ptthemes_feed_name",'addfiorese');
update_option("ptthemes_add_to_cart_button_position",'Below Description');
update_option("ptthemes_related_prd_single",'Show');
update_option("ptthemes_related_prd_number",'4');
update_option("ptthemes_home_design_settings",'Full page');
update_option("ptthemes_inner_design_settings",'With Right Sidebar');
update_option("ptthemes_product_design_settings",'With Right Sidebar');///
update_option("ptthemes_blog_design_settings",'With Right Sidebar');///
update_option("ptthemes_product_detail_design_settings",'With Right Sidebar');///
update_option("ptthemes_blog_detail_design_settings",'With Right Sidebar');
update_option("ptthemes_store_design_settings",'With Right Sidebar');
update_option("ptthemes_cart_design_settings",'With Right Sidebar');
update_option("ptthemes_checkout_design_settings",'With Right Sidebar');
update_option("ptthemes_all_pages_settings",'With Right Sidebar');
update_option("ptthemes_image_width",'150');
update_option("ptthemes_image_height",'150');
$blog_cat_id = $wpdb->get_var("SELECT term_id FROM $wpdb->terms where name='Blog'");
update_option("cat_exclude_$blog_cat_id",$blog_cat_id);

update_option("ptthemes_prd_listing_format",'grid');
update_option("ptthemes_storeprd_number",'16');
update_option("ptthemes_prdlisttitle_showhide",'true');
update_option("ptthemes_prdlisttitle_order",'2');
update_option("ptthemes_prdlistimage_showhide",'true');
update_option("ptthemes_prdlistimage_border",'true');
update_option("ptthemes_prdlistprice_showhide",'true');
update_option("ptthemes_prdlistprice_order",'3');
update_option("ptthemes_prdlistcontent_showhide",'true');
update_option("ptthemes_prdlistcontent_order",'4');
update_option("ptthemes_prdlistbutton_showhide",'true');
update_option("ptthemes_prdlistbutton_order",'5');
update_option("ptthemes_storelink_display",'Show');
$blog_cat_id = $wpdb->get_var("SELECT group_concat(term_id) FROM $wpdb->terms where name in ('Beauty &amp; Fragrance','Digital Products','Icons','Wordpress Theme','Feature')");
update_option("ptthemes_categories_id",$blog_cat_id);
/////////////// Design Settings END ///////////////

global $blog_id;
if(get_option('upload_path') && !strstr(get_option('upload_path'),'wp-content/uploads'))
{
	$upload_folder_path = "wp-content/blogs.dir/$blog_id/files/";
}else
{
	$upload_folder_path = "wp-content/uploads/";
}
$folderpath = $upload_folder_path . "dummy/";
$strpost = strpos(CHILDTEMPLATEPATH,'wp-content');
$target = substr(CHILDTEMPLATEPATH,0,$strpost).$folderpath;
full_copy( CHILDTEMPLATEPATH."/images/dummy/", $target );
//full_copy( TEMPLATEPATH."/images/dummy/", ABSPATH . "wp-content/uploads/dummy/" );
function full_copy( $source, $target ) 
{
	global $upload_folder_path;
	$imagepatharr = explode('/',$upload_folder_path."dummy");
	$year_path = ABSPATH;
	for($i=0;$i<count($imagepatharr);$i++)
	{
	  if($imagepatharr[$i])
	  {
		  $year_path .= $imagepatharr[$i]."/";
		  //echo "<br>";
		  if (!file_exists($year_path)){
			  mkdir($year_path, 0777);
		  }     
		}
	}
	@mkdir( $target );
		$d = dir( $source );
		
	if ( is_dir( $source ) ) {
		@mkdir( $target );
		$d = dir( $source );
		while ( FALSE !== ( $entry = $d->read() ) ) {
			if ( $entry == '.' || $entry == '..' ) {
				continue;
			}
			$Entry = $source . '/' . $entry; 
			if ( is_dir( $Entry ) ) {
				full_copy( $Entry, $target . '/' . $entry );
				continue;
			}
			@copy( $Entry, $target . '/' . $entry );
		}
	
		$d->close();
	}else {
		@copy( $source, $target );
	}
}
?>