<?php
if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/footer_page.php'))
{
	include(CHILDTEMPLATEPATH . '/footer_page.php');
}else
{
	include(TEMPLATEPATH . '/library/includes/footer.php');
}
?>
<!-- slider js code start -->
<script type="text/javascript">
$().ready(function() {
	if(eval(document.getElementById('coda-slider-1')))
	{
		$('#coda-slider-1').codaSlider();
		//jQuery.noConflict(); var $j = jQuery;
	}
});	
</script>
<!-- slider js code end -->
<?php if ( get_option('ptthemes_google_analytics') <> "" ) { echo stripslashes(get_option('ptthemes_google_analytics')); } ?>
<?php wp_footer(); ?>
</body>
</html>