</div>
<footer class="footer">
    <div class="row">
		<?php if ( get_field( 'copyright', 'options' ) ): ?>
            <div class="copyright">
				<?php the_field( 'copyright', 'options' ); ?>
            </div>
		<?php endif; ?>
        <div class="s_link">
			<?php get_template_part( 'components/social', 'icons' ); ?>
        </div>
    </div>
</footer>
<a href="#" class="burger desctop_hide"><span class="burger-icon "></span></a>
<div class="resp_container desctop_hide cfx">
    <nav class="mobile_nav">
		<?php
		$mobile_nav = array(
			'theme_location' => 'main_menu',
			'menu'           => '',
			'container'      => false,
			'menu_class'     => 'level_a'
		);
		wp_nav_menu( $mobile_nav );
		?>
    </nav>
</div>
<?php wp_footer(); ?>
</body>
</html>