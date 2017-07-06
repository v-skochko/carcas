<?php get_header(); ?>
    <div id="content" class="row cfx ">
        <main>
            <article>
                <div class="cog_container">
                    <div class="cog_overlay">
                    </div>
                    <span class="i-cog cog_icon cog_top"></span>
                    <span class="i-cog cog_icon cog_left"></span>
                    <span class="i-cog cog_icon cog_right"></span>
                </div>
                <h1><i>404</i> Page Not Found</h1>
                <p>The article you were looking for was not found, but maybe try looking again!</p>
                <form role="search" method="get" class="search404" action="<?php echo home_url( '/' ) ?>">
                <span class="i-search">
                <input placeholder="Search" type="search" value="<?php echo get_search_query() ?>" name="s" id="s"/>
                </span>
                    <input type="submit" id="searchsubmit" value="Search"/>
                </form>
            </article>
        </main>
    </div>
    <style>
    </style>
<?php get_footer(); ?>