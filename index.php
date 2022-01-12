<?php get_header(); ?>
<div class="container-fluid">

	<div class="container">

		<div class="row grid">

				<?php
				if ( have_posts() ) : while ( have_posts() ) : the_post();
				?>
					<div class="col-sm-8 blog-main index">
						<?php get_template_part( 'partials/template-parts/breadcrumbs'); // Displays the breadcrumbs ?>
						<?php get_template_part( 'partials/template-parts/content', 'post'); ?>
					</div> <!-- /.blog-main -->
				<?php endwhile; endif;
				?>
			
		</div> <!-- /.row -->

	</div>	<!-- /.container -->

</div>	<!-- /.container-fluid -->
<?php get_footer(); ?>