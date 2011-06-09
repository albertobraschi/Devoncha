<?php 
session_start();
ob_start();
global $Product,$Cart, $General;
$data = get_post_meta( $post->ID, 'key', true );
$product_price = $Product->get_product_price($post->ID);
$product_cart_price = $Product->get_product_price_no_currency($post->ID);
$product_qty = $Product->get_product_qty($post->ID);
$product_size = $Product->get_product_custom_dl($post->ID,'size','size','',$themeUI->get_product_att1_title($data,0));
$product_color = $Product->get_product_custom_dl($post->ID,'color','color','',$themeUI->get_product_att2_title($data,0));
$product_attribute3 = $Product->get_product_custom_dl($post->ID,'attribute3','attribute3','',$themeUI->get_product_att3_title($data,0));
$product_attribute4 = $Product->get_product_custom_dl($post->ID,'attribute4','attribute4','',$themeUI->get_product_att4_title($data,0));
$product_attribute5 = $Product->get_product_custom_dl($post->ID,'attribute5','attribute5','',$themeUI->get_product_att5_title($data,0));
$product_tax = $General->get_product_tax();
$customarray = array('size','color');
?>
<?php get_header(); ?>
<?php $Product->get_js_header_prd_detail();?>
<?php
global $General;
$admin_layout_setting_option = 'ptthemes_product_detail_design_settings';
$sidebar_left_widget_option = 'Product Detail Sidebar Left';
$sidebar_right_widget_option = 'Product Detail Sidebar Right';
$middle_content_widget_option = '';
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/send_inquiry_page.php'))
{
	$middle_content_file_fullpath = CHILDTEMPLATEPATH . '/send_inquiry_page.php';
}else{
	$middle_content_file_fullpath = TEMPLATEPATH . "/library/includes/send_inquiry_page.php";
}
include_once(TEMPLATEPATH.'/site_layout_structure.php');
?> 
<?php get_footer(); ?>
<?php
global $General;
if($_POST)
{
	$yourname = $_POST['yourname'];
	$youremail = $_POST['youremail'];
	$frnd_subject = $_POST['frnd_subject'];
	$frnd_comments = $_POST['frnd_comments'];
	$productid = $_POST['productid'];
	$to_email = $General->get_site_emailId();
	$to_name = $General->get_site_emailName();
	
	if($_REQUEST['productid'])
	{
		$productinfosql = "select ID,post_title from $wpdb->posts where ID =".$_REQUEST['productid'];
		$productinfo = $wpdb->get_results($productinfosql);
		foreach($productinfo as $productinfoObj)
		{
			$post_title = $productinfoObj->post_title; 
		}
	}
	$message1 = '<table width="80%" align=center>';
	$message1 .= '<tr><td>Dear Administrator,<Br><br></td></tr>';
	$message1 .= '<tr><td>Here is an inquiry for you related to <b>'.$post_title.'</b> :<br><br>'.$frnd_comments.'</td></tr>';
	$message1 .='<tr><td><Br><br>Thank you,<Br>'.$yourname.'</td></tr></table>';
	
	$General->sendEmail($youremail,$yourname,$to_email,$to_name,$frnd_subject,$message1,$extra='');///To friend email
	wp_redirect(site_url()."/?p=".$productid."&msg=inqsuccess");
}
else
{
?>
<?php
if($_REQUEST['pid'])
{
	$productinfosql = "select ID,post_title from $wpdb->posts where ID =".$_REQUEST['pid'];
	$productinfo = $wpdb->get_results($productinfosql);
	foreach($productinfo as $productinfoObj)
	{
		$post_title = $productinfoObj->post_title; 
	}
}
?>

 
 <script>
 function check_enquery_frm()
 {
 	if(document.getElementById('yourname').value == '')
	{
		alert("<?php _e('Please enter your name');?>");
		document.getElementById('yourname').focus();
		return false;
	}
	if(document.getElementById('youremail').value == '')
	{
		alert("<?php _e('Please enter email address');?>");
		document.getElementById('youremail').focus();
		return false;
	}
	if(document.getElementById('frnd_subject').value == '')
	{
		alert("<?php _e('Please enter Subject');?>");
		document.getElementById('frnd_subject').focus();
		return false;
	}
	document.enquiryfrm.submit();
	return true;
 }
 </script>
<?php
}
?>