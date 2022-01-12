<?php

class Component_Breadcrumbs {

	protected static $params = [
		'theme_location' => null,
		'separator'      => ' &gt; '
	];

	public static function get_render( $params = [] ) {
    $options = wp_parse_args( $params, self::$params );
    
		ob_start();

    $items = wp_get_nav_menu_items( $options['theme_location'] );
    
		if ( $items ) :
			_wp_menu_item_classes_by_context( $items ); // Set up the class variables, including current-classes
      $crumbs = array();
			foreach ( $items as $item ) {
				if ( ($item->current_item_ancestor || $item->current) && $item->post_title != "[Tabs]" ) {
					$output = '<a href="' . $item->url . '" rel="v:url" property="v:title">' . $item->title . '</a>';
					if ( $item->url === '' || $item->url === '#' || $item->current ) {
						$output = '<span>' . $item->title . '</span>';
					}
					$crumbs[] = $output;
				}
			}

			if ( empty( $crumbs ) ) {
				if ( function_exists( 'yoast_breadcrumb' ) ) {
          $test = yoast_breadcrumb( '', '', false );
          $test = str_replace('Θέλω να Εξυπηρετηθώ', 'Υπηρεσίες', $test);
          $test = str_replace('category/thelo-na-eksypiretitho/', 'services/', $test);


          // $test = str_replace('category/i-perifereia/organotiki-domi/', 'services/', $test);
          $test = preg_replace('/category\/i-perifereia\/organotiki-domi\//', 'services/', $test, 1);
          // $test = str_replace('category/i-perifereia/', 'region/i-perifereia/', $test);
          $test = preg_replace('/category\/i-perifereia\//', 'region/i-perifereia/', $test, 1);
          $test = str_replace('Οργανωτική Δομή', 'Υπηρεσίες', $test);
          
          echo $test;
				}
				// this is a parent page so just add the page title on breadcrumbs
				// $crumbs[] = '<span>' . get_the_title() . '</span>';
			} else {
				echo '<span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb">';
				echo '<a href="' . get_home_url() . '" rel="v:url" property="v:title">' . __( 'Αρχική', 'gov-portal' ) . '</a>' . $options['separator'];
				echo '<span rel="v:child" typeof="v:Breadcrumb">';
				echo implode( $options['separator'], $crumbs );
				echo '</span></span></span>';
			}

		endif;

		return ob_get_clean();
	}

	public static function render( $params = [] ) {
		echo self::get_render( $params );
	}
}
