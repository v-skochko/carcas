<?php get_header();?>
<div id="content" class="row cfx ">
	<main  role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
        <article>
        <span class="icf-exclamation"></span>
			<h1><span>404</span> Article Not Found</h1>
			<p>The article you were looking for was not found, but maybe try looking again!</p>
			<form role="search" method="get" class="search404" action="<?php echo home_url('/')?>" >
				<span class="icf-search"><input placeholder="Search" type="text" value="<?php echo get_search_query()?>" name="s" id="s" /></span>
				<input class="btn" type="submit" id="searchsubmit" value="Search" />
			</form>
        </article>
	</main>
</div>
<?php get_footer();?>
