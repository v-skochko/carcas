</div>
<footer role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
    <div class="row cfx">
        <span class="copyright"><?php echo date('Y'); ?> <?php bloginfo('name'); ?></span>

        <div class="social_link">
            <a href="<?php if (get_field('facebook')) {the_field('field_name'); } else {echo "https://www.facebook.com/"; } ?>" class="i-facebook" title="Official Facebook page" target="_blank"></a>
            <a href="<?php if (get_field('instagram')) {the_field('field_name'); } else {echo "https://www.instagram.com/"; } ?>" class="i-instagram"  title="Official Instagram accounts" target="_blank"></a>
            <a href="<?php if (get_field('twitter')) {the_field('field_name'); } else {echo "https://twitter.com/"; } ?>" class="i-twitter" title="Official Twitter accounts" target="_blank"></a>
            <a href="<?php if (get_field('google')) {the_field('field_name'); } else {echo "https://plus.google.com/"; } ?>" class="i-g"  title="Official Instagram accounts" target="_blank"></a>
            <a href="<?php if (get_field('youtube')) {the_field('field_name'); } else {echo "https://www.youtube.com/"; } ?>"  class="i-youtube-play" title="Official Youtube channel"  target="_blank"></a>
            <a href="<?php if (get_field('pinterest')) {the_field('field_name'); } else {echo "https://pinterest.com/"; } ?>"   class="i-pinterest" title="Official Pinterest accounts"target="_blank"></a>
            <a href="<?php if (get_field('pinterest')) {the_field('field_name'); } else {echo "https://www.linkedin.com/"; } ?>"   class="i-linkedin" title="Official Linkedin profile" target="_blank"></a>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>

</body>
</html>
<?php ob_end_flush() ?>




