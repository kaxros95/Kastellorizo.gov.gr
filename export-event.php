<?php 
ini_set('error_reporting', E_ALL );
ini_set('display_errors', 1 );
require_once("../../../wp-load.php");
require_once('SimpleXLSXGen.php');

if(isset($_GET['ID']) && !empty($_GET['ID'])){
    $id = $_GET['ID'];
};

$title = get_the_title($id);


$event_interest_surname = get_field('event_repeater')['event_interest_surname'];
$event_interest_email = get_field('event_repeater')['event_interest_email'];

if( have_rows('event_repeater',$id) ){
     while( have_rows('event_repeater', $id) ): the_row();

        $event_interest_name_label = get_sub_field_object('event_interest_name')['label'];
        $event_interest_surname_label = get_sub_field_object('event_interest_surname')['label'];
        $event_interest_email_label = get_sub_field_object('event_interest_email')['label'];
        
    endwhile;

        $users = [
        [$event_interest_name_label, $event_interest_surname_label, $event_interest_email_label ],
        ];

    while( have_rows('event_repeater', $id) ): the_row();

        $event_interest_name = get_sub_field('event_interest_name');
        $event_interest_surname = get_sub_field('event_interest_surname');
        $event_interest_email = get_sub_field('event_interest_email');

        $users[] = [$event_interest_name, $event_interest_surname, $event_interest_email];
    endwhile;
}

$xlsx = SimpleXLSXGen::fromArray( $users );
$xlsx->downloadAs('event-'.$title.'.xlsx'); // output to browser for download


