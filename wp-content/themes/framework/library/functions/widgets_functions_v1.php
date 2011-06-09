<?php

// Register widgetized areas
if ( function_exists('register_sidebar') ) {
	register_sidebars(1,array('name' => 'Front Page Slider','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
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
	register_sidebars(1,array('name' => 'Header Right Settings','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h3><span>','after_title' => '</span></h3>'));
}

// Check for widgets in widget-ready areas http://wordpress.org/support/topic/190184?replies=7#post-808787
// Thanks to Chaos Kaizer http://blog.kaizeku.com/
function is_sidebar_active( $index = 1){
	$sidebars	= wp_get_sidebars_widgets();
	$key		= (string) 'sidebar-'.$index;
 
	return ($sidebars[$key]);
}


// =============================== Feedburner Subscribe widget ======================================
function subscribeWidget()
{
	$settings = get_option("widget_subscribewidget");

	$id = $settings['id'];
	$title = $settings['title'];
	$text = $settings['text'];
	$linkedin = $settings['linkedin'];	
	$twitter = $settings['twitter'];
	$facebook = $settings['facebook'];
	$technorati = $settings['technorati'];
	$digg = $settings['digg'];
	$delicious = $settings['delicious'];
	$rssfeed = $settings['rssfeed'];
	$rss = $settings['rss'];
?>

<div class="widget clearfix" >
  <div class="subscribe" >
    <h3><?php echo $title; ?></h3>
    <p><?php echo $text; ?></p>
    <form action="http://www.feedburner.com/fb/a/emailverify" method="post" target="popupwindow" onsubmit="window.open('http://www.feedburner.com/fb/a/emailverifySubmit?feedId=<?php echo $id; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
      <input type="text" name="email" class="field" />
      <input type="hidden" value="http://feeds.feedburner.com/~e?ffid=<?php echo $id; ?>" name="url"  />
      <input type="hidden" value="<?php bloginfo('name'); ?>" name="title" />
      <input type="hidden" name="loc" value="en_US"/>
      <button class="replace" type="submit" name="submit">Subscribe</button>
    </form>
    <div class="iSocialize_icons clearfix">
      <?php if ( $linkedin <> "" ) { ?>
      <a href="<?php echo $linkedin; ?>"> <img src="<?php bloginfo('template_directory'); ?>/images/i_linkedin.png" alt=""  /></a>
      <?php } ?>
      <?php if ( $twitter <> "" ) { ?>
      <a href="<?php echo $twitter; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/i_twitter.png" alt=""  /></a>
      <?php } ?>
      <?php if ( $facebook <> "" ) { ?>
      <a href="<?php echo $facebook; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/i_facebook.png" alt=""  /></a>
      <?php } ?>
      <?php if ( $technorati <> "" ) { ?>
      <a href="<?php echo $technorati; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/i_technorati.png" alt=""  /></a>


      <?php } ?>
      <?php if ( $digg <> "" ) { ?>
      <a href="<?php echo $digg; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/i_digg.png" alt=""  /></a>
      <?php } ?>
      <?php if ( $delicious <> "" ) { ?>
      <a href="<?php echo $delicious; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/i_delicious.png" alt=""  /></a>
      <?php } ?>
      <?php if ( $rss <> "" ) { ?>
      <a href="<?php echo $rss; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/i_rss.png" alt=""  /></a>
      <?php } ?>
    </div>
  </div>
</div>
<?php
}

function subscribeWidgetAdmin() {

	$settings = get_option("widget_subscribewidget");

	// check if anything's been sent
	if (isset($_POST['update_subscribe'])) {
		$settings['id'] = strip_tags(stripslashes($_POST['subscribe_id']));
		$settings['title'] = strip_tags(stripslashes($_POST['subscribe_title']));
		$settings['text'] = strip_tags(stripslashes($_POST['subscribe_text']));	
		$settings['linkedin'] = strip_tags(stripslashes($_POST['subscribe_linkedin']));
		$settings['twitter'] = strip_tags(stripslashes($_POST['subscribe_twitter']));
		$settings['facebook'] = strip_tags(stripslashes($_POST['subscribe_facebook']));
		$settings['technorati'] = strip_tags(stripslashes($_POST['subscribe_technorati']));
		$settings['digg'] = strip_tags(stripslashes($_POST['subscribe_digg']));
		$settings['delicious'] = strip_tags(stripslashes($_POST['subscribe_delicious']));
		$settings['rssfeed'] = strip_tags(stripslashes($_POST['subscribe_rssfeed']));
		$settings['rss'] = strip_tags(stripslashes($_POST['subscribe_rss']));
		update_option("widget_subscribewidget",$settings);
	}

	echo '<p>
			<label for="subscribe_title">Title:
			<input id="subscribe_title" name="subscribe_title" type="text" class="widefat" value="'.$settings['title'].'" /></label></p>';
	echo '<p>
			<label for="subscribe_text">Text Under Title:
			<textarea class="widefat" rows=5  id="subscribe_text" name="subscribe_text" >'.$settings['text'].'</textarea></label></p>';
	echo '<p>
			<label for="subscribe_id">Feedburner ID:
			<input id="subscribe_id" name="subscribe_id" type="text" class="widefat" value="'.$settings['id'].'" /></label></p>';			
	echo '<p>
			<label for="subscribe_linkedin">LinkedIn: (write full URL) 
			<input id="subscribe_linkedin" name="subscribe_linkedin" type="text" class="widefat" value="'.$settings['linkedin'].'" /></label></p>';
	echo '<p>
			<label for="subscribe_twitter">Twitter: (write full URL) 
			<input id="subscribe_twitter" name="subscribe_twitter" type="text" class="widefat" value="'.$settings['twitter'].'" /></label></p>';			
	echo '<p>
			<label for="subscribe_facebook">Facebook: (write full URL) 
			<input id="subscribe_facebook" name="subscribe_facebook" type="text" class="widefat" value="'.$settings['facebook'].'" /></label></p>';			
	echo '<p>
			<label for="subscribe_technorati">Technorati: (write full URL) 
			<input id="subscribe_technorati" name="subscribe_technorati" type="text" class="widefat" value="'.$settings['technorati'].'" /></label></p>';			
	echo '<p>
			<label for="subscribe_digg">Digg It: (write full URL) 
			<input id="subscribe_digg" name="subscribe_digg" type="text" class="widefat" value="'.$settings['digg'].'" /></label></p>';			
	echo '<p>
			<label for="subscribe_delicious">Del.icio.us: (write full URL) 
			<input id="subscribe_delicious" name="subscribe_delicious" type="text" class="widefat" value="'.$settings['delicious'].'" /></label></p>';			
	echo '<p>
		<label for="subscribe_rss">RSS (write full URL) 
		<input id="subscribe_rss" name="subscribe_rss" type="text" class="widefat" value="'.$settings['rss'].'" /></label></p>';			
		
	echo '<input type="hidden" id="update_subscribe" name="update_subscribe" value="1" />';

}

register_sidebar_widget('PT &rarr; Subscribe', 'subscribeWidget');
register_widget_control('PT &rarr; Subscribe', 'subscribeWidgetAdmin', 400, 200);


// =============================== Advt 220x220px Widget ======================================
class TextWidget extends WP_Widget {
	function TextWidget() {
	//Constructor
		$widget_ops = array('classname' => 'widget Advt 220x220px', 'description' => 'Front Page Text Widget' );		
		$this->WP_Widget('widget_text', 'PT &rarr; Advt 220x220px', $widget_ops);
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
<!--<p><label for="<?php // echo $this->get_field_id('title'); ?>">Widget Title: <input class="widefat" id="<?php // echo $this->get_field_id('title'); ?>" name="<?php // echo $this->get_field_name('title'); ?>" type="text" value="<?php // echo attribute_escape($title); ?>" /></label></p>-->
<p>
  <label for="<?php echo $this->get_field_id('advt1'); ?>">Advt 1 Image Path (ex.http://pt.com/images/banner.jpg)
  <input class="widefat" id="<?php echo $this->get_field_id('advt1'); ?>" name="<?php echo $this->get_field_name('advt1'); ?>" type="text" value="<?php echo attribute_escape($advt1); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('advt_link1'); ?>">Advt 1 link
  <input class="widefat" id="<?php echo $this->get_field_id('advt_link1'); ?>" name="<?php echo $this->get_field_name('advt_link1'); ?>" type="text" value="<?php echo attribute_escape($advt_link1); ?>" />
  </label>
</p>
<?php
	}}
register_widget('TextWidget');


// =============================== Contact Widget ======================================
class ContactWidget extends WP_Widget {
	function ContactWidget() {
	//Constructor
		$widget_ops = array('classname' => 'widget contact', 'description' => 'Front Page contact' );		
		$this->WP_Widget('widget_contact', 'PT &rarr; Contact Us', $widget_ops);
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
  <label for="<?php echo $this->get_field_id('title'); ?>">Widget Title:
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('desc1'); ?>">Company Address
  <textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('desc1'); ?>" name="<?php echo $this->get_field_name('desc1'); ?>"><?php echo attribute_escape($desc1); ?></textarea>
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
register_widget('ContactWidget');


// =============================== Mycart Widget ======================================
class MycartWidget extends WP_Widget {
	function MycartWidget() {
	//Constructor
		$widget_ops = array('classname' => 'widget need help?', 'description' => 'Need Help?' );		
		$this->WP_Widget('widget_mycart', 'PT &rarr; Need Help?', $widget_ops);
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
<!--<p><label for="<?php // echo $this->get_field_id('title'); ?>">Widget Title: <input class="widefat" id="<?php // echo $this->get_field_id('title'); ?>" name="<?php // echo $this->get_field_name('title'); ?>" type="text" value="<?php // echo attribute_escape($title); ?>" /></label></p>-->
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

// =============================== Customer Care Widget ======================================
class CustomerWidget extends WP_Widget {
	function CustomerWidget() {
	//Constructor
		$widget_ops = array('classname' => 'widget contact', 'description' => 'Front Page contact' );		
		$this->WP_Widget('widget_customer', 'PT &rarr; Customer Care', $widget_ops);
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



// =============================== Normal Widget ======================================
class NormalWidget extends WP_Widget {
	function NormalWidget() {
	//Constructor
		$widget_ops = array('classname' => 'widget Text Widget', 'description' => 'Text Widget' );		
		$this->WP_Widget('widget_normal', 'PT &rarr; Text Widget', $widget_ops);
	}
	function widget($args, $instance) {
	// prints the widget
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$desc1 = empty($instance['desc1']) ? '' : apply_filters('widget_desc1', $instance['desc1']);
		 ?>
<div class="widget">
  <h3> <?php echo $title; ?> </h3>
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
register_widget('NormalWidget');

// =============================== Payment Method Widget ======================================
class AboutWidget extends WP_Widget {
	function AboutWidget() {
	//Constructor
		$widget_ops = array('classname' => 'widget Payment Method', 'description' => 'Payment Method' );		
		$this->WP_Widget('widget_about', 'PT &rarr; Payment Method', $widget_ops);
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



// =============================== Flickr widget ======================================

function flickrWidget()
{
	$settings = get_option("widget_flickrwidget");

	$id = $settings['id'];
	$number = $settings['number'];

?>
<div class="widget flickr">
  <h3 class="hl"><span><span class="flickr-logo">flick<b>r</b></span> photostream</span></h3>
  <div class="fix"></div>
  <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script>
  <div class="fix"></div>
</div>
<?php
}
function flickrWidgetAdmin() {

	$settings = get_option("widget_flickrwidget");

	// check if anything's been sent
	if (isset($_POST['update_flickr'])) {
		$settings['id'] = strip_tags(stripslashes($_POST['flickr_id']));
		$settings['number'] = strip_tags(stripslashes($_POST['flickr_number']));

		update_option("widget_flickrwidget",$settings);
	}

	echo '<p>
			<label for="flickr_id">Flickr ID (<a href="http://www.idgettr.com">idGettr</a>):
			<input id="flickr_id" name="flickr_id" type="text" class="widefat" value="'.$settings['id'].'" /></label></p>';
	echo '<p>
			<label for="flickr_number">Number of photos:
			<input id="flickr_number" name="flickr_number" type="text" class="widefat" value="'.$settings['number'].'" /></label></p>';
	echo '<input type="hidden" id="update_flickr" name="update_flickr" value="1" />';

}

register_sidebar_widget('PT &rarr; Flickr Photos', 'flickrWidget');
register_widget_control('PT &rarr; Flickr Photos', 'flickrWidgetAdmin', 250, 200);



// =============================== Latest Posts Widget (particular category) ======================================

class LatestPosts extends WP_Widget {
	function LatestPosts() {
	//Constructor
		$widget_ops = array('classname' => 'widget latest posts', 'description' => 'List of latest posts in particular category' );
		$this->WP_Widget('widget_posts1', 'PT &rarr; Latest Slider Posts', $widget_ops);
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
				$product_image_arr = $Product->get_product_image($post,'medium');
				if($product_image_arr && $product_image_arr[0])
				{
					$imagepath = $product_image_arr[0];
				}
				  if($imagepath)
				  {
				  ?>
    <div class="banner_img "> <a href="<?php the_permalink() ?>"><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $imagepath; ?><?php if($image_height>0){?>&amp;h=<?php echo $image_height; }?>&amp;w=<?php echo $image_width;?>&amp;zc=0&amp;q=80" alt=""  /></a> </div>
    <?php
				  }
				?>
    <h1><a class="widget-title" href="<?php the_permalink(); ?>">
      <?php the_title(); ?>
      </a> </h1>
    <p class="featured-excerpt"><?php echo bm_better_excerpt($content_lenght, ' ... '); ?> </p>
    <div class="button"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">Ver Detalhes</a> </div>
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
  <label for="<?php echo $this->get_field_id('category'); ?>">Categories (<code>IDs</code> separated by commas):
  <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo attribute_escape($category); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('post_number'); ?>">Number of posts:
  <input class="widefat" id="<?php echo $this->get_field_id('post_number'); ?>" name="<?php echo $this->get_field_name('post_number'); ?>" type="text" value="<?php echo attribute_escape($post_number); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('auto_rotate'); ?>">Set slider auto rotation:
  <select id="<?php echo $this->get_field_id('auto_rotate'); ?>" name="<?php echo $this->get_field_name('auto_rotate'); ?>" style="width:50%;">
  <option <?php if(attribute_escape($auto_rotate)=='Yes'){ echo 'selected="selected"';}?>>Yes</option>
  <option <?php if(attribute_escape($auto_rotate)=='No'){ echo 'selected="selected"';}?>>No</option>
  </select>
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('speed'); ?>">Slider rotation speed(frame/milisecond):
  <input class="widefat" id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" type="text" value="<?php echo attribute_escape($speed); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('image_width'); ?>">Slider image Width in px <br />(Default is 420px):
  <input class="widefat" id="<?php echo $this->get_field_id('image_width'); ?>" name="<?php echo $this->get_field_name('image_width'); ?>" type="text" value="<?php echo attribute_escape($image_width); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('image_height'); ?>">Slider image Height in px <br />(Default is 460px):
  <input class="widefat" id="<?php echo $this->get_field_id('image_height'); ?>" name="<?php echo $this->get_field_name('image_height'); ?>" type="text" value="<?php echo attribute_escape($image_height); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('content_lenght'); ?>">Slider content Length in characters:
  <input class="widefat" id="<?php echo $this->get_field_id('content_lenght'); ?>" name="<?php echo $this->get_field_name('content_lenght'); ?>" type="text" value="<?php echo attribute_escape($content_lenght); ?>" />
  </label>
</p>
<?php
	}

}

register_widget('LatestPosts');



// =============================== Popular Posts Widget ======================================

function PopularPostsSidebar()
{

    $settings_pop = get_option("widget_popularposts");

	$name = $settings_pop['name'];
	$number = $settings_pop['number'];
	if ($name <> "") { $popname = $name; } else { $popname = 'Popular Posts'; }
	if ($number <> "") { $popnumber = $number; } else { $popnumber = '10'; }

?>
<div class="widget popular">
  <h3 class="hl"><span><?php echo $popname; ?></span></h3>
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
}
function PopularPostsAdmin() {

	$settings_pop = get_option("widget_popularposts");

	// check if anything's been sent
	if (isset($_POST['update_popular'])) {
		$settings_pop['name'] = strip_tags(stripslashes($_POST['popular_name']));
		$settings_pop['number'] = strip_tags(stripslashes($_POST['popular_number']));

		update_option("widget_popularposts",$settings_pop);
	}

	echo '<p>
			<label for="popular_name">Title:
			<input id="popular_name" name="popular_name" type="text" class="widefat" value="'.$settings_pop['name'].'" /></label></p>';
	echo '<p>
			<label for="popular_number">Number of popular posts:
			<input id="popular_number" name="popular_number" type="text" class="widefat" value="'.$settings_pop['number'].'" /></label></p>';
	echo '<input type="hidden" id="update_popular" name="update_popular" value="1" />';

}

register_sidebar_widget('PT &rarr; Popular Posts', 'PopularPostsSidebar');
register_widget_control('PT &rarr; Popular Posts', 'PopularPostsAdmin', 250, 200);


// =============================== Twitter widget ======================================
// Plugin Name: Twitter Widget
// Plugin URI: http://seanys.com/2007/10/12/twitter-wordpress-widget/
// Description: Adds a sidebar widget to display Twitter updates (uses the Javascript <a href="http://twitter.com/badges/which_badge">Twitter 'badge'</a>)
// Version: 1.0.3
// Author: Sean Spalding
// Author URI: http://seanys.com/
// License: GPL

function widget_Twidget_init() {

	if ( !function_exists('register_sidebar_widget') )
		return;

	function widget_Twidget($args) {

		// "$args is an array of strings that help widgets to conform to
		// the active theme: before_widget, before_title, after_widget,
		// and after_title are the array keys." - These are set up by the theme
		extract($args);

		// These are our own options
		$options = get_option('widget_Twidget');
		$account = $options['account'];  // Your Twitter account name
		$title = $options['title'];  // Title in sidebar for widget
		$show = $options['show'];  // # of Updates to show
		$follow = $options['follow'];  // # of Updates to show

        // Output
		echo $before_widget ;

		// start
		echo '<div class="twitter clearfix"><div class="twitter_icon"><a href="http://www.twitter.com/'.$account.'/" title="'.$follow.'">'.$title.' </a></div>';              
		echo '<div class="twitter_post"><div id="twitter">';
		echo '<ul id="twitter_update_list"><li></li></ul>
		      <script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>';
		echo '<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/'.$account.'.json?callback=twitterCallback2&amp;count='.$show.'"></script>';
		echo '</div></div></div>';
			
				
		// echo widget closing tag
		echo $after_widget;
	}

	// Settings form
	function widget_Twidget_control() {

		// Get options
		$options = get_option('widget_Twidget');
		// options exist? if not set defaults
		if ( !is_array($options) )
			$options = array('account'=>'rbhavesh', 'title'=>'Twitter Updates', 'show'=>'3');

        // form posted?
		if ( $_POST['Twitter-submit'] ) {

			// Remember to sanitize and format use input appropriately.
			$options['account'] = strip_tags(stripslashes($_POST['Twitter-account']));
			$options['title'] = strip_tags(stripslashes($_POST['Twitter-title']));
			$options['show'] = strip_tags(stripslashes($_POST['Twitter-show']));
			$options['follow'] = strip_tags(stripslashes($_POST['Twitter-follow']));
			$options['linkedin'] = strip_tags(stripslashes($_POST['Twitter-linkedin']));
			$options['facebook'] = strip_tags(stripslashes($_POST['Twitter-facebook']));
			update_option('widget_Twidget', $options);
		}

		// Get options for form fields to show
		$account = htmlspecialchars($options['account'], ENT_QUOTES);
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$show = htmlspecialchars($options['show'], ENT_QUOTES);
		$follow = htmlspecialchars($options['follow'], ENT_QUOTES);

		// The form fields
		echo '<p style="text-align:left;">
				<label for="Twitter-account">' . __('Twitter Account ID:') . '
				<input style="width: 280px;" id="Twitter-account" name="Twitter-account" type="text" value="'.$account.'" />
				</label></p>';
		echo '<p style="text-align:left;">
				<label for="Twitter-title">' . __('Title:') . '
				<input style="width: 280px;" id="Twitter-title" name="Twitter-title" type="text" value="'.$title.'" />
				</label></p>';
		echo '<p style="text-align:left;">
				<label for="Twitter-show">' . __('Show Twitter Posts:') . '
				<input style="width: 280px;" id="Twitter-show" name="Twitter-show" type="text" value="'.$show.'" />
				</label></p>';
		echo '<input type="hidden" id="Twitter-submit" name="Twitter-submit" value="1" />';
	}


	// Register widget for use
	register_sidebar_widget(array('PT &rarr; Twitter', 'widgets'), 'Widget_Twidget');

	// Register settings for use, 300x200 pixel form
	register_widget_control(array('PT &rarr; Twitter', 'widgets'), 'Widget_Twidget_control', 300, 200);
	
}

// =============================== Browse By Categories Widget (particular category) ======================================

class browse_by_categories extends WP_Widget {
	function browse_by_categories() {
	//Constructor
		$widget_ops = array('classname' => 'widget browse_by_cats', 'description' => 'Category Listing' );
		$this->WP_Widget('browse_by_cats', 'PT &rarr; Browse By Categories', $widget_ops);
	}

	function widget($args, $instance) {
	// prints the widget

		extract($args, EXTR_SKIP);
		echo $before_widget;
 		$title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_category', $instance['title']);
		$category = empty($instance['category']) ? '&nbsp;' : apply_filters('widget_category', $instance['category']);
		if($before_title=='' || $after_title=='')
		{
			$before_title=='<h3>';
			$after_title=='</h3>';
		}
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
        ?>
      <ul class="browse_by_category">
		<?php
        $ex_catIdArr = get_categories('exclude=' . $category );
        $catIdArr = array();
        foreach($ex_catIdArr as $ex_catIdArrObj)
        {
            $catIdArr[] = $ex_catIdArrObj->term_id;
        }
        $includeCats = implode(',',$catIdArr);
        wp_list_categories('orderby=name&title_li=&include='.$includeCats);
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

// =============================== Shopping Cart info Widget (particular category) ======================================

class shopping_cart_info extends WP_Widget {
	function shopping_cart_info() {
	//Constructor
		$widget_ops = array('classname' => 'widget shopping_cart_info', 'description' => 'Shopping Cart Information' );
		$this->WP_Widget('shopping_cart_info', 'PT &rarr; Shopping Cart Information', $widget_ops);
	}

	function widget($args, $instance) {
	// prints the widget

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
		?>
        <div class="shoppingcart_box">
            <?php if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };?>
            <div> <p><?php _e('Você tem');?> <a href="<?php echo site_url('/?ptype=cart'); ?>"><strong> <span id="cart_information_span1"><?php echo $itemsInCartCount . "(".$General->get_currency_symbol()."$cartAmount)";?></span></strong></a> <?php _e(SHOPPING_CART_CONTENT_TEXT);?> </p>
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


// =============================== Latest Products Widget ======================================

class latest_product_widget extends WP_Widget {
	function latest_product_widget() {
	//Constructor
		$widget_ops = array('classname' => 'widget latest_product_info', 'description' => 'Latest Products' );
		$this->WP_Widget('latest_product_info', 'PT &rarr; Latest Products', $widget_ops);
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
		$title = empty($instance['title']) ? __('Latest Products') : apply_filters('widget_category', $instance['title']);
		$display_prds_no = empty($instance['display_prds_no']) ? 10 : apply_filters('widget_category', $instance['display_prds_no']);
		$list_type = empty($instance['display_prds_no']) ? 'Grid' : apply_filters('widget_category', $instance['list_type']);
		$show_store_link = empty($instance['show_store_link']) ? '' : apply_filters('widget_category', $instance['show_store_link']);
		$image_width = empty($instance['image_width']) ? '' : apply_filters('widget_image_width', $instance['image_width']);
		$image_height = empty($instance['image_height']) ? '' : apply_filters('widget_image_height', $instance['image_height']);
		?>
      <h3 class="title"><?php echo $title;?> </h3>
  <?php
if(have_posts())
{
	$limit = $display_prds_no;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$blogCategoryIdStr = str_replace(',',',-',get_inc_categories("cat_exclude_"));
	query_posts('showposts=' . $limit . '&paged=' . $paged .'&cat='.$blogCategoryIdStr);

?>
  <ul style="display: block;" class="display <?php if($list_type=='Grid'){echo 'thumb_view';}?> category_list">
    <?php
    while(have_posts())
    {
        the_post();
		$post->image_width = $image_width;
		$post->image_height = $image_height;
		$Product->product_listing_li($post);
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
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['display_prds_no'] = strip_tags($new_instance['display_prds_no']);
		$instance['list_type'] = strip_tags($new_instance['list_type']);
		$instance['show_store_link'] = strip_tags($new_instance['show_store_link']);
		$instance['image_width'] = strip_tags($new_instance['image_width']);
		$instance['image_height'] = strip_tags($new_instance['image_height']);		
		return $instance;
	}

	function form($instance) {
	//widgetform in backend	
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Latest Products','display_prds_no' => '10','list_type' => 'Grid' ,'show_store_link' => '1') );
		$title = strip_tags($instance['title']);
		$display_prds_no = strip_tags($instance['display_prds_no']);
		$list_type = strip_tags($instance['list_type']);
		$show_store_link = strip_tags($instance['show_store_link']);
		$image_width = strip_tags($instance['image_width']);
		$image_height = strip_tags($instance['image_height']);		
?>
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

<?php
	}

}
register_widget('latest_product_widget');

// =============================== Login Links Widget ======================================

class login_links_widget extends WP_Widget {
	function login_links_widget() {
	//Constructor
		$widget_ops = array('classname' => 'widget login_info', 'description' => 'Login Information' );
		$this->WP_Widget('login_info', 'PT &rarr; Login Information', $widget_ops);
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
      </div>
     <div> 
    <ul>
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
    <li id="checkout_widget_li"><a href="<?php echo site_url('/?ptype=cart'); ?>"><?php _e('Sair');?></a></li>
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

// =============================== Login Links Widget ======================================

class banner_widget extends WP_Widget {
	function banner_widget() {
	//Constructor
		$widget_ops = array('classname' => 'widget banner_widget', 'description' => 'Set Advertisement either banner or Google Ad Sence Code' );
		$this->WP_Widget('banner_widget', 'PT &rarr; Set Advertisement', $widget_ops);
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
?>