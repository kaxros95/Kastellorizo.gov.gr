<?php
/*
*
* Template Name: News Archive
*/
get_header(); ?>

<?php
    $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 10,
        'paged' => $paged,

    );
    $news = new WP_Query($args);
?>
<div id="news">
    <h1> <?php the_title(); ?> </h1>
    <?php
      if($news->have_posts()):while ($news->have_posts()) : $news->the_post();
      $category = get_the_category();
      $parent = get_cat_name($category[0]->category_parent);
    ?>
    
      <div class="news-content">
        <div class="news-header">
          <h2> <?= get_the_title(); ?> </h2>
          <a href="<?php echo  get_category_link($category[0]->term_id); ?>">
            <p>
              <?php echo  $category[0]->name ?>
              <?php if($parent): ?>
                (<span><?php echo  $parent ?></span>)
              <?php endif; ?>
            </p>
          </a>
        </div>
          <div class="entry-content">
            <p><?php echo  get_the_date() ?></p>
            <div class="meta">
              <div class="excerpt">
                <?php echo get_words(strip_tags(get_the_content()), 25); ?>
              </div>
              <a href="<?php echo get_the_permalink(get_the_ID()) ?>">
                <?php if (ICL_LANGUAGE_CODE == 'en') { ?>
                  <p class="read-more">Read more ></p>
                <?php } else { ?>
                  <p class="read-more">Περισσότερα ></p>
                <?php } ?>
              </a>
            </div>
          </div><!-- .entry-content -->
      </div>

    <?php endwhile; ?>
      <div id="posts-pagination" class="pagination">
        <?php
        $big = 999999999; // an unlikely integer
        echo paginate_links([
          'base'            => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
          'format'          => '?paged=%#%', # or '/page/%#%'
          'current'         => max(1, get_query_var('paged')),
          'total'           => $news->max_num_pages,
          'prev_text'       => __('<span class="meta-nav">&larr;</span> Προηγούμενη', 'gov-portal'),
          'next_text'       => __('Επόμενη <span class="meta-nav">&rarr;</span>', 'gov-portal'),
        ]);
        ?>
      </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>