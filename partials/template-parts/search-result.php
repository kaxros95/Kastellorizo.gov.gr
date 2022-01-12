<?php

/**
 * The template part for displaying results in search pages. Called by search.php
 */
?>
<?php $allowDate = ['competitions', 'press_releases', 'post']; ?>
<a class="single-item search-result" href=" <?php echo get_permalink() ?> ">
	<?php if(in_array(get_post_type(), $allowDate)){ ?>
		<small><i class="far fa-calendar-alt" aria-hidden="true"></i> <?php the_time('F j, Y') ?></small>
	<?php } ?>
	<h2 class="title"><?php echo get_the_title() ?></h2>

	<div class="meta">
		<?php //echo get_post_type(); ?>
		
		<div class="excerpt"><?php echo  get_words(get_the_excerpt(), 23); ?></div>
		<?php if (ICL_LANGUAGE_CODE == 'en') { ?>
			<p class="read-more">Read more ></p>
		<?php } else { ?>
			<p class="read-more">Περισσότερα ></p>
		<?php } ?>
	</div>
</a>