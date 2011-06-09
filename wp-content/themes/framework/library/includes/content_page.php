<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/content_page_above_title.php'))
{
	include(CHILDTEMPLATEPATH . '/content_page_above_title.php');
}
?>
<h1 class="head">
<?php the_title(); ?>
</h1>
<div class="breadcrumb clearfix">
<?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',''); } ?>
</div>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/content_page_below_title.php'))
{
	include(CHILDTEMPLATEPATH . '/content_page_below_title.php');
}
?>
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
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/content_page_end.php'))
{
	include(CHILDTEMPLATEPATH . '/content_page_end.php');
}
?>