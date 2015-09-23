<?php 	get_header(); 
	foreach((get_the_category()) as $category) {
		$catNoUrl = $category->cat_name . ' ';
		$catSlug = $category->slug;
	} ?>
       
<section id="search_results" >    
	<div class="contain">
        	<ul class="common_list col65 of_a">
                        <h1 class="gray">You searched for <span><?php echo get_search_query(); ?></span>: </h1>
        
                <?php 	if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                
                <?php 	if ( 'post' == get_post_type()) {	?>
                        <li class="result episodes">
                                <a href="<?php the_permalink(); ?>" class="of_a">
                                        <div class="img_thumb gray_to_color" style="background-image:url(<?php
                                                
                                                $ep_image = wp_get_attachment_image_src( get_field('poster_video'), "large" );
                                                if( $ep_image ) { 
                                                        echo $ep_image[0]; 
                                                } else { 
                                                        echo bloginfo('template_url').'/img/video_fallback.jpg';
                                                } ?>);">
                                                
                                                <?php if( get_field('just_baked')) { echo '<span class="white new_tag">¡Just Baked!</span>';} else {}?>
                                                <div class="icon">&gt;</div>
                                        </div>
                                        <span class="link">
                                                <strong><?php 
                                                        if( get_field('episode') ): echo 'Ep '.get_field('episode').'.'; endif; ?></strong> / <?php the_time('M Y'); ?>
                                        </span><br />
                                        <h2><?php the_title(); ?></h2>
                                </a>
                       </li>
        
        
        
                <?php } else if ( 'blog' == get_post_type()) {	?>
                        <li class="result blog">
                                <a href="<?php the_permalink(); ?>" class="of_a">
                                        
						<?php if (has_post_thumbnail( $post->ID ) ) { 
							$bl_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
							echo '<div class="img_thumb gray_to_color" style="background-image:url('.$bl_image[0].')"></div>';
						} else {}?>
					<p class="link">Posted on <?php the_time('F j Y'); ?> by <strong><?php if(get_field('auth-name')) { the_field('auth-name'); } else { the_author(); }?></strong>.</p>
					<h2><?php the_title(); ?></h2>
                                </a>
                        </li>
                <?php } else {}?>
                
                <?php 	endwhile; else: ?>
                
                        <p>Sorry, can't found what you're looking for. try these though:</p>
                
                        <ul>
                        <?php	$about_query = new WP_Query('category_name='. $catSlug); 
                                while ( $about_query->have_posts() ) : 
                                $about_query->the_post(); ?>
                                
                                <li class="new"><a href="<?php the_permalink(); ?>">
                                        <div class="img_thumb gray_to_color" style="background-image:url(<?php if( get_field('poster_video') ) { the_field('poster_video');} else { echo bloginfo('template_url').'/img/video_fallback.jpg';} ?>);">
                                                <?php if( get_field('just_baked')){ echo '<span class="white new_tag">¡Just Baked!</span>';} else { echo '<span class="white new_tag">&nbsp;</span>';}?>
                                        </div>
                                        <span class="link"><strong>
                                        <?php 	if( get_field('episode') ): 
                                                        echo 'Ep. ';
                                                        the_field('episode');
                                                endif; ?>
                                        </strong> / <?php the_time('M Y'); ?></span><br />
                                        <h2><?php the_title(); ?></h2>
                                </a></li>
                        
                        <?php	endwhile;
                                wp_reset_postdata(); ?>
                        </ul>
                
                <?php 	endif; ?>
                
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
                        ) );
                ?> 
                        </div>
                </ul>
        </div>
</section>
 
        
        
<?php get_footer(); ?>