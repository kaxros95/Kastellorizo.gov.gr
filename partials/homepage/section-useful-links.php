<!-- Homepage - Services Center section -->

<?php
$radio_button = get_field('home_useful_links')['useful_links_show_hide'];
$section_title = get_field('home_useful_links')['useful_links_title'];
$useful_links = get_field('home_useful_links')['useful_links_boxes'];

?>
<?php if($radio_button== 'true'):?>
<?php if ($useful_links && count($useful_links) > 0) { ?>
    <section class="useful-links">

      <div class="wrapper">

        <h2 class="section-title"><?php echo $section_title; ?></h2>

        <div id="useful-links">
          <div class="useful-links-swiper">
            <div class="swiper useful-links-swiper-container">
              <div class="swiper-wrapper">
                <!-- Slides -->
                <?php foreach ($useful_links as $key => $value) { ?>
                  <a class="swiper-slide" href="<?php echo $value["link"] ?>" style="background-image:url('<?php echo $value["graphic"] ?>')"></a>
                <?php } ?>
              </div>

              <!-- Pagination -->
              <div class="swiper-pagination useful-links-swiper-pagination"></div>

              <!-- Navigation buttons -->
              <div class="swiper-button-prev useful-links-swiper-button-prev"></div>
              <div class="swiper-button-next useful-links-swiper-button-next"></div>

            </div>
            
          </div>

          <?php if ($useful_links && count($useful_links) > 3) {
            $centered = 'true';
          } else {
            $centered = 'false';
          } ?>

          <script>
            /**
             * Initialize Swiper slider
             */

            var usefulLinksSlider = new Swiper('.useful-links-swiper-container', {
              // Parameters
              loop: false,
              slidesPerView: 1,
              spaceBetween: 40,
              centeredSlides: <?php echo $centered; ?>,

              breakpoints: {
                650: {
                  slidesPerView: 1,
                },
                800: {
                  slidesPerView: 2,
                },
                980: {
                  slidesPerView: 3,
                  spaceBetween: 40,
                },
                1140: {
                  slidesPerView: 3,
                  spaceBetween: 30
                }
              },

              pagination: {
                el: '.useful-links-swiper-pagination',
                clickable: true
              },

              navigation: {
                nextEl: '.useful-links-swiper-button-next',
                prevEl: '.useful-links-swiper-button-prev',
              },
            });
          </script>
              <!-- <a class="morebtn" href="#">ΠΕΡΙΣΣΟΤΕΡΑ</a> -->
        </div>

      </div>

    </section>
   
<?php } ?>
 <?php endif; ?>