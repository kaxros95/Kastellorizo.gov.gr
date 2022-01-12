<?php        
    $titlos = get_field('decision_subject',get_the_ID());
    $ar_apofasis = get_field('decision_number',get_the_ID());
    $etos_apofasis = get_field('decision_year',get_the_ID());
    $date_apofasis = get_field('decision_date',get_the_ID());
    $ada = get_field('decision_ada',get_the_ID());
    $organo = get_the_terms(get_the_ID(),'epitropi');
    $file_apofasis = get_field('decision_file',get_the_ID());
    $file_link = get_field('decision_link',get_the_ID());
?>
<div class="container">
    <h2> <?= $titlos ?> </h2>
    <div class="inner">
        <div class="decision_number">
            <p>
                <i class="fas fa-angle-right" aria-hidden="true"></i>
                <?php echo get_field_object('decision_number')['label'] ?>:
            </p>
            <span> <?= $ar_apofasis ?> </span>
        </div>
        <div class="decision_year">
            <p>
                <i class="fas fa-angle-right" aria-hidden="true"></i>
                <?php echo get_field_object('decision_year')['label'] ?>:
            </p>
            <span> <?= $etos_apofasis ?> </span>
        </div>
        <div class="decision_date">
            <p>
                <i class="fas fa-angle-right" aria-hidden="true"></i>
                <?php echo get_field_object('decision_date')['label'] ?>:
            </p>
            <span> <?= $date_apofasis ?> </span>
        </div>
        <?php if($ada): ?>
        <div class="decision_ada">
            <p>
                <i class="fas fa-angle-right" aria-hidden="true"></i>  
                <?php echo get_field_object('decision_ada')['label'] ?>:
            </p>
                <span>
                    <a href='https://et.diavgeia.gov.gr/decision/view/<?php echo $ada ?>'target="_blank"> 
                        <?= $ada ?>
                    </a> 
                </span>
        </div>
        <?php endif; ?>
        <div class="decision_organo">
            <p>
                <i class="fas fa-angle-right" aria-hidden="true"></i>
                Συλλογικό Όργανο: 
            </p>
            <span><?= $organo[0]->name ?></span>
        </div>
        <?php if($file_apofasis || $file_link): 

            if($file_link){
                $url = get_site_url() . '/apofasis-download/' . $file_link;
            }else if($file_apofasis){
                $url = $file_apofasis;
            }
             $dir = get_stylesheet_directory_uri() . '/assets/file-icons/';
             $ext = pathinfo($url, PATHINFO_EXTENSION);
             
                switch ($ext) {
                case 'x-citrix-jpeg':
                case 'jpeg':
                    $media_icon = $dir . 'jpg-file.png';
                    break;
                case 'png':
                    $media_icon = $dir . 'png-file.png';
                    break;
                case 'doc':
                    $media_icon = $dir . 'docx-file.png';
                    break;
                case 'docx':
                    $media_icon = $dir . 'docx-file.png';
                    break;
                case 'pdf':
                    $media_icon = $dir . 'pdf-file.png';
                    break;
                case 'mp4':
                    $media_icon = $dir . 'mp4-file.png';
                    break;
                case 'vnd.ms-excel':
                    $media_icon = $dir . 'xlsx-file.png';
                    break;
                default:
                    $media_icon = $dir . 'generic-file.png';
                    break;
                }
        ?>
        <div class="decision_file">
            <p>
                <i class="fas fa-angle-right" aria-hidden="true"></i>
                <?php echo get_field_object('decision_file')['label'] ?>:
            </p>
            <a href="<?php echo $url ?>"><img src="<?= $media_icon ?>"></a>
        </div>
        <?php endif; ?>
    </div>
    
    <div class="posts">
    <?php $prev_post = get_previous_post();
    if ( ! empty( $prev_post ) ): ?>
        <div class="post-previous">
            <a href="<?php echo get_permalink( $prev_post->ID ); ?>">
                <span class="arrow">
                    <i class="fas fa-angle-left" aria-hidden="true"></i>
                </span>
                <p> Προηγούμενη απόφαση </p>
            </a>
        </div>

    <?php endif; ?>
    <?php $next_post = get_next_post();
    if ( ! empty( $next_post ) ): ?>
        <div class="post-next">
            <a href="<?php echo get_permalink( $next_post->ID ); ?>">
                <p> Επόμενη απόφαση </p>
                <span class="arrow">
                    <i class="fas fa-angle-right" aria-hidden="true"></i>
                </span>
            </a>
        </div>
    <?php endif; ?>
    </div>
</div>