<?php 
$args = array(
'posts_per_page' => 4,
  'tax_query' => array(
    array(
      'taxonomy' => 'category',
      'field'    => 'slug',
      'terms'    => 'anakoinwseis',
    )
  )
);
$announcements = new WP_Query($args);

$args = array(
    'posts_per_page' => 1,
    'tax_query' => array(
      array(
        'taxonomy' => 'category',
        'field'    => 'slug',
        'terms'    => 'deltia-typou',
      )
    )
  );
  $press_releases = new WP_Query($args);

?>

<section id="announcements-grid">
    <div class="announcements-inner">
        <h2 class="section-title"><?php _e('ΔΕΛΤΙΑ ΤΥΠΟΥ & ΑΝΑΚΟΙΝΩΣΕΙΣ','gov-portal');?></h2>
        <div class="announcements-container">
            <div class="press-releases-item">
                <?php if ($press_releases ->have_posts()){
                      while ( $press_releases->have_posts() ) {
                        $press_releases->the_post();
                        $title = get_the_title();
                        $date = get_the_date('d'.'-'. 'm' . '-' . 'Y');
                        $permalink = get_permalink();
                        if (has_post_thumbnail()){
                            $thumbnail = get_the_post_thumbnail_url();
                        }else{
                            $thumbnail = get_stylesheet_directory_uri() . '/assets/img/defaultimg.png';
                        }
                        $category = get_the_category();
                        $category = $category[0];
                        $category = $category -> name;
                        ?>
                    <div class="news-box-deltia">
                        <img src="<?php echo $thumbnail;?>">
                        <div class="news-info">
                            <div class="category">
                                <?php echo $category;?>
                            </div>
                            <div class="title">
                                <?php echo $title;?>
                            </div>
                            <div class="news-line">
                                <div class="date">
                                    <?php echo $date;?>
                                </div>
                                <div class="more-link">
                                    <a href="<?php echo $permalink;?>">Περισσότερα</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php   }
                }
                wp_reset_postdata();
                ?>
                
            </div>

            <div class="announcements-items">
            <?php if ($announcements ->have_posts()){
                      while ( $announcements->have_posts() ) {
                        $announcements->the_post();
                        $title = get_the_title();
                        $date = get_the_date('d'.'-'. 'm' . '-' . 'Y');
                        $permalink = get_permalink();
                        if (has_post_thumbnail()){
                            $thumbnail = get_the_post_thumbnail_url();
                        }else{
                            $thumbnail = get_stylesheet_directory_uri() . '/assets/img/defaultimg.png';
                        }
                        $category = get_the_category();
                        $category = $category[0];
                        $category = $category -> name;
                        ?>
                    <div class="news-box-anakoinoseis">
                        <img src="<?php echo $thumbnail;?>">
                        <div class="news-info">
                            <div class="category">
                                <?php echo $category;?>
                            </div>
                            <div class="title">
                                <?php echo $title;?>
                            </div>
                            <div class="news-line">
                                <div class="date">
                                    <?php echo $date;?>
                                </div>
                                <div class="more-link">
                                    <a href="<?php echo $permalink;?>"><?php _e('Περισσότερα','gov-portal');?></a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php   }
                }
                wp_reset_postdata();
                ?>
            </div>    
        </div>
        <div class="news-buttons">
            <div class="button1">
                <a class="news-button-deltia" href="<?php echo get_term_link('deltia-typou','category');?>"><?php _e('Όλα τα δελτία τύπου','gov-portal');?></a>
            </div>
            <div class="button2">
                <a class="news-button-anakoinoseis" href="<?php echo get_term_link('anakoinwseis','category');?>"><?php _e('Όλες οι ανακοινώσεις','gov-portal');?></a>
            </div>
        </div>
    </div>
</section>

<style>
    .announcements-inner{
        width: 1140px;
        max-width: 90%;
        margin: 0 auto;
        padding: 30px 0px;
    }
    .section-title{
        text-align:center;
        margin:30px 0px;
    }
    .announcements-container{
        display:flex;
        gap:20px;
        padding:40px 0px;
    }
    .announcements-items{
        width: 50%;
        display: flex;
        flex-direction: column;
        gap:10px;
    }
    .press-releases-item{
        width:50%;
    }
    .news-box-deltia img{
    max-width: 100%;
    width: 100%;
    min-height: 300px;
    object-fit: cover;
    }

    .news-box-deltia{
        height:100%;
        box-shadow:0px 0px 5px #c1c1c0;
        border-radius: 4px;
    }
    .news-info{
        display:flex;
        flex-direction: column;
        gap:20px;
        width:100%;
    }
    .category{
        margin:20px 0px;
        padding: 10px 20px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .title{
        padding: 10px 20px;
    }
    .news-line{
        display:flex;
        justify-content: space-between;
        padding:10px;
    }

    .news-box-anakoinoseis img{
        width:100%;
        object-fit: cover;
        max-width:200px;
    }

    .news-box-anakoinoseis{
        display:flex;
        box-shadow:0px 0px 5px #c1c1c0;
        border-radius: 4px;
    }

    .news-box-anakoinoseis > .news-info > .category{
        margin:0;
    }

    .news-box-deltia > .news-info > .title{
        min-height:180px
    }

    .news-buttons{
        display:flex;
        width:100%;
        text-align: center;
    }

    .all-news-button{
        text-align:center;
    }
    .button1,.button2{
        width:50%;
        margin:30px 0px;
    }

    .button1 a, .button2 a{
        background:#8cadb9;
        color:#fff;
        padding: 10px 15px;
        border-radius:5px;
        box-shadow:0px 0px 5px #c1c1c0;
    }
    .more-link:hover{
        text-decoration: underline;
    }
    .date{
        font-style:italic;
        color:#b4b5c0;
    }
    

    @media screen and (max-width:1024px){
        .announcements-items{
        width: 100%;
    }
    .press-releases-item{
        width:100%;
    }
    .announcements-container{
        flex-direction: column;
    }
}

@media screen and (max-width:480px){
    .news-buttons{
        flex-direction: column;
        align-items: center;
    }
    .news-box-anakoinoseis img,.news-box-deltia img{
        display:none;
    }
    .button1,.button2{
        width:100%;
    }
}
</style>