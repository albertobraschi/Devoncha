<?php 
global $Cart,$General,$wpdb;
global $upload_folder_path;
$orderInfoArray = array();
$itemsInCartCount = $Cart->cartCount();
$cartInfo = $Cart->getcartInfo();
$grandTotal = $General->get_amount_format($Cart->getCartAmt());
$userInfo = $General->getLoginUserInfo();
$cartTotalAmt = $Cart->getCartAmt();
if($_REQUEST['coupon_code'])
{
	$coupon_code = $_REQUEST['coupon_code'];	
}else
{
	$coupon_code = $_SESSION['couponcode'];
}
$discount_amt = $General->get_discount_amount($coupon_code,$Cart->getCartAmt_discountable());
$shipping_amt = $General->get_amount_format($General->get_shipping_amt($Cart->getCartAmt_physical_prd(array(),array('freeshiping'=>1))),0);
$taxable_amt_info = $General->get_tax_amount();
$taxable_amt = $taxable_amt_info[0];
$taxable_info_desc = $taxable_amt_info[1];
$payable_amt = $General->get_payable_amount($_REQUEST['shippingmethod']);
if($payable_amt>0)
{
	$order_status = 'processing';
}else
{
	$order_status = 'approve';
}
$paymentFlag = 1;

$cartInfo = $Cart->getcartInfo();
$userInfo = $General->getLoginUserInfo();
$itemsInCartCount = $Cart->cartCount();

if($_SESSION['checkout_as_guest'] == '') //normal checkout
{
	if(!$userInfo)
	{
		global $General;
		wp_redirect($General->get_url_login(site_url('/?ptype=login')));
		exit;
	}
}else  // single page checkout
{
	if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/single_page_checkout_insertuser.php'))
	{
		include(CHILDTEMPLATEPATH . '/single_page_checkout_insertuser.php');
	}else
	{
	include_once(TEMPLATEPATH . '/library/includes/single_page_checkout_insertuser.php');  //checkout type single page
	}
	global $userInfo;
}
if(!$itemsInCartCount)
{
	wp_redirect(site_url('/?ptype=cart&msg=emptycart'));
	exit;
}
if($_REQUEST['paymentmethod'] == '')
{
	global $General;
	wp_redirect($General->get_ssl_normal_url(site_url('/?ptype=checkout&msg=nopaymethod')));
	exit;
}
global $current_user;
$user_address_info = $current_user->data->user_address_info;
$user_address_info['user_name'] = $userInfo['display_name'];
$cart_info_array = $cartInfo;
$cart_info_array['cart_amt'] = $General->get_amount_format($cartTotalAmt);

$paymentmethod = $_REQUEST['paymentmethod'];

/////////////////////////////////////////////////////////////////
$payment_info_array = array();
$payment_info_array['paydeltype'] = $paymentmethod;
if($_REQUEST['shippingmethod'])
{
	$payment_info_array['shippingtype'] = $General->get_shipping_method($field_type='title');
	$payment_info_array['shipping_amt'] = $shipping_amt;
}
$orderInfoArray['user_info'] = $user_address_info;
$orderInfoArray['cart_info'] = $cart_info_array;
$orderInfoArray['payment_info'] = $payment_info_array;
$aff_commission = 0;
////AFFILIATE CODING START///
if($General->is_active_affiliate())
{
	if($cartTotalAmt>0 && $_COOKIE['affiliate-settings'] != '')
	{
		$aff_info_array = explode('|',$_COOKIE['affiliate-settings']);
		$aid = $aff_info_array[0];
		$lkey = $aff_info_array[1];
		$affliate_info =  array(
								"aid"	=>	$aid,
								);
		$orderInfoArray['affliate_info'] = $affliate_info;
		if(get_option('aff_share_amt')>0)
		{
			$aff_commission = get_option('aff_share_amt');
		}
	}
}
////AFFILIATE CODING END///
$order_info_array = array(
				"order_date"	=>	date('Y-m-d H:s:i'),
				"order_status"	=>	$order_status,
				"discount_amt"	=>	$General->get_amount_format($discount_amt,0),
				"taxable_amt"	=>	$General->get_amount_format($taxable_amt,0),
				"taxable_desc"	=>	$taxable_info_desc,
				"payable_amt"	=>	$General->get_amount_format($payable_amt,0).' '.$General->get_currency_code(),
				);
$orderInfoArray['order_info'] = $order_info_array;

