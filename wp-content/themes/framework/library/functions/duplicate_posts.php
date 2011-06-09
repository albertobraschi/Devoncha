<?php
////////////Duplicate POST START/////////
/*
 * This function calls the creation of a new copy of the selected post (as a draft)
 * then redirects to the edit post screen
 */
if(!function_exists('duplicate_post_save_as_new_post'))
{
function duplicate_post_save_as_new_post(){
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'duplicate_post_save_as_new_post' == $_REQUEST['action'] ) ) ) {
		wp_die(__('No post to duplicate has been supplied!'));
	}

	// Get the original post
	$id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
	$post = duplicate_post_get_post($id);

	// Copy the post and insert it
	if (isset($post) && $post!=null) {
		$new_id = duplicate_post_create_duplicate_from_post($post);

		// If you have written a plugin which uses non-WP database tables to save
		// information about a post you can hook this action to dupe that data.
		do_action( 'dp_duplicate_post', $new_id, $post );

		// Redirect to the edit screen for the new draft post
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_id ) );
		exit;
	} else {
		wp_die(__('Post creation failed, could not find original post:') . ' ' . $id);
	}
}
}
add_action('admin_action_duplicate_post_save_as_new_post', 'duplicate_post_save_as_new_post');


add_filter('post_row_actions', 'duplicate_post_make_duplicate_link_row',10,2);
if(!function_exists('duplicate_post_make_duplicate_link_row')){
function duplicate_post_make_duplicate_link_row($actions, $post) {
		$actions['duplicate'] = '<a href="admin.php?action=duplicate_post_save_as_new_post&amp;post=' . $post->ID . '" title="' . __("Make a duplicate from this post")
		. '" rel="permalink">' .  __("Duplicate") . '</a>';
	return $actions;
}
}
/**
 * Add a button in the post/page edit screen to create a clone
 */
add_action( 'post_submitbox_start', 'duplicate_post_add_duplicate_post_button' );

if(!function_exists('duplicate_post_add_duplicate_post_button')){
function duplicate_post_add_duplicate_post_button() {
		$act = "admin.php?action=duplicate_post_save_as_new_post";
		global $post;
		if ($post->post_type == "page") $act = "admin.php?action=duplicate_post_save_as_new_page";
		$notifyUrl = $act."&post=" . $_GET['post'];
		?>
<div id="duplicate-action"><a class="submitduplicate duplication"
	href="<?php echo $notifyUrl; ?>"><?php _e('Copy to a new draft'); ?></a>
</div>
		<?php
}
}
/*
 * This function calls the creation of a new copy of the selected post (as a draft)
 * then redirects to the edit post screen
 */
 if(!function_exists('duplicate_post_save_as_new_post')){
function duplicate_post_save_as_new_post(){
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'duplicate_post_save_as_new_post' == $_REQUEST['action'] ) ) ) {
		wp_die(__('No post to duplicate has been supplied!'));
	}

	// Get the original post
	$id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
	$post = duplicate_post_get_post($id);

	// Copy the post and insert it
	if (isset($post) && $post!=null) {
		$new_id = duplicate_post_create_duplicate_from_post($post);

		// If you have written a plugin which uses non-WP database tables to save
		// information about a post you can hook this action to dupe that data.
		do_action( 'dp_duplicate_post', $new_id, $post );

		// Redirect to the edit screen for the new draft post
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_id ) );
		exit;
	} else {
		wp_die(__('Post creation failed, could not find original post:') . ' ' . $id);
	}
}
 }
add_action('admin_action_duplicate_post_save_as_new_post', 'duplicate_post_save_as_new_post');
add_filter('post_row_actions', 'duplicate_post_make_duplicate_link_row',10,2);

 if(!function_exists('duplicate_post_make_duplicate_link_row')){
function duplicate_post_make_duplicate_link_row($actions, $post) {
	if (duplicate_post_is_current_user_allowed_to_copy()) {
		$actions['duplicate'] = '<a href="admin.php?action=duplicate_post_save_as_new_post&amp;post=' . $post->ID . '" title="' . __("Make a duplicate from this post")
		. '" rel="permalink">' .  __("Duplicate") . '</a>';
	}
	return $actions;
}
}

/**
 * Add a button in the post/page edit screen to create a clone
 */
add_action( 'post_submitbox_start', 'duplicate_post_add_duplicate_post_button' );

if(!function_exists('duplicate_post_add_duplicate_post_button')){
function duplicate_post_add_duplicate_post_button() {
	if ( isset( $_GET['post'] ) && duplicate_post_is_current_user_allowed_to_copy()) {
		$act = "admin.php?action=duplicate_post_save_as_new_post";
		global $post;
		if ($post->post_type == "page") $act = "admin.php?action=duplicate_post_save_as_new_page";
		$notifyUrl = $act."&post=" . $_GET['post'];
		?>
<div id="duplicate-action"><a class="submitduplicate duplication"
	href="<?php echo $notifyUrl; ?>"><?php _e('Copy to a new draft'); ?></a>
</div>
		<?php
	}
}
}

