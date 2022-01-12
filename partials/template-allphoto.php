<?php 

/**
 * Template name: All Photo
 */


// acf_form_head();

get_header();

// $all_images = get_field('home_gallery_images');


$args = array(
    'post_type'         => 'photos',
    'posts_per_page'    => -1,
    'post_status'       => 'publish',
    'suppress_filters'  => true
);

$photos = new WP_Query($args);
?> 

<div class="section-all-photos" style="background-color: #e2f1f4;">
    <h2 class="all-photos-title"> <?php _e('Οι δικές σας Φωτογραφίες','gov-portal'); ?> </h2>
        <div class="all-photos-inner-content"> <?php
     
                 // The Loop
          if ( $photos->have_posts() ) {
              while ( $photos->have_posts() ) {
                  $photos->the_post();
                  $img = get_field('photo');
                  ?>
                  <img class="all-photos-content" src = "<?php echo $img;?>" loading="lazy" height="250" width="340">
             <?php } ?>
          <?php  }
          /* Restore original Post Data */
          wp_reset_postdata(); ?>
        </div>

</div>



<?php get_footer();?>


<style>
    .all-photos-title {
        padding: 50px;
        text-align: center;
    }
    .section-all-photos {
        width: auto !important;
    }
    .all-photos-inner-content {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;
        align-items: center;
        padding-bottom: 50px;
        row-gap: 30px;
        column-gap: 50px;
        width: 78%;
        margin-left: auto;
        margin-right: auto;
    }
    .all-photos-content {
        border-radius: 10%;
    }
    @media screen and (max-width:350px){
        .all-photos-content {
            width: 300px;
            height: 200px;
        }
    }
    @media screen and (max-width:1450) {
        .gallery-inner-photos {
            width: 95% !important;
        }
    }
</style>