if($orderInfoArray && $paymentFlag)
{
		if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/payment_before.php'))
		{
			include_once(CHILDTEMPLATEPATH . '/payment_before.php');
		}
		//$user_ID = $current_user->data->ID;
		$user_ID = $userInfo['ID'];
		global $ord_db_table_name;
		$ord_table_name = $ord_db_table_name;
		$payable_amt = $orderInfoArray['order_info']['payable_amt'];
		$billing_name = $orderInfoArray['user_info']['user_name'];
		$phone = '';
		if($orderInfoArray['user_info']['phone'])
		{
			$phone = __('<br>Phone : ').$orderInfoArray['user_info']['phone'];
		}
		$billin_add_arr = array($orderInfoArray['user_info']['user_add1'], $orderInfoArray['user_info']['user_add2'], $orderInfoArray['user_info']['user_city'], $orderInfoArray['user_info']['user_state'], $orderInfoArray['user_info']['user_country'], $orderInfoArray['user_info']['user_postalcode'],$phone);
		if($billin_add_arr)
		{
			$billing_add = implode(', ', $billin_add_arr);
		}
		if($orderInfoArray['user_info']['buser_name'])
		{
			$shipping_name = $orderInfoArray['user_info']['buser_name'];
		}else
		{
			$shipping_name = $orderInfoArray['user_info']['user_name'];
		}
		$shipping_add_arr = array($orderInfoArray['user_info']['buser_add1'], $orderInfoArray['user_info']['buser_add2'], $orderInfoArray['user_info']['buser_city'], $orderInfoArray['user_info']['buser_state'], $orderInfoArray['user_info']['buser_country'], $orderInfoArray['user_info']['buser_postalcode'],$phone);
		if($shipping_add_arr)
		{
			$shipping_add = implode(', ', $shipping_add_arr);
		}else
		{
			$shipping_add = $billing_add;
		}
		$payment_method = $orderInfoArray['payment_info']['paydeltype'];
		$shipping_method = $orderInfoArray['payment_info']['shippingtype'];
		$cart_amount = $Cart->getCartAmt();
		$shipping_amt = $orderInfoArray['payment_info']['shipping_amt'];
		$discount_amt = $orderInfoArray['order_info']['discount_amt'];
		$tax_amount = $orderInfoArray['order_info']['taxable_amt'];	
		$tax_desc = $orderInfoArray['order_info']['taxable_desc'];	
		$aff_uid = $orderInfoArray['affliate_info']['aid'];
		
		$payable_amt_db = str_replace(',','',$payable_amt);
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$currency_code = $General->get_currency_code();
		$order_insert_sql = "insert into $ord_table_name (uid,ord_date,billing_name, billing_add, shipping_name, shipping_add, payment_method, shipping_method, coupon_code, cart_amount, currency_code ,shipping_amt, discount_amt, tax_amount, tax_desc, payable_amt, aff_uid,aff_commission,ip_address) values (\"$user_ID\", now(), \"$billing_name\", \"$billing_add\", \"$shipping_name\", \"$shipping_add\", \"$payment_method\", \"$shipping_method\",\"$coupon_code\",\"$cart_amount\", \"$currency_code\", \"$shipping_amt\", \"$discount_amt\", \"$tax_amount\", \"$tax_desc\", \"$payable_amt_db\", \"$aff_uid\", \"$aff_commission\",\"$ip_address\")";
		$wpdb->query($order_insert_sql);
		$last_oid = $wpdb->get_var("select oid from $ord_table_name order by oid desc limit 1");
		$_SESSION['client_order_desc'] = $_POST['client_order_desc'];
		if($_SESSION['client_order_desc'] && $last_oid)
		{
			$order_desc = addslashes($_SESSION['client_order_desc']);
			$wpdb->get_var("update $ord_table_name set ord_desc_client='".$order_desc."' where oid=\"$last_oid\"");
		}
		$cart_prd_array = $orderInfoArray['cart_info'];
		global $prd_db_table_name;
		$prd_table_name = $prd_db_table_name;
		for($i=0;$i<count($cart_prd_array)-1;$i++)
		{
			$product_id = $cart_prd_array[$i]['product_id'];
			$prd_qty = $cart_prd_array[$i]['product_qty'];
			$pdesc = $cart_prd_array[$i]['product_att'];
			$price = $cart_prd_array[$i]['product_price'];
			$grossprice = $cart_prd_array[$i]['product_gross_price'];
			$pweight = $cart_prd_array[$i]['product_weight'];
			
			$product_data = get_post_meta( $product_id, 'key', true );
			$pmodel = $product_data['model'];
			
			$orderprd_insert_sql = "insert into $prd_table_name (oid,pid,prd_qty,pdesc,pmodel,pweight,price,grossprice) values (\"$last_oid\", \"$product_id\", \"$prd_qty\", \"$pdesc\", \"$pmodel\", \"$pweight\",\"$price\", \"$grossprice\")";
			$wpdb->query($orderprd_insert_sql);
			$last_order_id = $wpdb->get_var("select oid from $ord_table_name order by oid desc limit 1");
		}
		
	///affiliate data start///
	//@include_once(TEMPLATEPATH . '/library/includes/affiliates/set_affiliate_share.php'); // affiliate settings
	///affiliate data end///
	$orderNumber = $last_oid;
	if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/payment_after.php'))
	{
		include_once(CHILDTEMPLATEPATH . '/payment_after.php');
	}
}

/////////////////////////////////////////////////////////////////
$paymentSuccessFlag = 0;
if($paymentmethod == 'prebanktransfer' || $paymentmethod == 'payondelevary')
{
	$paymentSuccessFlag = 1;
}
else //if($paymentmethod == 'paypal' || $paymentmethod == 'googlechkout' || $paymentmethod == 'authorizenet' || $paymentmethod == 'worldpay')
{

	if($payable_amt>0)
	{
		if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/payment/'.$paymentmethod.'/'.$paymentmethod.'_response.php'))
		{
			include_once(CHILDTEMPLATEPATH . '/payment/'.$paymentmethod.'/'.$paymentmethod.'_response.php');
		}
		elseif(file_exists( TEMPLATEPATH.'/library/payment/'.$paymentmethod.'/'.$paymentmethod.'_response.php'))
		{
			include_once(TEMPLATEPATH.'/library/payment/'.$paymentmethod.'/'.$paymentmethod.'_response.php');
		}
	}else
	{
		$paymentSuccessFlag = 1;
	}
}
/////////////////////////////////////////////////////
if($orderInfoArray && $paymentFlag)
{
	
	if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/payment_email.php'))
	{
		include_once(CHILDTEMPLATEPATH . '/payment_email.php');
	}else
	{
		include_once(TEMPLATEPATH . '/library/includes/payment_email.php');
	}
	
}
if($paymentSuccessFlag)
{
	wp_redirect(site_url('/?ptype=ordersuccess&order='.$orderNumber));
}
?>