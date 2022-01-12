<?php

/**
 * The Post Categories Template
 */

get_header();

$category = get_queried_object();
// var_dump_pre($category)

// if (substr(get_category_link($category->term_id), -12) == 'koronoios-2/') {
//   $mystyle = 'grid-column: 1/3;';
// }

?>

<section>
  <header class="page-header" style="text-align: center;margin-top: 4rem;margin-bottom: 2rem;">
  <?php get_template_part( 'partials/template-parts/breadcrumbs'); // Displays the breadcrumbs ?>
    <?php if (is_category('Featured')) : ?>
      <h1 class="page-title" style="margin-bottom: 1rem;"><?php _e('Επίκαιρα', 'gov-portal'); ?></h1>
    <?php else : ?>
      <?php if($category->term_id === 496){ ?>
        <h1 class="page-title" style="margin-bottom: 1rem;"><?php _e('Υπηρεσίες', 'gov-portal'); ?> </h1>
      <?php } else {?>
        <h1 class="page-title" style="margin-bottom: 1rem;"><?php echo single_cat_title('', false); ?> </h1>
    <?php } endif;
    // Display optional category description
    if (category_description()) { ?>
      <div class="page-meta">
        <?php //echo category_description();
        if ($category->term_id == 2471) { ?>
          <img class="alignleft wp-image-91811" src="https://www.crete.gov.gr/wp-content/uploads/2020/05/menothmeasfaleis.png" alt="" width="273" height="277" /><img class="alignleft wp-image-90862" src="https://www.crete.gov.gr/wp-content/uploads/2020/03/aimodosia_-1.jpg" alt="" width="269" height="280" /><img class="alignleft wp-image-90649" src="https://www.crete.gov.gr/wp-content/uploads/2020/03/2.jpeg" alt="" width="276" height="274" />
        <?php } ?>
      </div>
    <?php } ?>

  </header>
</section>

<section id="primary">

  <?php get_sidebar('category'); ?>

  <div id="content" role="main" class="site-content" style="<?php echo $mystyle; ?>">
    <?php $attachments = get_field('attachments', $category); ?>
    <div class="page-meta">
      <?php echo category_description();
      if ($category->term_id == 2471) { ?>
        <img class="alignleft wp-image-91811" src="https://www.crete.gov.gr/wp-content/uploads/2020/05/menothmeasfaleis.png" alt="" width="273" height="277" /><img class="alignleft wp-image-90862" src="https://www.crete.gov.gr/wp-content/uploads/2020/03/aimodosia_-1.jpg" alt="" width="269" height="280" /><img class="alignleft wp-image-90649" src="https://www.crete.gov.gr/wp-content/uploads/2020/03/2.jpeg" alt="" width="276" height="274" />
      <?php } ?>
    </div>

    <?php
    if (is_array($attachments) && $attachments[0]['file']) { ?>

      <div class="attachments">
        <?php if (ICL_LANGUAGE_CODE == 'en') { ?>
          <h3>Attachments</h3>
        <?php } else { ?>
          <h3>Επισυναπτόμενα</h3>
        <?php } ?>
        <div class="media" style="margin-bottom:1rem;">

          <?php foreach ($attachments as $media) {
            // var_dump_pre($media);
            if ($media['file']) {
              $dir = get_stylesheet_directory_uri() . '/assets/file-icons/';

              switch ($media['file']['mime_type']) {
                case 'image/x-citrix-jpeg':
                case 'image/jpeg':
                  $media_icon = $dir . 'jpg-file.png';
                  break;
                case 'image/png':
                  $media_icon = $dir . 'png-file.png';
                  break;
                case 'application/msword':
                  $media_icon = $dir . 'docx-file.png';
                  break;
                case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                  $media_icon = $dir . 'docx-file.png';
                  break;
                case 'application/pdf':
                  $media_icon = $dir . 'pdf-file.png';
                  break;
                case 'video/mp4':
                  $media_icon = $dir . 'mp4-file.png';
                  break;
                case 'application/vnd.ms-excel':
                  $media_icon = $dir . 'xlsx-file.png';
                  break;
                default:
                  $media_icon = $dir . 'generic-file.png';
                  break;
              }
          ?>
              <a class="attachment file" href="<?php echo $media['file']['url']; ?>" target="_blank" title="<?php echo $media['file']['filename']; ?>">
                <img src="<?php echo $media_icon ?>" alt="File icon">
                <p><?php echo ($media['title'] ? $media['title'] : $media['file']['title']); ?> <span class="fas fa-external-link-alt" aria-hidden="true"></span></p>
              </a>
            <?php } elseif ($media['file_link'] == 'link') { ?>
              <a class="attachment link" href="<?php echo $media['link'] ?>" target="_blank" title="<?php echo $media['link']; ?>">
                <span class="fas fa-globe-europe" aria-hidden="true"></span>
                <p><?php echo $media['link']; ?> <span class="fas fa-external-link-alt" aria-hidden="true"></span></p>
              </a>
            <?php } ?>

          <?php } ?>

        </div>
      </div>
    <?php } ?>

    <?php

    // Check if there are any posts to display
    if (have_posts()) : ?>

      <?php
      // The Loop
      while (have_posts()) : the_post(); ?>
        <a class="single-item" href=" <?php echo get_permalink() ?> " rel="bookmark" title="Permanent Link to <?php the_title_attribute() ?>">

          <header class="entry-header">
            <small><span class="far fa-calendar-alt" aria-hidden="true"></span><?php the_time('F j, Y') ?></small>
            <h1 class="entry-title"><?php the_title(); ?></h1>
          </header>

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

        </a>


      <?php endwhile;

    else : ?>
      <p><?php //_e('Λυπούμαστε, δεν υπάρχουν δημοσιεύσεις που να ταιριάζουν με τα κριτήριά σας.', 'gov-portal');
          ?></p>
    <?php endif; ?>

    <div id="posts-pagination" class="pagination">
      <?php
      $big = 999999999; // an unlikely integer
      echo paginate_links([
        'base'            => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format'          => '?paged=%#%', # or '/page/%#%'
        'current'         => max(1, get_query_var('paged')),
        // 'total'           => $loop->max_num_pages,
        'prev_text'       => __('<span class="meta-nav">&lt;</span>', 'gov-portal'),
        'next_text'       => __('<span class="meta-nav">&gt;</span>', 'gov-portal'),
      ]);
      ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>