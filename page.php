<?php   get_header();

        foreach((get_the_category()) as $category) {
            $catNoUrl = $category->cat_name . ' ';
            $catSlug = $category->slug;
        }  ?>

<?php echo get_template_part('inc/ads', 'topbanner'); ?>



<?php 
    $categories = get_the_category();
    $comCheck = new WP_Query(array(
        'post_type' => 'commercials',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'com_relationA', 
                'value' => '"' . $categories[0]->cat_ID . '"', 
                'compare' => 'LIKE'
            ),
            array(
                'key' => 'com_relationB', 
                'value' => '"' . get_the_ID() . '"', 
                'compare' => 'LIKE'
            )
        ),
        'orderby' => 'rand',
        'posts_per_page' => 1
    ));  
    if( $comCheck->have_posts() ) {
        echo get_template_part('inc/player', 'comm');
    } else {
        echo get_template_part('inc/player', 'normal');
    } ?>


<section class="single_info contain_ctr">
        <div class="col65 left">
            <div class="main_col">
                <h1 class="big_title"><?php the_title(); ?></h1>
                <div class="meta gray">
                    <div class="half left">
                        <?php the_category( ', ' ); ?>. 
            <?php   if( get_field('episode') ): 
                    echo 'Episodio ';
                    the_field('episode');
                    echo '. ';
                endif; ?>
            <?php   if( get_field('season') ):
                    echo 'Temporada ';
                    the_field('season');
                    echo '. ';
                endif; ?><br />
                             <?php the_tags('Tags: ', ', ', ''); ?> 
                    </div>
                    <?php if ( is_user_logged_in() ) { ?> 
                    <div class="views half right hide">
                        <p class="whole">
                            <span class="red">5,039</span><br>
                            Views
                        </p>
                        <ul class="sources">
                            <li><span class="red">6,420</span>wearenotzombies.tv</li>
                            <li><span class="red">2,324</span>Youtube</li>
                            <li><span class="red">240</span>Daily Motion</li>
                            <li><span class="red">420</span>Other (Facebook, Twitter, ...)</li>
                        </ul>
                    </div>
                    <?php } ?>
                </div>

                        <div class="<?php if( have_rows('featuring') ): echo 'half '; endif;?>left mod">
                                <?php   // Titulo de sinopsis */ ?>
                                <p><?php the_field('es_description'); ?></p>
                                <p class="eng gray"><?php the_field('en_description'); ?></p>
                                

<?php // Mas Info ?>                                
                                
            <?php   if( have_rows('more_info') ): ?>
                                <h2>More Info</h2>
                                <ul>
                                <?php   while ( have_rows('more_info') ) : the_row(); ?>
                                        <li><a href="<?php the_sub_field('link'); ?>" title="<?php the_sub_field('name'); ?>" target="_blank"><?php the_sub_field('name'); ?></a></li>
                                <?php   endwhile; ?>
                                </ul>
                        <?php else : endif; ?>
            </div>
                        

<?php // featuring ?>                                

<?php if( have_rows('featuring') ): ?>
            <ul class="half right mugs mod">
            <h2>Featuring</h2>
            <?php   while ( have_rows('featuring') ) : the_row(); ?>
                <li class="half left"><a href="<?php the_sub_field('link'); ?>" title="<?php the_sub_field('name'); ?>" target="_blank">
                    <img class="circle" src="<?php  
                                    $ft_image = wp_get_attachment_image_src( get_sub_field('foto'), "thumbnail" );
                                    if( $ft_image ) { 
                                            echo $ft_image[0]; 
                                    } else { 
                                            echo bloginfo('template_url').'/img/video_fallback.jpg';
                                    } ?>" width="90" height="90" />
                    <h3><?php the_sub_field('name'); ?></h3>
                    <span class="gray"><?php the_sub_field('slug'); ?></span>
                </a></li>
            <?php   endwhile; ?>
            </ul>
<?php else : endif; ?>


<?php // mapa ?>   

        <?php if( get_field('map') ): ?>
            <div class="map_container">
                <?php echo get_field('map'); ?>
            </div>
        <?php endif; ?>


        </div>                        
    </div>  <?php // .main_col ?>
                
                
        <div class="comments col35 right">                  
    <?php   $ad_query = new WP_Query('pagename=publicidad'); 
                while ( $ad_query->have_posts() ) : 
                $ad_query->the_post(); ?>

    <?php   $rows = get_field('publicidad' ); // get all the rows
            $rand_row = $rows[ array_rand( $rows ) ]; // get the first row      ?>

                    <a href="http://<?php echo $rand_row['link']; ?>" title="<?php echo $rand_row['name']; ?>" target="_blank">
                        <img src="<?php echo $rand_row['banner_large']; ?>" width="590" height="220" />
                    </a>

        <?php   endwhile;
                wp_reset_postdata(); ?>

            <div id="disqus_thread"></div>
            <script type="text/javascript">
                    // * * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * * /
                    var disqus_shortname = 'wearenotzombies'; // Required - Replace example with your forum shortname
                    
                    // * * * DON'T EDIT BELOW THIS LINE * * * /
                    (function() {
                            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                    })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        </div>
</section>


<section id="mas_episodios" class="contain_ctr">
    <h2>Más episodios de <span class="red"><?php echo $category->cat_name; ?></span></h2>

    <div class="scrollable">
        <div class="scrollbar"><div class="track"><div class="thumb no_inst"><hr><hr></div></div></div>
        <div class="hold_eps viewport">
            <ul class="overview">
            <?php   

                $eps_query = new WP_Query('category_name='.$category->category_nicename); 
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
                    <h2 class="clmp_2"><?php the_title(); ?></h2>
                </a></li>
        
        <?php   endwhile;
                wp_reset_postdata(); ?>
            </ul>
        </div>
    </div>
</section>


    <?php   
        
        $args = array( 'hide_empty' => '1' );
        $categories = get_categories($args);
        if($categories): ?>
    <section id="mas_shows" class="contain_ctr">
        <h2>Todos los <a href="#">Shows</a></h2>

        <div class="scrollable">
            <div class="scrollbar"><div class="track"><div class="thumb no_inst"><hr><hr></div></div></div>
            <div class="hold_eps viewport">
                <ul class="overview">
        <?php   foreach($categories as $category) {
            $image = get_field('fondo', 'category_'.$category->term_id); 
            $category_link = get_category_link($category->cat_ID); ?>
                    <li><a href="<?php echo $category_link; ?>">
                        <div class="img_thumb gr2clr" style="background-image:url(<?php echo $image; ?>);"></div>
                        <h2><?php echo $category->name; ?></h2>
                    </a></li>
        <?php } ?>
                </ul>
            </div>
        </div>
    
    </section>
    <?php endif; ?>

<?php   get_footer(); ?>