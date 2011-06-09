<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/product_listing_page_above_title.php'))
{
	include_once(CHILDTEMPLATEPATH . '/product_listing_page_above_title.php');
}
?>
<h1 class="head" ><?php echo single_cat_title(); ?> </h1> 
    <div class="breadcrumb clearfix">
    <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',''); } ?>
    </div>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/product_listing_page_below_title.php'))
{
	include_once(CHILDTEMPLATEPATH . '/product_listing_page_below_title.php');
}
global $wp_query;
$current_term = $wp_query->get_queried_object();
if($current_term->category_description)
{
	echo '<p class="cat_desc">'.$current_term->category_description.'</p>';	
}
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/product_listing_page_below_cat_desc.php'))
{
	include_once(CHILDTEMPLATEPATH . '/product_listing_page_below_cat_desc.php');
}
?>       
   <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery-latest.js"></script>
   <?php $General->get_product_listing_thumb_view_js('category');?>
  <?php
 if(have_posts())
 {
 ?>
      <a href="#" class="switch_thumb swap"><?php _e('Modo de Visualização');?></a>
      
      
      <ul style="display:block;" class="display <?php echo $General->archive_listing_format();?>">
        <?php
        while(have_posts())
        {
            the_post();
            $Product->product_listing_li($post);
        }
        ?>
      </ul>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/product_listing_page_above_pagination.php'))
{
	include_once(CHILDTEMPLATEPATH . '/product_listing_page_above_pagination.php');
}
?>       <div class="pagination">
        <div class="Navi">
          <?php if (function_exists('wp_pagenavi')) { ?>
          <?php wp_pagenavi(); ?>
          <?php } ?>
        </div>
      </div>
      <?php
 }
 ?>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/product_listing_page_below_pagination.php'))
{
	include_once(CHILDTEMPLATEPATH . '/product_listing_page_below_pagination.php');
}
?> 