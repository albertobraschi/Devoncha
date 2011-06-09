<?php
$lkey = $_REQUEST['lkey'];
$aid = $_REQUEST['aid'];
$affiliate_links = get_option('affiliate_links');
if($affiliate_links && $lkey)
{
	foreach($affiliate_links as $key=>$affiliate_links_Obj)
	{
		if($affiliate_links_Obj['link_key'] == $lkey)
		{
			$affiliate_settings = get_option('affiliate_cookie_lifetime');
			if($affiliate_settings>0)
			{
				$alive_time = $affiliate_settings* 24 * 60 * 60;
			}
			else
			{
				$alive_time  = 1 * 24 * 60 * 60;
			}
			
			$settings = $aid.'|'.$lkey;
			$affiliate_cookie_lifetime = time() + apply_filters('comment_cookie_lifetime', $alive_time);
			setcookie( 'affiliate-settings', $settings, $affiliate_cookie_lifetime, SITECOOKIEPATH,COOKIE_DOMAIN );
			wp_redirect($affiliate_links_Obj['link_url']);
			exit;
		}
	}
}
if($_REQUEST['report_detail'])
{
	include_once(TEMPLATEPATH . '/library/includes/affiliates/affiliate_sale_report.php');
	exit;
}
if($_REQUEST['report_export'])
{
	include_once(TEMPLATEPATH . '/library/includes/affiliates/export_report.php');
	exit;
}
?>