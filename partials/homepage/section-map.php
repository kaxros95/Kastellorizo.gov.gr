<?php
if (ICL_LANGUAGE_CODE == 'en')
{
  $mapHide = 'display: none';
}else{
    $mapHide = 'display: block';
}
/**
 * Google Map section of the Front page
 */

// Get map info from the Admin Menu with ACF
$radio_button = get_field('home_map')['home_map_show_hide'];
$map = get_field('google_map_settings', 'option');
$projects_at_map = $map['map_projects_url'];
$map_zoom = $map['map_zoom'];
$map_longitude = $map['map_longitude'];
$map_latitude = $map['map_latitude'];
$google_maps_key = $map['google_maps_key'];
$marked_area_points = $map['map_points'];
// $kml_map_id = $map['map_id'];
if($radio_button=="true"):
?>

<div class="map-wrapper" style="<?php echo $mapHide ?>">
  <?php if ($marked_area_points):
    $filters = array();
    foreach ($marked_area_points as $point)
    {
        array_push($filters, $point['pin_category']);
    }
    $filters = array_filter(array_unique($filters, SORT_REGULAR));
?>

    <div class="map-filters-wrapper">
      <div class="map-filters">

        <h4>ΣΤΟΙΧΕΙΑ ΧΑΡΤΗ</h4>
        <p>Επιλέξτε μια ή παραπάνω επιλογές και δείτε τα σημεία στο χάρτη</p>

        <span style="font-weight:700;"><?php echo get_field('map_above_filters_title', 'option'); ?></span>
        <ul class="filters-wrapper">
          <?php
    console_log($filters);
    foreach ($filters as $filter)
    {
?>
              <div class="filter custom-control custom-checkbox mr-sm-2">
                <?php //echo (get_stylesheet_directory_uri().'/assets/img/map-filters/'.$point['filter']['value'].'.svg'); #the path for the filter icon
        
?>
                <label class="custom-control-label" for="<?php echo $filter['value']; ?>">
                  <?php echo $filter['label']; ?>
                  <input type="checkbox" class="custom-control-input" id="<?php echo $filter['value']; ?>" checked>
                  <span class="checkmark"></span>
                </label>
              </div>
            <?php
    } ?>
            <div class="filter custom-control custom-checkbox mr-sm-2">
              <?php //echo (get_stylesheet_directory_uri().'/assets/img/map-filters/'.$point['filter']['value'].'.svg'); #the path for the filter icon
    
?>
              <label class="custom-control-label" for="all-pins">
                <?php _e('Επιλογή/ Απoεπιλογή όλων', 'gov-portal'); ?>
                <input type="checkbox" class="custom-control-input" id="all-pins" checked>
                <span class="checkmark"></span>
              </label>
            </div>
          </ul>
        </div>
      </div>
    <?php
endif; ?>
    <div id="map" style="height: 600px;"></div>
    <?php if($projects_at_map): ?>
    <a target="_blank" href="<?php echo $projects_at_map;?>" class="cta-btn">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/crowdapps/projectatmaps.png" alt="Crowdapp logo">
      <p>Δείτε τα έργα μας, μέσω της πλατφόρμας <b>Έργα σε χάρτη</b></p>
    </a>
    <?php endif; ?>
  </div>

<script>
  function initMap() {
    var infoWindow = new google.maps.InfoWindow();
    //var geocoder = new google.maps.Geocoder();

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: <?php echo $map_zoom; ?>,
      center: {
        lat: <?php echo $map_latitude; ?>,
        lng: <?php echo $map_longitude; ?>
      },
      disableDefaultUI: true,
      clickableIcons: false
    });
    // Serving the KML file from Server **CURRENTLY NOT AVAILABLE**
    // var kmlLayer = new google.maps.KmlLayer({
    //   url: 'http://development.crowdpolicy.com/city-portal-dev/wp-content/themes/city-portal/assets/kml/Mosxato_Tayros_kml.kml',
    //   map: map
    // });

    // Serving the KML file through google my maps good but not the correct way
    // <?php // if($kml_map_id):

