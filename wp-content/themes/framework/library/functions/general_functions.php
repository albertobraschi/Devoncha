<?php 
//session_start();ob_start();
if (!class_exists('General')) {
	class General {
		// Class initialization
		function General() {
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
					return __('Pay with '.$paymentInfo['name']);
				}
			}
		}
		
		function get_shipping_method($field_type='',$shipping_id='',$all='0')
		{
			global $wpdb,$shippings_db_table_name;
			$shipping_sql = "select * from $shippings_db_table_name where 1";
			if($all=='0'){
			if($shipping_id){ $shipping_sql .= " and shipping_id=\"$shipping_id\"";}
			else{ $shipping_sql .= " and default_status = '1'";}
			}
			$shippinginfo = $wpdb->get_results($shipping_sql);
			if($all)
			{
				return $shippinginfo;
			}else
			{
				if($field_type){ return $shippinginfo[0]->$field_type;}
				else{ return $shippinginfo[0];}
			}
		}
		
		function get_weight_cart()
		{
			$cartInfo = $_SESSION['CART_INFORMATION'];
			$weight = 0;
			for($i=0;$i<count($cartInfo);$i++)
			{
				if($cartInfo[$i]['product_weight'])
				{
					$weight = $weight + ($cartInfo[$i]['product_weight']*$cartInfo[$i]['product_qty']);
				}
			}
			return $weight;
		}
		function get_shipping_info($shipping_id='')
		{
			global $wpdb,$shipping_info_db_table_name;
			$shipping_sql = "select * from $shipping_info_db_table_name where 1";
			if($shipping_id)
			{
				$shipping_sql .= " and shipping_id = '".$shipping_id."'";	
			}
			return $shippinginfo = $wpdb->get_results($shipping_sql);
		}
		
		function get_free_shipping_info()
		{
			global $wpdb,$General,$Product,$Cart;
			$free_shipping_flag_arr = array();
			$cart_info = $_SESSION['CART_INFORMATION'];
			for($i=0;$i<count($cart_info);$i++)
			{
				if($Product->get_product_type($cart_info[$i]['product_id']) == 'physical')
				{
					$data = get_post_meta( $cart_info[$i]['product_id'], 'key', true );
					if($data['is_free_shipping']){
					$free_shipping_flag_arr[] = 1;	
					}else{
						$free_shipping_flag_arr[] = 0;	
					}
				}				
			}
			return $free_shipping_flag_arr;
		}
		function get_shipping_amt($total_amt=0)
		{
			global $wpdb,$General,$Product,$Cart,$current_user,$country_db_table_name,$state_db_table_name;			
			$shipping_amt = 0;
			$paymentinfo = $this->get_shipping_method();
			$shipping_id = $paymentinfo->shipping_id;
			if($shipping_id==1){$method = 'flat_rate';}elseif($shipping_id==2){$method = 'free';}elseif($shipping_id==3){$method = 'price_base';}elseif($shipping_id==4){$method = 'weight_base';}
			$shipping_info = $this->get_shipping_info($shipping_id);
			$user_state = strtolower($current_user->data->user_address_info['buser_state']);
			$user_country = strtolower($current_user->data->user_address_info['buser_country']);
			
			foreach($shipping_info as $shipping_info_obj)
			{
				$sinfo_id = $shipping_info_obj->sinfo_id;
				$ship_type_range = trim($shipping_info_obj->ship_type_range);
				$country1 = $shipping_info_obj->country;
				$csql = "select title  from $country_db_table_name where country like \"$country1\"";
				$country = strtolower($wpdb->get_var($csql));
				$state1 = $shipping_info_obj->state;
				$ssql = "select title from $state_db_table_name	where state like \"$state1\"";
				$state = strtolower($wpdb->get_var($ssql));
				$amount = $shipping_info_obj->amount;
				$is_apply_ship = 0;
				if($state=='' && $country=='')
				{
					$is_apply_ship=1;
				}
				if($state!='' && $country=='')
				{
					$is_apply_ship=1;
				}
				if($state!='' && $country!='')
				{
					if($state==$user_state && $country==$user_country)
					{
						$is_apply_ship=1;
					}
				}elseif($state=='' && $country!='')
				{
					if($country==$user_country)
					{
						$is_apply_ship=1;
					}
				}
				if($is_apply_ship)
				{
					if(strstr($ship_type_range,'->'))
					{
						$array1 = explode('->',$ship_type_range);
						$initval = $array1[0];
						$lastval = $array1[1];
						$rate_amt = $amount;
						if($method == 'weight_base')
						{
							$weight = $this->get_weight_cart();
							if(($weight >= $initval) && ($weight <= $lastval))
							{
								$shipping_amt += $rate_amt;
							}
						}else
						{
							if(($total_amt >= $initval) && ($total_amt <= $lastval))
							{
								$shipping_amt += $rate_amt;
							}
						}
					}else
					{
						$free_shipping_info = $this->get_free_shipping_info();
						if(in_array('0',$free_shipping_info))
						{
							$shipping_amt = $amount;	
						}						
					}
				}
			}
			return $shipping_amt;
		}
		
		function get_tax_amount()
		{
			global $Product;
			if(isset($_SESSION['CART_INFORMATION']))
			{
				$cart_info = $_SESSION['CART_INFORMATION'];
				$product_tax_info = $this->get_product_tax();
				$product_tax = $product_tax_info[0];
				$product_tax_text = $product_tax_info[1];
				$tax_amt = 0;
				$all_tax_array = array();
				if($product_tax_info)
				{
					foreach($product_tax_info as $key=>$val)
					{
						$all_tax_array[] = 	$key;
					}
				}
				$product_tax_text = array();
				for($i=0;$i<count($cart_info);$i++)
				{
					$cart_prdinfo = $cart_info[$i];
					$product_id = $cart_prdinfo['product_id'];
					$data = get_post_meta( $product_id, 'key', true );
					$qty = $cart_prdinfo['product_qty'];
					$price = $cart_prdinfo['product_gross_price'];
					if($Product->get_product_price_sale($product_id)>0)
					{
						$taxable_price = $data['specialprice'];
					}else
					{
						$taxable_price = $data['price'];
					}
					$prd_info = $this->get_product_price_tax_included($product_id,$taxable_price);
					if($prd_info && $price>0)
					{
						$price = $price - $prd_info[0];	
					}
					$grossprice = $qty*$price;
					$istaxable =$data['istaxable'];
					if($istaxable=='on' && $data['prd_tax'])
					{
						if(in_array('all',$data['prd_tax']))
						{
							foreach($product_tax_info as $key=>$val)
							{
								if($val[2]=='per')
								{
									$tax_amt = $tax_amt + ($grossprice*$val[1])/100;
								}elseif($val[2]=='amt')
								{
									$tax_amt = $tax_amt + $val[1];
								}
								if(!in_array($val[0],$product_tax_text))
								{
									$product_tax_text[] = $val[0];
								}
							}
						}else
						{
							$prd_txt_arr = array_intersect($all_tax_array,$data['prd_tax']);
							if($prd_txt_arr)
							{
								foreach($prd_txt_arr as $tid=>$tval)
								{
									$tax = $product_tax_info[$tval];	
									if($tax[2]=='per')
									{
										$tax_amt = $tax_amt + ($grossprice*$tax[1])/100;
									}elseif($tax[2]=='amt')
									{
										$tax_amt = $tax_amt + $tax[1];
									}
									if(!in_array($tax[0],$product_tax_text))
									{
										$product_tax_text[] = $tax[0];
									}
								}
							}
						}
					}else
					{
						$tax_amt = $tax_amt;
					}
					$per_product_tax_text[] = $product_tax_text;
				}
				if($product_tax_text)
				{
					$tax_desc = implode(', ',$product_tax_text);
				}
				return array($tax_amt,$tax_desc);
			}
		}
		function get_tax_amount_included()
		{
			global $Product;
			if(isset($_SESSION['CART_INFORMATION']))
			{
				$cart_info = $_SESSION['CART_INFORMATION'];
				$product_tax_info = $this->get_product_tax();
				$product_tax = $product_tax_info[0];
				$product_tax_text = $product_tax_info[1];
				$tax_amt = 0;
				$all_tax_array = array();
				if($product_tax_info)
				{
					foreach($product_tax_info as $key=>$val)
					{
						$all_tax_array[] = 	$key;
					}
				}
				$product_tax_text = array();
				for($i=0;$i<count($cart_info);$i++)
				{
					$cart_prdinfo = $cart_info[$i];
					$product_id = $cart_prdinfo['product_id'];
					$data = get_post_meta( $product_id, 'key', true );
					$qty = $cart_prdinfo['product_qty'];
					$price = $cart_prdinfo['product_gross_price'];
					if($Product->get_product_price_sale($product_id)>0)
					{
						$taxable_price = $data['specialprice'];
					}else
					{
						$taxable_price = $data['price'];
					}
					$prd_info = $this->get_product_price_tax_included($product_id,$taxable_price,1);
					if($prd_info && $price>0)
					{
						$price = $price - $prd_info[0];	
					}
					$grossprice = $qty*$price;
					$istaxable =$data['istaxable'];
					$istax_included =$data['istax_included'];
					if($istaxable=='on' && $istax_included=='on' && $data['prd_tax'])
					{
						if(in_array('all',$data['prd_tax']))
						{
							foreach($product_tax_info as $key=>$val)
							{
								if($val[2]=='per')
								{
									$tax_amt = $tax_amt + ($grossprice*$val[1])/100;
								}elseif($val[2]=='amt')
								{
									$tax_amt = $tax_amt + $val[1];
								}
								if(!in_array($val[0],$product_tax_text))
								{
									$product_tax_text[] = $val[0];
								}
							}
						}else
						{
							$prd_txt_arr = array_intersect($all_tax_array,$data['prd_tax']);
							if($prd_txt_arr)
							{
								foreach($prd_txt_arr as $tid=>$tval)
								{
									$tax = $product_tax_info[$tval];	
									if($tax[2]=='per')
									{
										$tax_amt = $tax_amt + ($grossprice*$tax[1])/100;
									}elseif($tax[2]=='amt')
									{
										$tax_amt = $tax_amt + $tax[1];
									}
									if(!in_array($tax[0],$product_tax_text))
									{
										$product_tax_text[] = $tax[0];
									}
								}
							}
						}
					}else
					{
						$tax_amt = $tax_amt;
					}
					$per_product_tax_text[] = $product_tax_text;
				}
				if($product_tax_text)
				{
					$tax_desc = __('Note tax included : ').implode(', ',$product_tax_text);
				}
				return array($tax_amt,$tax_desc);
			}
		}
		
		
		function get_product_price_tax_included($pid='',$price='',$taxonly=0)
		{
			if($pid)
			{
				$product_tax_info = $this->get_product_tax();
				$product_tax_text = $product_tax_info[1];
				$product_tax = $product_tax_info[0];
				$product_tax_text = $product_tax_info[1];
				$tax_amt = 0;
				$all_tax_array = array();
				if($product_tax_info)
				{
					foreach($product_tax_info as $key=>$val)
					{
						$all_tax_array[] = 	$key;
					}
				}
				$product_tax_text = array();
				$product_id = $pid;
				$data = get_post_meta( $product_id, 'key', true );
				$grossprice =$data['price'];
				if($price)
				{
					$grossprice =$price;
				}					
				$istaxable =$data['istaxable'];
				$istax_included =$data['istax_included'];
				if($istaxable=='on' && ($istax_included!='on' && $taxonly==1) && $data['prd_tax'])
				{
					if(in_array('all',$data['prd_tax']))
					{
						foreach($product_tax_info as $key=>$val)
						{
							if($istax_included=='on'){
								if($val[2]=='per')
								{
									$tax_amt = $tax_amt + ($grossprice*$val[1])/100;
								}elseif($val[2]=='amt')
								{
									$tax_amt = $tax_amt + $val[1];
								}
								if(!in_array($val[0],$product_tax_text))
								{
									$product_tax_text[] = $val[0];
								}
							}
						}
					}else
					{
						$prd_txt_arr = array_intersect($all_tax_array,$data['prd_tax']);
						if($prd_txt_arr)
						{
							foreach($prd_txt_arr as $tid=>$tval)
							{
								$tax = $product_tax_info[$tval];
								if($istax_included=='on'){
									if($tax[2]=='per')
									{
										$tax_amt = $tax_amt + ($grossprice*$tax[1])/100;
									}elseif($tax[2]=='amt')
									{
										$tax_amt = $tax_amt + $tax[1];
									}
									if(!in_array($tax[0],$product_tax_text))
									{
										$product_tax_text[] = $tax[0];
									}
								}
							}
						}
					}
				}else
				{
					$tax_amt = $tax_amt;
				}
				$per_product_tax_text[] = $product_tax_text;
				if($product_tax_text)
				{
					$tax_desc = __('Note tax included : ').implode(', ',$product_tax_text);
				}
				return array($tax_amt,$tax_desc);
			}
		}
		
		function get_tax_amount_excluded()
		{
			global $General;
			//$taxable_amt_info = $General->get_tax_amount();
			$taxable_amt_info = $General->get_tax_amount_included();
			return $taxable_amt_info[0];
		}
		
		function get_payable_amount($shippingmehod='')  // To get the final payable amoung
		{
			global $Cart;
			$payable_amount = 0;
			$cart_amt = $Cart->getCartAmt();
			$tax_amt_info = $this->get_tax_amount();
			$taxable_amt_included = $this->get_tax_amount_excluded();
			$taxable_amt_info = $this->get_tax_amount_excluded();
			$tax_amt = $tax_amt_info[0];
			if($_SESSION['couponcode'])
			{
				$discount_amount = $this->get_discount_amount($_SESSION['couponcode'],$Cart->getCartAmt_discountable());
			}
			if($discount_amount)
			{
				$cart_amt = $cart_amt - $discount_amount;
			}
			$shipping_amt = $this->get_shipping_amt($Cart->getCartAmt_physical_prd(array(),array('freeshiping'=>1)));
			if($shipping_amt>0)
			{				
				$payable_amount = $cart_amt+$shipping_amt;
			}else
			{
				$payable_amount = $cart_amt;
			}
			if($tax_amt)
			{
				$payable_amount = $payable_amount + $tax_amt;
			}
			if($taxable_amt_included>0)
			{
				$payable_amount = $payable_amount-$taxable_amt_included;
			}
			
			return str_replace(',','',number_format($payable_amount,2));
		}
		
		function get_payment_optins($method)
		{
			global $wpdb;
			$paymentsql = "select * from $wpdb->options where option_name like 'payment_method_$method'";
			$paymentinfo = $wpdb->get_results($paymentsql);
			if($paymentinfo)
			{
				foreach($paymentinfo as $paymentinfoObj)
				{
					$option_value = unserialize($paymentinfoObj->option_value);
					$paymentOpts = $option_value['payOpts'];
					$optReturnarr = array();
					for($i=0;$i<count($paymentOpts);$i++)
					{
						$optReturnarr[$paymentOpts[$i]['fieldname']] = $paymentOpts[$i]['value'];
					}
					//echo "<pre>";print_r($optReturnarr);
					return $optReturnarr;
				}
			}
		}
		
		function get_coupon_deduction()
		{
			global $Cart;
			$discount_info = $this->get_discount_info($_SESSION['couponcode']);
			$couponInfo = __("Discount Amount");//.$discount_info['couponcode'];	
			if($discount_info['dis_per']=='dis')
			{
				$couponInfo .= "(".$discount_info['dis_amt']."%)";
			}else
			{
				$couponInfo .= "";
			}
			return $couponInfo;
		}
				
		function get_currency_symbol()
		{
			if(get_option('currencysym') == '')
			{
				return '$';
			}else
			{
				return get_option('currencysym');
			}
		}
		
		function get_currency_code()
		{
			if(get_option('currency') == '')
			{
				return 'USD';
			}else
			{
				return get_option('currency');
			}
		}
		
		function get_site_emailId()
		{
			if(get_option('site_email'))
			{
				return get_option('site_email');
			}else
			{
				return get_option('admin_email');				
			}
		}
		
		function get_site_emailName()
		{
			if(get_option('site_email_name'))
			{
				return get_option('site_email_name');					
			}else
			{
				return get_option('blogname');
			}
		}
		
		function get_product_imagepath()
		{
			return get_option('imagepath');
		}
		
		function get_product_tax()
		{
			return $this->get_product_tax_cal();
		}
		
		function get_product_tax_cal()
		{
			global $wpdb,$state_db_table_name,$tax_db_table_name,$country_db_table_name;
			global $current_user;
			$user_address_info = $current_user->data->user_address_info;

			$buser_country = $user_address_info['buser_country'];
			if($buser_country=='')
			{
				$buser_country = $user_address_info['user_country'];
			}
			$buser_state = $user_address_info['buser_state'];
			if($buser_state=='')
			{
				$buser_state = $user_state = $user_address_info['user_state'];
			}
			$buser_state = trim($buser_state);
			$buser_country = trim($buser_country);

			$state_code = $wpdb->get_var("select state from $state_db_table_name where title like \"$buser_state\"");
			$country_code = $wpdb->get_var("select country from $country_db_table_name where title like \"$buser_country\"");
			$tax_sql = "select * from $tax_db_table_name where tax_status=1 and (tax_state like \"$state_code\" || tax_state='') and (tax_country like \"$country_code\" || tax_country='')";
			$tax_res = $wpdb->get_results($tax_sql);
			$tax_title_arr = array();
			$tax_info_arr = array();
			$total_tax = 0;
			if($tax_res)
			{
				foreach($tax_res as $tax_res_obj)
				{
					$tax_id = $tax_res_obj->tax_id;
					$tax_amount = $tax_res_obj->tax_amount;
					$amount_type = $tax_res_obj->amount_type;
					if($amount_type=='per'){$perctype = '%';}else{$perctype = '';}
					$tax_title = $tax_res_obj->tax_title.'('.number_format($tax_amount,2)."$perctype)";
					$tax_title_arr[] = $tax_title;
					$tax_info_arr[$tax_id] = array($tax_title,$tax_amount,$amount_type);
					//$total_tax = $total_tax + $tax_amount;
				}
			}else
			{
				$tax_title = __('Tax').'('.get_option('tax').'%)';
				$tax_amount = get_option('tax');
				$amount_type = 'per';
				$tax_info_arr['0'] = array($tax_title,$tax_amount,$amount_type);
			}
			//return array($total_tax,$tax_title_arr);
			return $tax_info_arr;
		}
		
		function is_show_weight()
		{
			if(get_option('is_show_weight'))
			{
				return true;
			}else
			{
				return false;
			}
		}
		
		
		function is_show_coupon()
		{
			if(get_option('is_show_coupon'))
			{
				return true;
			}else
			{
				return false;
			}
		}
		function is_show_tellaFriend()
		{
			if(get_option('is_show_tellafrnd'))
			{
				return true;
			}else
			{
				return false;
			}
		}
		function is_show_storepage()
		{
			if(get_option('ptthemes_storelink_display')=='Show' || get_option('ptthemes_storelink_display')=='')
			{
				return true;
			}else
			{
				return false;
			}
		}
		function is_show_category()
		{
			if(get_option('is_show_category'))
			{
				return true;
			}else
			{
				return false;
			}
		}
		function is_show_blogpage()
		{
			if(get_option('ptthemes_blogcatheader_display')=='Show' || get_option('ptthemes_blogcatheader_display')=='')
			{
				return true;
			}else
			{
				return false;
			}
		}
		function is_show_addcomment()
		{
			if(get_option('is_show_addcomment'))
			{
				return true;
			}else
			{
				return false;
			}
		}
		function is_show_related_products()
		{
			if(get_option('ptthemes_related_prd_single')=='Show' || get_option('ptthemes_related_prd_single')=='')
			{
				return true;
			}else
			{
				return false;
			}
		}
		function get_dashboard_display_orders()
		{
			return get_option('dash_noof_orders');
		}
		
		function is_valid_couponcode($coupon)
		{
			global $wpdb;
			$couponexist = 0;
			if($coupon)
			{
				$couponsql = "select option_value from $wpdb->options where option_name='discount_coupons'";
				$couponinfo = $wpdb->get_results($couponsql);
				if($couponinfo)
				{
					foreach($couponinfo as $couponinfoObj)
					{
						$option_value = unserialize($couponinfoObj->option_value);
						foreach($option_value as $key=>$value)
						{
							if($value['couponcode'] == $coupon)
							{
								$couponexist = 1;
								break;
							}
						}
					}
				}			
			}
			return $couponexist;
		}
		function get_discount_amount($coupon,$amount)
		{
			global $wpdb;
			if($coupon!='' && $amount>0)
			{
				$couponsql = "select option_value from $wpdb->options where option_name='discount_coupons'";
				$couponinfo = $wpdb->get_results($couponsql);
				if($couponinfo)
				{
					foreach($couponinfo as $couponinfoObj)
					{
						$option_value = unserialize($couponinfoObj->option_value);
						foreach($option_value as $key=>$value)
						{
							if($value['couponcode'] == $coupon)
							{
								if($value['dis_per']=='per')
								{
									$discount_amt = ($amount*$value['dis_amt'])/100;
								}else
								if($value['dis_per']=='amt')
								{
									$discount_amt = $value['dis_amt'];
								}
							}
						}
					}
				}
			}
			return $discount_amt;
		}
		
		function get_discount_info($coupon)
		{
			global $wpdb;
			if($coupon!='')
			{
				$couponsql = "select option_value from $wpdb->options where option_name='discount_coupons'";
				$couponinfo = $wpdb->get_results($couponsql);
				if($couponinfo)
				{
					foreach($couponinfo as $couponinfoObj)
					{
						$option_value = unserialize($couponinfoObj->option_value);
						foreach($option_value as $key=>$value)
						{
							if($value['couponcode'] == $coupon)
							{
								return $value;
							}
						}
					}
				}
			}
			return $discount_amt;
		}
		
		function is_storetype_shoppingcart()
		{
			if(get_option('store_type') == 'cart')
			{
				return true;
			}else
			{
				return false;
			}
		}
		function is_storetype_digital()
		{
			if(get_option('store_type') == 'digital')
			{
				return true;
			}else
			{
				return false;
			}
		}
		function is_checkoutype_cart()
		{
			if(get_option('checkout_type') == 'cart')
			{
				return true;
			}else
			{
				return false;
			}
		}
		function is_storetype_catalog()
		{
			if(get_option('store_type') == 'catalog')
			{
				return true;
			}else
			{
				return false;
			}
		}
		
		function getLoginUserInfo()
		{
			$logininfoarr = explode('|',$_COOKIE[LOGGED_IN_COOKIE]);
			if($logininfoarr)
			{
				global $wpdb;
				$userInfoArray = array();
				$usersql = "select * from $wpdb->users where user_login = '".$logininfoarr[0]."'";
				$userinfo = $wpdb->get_results($usersql);
				foreach($userinfo as $userinfoObj)
				{
					$userInfoArray['ID'] = 	$userinfoObj->ID;
					$userInfoArray['display_name'] = 	$userinfoObj->display_name;
					$userInfoArray['user_nicename'] = 	$userinfoObj->user_login;
					$userInfoArray['user_email'] = 	$userinfoObj->user_email;
					$userInfoArray['user_id'] = 	$logininfoarr[0];
				}
				return $userInfoArray;
			}else
			{
				return false;
			}
		}
		
		function getOrderStatus($status = '',$return='')
		{
			$status_str = '';
			if($status == 'approve')
			{
				$status_str =  '<font style="color:#006633">'.__(ORDER_APPROVE_TEXT.'d').'</font>';
			}
			elseif($status == 'cancel')
			{
				$status_str = '<font style="color:#FF0000">'.__(ORDER_CANCEL_TEXT.'led').'</font>';
			}
			elseif($status == 'reject')
			{
				$status_str = '<font style="color:#FF0000">'.__(ORDER_REJECT_TEXT.'ed').'</font>';
			}
			elseif($status == 'shipping')
			{
				$status_str = '<font style="color:#0033FF">'.__(ORDER_SHIPPING_TEXT).'</font>';
			}
			elseif($status == 'delivered')
			{
				$status_str = '<font style="color:#0033FF">'.__(ORDER_DELIVERED_TEXT).'</font>';
			}
			elseif($status == 'processing' || $status == 'pending')
			{
				$status_str = '<font style="color:#FF9900">'.__(ORDER_PROCESSING_TEXT).'</font>';
			}
			if($return)
			{
				return __($status_str);	
			}else
			{
				_e($status_str);	
			}
		}
		
		function sendEmail($fromEmail,$fromEmailName,$toEmail,$toEmailName,$subject,$message,$extra='')
		{
			if($fromEmail && $toEmail)
			{
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
				
				// Additional headers
				$headers .= 'To: '.$toEmailName.' <'.$toEmail.'>' . "\r\n";
				$headers .= 'From: '.$fromEmailName.' <'.$fromEmail.'>' . "\r\n";
				//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
				//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
				// Mail it
				//@mail($toEmail, $subject, $message, $headers);
				/*echo "From : $toEmailName - $fromEmail <br>";
				echo "From : $toEmailName - $toEmail <br>";
				echo $subject.'<br>';
				echo $message.'<br>';
				echo $headers;exit;*/
				@mail( $toEmail, $subject, $message, $headers );
			}
		}
		
		function get_total_products($month='')
		{
			global $wpdb;
			$query = "SELECT COUNT($wpdb->posts.ID) FROM $wpdb->posts ";
			$query .= " JOIN $wpdb->postmeta";
			$query .= " ON $wpdb->posts.ID = $wpdb->postmeta.post_id";
			$query .= " AND ($wpdb->postmeta.meta_key = 'key') and ($wpdb->postmeta.meta_value like '".'%:"posttype";%'."')";
			$query .=" WHERE $wpdb->posts.post_status = 'publish' and $wpdb->posts.post_parent='0'";
			if($month)
			{
				$query .= " and date_format($wpdb->posts.post_date,'%m')=$month";
			}
			return $wpdb->get_var($query);
		}
		
		function get_total_orders()
		{
			global $General,$ord_db_table_name,$wpdb;
			$totalOrders = array();
			$currentMonthOrders = array();
			$totalOrders['processing'] = $wpdb->get_var("select count(oid) from $ord_db_table_name where ostatus='pending'");
			$totalOrders['approve'] = $wpdb->get_var("select count(oid) from $ord_db_table_name where ostatus='approve'");
			$totalOrders['reject'] = $wpdb->get_var("select count(oid) from $ord_db_table_name where ostatus='reject'");
			$totalOrders['cancel'] = $wpdb->get_var("select count(oid) from $ord_db_table_name where ostatus='cancel'");
			$totalOrders['shipping'] = $wpdb->get_var("select count(oid) from $ord_db_table_name where ostatus='shipping'");
			$totalOrders['delivered'] = $wpdb->get_var("select count(oid) from $ord_db_table_name where ostatus='delivered'");
			
			$tdate = date('Y-m');
			$currentMonthOrders['processing'] = $wpdb->get_var("select count(oid) from $ord_db_table_name where ostatus='pending' and date_format(ord_date,'%Y-%m')=\"$tdate\"");
			$currentMonthOrders['approve'] = $wpdb->get_var("select count(oid) from $ord_db_table_name where ostatus='approve' and date_format(ord_date,'%Y-%m')=\"$tdate\"");
			$currentMonthOrders['reject'] = $wpdb->get_var("select count(oid) from $ord_db_table_name where ostatus='reject' and date_format(ord_date,'%Y-%m')=\"$tdate\"");
			$currentMonthOrders['cancel'] = $wpdb->get_var("select count(oid) from $ord_db_table_name where ostatus='cancel' and date_format(ord_date,'%Y-%m')=\"$tdate\"");
			$currentMonthOrders['shipping'] = $wpdb->get_var("select count(oid) from $ord_db_table_name where ostatus='shipping' and date_format(ord_date,'%Y-%m')=\"$tdate\"");
			$currentMonthOrders['delivered'] = $wpdb->get_var("select count(oid) from $ord_db_table_name where ostatus='delivered' and date_format(ord_date,'%Y-%m')=\"$tdate\"");
			
			return array($currentMonthOrders,$totalOrders);
		}
		
		function get_total_orders_bydate()
		{
			global $wpdb, $General;
			
			$userInfo = $General->getLoginUserInfo();
			$ordersql = "select u.display_name,um.meta_value from $wpdb->usermeta as um join $wpdb->users as u on u.ID=um.user_id  where um.meta_key = 'user_order_info' order by um.umeta_id desc";
			$orderinfo = $wpdb->get_results($ordersql);
			$currentMonthOrders = array();
			$totalOrders = array();
			if($orderinfo)
			{
				foreach($orderinfo as $orderinfoObj)
				{
					$meta_value_arr = array();
					$meta_value = unserialize(unserialize($orderinfoObj->meta_value));
					$display_name= $orderinfoObj->display_name;
					for($i=0;$i<count($meta_value);$i++)
					{
						$meta_value[$i][0]['order_info']['customer_name'] = $orderinfoObj->display_name;
						$order_info = $meta_value[$i][0]['order_info'];
						$totalOrders[strtotime($order_info['order_date'])] = $order_info;
					}
				}
			}
			return $totalOrders;
		}	
		
		function get_pagination($targetpage,$total_pages,$limit=10,$page=0)
		{
			/* Setup page vars for display. */
			if ($page == 0) $page = 1;					//if no page var is given, default to 1.
			$prev = $page - 1;							//previous page is page - 1
			$next = $page + 1;							//next page is page + 1
			$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
			$lpm1 = $lastpage - 1;						//last page minus 1
			
			if(strstr($targetpage,'?'))
			{
				$querystr = "&pagination";
			}else
			{
				$querystr = "?pagination";
			}
			$pagination = "";
			if($lastpage > 1)
			{	
				$pagination .= "<div class=\"pagination\">";
				//previous button
				if ($page > 1) 
					$pagination.= "<a href=\"$targetpage$querystr=$prev\">&laquo; previous</a>";
				else
					$pagination.= "<span class=\"disabled\">&laquo; previous</span>";	
				
				//pages	
				if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
				{	
					for ($counter = 1; $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"$targetpage$querystr=$counter\">$counter</a>";					
					}
				}
				elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
				{
					//close to beginning; only hide later pages
					if($page < 1 + ($adjacents * 2))		
					{
						for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
								$pagination.= "<a href=\"$targetpage$querystr=$counter\">$counter</a>";					
						}
						$pagination.= "...";
						$pagination.= "<a href=\"$targetpage$querystr=$lpm1\">$lpm1</a>";
						$pagination.= "<a href=\"$targetpage$querystr=$lastpage\">$lastpage</a>";		
					}
					//in middle; hide some front and some back
					elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
					{
						$pagination.= "<a href=\"$targetpage$querystr=1\">1</a>";
						$pagination.= "<a href=\"$targetpage$querystr=2\">2</a>";
						$pagination.= "...";
						for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
								$pagination.= "<a href=\"$targetpage$querystr=$counter\">$counter</a>";					
						}
						$pagination.= "...";
						$pagination.= "<a href=\"$targetpage$querystr=$lpm1\">$lpm1</a>";
						$pagination.= "<a href=\"$targetpage$querystr=$lastpage\">$lastpage</a>";		
					}
					//close to end; only hide early pages
					else
					{
						$pagination.= "<a href=\"$targetpage$querystr=1\">1</a>";
						$pagination.= "<a href=\"$targetpage$querystr=2\">2</a>";
						$pagination.= "...";
						for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
						{
							if ($counter == $page)
								$pagination.= "<span class=\"current\">$counter</span>";
							else
								$pagination.= "<a href=\"$targetpage$querystr=$counter\">$counter</a>";					
						}
					}
				}
				
				//next button
				if ($page < $counter - 1) 
					$pagination.= "<a href=\"$targetpage$querystr=$next\">next &raquo;</a>";
				else
					$pagination.= "<span class=\"disabled\">next &raquo;</span>";
				$pagination.= "</div>\n";		
			}
			return $pagination;
		}
		
		function get_order_detailinfo_tableformat($orderId,$isshow_paydetail=0)
		{
			global $Cart,$General,$wpdb,$prd_db_table_name,$ord_db_table_name;
			$ordersql = "select * from $ord_db_table_name where oid=\"$orderId\"";
			$orderinfo = $wpdb->get_results($ordersql);
			$orderinfo = $orderinfo[0];
			if($isshow_paydetail)
			{
				$message = '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/style.css" media="screen" />';
				$message .= '<style>.address_info {width:400px;}</style>';
			}

			$message .='<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0"><tr><td colspan="2" align="left">		
			<div class="order_info">
					<p> <span class="span"> '. __('Order Number').' </span> : <strong>'.$orderinfo->oid.'  </strong>  <br />
					<span class="span"> '. __('Order Date').' </span> : '.date(get_option('date_format').' '.get_option('time_format'),strtotime($orderinfo->ord_date)).' </p>
				<p><span class="span">'. __('Order Status') .'</span>  : <strong>'. $this->getOrderStatus($orderinfo->ostatus,1).'</strong> </p>
			</div> <!--order_info -->
            </td></tr>
            <tr><td align="left" valign="top">
			<div class="checkout_address" >
			<div class="address_info address_info2  fl">
			  <h3>'.__('User Information').'</h3>
			  <div class="address_row"> <b>'.$orderinfo->billing_name.' </b></div>
			  <div class="address_row">'.$orderinfo->billing_add.' </div>
			  </div></td>'; 	
			
			$message .='<td align="left" valign="top"><div class="address_info address_info2 fr">
              <h3> '. __('Shipping Address').'  </h3>
              <div class="address_row"> <b>'.$orderinfo->shipping_name.'</b></div>
              <div class="address_row">'.$orderinfo->shipping_add.'  </div>
             </div></div><!-- checkout Address --></td></tr></table>';
			$message .='					 
					  <table width="100%" class="table table_spacer" >
					  <tr>
					  <td class="title"> '. __('Payment Information').'</td>
					   <td class="title"> '. __('Shipping Information').'</td>
					  </tr>
					  <tr>
					  <td class="row1 ">'.$this->get_payment_method($orderinfo->payment_method).'</td>
					  <td class="row1 ">'.$orderinfo->shipping_method.'</td>
					  </tr>
					  </table>
					  
					  <h3>  '. __('Products Information').' </h3>
					 
					  <table width="100%" class="table " >
 					  <tr>
					  <td width="5%" align="left" class="title" ><strong> '. __('Image').'</strong></td>
					  <td width="45%" align="left" class="title" ><strong> '. __('Product Name').'</strong></td>
					  <td width="13%" align="left" class="title" ><strong> '. __('Qty').'</strong></td>
					  <td width="13%" align="left" class="title" ><strong> '. __('Price').'</strong></td>
					  <td width="23%" align="left" class="title" ><strong> '. __('Price Total').'</strong></td>
					  </tr>';
					 
					$prdsql = "select * from $prd_db_table_name where oid=\"$orderId\"";
					$prdsqlinfo = $wpdb->get_results($prdsql);
					if($prdsqlinfo)
					{
						foreach($prdsqlinfo as $prdinfoObj)
						{
							$data = get_post_meta($prdinfoObj->pid,'key',true);
							$product_name = $wpdb->get_var("select post_title from $wpdb->posts where ID=\"".$prdinfoObj->pid."\"");
							global $Product;
							$post->ID=$prdinfoObj->pid;
							$product_image_arr = $Product->get_product_image($post);
							$product_image = $product_image_arr[0];

							$message .= '<tr>
									<td class="row1"><a href="'.get_permalink($prdinfoObj->pid).'"><img src="'.$product_image.'" width=60 height=60 /></a></td>
									  <td class="row1" ><strong><a href="'.get_permalink($prdinfoObj->pid).'">'.$product_name.'</a>';
									  if($prdinfoObj->pdesc)
									  {
										$message .= '('.$prdinfoObj->pdesc.')';		  
									  }
									  if($data['model'])
									 {
										$message .= '<br>'.__('code : ').$data['model'];
									 }
							$totalprc = $prdinfoObj->grossprice*$prdinfoObj->prd_qty;
							$message .='</strong></td>
									  <td class="row1 " align="left" >'.$prdinfoObj->prd_qty.'</td>
									  <td class="row1 tprice"  align="left">'.$this->get_amount_format($prdinfoObj->grossprice).'</td>
									  <td class="row1 tprice"  align="left">'.$this->get_amount_format($totalprc).'</td>
									  </tr>';
					  }
					}
			$message .= '<tr>
					  <td colspan="4" align="right" class="row1" ><strong> '. __('Sub Total').' :</strong></td>
					  <td class="row1 tprice" ><strong>'.$this->get_amount_format($orderinfo->cart_amount).'</strong></td>
					  </tr>';
			if($orderinfo->discount_amt>0)
			{
			$message .= '<tr>
					  <td colspan="4" align="right" class="row1" ><strong> '. __('Discount Amount').' :</strong> </td>
					  <td class="row1 tprice">- '.$this->get_amount_format($orderinfo->discount_amt).'</td>
					  </tr>';
			}
			if($orderinfo->shipping_amt>0)
			{
			$message .= '<tr>
					  <td colspan="4" align="right" class="row1" ><strong>'.$orderinfo->shipping_method .'  '. __('Amount').' :</strong> </td>
					  <td class="row1 tprice">+ '.$this->get_amount_format($orderinfo->shipping_amt).'</td>
					  </tr>';
			}
			if($orderinfo->tax_amount>0)
			{
			$message .= '<tr>
					  <td colspan="4" align="right" class="row1" ><strong> '. $orderinfo->tax_desc .' : </strong></td>
					  <td class="row1 tprice">+ '.$this->get_amount_format($orderinfo->tax_amount).'</td>
					  </tr>';
			}
			$message .= '<tr>
					  <td colspan="4" align="right" class="row2" ><strong> '. __('Total Payable Amount').' :</strong>  </td>
					  <td class="total_price" ><strong>'.$this->get_amount_format($orderinfo->payable_amt).'</strong></td>
					  </tr>';
			if($orderinfo->ord_desc_client)
			{
			$message .= '<tr><td colspan="4" height="10"  align="left" ></td></tr><tr>
					  <td colspan="1"  align="left" ><strong> '. __('Order&nbsp;Comments').'&nbsp;:</strong>  </td>
					  <td colspan="3" align="left" >'.nl2br(stripslashes($orderinfo->ord_desc_client)).'</td>
					  </tr><tr><td colspan="4" height="10"  align="left" ></td></tr>';
					  
			}
			if($isshow_paydetail)
			{
				if($payment_info['paydeltype'] == 'prebanktransfer')
				{
					$order_id = $order_info['order_id'];
					$order_amt = $order_info['payable_amt'];
					$paymentupdsql = "select option_value from $wpdb->options where option_name='payment_method_".$payment_info['paydeltype']."'";
					$paymentupdinfo = $wpdb->get_results($paymentupdsql);
					$paymentInfo = unserialize($paymentupdinfo[0]->option_value);
					$payOpts = $paymentInfo['payOpts'];
					$bankInfo = $payOpts[0]['value'];
					$accountinfo = $payOpts[1]['value'];
				$message .= ' 
						   <p> '. __('Please transfer amount of').' <u>'.$order_payable_amt.'</u>  '. __('to out bank with following information').':</p>
						 <p>  '. __('payment for Order Number').' : '. $order_id.' &nbsp;&nbsp;('. date(get_option('date_format').' '.get_option('time_format'),strtotime($order_info['order_date'])).')</p>
						 <p> '. __('Bank Name').' : '. $bankInfo.'</p>
						 <p> '. __('Account Number').' : '.$accountinfo.'</p>
						 
						   ';
				}
			}
			$message .='</table>
					  ';
			return $message;
		}
		
		function set_ordert_status($orderId,$order_status='pending')
		{
			global $wpdb,$ord_db_table_name;
			if($orderId)
			{
				$change_order_status = "update $ord_db_table_name set ostatus=\"$order_status\" where oid=\"$orderId\"";	
				$wpdb->query($change_order_status);
			}
			
		}
		
		function get_post_array($postid,$prdcount=5)
		{
			$prdcount++;
			$related_prd = 1;
			$postCatArr = wp_get_post_categories($postid);
			$postCatArr = implode(',',$postCatArr);
			$post_array = array();
			if($postCatArr)
			{
				$postCatStr = $postCatArr;
			}
			$category_posts=get_posts("numberposts=$prdcount&category=".$postCatStr);
			foreach($category_posts as $post) 
			{
				if($post->ID !=  $postid)
				{
					$post_array[$post->ID] = $post;
					$related_prd++;
				}
				if($related_prd==$prdcount)
				break;
			}
			return $post_array;
		}
		
		function get_digital_productpath()
		{
			return get_option('digitalproductpath');
		}
		
		function get_post_images($pid)
		{
			$image_array = array();
			$pmeta = get_post_meta($pid, 'key', $single = true);
			if($pmeta['productimage'])
			{
				$image_array[] = $pmeta['productimage'];
			}
			if($pmeta['productimage1'])
			{
				$image_array[] = $pmeta['productimage1'];
			}
			if($pmeta['productimage2'])
			{
				$image_array[] = $pmeta['productimage2'];
			}
			if($pmeta['productimage3'])
			{
				$image_array[] = $pmeta['productimage3'];
			}
			if($pmeta['productimage4'])
			{
				$image_array[] = $pmeta['productimage4'];
			}
			if($pmeta['productimage5'])
			{
				$image_array[] = $pmeta['productimage5'];
			}
			if($pmeta['productimage6'])
			{
				$image_array[] = $pmeta['productimage6'];
			}
			return $image_array;
		}
		function get_post_image($pid)
		{
			$image_array = array();
			$pmeta = get_post_meta($pid, 'key', $single = true);
			if($pmeta['productimage'])
			{
				$image_array[] = $pmeta['productimage'];
			}
			if($pmeta['productimage1'])
			{
				$image_array[] = $pmeta['productimage1'];
			}
			if($pmeta['productimage2'])
			{
				$image_array[] = $pmeta['productimage2'];
			}
			if($pmeta['productimage3'])
			{
				$image_array[] = $pmeta['productimage3'];
			}
			if($pmeta['productimage4'])
			{
				$image_array[] = $pmeta['productimage4'];
			}
			if($pmeta['productimage5'])
			{
				$image_array[] = $pmeta['productimage5'];
			}
			if($pmeta['productimage6'])
			{
				$image_array[] = $pmeta['productimage6'];
			}
			return $image_array;
		}
		
		function get_checkout_method() //single page checkout
		{
			if(get_option('checkout_method')=='')
			{
				return "normal";
			}else
			{
				return get_option('checkout_method');
			}
		}
		function is_show_term_conditions()
		{
			return get_option('is_show_termcondition');
		}
		function get_term_conditions_statement()
		{
			return get_option('termcondition');
		}
		function get_loginpage_top_statement()
		{
			global $General;
			if(get_option('loginpagecontent'))
			{
				$topcontent = get_option('loginpagecontent');
				$store_name = get_option('blogname');
				$search_array = array('[#$store_name#]');
				$replace_array = array($store_name);
				$instruction = str_replace($search_array,$replace_array,$topcontent);
				?>
				<p class="login_instruction"><?php 	echo $instruction;	?> </p>
				<?php
			}else
			{
				_e(LOGIN_PAGE_TOP_MSG);
			}
		}
		
		function get_shipping_mehod()
		{
			return $this->get_shipping_method();
		}
		function get_userinfo_mandatory_fields()
		{
			$return_array = array();
			if(!$this->is_storetype_digital())
			{
			$return_array['last_name'] = get_option('last_name');
			$return_array['bill_address1'] = get_option('bill_address1');
			$return_array['bill_address2'] = get_option('bill_address2');
			$return_array['bill_city'] = get_option('bill_city');
			$return_array['bill_state'] = get_option('bill_state');
			$return_array['bill_country'] = get_option('bill_country');
			$return_array['bill_zip'] = get_option('bill_zip');
			$return_array['bill_phone'] = get_option('bill_phone');
			}
			return $return_array;
		}
		
		function is_active_affiliate()
		{
			if(get_option('is_active_affiliate'))
			{
				return true;
			}else
			{
				return false;
			}
		}
		function is_send_email_guest()
		{
			if(get_option('send_email_guest') || get_option('send_email_guest') == '')
			{
				return true;
			}else
			{
				return false;
			}
		}
		
		///manage stock start
		function is_set_stock_alert()
		{
			if(get_option('is_set_min_stock_alert') != '')
			{
				return get_option('is_set_min_stock_alert');
			}else
			{
				return '1';
			}
		}
		function is_show_stock_color()
		{
			if(get_option('is_show_stock_color') != '')
			{
				return get_option('is_show_stock_color');
			}else
			{
				return '1';
			}
		}
		function is_show_stock_size()
		{
			if(get_option('is_show_stock_size') != '')
			{
				return get_option('is_show_stock_size');
			}else
			{
				return '1';
			}
		}
		
		function check_stock($pid)
		{
			global $Cart;
			$data = get_post_meta( $pid, 'key', true );
			if(trim($data['initstock'])=='') //Unlimited stock
			{
				return "unlimited";
			}else
			{
				if($data['is_check_outofstock']=='on')
				{
					if(trim($data['initstock'])=='0') // Out of Stock
					{
						return "out_of_stock";
					}else
					{
						$sold_prd_count = $this->product_current_orders_count($pid);
						if($sold_prd_count)
						{
							$sold_prd_count = $sold_prd_count;	
						}
						if(($data['initstock'] - $sold_prd_count)>0)
						{
							return $data['initstock'] - $sold_prd_count;
						}else
						{
							return __("out_of_stock");
						}
					}
				}else
				{
					return "unlimited";
				}			
			}
		}		
		function product_current_orders_count($pid,$arg=array())
		{
			global $prd_db_table_name,$ord_db_table_name;
			global $wpdb;
			$stdate = $arg['stdate'];
			$enddate = $arg['enddate'];
			if($enddate == '')
			{
				$enddate = date('Y-m-d');
			}else
			{
				$enddate = $enddate;
			}

			$procuct_count = 0;
			if($stdate !='' && $enddate !='')
			{
				$suborder_sql = " and date_format(o.ord_date,'%Y-%m-%d') between \"$stdate\" and \"$enddate\"";
			}elseif($stdate =='' && $enddate !='')
			{
				$suborder_sql = " and date_format(o.ord_date,'%Y-%m-%d') <= \"$enddate\"";
			}elseif($stdate !='' && $enddate =='')
			{
				$suborder_sql = " and date_format(o.ord_date,'%Y-%m-%d') >= \"$stdate\"";
			}
			if(get_option('stock_ostatus'))
			{
				$stock_order_status = get_option('stock_ostatus');
				$stock_order_status_arr = explode(',',$stock_order_status);
				$stock_order_status = "'".implode("','",$stock_order_status_arr)."'";
				$suborder_sql .= " and o.ostatus in ($stock_order_status)";
			}
			$ordsql = "select sum(op.prd_qty) from $prd_db_table_name op join $ord_db_table_name o on o.oid=op.oid and op.pid=\"$pid\" and o.ostatus not in ('reject','cancel','pending') $suborder_sql";
			$procuct_count = $wpdb->get_var($ordsql);
			
			
			if($_SESSION['CART_INFORMATION'])
			{
				for($i=0;$i<count($_SESSION['CART_INFORMATION']);$i++)
				{
					if($arg['attribute'])
					{
						for($att=0;$att<$_SESSION['CART_INFORMATION'][$i]['product_qty'];$att++)
						{
							if($_SESSION['CART_INFORMATION'][$i]['product_att'])
							{
								if( $attribute_array)
								{
									$attribute_array = array_merge($attribute_array,explode(',',$_SESSION['CART_INFORMATION'][$i]['product_att']));
								}else
								{
									$attribute_array = explode(',',$_SESSION['CART_INFORMATION'][$i]['product_att']);
								}
							}
						}
					}else
					{	
						if($pid == $_SESSION['CART_INFORMATION'][$i]['product_id'])
						{
							$procuct_count = $procuct_count+ $_SESSION['CART_INFORMATION'][$i]['product_qty'];		
						}
					}
				}
			}
			if($attribute_array)
			{
				return $attribute_array;
			}else
			{
				return $procuct_count;
			}
		}
		function get_out_of_stock_text()
		{
			echo "Out of stock";
		}
		function send_out_of_stock_alert()
		{
			global $Cart;
			$cartInfo = $Cart->getcartInfo();
			for($c=0;$c<count($cartInfo);$c++)
			{
				$this->send_lowest_stock_limit_alert($cartInfo[$c]['product_id']);
			}
		}
		function send_lowest_stock_limit_alert($pid)
		{
			global $wpdb;
			if($this->is_set_stock_alert())
			{
				$data = get_post_meta( $pid, 'key', true );
				if(trim($data['initstock'])!='' && $data['is_check_outofstock']=='on')
				{
					if(trim($data['initstock'])=='0') // Out of Stock
					{
						
					}else
					{
						$sold_prd_count = $this->product_current_orders_count($pid);
						if($data['minstock']>0)
						{
							$sold_prd_count = $sold_prd_count + $data['minstock'];
						}
						if(($data['initstock'] - $sold_prd_count)<=0)
						{
							$prdsql = "select p.post_title from $wpdb->posts p where p.ID=\"$pid\"";
							$prdname = $wpdb->get_var($prdsql);
							$fromEmail = get_option('admin_email');
							$fromEmailName = get_option('blogname');
							$toEmail = $this->get_site_emailId();
							$toEmailName = $this->get_site_emailName();
							$product_url = site_url('/?p='.$pid);
							$subject = 'Product out of  stock alert';
							if(OUT_OF_STOCK_ALERT_EMAIL_MSG=='')
							{
								define('OUT_OF_STOCK_ALERT_EMAIL_MSG','<p>Dear [#$to_name#],</p><p>One of our product <b><a href="[#$product_url#]">[#$product_name#]</a></b> is Out of Stock and this is system generated Alert message for you to inform about lowest level of the product.</p><p>Stock Information is given below:</p><p>Opening Stock : [#$opening_stock#]</p><p>Minimum Stock : [#$minimum_stock#]</p><p>Thank You.</p>');
							}
							$search_array = array('[#$to_name#]','[#$product_url#]','[#$product_name#]','[#$opening_stock#]','[#$minimum_stock#]');
							$replace_array = array($toEmailName,$product_url,$prdname,$data['initstock'],$data['minstock']);
							$message = str_replace($search_array,$replace_array,OUT_OF_STOCK_ALERT_EMAIL_MSG);
							$this->sendEmail($fromEmail,$fromEmailName,$toEmail,$toEmailName,$subject,$message,$extra='');
						}
					}			
				}
			}
		}
		
		function display_stock_text($chk_stock)
		{
			if($chk_stock=='out_of_stock')
			{
				echo '<p>'.__('Estoque Atual').': ';
				$this->get_out_of_stock_text();
				echo '</p>';
			}else
			{
				echo '<p>'.__('Estoque Atual').': '.$chk_stock.'</p>';
			}
		}
		
		function get_attribute_str($attribute_array)
		{
			for($i=0;$i<count($attribute_array);$i++)
			{
				if($attribute_array[$i])
				{
					$attribute_array[$i] = trim(preg_replace('/[(]([+-]+)(.*)[)]/','',$attribute_array[$i]));
				}
			}
			if($attribute_array && is_array($attribute_array))
			{
				return $att_str = ','.implode(',',$attribute_array).',';	
			}else
			{
				return $att_str = '';
			}
			
		}
		///manage stock end	
		
		function show_prd_size_chart($pid)
		{
			$data = get_post_meta( $pid, 'key', true );
			if($pid && $data['size_chart'])
			{			
		?>
            <div class="row"><span style="text-decoration: underline;" class="size_chart more" title="size_chart1">+ <?php _e(SIZE_CHART_TEXT);?></span> </div>
            <div style="display: none;" class="size_chart1 hide" > <span class="close"><?php _e(CLOSE_TEXT);?></span>
            <?php echo stripslashes($data['size_chart']);?>
            </div>
        <?php
			}
		}
		
		function all_product_listing_format()
		{
			 if(get_option('ptthemes_prd_listing_format')=='grid')
			 {
				$showgrid = "thumb_view"; 
			 }else
			 {
				 $showgrid = "";
			 }
			 return $showgrid;
		}
		
		function home_product_listing_format()
		{
			 if(get_option('ptthemes_prd_listing_format_home')=='grid')
			 {
				$showgrid = "thumb_view"; 
			 }else
			 {
				 $showgrid = "";
			 }
			 return $showgrid;
		}
		
		function archive_listing_format()
		{
			  if(get_option('ptthemes_prd_listing_format_cat')=='grid')
			 {
				$showgrid = "thumb_view"; 
			 }else
			 {
				 $showgrid = "";
			 }
			 return $showgrid;
		}
		
		function get_product_listing_thumb_view_js($listtype='category')
		{
			if($listtype=='store')
			{
				$listing = get_option('ptthemes_prd_listing_format');
			}elseif($listtype=='home')
			{
				$listing = get_option('ptthemes_prd_listing_format_home');
			}elseif($listtype=='category')
			{
				$listing = get_option('ptthemes_prd_listing_format_cat');
			}
		?>
         <script type="text/javascript">
        $(document).ready(function(){         
           <?php
			if($listing=='grid')
			{
			?>
			$("a.switch_thumb").toggle(function(){
			  $(this).addClass("swap"); 
			  $("ul.display").fadeOut("fast", function() {
				$(this).fadeIn("fast").removeClass("thumb_view");
				 });
			  }, function () {
			  $(this).removeClass("swap");
			  $("ul.display").fadeOut("fast", function() {
				$(this).fadeIn("fast").addClass("thumb_view"); 
				});
			});
			<?php
			}else
			{
			?>
			$("a.switch_thumb").toggle(function(){
			  $(this).addClass("swap"); 
			  $("ul.display").fadeOut("fast", function() {
				$(this).fadeIn("fast").addClass("thumb_view"); 
				//$(this).fadeIn("fast").removeClass("thumb_view");
				 });
			  }, function () {
			  $(this).removeClass("swap");
			  $("ul.display").fadeOut("fast", function() {
				//$(this).fadeIn("fast").addClass("thumb_view"); 
				$(this).fadeIn("fast").removeClass("thumb_view");
				});
			});
			<?php
			}
			?>
        
        });
        </script>
        <?php
		}
		function is_allow_user_reglogin()
		{
			if(get_option('is_user_reg_allow'))
			{
				return true;
			}else
			{
				return false;
			}
		}
		function is_send_registration_email()
		{
			if(get_option('registration_success_email_flag')!='inactive')
			{
				return true;
			}else
			{
				return false;
			}
		}
		function is_send_order_confirm_email()
		{
			if(get_option('order_payment_success_client_email_flag')!='inactive')
			{
				return true;
			}else
			{
				return false;
			}
		}
		function is_send_order_confirm_email_admin()
		{
			if(get_option('order_submited_success_admin_email_flag')!='inactive')
			{
				return true;
			}else
			{
				return false;
			}
		}
		function is_send_order_approval_email_wpadmin()
		{
			if(get_option('order_approval_client_email_flag')!='inactive')
			{
				return true;
			}else
			{
				return false;
			}
		}
		function is_send_order_reject_email_wpadmin()
		{
			if(get_option('order_rejection_client_email_flag')!='inactive')
			{
				return true;
			}else
			{
				return false;
			}
		}
		
		function is_send_order_shipping_email_wpadmin()
		{
			if(get_option('order_shipping_client_email_flag')!='inactive')
			{
				return true;
			}else
			{
				return false;
			}
		}
		
		function is_send_order_delivered_email_wpadmin()
		{
			if(get_option('order_approval_client_email_flag')!='inactive')
			{
				return true;
			}else
			{
				return false;
			}
		}
		
		function is_send_forgot_pw_email()
		{
			if(get_option('send_email_forgotpw') || get_option('send_email_forgotpw')=='')
			{
				return true;
			}else
			{
				return false;
			}
		}
		
		function get_product_weight_unit()
		{
			if(get_option('weight') || get_option('weight')=='')
			{
				return get_option('weight');
			}
		}
		
		function is_send_order_app_aff_email_wpadmin()
		{
			if(get_option('registration_success_aff_email_flag')!='inactive')
			{
				return true;
			}else
			{
				return false;
			}
		}
		
		function show_store_link_header_nav()
		{
			 global $General;
			 if($General->is_show_storepage())
			 {
			 ?>
			  <li class="store <?php if ($_GET['ptype']=='store') { ?>current_page_item <?php } ?>"><a href="<?php echo site_url('/?ptype=store');?>"><?php _e(STORE_TEXT);?></a>
			  <?php 
					echo " <ul>";
					$ex_catIdArr = get_categories('exclude=9999999' . get_inc_categories("cat_exclude_") .',1');
					$catIdArr = array();
					foreach($ex_catIdArr as $ex_catIdArrObj)
					{
						$catIdArr[] = $ex_catIdArrObj->term_id;
					}
					$includeCats = implode(',',$catIdArr);
					$categoyli = wp_list_categories('echo=0&orderby=name&title_li=&include='.$includeCats);
					if(!strstr($categoyli,'No categories'))
					{
						echo $categoyli;	
					}
					echo " </ul>";
				?>
			  </li>
			  <?php
			 }
		}
		function show_home_link_header_nav()
		{
		?>
		<li class="hometab <?php if ( is_home()&& $_GET['ptype']=='') { ?>current_page_item <?php } ?>"><a href="<?php echo get_option('home'); ?>/"><?php _e(HOME_TEXT);?></a></li>
		<?php
		}
		function show_pages_header_nav()
		{
			if(get_option('ptthemes_pageheader_display')=='Show' || get_option('ptthemes_pageheader_display')=='')
			{
				wp_list_pages('title_li=&depth=0&exclude=' . get_inc_pages("pag_exclude_") .'&sort_column=menu_order');
			}
		}
		
		function get_blog_sub_cats_str($type='array')
		{
			$catid = get_inc_categories("cat_exclude_");
			$catid_arr = explode(',',$catid);
			$blogcatids = '';
			$subcatids_arr = array();
			for($i=0;$i<count($catid_arr);$i++)
			{
				if($catid_arr[$i])
				{
					$subcatids_arr = array_merge($subcatids_arr,array($catid_arr[$i]),get_term_children( $catid_arr[$i],'category'));
				}
			}
			if($subcatids_arr && $type=='string')
			{
				$blogcatids = implode(',',$subcatids_arr);
				return $blogcatids;	
			}else
			{
				return $subcatids_arr;
			}			
		}
		
		function show_blog_link_header_nav()
		{
			global $General;
			$blogcatids = $General->get_blog_sub_cats_str('string');
			if($blogcatids && $General->is_show_blogpage())
			{
				$categoyli = wp_list_categories ('title_li=&use_desc_for_title=0&depth=0&include=' . $blogcatids. '&sort_column=menu_order&echo=0'); 
				if(!strstr($categoyli,'No categories'))
				{
					echo $categoyli;	
				}
			}
			
		}
		function show_category_header_nav()
		{
			if(get_option('ptthemes_catheader_display')=='Show')
			{
				$categories = get_option('ptthemes_categories_id');
				if(is_array($categories))
				{
					$categories = implode(',',$categories);
				}
				$categoyli = wp_list_categories ('title_li=&use_desc_for_title=0&depth=0&include=' . $categories. '&sort_column=menu_order&echo=0'); 
				if(!strstr($categoyli,'No categories'))
				{
					echo $categoyli;	
				}
			}
			
		}
		
		function is_on_ssl_url()
		{
			if(get_option('is_on_ssl'))
			{
				return true;
			}else
			{
				return false;
			}
		}
		function allow_autologin_after_reg()
		{
			if(get_option('allow_autologin_after_reg') || get_option('allow_autologin_after_reg')=='')
			{
				return true;
			}else
			{
				return false;
			}
		}
		function get_ssl_normal_url($url)
		{
			if($this->is_on_ssl_url())
			{
				$url = str_replace('http://','https://',$url);
			}
			return $url;
		}
		function get_url_login($url)
		{
			if(get_option('is_on_ssl_login'))
			{
				return $url = str_replace('http://','https://',$url);
			}else
			{
				return $url;
			}
			return $url;
		}
		
		function view_store_link_home()
		{
		?>
        <a href="<?php echo site_url("/?ptype=store");?>" class="highlight_button fr" ><?php _e(VIEW_STORE_TEXT);?></a>
        <?php	
		}
		
		function display_message_checkcout()
		{
			if(isset($_SESSION['display_message']) && $_SESSION['display_message']!='')
			{
				echo '<p style="color:#FF0000">'.$_SESSION['display_message']."<p>";
				$_SESSION['display_message'] = '';
			}
		}
		function show_term_and_condition()
		{
			global $General;
			if($General->is_show_term_conditions())
			{
			?>
			<div class="terms_condition clearfix">
			<input type="checkbox" name="termsandconditions" id="termsandconditions" class="checkin2" />&nbsp;
			<?php
			if($General->get_term_conditions_statement()!='')
			{
			echo $General->get_term_conditions_statement();
			}else
			{
			_e(CHECKOUT_TERMS_CONDITIONS_MSG);
			}
			?>
			</div>
			<?php
			}
		}
		
		function get_amount_format($amount,$show_currency=1)
		{
			if($amount)
			{
				$number_of_price_decimal = get_option('number_of_price_decimal');
				$currencysym_pos = get_option('currencysym_pos');
				if($number_of_price_decimal=='')
				{
					$number_of_price_decimal = 2;	
				}
				$amount = @number_format($amount,$number_of_price_decimal);
				if($show_currency){
					if($currencysym_pos=='after')
					{
						$amount = $amount.''.$this->get_currency_symbol();
					}elseif($currencysym_pos=='none')
					{
						$amount = $amount;
					}else
					{
						$amount = $this->get_currency_symbol().$amount;	
					}					
				}
				return $amount;
			}
		}
		
		function cart_detail_outofstock($pid,$qty=0,$pg='')
		{
			global $Cart;
			$data = get_post_meta( $pid, 'key', true );
			$sold_prd_count_ori = $this->product_current_orders_count($pid);
			$sold_prd_count = $sold_prd_count_ori;
			if($qty)
			{
				$sold_prd_count = $sold_prd_count + $qty;	
			}

			if($data['initstock'])
			{

				if($data['initstock']=='0' || $data['initstock'] < $sold_prd_count)
				{
					$currentqty = $data['initstock'] - $sold_prd_count;
					if($currentqty>0)
					{
						if($pg=='pd' && $_SESSION['CART_INFORMATION']) //$pg='pd' --for product detail
						{
							for($i=0;$i<count($_SESSION['CART_INFORMATION']);$i++)
							{
								if($_SESSION['CART_INFORMATION'][$i]['product_id']==$pid)
								{
									$product_qty = $_SESSION['CART_INFORMATION'][$i]['product_qty'];
									$currentqty  = $currentqty - $product_qty;
								}
							}
						}
						if(($data['initstock'] - $sold_prd_count_ori)>0)
						{
							$currentqty = $data['initstock'] - $sold_prd_count_ori;
							return __("Maximum available quantity is $currentqty only.");		
						}else
						{
							return __("Out of Stock");	
						}
					}elseif(($data['initstock'] - $sold_prd_count_ori)>0)
						{
							$currentqty = $data['initstock'] - $sold_prd_count_ori;
							return __("Maximum available quantity is $currentqty only.");		
						}				
					else
					{
						return __("Out of Stock");
					}
				}else
				{
					return $currentqty = $data['initstock'] - $sold_prd_count_ori;;	
				}
			}
		}
	}
	// Start this plugin once all other plugins are fully loaded
}
if(!$General)
{
	$General = new General();
}
?>