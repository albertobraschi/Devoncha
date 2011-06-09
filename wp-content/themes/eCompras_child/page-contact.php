<?php
/*
Template Name: Contact Page
*/
?>
<?php
global $wqdb, $General;
if($_POST)
{
	if($_POST['your-email'])
	{
		$toEmailName = get_option('blogname');
		$toEmail = $General->get_site_emailId();
		
		$subject = $_POST['your-subject'];
		$message = '';
		$message .= '<p>Dear '.$toEmailName.',</p>';
		$message .= '<p>Name : '.$_POST['your-name'].',</p>';
		$message .= '<p>Email : '.$_POST['your-email'].',</p>';
		$message .= '<p>Message : '.nl2br($_POST['your-message']).'</p>';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		// Additional headers
		$headers .= 'To: '.$toEmailName.' <'.$toEmail.'>' . "\r\n";
		$headers .= 'From: '.$_POST['your-name'].' <'.$_POST['your-email'].'>' . "\r\n";
		
		// Mail it
		wp_mail($toEmail, $subject, $message, $headers);
		if(strstr($_REQUEST['request_url'],'?'))
		{
			$url =  $_REQUEST['request_url'].'&msg=success'	;	
		}else
		{
			$url =  $_REQUEST['request_url'].'?msg=success'	;
		}
		wp_redirect($url);
		exit;
	}
}
?>
<?php get_header(); ?>
<?php global $is_home; ?>

<div id="wrapper"  class="clearfix">
<div id="page" class="container_16 clearfix " > 
	<div id="content" class="grid_11 clearfix fr content_right">
    
    <h1 class="head"> <?php the_title(); ?></h1>
  
  <?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('<div class="breadcrumb">','</div>'); } ?>

    <?php if(have_posts()) : ?>
			<?php while(have_posts()) : the_post() ?>
            		<?php $pagedesc = get_post_meta($post->ID, 'pagedesc', $single = true); ?>
            
        
                    <div id="post-<?php the_ID(); ?>" >
                        <div class="entry"> 
                            <?php the_content(); ?>
                        </div>
                    </div><!--/post-->
                
            <?php endwhile; else : ?>
        
                    <div class="posts">
                        <div class="entry-head"><h2><?php echo get_option('ptthemes_404error_name'); ?></h2></div>
                        <div class="entry-content"><p><?php echo get_option('ptthemes_404solution_name'); ?></p></div>
                    </div>
        
        <?php endif; ?>
        
        
        <?php
			if($_REQUEST['msg'] == 'success')
			{
			?>
			<p class="success_msg">Thank you, your Information send successfully.</p>
			<?php
			}
			?>
			 
			<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" id="contact_frm" name="contact_frm" class="wpcf7-form">
            <input type="hidden" name="request_url" value="<?php echo $_SERVER['REQUEST_URI'];?>" />

            <div class="form_row "> <label> Name <span class="indicates">*</span></label>
   				<input type="text" name="your-name" id="your-name" value="" class="textfield" size="40" />
				<span id="your_name_Info" class="error"></span>
		   </div>
           
            <div class="form_row "><label>Email  <span class="indicates">*</span></label>
  				<input type="text" name="your-email" id="your-email" value="" class="textfield" size="40" /> 
				<span id="your_emailInfo"  class="error"></span>
		  </div>
                  
               <div class="form_row "><label>Subject <span class="indicates">*</span></label>
                <input type="text" name="your-subject" id="your-subject" value="" size="40" class="textfield" />
				<span id="your_subjectInfo"></span>
				</div>     
                  
           
            <div class="form_row"><label>Message <span class="indicates">*</span></label>
             <textarea name="your-message" id="your-message" cols="40" class="textarea textarea2" rows="10"></textarea> 
			<span id="your_messageInfo"  class="error"></span>
			</div>
                <input type="submit" value="Send" class="b_submit" />  
          </form> 
          
          
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery.js"></script>	 

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/contact_us_validation.js"></script>
    </div>
    <!-- content-in #end -->
    
    <div id="sidebar" class="grid_4 sidebar_left fl">
     <?php if ( function_exists('dynamic_sidebar') && (is_sidebar_active(13)) ) { // Show on the front page ?>
				<?php dynamic_sidebar(13); ?>  
         <?php } ?>
  	
    </div> <!-- Left sidebar -->
	</div> <!-- page #end -->
</div><!-- wrapper #end -->
 <?php get_footer(); ?>