<?php
global $wpdb,$General;
global $upload_folder_path;
if($_POST && $_POST['admin_settings_saved'])
{
	$option_value['admin_settings_saved'] = $_POST['admin_settings_saved'];	
	$option_value['currency'] = $_POST['currency'];
	$option_value['weight'] = $_POST['weight'];	
	$option_value['currencysym'] = $_POST['currencysym']; 
	$option_value['site_email'] = $_POST['site_email'];
	$option_value['site_email_name'] = $_POST['site_email_name']; 
	$option_value['tax'] = $_POST['tax'];
	$option_value['is_show_weight'] = $_POST['is_show_weight'];
	$option_value['store_type'] = $_POST['store_type'];	
	$option_value['imagepath'] = $_POST['imagepath'];
	$option_value['is_show_coupon'] = $_POST['is_show_coupon'];	
	$option_value['dash_noof_orders'] = $_POST['dash_noof_orders'];	
	$option_value['is_show_tellafrnd'] = $_POST['is_show_tellafrnd'];
	$option_value['is_show_addcomment'] = $_POST['is_show_addcomment'];
	$option_value['checkout_type'] = $_POST['checkout_type'];
	$option_value['is_show_relproducts'] = $_POST['is_show_relproducts'];	
	$option_value['digitalproductpath'] = $_POST['digitalproductpath'];	
	$option_value['is_show_blogpage'] = $_POST['is_show_blogpage'];	
	$option_value['is_show_storepage'] = $_POST['is_show_storepage'];
	$option_value['is_show_category'] = $_POST['is_show_category'];
	$option_value['checkout_method'] = $_POST['checkout_method'];
	$option_value['is_show_termcondition'] = $_POST['is_show_termcondition'];
	$option_value['termcondition'] = stripslashes($_POST['termcondition']);
	$option_value['loginpagecontent'] = stripslashes($_POST['loginpagecontent']);
	$option_value['last_name'] = $_POST['last_name'];
	$option_value['bill_address1'] = $_POST['bill_address1'];
	$option_value['bill_address2'] = $_POST['bill_address2'];
	$option_value['bill_city'] = $_POST['bill_city'];
	$option_value['bill_state'] = $_POST['bill_state'];
	$option_value['bill_country'] = $_POST['bill_country'];
	$option_value['bill_zip'] = $_POST['bill_zip'];
	$option_value['bill_phone'] = $_POST['bill_phone'];
	$option_value['is_active_affiliate'] = $_POST['is_active_affiliate'];
	$option_value['send_email_guest'] = $_POST['send_email_guest'];
	$option_value['is_set_min_stock_alert'] = $_POST['is_set_min_stock_alert'];
	$option_value['is_show_stock_color'] = $_POST['is_show_stock_color'];
	$option_value['is_show_stock_size'] = $_POST['is_show_stock_size'];
	$option_value['send_email_user'] = $_POST['send_email_user'];
	$option_value['send_cust_order_email'] = $_POST['send_cust_order_email'];
	$option_value['send_admin_order_email'] = $_POST['send_admin_order_email'];
	$option_value['send_order_app_wpadmin_email'] = $_POST['send_order_app_wpadmin_email'];
	$option_value['send_order_rej_wpadmin_email'] = $_POST['send_order_rej_wpadmin_email'];
	$option_value['send_email_forgotpw'] = $_POST['send_email_forgotpw'];
	$option_value['is_on_ssl'] = $_POST['is_on_ssl'];
	$option_value['is_on_ssl_login'] = $_POST['is_on_ssl_login'];
	$option_value['allow_autologin_after_reg'] = $_POST['allow_autologin_after_reg'];
	$option_value['stock_ostatus'] = $_POST['stock_ostatus'];
	$option_value['currencysym_pos'] = $_POST['currencysym_pos'];
	$option_value['number_of_price_decimal'] = $_POST['number_of_price_decimal'];
	
	foreach($option_value as $key=>$val)
	{
		update_option($key,$val);
	}
	$message = "Updated Succesfully.";
}

