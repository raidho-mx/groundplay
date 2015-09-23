<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1; user-scalable=0;">
	<title><?php
	global $page, $paged;
	wp_title( ':', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo ": $site_description";
	if ( $paged >= 2 || $page >= 2 )
		echo ': ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
	?></title>
        
        
<!-- CSS -->
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/mediaelementplayer.css" type="text/css">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css">
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/query.css" type="text/css">
     

<!-- PHP -->
<?php   
    foreach((get_the_category()) as $category) {
        $catNoUrl = $category->cat_name . ' ';
        $catSlug = $category->slug;
    } ?>


<!-- JAVA -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/jquery.tinyscrollbar.min.js" type="text/javascript"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/jquery.fitvids.js" type="text/javascript"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/clamp.min.js" type="text/javascript"></script>
    <script src="<?php Bloginfo('template_url'); ?>/js/mediaelement-and-player.min.js" type="text/javascript"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/mep-feature-sourcechooser.js" type="text/javascript"></script>
    <script>
		jQuery(document).ready(function($) {

//	HEADER: Mobile Menu
            $('a.med_m_btn').click(function() { $('header').toggleClass('med_show'); });

//  TOP HOLDER: Width of Show view
            $('#tp_hld.shows ul').width($("#tp_hld.shows .ep_hld").length * $("#tp_hld.shows .ep_hld").width());
            $('#mas_shows .hold_eps ul').width($("#mas_shows .hold_eps ul li").length * $("#mas_shows .hold_eps ul li").width());

//  Toggle .tp_hld
            $('header .shcl_btn a').click(function() { 
                $('body').toggleClass('tp_hld_close tp_hld_open'); 
                $('#instructions').delay(3000).queue(function(next){  $(this).addClass('caput'); next();  });
            });

// ScrollBar Functions
            $("#tp_hld.shows").tinyscrollbar({ axis: "x", scrollInvert: false });
            $("#mas_shows .scrollable, #mas_episodios .scrollable, #about_activism .scrollable").tinyscrollbar({ axis: "x", scrollInvert: false, wheelLock: false });

//  AJAX: Call to Categories
            jQuery('a.jx_fn').live('click', function(e){
                e.preventDefault();
                var link = jQuery(this).attr('href');
                jQuery('#tp_hld').html('<div class="loading_hld"> <div class="loading"> <h1>LOADING</h1> </div> </div>');
                jQuery('#tp_hld').load(link+' #tp_jx_trgt');
                jQuery('#tp_hld').ajaxComplete(function() {
                    $('#tp_hld.episodes a#back_btn').click(function() { 
                        $('#tp_hld').removeClass('episodes'); 
                        $('#tp_hld').addClass('shows'); 
                        window.scrollTo(0, 0);
                    });
                    $('a#cl_btn').click(function() { 
                        $('body').toggleClass('tp_hld_close tp_hld_open'); 
                        $('#instructions').delay(3000).queue(function(next){  $(this).addClass('caput'); next();  });
                    });
                    $(document).scroll(function() {
                        var top = $(document).scrollTop();
                        console.log(top);
                        if (top < $( 'ul.overview' ).height()+60) $('.tp_sh_hdr').removeClass('unfix');
                        if (top > $( 'ul.overview' ).height()+60) $('.tp_sh_hdr').addClass('unfix');
                    });
                    $('ul li.ep_hld:lt(6)').show();
                    var items =  $('ul li.ep_hld').size();
                    var shown =  6;
                    if(shown> items){$('#loadMore').hide();}
                    $('#loadMore').click(function () {
                        shown = $('ul li.ep_hld:visible').size()+6;
                        if(shown< items) {
                            $('ul li.ep_hld:lt('+shown+')').show();
                        } else {
                            $('ul li.ep_hld:lt('+items+')').show();
                            $('#loadMore').hide();
                        }
                    });
                    $('.clmp_3').each(function(index, element) {
                        $clamp(element, { clamp: 3, useNativeClamp: false });
                    });

                });
            });

//  AJAX: Call to Shows
            jQuery('a#back_btn').live('click', function(e){
                e.preventDefault();
                var link = jQuery(this).attr('href');
                jQuery('#tp_hld').html('<div class="loading_hld"> <div class="loading"> <h1>LOADING</h1> </div> </div>');
                jQuery('#tp_hld').load(link+' #tp_jx_trgt');
                jQuery('#tp_hld').ajaxComplete(function() {
                    
                    $('#tp_hld.shows ul').width($("#tp_hld.shows .ep_hld").length * $("#tp_hld.shows .ep_hld").width());

                    $(".scrollable").tinyscrollbar({ axis: "x", scrollInvert: false });

                    $('.clmp_3').each(function(index, element) {
                        $clamp(element, { clamp: 3, useNativeClamp: false });
                    });

                });
            });

//  AJAX: First Call to shows 
            jQuery('#shows_button').live('click', function(e){
                e.preventDefault();
                var link = jQuery('a#shows_button').attr('href');
                jQuery('#tp_hld').html('<div class="loading_hld"> <div class="loading"> <h1>LOADING</h1> </div> </div>');
                jQuery('#tp_hld').load(link+' #tp_jx_trgt');
                jQuery('#tp_hld').ajaxComplete(function() {
                    $('#tp_hld').toggleClass('shows episodes');
                    $('#instructions').delay(3000).queue(function(next){  $(this).addClass('caput'); next();  });

                    $('#tp_hld.shows ul').width($("#tp_hld.shows .ep_hld").length * $("#tp_hld.shows .ep_hld").width());
                    $(".scrollable").tinyscrollbar({ axis: "x", scrollInvert: false });

                    $('#shows_button').removeAttr('id href');

                });
            });

		});// jQuery Closes

	</script>
        
	<?php wp_head(); ?>

<!-- META: Work in progress -->
    <meta name="keywords" content="web tv, television en linea, video, cine, teatro, cultura, cocina, recetas, arte, fashion, diseñadores de moda, mexicanos exitosos, mujeres chingonas, famosos, musica del mundo, zombie, television, radio, libertad de expresion, cool, vida, politica, libre pensamiento, resistencia, control mediatico, nuevas ideas">
   
<?php //  Google Analytics

/*  <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        
          ga('create', 'UA-49641013-1', 'wearenotzombies.tv');
          ga('require', 'displayfeatures');
          ga('send', 'pageview');
    </script> */    ?>
        
        
<?php //  Facebook Opengraph Meta

/*      <meta property="og:title" content="WeAreNotZombies">
        <meta property="og:description" content="Turn off the TV. Turn on to the World.">
        <meta property="og:type" content="website">        
	<?php if ( is_home() ) { ?>
                <meta property="og:url" content="<?php echo home_url(); ?>">
                <meta property="og:image" content="http://www.wearenotzombies.tv/facebook_like_wanz_logo.jpg">
        <?php } else /* cambiar is_home por is_single * / { ?>
                <meta property="og:url" content="<?php the_permalink(); ?>">
                <meta property="og:image" content="<?php the_field('poster_video');?>">
        <?php }  
*/	?>



</head>
<body <?php body_class('tp_hld_close'); ?>>

<?php $category = get_the_category(); ?>

<div id="tp_hld" class="episodes">
    <div class="scrollbar"><div class="track"><div class="thumb"><hr><hr></div></div></div>
	<div id="tp_jx_trgt">
            <div class="tp_sh_hdr">
                <a id="back_btn" href="<?php bloginfo('url'); ?>" class="jx_fn icon">&lt;</a>
                <div class="bc_title">
                    <p class="smoke">Show:</p>
                    <h1 class="white"><?php single_cat_title(''); ?></h1>
                </div>
                <a id="cl_btn" href="#" class="icon">&times;</a>
            </div>
    		<ul class="overview">

<?php 	$menu_query = new WP_query('posts_per_page=100&category_name='.$category[0]->slug); 
		while ( $menu_query->have_posts() ) : $menu_query->the_post(); ?>

    		<li class="ep_hld">
                <a href="<?php the_permalink(); ?>" title="<?php echo $category->name; ?>" class="href_cover"></a>
    			<a class="img gr2clr" style="background-image:url(<?php       	
					$ep_image = wp_get_attachment_image_src( get_field('poster_video'), "large" );
				 	if( $ep_image ) { 
						echo $ep_image[0]; 
					} else { 
						echo bloginfo('template_url').'/img/video_fallback.jpg';
					} ?>);"></a>
                <div class="ep_cnt">
        			<small>
                        <strong><?php 	if( get_field('episode') ): 
							echo 'Ep. ';
							the_field('episode');
							echo ' / ';
							endif; ?></strong> <?php the_time('M Y'); ?>
                    </small>
        			<h1 class="clmp_3 <?php 
        				$str = get_the_title();  $lenght = strlen($str);
        				if($lenght >= 55) { echo 't_20'; }
        				elseif($lenght >= 40) { echo 't_24'; }
        				else { echo 't_32'; }
        			?>"><?php the_title(); ?></h1>
                </div>
    		</li>

