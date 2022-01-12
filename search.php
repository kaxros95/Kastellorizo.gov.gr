<?php

/**
 * Search Page Template.
 */

get_header();

$base_url = get_site_url();
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main">

    <?php

    /* http://codex.wordpress.org/Creating_a_Search_Page#Display_Total_Results */

    //$mySearch =& new WP_Query("s=$s & showposts=-1");
    //$numResults = $mySearch->post_count;
    //$wp_query->post_count; // count only the results for 1 specific page
    $search_time = timer_stop(0);
    $search_query = get_search_query();

    /**
     * Search query not empty and long enough.
     * If the above criteria are not met (i.e. they are false),
     * then have_posts() will not ever run.
     */
    if ($search_query != null && strlen($search_query) >= 3 && have_posts()) {

      echo '<div id="search" class="search-wrapper">
      <form method="get" action="' . $base_url . '" id="search-form" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction">
        <div id="searchbar-container">
          <p>Αναζήτηση</p>

          <input type="search" role="search" accesskey="s" itemprop="query-input"
          name="s" tabindex="1" required />

          <button type="submit" form="search-form">
          <span class="fas fa-search" aria-hidden="true"></span>
          </button>
        </div>
      </form>
    </div>';

      echo '<div id="search-aftermath">' . __('Η αναζήτησή σας για', 'gov-portal') . ' <strong>' . $search_query . '</strong> ' . __('επέστρεψε ', 'gov-portal') . ' <strong>' . $wp_query->found_posts . '</strong> ' . __('αποτελέσματα σε', 'gov-portal') . ' ' . $search_time . ' ' . __('δευτερόλεπτα', 'gov-portal') . '.</div>';



      // Start the loop.
      while (have_posts()) : the_post();


        include dirname(__FILE__) . "/partials/template-parts/search-result.php";
      //get_template_part( 'template-parts/search', 'result-template' );

      // End the loop.
      endwhile;

      $current_page = $wp_query->query_vars['paged'];

      if ($current_page == 0 || $current_page == "") {
        $current_page = 1;
      }

      $total_pages = $wp_query->max_num_pages;
      $displayed_results = $wp_query->post_count;
      $total_results = $wp_query->found_posts;

      echo $current_page . ' ' . __('από', 'gov-portal') . ' ' . $total_pages . ' ' . __('σελίδες', 'gov-portal') . ', ' . $displayed_results . ' ' . __('από', 'gov-portal') . ' ' . $total_results .  ' ' . __('αποτελέσματα', 'gov-portal');

      echo '<div id="search-results-pagination" class="pagination">';
      // Previous/next page navigation.
      the_posts_pagination([
        'prev_text'       => __('<span class="meta-nav">&lt;</span>', 'gov-portal'),
        'next_text'       => __('<span class="meta-nav">&gt;</span>', 'gov-portal'),
        // 'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'gov-portal' ) . ' </span>',
      ]);
      echo '</div>';
    }
    // If nothing was found.
    else {
      echo '<div id="search" class="search-wrapper">
      <form method="get" action="' . $base_url . '" id="search-form" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction">
        <div id="searchbar-container">
          <p>Αναζήτηση</p>

          <input type="search" role="search" accesskey="s" itemprop="query-input"
          name="s" tabindex="1" required />

          <button type="submit" form="search-form">
          <span class="fas fa-search" aria-hidden="true"></span>
          </button>
        </div>
      </form>
    </div>';


      echo '<br /><br /><span style="font-size: 2em; display:table; margin: 0 auto;">&ldquo;' . $search_query . '&rdquo;</span>';

      echo '<br /><p style="text-align: center; color: rgb(var(--main-dark-font-color));line-height: 1.5">' . __('Η αναζήτησή σας δεν επέστρεψε αποτελέσματα. Δοκιμάστε ξανά με κάποιες διαφορετικές λέξεις-κλειδιά.', 'gov-portal') . '</p><br />';
      //get_search_form();

    }
    ?>

  </main>


</div>

<?php
get_footer();
