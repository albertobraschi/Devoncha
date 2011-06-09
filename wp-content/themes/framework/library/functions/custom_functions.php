<?php 
// Excerpt length

function bm_better_excerpt($length, $ellipsis) {
$text = get_the_content();
$text = strip_tags($text);
$text = substr($text, 0, $length);
//$text = substr($text, 0, strrpos($text, " "));
if(strlen(get_the_content())>$text)
{
$text = $text.$ellipsis;
}else
{
	$text = $text;	
}
return $text;
}
// Custom fields for WP write panel
//http://creativecommons.org/licenses/by-nc-nd/3.0/
function ptthemes_meta_box_content() {
    global $post, $pt_metaboxes;
    $output = '';
    $output .= '<div class="pt_metaboxes_table">'."\n";
    foreach ($pt_metaboxes as $pt_id => $pt_metabox) {
    if($pt_metabox['type'] == 'text' OR $pt_metabox['type'] == 'select' OR $pt_metabox['type'] == 'checkbox' OR $pt_metabox['type'] == 'textarea')
            $pt_metaboxvalue = get_post_meta($post->ID,$pt_metabox["name"],true);
            if ($pt_metaboxvalue == "" || !isset($pt_metaboxvalue)) {
                $pt_metaboxvalue = $pt_metabox['default'];
            }
            if($pt_metabox['type'] == 'text'){
            
                $output .= "\t".'<div>';
                $output .= "\t\t".'<br/><p><strong><label for="'.$pt_id.'">'.$pt_metabox['label'].'</label></strong></p>'."\n";
                $output .= "\t\t".'<p><input size="100" class="pt_input_text" type="'.$pt_metabox['type'].'" value="'.$pt_metaboxvalue.'" name="ptthemes_'.$pt_metabox["name"].'" id="'.$pt_id.'"/></p>'."\n";
                $output .= "\t\t".'<p><span style="font-size:11px">'.$pt_metabox['desc'].'</span></p>'."\n";
                $output .= "\t".'</div>'."\n";
                              
            }
            
            elseif ($pt_metabox['type'] == 'textarea'){
            			
				$output .= "\t".'<div>';
                $output .= "\t\t".'<br/><p><strong><label for="'.$pt_id.'">'.$pt_metabox['label'].'</label></strong></p>'."\n";
                $output .= "\t\t".'<p><textarea rows="5" cols="98" class="pt_input_textarea" name="ptthemes_'.$pt_metabox["name"].'" id="'.$pt_id.'">' . $pt_metaboxvalue . '</textarea></p>'."\n";
                $output .= "\t\t".'<p><span style="font-size:11px">'.$pt_metabox['desc'].'</span></p>'."\n";
                $output .= "\t".'</div>'."\n";
                              
            }

            elseif ($pt_metabox['type'] == 'select'){
                            
                $output .= "\t".'<div>';
                $output .= "\t\t".'<br/><p><strong><label for="'.$pt_id.'">'.$pt_metabox['label'].'</label></strong></p>'."\n";
                $output .= "\t\t".'<p><select class="pt_input_select" id="'.$pt_id.'" name="ptthemes_'. $pt_metabox["name"] .'"></p>'."\n";
                $output .= '<option> - Select One -</option>';
                
                $array = $pt_metabox['options'];
                
                if($array){
                    foreach ( $array as $id => $option ) {
                        $selected = '';
                        if($pt_metabox['default'] == $option){$selected = 'selected="selected"';} 
                        if($pt_metaboxvalue == $option){$selected = 'selected="selected"';}
                        $output .= '<option value="'. $option .'" '. $selected .'>' . $option .'</option>';
                    }
                }
                
                $output .= '</select><p><span style="font-size:11px">'.$pt_metabox['desc'].'</span></p>'."\n";
                $output .= "\t".'</div>'."\n";
            }
            
            elseif ($pt_metabox['type'] == 'checkbox'){
                if($pt_metaboxvalue == 'on') { $checked = 'checked="checked"';} else {$checked='';}
                
				$output .= "\t".'<div>';
                $output .= "\t\t".'<br/><p><strong><label for="'.$pt_id.'">'.$pt_metabox['label'].'</label></strong></p>'."\n";
                $output .= "\t\t".'<p><input type="checkbox" '.$checked.' class="pt_input_checkbox"  id="'.$pt_id.'" name="ptthemes_'. $pt_metabox["name"] .'" /></p>'."\n";
                $output .= "\t\t".'<p><span style="font-size:11px">'.$pt_metabox['desc'].'</span></p>'."\n";
                $output .= "\t".'</div>'."\n";

            }
        
        }
    
    $output .= '</div>'."\n\n";
    echo $output;
}

