<?php

// Register widgetized areas
if ( function_exists('register_sidebar') ) {
/*	register_sidebars(1,array('name' => 'Front Page Slider','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	register_sidebars(1,array('name' => 'Front Page Sidebar Left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	register_sidebars(1,array('name' => 'Front Page Middle Content','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	register_sidebars(1,array('name' => 'Front Page Sidebar Right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	
	register_sidebars(1,array('name' => 'Product Listing Sidebar Left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	register_sidebars(1,array('name' => 'Product Listing Sidebar Right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	
	register_sidebars(1,array('name' => 'Blog Listing Sidebar Left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	register_sidebars(1,array('name' => 'Blog Listing Sidebar Right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	
	register_sidebars(1,array('name' => 'Product Detail Sidebar Left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	register_sidebars(1,array('name' => 'Product Detail Sidebar Right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	
	register_sidebars(1,array('name' => 'Blog Detail Sidebar Left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	register_sidebars(1,array('name' => 'Blog Detail Sidebar Right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	
	register_sidebars(1,array('name' => 'Inner Page Sidebar Left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	register_sidebars(1,array('name' => 'Inner Page Sidebar Right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	
	register_sidebars(1,array('name' => 'Store Page Sidebar Left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	register_sidebars(1,array('name' => 'Store Page Sidebar Right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	
	register_sidebars(1,array('name' => 'My Cart Sidebar Left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	register_sidebars(1,array('name' => 'My Cart Sidebar Right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	
	register_sidebars(1,array('name' => 'Checkout Page Sidebar Right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));

	register_sidebars(1,array('name' => 'All Pages Sidebar Left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	register_sidebars(1,array('name' => 'All Pages Sidebar Right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	
	register_sidebars(3,array('name' => 'Footer Widget %d','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>')); 
	
	register_sidebars(1,array('name' => 'Header Top Navigation','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	register_sidebars(1,array('name' => 'Header Main Navigation','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	register_sidebars(1,array('name' => 'Header Sub Navigation','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	register_sidebars(1,array('name' => 'Header Right Settings','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));*/
	
	
	
	$sidebar_widget_arr = array();
	$sidebar_widget_arr[] = array('1',array('name' => 'Front Page Slider','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	$sidebar_widget_arr[] = array('1',array('name' => 'Front Page Sidebar Left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	$sidebar_widget_arr[] =array('1',array('name' => 'Front Page Middle Content','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	$sidebar_widget_arr[] =array('1',array('name' => 'Front Page Sidebar Right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	
	$sidebar_widget_arr[] =array('1',array('name' => 'Product Listing Sidebar Left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	$sidebar_widget_arr[] =array('1',array('name' => 'Product Listing Sidebar Right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	
	$sidebar_widget_arr[] =array('1',array('name' => 'Blog Listing Sidebar Left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	$sidebar_widget_arr[] =array('1',array('name' => 'Blog Listing Sidebar Right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	
	$sidebar_widget_arr[] =array('1',array('name' => 'Product Detail Sidebar Left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	$sidebar_widget_arr[] =array('1',array('name' => 'Product Detail Sidebar Right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	
	$sidebar_widget_arr[] =array('1',array('name' => 'Blog Detail Sidebar Left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	$sidebar_widget_arr[] =array('1',array('name' => 'Blog Detail Sidebar Right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	
	$sidebar_widget_arr[] =array('1',array('name' => 'Inner Page Sidebar Left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	$sidebar_widget_arr[] =array('1',array('name' => 'Inner Page Sidebar Right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	
	$sidebar_widget_arr[] =array('1',array('name' => 'Store Page Sidebar Left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	$sidebar_widget_arr[] =array('1',array('name' => 'Store Page Sidebar Right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	
	$sidebar_widget_arr[] =array('1',array('name' => 'My Cart Sidebar Left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	$sidebar_widget_arr[] =array('1',array('name' => 'My Cart Sidebar Right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	
	$sidebar_widget_arr[] =array('1',array('name' => 'Checkout Page Sidebar Right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));

	$sidebar_widget_arr[] =array('1',array('name' => 'All Pages Sidebar Left','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	$sidebar_widget_arr[] =array('1',array('name' => 'All Pages Sidebar Right','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	
	$sidebar_widget_arr[] = array(3,array('name' => 'Footer Widget %d','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>')); 
	
	$sidebar_widget_arr[] =array('1',array('name' => 'Header Top Navigation','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	$sidebar_widget_arr[] =array('1',array('name' => 'Header Main Navigation','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	$sidebar_widget_arr[] =array('1',array('name' => 'Header Sub Navigation','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	$sidebar_widget_arr[] =array('1',array('name' => 'Header Right Settings','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
	
	$sidebar_widget_arr = apply_filters('templ_sidebar_widget_box_filter',$sidebar_widget_arr);
	foreach($sidebar_widget_arr as $key=>$val)
	{
		register_sidebars($val[0],$val[1]);
	}
	
}

// Check for widgets in widget-ready areas http://wordpress.org/support/topic/190184?replies=7#post-808787
// Thanks to Chaos Kaizer http://blog.kaizeku.com/
function is_sidebar_active( $index = 1){
	$sidebars	= wp_get_sidebars_widgets();
	$key		= (string) 'sidebar-'.$index;
 
	return ($sidebars[$key]);
}

if(apply_filters('temp_subscribewidget_filter',true)){
// =============================== Feedburner Subscribe widget ======================================
class subscribewidget extends WP_Widget {
	function subscribewidget() {
	//Constructor
		$widget_ops = array('classname' => 'widget Newsletter Subscribe', 'description' => __('Newsletter Subscribe Widget') );		
		$this->WP_Widget('widget_subscribewidget', __('PT &rarr; Newsletter Subscribe'), $widget_ops);
	}
	function widget($args, $instance) {
	// prints the widget
	extract($args, EXTR_SKIP);
	$id = empty($instance['id']) ? '' : apply_filters('widget_id', $instance['id']);
	$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
	$text = empty($instance['text']) ? '' : apply_filters('widget_text', $instance['text']);
	$linkedin = empty($instance['linkedin']) ? '' : apply_filters('widget_linkedin', $instance['linkedin']);
	$twitter = empty($instance['twitter']) ? '' : apply_filters('widget_twitter', $instance['twitter']);
	$facebook = empty($instance['facebook']) ? '' : apply_filters('widget_facebook', $instance['facebook']);
	$technorati = empty($instance['technorati']) ? '' : apply_filters('widget_technorati', $instance['technorati']);
	$digg = empty($instance['digg']) ? '' : apply_filters('widget_digg', $instance['digg']);
	$delicious = empty($instance['delicious']) ? '' : apply_filters('widget_delicious', $instance['delicious']);
	$rssfeed = empty($instance['rssfeed']) ? '' : apply_filters('widget_rssfeed', $instance['rssfeed']);
	$rss = empty($instance['rss']) ? '' : apply_filters('widget_rss', $instance['rss']);
 ?>
  <div class="widget subscribe" >
    <?php if($title){?><h3><?php echo $title; ?></h3><?php }?>
    <?php if($text){?><p><?php echo $text; ?></p><?php }?>
    <form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $id; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true" >
      <input type="text" name="email" class="field" onfocus="if (this.value == 'your email address') {this.value = '';}" onblur="if (this.value == '') {this.value = 'your email address';}"  />
      <input type="hidden" value="<?php echo $id; ?>" name="uri"   />
      <input type="hidden" value="<?php bloginfo('name'); ?>" name="title" />
      <input type="hidden" name="loc" value="en_US"/>
      <input class="replace" type="submit" name="submit" value="<?php _e('Subscribe');?>">
    </form>
    
  </div>
<?php
	}
	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;		
		$instance['id'] = strip_tags($new_instance['id']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = strip_tags($new_instance['text']);
		$instance['linkedin'] = strip_tags($new_instance['linkedin']);
		$instance['twitter'] = strip_tags($new_instance['twitter']);
		$instance['facebook'] = strip_tags($new_instance['facebook']);
		$instance['technorati'] = strip_tags($new_instance['technorati']);
		$instance['digg'] = strip_tags($new_instance['digg']);
		$instance['rssfeed'] = strip_tags($new_instance['rssfeed']);
		$instance['rss'] = strip_tags($new_instance['rss']);
		
		return $instance;
	}
	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'id' => '', 'title' => 'Subscribe', 'text' => 'Stay updated with all our latest news enter your e-mail address here', 'linkedin' => '', 'twitter' => '', 'facebook' => '', 'technorati' => '', 'digg' => '', 'rssfeed' => '', 'rss' => '' ) );		
		$id = strip_tags($instance['id']);
		$title = strip_tags($instance['title']);
		$text = strip_tags($instance['text']);
		$linkedin = strip_tags($instance['linkedin']);
		$twitter = strip_tags($instance['twitter']);
		$facebook = strip_tags($instance['facebook']);
		$technorati = strip_tags($instance['technorati']);
		$digg = strip_tags($instance['digg']);
		$rssfeed = strip_tags($instance['rssfeed']);
		$rss = strip_tags($instance['rss']);
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:');?>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text Under Title:');?>
  <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo attribute_escape($text); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Feedburner ID:');?>
  <input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo attribute_escape($id); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('LinkedIn: (write full URL) :');?>
  <input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo attribute_escape($linkedin); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter: (write full URL):');?>
  <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo attribute_escape($twitter); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook: (write full URL):');?>
  <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo attribute_escape($facebook); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('technorati'); ?>"><?php _e('Technorati: (write full URL):');?>
  <input class="widefat" id="<?php echo $this->get_field_id('technorati'); ?>" name="<?php echo $this->get_field_name('technorati'); ?>" type="text" value="<?php echo attribute_escape($technorati); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('digg'); ?>"><?php _e('Digg It: (write full URL):');?>
  <input class="widefat" id="<?php echo $this->get_field_id('digg'); ?>" name="<?php echo $this->get_field_name('digg'); ?>" type="text" value="<?php echo attribute_escape($digg); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('delicious'); ?>"><?php _e('Del.icio.us: (write full URL):');?>
  <input class="widefat" id="<?php echo $this->get_field_id('delicious'); ?>" name="<?php echo $this->get_field_name('delicious'); ?>" type="text" value="<?php echo attribute_escape($delicious); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('RSS (write full URL):');?>
  <input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo attribute_escape($rss); ?>" />
  </label>
</p>

<?php
	}}
register_widget('subscribewidget');
}

if(apply_filters('temp_textWidgett_filter',true)){
// =============================== Advt 220x220px Widget ======================================
class TextWidget extends WP_Widget {
	function TextWidget() {
	//Constructor
		$widget_ops = array('classname' => 'widget Advt 220x220px', 'description' => __('Front Page Text Widget') );		
		$this->WP_Widget('widget_text', __('PT &rarr; Advt 220x220px'), $widget_ops);
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
<div class="advt">
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
<p>
  <label for="<?php echo $this->get_field_id('advt1'); ?>"><?php _e('Advt 1 Image Path (ex.http://pt.com/images/banner.jpg)');?>
  <input class="widefat" id="<?php echo $this->get_field_id('advt1'); ?>" name="<?php echo $this->get_field_name('advt1'); ?>" type="text" value="<?php echo attribute_escape($advt1); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('advt_link1'); ?>"><?php _e('Advt 1 link');?>
  <input class="widefat" id="<?php echo $this->get_field_id('advt_link1'); ?>" name="<?php echo $this->get_field_name('advt_link1'); ?>" type="text" value="<?php echo attribute_escape($advt_link1); ?>" />
  </label>
</p>
<?php
	}}
register_widget('TextWidget');
}

if(apply_filters('temp_ContactWidget_filter',true)){
// =============================== Contact Widget ======================================
class ContactWidget extends WP_Widget {
	function ContactWidget() {
	//Constructor
		$widget_ops = array('classname' => 'widget contact', 'description' => __('Front Page contact') );		
		$this->WP_Widget('widget_contact', __('PT &rarr; Contact Us'), $widget_ops);
	}
	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$t1 = empty($instance['t1']) ? '' : apply_filters('widget_t1', $instance['t1']);
		$t2 = empty($instance['t2']) ? '' : apply_filters('widget_t2', $instance['t2']);
 		$t4 = empty($instance['t4']) ? '' : apply_filters('widget_t4', $instance['t4']);
		$desc1 = empty($instance['desc1']) ? '' : apply_filters('widget_desc1', $instance['desc1']);
		 ?>
<div class="contact">
  <h3> <?php echo $title; ?> </h3>
  <div class="contact_right">
    <?php if ( $desc1 <> "" ) { ?>
    <?php echo $desc1; ?>
    <?php } ?>
    <div class="contact_info">
      <p>
        <?php if ( $t1 <> "" ) { ?>
        <span class="cfield"> Tel </span> : <?php echo $t1; ?> <br />
        <?php } ?>
        <?php if ( $t2 <> "" ) { ?>
        <span class="cfield">Email </span> : <a href="mailto:<?php echo $t2; ?>" ><?php echo $t2; ?></a><br />
        <?php } ?>
      </p>
    </div>
  </div>
</div>
<!-- contact #end -->
<?php
	}
	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['t1'] = ($new_instance['t1']);
		$instance['t2'] = ($new_instance['t2']);
 		$instance['img1'] = ($new_instance['img1']);
		$instance['desc1'] = ($new_instance['desc1']);
		return $instance;
	}
	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 't1' => '', 't2' => '', 't3' => '',  'img1' => '', 'desc1' => '' ) );		
		$title = strip_tags($instance['title']);
		$t1 = ($instance['t1']);
		$t2 = ($instance['t2']);
		$t3 = ($instance['t3']);
		$img1 = ($instance['img1']);		
		$desc1 = ($instance['desc1']);
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:');?>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('desc1'); ?>"><?php _e('Company Address');?>
  <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('desc1'); ?>" name="<?php echo $this->get_field_name('desc1'); ?>"><?php echo attribute_escape($desc1); ?></textarea>
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('t1'); ?>"><?php _e('Tel');?>
  <input class="widefat" id="<?php echo $this->get_field_id('t1'); ?>" name="<?php echo $this->get_field_name('t1'); ?>" type="text" value="<?php echo attribute_escape($t1); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('t2'); ?>"><?php _e('Email');?>
  <input class="widefat" id="<?php echo $this->get_field_id('t2'); ?>" name="<?php echo $this->get_field_name('t2'); ?>" type="text" value="<?php echo attribute_escape($t2); ?>" />
  </label>
</p>
<?php
	}}
register_widget('ContactWidget');
}

if(apply_filters('temp_MycartWidget_filter',true)){
// =============================== Mycart Widget ======================================
class MycartWidget extends WP_Widget {
	function MycartWidget() {
	//Constructor
		$widget_ops = array('classname' => 'widget need help?', 'description' => __('Need Help?') );		
		$this->WP_Widget('widget_mycart', __('PT &rarr; Need Help?'), $widget_ops);
	}
	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$t1 = empty($instance['t1']) ? '' : apply_filters('widget_t1', $instance['t1']);
  		$desc1 = empty($instance['desc1']) ? '' : apply_filters('widget_desc1', $instance['desc1']);
		 ?>
<div class="help " >
  <h5>Need Help?</h5>
  <?php if ( $t1 <> "" ) { ?> 
  <p class="phone"> Tel. <?php echo $t1; ?> </p>
  <?php } ?>
 
  <?php if ( $desc1 <> "" ) { ?>
  <?php echo $desc1; ?>
  <?php } ?>
</div>
<div class="payment_info"><img src="<?php bloginfo('template_directory'); ?>/images/payment_method.png" alt=""  /> </div>
<?php
	}
	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['t1'] = ($new_instance['t1']);
		$instance['t2'] = ($new_instance['t2']);
 		$instance['desc1'] = ($new_instance['desc1']);
		return $instance;
	}
	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 't1' => '', 't2' => '', 'desc1' => '' ) );		
		$title = strip_tags($instance['title']);
		$t1 = ($instance['t1']);
 		$desc1 = ($instance['desc1']);
?>
<p>
  <label for="<?php echo $this->get_field_id('desc1'); ?>">Description Here
  <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('desc1'); ?>" name="<?php echo $this->get_field_name('desc1'); ?>"><?php echo attribute_escape($desc1); ?></textarea>
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('t1'); ?>">Tel.
  <input class="widefat" id="<?php echo $this->get_field_id('t1'); ?>" name="<?php echo $this->get_field_name('t1'); ?>" type="text" value="<?php echo attribute_escape($t1); ?>" />
  </label>
</p>
<?php
	}}
register_widget('MycartWidget');
}

if(apply_filters('temp_CustomerWidget_filter',true)){
// =============================== Customer Care Widget ======================================
class CustomerWidget extends WP_Widget {
	function CustomerWidget() {
	//Constructor
		$widget_ops = array('classname' => 'widget contact', 'description' => __('Front Page contact') );		
		$this->WP_Widget('widget_customer', __('PT &rarr; Customer Care'), $widget_ops);
	}
	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$t1 = empty($instance['t1']) ? '' : apply_filters('widget_t1', $instance['t1']);
		$t2 = empty($instance['t2']) ? '' : apply_filters('widget_t2', $instance['t2']);
 		$t4 = empty($instance['t4']) ? '' : apply_filters('widget_t4', $instance['t4']);
		$desc1 = empty($instance['desc1']) ? '' : apply_filters('widget_desc1', $instance['desc1']);
		 ?>
<div class="fix"></div>
<div class="customer_care">
  <h3> <?php echo $title; ?> </h3>
  <p class="phone">
    <?php if ( $t1 <> "" ) { ?>
    <?php echo $t1; ?> <br />
    <?php } ?>
  </p>
  <?php if ( $t2 <> "" ) { ?>
  <p class="time"><?php echo $t2; ?> </p>
  <?php } ?>
</div>
<!-- customer #end -->
<?php
	}
	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['t1'] = ($new_instance['t1']);
		$instance['t2'] = ($new_instance['t2']);
		$instance['desc1'] = ($new_instance['desc1']);
		return $instance;
	}
	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 't1' => '', 't2' => '', 't3' => '',  'img1' => '', 'desc1' => '' ) );		
		$title = strip_tags($instance['title']);
		$t1 = ($instance['t1']);
		$t2 = ($instance['t2']);
		$t3 = ($instance['t3']);
		$desc1 = ($instance['desc1']);
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">Widget Title:
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('t1'); ?>">Tel
  <input class="widefat" id="<?php echo $this->get_field_id('t1'); ?>" name="<?php echo $this->get_field_name('t1'); ?>" type="text" value="<?php echo attribute_escape($t1); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('t2'); ?>">Email
  <input class="widefat" id="<?php echo $this->get_field_id('t2'); ?>" name="<?php echo $this->get_field_name('t2'); ?>" type="text" value="<?php echo attribute_escape($t2); ?>" />
  </label>
</p>
<?php
	}}
register_widget('CustomerWidget');
}

if(apply_filters('temp_NormalWidget_filter',true)){
// =============================== Normal Widget ======================================
class NormalWidget extends WP_Widget {
	function NormalWidget() {
	//Constructor
		$widget_ops = array('classname' => 'widget Text Widget', 'description' => __('Text Widget') );		
		$this->WP_Widget('widget_normal', __('PT &rarr; Text Widget'), $widget_ops);
	}
	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$desc1 = empty($instance['desc1']) ? '' : apply_filters('widget_desc1', $instance['desc1']);
		 ?>
<div class="widget">
  <h3> <?php echo $title; ?> </h3>
  	<div><?php if ( $desc1 <> "" ) { ?>
  <?php echo $desc1; ?>
  <?php } ?>
  </div>
</div>
<?php
	}
	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['desc1'] = ($new_instance['desc1']);
		return $instance;
	}
	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'desc1' => '' ) );		
		$title = strip_tags($instance['title']);
		$desc1 = ($instance['desc1']);
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">Widget Title:
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('desc1'); ?>">Description Here
  <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('desc1'); ?>" name="<?php echo $this->get_field_name('desc1'); ?>"><?php echo attribute_escape($desc1); ?></textarea>
  </label>
</p>
<?php
	}}
register_widget('NormalWidget');
}

if(apply_filters('temp_AboutWidget_filter',true)){
// =============================== Payment Method Widget ======================================
class AboutWidget extends WP_Widget {
	function AboutWidget() {
	//Constructor
		$widget_ops = array('classname' => 'widget Payment Method', 'description' => __('Payment Method') );		
		$this->WP_Widget('widget_about', __('PT &rarr; Payment Method'), $widget_ops);
	}
	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$desc1 = empty($instance['desc1']) ? '' : apply_filters('widget_desc1', $instance['desc1']);
		 ?>
<div class="payment_method">
  <h4> <?php echo $title; ?> </h4>
  <?php if ( $desc1 <> "" ) { ?>
  <?php echo $desc1; ?>
  <?php } ?>
</div>
<?php
	}
	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['desc1'] = ($new_instance['desc1']);
		return $instance;
	}
	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'desc1' => '' ) );		
		$title = strip_tags($instance['title']);
		$desc1 = ($instance['desc1']);
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">Widget Title:
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('desc1'); ?>">Description Here
  <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('desc1'); ?>" name="<?php echo $this->get_field_name('desc1'); ?>"><?php echo attribute_escape($desc1); ?></textarea>
  </label>
