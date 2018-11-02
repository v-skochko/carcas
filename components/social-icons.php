<?php
if (have_rows('social_icons', 'options')):
    while (have_rows('social_icons', 'options')) : the_row();
        if (get_row_layout() == 'facebook'): ?>
            <a href="<?php the_sub_field('url'); ?>" class="i-c-bk" title="Official Facebook page">Facebook</a>
        <?php elseif (get_row_layout() == 'twitter'): ?>
            <a href="<?php the_sub_field('url'); ?>" class="i-c-tr" title="Official Twitter accounts">Twitter</a>
        <?php elseif (get_row_layout() == 'instagram'): ?>
            <a href="<?php the_sub_field('url'); ?>" class="i-c-ism" title="Official Instagram accounts">Instagram</a>
        <?php elseif (get_row_layout() == 'linkedin'): ?>
            <a href="<?php the_sub_field('url'); ?>" class="i-c-ln" title="Official Linkedin profile">Linkedin</a>
        <?php elseif (get_row_layout() == 'youtube'): ?>
            <a href="<?php the_sub_field('url'); ?>" class="i-c-yb" title="Official Youtube channel">Youtube</a>
        <?php elseif (get_row_layout() == 'vimeo'): ?>
            <a href="<?php the_sub_field('url'); ?>" class="i-c-vm" title="Official Vimeo channel">vimeo</a>
        <?php elseif (get_row_layout() == 'pinterest'): ?>
            <a href="<?php the_sub_field('url'); ?>" class="i-c-pr" title="Official Pinterest accounts">Pinterest</a>
        <?php endif;
    endwhile;
else :
    // no layouts found
endif;
?>