function ptthemes_metabox_insert() {
    global $pt_metaboxes;
    global $globals;
    $pID = $_POST['post_ID'];
    $counter = 0;

    if($pt_metaboxes)
	{
		foreach ($pt_metaboxes as $pt_metabox) { // On Save.. this gets looped in the header response and saves the values submitted
		if($pt_metabox['type'] == 'text' OR $pt_metabox['type'] == 'select' OR $pt_metabox['type'] == 'checkbox' OR $pt_metabox['type'] == 'textarea') // Normal Type Things...
			{
				$var = "ptthemes_".$pt_metabox["name"];
				if (isset($_POST[$var])) {            
					if( get_post_meta( $pID, $pt_metabox["name"] ) == "" )
						add_post_meta($pID, $pt_metabox["name"], $_POST[$var], true );
					elseif($_POST[$var] != get_post_meta($pID, $pt_metabox["name"], true))
						update_post_meta($pID, $pt_metabox["name"], $_POST[$var]);
					elseif($_POST[$var] == "")
						delete_post_meta($pID, $pt_metabox["name"], get_post_meta($pID, $pt_metabox["name"], true));
				}  
			} 
		}
	}
}

function ptthemes_header_inserts(){
	//echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/library/functions/admin_style.css" media="screen" />';
}

function ptthemes_meta_box() {
    if ( function_exists('add_meta_box') ) {
       // add_meta_box('ptthemes-settings',$GLOBALS['themename'].' Custom Settings','ptthemes_meta_box_content','post','normal','high');
    }
}

$blogCategoryIdStr = get_inc_categories("cat_exclude_");
$blogCategoryIdArr = explode(',',$blogCategoryIdStr);
$postCatArr = wp_get_post_categories( $post_id = $_REQUEST['post']);
$editpost = 0;
if($_GET['action'] == 'edit')
{
	if(count(array_intersect($blogCategoryIdArr,$postCatArr))>0)
	{
		$editpost = 1;
	}
}
if($_GET['ptype']!='prd' || $_POST || $editpost==1)
{
add_action('admin_menu', 'ptthemes_meta_box');
add_action('admin_head', 'ptthemes_header_inserts');
add_action('save_post', 'ptthemes_metabox_insert');
}

