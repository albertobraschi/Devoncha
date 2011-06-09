<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/login_frm_above_title.php'))
{
	include_once(CHILDTEMPLATEPATH . '/login_frm_above_title.php');
}
?>
<div class="form_col_1">
          <div class="form login_form"  id="login_form_div_id" style="display:none;" >
            <h3> <?php _e(SING_IN_TEXT);?> </h3>
            <form name="loginform" id="loginform" action="<?php global $General; echo $General->get_url_login(site_url('/?ptype=login')); ?>" method="post">
              <div class="form_row">
                <label>
                <?php _e(USERNAME_TEXT) ?>
                </label>
                <input type="text" name="log" id="user_login" value="<?php echo esc_attr($user_login); ?>" size="20" class="form_textfield"  />
              </div>
              <div class="form_row">
                <label>
                <?php _e(PASSWORD_TEXT) ?>
                </label>
                <input type="password" name="pwd" id="user_pass" class="form_textfield" value="" size="20" />
              </div>
              <?php do_action('login_form'); ?>
              <p class="forgetmenot">
                <input name="rememberme" type="checkbox" id="rememberme" value="forever" class="fl" />
                <?php esc_attr_e('Lembrar de mim neste computador'); ?>
              </p>
              <a  href="javascript:void(0);" onclick="return chk_form_login();" class="highlight_button fl login" ><?php _e(SING_IN_TEXT);?></a>
			 <?php
             if(strstr($_SESSION['redirect_page'],'ptype=checkout'))
            {
                $login_redirect_link = site_url('/?ptype=cart');
                //session_unregister(redirect_page);
            }else
            {
				global $General;
                $login_redirect_link = $General->get_url_login(site_url('/?ptype=login&action=register'));
            }
            ?>
              <input type="hidden" name="redirect_to" value="<?php echo $login_redirect_link; ?>" />
              <span class="forgot_password"> <a href="javascript:void(0);showhide_forgetpw();"><?php _e(FORGET_PW_TEXT);?></a></span>
              <input type="hidden" name="testcookie" value="1" />
          </form>
          </div>
          <!-- login form #end -->
          <script type="text/javascript" >
function chk_form_login()
{
	if(document.getElementById('user_login').value=='')
	{
		alert('<?php _e('Please enter '.USERNAME_TEXT) ?>');
		document.getElementById('user_login').focus();
		return false;
	}
	if(document.getElementById('user_pass').value=='')
	{
		alert('<?php _e('Please enter '.PASSWORD_TEXT) ?>');
		document.getElementById('user_pass').focus();
		return false;
	}
	//return true;
	document.loginform.submit();
}
</script>
         <div class="lostpassword_form" id="lostpassword_form" style="display:none;">
            <h3><?php _e(FORGOT_PASSWORD_TEXT);?></h3>
            <form name="lostpasswordform" id="lostpasswordform" action="<?php global $General; echo $General->get_url_login(site_url('/?ptype=login&action=lostpassword')); ?>" method="post">
              <label>
              <?php _e(USERNAME_EMAIL_TEXT) ?>
              </label>
              <input type="text" name="user_login" id="user_login1" value="<?php echo esc_attr($user_login); ?>" size="20" class="lostpass_textfield" />
              <?php do_action('lostpassword_form'); ?>
              <a  href="javascript:void(0);" onclick="document.lostpasswordform.submit();" class="highlight_button fl " ><?php _e(GET_NEW_PASSWORD_TEXT);?></a>
            </form>
          </div>
        </div>
<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/login_frm_page_end.php'))
{
	include_once(CHILDTEMPLATEPATH . '/login_frm_page_end.php');
}
?>