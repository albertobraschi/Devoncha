<?php
global $wpdb,$General,$shipping_info_db_table_name,$shipping_info_db_table_name;
if($_REQUEST['act']=='del')
{

	$sinfoid = $_REQUEST['sinfoid'];
	$sid = $_REQUEST['id'];
	
	$delsql = "delete from $shipping_info_db_table_name where sinfo_id=\"$sinfoid\"";
	$wpdb->query($delsql);
	wp_redirect(site_url("/wp-admin/admin.php?page=manageshipping&payact=setting&msg=delsuccess&id=".$_GET['id']));
}elseif($_REQUEST['act']=='edit')
{

	$sinfo_id = $_REQUEST['sinfo_id'];
	$sid = $_REQUEST['sid'];
	$amount = $_REQUEST['amount'];
	$ship_type_range = trim($_REQUEST['ship_type_range']);
	$country = $_REQUEST['country'];
	$state = $_REQUEST['state'];
	
	if($sinfo_id){
		$updatesql = "update $shipping_info_db_table_name set amount=\"$amount\",state=\"$state\",country=\"$country\",ship_type_range =\"$ship_type_range\" where sinfo_id=\"$sinfo_id\"";
		$wpdb->query($updatesql);
	}else
	{
		$addsql = "insert into $shipping_info_db_table_name (amount,state,country,ship_type_range,shipping_id) values (\"$amount\",\"$state\",\"$country\",\"$ship_type_range\",\"$sid\")";
		$wpdb->query($addsql);
	}
	wp_redirect(site_url( "/wp-admin/admin.php?page=manageshipping&payact=setting&msg=editsuccess&id=".$_GET['id']));
}


$shipping_sql = "select * from $shippings_db_table_name where shipping_id = '".$_GET['id']."'";
$shippinginfo = $wpdb->get_results($shipping_sql);
$shipping_title = $shippinginfo[0]->title;
?>
 <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery-1.3.2.min.js"></script>
<script  type="text/javascript" >
function check_frm(ship_info_id)
{
	if(document.getElementById('amount'+ship_info_id).value=='')
	{
		alert('<?php _e('Please enter Amount');?>');
		document.getElementById('amount'+ship_info_id).focus();
		return false;
	}
	return true;
}
function edit_informations(ship_info_id)
{
	if(document.getElementById('ship_info_id_'+ship_info_id).style.display)
	{
		document.getElementById('ship_info_id_'+ship_info_id).style.display = '';
	}else
	{
		document.getElementById('ship_info_id_'+ship_info_id).style.display = 'none';	
	}
}
function get_country_state(country_id,shipinfoid,stateid)
{
	document.getElementById('state_ajax_indicator'+shipinfoid).innerHTML = '<?php _e('Processing ...')?>';
	$.ajax({
		url: '<?php echo site_url("/wp-admin/admin.php?page=tax&act=stateajax");?>&cid=' + country_id + '&sid=' +stateid,
		type: 'GET',
		dataType: 'html',
		timeout: 20000,
		error: function(){
			//alert('Error loading cart information');
		},
		success: function(html){
			if(eval(document.getElementById('country_state_id'+shipinfoid)))
			{
				document.getElementById('country_state_id'+shipinfoid).innerHTML=html;
				document.getElementById('state_ajax_indicator'+shipinfoid).innerHTML = '';
			}
		}
	});
	return false;
}
</script>
<div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_shipping_detail"><?php _e($option_value['name']);?>  <?php printf(__('Settings for %s'),$shipping_title); ?></span>  
 </div> <!-- sub heading -->
 <div id="page" >
  <?php if($_GET['msg']){?>
  <div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
    <p><?php if($_GET['msg']=='delsuccess'){_e('Delete Succesfully');}else{_e('Updated Succesfully');}?> </p>
  </div>
  <?php }?>
  <a href="javascript:void(0);" onclick="edit_informations('0');"><strong><?php _e('Add New');?></strong></a>
 <form method="post" action="<?php echo site_url('/wp-admin/admin.php?page=manageshipping&payact=setting&id='.$_GET['id']);?>" name="ship_info_frm_add_new" id="ship_info_id_0" style="display:none;">
      <input type="hidden" name="sinfo_id" value="<?php echo $sinfo_id?>" />
      <input type="hidden" name="sid" value="<?php echo $_GET['id']?>" />
      <input type="hidden" name="act" value="edit" />
     <table width="75%" cellpadding="3" cellspacing="3" class="widefat post sub_table">
    <tr>
      <td width="14%"><?php _e('Amount');?></td>
      <td width="86%">:
        <input type="text" name="amount" id="amount<?php echo $sinfo_id;?>" value="<?php echo $amount;?>"></td>
    </tr>
    <tr>
      <td width="14%"><?php _e('Range');?></td>
      <td width="86%">:
        <input type="text" name="ship_type_range" id="ship_type_range<?php echo $sinfo_id;?>" value="<?php echo $ship_type_range;?>">
       <br /> <small><?php _e('Keep blank for no range. You can set as from starting range to ending range as starting->ending. <u>ex: 0->1000</u>. The range unit depends on type of shipping. like for price base shipping range will be from start price->end price and for weight base shipping it will be from start weight->end weight');?></small>
        </td>
    </tr>
    <tr>
      <td><?php _e('Country');?></td>
      <td>:
      <select name="country"  id="country<?php echo $sinfo_id;?>" onChange="get_country_state(this.value,'<?php echo $sinfo_id;?>','');">
       <option value=""><?php _e('All Countries');?></option>
	   <?php echo country_dl($country);?>
       </select>
      </td>
    </tr>
      <tr>
      <td><?php _e('State');?></td>
      <td>:
       <select name="state"  id="country_state_id<?php echo $sinfo_id;?>">
       <option value=""><?php _e('Select Country First');?></option>
       </select>&nbsp;<span id="state_ajax_indicator<?php echo $sinfo_id;?>"></span>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="<?php _e('Submit');?>" onclick="return check_frm();" class="b_common action" >
        &nbsp;
        <input type="button" name="cancel" value="<?php _e('Cancel');?>" onClick="window.location.href='<?php echo site_url( '/wp-admin/admin.php?page=manageshipping&payact=setting&id='.$_GET['id'] );?>'" class="b_normal action" ></td>
    </tr>
  </table>
      </form>
      
      
