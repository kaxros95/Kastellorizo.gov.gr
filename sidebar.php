<?php

/**
 * Sidebar for all cpts with childs
 * can be used for pages that have childs too
 */

$childrenExistFlag = false;

$args = array(
  'post_parent' => get_the_ID(), // Current post's ID
);
$children = get_children($args);

// Check if the post has any child
if (!empty($children)) {
  // The post has at least one child
  $childrenExistFlag = true;
}

if ($post->post_parent == 0 || $childrenExistFlag) {
  $args = array(
    'post_parent' => $post->ID,
    'post_type'   => $post->post_type,
    'numberposts' => -1,
    'post_status' => 'publish',
    'suppress_filters' => false
  );
} else {
  $args = array(
    'post_parent' => $post->post_parent,
    'post_type'   => $post->post_type,
    'numberposts' => -1,
    'post_status' => 'publish',
    'suppress_filters' => false
  );
}
$children = get_children($args);


if ((get_post_type() == 'services' || get_post_type() == 'municipality' || get_post_type() == 'activities' || get_post_type() == 'guide')) {
?>
  <ul id="sidebar">
    <?php
    if ($childrenExistFlag) {
      if ((get_the_title($post->post_parent) != $post->post_title)) {
    ?>
        <li class="first"><a href="<?php echo get_permalink($post->post_parent) ?>"> <?php echo get_the_title($post->post_parent); ?> </a></li>
      <?php
      } ?>
      <ul class="child childs">
        <?php
        $args = array(
          'post_parent' => $post->post_parent,
          'post_type'   => $post->post_type,
          'numberposts' => -1,
          'post__not_in' => array(756),
          'post_status' => 'publish',
          'suppress_filters' => false
        );
        // Finds where to cut the repetition to put the children of the current post
        $cut_id = $post->ID;

        $levels = get_children($args);

        foreach ($levels as $level) {
          $args = array(
            'post_parent' => $level->ID,
            'post_type'   => $level->post_type,
            'numberposts' => -1,
            'post_status' => 'publish',
            'suppress_filters' => false
          );

          $children = get_children($args);

          if (count($children) > 0) {
            $hasChild = 'hasChild';
          }else{
            $hasChild = '';
          }

          $activeClass = '';
          if ($cut_id === $level->ID) {
            $activeClass = 'active';
          }

        ?>

          <a class="parent lvl-1 <?php echo $activeClass; ?> <?php echo $hasChild; ?>" href="<?php echo get_permalink($level->ID); ?>"> <?php echo $level->post_title; ?></a>
          <?php
          // if ($cut_id === $level->ID) {
          ?>
          <ul class="child grand-childs lvl-2-wrapper">

            <?php


            foreach ($children as $child) {
            ?>
              <a class="lvl-2" href="<?php echo get_permalink($child->ID); ?>"> <?php echo $child->post_title; ?> </a>
            <?php
            }
            ?>
          </ul>
        <?php } ?>

      </ul>
    <?php
    } else {
      $args = array(
        'post_parent' => $post->post_parent,
        'post_type'   => $post->post_type,
        'numberposts' => -1,
        'post__not_in' => array(756),
        'post_status' => 'publish',
        'suppress_filters' => false
      );
      // Finds where to cut the repetition to put the children of the current post
      $cut_id = $post->ID;
      $levels = get_children($args);


      if ($post->post_parent > 0) {
        $dontShow = "";
      } else {
        $dontShow = "display: none;";
      }
    ?>
      <li class="parent" style="<?php echo $dontShow; ?>"><a href="<?php echo get_permalink($post->post_parent); ?>"> <?php echo get_the_title($post->post_parent); ?> </a></li>
      <ul class="child childslvl-2">

        <?php
        foreach ($levels as $level) {
          $activeClass = '';
          if ($cut_id === $level->ID) {
            $activeClass = 'active';
          }
        ?>
          <a class='second <?php echo $activeClass; ?>' style="line-height: 1.3; font-weight: bold;" href="<?php echo get_permalink($level->ID); ?>"><?php echo $level->post_title; ?></a>
            <!-- <li class="second <?php //echo $activeClass; ?>"><a style="line-height: 1.3; font-weight: bold;" href="<?php //echo get_permalink($level->ID); ?>"> <?php //echo $level->post_title; ?> </a></li> -->
          
        <?php } ?>



      </ul>
    <?php } ?>

  </ul>

<?php  } ?>

<script>
  var acc = document.getElementsByClassName("lvl-1");
  var i;

  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("mouseover", function() {
      // this.classList.toggle("active");
      var panel = this.nextElementSibling;
      panel.style.display = "block";
    });
  }

  document.getElementById('sidebar').addEventListener('mouseleave', function() {
    var ul = document.getElementsByClassName("lvl-2-wrapper");

    for (var i = 0; i < ul.length; i++) {
      ul[i].style.display = 'none';
    }
  })
</script>