<script>var rootfolderpath = '<?php echo bloginfo('template_directory');?>/images/';</script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/dhtmlgoodies_calendar.js"></script>
<link href="<?php bloginfo('template_directory'); ?>/library/css/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css" />
<style>
h2 {
	color:#464646;
	font-family:Georgia, "Times New Roman", "Bitstream Charter", Times, serif;
	font-size:24px;
	font-size-adjust:none;
	font-stretch:normal;
	font-style:italic;
	font-variant:normal;
	font-weight:normal;
	line-height:35px;
	margin:0;
	padding:14px 15px 3px 0;
	text-shadow:0 1px 0 #FFFFFF;
}
</style>
<?php
global $Cart,$General,$wpdb,$prd_db_table_name,$ord_db_table_name;
?>
<br />
<h2><?php _e('Affiliates Share'); ?></h2>
<?php
if($_REQUEST['srch_st_date'] == '' && $_REQUEST['srch_end_date'] =='')
{
	$_REQUEST['srch_st_date'] = date('Y-m-').'01';
	$num = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')) ;
	$_REQUEST['srch_end_date'] = date('Y-m-').$num;
}
?>
    <form action="" method="post" name="frm_srch">
 <?php _e('Search By');?> : 
     <?php _e('Date From');?>  <input type="text" name="srch_st_date"  id="srch_st_date"  value="<?php echo $_REQUEST['srch_st_date']; ?>" size="10"/>
    &nbsp;<img src="<?php echo bloginfo('template_directory');?>/images/cal.gif" alt="Calendar" onclick="displayCalendar(document.frm_srch.srch_st_date,'yyyy-mm-dd',this)" style="cursor: pointer;" align="absmiddle" border="0">
    <?php _e('To');?> <input type="text" name="srch_end_date"  id="srch_end_date"  value="<?php echo $_REQUEST['srch_end_date']; ?>" size="10"/>
    &nbsp;<img src="<?php echo bloginfo('template_directory');?>/images/cal.gif" alt="Calendar" onclick="displayCalendar(document.frm_srch.srch_end_date,'yyyy-mm-dd',this)" style="cursor: pointer;" align="absmiddle" border="0">
     <input type="submit" name="submit" value="<?php _e('Search');?>" class="highlight_input_btn" />
      <input type="button" name="default" onclick="window.location.href='<?php echo site_url();?>/wp-admin/admin.php?page=affiliates_settings'" value="<?php _e('Default');?>" class="highlight_input_btn" />
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
 <a href="<?php echo site_url();?>/?ptype=account&report_export=1&user_id=<?php echo $userId;?><?php echo $params?>" target="_blank"><?php _e('Export to Excel');?></a>
 </form>
 <br />
    <table width="100%"  class="widefat post fixed" >
      <thead>
         <tr>
            <th class="title"><?php _e('Ord ID'); ?> </th>
             <th class="title"><?php _e('Ord Date'); ?> </th>
            <th class="title"><?php _e('Affilate Name'); ?> </th>
            <th class="title"><?php _e('Ord Total'); echo ' ('. $General->get_currency_code().')'; ?> </th>
            <th class="title"><?php _e('Comission (%)');?> </th>
            <th class="title"><?php _e('Share Total'); echo ' ('.$General->get_currency_code().')'; ?> </th>
        </tr>
        <?php
		if($_REQUEST['srch_st_date'] == '' && $_REQUEST['srch_end_date'] =='')
		{
			$_REQUEST['srch_st_date'] = date('Y-m-').'1';
			$num = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')) ;
			$_REQUEST['srch_end_date'] = date('Y-m-').$num;
		}
		$affsql = "select oid,aff_uid,aff_commission,cart_amount,discount_amt,ord_date,(select u.user_login from $wpdb->users u where u.ID=aff_uid) as aff_name from $ord_db_table_name where aff_uid>0 and ostatus='approve'";
		if($_REQUEST['srch_st_date'] && $_REQUEST['srch_end_date'])
		{
			$srch_st_date = $_REQUEST['srch_st_date'];
			$srch_end_date = $_REQUEST['srch_end_date'];
			$affsql .= " and date_format(ord_date,'%Y-%m-%d') between \"$srch_st_date\" and \"$srch_end_date\"";
		}
		$affres = $wpdb->get_results($affsql);
		if($affres)
		{
			$order_total_amt = 0;
			$share_total = 0;
			foreach($affres as $userinfoObj)
			{
				$order_total = $userinfoObj->cart_amount-$userinfoObj->discount_amt;
				$aff_comm = $userinfoObj->aff_commission;
				$comission_amt = ($order_total*$aff_comm)/100;
				$share_total += $comission_amt;
				$order_total_amt += $order_total;
			  ?>
			<tr>
				<td class="row1" ><a href="<?php echo site_url();?>/wp-admin/admin.php?page=manageorders&oid=<?php echo $userinfoObj->oid;?>"><?php echo $userinfoObj->oid;?></a></td>
                 <td class="row1" ><?php echo date('Y-m-d',strtotime($userinfoObj->ord_date));?></td>
                <td class="row1" ><a href="<?php echo site_url();?>/wp-admin/admin.php?page=affiliates_settings&user_id=<?php echo $userinfoObj->aff_uid;?>"><?php echo $userinfoObj->aff_name;?></a></td>
              	<td class="row1" ><?php echo $General->get_amount_format($order_total,0);?></td>
				<td class="row1" ><?php echo $userinfoObj->aff_commission;?></td>
				<td class="row1" ><?php echo $General->get_amount_format($comission_amt,0);?></td>
			</tr>   
			<?php
			}
			?>
            <tr>
				<td class="row1" >&nbsp;</td>
                <td class="row1" >&nbsp;</td>
                <td class="row1" align="right"><strong><?php _e('Total : ');?></strong></td>
                <td class="row1" ><strong><?php echo $General->get_amount_format($order_total_amt,0);?></strong></td>
				<td class="row1" align="right"><strong><?php _e('Total : ');?></strong></td>
				<td class="row1" ><strong><?php echo $General->get_amount_format($share_total,0);?></strong></td>
			</tr>  
            <?php
		}else
		{
        ?>
        <tr><td colspan="6" align="center"><?php _e('No affiliates share available.');?> </td></tr>
        <?php }?>
        </thead>
    </table>