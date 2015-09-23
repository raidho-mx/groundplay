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
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/deprecate.css" type="text/css">

        
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
	<script src="<?php bloginfo('template_url'); ?>/js/mediaelement-and-player.min.js" type="text/javascript"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/mep-feature-sourcechooser.js" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function($) {

            $("section#video").fitVids();

            $('.openModal').click(
                function() {
                    $('.dumbBoxWrap').fadeIn();
                    $('.contain_good_info').html($(this).find('.good_info').html());
                }
            );

            $('#intro.dumbBoxWrap').fadeIn();

            $('.closeModal, .dumbBoxOverlay, .vertical-offset').click(function() {
                $('.dumbBoxWrap').fadeOut("fast");
            });

//  HEADER: Mobile Menu
            $('a.med_m_btn').click(function() { $('header').toggleClass('med_show'); });
            $('.top_ad a.close').click(function() { $('.top_ad').toggleClass('closed'); });

//  TOP HOLDER: Width of Show view
            // $('#tp_hld.shows ul').width($("#tp_hld.shows .ep_hld").length * $("#tp_hld.shows .ep_hld").width());
            $('#mas_episodios .hold_eps ul').width($("#mas_episodios .hold_eps ul li").length * $("#mas_episodios .hold_eps ul li").width());
            $('#mas_shows .hold_eps ul').width($("#mas_shows .hold_eps ul li").length * $("#mas_shows .hold_eps ul li").width());
            $('.hold_act ul').width($(".hold_act ul li").length * $(".hold_act ul li").width());

//  Toggle .tp_hld                 
            $('header .shcl_btn a').click(function() { 
                $('body').toggleClass('tp_hld_close tp_hld_open'); 
                $('#instructions').delay(3000).queue(function(next){  $(this).addClass('caput'); next();  });
            });
            $('#tp_hld.shows a.jx_fn').click(function() { $('#tp_hld').toggleClass('shows episodes'); });

// ScrollBar Functions
            $("#tp_hld .scrollable").tinyscrollbar({ axis: "x", scrollInvert: false });
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

                    $('#tp_hld.shows a.jx_fn').click(function() { $('#tp_hld').addClass('episodes'); $('#tp_hld').removeClass('shows'); });
                    
                    // $('#tp_hld.shows ul').width($("#tp_hld.shows .ep_hld").length * $("#tp_hld.shows .ep_hld").width());

                    $(".scrollable").tinyscrollbar({ axis: "x", scrollInvert: false });

                    $('.clmp_3').each(function(index, element) {
                        $clamp(element, { clamp: 3, useNativeClamp: false });
                    });

                });
            });


            $('.clmp_2').each(function(index, element) {
                $clamp(element, { clamp: 3, useNativeClamp: false });
            });


        });

    </script>

	<?php wp_head(); ?>
        
<!-- META: Work in progress -->
    <meta name="keywords" content="web tv, television en linea, video, cine, teatro, cultura, cocina, recetas, arte, fashion, diseñadores de moda, mexicanos exitosos, mujeres chingonas, famosos, musica del mundo, zombie, television, radio, libertad de expresion, cool, vida, politica, libre pensamiento, resistencia, control mediatico, nuevas ideas">

    <meta property="og:title" content="WeAreNotZombies">
    <meta property="og:description" content="Turn off the TV. Turn on to the World.">
    <meta property="og:type" content="website">        
	<?php if ( is_home() ) { ?>
	    <meta property="og:url" content="<?php echo home_url(); ?>">
	    <meta property="og:image" content="http://www.wearenotzombies.tv/facebook_like_wanz_logo.jpg">
    <?php } else /* cambiar is_home por is_single */ { ?>
	    <meta property="og:url" content="<?php the_permalink(); ?>">
	    <meta property="og:image" content="<?php 
			$ft_image = wp_get_attachment_image_src( get_field('poster_video'), "large" );
            if( $ft_image ) { 
                    echo $ft_image[0]; 
            } else { 
                    echo bloginfo('template_url').'/img/video_fallback.jpg';
            } ?>">
    <?php }  ?>

	<script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-49641013-1', 'wearenotzombies');
        ga('require', 'linkid', 'linkid.js');
		ga('require', 'displayfeatures');
        ga('send', 'pageview');
    </script>

