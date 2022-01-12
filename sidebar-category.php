<?php

/**
 * Sidebar for POSTS CPT archive
 */
$cats = get_categories(array(
  'parent'  =>  0,
));
$category = get_queried_object();
$cats=get_categories(
  array( 'parent' => $category->cat_ID,'hide_empty' => false )
);
// var_dump_pre($category);

if (substr(get_category_link($category->term_id), -12) == 'koronoios-2/') {
  $covidPage = true;
} else {
  $covidPage = false;
}

//if (!$covidPage) {
?>
  <ul id="sidebar" style="margin-top: 0px;">
    <li class="parent">
      <?php 
      if($category->parent === 496 || $category->parent === 442){ # get the archive link of services instead of "Θέλω να εξυπηρετηθώ" or "οργανωτική δομή" category ?>
        <a href="<?php echo get_post_type_archive_link('services'); ?>">&larr; <?php _e('Υπηρεσίες', 'gov-portal'); ?></a>
      <?php }else if($category->parent !=0){ ?>
        <a href="<?php echo get_category_link($category->parent); ?>">&larr; <?php echo get_cat_name($category->parent); ?></a>
      <?php } ?>
    </li>
    <?php
    foreach ($cats as $cat) {
    ?>
      <li>
        <a class="second" href="<?php echo get_category_link($cat->term_id); ?>"> <?php echo $cat->name; ?> </a>
        <?php
        $children = get_terms($cat->taxonomy, array(
          'parent'    => $cat->term_id,
          'hide_empty' => false
        ));
        if ($children) {
        ?>
          <ul class="child childs lvl-2-wrapper">
            <?php
            foreach ($children as $child) {
            ?>
              <li class="lvl-2">
                <a href="<?php echo get_category_link($child->term_id); ?>"> <?php echo $child->name; ?> </a>
                <?php
                $grandchildren = get_terms($child->taxonomy, array(
                  'parent'    => $child->term_id,
                  'hide_empty' => false
                ));
                if ($grandchildren) {
                ?>
                  <ul class="child grand-childs">
                    <?php
                    foreach ($grandchildren as $grandchild) {
                    ?>
                      <li><a href="<?php echo get_category_link($grandchild->term_id); ?>"> <?php echo $grandchild->name; ?> </a></li> <!-- Third & Last Child -->
                    <?php
                    }
                    ?>
                  </ul>
                <?php
                }
                ?>
              </li> <!-- END OF Second Child -->
            <?php
            }
            ?>
          </ul>
        <?php
        }

        ?>

      </li> <!-- END OF FIRST Child -->
    <?php
    }
    ?>
  </ul>

<?php //} ?>

<script>
  var acc = document.getElementsByClassName("second");
  var i;

  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("mouseover", function() {
      if (this.nextElementSibling) {
        var panel = this.nextElementSibling;
        panel.style.display = "block";
      }
    });
  }

  document.getElementById('sidebar').addEventListener('mouseleave', function() {
    var ul = document.getElementsByClassName("lvl-2-wrapper");

    for (var i = 0; i < ul.length; i++) {
      ul[i].style.display = 'none';
    }
  })
</script>