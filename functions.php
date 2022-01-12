<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
/**
 * Theme Setup
 */
require_once __DIR__ . '/includes/theme-setup.php';

/**
 * Helper Functions (reusable code).
 */

require_once __DIR__ . '/includes/helper-functions.php';

/**
 * Register custom post types.
 */
require_once __DIR__ . '/includes/custom-post-types-setup.php';

/**
 * User roles and admin panel customization.
 */
require_once __DIR__ . '/includes/custom-role-user-permissions.php';
require_once __DIR__ . '/includes/dashboard-customization.php';

/*
 * Modify Attachments plugin
 */
require_once 'includes/attachments.php';

/**
 * Class loader
 */
include __DIR__ . "/components/components-loader.php";

require_once __DIR__ . '/includes/config/walkernav.php';

add_action('after_body', function () {
    if (function_exists('pll_current_language') && function_exists('pll_default_language') && pll_current_language() !== pll_default_language()) {
        $base_url = site_url('/' . pll_current_language() . '/');
        $base_url_trailing = true;
    } else {
        $base_url = get_site_url();
    }
?>
    <!-- <style>
        #mhb:before {
            font-family: "Font Awesome 5 Free";
            content: "\f002";
            display: inline-block;
            vertical-align: middle;
            font-weight: 900;
            padding-right: 2px;
            margin-top: 5px;
        }

        #mhd a {
            padding-right: 10px;
        }

        #mhb input {
            background: none;
            border: none;
            color: #fff;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 10px;
            padding-right: 10px;
        }

        #mhb input::placeholder {
            color: #fff;
            text-align: center;
        }

        @media all and (max-width: 800px) {
            #minihead {
                display: none;
            }

            #mh0 {
                flex-direction: column !important;
                padding-top: 20px;
                padding-bottom: 20px
            }

            #mha {
                padding-top: 20px;
                padding-bottom: 20px
            }

            #mhb {
                padding-top: 40px;
                padding-bottom: 40px
            }

            #mhc {
                padding-top: 20px;
                padding-bottom: 40px;
                padding-right: 0 !important;
                padding-left: 0 !important
            }
        }

        .dropbtn {
            background-color: transparent;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            padding-right: 50px;
        }

        .dropbtn i {
            margin-left: 6px;
            font-size: 15px;
            position: relative;
            top: -1px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 50px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            bottom: -35px;
            left: 8px;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: transparent;
        }
    </style> -->
    <?php
    // echo '<div id="minihead" style="background-color: #3A3E70;min-height: 20px;padding:10px 20px;">';
    // echo '<div id="mh0" style="max-width:1140px;color:#fff;display:flex;justify-content: center;align-items: center;min-height: 20px; height: 20px; margin:0 auto">';
    // echo '<div id="mhd"><a href="https://www.facebook.com/d.ampelokipon/" target="_blank"><span class="fab fa-facebook-f"></span></a><a href="https://twitter.com/dim_ampel_men" target="_blank"><span class="fab fa-twitter"></span></a><a href="https://www.youtube.com/channel/UCQFl1ch1Wjs6boi-nRoGcJg" target="_blank"><span class="fab fa-youtube"></span></a>
    // </div>';
    // // echo '<div id="mha">Τηλεφωνικό κέντρο: +302813400300</div>';
    // echo '<div id="mhb" style="flex: 1;display:flex;justify-content: center;"><div id="mhb-inner" style="border-bottom: 1px solid #fff;">';
    ?>
    <!-- <form method="get" id="search" class="search responsive-show-block" action="<?php echo $base_url; ?>" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction">
        <meta itemprop="target" content="<?php if ($base_url_trailing) {
            echo rtrim($base_url, "/");
        } else {
            echo $base_url;
        } ?>/?s={s}" />
        <input type="search" role="search" placeholder="<?php _e('Αναζήτηση', 'gov-portal'); ?>" title="<?php _e('Αναζήτηση', 'gov-portal'); ?>" accesskey="s" itemprop="query-input" name="s" tabindex="1" required />
    </form> -->
    <?php
    // echo '</div></div>';
    if(function_exists(icl_get_languages)){
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

        ?>
        <!-- <div class="dropdown">
            <button class="dropbtn"><?php echo strtoupper(($activeLang['language_code'])); ?><span class="fas fa-chevron-down"></span></button>
            <?php if ($otherLangs) { ?>
                <div class="dropdown-content">
                    <?php foreach ($otherLangs as $ol) {
                        if ($ol['language_code'] == 'el') {
                            $ol['language_code'] = 'EΛ';
                        }
                    ?>
                        <a href="<?php echo $ol['url'] ?>"><?php echo strtoupper($ol['language_code']); ?></a>
                    <?php

                    } ?>
                </div>
            <?php } ?>
        </div> -->
    <?php
    }
    // echo '<div id="mhc" style="padding-right: 50px;">ΕΛ &or;';

    // if (function_exists('pll_the_languages')) {
    //     pll_the_languages(array( 'dropdown' => 1 , 'show_flags' => 1,'show_names' => 0, 'hide_if_empty' => 0 )  );
    // }
    // do_action('wpml_add_language_selector');

    // echo '</div>';
    // echo '</div>';
    // echo '</div>';
});

