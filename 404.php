<?php 	get_header(); 
	foreach((get_the_category()) as $category) {
		$catNoUrl = $category->cat_name . ' ';
		$catSlug = $category->slug;
	} ?>
        
<section id="four-o-four" style="margin:40px 0 60px;">
	<div class="contain">
        	<h1>404</h1>
        	<p class="big_title">Sorry, <br>
        	there's nothing here. </p>
        </div>
</section>
        
        
<?php get_footer(); ?>