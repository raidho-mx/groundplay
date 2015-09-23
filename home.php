<?php   get_header();

        foreach((get_the_category()) as $category) {
            $catNoUrl = $category->cat_name . ' ';
            $catSlug = $category->slug;
        } ?>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $("body").addClass('intro');
    });
</script>

<?php echo get_template_part('inc/player', 'home'); ?>



<section id="mas_episodios" class="contain_ctr">
    <h2><span class="red">Just Baked!</span> Lo más reciente.</h2>

    <div class="scrollable">
        <div class="scrollbar"><div class="track"><div class="thumb no_inst"><hr><hr></div></div></div>
        <div class="hold_eps viewport">
            <ul class="overview">
            <?php   

                $eps_query = new WP_Query('posts_per_page=12'); 
                while ( $eps_query->have_posts() ) : 
                $eps_query->the_post(); ?>
                
                <li><a href="<?php the_permalink(); ?>">
                    <div class="img_thumb gr2clr " style="background-image:url(<?php                                        
                        $ep_image = wp_get_attachment_image_src( get_field('poster_video'), "large" );
                        if( $ep_image ) { 
                            echo $ep_image[0]; 
                        } else { 
                            echo bloginfo('template_url').'/img/video_fallback.jpg';
                        } ?>);">
                    </div>
                    <?php if (strtotime($post->post_date) > strtotime('-14 days')): ?> <div class="white new_tag">¡Just Baked!</div> <?php endif; ?>
                    <span class="link"><strong>
                <?php   if( get_field('episode') ): 
                            echo 'Ep. ';
                            the_field('episode');
                        endif; ?>
                    </strong> / <?php the_time('M Y'); ?></span>
                    <h2><?php the_title(); ?></h2>
                </a></li>
        
        <?php   endwhile;
                wp_reset_postdata(); ?>
            </ul>
        </div>
    </div>
</section>



    <section id="banners" class="contain_ctr">
<?php   $ad_query = new WP_Query('pagename=publicidad'); 
        while ( $ad_query->have_posts() ) : 
            $ad_query->the_post();
            $rows = get_field('publicidad');
            $rand_keys = array_rand($rows, 2);
            $ad1 = $rows[$rand_keys[0]]; 
            $ad2 = $rows[$rand_keys[1]]; ?>

            <div class="half left">
                <a href="http://<?php echo $ad1['link']; ?>" title="<?php echo $ad1['name']; ?>" target="_blank">
                    <img src="<?php echo $ad1['banner_large']; ?>" width="590" height="220" />
                </a>
            </div>
            <div class="half right">
                <a href="http://<?php echo $ad2['link']; ?>" title="<?php echo $ad2['name']; ?>" target="_blank">
                    <img src="<?php echo $ad2['banner_large']; ?>" width="590" height="220" />
                </a>
            </div>

<?php   endwhile;
        wp_reset_postdata(); ?>
    </section>

<?php   get_footer(); ?>