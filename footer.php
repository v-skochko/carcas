</div>
<footer>
	<div class="row flex  ai_center">
		<span class="copyright"><?php echo date( 'Y' ); ?><?php bloginfo( 'name' ); ?></span>
		<div class="s_link">
			<?php echo socail_link(); ?>
		</div>
	</div>
</footer>
<a href="#" class="burger desctop_hide"><span class="burger-icon "></span></a>
<div class="resp_container desctop_hide cfx">
	<form role="search" method="get" class="resp_search" action="<?php echo home_url( '/' ); ?>">
		<input type="search" class="search-field" placeholder="Search on site" value="" name="s" title="Search for:"/>
	</form>
</div>
<?php wp_footer(); ?>
</body>
</html>