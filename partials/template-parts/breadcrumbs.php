<div class="breadcrumbs">
	<?php
	//	if ( function_exists( 'yoast_breadcrumb' ) ) {
	//		echo yoast_breadcrumb( '', '', false );
	//	}
	Component_Breadcrumbs::render( array(
		'theme_location' => 'site-main-menu',
		'separator'      => ' &gt; '
	) );
	?>
</div>