</p>
<?php
	}}
register_widget('AboutWidget');
}


if(apply_filters('temp_LatestPosts_filter',true)){
// =============================== Latest Posts Widget (particular category) ======================================
class LatestPosts extends WP_Widget {
	function LatestPosts() {
	//Constructor
		$widget_ops = array('classname' => 'widget latest posts', 'description' => __('List of latest posts in particular category') );
		$this->WP_Widget('widget_posts1', __('PT &rarr; Latest Slider Posts'), $widget_ops);
	}

	function widget($args, $instance) {
	// prints the widget

		extract($args, EXTR_SKIP);
		echo $before_widget;
 		$category = empty($instance['category']) ? '&nbsp;' : apply_filters('widget_category', $instance['category']);
		$post_number = empty($instance['post_number']) ? '&nbsp;' : apply_filters('widget_post_number', $instance['post_number']);
		$post_link = empty($instance['post_link']) ? '&nbsp;' : apply_filters('widget_post_link', $instance['post_link']);
		$auto_rotate = empty($instance['auto_rotate']) ? 'Yes' : apply_filters('widget_auto_rotate', $instance['auto_rotate']);
		$speed =  empty($instance['speed']) ? '5000' : apply_filters('widget_speed', $instance['speed']);
		$image_width =  empty($instance['image_width']) ? '420' : apply_filters('widget_image_width', $instance['image_width']);
		$image_height =  empty($instance['image_height']) ? '' : apply_filters('widget_image_height', $instance['image_height']);
		$content_lenght =  empty($instance['content_lenght']) ? '700' : apply_filters('widget_content_lenght', $instance['content_lenght']);
		if($auto_rotate=='No'){$speed='100000';}
		
		?>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/slider.js"></script>
		<?php
		echo "<script type='text/javascript'>
			var autoSlider_var = '".$auto_rotate."';
			var autoSlideInterval_var = '".$speed."';
			</script>";

		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		echo '<div id="banner">
<div class="banner-in container_16 clearfix">
    <div id="slider"> <div class="coda-slider-wrapper"><div class="coda-slider preload" id="coda-slider-1">';

		        ?>

<?php 
			        global $post;
			        $latest_menus = get_posts('numberposts='.$post_number.'postlink='.$post_link.'&category='.$category.'');
                    foreach($latest_menus as $post) :
                    setup_postdata($post);
			    ?>
<?php $button = get_post_meta($post->ID, 'button', $single = true);	?>
<?php $button_url = get_post_meta($post->ID, 'button_url', $single = true);	?>



<div class="panel">
  <div class="panel-wrapper">
    <?php
				global $Product;
				$product_image_arr = $Product->get_product_image($post,'large');
				if($product_image_arr && $product_image_arr[0])
				{
					$imagepath = $product_image_arr[0];
				}
				  if($imagepath)
				  {
					  global $thumb_url;
				  ?>
    <div class="banner_img "> <a href="<?php the_permalink() ?>"><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $imagepath; ?><?php if($image_height>0){?>&amp;h=<?php echo $image_height; }?>&amp;w=<?php echo $image_width;?>&amp;zc=0&amp;q=80<?php echo $thumb_url;?>" alt=""  /></a> </div>
    <?php
				  }
				?>
    <h1><a class="widget-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h1>
    <p class="featured-excerpt"><?php echo bm_better_excerpt($content_lenght, ' ... '); ?> </p>
    <div class="button"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php _e('Ver Detalhes');?></a> </div>
  </div>
</div>
<?php endforeach; ?>
<?php

	    echo '</div></div>
		     </div>
  </div> </div>
  ';

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['category'] = strip_tags($new_instance['category']);
		$instance['post_number'] = strip_tags($new_instance['post_number']);
		$instance['post_link'] = strip_tags($new_instance['post_link']);
		$instance['auto_rotate'] = strip_tags($new_instance['auto_rotate']);
		$instance['speed'] = strip_tags($new_instance['speed']);
		$instance['image_width'] = strip_tags($new_instance['image_width']);
		$instance['image_height'] = strip_tags($new_instance['image_height']);
		$instance['content_lenght'] = strip_tags($new_instance['content_lenght']);
		return $instance;

	}

	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'category' => '', 'post_number' => '','auto_rotate'=>'Yes','speed'=>'5000','image_width'=>'420','image_height'=>'460','content_lenght'=>'700' ) );
		$title = strip_tags($instance['title']);
		$category = strip_tags($instance['category']);
		$post_number = strip_tags($instance['post_number']);
		$post_link = strip_tags($instance['post_link']);
		$auto_rotate = strip_tags($instance['auto_rotate']);
		$speed = strip_tags($instance['speed']);
		$image_width = strip_tags($instance['image_width']);
		$image_height = strip_tags($instance['image_height']);
		$content_lenght = strip_tags($instance['content_lenght']);
