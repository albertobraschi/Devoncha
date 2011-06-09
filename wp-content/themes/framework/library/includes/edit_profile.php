<?php
global $General,$wpdb;
$userInfo = $General->getLoginUserInfo();
if($_POST)
{
	if($_REQUEST['chagepw'])
	{
		$new_passwd = $_POST['new_passwd'];
		if($new_passwd)
		{
			$user_id = $current_user->data->ID;
			wp_set_password($new_passwd, $user_id);
			$message1 = CHANGE_PASSWORD_SUCCESS_MSG;
		}		
	}else
	{
		$user_id = $userInfo['ID'];
		
		$phone = $_POST['phone'];
		
		$user_add1 = stripslashes(str_replace("'","&acute;",$_POST['user_add1']));
		$user_add2 = stripslashes(str_replace("'","&acute;",$_POST['user_add2']));
		$user_city = stripslashes(str_replace("'","&acute;",$_POST['user_city']));
		$user_state = stripslashes(str_replace("'","&acute;",$_POST['user_state']));
		$user_country = stripslashes(str_replace("'","&acute;",$_POST['user_country']));
		$user_postalcode = stripslashes(str_replace("'","&acute;",$_POST['user_postalcode']));
		
	
		
		$buser_add1 = stripslashes(str_replace("'","&acute;",$_POST['buser_add1']));
		$buser_add2 = stripslashes(str_replace("'","&acute;",$_POST['buser_add2']));
		$buser_city = stripslashes(str_replace("'","&acute;",$_POST['buser_city']));
		$buser_state = stripslashes(str_replace("'","&acute;",$_POST['buser_state']));
		$buser_country = stripslashes(str_replace("'","&acute;",$_POST['buser_country']));
		$buser_postalcode = stripslashes(str_replace("'","&acute;",$_POST['buser_postalcode']));
		
		$user_address_info = array(
							"user_add1"		=> $user_add1,
							"user_add2"		=> $user_add2,
							"user_city"		=> $user_city,
							"user_state"	=> $user_state,
							"user_country"	=> $user_country,
							"phone"			=> $phone,
							"user_postalcode"=> $user_postalcode,
							"buser_name" 	=> $_POST['buser_fname'].'  '.$_POST['buser_lname'],
							"buser_add1"	=> $buser_add1,
							"buser_add2"	=> $buser_add2,
							"buser_city"	=> $buser_city,
							"buser_state"	=> $buser_state,
							"buser_country"	=> $buser_country,
							"buser_postalcode"=> $buser_postalcode,
							);
		
		if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/edit_profile_save_meta_fields.php'))
		{
			include_once(CHILDTEMPLATEPATH . '/edit_profile_save_meta_fields.php');
		}

foreach($_POST as $key=>$val)
		{
			if(strstr($key,'_custom'))
			{
				$user_address_info[$key] = 	$val;	
			}
		}
		if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/edit_profile_before_user_update.php'))
		{
			include_once(CHILDTEMPLATEPATH . '/edit_profile_before_user_update.php');
		}
		update_usermeta($user_id, 'user_address_info', $user_address_info); // User Address Information Here
		update_usermeta($user_id, 'first_name', $_POST['user_fname']); // User Address Information Here
		update_usermeta($user_id, 'last_name', $_POST['user_lname']); // User Address Information Here
		$userName = $_POST['user_fname'].'  '.$_POST['user_lname'];
		$updateUsersql = "update $wpdb->users set user_nicename=\"$userName\", display_name=\"$userName\"  where ID=\"$user_id\"";
		$wpdb->query($updateUsersql);
		if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/edit_profile_after_user_update.php'))
		{
			include_once(CHILDTEMPLATEPATH . '/edit_profile_after_user_update.php');
		}
		wp_redirect(site_url('/?ptype=myaccount&type=editprofile&msg=success'));
	}
}

$userInfo = $General->getLoginUserInfo();
global $current_user;
$user_address_info = $current_user->data->user_address_info;
$user_add1 = $user_address_info['user_add1'];
$user_add2 = $user_address_info['user_add2'];
$user_city = $user_address_info['user_city'];
$user_state = $user_address_info['user_state'];
$user_country = $user_address_info['user_country'];
$phone = $user_address_info['phone'];
$user_postalcode = $user_address_info['user_postalcode'];
$display_name = $userInfo['display_name'];
$display_name_arr = explode(' ',$display_name);
$user_fname = $display_name_arr[0];
$user_lname = $display_name_arr[2];
$buser_add1 = $user_address_info['buser_add1'];
$buser_add2 = $user_address_info['buser_add2'];
$buser_city = $user_address_info['buser_city'];
$buser_state = $user_address_info['buser_state'];
$buser_country = $user_address_info['buser_country'];
$buser_postalcode = $user_address_info['buser_postalcode'];
$bdisplay_name = $user_address_info['buser_name'];
$display_name_arr = explode(' ',$bdisplay_name);
$buser_fname = $display_name_arr[0];
$buser_lname = $display_name_arr[2];

