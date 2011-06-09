<?php
$chekcout_method = $General->get_checkout_method();

if($userInfo) //simple checkout
{
?>
<div class="checkout_address">
  <div class="address_info fl">
	<h3><?php _e(BILLING_ADDRESS_TEXT); ?> <span>(<a href="<?php echo site_url('/?ptype=account&type=editprofile'); ?>"><u><?php _e(CHECKOUT_EDIT_LINK); ?></u></a>)</span></h3>
	<div class="address_row"> <b><?php echo $userInfo['display_name'];?></b></div>
	<div class="address_row"><?php echo $user_address_info['user_add1'];?></div>
	<div class="address_row"><?php echo $user_address_info['user_add2'];?></div>
	<div class="address_row"><?php echo $user_address_info['user_city'];?>, <?php echo $user_address_info['user_state'];?>,</div>
	<div class="address_row"><?php echo $user_address_info['user_country'];?> - <?php echo $user_address_info['user_postalcode'];?></div>
    <?php if($user_address_info['phone']!='' ){?> <div class="address_row"><?php _e(PHONE_NUMBER_TEXT);?> : <?php echo $user_address_info['phone'];?></div>  <?php }?>
  </div>
  <?php  if(!$General->is_storetype_digital()){	?>
  <div class="address_info fr">
	<h3><?php _e(SHIPPING_ADDRESS_TEXT); ?> <span>(<a href="<?php echo site_url('/?ptype=account&type=editprofile'); ?>"><u><?php _e(CHECKOUT_EDIT_LINK); ?></u></a>)</span> </h3>
	<div class="address_row"> <b><?php echo $user_address_info['buser_name'];?></b></div>
	<div class="address_row"><?php echo $user_address_info['buser_add1'];?> </div>
	<div class="address_row"><?php echo $user_address_info['buser_add2'];?></div>
	<div class="address_row"><?php echo $user_address_info['buser_city'];?>, <?php echo $user_address_info['buser_state'];?>, </div>
	<div class="address_row"><?php echo $user_address_info['buser_country'];?> - <?php echo $user_address_info['buser_postalcode'];?></div>
  </div>
 <?php }?>
</div>
<?php
}else  //single page checkout
{
?>
<div class="checkout_address">
  <div class="address_info fl">
	<h3><?php _e(USER_INFO_TEXT);?></h3>
	<div class="address_row"> <label> <?php _e(NAME_TEXT);?> <span class="indicates">*</span></label>  <input type="text" name="user_fname" id="user_fname" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_fname)); ?>" size="25"  /></div>
    <div class="address_row"> <label> <?php _e(EMAIL_TEXT);?> <span class="indicates">*</span></label> <input type="text" name="user_email" id="user_email" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_email)); ?>" size="25" /></div>

  <?php
    if(!$General->is_storetype_digital())
	{
	?>
    <?php
	$mandotary_info = $General->get_userinfo_mandatory_fields();
	if($mandotary_info['bill_address1'])
	{
		$bill_address1 = ' <span class="indicates">*</span>';
	}
	if($mandotary_info['bill_address2'])
	{
		$bill_address2 = ' <span class="indicates">*</span>';
	}
	if($mandotary_info['bill_city'])
	{
		$bill_city = ' <span class="indicates">*</span>';
	}
	if($mandotary_info['bill_state'])
	{
		$bill_state = ' <span class="indicates">*</span>';
	}
	if($mandotary_info['bill_country'])
	{
		$bill_country = ' <span class="indicates">*</span>';
	}
	if($mandotary_info['bill_zip'])
	{
		$bill_zip = ' <span class="indicates">*</span>';
	}
	if($mandotary_info['bill_phone'])
	{
		$bill_phone = ' <span class="indicates">*</span>';
	}
	?>
    <h4><?php _e(BILLING_ADDRESS_TEXT);?></h4>
    <div class="address_row">  
	 <label><?php _e(ADDRESS_TEXT);?> <?php echo $bill_address1;?> </label> 
     <input type="text" name="user_add1" id="user_add1" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_add1)); ?>" size="25" /></div>
      
     
     <div class="address_row">
	 <label><?php _e(COUNTRY_TEXT);?> <?php echo $bill_country;?> </label>
    <select name="user_country"  id="user_country" onChange="get_country_state(this.value,'','user_state');" class="reg_row_textfield">
    <option value=""><?php _e('Select Country');?></option>
    <?php echo frontend_country_dl(esc_attr(stripslashes($user_country)));?>
    </select>
     </div>
     
     <div class="address_row">
	 <label><?php _e(STATE_TEXT);?> <?php echo $bill_state;?></label>
    <span id="state_ajax_indicator">
    <select name="user_state"  id="user_state" class="reg_row_textfield">
    <option value=""><?php _e('Select Country First');?></option>
    </select>&nbsp;
    </span>
     </div>
     
      <div class="address_row"> 
	 <label><?php _e(CITY_TEXT);?> <?php echo $bill_city;?> </label>
    <input type="text" name="user_city" id="user_city" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_city)); ?>" size="25" /></div>
    
    <div class="address_row">
	 <label><?php _e(POSTAL_CODE_TEXT);?> <?php echo $bill_zip;?> </label>
     <input type="text" name="user_postalcode" id="user_postalcode" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_postalcode)); ?>" size="25" /></div>
    
     
     <div class="address_row">
	 <label><?php _e('Phone Number');?>  <?php echo $bill_phone;?> </label>
     <input type="text" name="phone" id="phone" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($phone)); ?>" size="25" /></div>
