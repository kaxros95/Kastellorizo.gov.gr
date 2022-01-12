<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

get_header();
$currentTermID = get_queried_object()->term_id;
$base_url = get_site_url();

$currentTerm = get_term($currentTermID, 'contact_categories');
$termChilds = null;
$termChilds = get_term_children($currentTermID, 'contact_categories');
$parentTerm = null;
if ($currentTerm->parent > 0) {
  $parentTerm = get_term($currentTerm->parent, 'contact_categories');
}

$args = array(
  'post_type'       => 'contacts',
  'posts_per_page'  => -1,
  'post_status'     => 'publish',
  'orderby'        => 'title',
  'order'          => 'ASC',
  'tax_query'       => array(
    array(
      'taxonomy' => 'contact_categories',
      'field'    => 'slug',
      'terms'    => $currentTerm->slug,
      'include_children' => false
    ),
  ),
);
$query = new WP_Query($args);

$post_titles = array();
$main_posts = array();


foreach ($query->posts as $post) {
  array_push($post_titles, $post->post_title);
  array_push($main_posts, $post->ID);
}
?>

<?php if ($query->have_posts()) { ?>
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
    
    <?php get_template_part( 'partials/template-parts/breadcrumbs'); // Displays the breadcrumbs ?>
      <div class="contacts-page">
      
        <div id="sidebar">

          <?php if ($parentTerm) { ?>
            <a class="parent" href="<?php echo get_term_link($parentTerm->term_id); ?>"><span class="fas fa-long-arrow-alt-left" aria-hidden="true"></span><?php echo $parentTerm->name; ?></a>
          <?php }
          if ($termChilds) { ?>
            <ul class="child-ul">
              <?php foreach ($termChilds as $child) { ?>
                <li class="child-ul-li">
                  <?php
                  $child = get_term($child, 'contact_categories'); ?>
                  <div class="count-wrapper">
                    <span><?php echo $child->count; ?></span>
                  </div>
                  <a href="<?php echo get_term_link($child->term_id); ?>"><?php echo $child->name; ?></a>
                </li>
              <?php } ?>
            </ul>
          <?php } ?>

        </div>

        <div class="contact-list">
          

          <h1><?php echo $currentTerm->name; ?></h1>

          <!-- Search -->
          <div id="search" class="search-wrapper">
            <div class="form">
              <div id="searchbar-container">
                <p><?php _e('Αναζήτηση επαφών', 'gov-portal'); ?></p>

                <input type="text" id="filterInput" />

                <button type="submit" form="search-form">
                  <span class="fas fa-search" aria-hidden="true"></span>
                </button>
              </div>
            </div>
          </div>

          <div class="results">
            <?php
            // Start the Loop.
            while ($query->have_posts()) : $query->the_post();

              if (get_the_title()) {
            ?>

                <div class="single-item" data-title="<?php echo get_the_title(); ?>">
                  <div class="left">
                    <?php if (get_field('image')) { ?>
                      <img src="<?php echo get_field('image')["url"]; ?>" alt="contact image">
                    <?php } else { ?>
                      <span class="fas fa-user" aria-hidden="true"></span>
                    <?php  } ?>
                    <div class="details">
                      <h2 class="name">
                        <?php echo get_the_title(); ?></h2>
                      <p class="position"><?php echo get_field('position'); ?></p>
                    </div>
                  </div>

                  <div class="right">
                    <?php if (get_field('email')) { ?>
                      <a href="mailto:<?php echo get_field('email'); ?>" class="entry email"><span class="fas fa-envelope" aria-hidden="true"></span>
                        <p><?php echo get_field('email'); ?></p>
                      </a>
                    <?php } ?>
                    <?php if (get_field('phone')) { ?>
                      <a href="tel:<?php echo get_field('phone'); ?>" class="entry tel"><span class="fas fa-phone" aria-hidden="true"></span>
                        <p><?php echo get_field('phone'); ?></p>
                      </a>
                    <?php } ?>
                    <?php if (get_field('fax')) { ?>
                      <a href="fax:<?php echo get_field('fax'); ?>" class="entry fax"><span class="fas fa-print" aria-hidden="true"></span>
                        <p><?php echo get_field('fax'); ?></p>
                      </a>
                    <?php } ?>
                    <?php if (get_field('address')) { ?>
                      <div class="entry address"><span class="fas fa-map-marked-alt" aria-hidden="true"></span>
                        <p><a href="https://www.google.com/maps/search/?api=1&query=<?php echo get_field('map_location')['lat'] . ',' . get_field('map_location')['lng'] ?>" target="_blank"><?php echo get_field('address'); ?></a></p>
                      </div>
                    <?php } ?>
                  </div>
                </div>



              <?php
              }
            endwhile;

            $args = array(
              'post_type'       => 'contacts',
              'posts_per_page'  => -1,
              'post_status'     => 'publish',
              'orderby'        => 'title',
              'order'          => 'ASC',
              'post__not_in' => $main_posts,
              'tax_query'       => array(
                array(
                  'taxonomy' => 'contact_categories',
                  'field'    => 'slug',
                  'terms'    => $currentTerm->slug
                ),
              ),
            );
            $child_contacts = get_posts($args);
            if ($child_contacts) { ?>

              <hr>
              <?php
              foreach ($child_contacts as $contact) {
                array_push($post_titles, $contact->post_title);
              ?>
                <div class="single-item bottom-list-item" data-title="<?php echo $contact->post_title; ?>">

                  <div class="details">
                    <?php if (get_field('image', $contact->ID)) { ?>
                      <img src="<?php echo get_field('image', $contact->ID)["url"]; ?>" alt="contact image">
                    <?php } else { ?>
                      <span class="fas fa-user" aria-hidden="true"></span>
                    <?php  } ?>
                    <div>
                      <h2 class="name">
                        <?php echo get_the_title($contact->ID); ?></h2>
                      <p class="position"><?php echo get_field('position', $contact->ID); ?></p>
                    </div>
                  </div>
                  <div class="right">
                    <?php if (get_field('email', $contact->ID)) { ?>
                      <a href="mailto:<?php echo get_field('email', $contact->ID); ?>" class="entry email">
                        <!-- <span class="fas fa-envelope"></span> -->
                        <p><?php echo get_field('email', $contact->ID); ?></p>
                      </a>
                    <?php } else { ?>
                      <div></div>
                    <?php }
                    if (get_field('phone', $contact->ID)) { ?>
                      <a href="tel:<?php echo get_field('phone', $contact->ID); ?>" class="entry tel">
                        <!-- <span class="fas fa-phone"></span> -->
                        <p><?php echo get_field('phone', $contact->ID); ?></p>
                      </a>
                    <?php } else { ?>
                      <div></div>
                    <?php }
                    if (get_field('fax', $contact->ID)) { ?>
                      <a href="fax:<?php echo get_field('fax', $contact->ID); ?>" class="entry fax">
                        <!-- <span class="fas fa-print"></span> -->
                        <p><?php echo get_field('fax', $contact->ID); ?></p>
                      </a>
                    <?php } else { ?>
                      <div></div>
                    <?php }
                    if (get_field('address', $contact->ID)) { ?>
                      <div class="entry address">
                        <!-- <span class="fas fa-map-marked-alt"></span> -->
                        <p><a href="https://www.google.com/maps/search/?api=1&query=<?php echo get_field('map_location', $contact->ID)['lat'] . ',' . get_field('map_location', $contact->ID)['lng'] ?>" target="_blank"><?php echo get_field('address', $contact->ID); ?></a></p>
                      </div>
                    <?php } else {
                    ?>
                      <div></div>
                    <?php
                    } ?>
                  </div>
                </div>
            <?php
              }
            }

            ?>


            <script>
              var list = <?php echo json_encode($post_titles); ?>;

              // Get input element
              let filterInput = document.getElementById('filterInput');
              // Add event listener
              filterInput.addEventListener('keyup', filterNames);

              function filterNames() {
                // Get value of input
                let filterValue = document.getElementById('filterInput').value.toUpperCase();

                // Loop through collection-item lis
                for (let i = 0; i < list.length; i++) {
                  // Get single-items
                  var single_items = document.querySelectorAll('.single-item');

                  if (list[i].toUpperCase().indexOf(filterValue) > -1) {
                    for (let o = 0; o < single_items.length; o++) {
                      var item_title = single_items[o].getAttribute('data-title');

                      if (item_title === list[i]) {
                        single_items[o].classList.remove('hide-item');
                      }
                    }
                  } else {
                    for (let j = 0; j < single_items.length; j++) {
                      // Get data-title attribute
                      var item_title = single_items[j].getAttribute('data-title');

                      if (item_title === list[i]) {
                        single_items[j].classList.add('hide-item');
                      }
                    }
                  }
                }

              }
            </script>

          </div>

        </div>

      </div>
    </main>
  </div>
<?php }else{ ?>
  <div id="primary" class="content-area">
    <main id="main" class="site-main">

      <div class="contacts-page">
        <div id="sidebar">

          <?php if ($parentTerm) { ?>
            <a class="parent" href="<?php echo get_term_link($parentTerm->term_id); ?>"><span class="fas fa-long-arrow-alt-left" aria-hidden="true"></span><?php echo $parentTerm->name; ?></a>
          <?php }
          if ($termChilds) { ?>
            <ul class="child-ul">
              <?php foreach ($termChilds as $child) { ?>
                <li class="child-ul-li">
                  <?php
                  $child = get_term($child, 'contact_categories'); ?>
                  <div class="count-wrapper">
                    <span><?php echo $child->count; ?></span>
                  </div>
                  <a href="<?php echo get_term_link($child->term_id); ?>"><?php echo $child->name; ?></a>
                </li>
              <?php } ?>
            </ul>
          <?php } ?>

        </div>

        <div class="contact-list">
          <h1><?php echo $currentTerm->name; ?></h1>
          <div class="results">
            <p style='text-align:center;'><?php _e('Δεν υπάρχουν διαθέσιμες επαφές.'); ?></p>
          </div>
        </div>
      </div>

    </main>
  </div>
<?php } ?>

<?php
get_footer();
