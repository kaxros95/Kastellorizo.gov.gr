

        <div class="cta-section">
         

         
          

        
       
          <?php if ($upper_section_buttons && count($upper_section_buttons) > 0) { ?>

            <?php foreach ($upper_section_buttons as $key => $value) { ?>
              <a href="<?php echo $value['link']; ?>" class="btn"><?php echo $value['text']; ?></a>
            <?php } ?>

          <?php } ?>
          
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

          <?php } ?>
        </div>

        <div class="social-feed">

        

        </div>
