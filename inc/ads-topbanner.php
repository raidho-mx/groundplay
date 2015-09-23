<?php 
	
//	print_r(get_the_category());
	$categories = get_the_category();

   	$toCheck = new WP_Query(array(
        'post_type' => 'take_over',
        'meta_query' => array(
        	'relation' => 'OR',
            array(
                'key' => 'en_cat', 
                'value' => '"' . $categories[0]->cat_ID . '"', 
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'relationB', 
                'value' => '"' . get_the_ID() . '"', 
                'compare' => 'LIKE'
            )
        ),
        'orderby' => 'rand',
        'posts_per_page' => 1
    ));  
	
	if( $toCheck->have_posts() ) {
		while ( $toCheck->have_posts() ) {
			$toCheck->the_post(); ?>
    <div class="top_ad animate">
        <a href="http://<?php the_field('link'); ?>" target="_blank"><div class="ad_container" style="background-image:url(<?php the_field('master_head'); ?>);"></div></a>
        <a class="close fanimate circle"><span class="up">∧</span><span class="dw">∨</span></a>
    </div>

    <script type="text/javascript">

	$( document ).ready(function() {
	    $('section#video').css("background-image", "url(<?php the_field('takeover_vid'); ?>)");
	    $('body').css("background-image", "url(<?php the_field('takeover_fondo'); ?>)");
	});
	
    </script>

<?php	}
	} wp_reset_query(); ?>    