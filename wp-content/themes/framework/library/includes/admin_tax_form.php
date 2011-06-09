<?php
global $wpdb,$tax_db_table_name;

if($_POST['addtax'])
{
	$page = $_POST['page'];
	$tid = $_POST['tid'];
	$title = $_POST['title'];
	$description = addslashes($_POST['description']);
	$country = $_POST['country'];
	$state = $_POST['state'];
	$status = $_POST['status'];
	$amount = $_POST['amount'];
	$amount_type = $_POST['amount_type'];
	
	if($tid)
	{
		$updatesql = "update $tax_db_table_name set tax_title=\"$title\", tax_desc=\"$description\", tax_state=\"$state\",tax_country=\"$country\",tax_status=\"$status\",tax_amount=\"$amount\",amount_type=\"$amount_type\"  where tax_id=\"$tid\"";
		$wpdb->query($updatesql);
		$location = site_url("/wp-admin/admin.php?page=tax&msg=editsuccess");
	}else
	{
		$insertsql = "insert into $tax_db_table_name (tax_title,tax_desc,tax_state,tax_country,tax_status,tax_amount,amount_type) values (\"$title\",\"$description\",\"$state\",\"$country\",\"$status\",\"$amount\",\"$amount_type\")";
		$wpdb->query($insertsql);
		$location = site_url("/wp-admin/admin.php?page=tax&msg=addsuccess");
	}	
	wp_redirect($location);
	exit;
}
if($_REQUEST['tid'])
{
	$tid = $_REQUEST['tid'];
	$sql = "select * from $tax_db_table_name where tax_id=\"$tid\"";	
	$stateinfo = $wpdb->get_results($sql);
	$tax = $stateinfo[0];
}
if($_REQUEST['country'])
{
	$state->country	= $_REQUEST['country'];
}
?>
<div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_mange_coupon"><?php if($_REQUEST['tid']!=''){_e('Edit Tax');}else{_e('Add Tax');}?></span>  
    
    
 </div> <!-- sub heading -->
 <div id="page" >

<form action="<?php echo site_url('/wp-admin/admin.php?page=tax&act=addtax')?>" method="post" name="state_frm">
  <input type="hidden" name="addtax" value="1">
  <input type="hidden" name="page" value="tax">
  <input type="hidden" name="act" value="addtax">
  <input type="hidden" name="tid" value="<?php echo $_REQUEST['tid'];?>">
 
  <table width="75%" cellpadding="3" cellspacing="3" class="widefat post sub_table" >
     <tr>
      <td><?php _e('Tax&nbsp;Title');?></td>
      <td>:
       <input type="text" name="title" id="title" value="<?php echo $tax->tax_title;?>">
      </td>
    </tr>
        <tr>
      <td><?php _e('Tax&nbsp;Description');?></td>
      <td>:
       <textarea name="description" id="description"><?php echo $tax->tax_desc;?></textarea>
      </td>
    </tr>
     <tr>
      <td><?php _e('Country');?></td>
      <td>:
       <select name="country"  id="country" onChange="get_country_state(this.value,'');">
       <option value=""><?php _e('All Countries');?></option>
	   <?php echo country_dl($tax->tax_country);?>
       </select>
       <br>&nbsp;&nbsp;&nbsp;<small><?php _e('Skip to apply in all countries.');?></small>
      </td>
    </tr>
     <tr>
      <td><?php _e('State');?></td>
      <td>:
       <select name="state"  id="country_state_id">
       <option value=""><?php _e('Select Country First');?></option>
	   <?php //echo country_dl($tax->tax_state);?>
       </select>&nbsp;<span id="state_ajax_indicator"></span>
       <br>&nbsp;&nbsp;&nbsp;<small><?php _e('Skip to apply in all states of above country.');?></small>
      </td>
    </tr>
    <tr>
      <td><?php _e('Status');?></td>
      <td>:
       <select name="status"  id="status">
       <option <?php if($tax->tax_status=='1'){ echo 'selected';}?> value="1"><?php _e('Active');?></option>
	   <option value="2" <?php if($tax->tax_status=='2'){ echo 'selected';}?>><?php _e('Inactive');?></option>
       </select>
      </td>
    </tr>
     <tr>
      <td><?php _e('Amount');?></td>
      <td>:
       <input type="text" name="amount" id="amount" value="<?php echo $tax->tax_amount;?>">
      <select name="amount_type"  id="amount_type">
       <option <?php if($tax->amount_type=='per'){ echo 'selected';}?> value="per"><?php _e('Percentage');?></option>
	   <option <?php if($tax->amount_type=='amt'){ echo 'selected';}?> value="amt"><?php _e('Amount');?></option>
       </select>
       
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="<?php _e('Submit');?>" onclick="return check_frm();" class="b_common action" >
        &nbsp;
        <input type="button" name="cancel" value="<?php _e('Cancel');?>" onClick="window.location.href='<?php echo site_url('/wp-admin/admin.php?page=tax')?>'" class="b_normal action" ></td>
    </tr>
  </table>
</form>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery-1.3.2.min.js"></script>
<script  type="text/javascript" >
function check_frm()
{
	if(document.getElementById('title').value=='')
	{
		alert('<?php _e('Please enter Title');?>');
		document.getElementById('title').focus();
		return false;
	}
	return true;
}
function get_country_state(country_id,stateid)
{
	document.getElementById('state_ajax_indicator').innerHTML = '<?php _e('Processing ...')?>';
	$.ajax({
		url: '<?php echo site_url("/wp-admin/admin.php?page=tax&act=stateajax");?>&cid=' + country_id + '&sid=' +stateid,
		type: 'GET',
		dataType: 'html',
		timeout: 20000,
		error: function(){
			//alert('Error loading cart information');
		},
		success: function(html){
			if(eval(document.getElementById('country_state_id')))
			{
				document.getElementById('country_state_id').innerHTML=html;
				document.getElementById('state_ajax_indicator').innerHTML = '';
			}
		}
	});
	return false;
}
<?php
if($_REQUEST['tid'])
{
?>
	if(document.getElementById('country').value!='')
	{
		var country_id = document.getElementById('country').value;
		get_country_state(country_id,'<?php echo $tax->tax_state;?>');
	}
<?php
}
?>
</script>

</div> <!-- page #end -->
 </div>   <!-- wrapper #end -->
