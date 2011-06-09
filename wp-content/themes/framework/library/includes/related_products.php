<?php
global $General;
$current_post = $post; //take backup of current post
if($General->is_show_related_products())
{
	if(get_option('ptthemes_related_prd_number'))
	{
		$number_of_related_prd = get_option('ptthemes_related_prd_number');
	}else
	{
		$number_of_related_prd = 5;
	}
	$post_array = $General->get_post_array($post->ID,$number_of_related_prd);
	?>
	<div class="realated_product_section clearfix">
    <h3><?php echo RELATED_PRD_TEXT;?></h3>
    <ul class="realated_products thumb_view">
		<?php
        foreach($post_array as $post)
        {
		 ?>
         <li class="relpost"> <div class="content_block">
         <?php
		  $Product->product_listing_li_default($post,$args);
		  ?>
        </div>
          <!-- content block #end -->
        </li>
        <?php
        }
		
        ?>
    </ul>
	</div>
 <?php }?>
 <?php $post = $current_post; //retrive current post info ?>
