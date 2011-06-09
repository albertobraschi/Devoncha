<?php
global $Cart,$General,$wpdb,$prd_db_table_name,$ord_db_table_name;
global $upload_folder_path;
$orderId = $_GET['oid'];

$ordersql = "select * from $ord_db_table_name where oid=\"$orderId\"";
$orderinfo = $wpdb->get_results($ordersql);
if($orderinfo)
{
	foreach($orderinfo as $orderinfoObj)
	{
	}
}
if($_POST['act'] && $_REQUEST['oid']) // update order 
{
	$issendEmail = 0;
	if($orderinfoObj->ostatus != $_POST['ostatus'] && ($_POST['ostatus']=='reject' || $_POST['ostatus']=='approve' || $_POST['ostatus']=='shipping' || $_POST['ostatus']=='delivered') && ($General->is_send_order_approval_email_wpadmin() || $General->is_send_order_reject_email_wpadmin() || $General->is_send_order_shipping_email_wpadmin() || $General->is_send_order_delivered_email_wpadmin()))
	{
		$issendEmail = 1;
	}
	$wpdb->query("update $ord_db_table_name set ostatus='".$_POST['ostatus']."', ord_desc_admin='".addslashes($_POST['ocomments'])."' where oid='".$_REQUEST['oid']."'");
	$display_message = "Order updated successfully.";
	if($issendEmail)
	{
		$ordersql = "select * from $ord_db_table_name where oid=\"$orderId\"";
		$orderinfo = $wpdb->get_results($ordersql);
		if($orderinfo)
		{
			foreach($orderinfo as $orderinfoObj)
			{
			}
		}
		$fromEmail = $General->get_site_emailId();
		$fromEmailName = $General->get_site_emailName();
		$subject_default = "Order ".$_POST['ostatus'] ." Email, Order Number:#".$_REQUEST['oid'];
		$message = "";
		global $wpdb,$ord_db_table_name;
		$oid = $_REQUEST['oid'];
		$user_info = "select u.user_email,u.display_name from $wpdb->users u join $ord_db_table_name ot on ot.uid=u.ID and ot.oid=\"$oid\"";
		$user_info_arr = $wpdb->get_results($user_info);
		if($user_info_arr)
		{
			$toEmailName = $user_info_arr[0]->display_name;
			$toEmail = $user_info_arr[0]->user_email;
		}
		///////////admin email//////////
		if($_POST['ostatus']=='approve')
		{
			$subject = get_option('order_approval_client_email_subject');
			$admin_message = get_option('order_approval_client_email_content');
		}elseif($_POST['ostatus']=='shipping')
		{
			$subject = get_option('order_shipping_client_email_subject');
			$admin_message = get_option('order_shipping_client_email_content');
		}elseif($_POST['ostatus']=='delivered')
		{
			$subject = get_option('order_shipping_client_email_subject');
			$admin_message = get_option('order_shipping_client_email_content');
		}elseif($_POST['ostatus']=='reject')
		{
			$subject = get_option('order_rejection_client_email_subject');
			$admin_message = get_option('order_rejection_client_email_content');
		}
		$order_info = $General->get_order_detailinfo_tableformat($_REQUEST['oid']);
		$store_name = $fromEmailName;
		$search_array = array('[#$user_name#]','[#$to_name#]','[#$order_info#]','[#$store_name#]');
		$replace_array = array($orderinfoObj->billing_name,$orderinfoObj->billing_name,$order_info,$store_name);
		$client_message = apply_filters('order_approved_admin_email_content_filter',str_replace($search_array,$replace_array,$admin_message));
		if($_POST['ostatus']=='approve' && $General->is_send_order_approval_email_wpadmin()){
			$General->sendEmail($fromEmail,$fromEmailName,$toEmail,$toEmailName,$subject,$client_message,$extra='');///approve/reject email			
		}elseif($_POST['ostatus']=='shipping'){
			$General->sendEmail($fromEmail,$fromEmailName,$toEmail,$toEmailName,$subject,$client_message,$extra='');///approve/reject email	
		}elseif($_POST['ostatus']=='delivered'){
			$General->sendEmail($fromEmail,$fromEmailName,$toEmail,$toEmailName,$subject,$client_message,$extra='');///approve/reject email	
		}else
		if($_POST['ostatus']=='reject' && $General->is_send_order_reject_email_wpadmin())
		{
			$General->sendEmail($fromEmail,$fromEmailName,$toEmail,$toEmailName,$subject,$client_message,$extra='');///approve/reject email	
		}
		
		
		///AFFILIATE START//
		if($General->is_active_affiliate() && $General->is_send_order_app_aff_email_wpadmin())
		{
			if($_POST['ostatus']=='approve')  // send affiliate email
			{
				$aid = $orderinfoObj->aff_uid;
				if($aid)
				{
					$usersql = "SELECT user_nicename,user_email FROM $wpdb->users WHERE ID=\"$aid\"";
					$userinfo = $wpdb->get_results($usersql);
					$toEmailName = $userinfo[0]->user_nicename;
					$toEmail = $userinfo[0]->user_email;
					$user_affiliate_data = get_usermeta($aid,'user_affiliate_data');
					$cart_amt = str_replace(',','',$orderinfoObj->cart_amount);
					foreach($user_affiliate_data as $key => $val)
					{
						$share_amt = ($cart_amt*$val['share_amt'])/100;
					}			
					
					$product_name = $wpdb->get_var("select group_concat(p.post_title) from $wpdb->posts p join $prd_db_table_name op on op.pid=p.ID where op.oid='".$_REQUEST['oid']."'");
					$product_qty = $wpdb->get_var("select sum(prd_qty) from $prd_db_table_name where oid='".$_REQUEST['oid']."'");
					
					$subject = __('Your Affiliate Sale');
					$aff_message = __('
					<p>Dear '.$toEmailName.',</p>
					<p>
					New sale has been made by your affiliate link and<br>
					commission credited to your balance.<br>
					</p>
					<p>
					You may find sale details below:
					</p>
					<p>----</p>
					<p>Transaction Id : '.$orderinfoObj->oid.'</p>
					<p>Order Amount :       '.$General->get_amount_format($orderinfoObj->cart_amount).'</p>
					<p>Qty :       '.$product_qty.'</p>
					<p>Product ordered: '.$product_name.'</p>
					<p>Your commission: '.$General->get_amount_format($share_amt).'</p>
					<p>----</p>
					');
					$General->sendEmail($fromEmail,$fromEmailName,$toEmail,$toEmailName,$subject,$aff_message,$extra='');///To affiliate email
				}
			}
		}
		///AFFILIATE END///
		
	}
	wp_redirect("admin.php?page=manageorders&oid=".$_REQUEST['oid']."&msg=success");
}
 ?>
 
 <div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_order_detail"><?php _e('Order Detail of Order'); ?> - <?php echo $_GET['oid'];?></span>  
     <a href="javascript:void(0);" onclick="print();" title="Print Order" class="print_order" style="float:right; padding-right:20px; margin-top:10px;"><img src="<?php bloginfo('template_directory')?>/admin/images/printer.jpg" height="30" width="30" alt="print order" /></a>
    
 </div> <!-- sub heading -->
 <div id="page" >

<table width="100%">
<tr><td>
<?php if($orderinfoObj->aff_uid>0){
	$uid = $orderinfoObj->aff_uid;
	$username = $wpdb->get_var("select display_name from $wpdb->users where ID=\"$uid\"");
	?>
<div style="width:50%; float:left;"><?php _e('Affiliate Info. : ');?><a href="<?php echo site_url()?>/wp-admin/admin.php?page=affiliates_settings&user_id=<?php echo $orderinfoObj->aff_uid;?>"><?php echo $username;?></a> (<?php echo $orderinfoObj->aff_commission;?>%)</div>
<?php }?>
<?php if($orderinfoObj->ip_address){?>
<div style="width:50%; float:right;"><?php _e('Order Request IP Address : '); echo $orderinfoObj->ip_address;?></div>
<?php }?>
</td></tr>
<?php if($_REQUEST['msg']=='success'){?>
<tr>
  <td style="color:#FF0000;"><?php _e('Order status changed successfuly');?></td>
</tr>
<?php }?>
<tr>
  <td><table width="100%">
      <tr>
        <td><?php echo $General->get_order_detailinfo_tableformat($orderId);?> </td>
      </tr>
      <tr>
        <td><form action="<?php echo site_url("/wp-admin/admin.php?page=manageorders&oid=".$_GET['oid']);?>" method="post">
            <input type="hidden" name="act" value="orderstatus">
            <table width="75%" class="widefat post" >
              <tr>
                <td width="10%"><strong><?php _e('Order Status'); ?> :</strong></td>
                <td width="90%">

                <select name="ostatus">
                    <option value="pending" <?php if($orderinfoObj->ostatus=='pending'){?> selected<?php }?>><?php _e(ORDER_PROCESSING_TEXT);?></option>
                    <option value="approve" <?php if($orderinfoObj->ostatus=='approve'){?> selected<?php }?>><?php _e(ORDER_APPROVE_TEXT);?></option>
                    <option value="reject" <?php if($orderinfoObj->ostatus=='reject'){?> selected<?php }?>><?php _e(ORDER_REJECT_TEXT);?></option>
                    <option value="cancel" <?php if($orderinfoObj->ostatus=='cancel'){?> selected<?php }?>><?php _e(ORDER_CANCEL_TEXT);?></option>
                    <option value="shipping" <?php if($orderinfoObj->ostatus=='shipping'){?> selected<?php }?>><?php _e(ORDER_SHIPPING_TEXT);?></option>
                    <option value="delivered" <?php if($orderinfoObj->ostatus=='delivered'){?> selected<?php }?>><?php _e(ORDER_DELIVERED_TEXT);?></option>
                  </select></td>
              </tr>
              <tr>
                <td><strong><?php _e('Comments'); ?>:</strong></td>
                <td><textarea name="ocomments" cols="70"><?php echo stripslashes($orderinfoObj->ord_desc_admin);?></textarea></td>
              </tr>
              <tr>
                <td></td>
                <td><input type="submit" name="submit" value="<?php _e('Update'); ?>" class="button-secondary action" ></td>
              </tr>
            </table>
          </form></td>
      </tr>
      <tr>
        <td><a href="<?php echo site_url("/wp-admin/admin.php?page=manageorders");?>"><strong><?php _e('Back to Orders Listing'); ?></strong></a></td>
      </tr>
     </table>
     </td></tr></table>	
</div> <!-- page #end -->
 </div>   <!-- wrapper #end -->