if(!get_option('admin_settings_saved'))
{
	$paymethodinfo = array(
						"currency"		=> 'USD',
						"currencysym"	=> '$',
						"weight"		=> 'oz',						
						"site_email"	=> get_option('admin_email'),
						"site_email_name"=>	get_option('blogname'),
						"tax"			=>	'0.00',
						"is_show_weight"=>	'1',
						"store_type"	=>	'cart',
						"imagepath"		=>	"",		
						"is_show_coupon"=>	"1",
						"dash_noof_orders"=>	"5",
						"is_show_tellafrnd"=>	"1",
						"is_show_addcomment"=>	"0",
						"checkout_type"=>	"cart",
						"is_show_relproducts"=>	"1",
						"digitalproductpath"=>	"",
						"is_show_blogpage"=>	"1",
						"is_show_storepage"=>	"1",
						"is_show_category"=>	"1",
						"checkout_method"	=>	"normal",
						"is_show_termcondition"	=>	'1',
						"termcondition"	=>	'Accept Terms and Conditions',
						"loginpagecontent"	=>	'If you are an existing customer of [#$store_name#] or have previously registered you may sign in below or request a new password. Otherwise please enter your information below and an account will be created for you.',
						"last_name"	=>	"1",
						"bill_address1"=>	"1",
						"bill_address2"=>	"1",																	
						"bill_city"=>	"1",
						"bill_state"=>	"1",
						"bill_country"=>	"1",
						"bill_zip"=>	"1",
						"bill_phone"=>	"1",
						"is_active_affiliate"=>	"0",
						"send_email_guest"=>	"1",
						"is_set_min_stock_alert"=>	"1",
						"is_show_stock_color"=>	"1",
						"is_show_stock_size"=>	"1",
						"send_email_user"=>	"1",
						"send_cust_order_email"=>	"1",
						"send_admin_order_email"=>	"1",
						"send_order_app_wpadmin_email"=>	"1",
						"send_order_rej_wpadmin_email"=>	"1",
						"send_email_forgotpw"=>	"1",
						"is_on_ssl"=>	"1",
						"is_on_ssl_login"=>	"1",
						"allow_autologin_after_reg"=>	"1",
						"stock_ostatus"=>	"",
						"currencysym_pos"=>	"before",
						"number_of_price_decimal"=>	"2",
						
						);
		foreach($paymethodinfo as $key=>$val)
		{
			update_option($key,$val);
		}
}
$admin_settings_saved = get_option('admin_settings_saved');
$currency = get_option('currency');
$weight = get_option('weight');
$currencysym = get_option('currencysym');
$site_email = get_option('site_email');
$site_email_name = get_option('site_email_name');
$tax = get_option('tax');
$is_show_weight = get_option('is_show_weight');
$store_type = get_option('store_type');
$imagepath = get_option('imagepath');
$is_show_coupon = get_option('is_show_coupon');
$dash_noof_orders = get_option('dash_noof_orders');
$is_show_tellafrnd = get_option('is_show_tellafrnd');
$is_show_addcomment = get_option('is_show_addcomment');
$checkout_type = get_option('checkout_type');
$is_show_relproducts = get_option('is_show_relproducts');
$digitalproductpath = get_option('digitalproductpath');
$is_show_blogpage = get_option('is_show_blogpage');
$is_show_storepage = get_option('is_show_storepage');
$is_show_category = get_option('is_show_category');
$checkout_method = get_option('checkout_method');
$is_show_termcondition = stripslashes(get_option('is_show_termcondition'));
$termcondition = get_option('termcondition');
$loginpagecontent = stripslashes(get_option('loginpagecontent'));
$last_name = get_option('last_name');
$bill_address1 = get_option('bill_address1');
$bill_address2 = get_option('bill_address2');
$bill_city = get_option('bill_city');
$bill_state = get_option('bill_state');
$bill_country = get_option('bill_country');
$bill_zip = get_option('bill_zip');
$bill_phone = get_option('bill_phone');
$is_active_affiliate = get_option('is_active_affiliate');
$send_email_guest = get_option('send_email_guest');
$is_set_min_stock_alert = get_option('is_set_min_stock_alert');
$is_show_stock_color = get_option('is_show_stock_color');
$is_show_stock_size = get_option('is_show_stock_size');
$send_email_user = get_option('send_email_user');
$send_admin_order_email = get_option('send_admin_order_email');
$send_cust_order_email = get_option('send_cust_order_email');
$send_order_app_wpadmin_email = get_option('send_order_app_wpadmin_email');
$send_order_rej_wpadmin_email = get_option('send_order_rej_wpadmin_email');
$send_email_forgotpw = get_option('send_email_forgotpw');
$is_on_ssl = get_option('is_on_ssl');
$is_on_ssl_login = get_option('is_on_ssl_login');
$allow_autologin_after_reg =get_option('allow_autologin_after_reg');
$stock_ostatus = get_option('stock_ostatus');
$currencysym_pos = get_option('currencysym_pos');
$number_of_price_decimal = get_option('number_of_price_decimal');
?>
<div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_general_settings"><?php _e('General Settings'); ?></span>  
 </div> <!-- sub heading -->
 
  <?php if($message){?>
  <div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
    <p><?php _e($message);?> </p>
  </div>
  <?php }?>
  
