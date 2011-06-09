<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!'));

	if ( post_password_required() ) { ?>

<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.');?></p>
<?php
		return;
	}
?>
<!-- You can start editing here. -->
<div id="comments_wrap" >
  <?php if ( have_comments() ) : ?>
  <h3>
    <?php _e('One Comment');?>
      </h3>
  <ol class="commentlist">
    <?php wp_list_comments('avatar_size=48&callback=custom_comment'); ?>
  </ol>
  <div class="navigation">
    <div class="fl">
      <?php previous_comments_link() ?>
    </div>
    <div class="fr">
      <?php next_comments_link() ?>
    </div>
    <div class="fix"></div>
  </div>
  <br />
  <?php if ( $comments_by_type['pings'] ) : ?>
  <h3 id="pings"><?php _e('Trackbacks For This Post');?></h3>
  <ol class="commentlist">
    <?php wp_list_comments('type=pings'); ?>
  </ol>
  <?php endif; ?>
  <?php else : // this is displayed if there are no comments so far ?>
  <?php if ('open' == $post->comment_status) : ?>
  <!-- If comments are open, but there are no comments. -->
  <?php else : // comments are closed ?>
  <!-- If comments are closed. -->
  <p class="nocomments">Comments are closed.</p>
  <?php endif; ?>
  <?php endif; ?>
</div>
<!-- end #comments_wrap -->
<?php if ('open' == $post->comment_status) : ?>
<div id="respond">
  <h3><?php _e('Leave a Reply');?> </h3>
  <div class="cancel-comment-reply"> 
    	<p> <?php cancel_comment_reply_link(); ?> </p>
      </div>
  <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
  <?php printf(__('<p>You must be <a href="%s/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>',site_url()));?>
  <?php else : ?>
  <form action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post" id="commentform">
    <?php if ( $user_ID ) : ?>
    <p>Login efetuado. Deixe Seu Comentário &rarr; <a href="<?php echo site_url('/wp-admin/profile.php'); ?>"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(); ?>" title="Log out of this account"><?php _e('Sair');?> &raquo;</a></p>
    <?php else : ?>
    <p class="commpadd">
      <label for="author"><?php _e('Nome');?>
      <?php if ($req) _e('*'); ?>
      </label>
     <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
     </p>
    <p class="commpadd">
       <label for="email"><?php _e('E-Mail');?>
      <?php if ($req) _e('*'); ?>
      </label>
      <input type="text" name="email" id="email" value="<?php echo $comment_auth_email; ?>" size="22" tabindex="2" />
      
    </p>
    <p class="commpadd">
    	<label for="url" ><?php _e('Site');?></label>
      <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
    </p>
    <?php endif; ?>
    <p class="commpadd">
      <label for="comment"><?php _e('Comment');?></label>
      <textarea name="comment" id="comment" rows="10" cols="10" tabindex="4"></textarea>
    </p>
    
      <input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Enviar Comentário');?>" />
      <?php comment_id_fields(); ?>
     
    <?php do_action('comment_form', $post->ID); ?>
  </form>
  <?php endif; // If logged in ?>
  <div class="fix"></div>
</div>
<!-- end #respond -->
<?php endif; // if you delete this the sky will fall on your head ?>
