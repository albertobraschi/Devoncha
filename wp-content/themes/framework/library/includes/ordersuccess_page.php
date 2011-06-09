<?php
global $Cart,$General,$wpdb,$prd_db_table_name,$ord_db_table_name;
$orderId = $_REQUEST['order'];
?>
 
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/order_success_above_title.php'))
{
	include(CHILDTEMPLATEPATH . '/order_success_above_title.php');
}
?>  
              <h1 class="head"><?php _e(THANK_YOU_TITLE) ?></h1>
            <div class="breadcrumb clearfix">
             <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',' &raquo; '.__(THANK_YOU_TITLE)); } ?>
            </div>
  <?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/order_success_below_title.php'))
{
	include(CHILDTEMPLATEPATH . '/order_success_below_title.php');
}
?>          
       <?php
	   global $upload_folder_path;
	   $orderId = $_REQUEST['order'];
	   $ordersql = "select * from $ord_db_table_name where oid=\"$orderId\"";
		$orderinfo = $wpdb->get_results($ordersql);
		$orderinfo = $orderinfo[0];
	  if($orderinfo->payment_method == 'prebanktransfer')
		{
			$filecontent = get_option('order_payment_success_prebank_msg_content');
			
		}else
		{
			$filecontent = get_option('order_payment_success_msg_content');
		}
		
		$store_name = get_option('blogname');
		if($orderinfo->payment_method == 'prebanktransfer')
		{
			$order_id = $orderinfo->oid;
			$order_amt = $General->get_amount_format($orderinfo->payable_amt);
			$paymentupdsql = "select option_value from $wpdb->options where option_name='payment_method_".$orderinfo->payment_method."'";
			$paymentupdinfo = $wpdb->get_results($paymentupdsql);
			$paymentInfo = unserialize($paymentupdinfo[0]->option_value);
			$payOpts = $paymentInfo['payOpts'];
			$bankInfo = $payOpts[0]['value'];
			$accountinfo = $payOpts[1]['value'];
		}
		
		$search_array = array('[#$order_amt#]','[#$bank_name#]','[#$account_number#]','[#$orderId#]','[#$store_name#]');
		$replace_array = array($order_amt,$bankInfo,$accountinfo,$order_id,$store_name);
		$filecontent = str_replace($search_array,$replace_array,$filecontent);	
		echo $filecontent;
		?> 
   <?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/order_success_page_end.php'))
{
	include(CHILDTEMPLATEPATH . '/order_success_page_end.php');
}
?>     
     
