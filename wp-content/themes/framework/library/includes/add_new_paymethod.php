  <h2><?php _e('Install New Payment Gateway'); ?></h2>
  <?php if($_REQUEST['msg']=='exist'){?>
  <div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
    <p><?php _e('Installed successully.'); ?></p>
  </div>
  <?php }?>
  <?php
  if($install_message)
  {
	echo '<div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >';
	_e($install_message); 
	echo '</div>';
	$message='';
  }
  ?>
  <table width="75%" cellpadding="3" cellspacing="3" class="widefat post" >
    
 
 <?php

if ($handle = opendir(TEMPLATEPATH . '/library/payment')) {
    /* This is the correct way to loop over the directory. */
    while (false !== ($file = readdir($handle))) 
	{
       if($file=='.' || $file=='..')
	   {
	   	
	   }else
	   {
		  ?>
          <tr>
      <td width="20%"><?php _e($file); ?></td>
      <td width="80%">:
          <?php
			if(get_option('payment_method_'.$file))
			{
				echo '<a href="'.site_url('/wp-admin/admin.php?page=paymentoptions&uninstall='.$file).'">Uninstall</a>';
			}else
			{
				echo '<a href="'.site_url('/wp-admin/admin.php?page=paymentoptions&install='.$file).'">Install</a>';
			}
		?>
         </tr>
        <?php
	   }
    }
    closedir($handle);
}
?>

   
    <tr>
      <td>&nbsp;</td>
    <td>    </tr>
  </table>
