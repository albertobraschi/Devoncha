<?php
/*
Template Name: Archives Page
*/
?>
<?php get_header(); ?>

<div id="wrapper"  class="clearfix">
<div id="page" class="container_16 clearfix " > 
	<div id="content" class="grid_11 clearfix fr content_right">
     
     	 <h1 class="head"> <?php the_title(); ?> </h1>
        <div class="breadcrumb clearfix"> <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',''); } ?> </div>
     
        
        
           
            <ul class="archive_list clearfix">
              <?php query_posts('showposts=60'); ?>
              <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
              <li > <a href="<?php the_permalink() ?>">
                <?php the_title(); ?>
                </a>    <?php the_time('M j Y') ?> - <?php echo $post->comment_count ?> </li>
              <?php endwhile; endif; ?>
            </ul>
          
          <!--/arclist -->
        
      
    </div>
    <!-- content-in #end -->
    
    <div id="sidebar" class="grid_4 sidebar_left fl">
     <?php if ( function_exists('dynamic_sidebar') && (is_sidebar_active(13)) ) { // Show on the front page ?>
				<?php dynamic_sidebar(13); ?>  
         <?php } ?>
  	
    </div> <!-- Left sidebar -->
	</div> <!-- page #end -->
</div><!-- wrapper #end -->
 <?php get_footer(); ?>