if($_SESSION['redirect_page'] == '')
{
	$_SESSION['redirect_page'] = $_SERVER['HTTP_REFERER'];
}
if(strstr($_SESSION['redirect_page'],'ptype=checkout'))
{
	global $General;
	$login_redirect_link = $General->get_ssl_normal_url(site_url('/?ptype=checkout'));
}
?>
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

if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/edit_profile_before_title.php'))
{
	include_once(CHILDTEMPLATEPATH . '/edit_profile_before_title.php');
}
?>

<h3><?php _e(CHANGE_PASSWORD_TEXT); ?></h3>
<form name="registerform" id="registerform" action="<?php echo site_url('/?ptype=myaccount&type=editprofile&chagepw=1'); ?>" method="post">
<?php if($message1) { ?>
  <div class="sucess_msg"> <?php _e(CHANGE_PASSWORD_SUCCESS_MSG); ?> </div>
  </td>
  <?php } ?>
<div class="myorders ">
     <div class="myorders_col myorders_col_2 fl">
        <div class="myorder_form_row ">
        <label>
        <?php _e(NEW_PASSWORD_TEXT); ?> <span class="indicates">*</span>
         </label> 
         <input type="password" name="new_passwd" id="new_passwd"  class="myorder_text" />       
        </div>
        <div class="myorder_form_row ">
        <label>
        <?php _e(CONFIRM_NEW_PASSWORD_TEXT); ?> <span class="indicates">*</span> </label>
        <input type="password" name="cnew_passwd" id="cnew_passwd"  class="myorder_text" />
         </div>
        <input type="submit" name="Update2" value="<?php _e(UPDATE_BUTTON_TEXT) ?>" class="highlight_input_btn" onclick="return chk_form_pw();" />
       
        
       
    </div>
</div>
</form>
<script type="text/javascript">
function chk_form_pw()
{
	if(document.getElementById('new_passwd').value == '')
	{
		alert("<?php _e('Please enter '.NEW_PASSWORD_TEXT) ?>");
		document.getElementById('new_passwd').focus();
		return false;
	}
	if(document.getElementById('new_passwd').value.length < 4 )
	{
		alert("<?php _e('Please enter '.NEW_PASSWORD_TEXT.' minimum 5 chars') ?>");
		document.getElementById('new_passwd').focus();
		return false;
	}
	if(document.getElementById('cnew_passwd').value == '')
	{
		alert("<?php _e('Please enter '.CONFIRM_NEW_PASSWORD_TEXT) ?>");
		document.getElementById('cnew_passwd').focus();
		return false;
	}
	if(document.getElementById('cnew_passwd').value.length < 4 )
	{
		alert("<?php _e('Please enter '.CONFIRM_NEW_PASSWORD_TEXT.' minimum 5 chars') ?>");
		document.getElementById('cnew_passwd').focus();
		return false;
	}
	if(document.getElementById('new_passwd').value != document.getElementById('cnew_passwd').value)
	{
		alert("<?php _e(NEW_PASSWORD_TEXT.' and '.CONFIRM_NEW_PASSWORD_TEXT.' should be same') ?>");
		document.getElementById('cnew_passwd').focus();
		return false;
	}
}
</script>  

<h3><?php _e(PERSONAL_INFO_TEXT);?> </h3>
  <?php
  if($login_redirect_link)
  {
  ?>
<?php /*?>  <div class="fr"><input type="button" name="<?php _e('Checkout');?>" value="<?php _e('Checkout');?>" onclick="window.location.href='<?php echo $login_redirect_link;?>'"  class="highlight_input_btn fl" /></div><?php */?>
  <div class="clearfix"></div>
  <?php }?>