// remove the html filtering
// remove_filter( 'pre_term_description', 'wp_filter_kses' );

// add_filter('edit_category_form_fields', 'cat_description');
function cat_description($tag)
{
    ?>
        <table class="form-table">
            <tr class="form-field">
                <th scope="row" valign="top"><label for="description"><?php _ex('Description', 'Taxonomy Description'); ?></label></th>
                <td>
                <?php
                    $settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'description' );
                    wp_editor(wp_kses_post($tag->description , ENT_QUOTES, 'UTF-8'), 'cat_description', $settings);
                ?>
                <br />
                <span class="description"><?php _e('The description is not prominent by default; however, some themes may show it.'); ?></span>
                </td>
            </tr>
        </table>
    <?php
}

// add_action('admin_head', 'remove_default_category_description');
function remove_default_category_description()
{
    global $current_screen;
    if ( $current_screen->id == 'edit-category' )
    {
    ?>
        <script type="text/javascript">
        jQuery(function($) {
            $('textarea#description').closest('tr.form-field').remove();
        });
        </script>
    <?php
    }
}
function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

// You need to set the variable instead of the value here
function pre_save_event( $post_id ) {
if(get_post_type($post_id) !== 'mec-events'){
    return;
}
$name = ($_POST['acf']['field_60212490c1514']);
$surname = ($_POST['acf']['field_6021249fc1515']);
$email = ($_POST['acf']['field_602124abc1516']);

$row = array(
	'event_interest_name'	=> $name,
    'event_interest_surname' => $surname,
    'event_interest_email'=> $email
);

$i = add_row('field_6021247ac1513', $row, $post_id);
}
add_filter('acf/pre_save_post' , 'pre_save_event', 10,1);


//Add meta box to Post Type EVENT

function add_export_csv_event_info() {
    global $post;
    $post_type = get_post_type($post->ID);
    $show_form = get_field('event_show_form',$post->ID);
    if( $show_form && have_rows('event_repeater') && $post_type == 'mec-events'){
        add_meta_box( 'export-csv', 'Export CSV', 'export_csv_event_info', 'mec-events', 'side', 'high' );
    }
}
// callback function to populate metabox
function export_csv_event_info() {
$current_id = get_the_ID();
?>
<div style="text-align:center">
    <a href="<?php echo get_template_directory_uri(); ?>/export-event.php?ID=<?php echo $current_id ?>"><img style="width:20%" src="<?php echo get_template_directory_uri(); ?>/assets/img/download.png">  </a>
</div>
<?php }
add_action( 'add_meta_boxes', 'add_export_csv_event_info' );

