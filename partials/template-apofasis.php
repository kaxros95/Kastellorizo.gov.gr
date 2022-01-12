<?php
/*
 *
 *
 * Template Name: Apofasi Search
 *
 *
*/
get_header();
?>
<?php
//Get all taxonomies terms to populate select field
$terms = get_terms(['taxonomy' => 'epitropi', 'hide_empty' => false, ]);
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
    'post_type' => 'apofasis',
    'post_status' => 'publish',
    'paged' => $paged,
    'posts_per_page'=> 5,
    'meta_query' => array(
        'relation' => 'AND',
        'query_one' => array(
            'key' => 'decision_year',
            'type' => 'NUMERIC',
        ),
        'query_two' => array(
            'key' => 'decision_number',
            'type' => 'NUMERIC',
        ),
    ),
    'orderby'    => array(
        'query_one' => 'DESC',
        'query_two' => 'DESC',
    )
);
$apofasis = new WP_Query($args);

$apofasis_date_array = array();

$startyear = 2010;
$currentyear = date("Y");
while($startyear <= $currentyear){
    array_push($apofasis_date_array, $startyear);
    $startyear++;
}
?>

<section class="apofasi-search">
    <div class="container">
        <div class="apofasi-inner">
            <h2> <?php _e('Κριτήρια Αναζήτησης', 'gov-portal') ?> </h2>
            <form action='' method="POST" id="form">
                <div class="apofasi-keyword">
                    <label for="keyword"> <?php _e('Λέξεις κλειδιά','gov-portal') ?> </label>
                    <input type="text" name="keyword" id="keyword" placeholder="Πληκτρολογήστε λέξεις κλειδιά">
                </div>
                <div class="apofasi-container-inner">
                    <div class="apofasi-column-inner">
                        <div class="apofasi-column-inner-content">
                        <label for="organa"> Συλλογικά Όργανα </label>
                        <select id="organa">
                            <option selected disabled> --Επιλέξτε -- </option>
                            <option value="all"> Όλα </option>
                            <?php foreach ($terms as $term){ ?>
                                <option value="<?php echo $term->slug ?>"> <?php echo $term->name ?> </option>
                            <?php } ?>
                        </select>
                        <label for="ada"> ΑΔΑ </label>
                        <input type="text" name="ada" id="ada" placeholder="Εισάγετε τον αριθμό ΑΔΑ">
                        </div>
                    </div>
                    <div class="apofasi-column-inner">
                        <div class="apofasi-column-inner-content">
                            <label for="etos_apo"> Έτος από: </label>
                            <select name="etos_apo" id="etos_apo">
                                <option selected disabled> --Επιλέξτε -- </option>
                                <?php foreach (array_reverse($apofasis_date_array) as $date){ ?>
                                    <option value="<?php echo $date; ?>"> <?php echo $date; ?> </option>
                                <?php } ?>
                            </select>
                            <label for="etos_mexri"> Έτος μέχρι: </label>
                            <select name="etos_mexri" id="etos_mexri">
                                <option selected disabled> --Επιλέξτε -- </option>
                                <?php foreach ($apofasis_date_array as $date){ ?>
                                    <option value="<?php echo $date; ?>"> <?php echo $date; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="apofasi-column-inner">
                        <div class="apofasi-column-inner-content">
                          <label for="decision_number">Αριθμός απόφασης</label>
                          <input type="number" name="decision_number" id="decision_number" placeholder="Εισάγετε τον αριθμό απόφασης" min=0>
                          <label for="decision_date">Ημερομηνία απόφασης</label>
                          <input type="date" name="decision_date" id="decision_date">
                        </div>
                    </div>
                </div>
                <div class="buttons">
                    <button id="submitbtn" type="submit" value="Αναζήτηση"><span class="fas fa-search" aria-hidden="true"></span> <?php _e('ΑΝΑΖΗΤΗΣΗ','gov-portal') ?> </button>
                    <button id="clearbtn" type="submit" value="Καθαρισμός Φίλτρων"> <?php _e('ΚΑΘΑΡΙΣΜΟΣ ΦΙΛΤΡΩΝ','gov-portal') ?> </button>
                </div>
                <div>
                    <select name="posts_per_page" id="posts_per_page">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="content-container">
      <h2> <?php _e('Αποφάσεις Συλλογικών Οργάνων', 'gov-portal') ?> </h2>
      <div class="content-apofasis">
          <?php require( locate_template( 'partials/table-apofasis.php' ) ); ?>
      </div>
        <div class="pagination">
            <?php 
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
            ?>
        </div>
        <p class="wait"></p>
    </div>
</section>
<?php

get_footer();

?>

<script>
  jQuery(document).ready(function($){
      
      function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
            callback.apply(context, args);
            }, ms || 0);
        };
    }

    function ajax(paged){
      var keyword = $('input[name="keyword"]').val();
      var organa = $('select[id="organa"]').val();
      var etos_apo = $('select[id="etos_apo"]').val();
      var etos_mexri = $('select[id="etos_mexri"]').val();
      var decision_number = $('input[name="decision_number"]').val();
      var decision_date = $('input[name="decision_date"]').val();
      var posts_per_page = $('select[name="posts_per_page"]').val();
      var ada = $('input[name="ada"]').val();

      $.ajax({
        url: '<?php echo admin_url('admin-ajax.php') ?>',
        type: "POST",
        dataType: 'json',
        data: {
          'action': 'apofasi_ajax',
          'keyword': keyword,
          'organa': organa,
          'etos_apo': etos_apo,
          'etos_mexri':etos_mexri,
          'decision_number':decision_number,
          'decision_date':decision_date,
          'posts_per_page':posts_per_page,
          'ada': ada,
          'paged': paged,
          'nonce':'<?php echo wp_create_nonce('ajax-nonce') ?>',
        },
        beforeSend: ()=>{
        let lang = '<?php echo ICL_LANGUAGE_CODE ?>';
        if(lang =='el'){
            $('.wait').text('Φορτώνει...');
        }else {
            $('.wait').text('Loading...');
        };
        $('#submitbtn').attr("disabled", true);
       $('#submitbtn').css({'background-color':'#f2f2f2','color':'#000','cursor':'default'});
       
        },
        success: (data) => {
          $('.wait').text('');
          $('#submitbtn').removeAttr('disabled style');
          $('.content-apofasis').empty().append(data.data.content);
          $('.pagination').empty().append(data.data.pagination);
          console.log(data.data.args);
        },
        error: (error)=>{
            console.log(error);
        }

      })

    }
    $('#submitbtn').on('click',(e)=>{
      e.preventDefault();
      ajax();
    });
    $('#clearbtn').on('click',(e)=>{
        e.preventDefault();
        $('#form')[0].reset();
        ajax();
    });
    $('#posts_per_page').on('change',()=>{
        ajax();
    });
    $('#organa').on ('change',()=>{
        ajax();
    });
    $('#etos_apo').on ('change',()=>{
        ajax();
    });
    $('#etos_mexri').on ('change',()=>{
        ajax();
    });
    $('input[name="decision_number"]').keyup(delay(function (e) {
        ajax();
    }, 300));

    $('input[name="keyword"]').keyup(delay(function (e) {
        ajax();
    }, 300));
    $('input[name="decision_date"]').on('change',()=>{
        ajax();
    });
    $('input[name="ada"]').keyup(delay(function (e) {
        ajax();
    }, 300));
    $(document).on('click','.page-numbers',function(e){
        if(!$(this).hasClass('dots') && !$(this).hasClass('current')){
            e.preventDefault();
            paged = $(this).text();
            paged = paged.replace(',', '');
            ajax(paged);
        }
    });

    
  });
</script>
