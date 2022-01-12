<!DOCTYPE html>
<!-- <html <?php language_attributes(); ?>> -->
<html lang = "en">

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-8T290JCREL"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-8T290JCREL');
</script>

  <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="description" content="<?php if ( is_single() ) {
        single_post_title('', true); 
      } else {
        bloginfo('name'); echo " - "; bloginfo('description');
      }
  ?>" />
  <meta name="keywords" content="Καστελλόριζο, δήμο, δήμος μεγίστης, Καστελόριζο, Kastellorizo, Dimos Megistis, kastelorizo, καστελόριζο, μεγίστη, megisti">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="apple-itunes-app" content="app-id=1508110671, app-argument=https://cityon.gr?cityId=25a70523-c8d4-45ef-b717-795665504e6e">
 
  <title>
    <?php if(is_front_page() || is_home()){
      echo get_bloginfo('name');
    } else{
      wp_title('|',true,'right');
      bloginfo('name');
    }?>
  </title>
  <!-- <script src="https://kit.fontawesome.com/95345bac54.js"></script> -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v0.0.4/css/unicons.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;subset=greek,greek-ext" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i&display=swap&subset=greek" rel="stylesheet">

  
  

  <!-- Fonts -->


  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <?php do_action('after_body'); ?>

  <?php
  $imgid = get_theme_mod('custom_logo');
  $imglogo = wp_get_attachment_image_src($imgid, 'full');
  $imglogo = $imglogo[0];
  $default_logo =  get_template_directory_uri() . '/assets/img/urn_aaid_sc_US_17a37565-6b78-4d4e-b730-6e6f542879e1 (11).png';

  // Nav args
  $nav_args = array(
    'theme_location' => 'head-menu',
    'walker' => new walkernav(),
    // 'container' => 'div',
  );
  ?>

<div id="minihead">
  <?php 
      $socials =get_field('social_links','option');
      $facebook = $socials ["facebook_profile"];
      $twitter = $socials ["twitter_profile"];
      $youtube = $socials ["youtube_profile"];
     
    
  ?>
   <div id="mh0">
      <div id="socials_inner">
        <a href="<?php echo $facebook; ?>" target="_blank">
          <span class="fab fa-facebook-f" aria-hidden="false"></span>
        </a>
        <a href="<?php echo $twitter; ?>" target="_blank">
          <span class="fab fa-twitter" aria-hidden="true"></span>
        </a>
        <a href="<?php echo $youtube; ?>" target="_blank">
          <span class="fab fa-youtube" aria-hidden="true"></span>
        </a>
      </div> 
      <!-- <div id="mha">Τηλεφωνικό κέντρο: +30</div> -->
      <?php
      if (function_exists('pll_current_language') && function_exists('pll_default_language') && pll_current_language() !== pll_default_language()) {
        $base_url = site_url('/' . pll_current_language() . '/');
        $base_url_trailing = true;
      } else {
          $base_url = get_site_url();
      }
      
      ?>
      <div id="mhb">
         <div class="mhb-inner">
            <form method="get" id="search" class="search responsive-show-block" action="<?php echo $base_url; ?>" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction">
               <meta itemprop="target" content="<?php if ($base_url_trailing) {
                  echo rtrim($base_url, "/");
                  } else {
                  echo $base_url;
                  } ?>/?s={s}" />
               <input type="search" role="search" placeholder="<?php _e('Αναζήτηση', 'gov-portal'); ?>" title="<?php _e('Αναζήτηση', 'gov-portal'); ?>" accesskey="s" itemprop="query-input" name="s" tabindex="1" required />
            </form>
         </div>
      </div>
      <?php if(function_exists(icl_get_languages)){
         $langs = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str');
         $activeLang['language_code'] = 'el';
         $otherLangs = array();
         foreach ($langs as $lang) {
             if ($lang['active']) {
                 $activeLang = $lang;
             } else {
                 $otherLangs[] = $lang;
             }
         }
         
         if ($activeLang['language_code'] == 'el') {
             $activeLang['language_code'] = 'EΛ';
         }
         }?>
      <?php if($langs): ?>
      <!-- <div class="dropdown">
         <button class="dropbtn"><?php echo strtoupper(($activeLang['language_code'])); ?><span class="fas fa-chevron-down" aria-hidden="true"></span></button>
         <?php if ($otherLangs) { ?>
         <div class="dropdown-content">
            <?php foreach ($otherLangs as $ol) {
               if ($ol['language_code'] == 'el') {
                   $ol['language_code'] = 'EΛ';
               }
               ?>
            <a href="<?php echo $ol['url'] ?>"><?php echo strtoupper($ol['language_code']); ?></a>
            <?php } ?>
         </div>
         <?php } ?>
      </div> -->
      <?php endif; ?>
   </div>
