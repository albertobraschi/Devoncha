<div id="wrapper"  class="clearfix">
		
<?php 
if($header_file_fullpath)
{
	include_once ($header_file_fullpath);
}else
{
	if ( function_exists('dynamic_sidebar') && (dynamic_sidebar($header_widget_option)) ) { }
}?>

<div id="page" class="container_16 clearfix " > 
<?php
global $General,$Product,$Cart,$wpdb,$post;
$admin_layout_option = get_option($admin_layout_setting_option);
if($admin_layout_option=='3 column content with left & right sidebar')
{
?>
	<div class="sidebar_l fl" >
	<?php 
	if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/sidebar_left.php'))
	{
		include(CHILDTEMPLATEPATH . '/sidebar_left.php');
	}elseif ( function_exists('dynamic_sidebar') && (dynamic_sidebar($sidebar_left_widget_option)) ) { } ?>
	</div> <!-- sidebar left-->
	<div id="content" class="content_3col fl">
		<?php 
		if($middle_content_file_fullpath)
		{
			include_once ($middle_content_file_fullpath);
		}else
		{
			if ( function_exists('dynamic_sidebar') && (dynamic_sidebar($middle_content_widget_option)) ) { }
		}?>
	</div> <!-- middel column-->
	<div class="sidebar_r fr">
	<?php if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/sidebar_right.php'))
		{
			include(CHILDTEMPLATEPATH . '/sidebar_right.php');
		}elseif ( function_exists('dynamic_sidebar') && (dynamic_sidebar($sidebar_right_widget_option)) ) { } ?>
	</div> <!-- 3 column content & with left / right sidebar-->

<?php
}elseif($admin_layout_option=='2 column sidebar in right side')
{
?>
	<div id="content" class="content_common_l fl">
	<?php 
		if($middle_content_file_fullpath)
		{
			include_once ($middle_content_file_fullpath);
		}else
		{
			if ( function_exists('dynamic_sidebar') && (dynamic_sidebar($middle_content_widget_option)) ) { }
		}?>
		</div> 
	<div class="sidebar_common fr">
	  <div class="sidebar_l fl" >
		<?php 
		if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/sidebar_left.php'))
		{
			include(CHILDTEMPLATEPATH . '/sidebar_left.php');
		}else
		if ( function_exists('dynamic_sidebar') && (dynamic_sidebar($sidebar_left_widget_option)) ) { } ?>
		  </div> <!-- sidebar left-->
		<div class="sidebar_r fr">
			<?php if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/sidebar_right.php'))
		{
			include(CHILDTEMPLATEPATH . '/sidebar_right.php');
		}elseif ( function_exists('dynamic_sidebar') && (dynamic_sidebar($sidebar_right_widget_option)) ) { } ?>
		</div>
	 </div>   <!-- 2 column sidebar in  right side -->
<?php
}elseif($admin_layout_option=='2 column sidebar in left side')
{
?>
	<div id="content" class="content_common_r fr">
	<?php 
		if($middle_content_file_fullpath)
		{
			include_once ($middle_content_file_fullpath);
		}else
		{
			if ( function_exists('dynamic_sidebar') && (dynamic_sidebar($middle_content_widget_option)) ) { }
		}?>
	</div> 
	<div class="sidebar_common fl">
	<div class="sidebar_l fl" >
	 <?php if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/sidebar_left.php'))
		{
			include(CHILDTEMPLATEPATH . '/sidebar_left.php');
		}elseif ( function_exists('dynamic_sidebar') && (dynamic_sidebar($sidebar_left_widget_option)) ) { } ?>
	  </div> <!-- sidebar left-->
	<div class="sidebar_r fr">
		<?php if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/sidebar_right.php'))
		{
			include(CHILDTEMPLATEPATH . '/sidebar_right.php');
		}elseif ( function_exists('dynamic_sidebar') && (dynamic_sidebar($sidebar_right_widget_option)) ) { } ?>
	</div>  <!-- 2 column sidebar in  left side -->
    </div>
<?php	
}elseif($admin_layout_option=='Full page')
{
?>
	<div id="content" class="clearfix content_full">
	<?php 
		if($middle_content_file_fullpath)
		{
			include_once ($middle_content_file_fullpath);
		}else
		{
			if ( function_exists('dynamic_sidebar') && (dynamic_sidebar($middle_content_widget_option)) ) { }
		}?>
	</div> <!-- full page -->
<?php
}elseif($admin_layout_option=='With Left Sidebar')
{
?>
	<div id="content" class="grid_11 clearfix fr content_right">
	 <?php 
		if($middle_content_file_fullpath)
		{
			include_once ($middle_content_file_fullpath);
		}else
		{
			if ( function_exists('dynamic_sidebar') && (dynamic_sidebar($middle_content_widget_option)) ) { }
		}?>
	</div>
	<div id="sidebar" class="grid_4 sidebar_left fl">
	<?php if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/sidebar_left.php'))
		{
			include(CHILDTEMPLATEPATH . '/sidebar_left.php');
		}elseif ( function_exists('dynamic_sidebar') && (dynamic_sidebar($sidebar_left_widget_option)) ) { } ?>
	</div> <!-- Left sidebar -->
<?php
}else //elseif($admin_layout_option=='With Left Sidebar')
{
?>
	<div id="content" class="grid_11 clearfix fl content_left">
	<?php 
		if($middle_content_file_fullpath)
		{
			include_once ($middle_content_file_fullpath);
		}else
		{
			if ( function_exists('dynamic_sidebar') && (dynamic_sidebar($middle_content_widget_option)) ) { }
		}?>
	</div>
	<div id="sidebar" class="grid_4 fr">
	<?php if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/sidebar_right.php'))
		{
			include(CHILDTEMPLATEPATH . '/sidebar_right.php');
		}elseif ( function_exists('dynamic_sidebar') && (dynamic_sidebar($sidebar_right_widget_option)) ) { } ?>
	</div><!-- right sidebar -->
<?php
}
?>
	</div> <!-- page #end -->
</div><!-- wrapper #end -->