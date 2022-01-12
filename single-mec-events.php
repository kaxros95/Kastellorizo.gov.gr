<?php

/** no direct access **/
defined('MECEXEC') or die();

/**
 * The Template for displaying all single events
 * more info @ https://webnus.net/dox/modern-events-calendar/overriding-mec-single-event-page/
 *
 * @author Webnus <info@webnus.biz>
 * @package MEC/Templates
 * @version 1.0.0
 */
acf_form_head();
get_header();

$single = new MEC_skin_single();
$single_event_main = $single->get_event_mec(get_the_ID());
$single_event_obj = $single_event_main[0];
?>

<style>
.event-wrapper .interest-form .acf-form-submit {
  text-align:center;
  padding: 1rem;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.event-wrapper .interest-form .acf-form-submit #mec-submit{
  outline:none;
  padding: 13px 22px;
  border-radius: 4px;
  background-color: #707070;
  border: 2px inset transparent;
  color: #fff;
  cursor:pointer;
  transition: all 0.2s ease-in-out;
}
.event-wrapper .interest-form .acf-form-submit #mec-submit:hover{
  background-color: #fff;
  border: 2px solid #707070;
  color: #707070;
}
.event-wrapper .interest-form .acf-form-submit .acf-spinner{
  margin:1rem;
}
</style>

<section class="event-wrapper">
  <?php while (have_posts()) : the_post(); ?>
    <div class="grid">
      <div id="sidebar">
        <div class="meta">
          <div class="sidebar-meta date"><?php $single->display_date_widget($single_event_obj); ?></div>
          <div class="sidebar-meta time"><?php $single->display_time_widget($single_event_obj); ?></div>
          <div class="sidebar-meta more-info"><?php $single->display_more_info_widget($single_event_obj); ?></div>
          <div class="sidebar-meta cost"><?php $single->display_cost_widget($single_event_obj); ?></div>
          <div class="sidebar-meta organizer">
            <?php
            $single->display_organizer_widget($single_event_obj); // show Organizer 
            $single->display_other_organizer_widget($single_event_obj); // additional Organizers
            ?>
          </div>
        </div>

        <!-- Social Sharing -->
        <?php $single->display_social_widget($single_event_obj); ?>
      </div>

      <div class="content">
        <div class="page-header">
          <h1 class="page-title"><?php echo get_the_title(); ?> </h1>
          </header>
        </div>

        <div class="thumbnail"><?php the_post_thumbnail('full'); ?></div>

        <div class="description">
          <?php the_content(); ?>
        </div>

      </div>
    </div>
    <div class="interest-form">
      <?php
      // var_dump_pre(get_post_meta(get_the_ID()));
      $show_form = get_field('event_show_form',get_the_ID());
      if($show_form == 'true'){
        $settings = array(

        /* (string) Unique identifier for the form. Defaults to 'acf-form' */
        'id' => 'acf-form-event',

        /* (int|string) The post ID to load data from and save data to. Defaults to the current post ID.
        Can also be set to 'new_post' to create a new post on submit */
        'post_id' => false,


        /* (array) An array of post data used to create a post. See wp_insert_post for available parameters.
        The above 'post_id' setting must contain a value of 'new_post' */
        'new_post' => false,

        /* (array) An array of field group IDs/keys to override the fields displayed in this form */
        'field_groups' => false,

        /* (array) An array of field IDs/keys to override the fields displayed in this form */
        'fields' => array('field_60212490c1514','field_6021249fc1515','field_602124abc1516'),

        /* (boolean) Whether or not to show the post title text field. Defaults to false */
        'post_title' => false,

        /* (boolean) Whether or not to show the post content editor field. Defaults to false */
        'post_content' => false,

        /* (boolean) Whether or not to create a form element. Useful when a adding to an existing form. Defaults to true */
        'form' => true,

        /* (array) An array or HTML attributes for the form element */
        'form_attributes' => array(),

        /* (string) The URL to be redirected to after the form is submit. Defaults to the current URL with a GET parameter '?updated=true'.
        A special placeholder '%post_url%' will be converted to post's permalink (handy if creating a new post)
        A special placeholder '%post_id%' will be converted to post's ID (handy if creating a new post) */
        'return' => false,

        /* (string) Extra HTML to add before the fields */
        'html_before_fields' => '',

        /* (string) Extra HTML to add after the fields */
        'html_after_fields' => '',

        /* (string) The text displayed on the submit button */
        'submit_value' => __("Εκδήλωση ενδιαφέροντος", 'acf'),

        /* (string) A message displayed above the form after being redirected. Can also be set to false for no message */
        'updated_message' => __("Post updated", 'acf'),

        /* (string) Determines where field labels are places in relation to fields. Defaults to 'top'.
        Choices of 'top' (Above fields) or 'left' (Beside fields) */
        'label_placement' => 'top',

        /* (string) Determines where field instructions are places in relation to fields. Defaults to 'label'.
        Choices of 'label' (Below labels) or 'field' (Below fields) */
        'instruction_placement' => 'label',

        /* (string) Determines element used to wrap a field. Defaults to 'div'
        Choices of 'div', 'tr', 'td', 'ul', 'ol', 'dl' */
        'field_el' => 'div',


        /* (boolean) Whether to include a hidden input field to capture non human form submission. Defaults to true. Added in v5.3.4 */
        'honeypot' => true,

        /* (string) HTML used to render the updated message. Added in v5.5.10 */
        'html_updated_message' => '<div id="message" class="updated"><p>%s</p></div>',

        /* (string) HTML used to render the submit button. Added in v5.5.10 */
        'html_submit_button' => '<input type="submit" id="mec-submit" class="acf-button button" value="%s" />',

        /* (string) HTML used to render the submit button loading spinner. Added in v5.5.10 */
        'html_submit_spinner' => '<span class="acf-spinner"></span>',

        /* (boolean) Whether or not to sanitize all $_POST data with the wp_kses_post() function. Defaults to true. Added in v5.6.5 */
        'kses' => true

      );
      acf_form($settings); 
      }
      ?>
    </div>
  <?php endwhile; ?>