/**
 * Get a post from the database
 */
if(!function_exists('duplicate_post_get_post')){
function duplicate_post_get_post($id) {
	global $wpdb;
	$post = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE ID=$id");
	if ($post->post_type == "revision"){
		$id = $post->post_parent;
		$post = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE ID=$id");
	}
	return $post[0];
}
}

/**
 * Create a duplicate from a post
 */
if(!function_exists('duplicate_post_create_duplicate_from_post')){
function duplicate_post_create_duplicate_from_post($post) {
	global $wpdb;
	//$new_post_type = 'post';
	$new_post_author = duplicate_post_get_current_user();
	$new_post_date = (get_option('duplicate_post_copydate') == 1)?  $post->post_date : current_time('mysql');
	$new_post_date_gmt = get_gmt_from_date($new_post_date);
	$prefix = get_option('duplicate_post_title_prefix');
	if (!empty($prefix)) $prefix.= " ";

	$new_post_type 	= $post->post_type;
	$post_content    = str_replace("'", "''", $post->post_content);
	$post_content_filtered = str_replace("'", "''", $post->post_content_filtered);
	$post_excerpt    = str_replace("'", "''", $post->post_excerpt);
	$post_title      = $prefix.str_replace("'", "''", $post->post_title);
	$post_status     = str_replace("'", "''", $post->post_status);
	$post_name       = str_replace("'", "''", $post->post_name);
	$comment_status  = str_replace("'", "''", $post->comment_status);
	$ping_status     = str_replace("'", "''", $post->ping_status);

	// Insert the new template in the post table
	$wpdb->query(
			"INSERT INTO $wpdb->posts
			(post_author, post_date, post_date_gmt, post_content, post_content_filtered, post_title, post_excerpt,  post_status, post_type, comment_status, ping_status, post_password, to_ping, pinged, post_modified, post_modified_gmt, post_parent, menu_order, post_mime_type)
			VALUES
			('$new_post_author->ID', '$new_post_date', '$new_post_date_gmt', '$post_content', '$post_content_filtered', '$post_title', '$post_excerpt', 'draft', '$new_post_type', '$comment_status', '$ping_status', '$post->post_password', '$post->to_ping', '$post->pinged', '$new_post_date', '$new_post_date_gmt', '$post->post_parent', '$post->menu_order', '$post->post_mime_type')");

	$new_post_id = $wpdb->insert_id;

	// Copy the taxonomies
	duplicate_post_copy_post_taxonomies($post->ID, $new_post_id, $post->post_type);

	// Copy the meta information
	duplicate_post_copy_post_meta_info($post->ID, $new_post_id);

	return $new_post_id;
}
}

/**
 * Get the currently registered user
 */
if(!function_exists('duplicate_post_get_current_user')){
function duplicate_post_get_current_user() {
	if (function_exists('wp_get_current_user')) {
		return wp_get_current_user();
	} else if (function_exists('get_currentuserinfo')) {
		global $userdata;
		get_currentuserinfo();
		return $userdata;
	} else {
		$user_login = $_COOKIE[USER_COOKIE];
		$current_user = $wpdb->get_results("SELECT * FROM $wpdb->users WHERE user_login='$user_login'");
		return $current_user;
	}
}
}

/**
 * Copy the taxonomies of a post to another post
 */
if(!function_exists('duplicate_post_copy_post_taxonomies')){
function duplicate_post_copy_post_taxonomies($id, $new_id, $post_type) {
	global $wpdb;
	if (isset($wpdb->terms)) {
		// WordPress 2.3
		$taxonomies = get_object_taxonomies($post_type); //array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($id, $taxonomy);
			for ($i=0; $i<count($post_terms); $i++) {
				wp_set_object_terms($new_id, $post_terms[$i]->slug, $taxonomy, true);
			}
		}
	}
}
}

/**
 * Copy the meta information of a post to another post
 */
if(!function_exists('duplicate_post_copy_post_meta_info')){
function duplicate_post_copy_post_meta_info($id, $new_id) {
	global $wpdb;
	$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$id");

	if (count($post_meta_infos)!=0) {
		$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
		$meta_no_copy = explode(",",get_option('duplicate_post_blacklist'));
		foreach ($post_meta_infos as $meta_info) {
			$meta_key = $meta_info->meta_key;
			$meta_value = addslashes($meta_info->meta_value);
			if (!in_array($meta_key,$meta_no_copy)) {
				$sql_query_sel[]= "SELECT $new_id, '$meta_key', '$meta_value'";
			}
		}
		$sql_query.= implode(" UNION ALL ", $sql_query_sel);
		$wpdb->query($sql_query);
	}
}
}
////////////Duplicate POST END/////////
?>