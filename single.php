<?php get_header();
global $post; ?>
<div id="content" class="row flex">
    <main class="index_main">
        <h1><?php the_title(); ?></h1>
        <div class="author">
            By <?php $a_id = $post->post_author;
			the_author_meta( 'display_name', $a_id ); ?>
        </div>
		<?php if ( has_post_thumbnail() ) { ?>
            <img src="  <?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>" alt="">
		<?php } ?>
        <div class="wysiwyg">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				the_content();
			endwhile; endif; ?>
        </div>
        <div class="shr_link">
            <a class="i-c-bk" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&t="
               title="Share on Facebook" target="_blank"
               onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.URL)); return false;"></a>
            <a class="i-c-tr"
               href="https://twitter.com/intent/tweet?source=<?php the_permalink(); ?>&text=:%20<?php the_permalink(); ?>"
               target="_blank" title="Tweet"
               onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20'  + encodeURIComponent(document.URL)); return false;"></a>
            <a class="i-c-ln"
               href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=&summary=&source=<?php the_permalink(); ?>"
               target="_blank" title="Share on LinkedIn"
               onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;"></a>
            <a class="i-mail" href="mailto:?subject=&body=:%20<?php the_permalink(); ?>" target="_blank"
               title="Email"
               onclick="window.open('mailto:?subject=' + encodeURIComponent(document.title) + '&body=' +  encodeURIComponent(document.URL)); return false;"> </a>
        </div>
		<?php comments_template(); ?>
    </main>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
