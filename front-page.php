<?php

get_header();

// Homepage template parts 
?>


<!-- Messenger Πρόσθετο συνομιλίας Code -->
<div id="fb-root"></div>

<!-- Your Πρόσθετο συνομιλίας code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>

  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "108999931500827");
  chatbox.setAttribute("attribution", "biz_inbox");

  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v11.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/el_GR/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

</script>



<?php if(get_field('home_hero')['hero_show_hide']){
  get_template_part('partials/homepage/section', 'hero');
  get_template_part('partials/homepage/section', 'buttons-overlay');
} ?>
<?php if (get_field('home_greetings')['greetings_show_hide']) {
   get_template_part('partials/homepage/section', 'greetings');
}?>
<?php if (get_field('home_notices_announcements')['notices_announcements_show_hide'] == "true") {
  get_template_part('partials/homepage/section', 'announcements');
} ?>

<?php get_template_part('partials/homepage/section', 'announcementsv2'); ?>

<?php //get_template_part('partials/homepage/section', 'greetings'); ?>
<?php //get_template_part('partials/homepage/section', 'offices-contact'); ?>

<?php if (get_field('home_events')['events_show_hide']) {
  get_template_part('partials/homepage/section', 'calendar');
}?>


  <?php get_template_part('partials/homepage/section', 'info');?>


<?php  if (get_field('home_actions')['home_actions_show_hide']) {
  get_template_part('partials/homepage/section', 'actions');
} ?>

<?php if(get_field('home_services')['services_show_hide']){
  get_template_part('partials/homepage/section', 'services');
} ?>

<?php if(get_field('municipality_admin')['municipality_show']){
  get_template_part('partials/homepage/section', 'municipality'); 
}?>


<?php if(get_field('counters')['show_counters']){
  get_template_part('partials/homepage/section', 'counters');
} ?>

<?php if(get_field('home_map')['home_map_show_hide']){
  get_template_part('partials/homepage/section', 'map');
} ?>



<?php if (get_field('home_contact')['contact_show_hide']) { 
  get_template_part('partials/homepage/section', 'contact');
} ?>

<?php if (get_field('home_press_releases')['press_releases_show_hide']) { 
  get_template_part('partials/homepage/section', 'press-release');
} ?>
<?php if(get_field('city_on_section_show','option') == 'true'){
  get_template_part('partials/homepage/section', 'cityon');
} ?>
<?php if (get_field('home_cta')['cta_show_hide'] == 'true') {
  get_template_part('partials/homepage/section', 'cta-new');
} ?>
<?php get_template_part('partials/homepage/section', 'gallery'); ?> 

<?php if (get_field('home_useful_links')['useful_links_show_hide'] == 'true') {
  get_template_part('partials/homepage/section', 'useful-links'); 
} ?>
<?php if(get_field('city_section_show','option') == 'true'){
  get_template_part('partials/homepage/section', 'city');
} ?>

<?php get_footer(); ?>