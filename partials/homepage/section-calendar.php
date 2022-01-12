<!-- Homepage - Calendar section -->

<?php
$radiobutton = get_field('home_events')['events_show_hide'];
$section_title = get_field('home_events')['events_title'];
$button_text = get_field('home_events')['events_button_text'];
$button_link = get_field('home_events')['events_button_link'];

if($radiobutton == 'true'):
?>
  <section class="calendar">
    <div class="calendar-inner">

      <h2 class="section-title"><?php echo $section_title; ?></h2>

      <?php // echo do_shortcode('[MEC id="89"]'); 
      ?>
      <?php echo do_shortcode('[MEC id="34364"]'); ?>

      <div class="cta">
        <a href="<?= $button_link  ?>"><?php echo $button_text; ?></a>
      </div>
    </div>
  </section>

  <?php endif; ?>

