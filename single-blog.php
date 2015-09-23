<?php 	get_header(); 
	foreach((get_the_category()) as $category) {
		$catNoUrl = $category->cat_name . ' ';
		$catSlug = $category->slug;
	}
	include("js/Mobile_Detect.php");
	setup_postdata($post);
	?>
        

<section class="big_head" style="background-image:url(

<?php 	if (has_post_thumbnail( $post->ID ) ) { 
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
		echo $image[0].')';  
	} else {
		echo 'http://www.placehold.it/1000x380&text=-); filter: url(';
		echo bloginfo('template_url').'/img/filters.svg#grayscale); filter: gray; -webkit-filter: grayscale(1);';
	} ?>;">
	<div class="contain">
                <p class="breadcrumbs"><a href="<?php echo home_url(); ?>/blog">#WANZblog</a></p>
                <h1><?php the_title(); ?></h1>
                <?php the_tags('<ul class="tags"><li>','</li><li>','</li></ul>'); ?>
        </div>
</section>


<section class="blogpost_content">
	<div class="contain">
        	<div class="meta gray">
                <p>Posted on <?php the_time('F j Y'); ?> by <strong><?php if(get_field('auth-name')) { the_field('auth-name'); } else { the_author(); }?></strong>. <br />
                <?php // get discuss coments<span class="icon">b</span> 13 Comentarios.  ?>Share  
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="icon" title="Share on Facebook" target="_blank">F</a>
                <a href="https://twitter.com/home?status=<?php the_permalink(); ?>" class="icon" title="Share on Twitter" target="_blank">T</a>.</p>
                </div>
                <?php // if gets discuss comments make this  <div class="share right"></div> ?>
                <div class="article">
			<?php the_content(); ?>
                </div>
	<?php 	if(get_field('auth-name')):?>
                <div class="author">
                	<?php if(get_field('auth-img')):?>
                                <img class="left circle" src="<?php the_field('auth-img'); ?>" width="120" height="120" />
                	<?php endif; ?>
			<h2><?php the_field('auth-name'); ?></h2>
                	<?php if(get_field('auth-twitter')):?>
                        	<a href="http://www.twitter.com/<?php the_field('auth-twitter'); ?>" title="<?php the_field('auth-twitter'); ?>" target="_blank">@<?php the_field('auth-twitter'); ?></a>
			<?php endif; ?>
                	<?php if(get_field('auth-bio')):?>
                	<p class="gray"><?php the_field('auth-bio'); ?></p>
			<?php endif; ?>
                </div>
	<?php 	endif; ?>
        </div>
</section>


<section class="blogpost_comments">
	<div class="contain">
                <div class="comments col65 left">
                        <div id="disqus_thread"></div>         	
                        <script type="text/javascript">
                                /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                                var disqus_shortname = 'wearenotzombies'; // Required - Replace example with your forum shortname
                                
                                /* * * DON'T EDIT BELOW THIS LINE * * */
                                (function() {
                                        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                                        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                                })();
                        </script>
                        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                </div>
                <div class="goods_and_ads col35 right">
        <?php   $ad_query = new WP_Query('pagename=publicidad'); 
                while ( $ad_query->have_posts() ) : 
                $ad_query->the_post(); ?>

        <?php   $rows = get_field('publicidad' ); // get all the rows
                $rand_row = $rows[ array_rand( $rows ) ]; // get the first row          ?>

                    <a href="http://<?php echo $rand_row['link']; ?>" title="<?php echo $rand_row['name']; ?>" target="_blank">
                        <img src="<?php echo $rand_row['banner_large']; ?>" width="590" height="220" />
                    </a>

        <?php   endwhile;
                wp_reset_postdata(); ?>
                </div>
        </div>
</section>


<section class="sigue_leyendo">
	<div class="contain">
        	<ul>
                	<li></li>
                </ul>
        </div>
</section>
        
<?php get_footer(); ?>