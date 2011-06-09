<?php
global $wpdb;
if($_POST['frm_action'] == 'addeditlinks')
{
	$link_title = $_POST['link_title'];
	$link_url = $_POST['link_url'];
	$link_status = $_POST['link_status'];
	if($link_title)
	{
		$affiliate_links = get_option('affiliate_links');

		if($_POST['lid']!='')
		{
			$affiliate_links[$_POST['lid']]['link_title'] = $link_title;
			$affiliate_links[$_POST['lid']]['link_url'] = $link_url;
			$affiliate_links[$_POST['lid']]['link_status'] = $link_status;
			if(!isset($affiliate_links[$_POST['lid']]['link_key']) || $affiliate_links[$_POST['lid']]['link_key'] == '')
			{
				$affiliate_links[$_POST['lid']]['link_key'] = time();
			}
		}else
		{
			$affiliate_links1 = array(
							"link_title"	=>	$link_title,
							"link_url"		=>	$link_url,
							"link_status"	=>	$link_status,
							"link_key"		=>	time(),
							);
			$affiliate_links[] = $affiliate_links1;
		}
		update_option('affiliate_links', $affiliate_links);
		$location = site_url()."/wp-admin/admin.php?page=affiliates_settings&msg=success";
		wp_redirect($location);
		exit;
	}
}
if($_REQUEST['lid']!='')
{
	$affiliate_links = get_option('affiliate_links');
	$link_title = $affiliate_links[$_REQUEST['lid']]['link_title'];
	$link_url = $affiliate_links[$_REQUEST['lid']]['link_url'];
	$link_status = $affiliate_links[$_REQUEST['lid']]['link_status'];
}
?>

<form action="<?php echo site_url()?>/wp-admin/admin.php?page=affiliates_settings&pagetype=addedit&lid=<?php echo $_REQUEST['lid'];?>" method="post" name="coupon_frm">
  <input type="hidden" name="frm_action" value="addeditlinks">
  <input type="hidden" name="lid" value="<?php echo $_REQUEST['lid'];?>">
  <h2>
    <?php
if($_REQUEST['lid']!='')
{
	
	 _e('Edit Affiliate Link');
}else
{
	 _e('Add Affiliate Link');
}
?>
  </h2>
  <?php /*?><?php if($_REQUEST['msg']=='exist'){?>
  <div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
    <p><?php  _e('Coupon code already exists, Please user different one.');?></p>
  </div>
  <?php }?><?php */?>
  <table width="75%" cellpadding="3" cellspacing="3" class="widefat post fixed" >
    <tr>
      <td width="14%"><?php _e('Link Title');?></td>
      <td width="86%">:
        <input type="text" name="link_title" value="<?php echo $link_title;?>"></td>
    </tr>
    <tr>
      <td width="14%"><?php _e('Link URL');?></td>
      <td width="86%">:
        <input type="text" name="link_url" value="<?php echo $link_url;?>"></td>
    </tr>
    <tr>
      <td width="14%"><?php _e('Link Status');?></td>
      <td width="86%">:
        <select name="link_status">
        <option value="1" <?php if($link_status=='1'){?> selected="selected"<?php }?>><?php _e('Show');?></option>
        <option value="0" <?php if($link_status=='0'){?> selected="selected"<?php }?>><?php _e('Hide');?></option>
        </select>
        
        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="<?php _e('Submit');?>" onclick="return check_frm();" class="button-secondary action" >
        &nbsp;
        <input type="button" name="cancel" value="<?php _e('Cancel');?>" onClick="window.location.href='<?php echo site_url()?>/wp-admin/admin.php?page=affiliates_settings'" class="button-secondary action" ></td>
    </tr>
  </table>
</form>
<script>
function check_frm()
{
	if(document.getElementById('coupondiscper').checked)
	{
		if(document.getElementById('couponamt').value > 100)
		{
			alert("<?php _e('Percentage should be less than or equal to 100');?>");
			return false;
		}
	}
	return true;
}
</script>
