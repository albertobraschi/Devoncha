<?php
/*
Template Name: tags Listing Page
*/
?>

          
	<?php if (is_category()) { ?>
    <h1  class="head" ><?php echo single_cat_title(); ?> </h1>
    <?php } elseif (is_day()) { ?>
    <h1  class="head">
      <?php the_time('F jS, Y'); ?>
    </h1>
    <?php } elseif (is_month()) { ?>
    <h1  class="head">
      <?php the_time('F, Y'); ?>
    </h1>
    <?php } elseif (is_year()) { ?>
    <h1  class="head">
      <?php the_time('Y'); ?>
    </h1>
    <?php } elseif (is_author()) { ?>
    <h1  class="head"><?php echo $curauth->nickname; ?> </h1>
    <?php } elseif (is_tag()) { ?>
    <h1  class="head"> <?php echo single_tag_title('', true); ?> </h1>
    <?php } elseif ($_GET['ptype']=='Blog') { ?>
    <h1  class="head"><?php _e(BLOG_TEXT);?></h1>
    <?php } ?>
    <div class="breadcrumb clearfix">
      <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',  ' &raquo; ' . $_GET['ptype']); } ?>
    </div>
      
      
        <?php if(have_posts()) : ?>
        <?php while(have_posts()) : the_post() ?>
        <div id="post-<?php the_ID(); ?>" class="posts">
          
          
          <div class="post_top clearfix">
            	 <div class="posted_on">
             	<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
             	 <?php the_title(); ?> </a></h2>
                 <p class="postmetadata"> Posted by <?php the_author_posts_link(); ?> at <?php the_time('F j, Y') ?> in  <?php the_category(" &amp;"); ?></p>
              </div> <!-- posted on #end --> 
              
              <span class="commentcount"> <a href="<?php the_permalink(); ?>#commentarea">
             <?php comments_number('0 Comments', '1 Comments', '% Comments'); ?>
             </a></span>
              
          </div>
          
          <?php if (( get_post_meta($post->ID,'image', true) ) && (get_option( 'ptthemes_timthumb_all' )) ) { ?>
          <a title="Link to <?php the_title(); ?>" href="<?php the_permalink() ?>"><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "image", $single = true); ?>&amp;h=95&amp;w=95&amp;zc=1&amp;q=80" alt="<?php the_title(); ?>" class="fll" style="margin-right:10px; margin-bottom:10px" /></a>
          <?php } ?>
          <?php if ( get_option( 'ptthemes_postcontent_full' )) { ?>
          <?php the_content(); ?>
          <?php } else { ?>
          <?php the_excerpt(); ?>
          <?php } ?>
         
          
           	<?php the_tags('<p class="post_bottom"> Tags : ', ', ', ' </p>'); ?>  
           
        </div>
        <!--/post-->
        <?php endwhile; ?>
        <div class="pagination">
          <?php if (function_exists('wp_pagenavi')) { ?>
          <?php wp_pagenavi(); ?>
          <?php } ?>
        </div>
        <?php endif; ?>