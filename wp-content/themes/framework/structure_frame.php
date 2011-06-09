 <?php
if(get_option('ptthemes_blog_detail_design_settings')=='3 column content with left & right sidebar')
{
?>
	<div class="sidebar_l fl" >
	<?php if ( function_exists('dynamic_sidebar') && (dynamic_sidebar('Blog Detail Sidebar Left')) ) { } ?>
    </div> <!-- sidebar left-->
    <div id="content" class="content_3col fl">
    	<?php include (TEMPLATEPATH . "/library/includes/blog_detail_page.php");?>
    </div> <!-- middel column-->
    <div class="sidebar_r fr">
    <?php if ( function_exists('dynamic_sidebar') && (dynamic_sidebar('Blog Detail Sidebar Right')) ) { } ?>
    </div> <!-- 3 column content & with left / right sidebar-->

<?php
}elseif(get_option('ptthemes_inner_design_settings')=='2 column sidebar in right side')
{
?>
    <div id="content" class="content_common_l fl">
    <?php include (TEMPLATEPATH . "/library/includes/blog_detail_page.php");?>
        </div> 
    <div class="sidebar_common fr">
      <div class="sidebar_l fl" >
        <?php if ( function_exists('dynamic_sidebar') && (dynamic_sidebar('Blog Detail Sidebar Left')) ) { } ?>
          </div> <!-- sidebar left-->
        <div class="sidebar_r fr">
            <?php if ( function_exists('dynamic_sidebar') && (dynamic_sidebar('Blog Detail Sidebar Right')) ) { } ?>
        </div>
     </div>   <!-- 2 column sidebar in  right side -->
<?php
}elseif(get_option('ptthemes_inner_design_settings')=='2 column sidebar in left side')
{
?>
    <div id="content" class="content_common_r fr">
    <?php include (TEMPLATEPATH . "/library/includes/blog_detail_page.php");?>
    </div> 
    <div class="sidebar_common fl">
    <div class="sidebar_l fl" >
     <?php if ( function_exists('dynamic_sidebar') && (dynamic_sidebar('Blog Detail Sidebar Left')) ) { } ?>
      </div> <!-- sidebar left-->
    <div class="sidebar_r fr">
        <?php if ( function_exists('dynamic_sidebar') && (dynamic_sidebar('Blog Detail Sidebar Right')) ) { } ?>
    </div>  <!-- 2 column sidebar in  left side -->
<?php	
}elseif(get_option('ptthemes_inner_design_settings')=='Full page')
{
?>
    <div id="content" class="clearfix">
    <?php include (TEMPLATEPATH . "/library/includes/blog_detail_page.php");?>
    </div> <!-- full page -->
<?php
}elseif(get_option('ptthemes_inner_design_settings')=='With Right Sidebar')
{
?>
	<div id="content" class="grid_11 clearfix fl">
	<?php include (TEMPLATEPATH . "/library/includes/blog_detail_page.php");?>
    </div>
    <div id="sidebar" class="grid_4 fr">
    <?php if ( function_exists('dynamic_sidebar') && (dynamic_sidebar('Blog Detail Sidebar Right')) ) { } ?>
    </div><!-- right sidebar -->
<?php
}elseif(get_option('ptthemes_inner_design_settings')=='With Left Sidebar')
{
?>
	<div id="content" class="grid_11 clearfix fr content_right">
	 <?php include (TEMPLATEPATH . "/library/includes/blog_detail_page.php");?>
    </div>
    <div id="sidebar" class="grid_4 sidebar_left fl">
    <?php if ( function_exists('dynamic_sidebar') && (dynamic_sidebar('Blog Detail Sidebar Left')) ) { } ?>
    </div> <!-- Left sidebar -->
<?php
}
?>