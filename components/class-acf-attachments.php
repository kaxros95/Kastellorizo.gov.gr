<?php

class Component_Acf_Attachments {

	protected static $params = [
		'key'   => null,
		'field' => null
	];

	public static function get_render( $params = [] ) {
		$options = wp_parse_args( $params, self::$params );
		ob_start();

		$key         = $options['key'];
		$field       = $options['field'];
		$attachments = $key ? get_field( $key ) : $field;

		if ( $attachments ) :
			$total = count( $attachments );
			switch ( $total ) {
				case 2:
					$col_class = 'tab--one-half lap--one-half';
					break;
				default:
					$col_class = 'tab--one-half lap--one-third desk--one-quarter';
			}
			?>
			<div class="attachments">
				<div class="attachments__inner">
					<div class="grid">
						<?php foreach ( $attachments as $index => $attachment ) :
							$title = $attachment['title'];
							$file = $attachment['file'];
							if ( $file ) :
								$filename = $file['filename'];
								$type = self::get_file_type_from_name( $filename );
								$title_string = $title ? $title : $file['title'];
								switch ( $type ) {
									case 'msword':
										$type = 'doc';
										break;
									case 'vnd.openxmlformats-officedocument.wordprocessingml.document':
										$type = 'docx';
										break;
									case 'vnd.ms-excel':
										$type = 'xls';
										break;
									case 'x-rar-compressed':
										$type = 'rar';
										break;
									case 'x-citrix-jpeg':
										$type = 'jpg';
										break;
								}
								?>
								<div class="grid__item <?php echo $col_class; ?>">
									<div class="attachments__item">
										<div class="zmdi zmdi-file">
											<div class="attachments__item__type">
												<?php if ( $type ) : MOZ_Utils::upper( '.' . $type ); endif; ?>
											</div>
										</div>
										<div class="attachments__item__name">
											<?php echo $title_string; ?>
										</div>
										<span class="zmdi zmdi-download"></span>
										<a href="<?php echo $file['url']; ?>"
										   title="<?php echo $title_string; ?>"
										   target="_blank"></a>
									</div>
									<?php
									$button_url = $attachment['button_url'];
									if ( $button_url ) :
										?>
										<div class="attachments__btn">
											<?php
											Component_Link::render( [
												'field' => [
													'type'        => 'external',
													'button_name' => __( 'Online αίτηση', 'cre001' ),
													'button_page' => '',
													'button_url'  => $button_url,
												],
												'class' => 'btn-blue'
											] );
											?>
										</div>
										<?php
									endif;
									?>
								</div>
								<?php
							endif;
						endforeach;
						?>
					</div>
				</div>
			</div>
			<?php
		endif;

		return ob_get_clean();
	}

	private static function get_file_type_from_name( $name ) {
		$array       = explode( '.', $name );
		$count_array = count( $array );
		$key         = $count_array - 1;
		if ( $key >= 0 ) {
			return $array[ $key ];
		}

		return false;
	}

	public static function render( $params = [] ) {
		echo self::get_render( $params );
	}
}