add_action('wp_ajax_nopriv_apofasi_ajax','apofasi_ajax_handler');
add_action('wp_ajax_apofasi_ajax','apofasi_ajax_handler');

function apofasi_ajax_handler(){
    
    $keyword = isset($_POST['keyword']) ? sanitize_text_field($_POST['keyword']) : "";
    $organa = isset($_POST['organa']) ? $_POST['organa'] : "";
    $etos_apo = isset($_POST['etos_apo']) ? $_POST['etos_apo'] : "";
    $etos_mexri = isset($_POST['etos_mexri']) ? $_POST['etos_mexri'] : "";
    $decision_number = isset($_POST['decision_number']) ? $_POST['decision_number'] : "";
    $decision_date = isset($_POST['decision_date']) ? date("Ymd", strtotime($_POST['decision_date'])) : "";
    $posts_per_page = $_POST['posts_per_page'];
    $paged = isset($_POST['paged']) ? $_POST['paged'] : 1; 
    $nonce = $_POST['nonce'];
    $ada = isset($_POST['ada']) ? $_POST['ada'] : "";
    if ( ! wp_verify_nonce( $_POST['nonce'], 'ajax-nonce' ) ) {
         die ( 'Permission denied!');
     }
     $meta = array(
         'relation' => 'AND',
        array(
                'query_one' => array(
                    'key' => 'decision_year',
                    'type' => 'NUMERIC',
                ),
                'query_two' => array(
                    'key' => 'decision_number',
                    'type' => 'NUMERIC',
                ),
            )
        );
     $ajax_orderby = array(
        'query_one' => 'DESC',
        'query_two' => 'DESC',
     );
    if(!empty($etos_apo) && !empty($etos_mexri)){
        if($etos_apo < $etos_mexri){
            $local = 
                array(
                    'key' => 'decision_year',
                    'value' => array($etos_apo, $etos_mexri),
                    'compare' => 'BETWEEN'
                );
                array_push($meta,$local);

            $ajax_orderby = array(
                'query_one' => 'ASC',
                'query_two' => 'DESC',
            );
        }else{
            $local =
                array(
                    'key' => 'decision_year',
                    'value' => array($etos_mexri, $etos_apo),
                    'compare' => 'BETWEEN'
                );
                array_push($meta,$local);
            $ajax_orderby = array(
                'query_one' => 'DESC',
                'query_two' => 'DESC',
            );
        };
        }elseif(!empty($etos_apo) && empty($etos_mexri)){
        $local = 
        array(
            'key' => 'decision_year',
            'value' => $etos_apo,
            'compare' => 'IN'
        );
        array_push($meta,$local);
        }elseif(empty($etos_apo) && !empty($etos_mexri)){
        $local = 
        array(
            'key' => 'decision_year',
            'value' => $etos_mexri,
            'compare' => 'IN'
        );
        array_push($meta,$local);
    }
    if(!empty($decision_number)){
        $local = 
            array(
                'key' => 'decision_number',
                'value' => $decision_number,
                'compare' => 'LIKE'
            );
        array_push($meta,$local);
    }
    if(!empty($ada)){
        $local = 
            array(
                'key' => 'decision_ada',
                'value' => $ada,
                'compare' => 'LIKE'
            );
        array_push($meta,$local);
    }
    //Hmerominia apofasis
    if(!empty($decision_date) && $decision_date !=19700101){
        $local = 
            array(
                'key' => 'decision_date',
                'value' => $decision_date,
                'compare' => '='
            );
        array_push($meta,$local);
    };
    $tax = array('relation' => 'AND',);
    if(!empty($organa) && $organa !='all'){
        $local_tax =
        array (
            'taxonomy' =>'epitropi',
            'field' => 'slug',
            'terms' => $organa,
        );
        array_push($tax,$local_tax);
    }
    $args = array(
        'post_type' => 'apofasis',
        'post_status' => 'publish',
        's' => $keyword,
        'paged' => $paged,
        'posts_per_page' => $posts_per_page,
        // 'meta_key' => 'decision_date',
        'meta_query' => $meta,
        'tax_query' => $tax,
        'orderby' => $ajax_orderby
    );

    $apofasis =new WP_Query($args);
    
    if($apofasis->have_posts()){
            ob_start();
                require( locate_template( 'partials/table-apofasis.php' ) );
                $content = ob_get_contents();
            ob_end_clean();
            ob_start();
                echo paginate_links( array(
                'base'         =>  home_url( '/anazitisi-apofaseon'.'/%_%' ),
                'total'        => $apofasis->max_num_pages,
                'current'      => max( 1, $paged ),
                'format'       => '?paged=%#%',
                'show_all'     => false,
                'type'         => 'plain',
                'end_size'     => 2,
                'mid_size'     => 1,
                'add_args'     => false,
                'add_fragment' => '',
                'prev_next' => false,
                ) );
                $pagination = ob_get_contents();
            ob_end_clean();

    }else{
        $content = '<p>Δεν βρέθηκαν αποτελέσματα</p>';
    }
    wp_send_json_success(array('content'=> $content,'max_pages' =>$apofasis->max_num_pages,'paged'=>$paged,'pagination'=> $pagination,'args' => $args));

    die();
}

