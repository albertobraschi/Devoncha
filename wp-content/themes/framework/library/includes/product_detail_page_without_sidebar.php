<?php get_header(); ?>
<?php $Product->get_js_header_prd_detail();?>
<div class="wrapper container_16" >
<div class="clearfix container_border">
  <h1 class="head">
    <?php $catarr = get_the_category(); echo $catarr[0]->name;?>
   </h1>
  <div class="breadcrumb clearfix">
    <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',''); } ?>
  </div>
</div>
<div class="container_16 clearfix ">

<div id="content" class=" clearfix">
    <div class="content_spacer">
      <div class="product clearfix product_inner">
        <div id="photos">
         <?php $Product->show_product_images($post->ID); // display product 6 image if uploaded?>
        </div>
        <div class="product_details">
          <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
            <?php the_title(); ?>
            </a></h3>
          <!-- <p>Qty: <strong><?php // echo $product_qty; ?></strong></p> -->
          <?php
			if($Product->show_addtocart_above_desc()) // add to cart button ABOVE description
			{
			?>
            <div class="product_info clearfix">
            <?php $Product->display_product_price_single($post->ID); //display product price -- regular price and special price ?>
            
            <div class="row size_spacer">
            <?php if($product_size){?>
              <label class="pfield"><?php $themeUI->get_product_att1_title($data);?>:: </label>
              <strong class="fl"><?php echo $product_size; ?></strong> 
             <?php }?>
             <!-- size chart -->
			<?php  $General->show_prd_size_chart($post->ID);?>
            </div>
            
            <?php if($product_color){?>
            <div class="row color_spacer">
              <label class="pfield"><?php $themeUI->get_product_att2_title($data);?>::</label>
              <strong><?php echo $product_color; ?></strong></div>
            <?php }?>
           <?php $Product->show_product_weight($post->ID)?>
           <?php $Product->show_product_model_code($post->ID)?>
           
         <?php include(TEMPLATEPATH . '/library/includes/product_buttons_above.php'); //addtocart,buynow,inquiry and affiliates buttons ?>          
          </div>
          <?php }?>
		  <?php the_content(); ?>
          <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/single_page.js"></script>
		<?php
        if($Product->show_addtocart_below_desc()) // add to cart button below description
        {
            if(get_option('ptthemes_add_to_cart_button_position')=='Above and Below Description')
            {
                $product_size = $Product->get_product_custom_dl($post->ID,'size','size2');
                $product_color = $Product->get_product_custom_dl($post->ID,'color','color2');
            }
        ?>
          <div class="product_info clearfix">
            <?php $Product->display_product_price_single($post->ID); //display product price -- regular price and special price ?>
           
            <div class="row size_spacer">
            <?php if($product_size){?>
              <label class="pfield"><?php $themeUI->get_product_att1_title($data);?>: </label>
              <strong class="fl"><?php echo $product_size; ?></strong> 
             <?php }?>
             <!-- size chart -->
			<?php  $General->show_prd_size_chart($post->ID);?>
            </div>
            
            <?php if($product_color){?>
            <div class="row color_spacer">
              <label class="pfield"><?php $themeUI->get_product_att2_title($data);?>:</label>
              <strong><?php echo $product_color; ?></strong></div>
            <?php }?>
            
			<?php if($product_attribute3){?>
            <div class="row size_spacer">
              <label class="pfield"><?php $themeUI->get_product_att3_title($data);?>:</label>
              <strong><?php echo $product_attribute3; ?></strong></div>
            <?php }?>
            
            <?php if($product_attribute4){?>
            <div class="row size_spacer">
              <label class="pfield"><?php $themeUI->get_product_att4_title($data);?>:</label>
              <strong><?php echo $product_attribute4; ?></strong></div>
            <?php }?>
            
            <?php if($product_attribute5){?>
            <div class="row size_spacer">
              <label class="pfield"><?php $themeUI->get_product_att5_title($data);?>:</label>
              <strong><?php echo $product_attribute5; ?></strong></div>
            <?php }?>
            
            <?php $Product->show_product_weight($post->ID);?>
             <?php $Product->show_product_model_code($post->ID);?>
           <?php include(TEMPLATEPATH . '/library/includes/product_buttons_below.php'); //addtocart,buynow,inquiry and affiliates buttons ?>
          </div>
        <?php }?>
        
        <p class="tags"><?php the_tags(); ?></p>
          <!-- productinfo #end -->
        </div>
        <!-- product inner #end -->
        <ul class="fav_link">
          <?php $Product->show_favourite_link($post);?>
        </ul>
        <div class="fix"></div>
        <?php include(TEMPLATEPATH . '/library/includes/related_products.php');	 ?>
        <div class="fix"></div>
         <?php 
		 if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/library/includes/product_comments.php'))
		{
			include(CHILDTEMPLATEPATH . '/library/includes/product_comments.php');
		}else
		{
			include(TEMPLATEPATH . '/library/includes/product_comments.php'); //product detail page
		}
		 ?>
      </div>
      <!-- content Spacer #end -->
    </div>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/library/js/zoom/jquery.fancybox-1.2.6.css" media="screen" />
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/zoom/jquery.fancybox-1.2.6.pack.js"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
	$("a.zoom").fancybox();
});
</script>
</div>

  </div>
  <!-- container 16-->
</div>
<!-- wrapper #end -->
<?php get_footer(); ?>