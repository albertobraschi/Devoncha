<h1 class="head">
<?php $catarr = get_the_category(); echo $catarr[0]->name;?>
</h1>
<div class="breadcrumb clearfix">
<?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',''); } ?>
</div>

     <div id="post-<?php the_ID(); ?>" class="posts">
      <div class="post_top clearfix">
             <?php
		   if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/blog_detail_title_above.php'))
			{
				include_once(CHILDTEMPLATEPATH . '/blog_detail_title_above.php');
			}
		   ?>
             <div class="posted_on">
            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?> </a></h2>
             <p class="postmetadata"> Posted by <?php the_author_posts_link(); ?> at <?php the_time('F j, Y') ?> in  <?php the_category(" &amp;"); ?></p>
          </div> <!-- posted on #end --> 
           <?php
		   if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/blog_detail_title_below.php'))
			{
				include_once(CHILDTEMPLATEPATH . '/blog_detail_title_below.php');
			}
		   ?>
          <span class="commentcount"> <a href="<?php the_permalink(); ?>#commentarea">
         <?php comments_number('0 Comments', '1 Comments', '% Comments'); ?>
         </a></span>
          
      </div>
       <?php
	   if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/blog_detail_content_above.php'))
		{
			include_once(CHILDTEMPLATEPATH . '/blog_detail_content_above.php');
		}
	   ?>
      <?php if (( get_post_meta($post->ID,'image', true) ) && (get_option( 'ptthemes_timthumb_all' )) ) { ?>
      <a title="Link to <?php the_title(); ?>" href="<?php the_permalink() ?>"><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "image", $single = true); ?>&amp;h=95&amp;w=95&amp;zc=1&amp;q=80" alt="<?php the_title(); ?>" class="fll" style="margin-right:10px; margin-bottom:10px" /></a>
      <?php } ?>
       <?php the_content(); ?>
        <?php
	   if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/blog_detail_content_below.php'))
		{
			include_once(CHILDTEMPLATEPATH . '/blog_detail_content_below.php');
		}
	   ?>  
      <?php the_tags('<p class="post_bottom"> Tags : ', ', ', ' </p>'); ?> 
    </div>
     <?php
       if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/blog_detail_comment_above.php'))
        {
            include_once(CHILDTEMPLATEPATH . '/blog_detail_comment_above.php');
        }
       ?> 
    <div id="comments">
      <?php comments_template(); ?>
    </div>
    <?php
       if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/blog_detail_comment_below.php'))
        {
            include_once(CHILDTEMPLATEPATH . '/blog_detail_comment_below.php');
        }
       ?> 