?>
<p>
  <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Categories (<code>IDs</code> separated by commas):');?>
  <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo attribute_escape($category); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('post_number'); ?>"><?php _e('Number of posts:');?>
  <input class="widefat" id="<?php echo $this->get_field_id('post_number'); ?>" name="<?php echo $this->get_field_name('post_number'); ?>" type="text" value="<?php echo attribute_escape($post_number); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('auto_rotate'); ?>"><?php _e('Set slider auto rotation:');?>
  <select id="<?php echo $this->get_field_id('auto_rotate'); ?>" name="<?php echo $this->get_field_name('auto_rotate'); ?>" style="width:50%;">
  <option <?php if(attribute_escape($auto_rotate)=='Yes'){ echo 'selected="selected"';}?>>Yes</option>
  <option <?php if(attribute_escape($auto_rotate)=='No'){ echo 'selected="selected"';}?>>No</option>
  </select>
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('speed'); ?>"><?php _e('Slider rotation speed(frame/milisecond):');?>
  <input class="widefat" id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" type="text" value="<?php echo attribute_escape($speed); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('image_width'); ?>"><?php _e('Slider image Width in px <br />(Default is 420px):');?>
  <input class="widefat" id="<?php echo $this->get_field_id('image_width'); ?>" name="<?php echo $this->get_field_name('image_width'); ?>" type="text" value="<?php echo attribute_escape($image_width); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('image_height'); ?>"><?php _e('Slider image Height in px <br />(Default is 460px):');?>
  <input class="widefat" id="<?php echo $this->get_field_id('image_height'); ?>" name="<?php echo $this->get_field_name('image_height'); ?>" type="text" value="<?php echo attribute_escape($image_height); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('content_lenght'); ?>"><?php _e('Slider content Length in characters:');?>
  <input class="widefat" id="<?php echo $this->get_field_id('content_lenght'); ?>" name="<?php echo $this->get_field_name('content_lenght'); ?>" type="text" value="<?php echo attribute_escape($content_lenght); ?>" />
  </label>