function relativeDate($posted_date) {
    
    $tz = 0;    // change this if your web server and weblog are in different timezones
                // see project page for instructions on how to do this
    
    $month = substr($posted_date,4,2);
    
    if ($month == "02") { // february
    	// check for leap year
    	$leapYear = isLeapYear(substr($posted_date,0,4));
    	if ($leapYear) $month_in_seconds = 2505600; // leap year
    	else $month_in_seconds = 2419200;
    }
    else { // not february
    // check to see if the month has 30/31 days in it
    	if ($month == "04" or 
    		$month == "06" or 
    		$month == "09" or 
    		$month == "11")
    		$month_in_seconds = 2592000; // 30 day month
    	else $month_in_seconds = 2678400; // 31 day month;
    }
  
/* 
some parts of this implementation borrowed from:
http://maniacalrage.net/archives/2004/02/relativedatesusing/ 
*/
  
    $in_seconds = strtotime(substr($posted_date,0,8).' '.
                  substr($posted_date,8,2).':'.
                  substr($posted_date,10,2).':'.
                  substr($posted_date,12,2));
    $diff = time() - ($in_seconds + ($tz*3600));
    $months = floor($diff/$month_in_seconds);
    $diff -= $months*2419200;
    $weeks = floor($diff/604800);
    $diff -= $weeks*604800;
    $days = floor($diff/86400);
    $diff -= $days*86400;
    $hours = floor($diff/3600);
    $diff -= $hours*3600;
    $minutes = floor($diff/60);
    $diff -= $minutes*60;
    $seconds = $diff;

    if ($months>0) {
        // over a month old, just show date ("Month, Day Year")
        echo ''; the_time('F jS, Y');
    } else {
        if ($weeks>0) {
            // weeks and days
            $relative_date .= ($relative_date?', ':'').$weeks.' '.get_option('ptthemes_relative_week').''.($weeks>1?''.'s'.'':'');
            $relative_date .= $days>0?($relative_date?', ':'').$days.' '.get_option('ptthemes_relative_day').''.($days>1?''.'s'.'':''):'';
        } elseif ($days>0) {
            // days and hours
            $relative_date .= ($relative_date?', ':'').$days.' '.get_option('ptthemes_relative_day').''.($days>1?''.'s'.'':'');
            $relative_date .= $hours>0?($relative_date?', ':'').$hours.' '.get_option('ptthemes_relative_hour').''.($hours>1?''.'s'.'':''):'';
        } elseif ($hours>0) {
            // hours and minutes
            $relative_date .= ($relative_date?', ':'').$hours.' '.get_option('ptthemes_relative_hour').''.($hours>1?''.'s'.'':'');
            $relative_date .= $minutes>0?($relative_date?', ':'').$minutes.' '.get_option('ptthemes_relative_minute').''.($minutes>1?''.'s'.'':''):'';
        } elseif ($minutes>0) {
            // minutes only
            $relative_date .= ($relative_date?', ':'').$minutes.' '.get_option('ptthemes_relative_minute').''.($minutes>1?''.'s'.'':'');
        } else {
            // seconds only
            $relative_date .= ($relative_date?', ':'').$seconds.' '.get_option('ptthemes_relative_minute').''.($seconds>1?''.'s'.'':'');
        }
        
        // show relative date and add proper verbiage
    	echo 'Posted'.$relative_date.'ago';
    }
    
}

function isLeapYear($year) {
        return $year % 4 == 0 && ($year % 400 == 0 || $year % 100 != 0);
}

    if(!function_exists('how_long_ago')){
        function how_long_ago($timestamp){
            $difference = time() - $timestamp;

            if($difference >= 60*60*24*365){        // if more than a year ago
                $int = intval($difference / (60*60*24*365));
                $s = ($int > 1) ? ''.'s'.'' : '';
                $r = $int .'year'. $s . 'ago';
            } elseif($difference >= 60*60*24*7*5){  // if more than five weeks ago
                $int = intval($difference / (60*60*24*30));
                $s = ($int > 1) ? ''.'s'.'' : '';
                $r = $int . 'month' . $s . 'ago';
            } elseif($difference >= 60*60*24*7){        // if more than a week ago
                $int = intval($difference / (60*60*24*7));
                $s = ($int > 1) ? ''.'s'.'' : '';
                $r = $int . ' week' . $s . 'ago';
            } elseif($difference >= 60*60*24){      // if more than a day ago
                $int = intval($difference / (60*60*24));
                $s = ($int > 1) ? ''.'s'.'' : '';
                $r = $int . 'day' . $s . 'ago';
            } elseif($difference >= 60*60){         // if more than an hour ago
                $int = intval($difference / (60*60));
                $s = ($int > 1) ? ''.'s'.'' : '';
                $r = $int . 'hour' . $s . 'ago';
            } elseif($difference >= 60){            // if more than a minute ago
                $int = intval($difference / (60));
                $s = ($int > 1) ? ''.'s'.'' : '';
                $r = $int . 'minute' . $s . 'ago';
            } else {                                // if less than a minute ago
                $r = ''.get_option('ptthemes_relative_moments').'ago';
            }

            return $r;
        }
    }

