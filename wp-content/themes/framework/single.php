<?php
$blogCategoryIdStr = get_inc_categories("cat_exclude_");
$blogCategoryIdArr = explode(',',$blogCategoryIdStr);

if(have_posts())
{
	while(have_posts())
	{
		the_post();
		$cagInfo = get_the_category();
		$postCatId = $cagInfo[0]->term_id;
		if(!in_array($postCatId,$blogCategoryIdArr))  //DISPLAY PRODUCT
		{
			include(TEMPLATEPATH . '/library/includes/product_detail.php');
			
		}else //DISPLAY BLOG POST
		{
			if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/library/includes/blog_detail.php'))
			{
				include(CHILDTEMPLATEPATH . '/library/includes/blog_detail.php');
			}else
			{
				include(TEMPLATEPATH . '/library/includes/blog_detail.php');
			}			
		}
	}
}
?>