<?php 	endwhile;  ?>
            <a id="loadMore" class="t_32 white fanimate">SHOW MORE</a>
		</ul>
	</div>
</div>



    <header>
        <a class="logo_a" href="<?php echo home_url(); ?>"><img id="menu_logo" class="left" src="<?php bloginfo('template_url'); ?>/img/logo.svg" height="40" /></a>
        <nav>
            <ul class="left">
                <li>
                    <a href="<?php echo home_url(); ?>/about"><span class="sm_hide">WANZ</span> World</a>
                </li>
                <li class="shcl_btn">
                        <a href="<?php echo home_url(); ?>" id="shows_button" class="op">Shows</a>
                        <a class="cl">&times;</a>
                </li>
                <li>
                        <a href="<?php echo home_url(); ?>/blog">Blog</a>
                </li>
                <?php if(get_field('sh_merch', 'options')) { ?>
                <li class="med_hide">
                    <a href="http://<?php the_field('merch_link', 'options'); ?>">Merch</a>
                </li>
                <?php } 
                if (get_field('sh_live', 'options')) {?>
                <li class="live">
                    <a href="<?php echo home_url('/live'); ?>">LIVE!</a>
                </li> 
                <?php } ?> 
            </ul>
        </nav>
            
        <a class="med_m_btn">    <hr><hr><hr>    </a>
                                        
        <ul class="right animate">
            <li class="search animate" style="background-image:url('<?php bloginfo('template_url'); ?>/img/i-search.svg');">
                <?php get_search_form(); ?>
            </li>
            <li class="newsletter animate" style="background-image:url('<?php bloginfo('template_url'); ?>/img/i-news.svg');">
                <form action="http://wearenotzombies.us7.list-manage1.com/subscribe/post?u=25113ef9c22a647acf0f9238b&amp;id=c53794813e" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                    <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" title="Correo / Email" placeholder="Correo / Email" />
                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;"><input type="text" name="b_25113ef9c22a647acf0f9238b_c53794813e" tabindex="-1" value=""></div>
                    <input type="submit" value="Send" name="Suscribirme" id="mc-embedded-subscribe" class="form_button button" />
                </form>
            </li>
            <li class="share animate" style="background-image:url('<?php bloginfo('template_url'); ?>/img/i-share.svg');">
                <ul>
                    <li>
                        <a href="https://www.youtube.com/user/WeAreNotZombiestv" title="Subscribe to our youtube channel" target="_blank">
                            <img src="<?php bloginfo('template_url'); ?>/img/i-yt.svg" width="21" height="21">
                            <small><?php echo get_scp_youtube(); ?></small>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/wearenotzombiestv" title="Like us on Facebook" target="_blank">
                            <img src="<?php bloginfo('template_url'); ?>/img/i-fb.svg" width="21" height="21">
                            <small><?php echo get_scp_facebook(); ?></small>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/wanztv" title="Follow us on Twitter" target="_blank">
                            <img src="<?php bloginfo('template_url'); ?>/img/i-tw.svg" width="21" height="21">
                            <small><?php echo get_scp_twitter(); ?></small>
                        </a>
                        </li>
                    <li>
                        <a href="https://plus.google.com/+WearenotzombiesTv/" title="+WeAreNotZombies" target="_blank">
                            <img src="<?php bloginfo('template_url'); ?>/img/i-gp.svg" width="21" height="21">
                            <small><?php echo get_scp_googleplus(); ?></small>
                        </a>
                    </li>
                    <li>
                        <a href="http://instagram.com/wanztv" title="Follow us on Instagram" target="_blank">
                            <img src="<?php bloginfo('template_url'); ?>/img/i-in.svg" width="21" height="21">
                            <small><?php echo get_scp_instagram(); ?></small>
                        </a>
                    </li>
                </ul>      
            </li>
        </ul>
    </header>
