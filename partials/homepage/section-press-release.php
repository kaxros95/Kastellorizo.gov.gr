<?php

$section_title = get_field('home_press_releases')['press_releases_title'];


$date_now = date('Ymd');
$sticky = array(
    'post_type' => 'press_releases',
    // 'tax_query' => array(
    //   array(
    //     'taxonomy' => 'category',
    //     'field'    => 'slug',
    //     'terms'    => 'deltia-typou'
    //   )
    // ),
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'sticky_post',
            'value' => 'true',
            'compare' => 'LIKE',
        ),
        array(
            'key' => 'date_until',
            'value' => $date_now,
            'type' => 'DATE',
            'compare' => '>=',
        ),
    ),
);
$sticky_post = get_posts($sticky);
if ($sticky_post[0]) {
    console_log('exists');
} else {
    console_log('exists not');
}

$args = array(
    'post_type' => 'press_releases',
    // 'tax_query' => array(
    //   array(
    //     'taxonomy' => 'category',
    //     'field'    => 'slug',
    //     'terms'    => 'deltia-typou'
    //   )
    // ),
    'post__not_in' => [$sticky_post[0]->ID],
);
$deltiaTypou = get_posts($args);

if ($deltiaTypou && get_field('home_press_releases')['press_releases_show_hide']) {
    ?>

    <section class="press-release">
        <?php if (get_field('home_icons')['show_icons'] == 'true') { ?>
            <div class="icons">
                <ul>
                    <?php
                    if (have_rows('home_icons')): while (have_rows('home_icons')) : the_row();
                        if (have_rows('icons_inner')): while (have_rows('icons_inner')) : the_row();

                            $icon = get_sub_field('fa_icon');
                            $title = get_sub_field('fa_title');
                            $url_or_page = get_sub_field('url_or_page');
                            $url = addhttp(get_sub_field('fa_url'));
                            $page = get_sub_field('fa_page');

                            if ($url_or_page == 'true') { ?>
                                <li>
                                    <a href="<?php echo $url ?>" target="_blank"><?php echo $icon . ' ' . $title ?></a>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <a href="<?php echo $page ?>"><?php echo $icon . ' ' . $title ?></a>
                                </li>
                            <?php } ?>
                        <?php endwhile; endif;
                    endwhile; endif;
                    ?>
                </ul>
            </div>

        <?php } ?>
        <div class="wrapper">
            <h2 class="section-title"><?php echo $section_title; ?></h2>

            <hr>

            <div class="press-release-swiper">
                <div class="swiper press-release-swiper-container">
                    <div class="swiper-wrapper">
                        <!-- Slides -->

                        <?php
                        if ($sticky_post[0]) {
                            $img = get_the_post_thumbnail_url($sticky_post[0]->ID);
                            $img = $img ? $img : get_stylesheet_directory_uri() . '/assets/img/defaultimg.svg';
                            $date = new DateTime($sticky_post[0]->post_date);
                            ?>
                            <style>
                                .sticky-deltio::after {
                                    background-color: #3366ff;
                                }
                            </style>
                            <div class="swiper-slide">
                                <div class="press-release-card sticky-deltio">
                                    <a href="<?php the_permalink($sticky_post[0]->ID); ?>">
                                        <img src="<?php echo $img; ?>" alt="Press release article photo">
                                        <div class="article-details">
                                            <span class="category">ΔΕΛΤΙΑ ΤΥΠΟΥ</span>
                                            <span class="date"><?php echo $date->format('d/m/Y'); ?></span>

                                            <p class="excerpt">
                                                <?php echo get_words($sticky_post[0]->post_title, 16); ?>
                                            </p>

                                            <div class="meta">
                                                <div class="social-sharing">
                                                    Κοινοποίηση:
                                                    <div class="social-icons">
                                                        <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink($sticky_post[0]->ID); ?>"
                                                           target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                                                        <a href="http://twitter.com/share?url=<?php the_permalink($sticky_post[0]->ID); ?>&text=Simple Share Buttons&hashtags=simplesharebuttons"
                                                           target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                                        <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink($sticky_post[0]->ID); ?>"
                                                           target="_blank"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>

                                                <a href="<?php the_permalink($sticky_post[0]->ID); ?>"
                                                   class="read-more">Περισσότερα ></a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php
                        }

                        foreach ($deltiaTypou as $deltio) {
                            $img = get_the_post_thumbnail_url($deltio->ID);
                            $img = $img ? $img : get_stylesheet_directory_uri() . '/assets/img/defaultimg.svg';
                            $date = new DateTime($deltio->post_date);
                            ?>
                            <div class="swiper-slide">
                                <div class="press-release-card">
                                    <a href="<?php the_permalink($deltio->ID); ?>">
                                        <img src="<?php echo $img; ?>" alt="Press release article photo">
                                        <div class="article-details">
                                            <span class="category">ΔΕΛΤΙΑ ΤΥΠΟΥ</span>
                                            <span class="date"><?php echo $date->format('d/m/Y'); ?></span>

                                            <p class="excerpt">
                                                <?php echo get_words($deltio->post_title, 16); ?>
                                            </p>

                                            <div class="meta">
                                                <div class="social-sharing">
                                                    Κοινοποίηση:
                                                    <div class="social-icons">
                                                        <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink($deltio->ID); ?>"
                                                           target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                                                        <a href="http://twitter.com/share?url=<?php the_permalink($deltio->ID); ?>&text=Simple Share Buttons&hashtags=simplesharebuttons"
                                                           target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                                        <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink($deltio->ID); ?>"
                                                           target="_blank"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>

                                                <a href="<?php the_permalink($deltio->ID); ?>" class="read-more">Περισσότερα
                                                    ></a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>


                    </div>

                    <!-- Pagination -->
                    <div class="swiper-pagination   press-release-swiper-pagination"></div>

                    <!-- Navigation buttons -->
                    <div class="swiper-button-prev press-release-swiper-button-prev"></div>
                    <div class="swiper-button-next press-release-swiper-button-next"></div>

                </div>
            </div>


            <script>
                /**
                 * Initialize Swiper
                 */
                var pressRelease = new Swiper('.press-release-swiper-container', {
                    // Parameters
                    loop: false,
                    slidesPerView: 1,
                    spaceBetween: 20,

                    breakpoints: {
                        550: {
                            slidesPerView: 1.5,
                        },
                        650: {
                            slidesPerView: 2,
                        },
                        800: {
                            slidesPerView: 2.5,
                        },
                        900: {
                            slidesPerView: 3,
                            spaceBetween: 20,
                        },
                        1140: {
                            slidesPerView: 3.5,
                            spaceBetween: 30
                        }
                    },

                    pagination: {
                        el: '.press-release-swiper-pagination',
                        clickable: true
                    },

                    navigation: {
                        nextEl: '.press-release-swiper-button-next',
                        prevEl: '.press-release-swiper-button-prev',
                    },
                });
            </script>

        </div>

        <div class="cta">
            <a href="press-releases/"><?php _e('Όλα τα Δελτία Τύπου','gov-portal'); ?></a>
        </div>

    </section>
<?php } ?>