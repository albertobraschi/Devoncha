<?php
global $wpdb;
?>
<div id="wrapper">
   <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_manage_notification"><?php _e('Manage Notification'); ?></span>  
 </div> <!-- sub heading -->
 <div id="page" >
 
<?php if($_REQUEST['msg']=='success'){?>
<div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
  <p><?php _e('updated successfully.'); ?></p>
</div>
<?php }?>
<?php
$notification_path = ABSPATH . $upload_folder_path."notification/";
if (!file_exists($notification_path))
{
  mkdir($notification_path, 0777);
}
$notification_dir = ABSPATH . "wp-content/themes/".get_option('template')."/library/notification";
$handle = opendir($notification_dir);
while (false !== ($file = readdir($handle))) 
{
        if($file=='emails' || $file=='message')
		{
			if($file=='emails') // Emails template
			{
				$notification_dir1 = MSG_NOTIFICATION_DIR .$file;
				$handle1 = opendir($notification_dir1);
				$email_file_array = array();
				while (false !== ($file1 = readdir($handle1))) 
				{
					$emailcontent = array();
					$file_arr = explode('.', $file1);
					if($file_arr[1] == 'txt')
					{
						$srcfile =  "$notification_dir1/$file1";
						$destinationfile =  $srcfile;
						$filecontent = file_get_contents($destinationfile);
						$filecontent_arr1 = explode('[SUBJECT-STR]',$filecontent);
						$filecontent_arr2 = explode('[SUBJECT-END]',$filecontent_arr1[1]);
						$subject = $filecontent_arr2[0];
						$message = $filecontent_arr2[1];
						$emailcontent['file'] =  $file1;
						$emailcontent['subject'] =  $subject;
						$emailcontent['message'] =  $message;
						$email_file_array[] = $emailcontent;
					}
				}
			}elseif($file=='message')  // Message Templaes
			{
				$notification_dir1 = MSG_NOTIFICATION_DIR .$file;
				$handle1 = opendir($notification_dir1);
				$message_file_array = array();
				while (false !== ($file1 = readdir($handle1))) 
				{
					$messagecontent = array();
					$file_arr = explode('.', $file1);
					if($file_arr[1] == 'txt')
					{
						$srcfile =  "$notification_dir1/$file1";
						$destinationfile =  $srcfile;
						if(!file_exists($destinationfile))
						{
							copy($srcfile,$destinationfile);
						}
						$filecontent = file_get_contents($destinationfile);
						$messagecontent = array();
						$messagecontent['file'] =  $file1;
						$messagecontent['message'] =  $filecontent;
						$message_file_array[] = $messagecontent;
					}
				}
			}
		}
}
closedir($handle1);
closedir($handle);
?>
<?php
if($email_file_array)
{
	?>
    <h3><?php _e('Emails');?></h3>
    <table width="100%" cellpadding="5" class="widefat post" >
  <thead>
    <tr>
      <th width="150" align="left"><strong><?php _e('File Name'); ?></strong></th>
      <th width="150" align="left"><strong><?php _e('Subject'); ?></strong></th>
      <th width="500" align="left"><strong><?php _e('Description'); ?></strong></th>
    </tr>
   </thead>
    <?php
	for($e=0;$e<count($email_file_array);$e++)
	{
?>
    <tr>
      <td><a href="<?php echo site_url('/wp-admin/admin.php?page=notification&notification=emails&file='.$email_file_array[$e]['file']);?>"><?php echo $email_file_array[$e]['file'];?></a></td>
      <td><?php echo $email_file_array[$e]['subject'];?></td>
      <td><?php echo $email_file_array[$e]['message'];?></td>
    </tr>
<?php
	}
	?>
    </table>
    <?php
}
?>
<?php
if($message_file_array)
{
	?>
    <h3><?php _e('Messages');?></h3>
    <table width="100%" cellpadding="5" class="widefat post " >
  <thead>
    <tr>
       <th width="100" align="left"><strong><?php _e('File Name'); ?></strong></th>
      <th width="500" align="left"><strong><?php _e('Description'); ?></strong></th>
    </tr>
   </thead>
    <?php
	for($e=0;$e<count($message_file_array);$e++)
	{
?>
    <tr>
      <td><a href="<?php echo site_url('/wp-admin/admin.php?page=notification&notification=message&file='.$message_file_array[$e]['file']);?>"><?php echo $message_file_array[$e]['file'];?></a></td>
      <td><?php echo $message_file_array[$e]['message'];?></td>
    </tr>
<?php
	}
	?>
    </table>
    <?php
}
?>

</div> <!-- page #end -->
 </div>   <!-- wrapper #end -->