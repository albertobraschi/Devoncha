<?php
global $wpdb,$Cart,$General,$state_db_table_name;
if($_GET['delete'])
{
	$sid = $_REQUEST['delete'];
	$deletesql = "delete from $state_db_table_name where state_id=\"$sid\"";
	$wpdb->query($deletesql);
	$location = site_url("/wp-admin/admin.php?page=state&msg=delsuccess");
	wp_redirect($location);
	exit;
}

if($_GET['act']=='addstate')
{
	require_once (TEMPLATEPATH . '/library/includes/admin_state_form.php');
	exit;
}
?>
<div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_mange_order"><?php _e('Manage States'); ?></span>  
    
    
 </div> <!-- sub heading -->
 
 <div id="page" >
<?php if($_REQUEST['msg']){?>
<div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
  <p><?php 
  if($_REQUEST['msg']=='addsuccess')
  {
	   _e('State information added successfully');
  }else if($_REQUEST['msg']=='delsuccess') 
  {
 	 _e('State information deleted successfully');
  }else if($_REQUEST['msg']=='editsuccess') 
  {
 	 _e('State information edited successfully');
  }
  ?> </p>
</div>
<?php }?>
<table width="100%">
<tr><td>
<form method="get" action="<?php echo site_url('/wp-admin/admin.php');?>" name="statesearch_frm">
<input type="hidden" name="page" value="state" />
        <table>
        
          <tr>
            <td valign="top"><strong>
              <?php _e('Search'); ?> 
              :</strong></td>
            <td valign="top">&nbsp;</td>
            <td colspan="-2" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" valign="top"><?php if ($_REQUEST['srch_title'])
				{
					$srch_title= stripslashes($_REQUEST['srch_title']);
				}else
				{
					$srch_title = 'Title';
				}
				
				?>
              <input type="text" value="<?php echo $srch_title;?>" name="srch_title" id="srch_title" onblur="if(this.value=='') this.value = '<?php _e('Title');?>';" onfocus="if(this.value=='<?php _e('Title');?>') this.value= '';"   />              &nbsp;&nbsp;
              <input type="submit" name="Search" value="<?php _e('Search'); ?>" class="button-secondary action" onclick="chkfrm();" />              <input type="button" name="Default" value="<?php _e('List All'); ?>" onclick="window.location.href='<?php echo site_url('/wp-admin/admin.php?page=state');?>'" class="button-secondary action" /></td>
            </tr>
          <tr>
            <td colspan="4"><?php _e('Search State title with starting characters. ex: to search <b>London City</b> you can enter <b>London</b>');?></td>
          </tr>
          <tr>
            <td colspan="4">&nbsp;</td>
          </tr>
        </table>
      </form>
<script>
function chkfrm()
{
	if(document.getElementById('srch_title').value=='Title')
	{
		document.getElementById('srch_title').value = '';
	}
}
</script>
</td></tr>
<tr><td>
<a href="<?php echo site_url('/wp-admin/admin.php?page=state&act=addstate');?><?php if($_REQUEST['country']){ echo '&country='.$_REQUEST['country'];}?>"><?php _e('[ + Add State ]');?></a>
</td></tr>
  <tr>
    <td><?php
global $current_user,$state_db_table_name,$country_db_table_name;
if ($_REQUEST['srch_title'])
{
	$srch_suburl= "&srch_title=". stripslashes($_REQUEST['srch_title']);
}
$targetpage = site_url('/wp-admin/admin.php?page=state'.$srch_suburl);
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
$ordersql_select = "select s.*,c.title as ctitle ";
$ordersql_count = "select count(s.state_id) ";
$ordersql_from= " from $state_db_table_name s join $country_db_table_name c on c.country=s.country ";
if($_REQUEST['country'])
{
	$country = $_REQUEST['country'];	
	$ordersql_conditions= " where s.country=\"$country\" ";
}
if($_REQUEST['srch_title'])
{
	$srch_title = $_REQUEST['srch_title'];	
	$ordersql_conditions= " where s.title like \"$srch_title%\" ";
}

$ordersql_limit=" order by s.title limit $strtlimit,$endlimit";
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
              <th width="100" ><strong><?php _e('ID'); ?></strong></th>
              <th width="100" ><strong><?php _e('Code'); ?></strong></th>
              <th colspan="2"><strong><?php _e('Title'); ?></strong></th>
              <th  width="99"><strong><?php _e('Country'); ?></strong></th>
              <th  width="99"><strong><?php _e('Action'); ?></strong></th>
              </tr>
            <?php
if($orderinfo)
{
	foreach($orderinfo as $orderinfoObj)
	{
	?>
         <tr>
          <td align="left"><?php echo $orderinfoObj->state_id;?></td>
          <td><a href="<?php echo site_url('/wp-admin/admin.php?page=state&act=addstate&sid='.$orderinfoObj->state_id);?>"><div><?php echo $orderinfoObj->state;?></div></a></td>
          <td colspan="2"><a href="<?php echo site_url('/wp-admin/admin.php?page=state&act=addstate&sid='.$orderinfoObj->state_id);?>"><?php echo $orderinfoObj->title;?></a></td>
          <td ><a href="<?php echo site_url('/wp-admin/admin.php?page=state&country='.$orderinfoObj->country);?>"><div><?php echo $orderinfoObj->ctitle;?></div></a></td>
          <td ><a href="<?php echo site_url('/wp-admin/admin.php?page=state&delete='.$orderinfoObj->state_id);?>" onclick="return confirm('<?php _e('Are you sure want to delete?');?>');"><div><?php _e('Delete');?></div></a></td>
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