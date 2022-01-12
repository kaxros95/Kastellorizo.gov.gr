<?php
$attachments = get_field('files');
$postAttachments = get_post_meta(get_the_ID())['attachments'];
$postAttachments = json_decode($postAttachments[0]);
$postAttachments = $postAttachments->attachments;

// echo '<pre>';
// var_dump($postAttachments);
// echo '</pre>';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('inner'); ?>>

	<header class="entry-header">
		<?php the_title(sprintf('<h1 class="entry-title">', esc_url(get_permalink())), '</h1>'); ?>
		<?php
		if (!is_page()) :
			if (ICL_LANGUAGE_CODE == 'en') {
				$categories = get_the_category();
				$lastElement = array_pop($categories);
		?>
				<small>Published on <?php the_time('j/m/Y'); ?>, in <?php echo $lastElement->name; ?></small>
			<?php } else {
				$categories = get_the_category();
				$lastElement = array_pop($categories);
			?>
				<small>Αναρτήθηκε στις <?php the_time('j/m/Y'); ?>, στην κατηγορία <?php echo $lastElement->name; ?></small>
		<?php

			}
		endif; ?>


	</header>

	<div class="row">

		<?php $slides = get_field('post_slider_slider'); $showImg = get_field('display_feat_img'); ?>

		<div class="article-content">
			<?php if (has_post_thumbnail() && $showImg) : ?>
				<div class="thumbnail"><?php the_post_thumbnail('full'); ?></div>
			<?php endif; ?>

			<?php if ($slides) { ?>
				<div id="thumbnail" class="single-tab">
					<div class="thumbnail-swiper">
						<div class="swiper thumbnail-swiper-container">
							<div class="swiper-wrapper">
								<!-- Slides -->
								<?php foreach ($slides as $slide) {
									$img = $slide['image']['url'];
									if ($img) {
								?>
										<div class="swiper-slide">
											<img src="<?php echo $img; ?>" alt="Slider image">
										</div>
								<?php
									}
								}
								?>
							</div>

							<!-- Pagination -->
							<div class="swiper-pagination thumbnail-swiper-pagination"></div>

							<!-- Navigation buttons -->
							<div class="swiper-button-prev thumbnail-swiper-button-prev"></div>
							<div class="swiper-button-next thumbnail-swiper-button-next"></div>
						</div>


					</div>



				</div>
			<?php } ?>
			<?php the_content(); ?>
			<!-- Swiper -->
			<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
			<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

			<script>
				/**
				 * Initialize Swiper sliders
				 */

				var thumbnailSlider = new Swiper('.thumbnail-swiper-container', {
					// Parameters
					loop: false,
					slidesPerView: 1,

					pagination: {
						el: '.thumbnail-swiper-pagination',
						clickable: true
					},

					navigation: {
						nextEl: '.thumbnail-swiper-button-next',
						prevEl: '.thumbnail-swiper-button-prev',
					},
				});
			</script>

		</div>


		<?php if ($attachments || $postAttachments) { ?>
			<div class="attachments">

				<?php if (ICL_LANGUAGE_CODE == 'en') { ?>
					<h3>Attachments</h3>
				<?php } else { ?>
					<h3>Επισυναπτόμενα</h3>
				<?php } ?>

				<div class="media">
					<?php
					if ($attachments) {
						foreach ($attachments as $media) {

							if ($media['file_link'] == 'file') {
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
									case 'application/x-rar-compressed':
										$media_icon = $dir . 'rar-file.png';
										break;
									default:
										$media_icon = $dir . 'generic-file.png';
										break;
								}
					?>
								<a class="attachment file" href="<?php echo $media['file']['url']; ?>" target="_blank" title="<?php echo $media['file']['filename']; ?>">
									<img src="<?php echo $media_icon ?>" alt="File icon">
									<p><?php echo $media['file']['filename']; ?> <i class="fas fa-external-link-alt" aria-hidden="true"></i></p>
								</a>
							<?php } elseif ($media['file_link'] == 'link') { ?>
								<a class="attachment link" href="<?php echo $media['link'] ?>" target="_blank" title="<?php echo $media['link']; ?>">
									<i class="fas fa-globe-europe" aria-hidden="true"></i>
									<p><?php echo $media['link']; ?> <i class="fas fa-external-link-alt" aria-hidden="true"></i></p>
								</a>
							<?php } ?>

						<?php }
					} else if ($postAttachments) {
						foreach ($postAttachments as $nativemedia) {
							$mimeType = get_post_mime_type($nativemedia->id);
							$mediaUrl = wp_get_attachment_url($nativemedia->id);
							$mediaTitle = $nativemedia->fields->title;


							$dir = get_stylesheet_directory_uri() . '/assets/file-icons/';

							switch ($mimeType) {
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
								case 'application/x-rar-compressed':
									$media_icon = $dir . 'rar-file.png';
									break;
								default:
									$media_icon = $dir . 'generic-file.png';
									break;
							}
						?>
							<a class="attachment file" href="<?php echo $mediaUrl; ?>" target="_blank" title="<?php echo $mediaTitle; ?>">
								<img src="<?php echo $media_icon ?>" alt="File icon">
								<p><?php echo $mediaTitle; ?> <i class="fas fa-external-link-alt" aria-hidden="true"></i></p>
							</a>
					<?php
						}
					} ?>

				</div>
			</div>
		<?php } ?>


		<div class="share-buttons">

			<p>Share:</p>
			<a target="_blank" class="share-button facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink(); ?>" title="Share on Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i> Facebook</a>
			<?php $useragent=$_SERVER['HTTP_USER_AGENT'];

			if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){ ?>
				<a target="_blank" class="share-button messenger" href="fb-messenger://share/?link=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fsharing%2Freference%2Fsend-dialog&app_id=123456789<?php echo get_the_permalink(); ?>" title="Share on Facebook"><i class="fab fa-facebook-messenger" aria-hidden="true"></i> Messenger</a>
			<?php } ?>
			
			<a class="share-button facebook linkedin" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_the_permalink(); ?>&title=<?php echo the_title(); ?>&source=<?php echo home_url(); ?>" title="Share on Linkedin"><i class="fab fa-linkedin-in" aria-hidden="true"></i> LinkedIn</a>
			<a class="share-button twitter" target="_blank" class="share-button twitter" href="https://twitter.com/intent/tweet?url=<?php echo get_the_permalink(); ?>&text=<?php echo the_title(); ?>&via=<?php the_author_meta('twitter'); ?>" title="Tweet"><i class="fab fa-twitter" aria-hidden="true"></i> Tweet</a>
			<a class="share-button viber" href="viber://forward?text=<?php echo the_title(); ?> <?php echo get_the_permalink(); ?>"><i class="fab fa-viber" aria-hidden="true"></i> Viber</a>
		<!--<a class="share-button whatsapp" href="https://wa.me/?text=<?php echo the_title(); ?> <?php echo get_the_permalink(); ?>"><i class="fab fa-whatsapp" aria-hidden="true"></i> Whatsapp</a>  -->
		</div>

	</div>

</article>