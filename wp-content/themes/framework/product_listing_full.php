<?php
/*
Template Name: Product Full Page Listing
*/
?>
<?php get_header(); 
global $Product,$Cart;
?>

<div class="wrapper" >
   
  <div class="container_16 clearfix">
    <div id="content" class="container_16 fl" >
    <h1 class="head">
      <?php the_title(); ?>
    </h1>
    <div class="breadcrumb clearfix">
      <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',''); } ?>
    </div>
    
    
    
      <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery-latest.js"></script>
      <script type="text/javascript">
        $(document).ready(function(){
         
            $("a.switch_thumb").toggle(function(){
              $(this).addClass("swap"); 
              $("ul.display").fadeOut("fast", function() {
                $(this).fadeIn("fast").removeClass("thumb_view");
                 });
              }, function () {
              $(this).removeClass("swap");
              $("ul.display").fadeOut("fast", function() {
                $(this).fadeIn("fast").addClass("thumb_view"); 
                });
            }); 
        
        });
        </script>
      <?php
 if(have_posts())
 {
 ?>
      <a href="#" class="switch_thumb swap">Modo de Visualização</a>
      <ul style="display: block;" class="display thumb_view">
        <?php
        while(have_posts())
        {
            the_post();
            $data = get_post_meta( $post->ID, 'key', true );
            $product_price = $Product->get_product_price($post->ID);
            ?>
        <li class="full">
          <div class="content_block"> <a href="<?php the_permalink() ?>"><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $data[ 'productimage' ]; ?>&amp;h=180&amp;w=218&amp;zc=1&amp;q=80" alt=""  /></a>
            <h3><a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>">
              <?php the_title(); ?>
              </a></h3>
            <div class="content">
              <?php if ( get_option( 'ptthemes_postcontent_full' )) {
									the_content();
                                	} else {
                                    the_excerpt();
                                } ?>
            </div>
            <p class="price" ><?php echo $product_price;?> </p>
            <div class="viewdetails"> <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">Ver Detalhes &raquo;</a> 
            
             <span id="addtocartformspan">
              <?php if($Cart->is_product_in_cart($post->ID)){echo '&nbsp;&nbsp; Already in the cart';}?>
              </span> </div>
          </div>
          <!-- content block #end -->
        </li>
        <?php
        }
        ?>
      </ul>
      <div class="clearfix"></div>
      <div class="pagination">
        <?php if (function_exists('wp_pagenavi')) { ?>
        <?php wp_pagenavi(); ?>
        <?php } ?>
      </div>
      <?php
 }
 ?>
      <!-- pagination #end -->
    
    <?php // get_sidebar(); ?>
  </div>
  <!-- container 16-->
</div>
<!-- wrapper #end -->
<?php get_footer(); ?>