<form action="<?php echo site_url( '/wp-admin/admin.php?page=settings' );?>" method="post">
<input type="hidden" name="admin_settings_saved" value="1" />
 <div class="tabber">
	<div class="tabbertab">
    <h2> <?php _e('Shopping Cart');?> </h2>
<table width="100%" cellpadding="5" class="widefat post sub_table" ><thead>
  <tr>
        <td width="250"><?php _e('Store Type'); ?></td>
        <td width="58%"><select name="store_type" class="max">
            <option value="cart" <?php if($store_type=='cart'){?> selected="selected"<?php }?>><?php _e('Shopping Cart');?></option>
            <option value="digital" <?php if($store_type=='digital'){?> selected="selected"<?php }?>><?php _e('Digital Shop');?></option
>
            <option value="catalog" <?php if($store_type=='catalog'){?> selected="selected"<?php }?>><?php _e('Catalog Mode');?></option>
          </select>        </td>
      </tr>
      <tr>
        <td><?php _e("<em>Checkout Type (for 'Shopping Cart' and 'Digital Shop' only)</em>"); ?> </td>
        <td><select name="checkout_type" class="max">
            <option value="cart" <?php if($checkout_type=='cart'){?> selected="selected"<?php }?>><?php _e('Shopping Cart');?></option>
            <option value="buynow" <?php if($checkout_type=='buynow'){?> selected="selected"<?php }?>><?php _e('Buy Now Button');?></option>
          </select>        </td>
      </tr>
        <tr>
        <td><?php _e('Checkout/Login Method'); ?></td>
        <td><select name="checkout_method" class="max" >
            <option value="normal" <?php if($checkout_method=='normal'){?> selected="selected"<?php }?>><?php _e('Normal Login Checkout');?></option>
            <option value="single" <?php if($checkout_method=='single'){?> selected="selected"<?php }?>><?php _e('Checkout as Guest');?></option>
            <option value="login_reg_not" <?php if($checkout_method=='login_reg_not'){?> selected="selected"<?php }?>><?php _e('Login and Registration not allowed');?></option>
             <option value="reg_not" <?php if($checkout_method=='reg_not'){?> selected="selected"<?php }?>><?php _e('Registration not allowed');?></option>
          </select>        </td>
      </tr>
      <tr>
        <td><?php _e('From Email Name'); ?></td>
        <td><input type="text" name="site_email_name" value="<?php echo $site_email_name;?>" class="max" /></td>
      </tr>
      <tr>
        <td><?php _e('From Email ID'); ?></td>
        <td><input type="text" name="site_email" value="<?php echo $site_email;?>" class="max" /></td>
      </tr>
      <tr>
        <td><?php _e('Default Currency (Ex.: USD)'); ?></td>
        <td><input type="text" name="currency" value="<?php echo $currency;?>" class="max" /></td>
      </tr>
      <tr>
        <td><?php _e('Default Currency Symbol (Ex.: $)'); ?></td>
        <td><input type="text" name="currencysym" value="<?php echo $currencysym;?>" class="max" /></td>
      </tr>
       <tr>
        <td><?php _e('Price Format Decimals <br> (Ex.: 0 for 1/1 for 1.0/2 for 1.00/3 for 1.000/4 for  1.000)'); ?></td>
        <td><input type="text" name="number_of_price_decimal" value="<?php echo $number_of_price_decimal;?>" class="max" /></td>
      </tr>
       <tr>
        <td><?php _e('Price Format Currency Symbol Position'); ?></td>
        <td>
        <?php
        if(get_option('currencysym'))
		{
			$currencysymball = 	get_option('currencysym');
		}else
		{
			$currencysymball = '$';
		}
		?>
        <select id="currencysym_pos" name="currencysym_pos" class="max">
        <option value="before" <?php if($currencysym_pos=='before'){ echo 'selected="selected"';}?>><?php printf(__('Before Price Amount(%s 10.00)'),$currencysymball);?></option>
        <option value="after" <?php if($currencysym_pos=='after'){ echo 'selected="selected"';}?>><?php  printf(__('After Price Amount(10.00 %s)'),$currencysymball);?></option>
        <option value="none" <?php if($currencysym_pos=='none'){ echo 'selected="selected"';}?>><?php _e('None(10.00)');?></option>
        </select>
        </td>
      </tr>
	   <tr>
        <td><?php _e('Default Weight Unit (Ex.: gr,dr,oz or lb)'); ?>
		<br />
        <?php _e('You can also leave this as blank '); ?>
		</td>
        <td><input type="text" name="weight" value="<?php echo $weight;?>" class="max" /></td>
      </tr>
      <tr>
        <td><?php _e('Product Tax - apply to each products (%)'); ?></td>
        <td><input type="text" name="tax" value="<?php echo $tax;?>" class="max" /></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" name="submit" value="<?php _e('Submit'); ?>" class="b_common action" /></td>
      </tr>
