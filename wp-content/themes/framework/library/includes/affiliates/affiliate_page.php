<?php
if($_REQUEST['type']=='reg')
{
	include(TEMPLATEPATH . '/library/includes/affiliates/affiliate_reg.php');
}else
{
	include(TEMPLATEPATH . '/library/includes/affiliates/affiliate_login.php');
}
?>