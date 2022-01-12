<?php get_header(); ?>
<?php $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; ?>
<?php $args= array(
    'post_type' => 'mec-events',
    'paged' => $paged,
    'order' => 'DESC',
    'meta_key' => 'mec_start_date',
    'orderby' => 'meta_value_num' 
);
$events = new WP_Query($args);
?>
    <div id="mec-events">
    <h2><?php _e('ΕΚΔΗΛΩΣΕΙΣ - ΓΕΓΟΝΟΤΑ','gov-portal'); ?></h2>
    <?php if($events->have_posts()):?>
        <?php while($events->have_posts()):$events->the_post(); ?>
        <?php 
            $start_date = get_post_meta( get_the_ID(), 'mec_start_date', true ); 
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
            $taxonomy = get_the_terms($id,'mec_category');
            $taxonomy_link = get_term_link($taxonomy[0]->slug,'mec_category');
            $location = $single_event_obj->data->locations[$single_event_obj->data->meta['mec_location_id']]['name'];
            $language = ICL_LANGUAGE_CODE;
        ?>
        <div class="mec-archive-item">
            <div class="mec-archive-item-event">
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
                <?php if ($taxonomy) { ?>
                    <a href="<?php echo $taxonomy_link ?>">
                        <span class="cat" style="color:#<?=$color ?>"><?php echo $taxonomy[0]->name; ?></span>
                    </a> 
                <?php } ?>
                </div>
            </div>
            <div class="mec-archive-item-body">
                <p> <?= $title ?> </p>
                <p> <?= $excerpt ?> </p>
            </div>
            <div class="mec-archive-item-link">
                <a href="<?php echo $link ?>">Περισσότερα<span class="fa fa-angle-right" aria-hidden="true"></span></a>
            </div>

        </div>
        <?php endwhile; ?>
        <div id="posts-pagination" class="pagination">
            <?php
            $big = 999999999; // an unlikely integer
            echo paginate_links([
            'base'            => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format'          => '?paged=%#%', # or '/page/%#%'
            'current'         => max(1, get_query_var('paged')),
            'total'           => $events->max_num_pages,
            'prev_text'       => __('<span class="meta-nav">&larr;</span> Προηγούμενη', 'gov-portal'),
            'next_text'       => __('Επόμενη <span class="meta-nav">&rarr;</span>', 'gov-portal'),
            ]);
            ?>
        </div>
    <?php endif; ?>
    
    </div>

    <?php get_footer(); ?>