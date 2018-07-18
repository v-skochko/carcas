<?php get_header();
if ( is_home() ) {
	$queryname = get_the_title( BLOG_ID );
} else {
	$queryname = 'Archive of ' . get_the_archive_title();
} ?>
<div id="content" class="row index_style flex">
    <main class="index_main col-9 sm-12 sm-bottom">
        <h1 class="page-title">
			<?php if ( is_search() ) {
				printf( esc_html__( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>' );
			} else {
				echo $queryname;
			} ?>
        </h1>
		<?php if ( have_posts() ) : while ( have_posts() ) :
			the_post(); ?>
            <div class="post_item flex ai_stretch">
                <a class="post_thumbnail bg_center col-3 sm-12 sm-bottom" href="<?php the_permalink(); ?>"
                   style="background-image:url(
				   <?php echo post_img( 'thumbnail' ); ?>); ">
                </a>
                <div class="post_content col-9 sm-12">
                    <a title="Read more" class="post_title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <div class="author">
						<?php the_author() ?>
                    </div>
                    <time><?php echo get_the_date( 'j F, Y' ); ?></time>
					<?php echo wp_trim_words( strip_shortcodes( get_the_content() ), 20, "..." ); ?>
                </div>
            </div>
		<?php endwhile;
		endif; ?>
		<?php if ( function_exists( 'wp_pagenavi' ) ) {
			wp_pagenavi();
		} ?>
    </main>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>