<?php
global $wpdb,$Cart,$General,$country_db_table_name;
if($_GET['delete'])
{
	$cid = $_REQUEST['delete'];
	$deletesql = "delete from $country_db_table_name where country_id=\"$cid\"";
	$wpdb->query($deletesql);
	$location = site_url("/wp-admin/admin.php?page=country&msg=delsuccess");
	wp_redirect($location);
	exit;
}
if($_GET['act']=='addcountry')
{
	require_once (TEMPLATEPATH . '/library/includes/admin_country_form.php');
	exit;
}

?>
<div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_mange_order"><?php _e('Manage Country'); ?></span>  
    
    
 </div> <!-- sub heading -->
 
 <div id="page" >
<?php if($_REQUEST['msg']){?>
<div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
  <p><?php 
  if($_REQUEST['msg']=='addsuccess')
  {
	   _e('Country information added successfully');
  }else if($_REQUEST['msg']=='delsuccess') 
  {
 	 _e('Country information deleted successfully');
  }else if($_REQUEST['msg']=='editsuccess') 
  {
 	 _e('Country information edited successfully');
  }
  ?> </p>
</div>
<?php }?>
<table width="100%">
<tr><td>
<form method="get" action="<?php echo site_url('/wp-admin/admin.php');?>" name="statesearch_frm">
<input type="hidden" name="page" value="country" />
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
              <input type="submit" name="Search" value="<?php _e('Search'); ?>" class="button-secondary action" onclick="chkfrm();" />              <input type="button" name="Default" value="<?php _e('List All'); ?>" onclick="window.location.href='<?php echo site_url('/wp-admin/admin.php?page=country');?>'" class="button-secondary action" /></td>
            </tr>
          <tr>
            <td colspan="4"><?php _e('Search Country United States title with starting characters. ex: to search <b>United States</b> you can enter <b>United</b>');?></td>
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
<a href="<?php echo site_url('/wp-admin/admin.php?page=country&act=addcountry');?>"><?php _e('[ + Add Country ]');?></a>
</td></tr>
  <tr>
    <td><?php
global $current_user,$country_db_table_name;
if ($_REQUEST['srch_title'])
{
	$srch_suburl= "&srch_title=". stripslashes($_REQUEST['srch_title']);
}
$targetpage = site_url('/wp-admin/admin.php?page=country'.$srch_suburl);
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
$ordersql_select = "select * ";
$ordersql_count = "select count(country_id) ";
$ordersql_from= " from $country_db_table_name ";
//$ordersql_conditions= " where 1 ";
if($_REQUEST['srch_title'])
{
	$srch_title = $_REQUEST['srch_title'];	
	$ordersql_conditions= " where title like \"$srch_title%\" ";
}
$ordersql_limit=" order by title limit $strtlimit,$endlimit";
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
              <th colspan="2" ><strong><?php _e('Title'); ?></strong></th>
              <th ><?php _e('States'); ?></th>
              <th ><?php _e('Action'); ?></th>
              </tr>
            <?php
if($orderinfo)
{
	foreach($orderinfo as $orderinfoObj)
	{
	?>
         <tr>
          <td align="left"><?php echo $orderinfoObj->country_id;?></td>
          <td><a href="<?php echo site_url('/wp-admin/admin.php?page=country&act=addcountry&cid='.$orderinfoObj->country_id);?>"><div><?php echo $orderinfoObj->country;?></div></a></td>
          <td colspan="2"><a href="<?php echo site_url('/wp-admin/admin.php?page=country&act=addcountry&cid='.$orderinfoObj->country_id);?>"><div><?php echo $orderinfoObj->title;?></div></a></td>
          <td><a href="<?php echo site_url('/wp-admin/admin.php?page=state&country='.$orderinfoObj->country);?>"><div><?php _e('View States');?></div></a></td>
          <td><a href="<?php echo site_url('/wp-admin/admin.php?page=country&delete='.$orderinfoObj->country_id);?>" onclick="return confirm('<?php _e('Are you sure want to delete?');?>');"><div><?php _e('Delete');?></div></a></td>
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