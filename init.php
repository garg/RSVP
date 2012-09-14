<?php
/*
** Init
** Contains site settings and links to function documents.
*/

ob_start();
session_start();

mysql_connect( 'localhost', 'root', 'henshin' );
mysql_select_db( 'rsvp' );

include 'functions/users.func.php';
include 'functions/events.func.php';
include 'functions/guests.func.php';

if( logged_in()) {
	
	$user_data = user_data();
}

if( event_exists()) {

	$event_data = get_event();
}
?>