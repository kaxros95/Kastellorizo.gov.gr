<?php

class Component_Attachments {

	protected static $params = [
		'postID' => null
	];

	public static function get_render( $params = [] ) {
		$options = wp_parse_args( $params, self::$params );
		ob_start();
		$attachments = new Attachments( 'attachments', $options['postID'] );
		if ( $attachments->exist() ) :
			$total = $attachments->total();
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
						<?php while ( $attachment = $attachments->get() ) :
							$type = $attachments->subtype();
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
								case 'x-citrix-jpeg':
									$type = 'jpg';
									break;
								case 'x-rar-compressed':
									$type = 'rar';
									break;
								default:
									$type = $attachments->subtype();
							}
							?>
							<div class="grid__item <?php echo $col_class; ?>">
								<div class="attachments__item">
									<div class="zmdi zmdi-file">
										<div class="attachments__item__type">
											.<?php MOZ_Utils::upper( $type ); ?>
										</div>
									</div>
									<div class="attachments__item__name">
										<?php echo $attachments->field( 'title' ); ?>
									</div>
									<span class="zmdi zmdi-download"></span>
									<a href="<?php echo $attachments->url(); ?>"
									   title="<?php echo $attachments->field( 'title' ); ?>"
									   target="_blank"></a>
								</div>
								<?php
								$button_url = $attachments->field( 'button_url' );
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
						<?php endwhile; ?>
					</div>
				</div>
			</div>
			<?php
		endif;

		return ob_get_clean();
	}

	public static function render( $params = [] ) {
		echo self::get_render( $params );
	}
}
