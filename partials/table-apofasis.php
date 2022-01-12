<table id="apofaseis" align="center">
    <thead>
        <tr>
            <th> <?php _e('Τίτλος Απόφασης','gov-portal') ?> </th>
            <th> <?php _e('Αρ. Απόφασης','gov-portal') ?> </th>
            <th> <?php _e('Έτος απόφασης','gov-portal') ?> </th>
            <th> <?php _e('Ημ/νία Απόφασης','gov-portal') ?> </th>
            <th> <?php _e('Συλλογικό Όργανο','gov-portal') ?> </th>
            <th> <?php _e('ΑΔΑ','gov-portal') ?> </th>
            <th> <?php _e('Σχετικό Αρχείο','gov-portal') ?> </th>
        </tr>
    </thead>
    <tbody id="tbody">
    <?php if($apofasis->have_posts()):
        while($apofasis->have_posts()): $apofasis->the_post();
        
        $titlos = get_field('decision_subject',get_the_ID());
        $ar_apofasis = get_field('decision_number',get_the_ID());
        $etos_apofasis = get_field('decision_year',get_the_ID());
        $date_apofasis = get_field('decision_date',get_the_ID());
        $ada = get_field('decision_ada',get_the_ID());
        $organo = get_the_terms(get_the_ID(),'epitropi');
        $file_apofasis = get_field('decision_file',get_the_ID());
        $file_link = get_field('decision_link',get_the_ID());
    ?>
    <tr>
        <td>
            <a href="<?php echo get_permalink(get_the_ID()) ?>" target="_blank">
                <?php echo $titlos ?>
            </a>
        </td>
        <td><?php echo $ar_apofasis ?></td>
        <td><?php echo $etos_apofasis ?></td>
        <td><?php echo $date_apofasis ?></td>
        <td><?php echo $organo[0]->name ?></td>
        <td> 
            <?php if ($ada): ?>
                <a style="text-decoration:underline" href='https://et.diavgeia.gov.gr/decision/view/<?php echo $ada ?>'target="_blank">
                    <?php echo $ada ?></a>
                </a>
            <?php endif; ?>
            
        </td>
        <td>
        <?php if($file_apofasis || $file_link): ?>
            <?php 
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
            <a href="<?php echo $url; ?>"><img src="<?= $media_icon; ?>"></a>
        <?php endif; ?>
        </td>
    <?php 
        endwhile;
        wp_reset_query();
    endif; 
    ?>
    </tbody>
    <tfoot>
        <tr>
            <th> <?php _e('Τίτλος Απόφασης','gov-portal') ?> </th>
            <th> <?php _e('Αρ. Απόφασης','gov-portal') ?> </th>
            <th> <?php _e('Έτος απόφασης','gov-portal') ?> </th>
            <th> <?php _e('Ημ/νία Απόφασης','gov-portal') ?> </th>
            <th> <?php _e('Συλλογικό Όργανο','gov-portal') ?> </th>
            <th> <?php _e('ΑΔΑ','gov-portal') ?> </th>
            <th> <?php _e('Σχετικό Αρχείο','gov-portal') ?> </th>
        </tr>
    </tfoot>
</table>