<?php
function pt_get_captch()
{
	if(get_option('ptthemes_captcha_flag'))
	{	
	}else
	{	
	global $captchaimagepath;
	$captchaimagepath = get_bloginfo('template_url').'/library/captcha/';
?>
<div class="reg_row fl">
<label><?php _e('Texto Anti-Spam');?> <span class="indicates">*</span></label>
<input type="text" name="captcha" size="6" maxlength="6" class="reg_row_textfield" /> 
<img src="<?php bloginfo('template_url');?>/library/captcha/captcha.php" alt="captcha image" /></div>
<?php if($_REQUEST['emsg']=='captch'){echo '<span class="message_error2" id="category_span">'.__('Digite apenas texto em preto').'</span>';}?>
<span class="message_note"><?php _e('Digite apenas o texto em preto.');?></span>
<?php
	}
}
function pt_check_captch_cond()
{
	if(get_option('ptthemes_captcha_flag'))
	{
		return true;
	}else
	{
		if($_SESSION["captcha"] && $_POST)
		{
			if($_SESSION["captcha"]==$_POST["captcha"])
			{
				return true;
			}
			else
			{
				return false;
			}	
		}
		return true;
	}
}
?>