</thead></table>
	</div> <!-- tab 1-->
    
     <div class="tabbertab"> 
     <h2> <?php _e('Product Settings');?> </h2>
<table width="100%" cellpadding="5" class="widefat post sub_table" >
	<thead>
 <tr>
        <td width="50%"><?php _e('Product Image Path'); ?> (<?php echo site_url("/$upload_folder_path");?>) <br />
          <?php _e("(Default folder is 'products_img')"); ?> </td>
        <td><input type="text" name="imagepath" value="<?php echo $imagepath;?>" /></td>
      </tr>
      <tr>
        <td><?php _e('Digital Product Path'); ?> (<?php echo site_url("/$upload_folder_path");?>) <br />
          <?php _e("(Default folder is 'digital_products')"); ?> </td>
        <td><input type="text" name="digitalproductpath" value="<?php echo $digitalproductpath;?>" /></td>
      </tr>
      </thead>
      </table>
      
      
      <h3><b><?php _e('Stock Settings'); ?></b></h3>
      <table width="100%"  class="widefat post sub_table" >
	<thead>
      
	 
	   <tr>
        <td width="50%" ><?php _e('Set email alert on minimum stock of Product'); ?></td>
        <td><select name="is_set_min_stock_alert" class="max">
            <option value="1" <?php if($is_set_min_stock_alert==1){?> selected="selected"<?php }?>><?php _e('Yes');?></option>
            <option value="0" <?php if($is_set_min_stock_alert=='0'){?> selected="selected"<?php }?>><?php _e('No');?></option>
          </select>        </td>
      </tr>
       <tr>
        <td width="50%" ><?php _e('Stock calculation for order status'); ?></td>
        <td>
	      <strong><?php _e('Stock will calculated for approved,shipped or delivered order status only.');?></strong>
       </td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" name="submit" value="<?php _e('Submit'); ?>" class="b_common action" /></td>
      </tr>
</thead></table> 
	</div> <!-- tab 1-->       

