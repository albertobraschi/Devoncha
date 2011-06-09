<?php
if(get_option('ptthemes_addcomment_showhide')=='Show' || get_option('ptthemes_addcomment_showhide')=='')
{
?>
<div class="all_comments">
  <div id="comments">
    <?php comments_template(); ?>
  </div>
</div>
<?php }?>