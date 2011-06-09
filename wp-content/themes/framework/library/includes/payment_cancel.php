<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/payment_cancel_above_title.php'))
{
	include(CHILDTEMPLATEPATH . '/payment_cancel_above_title.php');
}
?>
<h1 class="head"><?php _e(PAY_CANCELATION_TITLE); ?> </h1>
     <div class="breadcrumb clearfix">
		 <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',' &raquo; '.__(PAY_CANCELATION_TITLE)); } ?>
    </div>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/payment_cancel_below_title.php'))
{
	include(CHILDTEMPLATEPATH . '/payment_cancel_below_title.php');
}

$filecontent = get_option('order_cancellation_msg_content');
$store_name = get_option('blogname');
$search_array = array('[#$store_name#]');
$replace_array = array($store_name);
$filecontent = str_replace($search_array,$replace_array,$filecontent);
if($filecontent)
{
echo $filecontent;
}else
{
?>
<h2><?php _e(PAY_CANCEL_MSG); ?></h2>
<?php
}
?>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/payment_cancel_page_end.php'))
{
	include(CHILDTEMPLATEPATH . '/payment_cancel_page_end.php');
}
?>