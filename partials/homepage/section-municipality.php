<?php 
$radio_button = get_field('municipality_admin')['municipality_show'];
$municipality_title = get_field('municipality_admin')['municipality_title'];
$municipality_background = get_field('municipality_admin')['municipality_background']['url'];
$municipality_repeater = get_field('municipality_admin')['municipality_list'];
if($radio_button == 'true'):
?>

<section class="municipality" style="background-image:url('<?php echo $municipality_background ?>')">
<div class="inner">
<div class="title">
    <?php echo $municipality_title; ?>
</div>
<div class="links">
    <?php
        if($municipality_repeater){
            foreach($municipality_repeater as $mr){
                if($mr['municipality_internal_or_external'] == 'true'){ ?>
                   <a href="<?php echo $mr['municipality_internal'] ?>" class="inner-link"> <?php echo $mr['municipality_url_text'];  ?> </a>
                <?php }else{ ?>
                    <a href="<?php echo $mr['municipality_external'] ?>" target="_blank" class="inner-link"> <?php echo $mr['municipality_url_text'];  ?> </a>
                <?php } ?>
                
            <?php } ?>
        <?php } ?>
</div>
</div>

</section>
<?php endif; ?>
