</div>
<footer>
    <div class="row flex  ai_center">
		<?php if ( get_field( 'copyright', 'options' ) ): ?>
            <div class="copyright">
				<?php the_field( 'copyright', 'options' ); ?>
            </div>
		<?php endif; ?>

        <div class="s_link">
			<?php get_template_part( 'template-parts/social', 'icons' ); ?>
        </div>
    </div>
</footer>
<a href="#" class="burger desctop_hide"><span class="burger-icon "></span></a>
<div class="resp_container desctop_hide cfx">

</div>
<?php wp_footer(); ?>
</body>
</html>