   <?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/view_orders_above_title.php'))
{
	include(CHILDTEMPLATEPATH . '/view_orders_above_title.php');
}
?> 
<h3> <?php _e('Meus Pedidos');?> </h3>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table">
  <tr>
    <td class="title"><?php _e('Número do Pedido');?></td>
    <td width="25%" align="center" class="title"><?php _e('Data');?></td>
    <td width="10%" align="center" class="title"><?php _e('Valor');?></td>
    <td width="10%" align="center" class="title"><?php _e('Status');?></td>
  </tr>
<?php
global $current_user,$wpdb,$prd_db_table_name,$ord_db_table_name;
$ordersql = "select *  from $ord_db_table_name where 1";
$current_user_ID = $current_user->ID;
if($current_user_ID)
{
	$user_id = $current_user_ID;	
	$ordersql .= " and uid=\"$user_id\" order by oid desc";
}
$orderinfo = $wpdb->get_results($ordersql);
if($orderinfo)
{
	foreach($orderinfo as $orderinfoObj)
	{
	?>
    	<tr>
        <td class="row1"><a href="<?php echo site_url();?>/?ptype=order_detail&oid=<?php echo $orderinfoObj->oid;?>"><div><?php echo $orderinfoObj->oid;?></div></a></td>
        <td align="center" class="row1"><?php echo date(get_option('date_format'),strtotime($orderinfoObj->ord_date));?></td>
        <td align="center" class="row1 tprice"><?php echo $General->get_amount_format($orderinfoObj->payable_amt);?></td>
        <td align="center" class="remove"><?php echo $General->getOrderStatus($orderinfoObj->ostatus);?></td>
      </tr>
    <?php
	}
}else
{
?>
<tr><td colspan="4"><b><?php _e('No order available');?></b></td></tr>
<?php	
}
?>
 
</table>
   <?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/view_orders_page_end.php'))
{
	include(CHILDTEMPLATEPATH . '/view_orders_page_end.php');
}
?> 