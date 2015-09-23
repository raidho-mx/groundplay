<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css">
        <style type="text/css">
		.red_bg {
			background:#c52f36;
		}
		#presskit {
			text-align: center;
			margin-top: 100px;
			width: 460px;
			margin: 100px auto 0;
		}
		#presskit p {
			font-size:18px;
			margin:30px auto 40px;
			color:#941f24;
		}
		a.bodbttn {
			background: white;
			position:relative;
			top: 0px;
			color: #c52f36;
			padding: 10px 16px;
			font-size: 24px;
			-webkit-border-radius: 6px;
			-moz-border-radius: 6px;
			/* border-radius: 6px; */
			-moz-box-shadow: 0px 8px 0px 0px #E4E4E4;
			-webkit-box-shadow: 0px 8px 0px 0px #E4E4E4;
			box-shadow: 0px 8px 0px 0px #E4E4E4;
		}
		a.bodbttn:hover {
			top: -2px;
			-moz-box-shadow: 0px 10px 0px 0px #E4E4E4;
			-webkit-box-shadow: 0px 10px 0px 0px #E4E4E4;
			box-shadow: 0px 10px 0px 0px #E4E4E4;
		}
		a.bodbttn:active {
			top: 8px;
			-moz-box-shadow: 0px 2px 0px 0px #E4E4E4;
			-webkit-box-shadow: 0px 2px 0px 0px #E4E4E4;
			box-shadow: 0px 2px 0px 0px #E4E4E4;
		}
		a.bodbttn .icon {font-size:30px;}

	</style>

<!-- META: Work in progress -->
        <meta name="keywords" content="web tv, television en linea, video, cine, teatro, cultura, cocina, recetas, arte, fashion, diseñadores de moda, mexicanos exitosos, mujeres chingonas, famosos, musica del mundo, zombie, television, radio, libertad de expresion, cool, vida, politica, libre pensamiento, resistencia, control mediatico, nuevas ideas">

	<?php wp_head(); ?>
        
        <meta property="og:title" content="WeAreNotZombies">
        <meta property="og:description" content="Turn off the TV. Turn on to the World.">
        <meta property="og:type" content="website">        
        <meta property="og:url" content="<?php echo home_url(); ?>">
        <meta property="og:image" content="http://www.wearenotzombies.tv/facebook_like_wanz_logo.jpg">
</head>

<body class="red_bg">        
<section id="presskit">

<a href="<?php echo home_url('/'); ?>"><img id="menu_logo" class="logo" src="<?php bloginfo('template_url'); ?>/img/logo.svg" height="40" /></a>
<p>Big ol' Presskit download button</p>

<a href="<?php the_field('big_ol_upload_input');?>" class="bodbttn animate" target="_blank">Download <span class="icon">a</span></a>

</section>        
        
</body>
</html>