</div>
<div class="pilotiki-leitourgia">
  <h4 class="pilotiki-leitourgia-title"><?php _e('Πιλοτική Λειτουργία','gov-portal'); ?></h4>
  
</div>

  <header class="main" id="header">
    <div class="header-outer">
      <div class="wrapper">

        <a class="logo-wrapper" style="display: inline-block;padding-top: .3125rem;padding-bottom: .3125rem;margin-right: 1rem;font-size: 1.25rem;line-height: inherit;white-space: nowrap;" href="<?php echo home_url(); ?>">
          <img class="logo" src="<?php echo ($imglogo ?  $imglogo : $default_logo); ?>" class="d-inline-block align-top main-logo" alt="site-logo">
        </a>

        <div id="responsive-menu-toggle">
          <button class="hamburger hamburger--3dy" type="button">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>

            <div id="responsive-header-menu-container">
              <?php wp_nav_menu($nav_args);
              ?>
            </div>
          </button>


        </div>



        <div class="nav-links" style="flex:1;" id="header-menu-container">
          <?php
          if (function_exists('ubermenu')) {
            ubermenu('main', array('theme_location' => 'header-menu'));
          }
          ?>
        </div>

        <!-- <div class="weather">
          <div class="current-weather">
            <span id="weather-current-label" class="label">Heraklion, Now</span>
            <div class="weather-temp">
              <span id="weather-current-temp">...</span>
              <img id="weather-current-img" src="<?php echo get_stylesheet_directory_uri() . '/assets/weather.png'; ?>" alt="Weather icon">
            </div>
          </div>

          <div class="air-quality">
            <span id="air-quality-label" class="label">Air Quality</span> -->

            <!-- <ul> -->
              <!-- <li class="weather-no2">
              <span class="label">No2</span>
              <span id="weather-no2" class="result">...</span>
            </li>
            <li class="weather-co2">
              <span class="label">Co2</span>
              <span id="weather-co2" class="result">...</span>
            </li> -->
              <!-- <li class="weather-humidity">
                <span id="weather-humidity-label" class="label">Humidity</span>
                <span id="weather-humidity" class="result">...</span>
              </li>
            </ul>
          </div> -->
