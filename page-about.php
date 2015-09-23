<?php get_header(); ?>
        
<section id="about_welcome" class="dark about">
    <div class="contain">
        <p class="breadcrumb">wearenotzombies.com</p>
    <?php   $healthy = array("<red>", "</red>");
            $yummy   = array("<span class='red'>", "</span>");
            
            $esQuote  = get_field('es_quote');
            $newesQuote = str_replace($healthy, $yummy, $esQuote);

            $enQuote  = get_field('en_quote');
            $newenQuote = str_replace($healthy, $yummy, $enQuote);

            $esDesc  = get_field('es_description');
            $newesDesc = str_replace($healthy, $yummy, $esDesc);

            $enDesc  = get_field('en_description');
            $newenDesc = str_replace($healthy, $yummy, $enDesc);
                
            if( get_field('en_quote')){ 
                echo '<h1 class="half left">';
                echo $newesQuote;
                echo '</h1><h1 class="half left">';
                echo $newenQuote;
                echo '</h1>'; 
            } else { 
                echo '<h1>';
                echo $newesQuote;
                echo '</h1>';
            } ?>
        <p class="half left">
                <?php echo $newesDesc; ?>
        </p>
        <p class="half left">
                <?php echo $newenDesc; ?>
        </p>

        <ul class="share_holder">
            <h2>Follow us:</h2>
            <li>
                <a href="https://www.youtube.com/user/WeAreNotZombiestv" title="Subscribe to our youtube channel" target="_blank">
                    <img src="<?php bloginfo('template_url'); ?>/img/i-yt.svg" width="42" height="42">
                    <small><?php echo get_scp_youtube(); ?></small>
                </a>
            </li>
            <li>
                <a href="https://www.facebook.com/wearenotzombiestv" title="Like us on Facebook" target="_blank">
                    <img src="<?php bloginfo('template_url'); ?>/img/i-fb.svg" width="42" height="42">
                    <small><?php echo get_scp_facebook(); ?></small>
                </a>
            </li>
            <li>
                <a href="https://twitter.com/wanztv" title="Follow us on Twitter" target="_blank">
                    <img src="<?php bloginfo('template_url'); ?>/img/i-tw.svg" width="42" height="42">
                    <small><?php echo get_scp_twitter(); ?></small>
                </a>
                </li>
            <li>
                <a href="https://plus.google.com/+WearenotzombiesTv/" title="+WeAreNotZombies" target="_blank">
                    <img src="<?php bloginfo('template_url'); ?>/img/i-gp.svg" width="42" height="42">
                    <small><?php echo get_scp_googleplus(); ?></small>
                </a>
            </li>
            <li>
                <a href="http://instagram.com/wanztv" title="Follow us on Instagram" target="_blank">
                    <img src="<?php bloginfo('template_url'); ?>/img/i-in.svg" width="42" height="42">
                    <small><?php echo get_scp_instagram(); ?></small>
                </a>
            </li>
        </ul>
    </div>
</section>



<section id="about_activism" class="about contain_ctr">
    <h2>Activism</h2>
    <div class="description gray left">
        <p><?php the_field('activism_desc'); ?></p>
    </div>
    <?php   if( have_rows('activism') ): ?>
    <div class="contain_scroll">
                <ul class="overview">
                    <?php   while ( have_rows('activism') ) : the_row(); ?>
                    
                        <li class=" left"><a href="<?php the_sub_field('link'); ?>" title="<?php the_sub_field('name'); ?>" target="_blank">
                            <div class="thumb" style="background-image:url('<?php 
                                if( get_sub_field('img') ) {
                                        the_sub_field('img');
                                } else {
                                        echo 'http://placehold.it/360x200&text=Missing';
                                } ?>');"></div>
                            <h3><?php the_sub_field('name'); ?></h3>
                            <?php   if( get_sub_field('caption')) : 
                                        echo '<span class="gray">';
                                        the_sub_field('caption');
                                        echo '</span>';  
                                    endif; ?>
                        </a></li>
            
                    <?php   endwhile; ?>
                </ul>
                
<?php /*
        <div class="scrollable">
            <div class="scrollbar"><div class="track"><div class="thumb no_inst"><hr><hr></div></div></div>
            <div class="hold_act viewport">
            </div>
        </div>
*/ ?>

    </div>
    <?php   endif; ?>
</section>



	<?php 	if( have_rows('friends') ): ?>
