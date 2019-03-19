<?php get_header(); ?>
<div id="content" class="row">
    <main>
        <h1 class="page-title"><?php the_title(); ?></h1>
         <?php if ('' !== get_post()->post_content) { ?>
                
            
        
        <div class="wysiwyg">
            <?php if (have_posts()): while (have_posts()): the_post();
                the_content();
            endwhile;endif;
            ?>
        </div>
        <?php } ?>
    </main>
</div>
<?php get_footer(); ?>
