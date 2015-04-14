<?php get_header(); /* Template Name: page_demo_content */
global $post; ?>
    <section class="content row cfx">
        <article>
		<div class="c"></div>
			<h1>heading 1</h1>
			<h2>heading 2</h2>
			<h3>heading 3</h3>
			<h4>heading 4</h4>
			<h5>heading 5</h5>
			<h6>heading 6</h6>
        </article>
        <article>
			<a class="btn" href="##">buton</a>
		</article>
		<article>
			<div class="wysiwyg">
				<h2>wysiwyg preview</h2>
				<p><strong>Strong text</strong>, consectetur adipisicing elit. <a href="##">Ad blanditiis</a>  quae aspernatur laborum iusto cupiditate ea a perspiciatis est sit rem <a href="##">repellendus</a> ex animi, itaque soluta excepturi veniam dolor ullam nobis odit impedit. Dolorum atque dolorem, omnis nam quasi quidem!</p>
			<blockquote>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur nisi sequi excepturi eos illo provident ullam doloremque aut necessitatibus ut!</p>
			</blockquote>
			</div>
        </article>
        <article>
        	<?php echo do_shortcode( '[contact-form-7 id="6" title="Demo"]' ); ?>
        </article>
    </section>
    <style>
article {
	margin: 10px 0 0 0;
	padding: 10px 0 ;
	border-bottom: 1px solid #ddd;
}
.wysiwyg {
	padding: 20px;
	margin: 20px;
	border: 1px solid #ddd;
}
    </style>
<?php get_footer(); ?>
