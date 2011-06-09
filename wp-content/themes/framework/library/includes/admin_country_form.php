<?php
global $wpdb,$country_db_table_name;
if($_POST['addcountry'])
{
	$page = $_POST['page'];
	$cid = $_POST['cid'];
	$code = $_POST['code'];
	$title = $_POST['title'];
	if($cid)
	{
		$updatesql = "update $country_db_table_name set country=\"$code\", title=\"$title\" where country_id=\"$cid\"";
		$wpdb->query($updatesql);
		$location = site_url("/wp-admin/admin.php?page=country&msg=editsuccess");
	}else
	{
		$insertsql = "insert into $country_db_table_name (country,title) values (\"$code\",\"$title\")";
		$wpdb->query($insertsql);
		$location = site_url("/wp-admin/admin.php?page=country&msg=addsuccess");
	}
	wp_redirect($location);
	exit;
}
if($_REQUEST['cid'])
{
	$cid = $_REQUEST['cid'];
	$sql = "select * from $country_db_table_name where country_id=\"$cid\"";	
	$stateinfo = $wpdb->get_results($sql);
	$country = $stateinfo[0];
}
?>
<div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_mange_coupon"><?php if($_REQUEST['cid']!=''){_e('Edit Country');}else{_e('Add Country');}?></span>  
    
    
 </div> <!-- sub heading -->
 <div id="page" >

<form action="<?php echo site_url('/wp-admin/admin.php?page=country&act=addcountry')?>" method="post" name="state_frm">
  <input type="hidden" name="addcountry" value="1">
  <input type="hidden" name="page" value="country">
  <input type="hidden" name="act" value="addcountry">
  <input type="hidden" name="cid" value="<?php echo $_REQUEST['cid'];?>">
 
  <table width="75%" cellpadding="3" cellspacing="3" class="widefat post sub_table" >
    <tr>
      <td width="14%"><?php _e('Country&nbsp;Code');?></td>
      <td width="86%">:
        <input type="text" name="code" id="code" value="<?php echo $country->country;?>"></td>
    </tr>
    <tr>
      <td><?php _e('Title');?></td>
      <td>:
       <input type="text" name="title" id="title" value="<?php echo $country->title;?>">
      </td>
    </tr>
     
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="<?php _e('Submit');?>" onclick="return check_frm();" class="b_common action" >
        &nbsp;
        <input type="button" name="cancel" value="<?php _e('Cancel');?>" onClick="window.location.href='<?php echo site_url('/wp-admin/admin.php?page=country')?>'" class="b_normal action" ></td>
    </tr>
  </table>
</form>
<script>
function check_frm()
{
	if(document.getElementById('code').value=='')
	{
		alert('<?php _e('Please enter Country Code');?>');
		document.getElementById('code').focus();
		return false;
	}
	if(document.getElementById('title').value=='')
	{
		alert('<?php _e('Please enter Title');?>');
		document.getElementById('title').focus();
		return false;
	}
	return true;
}
</script>

</div> <!-- page #end -->
 </div>   <!-- wrapper #end -->