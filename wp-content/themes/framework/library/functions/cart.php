<?php 
@session_start();
@ob_start();
if (!class_exists('Cart')) {
	class Cart {
		// Class initialization
		function Cart() {
		}

		function Addtocart($_POST)
		{
			if($_POST)
			{
				$product_info = array();
				$product_id = $_POST['product_id'];
				$product_info['product_id'] = $_POST['product_id'];
				$product_info['product_qty'] = $_POST['product_qty'];
				$product_info['product_att'] = $_POST['product_att'];
				$product_info['product_price'] = $_POST['product_price'];
				$product_info['product_istaxable'] = $_POST['product_istaxable'];
				$product_info['product_weight'] = $_POST['product_weight'];
				if(isset($_SESSION['CART_INFORMATION']))
				{
					$cart_info = $_SESSION['CART_INFORMATION'];
					for($c=0;$c<count($cart_info);$c++)
					{
						$cartprdArr = $cart_info[$c];
						$qtyupd = 0;
						$isprdexist = 0;
						if(($cartprdArr['product_id'] == $_POST['product_id']) && ($cartprdArr['product_att'] == $_POST['product_att']))
						{
							$product_info['product_qty'] = $cartprdArr['product_qty'] + $_REQUEST['product_qty'];
							$qtyupd = $c;
							$isprdexist = 1;
							break;
						}
					}
					
					if($isprdexist)
					{
						$cart_info[$qtyupd] = $product_info;
					}else
					{
						$cart_info[] = $product_info;		
					}
					
				}else
				{
					$cart_info = array();
					$cart_info[] = $product_info;
				}
				$cart_info = $this->calprdGrossPrice($cart_info);
				$_SESSION['CART_INFORMATION'] = $cart_info;
			}
		}
		function calprdGrossPrice($cart_info)
		{
			for($i=0;$i<count($cart_info);$i++)
			{
				$price = $cart_info[$i]['product_price'];
				$att = $cart_info[$i]['product_att'];
				$attArr = explode(',',$att);
				$attamt = 0;
				for($a=0;$a<count($attArr);$a++)
				{
					preg_match('/[(]([+-]+)(.*)[)]/', $attArr[$a], $match);
					$attributeVal = 0;
					if($match[0] !='')
					{
						$attamt = $attamt + substr($match[0],1,strlen($match[0])-2);
					}
				}
				$cart_info[$i]['product_gross_price'] = $cart_info[$i]['product_price'] + ($attamt);
			}
			return $cart_info;
		}
		function getCartAmt($cartArray = array())
		{
			if($cartArray == array())
			{
				$cart_info = $_SESSION['CART_INFORMATION'];
			}else
			{
				$cart_info = $cartArray;
			}
			$cartAmt = 0;
			for($i=0;$i<count($cart_info);$i++)
			{
				$cartAmt = $cartAmt + ($cart_info[$i]['product_gross_price']*$cart_info[$i]['product_qty']);
			}
			return $cartAmt;
		}
	
		function getCartAmt_physical_prd($cartArray = array(),$arg_arr = array())
		{
			global $General,$Product;
			if($cartArray == array())
			{
				$cart_info = $_SESSION['CART_INFORMATION'];
			}else
			{
				$cart_info = $cartArray;
			}
			$cartAmt = 0;
			for($i=0;$i<count($cart_info);$i++)
			{
				if($Product->get_product_type($cart_info[$i]['product_id']) == 'physical')
				{
					$data = get_post_meta( $cart_info[$i]['product_id'], 'key', true );
					//if($arg_arr['freeshiping'] && $data['is_free_shipping']){
					if($data['is_free_shipping']){
					}else{
					$cartAmt = $cartAmt + ($cart_info[$i]['product_gross_price']*$cart_info[$i]['product_qty']);	
					}
				}				
			}
			return $cartAmt;
		}
		function getCartAmt_discountable($cartArray = array())
		{
			global $General,$Product;
			if($cartArray == array())
			{
				$cart_info = $_SESSION['CART_INFORMATION'];
			}else
			{
				$cart_info = $cartArray;
			}
			$cartAmt = 0;
			for($i=0;$i<count($cart_info);$i++)
			{
				if($Product->get_product_type($cart_info[$i]['product_id']) != 'donation')
				{
					$cartAmt = $cartAmt + ($cart_info[$i]['product_gross_price']*$cart_info[$i]['product_qty']);	
				}				
			}
			return $cartAmt;
		}
		function Removefromcart($cartprdid = '')
		{
			if($cartprdid != '')
			{
				if(isset($_SESSION['CART_INFORMATION']))
				{
					$cart_info = $_SESSION['CART_INFORMATION'];
					unset($cart_info[$cartprdid]);
					sort($cart_info);
					$_SESSION['CART_INFORMATION'] = $cart_info;
				}
			}
		}
		function updateCart($cartqty)
		{
			if(isset($_SESSION['CART_INFORMATION']))
			{
				$cart_info = $_SESSION['CART_INFORMATION'];
				for($c=0;$c<count($cart_info);$c++)
				{
					if(trim($cartqty[$c])==0 || trim($cartqty[$c])=='')
					{
						$_SESSION['CART_INFORMATION'] = $cart_info;
						$this->Removefromcart("$c");
						$cart_info = $_SESSION['CART_INFORMATION'];
					}else
					{
						$cart_info[$c]['product_qty'] = $cartqty[$c];
					}
				}
				$_SESSION['CART_INFORMATION'] = $cart_info;
			}
		}
		function getcartInfo()
		{
			$cartproductinfo = array();
			if(isset($_SESSION['CART_INFORMATION']))
			{
				global $wpdb;
				$cart_info = $_SESSION['CART_INFORMATION'];
				$productidArr = array();
				for($c=0;$c<count($cart_info);$c++)
				{
					$productidArr[] = $cart_info[$c]['product_id'];
				}
				$productIds = implode(',',$productidArr);
				if($productIds)
				{
					$productinfosql = "select ID,post_title from $wpdb->posts where ID in ($productIds)";
					$productinfo = $wpdb->get_results($productinfosql);
					foreach($productinfo as $productinfoObj)
					{
						$productArray[$productinfoObj->ID] = $productinfoObj->post_title; 
					}
				}
				for($c=0;$c<count($cart_info);$c++)
				{
					$cartprd = $cart_info[$c];
					$prdattdata = get_post_meta( $cartprd['product_id'], 'key', true );
					$cartprd['product_image'] = $prdattdata[ 'productimage' ];
					$cartprd['model'] = $prdattdata[ 'model' ];
					$cartprd['product_name'] = $productArray[$cartprd['product_id']];
					if(!$cartprd['product_price'] || $cartprd['product_price'] == '')
					{
						$cartprd['product_price'] = '0.00';
					}
					$cart_info[$c] = $cartprd;
				}
				$cartproductinfo = $cart_info;
			}
			return $cartproductinfo;
		}
		function cartCount()
		{
			$itemcount = 0;
			if(isset($_SESSION['CART_INFORMATION']))
			{
				$cart_info = $_SESSION['CART_INFORMATION'];
				for($c=0;$c<count($cart_info);$c++)
				{
					$itemcount = $itemcount + $cart_info[$c]['product_qty'];
				}
			}
			return $itemcount;
		}
		
		function is_product_in_cart($productid='')
		{
			$product_in_cart = 0;
			if($productid!='' && isset($_SESSION['CART_INFORMATION']))
			{
				$cart_info = $_SESSION['CART_INFORMATION'];
				for($c=0;$c<count($cart_info);$c++)
				{
					if($cart_info[$c]['product_id'] == $productid)
					{
						$product_in_cart = 1;
						break;
					}
				}
			}
			return $product_in_cart;
		}
		
		function get_product_qty_cart($productid='')
		{
			$product_qty = 0;
			if($productid!='' && isset($_SESSION['CART_INFORMATION']))
			{
				$cart_info = $_SESSION['CART_INFORMATION'];
				for($c=0;$c<count($cart_info);$c++)
				{
					if($cart_info[$c]['product_id'] == $productid)
					{
						$product_qty = $cart_info[$c]['product_qty'];
						break;
					}
				}
			}
			return $product_qty;
		}
		
		function empty_cart()
		{
			$_SESSION['CART_INFORMATION'] = array();
		}
		
		function get_payment_method($method)
		{
			global $wpdb;
			$paymentsql = "select * from $wpdb->options where option_name like 'payment_method_$method'";
			$paymentinfo = $wpdb->get_results($paymentsql);
			if($paymentinfo)
			{
				foreach($paymentinfo as $paymentinfoObj)
				{
					$paymentInfo = unserialize($paymentinfoObj->option_value);
					return "Pay with ".$paymentInfo['name'];
				}
			}
		}
		
		function get_payment_gateway_info($method)
		{
			
			$paymentmethod = '';
			if($method == 'paypal')
			{
				$paymentmethod = 'Paypal';
			}
			elseif($method == 'googlechkout')
			{
				$paymentmethod = 'Google CheckOut';
			}elseif($method == 'autorizenet')
			{
				$paymentmethod = 'Authorize.net';
			}elseif($method == 'payondelevary')
			{
				$paymentmethod = 'Pay on Delevary';
			}
			elseif($method == 'worldpay')
			{
				$paymentmethod = 'Worldpay';
			}		
		}
		
		function is_shopping_cart_empty()
		{
			global $Cart;
			$itemsInCartCount = $Cart->cartCount();
			if($itemsInCartCount>0)
			{
				
			}else
			{
				 wp_redirect(site_url('/?ptype=cart'));	
			}
		}
	}
	
	// Start this plugin once all other plugins are fully loaded
}
if(!$Cart)
{
	$Cart = new Cart();
}
?>
