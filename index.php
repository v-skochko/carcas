<?php get_header();
$s = 0;
if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
} else {
	$paged = 1;
}
if ( is_home() ) {
	$queryname = get_the_title( BLOG_ID );
} else {
	$queryname = 'Archive of ' . get_the_archive_title();
} ?>
<div id="content" class="row index_style flex">
	<main class="index_main">
		<?php if ( is_search() ) { ?>
			<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		<?php } else {
			echo '<h1 class="page-title">' . $queryname . '</h1>';
		} ?>
		<?php if ( have_posts() ) : while ( have_posts() ) :
			the_post(); ?>
			<div class="post_item cfx">
				<a class="the_post_thumbnail bg_center" href="<?php the_permalink(); ?>"
				   style="background-image:url(
				   <?php if ( has_post_thumbnail() ) {
					   the_post_thumbnail_url( 'medium' );
				   } else {
					   echo get_stylesheet_directory_uri();
					   echo '/img/holder.png';
				   } ?>); ">
				</a>
				<div class="info">
					<a href="<?php the_permalink(); ?>" class="blogtitle"><?php the_title(); ?></a>
					<div class="blogmeta cfx">
						<div class="author">
							<?php the_author() ?>
						</div>
						<div class="ccount">
							<?php comments_number( 'No comments', 'One comment', '% comments' ); ?>
						</div>
						<time><?php echo get_the_date( 'j F, Y' ); ?></time>
						<?php echo wp_trim_words( get_the_content(), 22, '...' ); ?>
					</div>
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