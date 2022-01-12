<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php
		$x = $wp_query->query;
		$maxposts = 10;
		$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
		$posts_query_args = [
			'post_type' 			=> $x['post_type'],
			//'numberposts' 	=> '5',
			'post_parent'			=> 0,
			'posts_per_page' 	=> $maxposts,
			'paged' 					=> $paged,
			'suppress_filters' => false
		];
		$loop = new WP_Query($posts_query_args);
		?>

		<?php if ($loop->have_posts()) : ?>

			<header class="page-header">
				<?php
				// Get the current archive title and display it if it doesn't exist it's from posts
				$archiveTitle = post_type_archive_title('', false) ?? __("Ενημέρωση", 'gov-portal');
				get_template_part( 'partials/template-parts/breadcrumbs'); // Displays the breadcrumbs
				echo '<h1 class="page-title">' . $archiveTitle . '</h1>';
				?>
			</header><!-- .page-header -->

			<?php
			// Start the Loop.
			while ($loop->have_posts()) :
				$loop->the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that
				 * will be used instead.
				 */
				if (get_the_title() !== 'Κορωνοϊός') {

			?>
					<a class="single-item" href=" <?php echo get_permalink() ?> ">
						<?php if(get_post_type() === 'press_releases' || get_post_type() === 'competitions' ){ ?>
						<small><span class="far fa-calendar-alt" aria-hidden="true"></span><?php the_time('F j, Y') ?></small>
						<?php } ?>
						<h2 class="title"><?php echo get_the_title() ?></h2>

						<div class="meta">

							<div class="excerpt"><?php echo  get_words(get_the_excerpt(), 23); ?></div>
							<?php if (ICL_LANGUAGE_CODE == 'en') { ?>
								<p class="read-more">Read more ></p>
							<?php } else { ?>
								<p class="read-more">Περισσότερα ></p>
							<?php } ?>
						</div>
					</a>

		<?php
				}

			// End the loop.
			endwhile;

		// Previous/next page navigation.

		// If no content, include the "No posts found" template.
		else :
			// get_template_part( 'template-parts/content', 'none' );
			echo '<h1>Oops no posts!</h1>';

		endif;
		?>
		<div id="posts-pagination" class="pagination">
			<?php

			$big = 999999999; // an unlikely integer
			echo paginate_links([
				'base'            => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
				'format'          => '?paged=%#%', # or '/page/%#%'
				'current'         => max(1, get_query_var('paged')),
				'total'           => $loop->max_num_pages,
				'prev_text'       => __('<span class="meta-nav">&lt;</span>', 'gov-portal'),
				'next_text'       => __('<span class="meta-nav">&gt;</span>', 'gov-portal'),
			]);
			?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
