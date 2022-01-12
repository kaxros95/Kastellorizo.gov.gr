<!-- Homepage - Contact section -->

<?php

$section_title = get_field('home_contact')['contact_title'];
$section_bg = get_field('home_contact')['contact_background_image'];
$radio_button = get_field('home_contact')['contact_show_hide'];
$upper_section = get_field('home_contact')['contact_upper_section'];
$upper_section_title = $upper_section['title'];
$upper_section_image = $upper_section['image'];
$upper_section_email = $upper_section['email'];
$upper_section_name = $upper_section['name'];
$upper_section_tel = $upper_section['phone'];
$upper_section_buttons = $upper_section['home_upper_section_buttons'];

$lower_section = get_field('home_contact')['contact_lower_section'];
$lower_section_title = $lower_section['title'];
$lower_section_image = $lower_section['image'];
$lower_section_tel = $lower_section['telephone'];
$lower_section_email = $lower_section['email'];
$lower_section_buttons = $lower_section['home_lower_section_buttons'];

$lower_section_social_show_social= $lower_section['social_networks']['show_social'];

$lower_section_social_networks_facebook_show = $lower_section['social_networks']['show_facebook'];
$lower_section_social_networks_facebook = $lower_section['social_networks']['facebook'];
$lower_section_social_networks_facebook_url = $lower_section['social_networks']['facebook_url'];

$lower_section_social_networks_twitter_show = $lower_section['social_networks']['show_twitter'];
$lower_section_social_networks_twitter = $lower_section['social_networks']['twitter'];
$lower_section_social_networks_twitter_url = $lower_section['social_networks']['twitter_url'];

$lower_section_social_networks_instagram_show = $lower_section['social_networks']['show_instagram'];
$lower_section_social_networks_instagram = $lower_section['social_networks']['instagram'];
$lower_section_social_networks_instagram_url = $lower_section['social_networks']['instagram_url'];
if($radio_button == 'true'):
?>

<section class="contact" style="background-image:url(<?php echo $section_bg; ?>)">

  <div class="bg-overlay"></div>
  <div class="inner">
    <h2 class="section-title"><?php echo $section_title; ?></h2>
    <div class="content">
      <div class="leftcol">
        <h5 class="section-sub-title">
          <?php echo $upper_section_title; ?></h5>
        <div class="leftcol-inner">
          <img src="<?php echo $upper_section_image; ?>" alt="Portrait of Regional Governor" class="circle">
          <?php if (ICL_LANGUAGE_CODE == 'en') {
            $tel_text = 'Telephone: ';
          } else {
            $tel_text = 'Τηλέφωνο: ';
          }
          ?>
          <div class="info">
            <p><?php echo $upper_section_name ?></p>

            <p><?php echo $tel_text; ?><a
                href="tel:<?php echo $upper_section_tel; ?>"><?php echo $upper_section_tel; ?></a></p>
            <p>Email: <?php echo $upper_section_email;?> </p>
          </div>

        </div>
        <div class="flex">
          <?php if ($upper_section_buttons && count($upper_section_buttons) > 0) { ?>

          <?php foreach ($upper_section_buttons as $key => $value) { ?>
          <a target="_blank" href="<?php echo $value['link']; ?>" class="btn"><?php echo $value['text']; ?></a>
          <?php } ?>

          <?php } ?>
        </div>
      </div>

      <div class="rightcol">
        <h5 class="section-sub-title">
          <?php echo $lower_section_title ?></h5>
        <div class="rightcol-inner">
          <img src="<?php echo $lower_section_image; ?>" alt="municipality" class="circle">
          <?php if (ICL_LANGUAGE_CODE == 'en') {
            $tel_text = 'Telephone: ';
          } else {
            $tel_text = 'Τηλέφωνο: ';
          }
          ?>
          <div class="info">
          <p><?php echo $tel_text; ?><?php echo $lower_section_tel; ?></p>
           <p>Email: <?php echo $lower_section_email;?> </p>
          </div>

        </div>
         <div class="flex">
          <?php if ($lower_section_buttons && count($lower_section_buttons) > 0) { ?>

          <?php foreach ($lower_section_buttons as $key => $value) { ?>
          <a href="<?php echo $value['link']; ?>" class="btn"><?php echo $value['text']; ?></a>
          <?php } ?>

          <?php } ?>
        </div>
      </div>
      </div>
    </div>
  </div>
<?php if($lower_section_social_show_social == "true"): ?>
  <div class="socials">
    <p> Κοινωνικά δίκτυα: </p>

    <?php if($lower_section_social_networks_facebook_show == "true"): ?>
    <a href="<?php echo $lower_section_social_networks_facebook_url ?>" target="_blank">
      <?php echo $lower_section_social_networks_facebook  ?>
    </a>
    <?php endif; ?>

    <?php if($lower_section_social_networks_twitter_show == "true"): ?>
    <a href="<?php echo $lower_section_social_networks_twitter_url ?>" target="_blank">
      <?php echo $lower_section_social_networks_twitter  ?>
    </a>
    <?php endif; ?>

    <?php if($lower_section_social_networks_instagram_show == "true"): ?>
    <a href="<?php echo $lower_section_social_networks_instagram_url ?>" target="_blank">
      <?php echo $lower_section_social_networks_instagram  ?>
    </a>
    <?php endif; ?>
  </div>
  <?php endif;?>

  </div>
</section>

<?php endif; ?>