</head>

<body <?php body_class('tp_hld_close'); ?>>
    <?php if ( is_page( 'about' ) ) { ?>
        <div class="dumbBoxWrap"> 
            <div class="dumbBoxOverlay">
                &nbsp;
            </div>     

            <div class="vertical-offset"> 
                <div class="dumbBox"> 
                    <a class="closeModal animate">×</a>
                    <div class="contain_good_info of_a"></div>
                </div>
            </div>
        </div> 
<?php }  elseif ( is_home() ) { 
            if(get_field('intro_ad_video', 'options') == 'Desactivar') : else : 
                echo get_template_part('inc/intro');
            endif;
        }  ?>

<?php $category = get_the_category(); ?>


    <div id="tp_hld" class="shows">
        <div id="tp_jx_trgt">
            <?php /*
            <div class="scrollable">
                <div class="scrollbar"><div class="track"><div class="thumb"><div id="instructions"><h1>SCROLL<br>↓</h1></div><hr><hr></div></div></div>
                <div class="viewport">
*/                  $args = array( 'hide_empty' => '1' );
                    $categories = get_categories($args);
                    if($categories){ ?>
                <ul class="overview">
            <?php   foreach($categories as $category) {
                    $head_image = get_field('fondo', 'category_'.$category->term_id);
                    $head_logo = get_field('logo', 'category_'.$category->term_id);
                    $head_endesc = get_field('en_description', 'category_'.$category->term_id);
                    $head_launched = get_field('launched', 'category_'.$category->term_id);
                    $head_category_link = get_category_link($category->cat_ID); ?>

                <li class="ep_hld">
                    <a href="<?php echo $head_category_link; ?>" title="<?php echo $category->name; ?>" class="href_cover jx_fn"></a>
                        <div class="img gr2clr" style="background-image:url(<?php echo $head_image; ?>);">
                            <img class="logo" src="<?php echo $head_logo; ?>" width="220" width="220" />
                        </div>
                        <div class="sh_cnt animate">
                            <small>
                                <strong><?php echo $category->count; ?> Episode<?php if($category->count > 1){ echo 's'; } else {}?></strong>
                                Since <?php $date = DateTime::createFromFormat('Ymd', $head_launched);  echo $date->format('F Y');  ?>.
                            </small>
                            <h1 class="t_32"><?php echo $category->name; ?></h1>
                            <p class="desc">
                                <?php $string = (strlen($category->description) > 60) ? substr($category->description,0,60).'...' : $category->description;
                                echo $string; ?><br>
                                <span><?php $string = (strlen($head_endesc) > 65) ? substr($head_endesc,0,65).'...' : $head_endesc;
                                echo $string; ?></span>
                            </p>
                        </div>
                </li>

            <?php } ?> 
                </ul>
            <?php } else {} /*
                </div>
            </div>*/?>
        </div>
    </div>


    <header>
        <a class="logo_a" href="<?php echo home_url(); ?>"><img id="menu_logo" class="left" src="<?php bloginfo('template_url'); ?>/img/logo.svg" height="40" /></a>
        <nav>
            <ul class="left">
                <li>
                    <a href="<?php echo home_url('/about'); ?>"><span class="sm_hide">WANZ</span> World</a>
                </li>
                <li class="shcl_btn">
                    <a href="#" class="op">Shows</a>
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
                            <small class="hide"><?php echo get_scp_googleplus(); ?></small>
                        </a>
                    </li>
                    <li>
                        <a href="http://instagram.com/wanztv" title="Follow us on Instagram" target="_blank">
                            <img src="<?php bloginfo('template_url'); ?>/img/i-in.svg" width="21" height="21">
                            <small><?php echo get_scp_instagram(); ?></small>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.dailymotion.com/wearenotzombies" title="Follow us on DailyMotion" target="_blank">
                            <img src="<?php bloginfo('template_url'); ?>/img/i-dm.svg" width="21" height="21">
                        </a>
                    </li>
                </ul>      
            </li>
        </ul>
    </header>
</div>


<div id="main-content"> <?php // General AJAX Purpose ?>
    <div id="inside">