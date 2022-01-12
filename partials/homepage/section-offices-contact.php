<!-- Homepage - Offices Contact -->

<?php

$section_title = get_field('home_offices')['offices_title'];
$offices = get_field('home_offices')['offices_list'];
$photo = get_field('home_greetings')['greetings_photo'];
$text = get_field('home_greetings')['greetings_text'];


if (get_field('home_greetings')['greetings_show_hide']) {

?>

  <section class="offices-contact">

    <div class="wrapper">

      <h2 class="section-title"><?php echo $section_title; ?></h2>

      <div class="inner">

        <div id="offices">
          <div class="offices-swiper">
            <div class="swiper offices-swiper-container">
              <div class="swiper-wrapper">
                <!-- Slides -->
                <?php foreach ($offices as $key => $value) {
                  $address = $value['office_address'];
                  $address = explode(' ', $address);
                  $address = implode('+', $address);
                  $address = 'https://www.google.com/maps/search/' . $address;

                ?>

                  <div class="swiper-slide">

                    <h3><?php echo $value["office_title"] ?></h3>

                    <div class="detail">
                      <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                      <a href='<?php echo $address; ?>' target="_blank"><?php echo $value["office_address"] ?></a>
                    </div>
                    <div class="detail">
                      <i class="fas fa-envelope" aria-hidden="true"></i>
                      <a href='mailto:<?php echo $value["office_email"]; ?>' target="_blank"><?php echo $value["office_email"] ?></a>
                    </div>
                    <div class="detail">
                      <i class="fas fa-phone-alt" aria-hidden="true"></i>
                      <a href='tel:<?php echo  $value["office_telephone"] ?>' target="_blank"><?php echo $value["office_telephone"] ?></a>
                    </div>
                    <div class="detail">
                      <i class="fas fa-print" aria-hidden="true"></i>
                      <a href='fax:<?php echo $value["office_fax"] ?>' target="_blank"><?php echo $value["office_fax"] ?></a>
                    </div>
                    <div class="detail">
                      <i class="fas fa-globe" aria-hidden="true"></i>
                      <a href='http://<?php echo $value["office_website"]  ?>' target="_blank"><?php echo $value["office_website"] ?></a>
                    </div>

                  </div>

                <?php } ?>

              </div>

              <!-- Pagination -->
              <div class="swiper-pagination offices-swiper-pagination"></div>

              <!-- Navigation buttons -->
              <div class="swiper-button-prev offices-swiper-button-prev"></div>
              <div class="swiper-button-next offices-swiper-button-next"></div>

            </div>
          </div>

          <script>
            /**
             * Initialize Swiper slider
             */

            var officesSlider = new Swiper('.offices-swiper-container', {
              // Parameters
              loop: false,
              slidesPerView: 1,
              spaceBetween: 40,
              // centeredSlides: true,

              breakpoints: {
                450: {
                  slidesPerView: 1,
                },
                650: {
                  slidesPerView: 1.5,
                },
                800: {
                  slidesPerView: 2,
                },
                980: {
                  slidesPerView: 2.5,
                },
                1140: {
                  slidesPerView: 3.5,
                  spaceBetween: 30
                }
              },

              pagination: {
                el: '.offices-swiper-pagination',
                clickable: true
              },

              navigation: {
                nextEl: '.offices-swiper-button-next',
                prevEl: '.offices-swiper-button-prev',
              },
            });
          </script>

        </div>


      </div>


    </div>

  </section>

<?php }
