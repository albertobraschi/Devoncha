<div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_mange_stock"><?php _e('Manage Stock'); ?></span>  
 </div> <!-- sub heading -->
 <div id="page" >
<script type="text/javascript">var rootfolderpath = '<?php echo bloginfo('template_directory');?>/images/';</script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/dhtmlgoodies_calendar.js"></script>
<link href="<?php bloginfo('template_directory'); ?>/library/css/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css" />


<table width="100%">
<tr>
<td><form method="post" action="<?php echo site_url('/wp-admin/admin.php?page=stock');?>" name="stock_frm">
<?php
if($_REQUEST['srch_stdate'])
{
	$srch_stdate = $_REQUEST['srch_stdate'];
}else
{
	$srch_stdate = '';
}
if($_REQUEST['srch_enddate'])
{
	$srch_enddate = $_REQUEST['srch_enddate'];
}else
{
	$srch_enddate = date('Y-m-d');
}

?>
        <table>
          <tr>
            <td valign="middle"></td>
            <td valign="top">From : 
              <input type="text" value="<?php echo $srch_stdate;?>" name="srch_stdate" id="srch_stdate" size="12"  />&nbsp;<img src="<?php echo bloginfo('template_directory');?>/images/cal.gif" alt="Calendar" onclick="displayCalendar(document.stock_frm.srch_stdate,'yyyy-mm-dd',this)" style="cursor: pointer;" align="absmiddle" border="0">
			  </td>
            <td valign="top"> &nbsp;&nbsp;To : <input type="text" value="<?php echo $srch_enddate;?>" name="srch_enddate" id="srch_enddate" size="12" />&nbsp;<img src="<?php echo bloginfo('template_directory');?>/images/cal.gif" alt="Calendar" onclick="displayCalendar(document.stock_frm.srch_enddate,'yyyy-mm-dd',this)" style="cursor: pointer;" align="absmiddle" border="0">
			</td>
			
			 </td>
            <td valign="top">&nbsp;&nbsp;
              <input type="submit" name="Search" value="<?php _e('Search'); ?>" class="button-secondary action" onclick="chkfrm();" />
            </td>
            </tr>
          <tr>
            <td height="2" valign="top"></td>
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
</table>
<table width="100%" cellpadding="5" class="widefat post" >
  <thead>
    <tr>
      <th width="350" align="left"><strong><?php _e('Products'); ?></strong></th>
      <th width="100" align="center"><strong><?php _e('Opening Stock'); ?></strong></th>
      <th width="100" align="right"><strong><?php _e('Sold Out'); ?></strong></th>
      <th width="100" align="left"><strong><?php _e('Current Stock'); ?></strong></th>
	   <th width="100" align="left"><strong><?php _e('Low stock value'); ?></strong></th>
	  <th width="100" align="left"><strong><?php _e('Stock enabled?'); ?></strong></th>
      <th align="left">&nbsp;</th>
    </tr>
	<pre>
<?php
global $wpdb,$General;
$blogCatStr = $General->get_blog_sub_cats_str('string');
$term_taxonomy = $wpdb->get_var("select group_concat(term_taxonomy_id) from $wpdb->term_taxonomy where term_id in ($blogCatStr)");
if($term_taxonomy)
{
	$sub_sql = "and p.ID not in (select tr.object_id from $wpdb->term_relationships tr  where tr.term_taxonomy_id in ($term_taxonomy))";	
}
$prdsql = "select p.ID,p.post_title from $wpdb->posts p  where p.post_status in ('draft','publish') and p.post_type='post' $sub_sql order by p.post_title";
$prdinfo = $wpdb->get_results($prdsql);
 $arg_parm = array(
 			"stdate"	=>	$_REQUEST['srch_stdate'],
			"enddate"	=>	$_REQUEST['srch_enddate'],	
			);
if($prdinfo)
{
	for($i=0;$i<count($prdinfo);$i++)
	{
		$data = get_post_meta( $prdinfo[$i]->ID, 'key', true );
		$current_stock = $General->product_current_orders_count($prdinfo[$i]->ID,$arg_parm);
	?>
    <tr class="stock">
      <td><a href="<?php echo site_url('/wp-admin/post.php?action=edit&post='.$prdinfo[$i]->ID);?>"><div><?php echo $prdinfo[$i]->post_title;?></div></a></td>
      <td align="center"><?php
		if($data['initstock']=='')
		{
			_e("Unlimited");
		}elseif($data['initstock']=='0')
		{
			echo "<font style=\"color:#006600;\"><b>".__("Out of Stock")."</b></font>";
		}else
		{
			echo number_format($data['initstock']);
		}
	  ?></td>
      <td align="center"><a href="<?php echo site_url();?>/wp-admin/admin.php?page=manageorders&pid=<?php echo $prdinfo[$i]->ID;?>" title="<?php _e('View Orders information');?>"><?php _e($current_stock);?></a></td>
      <td align="center">
	  <?php
		if($data['initstock']=='')
		{
			_e("Unlimited");
		}elseif($data['initstock']=='0')
		{
			echo "<font style=\"color:#006600;\"><b>".__("Out of Stock")."</b></font>";
		}else
		{
			if(($data['initstock']-$current_stock)>0)
			{
				echo number_format($data['initstock']-$current_stock);
			}else
			{
				echo "<font style=\"color:#006600;\"><b>".__("Out of Stock")."</b></font>";
			}
		}
	  ?>
	   </td>
	   <td align="center"><?php echo $data['minstock'];?></td>
	    <td align="center"><?php echo $data['is_check_outofstock'];?></td>
      <td>&nbsp;</td>
    </tr>
    <?php
	}
	
}
?>
  </thead>
</table>
</div> <!-- page #end -->
 </div>   <!-- wrapper #end -->