/*
Plugin Name: WP-PageNavi 
Plugin URI: http://www.lesterchan.net/portfolio/programming.php 
*/ 

function wp_pagenavi($before = '', $after = '', $prelabel = '', $nxtlabel = '', $pages_to_show = 5, $always_show = false) {

	global $request, $posts_per_page, $wpdb, $paged, $totalpost_count, $posts_per_page_homepage;
	if($posts_per_page_homepage)
	{
		$posts_per_page = $posts_per_page_homepage;
	}
	if(empty($prelabel)) {
		$prelabel  = '<strong>&laquo;</strong>';
	}
	if(empty($nxtlabel)) {
		$nxtlabel = '<strong>&raquo;</strong>';
	}
	$half_pages_to_show = round($pages_to_show/2);
	if (!is_single()) {
		if(is_tag()) {
			preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);		
		} elseif (!is_category()) {
			preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches);	
		} else {
			preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);		
		}
		$fromwhere = $matches[1];
		$numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
		
	}
	if($totalpost_count)
	{
		$numposts = $totalpost_count;
	}
	$max_page = ceil($numposts /$posts_per_page);
		if(empty($paged)) {
			$paged = 1;
		}
		if($max_page > 1 || $always_show) {
			echo "$before <div class='Navi'>";
			if ($paged >= ($pages_to_show-1)) {
				echo '<a href="'.str_replace('&','&amp;',str_replace('&','&amp;',get_pagenum_link())).'">&laquo; First</a>';
			}
			previous_posts_link($prelabel);
			for($i = $paged - $half_pages_to_show; $i  <= $paged + $half_pages_to_show; $i++) {
				if ($i >= 1 && $i <= $max_page) {
					if($i == $paged) {
						echo "<strong class='on'>$i</strong>";
					} else {
						echo ' <a href="'.str_replace('&','&amp;',get_pagenum_link($i)).'">'.$i.'</a> ';
					}
				}
			}
			next_posts_link($nxtlabel, $max_page);
			if (($paged+$half_pages_to_show) < ($max_page)) {
				echo '<a href="'.str_replace('&','&amp;',get_pagenum_link($max_page)).'">Last &raquo;</a>';
			}
			echo "</div> $after";
		}
}

///////////NEW FUNCTIONS  START//////
function bdw_get_images($iPostID,$img_size='thumb') 
{
    $arrImages =& get_children('order=ASC&orderby=menu_order ID&post_type=attachment&post_mime_type=image&post_parent=' . $iPostID );
	
	$return_arr = array();
	if($arrImages) 
	{		
       foreach($arrImages as $key=>$val)
	   {
	   		$id = $val->ID;
			if($img_size == 'large')
			{
				$img_arr = wp_get_attachment_image_src($id,'full');	// THE FULL SIZE IMAGE INSTEAD
				$img_arr['id'] = $id;
				$return_arr[] = $img_arr;
			}
			elseif($img_size == 'medium')
			{
				$img_arr = wp_get_attachment_image_src($id, 'medium'); //THE medium SIZE IMAGE INSTEAD
				$img_arr['id'] = $id;
				$return_arr[] = $img_arr;
			}
			elseif($img_size == 'thumb')
			{
				$img_arr = wp_get_attachment_image_src($id, 'thumbnail'); // Get the thumbnail url for the attachment
				$img_arr['id'] = $id;
				$return_arr[] = $img_arr;
				
			}
	   }
	  return $return_arr;
	}
}

// Use Noindex for sections specified in theme admin