</p>
<?php
	}

}
register_widget('LatestPosts');
}

if(apply_filters('temp_browse_by_categories_filter',true)){
// =============================== Browse By Categories Widget (particular category) ======================================
class browse_by_categories extends WP_Widget {
	function browse_by_categories() {
	//Constructor
		$widget_ops = array('classname' => 'widget browse_by_cats', 'description' => __('Category Listing') );
		$this->WP_Widget('browse_by_cats', __('PT &rarr; Browse By Categories'), $widget_ops);
	}

	function widget($args, $instance) {
	// prints the widget

		extract($args, EXTR_SKIP);
		echo $before_widget;
 		$title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_category', $instance['title']);
		$category = empty($instance['category']) ? '' : apply_filters('widget_category', $instance['category']);
		if($before_title=='' || $after_title=='')
		{
			$before_title=='<h3>';
			$after_title=='</h3>';
		}
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
        ?>
      <ul class="browse_by_category">
		<?php
       if($category )
	   {
	   	$ex_catIdArr = get_categories('exclude=' . $category );
	
        $catIdArr = array();
        foreach($ex_catIdArr as $ex_catIdArrObj)
        {
            $catIdArr[] = $ex_catIdArrObj->term_id;
        }
        $includeCats = implode(',',$catIdArr);
	   $subque = "&include=$includeCats";
	   }
        wp_list_categories('orderby=name&title_li='.$subque);
        ?>
      </ul>

	<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['category'] = strip_tags($new_instance['category']);
		return $instance;

	}

	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Our Products', 'category' => '' ) );
		$title = strip_tags($instance['title']);
		$category = strip_tags($instance['category']);
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title');?> :
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Exclude Categories (<code>IDs</code> separated by commas)');?> :
  <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo attribute_escape($category); ?>" />
  </label>
</p>
<?php
	}

}
register_widget('browse_by_categories');
}

