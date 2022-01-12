<?php

class Component_Link {

	protected static $params = [
		'field' => null, // key of your acf field
		'class' => null,
		'icon'  => null, // http://zavoloklom.github.io/material-design-iconic-font/cheatsheet.html
	];

	public static function get_render( $params = [] ) {
		$options = wp_parse_args( $params, self::$params );

		ob_start();

		$field = $options['field'];

		$type     = $field['type'];
		$btn_name = $field['button_name'];
		$btn_url  = $field['button_url'];
		$btn_page = $field['button_page'];

		$link_url = $btn_url;
		$target   = '';
		$rel      = '';
		if ( $type == 'external' ) {
			$target = ' target="_blank"';
			$rel    = ' rel="nofollow"';
		} else if ( $type == 'page' ) {
			$link_url = $btn_page;
		}
		$link_class = $options['class'] ? ' class="' . $options['class'] . '"' : '';
		if ( $btn_name && $link_url ) :
			?>
			<a href="<?php echo $link_url; ?>" title="<?php echo $btn_name; ?>"
				<?php echo $link_class; ?><?php echo $target; ?><?php echo $rel; ?>
			><span class="text"><?php MOZ_Utils::upper( $btn_name ); ?></span><?php if ( $options['icon'] ) : ?><span
					class="zmdi zmdi-<?php echo $options['icon']; ?>"></span>
				<?php endif; ?></a>
			<?php
		endif;

		return ob_get_clean();
	}

	public static function render( $params = [] ) {
		echo self::get_render( $params );
	}
}