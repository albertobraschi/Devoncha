<?php
global $wpdb;
$uid = $_REQUEST['uid'];
if($_REQUEST['act']=='updateuser')
{
		$user_id = $_REQUEST['uid'];
		$user_add1 = $_POST['user_add1'];
		$user_add2 = $_POST['user_add2'];
		$user_city = $_POST['user_city'];
		$user_state = $_POST['user_state'];
		$user_country = $_POST['user_country'];
		$user_postalcode = $_POST['user_postalcode'];		
		$buser_add1 = $_POST['buser_add1'];
		$buser_add2 = $_POST['buser_add2'];
		$buser_city = $_POST['buser_city'];
		$buser_state = $_POST['buser_state'];
		$buser_country = $_POST['buser_country'];
		$buser_postalcode = $_POST['buser_postalcode'];
		$user_address_info = array(
							"user_add1"		=> $user_add1,
							"user_add2"		=> $user_add2,
							"user_city"		=> $user_city,
							"user_state"	=> $user_state,
							"user_country"	=> $user_country,
							"user_postalcode"=> $user_postalcode,
							"buser_name" 	=> $_POST['buser_fname'],
							"phone" 	=> $_POST['phone'],
							"buser_add1"	=> $buser_add1,
							"buser_add2"	=> $buser_add2,
							"buser_city"	=> $buser_city,
							"buser_state"	=> $buser_state,
							"buser_country"	=> $buser_country,
							"buser_postalcode"=> $buser_postalcode,
							);
		
		foreach($_POST as $key=>$val)
		{
			if(strstr($key,'_custom'))
			{
				$user_address_info[$key] = 	$val;	
			}
		}		
		update_usermeta($user_id, 'user_address_info', $user_address_info); // User Address Information Here
		$userName = $_POST['user_fname'];
		$updateUsersql = "update $wpdb->users set user_nicename=\"$userName\", display_name=\"$userName\"  where ID=\"$user_id\"";
		$wpdb->query($updateUsersql);
}

$user = $wpdb->get_results("select * from $wpdb->users where ID=\"$uid\"");
$user_address_info = get_user_meta($uid,'user_address_info');
$user_fname = $user[0]->display_name;
$user_add1 = $user_address_info[0]['user_add1'];
$user_add2 = $user_address_info[0]['user_add2'];
$user_city = $user_address_info[0]['user_city'];
$user_state = $user_address_info[0]['user_state'];
$user_country = $user_address_info[0]['user_country'];
$user_postalcode = $user_address_info[0]['user_postalcode'];
$phone = $user_address_info[0]['phone'];
$buser_fname = $user_address_info[0]['buser_name'];
$buser_add1 = $user_address_info[0]['buser_add1'];
$buser_add2 = $user_address_info[0]['buser_add2'];
$buser_city = $user_address_info[0]['buser_city'];
$buser_state = $user_address_info[0]['buser_state'];
$buser_country = $user_address_info[0]['buser_country'];
$buser_postalcode = $user_address_info[0]['buser_postalcode'];
?>
<div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_mange_coupon"><?php _e('Edit User');?></span>  
    
    
 </div> <!-- sub heading -->
 <div id="page" >

