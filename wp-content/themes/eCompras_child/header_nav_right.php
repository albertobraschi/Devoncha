<div class="searchform">
 <form role="search" method="get" id="searchform" action="<?php bloginfo('home'); ?>" >
	<label class="screen-reader-text" for="s">Search for:</label>

	 <input type="text" value="<?php echo get_option('ptthemes_search_name'); ?>" name="s" id="s" class="s" onfocus="if (this.value == '<?php echo get_option('ptthemes_search_name'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo get_option('ptthemes_search_name'); ?>';}" />
	<input type="submit" id="searchsubmit" value="Search" />
	
	</form>
</div>



