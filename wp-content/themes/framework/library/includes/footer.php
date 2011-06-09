<div class="fix"></div>
<div id="bottom" >
  <div class="bottom-in container_12 clearfix">
    <div class="grid_4 fl widget">
      <div class="widget-spot" >
        <?php dynamic_sidebar('Footer Widget 1');  ?>
      </div>
      <!-- widget #end -->
    </div>
    <!-- grid #end -->
    <div class="grid_4 fl ">
      <div class="widget-spot bottom_spacer">
        <?php dynamic_sidebar('Footer Widget 2');  ?>
      </div>
      <!-- widget #end -->
    </div>
    <!-- grid #end -->
    <div class="grid_4 fr widget">
      <div class="widget-spot">
        <?php dynamic_sidebar('Footer Widget 3');  ?>
      </div>
      <!-- widget #end -->
    </div>
    <!-- grid #end -->
  </div>
  <!-- bottom-in #end -->
</div>
<!-- bottom #end -->
<div id="footer">
  <div class="footer-in container_12 clearfix">
    <p class="fl"> &copy;
      <?php the_time('Y'); ?>
      <?php bloginfo(); ?>
      <?php _e(ALL_RIGHTS_RESERVED_TEXT);?> <br />
      <span class="copyright"><?php _e(COPY_RIGHTS_TEXT);?></span></p>
    <?php if ( get_option('ptthemes_footerpages') <> "" ) { ?>
    <ul>
      <?php 
	 $footer_pages = get_option('ptthemes_footerpages');
	 if($footer_pages)
	 {
		for($i=0;$i<count($footer_pages);$i++)
		{
			if($footer_pages[$i]>0){$footercatarr[] = $footer_pages[$i];}
		}
	 }
	 if($footercatarr)
	 {
	 	$footer_pages_ids = implode(',',$footercatarr);
		wp_list_pages('title_li=&depth=0&include=' . $footer_pages_ids . '&sort_column=menu_order');	
	}	 
	 ?>
    </ul>
    <?php } ?>
  </div>
  <!-- footer in #end -->
</div>
<!-- footer #end -->
