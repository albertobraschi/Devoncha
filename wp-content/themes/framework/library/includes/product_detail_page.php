<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/product_detail_page_above_title.php'))
{
	include_once(CHILDTEMPLATEPATH . '/product_detail_page_above_title.php');
}
?>
<h1 class="head"><?php $catarr = get_the_category(); echo $catarr[0]->name;?></h1>   
  <div class="breadcrumb clearfix">
    <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',''); } ?>
  </div>
 <?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/product_detail_page_below_title.php'))
{
	include_once(CHILDTEMPLATEPATH . '/product_detail_page_below_title.php');
}
?>
   <div class="product clearfix product_inner">
    <div id="photos">
     <?php if($Product->show_product_images($post)) // display product 6 image if uploaded
    {
    }else
    {
        echo '<style type="text/css">.content_full .product_details_inner {width:auto;}</style>';	
    }
     ?>
     </div>
    <div class="product_details product_details_inner">
    <?php
       if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/product_detail_above_title.php'))
        {
            include_once(CHILDTEMPLATEPATH . '/product_detail_above_title.php');
        }
       ?> 
      <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
         <?php
       if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/product_detail_below_title.php'))
        {
            include_once(CHILDTEMPLATEPATH . '/product_detail_below_title.php');
        }
       ?> 
        <?php
        if($Product->show_addtocart_above_desc()) // add to cart button ABOVE description
        {
        ?>
        <?php $Product->display_product_price_single($post->ID); //display product price -- regular price and special price ?>
        <div class="row">
        <?php if($product_size){?>
          <label class="pfield"><?php $themeUI->get_product_att1_title($data);?>: </label>
          <strong class="fl"><?php echo $product_size; ?></strong> 
         <?php }?>
         <!-- size chart -->
        <?php  $General->show_prd_size_chart($post->ID);?>
        </div>
        
         <?php if($product_color){?>
        <div class="row">
          <label class="pfield"><?php $themeUI->get_product_att2_title($data);?>:</label>
          <strong><?php echo $product_color; ?></strong></div>
        <?php }?>
         <!-- size chart -->
       <?php if($product_attribute3){?>
        <div class="row">
          <label class="pfield"><?php $themeUI->get_product_att3_title($data);?>:</label>
          <strong><?php echo $product_attribute3; ?></strong></div>
        <?php }?>
        <?php if($product_attribute4){?>
        <div class="row">
          <label class="pfield"><?php $themeUI->get_product_att4_title($data);?>:</label>
          <strong><?php echo $product_attribute4; ?></strong></div>
        <?php }?>
        
        <?php if($product_attribute5){?>
        <div class="row">
          <label class="pfield"><?php $themeUI->get_product_att5_title($data);?>:</label>
          <strong><?php echo $product_attribute5; ?></strong></div>
        <?php }?>
         <?php if($product_attribute6){?>
        <div class="row">
          <label class="pfield"><?php $themeUI->get_product_att6_title($data);?>:</label>
          <strong><?php echo $product_attribute6; ?></strong></div>
        <?php }?>
         <?php if($product_attribute7){?>
        <div class="row">
          <label class="pfield"><?php $themeUI->get_product_att7_title($data);?>:</label>
          <strong><?php echo $product_attribute7; ?></strong></div>
        <?php }?>
         <?php if($product_attribute8){?>
        <div class="row">
          <label class="pfield"><?php $themeUI->get_product_att8_title($data);?>:</label>
          <strong><?php echo $product_attribute8; ?></strong></div>
        <?php }?>
         <?php if($product_attribute9){?>
        <div class="row">
          <label class="pfield"><?php $themeUI->get_product_att9_title($data);?>:</label>
          <strong><?php echo $product_attribute9; ?></strong></div>
        <?php }?>
         <?php if($product_attribute10){?>
        <div class="row">
          <label class="pfield"><?php $themeUI->get_product_att10_title($data);?>:</label>
          <strong><?php echo $product_attribute10; ?></strong></div>
        <?php }?>
         <?php
       if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/product_detail_below_attributes.php'))
        {
            include_once(CHILDTEMPLATEPATH . '/product_detail_below_attributes.php');
        }
       ?> 
       <?php $Product->show_product_weight($post->ID)?>
       <?php $Product->show_product_model_code($post->ID)?>
       <?php
       if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/product_detail_above_cart.php'))
        {
            include_once(CHILDTEMPLATEPATH . '/product_detail_above_cart.php');
        }
       ?>
    <div class="clearfix">  <?php include_once(TEMPLATEPATH . '/library/includes/product_buttons_above.php'); //addtocart,buynow,inquiry and affiliates buttons ?> </div>          
      <?php
       if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/product_detail_below_cart.php'))
        {
            include_once(CHILDTEMPLATEPATH . '/product_detail_below_cart.php');
        }
       ?>
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
            $product_attribute3 = $Product->get_product_custom_dl($post->ID,'attribute3','attribute32','',$themeUI->get_product_att3_title($data,0));
            $product_attribute4 = $Product->get_product_custom_dl($post->ID,'attribute4','attribute42','',$themeUI->get_product_att4_title($data,0));
            $product_attribute5 = $Product->get_product_custom_dl($post->ID,'attribute5','attribute52','',$themeUI->get_product_att5_title($data,0));
			$product_attribute6 = $Product->get_product_custom_dl($post->ID,'attribute6','attribute62','',$themeUI->get_product_att6_title($data,0));
			$product_attribute7 = $Product->get_product_custom_dl($post->ID,'attribute7','attribute72','',$themeUI->get_product_att7_title($data,0));
			$product_attribute8 = $Product->get_product_custom_dl($post->ID,'attribute8','attribute82','',$themeUI->get_product_att8_title($data,0));
			$product_attribute9 = $Product->get_product_custom_dl($post->ID,'attribute9','attribute92','',$themeUI->get_product_att9_title($data,0));
			$product_attribute10 = $Product->get_product_custom_dl($post->ID,'attribute10','attribute102','',$themeUI->get_product_att10_title($data,0));

        }
    ?>
        <?php $Product->display_product_price_single($post->ID); //display product price -- regular price and special price ?>
        <div class="row">
        <?php if($product_size){?>
          <label class="pfield"><?php $themeUI->get_product_att1_title($data);?>: </label>
          <strong class="fl"><?php echo $product_size; ?></strong> 
         <?php }?>
         <!-- size chart -->
        <?php  $General->show_prd_size_chart($post->ID);?>
        </div>
        
         <?php if($product_color){?>
        <div class="row">
          <label class="pfield"><?php $themeUI->get_product_att2_title($data);?>:</label>
          <strong><?php echo $product_color; ?></strong></div>
        <?php }?>
        
         <!-- size chart -->
       <?php if($product_attribute3){?>
        <div class="row">
          <label class="pfield"><?php $themeUI->get_product_att3_title($data);?>:</label>
          <strong><?php echo $product_attribute3; ?></strong></div>
        <?php }?>
        
        <?php if($product_attribute4){?>
        <div class="row">
          <label class="pfield"><?php $themeUI->get_product_att4_title($data);?>:</label>
          <strong><?php echo $product_attribute4; ?></strong></div>
        <?php }?>            
        <?php if($product_attribute5){?>
        <div class="row">
          <label class="pfield"><?php $themeUI->get_product_att5_title($data);?>:</label>
          <strong><?php echo $product_attribute5; ?></strong></div>
        <?php }?> 
		<?php if($product_attribute6){?>
        <div class="row">
          <label class="pfield"><?php $themeUI->get_product_att6_title($data);?>:</label>
          <strong><?php echo $product_attribute6; ?></strong></div>
        <?php }?>
         <?php if($product_attribute7){?>
        <div class="row">
          <label class="pfield"><?php $themeUI->get_product_att7_title($data);?>:</label>
          <strong><?php echo $product_attribute7; ?></strong></div>
        <?php }?>
         <?php if($product_attribute8){?>
        <div class="row">
          <label class="pfield"><?php $themeUI->get_product_att8_title($data);?>:</label>
          <strong><?php echo $product_attribute8; ?></strong></div>
        <?php }?>
         <?php if($product_attribute9){?>
        <div class="row">
          <label class="pfield"><?php $themeUI->get_product_att9_title($data);?>:</label>
          <strong><?php echo $product_attribute9; ?></strong></div>
        <?php }?>
         <?php if($product_attribute10){?>
        <div class="row">
          <label class="pfield"><?php $themeUI->get_product_att10_title($data);?>:</label>
          <strong><?php echo $product_attribute10; ?></strong></div>
        <?php }?> 
         <?php
       if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/product_detail_below_attributes.php'))
        {
            include_once(CHILDTEMPLATEPATH . '/product_detail_below_attributes.php');
        }
       ?>          
         <?php $Product->show_product_model_code($post->ID);?>             
         <?php $Product->show_product_weight($post->ID);?>
          <?php
       if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/product_detail_above_cart.php'))
        {
            include_once(CHILDTEMPLATEPATH . '/product_detail_above_cart.php');
        }
       ?>
        <?php include(TEMPLATEPATH . '/library/includes/product_buttons_below.php'); //addtocart,buynow,inquiry and affiliates buttons ?>      
         <?php
       if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/product_detail_below_cart.php'))
        {
            include_once(CHILDTEMPLATEPATH . '/product_detail_below_cart.php');
        }
       ?>        
        <?php }?>            
       <?php if(function_exists('the_ratings')) { the_ratings(); } ?>            
        
          <?php the_tags('<div class="row">  Tags :', ', ', '</div> '); ?>            
        
    </div> <!-- product inner #end -->
   
    <ul class="fav_link fav_link_inner clearfix">
      <?php $Product->show_favourite_link($post);?>
    </ul>
     <?php
       if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/related_products_above.php'))
        {
            include_once(CHILDTEMPLATEPATH . '/related_products_above.php');
        }
       ?>   
    <div class="fix"></div>
    <?php include(TEMPLATEPATH . '/library/includes/related_products.php');	 ?>
    <div class="fix"></div>
     <?php
       if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/related_products_below.php'))
        {
            include_once(CHILDTEMPLATEPATH . '/related_products_below.php');
        }
       ?>  
    <div class="comments_inner">
     <?php 
     if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/product_comments.php'))
    {
        include(CHILDTEMPLATEPATH . '/product_comments.php');
    }else
    {
        include(TEMPLATEPATH . '/library/includes/product_comments.php'); //product detail page
    }
     ?>
    </div>     
</div>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/zoom/jquery.fancybox-1.2.6.pack.js"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
	$("a.zoom").fancybox();
});
</script>
 <?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/product_detail_page_end.php'))
{
	include_once(CHILDTEMPLATEPATH . '/product_detail_page_end.php');
}
?>