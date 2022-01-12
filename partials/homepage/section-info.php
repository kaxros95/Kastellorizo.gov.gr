<!-- Homepage - Location Information section -->
<?php
 $radiobutton = get_field('home_information')['info_show_hide'];
 $info_title = get_field('home_information')['info_title'];
$info_bg = get_field('home_information')['info_bg'];
 $info_video = get_field('home_information')['video'];    
 
 $args = array(     
    'post_type'=>'information',
    'posts_per_page' => -1,
    'suppress_filters' => false,
 );

 $infos = get_posts($args);



if($radiobutton=='true'):
?>
<section class="information"
  style="background:   linear-gradient(rgba(68, 56, 44, 0.7),rgba(68, 56, 44, 0.7)), url('<?php echo $info_bg;?>');">

  <h2><?php echo  $info_title?></h2>
  <div class="info-video">
    <?php echo $info_video;?>
  </div>
  <div class="infowrapper">
    <?php foreach ($infos as $info){
        $infoid = $info->ID;
        $informationlinks = get_field('information_links',$infoid);
        $informationame =$informationlinks[0]['information_url_text'];
        $informationinternal = $informationlinks[0]['information_internal'];
        $informationexternal = $informationlinks[0]['information_external'];
        $radiobutton = $informationlinks[0]['information_internal_or_external'];
        $icons = get_field('FotnAwesome_icon_field',$infoid);?>

    <div class="infobox">

      <p>

        <?php echo $icons;?>

        <?php if ($radiobutton=='true'): ?>
            <a href="<?php echo $informationinternal;?>">
            <?php else: ?>
                <a href="<?php echo $informationexternal;?>" target="_blank">

            <?php endif; ?>
         <?php echo $informationame; ?> </p></a>
            
    </div>



    <?php }?>
    <hr class="vr">
  </div>
</section>

<?php endif;?>