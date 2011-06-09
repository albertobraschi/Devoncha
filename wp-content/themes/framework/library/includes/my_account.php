<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/my_account_above_title.php'))
{
	include_once(CHILDTEMPLATEPATH . '/my_account_above_title.php');
}
?>
 <h1 class="head">
	<?php 
	if($_REQUEST['type']=="editprofile")
	{
		_e(EDIT_PROFILE_PAGE_TITLE);
	}else
	{
		_e(VIEW_ACCOUNT_PAGE_TITLE);
	}
	?></h1>
    <?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/my_account_after_title.php'))
{
	include_once(CHILDTEMPLATEPATH . '/my_account_after_title.php');
}
?>

    <div class="breadcrumb clearfix">
     <?php 
	  if($_REQUEST['type']=="editprofile")
	  {
	  	 $myaccountlink = ' &raquo; <a href="'.site_url('?ptype=myaccount').'">'.VIEW_ACCOUNT_PAGE_TITLE.'</a>';
	  }
	 if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',$myaccountlink.' &raquo; '.EDIT_PROFILE_PAGE_TITLE); } ?>
    </div>
    
    
    <div class="fr"><?php $themeUI->get_logout_link($css='fr');?></div>
		
        <?php  //AFFILIATE START
		if($General->is_active_affiliate())
		{
			global $current_user;
			get_currentuserinfo();
			$user_id = $current_user->data->ID;
			$user_role = get_usermeta($user_id,'wp_capabilities');
			if(!$user_role['affiliate'])
			{
			?>
				<h6><b><?php _e(WANT_TO_BECOME_AFF_TEXT);?> <?php $themeUI->get_affiliate_link($css='fr');?></b> </h6>
				<?php
			} 
			
		} //AFFILIATE END
		?>
      
        <?php
         if($_REQUEST['type']=="editprofile")
		 {
		 	if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/my_account_above_edit_profile.php'))
			{
				include_once(CHILDTEMPLATEPATH . '/my_account_above_edit_profile.php');
			}
			include_once(TEMPLATEPATH . '/library/includes/edit_profile.php');
			if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/my_account_below_edit_profile.php'))
			{
				include_once(CHILDTEMPLATEPATH . '/my_account_below_edit_profile.php');
			}
		}else
		{
			if(!$General->is_storetype_catalog())
			 {
				 if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/my_account_above_view_orders.php'))
				{
					include_once(CHILDTEMPLATEPATH . '/my_account_above_view_orders.php');
				}
				 include_once(TEMPLATEPATH . '/library/includes/view_orders.php');
				 echo "<br /><br /><br />";
				if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/my_account_below_view_orders.php'))
				{
					include_once(CHILDTEMPLATEPATH . '/my_account_below_view_orders.php');
				}
				if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/my_account_above_view_downloads.php'))
				{
					include_once(CHILDTEMPLATEPATH . '/my_account_above_view_downloads.php');
				}
				 include_once(TEMPLATEPATH . '/library/includes/view_downloads.php');
				if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/my_account_below_view_downloads.php'))
				{
					include_once(CHILDTEMPLATEPATH . '/my_account_below_view_downloads.php');
				}
			 }
			global $current_user;
			$user_address_info = $current_user->data->user_address_info;
			?>
        <?php
			if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/my_account_above_billing_fields.php'))
			{
				include_once(CHILDTEMPLATEPATH . '/my_account_above_billing_fields.php');
			}
			?>
        <table width="100%" class="table">
          <tr>
            <td colspan="2" class="title"><?php _e(PERSONAL_INFO_TEXT);?> </td>
          </tr>
          <tr>
            <td class="row1" ><?php _e(NAME_TEXT);?> : </td>
            <td class="row1" ><?php echo $userInfo['display_name'];?></td>
          </tr>
          <tr>
            <td class="row1"  ><?php _e(EMAIL_TEXT);?> : </td>
            <td class="row1" ><?php echo $userInfo['user_email'];?></td>
          </tr>
          <tr>
            <td class="row1" ><?php _e(ADDRESS1_TEXT);?> : </td>
            <td class="row1" ><?php echo $user_address_info['user_add1'];?></td>
          </tr>
          <tr>
            <td class="row1" ><?php _e(ADDRESS2_TEXT);?> : </td>
            <td class="row1" ><?php echo $user_address_info['user_add2'];?></td>
          </tr>
          <tr>
            <td class="row1" ><?php _e(CITY_TEXT);?> : </td>
            <td class="row1" ><?php echo $user_address_info['user_city'];?></td>
          </tr>
          <tr>
            <td class="row1" ><?php _e(STATE_TEXT);?> : </td>
            <td class="row1" ><?php echo $user_address_info['user_state'];?></td>
          </tr>
          <tr>
            <td class="row1" ><?php _e(COUNTRY_TEXT);?> : </td>
            <td class="row1" ><?php echo $user_address_info['user_country'];?></td>
          </tr>
          <tr>
            <td class="row1" ><?php _e(POSTAL_CODE_TEXT);?> : </td>
            <td class="row1" ><?php echo $user_address_info['user_postalcode'];?></td>
          </tr>
           <tr>
            <td class="row1" ><?php echo PHONE_NUMBER_TEXT;?> : </td>
            <td class="row1" ><?php echo $user_address_info['phone'];?></td>
          </tr>
           <?php
			if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/my_account_after_billing_fields.php'))
			{
				include_once(CHILDTEMPLATEPATH . '/my_account_after_billing_fields.php');
			}
			?>
          <tr>
            <td class="row1" ></td>
            <td class="row1" ><a href="<?php echo site_url('/?ptype=myaccount&type=editprofile'); ?>" class="highlight_button fr" ><?php _e(EDIT_PROFILE_TEXT);?></a></td>
          </tr>
        </table>
         <?php
			if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/my_account_above_affiliate_account.php'))
			{
				include_once(CHILDTEMPLATEPATH . '/my_account_above_affiliate_account.php');
			}
			?>
        <?php
		////////AFFILIATE CODING//////////
			if($General->is_active_affiliate())
			{
				@include_once(TEMPLATEPATH . '/library/includes/affiliates/affiliate_account.php');		
			}	
		}
		 ?>
		   <?php
			if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/my_account_below_affiliate_account.php'))
			{
				include_once(CHILDTEMPLATEPATH . '/my_account_below_affiliate_account.php');
			}
			?>