<div class="tabbertab">
<h2> <?php _e('Email Settings');?> </h2>
<table width="100%" cellpadding="5" class="widefat post sub_table" ><thead>
       <tr>
        <td><?php _e('Send Guest Registration Email Notification'); ?><br />
        <?php _e('In case of Checkout as Guest do you want to send Registration Email Notification'); ?>
        </td>
        <td>
        <select name="send_email_guest" class="mini">
            <option value="0" <?php if($send_email_guest=='0'){?> selected="selected"<?php }?>><?php _e('No');?></option>
            <option value="1" <?php if($send_email_guest==1){?> selected="selected"<?php }?>><?php _e('Yes');?></option>
          </select>        </td>
      </tr>
      <tr>
        <td><?php _e('Send Forgot Password Email Notification'); ?>
        </td>
        <td><select name="send_email_forgotpw" class="mini">
            <option value="1" <?php if($send_email_forgotpw==1){?> selected="selected"<?php }?>><?php _e('Yes');?></option>
            <option value="0" <?php if($send_email_forgotpw=='0'){?> selected="selected"<?php }?>><?php _e('No');?></option>
          </select>        </td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" name="submit" value="<?php _e('Submit'); ?>" class="b_common action" /></td>
      </tr>
</thead></table>
	</div> <!-- tab 1-->       
 