</div>
  <?php
    if(!$General->is_storetype_digital())
	{
	?>
   <h4><?php _e(SHIPPING_ADDRESS_TEXT);?></h4> 
   
   <div class="address_row"><span><input type="checkbox" name="copybilladd" id="copybilladd" onClick="copy_billing_address();" ><?php _e(SAME_AS_ABOVE_TEXT);?></span> </div>
   <div class="address_row"><label><?php _e(ADDRESS_TEXT);?> </label>
   <input type="text" name="buser_add1" id="buser_add1" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($buser_add1)); ?>" size="25" /></div>
   
      <div class="address_row"><label><?php _e(COUNTRY_TEXT);?>  </label>
    <select name="buser_country"  id="buser_country" onChange="get_country_billstate(this.value,'','buser_state');" class="reg_row_textfield">
       <option value=""><?php _e('All Countries');?></option>
	   <?php echo frontend_country_dl( esc_attr(stripslashes($buser_country)));?>
       </select>
    
    </div>
    
    <div class="address_row"><label><?php _e(STATE_TEXT);?> </label>
    <span id="billstate_ajax_indicator">
     <select name="buser_state"  id="buser_state" class="reg_row_textfield">
       <option value=""><?php _e('Select Country First');?></option>
       </select>
       </span>
    </div>
    
   <div class="address_row"><label><?php _e(CITY_TEXT);?> </label>
    <input type="text" name="buser_city" id="buser_city" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($buser_city)); ?>" size="25" /></div>
    
     <div class="address_row"><label><?php _e(POSTAL_CODE_TEXT);?> </label>
    <input type="text" name="buser_postalcode" id="buser_postalcode" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($buser_postalcode)); ?>" size="25" /></div> 
    
   
    
    <?php }	?>
	<?php }	?>
    </div>
