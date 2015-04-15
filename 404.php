<?php get_header(); ?>
<div id="content" class="row cfx ">
	<main  role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
        <article>
        <span class="icf-404"></span>
			<h1><span>404</span> Article Not Found</h1>
			<p><?php _e( 'The article you were looking for was not found, but maybe try looking again!', 'bonestheme' ); ?></p>
			<p><?php get_search_form(); ?></p>
        </article>
	</main>
</div>
<?php get_footer(); ?>