<form name="registerform" id="registerform" action="<?php echo site_url('/?ptype=myaccount&type=editprofile'); ?>" method="post">
  <?php 
  if($_REQUEST['msg']=='success')
  {
  	$message = "Informações Atualizadas com Sucesso.";
  }
  if($message) { ?>
  <div class="sucess_msg"> <?php _e(MYACC_INFO_UPDATE_MSG);?> </div>
  </td>
  <?php } ?>
  <div class="myorders ">
    <div class="myorders_col fl">
      <h5><?php _e(USER_INFO_TEXT);?> </h5>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/edit_profile_before_edit_form_fields.php'))
{
	include_once(CHILDTEMPLATEPATH . '/edit_profile_before_edit_form_fields.php');
}
?>
      <div class="myorder_form_row ">
        <label> 
        <?php _e(FIRST_NAME_TEXT) ?> <span class="indicates">*</span>
        </label>
        <input type="text" name="user_fname" id="user_fname" class="myorder_text" value="<?php echo esc_attr(stripslashes($user_fname)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e(LAST_NAME_TEXT) ?><?php echo $last_name;?>
        </label>
        <input type="text" name="user_lname" id="user_lname" class="myorder_text" value="<?php echo esc_attr(stripslashes($user_lname)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e(ADDRESS1_TEXT) ?> <?php echo $bill_address1;?>
        </label>
        <input type="text" name="user_add1" id="user_add1" class="myorder_text" value="<?php echo esc_attr(stripslashes($user_add1)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e(ADDRESS2_TEXT) ?> <?php echo $bill_address2;?>
        </label>
        <input type="text" name="user_add2" id="user_add2" class="myorder_text" value="<?php echo esc_attr(stripslashes($user_add2)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e(COUNTRY_TEXT) ?> <?php echo $bill_country;?>
        </label>
        <select name="user_country"  id="user_country" onChange="get_country_state(this.value,'','user_state');" class="myorder_text">
       <option value=""><?php _e('Todos os Países');?></option>
	   <?php echo frontend_country_dl( esc_attr(stripslashes($user_country)));?>
       </select>
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e(STATE_TEXT) ?> <?php echo $bill_state;?>
        </label>
        <span id="state_ajax_indicator">
        <select name="user_state"  id="user_state" class="myorder_text">
       <option value=""><?php _e('Selecionar País Antes');?></option>
       </select>
       </span>
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e(CITY_TEXT) ?> <?php echo $bill_city;?>
        </label>
        <input type="text" name="user_city" id="user_city" class="myorder_text" value="<?php echo esc_attr(stripslashes($user_city)); ?>" size="25" tabindex="20" />
      </div>
      
      <div class="myorder_form_row ">
        <label>
        <?php _e(POSTAL_CODE_TEXT) ?> <?php echo $bill_zip;?>
        </label>
        <input type="text" name="user_postalcode" id="user_postalcode" class="myorder_text" value="<?php echo esc_attr(stripslashes($user_postalcode)); ?>" size="25" tabindex="20" />
      </div>
       <div class="myorder_form_row ">
        <label>
        <?php _e('Telefone') ?> <?php echo $bill_phone;?>
        </label>
        <input type="text" name="phone" id="phone" class="myorder_text" value="<?php echo esc_attr(stripslashes($phone)); ?>" size="25" tabindex="20" />
      </div>
        <?php
	if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/edit_profile_after_billing_fields.php'))
	{
		include_once(CHILDTEMPLATEPATH . '/edit_profile_after_billing_fields.php');
	}
	?>
    </div>
    <!-- my order col_1 End -->
     <?php
    if(!$General->is_storetype_digital())
	{
	?>
    <div class="myorders_col fr">
      <h5><?php _e(SHIPPING_INFO_TEXT);?></h5>
      <div class="myorder_form_row ">
      <p><input type="checkbox" class="checkin" name="copybilladd" id="copybilladd" onClick="copy_billing_address();" > <?php _e('utilizar as');?> <?php _e(USER_INFO_TEXT);?></p>
        <label>
        <?php _e(FIRST_NAME_TEXT) ?>
        </label>
        <input type="text" name="buser_fname" id="buser_fname" class="myorder_text" value="<?php echo esc_attr(stripslashes($buser_fname)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e(LAST_NAME_TEXT) ?>
        </label>
        <input type="text" name="buser_lname" id="buser_lname" class="myorder_text" value="<?php echo esc_attr(stripslashes($buser_lname)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e(ADDRESS1_TEXT) ?>
        </label>
        <input type="text" name="buser_add1" id="buser_add1" class="myorder_text" value="<?php echo esc_attr(stripslashes($buser_add1)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
         <?php _e(ADDRESS2_TEXT) ?>
        </label>
        <input type="text" name="buser_add2" id="buser_add2" class="myorder_text" value="<?php echo esc_attr(stripslashes($buser_add2)); ?>" size="25" tabindex="20" />
      </div>
        <div class="myorder_form_row ">
        <label>
        <?php _e(COUNTRY_TEXT) ?>
        </label>
        <select name="buser_country"  id="buser_country" onChange="get_country_billstate(this.value,'','buser_state');" class="myorder_text">
       <option value=""><?php _e('Todos os Países');?></option>
	   <?php echo frontend_country_dl( esc_attr(stripslashes($buser_country)));?>
       </select>
      </div>
       <div class="myorder_form_row ">
        <label>
        <?php _e(STATE_TEXT) ?>
        </label>
        <span id="billstate_ajax_indicator">
         <select name="buser_state"  id="buser_state" class="myorder_text">
       <option value=""><?php _e('Selecionar País Antes');?></option>
       </select>
       </span>
      </div>
      <div class="myorder_form_row ">
        <label>
         <?php _e(CITY_TEXT) ?>
        </label>
        <input type="text" name="buser_city" id="buser_city" class="myorder_text" value="<?php echo esc_attr(stripslashes($buser_city)); ?>" size="25" tabindex="20" />
      </div>
      <div class="myorder_form_row ">
        <label>
        <?php _e(POSTAL_CODE_TEXT) ?>
        </label>
        <input type="text" name="buser_postalcode" id="buser_postalcode" class="myorder_text" value="<?php echo esc_attr(stripslashes($buser_postalcode)); ?>" size="25" tabindex="20" />
      </div>
       <?php
	if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/edit_profile_after_shipping_fields.php'))
	{
		include_once(CHILDTEMPLATEPATH . '/edit_profile_after_shipping_fields.php');
	}
	?>
    </div>
    <?php }?>
    <!-- my order col_1 End -->
  </div>
  <?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/edit_profile_after_edit_form_fields.php'))
{
	include_once(CHILDTEMPLATEPATH . '/edit_profile_after_edit_form_fields.php');
}
?>
  <?php
  if($login_redirect_link)
  {
  ?>
  <input type="button" name="<?php _e('Checkout');?>" value="<?php _e(CHECKOUT_TEXT);?>" onclick="window.location.href='<?php echo $login_redirect_link;?>'"  class="highlight_input_btn fl" />
  <?php }?>
  <input type="submit" name="Update" value="<?php _e(UPDATE_BUTTON_TEXT);?>" class="highlight_input_btn fr" onclick="return chk_form_profile();" />
