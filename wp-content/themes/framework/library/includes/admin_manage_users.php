<?php global $wpdb,$Cart,$General,$prd_db_table_name,$ord_db_table_name;?>

<div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_mange_order"><?php _e('Manage Users'); ?></span>  
    
    
 </div> <!-- sub heading -->
 
 <div id="page" >
<?php 
if($_REQUEST['msg']=='statusupdate')
{
	$message= __('Status Updated successfully...');
}
if($message){?>
<div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
  <p><?php _e($message);?> </p>
</div>
<?php }?>
<p> <a href="<?php echo site_url('/wp-admin/users.php');?>"> <?php _e('Click to Add or Delete Users');?> </a></p>
<table width="100%">
  <tr>
    <td>
    <form method="post" action="<?php echo site_url('/wp-admin/admin.php?page=manageusers');?>" name="ordersearch_frm">
        <table>
       
          <tr>
            <td valign="top"><strong>
              <?php _e('Search'); ?> 
              :</strong></td>
            <td valign="top">&nbsp;</td>
            <td width="25" valign="top">&nbsp;</td>
            <td colspan="2" valign="top"><strong>
              <?php _e('Order Status'); ?> 
              :</strong></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td valign="top"><?php if ($_REQUEST['srch_orderno'])
{
	$srch_orderno=$_REQUEST['srch_orderno'];
}else
{
	$srch_orderno = 'order number';
}

?>
              <input type="text" value="<?php echo $srch_orderno;?>" name="srch_orderno" id="srch_orderno" onblur="if(this.value=='') this.value = '<?php _e('order number');?>';" onfocus="if(this.value=='<?php _e('order number');?>') this.value= '';"   /><br /></td>
            <td valign="top"><?php
$paymentsql = "select * from $wpdb->options where option_name like 'payment_method_%' order by option_id";
$paymentinfo = $wpdb->get_results($paymentsql);
if($paymentinfo)
{
	foreach($paymentinfo as $paymentinfoObj)
	{
		$paymentInfo = unserialize($paymentinfoObj->option_value);
		$paymethodKeyarray[$paymentInfo['key']] = $paymentInfo['key'];
		ksort($paymethodKeyarray);
	}
}
?>
              <select name="srch_payment">
                <option value=""> <?php _e('Select Payment Type'); ?> </option>
                <?php
				foreach($paymethodKeyarray as $key=>$value)
				{
					if($value)
					{
				?>
                <option value="<?php echo $value;?>" <?php if($value==$_REQUEST['srch_payment']){?> selected<?php }?>><?php echo $value;?></option>
                <?php }}?>
              </select></td>
            <td valign="top">&nbsp;</td>
            <td valign="top"> 
              <select name="srch_status">
                <option value=""> <?php _e('Select Status');?> </option>
                    <option value="pending" <?php if($_REQUEST['srch_status']=='pending'){?> selected<?php }?>><?php _e(ORDER_PROCESSING_TEXT);?></option>
                    <option value="approve" <?php if($_REQUEST['srch_status']=='approve'){?> selected<?php }?>><?php _e(ORDER_APPROVE_TEXT);?></option>
                    <option value="reject" <?php if($_REQUEST['srch_status']=='reject'){?> selected<?php }?>><?php _e(ORDER_REJECT_TEXT);?></option>
                    <option value="cancel" <?php if($_REQUEST['srch_status']=='cancel'){?> selected<?php }?>><?php _e(ORDER_CANCEL_TEXT);?></option>
                    <option value="shipping" <?php if($_REQUEST['srch_status']=='shipping'){?> selected<?php }?>><?php _e(ORDER_SHIPPING_TEXT);?></option>
                    <option value="delivered" <?php if($_REQUEST['srch_status']=='delivered'){?> selected<?php }?>><?php _e(ORDER_DELIVERED_TEXT);?></option>
              </select></td>
            <td valign="top">&nbsp;&nbsp;
              <input type="submit" name="Search" value="<?php _e('Search'); ?>" class="button-secondary action" onclick="chkfrm();" />
              &nbsp;
              <script>
