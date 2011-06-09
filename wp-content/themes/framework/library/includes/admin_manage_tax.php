<?php
global $wpdb,$Cart,$General,$state_db_table_name,$tax_db_table_name,$country_db_table_name;
if($_GET['delete'])
{
	$tid = $_REQUEST['delete'];
	$deletesql = "delete from $tax_db_table_name where tax_id=\"$tid\"";
	$wpdb->query($deletesql);
	$location = site_url("/wp-admin/admin.php?page=tax&msg=delsuccess");
	wp_redirect($location);
	exit;
}

if($_GET['act']=='addtax')
{
	require_once (TEMPLATEPATH . '/library/includes/admin_tax_form.php');
	exit;
}
?>
<div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_mange_order"><?php _e('Manage Tax'); ?></span>  
    
    
 </div> <!-- sub heading -->
 
 <div id="page" >
<?php if($_REQUEST['msg']){?>
<div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
  <p><?php 
  if($_REQUEST['msg']=='addsuccess')
  {
	   _e('Information added successfully');
  }else if($_REQUEST['msg']=='delsuccess') 
  {
 	 _e('Information deleted successfully');
  }else if($_REQUEST['msg']=='editsuccess') 
  {
 	 _e('Information edited successfully');
  }
  ?> </p>
</div>
<?php }?>
<table width="100%">
<tr><td>
<a href="<?php echo site_url('/wp-admin/admin.php?page=tax&act=addtax');?>"><?php _e('[ + Add Tax ]');?></a>
</td></tr>
  <tr>
    <td><?php
global $current_user,$state_db_table_name,$country_db_table_name;

$targetpage = site_url('/wp-admin/admin.php?page=tax	'.$srch_suburl);
$recordsperpage = 50;
$pagination = $_REQUEST['pagination'];
if($pagination == '')
{
	$pagination = 1;
}
$strtlimit = ($pagination-1)*$recordsperpage;
$endlimit = $strtlimit+$recordsperpage;
$orderCount = 0;
//----------------------------------------------------
$ordersql_select = "select t.*,(select s.title from $state_db_table_name s where s.state=t.tax_state and t.tax_state!='') as tstate,(select c.title from $country_db_table_name c where c.country=t.tax_country and t.tax_country!='') as tcountry ";
$ordersql_count = "select count(t.tax_id) ";
$ordersql_from= " from $tax_db_table_name t ";
if($_REQUEST['country'])
{
	$country = $_REQUEST['country'];	
	$ordersql_conditions= " where s.country=\"$country\" ";
}
if($_REQUEST['srch_title'])
{
	$srch_title = $_REQUEST['srch_title'];	
	$ordersql_conditions= " where t.tax_title like \"$srch_title%\" ";
}

$ordersql_limit=" order by t.tax_title limit $strtlimit,$endlimit";
//----------------------------------------------------

$total_pages = $wpdb->get_var($ordersql_count . $ordersql_from . $ordersql_conditions);
$orderinfo = $wpdb->get_results($ordersql_select.$ordersql_from.$ordersql_conditions.$ordersql_limit);
if($total_pages>0)
{
?>
      <form name="frmContentList1" action="" method="post">
      <input type="hidden" name="submitact" value="delete" />
        <table width="100%" cellpadding="5"  class="widefat post" >
          <thead>
            <tr>
              <th width="100" ><strong><?php _e('Title'); ?></strong></th>
              <th width="100" ><strong><?php _e('Amount'); ?></strong></th>
              <th><strong><?php _e('State	'); ?></strong></th>
              <th><strong><?php _e('Country'); ?></strong></th>
              <th  width="90"><?php _e('Status'); ?></th>
              <th  width="90"><strong><?php _e('Action'); ?></strong></th>
              </tr>
            <?php
if($orderinfo)
{
	foreach($orderinfo as $orderinfoObj)
	{
	?>
         <tr>
          <td align="left"><a href="<?php echo site_url('/wp-admin/admin.php?page=tax&act=addtax&tid='.$orderinfoObj->tax_id);?>"><div><?php echo $orderinfoObj->tax_title;?></div></a></td>
          <td><a href="<?php echo site_url('/wp-admin/admin.php?page=tax&act=addstate&sid='.$orderinfoObj->tax_id);?>"><div><?php echo $orderinfoObj->tax_amount;?>
          <?php if($orderinfoObj->amount_type=='per'){ echo "%";} ?>
          </div></a></td>
          <td><a href="<?php echo site_url('/wp-admin/admin.php?page=tax&act=addstate&sid='.$orderinfoObj->state_id);?>"><?php echo $orderinfoObj->tstate;?></a></td>
          <td><a href="<?php echo site_url('/wp-admin/admin.php?page=tax&country='.$orderinfoObj->country);?>"><div><?php echo $orderinfoObj->tcountry;?></div></a></td>
          <td ><?php echo  get_status($orderinfoObj->tax_status);?></td>
          <td ><a href="<?php echo site_url('/wp-admin/admin.php?page=tax&delete='.$orderinfoObj->tax_id);?>" onclick="return confirm('<?php _e('Are you sure want to delete?');?>');"><div><?php _e('Delete');?></div></a></td>
          </tr>
    <?php		
	}
}
?>
            <tr>
              <td colspan="6">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2"><strong><?php _e('Total'); ?> : <?php echo $total_pages;?> <?php _e('records'); ?></strong></td>
              <td colspan="4" align="right"><?php
if($total_pages>$recordsperpage)
{
echo $General->get_pagination($targetpage,$total_pages,$recordsperpage,$pagination);
}?></td>
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
      <p><strong><?php _e('No Record Available'); ?></strong></p>
      <?php
}
?>
    </td>
  </tr>
</table>

	</div> <!-- page #end -->
 </div>   <!-- wrapper #end -->
 <?php
 function get_status($stid)
 {
	 if($stid==1)
	 {
		 return __('Active');
	 }else
	 {
		return __('Inactive'); 
	 }
 }
 ?>