</div>

<?php // General AJAX Purpose ?>
<div id="main-content"> 
    <div id="inside">
        
        <h1 class="hide"><?php  echo $category[0]->cat_name; ?></h1>        

        <section class="big_head" style="background-image:url(<?php 

    $bgimg_query = new WP_Query('posts_per_page=1&orderby=rand&category_name='.$category[0]->category_nicename);
    while ( $bgimg_query->have_posts() ) : $bgimg_query->the_post();
        $ep_image = wp_get_attachment_image_src( get_field('poster_video'), "full" );
        
        if( $ep_image ) { 
            echo $ep_image[0]; 
        } else { 
            echo bloginfo('template_url').'/img/video_fallback.jpg';
        }
    endwhile; 
    wp_reset_postdata();
    
    ?>);">
            <div class="contain">
                <img class="show_logo" src="<?php echo get_field('logo', 'category_'.$category[0]->term_id); ?>" width="380" height="380"><br />
                <a class="facebook animate round" href="https://www.facebook.com/sharer/sharer.php?u=<?php  echo get_category_link( $category[0]->cat_ID );  ?>" title="Compartir en Facebook">Share on Facebook</a>
                <a class="twitter animate round" href="https://www.facebook.com/sharer/sharer.php?u=<?php  echo get_category_link( $category[0]->cat_ID );  ?>" title="Compartir en Twitter">Share on Twitter</a>
            </div>
        </section>
    
        <section id="about_show">
            <div class="contain of_a">
                <div class="ab_sh_head of_a gray">
                    <div class="col65 left">
                        <h1 class="big_title"><?php echo $category[0]->cat_name; ?></h1>
                    </div>
                    <div class="col35 right">
                        <?php  echo $category[0]->count; ?> Episode<?php if($category[0]->count > 1){ echo 's'; } else {}?></strong> <br>
                        1 Season <?php 
                    
                        $tags_query = new WP_Query('posts_per_page=2&orderby=rand&category_name='.$category[0]->category_nicename);
                        if ( $tags_query->have_posts() ) : 
                            echo '<br>Tags: ';
                            while ( $tags_query->have_posts() ) : $tags_query->the_post();
                        
                            the_tags('',', ',', ');
                        endwhile; endif;
                        wp_reset_postdata();                    
                    
                    ?> <br>
                    </div>
                </div>
                <div class="col65 of_a left gray">
                    <div class="half left about">
                        <h2>About this show</h2>
                        <p><?php echo $category[0]->description; ?></p>
                        <p class="smoke"><?php echo get_field('en_description', 'category_'.$category[0]->term_id); ?></p>
                    </div>
                    <div class="half left recent">
                        <h2>Latest</h2>
                        <?php $latest_ep = new WP_Query('posts_per_page=1&category_name='.$category[0]->category_nicename);
                    while ( $latest_ep->have_posts() ) : $latest_ep->the_post(); ?>
                        <div class="latest_ep">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="ep_sel">
                                <div class="img_thumb gray_to_color" style="background-image:url(<?php
                                    //290 x 165
                                    $ep_image = wp_get_attachment_image_src( get_field('poster_video'), "medium" );
                                    if( $ep_image ) { 
                                            echo $ep_image[0]; 
                                    } else { 
                                            echo bloginfo('template_url').'/img/video_fallback.jpg';
                                    } ?>);">

                                    <?php if( get_field('just_baked')) { echo '<span class="white new_tag">¡Just Baked!</span>';} else {}?>
                                </div>
                                <div>
                                <span class="smoke">
                                    <strong><?php if( get_field('episode') ): echo 'Ep '.get_field('episode').'.'; endif; ?></strong> / <?php the_time('M Y'); ?>
                                </span>
                                <h3 class="gray"><?php the_title(); ?></h3>
                                </div>
                            </a>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                        


