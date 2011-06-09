<?php
global $General,$wpdb;
global $current_user,$wpdb,$prd_db_table_name,$ord_db_table_name;
$userInfo = $General->getLoginUserInfo();
$orderId = $_REQUEST['id'];
$product_id = $_REQUEST['pid'];
$userid = $wpdb->get_var("select uid from $ord_db_table_name where oid=\"$orderId\"");
if($userid == $current_user->data->ID)
{	
	$data = get_post_meta($product_id, 'key', true );
	$product_image = $data['productimage'];
	$digital_product = $data['digital_product'];
	if($digital_product == '')
	{
		?>
 <?php get_header(); ?>


 
  <div id="wrapper"  class="container_16 clearfix">
    <div id="content" class="grid_11 fl">
     
     	<h1 class="head"><?php _e(DOWNLOAD_PAGE_TITLE);?></h1>
     <div class="breadcrumb clearfix">
		 <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',' &raquo; '.DOWNLOAD_PAGE_TITLE); } ?>
    </div>
     	

      <table>
        <tr>
          <td><h2 style="color:#FF0000;"><?php _e(NO_DOWNLOAD_AVAILABLE_MSG);?></h2></td>
        </tr>
      </table>
 </div>
    </div>
    <!-- content-in #end -->
    <?php include(TEMPLATEPATH . '/sidebar-inner.php'); ?>
  </div>
  <!-- container 16-->
</div>
<!-- wrapper #end -->

 <?php get_footer(); ?>
<?php
	}else
	{
		$filesize =  filesize(WP_CONTENT_DIR.str_replace(site_url( ).'/wp-content','',$digital_product));
		
		$digital_product_arr = explode('.',$digital_product);
		$file_extension = strtolower($digital_product_arr[count($digital_product_arr)-1]);
		//This will set the Content-Type to the appropriate setting for the file
		switch($file_extension)
		{
			case 'exe': $ctype='application/octet-stream'; break;
			case 'zip': $ctype='application/zip'; break;
			case 'mp3': $ctype='audio/mpeg'; break;
			case 'mpg': $ctype='video/mpeg'; break;
			case 'avi': $ctype='video/x-msvideo'; break;
			default:    $ctype='application/force-download';
		}
		header('Content-Description: File Transfer');
		header('Content-Type: '.$ctype);
	   	header('Content-Disposition: inline; filename="' . $digital_product . '"');
		header('Content-Transfer-Encoding: binary');

		set_time_limit(0);
		echo file_get_contents($digital_product);
		flush();
		ob_flush();
		exit;
	}
}else
{
	?>
    
 <?php get_header(); ?>

 
 
<div id="wrapper"  class="container_16 clearfix">
    <div id="content" class="grid_11 fl">
    
    	<h1 class="head"><?php _e(DOWNLOAD_PAGE_TITLE);?></h1>
     <div class="breadcrumb clearfix">
		 <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',' &raquo; '.DOWNLOAD_PAGE_TITLE); } ?>
    </div>
      
      <table>
        <tr>
          <td><h2 style="color:#FF0000;"><?php _e(NOT_VALID_DOWNLOAD_LINK_MSG);?></h2></td>
        </tr>
      </table>
  
    </div>
    <!-- content-in #end -->
    <?php include(TEMPLATEPATH . '/sidebar-inner.php'); ?>
  </div>
  <!-- container 16-->


 <?php get_footer(); ?>
<?php
}
?>