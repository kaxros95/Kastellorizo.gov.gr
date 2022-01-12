<?php 
/*
*
*Template for MEC Calendar taxonomies
*/
get_header(); ?>
<?php
global $wp_query;
$single = new MEC_skin_single();
$single_event_main = $single->get_event_mec(get_the_ID());
$single_event_obj = $single_event_main[0];
?>
<style>

</style>
<div id="mec-taxonomy">
    <h2><?= single_cat_title(); ?></h2>
    <?php if(have_posts()):?>
    <?php while(have_posts()):the_post(); ?>
    <?php
        $single = new MEC_skin_single();
        $single_event_main = $single->get_event_mec(get_the_ID());
        $single_event_obj = $single_event_main[0]; 
        $start_date = get_post_meta( get_the_ID(), 'mec_start_date', true );
        $start_date_array = explode("-", $start_date);
        $final_start_date = $start_date_array[2].'-'.$start_date_array[1].'-'.$start_date_array[0];
        $end_date = get_post_meta( get_the_ID(), 'mec_end_date', true );
        $end_date_array = explode("-", $start_date);
        $final_end_date = $end_date_array[2].'-'.$end_date_array[1].'-'.$end_date_array[0];
        $start_time = get_post_meta( get_the_ID(), 'mec_start_time_hour', true);
        $start_time_hour = get_post_meta( get_the_ID(), 'mec_start_time_ampm', true);
        $end_time = get_post_meta( get_the_ID(), 'mec_end_time_hour', true);
        $end_time_hour = get_post_meta( get_the_ID(), 'mec_end_time_ampm', true);
        $color = get_post_meta( get_the_ID(), 'mec_color', true );
        $all_day = get_post_meta( get_the_ID(), 'mec_allday', true );
        $excerpt = get_words(strip_tags(get_the_content()), 50);
        $link = get_permalink();
        $title = get_the_title();
        $location = $single_event_obj->data->locations[$single_event_obj->data->meta['mec_location_id']]['name'];
        $language = ICL_LANGUAGE_CODE;
        // var_dump_pre(get_post_meta( get_the_ID()));
    ?>

        <div class="mec-taxonomy-item">
            <div class="mec-taxonomy-item-event">
                <div class="info">
                <span><span class="fa fa-calendar" aria-hidden="true"></span> <?= $final_start_date ?> </span>
                <span> | </span> 
                <span> <?= $final_end_date ?> </span>
                <span> | </span>
                <?php if($all_day): ?>
                    <span> <?php _e('Όλη την ημέρα','gov-portal') ?> </span>
                <?php else: ?>
                    <?php if($start_time): ?>
                        <span><span class="fa fa-clock" aria-hidden="true"></span> <?= $start_time ?> </span>
                        <?php if($language == 'el'): ?>
                            <?php if($start_time_hour == 'AM'): ?>
                                <span> ΠΜ </span>
                            <?php else: ?>
                                <span> ΜΜ </span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span> $start_time_hour </span>
                        <?php endif;?>
                    <?php endif; ?>
                    <?php if($end_time): ?>
                        - <span> <?= $end_time ?> </span>
                        <?php if($language == 'el'): ?>
                            <?php if($end_time_hour == 'AM'): ?>
                                <span> ΠΜ </span>
                            <?php else: ?>
                                <span> ΜΜ </span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span> $end_time_hour </span>
                        <?php endif;?>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if($location): ?>
                    | <span><span class="fas fa-map-marker-alt" aria-hidden="true"></span><?= $location ?> </span>
                <?php endif; ?>
                </div>
                <div class="right-info">
                <div class="circle" style="background:#<?=$color ?>"></div>
                <span class="cat" style="color:#<?=$color ?>"><?= single_cat_title(); ?></span>
                </div>
            </div>
            <div class="mec-taxonomy-item-body">
                <p> <?= $title ?> </p>
                <p> <?= $excerpt ?> </p>
            </div>
            <div class="mec-taxonomy-item-link">
                <a href="<?php echo $link ?>">Περισσότερα<span class="fa fa-angle-right" aria-hidden="true"></span></a>
            </div>

        </div>
    <?php endwhile ?>
        <div id="posts-pagination" class="pagination">
            <?php
            $big = 999999999; // an unlikely integer
            echo paginate_links([
            'base'            => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format'          => '?paged=%#%', # or '/page/%#%'
            'current'         => max(1, get_query_var('paged')),
            'total'           => $wp_query->max_num_pages,
            'prev_text'       => __('<span class="meta-nav">&larr;</span> Προηγούμενη', 'gov-portal'),
            'next_text'       => __('Επόμενη <span class="meta-nav">&rarr;</span>', 'gov-portal'),
            ]);
            ?>
      </div>
    <?php else: ?>
        <p class="mec-not-found"> <?php  _e('Δεν βρέθηκαν διαθέσιμες εκδηλώσεις','gov-portal'); ?> </p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>