if(apply_filters('temp_shopping_cart_info_filter',true)){
// =============================== Shopping Cart info Widget (particular category) ======================================
class shopping_cart_info extends WP_Widget {
	function shopping_cart_info() {
	//Constructor
		$widget_ops = array('classname' => 'widget shopping_cart_info', 'description' => __('Shopping Cart Information') );
		$this->WP_Widget('shopping_cart_info', __('PT &rarr; Shopping Cart Information'), $widget_ops);
	}

	function widget($args, $instance) {
	// prints the widget
	global $General;
		extract($args, EXTR_SKIP);
		echo $before_widget;
 		$title = empty($instance['title']) ? '' : apply_filters('widget_category', $instance['title']);
		if($before_title=='' || $after_title=='')
		{
			$before_title=='<h4>';
			$after_title=='</h4>';
		}
		global $Cart,$General;
		$itemsInCartCount = $Cart->cartCount();
		$cartAmount = $Cart->getCartAmt();
		$cart_amt = $General->get_amount_format($cartAmount);
		if($cart_amt){ $cart_amt = "($cart_amt)";}
		?>
        <div class="shoppingcart_box">
            <?php if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };?>
            <div> <p><?php _e('Você tem');?> <a href="<?php echo site_url('/?ptype=cart'); ?>"><strong> <span id="cart_information_span1"><?php echo $itemsInCartCount . $cart_amt;?></span></strong></a> <?php _e(SHOPPING_CART_CONTENT_TEXT);?> </p>
            <p><a href="<?php echo site_url('/?ptype=cart'); ?>"> <span id="cart_information_span11"><strong><?php _e(CHECKOUT_TEXT);?> &raquo;</strong></span></a></p>
            </div>
          </div>
      	<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;

	}

	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Shopping Cart' ) );
		$title = strip_tags($instance['title']);
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title');?> :
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
  </label>
</p>
<?php
	}

}
register_widget('shopping_cart_info');
}


