<?php
global $wpdb,$state_db_table_name;
if($_POST['addstate'])
{
	$page = $_POST['page'];
	$sid = $_POST['sid'];
	$code = $_POST['code'];
	$title = $_POST['title'];
	$country = $_POST['country'];
	
	if($sid)
	{
		$updatesql = "update $state_db_table_name set state=\"$code\", country=\"$country\",title=\"$title\" where state_id=\"$sid\"";
		$wpdb->query($updatesql);
		$location = site_url("/wp-admin/admin.php?page=state&msg=editsuccess");
	}else
	{
		$insertsql = "insert into $state_db_table_name (state,country,title) values (\"$code\",\"$country\",\"$title\")";
		$wpdb->query($insertsql);
		$location = site_url("/wp-admin/admin.php?page=state&msg=addsuccess");
	}
	wp_redirect($location);
	exit;
}
if($_REQUEST['sid'])
{
	$sid = $_REQUEST['sid'];
	$sql = "select * from $state_db_table_name where state_id=\"$sid\"";	
	$stateinfo = $wpdb->get_results($sql);
	$state = $stateinfo[0];
}
if($_REQUEST['country'])
{
	$state->country	= $_REQUEST['country'];
}
?>
<div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_mange_coupon"><?php if($_REQUEST['sid']!=''){_e('Edit State');}else{_e('Add State');}?></span>  
    
    
 </div> <!-- sub heading -->
 <div id="page" >

<form action="<?php echo site_url('/wp-admin/admin.php?page=state&act=addstate')?>" method="post" name="state_frm">
  <input type="hidden" name="addstate" value="1">
  <input type="hidden" name="page" value="state">
  <input type="hidden" name="act" value="addstate">
  <input type="hidden" name="sid" value="<?php echo $_REQUEST['sid'];?>">
 
  <?php if($_REQUEST['msg']=='exist'){?>
  <div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
    <p><?php _e('Coupon code already exists, Please user different one.');?></p>
  </div>
  <?php }?>
  <table width="75%" cellpadding="3" cellspacing="3" class="widefat post sub_table" >
    <tr>
      <td width="14%"><?php _e('State&nbsp;Code');?></td>
      <td width="86%">:
        <input type="text" name="code" id="code" value="<?php echo $state->state;?>"></td>
    </tr>
    <tr>
      <td><?php _e('Title');?></td>
      <td>:
       <input type="text" name="title" id="title" value="<?php echo $state->title;?>">
      </td>
    </tr>
     <tr>
      <td><?php _e('Country');?></td>
      <td>:
       <select name="country"  id="country">
       <option value=""><?php _e('Select Country');?></option>
	   <?php echo country_dl($state->country);?>
       </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="<?php _e('Submit');?>" onclick="return check_frm();" class="b_common action" >
        &nbsp;
        <input type="button" name="cancel" value="<?php _e('Cancel');?>" onClick="window.location.href='<?php echo site_url('/wp-admin/admin.php?page=state')?><?php if($_REQUEST['country']){ echo '&country='.$_REQUEST['country'];}?>'" class="b_normal action" ></td>
    </tr>
  </table>
</form>
<script>
function check_frm()
{
	if(document.getElementById('code').value=='')
	{
		alert('<?php _e('Please enter State Code');?>');
		document.getElementById('code').focus();
		return false;
	}
	if(document.getElementById('title').value=='')
	{
		alert('<?php _e('Please enter Title');?>');
		document.getElementById('title').focus();
		return false;
	}
	if(document.getElementById('country').value=='')
	{
		alert('<?php _e('Please select Country');?>');
		document.getElementById('country').focus();
		return false;
	}
	return true;
}
</script>

</div> <!-- page #end -->
 </div>   <!-- wrapper #end -->