<form action="<?php echo site_url( '/wp-admin/admin.php?page=manageshipping&payact=setting&id='.$_GET['id'] );?>" method="post" name="payoptsetting_frm">
  <table width="65%" cellpadding="5" class="widefat post sub_table" >
    <thead>
     <tr>
        <th width="45" align="center"><strong><?php _e('Amount'); ?></strong></th>
        <th width="45" align="center"><strong><?php _e('Range'); ?></strong></th>
        <th width="180"><strong><?php _e('State / Country'); ?></strong></th>
        <th width="100" ><strong><?php _e('Action'); ?></strong></th>
        <th >&nbsp;</th>
      </tr>
<?php 
$shipping_sql = "select * from $shipping_info_db_table_name where shipping_id = '".$_GET['id']."'";
$shippinginfo = $wpdb->get_results($shipping_sql);
foreach($shippinginfo as $shippinginfo_obj){
$sinfo_id = $shippinginfo_obj->sinfo_id;
$ship_type_range = $shippinginfo_obj->ship_type_range;
$country = $shippinginfo_obj->country;
$state = $shippinginfo_obj->state;
$amount = $shippinginfo_obj->amount;
?>
     
      <tr>
        <td width="120"><?php echo $amount;?> </td>
         <td width="120"><?php echo $ship_type_range;?> </td>
        <td width="0"><?php echo empty($state) ? __('All States') : $state; echo ' / ';  echo empty($country) ? __('All Countries') : $country;?></td>
         <td width="120">
         <a href="javascript:void(0);" onclick="edit_informations('<?php echo $sinfo_id;?>');"><?php _e('Edit');?></a>&nbsp;&nbsp;
         <?php if(count($shippinginfo)>1){?>
         <a href="<?php echo site_url( '/wp-admin/admin.php?page=manageshipping&payact=setting&id='.$_GET['id']);?>&sinfoid=<?php echo $sinfo_id;?>&act=del"><?php _e('Delete');?></a>
         <?php }else{?>
         <?php _e("Can't&nbsp;Delete");?>
         <?php }?>
         </td>
        <td>&nbsp;</td>
      </tr>
      <tr id="ship_info_id_<?php echo $sinfo_id;?>" style="display:none;"><td colspan="5">
      <form method="post" action="<?php echo site_url( '/wp-admin/admin.php?page=manageshipping&payact=setting&id='.$_GET['id']);?>" name="ship_info_frm_<?php echo $sinfo_id;?>">
      <input type="hidden" name="sinfo_id" value="<?php echo $sinfo_id?>" />
      <input type="hidden" name="sid" value="<?php echo $_GET['id']?>" />
      <input type="hidden" name="act" value="edit" />
     <table width="75%" cellpadding="3" cellspacing="3" class="widefat post sub_table" >
    <tr>
      <td width="14%"><?php _e('Amount');?></td>
      <td width="86%">:
        <input type="text" name="amount" id="amount<?php echo $sinfo_id;?>" value="<?php echo $amount;?>"></td>
    </tr>
    <tr>
      <td width="14%"><?php _e('Range');?></td>
      <td width="86%">:
        <input type="text" name="ship_type_range" id="ship_type_range<?php echo $sinfo_id;?>" value="<?php echo $ship_type_range;?>">
       <br /> <small><?php _e('Keep blank for no range. You can set as from starting range to ending range as starting->ending. <u>ex: 0->1000</u>. The range unit depends on type of shipping. like for price base shipping range will be from start price->end price and for weight base shipping it will be from start weight->end weight');?></small>
        </td>
    </tr>
    <tr>
      <td><?php _e('Country');?></td>
      <td>:
      <select name="country"  id="country<?php echo $sinfo_id;?>" onChange="get_country_state(this.value,'<?php echo $sinfo_id;?>','');">
       <option value=""><?php _e('All Countries');?></option>
	   <?php echo country_dl($country);?>
       </select>
      </td>
    </tr>
      <tr>
      <td><?php _e('State');?></td>
      <td>:
       <select name="state"  id="country_state_id<?php echo $sinfo_id;?>">
       <option value=""><?php _e('Select Country First');?></option>
       </select>&nbsp;<span id="state_ajax_indicator<?php echo $sinfo_id;?>"></span>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="<?php _e('Submit');?>" onclick="return check_frm();" class="b_common action" >
        &nbsp;
        <input type="button" name="cancel" value="<?php _e('Cancel');?>" onClick="window.location.href='<?php echo site_url( '/wp-admin/admin.php?page=manageshipping&payact=setting&id='.$_GET['id'] );?>'" class="b_normal action" ></td>
    </tr>
  </table>
      </form>
<script type="text/javascript">
if(document.getElementById('country<?php echo $sinfo_id;?>').value!='')
{
	//var country_id = document.getElementById('country<?php echo $sinfo_id;?>').value;
	get_country_state('<?php echo $country;?>','<?php echo $sinfo_id;?>','<?php echo $state;?>');
}
</script>
      </td></tr>
<?php }?>
      
    </thead>
  </table>
</form>
</div> <!-- page #end -->
 </div>   <!-- wrapper #end -->