<?php get_header(); ?>
<div class="container-fluid">

	<div class="container">
	<?php get_template_part( 'partials/template-parts/breadcrumbs');  // Displays the breadcrumbs ?>
	
		<div class="row grid">

			<?php
			$notInclude = ['post', 'page','press_releases', 'competitions', 'jobs','apofasis' ];
			if (have_posts()) : while (have_posts()) : the_post();
			?>
					<?php if (!in_array(get_post_type(get_the_ID()), $notInclude)) { ?>
						<div class="col-sm-4 single-sidebar">
							<?php get_sidebar(); ?>
						</div>
					<?php } ?>

					<div class="col-sm-8 blog-main index">
						<?php 
						
						get_template_part('partials/template-parts/content', get_post_type(get_the_ID())); ?>
					</div> <!-- /.blog-main -->

			<?php endwhile;
			endif;
			?>

		</div> <!-- /.row -->

	</div> <!-- /.container -->

</div> <!-- /.container-fluid -->
<?php get_footer(); ?>