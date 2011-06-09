<?php 
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_main_begin.php'))
{
	include(CHILDTEMPLATEPATH . '/normal_checkout_main_begin.php');
}
?>
<?php 
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_page.php'))
{
	include(CHILDTEMPLATEPATH . '/normal_checkout_page.php');
}else
{
	include(TEMPLATEPATH . '/library/includes/normal_checkout_page.php'); //product detail page
}
?>
<script type="text/javascript">
function accepttermandconditions()
{
	//if(!accepttermandconditions_top()){ return false;}
	<?php if($General->is_show_term_conditions()){?>
	if(document.getElementById('termsandconditions').checked){
		return true;
	}else{
		alert('<?php echo CHECKOUT_JS_TERMS_CONDITIONS_MSG;?>');
		document.getElementById('termsandconditions').focus();
		return false;
	}
	<?php
	}
	?>
	if(!accepttermandconditions_bottom()){ return false;}
}
function showoptions(paymethod)
{
	<?php for($i=0;$i<count($paymethodKeyarray);$i++){?>
	showoptvar = '<?php echo $paymethodKeyarray[$i]?>options';
	if(eval(document.getElementById(showoptvar)))
	{
		document.getElementById(showoptvar).style.display = 'none';
		if(paymethod=='<?php echo $paymethodKeyarray[$i]?>')
		{
			document.getElementById(showoptvar).style.display = '';
		}
	}
	
	<?php
	}	
	?>
}
<?php
for($i=0;$i<count($paymethodKeyarray);$i++)
{
?>
if(document.getElementById('<?php echo $paymethodKeyarray[$i];?>_id').checked)
{
	showoptions(document.getElementById('<?php echo $paymethodKeyarray[$i];?>_id').value);
}
<?php
}	
?>
</script>
<?php 
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/normal_checkout_main_end.php'))
{
	include(CHILDTEMPLATEPATH . '/normal_checkout_main_end.php');
}
?>
