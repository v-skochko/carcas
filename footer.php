</div>
<footer>
    <div class="row cfx">
        <span class="copyright"><?php echo date('Y'); ?> <?php bloginfo('name'); ?></span>
        <div class="s_link">
            <a href="<?php if (get_field('facebook', 'options')) {the_field('facebook', 'options'); } else {echo "https://www.facebook.com/"; } ?>" class="i-facebook" title="Official Facebook page" target="_blank"></a>
            <a href="<?php if (get_field('instagram', 'options')) {the_field('instagram', 'options'); } else {echo "https://www.instagram.com/"; } ?>" class="i-instagram"  title="Official Instagram accounts" target="_blank"></a>
            <a href="<?php if (get_field('twitter', 'options')) {the_field('twitter', 'options'); } else {echo "https://twitter.com/"; } ?>" class="i-twitter" title="Official Twitter accounts" target="_blank"></a>
            <a href="<?php if (get_field('linkedin', 'options')) {the_field('linkedin', 'options'); } else {echo "https://www.linkedin.com/"; } ?>"   class="i-linkedin" title="Official Linkedin profile" target="_blank"></a>
            <a href="<?php if (get_field('google', 'options')) {the_field('google', 'options'); } else {echo "https://plus.google.com/"; } ?>" class="i-g"  title="Official Google+ page" target="_blank"></a>
            <a href="<?php if (get_field('pinterest', 'options')) {the_field('pinterest', 'options'); } else {echo "https://pinterest.com/"; } ?>"   class="i-pinterest" title="Official Pinterest accounts" target="_blank"></a>
            <a href="<?php if (get_field('youtube', 'options')) {the_field('youtube', 'options'); } else {echo "https://www.youtube.com/"; } ?>"  class="i-youtube-play" title="Official Youtube channel"  target="_blank"></a>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
<?php ob_end_flush() ?>




