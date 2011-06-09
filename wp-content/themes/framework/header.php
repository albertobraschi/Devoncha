<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<title>
<?php if ( is_home() ) { ?>
<?php bloginfo('description'); ?>
&nbsp;|&nbsp;
<?php bloginfo('name'); ?>
<?php } ?>
<?php if ( is_search() ) { ?>
Search Results&nbsp;|&nbsp;
<?php bloginfo('name'); ?>
<?php } ?>
<?php if ( is_author() ) { ?>
Author Archives&nbsp;|&nbsp;
<?php bloginfo('name'); ?>
<?php } ?>
<?php if ( is_single() ) { ?>
<?php wp_title(''); ?>
<?php } ?>
<?php if ( is_page() ) { ?>
<?php wp_title(''); ?>
<?php } ?>
<?php if ( is_category() ) { ?>
<?php single_cat_title(); ?>
&nbsp;|&nbsp;
<?php bloginfo('name'); ?>
<?php } ?>
<?php if ( is_month() ) { ?>
<?php the_time('F'); ?>
&nbsp;|&nbsp;
<?php bloginfo('name'); ?>
<?php } ?>
<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?>
<?php bloginfo('name'); ?>
&nbsp;|&nbsp;Tag Archive&nbsp;|&nbsp;
<?php single_tag_title("", true); } } ?>
</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php if (is_home()) { ?>
<?php if ( get_option('ptthemes_meta_description') <> "" ) { ?>
<meta name="description" content="<?php echo stripslashes(get_option('ptthemes_meta_description')); ?>" />
<?php } ?>
<?php if ( get_option('ptthemes_meta_keywords') <> "" ) { ?>
<meta name="keywords" content="<?php echo stripslashes(get_option('ptthemes_meta_keywords')); ?>" />
<?php } ?>
<?php if ( get_option('ptthemes_meta_author') <> "" ) { ?>
<meta name="author" content="<?php echo stripslashes(get_option('ptthemes_meta_author')); ?>" />
<?php } ?>
<?php } ?>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery-1.3.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />

<link href="<?php bloginfo('template_directory'); ?>/library/css/common.css" rel="stylesheet" type="text/css" />


<?php if ( get_option('ptthemes_favicon') <> "" ) { ?>
<link rel="icon" type="image/png" href="<?php echo get_option('ptthemes_favicon'); ?>" />
<?php } ?>
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('ptthemes_feedburner_url') <> "" ) { echo get_option('ptthemes_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/library/css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/library/js/zoom/jquery.fancybox-1.2.6.css" />
<!--[if lt IE 7]>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/pngfix.js"></script>
<![endif]-->
<?php if ( get_option('ptthemes_scripts_header') <> "" ) { echo stripslashes(get_option('ptthemes_scripts_header')); } ?>
<!-- For Menu -->

<?php if(CHILDTEMPLATEPATH  && file_exists(CHILDTEMPLATEPATH . '/custom.css')) { ?> 
    <link href="<?php bloginfo('stylesheet_directory'); ?>/custom.css" rel="stylesheet" type="text/css">
   <?php } else { ?> 
    <link href="<?php bloginfo('template_directory'); ?>/custom.css" rel="stylesheet" type="text/css"> <?php }?>

<?php wp_enable_cufon_font();?>
<?php wp_head(); ?>

<?php if ( get_option('ptthemes_customcss') ) { ?>
<?php if(CHILDTEMPLATEPATH  && file_exists(CHILDTEMPLATEPATH . '/custom.css')) { ?> 
    <link href="<?php bloginfo('stylesheet_directory'); ?>/custom.css" rel="stylesheet" type="text/css">
   <?php } else { ?> 
    <link href="<?php bloginfo('template_directory'); ?>/custom.css" rel="stylesheet" type="text/css"> <?php }?>
<?php } ?>




</head>
<body>
<?php
global $General,$Cart,$Product,$themeUI;
$userInfo = $General->getLoginUserInfo();
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/header_page.php'))
{
	include(CHILDTEMPLATEPATH . '/header_page.php');
}else
{
	include(TEMPLATEPATH . '/library/includes/header.php');
}
?>