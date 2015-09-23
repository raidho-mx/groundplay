<?php 	get_header(); 
	foreach((get_the_category()) as $category) {
		$catNoUrl = $category->cat_name . ' ';
		$catSlug = $category->slug;
	} ?>

<section id="blog_main">
	<div class="contain_blog">
		
<?php 	if ( have_posts() ) { ?>
        <ul id="blog_loop" class="of_a">
    <?php	while ( have_posts() ) {
                the_post();
                if (has_post_thumbnail( $post->ID ) ) { 
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                <li>
                    <div class="featured_holder" style="background-image:url(<?php echo $image[0]; ?>);">
                        <?php the_tags('<ul class="tags"><li>','</li><li>','</li></ul>'); ?>
                        <a class="cl_area" href="<?php the_permalink(); ?>"></a>
                    </div>
        <?php	} else {the_tags('<ul class="tags"><li>','</li><li>','</li></ul>');} ?>
                                
                    <div class="info_holder">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <h1><?php the_title(); ?></h1>
                            <div class="meta gray">
                                <p>Posted on <?php the_time('F j Y'); ?> by <span class="red"><?php if(get_field('auth-name')) { the_field('auth-name'); } else { the_author(); }?></span>.</p>
                            </div>
                            <div class="excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            <?php if(get_field('eng-excerpt')): ?>
                                <div class="excerpt gray"><?php the_field('eng-excerpt'); ?></div>
                            <?php endif; ?>
                        </a>
                    </div>
                </li>
<?php 	} // end while ?>
                <div class="pagination">
        <?php 	global $wp_query;
                $big = 999999999; // need an unlikely integer
                $translated = __( '', 'mytextdomain' ); // Supply translatable string
                
                echo paginate_links( array(
                    'prev_text'    => __('« Prev'),
                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format' => '?paged=%#%',
                    'current' => max( 1, get_query_var('paged') ),
                    'total' => $wp_query->max_num_pages,
                    'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
                ) );  ?> 
                </div>
        </ul>
        <?php 	} // end if	?>        

        </div>
</section>

<section id="blog_goods">
    <h1 class="big_title">Blog</h1>
    <?php //wp_tag_cloud( 'smallest=8&largest=22&orderby=count&order=DESC&number=0' ); ?>
    <div class="tag_cloud">
        <h2>Temas: </h2>
        <?php ctc( 'smallest=14&largest=16&unit=px&orderby=count&order=DESC&number=0&minnum=4&format=list' ); ?>
    </div>
    <div class="tag_cloud">
        <h2>Autores: </h2>
        <ul class="tags">
            <?php wp_list_authors('show_fullname=1'); ?>
        <?php   // autores invitados. 
                // get_field('auth-name') & href= search?'auth-name'   ?>
        </ul>
    </div>

    <div id="banners" class="contain_ctr">
<?php   $ad_query = new WP_Query('pagename=publicidad'); 
            while ( $ad_query->have_posts() ) : 
            $ad_query->the_post();
            $rows = get_field('publicidad');
            $rand_keys = array_rand($rows, 2);
            $ad1 = $rows[$rand_keys[0]]; 
            $ad2 = $rows[$rand_keys[1]]; ?>

            <div class="half left">
                <a href="http://<?php echo $ad1['link']; ?>" title="<?php echo $ad1['name']; ?>" target="_blank">
                    <img src="<?php echo $ad1['banner_square']; ?>" />
                </a>
            </div>
            <div class="half left">
                <a href="http://<?php echo $ad2['link']; ?>" title="<?php echo $ad2['name']; ?>" target="_blank">
                    <img src="<?php echo $ad2['banner_square']; ?>" />
                </a>
            </div>

        <?php   endwhile;
                wp_reset_postdata(); ?>
    </div>
</section>
        
<?php get_footer(); ?>