// Add custom column for Arithmos Apofasis on apofasis custom post type:
    add_filter( 'manage_apofasis_posts_columns', 'set_custom_edit_apofasis_columns' );
    function set_custom_edit_apofasis_columns($columns) {
        unset( $columns['Αριθμός απόφασης'] );
        $columns['decision_number'] = __( 'Αριθμός απόφασης', 'gov-portal' );
        $columns['decision_ada'] = __( 'Αριθμός ΑΔΑ', 'gov-portal' );
         $columns['decision_date'] = __( 'Ημ/νία απόφασης', 'gov-portal' );

        return $columns;
    }

    // Add the data to the custom column for the apofasis post type:
    add_action( 'manage_apofasis_posts_custom_column' , 'custom_apofasis_column', 10, 2 );
    function custom_apofasis_column( $column, $post_id ) {
        switch ( $column ) {

            case 'decision_number' :
                echo get_field('decision_number',$post_id);
                break;
            case 'decision_date' : 
                echo get_field('decision_date',$post_id);
                break;
            case 'decision_ada' : 
                echo get_field('decision_ada',$post_id);
                break;


        }
    }
    add_filter( 'manage_edit-apofasis_sortable_columns', 'set_custom_apofasis_sortable_columns' );

    //Make sortable the columns decision_number & decision_date (ACF fields)
    function set_custom_apofasis_sortable_columns( $columns ) {
    $columns['decision_number'] = 'decision_number';
    $columns['decision_date'] = 'decision_date';

    return $columns;
    }

    add_action( 'pre_get_posts', 'apofasis_custom_orderby' );

    function apofasis_custom_orderby( $query ) {
        if ( ! is_admin() )
            return;

        $orderby = $query->get( 'orderby');
        
        switch( $orderby ){
            case 'decision_number':
                $query->set( 'meta_key', 'decision_number' );
                $query->set( 'orderby', 'meta_value_num' );
                break;
            case 'decision_date':
                $query->set( 'meta_key', 'decision_date' );
                $query->set( 'orderby', 'meta_value_num' );
                break;
            default: break;
        }
    }
//Set posts_per_page limitation on the taxonomy of mec_category
function mec_category_pre_get_posts( $query ) {
    if (is_tax('mec_category') && !is_admin( )) {
		set_query_var('posts_per_page',5);
        set_query_var('order','DESC');
        set_query_var('meta_key','mec_start_date');
        set_query_var('orderby','meta_value_num');
    }elseif(is_archive('mec-events') && !is_admin( )){
        $query->set('posts_per_page',5);
    }
}
add_action( 'pre_get_posts','mec_category_pre_get_posts' );

//Remove menu pages from user role Organizer
add_action( 'admin_init', 'organizer_remove_menu_pages' );

