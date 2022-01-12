<!-- Homepage - Announcements section -->

<?php

// $section_title = get_field('announcements', 'option')['announcements_title'];
$args = array(
    'hide_empty'=> false,
);
$cat = get_categories($args);
// var_dump_pre($cat);
$args = array(
  'tax_query' => array(
    array(
      'taxonomy' => 'category',
      'field'    => 'slug',
      'terms'    => 'prokirikseis',
    )
  )
);
$competitions = get_posts($args);

$args = array(
  'tax_query' => array(
    array(
      'taxonomy' => 'category',
      'field'    => 'slug',
      'terms'    => 'deltia-typou',
    )
  )
);
$press_releases = get_posts($args);

$args = array(
  'tax_query' => array(
    array(
      'taxonomy' => 'category',
      'field'    => 'slug',
      'terms'    => 'anakoinwseis',
    )
  )
);
$announcements = get_posts($args);

if ($press_releases || $announcements || $competitions ) {

?>

<section class="announcements">

  <div class="announcements-inner">

    <div class="tabs">

      <div class="tabs-buttons">
        <ul class="tabs" data-tab role="tablist">
          <div class="btn-wrapper">
            <?php if (ICL_LANGUAGE_CODE == 'en') { ?>
            <button id="defaultOpen" class="tab-title" onclick="openTab(event, 'deltia-typou')">PRESS RELEASES</button>
            <?php } else { ?>
            <button id="defaultOpen" class="tab-title" onclick="openTab(event, 'deltia-typou')">ΔΕΛΤΙΑ ΤΥΠΟΥ</button>
            <?php } ?>
          </div>
          <div class="btn-wrapper active">
            <?php if (ICL_LANGUAGE_CODE == 'en') { ?>
            <button class="tab-title" onclick="openTab(event, 'announcements')">ANNOUNCEMENTS</button>
            <?php } else { ?>
            <button class="tab-title" onclick="openTab(event, 'announcements')">ΑΝΑΚΟΙΝΩΣΕΙΣ</button>
            <?php } ?>
          </div>
          <div class="btn-wrapper">
            <?php if (ICL_LANGUAGE_CODE == 'en') { ?>
            <button class="tab-title" onclick="openTab(event, 'competitions')">COMPETITIONS</button>
            <?php } else { ?>
            <button class="tab-title" onclick="openTab(event, 'competitions')">ΠΡΟΚΗΡΥΞΕΙΣ</button>
            <?php } ?>
          </div>
          <span class="active-line"></span>
          <span class="bg-line"></span>
        </ul>
      </div>

      <div class="tabs-content">
        <?php if ($press_releases) { ?>
        <div id="deltia-typou" class="single-tab">
          <div class="deltia-typou-swiper">
            <div class="swiper deltia-typou-swiper-container">
              <div class="swiper-wrapper">
                <!-- Slides -->
                <?php
                      foreach ($press_releases as $press_release) {
                        $img = get_the_post_thumbnail_url($press_release->ID);
                        $img = $img ? $img : get_stylesheet_directory_uri() . '/assets/img/defaultimg.png';
                        $date = new DateTime($press_release->post_date);
                      ?>

                <div class="swiper-slide">
                  <div class="press-release-card">
                    <a href="<?php the_permalink($press_release->ID); ?>">
                      <img src="<?php echo $img; ?>" alt="Press release article photo">
                      <div class="article-details">
                        <span class="category">ΔΕΛΤΙΑ ΤΥΠΟΥ</span>
                        <span class="date"><?php echo $date->format('d/m/Y'); ?></span>

                        <p class="excerpt">
                          <?php echo get_words($press_release->post_title, 16); ?>
                        </p>

                        <div class="meta">
                          <div class="social-sharing">
                            Κοινοποίηση:
                            <div class="social-icons">
                              <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink($press_release->ID); ?>"
                                target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                              <a href="http://twitter.com/share?url=<?php the_permalink($announcement->ID); ?>&text=Simple Share Buttons&hashtags=simplesharebuttons"
                                target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                              <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink($announcement->ID); ?>"
                                target="_blank"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a>
                            </div>
                          </div>

                          <a href="<?php the_permalink($announcement->ID); ?>" class="read-more">Περισσότερα
                            ></a>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                <?php } ?>

              </div>

              <!-- Pagination -->
              <div class="swiper-pagination notices-swiper-pagination"></div>

              <!-- Navigation buttons -->
              <div class="swiper-button-prev notices-swiper-button-prev"></div>
              <div class="swiper-button-next notices-swiper-button-next"></div>

            </div>
          </div>
        </div>
        <?php }
            if ($announcements) { ?>
        <div id="announcements" class="single-tab">

          <div class="announcements-swiper">
            <div class="swiper announcements-swiper-container">
              <div class="swiper-wrapper">
                <!-- Slides -->
                <?php
                      foreach ($announcements as $announcement) {
                        $date = new DateTime($announcement->post_date);
                        $img = get_the_post_thumbnail_url($announcement->ID);
                        $img = $img ? $img : get_stylesheet_directory_uri() . '/assets/img/defaultimg.png';
                      ?>
                <div class="swiper-slide">
                  <div class="press-release-card">
                    <a href="<?php the_permalink($announcement->ID); ?>">
                      <img src="<?php echo $img; ?>" alt="Press release article photo">
                      <div class="article-details">
                        <span class="category">ΑΝΑΚΟΙΝΩΣΕΙΣ</span>
                        <span class="date"><?php echo $date->format('d/m/Y'); ?></span>

                        <p class="excerpt">
                          <?php echo get_words($announcement->post_title, 16); ?>
                        </p>

                        <div class="meta">
                          <div class="social-sharing">
                            Κοινοποίηση:
                            <div class="social-icons">
                              <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink($announcement->ID); ?>"
                                target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                              <a href="http://twitter.com/share?url=<?php the_permalink($announcement->ID); ?>&text=Simple Share Buttons&hashtags=simplesharebuttons"
                                target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                              <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink($announcement->ID); ?>"
                                target="_blank"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a>
                            </div>
                          </div>

                          <a href="<?php the_permalink($announcement->ID); ?>" class="read-more">Περισσότερα
                            ></a>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                <?php } ?>
              </div>

              <!-- Pagination -->
              <div class="swiper-pagination announcements-swiper-pagination"></div>

              <!-- Navigation buttons -->
              <div class="swiper-button-prev announcements-swiper-button-prev"></div>
              <div class="swiper-button-next announcements-swiper-button-next"></div>

            </div>
          </div>
        </div>
        <?php } ?>
        <div id="competitions" class="single-tab">

          <div class="announcements-swiper">
            <div class="swiper announcements-swiper-container">
              <div class="swiper-wrapper">
                <!-- Slides -->
                <?php
                      foreach ($competitions as $competition) {
                        $date = new DateTime($competition->post_date);
                        $img = get_the_post_thumbnail_url($competition->ID);
                        $img = $img ? $img : get_stylesheet_directory_uri() . '/assets/img/defaultimg.png';
                      ?>
                <div class="swiper-slide">
                  <div class="press-release-card">
                    <a href="<?php the_permalink($competition->ID); ?>">
                      <img src="<?php echo $img; ?>" alt="Press release article photo">
                      <div class="article-details">
                        <span class="category">ΠΡΟΚΥΡΗΞΕΙΣ</span>
                        <span class="date"><?php echo $date->format('d/m/Y'); ?></span>

                        <p class="excerpt">
                          <?php echo get_words($announcement->post_title, 16); ?>
                        </p>

                        <div class="meta">
                          <div class="social-sharing">
                            Κοινοποίηση:
                            <div class="social-icons">
                              <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink($competition->ID); ?>"
                                target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                              <a href="http://twitter.com/share?url=<?php the_permalink($competition->ID); ?>&text=Simple Share Buttons&hashtags=simplesharebuttons"
                                target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                              <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink($competition->ID); ?>"
                                target="_blank"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a>
                            </div>
                          </div>

                          <a href="<?php the_permalink($competition->ID); ?>" class="read-more">Περισσότερα
                            ></a>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                <?php } ?>
              </div>

              <!-- Pagination -->
              <div class="swiper-pagination announcements-swiper-pagination"></div>

              <!-- Navigation buttons -->
              <div class="swiper-button-prev announcements-swiper-button-prev"></div>
              <div class="swiper-button-next announcements-swiper-button-next"></div>

            </div>
          </div>
        </div>

      </div>

    </div>

    <div class="cta-wrapper">
      <div class="cta">
        <a href="/category/deltia-typou	/">ΟΛΑ ΤΑ ΔΕΛΤΙΑ ΤΥΠΟΥ</a>
      </div>

      <div class="cta">
        <a href="/category/anakoinwseis/">ΟΛΕΣ ΟΙ ΑΝΑΚΟΙΝΩΣΕΙΣ</a>
      </div>
      <div class="cta">
        <a href="/category/prokirikseis/">ΟΛΕΣ ΟΙ ΠΡΟΚΗΡΥΞΕΙΣ</a>
      </div>
    </div>
  </div>


  <script>
  // Default open tab
  document.getElementById("defaultOpen").click();

  function openTab(evt, tab) {
    // Declare all variables
    var i, single_tab, tablinks;

    // Get all elements with class="single-tab" and hide them
    single_tab = document.getElementsByClassName("single-tab");
    for (i = 0; i < single_tab.length; i++) {
      single_tab[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("btn-wrapper");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }


    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tab).style.display = "block";
    evt.currentTarget.parentElement.classList.add("active");
    // evt.currentTarget.className += " active";
  }

  /**
   * Initialize Swiper sliders
   */

  var noticesSlider = new Swiper('.deltia-typou-swiper-container', {
    // Parameters
    loop: false,
    slidesPerView: 1,
    spaceBetween: 20,
    observer: true,
    observeParents: true,

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
        slidesPerView: 3,
        spaceBetween: 30
      }
    },

    pagination: {
      el: '.notices-swiper-pagination',
      clickable: true
    },

    navigation: {
      nextEl: '.notices-swiper-button-next',
      prevEl: '.notices-swiper-button-prev',
    },
  });

  var announcementsSlider = new Swiper('.announcements-swiper-container', {
    // Parameters
    loop: false,
    slidesPerView: 1,
    spaceBetween: 20,
    observer: true,
    observeParents: true,

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
        slidesPerView: 3,
        spaceBetween: 30
      }
    },

    pagination: {
      el: '.announcements-swiper-pagination',
      clickable: true
    },

    navigation: {
      nextEl: '.announcements-swiper-button-next',
      prevEl: '.announcements-swiper-button-prev',
    },
  });
  var competitionsSlider = new Swiper('.competitions-swiper-container', {
    // Parameters
    loop: false,
    slidesPerView: 1,
    spaceBetween: 20,
    observer: true,
    observeParents: true,

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
        slidesPerView: 3,
        spaceBetween: 30
      }
    },

    pagination: {
      el: '.competitions-swiper-pagination',
      clickable: true
    },

    navigation: {
      nextEl: '.competitions-swiper-button-next',
      prevEl: '.competitions-swiper-button-prev',
    },
  });
  </script>

  </div>


</section>

<?php } ?>