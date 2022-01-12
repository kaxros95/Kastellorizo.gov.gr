<?php
$cta_section = get_field('home_cta');
$cta_boxes = $cta_section['cta_box'];
$cta_title = $cta_section['cta_title'];
?>
<section class="cta-new">
    <h2 class="section-title"> <?php echo $cta_title ?> </h2>
    <div id="cta" class="cta-new-inner">
      <!-- Slider main container -->
      <div class="swiper cta-swiper-container">
      <!-- Additional required wrapper -->
      <div class="swiper-wrapper">
          <!-- Slides -->
        <?php foreach ($cta_boxes as $box => $boxValue) {?>
        <div class="swiper-slide box">
          <div class="title"><?php echo $boxValue['cta_box_title'] ?></div>
          <div class="image">
            <img src="<?php echo $boxValue["cta_box_graphic"] ?>">
          </div>
          <div class="button">
            <a href="<?php echo $boxValue["cta_box_link"] ?>" class="btn" style="background-color: <?php echo $boxValue["button"]['button_bg_color']; ?>; color: <?php echo $boxValue["button"]['button_text_color']; ?>;"><?php echo $boxValue["button"]['button_text']; ?>
            </a>
          </div>
        </div>
        <?php } ?>
      </div>
      <!-- If we need pagination -->
      <div class="swiper-pagination"></div>

      <!-- If we need navigation buttons -->
      <div class="swiper-button-prev cta-swiper-button-prev"></div>
      <div class="swiper-button-next cta-swiper-button-next"></div>

      </div> 
    </div>
</section>

<script>
    <?php if ($cta_boxes && count($cta_boxes) > 4) {
      $centered = 'false';
      } else {
        $centered = 'true';
      } 
    ?>
    const swiper = new Swiper('.cta-swiper-container', {
    // Optional parameters
    direction: 'horizontal',
    loop: false,
    slidesPerView: 1,
    spaceBetween: 40,
    centeredSlides: <?php echo $centered; ?>,
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
              slidesPerView: 4,
              spaceBetween: 30
            }
          },

    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
         clickable: true
    },

    // Navigation arrows
    navigation: {
        nextEl: '.cta-swiper-button-next',
        prevEl: '.cta-swiper-button-prev',
    },
    });
</script>