<div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_aff_detail"><?php _e('Affiliate Detail Report'); ?></span>  
 </div> <!-- sub heading -->
 <div id="page" >
 
<script>var rootfolderpath = '<?php echo bloginfo('template_directory');?>/images/';</script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/dhtmlgoodies_calendar.js"></script>
<link href="<?php bloginfo('template_directory'); ?>/library/css/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css" />

<?php
global $Cart,$General,$wpdb,$prd_db_table_name,$ord_db_table_name;
?>
<?php
$user_id = $_REQUEST['user_id'];
$affsql = "select count(oid) as oid_count, sum(cart_amount-discount_amt) as order_total, sum(((cart_amount-discount_amt)*aff_commission)/100) as earn_total from $ord_db_table_name where aff_uid=\"$user_id\" and ostatus='approve'";
$aff_total_res = $wpdb->get_results($affsql);
$user_name = $wpdb->get_var("select u.user_login from $wpdb->users u where u.ID=\"$user_id\"");
?>
<table width="100%"  class="widefat post" >
<thead>
<td class="row1">
<table cellpadding="5" ><tr><td colspan="8"><h3><?php echo $user_name; _e("'s Affiliate Detail Report"); ?></h3></td></tr>
<tr>
<td><?php _e('No of Orders'); ?> </td>
<th><?php echo  $aff_total_res[0]->oid_count;?> </th>
<td><?php _e('Total Sale Amount'); ?> </td>
<th><?php echo  number_format($aff_total_res[0]->order_total,2);?> </th>
<td><?php _e('Total Earn Amount'); ?> </td>
<th><?php echo number_format($aff_total_res[0]->earn_total,2);?> </th>
</tr>
</table>
 </td>
</thead>

</table>
<form action="" method="post" name="frm_srch">
 <?php _e('Search By');?> : 
     <?php _e('Date From');?>  <input type="text" name="srch_st_date"  id="srch_st_date"  value="<?php echo $_REQUEST['srch_st_date']; ?>" size="10"/>
    &nbsp;<img src="<?php echo bloginfo('template_directory');?>/images/cal.gif" alt="Calendar" onclick="displayCalendar(document.frm_srch.srch_st_date,'yyyy-mm-dd',this)" style="cursor: pointer;" align="absmiddle" border="0">
    <?php _e('To');?> <input type="text" name="srch_end_date"  id="srch_end_date"  value="<?php echo $_REQUEST['srch_end_date']; ?>" size="10"/>
    &nbsp;<img src="<?php echo bloginfo('template_directory');?>/images/cal.gif" alt="Calendar" onclick="displayCalendar(document.frm_srch.srch_end_date,'yyyy-mm-dd',this)" style="cursor: pointer;" align="absmiddle" border="0">
     <input type="submit" name="submit" value="<?php _e('Search');?>" class="highlight_input_btn" />
      <input type="button" name="default" onclick="window.location.href='<?php echo site_url();?>/wp-admin/admin.php?page=affiliate_report&user_id=<?php echo $userId;?>'" value="<?php _e('Default');?>" class="highlight_input_btn" />
     <?php
     $params = '';
	 if($_REQUEST['srch_st_date'] != '' && $_REQUEST['srch_end_date'] =='')
	 {
	 	$params = "&srch_st_date=".$_REQUEST['srch_st_date'];
	 }else
	 if($_REQUEST['srch_st_date'] == '' && $_REQUEST['srch_end_date']!='')
	 {
	 	$params = "&srch_end_date=".$_REQUEST['srch_end_date'];
	 }else
	  if($_REQUEST['srch_st_date'] != '' && $_REQUEST['srch_st_date'] != '')
	 {
	 	$params = "&srch_st_date=".$_REQUEST['srch_st_date']."&srch_end_date=".$_REQUEST['srch_end_date'];
	 }
	 ?>
 <a href="<?php echo site_url();?>/?ptype=account&report_export=1&user_id=<?php echo $_REQUEST['user_id'];?><?php echo $params?>" target="_blank"><?php _e('Export to Excel');?></a>
 </form>
<br />
<?php
if($_REQUEST['user_id'])
{
	$user_id = $_REQUEST['user_id'];
	?>
	<table width="100%"  class="widefat post fixed" >
	  <thead>
		 <tr>
			<th class="title"><?php _e('Date'); ?> </th>
			<th class="title"><?php _e('Order ID'); ?> </th>
			<th class="title"><?php _e('Payment Status'); ?> </th>
			<th class="title"><?php _e('Comission(%)'); ?> </th>
			<th class="title"><?php _e('Currency'); ?> </th>
            <th class="title"><?php _e('Ord Amount'); ?> </th>
			<th class="title"><?php _e('Aff Share'); ?> </th>
		</tr>
<?php
$user_id = $_REQUEST['user_id'];
$affsql = "select * from $ord_db_table_name where aff_uid=\"$user_id\" and ostatus='approve'";
if($_REQUEST['srch_st_date'] && $_REQUEST['srch_end_date'])
{
	$srch_st_date = $_REQUEST['srch_st_date'];
	$srch_end_date = $_REQUEST['srch_end_date'];
	$affsql .= " and date_format(ord_date,'%Y-%m-%d') between \"$srch_st_date\" and \"$srch_end_date\"";
}
$aff_res = $wpdb->get_results($affsql);
if($aff_res)
{
	$share_total = 0;
	foreach($aff_res as $aff_res_obj)
	{
		$order_amt = $aff_res_obj->cart_amount-$aff_res_obj->discount_amt;
		$aff_amt = ($order_amt*$aff_res_obj->aff_commission)/100;
		$share_total += $aff_amt;
	?>
		 <tr>
			<td class="row1" ><?php echo date('Y-m-d',strtotime($aff_res_obj->ord_date));?></td>
			<td class="row1" ><?php echo $aff_res_obj->oid;?></td>
			<td class="row1" ><?php echo $aff_res_obj->ostatus;?></td>
			<td class="row1" ><?php echo $aff_res_obj->aff_commission;?></td>
			<td class="row1" ><?php echo $aff_res_obj->currency_code;?></td>
            <td class="row1" ><?php echo $General->get_amount_format($order_amt,0);?></td>
			<td class="row1" ><?php echo $General->get_amount_format($aff_amt,0);?></td>
		</tr>   
		<?php
	}
?>
<tr><td colspan="5">&nbsp;</td><th><?php _e('Total Earn : ');?> </th><th><?php echo $General->get_amount_format($share_total,0);?></th></tr>
<?php
}else
{
?>
<tr><td colspan="7"><h4><?php _e('No record available');?></h4></td></tr>
<?php
}
}
?>  </thead>
</table>
</div> <!-- page #end -->
 </div>   <!-- wrapper #end -->