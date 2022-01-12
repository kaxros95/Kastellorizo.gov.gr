<?php

/**
 * The template for displaying 404 pages (Not Found)
 *
 */

get_header(); ?>
<style>
.page-wrapper .notfound-text{
	text-align:center;
	font-size:20px;	
	color:#3a3e70;
	font-weight:bold;
	
}
.page-wrapper .image{
	text-align:center;
	max-height: 100%;
}
.page-wrapper .image img{
	width:50%;
	max-width:100%;
	height:auto;
}
</style>
<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

		<div class="page-wrapper">

			<div class="image">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/megisti-_404.png" alt="Page not found">
			</div>
			<p class="notfound-text"><?= _e('Η σελίδα δεν βρέθηκε','gov-portal') ?></p>

		</div><!-- .page-wrapper -->

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>