<form action="<?php echo site_url('/wp-admin/admin.php?page=manageusers&act=updateuser')?>" method="post" name="users_frm">
  <input type="hidden" name="page" value="manageusers">
  <input type="hidden" name="act" value="updateuser">
  <input type="hidden" name="uid" value="<?php echo $_REQUEST['uid'];?>">
 
 <table width="100%" cellpadding="3" cellspacing="3"  >
  <tr>
  <td><table width="100%" cellpadding="3" cellspacing="3" class="widefat post sub_table" >
  <th colspan="2"><?php _e('User Information ');?></th>
    <tr>
      <td width="25%"><?php _e('Full Name');?> *</td>
      <td width="75%">:
        <input type="text" name="user_fname" id="user_fname" value="<?php echo $user_fname;?>"></td>
    </tr>
     <tr>
      <td><?php _e('Address1');?></td>
      <td>:
       <input type="text" name="user_add1" id="user_add1" value="<?php echo $user_add1;?>">
      </td>
    </tr>
     <tr>
      <td><?php _e('Address2');?></td>
      <td>:
       <input type="text" name="user_add2" id="user_add2" value="<?php echo $user_add2;?>">
      </td>
    </tr>
     <tr>
      <td><?php _e('City');?></td>
      <td>:
       <input type="text" name="user_city" id="user_city" value="<?php echo $user_city;?>">
      </td>
    </tr>
     <tr>
      <td><?php _e('State');?></td>
      <td>:
       <input type="text" name="user_state" id="user_state" value="<?php echo $user_state;?>">
      </td>
    </tr>
     <tr>
      <td><?php _e('Country');?></td>
      <td>:
       <input type="text" name="user_country" id="user_country" value="<?php echo $user_country;?>">
      </td>
    </tr>
     <tr>
      <td><?php _e('Postal Code');?></td>
      <td>:
       <input type="text" name="user_postalcode" id="user_postalcode" value="<?php echo $user_postalcode;?>">
      </td>
    </tr>
     <tr>
      <td><?php _e('Phone');?></td>
      <td>:
       <input type="text" name="phone" id="phone" value="<?php echo $phone;?>">
      </td>
    </tr>
  </table></td>
  <td valign="top"><table width="100%" cellpadding="3" cellspacing="3" class="widefat post sub_table" >
  <th colspan="2"><?php _e('Shipping Information ');?></th>
    <tr>
      <td width="25%"><?php _e('Full Name');?></td>
      <td width="75%">:
        <input type="text" name="buser_fname" id="buser_fname" value="<?php echo $buser_fname;?>"></td>
    </tr>
     <tr>
      <td><?php _e('Address1');?></td>
      <td>:
       <input type="text" name="buser_add1" id="buser_add1" value="<?php echo $buser_add1;?>">
      </td>
    </tr>
     <tr>
      <td><?php _e('Address2');?></td>
      <td>:
       <input type="text" name="buser_add2" id="buser_add2" value="<?php echo $buser_add2;?>">
      </td>
    </tr>
     <tr>
      <td><?php _e('City');?></td>
      <td>:
       <input type="text" name="buser_city" id="buser_city" value="<?php echo $buser_city;?>">
      </td>
    </tr>
     <tr>
      <td><?php _e('State');?></td>
      <td>:
       <input type="text" name="buser_state" id="buser_state" value="<?php echo $buser_state;?>">
      </td>
    </tr>
     <tr>
      <td><?php _e('Country');?></td>
      <td>:
       <input type="text" name="buser_country" id="buser_country" value="<?php echo $buser_country;?>">
      </td>
    </tr>
     <tr>
      <td><?php _e('Postal Code');?></td>
      <td>:
       <input type="text" name="buser_postalcode" id="buser_postalcode" value="<?php echo $buser_postalcode;?>">
      </td>
    </tr>
  </table></td>
  </tr>
   <tr>
      <td colspan="2"><input type="submit" name="submit" value="<?php _e('Submit');?>" onclick="return check_frm();" class="b_common action" >
        &nbsp;
        <input type="button" name="cancel" value="<?php _e('Cancel');?>" onClick="window.location.href='<?php echo site_url('/wp-admin/admin.php?page=manageusers')?>'" class="b_normal action" ></td>
    </tr>
  </table> 
</form>
<script>
function check_frm()
{
	if(document.getElementById('user_fname').value=='')
	{
		alert('<?php _e('Please enter Full Name');?>');
		document.getElementById('user_fname').focus();
		return false;
	}
	return true;
}
</script>
</div> <!-- page #end -->
 </div>   <!-- wrapper #end -->