<section id="video">
	<?php // Aquí estaba el paginator ?>
    <div class="contain_ctr video-wrap">

<?php if (get_field('yt_or_wanz') == 'Youtube') : ?>




    <?php   $image = get_field('poster_video');
            $call = wp_get_attachment_image_src($image, 'full'); ?>
    <div class="st_pause overlay" style="background-image:url(<?php echo $call[0]; ?>);">
        <div class="tapa">
            <div class="sharer">
				<div class="paginator"><?php   
					foreach((get_the_category()) as $category) {}
					$prev_post = get_adjacent_post(false, '', false);
					$next_post = get_adjacent_post(false, '', true);

					if(!empty($prev_post)) { ?>

						<a href="<?php echo get_permalink($prev_post->ID) ?>" title="<?php echo $prev_post->post_title ?>" class="bllt animate prev">
							<p>Just Viewed</p>
							<p class="title"><?php echo $prev_post->post_title; ?></p>
							<img src="<?php bloginfo('template_url'); ?>/img/p-pv.svg" width="70" height="34">
						</a><?php 

					} if(!empty($next_post)) { ?>

						<a href="<?php echo get_permalink($next_post->ID) ?>" title="<?php echo $next_post->post_title ?>" class="bllt animate next">
							<p>Up Next</p>
							<p class="title"><?php echo $next_post->post_title; ?></p>
							<img src="<?php bloginfo('template_url'); ?>/img/p-nx.svg" width="70" height="34">
						</a><?php  

					}  ?>
				</div>
                <div class="nb">
                    <div id="count">5</div>
                    <div class="loading"></div>
                </div>
                <a class="play_btn animate hide"></a>
                <h2><?php the_title(); ?> <span class="smoke">en</span> <?php global $catNoUrl; echo $catNoUrl; ?></h2>
                <a href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" class="sh_btn facebook" title="Share on Facebook" target="_blank">Share on Facebook</a>
                <a href="http://twitter.com/home?status=Mira el video de <?php the_title(); ?> en WearenotzombiesTv: <?php the_permalink(); ?>" class="sh_btn twitter" title="Share on Twitter" target="_blank">Share on Twitter</a>
            </div>
        </div>
    </div>

    <div id="player"></div>

    <script>
        // 2. This code loads the IFrame Player API code asynchronously.
        var tag = document.createElement('script');

        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        // 3. This function creates an <iframe> (and YouTube player)
        //    after the API code downloads.
        var player;
        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                height: '390',
                width: '640',
                videoId: '<?php the_field('yt_video_code'); ?>',
            //    playerVars: { 'controls': 0 },
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });

            $("section#video").fitVids();
        }
        function a(){
            document.querySelector('.tapa, .overlay').classList.toggle('hide');
            document.querySelector('.sharer.playing').classList.toggle('appear');
            player.playVideo();
        }
        document.querySelector('.play_btn').addEventListener('click', a );

        function onPlayerReady(event) {
            setTimeout(function(){
                player.playVideo();
                document.querySelector('.tapa, .overlay').classList.toggle('hide');
                document.querySelector('.play_btn').classList.toggle('hide');
            document.querySelector('.sharer.playing').classList.toggle('appear');
            }, 5000);
        }

        function onPlayerStateChange(event) {
            if (event.data === -1) {
                document.querySelector('.nb').classList.toggle('hide');
            }
            if (event.data === 2) {
                document.querySelector('.tapa, .overlay').classList.toggle('hide');
                document.querySelector('.sharer.playing').classList.toggle('appear');
            }
            if (event.data === 0) {
                <?php   $prev_post = get_previous_post();
                    if (!empty( $prev_post )) { ?>
                    window.location = '<?php echo get_permalink( $prev_post->ID ); ?>';
                <?php   } else { /* Missing: Go To Category */ } ?>
            }
        }

        window.onload = function(){
          
            (function(){
              var counter = 5;

              setInterval(function() {
                counter--;
                if (counter >= 0) {
                  span = document.getElementById("count");
                  span.innerHTML = counter;
                }
                // Display 'counter' wherever you want to display it.
                if (counter === 0) {
                    clearInterval(counter);
                }
                
              }, 1000);
                
            })();
          
        }
    </script>





