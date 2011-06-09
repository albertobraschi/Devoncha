<?php
/*
Template Name: Store Page
*/
?>
<?php
$totalpost_count = 0;
$limit = 1000;
$blogCategoryIdStr = str_replace(',',',-',get_inc_categories("cat_exclude_"));
query_posts('showposts=' . $limit . '&cat='.$blogCategoryIdStr);
if(have_posts())
{
	while(have_posts())
	{
		 the_post();
		$totalpost_count++;
	}
}
//echo $totalpost_count;
if(get_option('ptthemes_storeprd_number'))
{
	$limit = get_option('ptthemes_storeprd_number');
}else
{
	$limit = 16;
} // number of posts per page for store page

$posts_per_page_homepage = $limit;
global $paged;
$blogCategoryIdStr = str_replace(',',',-',get_inc_categories("cat_exclude_"));
query_posts('showposts=' . $limit . '&paged=' . $paged .'&cat='.$blogCategoryIdStr);


include(TEMPLATEPATH . '/library/includes/store.php');
?>