if(apply_filters('temp_latest_product_widget_filter',true)){
// =============================== Latest Products Widget ======================================
class latest_product_widget extends WP_Widget {
	function latest_product_widget() {
	//Constructor
		$widget_ops = array('classname' => 'widget latest_product_info', 'description' => __('Latest Products') );
		$this->WP_Widget('latest_product_info', __('PT &rarr; Latest Products'), $widget_ops);
	}

	function widget($args, $instance) {
	// prints the widget
		global $Cart,$General,$Product,$post;
		extract($args, EXTR_SKIP);
		echo $before_widget;
 		if($before_title=='' || $after_title=='')
		{
			$before_title=='<h4>';
			$after_title=='</h4>';
		}
		$category = empty($instance['category']) ? '' : apply_filters('widget_category', $instance['category']);
		$title = empty($instance['title']) ? __('Latest Products') : apply_filters('widget_title', $instance['title']);
		$display_prds_no = empty($instance['display_prds_no']) ? 10 : apply_filters('widget_display_prds_no', $instance['display_prds_no']);
		$list_type = empty($instance['display_prds_no']) ? 'Grid' : apply_filters('widget_display_prds_no', $instance['list_type']);
		$show_store_link = empty($instance['show_store_link']) ? '' : apply_filters('widget_show_store_link', $instance['show_store_link']);
		$image_width = empty($instance['image_width']) ? '' : apply_filters('widget_image_width', $instance['image_width']);
		$image_height = empty($instance['image_height']) ? '' : apply_filters('widget_image_height', $instance['image_height']);
		$image_cut = empty($instance['image_cut']) ? '' : apply_filters('widget_image_cut', $instance['image_cut']);
		?>
      <h3 class="title"><?php echo $title;?> </h3>
  <?php
if(have_posts())
{
	$limit = $display_prds_no;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	if($category)
	{
		$blogCategoryIdStr =$category;	
	}else
	{
		$blogCategoryIdStr = str_replace(',',',-',get_inc_categories("cat_exclude_"));	
	}
	query_posts('showposts=' . $limit . '&paged=' . $paged .'&cat='.$blogCategoryIdStr);
?>
  <ul style="display: block;" class="display <?php if($list_type=='Grid'){echo 'thumb_view';}?> category_list">
    <?php
    while(have_posts())
    {
        the_post();
		$post->image_width = $image_width;
		$post->image_height = $image_height;
		$Product->product_listing_li($post,array('image_cut'=>$image_cut));
    }
	?>
  </ul>
  <div class="clearfix"></div>
  <?php
}
?>
  <?php if($show_store_link){$General->view_store_link_home();}?>
  
  <?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;
		$instance['category'] = strip_tags($new_instance['category']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['display_prds_no'] = strip_tags($new_instance['display_prds_no']);
		$instance['list_type'] = strip_tags($new_instance['list_type']);
		$instance['show_store_link'] = strip_tags($new_instance['show_store_link']);
		$instance['image_width'] = strip_tags($new_instance['image_width']);
		$instance['image_height'] = strip_tags($new_instance['image_height']);
		$instance['image_cut'] = strip_tags($new_instance['image_cut']);
		return $instance;
	}

	function form($instance) {
	//widgetform in backend	
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Latest Products','display_prds_no' => '10','list_type' => 'Grid' ,'show_store_link' => '1') );
		$category = strip_tags($instance['category']);
		$title = strip_tags($instance['title']);
		$display_prds_no = strip_tags($instance['display_prds_no']);
		$list_type = strip_tags($instance['list_type']);
		$show_store_link = strip_tags($instance['show_store_link']);
		$image_width = strip_tags($instance['image_width']);
		$image_height = strip_tags($instance['image_height']);		
		$image_cut = strip_tags($instance['image_cut']);		
?>
<p>
  <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Categories (<code>IDs</code> separated by commas):');?>
  <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo attribute_escape($category); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title');?> :</label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
</p>
<p>  <label for="<?php echo $this->get_field_id('display_prds_no'); ?>"><?php _e('Number of Products');?> :</label>
  <input class="widefat" id="<?php echo $this->get_field_id('display_prds_no'); ?>" name="<?php echo $this->get_field_name('display_prds_no'); ?>" type="text" value="<?php echo attribute_escape($display_prds_no); ?>" /></p>
<p>  <label for="<?php echo $this->get_field_id('list_type'); ?>"><?php _e('Listing Type');?> :  </label>
  <select name="<?php echo $this->get_field_name('list_type'); ?>" id="<?php echo $this->get_field_id('list_type'); ?>" style="width:50%;">
  <option <?php if(attribute_escape($list_type)=='Grid'){ echo 'selected="selected"';} ?> >Grid</option>
  <option <?php if(attribute_escape($list_type)=='List'){ echo 'selected="selected"';} ?>>List</option>
  </select>
  </label>
</p>
<p>  
<label for="<?php echo $this->get_field_id('show_store_link'); ?>">
<input class="" id="<?php echo $this->get_field_id('show_store_link'); ?>" value="1" name="<?php echo $this->get_field_name('show_store_link'); ?>" type="checkbox" <?php if(attribute_escape($show_store_link)){ echo 'checked="checked"';} ?>  />
<?php _e('Wish to display Store link?');?></label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('image_width'); ?>"><?php _e('Image Width (in px)');?> :</label>
  <input class="widefat" id="<?php echo $this->get_field_id('image_width'); ?>" name="<?php echo $this->get_field_name('image_width'); ?>" type="text" value="<?php echo attribute_escape($image_width); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('image_height'); ?>"><?php _e('Image Height (in px)');?> :</label>
  <input class="widefat" id="<?php echo $this->get_field_id('image_height'); ?>" name="<?php echo $this->get_field_name('image_height'); ?>" type="text" value="<?php echo attribute_escape($image_height); ?>" />
</p>
<p>  <label for="<?php echo $this->get_field_id('image_cut'); ?>"><?php _e('Image Cutting Type');?> :  </label>
  <select name="<?php echo $this->get_field_name('image_cut'); ?>" id="<?php echo $this->get_field_id('image_cut'); ?>" style="width:50%;">
  <option <?php if(attribute_escape($image_cut)=='center'){ echo 'selected="selected"';} ?> >center</option>
  <option <?php if(attribute_escape($image_cut)=='top'){ echo 'selected="selected"';} ?>>top</option>
  <option <?php if(attribute_escape($image_cut)=='bottom'){ echo 'selected="selected"';} ?>>bottom</option>
  <option <?php if(attribute_escape($image_cut)=='left'){ echo 'selected="selected"';} ?>>left</option>
  <option <?php if(attribute_escape($image_cut)=='right'){ echo 'selected="selected"';} ?>>right</option>
  <option <?php if(attribute_escape($image_cut)=='top right'){ echo 'selected="selected"';} ?>>top right</option>
  <option <?php if(attribute_escape($image_cut)=='top left'){ echo 'selected="selected"';} ?>>top left</option>
  <option <?php if(attribute_escape($image_cut)=='bottom right'){ echo 'selected="selected"';} ?>>bottom right</option>
  <option <?php if(attribute_escape($image_cut)=='bottom left'){ echo 'selected="selected"';} ?>>bottom left</option>
  </select>
  </label>
</p>
<?php
	}

}
register_widget('latest_product_widget');
}

if(apply_filters('temp_login_links_widget_filter',true)){
// =============================== Login Links Widget ======================================
class login_links_widget extends WP_Widget {
	function login_links_widget() {
	//Constructor
		$widget_ops = array('classname' => 'widget login_info', 'description' => __('Login Information') );
		$this->WP_Widget('login_info', __('PT &rarr; Login Information'), $widget_ops);
	}

	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		echo $before_widget;
 		if($before_title=='' || $after_title=='')
		{
			$before_title=='<h4>';
			$after_title=='</h4>';
		}
		$title = empty($instance['title']) ? '' : apply_filters('widget_category', $instance['title']);
		?>
        
        <div class="myaccount_info">
      <h3 class="title">
      <?php 
		global $current_user;
		if($title)
		{
			echo $title;
		}else
		{
			if($current_user->data->ID)
			{
			?>
			<?php _e('Welcome ');?> <strong><?php echo $current_user->data->user_nicename;?></strong>
			<?php }else
			{
			?>
			<?php _e('Hello Guest');?>,
			<?php	
			}
		}?>
      </h3>
      
      	<div><ul>
	<?php
	if($current_user->data->ID)
	{
	?>
        <li id="my_account_widget_li"><a href="<?php echo site_url('/?ptype=myaccount'); ?>"><?php _e('Minha Conta');?></a> </li>
        <li id="logout_widget_li"><a href="<?php global $General; echo $General->get_url_login(site_url('/?ptype=login&amp;action=logout')); ?>"><?php _e('Sair');?></a> </li>
	<?php
	}else
	{
	?>
        <li id="login_widget_li"><a href="<?php global $General; echo $General->get_url_login(site_url('/?ptype=login')); ?>"><?php _e('Login na Conta');?></a> </li>
        <li id="registration_widget_li"><a href="<?php global $General; echo $General->get_url_login(site_url('/?ptype=login')); ?>"><?php _e('Cadastrar');?></a> </li>
    <?php	
	}
	?>
    <li id="cart_detail_widget_li"><a href="<?php echo site_url('/?ptype=cart'); ?>"><?php _e('Ver Bolsa de Compras');?></a></li>
    <li id="checkout_widget_li"><a href="<?php echo site_url('/?ptype=cart'); ?>"><?php _e('Finalizar Compra');?></a></li>
    </ul>
      </div>
    </div> 
    
  <?php

	echo $after_widget;
	}

	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	function form($instance) {
	//widgetform in backend	
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Login') );
		$title = strip_tags($instance['title']);
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title');?> :</label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
</p>
<?php
	}

}
register_widget('login_links_widget');
}

