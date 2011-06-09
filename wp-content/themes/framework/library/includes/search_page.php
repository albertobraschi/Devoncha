<?php
global $Product;
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/search_page_above_title.php'))
{
	include(CHILDTEMPLATEPATH . '/search_page_above_title.php');
}
?> 
<h1 class="head"><?php _e('Search Results');?></h1>

    <div class="breadcrumb clearfix">
      <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',''); } ?>
    </div>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/search_page_below_title.php'))
{
	include(CHILDTEMPLATEPATH . '/search_page_below_title.php');
}
?>  
 
        <?php if (is_paged()) $is_paged = true; ?>
        <?php if(have_posts()) : ?>
        <?php while(have_posts()) : the_post() ?>
        <div id="post-<?php the_ID(); ?>" class="posts">
          
          
          <div class="post_top clearfix">
            	 <div class="posted_on">
             	<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?> </a></h2>
                 <p class="postmetadata"> Posted by <?php the_author_posts_link(); ?> at <?php the_time('F j, Y') ?> in  <?php the_category(" &amp;"); ?></p>
              </div> <!-- posted on #end --> 
              
              <span class="commentcount"> <a href="<?php the_permalink(); ?>#commentarea">
             <?php comments_number('0 Comments', '1 Comments', '% Comments'); ?>
             </a></span>
              
          </div>
          <?php
          $product_image_arr = $Product->get_product_image($post,'large','',1);
		  ?>
          <?php if ($product_image_arr[0]) { ?>
          <a title="Link to <?php the_title(); ?>" href="<?php the_permalink() ?>"><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $product_image_arr[0]; ?>&amp;h=95&amp;w=95&amp;zc=1&amp;q=80" alt="<?php the_title(); ?>" class="fll" style="margin-right:10px; margin-bottom:10px; float:left;" /></a>
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
        <?php else: ?>
        <div class="posts">
          <h2><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.'); ?></h2>
        </div>
        <?php endif; ?>
        <div class="pagination">
          <?php if (function_exists('wp_pagenavi')) { ?>
          <?php wp_pagenavi(); ?>
          <?php } ?>
        </div>
    <?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/search_page_end.php'))
{
	include(CHILDTEMPLATEPATH . '/search_page_end.php');
}
?> 