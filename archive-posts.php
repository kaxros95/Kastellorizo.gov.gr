<?php

/**
 * Template Name: Archives Posts
 */

get_header();
$x = $wp_query->query;
$maxposts = 2;
$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
$posts_query_args = [
  //'numberposts' 	=> '5',
  'post_parent'      => 0,
  'posts_per_page'   => $maxposts,
  'paged'           => $paged,
  'suppress_filters' => false
];
$loop = new WP_Query($posts_query_args);
?>

<div id="main-content" class="main-content">

  <div id="primary" class="content-area">

    <?php get_sidebar('category'); ?>


    <div id="content" class="site-content" role="main">

      <header class="page-header">
        <?php
        // Get the current archive title and display it if it doesn't exist it's from posts
        $archiveTitle = post_type_archive_title('', false) ?? __("Ενημέρωση", 'gov-portal');
        echo '<h1 class="page-title">' . $archiveTitle . '</h1>';

        echo '<div class="page-content">' . get_the_content() . '</div>';

        ?>

      </header><!-- .page-header -->

      <?php
      // Start the Loop.
      while ($loop->have_posts()) : $loop->the_post();

      ?>
        <a class="single-item" href=" <?php echo get_permalink() ?> ">
          <?php
          // Page title.
          the_title('<header class="entry-header"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->');
          ?>

          <div class="entry-content">
            <div class="meta">
              <div class="excerpt">
                <?php echo get_words(strip_tags(get_the_content()), 25); ?>
              </div>

              <?php if (ICL_LANGUAGE_CODE == 'en') { ?>
                <p class="read-more">Read more ></p>
              <?php } else { ?>
                <p class="read-more">Περισσότερα ></p>
              <?php } ?>
            </div>
          </div><!-- .entry-content -->

        </a><!-- #post-## -->
      <?php
      endwhile;
      ?>

      <div id="posts-pagination" class="pagination">
        <?php
        $big = 999999999; // an unlikely integer
        echo paginate_links([
          'base'            => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
          'format'          => '?paged=%#%', # or '/page/%#%'
          'current'         => max(1, get_query_var('paged')),
          'total'           => $loop->max_num_pages,
          'prev_text'       => __('<span class="meta-nav">&larr;</span> Προηγούμενη', 'gov-portal'),
          'next_text'       => __('Επόμενη <span class="meta-nav">&rarr;</span>', 'gov-portal'),
        ]);
        ?>
      </div>
    </div><!-- #content -->




  </div><!-- #primary -->



</div><!-- #main-content -->

<?php
get_footer();