if(apply_filters('temp_banner_widget_filter',true)){
// =============================== Login Links Widget ======================================
class banner_widget extends WP_Widget {
	function banner_widget() {
	//Constructor
		$widget_ops = array('classname' => 'widget banner_widget', 'description' => __('Set Advertisement either banner or Google Ad Sence Code') );
		$this->WP_Widget('banner_widget', __('PT &rarr; Set Advertisement'), $widget_ops);
	}

	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		echo $before_widget;
 		if($before_title=='' || $after_title=='')
		{
			$before_title=='<h4>';
			$after_title=='</h4>';
		}
		$title = empty($instance['title']) ? '' : apply_filters('widget_category', $instance['title']);
		$advertisement = empty($instance['advertisement']) ? '' : apply_filters('widget_advertisement', $instance['advertisement']);
		if($title){ echo '<h3>'.$title.'</h3>';}
		echo $advertisement;
	echo $after_widget;
	}

	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['advertisement'] = strip_tags($new_instance['advertisement']);
		return $instance;
	}

	function form($instance) {
	//widgetform in backend	
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = strip_tags($instance['title']);
		$advertisement = strip_tags($instance['advertisement']);
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title');?> :</label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('advertisement'); ?>"><?php _e('Advertisement');?> :</label>
  <textarea id="<?php echo $this->get_field_id('advertisement'); ?>" name="<?php echo $this->get_field_name('advertisement'); ?>" ><?php echo attribute_escape($advertisement); ?></textarea>
</p>
<?php
	}

}
register_widget('banner_widget');
}

if(apply_filters('temp_flickr_widget_filter',true)){
// ===============================  Flickr Widget ======================================
class flickr_widget extends WP_Widget {
	function flickr_widget() {
	//Constructor
		$widget_ops = array('classname' => 'widget flickr_widget', 'description' => 'Set Flicker Setttings' );
		$this->WP_Widget('flickr_widget', 'PT &rarr; Flicker Widget', $widget_ops);
	}

	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		echo $before_widget;
 		if($before_title=='' || $after_title=='')
		{
			$before_title=='<h4>';
			$after_title=='</h4>';
		}
		$title = empty($instance['title']) ? '<span class="flickr-logo">flick<b>r</b></span> photostream' : apply_filters('widget_title', $instance['title']);
		$id = empty($instance['id']) ? '' : apply_filters('widget_id', $instance['id']);
		$number = empty($instance['number']) ? '6' : apply_filters('widget_number', $instance['number']);
	?>
    <div class="widget flickr">
    <?php if($title) {?> <h3 class="hl"><span><?php echo $title;?></span></h3> <?php }?>    
    <div class="fix"></div>
    <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script>
    <div class="fix"></div>
    </div>
    <?php
	echo $after_widget;
	}

	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['id'] = strip_tags($new_instance['id']);
		$instance['number'] = strip_tags($new_instance['number']);
		return $instance;
	}

	function form($instance) {
	//widgetform in backend	
		$instance = wp_parse_args( (array) $instance, array( 'title' => '<span class="flickr-logo">flick<b>r</b></span> photostream','id' => '','number' => '') );
		$title = strip_tags($instance['title']);
		$id = strip_tags($instance['id']);
		$number = strip_tags($instance['number']);
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title');?> :</label>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Flickr ID (<a href="http://www.idgettr.com">idGettr</a>)');?> :</label>
 <input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo attribute_escape($id); ?>" />
 
</p>
<p>
  <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of photos');?> :</label>
  <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo attribute_escape($number); ?>" />
</p>
<?php
	}

}
register_widget('flickr_widget');
}

if(apply_filters('temp_PopularPostsSidebart_filter',true)){
// =============================== Popular Posts Widget ======================================
class PopularPostsSidebar extends WP_Widget {
	function PopularPostsSidebar() {
	//Constructor
		$widget_ops = array('classname' => 'widget Popular Posts Sidebar', 'description' => __('Set Popular Posts to Sidebar') );
		$this->WP_Widget('PopularPostsSidebar', __('PT &rarr; Popular Posts Sidebar'), $widget_ops);
	}

	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		echo $before_widget;
 		if($before_title=='' || $after_title=='')
		{
			$before_title=='<h4>';
			$after_title=='</h4>';
		}
		$name = empty($instance['name']) ? 'Popular Posts' : apply_filters('widget_name', $instance['name']);
		$popnumber = empty($instance['number']) ? '10' : apply_filters('widget_number', $instance['number']);
?>
<div class="widget popular">
  <h3 class="hl"><span><?php echo $name; ?></span></h3>
  <ul>
    <?php
			global $wpdb;
            $now = gmdate("Y-m-d H:i:s",time());
            $lastmonth = gmdate("Y-m-d H:i:s",gmmktime(date("H"), date("i"), date("s"), date("m")-12,date("d"),date("Y")));
            $popularposts = "SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS 'stammy' FROM $wpdb->posts, $wpdb->comments WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish' AND post_date < '$now' AND post_date > '$lastmonth' AND comment_status = 'open' GROUP BY $wpdb->comments.comment_post_ID ORDER BY stammy DESC LIMIT $popnumber";
            $posts = $wpdb->get_results($popularposts);
            $popular = '';
            if($posts){
                foreach($posts as $post){
	                $post_title = stripslashes($post->post_title);
		               $guid = get_permalink($post->ID);
					   
					      $first_post_title=substr($post_title,0,26);
            ?>
    <li> <a href="<?php echo $guid; ?>" title="<?php echo $post_title; ?>"><?php echo $first_post_title; ?></a>
    </li>
    <?php } } ?>
  </ul>
</div>
    <?php
	echo $after_widget;
	}

	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;
		$instance['name'] = strip_tags($new_instance['name']);
		$instance['number'] = strip_tags($new_instance['number']);
		return $instance;
	}

	function form($instance) {
	//widgetform in backend	
		$instance = wp_parse_args( (array) $instance, array( 'name' => 'Popular Posts', 'number' => '') );
		$name = strip_tags($instance['name']);
		$number = strip_tags($instance['number']);
?>
<p>
  <label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Title');?> :</label>
  <input class="widefat" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="text" value="<?php echo attribute_escape($name); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts');?> :</label>
  <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo attribute_escape($number); ?>" />
</p>
<?php
	}

}
register_widget('PopularPostsSidebar');
}

