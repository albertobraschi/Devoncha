<?php
if(!pt_check_captch_cond() && $_REQUEST['action']!='lostpassword')
{
	if($_POST['testcookie']!='')
	{ }else
	{		
		wp_redirect(site_url( '/?ptype=login&emsg=wcaptch'));exit;	
	}
}
global $Cart,$General,$wpdb;
$userInfo = $General->getLoginUserInfo();
$_SESSION['checkout_as_guest'] = '';
if($userInfo && $_GET['action'] != 'logout')
{
	wp_redirect(site_url('/?ptype=myaccount'));
	exit;
}
require( 'wp-load.php' );
require(ABSPATH.'wp-includes/registration.php');

// Redirect to https login if forced to use SSL
if ( force_ssl_admin() && !is_ssl() ) {
	if ( 0 === strpos($_SERVER['REQUEST_URI'], 'http') ) {
		wp_redirect(preg_replace('|^http://|', 'https://', $_SERVER['REQUEST_URI']));
		exit();
	} else {
		wp_redirect('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		exit();
	}
}

	$message = apply_filters('login_message', $message);
	if ( !empty( $message ) ) echo $message . "\n";


/**
 * Handles sending password retrieval email to user.
 *
 * @uses $wpdb WordPress Database object
 *
 * @return bool|WP_Error True: when finish. WP_Error on error
 */
function retrieve_password() {
	global $wpdb,$General,$Cart,$Product;

	$errors = new WP_Error();

	if ( empty( $_POST['user_login'] ) && empty( $_POST['user_email'] ) )
		$errors->add('empty_username', __('<strong>ERROR</strong>: Enter a username or e-mail address.'));

	if ( strpos($_POST['user_login'], '@') ) {
		$user_data = get_user_by_email(trim($_POST['user_login']));
		if ( empty($user_data) )
			$errors->add('invalid_email', __('<strong>ERROR</strong>: There is no user registered with that email address.'));
	} else {
		$login = trim($_POST['user_login']);
		$user_data = get_userdatabylogin($login);
	}

	do_action('lostpassword_post');

	if ( $errors->get_error_code() )
		return $errors;

	if ( !$user_data ) {
		$errors->add('invalidcombo', __('<strong>ERROR</strong>: Invalid username or e-mail.'));
		return $errors;
	}

	// redefining user_login ensures we return the right case in the email
	$user_login = $user_data->user_login;
	$user_email = $user_data->user_email;

	//do_action('retreive_password', $user_login);  // Misspelled and deprecated
	//do_action('retrieve_password', $user_login);

	//$allow = apply_filters('allow_password_reset', true, $user_data->ID);

	////////////////////////////////////
	//forget pw changed on 1st april 2010 start//
	$user_email = $_POST['user_email'];
	$user_login = $_POST['user_login'];
	$user = $wpdb->get_row("SELECT * FROM $wpdb->users WHERE user_login = \"$user_login\" or user_email = \"$user_login\"" );
	$new_pass = wp_generate_password(12,false);
	wp_set_password($new_pass, $user->ID);
	if($General->is_send_forgot_pw_email())
	{
		$message  = '<p>'.sprintf(__('Username: %s'), $user_data->user_login) . '</p>';
		$message .= '<p>'.sprintf(__('Password: %s'), $new_pass) . "</p>";
		$message .= '<p>You can <a href="'.$General->get_url_login(site_url('/?ptype=login')).'">Login</a> now</p>';
		$title = sprintf(__('[%s] Your new password'), get_option('blogname'));
		$user_email = $user_data->user_email;
		$user_login = $user_data->user_login;
		$title = apply_filters('password_reset_title', $title);
		$message = apply_filters('password_reset_message', $message, $new_pass);
		//forget pw changed on 1st april 2010 end//
		global $General;
		$fromEmail = $General->get_site_emailId();
		$fromEmailName = $General->get_site_emailName();
		$General->sendEmail($fromEmail,$fromEmailName,$user_email,$user_login,$title,$message,$extra='');///To clidne email
	}
	return true;
}

/**
 * Handles registering a new user.
 *
 * @param string $user_login User's username for logging in
 * @param string $user_email User's email address to send password and add
 * @return int|WP_Error Either user's ID or error on failure.
 */
function register_new_user($user_login, $user_email) {
	global $wpdb,$General;
	$errors = new WP_Error();

	$user_login = sanitize_user( $user_login );
	$user_email = apply_filters( 'user_registration_email', $user_email );

	// Check the username
	if ( $user_login == '' )
		$errors->add('empty_username', __('ERROR: Please enter a username.'));
	elseif ( !validate_username( $user_login ) ) {
		$errors->add('invalid_username', __('<strong>ERROR</strong>: This username is invalid.  Please enter a valid username.'));
		$user_login = '';
	} elseif ( username_exists( $user_login ) )
		$errors->add('username_exists', __('<strong>ERROR</strong>: This username is already registered, please choose another one.'));

	// Check the e-mail address
	if ($user_email == '') {
		$errors->add('empty_email', __('<strong>ERROR</strong>: Please type your e-mail address.'));
	} elseif ( !is_email( $user_email ) ) {
		$errors->add('invalid_email', __('<strong>ERROR</strong>: The email address isn&#8217;t correct.'));
		$user_email = '';
	} elseif ( email_exists( $user_email ) )
		$errors->add('email_exists', __('<strong>ERROR</strong>: This email is already registered, please choose another one.'));

	do_action('register_post', $user_login, $user_email, $errors);

	$errors = apply_filters( 'registration_errors', $errors );
	global $registration_error_msg;
	$registration_error_msg = 0;
	$error_message_reg = '';
	foreach($errors as $errorsObj)
	{
		foreach($errorsObj as $key=>$val)
		{
			for($i=0;$i<count($val);$i++)
			{
				$error_message_reg .= "<div class=error_msg>".$val[$i].'</div>';	
				$registration_error_msg = 1;
			}
		} 
	}
	$_SESSION['error_message_reg'] = $error_message_reg;
	

	if ( $errors->get_error_code() )
		return $errors;


	$user_pass = wp_generate_password(12,false);
	$user_id = wp_create_user( $user_login, $user_pass, $user_email );
	
	$is_affiliate = $_POST['is_affiliate'];
	$phone = $_POST['phone'];
	$user_add1 = stripslashes(str_replace("'","&acute;",$_POST['user_add1']));
	$user_add2 = stripslashes(str_replace("'","&acute;",$_POST['user_add2']));
	$user_city = stripslashes(str_replace("'","&acute;",$_POST['user_city']));
	$user_state = stripslashes(str_replace("'","&acute;",$_POST['user_state']));
	$user_country = stripslashes(str_replace("'","&acute;",$_POST['user_country']));
	$user_postalcode = stripslashes(str_replace("'","&acute;",$_POST['user_postalcode']));
	$user_address_info = array(
						"user_add1"		=> $user_add1,
						"user_add2"		=> $user_add2,
						"user_city"		=> $user_city,
						"user_state"	=> $user_state,
						"user_country"	=> $user_country,
						"phone"			=> $phone,
						"user_postalcode"=> $user_postalcode,
						"buser_name" 	=> $_POST['user_fname'].'  '.$_POST['user_lname'],
						"buser_add1"		=> $user_add1,
						"buser_add2"		=> $user_add2,
						"buser_city"		=> $user_city,
						"buser_state"	=> $user_state,
						"buser_country"	=> $user_country,
						"buser_postalcode"=> $user_postalcode,
						);
	foreach($_POST as $key=>$val)
	{
		if(strstr($key,'_custom'))
		{
			$user_address_info[$key] = 	$val;	
		}
	}
	if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/registration_before_user_insert.php'))
	{
		include_once(CHILDTEMPLATEPATH . '/registration_before_user_insert.php');
	}
	update_usermeta($user_id, 'user_address_info', $user_address_info); // User Address Information Here
	update_usermeta($user_id, 'first_name', $_POST['user_fname']); // User Address Information Here
	update_usermeta($user_id, 'last_name', $_POST['user_lname']); // User Address Information Here
	$userName = $_POST['user_fname'].'  '.$_POST['user_lname'];
	$updateUsersql = "update $wpdb->users set user_nicename=\"$userName\", display_name=\"$userName\"  where ID=\"$user_id\"";
	$wpdb->query($updateUsersql);
	
	if ( !$user_id ) {
		$errors->add('registerfail', sprintf(__('<strong>ERROR</strong>: Couldn&#8217;t register you... please contact the <a href="mailto:%s">webmaster</a> !'), get_option('admin_email')));
		return $errors;
	}

	if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/registration_after_user_insert.php'))
	{
		include_once(CHILDTEMPLATEPATH . '/registration_after_user_insert.php');
	}

if ( $user_id ) 
	{
		////AFFILIAGE START//
		if($General->is_active_affiliate())
		{
			if($is_affiliate)
			{
				$user_role = get_usermeta($user_id,'wp_capabilities');
				$user_role['affiliate'] = 1;
				update_usermeta($user_id, 'wp_capabilities', $user_role);
			}
		}
		////AFFILIATE END///
		
		//wp_new_user_notification($user_id, $user_pass);
		///////REGISTRATION EMAIL START//////
		if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/registration_before_user_email.php'))
		{
			include_once(CHILDTEMPLATEPATH . '/registration_before_user_email.php');
		}
		global $General;
		if($General->is_send_registration_email())
		{
			$fromEmail = $General->get_site_emailId();
			$fromEmailName = $General->get_site_emailName();
			$store_name = get_option('blogname');
			$subject = get_option('registration_success_email_subject');
			$client_message = get_option('registration_success_email_content');
			
			$store_login = 'You can login to : <a href="'.$General->get_url_login(site_url('/?ptype=login')) . "\">Login</a> or the URL is :  ".$General->get_url_login(site_url())."/?ptype=login";
			/////////////customer email//////////////
			$search_array = array('[#$user_name#]','[#$user_login#]','[#$user_password#]','[#$store_name#]','[#$store_login_url#]');
			$replace_array = array($_POST['user_fname'],$user_login,$user_pass,$store_name,$store_login);
			$client_message = str_replace($search_array,$replace_array,$client_message);
			$General->sendEmail($fromEmail,$fromEmailName,$user_email,$userName,$subject,$client_message,$extra='');///To clidne email
		}
		if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/registration_after_user_email.php'))
		{
			include_once(CHILDTEMPLATEPATH . '/registration_after_user_email.php');
		}
		//////REGISTRATION EMAIL END////////
	}
	return array($user_id,$user_pass);
}			

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'login';
$errors = new WP_Error();

if ( isset($_GET['key']) )
	$action = 'resetpass';

// validate action so as to default to the login screen
if ( !in_array($action, array('logout', 'lostpassword', 'retrievepassword', 'resetpass', 'rp', 'register', 'login')) && false === has_filter('login_form_' . $action) )
	$action = 'login';

nocache_headers();

header('Content-Type: '.get_bloginfo('html_type').'; charset='.get_bloginfo('charset'));

if ( defined('RELOCATE') ) { // Move flag is set
	if ( isset( $_SERVER['PATH_INFO'] ) && ($_SERVER['PATH_INFO'] != $_SERVER['PHP_SELF']) )
		$_SERVER['PHP_SELF'] = str_replace( $_SERVER['PATH_INFO'], '', $_SERVER['PHP_SELF'] );

	$schema = ( isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on' ) ? 'https://' : 'http://';
	if ( dirname($schema . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']) != site_url() )
		update_option('siteurl', dirname($schema . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']) );
}

//Set a cookie now to see if they are supported by the browser.
setcookie(TEST_COOKIE, 'WP Cookie check', 0, COOKIEPATH, COOKIE_DOMAIN);
if ( SITECOOKIEPATH != COOKIEPATH )
	setcookie(TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN);

// allow plugins to override the default actions, and to add extra actions if they want
do_action('login_form_' . $action);

$http_post = ('POST' == $_SERVER['REQUEST_METHOD']);
switch ($action) {

case 'logout' :
	//check_admin_referer('log-out');
	wp_logout();

	$redirect_to =  $_SERVER['HTTP_REFERER'];
	//$redirect_to = site_url().'/?ptype=login&loggedout=true';
	if ( isset( $_REQUEST['redirect_to'] ) )
		$redirect_to = $_REQUEST['redirect_to'];

	wp_safe_redirect($redirect_to);
	exit();

break;

case 'lostpassword' :
case 'retrievepassword' :
	if ( $http_post ) {
		$errors = retrieve_password();
		$error_message = $errors->errors['invalid_email'][0];
		if ( !is_wp_error($errors) ) {
			global $General;
			wp_redirect($General->get_url_login(site_url()).'/?ptype=login&action=login&checkemail=confirm');
			exit();
		}
	}

	if ( isset($_GET['error']) && 'invalidkey' == $_GET['error'] ) $errors->add('invalidkey', __('Sorry, that key does not appear to be valid.'));

	do_action('lost_password');
	$message = '<div class="sucess_msg">Please enter your username or e-mail address. You will receive a new password via e-mail.</div>';
	//login_header(__('Lost Password'), '<p class="message">' . __('Please enter your username or e-mail address. You will receive a new password via e-mail.') . '</p>', $errors);

	$user_login = isset($_POST['user_login']) ? stripslashes($_POST['user_login']) : '';

break;

case 'resetpass' :
case 'rp' :
	$errors = reset_password($_GET['key'], $_GET['login']);
	global $General;
	if ( ! is_wp_error($errors) ) {
		wp_redirect($General->get_url_login(site_url()).'/?ptype=login&action=login&checkemail=newpass');
		exit();
	}

	wp_redirect($General->get_url_login(site_url()).'/?ptype=login&action=lostpassword&error=invalidkey');
	exit();

break;

case 'register' :
	if ( !get_option('users_can_register') ) {
		wp_redirect(site_url().'/?ptype=login&registration=disabled');
		exit();
	}

	$user_login = '';
	$user_email = '';
	if ( $http_post ) {
		//require_once( ABSPATH . WPINC . '/registration.php');

		$user_login = $_POST['user_login'];
		$user_email = $_POST['user_email'];
		$user_fname = $_POST['user_fname'];
		$user_lname = $_POST['user_lname'];		  
		$user_add1 = $_POST['user_add1'];
		$user_add2 = $_POST['user_add2'];
		$user_city = $_POST['user_city'];
		$user_state = $_POST['user_state'];
		$user_country = $_POST['user_country'];
		$user_postalcode = $_POST['user_postalcode'];
		$phone = $_POST['phone'];
		
		$errors = register_new_user($user_login, $user_email);
		if($General->allow_autologin_after_reg())
		{
			if ( !is_wp_error($errors) ) 
			{
			$_POST['log'] = $user_login;
			$_POST['pwd'] = $errors[1];
			$_POST['testcookie'] = 1;
			
			$secure_cookie = '';
			// If the user wants ssl but the session is not ssl, force a secure cookie.
			if ( !empty($_POST['log']) && !force_ssl_admin() ) {
				$user_name = sanitize_user($_POST['log']);
				if ( $user = get_userdatabylogin($user_name) ) {
					if ( get_user_option('use_ssl', $user->ID) ) {
						$secure_cookie = true;
						force_ssl_admin(true);
					}
				}
			}
		
			$redirect_to = $_REQUEST['reg_redirect_link'];
			if ( !$secure_cookie && is_ssl() && force_ssl_login() && !force_ssl_admin() && ( 0 !== strpos($redirect_to, 'https') ) && ( 0 === strpos($redirect_to, 'http') ) )
				$secure_cookie = false;
		
			$user = wp_signon('', $secure_cookie);
		
			$redirect_to = apply_filters('login_redirect', $redirect_to, isset( $_REQUEST['reg_redirect_link'] ) ? $_REQUEST['reg_redirect_link'] : '', $user);
		
			if ( !is_wp_error($user) ) 
			{
				wp_safe_redirect($redirect_to);
				exit();
			}
			exit();
		}
		
		}else
		{
			if ( !is_wp_error($errors) ) {
				global $General;
				wp_redirect($General->get_url_login(site_url()).'/?ptype=login&action=login&checkemail=registered');
				exit();
			}	
		}
		
	}

	//login_header(__('Registration Form'), '<p class="message register">' . __('Register For This Site') . '</p>', $errors);
break;

case 'login' :
default:
	$secure_cookie = '';

	// If the user wants ssl but the session is not ssl, force a secure cookie.
	if ( !empty($_POST['log']) && !force_ssl_admin() ) {
		$user_name = sanitize_user($_POST['log']);
		if ( $user = get_userdatabylogin($user_name) ) {
			if ( get_user_option('use_ssl', $user->ID) ) {
				$secure_cookie = true;
				force_ssl_admin(true);
			}
		}
	}

	if ( isset( $_REQUEST['redirect_to'] ) ) {
		$redirect_to = $_REQUEST['redirect_to'];
		// Redirect to https if user wants ssl
		if ( $secure_cookie && false !== strpos($redirect_to, 'wp-admin') )
			$redirect_to = preg_replace('|^http://|', 'https://', $redirect_to);
	} else {
		$redirect_to = admin_url();
	}

	if ( !$secure_cookie && is_ssl() && force_ssl_login() && !force_ssl_admin() && ( 0 !== strpos($redirect_to, 'https') ) && ( 0 === strpos($redirect_to, 'http') ) )
		$secure_cookie = false;

	$user = wp_signon('', $secure_cookie);

	$redirect_to = apply_filters('login_redirect', $redirect_to, isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '', $user);

	if ( !is_wp_error($user) ) {
		// If the user can't edit posts, send them to their profile.
		if ( !$user->has_cap('edit_posts') && ( empty( $redirect_to ) || $redirect_to == 'wp-admin/' || $redirect_to == admin_url() ) )
			$redirect_to = admin_url('profile.php');
		wp_safe_redirect($redirect_to);
		exit();
	}

	$errors = $user;
	// Clear errors if loggedout is set.
	if ( !empty($_GET['loggedout']) )
		$errors = new WP_Error();

	// If cookies are disabled we can't log in even with a valid user+pass
	if ( isset($_POST['testcookie']) && empty($_COOKIE[TEST_COOKIE]) )
		$errors->add('test_cookie', __("<strong>ERROR</strong>: Cookies are blocked or not supported by your browser. You must <a href='http://www.google.com/cookies.html'>enable cookies</a> to use WordPress."));

	// Some parts of this script use the main login form to display a message
	if( isset($_GET['loggedout']) && TRUE == $_GET['loggedout'] )
	{
		$successmsg = __('<div class="sucess_msg">You are now logged out.</div>');
	}
	elseif( isset($_GET['registration']) && 'disabled' == $_GET['registration'] )
	{
		$successmsg = __('<div class="sucess_msg">User registration is currently not allowed.</div>');
	}
	elseif( isset($_GET['checkemail']) && 'confirm' == $_GET['checkemail'] )
	{
		$successmsg = __('<div class="sucess_msg">Check your e-mail for the confirmation link.</div>');
	}
	elseif( isset($_GET['checkemail']) && 'newpass' == $_GET['checkemail'] )
	{
		$successmsg = __('<div class="sucess_msg">Check your e-mail for your new password.</div>');
	}
	elseif( isset($_GET['checkemail']) && 'registered' == $_GET['checkemail'] )
	{
		$successmsg = __('<div class="sucess_msg">Registration complete. Please check your e-mail.</div>');
	}
if($successmsg)
{
	echo "<p class=sucess_msg>".$successmsg.'</p>';		
}elseif($_REQUEST['emsg']=='wcaptch')
{
	echo "<p class=sucess_msg>".__('Please Enter Captcha Code').'</p>';
}
?>
        <script type="text/javascript" >
<?php if ( $user_login ) { ?>
setTimeout( function(){ try{
d = document.getElementById('user_pass');
d.value = '';
d.focus();
} catch(e){}
}, 200);
<?php } else { ?>
try{document.getElementById('user_login').focus();}catch(e){}
<?php } ?>
</script>
        <?php

break;
} // end action switch
?>

<?php
if(strstr($_SESSION['redirect_page'],'ptype=checkout'))
{
	$title_cum = LOGIN_AS_CHECKOUT_TITLE;
}else
{
	$title_cum = LOGIN_PAGE_TITLE;
}
?>
<?php
if(strstr($_SESSION['redirect_page'],'ptype=checkout'))
{
	$title = LOGIN_AS_CHECKOUT_TITLE;
	$title_cum = LOGIN_AS_CHECKOUT_TITLE;
}else
{
	$title = LOGIN_PAGE_TITLE;
	$title_cum = LOGIN_PAGE_TITLE;
}
?>
<?php
$chekcout_method = $General->get_checkout_method();
if($chekcout_method == 'single' && $General->is_storetype_shoppingcart())
{
	$box_width = "25";
}else
{
	$box_width = "35";
}
?>

<?php get_header(); ?>
<?php
global $General;
$admin_layout_setting_option = 'ptthemes_checkout_design_settings';
$sidebar_left_widget_option = 'All Pages Sidebar Left';
$sidebar_right_widget_option = 'All Pages Sidebar Right';
$middle_content_widget_option = '';
$file_name = 'registration_page.php';;
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . "/$file_name"))
{
	$middle_content_file_fullpath = CHILDTEMPLATEPATH . "/$file_name";
}else{
	$middle_content_file_fullpath = TEMPLATEPATH . "/library/includes/$file_name";
}
include_once(TEMPLATEPATH.'/site_layout_structure.php');
?> 
<?php get_footer(); ?>