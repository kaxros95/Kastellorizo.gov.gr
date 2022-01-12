<?php

/**
 * Template Name: Under Construction
 */

get_header();

the_content(); ?>

<div class="wrapper">
  <?php if (ICL_LANGUAGE_CODE == 'en') { ?>
    <img class="map" src="<?php echo get_template_directory_uri(); ?>/assets/img/UnderConstructionEN.png" alt="Under construction">
    <h2>Coming Soon</h2>
  <?php } else { ?>
    <img class="map" src="<?php echo get_template_directory_uri(); ?>/assets/img/UnderConstructionEL.png" alt="Υπο κατασκευή">
    <h2>Σύντομα κοντά σας</h2>
  <?php } ?>
</div>

<?php get_footer();
