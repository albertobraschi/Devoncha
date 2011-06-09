<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/return_page_above_title.php'))
{
	include(CHILDTEMPLATEPATH . '/return_page_above_title.php');
}
?>
<h1 class="head"><?php _e(PAYMENT_SUCCESS_TITLE);?></h1>
     <div class="breadcrumb clearfix">
		<?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',' &raquo; '.__(PAYMENT_SUCCESS_TITLE)); } ?>
    </div>
 <?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/return_page_below_title.php'))
{
	include(CHILDTEMPLATEPATH . '/return_page_below_title.php');
}

$filecontent = get_option('order_payment_success_paypal_msg_content');
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
<h4><?php _e(PAYMENT_SUCCESS_MSG1); ?></h4>
<h6><?php _e(PAYMENT_SUCCESS_MSG2); ?></h6>
<h6><?php _e(PAYMENT_SUCCESS_MSG3.' '.get_option('blogname').'.'); ?></h6>
<?php
}
?>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/return_page_end.php'))
{
	include(CHILDTEMPLATEPATH . '/return_page_end.php');
}
?>