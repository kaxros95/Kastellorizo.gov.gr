<!-- Homepage - Actions section -->

<?php
$radio_button = get_field('home_actions')['home_actions_show_hide'];
$section_title = get_field('home_actions')['home_actions_title'];
$home_actions = get_field('home_actions')['home_actions_boxes'];

// echo '<pre>';
// var_dump($home_actions);
// echo '</pre>';
if($radio_button == "true"):
?>

<?php if ($home_actions && count($home_actions) > 0) { ?>
    <section class="actions">

      <div class="wrapper">

        <h2 class="section-title"><?php echo $section_title; ?></h2>

        <div id="actions">
          <div class="actions-swiper">
            <div class="swiper-swiper actions-swiper-container">
              <div class="swiper-wrapper">
                <!-- Slides -->
                <?php foreach ($home_actions as $key => $value){ ?>
                  <?php if (!empty($value['link']['target']) && $value['link']['target'] == '_blank'): ?>
                    <a class="swiper-slide" href="<?php echo $value["link"]["url"] ?>" target="<?=$value['link']['target'] ?>" style="background-image:url('<?php echo $value["graphic"] ?>')"></a>
                  <?php else: ?>
                    <a class="swiper-slide" href="<?php echo $value["link"]["url"] ?>" style="background-image:url('<?php echo $value["graphic"] ?>')"></a>
                  <?php endif; ?> 
                <?php } ?>
              </div>

              <!-- Pagination -->
              <!-- <div class="swiper-pagination actions-swiper-pagination"></div> -->

              <!-- Navigation buttons -->
              <div class="swiper-button-prev actions-swiper-button-prev"></div>
              <div class="swiper-button-next actions-swiper-button-next"></div>

            </div>
          </div>


          <script>
            /**
             * Initialize Swiper slider
             */

            var actionsSlider = new Swiper('.actions-swiper-container', {
              // Parameters
              loop: false,
              slidesPerGroup: 1,
              spaceBetween: 40,

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
                  slidesPerView: 5,
                  spaceBetween: 30
                }
              },

              // pagination: {
              //   el: '.actions-swiper-pagination',
              //   clickable: true
              // },

              navigation: {
                nextEl: '.actions-swiper-button-next',
                prevEl: '.actions-swiper-button-prev',
              },
            });
          </script>


        </div>

      </div>

    </section>
<?php } ?>
<?php endif; ?>