<div class="tabbertab">
<h2> <?php _e('Other Settings');?> </h2>
<table width="100%" cellpadding="5" class="widefat post sub_table" ><thead>
 <tr>
        <td width="40%"><?php _e('Enable SSL - https for checkout process'); ?></td>
        <td><select name="is_on_ssl" class="mini">
            <option value="1" <?php if($is_on_ssl==1){?> selected="selected"<?php }?>><?php _e('Yes');?></option>
            <option value="0" <?php if($is_on_ssl=='0'){?> selected="selected"<?php }?>><?php _e('No');?></option>
          </select>        </td>
      </tr>
       <td width="40%"><?php _e('Enable SSL - https for Login process'); ?></td>
        <td><select name="is_on_ssl_login" class="mini">
            <option value="1" <?php if($is_on_ssl_login=='1'){?> selected="selected"<?php }?>><?php _e('Yes');?></option>
            <option value="0" <?php if($is_on_ssl_login=='0'){?> selected="selected"<?php }?>><?php _e('No');?></option>
          </select>        </td>
      </tr>
      <tr>
      <td width="40%"><?php _e('Enable Auto login after successful Registraton'); ?></td>
        <td><select name="allow_autologin_after_reg" class="mini">
            <option value="1" <?php if($allow_autologin_after_reg==1){?> selected="selected"<?php }?>><?php _e('Yes');?></option>
            <option value="0" <?php if($allow_autologin_after_reg=='0'){?> selected="selected"<?php }?>><?php _e('No');?></option>
          </select>        </td>
      </tr>
      
     <?php /*?> <tr>
        <td><?php _e('Display Blog Page link on header navigation'); ?></td>
        <td><select name="is_show_blogpage" class="mini" >
            <option value="1" <?php if($is_show_blogpage==1){?> selected="selected"<?php }?>><?php _e('Yes');?></option>
            <option value="0" <?php if($is_show_blogpage=='0'){?> selected="selected"<?php }?>><?php _e('No');?></option>
          </select>        </td>
      </tr>
      <tr>
        <td><?php _e('Display Store Page link on header navigation'); ?></td>
        <td><select name="is_show_storepage" class="mini">
            <option value="1" <?php if($is_show_storepage==1){?> selected="selected"<?php }?>><?php _e('Yes');?></option>
            <option value="0" <?php if($is_show_storepage=='0'){?> selected="selected"<?php }?>><?php _e('No');?></option>
          </select>        </td>
      </tr><?php */?>
      <tr>
        <td><?php _e('Display Number of Orders on Admin Dashboard'); ?></td>
        <td><input type="text" name="dash_noof_orders" value="<?php echo $dash_noof_orders;?>" class="max" /></td>
      </tr>
	   <tr>
        <td><?php _e('Display Coupon code on checkout page'); ?> </td>
        <td><select name="is_show_coupon" class="mini">
            <option value="1" <?php if($is_show_coupon==1){?> selected="selected"<?php }?>><?php _e('Yes');?></option>
            <option value="0" <?php if($is_show_coupon=='0'){?> selected="selected"<?php }?>><?php _e('No');?></option>
          </select>        </td>
      </tr>
       <tr>
        <td><?php _e('Display Term and Conditions'); ?><br />
       ( <?php _e('Display Term and Conditions checkbox at checkout page'); ?>)        </td>
        <td><select name="is_show_termcondition" class="mini">
            <option value="1" <?php if($is_show_termcondition==1){?> selected="selected"<?php }?>><?php _e('Yes');?></option>
            <option value="0" <?php if($is_show_termcondition=='0'){?> selected="selected"<?php }?>><?php _e('No');?></option>
          </select>
          <?php _e('syntax beside checkbox');?> <textarea name="termcondition" id="termcondition"><?php echo $termcondition;?></textarea>       </td>
      </tr>
       <tr>
        <td><?php _e('Registration Page Mandatory Fields'); ?>
        <br />( <?php _e('the selected fields will be Mandatory Fields while collecting user information'); ?>)        </td>
        <td>
        
        <table border="0" cellspacing="0" cellpadding="0" class="sub_table">
                      <tr>
                        <td class="first" ><input type="checkbox" name="last_name" value="1" <?php if($last_name){?> checked="checked"<?php }?> /> </td>
                        <td> <?php _e('Last Name');?></td>
                      </tr>
                      <tr>
                      <td class="first"> <input type="checkbox" name="bill_address1" value="1" <?php if($bill_address1){?> checked="checked"<?php }?> /></td>
                      <td> <?php _e('Address1');?></td>
                      </tr>
                      
                       <tr>
                      <td class="first"> <input type="checkbox" name="bill_address2" value="1" <?php if($bill_address2){?> checked="checked"<?php }?> /></td>
                      <td> <?php _e('Address2');?></td>
                      </tr>
                      
                      <tr>
                      <td> <input type="checkbox" name="bill_city" value="1" <?php if($bill_city){?> checked="checked"<?php }?> /></td>
                      <td> <?php _e('City');?></td>
                      </tr>
                      
                       <tr>
                      <td class="first"> <input type="checkbox" name="bill_state" value="1" <?php if($bill_state){?> checked="checked"<?php }?> /></td>
                      <td>  <?php _e('State');?></td>
                      </tr>
                      
                       <tr>
                      <td class="first"> <input type="checkbox" name="bill_country" value="1" <?php if($bill_country){?> checked="checked"<?php }?> /></td>
                      <td> <?php _e('Country');?></td>
                      </tr>
                     <tr>
                      <td class="first"> <input type="checkbox" name="bill_zip" value="1" <?php if($bill_zip){?> checked="checked"<?php }?> /></td>
                      <td> <?php _e('Postal Code');?></td>
                      </tr>
                       <tr>
                      <td class="first"> <input type="checkbox" name="bill_phone" value="1" <?php if($bill_phone){?> checked="checked"<?php }?> /></td>
                      <td> <?php _e('Phone Number');?></td>
                      </tr>
                    </table>
        </td>
      </tr>
      <tr>
        <td><?php _e('Login Page Top Content'); ?> </td>
        <td><textarea name="loginpagecontent" id="loginpagecontent" cols="70" rows="7"><?php _e($loginpagecontent);?></textarea></td>
      </tr> 
      <tr>
        <td></td>
        <td><input type="submit" name="submit" value="<?php _e('Submit'); ?>" class="b_common action" /></td>
      </tr>
</thead></table>
	</div> <!-- tab 1-->

<script language="javascript">
function resetthankyoucontent()
{
	var thankyoucontent='Thank you for your order\n\nYour payment has been successfully received and your order will be processed for shipping.\n\nThank you for shopping at {#[store_name]#}.';
	document.getElementById('thankyoucontent').value = thankyoucontent;
}
</script>
</div> <!-- tabber #end -->
</form>
 </div>   <!-- wrapper #end -->