function organizer_remove_menu_pages() {
    $excluded = array('edit.php','edit.php?post_type=municipality','edit.php?post_type=services','edit.php?post_type=apofasis','edit.php?post_type=activities','edit.php?post_type=guide','edit.php?post_type=competitions','edit.php?post_type=page','edit.php?post_type=dae_download','wpcf7','cmmrm','ultimate-blocks-settings','sitepress-multilingual-cms/menu/languages.php');
    if(is_user_logged_in() && current_user_can('organizer')){
        foreach($excluded as $exclude){
            remove_menu_page($exclude);
        }
    }
}
//Redirect user role Organizer if he tries to enter on the below urls
function organizer_redirect(){
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $excluded = array('edit.php?post_type=municipality','edit.php?post_type=services','edit.php?post_type=apofasis','edit.php?post_type=activities','edit.php?post_type=guide','edit.php?post_type=competitions','edit.php?post_type=page','edit.php?post_type=dae_download','wpcf7','cmmrm','ultimate-blocks-settings','sitepress-multilingual-cms/menu/languages.php');
    foreach($excluded as $exclude){
        if (preg_match("/\b".$exclude."\b/iu",$url) && current_user_can('organizer')) {
            wp_redirect('/wp-admin/');
            exit;
        }
    }
}
add_action('init','organizer_redirect');

// Remove updates check for non admins and non Crowdpolicy

$current_user = wp_get_current_user();
if(!strpos($current_user->user_email, 'crowdpolicy')){
	add_action( 'admin_init', 'wpse_38111' );
}
function wpse_38111() {
    remove_submenu_page( 'index.php', 'update-core.php' );
	remove_menu_page( 'plugins.php' );
    remove_submenu_page('themes.php', 'themes.php');
    remove_submenu_page('themes.php', 'theme-editor.php');
    remove_submenu_page('themes.php', 'widgets.php');
	// remove_menu_page( 'themes.php' );
}

