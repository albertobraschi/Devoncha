<?php
global $wpdb,$Cart,$General,$prd_db_table_name,$ord_db_table_name;

if($_POST['submitact']=='delete')
{
	if($_POST['list'])
	{
		$list_str = implode(',',$_POST['list']);
	}
	$delete_prd = "delete from $prd_db_table_name where oid in ($list_str)";
	$wpdb->query($delete_prd);
	$delete_ord = "delete from $ord_db_table_name where oid in ($list_str)";
	$wpdb->query($delete_ord);
	wp_redirect(site_url("/wp-admin/admin.php?page=manageorders&msg=delete"));
}elseif($_POST['submitact']=='change_status')
{
	if($_POST['list'])
	{
		$list_str = implode(',',$_POST['list']);
	}
	$order_status = $_REQUEST['order_status'];
	$delete_ord = "update $ord_db_table_name set ostatus=\"$order_status\" where oid in ($list_str)";
	$wpdb->query($delete_ord);
	wp_redirect(site_url("/wp-admin/admin.php?page=manageorders&msg=statusupdate"));
}

?>
<div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_mange_order"><?php _e('Gerenciar Pedidos'); ?></span>  
    
    
 </div> <!-- sub heading -->
 
 <div id="page" >
 
<script>
	function checkAll(field)
	{
	for (i = 0; i < field.length; i++)
		field[i].checked = true ;
	}
	
	function uncheckAll(field)
	{
	for (i = 0; i < field.length; i++)
		field[i].checked = false ;
	}
	
	function selectCheckBox()
	{
		field = document.getElementsByName('list[]');
		var i;
		ch	= document.getElementById('check');
		if(ch.checked)
		{
			checkAll(field);
		}
		else
		{
			uncheckAll(field);
		}
	}
	
	function recordAction(ordstst)
	{
		var chklength = document.getElementsByName("list[]").length;
		var flag      = false;
		var temp	  ='';
		for(i=1;i<=chklength;i++)
		{
		   temp = document.getElementById("check_"+i+"").checked; 
		   if(temp == true)
		   {
		   		flag = true;
				break;
			}
		}
		
		if(ordstst=='delete')
		{
			var order_act = 'delete';
			var msg1 = '<?php _e('Please select atleast one record to delete.')?>';
			var msg2 = '<?php _e('Are you sure want to continue?');?>';
		}else //status 
		{
			if(document.getElementById("order_status").value=='')
			{
				alert('<?php _e('Select Status to set');?>');
				document.getElementById("order_status").focus();
				return false;
			}else
			{
				document.getElementById("submitact").value = 'change_status';
				var order_act = document.getElementById("order_status").value;
				var msg1 = '<?php _e('Please select atleast one record to ')?>'+order_act;
				var msg2 = '<?php _e('Are you sure want to continue?');?>';
			}
		}
		if(flag == false)
		{
			alert(msg1);
			return false;
		}
		
		if(!confirm(msg2))
		{
		 return false;
		}
		return true;
	
	}
 
</script>

