<?php
global $wpdb,$shippings_db_table_name;

if($_POST)
{
	if( $_POST['action']=='active')
	{
		$shippingmethod = $_REQUEST['shippingmethod'];
		if($shippingmethod)
		{
			$updatestatus = "update $shippings_db_table_name set default_status='0'";
			$wpdb->query($updatestatus);
			$updatestatus = "update $shippings_db_table_name set default_status='1' where shipping_id=\"$shippingmethod\"";
			$wpdb->query($updatestatus);
			$message = "Atualizado com sucesso.";
		}
	}elseif( $_POST['action']=='edit_title')
	{
		$id = $_POST['id'];
		$title = $_POST['title'];
		$updatestatus = "update $shippings_db_table_name set title=\"$title\" where shipping_id=\"$id\"";
		$wpdb->query($updatestatus);
	}
}

///////////update options start//////
if($_GET['payact']=='setting' && $_GET['id']!='')
{
	include_once(TEMPLATEPATH . '/library/includes/admin_shipping_settings.php');
	exit;
}
//////////update options end////////
$shipping_sql = "select * from $shippings_db_table_name";
$shippinginfo = $wpdb->get_results($shipping_sql);
?>

<div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_shipping_detail"><?php _e('Opções de Envio'); ?></span>  
 </div> <!-- sub heading -->
 <div id="page" >
<?php if($message){?>
<div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
  <p><?php _e($message);?> </p>
</div>
<?php }?>
<form action="<?php site_url( '/wp-admin/admin.php?page=manageshipping' );?>" method="post" name="shippingfrm">
  <input type="hidden" name="action" value="active" />
  <table width="80%" class="widefat post fixed" >
    <thead>
      <tr>
        <th width="45" align="center"><strong><?php _e('Select'); ?></strong></th>
        <th width="180"><strong><?php _e('Nome do Método'); ?></strong></th>
        <th width="100" ><strong><?php _e('Action'); ?></strong></th>
        <th >&nbsp;</th>
      </tr>
      <?php
if($shippinginfo)
{
	foreach($shippinginfo as $paymentinfoObj)
	{
	$shipping_id = $paymentinfoObj->shipping_id;
	$title = $paymentinfoObj->title;
	$sdesc = $paymentinfoObj->sdesc;
	$default_status = $paymentinfoObj->default_status;
?>
      <tr>
        <td align="center"><input type="radio" name="shippingmethod" value="<?php echo $shipping_id;?>"
     <?php
     if($default_status == 1)
	 {
	 ?>
     checked="checked"
     <?php
	 }
	 ?>
      />
        <td><span id="label_title_id<?php echo $shipping_id;?>"><?php echo $title;?></span>
        <span style="display:none;" id="title_id<?php echo $shipping_id;?>">
        <input type="text" id="shipping_title_<?php echo $shipping_id;?>" value="<?php echo $title;?>" name="shipping_title_<?php echo $shipping_id;?>" /><input type="button" name="button" value="salvar" onclick="return edit_me('<?php echo $shipping_id;?>')" />
        </span>
        </td>
        <td>
        <a href="javascript:void(0);edit_shipping('title_id<?php echo $shipping_id;?>');"><?php _e('Edit');?></a>
   <?php echo '<a href="'.site_url('/wp-admin/admin.php?page=manageshipping&payact=setting&id='.$shipping_id).'">'.__('Settings').'</a>';	?>
        </td>
        <td>&nbsp;</td>
      </tr>
      <?php
	}
}
?>
      <tr>
        <td height="37" colspan="4" align="left" style="padding-top:15px;"><input type="submit" name="<?php _e('Salvar'); ?>" value="Salvar" class="button-secondary action" /></td>
      </tr>
    </thead>
  </table>
</form>
</div> <!-- page #end -->
 </div>   <!-- wrapper #end -->
<span style="display:none;">
<form  id="shipping_title_frm" name="shipping_title_frm" action="<?php echo site_url('/wp-admin/admin.php?page=manageshipping')?>" method="post">
<input type="hidden" id="shipping_frm_id" name="id" value="">
<input type="hidden" id="shipping_frm_title" name="title" value="">
<input type="hidden" value="edit_title" name="action" />
</form></span>
<script type="text/javascript">
function edit_shipping(tabid)
{
	if(document.getElementById('label_'+tabid).style.display)
	{
		document.getElementById('label_'+tabid).style.display = '';
		document.getElementById(tabid).style.display = 'none';
	}else
	{
		document.getElementById('label_'+tabid).style.display = 'none';
		document.getElementById(tabid).style.display = '';
	}
}
function edit_me(sid)
{
	var shipping_title = document.getElementById('shipping_title_'+sid).value;
	if(shipping_title=='')
	{
		alert('<?php _e('Please Enter Title');?>');
		document.getElementById('shipping_title_'+sid).focus();
		return false;	
	}
	document.getElementById('shipping_frm_title').value = shipping_title;
	document.getElementById('shipping_frm_id').value = sid;
	document.shipping_title_frm.submit();
}
</script>