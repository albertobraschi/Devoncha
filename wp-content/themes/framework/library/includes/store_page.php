<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/store_page_above_title.php'))
{
	include_once(CHILDTEMPLATEPATH . '/store_page_above_title.php');
}
?>
<h1 class="head">
 <?php _e('Store');?>
</h1>
<div class="breadcrumb clearfix">
  <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',  ' &raquo; ' . $_GET['ptype']); } ?>
</div>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/store_page_below_title.php'))
{
	include_once(CHILDTEMPLATEPATH . '/store_page_below_title.php');
}
?>   
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery-latest.js"></script>
<?php $General->get_product_listing_thumb_view_js('store');?>
<?php
if(have_posts())
{
?>
  <a href="#" class="switch_thumb swap"><?php _e('Modo de Visualização');?></a>
  <ul style="display: block;" class="display <?php echo $General->all_product_listing_format();?> category_list">
    <?php
    while(have_posts())
    {
        the_post();
        $Product->product_listing_li($post);
    }
    ?>
  </ul>
  
  <?php
}
?>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/store_page_above_pagination.php'))
{
	include_once(CHILDTEMPLATEPATH . '/store_page_above_pagination.php');
}
?>
    <div class="pagination">
    
      <?php if (function_exists('wp_pagenavi')) { ?>
      <?php wp_pagenavi(); ?>
      <?php } ?>
   
  </div>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/store_page_below_pagination.php'))
{
	include_once(CHILDTEMPLATEPATH . '/store_page_below_pagination.php');
}
?>