<?php 
if($_REQUEST['msg']=='delete')
{
	$message= __('Deleted successfully...');
}elseif($_REQUEST['msg']=='statusupdate')
{
	$message= __('Status Updated successfully...');
}
if($message){?>
<div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
  <p><?php _e($message);?> </p>
</div>
<?php }?>
<table width="100%">
  <tr>
    <td>
    <form method="post" action="<?php echo site_url('/wp-admin/admin.php?page=manageorders');?>" name="ordersearch_frm">
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
                <option value=""> <?php _e('Selecione Modo de Pagamento'); ?> </option>
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
                <option value=""> <?php _e('Selecione Status');?> </option>
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
global $current_user,$ord_db_table_name,$prd_db_table_name;
$current_user_ID = $current_user->ID;
$targetpage = site_url('/wp-admin/admin.php?page=manageorders');
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
$ordersql_select = "select u.ID,u.display_name ,o.* ";
$ordersql_count = "select count(o.oid) ";
$ordersql_from= " from $ord_db_table_name as o join $wpdb->users u on u.ID=o.uid";
$ordersql_conditions= " where 1 ";
if($_REQUEST['user_id'])
{
	$user_id = $_REQUEST['user_id'];	
	$ordersql_conditions .= " and u.ID=\"$user_id\"";
}
if($_REQUEST['srch_orderno'])
{
	$srch_orderno = $_REQUEST['srch_orderno'];
	$ordersql_conditions .= " and o.oid in ($srch_orderno)";
}
if($_REQUEST['srch_payment'])
{
	$srch_payment = $_REQUEST['srch_payment'];
	$ordersql_conditions .= " and o.payment_method like \"$srch_payment\"";
}
if($_REQUEST['srch_status'])
{
	$srch_status = $_REQUEST['srch_status'];
	$ordersql_conditions .= " and o.ostatus like \"$srch_status\"";
}	
if($_REQUEST['uid'])
{
	$uid = $_REQUEST['uid'];
	$ordersql_conditions .= " and o.uid=\"$uid\"";
}
if($_REQUEST['pid'])
{
	$pid = $_REQUEST['pid'];
	$ordersql_conditions .= " and o.oid in (select oid from $prd_db_table_name where pid=\"$pid\")";
}
$ordersql_limit=" order by o.oid desc limit $strtlimit,$endlimit";
//----------------------------------------------------
$total_pages = $wpdb->get_var($ordersql_count . $ordersql_from . $ordersql_conditions);
$orderinfo = $wpdb->get_results($ordersql_select.$ordersql_from.$ordersql_conditions.$ordersql_limit);
if($total_pages>0)
{
?>
      <form name="frmContentList1" action="" method="post">
      <input type="hidden" id="submitact" name="submitact" value="delete" />
        <table width="100%" cellpadding="5"  class="widefat post" >
          <thead>
            <tr>
              <th width="28" ><input name="check" onClick="return selectCheckBox();" id="check" type="checkbox"></th>
              <th width="120" ><strong><?php _e('Order Number'); ?></strong></th>
              <th width="320" ><strong><?php _e('Customer Name'); ?></strong></th>
              <th width="100" ><strong><?php _e('Order Total'); ?></strong></th>
              <th width="100" ><strong><?php _e('Payment Type'); ?></strong></th>
              <th width="100" ><strong><?php _e('Date'); ?></strong></th>
              <th width="85" ><strong><?php _e('Status'); ?></strong></th>
              <th >&nbsp;</th>
            </tr>
            <?php
if($orderinfo)
{
	$counter = 0;
	foreach($orderinfo as $orderinfoObj)
	{ $counter++;
	?>
         <tr>
          <td align="center"><input name="list[]" id="check_<?php echo $counter;?>" value="<?php echo $orderinfoObj->oid;?>" type="checkbox"></td>
          <td><a href="<?php echo site_url('/wp-admin/admin.php?page=manageorders&oid='.$orderinfoObj->oid);?>"><div><?php echo $orderinfoObj->oid;?></div></a></td>
          <td><a href="<?php echo site_url('/wp-admin/admin.php?page=manageorders&user_id='.$orderinfoObj->ID);?>"><div><?php echo $orderinfoObj->display_name;?></div></a></td>
          <td><?php echo $General->get_amount_format($orderinfoObj->payable_amt);?></td>
          <td><?php echo $orderinfoObj->payment_method;?></td>
          <td><?php echo date('Y/m/d',strtotime($orderinfoObj->ord_date));?></td>
          <td><?php echo $General->getOrderStatus($orderinfoObj->ostatus);?></td>
          <td>&nbsp;</td>
        </tr>
    <?php		
	}
}
?>
            <tr>
              <td colspan="8">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="5"><input name="submit" value="<?php _e('Delete'); ?>" onclick="return recordAction('delete');" type="submit"  class="b_common" />
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('Set Status to :');?> <select name="order_status" id="order_status">
                <option value=""> <?php _e('Select Status');?> </option>
                    <option value="pending" <?php if($_REQUEST['order_status']=='pending'){?> selected<?php }?>><?php _e(ORDER_PROCESSING_TEXT);?></option>
                    <option value="approve" <?php if($_REQUEST['order_status']=='approve'){?> selected<?php }?>><?php _e(ORDER_APPROVE_TEXT);?></option>
                    <option value="reject" <?php if($_REQUEST['order_status']=='reject'){?> selected<?php }?>><?php _e(ORDER_REJECT_TEXT);?></option>
                    <option value="cancel" <?php if($_REQUEST['order_status']=='cancel'){?> selected<?php }?>><?php _e(ORDER_CANCEL_TEXT);?></option>
                    <option value="shipping" <?php if($_REQUEST['order_status']=='shipping'){?> selected<?php }?>><?php _e(ORDER_SHIPPING_TEXT);?></option>
                    <option value="delivered" <?php if($_REQUEST['order_status']=='delivered'){?> selected<?php }?>><?php _e(ORDER_DELIVERED_TEXT);?></option>
              </select>
              <input name="submit" value="<?php _e('Submit'); ?>" onclick="return recordAction('status');" type="submit"  class="b_common" />
              </td>
              <td colspan="3" align="right"><strong><?php _e('Total'); ?> : <?php echo $total_pages;?> <?php _e('orders'); ?></strong></td>
            </tr>
            <tr><td colspan="8" align="center">
            <?php
			if($total_pages>$recordsperpage)
			{
			echo $General->get_pagination($targetpage,$total_pages,$recordsperpage,$pagination);
			}?>
            </td></tr>
          </thead>
        </table>
      </form>
      <?php
}else
{
?>
      <br />
      <br />
      <p><strong><?php _e('Nenhum Pedido no Momento'); ?></strong></p>
      <?php
}
?>
    </td>
  </tr>
</table>

	</div> <!-- page #end -->
 </div>   <!-- wrapper #end -->