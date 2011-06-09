<?php
if($_POST && !$userInfo)
{
	require( 'wp-load.php' );
	require(ABSPATH.'wp-includes/registration.php');
	
	global $wpdb;
	$errors = new WP_Error();
	
	$user_email = $_POST['user_email'];
	$user_login = $user_email;
	$user_count = $wpdb->get_var("select count(ID) from $wpdb->users where user_email like \"$user_email\"");
	if($user_count>0)
	{
		//$maxuserid = $wpdb->get_var("select max(ID) from $wpdb->users");
		$user_login = str_replace('@',time().'@',$user_email);
		$user_email = $user_login;
	}
	$user_login = sanitize_user( $user_login );
	$user_email = sanitize_user( $user_login );
	
	// Check the username
	if ( $user_login == '' )
		$errors->add('empty_username', __('ERROR: Please enter a username.'));
	elseif ( !validate_username( $user_login ) ) {
		$errors->add('invalid_username', __('<strong>ERROR</strong>: This username is invalid.  Please enter a valid username.'));
		$user_login = '';
	} elseif ( username_exists( $user_login ) )
	{
		$errors->add('username_exists', __('<strong>ERROR</strong>: '.$user_login.' This username is already registered, please choose another one.'));
	}

	// Check the e-mail address
	if ($user_email == '') {
		$errors->add('empty_email', __('<strong>ERROR</strong>: Please type your e-mail address.'));
	} elseif ( !is_email( $user_email ) ) {
		$errors->add('invalid_email', __('<strong>ERROR</strong>: The email address isn&#8217;t correct.'));
		$user_email = '';
	}
	//elseif ( email_exists( $user_email ) )
		//$errors->add('email_exists', __('<strong>ERROR</strong>: '.$user_email.' This email is already registered, please choose another one.'));

	do_action('register_post', $user_login, $user_email, $errors);	
	
	$errors = apply_filters( 'registration_errors', $errors );
	if($errors->errors)
	{
		global $General;
		wp_redirect($General->get_ssl_normal_url(site_url()).'/?ptype=checkout&checkout_as_guest=1&msg=emptyuser');exit;	
	}
	if($errors->errors)
	{
	?>
        
  <div class="breadcrumb clearfix">
		<h1 class="head">Error!!!</h1>
      </div> <!-- breadcrumbs #end -->

<div id="page" class="clearfix">
		<div class="clearfix container_message">
        
        <?php
		echo "";
		foreach($errors as $errorsObj)
		{
			foreach($errorsObj as $key=>$val)
			{
				for($i=0;$i<count($val);$i++)
				{
					echo "<div class=error_msg>".$val[$i].'</div>';	
				}
			} 
		}
		echo "<br><br><br>";
	}	
	if ( $errors->get_error_code() )
	{
		echo '<h6><b><a href="javascript:void(0);history.back();">Return to Checkout Page</a></b></h6>';
		?>
        
        
   </div>
</div>
        
        <?php
		exit;
	}
		
	$user_pass = wp_generate_password(12,false);
	$user_id = wp_create_user( $user_login, $user_pass, $user_email );
	
	if ( !$user_id ) {
		$errors->add('registerfail', sprintf(__('<strong>ERROR</strong>: Couldn&#8217;t register you... please contact the <a href="mailto:%s">webmaster</a> !'), get_option('admin_email')));
		exit;
	}
	
	$user_fname = $_POST['user_fname'];
	$user_add1 = $_POST['user_add1'];
	$user_city = $_POST['user_city'];
	$user_state = $_POST['user_state'];
	$user_country = $_POST['user_country'];
	$user_postalcode = $_POST['user_postalcode'];
	$phone = $_POST['phone'];
	
	$buser_add1 = $_POST['buser_add1'];
	$buser_city = $_POST['buser_city'];
	$buser_state = $_POST['buser_state'];
	$buser_country = $_POST['buser_country'];
	$buser_postalcode = $_POST['buser_postalcode'];
	
	$user_address_info = array(
						"user_add1"		=> $user_add1,
						"user_city"		=> $user_city,
						"user_state"	=> $user_state,
						"user_country"	=> $user_country,
						"user_postalcode"=> $user_postalcode,
						"buser_name" 	=> $_POST['user_fname'],
						"buser_add1"	=> $buser_add1,
						"buser_city"	=> $buser_city,
						"buser_state"	=> $buser_state,
						"buser_country"	=> $buser_country,
						"buser_postalcode"=> $buser_postalcode,
						"phone"=> $phone,
						);
	update_usermeta($user_id, 'user_address_info', $user_address_info); // User Address Information Here
	$userName = $_POST['user_fname'];
	$updateUsersql = "update $wpdb->users set user_nicename=\"$userName\", display_name=\"$userName\"  where ID=\"$user_id\"";
	$wpdb->query($updateUsersql);
	
	//wp_new_user_notification($user_id, $user_pass);
	global $General;	
	if ( $user_id && $General->is_send_email_guest()) 
	{
		//wp_new_user_notification($user_id, $user_pass);
		///////REGISTRATION EMAIL START//////
		global $General;
		$fromEmail = $General->get_site_emailId();
		$fromEmailName = $General->get_site_emailName();
		$store_name = get_option('blogname');
		$order_info = $General->get_order_detailinfo_tableformat($orderInfoArray,1);
	
		$subject = get_option('order_success_ipn_supplier_email_subject');
		$client_message = get_option('order_success_ipn_supplier_email_content');
		$store_login = site_url().'/?page=login';
		/////////////customer email//////////////
		$search_array = array('[#$user_name#]','[#$user_login#]','[#$user_password#]','[#$store_name#]','[#$store_login_url#]');
		$replace_array = array($_POST['user_fname'],$user_login,$user_pass,$store_name,$store_login);
		$client_message = str_replace($search_array,$replace_array,$client_message);
		$userName=$_POST['user_fname'];
		$user_email=$_POST['user_email'];
		$General->sendEmail($fromEmail,$fromEmailName,$user_email,$userName,$subject,$client_message,$extra='');///To clidne email
		//////REGISTRATION EMAIL END////////
	}
	
	$userInfoArray = array();
	$userInfoArray['ID'] = 	$user_id;
	$userInfoArray['display_name'] = 	$user_fname;
	$userInfoArray['user_nicename'] = 	$user_fname;
	$userInfoArray['user_email'] = 	$user_email;
	$userInfoArray['user_id'] = 	$user_id;	
	$userInfo = $userInfoArray;
	
	$user = new WP_User($user_id);
	global $current_user;
	$current_user = $user;
}
?>