function remove_core_updates_for_non_crowdpolicy() {
  global $wp_version;
  return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}

  function photo_uploader_button(){ ?>
  
    <div class="button-container" id="photoUploaderButton">
    <div class="button-icon-container">
    <?php if (ICL_LANGUAGE_CODE == 'el') { ?>
        <a href="<?php echo get_home_url();?>/photos-upload/" target="_blank">
     <?php } else { ?>
        <a href="https://cityportal-kastelorizo.crowdapps.net/photos-upload/?lang=en" target="_blank">
    <?php } ?>
    
    <button class="photobtn">
        <i class="fas fa-camera"></i>
    </button>
  </a>
    </div>
    <div class="button-text-container">
      <span><?php _e('Ανεβάστε τη φωτογραφία σας εδω!','gov-portal'); ?></span>
    </div>
  </div>
  
  <style>
  .photobtn{
    font-size:30px;
    background-color: transparent;
    color:#fff;
    padding:15px;
    cursor: pointer;
  }
  .button-container {
    position: absolute;
    top: 15%;
    right:0;
    z-index:9;
    padding: 5px;
    background-color: #3075AD;
    border:1px solid #3075AD;
    border-radius:10px 0px 0px 8px;
    display: flex;
    justify-content: space-between;
    overflow: hidden;
  }
  
  .button-text-container {
    order:-1;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #3075AD;
    white-space:nowrap; /*Keep text always one line*/
    overflow:hidden;
    width:0;
    transition: width 1s;
    color:#fff;
  }
  
  .button-icon-container {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .button-icon-container:hover + .button-text-container {
    width:300px;
  }
  @media screen and (max-width:1000px) {
    .button-text-container {
        display: none !important;
    }
  }
  </style>
  <?php }
  // register shortcode
  add_shortcode('photouploader', 'photo_uploader_button');

// Register Custom Post Type
function photos_post_type() {

    $labels = array(
        'name'                  => _x( 'Φωτογραφίες', 'Post Type General Name', 'city-portal' ),
        'singular_name'         => _x( 'Φωτογραφία', 'Post Type Singular Name', 'city-portal' ),
        'menu_name'             => __( 'Φωτογραφίες', 'city-portal' ),
        'name_admin_bar'        => __( 'Φωτογραφίες', 'city-portal' ),
        'archives'              => __( 'Φωτογραφίες', 'city-portal' ),
        'attributes'            => __( 'Φωτογραφίες', 'city-portal' ),
        'parent_item_colon'     => __( 'Parent Item:', 'city-portal' ),
        'all_items'             => __( 'Φωτογραφίες', 'city-portal' ),
        'add_new_item'          => __( 'Προσθήκη φωτογραφίας', 'city-portal' ),
        'add_new'               => __( 'Προσθήκη φωτογραφίας', 'city-portal' ),
        'new_item'              => __( 'Νέα φωτογραφία', 'city-portal' ),
        'edit_item'             => __( 'Επεξεργασία φωτογραφίας', 'city-portal' ),
        'update_item'           => __( 'Ενημέρωση φωτογραφίας', 'city-portal' ),
        'view_item'             => __( 'Προβολή φωτογραφίας', 'city-portal' ),
        'view_items'            => __( 'Προβολή φωτογραφιών', 'city-portal' ),
        'search_items'          => __( 'Αναζήτηση φωτογραφιών', 'city-portal' ),
        'not_found'             => __( 'Δεν βρέθηκαν', 'city-portal' ),
        'not_found_in_trash'    => __( 'Δεν βρέθηκαν στα απορρήματα', 'city-portal' ),
        'featured_image'        => __( 'Featured Image', 'city-portal' ),
        'set_featured_image'    => __( 'Set featured image', 'city-portal' ),
        'remove_featured_image' => __( 'Remove featured image', 'city-portal' ),
        'use_featured_image'    => __( 'Use as featured image', 'city-portal' ),
        'insert_into_item'      => __( 'Εισαγωγή μέσα στο Φωτογραφίες', 'city-portal' ),
        'uploaded_to_this_item' => __( 'Ανέβασμα μέσα στο Φωτογραφίες this item', 'city-portal' ),
        'items_list'            => __( 'Φωτογραφίες', 'city-portal' ),
        'items_list_navigation' => __( 'Φωτογραφίες navigation', 'city-portal' ),
        'filter_items_list'     => __( 'Φωτογραφίες list', 'city-portal' ),
    );
    $args = array(
        'label'                 => __( 'Φωτογραφία', 'city-portal' ),
        'description'           => __( 'Photo gallery', 'city-portal' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes', 'post-formats' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'menu_icon'             => 'dashicons-images-alt',
        'capability_type'       => 'post',
    );
    register_post_type( 'photos', $args );

}
add_action( 'init', 'photos_post_type', 0 );

//Define AJAX URL
function myplugin_ajaxurl() {

   echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}
add_action('wp_head', 'myplugin_ajaxurl');

//The Javascript
function ajax_call_photos(){ ?>
<script>
jQuery(document).ready(function($) {
    // This is the variable we are passing via AJAX
    var text = 'Υποβολή Φωτογραφίας';
    // This does the ajax request (The Call).

    $( ".submit-photos" ).click(function(e) {
        e.preventDefault();
        const file = $('#fileToUpload').prop('files')[0];
        let form_data = new FormData();

        form_data.append('file', file);
        form_data.append('action', 'photo_upload_ajax_request');
        form_data.append('nonce', '<?php echo wp_create_nonce('photos-upload-custom-cp-nonce'); ?>');

        $.ajax({
            url: ajaxurl, // Since WP 2.8 ajaxurl is always defined and points to admin-ajax.php
            type: 'post',
            contentType: false,
            processData: false,
            data: form_data,
            success:function(response) {
                // This outputs the result of the ajax request (The Callback)
                // const result = JSON.parse(response);
                console.log(response);
                let data = response.data;
                console.log(data);
                let button;
                if (data.indexOf('Thank you for your photo') > -1){
                    Swal.fire(
                    '<?php _e('Σας ευχαριστούμε!','gov-portal')?>',
                    '<?php _e('Η φωτογραφία σας ανέβηκε!','gov-portal')?>',
                    'success'
                    );
                    button = document.querySelector('.swal2-confirm');
                    $(button).click(function(){
                        location.reload();
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: '<?php _e('Παρουσιάστηκε σφάλμα!','gov-portal')?>',
                        text: '<?php _e('Λάθος τύπος αρχείου, ξαναπροσπαθήστε!','gov-portal')?>',
                        });
                        button = document.querySelector('.swal2-confirm');
                        $(button).click(function(){
                        location.reload();
                        }); 
                }
            },
            error: function(errorThrown){
                window.alert(errorThrown);
            }
        });
    });
});
</script>
<?php }
add_action('wp_footer', 'ajax_call_photos');

function photo_upload_ajax_request() {

    // The $_REQUEST contains all the data sent via AJAX from the Javascript call
    if ( isset($_REQUEST) ) {
        
        $file_to_upload = $_FILES['file'];

        if ( ! wp_verify_nonce( $_REQUEST['nonce'], 'photos-upload-custom-cp-nonce' ) || wp_verify_nonce( $_REQUEST['nonce'], 'photos-upload-custom-cp-nonce' ) > 1) {
            @unlink( $file_to_upload['tmp_name'] );
            wp_send_json_error(new WP_Error( 'verification', "Not allowed to do that, go back!" ));
        }
        
        // Check if file is image
        $finfo      = finfo_open(FILEINFO_MIME_TYPE);
        $mimetype   = finfo_file($finfo, $file_to_upload['tmp_name']);

        if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/gif' || $mimetype == 'image/png') {
            // continue
        } else {
            @unlink( $file_to_upload['tmp_name'] );
            $error = new WP_Error( 'mimetype', "The source file type $mimetype is not supported" );
            wp_send_json_error($error);
        }

        if (!function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }

        $uploaded_file = media_handle_sideload($file_to_upload);
        if ( is_wp_error( $uploaded_file ) ) {
            @unlink( $file_to_upload['tmp_name'] );
            wp_send_json_error($uploaded_file);
        }

        // Add new photo cpt and add the image to it
        $new_post = array(
            'post_status'	=> 'pending',
            'post_type'		=> 'photos'
        );

        $post_id = wp_insert_post( $new_post );

        wp_update_post(
            array(
                'ID'         => $post_id,
                'post_title' => "Νέα φωτογραφία: $post_id"
            )
        );

        if(!update_field('field_619642513e176', $uploaded_file, $post_id)) wp_send_json_error(new WP_Error( 'acf', "The source file was not inserted to the field" ));

        wp_send_json_success(__('Thank you for your photo', 'city-portal'));
    }
    wp_send_json_error(new WP_Error( 'request_error', "Oops something went really bad, try again later" ));
}
// This bit is a special action hook that works with the WordPress AJAX functionality.
add_action( 'wp_ajax_photo_upload_ajax_request', 'photo_upload_ajax_request' );
add_action( 'wp_ajax_nopriv_photo_upload_ajax_request', 'photo_upload_ajax_request' ); 


if ( !current_user_can( 'edit_users' ) || !strpos($current_user->user_email, 'crowdpolicy')) {
  add_filter('pre_site_transient_update_core','remove_core_updates_for_non_crowdpolicy');
  add_filter('pre_site_transient_update_plugins','remove_core_updates_for_non_crowdpolicy');
  add_filter('pre_site_transient_update_themes','remove_core_updates_for_non_crowdpolicy');
  remove_action( 'welcome_panel', 'wp_welcome_panel' );
}

wp_enqueue_style('swiper-css', get_template_directory_uri() . '/assets/libs/swiper-bundle.min.css');
wp_enqueue_script('swiper-js', get_template_directory_uri() . '/assets/libs/swiper-bundle.min.js', array('jquery'), '', true);