?>
    //   var ctaLayer = new google.maps.KmlLayer({
    //     url: "https://www.google.com/maps/d/kml?forcekml=1&mid=<?php // echo $kml_map_id;

?>",
    //     map: map,
    //     suppressInfoWindows : true,
    //     clickable: false
    //   });
    // <?php // endif;

?>

    let pinColor;
    var markers = [];

    <?php if ($marked_area_points):

    foreach ($marked_area_points as $point)
    { ?>

        <?php if ($point['pin_longitude'] && $point['pin_latitude'])
        { ?>

          pinColor = '<?php echo $point['pin_category']['value']; ?>';

          marker = new google.maps.Marker({
            position: {
              lat: <?php echo $point["pin_latitude"]; ?>,
              lng: <?php echo $point["pin_longitude"]; ?>
            },
            map: map,
            animation: google.maps.Animation.DROP,
            title: '<?php echo $point["descriptionicon"]; ?>',
            icon: new google.maps.MarkerImage('<?php echo (get_stylesheet_directory_uri() . '/assets/img/map-pins/' . $point['pin_category']['value']); ?>.svg', null, null, null, new google.maps.Size(22, 22)),

          });
          marker.set("id", '<?php echo $point['pin_category']['value']; ?>');
          markers.push(marker);

          google.maps.event.addListener(marker, "click", function(evt) {
            infoWindow.setContent(this.get('title') + '</br></br>' + '<?php echo ($point["address"]? "Διεύθυνση: ".$point["address"]."</br>" :""); ?><a style="color:blue;" target="_blank" href="https://www.google.com/maps/search/?api=1&query=<?php echo ($point["pin_latitude"] .','. $point["pin_longitude"]);?>">Οδηγίες <i class="fas fa-route" aria-hidden="true"></i></a>'); // https://www.google.com/maps/search/?api=1&query=47.5951518,-122.3316393 for the search link
            infoWindow.open(map, this);
          });

      <?php
        }
    } ?>

var filterCheck = document.querySelectorAll('.filters-wrapper input[type="checkbox"]');
        var Allcheckbox = document.getElementById('all-pins');
        // console.log(filterCheck);
        Allcheckbox.addEventListener('change', (e) => {
          if (e.target.checked) {
            for (const checkbox of filterCheck) {
              if (!checkbox.checked) {
                checkbox.checked = true;
              }
            }
          } else {
            for (const checkbox of filterCheck) {
              if (checkbox.checked) {
                checkbox.checked = false;
              }
            }
          }
        })
        filterCheck.forEach(checkbox => {
          // hide every map cat except the buildings
          if (checkbox.id !== 'building') {
            markers.forEach(function(marker) {
              if (marker.get("id") == checkbox.id) {
                marker.setVisible(false);
                checkbox.checked = false;
              } else if (checkbox.id === 'all-pins') {
                checkbox.checked = false;
              }
            })
          }
          google.maps.event.addDomListener(checkbox, 'change', function(e) {
            if (e.target.checked) {
              markers.forEach(function(marker) {
                if (marker.get("id") == e.target.id) {
                  marker.setVisible(true);
                  // console.log(marker)
                } else if (e.target.id === 'all-pins') {
                  marker.setVisible(true);
                  // for (const checkbox of filterCheck){
                  //   if(!checkbox.checked && e.target.id != 'all-pins'){
                  //     checkbox.checked = true;
                  //   }
                  // }
                }
              })
            } else {
              markers.forEach(function(marker) {
                if (marker.get("id") == e.target.id) {
                  marker.setVisible(false);
                } else if (e.target.id === 'all-pins') {
                  marker.setVisible(false);
                  // for (const checkbox of filterCheck){
                  //   if(checkbox.checked && e.target.id != 'all-pins'){
                  //     checkbox.checked = false;
                  //   }
                  // }
                }
              })
            }
          });
        });
      <?php endif; ?>
  } 
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OverlappingMarkerSpiderfier/1.0.3/oms.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_maps_key; ?>&callback=initMap&language=gr&region=GR" async defer>
</script>
<?php endif; ?>