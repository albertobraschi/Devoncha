<?php if(get_option('ptthemes_order_add_comment_flag')){?>
<div id="respond" class="ordcomment">

<p class="commpadd">
<label for="comment"><?php echo YOUR_ORDER_COMMENTS_TEXT;?></label>
<textarea id="client_order_desc" name="client_order_desc"  cols="50" rows="3" ><?php echo stripslashes($_SESSION['client_order_desc']);?></textarea>
</p>
</div>
<?php }?>