<!-- Homepage - Services Center section -->

<?php

$section_title = get_field('home_services')['services_title'];

$args = array(
  'post_type'   => 'services',
  'post_parent' => 0,
  'post_status' => 'publish',
  'numberposts' => -1,
  'suppress_filters' => false

);
$services = get_posts($args);
if ($services) {
?>

  <section class="services">

    <div class="wrapper">

      <h2 class="section-title"><?php echo $section_title; ?></h2>

      <div class="services-grid">

        <?php
        foreach ($services as $service) {
          if ($service->post_title !== 'Κορωνοϊός') {
        ?>
            <div class="box">
              <div class="icon">
                <a href="<?php the_permalink($service->ID); ?>">
                  <?php the_field('FotnAwesome_icon_field', $service->ID); ?>
                </a>
              </div>

              <a href="<?php the_permalink($service->ID); ?>" class="title"><?php echo $service->post_title; ?></a>

              <?php
              $args = array(
                'post_parent' => $service->ID,
                'post_status' => 'publish'
              );
              $serviceChilds = null; //get_children($args);
              if ($serviceChilds) {
              ?>
                <div class="links">
                  <?php foreach ($serviceChilds as $sChild) { ?>
                    <a href="<?php the_permalink($sChild->ID); ?>"><?php echo $sChild->post_title; ?></a>
                  <?php } ?>
                </div>
              <?php } ?>
            </div>
        <?php
          }
        }

        ?>

        <!-- <div class="box">

        <div class="icon">icon</div>
        <p class="title">ΗΛΕΚΤΡΟΝΙΚΑ ΑΙΤΗΜΑΤΑ ΠΟΛΙΤΩΝ</p>


        <div class="links">
        </div>
      </div>

      <div class="box">
        <div class="icon">
          <a href="#">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/services/covid.png" alt="Covid icon">
          </a>
        </div>

        <a href="#" class="title">ΚΟΡΟΝΟΙΟΣ</a>

        <div class="links">
        </div>
      </div>

      <div class="box">

        <div class="icon">icon</div>
        <p class="title">ΠΕΡΙΦΕΡΕΙΑΚΗ ΑΓΡΟΤΙΚΗ ΟΙΚΟΝΟΜΙΑ ΚΑΙ ΚΤΗΝΙΑΤΡΙΚΗ</p>

        <div class="links">
          <a href="#">Διεύθυνση Αγροτικής Οικονομίας & Κτηνιατρικής Περιφερειακών Ενοτήτων</a>
        </div>
      </div>

      <div class="box">

        <div class="icon">icon</div>
        <p class="title">ΑΝΑΠΤΥΞΙΑΚΟΣ ΠΡΟΓΡΑΜΜΑΤΙΣΜΟΣ, ΠΕΡΙΒΑΛΛΟΝΤΟΣ ΚΑΙ ΥΠΟΔΟΜΩΝ</p>

        <div class="links">
          <a href="#">Διεύθυνση Περιβάλλοντος και Χωρικού Σχεδιασμού</a>
          <a href="#">Διεύθυνσεις Τεχνικών Έργων Περιφερειακών Ενοτήτων</a>
        </div>
      </div>

      <div class="box">

        <div class="icon">icon</div>
        <p class="title">ΔΗΜΟΣΙΑ ΥΓΕΙΑ & ΚΟΙΝΩΝΙΚΗ ΜΕΡΙΝΜΝΑ</p>

        <div class="links">
          <a href="#">Διεύθυνση Δημόσιας Υγείας</a>
          <a href="#">Διεύθυνση Κοινωνικής Μέριμνας</a>
          <a href="#">Διεύθυνση Δημόσιας Υγείας και Κοινωνικής Μέριμνας Περιφερειακών Ενοτήτων</a>
        </div>
      </div>

      <div class="box">

        <div class="icon">icon</div>
        <p class="title">ΜΕΤΑΦΟΡΕΣ ΚΑΙ ΕΠΙΚΟΙΝΩΝΙΑ</p>

        <div class="links">
          <a href="#">Δ/νσεις Μεταφορών & Επικοινωνιών Περιφερειακών Ενοτήτων</a>
        </div>
      </div>

      <div class="box">

        <div class="icon">icon</div>
        <p class="title">ΑΝΑΠΤΥΞΗ</p>

        <div class="links">
          <a href="#">Διευθύνσεις Ανάπτυξης Περιφερειακών Ενοτήτων</a>
        </div>
      </div>

      <div class="box">

        <div class="icon">icon</div>
        <p class="title">ΕΣΩΤΕΡΙΚΗ ΛΕΙΤΟΥΡΓΙΑ</p>

        <div class="links">
          <a href="#">Διεύθυνση Διοίκησης</a>
          <a href="#">Διεύθυνση Οικονομικού</a>
        </div>
      </div> -->

      </div>

    </div>

  </section>
<?php } ?>