<?php get_header(); ?>
<div id="content" class="row cfx ">
    <main role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
        <article>
            <div class="inside_web">
                <div class="l_overlay">
                </div>
                <span class="icf-cog cog_top"></span>
                <span class="icf-cog cog_left"></span>
                <span class="icf-cog cog_right"></span>
            </div>
            <h1><i>404</i> Page Not Found</h1>
            <p>The article you were looking for was not found, but maybe try looking again!</p>
            <form role="search" method="get" class="search404" action="<?php echo home_url('/') ?>">
                <span class="icf-search">
                <input placeholder="Search" type="search" value="<?php echo get_search_query() ?>" name="s" id="s"/>
                </span>
                <input class="btn" type="submit" id="searchsubmit" value="Search"/>
            </form>
        </article>
    </main>
</div>
<style>
</style>
<?php get_footer(); ?>