<?php /* FEATURING: Count the posts 

                        <div class="col35 right">
                                <?php   $latest_ep = new WP_Query('posts_per_page=-1&orderby=rand&category_name='.the_excluded_category_slug(array(23)));                   
                    while ( $latest_ep->have_posts() ) : $latest_ep->the_post(); 
                    
                        while ( have_rows('featuring') ) : the_row(); 
                                 echo the_sub_field('name').'<br>'; 
                            endwhile;
                    endwhile;   ?>
                        </div>

*/ ?>

        <?php   $latest_ep = new WP_Query('posts_per_page=-1&orderby=rand&category_name='.$category[0]->category_nicename);
                if ($latest_ep->have_posts() ) : ?>
                <div class="col35 right">
                    <ul class="featuring mugs mod">
                        <h2>Featuring</h2>
                                        
                        <script>
                            jQuery(document).ready(function($) {
                                $('.category ul.featuring li').hide();
                                $('.category ul.featuring li:lt(4)').show();
                            });
                        </script>

                                        
                <?php   while ( $latest_ep->have_posts() ) : $latest_ep->the_post();  
                            if( have_rows('featuring') ): 
                                while ( have_rows('featuring') ) : the_row(); ?>
                        <li class="left"><a href="<?php the_sub_field('link'); ?>" title="<?php the_sub_field('name'); ?>" target="_blank">
                            <img class="circle" src="<?php 
                                $ft_image = wp_get_attachment_image_src( get_sub_field('foto'), "thumbnail" );
                                if( $ft_image ) { 
                                    echo $ft_image[0]; 
                                } else { 
                                    echo bloginfo('template_url').'/img/video_fallback.jpg';
                                } ?>"   width="90" height="90" />
                            <h3 class="gray"><?php the_sub_field('name'); ?></h3>
                            <span class="smoke"><?php the_sub_field('slug'); ?></span>
                        </a></li>
                <?php           endwhile; 
                            endif;
                        endwhile; ?>
                    </ul>
                </div>
        <?php   endif;?>
            </div>
        </section>

 
        <section id="episodes_list" class="of_a">
            <div class="contain">
                <ul class="col65 shows_list left">
                    <h2 class="gray jr">All of <strong><?php echo $category[0]->cat_name; ?></strong> </h2>
                
            <?php   while ( have_posts() ) : the_post(); ?>
                        
                    <li class="result episodes">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="ep_sel">
                            <div class="img_thumb gray_to_color" style="background-image:url(<?php
                                    
                                $ep_image = wp_get_attachment_image_src( get_field('poster_video'), "large" );
                                if( $ep_image ) { 
                                        echo $ep_image[0]; 
                                } else { 
                                        echo bloginfo('template_url').'/img/video_fallback.jpg';
                                } ?>);">

                                <?php if( get_field('just_baked')) { echo '<span class="white new_tag">¡Just Baked!</span>';} ?>
                            </div>
                            <span class="link smoke">
                                    <strong><?php if( get_field('episode') ): echo 'Ep '.get_field('episode').'.'; endif; ?></strong> / <?php the_time('M Y'); ?>
                            </span><br />
                            <h2 class="gray"><?php the_title(); ?></h2>
                        </a>
                    </li>
                
            <?php   endwhile; ?>

                    <div class="pagination">
            <?php       global $ep_list;
                        $big = 999999999; // need an unlikely integer
                        $translated = __( '', 'mytextdomain' ); // Supply translatable string
                        
                        echo paginate_links( array(
                            'prev_text'    => __('« Prev'),
                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format' => '?paged=%#%',
                            'current' => max( 1, get_query_var('paged') ),
                            'total' => $wp_query->max_num_pages,
                            'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
                        ) ); ?> 
                    </div>

                </ul>
                <div class="col35 comments right">
                    <img src="<?php bloginfo('template_url'); ?>/img/publ_fallback.jpg" width="380" />
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
            </div>
        </section>
        
    <?php  
        // Change 1 to 23 while testing
    
    /*
        $args = array( 'hide_empty' => '1' );
        $categories = get_categories($args);
        if($categories): ?>
        <section id="mas_shows" class="prox_slide rctngl_slide">
            <div class="contain">
                <h1>Todos los <a href="#">Shows</a></h1>
                <a class="scbtn sh_lbtn icon animate"> < </a>
                <a class="scbtn sh_rbtn icon animate"> > </a>
                <div class="hold_eps">
                    <ul>
            <?php   foreach($categories as $category) {
                        $image = get_field('fondo', 'category_'.$category->term_id); 
                        $category_link = get_category_link($category->cat_ID); ?>
    
                        <li><a href="<?php echo $category_link; ?>">
                                <div class="img_thumb gray_to_color" style="background-image:url(<?php echo $image; ?>);"></div>
                                <h2><?php echo $category->name; ?></h2>
                        </a></li>
    
            <?php   } ?> 
                    </ul>
                </div>
            </div>
        </section>
<?php   endif; */ ?>

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

<?php get_footer(); ?>	