
<div id="reg_form_div_id" style="display:none;">
<?php $General->get_loginpage_top_statement();?>
        <!-- form column #end -->
         <?php
        global $General;
		if(strstr($_SESSION['redirect_page'],'ptype=checkout'))
		{
			
			$reg_redirect_link = $General->get_ssl_normal_url(site_url()).'/?ptype=checkout';
		}else
		{
			$reg_redirect_link = $General->get_url_login(site_url()).'/?ptype=login&action=register';
		}
		?>
        <?php
		if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/registration_frm_page_above_form.php'))
		{
			include_once(CHILDTEMPLATEPATH . '/registration_frm_page_above_form.php');
		}
		?>
         <form name="registerform" id="registerform" action="<?php global $General; echo $General->get_url_login(site_url()).'/?ptype=login&action=register'; ?>" method="post">
        <input type="hidden" name="reg_redirect_link" value="<?php echo $reg_redirect_link;?>" />
        <div class="form form_col_2 fl ">
         <h3><?php _e(YOUR_INFO_TEXT);?> </h3>
          <p class="mandatory"> <span class="indicates">*</span> <?php _e(INDICATE_MENDATORY_MSG);?></p>
         <h5><?php _e(PERSONAL_INFO_TEXT);?> </h5>
          <?php
			if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/registration_frm_page_below_title.php'))
			{
				include_once(CHILDTEMPLATEPATH . '/registration_frm_page_below_title.php');
			}
			?>
            <div class="reg_row fl">
              <label>
              <?php _e(USERNAME_TEXT) ?>
              <span class="indicates">*</span></label>
              <input type="text" name="user_login" id="user_loginreg" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20"/>
            </div>
            <div class="reg_row fl">
              <label>
              <?php _e(EMAIL_TEXT) ?>
              <span class="indicates">*</span></label>
              <input type="text" name="user_email" id="user_emailreg" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_email)); ?>" size="25" />
            </div>
            <div class="reg_row fl">
              <label>
              <?php _e(FIRST_NAME_TEXT) ?>
              <span class="indicates">*</span></label>
              <input type="text" name="user_fname" id="user_fname" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_fname)); ?>" size="25"  />
            </div>
            <div class="reg_row fl">
              <label>
              <?php _e(LAST_NAME_TEXT) ?> <?php echo $last_name;?>
              </label>
              <input type="text" name="user_lname" id="user_lname" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_lname)); ?>" size="25"  />
            </div>
            <div class="fix"></div>
            <h5><?php _e(LOCATION_INFO_TEXT);?> </h5>
            <div class="reg_row fl">
              <label>
              <?php _e(ADDRESS1_TEXT) ?> <?php echo $bill_address1;?>
              </label>
              <input type="text" name="user_add1" id="user_add1" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_add1)); ?>" size="25" />
            </div>
            <div class="reg_row fl">
              <label>
              <?php _e(ADDRESS2_TEXT) ?> <?php echo $bill_address2;?>
              </label>
              <input type="text" name="user_add2" id="user_add2" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_add2)); ?>" size="25" />
            </div>
             <div class="reg_row fl">
              <label>
              <?php _e(CITY_TEXT) ?> <?php echo $bill_city;?>
              </label>
              <input type="text" name="user_city" id="user_city" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_city)); ?>" size="25" />
            </div>
            
            <div class="reg_row fl">
              <label>
              <?php _e(POSTAL_CODE_TEXT) ?> <?php echo $bill_zip;?>
              </label>
              <input type="text" name="user_postalcode" id="user_postalcode" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($user_postalcode)); ?>" size="25" />
            </div>
             <div class="reg_row fl">
              <label>
              <?php _e(COUNTRY_TEXT) ?> <?php echo $bill_country;?>
              </label>
            <select name="user_country"  id="user_country" onChange="get_country_state(this.value,'','user_state');" class="reg_row_textfield">
            <option value=""><?php _e('Selecione um País');?></option>
            <?php echo frontend_country_dl(esc_attr(stripslashes($user_country)));?>
            </select>
             </div>
             <div class="reg_row fl">
              <label>
              <?php _e(STATE_TEXT) ?> <?php echo $bill_state;?>
              </label>
             <span id="state_ajax_indicator">
            <select name="user_state"  id="user_state" class="reg_row_textfield">
            <option value=""><?php _e('Selecione o País Antes');?></option>
            </select>
            </span>
            </div>
           
           
             <div class="reg_row fl">
              <label>
              <?php echo PHONE_NUMBER_TEXT; ?> <?php echo $bill_phone;?>
              </label>
              <input type="text" name="phone" id="phone" class="reg_row_textfield" value="<?php echo esc_attr(stripslashes($phone)); ?>" size="25" />
            </div>
            <?php
			if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/registration_frm_page_above_captcha.php'))
			{
				include_once(CHILDTEMPLATEPATH . '/registration_frm_page_above_captcha.php');
			}
			?>
            <?php pt_get_captch();?>
            <?php do_action('register_form'); ?>
             <?php
			if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/registration_frm_page_below_captcha.php'))
			{
				include_once(CHILDTEMPLATEPATH . '/registration_frm_page_below_captcha.php');
			}
			?>
            <div id="reg_passmail">
               <?php _e(REGISTRATION_EMAIL_MSG) ?>
            </div>
            
            <a  href="javascript:void(0);" onclick="return chk_form_reg();" class="highlight_button fr " ><?php _e(CREATE_ACCOUNT_BUTTON);?> </a>
       
        </div>
           </form>
           <?php
		if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/registration_frm_page_below_form.php'))
		{
			include_once(CHILDTEMPLATEPATH . '/registration_frm_page_below_form.php');
		}
		?>
</div>
