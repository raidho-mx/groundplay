        <div id="intro" class="dumbBoxWrap commercial"> 
            <div class="dumbBoxOverlay">
                &nbsp;
            </div>     

            <div class="vertical-offset"> 
                <div class="dumbBox"> 
                    <a class="closeModal animate">×</a>

        <?php       if (get_field('intro_ad_video', 'options') == 'Intro') : ?>

                    <div class="contain_good_info of_h intro_style">
                        <p class="big_title"><?php the_field('home_modal', 'options'); ?></p>
                    </div>

                <?php if(get_field('yt_or_wanz') == 'Youtube') { ?>
                    <script type="text/javascript">
                        $('#intro .closeModal, #intro .dumbBoxOverlay, #intro .vertical-offset').click(function() {
                            $('body').removeClass('intro');
                            player.playVideo();
                            $('.play_btn').removeClass('hide');
                            $('.sharer.playing').addClass('appear');
                            $('.overlay').addClass('hide');
                        });
                    </script>
                <?php } elseif(get_field('yt_or_wanz') == 'Wanz Player') { ?>
                    <script type="text/javascript">
                        $('#intro .closeModal, #intro .dumbBoxOverlay, #intro .vertical-offset').click(function() {
                            $('body').removeClass('intro');
                            player.play();
                            $('.dumbBoxWrap').fadeOut("fast");
                            $('.nb').addClass('hide'); 
                            $('.mejs-overlay-play').removeClass('hide'); 
                        });
                    </script>
                <?php } ?>

        <?php       elseif (get_field('intro_ad_video', 'options') == 'Anuncio') :
                    $image = get_field('ad', 'options'); ?>

                    <div class="contain_good_info of_h it_vid">
                        <a class="com_click" href="<?php the_field('link', 'options'); ?>"></a>
                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                    </div>

                <?php if(get_field('yt_or_wanz') == 'Youtube') { ?>
                    <script type="text/javascript">
                        $('#intro .closeModal, #intro .dumbBoxOverlay, #intro .vertical-offset').click(function() {
                            $('body').removeClass('intro');
                            player.playVideo();
                            $('.play_btn').removeClass('hide');
                            $('.sharer.playing').addClass('appear');
                            $('.overlay').addClass('hide');
                        });
                    </script>
                <?php } elseif(get_field('yt_or_wanz') == 'Wanz Player') { ?>
                    <script type="text/javascript">
                        $('#intro .closeModal, #intro .dumbBoxOverlay, #intro .vertical-offset').click(function() {
                            $('body').removeClass('intro');
                            player.play();
                            $('.dumbBoxWrap').fadeOut("fast");
                            $('.nb').addClass('hide'); 
                            $('.mejs-overlay-play').removeClass('hide'); 
                        });
                    </script>
                <?php } ?>

        <?php       elseif (get_field('intro_ad_video', 'options') == 'Video') : ?>

                    <div class="contain_good_info of_h it_vid">
                        <a class="com_click" href="<?php the_field('link'); ?>"></a>
                        <video id="commercial" controls preload="none" width="640" height="360" style="width:100%; height:100%;">
                            <source src="<?php the_field('video', 'options'); ?>" type="video/mp4" title=""> 
                        </video>
                    </div>


                <?php if(get_field('yt_or_wanz') == 'Youtube') { ?>
                    <script type="text/javascript">
                    // Get videos for mediaelement.js 
                    var player = new MediaElementPlayer('video#commercial', {
                        features: [],
                        success: function (me) {
                            me.play();

                    // Manual close 
                            $('#intro .closeModal, #intro .dumbBoxOverlay, #intro .vertical-offset').click(function() {
                                $('.dumbBoxWrap').fadeOut("fast");
                                me.pause();
                                player.playVideo();
                                document.querySelector('.overlay').classList.toggle('hide');
                                // document.querySelector('.tapa').classList.toggle('hide');
                                document.querySelector('.sharer.playing').classList.toggle('appear');
                                document.querySelector('.play_btn').classList.toggle('hide');
                            });

                    // Close 3 seconds after play
                            me.addEventListener('ended', function (e) {
                                setTimeout(function() {
                                    $('.dumbBoxWrap').fadeOut("slow");
                                    player.playVideo();
                                    document.querySelector('.tapa, .overlay').classList.toggle('hide');
                                    document.querySelector('.sharer.playing').classList.toggle('appear');
                                    document.querySelector('.play_btn').classList.toggle('hide');
                                }, 2000);
                            }, false);
                        }
                    });
                    </script>
                <?php } elseif(get_field('yt_or_wanz') == 'Wanz Player') { ?>
                    <script type="text/javascript">
                    // Get videos for mediaelement.js 
                    var player = new MediaElementPlayer('video#commercial', {
                        features: [],
                        success: function (me) {
                            me.play();

                    // Manual close 
                            $('#intro .closeModal, #intro .dumbBoxOverlay, #intro .vertical-offset').click(function() {
                                $('.dumbBoxWrap').fadeOut("fast");
                                me.pause();
                                player.play();
                                $('.mejs-overlay-play').removeClass('hide');
                                $('.nb').addClass('hide');
                            });

                    // Close 3 seconds after play
                            me.addEventListener('ended', function (e) {
                                setTimeout(function() {
                                    $('.dumbBoxWrap').fadeOut("slow");
                                    player.play();
                                    $('.mejs-overlay-play').removeClass('hide');
                                    $('.nb').addClass('hide');
                                }, 2000);
                            }, false);
                        }
                    });
                    </script>
                <?php } ?>
                    <?php endif; ?>                    
                </div>
            </div>
        </div> 