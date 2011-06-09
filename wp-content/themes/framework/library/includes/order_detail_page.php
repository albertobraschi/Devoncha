<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/order_detail_page_above_title.php'))
{
	include_once(CHILDTEMPLATEPATH . '/order_detail_page_above_title.php');
}
?>
<h1 class="head"><?php _e(ORDER_DETAIL_PAGE_TITLE);?></h1>
<div class="breadcrumb clearfix">
  <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',' &raquo; '.ORDER_DETAIL_PAGE_TITLE); } ?>
</div>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/order_detail_page_below_title.php'))
{
	include_once(CHILDTEMPLATEPATH . '/order_detail_page_below_title.php');
}
?>
<?php echo $General->get_order_detailinfo_tableformat($_REQUEST['oid']); ?><?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/order_detail_page_end.php'))
{
	include_once(CHILDTEMPLATEPATH . '/order_detail_page_end.php');
}
?>