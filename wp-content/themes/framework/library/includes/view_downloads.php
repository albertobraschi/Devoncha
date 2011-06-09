 <h3><?php _e(MY_DOWNLOADS_PAGE_TITLE);?></h3>
        <table width="100%" class="table">
          <tr>
            <td width="100" class="title"><?php _e(ORDER_NUMBER_TEXT);?></td>
            <td class="title"><?php _e(DOWNLOAD_PRODUCTS_TEXT);?></td>
          </tr>
		<?php
        global $current_user,$wpdb,$prd_db_table_name,$ord_db_table_name;
		$user_id = $current_user->ID;
        $ordersql = "select oid,ostatus  from $ord_db_table_name where uid=\"$user_id\" order by oid desc";
        $orderinfo = $wpdb->get_results($ordersql);
        if($orderinfo)
        {
            $mydownloads = 1;
			foreach($orderinfo as $orderinfoObj)
            {
        		if($orderinfoObj->ostatus == 'approve' || $orderinfoObj->ostatus == 'delivered')
				{
					$order_id = $orderinfoObj->oid;
					$prdsql = "select pid  from $prd_db_table_name where oid=\"$order_id\"";
					$prdinfo = $wpdb->get_results($prdsql);
					if($prdinfo)
					{
						foreach($prdinfo as $prdinfoObj)
						{
							$digital_product =  get_post_meta($prdinfoObj->pid,'product_type',true);
							if($digital_product=='digital')
							{
								$product_name = $wpdb->get_var("select post_title from $wpdb->posts where ID=\"".$prdinfoObj->pid."\"");
								$data =  get_post_meta($prdinfoObj->pid,'key',true);
								$mydownloads = 0;
								?>
								<tr>
								<td class="row1"><?php echo $order_id;?></td>
								<td class="row1">
                                <?php if($data['digital_product']){?>
                                <a href="<?php echo site_url();?>/?ptype=digital_download&pid=<?php echo $prdinfoObj->pid;?>&oid=<?php echo $order_id;?>"><?php echo $product_name;?> (<?php _e('download');?>)</a>
                                <?php }else{?>
								<a href="#"><?php echo $product_name;?> (<?php _e('no download available');?>)</a>								
								<?php }?>
                                </td>
								</tr>
								<?php
							}
						}
					}
				}
            }
        }
        if($mydownloads)
		{
		?>
         <tr>
            <td colspan="2"><?php _e(NO_DOWNLOAD_FILES_MSG);?></td>
          </tr>
        <?php	
		}
		?>
          <tr>
            <td >&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>