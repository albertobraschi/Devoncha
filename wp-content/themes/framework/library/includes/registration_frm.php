<?php
$mandotary_info = $General->get_userinfo_mandatory_fields();
if($mandotary_info['last_name'])
{
	$last_name = ' <span class="indicates">*</span>';
}
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
<?php 
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/registration_frm_page.php'))
{
	include(CHILDTEMPLATEPATH . '/registration_frm_page.php');
}else
{
	include(TEMPLATEPATH . '/library/includes/registration_frm_page.php'); //product detail page
}
?>
<script  type="text/javascript" >
function chk_form_reg()
{
	if(document.getElementById('user_loginreg').value == '')
	{
		alert("<?php _e('Please enter '.USERNAME_TEXT) ?>");
		document.getElementById('user_loginreg').focus();
		return false;
	}
	if(document.getElementById('user_emailreg').value == '')
	{
		alert("<?php _e('Please enter '.EMAIL_TEXT) ?>");
		document.getElementById('user_emailreg').focus();
		return false;
	}
	if(document.getElementById('user_fname').value == '')
	{
		alert("<?php _e('Please enter '.FIRST_NAME_TEXT) ?>");
		document.getElementById('user_fname').focus();
		return false;
	}
	<?php
	if($mandotary_info['last_name'])
	{
	?>
		if(document.getElementById('user_lname').value=='')
		{
			alert('<?php _e('Please enter '.LAST_NAME_TEXT) ?>');
			document.getElementById('user_lname').focus();
			return false;
		}
	<?php
	}
	?>
	<?php
	if($mandotary_info['bill_address1'])
	{
	?>
		if(document.getElementById('user_add1').value=='')
		{
			alert('<?php _e('Please enter '.ADDRESS1_TEXT) ?>');
			document.getElementById('user_add1').focus();
			return false;
		}
	<?php
	}
	?>
	<?php
	if($mandotary_info['bill_address2'])
	{
	?>
		if(document.getElementById('user_add2').value=='')
		{
			alert('<?php _e('Please enter '.ADDRESS2_TEXT) ?>');
			document.getElementById('user_add2').focus();
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
	if($mandotary_info['bill_phone'])
	{
	?>
		if(document.getElementById('phone').value=='')
		{
			alert('<?php _e('Please enter Phone Number') ?>');
			document.getElementById('phone').focus();
			return false;
		}
	<?php
	}
	?>
	document.registerform.submit();
}

function showhide_checkout()
{
	if(document.getElementById('checkout_div_id').style.display=='none')
	{
		document.getElementById('checkout_div_id').style.display = '';
		document.getElementById('reg_form_div_id').style.display = 'none';
		document.getElementById('lostpassword_form').style.display = 'none';
		document.getElementById('login_form_div_id').style.display = 'none';
	}else
	{
		//document.getElementById('reg_form_div_id').style.display = 'none';
	}	
}
function get_country_state(country_id,stateid,sname)
{
	document.getElementById('state_ajax_indicator').innerHTML = '<?php _e('Processing ...')?>';
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
			
				document.getElementById('state_ajax_indicator').innerHTML = html;
		}
	});
	return false;
}
</script>
<?php
if($login_invalid_error)
{
?>
<script language="javascript">showhide_login();</script>
<?php
}
if($forgot_password_error)
{
?>
<script language="javascript">showhide_forgetpw();</script>
<?php
}
if($registration_error_msg)
{
?>
<script language="javascript">showhide_registration();</script>
<?php }?>