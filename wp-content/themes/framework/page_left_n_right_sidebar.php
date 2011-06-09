<?php
/*
Template Name: Page Left & Right Sidebar
*/
?>
<?php get_header(); ?>

<div class="wrapper" >
   
  <div class="container_16 clearfix">

	
    
   
   <div class="sidebar_l fl" >
 	 <?php if ( function_exists('dynamic_sidebar') ) { // Show on the front page ?>
       <?php dynamic_sidebar('Front Page Middle Content'); ?>
      <?php } ?>
      </div> <!-- sidebar left-->
   
   
   
    <div id="content" class="content_3col fl">
    
     <h1 class="head">
      <?php the_title(); ?>
    </h1>
    <div class="breadcrumb clearfix">
      <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',''); } ?>
    </div>
      
        <?php if(have_posts()) : ?>
        <?php while(have_posts()) : the_post() ?>
        <?php $pagedesc = get_post_meta($post->ID, 'pagedesc', $single = true); ?>
        <div id="post-<?php the_ID(); ?>" >
          <div class="entry">
            <?php the_content(); ?>
          </div>
        </div>
        <!--/post-->
        <?php endwhile; else : ?>
        <div class="posts">
          <div class="entry-head">
            <h2><?php echo get_option('ptthemes_404error_name'); ?></h2>
          </div>
          <div class="entry-content">
            <p><?php echo get_option('ptthemes_404solution_name'); ?></p>
          </div>
        </div>
        <?php endif; ?>
      
    </div>
    <!-- content-in #end -->
 
 
 	<div class="sidebar_r fr">
    	 <?php if ( function_exists('dynamic_sidebar') ) { // Show on the front page ?>
      <?php dynamic_sidebar('Front Page Sidebar Right'); ?>
      <?php } ?>
    </div>
 
 
  </div>
  <!-- container 16-->
</div>
<!-- wrapper #end -->
<?php get_footer(); ?>
