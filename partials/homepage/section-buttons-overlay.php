<?php 
// Buttons
$display_section = get_field('home_hero')['hero_show_hide'];
$display_buttons = get_field('home_hero')['hero_buttons']['hero_buttons_display'];
$left_button = get_field('home_hero')['hero_buttons']['left_button'];
$middle_button = get_field('home_hero')['hero_buttons']['middle_button'];
$right_button = get_field('home_hero')['hero_buttons']['right_button'];

?>
<section class="buttons">
<div class="inner">
    <!-- <div class="hero-header">
    <div class="title"><?php echo $section_title; ?></div>

    <div class="text"><?php echo $section_text; ?></div>
    </div> -->

    <?php if ($display_buttons) { ?>
    <div class="cta-boxes">

        <?php if ($left_button['button_show']) { ?>
        <a target="_block" href="<?php echo $left_button['button_link']; ?>" class="box" style="background-color: <?php echo $left_button['button_color']; ?>">
            <img src="<?php echo $left_button['button_icon']; ?>" alt="Call to action image" class="icon">
            <div class="box-details">
            <div class="box-title"><?php echo $left_button['button_title']; ?></div>
            <hr>
            <div class="box-text"><?php echo $left_button['button_text']; ?></div>
            </div>
        </a>
        <?php } ?>

        <?php if ($middle_button['button_show']) { ?>
        <a target="_block" href="<?php echo $middle_button['button_link']; ?>" class="box" style="background-color: <?php echo $middle_button['button_color']; ?>">
            <img src="<?php echo $middle_button['button_icon']; ?>" alt="Call to action image" class="icon">
            <div class="box-details">
            <div class="box-title"><?php echo $middle_button['button_title']; ?></div>
            <hr>
            <div class="box-text"><?php echo $middle_button['button_text']; ?></div>
            </div>
        </a>
        <?php } ?>

        <?php if ($right_button['button_show']) { ?>
        <a target="_block" href="<?php echo $right_button['button_link']; ?>" class="box" style="background-color: <?php echo $right_button['button_color']; ?>">
            <img src="<?php echo $right_button['button_icon']; ?>" alt="Call to action image" class="icon">
            <div class="box-details">
            <div class="box-title"><?php echo $right_button['button_title']; ?></div>
            <hr>
            <div class="box-text"><?php echo $right_button['button_text']; ?></div>
            </div>
        </a>
        <?php } ?>

    </div>
    <?php } ?>

</div>
</section>