<?php elseif(get_field('yt_or_wanz') == 'Wanz Player') : ?>




    <div class="st_pause overlay">
        <div class="sharer">
            <div class="nb">
                <div id="count">5</div>
                <div class="loading"></div>
            </div>
            <h2><?php the_title(); ?> <span class="smoke">en</span> <?php echo $catNoUrl; ?></h2>
            <a href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" class="sh_btn facebook" title="Share on Facebook" target="_blank">Share on Facebook</a>
            <a href="http://twitter.com/home?status=Mira el video de <?php the_title(); ?> en WearenotzombiesTv: <?php the_permalink(); ?>" class="sh_btn twitter" title="Share on Twitter" target="_blank">Share on Twitter</a>
        </div>  
    </div>

    <video id="player1" controls preload="none" width="640" height="360" style="width:100%;height:100%;" poster="<?php  
        $ft_image = wp_get_attachment_image_src( get_field('poster_video'), "full" );
        if( $ft_image ) { 
            echo $ft_image[0]; 
        } else { 
            echo bloginfo('template_url').'/img/video_fallback.jpg';
        } ?>" >
        <source src="<?php the_field('file_video'); ?>" type="video/mp4" title="SD (480)"> 
        <?php if(get_field('hd_video')) { ?> <source src="<?php the_field('hd_video'); ?>" type="video/mp4" title="HD (720)"> <?php } ?>
        <?php if(have_rows('subtitles')): while(have_rows('subtitles')): the_row();?>
            <track kind="subtitles" src="<?php the_sub_field('cc_idioma'); ?>" srclang="en" ></track>
            <p class="debug"><?php the_sub_field('language'); ?></p>
        <?php   endwhile; endif; ?>
    </video>


<script type="text/javascript">
// Get videos for mediaelement.js 
            var player = new MediaElementPlayer('video#player1', {
                features: ['playpause','progress','current','duration','tracks','volume','fullscreen','sourcechooser'],
                success: function (me) {

// 5 Seconds till play
                    setTimeout(function() {
                          me.play();
                          $('.nb, .mejs-overlay-play').toggleClass('hide'); 
                    }, 5000);
                    

// Automatic Next (eventually this will be moved to loophandler.php)
                    me.addEventListener('ended', function (e) {
                <?php   $next_post = get_next_post();
                    if (!empty( $next_post )) { ?>
                    window.location = '<?php echo get_permalink( $next_post->ID ); ?>';
                <?php   } else { /* Missing: Go To Category */ } ?>
                    }, false);

// While Playing
                    me.addEventListener('play', function() {
                        $('body').addClass('hide_menu'); 
                        $('.st_pause').hide(); 
                        $('.sharer.playing').addClass("appear"); 
                    }, true);
                    
// While Pause
                    me.addEventListener('pause', function() { 
                        $('body').removeClass('hide_menu'); 
                        $('.st_pause').show(); 
                        $('.sharer.playing').removeClass("appear"); 
                    }, true);
                    
                }
            });
            
            window.onload = function(){
              
                (function(){
                  var counter = 5;

                  setInterval(function() {
                    counter--;
                    if (counter >= 0) {
                      span = document.getElementById("count");
                      span.innerHTML = counter;
                    }
                    // Display 'counter' wherever you want to display it.
                    if (counter === 0) {
                        clearInterval(counter);
                    }
                    
                  }, 1000);
                    
                })();
              
            }
</script>


<?php endif; ?>

    </div>
    <div class="sharer playing animate">
        <a href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" class="sh_btn facebook" title="Share on Facebook" target="_blank">Share on Facebook</a>
        <a href="http://twitter.com/home?status=Mira el video de <?php the_title(); ?> en WearenotzombiesTv: <?php the_permalink(); ?>" class="sh_btn twitter" title="Share on Twitter" target="_blank">Share on Twitter</a>
    </div>  
</section>
