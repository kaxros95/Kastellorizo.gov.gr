<?php 

/**
 * Template name: Photos
 */

?>
 


<?php

// acf_form_head();

get_header();


?>
<div class="container text-center mb-5">
    <h2 class="mb-3"> <?php _e('Ανεβάστε φωτογραφίες του τόπου μας','gov-portal'); ?> </h2>
      <?php
      // $settings = array(
      //   'id' => 'photos_form',
      //   'post_id' => 'new_post',
      //   // 'new_post' => array(
      //   //   'post_type'   => 'photos',
      //   //   'post_status' => 'publish',
      //   //   'post_title'  => "Test11111" 
      //   // ),
      //   'field_groups' => array("group_61924699b96a5"),
      //   // 'fields' => false,
      //   'submit_value' => __("Υποβολή", 'acf'),
      //   // 'label_placement' => 'top',
      //   'html_submit_button' => '<input type="submit" id="submitbtn" class="acf-button button main_btn" value="%s" />',
      //   'html_submit_spinner' => '<span class="acf-spinner"></span>',
      //   'updated_message' => '<p style="font-weight:bold; color:#a79149;">Η υποβολή πραγματοποιήθηκε επιτυχώς. Ευχαριστούμε!</p>',
      //   'html_after_fields' => '',
      //   'uploader' => 'basic',
      // );
      // acf_form($settings); ?> 

    <form method="post" enctype="multipart/form-data">
      <?php _e('Ανεβάστε την φωτογραφία σας εδώ:', 'gov-portal') ?> <br>
      <div class="photo-content">
        <input class="photo-content-inner" type="file" value="Επιλογή εικόνας" name="fileToUpload" id="fileToUpload">
      </div>
      <div class="g-recaptcha" id="rcaptcha" data-sitekey="6LfihnYdAAAAAPxEgLFOwZRiCgjyFtWlJrpOkeGB"></div>
      <span id="captcha" style="color:red" /></span>  <!-- this will show captcha errors -->
      <input class="submit-photos" type="submit" value=<?php _e('Υποβολή', 'gov-portal') ?> name="submit">
    </form>



    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>

    function get_action(form) 
    {
        var v = grecaptcha.getResponse();
        if(v.length == 0)
        {
            document.getElementById('captcha').innerHTML="You can't leave Captcha Code empty";
            return false;
        }
        else
        {
            document.getElementById('captcha').innerHTML="Captcha completed";
            return true; 
        }
    }

    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.10/sweetalert2.min.js" integrity="sha512-1Jkfcq8ZUmwWGIEHdejGoqwEJp/Zx6r6BKxCpLGHZ7GqJZfYS+VD/Ti9eSlvhFkDBq6ZalxKSU9K8FQtfexe9w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.10/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</div>

<?php get_footer();?>

<style>

.mb-3 {
  margin: 30px auto;
}
.submit-photos {
  background-color: #D9AA36;
    color: white;
    border: 1px solid #D9AA36;
    border-radius: 40px;
    padding: 15px 30px;
    margin: 3rem auto 1rem;
    cursor: pointer;
    font-family: "CeraGR-Regular";
    font-size: 16px;
    transition: all 0.2s ease-in-out;
    display: block;
}
.photo-content {
  margin: 40px auto;
  display: flex;
  justify-content: space-around;
}
.photo-content-inner{
  width: 60%;
  border: 2px solid #DFDFDF;
  align-items: center;
  border-radius: 30px;
  padding: 16px 20px;
}
.g-recaptcha {
  display: flex;
  justify-content: space-around;
}
</style>