</section>

<script>
  // Translations
  <?php if (ICL_LANGUAGE_CODE == 'el') { ?>
    if (document.querySelector('#sidebar .mec-event-social h3.mec-frontbox-title')) {
      let socialText = document.querySelector('#sidebar .mec-event-social h3.mec-frontbox-title');
      socialText.innerHTML = 'Κοινοποιήστε την εκδήλωση';
    }
    if (document.querySelector('#sidebar .mec-single-event-date .mec-date')) {
      let dateText = document.querySelector('#sidebar .mec-single-event-date .mec-date');
      dateText.innerHTML = 'Ημερομηνία';
    }
    if (document.querySelector('#sidebar .mec-single-event-time .mec-time')) {
      let timeText = document.querySelector('#sidebar .mec-single-event-time .mec-time');
      timeText.innerHTML = 'Ώρα';
    }
    if (document.querySelector('#sidebar .mec-event-more-info .mec-cost')) {
      let moreInfoText = document.querySelector('#sidebar .mec-event-more-info .mec-cost');
      moreInfoText.innerHTML = 'Για την εκδήλωση';
    }
    if (document.querySelector('#sidebar .mec-event-cost .mec-cost')) {
      let moreInfoText = document.querySelector('#sidebar .mec-event-cost .mec-cost');
      moreInfoText.innerHTML = 'Τιμή';
    }
    if (document.querySelector('#sidebar .mec-single-event-organizer .mec-events-single-section-title')) {
      let moreInfoText = document.querySelector('#sidebar .mec-single-event-organizer .mec-events-single-section-title');
      moreInfoText.innerHTML = 'Διοργάνωση';
    }
  <?php } ?>

  if (document.querySelector('#sidebar .organizer dd.mec-organizer i')) {
    let orginizerIcon = document.querySelector('#sidebar .organizer dd.mec-organizer i');
    let desiredPosition = document.querySelector('#sidebar .organizer div.mec-single-event-organizer');

    desiredPosition.insertBefore(orginizerIcon, desiredPosition.childNodes[0]);

    document.querySelector('#sidebar .organizer div.mec-single-event-organizer .mec-organizer h6').outerHTML = document.querySelector('#sidebar .organizer div.mec-single-event-organizer .mec-organizer h6').outerHTML.replace(/h6/g, "abbr");
  }
</script>

<?php get_footer();