if(apply_filters('temp_widget_Twidget_filter',true)){
// =============================== Twitter widget ======================================
class widget_Twidget extends WP_Widget {
	function widget_Twidget() {
	//Constructor
		$widget_ops = array('classname' => 'widget Twitter', 'description' => __('Set Twitter') );
		$this->WP_Widget('widget_Twidget', __('PT &rarr; Twitter'), $widget_ops);
	}

	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$account = empty($instance['account']) ? '' : apply_filters('widget_account', $instance['account']);
		$title = empty($instance['title']) ? 'Twitter' : apply_filters('widget_title', $instance['title']);
		$show = empty($instance['show']) ? '5' : apply_filters('widget_show', $instance['show']);
		$follow = empty($instance['follow']) ? '' : apply_filters('widget_follow', $instance['follow']);
 	// Output
		echo $before_widget ;

		// start
		echo '<div class="widget twitter clearfix"><div class="twitter_icon"><h3><a href="http://www.twitter.com/'.$account.'/" title="'.$follow.'">'.$title.' </a></h3></div>';              
		echo '<div class="twitter_post"><div id="twitter">';
		echo '<ul id="twitter_update_list"><li></li></ul>
		      <script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>';
		echo '<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/'.$account.'.json?callback=twitterCallback2&amp;count='.$show.'"></script>';
		echo '</div></div></div>';
			
				
		// echo widget closing tag
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;
		$instance['account'] = strip_tags($new_instance['account']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['show'] = strip_tags($new_instance['show']);
		$instance['follow'] = strip_tags($new_instance['follow']);
		return $instance;
	}

	function form($instance) {
	//widgetform in backend	
		$instance = wp_parse_args( (array) $instance, array( 'account' => '', 'title' => 'Twitter','show' => '5', 'follow' => '') );
		$account = strip_tags($instance['account']);
		$title = strip_tags($instance['title']);
		$show = strip_tags($instance['show']);
		$follow = strip_tags($instance['follow']);
?>
<p>
  <label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Title');?> :</label>
  <input class="widefat" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="text" value="<?php echo attribute_escape($name); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('account'); ?>"><?php _e('Twitter Account ID');?> :</label>
  <input class="widefat" id="<?php echo $this->get_field_id('account'); ?>" name="<?php echo $this->get_field_name('account'); ?>" type="text" value="<?php echo attribute_escape($account); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('show'); ?>"><?php _e('Number of List');?> :</label>
  <input class="widefat" id="<?php echo $this->get_field_id('show'); ?>" name="<?php echo $this->get_field_name('show'); ?>" type="text" value="<?php echo attribute_escape($show); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('follow'); ?>"><?php _e('Follow Link');?> :</label>
  <input class="widefat" id="<?php echo $this->get_field_id('follow'); ?>" name="<?php echo $this->get_field_name('follow'); ?>" type="text" value="<?php echo attribute_escape($follow); ?>" />
</p>
<?php
	}

}
register_widget('widget_Twidget');
}

if(apply_filters('temp_social_media_filter',true)){
// =============================== Connect Widget ======================================
class social_media extends WP_Widget {
	function social_media() {
	//Constructor
		$widget_ops = array('classname' => 'widget Social Media', 'description' => 'Social Media' );		
		$this->WP_Widget('social_media', 'T &rarr; Social Media', $widget_ops);
	}
	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$twitter = empty($instance['twitter']) ? '' : apply_filters('widget_twitter', $instance['twitter']);
		$facebook = empty($instance['facebook']) ? '' : apply_filters('widget_facebook', $instance['facebook']);
		$digg = empty($instance['digg']) ? '' : apply_filters('widget_digg', $instance['digg']);
		$linkedin = empty($instance['linkedin']) ? '' : apply_filters('widget_linkedin', $instance['linkedin']);
		$myspace = empty($instance['myspace']) ? '' : apply_filters('widget_myspace', $instance['myspace']);
		$rss = empty($instance['rss']) ? '' : apply_filters('widget_rss', $instance['rss']);
		 ?>						

		<div class="widget social_media">
      		<?php if($title){?> <h3 class="i_bio"><?php echo $title; ?> </h3><?php }?>
       
       <ul class="social_media_list">
       	<?php if ( $twitter <> "" ) { ?>	
        	<li><a href="<?php echo $twitter; ?>" > <img src="<?php bloginfo('template_directory'); ?>/images/i_twitter.png" alt=""  /> </a>  </li>
         <?php } ?>
         	<?php if ( $facebook <> "" ) { ?>	
        	<li> <a href="<?php echo $facebook; ?>" > <img src="<?php bloginfo('template_directory'); ?>/images/i_facebook.png" alt=""  /> </a> </li>
         <?php } ?>
         	<?php if ( $digg <> "" ) { ?>	
        	<li>  <a href="<?php echo $digg; ?>" > <img src="<?php bloginfo('template_directory'); ?>/images/i_digg.png" alt=""  /> </a> </li>
         <?php } ?>
         	<?php if ( $linkedin <> "" ) { ?>	
        	<li> <a href="<?php echo $linkedin; ?>" > <img src="<?php bloginfo('template_directory'); ?>/images/i_linkedin.png" alt=""  /> </a>   </li>
         <?php } ?>
         	<?php if ( $myspace <> "" ) { ?>	
        	<li> <a href="<?php echo $myspace; ?>" > <img src="<?php bloginfo('template_directory'); ?>/images/i_myspace.png" alt=""  /> </a>  </li>
         <?php } ?>
         	<?php if ( $rss <> "" ) { ?>	
        	<li> <a href="<?php echo $rss; ?>" > <img src="<?php bloginfo('template_directory'); ?>/images/i_rss.png" alt=""  /> </a>  </li>
         <?php } ?>
		</ul>
        
        
        </div> <!-- widget #end -->
            
            
	<?php
	}
	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter'] = ($new_instance['twitter']);
		$instance['facebook'] = ($new_instance['facebook']);
		$instance['digg'] = ($new_instance['digg']);
		$instance['linkedin'] = ($new_instance['linkedin']);
		$instance['myspace'] = ($new_instance['myspace']);
		$instance['rss'] = ($new_instance['rss']);
		return $instance;
	}
	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'twitter' => '', 'facebook' => '', 'digg' => '',  'linkedin' => '', 'myspace' => '','rss' => '' ) );		
		$title = strip_tags($instance['title']);
		$twitter = ($instance['twitter']);
		$facebook = ($instance['facebook']);
		$digg = ($instance['digg']);
		$linkedin = ($instance['linkedin']);		
		$myspace = ($instance['myspace']);
		$rss = ($instance['rss']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Widget Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
       <p><label for="<?php echo $this->get_field_id('twitter'); ?>">Twitter Full URL : <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo attribute_escape($twitter); ?>" /></label></p>
       <p><label for="<?php echo $this->get_field_id('facebook'); ?>">Facebook Full URL : <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo attribute_escape($facebook); ?>" /></label></p>
       <p><label for="<?php echo $this->get_field_id('digg'); ?>">Digg Full URL : <input class="widefat" id="<?php echo $this->get_field_id('digg'); ?>" name="<?php echo $this->get_field_name('digg'); ?>" type="text" value="<?php echo attribute_escape($digg); ?>" /></label></p>
       <p><label for="<?php echo $this->get_field_id('linkedin'); ?>">Linkedin Full URL : <input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo attribute_escape($linkedin); ?>" /></label></p>
       <p><label for="<?php echo $this->get_field_id('myspace'); ?>">Myspace Full URL : <input class="widefat" id="<?php echo $this->get_field_id('myspace'); ?>" name="<?php echo $this->get_field_name('myspace'); ?>" type="text" value="<?php echo attribute_escape($myspace); ?>" /></label></p>
        <p><label for="<?php echo $this->get_field_id('rss'); ?>">Rss Full URL : <input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo attribute_escape($rss); ?>" /></label></p>

<?php
	}}
register_widget('social_media');
}


?>