function chkfrm()
{
	if(document.getElementById('srch_orderno').value=='order number')
	{
		document.getElementById('srch_orderno').value = '';
	}
}
</script>
            </td>
            <td valign="top"><input type="button" name="Default" value="<?php _e('List All Orders'); ?>" onclick="window.location.href='<?php echo site_url('/wp-admin/admin.php?page=manageorders');?>'" class="button-secondary action" /></td>
          </tr>
          <tr>
            <td colspan="7">&nbsp;</td>
          </tr>
          <tr><td colspan="7"><small><?php _e('<u><b>Note</b></u> : you can search multiple orders by enter "Order Number"  comma seperated. example : 1,2,3,4');?></small></td></tr>
          <tr>
            <td height="2" valign="top"></td>
            <td height="2" valign="top"></td>
            <td height="2" valign="top"></td>
            <td height="2" valign="top"></td>
            <td height="2" valign="top"></td>
            <td height="2" valign="top"></td>
          </tr>
        </table>
      </form></td>
  </tr>
  <tr>
    <td><?php
global $current_user,$ord_db_table_name;
$current_user_ID = $current_user->ID;
$targetpage = site_url('/wp-admin/admin.php?page=manageusers');
$recordsperpage = 30;
$pagination = $_REQUEST['pagination'];
if($pagination == '')
{
	$pagination = 1;
}
$strtlimit = ($pagination-1)*$recordsperpage;
$endlimit = $strtlimit+$recordsperpage;
$orderCount = 0;
//----------------------------------------------------
$sql_select = "select u.* ";
$sql_count = "select count(u.ID) ";
$sql_from= " from $wpdb->users u ";
$sql_conditions= " where  1 ";
if($_REQUEST['srch_status'])
{
	$srch_status = $_REQUEST['srch_status'];
	$sql_conditions .= " and o.ostatus like \"$srch_status\"";
}	
$ordersql_limit=" order by u.user_login asc limit $strtlimit,$endlimit";
//----------------------------------------------------
$total_pages = $wpdb->get_var($sql_count . $sql_from . $sql_conditions);
$info = $wpdb->get_results($sql_select.$sql_from.$sql_conditions.$sql_limit);
if($total_pages>0)
{
?>
      <form name="frmContentList1" action="" method="post">
      <input type="hidden" id="submitact" name="submitact" value="delete" />
        <table width="100%" cellpadding="5"  class="widefat post" >
          <thead>
            <tr>
              <th><?php _e('User ID'); ?></th>
              <th width="200" ><strong><?php _e('Email'); ?></strong></th>
              <th width="100" ><strong><?php _e('Registration'); ?></strong></th>
              <th width="100" ><strong><?php _e('Orders'); ?></strong></th>
              <th width="100" ><strong><?php _e('View Detail');?></strong></th>
              <th >&nbsp;</th>
              </tr>
            <?php
if($info)
{
$ordsql = "select count(oid) as total_orders,uid from $ord_db_table_name group by uid";
$orderinfo = $wpdb->get_results($ordsql);
$user_orders = array();
foreach($orderinfo as $orderinfo_obj)
{
	$user_orders[$orderinfo_obj->uid] = $orderinfo_obj->total_orders;
}
foreach($info as $infoObj)
{
?>
	 <tr>
	  <td align="left"><a href="<?php echo site_url('/wp-admin/admin.php?page=manageusers&uid='.$infoObj->ID);?>"><div><?php echo $infoObj->user_login ;?></div></a></td>
	  <td><a href="<?php echo site_url('/wp-admin/admin.php?page=manageusers&uid='.$infoObj->ID);?>"><div><?php echo $infoObj->user_email;?></div></a></td>
	  <td><?php echo date(get_option('date_format'),strtotime($infoObj->user_registered));?></td>
	  <td><?php if($user_orders[$infoObj->ID]){?><a href="<?php echo site_url('/wp-admin/admin.php?page=manageorders&uid='.$infoObj->ID);?>"><div><?php echo $user_orders[$infoObj->ID];?></div></a><?php }?></td>
      <td><a href="<?php echo site_url('/wp-admin/admin.php?page=manageusers&uid='.$infoObj->ID);?>"><div><?php _e('View Detail');?></div></a></td>
	  <td>&nbsp;</td>
	  </tr>
<?php		
}
}
?>
            <tr>
              <td colspan="6">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4" align="center"><?php
			if($total_pages>$recordsperpage)
			{
			echo $General->get_pagination($targetpage,$total_pages,$recordsperpage,$pagination);
			}?></td>
             
              <td colspan="2" align="right"><strong><?php _e('Total'); ?> : <?php echo $total_pages;?> <?php _e('users'); ?></strong></td>
            </tr>
          </thead>
        </table>
      </form>
      <?php
}else
{
?>
      <br />
      <br />
      <p><strong><?php _e('No Orders Available'); ?></strong></p>
      <?php
}
?>
    </td>
  </tr>
</table>

	</div> <!-- page #end -->
 </div>   <!-- wrapper #end -->