</form>
<script  type="text/javascript" >
function chk_form_profile()
{
	if(document.getElementById('user_fname').value == '')
	{
		alert("Please enter <?php _e(FIRST_NAME_TEXT) ?>");
		document.getElementById('user_fname').focus();
		return false;
	}
	<?php
	if($mandotary_info['last_name'])
	{
	?>
		if(document.getElementById('user_lname').value=='')
		{
			alert('<?php _e('Please enter Last Name') ?>');
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
			alert('Please enter <?php _e(ADDRESS1_TEXT) ?>');
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
			alert('Please enter <?php _e(ADDRESS2_TEXT) ?>');
			document.getElementById('user_add2').focus();
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
			alert('Please enter <?php _e(COUNTRY_TEXT) ?>');
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
			alert('Please enter <?php _e(STATE_TEXT) ?>');
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
			alert('Please enter <?php _e(CITY_TEXT) ?>');
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
			alert('Please enter <?php _e(POSTAL_CODE_TEXT) ?>');
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
			alert('Please enter Phone Number');
			document.getElementById('phone').focus();
			return false;
		}
	<?php
	}
	?>
	document.registerform.submit();
}
function copy_billing_address()
{
	if(document.getElementById('copybilladd').checked)
	{
		
		document.getElementById('buser_fname').value = document.getElementById('user_fname').value;
		document.getElementById('buser_lname').value = document.getElementById('user_lname').value;
		document.getElementById('buser_add1').value = document.getElementById('user_add1').value;
		document.getElementById('buser_add2').value = document.getElementById('user_add2').value;
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
		document.getElementById('buser_fname').value = '';
		document.getElementById('buser_lname').value = '';
		document.getElementById('buser_add1').value = '';
		document.getElementById('buser_add2').value = '';
		document.getElementById('buser_city').value = '';
		document.getElementById('buser_state').value = '';
		document.getElementById('buser_country').value = '';
		document.getElementById('buser_postalcode').value = '';
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
			//alert('Error loading cart information');
		},
		success: function(html){
			
				document.getElementById('state_ajax_indicator').innerHTML = html;
		}
	});
	return false;
}
<?php
if($current_user->data->user_address_info)
{
?>
	if(document.getElementById('user_country').value!='')
	{
		var country_id = document.getElementById('user_country').value;
		get_country_state(country_id,'<?php echo esc_attr(stripslashes($user_state)); ?>','user_state');
	}
<?php
}
?>
function get_country_billstate(country_id,stateid,sname)
{
	document.getElementById('billstate_ajax_indicator').innerHTML = ' <div class="myorder_form_row "><?php _e('Processando ...')?></div>';
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

<?php
if($current_user->data->user_address_info)
{
?>
	if(document.getElementById('buser_country').value!='')
	{
		var country_id = document.getElementById('buser_country').value;
		get_country_billstate(country_id,'<?php echo esc_attr(stripslashes($buser_state)); ?>','buser_state');
	}
<?php
}
?>
</script>