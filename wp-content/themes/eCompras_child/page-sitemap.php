<?php
/*
Template Name: Sitemap Page
*/
?>
<?php get_header(); ?>
<div id="wrapper"  class="clearfix">
<div id="page" class="container_16 clearfix " > 
	<div id="content" class="grid_11 clearfix fr content_right">

    <h1 class="head"><?php the_title(); ?></h1>
  
  <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('<div class="breadcrumb">','</div>'); } ?>

   <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery.js"></script>	 

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/contact_us_validation.js"></script>
<ul>
    <div class="sitemap_col fl">
     
     	<h4>Pages :</h4>
       <ul class="archive_list">
          <?php wp_list_pages('title_li='); ?>
        </ul>
        <!--/arclist -->
        
        
        <h4>Latest Posts:</h4>
     	<ul class="archive_list">
          <?php $archive_query = new WP_Query('showposts=60');
		                        
								while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
          <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
            <?php the_title(); ?>
            </a> <strong>
            <?php comments_number('0', '1', '%'); ?>
            </strong></li>
          <?php endwhile; ?>
        </ul>
        <!--/arclist -->
        </div>  <!-- first col #end -->
        
        <div class="sitemap_col fr">
        <h4>Monthly Archives:</h4>
       <ul class="archive_list">
          <?php wp_get_archives('type=monthly'); ?>
        </ul>
        
         <h4>Categories:</h4>
        <ul class="archive_list">
          <?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>
        </ul>
        
        
        <h4>RSS Feed:</h4>
        <ul class="archive_list">
          <li><a href="<?php bloginfo('rdf_url'); ?>" title="RDF/RSS 1.0 feed">RDF / RSS 1.0 feed</a></li>
          <li><a href="<?php bloginfo('rss_url'); ?>" title="RSS 0.92 feed">RSS 0.92 feed</a></li>
          <li><a href="<?php bloginfo('rss2_url'); ?>" title="RSS 2.0 feed">RSS 2.0 feed</a></li>
          <li><a href="<?php bloginfo('atom_url'); ?>" title="Atom feed">Atom feed</a></li>
        </ul>
        </div>
        
        
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