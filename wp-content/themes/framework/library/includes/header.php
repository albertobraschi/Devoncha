<div id="header" >
 
  <div id="header-in" class="container_16 clearfix">
  
  <?php if ( function_exists('dynamic_sidebar') ) { // Header Top Navigation Menu ?>
	 		<div class="top_navigation clearfix">	<?php dynamic_sidebar('Header Top Navigation'); ?> </div>
	 <?php } ?>
     
     
    <div class="header_left">
      <?php if ( get_option('ptthemes_show_blog_title') ) { ?>
      <?php if ( get_option('ptthemes_logo_url') ) { ?>
      <a href="<?php echo get_option('home'); ?>/"><img src="<?php echo get_option('ptthemes_logo_url'); ?>" alt="<?php bloginfo('name'); ?>" class="photo"  /></a>
      <?php } else { ?>
      <?php } ?>
      <div class="blog-title"><a href="<?php echo get_option('home'); ?>/">
        <?php bloginfo('name'); ?>
        </a> </div>
      <p class="blog-description">
        <?php bloginfo('description'); ?>
      </p>
      <?php } else { ?>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/images/logo.png'))
{
	$logo_image = get_stylesheet_directory_uri().'/images/logo.png';
}else
{
	$logo_image = get_bloginfo('template_directory').'/images/logo.png';
}
?>
      <a href="<?php echo get_option('home'); ?>/"><img src="<?php if ( get_option('ptthemes_logo_url') <> "" ) { echo get_option('ptthemes_logo_url'); } else { echo $logo_image; } ?>" alt="<?php bloginfo('name'); ?>" class="logo"  /></a>
      <?php } ?>
    </div>
    <!--/logo-->
   <?php if ( function_exists('dynamic_sidebar') ) { // Header Sub Navigation Menu ?>
	<div class="header_right" ><?php dynamic_sidebar('Header Right Settings'); ?> </div>
<?php }?>   
    
  </div>
</div>
<!-- header #end -->

 <?php 
 // Header Main Navigation Menu  START
?>
   <div class="container_16 main_navi" >
    <?php
 		global $wpdb;
 		$blogcatname = get_option('ptthemes_blogcategory');
 		$catid = $wpdb->get_var("SELECT term_ID FROM $wpdb->terms WHERE name = '$blogcatname'");
   		 ?>
    <ul>
      <?php $General->show_home_link_header_nav();?>
	  <?php $General->show_store_link_header_nav();?>
      <?php $General->show_blog_link_header_nav(); ?>
	  <?php $General->show_category_header_nav();?>
	  <?php $General->show_pages_header_nav(); ?>
    </ul>
    <?php if ( function_exists('dynamic_sidebar')) { // Header Main Navigation Menu ?>
	 <?php dynamic_sidebar('Header Main Navigation'); ?>
	 <?php }?>
    <?php
    if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/header_nav_right.php'))
	{
		include(CHILDTEMPLATEPATH . '/header_nav_right.php');
	}
	?>
 </div>
 <?php
  // Header Main Navigation Menu  END
 ?>
 
<?php if ( function_exists('dynamic_sidebar')) { // Header Sub Navigation Menu ?>
 	<div class="category_navi_outer"><div class="category_navi clearfix" ><?php dynamic_sidebar('Header Sub Navigation'); ?> </div> </div>
<?php }?>