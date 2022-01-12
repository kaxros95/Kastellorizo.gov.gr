<!-- Homepage - Call to actions section -->

<?php
$cta_section = get_field('home_cta');
$cta_boxes = $cta_section['cta_box'];
$cta_title = $cta_section['cta_title'];
?>

  <section class="cta">
      <h2 class="section-title"> <?php echo $cta_title ?> </h2> 
    <div class="inner">
      <?php foreach ($cta_boxes as $box => $boxValue) {
      ?>

        <div class="box" style="background-image:url('<?php echo $boxValue["cta_box_graphic"] ?>')">
          <div>
            <a href="<?php echo $boxValue["cta_box_link"] ?>" class="btn" style="background-color: <?php echo $boxValue["button"]['button_bg_color']; ?>; color: <?php echo $boxValue["button"]['button_text_color']; ?>;"><?php echo $boxValue["button"]['button_text']; ?></a>
          </div>
        </div>
      <?php } ?>
    </div>
  </section>

