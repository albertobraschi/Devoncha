<?php
global $wpdb,$upload_folder_path;
if($_POST)
{
	$subject = $_POST['subject'];
	$message = stripslashes($_POST['message']);
	$filename = $_POST['filename'];
	$file = $_POST['notification'];	
	if($file=='emails' || $file=='message')
	{
		$destinationfile = ABSPATH . "wp-content/themes/".get_option('template')."/library/notification/$file/$filename";
		if($subject)
		{
			$subject = '[SUBJECT-STR]'.$subject.'[SUBJECT-END]';
		}
		echo $message = $subject.$message;
		file_put_contents($destinationfile,$message);
		
		$fp = fopen($destinationfile,'rw');
		wp_redirect(site_url('/wp-admin/admin.php?page=notification&msg=success'));
	}
}
?>
<div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_notification_edit"><?php _e('Manage Notification'); ?></span>  
 </div> <!-- sub heading -->
 <div id="page" >
<?php
$file = $_REQUEST['notification'];
$filename = $_REQUEST['file'];
if($file=='emails' || $file=='message')
{
	if($file=='emails') // Emails template
	{
		$destinationfile = ABSPATH . "wp-content/themes/".get_option('template')."/library/notification/$file/$filename";
		$filecontent = file_get_contents($destinationfile);
		$filecontent_arr1 = explode('[SUBJECT-STR]',$filecontent);
		$filecontent_arr2 = explode('[SUBJECT-END]',$filecontent_arr1[1]);
		$subject = $filecontent_arr2[0];
		$message = $filecontent_arr2[1];
		$file_array['file'] =  $filename;
		$file_array['subject'] =  $subject;
		$file_array['message'] =  $message;
	}elseif($file=='message')  // Message Templaes
	{
		$destinationfile = ABSPATH . "wp-content/themes/".get_option('template')."/library/notification/$file/$filename";
		$filecontent = file_get_contents($destinationfile);
		$file_array['file'] =  $filename;
		$file_array['message'] =  $filecontent;
	}
}
?>
<?php
if($file_array)
{
	?>
  <h3><?php echo $page_title;?></h3>
  <form action="" method="post" name="message_frm">
  <input type="hidden" name="filename" value="<?php echo $file_array['file'];?>">
  <input type="hidden" name="notification" value="<?php echo $file;?>">
  <table width="100%" cellpadding="5" class="widefat post sub_table" >
  <tr>
  <td width="100px" align="right"><?php _e('File Name');?> : </td>
  <td><?php echo $file_array['file'];?></td>
  </tr>
  <tr>
  <td width="100px" align="right"><?php _e('File Path');?> : </td>
  <td><?php echo $destinationfile;?></td>
  </tr>
  <?php
  if($file=='emails')
  {
  ?>
  <tr>
  <td align="right"><?php _e('Subject');?> : </td>
  <td><input type="text" name="subject" value="<?php echo $file_array['subject'];?>" size="80"></td>
  </tr>
  <?php
  }
  ?>
  <tr>
  <td align="right"><?php _e('Message');?> : </td>
  <td><textarea name="message" cols="90" rows="20"><?php echo $file_array['message'];?></textarea></td>
  </tr>
  <tr>
  <td></td>
  <td><input type="submit" name="Submit" value="<?php _e('Submit')?>" class="b_common"> 
  <input type="button" name="cancel" class="b_normal" value="<?php _e('Cancel')?>" onClick="window.location.href='<?php echo site_url('/wp-admin/admin.php?page=notification');?>'">
  <input type="button" name="cancel" class="b_normal"  value="<?php _e('Back')?>" onClick="window.location.href='<?php echo site_url('/wp-admin/admin.php?page=notification');?>'">
  </td>
  </tr>
   <tr>
  <td colspan="2"><?php printf(__('<b>Note :-</b> Please make sure "%s" file and folder permission is 0777 otherwise the content will not changed.'),$destinationfile);?></td>
  </tr>
</table>
</form>
<?php  
}
?>
</div> <!-- page #end -->
 </div>   <!-- wrapper #end -->