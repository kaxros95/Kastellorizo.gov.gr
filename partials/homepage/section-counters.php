<?php 
$counters = get_field('counters');
$radio_button = $counters['show_counters'];
$counter_title = $counters['counter_title'];
$counter_repeater = $counters['counter_repeater'];
if($radio_button == 'true'):
?>



<section class="counters">
    <h2><?php echo $counter_title ?></h2>
    <div class="inner">
            <div class="counters-container">
                <?php foreach($counter_repeater as $cr){ ?>
                    <div class="counters-item">
                        <div class="counters-number"><?php echo $cr['counter_number'] ?></div>
                        <p><?php echo $cr['counter_name']  ?></p>
                    </div>
                <?php  } ?>
            </div>
    </div>
</section>
<?php endif; ?>