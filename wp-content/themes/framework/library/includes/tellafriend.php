<?php
global $General;
if($_POST)
{
	$frnd_yourname = $_POST['frnd_yourname'];
	$frnd_youremail = $_POST['frnd_youremail'];
	$frnd_name = $_POST['frnd_name'];
	$frnd_email = $_POST['frnd_email'];
	$frnd_subject = $_POST['frnd_subject'];
	$frnd_comments = $_POST['frnd_comments'];
	$productid = $_POST['productid'];
	
	$message1 = '
	 <table width="80%" align=center>';
	$message1 .=	'<tr>
		  <td>Dear '.$frnd_name.',<br><br></td>
		</tr>';
	$message1 .= '<tr><td>'.$frnd_comments.'</td></tr>';
	echo $message1 .='
	<tr><td>Your can see the following link <a href="'.site_url().'/?p='.$productid.'">Click Here</a>.</td></tr>
	<tr>
		  <td><Br><br>Thank you,<Br>'.$frnd_yourname.'</td>
		</tr>
	  </table>
	';
	echo $message1;exit;
	$General->sendEmail($frnd_youremail,$frnd_yourname,$frnd_email,$frnd_name,$frnd_subject,$message1,$extra='');///To friend email
	echo '<script>alert(document.getElementById("tellfrnddiv").innerHTML);</script>';
	wp_redirect(site_url()."/?ptype=tellafriend");
}
else
{
?>


<li class="emailtofriend"><span class="more" title="tellafrnd_div"><?php _e(EMAIL_TO_FRIEND_TEXT);?></span> 

<span id="tellafrnd_success_msg_span">&nbsp;</span>
<div style="display: none;" id="tellfrnddiv" class="tellafrnd_div hide">
  <a href="#" onclick="hideform()" class="close">Close X</a>
<iframe src="<?php echo site_url()."/?ptype=tellafriend_form&amp;pid=".$post->ID;?>" height="555" width="500"  frameborder="0" marginheight="0" marginwidth="0"   ></iframe>
</div></li>

<?php
}
?>