<script type="text/javascript">
function copy_billing_address()
{
	if(document.getElementById('copybilladd').checked)
	{
		document.getElementById('buser_add1').value = document.getElementById('user_add1').value;
		document.getElementById('buser_city').value = document.getElementById('user_city').value;
		//document.getElementById('buser_state').value = document.getElementById('user_state').value;
		document.getElementById('buser_country').value = document.getElementById('user_country').value;
		if(document.getElementById('user_country').value!='')
		{
		var country_id = document.getElementById('user_country').value;
		var state_id = document.getElementById('user_state').value;
		get_country_billstate(country_id,state_id,'buser_state');
		}
		document.getElementById('buser_postalcode').value = document.getElementById('user_postalcode').value;
	}else
	{
		document.getElementById('buser_add1').value = '';
		document.getElementById('buser_city').value = '';
		document.getElementById('buser_state').value = '';
		document.getElementById('buser_country').value = '';
		document.getElementById('buser_postalcode').value = '';
	}
}
function check_user_info()
{
	<?php
	if(!$userInfo)
	{
	?>
	if(document.getElementById('user_fname').value=='')
	{
		alert('<?php _e('Please enter '.NAME_TEXT);?>');
		document.getElementById('user_fname').focus();
		return false;
	}
	if(document.getElementById('user_email').value=='')
	{
		alert('<?php _e('Please enter '.EMAIL_TEXT);?>');
		document.getElementById('user_email').focus();
		return false;
	}else
	{
		if(!checkemail(document.getElementById('user_email').value))
		{
			document.getElementById('user_email').focus();
			return false;
		}
	}
	if(!chk_form_reg())
	{
		return false;
	}
	<?php
		if($General->is_show_term_conditions())
		{
	?>
		if(!accepttermandconditions())
		{
			return false;
		}
		return true;
	<?php
		}
	}else
	?>
	return true;
	<?php
	?>
}
function chk_form_reg()
{
	<?php
	if($mandotary_info['bill_address1'])
	{
	?>
		if(document.getElementById('user_add1').value=='')
		{
			alert('<?php _e('Please enter '.ADDRESS_TEXT) ?>');
			document.getElementById('user_add1').focus();
			return false;
		}
	<?php
	}
	?>

	<?php
	if($mandotary_info['bill_country'])
	{
	?>
		if(document.getElementById('user_country').value=='')
		{
			alert('<?php _e('Please enter '.COUNTRY_TEXT) ?>');
			document.getElementById('user_country').focus();
			return false;
		}
	<?php
	}
	?>
	<?php
	if($mandotary_info['bill_state'])
	{
	?>
		if(document.getElementById('user_state').value=='')
		{
			alert('<?php _e('Please enter '.STATE_TEXT) ?>');
			document.getElementById('user_state').focus();
			return false;
		}
	<?php
	}
	?>
	
	<?php
	if($mandotary_info['bill_city'])
	{
	?>
		if(document.getElementById('user_city').value=='')
		{
			alert('<?php _e('Please enter '.CITY_TEXT) ?>');
			document.getElementById('user_city').focus();
			return false;
		}
	<?php
	}
	?>
	<?php
	if($mandotary_info['bill_zip'])
	{
	?>
		if(document.getElementById('user_postalcode').value=='')
		{
			alert('<?php _e('Please enter '.POSTAL_CODE_TEXT) ?>');
			document.getElementById('user_postalcode').focus();
			return false;
		}
	<?php
	}
	?>
	<?php
	if($mandotary_info['bill_phone'])
	{
	?>
		if(document.getElementById('phone').value=='')
		{
			alert('<?php _e('Please enter '.PHONE_NUMBER_TEXT) ?>');
			document.getElementById('phone').focus();
			return false;
		}
	<?php
	}
	?>
	return true;
}
function checkemail(str)
{
	var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
	if (filter.test(str))
	{
		return true;
	}
	else
	{
		alert("Please enter valid email")
		return false;
	}
}
function get_country_state(country_id,stateid,sname)
{
	document.getElementById('state_ajax_indicator').innerHTML = '<div class="address_row"><?php _e('Processing ...')?></div>';
	<?php
	if(strstr($_SERVER['REQUEST_URI'],'https:'))
	{
		$url = str_replace('http://','https://',site_url());
	}else
	{
		$url = site_url();
	}
	?>
	$.ajax({
		url: '<?php echo $url."/wp-admin/admin.php?page=tax&act=stateajaxfrontend";?>&cid=' + country_id + '&sid=' +stateid+ '&stype=' +sname,
		type: 'GET',
		dataType: 'html',
		timeout: 20000,
		error: function(){
		},
		success: function(html){
			
				document.getElementById('state_ajax_indicator').innerHTML = html;
		}
	});
	return false;
}
function get_country_billstate(country_id,stateid,sname)
{
	document.getElementById('billstate_ajax_indicator').innerHTML = ' <div class="myorder_form_row "><?php _e('Processing ...')?></div>';
	<?php
	if(get_option('is_on_ssl_login'))
	{
		$url = str_replace('http://','https://',site_url());
	}else
	{
		$url = site_url();
	}
	?>
	$.ajax({
		url: '<?php echo $url."/wp-admin/admin.php?page=tax&act=stateajaxfrontend";?>&cid=' + country_id + '&sid=' +stateid+ '&stype=' +sname,
		type: 'GET',
		dataType: 'html',
		timeout: 20000,
		error: function(){
			//alert('Error loading cart information');
		},
		success: function(html){
				document.getElementById('billstate_ajax_indicator').innerHTML = html;
		}
	});
	return false;
}
</script>
<?php
}
?>