<!-- 
          <script>
            let url = 'https://api.openweathermap.org/data/2.5/group?id=261745,260114,254352,263824&units=metric&appid=4627c7413a29db4517a60068b18584dc';
            let weather = [];

            fetch(url)
              .then(res => res.json())
              .then(data => {
                data.list.forEach(city => {
                  weather.push(city);
                });


                if (weather.length > 0) {
                  let count = 0;

                  setInterval(function intval() {

                    var currentLang = '<?php echo ICL_LANGUAGE_CODE; ?>';

                    if (currentLang == 'el') {
                      // Change temp label
                      switch (weather[count].name) {
                        case "Heraklion":
                          weather[count].name = 'Ηράκλειο';
                          break;
                        case "Chania":
                          weather[count].name = 'Χανιά';
                          break;
                        case "Rethymno":
                          weather[count].name = 'Ρέθυμνο';
                          break;
                        case 'Agios Nikolaos':
                          weather[count].name = 'Άγιος Νικόλαος';
                          break;
                        default:
                          break;
                      }

                      // Change air quality label
                      document.getElementById('air-quality-label').innerHTML = 'Ποιότητα Αέρα';

                      // Change humidity label
                      document.getElementById('weather-humidity-label').innerHTML = 'Υγρασία';

                      document.getElementById('weather-current-label').innerHTML = weather[count].name + ', Τώρα';
                    } else {
                      document.getElementById('weather-current-label').innerHTML = weather[count].name + ', Now';
                    }
                    document.getElementById('weather-current-temp').innerHTML = weather[count].main.temp.toFixed(0) + ' °C';
                    document.getElementById('weather-humidity').innerHTML = weather[count].main.humidity + '%';
                    document.getElementById('weather-current-img').setAttribute('src', `https://openweathermap.org/img/wn/${weather[count].weather[0].icon}@2x.png`);

                    count++;

                    if (count > weather.length - 1) {
                      count = 0;
                    }

                    return intval;
                  }(), 8000);
                }
              })
          </script> -->
        <!-- </div> -->

      </div>


    </div>
  </header>

  <script>
    // When the user scrolls the page, execute myFunction
    window.onscroll = function() {
      myFunction()
    };

    // Get the header
    var header = document.getElementById("header");
    var miniheader = document.getElementById("minihead");
    // console.log(header)

    // Get the offset position of the navbar
    var sticky = header.offsetTop;

    // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
      if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
      } else {
        header.classList.remove("sticky");
      }
    }

    // Hover handling
    // var depth1 = document.querySelector('.dropdown-menu.depth_1');
    // console.log(depth1)
    // var depth1Height = depth1.clientHeight;
    // depth1.style.position = 'absolute';

    // console.log(depth1Height)

    // $('menu-wrapper-inner').height($('.dropdown-menu.depth_1', this).height());

    // let toplvl = document.querySelectorAll('.nav-links #menu-site-main-menu > li');
    // let wrapper = document.querySelector('.menu-wrapper-inner');
    // console.log(wrapper)


    // for (let j = 0; j < toplvl.length; j++) {
    //   toplvl[j].addEventListener('mouseenter', function() {
    //     for (let i = 0; i < toplvl.length; i++) {

    //       let lvl0 = toplvl[i].querySelectorAll('.dropdown-menu.depth_0 > li');

    //       toplvl[i].querySelector('.menu-wrapper-inner').style.height = lvl0.length * 65 + 'px';

    //       let lvl0haschild = toplvl[i].querySelectorAll('.dropdown-menu.depth_0 > li.menu-item-has-children');

    //       for (let o = 0; o < lvl0haschild.length; o++) {
    //         lvl0haschild[o].addEventListener('mouseenter', function() {
    //           let lvl1 = this.querySelectorAll('.dropdown-menu.depth_1 > li');

    //           toplvl[i].querySelector('.menu-wrapper-inner').style.height = lvl1.length * 45 + 'px';

    //         })

    //       }



    //     }

    //   })
    // }


    // toplvl.forEach(toplvlli => {
    //   let lvl0, lvl1;

    //   lvl0 = toplvlli.querySelectorAll('.dropdown-menu.depth_0 > li');
    //   console.log(lvl0)
    //   wrapper.style.height = lvl0.length * 60 + 'px';

    //   lvl0.forEach(li => {
    //     lvl1 = li.querySelectorAll('.dropdown-menu.depth_1 > li.menu-item-has-children');
    //     toplvlli.querySelector('.menu-wrapper-inner').style.height = lvl1.length * 60 + 'px';
    //   });
    // });


    // document.querySelectorAll('.menu-wrapper-inner').forEach(element => {
    //   element.style.minHeight = '300px';
    // });
  </script>
  <main style="flex:1">

<style>
  .pilotiki-leitourgia { 
        width: 100%;
        padding-top: 5px;
  }
  .pilotiki-leitourgia-title {
        width: 37%;
        text-align: right;
        font-size: 20px;
        font-weight: 600;
  }
  .h1-tag-seo-improvement {
    visibility: hidden;
  }
</style>