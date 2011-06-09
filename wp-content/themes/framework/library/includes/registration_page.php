<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/registration_page_above_title.php'))
{
	include_once(CHILDTEMPLATEPATH . '/registration_page_above_title.php');
}
?>
 <h1 class="head"><?php echo $title;?></h1>
    <div class="breadcrumb clearfix">
      <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',' &raquo; '.$title_cum); } ?>
    </div>
<?php 
echo $_SESSION['error_message_reg']; 
$_SESSION['error_message_reg']='';
?>
 <?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/registration_page_below_title.php'))
{
	include_once(CHILDTEMPLATEPATH . '/registration_page_below_title.php');
}
?> 	
        
 <div class="registernchekout_m" style="width:<?php echo $box_width;?>%">
                    <h3> <?php _e(REGISTER_AND_CHECKOUT_TEXT); ?> </h3>
                    <p> <?php _e(REGISTER_CHECKOUT_MSG);?>  </p>
                     <input class="highlight_input_btn " type="button" onclick="showhide_registration();" value="Nova Conta &raquo;" name="confirm"/>
 <?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/registration_page_below_reg_area.php'))
{
	include_once(CHILDTEMPLATEPATH . '/registration_page_below_reg_area.php');
}
?> 
                   </div>


<div class="sign_in_l" style="width:<?php echo $box_width;?>%" >
        <h3> <?php _e(SING_IN_TEXT);?> </h3>
        
        <p> <?php _e(SIGN_IN_MSG);?> </p>
        <p> <a href="javascript:void(0);showhide_forgetpw();"><u>Esqueceu sua senha?</u></a></p>
       <input class="highlight_input_btn " type="button" onclick="showhide_login();" value="Entrar &raquo;" name="confirm"/>
    </div>
    
<?php
if($themeUI->is_on_guest_checkout())
{
?>
   <div class="checkout_r" style="width:26%" >
    <h3> <?php _e(GUEST_CHECKOUT_TEXT); ?> </h3>
    <p> <?php _e(GUEST_CHECKOUT_MSG);?>  </p>
     <input class="highlight_input_btn " type="button" onclick="window.location.href='<?php global $General; echo $General->get_ssl_normal_url(site_url());?>/?ptype=checkout&checkout_as_guest=1'" value="<?php _e('Finalizar Compras');?> &raquo;" name="confirm"/>
   </div>
<?php
}
?>
<?php
if($themeUI->is_on_guest_checkout())
{
?>
<h3><a href="<?php // echo site_url();?>/?ptype=checkout&checkout_as_guest=1"><?php // _e(CHEKCOUOT_AS_GUEST_TEXT);?></a></h3>
<?php
}
?>
<?php
if($error_message)
{
	echo "<div class=error_msg>".$error_message.'</div>';
}
$forgot_password_error = 0;
if($message)
{
	echo "".$message.'';
	$forgot_password_error = 1;
}
$login_invalid_error = 0;
if ( isset($_POST['log']) )
{
	if( 'incorrect_password' == $errors->get_error_code() || 'empty_password' == $errors->get_error_code() || 'invalid_username' == $errors->get_error_code() )
	{
		$login_invalid_error = 1;
		echo "<div class=\"error_msg\"> Invalid Username/Password. </div>";
	}
}
if($errors->get_error_code() == 'invalidcombo')
{
	$showforgotpwflag = 1;
	$errors = $errors->errors;
	echo "<div class=error_msg>".$errors['invalidcombo'][0].'</div>';
}
$chekcout_method = $General->get_checkout_method();
if($chekcout_method!='login_reg_not')
{
?>
<?php include(TEMPLATEPATH . '/library/includes/login_frm.php');?>
<?php if($chekcout_method != 'reg_not'){?>
<?php include(TEMPLATEPATH . '/library/includes/registration_frm.php');?>
<?php }?>
<?php }else
{
 _e('<div class="sucess_msg">Neither Registration nor Login allow.</div>');	
}?>
<script language="javascript" type="text/javascript">

function showhide_forgetpw()
{
	if(document.getElementById('lostpassword_form').style.display=='none')
	{
		document.getElementById('lostpassword_form').style.display = ''
		document.getElementById('login_form_div_id').style.display = 'none';
		document.getElementById('reg_form_div_id').style.display = 'none';
	}	
}
function showhide_login()
{
	if(document.getElementById('login_form_div_id').style.display=='none')
	{
		document.getElementById('login_form_div_id').style.display = ''
		document.getElementById('lostpassword_form').style.display = 'none';
		document.getElementById('reg_form_div_id').style.display = 'none';
	}	
}
function showhide_registration()
{
	if(document.getElementById('reg_form_div_id').style.display=='none')
	{
		document.getElementById('reg_form_div_id').style.display = '';
		document.getElementById('lostpassword_form').style.display = 'none';
		document.getElementById('login_form_div_id').style.display = 'none';
	}	
}</script>
 <?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/registration_page_end.php'))
{
	include_once(CHILDTEMPLATEPATH . '/registration_page_end.php');
}
?> 