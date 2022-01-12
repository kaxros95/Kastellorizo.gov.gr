<?php

/**
 * Get selected crowdapps
 **/
$crowdapps_selected = get_field('footer_crowdapps', 'option')['crowdapps'];
$socialLinks = get_field('social_links', 'option');


/**
 * Prepare crowdapps details
 **/
$crowdapps = array(
  "crowd-participation" => [
    "id"   => "crowd-participation",
    "text" => "Crowd Participation",
    "icon" => "/assets/crowdapps/participation.png",
    "url"  => "http://hello.crowdapps.net/participation-kastelorizo/",
  ],
  "chat-bot" => [
    "id"   => "chat-bot",
    "text" => "Chatbot",
    "icon" => "/assets/crowdapps/chatbot.png",
    "url"  => "https://www.kastellorizo.gov.gr/psifiakos-voithos-tou-dimou-megistis/",
  ],
  "project-maps" => [
    "id"   => "project-maps",
    "text" => "Project@maps",
    "icon" => "/assets/crowdapps/projectatmaps.png",
    "url"  => "https://egov.crowdapps.net/cityworks-kastelorizo/",
  ],
  "city-on" => [
    "id"   => "city-on",
    "text" => "Mobile App",
    "icon" => "/assets/crowdapps/cityon.svg",
    "url"  => "https://www.cityon.gr",
  ]
);

?>
<script>
(function(d) {
  var s = d.createElement("script");
  s.setAttribute("data-account", "b9UWWxodU8");
  s.setAttribute("src", "https://cdn.userway.org/widget.js");
  (d.body || d.head).appendChild(s);
})(document)
</script>
<noscript>Please ensure Javascript is enabled for purposes of <a href="https://userway.org">website accessibility</a></noscript>


</main>

<?php 
// Up Menu
$footer = get_field('home_footer','option');
$footer_picture = $footer['footer_picture']['url'];
$footer_repeater = $footer['footer_menu'];

//Down Menu
$down_footer = $footer['footer_menu_down'];
?>
<footer class="main">
  <div class="logo-wrapper">
    <a href="<?php echo site_url() ?>">
      <img src="<?php echo $footer_picture ?>" alt="Menemeni logo" class="logo">
    </a>
  </div>
  <section class="content">
    <div class="left">
      <ul class="menu">
        <?php 
        if($footer_repeater){
          foreach($footer_repeater as $fr){ 
            if($fr['menu_internal_or_external'] == 'true'){ ?>
        <li> > <a href="<?php echo $fr['menu_internal']?>"><?php _e($fr['menu_title'], 'gov-portal'); ?></a></li>
        <?php }else{ ?>
        <li> > <a href="<?php echo $fr['menu_external']?>"
            target="_blank"><?php _e($fr['menu_title'], 'gov-portal'); ?></a></li>
        <?php } ?>
        <?php } ?>
        <?php if(count($footer_repeater) > 4 && $down_footer > 0){
            echo "<hr class='footer-hr'>";
            foreach($down_footer as $df){ 
              if($df['footer_menu_down_internal_or_external'] == 'true'){ ?>
        <li><a
            href="<?php echo $df['footer_menu_down_internal']?>"><?php _e($df['footer_menu_down_title'], 'gov-portal'); ?></a>
        </li>
        <?php }else{ ?>
        <li><a href="<?php echo $df['footer_menu_down_external']?>"
            target="_blank"><?php _e($df['footer_menu_down_title'], 'gov-portal'); ?></a></li>
        <?php } ?>
        <?php } ?>
        <?php } ?>
        <?php } ?>
        <!-- <li class="social-media-label"><?php _e('KOIΝΩΝΙΚΑ ΔΙΚΤΥΑ', 'gov-portal'); ?></li>
        <li class="social-media">
          <?php if ($socialLinks['facebook_profile']) { ?>
            <a href="<?php echo $socialLinks['facebook_profile']; ?>" target="_blank"><span class="fab fa-facebook-f"></span></a>
          <?php }
          if ($socialLinks['twitter_profile']) { ?>
            <a href="<?php echo $socialLinks['twitter_profile']; ?>" target="_blank"><span class="fab fa-twitter"></span></a>
          <?php }
          if ($socialLinks['youtube_profile']) { ?>
            <a href="<?php echo $socialLinks['youtube_profile']; ?>" target="_blank"><span class="fab fa-youtube"></span></a>
          <?php }
          if ($socialLinks['linkedin_profile']) { ?>
            <a href="<?php $socialLinks['linkedin_profile']; ?>" target="_blank"><span class="fab fa-linkedin-in"></span></a>
          <?php }
          if ($socialLinks['flickr_profile']) { ?>
            <a href="<?php echo $socialLinks['flickr_profile']; ?>" target="_blank"><span class="fab fa-flickr"></span></a>
          <?php } ?>
        </li> -->
        <!-- <li><a href="#">SITE MAP</a></li> -->
      </ul>
    </div>

    <div class="right">
      <?php if (ICL_LANGUAGE_CODE == 'el') { ?>
      <h5 class="title">Ψηφιακή Εργαλειοθήκη</h5>
      <?php }else{ ?>
      <h5 class="title">DIGITAL TOOLKIT</h5>
      <?php } ?>

      <div class="crowdapps-wrapper">

        <?php
        foreach ($crowdapps_selected as $s_key => $s_value) { // Get each selected crowdapp
          
          foreach ($crowdapps as $key => $value) { // For each selected crowdapp, loop all crowdapps
            if ($key == $s_value) { // Check if selected is in all crowdapps 
              
        ?>
        <a target="_blank" href="<?php echo $value['url'] ?>" class="crowdapp">
          <img src="<?php echo get_template_directory_uri(); ?><?php echo $value['icon'] ?>" alt="Crowdapp logo">
          <p><?php echo $value['text'] ?></p>
        </a>
        <?php
            }
          }
        }
        ?>

      </div>



    </div>
  </section>

  <div class="copyright-wrapper">
    <div class="container">
      <div>
        <a href="<?php echo get_home_url();?>/privacy-policy-2/"><?php _e('Όροι Χρήσης και Πολιτική Απορρήτου','gov-portal');?></a>
        <div class="co-financed-images">
          <?php 
          if( have_rows('home_footer','option') ):

              while( have_rows('home_footer','option') ) : the_row();

                    if( have_rows('co_financed') ):

                      while( have_rows('co_financed') ) : the_row();

                          $photo = get_sub_field('co_financed_image');
        ?>
          <img src="<?= $photo ?>" alt="co-financed logo">
          <?php
                      endwhile;
                  endif;
                  
              endwhile;

          endif;
        
        ?>
        </div>
      </div>
      <div class="right">
        <a href="https://crowdpolicy.com" target="_blank">
          <p><?php _e('Σχεδιασμός και υλοποίηση από την CrowdPolicy', 'gov-portal'); ?> <img
              src="<?php echo get_stylesheet_directory_uri(); ?>/assets/cp-logo.svg" alt="Crowdpolicy logo"
              class="cp-logo"></p>
        </a>
      </div>

    </div>

  </div>

</footer>

<?php wp_footer(); ?>

<?php if (ICL_LANGUAGE_CODE == 'el') { ?>
<script>
// Translate Events archive
if (document.querySelector('body.post-type-archive-mec-events')) {
  document.querySelector(
    'body.post-type-archive-mec-events #main-content > h1'
  ).innerHTML = 'ΕΚΔΗΛΩΣΕΙΣ';
}
</script>

<?php } ?>

</body>

</html>

<style> 
@media screen and (max-width:1250px) {
  section {
    width: auto !important;
  }
}
</style>