function ptthemes_noindex_head() { 

    if ((is_category() && get_option('ptthemes_noindex_category')) ||
	    (is_tag() && get_option('ptthemes_noindex_tag')) ||
		(is_day() && get_option('ptthemes_noindex_daily')) ||
		(is_month() && get_option('ptthemes_noindex_monthly')) ||
		(is_year() && get_option('ptthemes_noindex_yearly')) ||
		(is_author() && get_option('ptthemes_noindex_author')) ||
		(is_search() && get_option('ptthemes_noindex_search'))) {

		$meta_string .= '<meta name="robots" content="noindex,follow" />';
	}
	
	echo $meta_string;
	
}

add_action('wp_head', 'ptthemes_noindex_head');

///NEW FUNCTIONS START////

function get_the_category_list_custom( $parents='',$returntype='array') 
{
	global $wp_rewrite;
	$categories = get_the_category( $post_id );

	$thelist = array();
	if($parents){ $thelist[] = $parents;}
	$i = 0;
	foreach ( $categories as $category ) {
		if ( 0 < $i )
			$thelist[]= $category->term_id;
		++$i;
	}
	if($returntype=='array')
	{
		return $thelist;
	}elseif($returntype=='string')
	{
		if($thelist)
		{
			return implode(',',$thelist);
		}else
		{
			return '';
		}
	}
}

function get_child_image($image='',$is_show=false)
{
	if($is_show)
	{
		echo get_stylesheet_directory_uri()."/images/$image";
	}else
	{
		return get_stylesheet_directory_uri()."/images/$image";
	}
}

function get_childtheme_path($file='',$is_show=false)
{
	$path = get_stylesheet_directory_uri()."/$file";	
	
	if($is_show){
		echo $path;
	}else{
		return $path;
	}
}

function cmp($a, $b) 
{
	if ($a == $b) {
		return 0;
	}
	return ($a < $b) ? -1 : 1;
}

function country_dl($cid='')
{
 global $wpdb,$country_db_table_name;
 $sql = "select country,title  from $country_db_table_name order by title";
 $countryinfo = $wpdb->get_results($sql);
$option_str = '';
foreach($countryinfo as $countryinfoObj)
 {
	 $country_id = $countryinfoObj->country;
	 $title = $countryinfoObj->title;
	 if($cid==$country_id)
	 {
		 $option_str .= '<option value="'.$country_id.'" selected>'. $title.'</option>';
	 }else
	 {
		$option_str .= '<option value="'.$country_id.'">'. $title.'</option>';	 
	 }
	 
 }
 return $option_str;
}
function frontend_country_dl($cid='')
{
 global $wpdb,$country_db_table_name;
 $sql = "select country,title  from $country_db_table_name order by title";
 $countryinfo = $wpdb->get_results($sql);
$option_str = '';
foreach($countryinfo as $countryinfoObj)
 {
	 $title = $countryinfoObj->title;
	 if($cid==$title)
	 {
		 $option_str .= '<option value="'.$title.'" selected>'. $title.'</option>';
	 }else
	 {
		$option_str .= '<option value="'.$title.'">'. $title.'</option>';	 
	 }
	 
 }
 return $option_str;
}

function wp_enable_cufon_font()
{
	if(get_option('ptthemes_cufon_flag'))
	{
		$font = 'Rockwell_Condensed_400-Rockwell_Condensed_700.font.js';
	?>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/cufon/cufon-yui.js"></script>
    
    <?php 
	
	if(CHILDTEMPLATEPATH  && file_exists(CHILDTEMPLATEPATH . '/library/js/cufon_font.js')) { ?> 
   <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/library/js/cufon_font.js"></script>
   <?php } else { ?> 
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/cufon/<?php echo $font;?>"></script>
    <?php
	}
  }
}

function twentyten_continue_reading_link() {
	return ' <a href="'. get_permalink() . '" class="readmore">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyten_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function twentyten_auto_excerpt_more( $more ) {
	return ' &hellip;' . twentyten_continue_reading_link();
}
add_filter( 'excerpt_more', 'twentyten_auto_excerpt_more' );
?>