<!-- Homepage - Photo Gallery section -->
<?php

$args = array(
    'post_type'         => 'photos',
    'posts_per_page'    => 6,
    'post_status'       => 'publish',
    'suppress_filters'  => true 
);

$photos = new WP_Query($args);


?>
<section id="gallery-section">
    <div class="gallery-container" style="background-color: #f7f7f7;">
        <h2 class="gallery-title"><?php _e('Η ΓΚΑΛΕΡΙ ΤΩΝ ΠΟΛΙΤΩΝ','gov-portal'); ?> </h2>
        <div class="gallery-inner-photos"> <?php
        // The Loop
            if ( $photos->have_posts() ) {
                while ( $photos->have_posts() ) {
                    $photos->the_post();
                    $img = get_field('photo');
                    ?>
                    <img class="gallery-images-content" src = "<?php echo $img;?>" loading="lazy" height="250" width="340">
               <?php } ?>
            <?php  }
            /* Restore original Post Data */
            wp_reset_postdata(); ?>
        </div>
            <div class="gallery-button">
                <a class="gallery-button-inner" href="https://www.kastellorizo.gov.gr/oi-dikes-sas-fotografies/" target="_blank"> <?php _e('Όλες οι εικόνες','gov-portal') ?></a>
            </div>
    </div>
</section>


<style>
    #gallery-section {
        width: auto !important;
    }
    .gallery-title {
        text-align: center;
       padding-top: 60px;
       padding-bottom: 50px;
    }
    .gallery-inner-photos {
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
    .gallery-images-content {
        border-radius: 10%;
    }
    .gallery-button {
        display: flex;
        justify-content: space-around;
        padding-bottom: 30px;
    }
    .gallery-button-inner{
        display: inline-block;
        padding: 13px 22px;
        border-radius: 36px;
        background-color: transparent;
        border: 1px solid #1A5F98;
        color: #1A5F98;
        transition: all 0.2s ease-in-out;
        position: relative;
    }
    .gallery-button-inner:hover {
        background-color: #1A5F98;
        color: white;
    }
    @media screen and (max-width:1450) {
        .gallery-inner-photos {
            width: 95% !important;
        }
    }
</style>