<section id="about_friends" class="about">
	<div class="contain">
        	<h2>Friends</h2>
                <div class="list_contain">
                        <ul>
	<?php	while ( have_rows('friends') ) : the_row(); ?>
                        <li class=" left"><a href="<?php the_sub_field('link'); ?>" title="<?php the_sub_field('name'); ?>" target="_blank">
                                <img class="circle" src="<?php 
					if( get_sub_field('img') ) {
						the_sub_field('img');
					} else {
						echo 'http://placehold.it/180x180&text=Missing';
					} ?>" width="90" height="90" />
                                <h3><?php the_sub_field('name'); ?></h3>
                        <?php 	if( get_sub_field('caption')) : 
					echo '<span class="gray">';
					the_sub_field('caption');
					echo '</span>';  
				endif; ?>
                        </a></li>
	<?php	endwhile; ?>
                        </ul>
                </div>
        </div>
</section>
	<?php 	endif; ?>




<?php   if( have_rows('goodies') ): ?>
<section id="about_goodies" class="about">
    <div class="contain">
        <h2>Goods</h2>
        <ul>
    <?php   while ( have_rows('goodies') ) : the_row(); ?>
            <li class=" left openModal">
                
                <div class="good_info">
                    <div class="good_img" style="background-image:url('<?php   
                        $go1_image = wp_get_attachment_image_src( get_sub_field('img'), "medium" );
                        if( $go1_image ) { 
                                echo $go1_image[0]; 
                        } else { 
                                echo 'http://placehold.it/360x200&text=Missing';
                        } ?>');"></div>
                    <h2><?php the_sub_field('name'); ?></h2>
                    <p><?php the_sub_field('more_info'); ?></p>
                    <?php //if link or file ?>
                    <?php if( get_sub_field('link') ){ ?>
                        <a href="<?php the_sub_field('link'); ?>" title="<?php the_sub_field('caption'); ?>" class="dl_bttn animate round" target="_blank">Go there</a>
                    <?php } else { ?> 
                        <a href="<?php the_sub_field('file'); ?>" title="<?php the_sub_field('caption'); ?>" class="dl_bttn animate round" target="_blank">Download</a>
                    <?php }?>
                </div>
                
                <div class="thumb" style="background-image:url('<?php   
                    $go_image = wp_get_attachment_image_src( get_sub_field('img'), "large" );
                    if( $go_image ) { 
                            echo $go_image[0]; 
                    } else { 
                            echo 'http://placehold.it/360x200&text=Missing';
                    } ?>');"></div>
                <h3><?php the_sub_field('name'); ?></h3>
                <?php   if( get_sub_field('caption')) : 
                            echo '<span class="gray">';
                            the_sub_field('caption');
                            echo '</span>';  
                        endif; ?>
            </li>
        <?php   endwhile; ?>
        </ul>
    </div>
</section>
        <?php   endif; ?>

        
      

<section id="about_contact">
	<div class="contain tabs">
        	<!--h2>Contact Us</h2-->
                <div class="tab">
                        <input type="radio" id="tab-1" name="tab-group-1" checked>
                        <label for="tab-1">DENUNCIA<span> / ALERT </span></label>
                        
                        <div class="content">
                                <div class="description">
                                        <p><?php the_field('denuncia_text'); ?></p>
                                </div>
                                <?php echo do_shortcode('[contact-form-7 id="1114" title="Denuncia"]'); ?>
                        </div> 
                </div>
            
                <div class="tab">
                        <input type="radio" id="tab-2" name="tab-group-1">
                        <label for="tab-2">ANÚNCIATE<span> / ADVERTISE </span></label>
                       
                        <div class="content">
                                <div class="description">
                                        <p><?php the_field('anuncia_text'); ?></p>
                                </div>
                                <?php echo do_shortcode('[contact-form-7 id="1115" title="Anunciate"]'); ?>
                        </div> 
                </div>
            
                <div class="tab">
                        <input type="radio" id="tab-3" name="tab-group-1">
                        <label for="tab-3">COLABORA<span> / CONTRIBUTE </span></label>
                        
                        <div class="content">
                                <div class="description">
                                        <p><?php the_field('colabora_text'); ?></p>
                                </div>
                                <?php echo do_shortcode('[contact-form-7 id="1116" title="Colabora"]'); ?>
                        </div> 
                </div>
        </div><?php // contain	 ?>
</section>
        
<?php get_footer(); ?>