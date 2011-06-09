<?php

// Register widgetized areas
if ( function_exists('register_sidebar') ) {
    register_sidebars(1,array('name' => 'Slider Home','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	register_sidebars(1,array('name' => 'Banner Página Inicial','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
}
	

 // =============================== Advt 150x150px Widget ======================================
class advtwidget extends WP_Widget {
	function advtwidget() {
	//Constructor
		$widget_ops = array('classname' => 'widget eshop Advt 290x300px', 'description' => 'Front Page Text Widget' );		
		$this->WP_Widget('widget_advtwidget', 'PT &rarr; eshop Advt 290x300px', $widget_ops);
	}
	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$advt1 = empty($instance['advt1']) ? '' : apply_filters('widget_advt1', $instance['advt1']);
		$advt_link1 = empty($instance['advt_link1']) ? '' : apply_filters('widget_advt_link1', $instance['advt_link1']);
		$advt2 = empty($instance['advt2']) ? '' : apply_filters('widget_advt2', $instance['advt2']);
		$advt_link2 = empty($instance['advt_link2']) ? '' : apply_filters('widget_advt_link2', $instance['advt_link2']);
		 ?>						

 
      		<!--<h3><?php // echo $title; ?> </h3>-->
         
      <div class="front_advt">
        <?php if ( $advt1 <> "" ) { ?>	
         <a href="<?php echo $advt_link1; ?>"><img src="<?php echo $advt1; ?> " alt="" /></a>
         <?php } ?>
		
       </div>
              
	<?php
	}
	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['advt1'] = ($new_instance['advt1']);
		$instance['advt_link1'] = ($new_instance['advt_link1']);
		$instance['advt2'] = ($new_instance['advt2']);
		$instance['advt_link2'] = ($new_instance['advt_link2']);
		return $instance;
	}
	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'advt1' => '', 'advt_link1' => '', 'advt2' => '', 'advt_link2' => '' ) );		
		$title = strip_tags($instance['title']);
		$advt1 = ($instance['advt1']);
		$advt_link1 = ($instance['advt_link1']);
		$advt2 = ($instance['advt2']);
		$advt_link2 = ($instance['advt_link2']);			
?>
<!--<p><label for="<?php // echo $this->get_field_id('title'); ?>">Widget Title: <input class="widefat" id="<?php // echo $this->get_field_id('title'); ?>" name="<?php // echo $this->get_field_name('title'); ?>" type="text" value="<?php // echo attribute_escape($title); ?>" /></label></p>-->
     
 <p> <label for="<?php echo $this->get_field_id('advt1'); ?>">Advt 1 Image Path (ex.http://pt.com/images/banner.jpg)
    <input class="widefat" id="<?php echo $this->get_field_id('advt1'); ?>" name="<?php echo $this->get_field_name('advt1'); ?>" type="text" value="<?php echo attribute_escape($advt1); ?>" />
  </label> </p>
<p>  <label for="<?php echo $this->get_field_id('advt_link1'); ?>">Advt 1 link 
    <input class="widefat" id="<?php echo $this->get_field_id('advt_link1'); ?>" name="<?php echo $this->get_field_name('advt_link1'); ?>" type="text" value="<?php echo attribute_escape($advt_link1); ?>" />
  </label>
</p>
<?php
	}}
register_widget('advtwidget');


?>