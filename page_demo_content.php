<?php get_header(); /* Template Name: page_demo_content */
global $post; ?>
<div id="content" class="row cfx">
    <main  role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
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
        	<?php echo do_shortcode( '[contact-form-7 id="4" title="Contact form 1"]' ); ?>
        </article>
        <article>
        	<div class="grid-wrap">
<div class="grid">
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
</div>
<div class="grid">
<div class="col-2">Col #2</div>
<div class="col-2">Col #2</div>
<div class="col-2">Col #2</div>
<div class="col-2">Col #2</div>
<div class="col-2">Col #2</div>
<div class="col-2">Col #2</div>
</div>
<div class="grid">
<div class="col-3">Col #3</div>
<div class="col-3">Col #3</div>
<div class="col-3">Col #3</div>
<div class="col-3">Col #3</div>
</div>
<div class="grid">
<div class="col-4">Col #4</div>
<div class="col-4">Col #4</div>
<div class="col-4">Col #4</div>
</div>
<div class="grid">
<div class="col-5">Col #5</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
</div>
<div class="grid">
<div class="col-6">Col #6</div>
<div class="col-6">Col #6</div>
</div>
<div class="grid">
<div class="col-7">Col #7</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
</div>
<div class="grid">
<div class="col-8">Col #8</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
</div>
<div class="grid">
<div class="col-9">Col #9</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
</div>
<div class="grid">
<div class="col-10">Col #10</div>
<div class="col-1">Col #1</div>
<div class="col-1">Col #1</div>
</div>
<div class="grid">
<div class="col-11">Col #11</div>
<div class="col-1">Col #1</div>
</div>
<div class="grid">
<div class="col-12">Col #12</div>
</div>
<div class="grid">
	<div class="col-6">
		<div class="col-6">6</div>
		<div class="col-6">6</div>
	</div>
	<div class="col-6">
		<div class="col-2">2</div>
		<div class="col-2">2</div>
		<div class="col-2">2</div>
		<div class="col-2">2</div>
		<div class="col-2">2</div>
		<div class="col-1">1</div>
		<div class="col-1">1</div>
	</div>
</div>
</div>
        </article>
    </main>
</div>
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

.grid-wrap {
  padding: 3%;
  background: #f6f7f8;
}
.grid [class^="col-"] {
  padding: 5px;
  background: #e4e5e7;
  text-align: center;
  color: #767779;
  font-size: 11px;
}
.grid  [class^="col-"] [class^="col-"] {
  background: #ADB0B6;
  text-align: center;
  color: #fff;
}
    </style>
<?php get_footer(); ?>
