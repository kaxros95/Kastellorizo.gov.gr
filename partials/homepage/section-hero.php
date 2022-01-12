<!-- Homepage - Hero section -->

<?php

$section_title = get_field('home_hero')['hero_title'];
$section_text = get_field('home_hero')['hero_text'];
$section_bg_images = get_field('home_hero')['hero_background_slider'];
$language = ICL_LANGUAGE_CODE;
$count_pictures = count($section_bg_images);
console_log($count_pictures);

// Buttons
$display_buttons = get_field('home_hero')['hero_buttons']['hero_buttons_display'];
$left_button = get_field('home_hero')['hero_buttons']['left_button'];
$middle_button = get_field('home_hero')['hero_buttons']['middle_button'];
$right_button = get_field('home_hero')['hero_buttons']['right_button'];

?>

  <section class="hero">

    <div id="hero">


      <div class="hero-inner">
          <p> <?php _e('Πρόσβαση από ένα σημείο!','gov-portal') ?> </p>
          <p> <?php _e('Σε Υπηρεσίες, Δράσεις, Γνώση! Για όλους!','gov-portal')?> </p>
      </div> 
      <div class="hero-swiper">
          <?php echo do_shortcode('[photouploader]');?>
        <div class="swiper hero-swiper-container">
          <div class="swiper-wrapper">
                                          <!-- video --> 
            <div class="background-video" style="height: 740px;width: 100%;"> 
              <video autoplay muted loop id="myvideo" style="width:100%;">
                <source src="https://drive.google.com/uc?export=download&id=1jLO0Zn6ucrdL17n-JiB1U0DUDAE54Aps" type="video/mp4">
                    Your browser does not support the video tag.
              </video>
            </div>         
          </div>
        </div>
      </div>
    </div>
    <!-- Swiper -->
    <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    </div>
    
  </section>

<style>
  #myvideo {
    position: relative;
  }
  @media screen and (min-width:1350px) {
    #myvideo {
      top: 50%;
      transform: translateY(-50%);
  }
  }
  @media screen and (max-width:1000px) {
    .background-video {
      width: auto !important;
    }
    #myvideo {
      width: auto !important;
      margin-left: 50vw;
      transform: translate(-50%);
    }
  }
</style>
