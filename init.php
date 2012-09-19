<?php
/**
 * Init
 *
 * Contains site settings and links to function documents.
 */

// Start output buffering and session.
ob_start();
session_start();

// Connect to MySQL server and select database.
mysql_connect( 'localhost', 'root', 'henshin' );
mysql_select_db( 'rsvp' );

// Include function files.
include 'functions/users.func.php';
include 'functions/events.func.php';
include 'functions/guests.func.php';

// Is user logged in?
if( logged_in()) {
	
	// If so select user data from database and set to array.
	$user_data = user_data();
	
	// Has the user registered an event?
	if( event_exists()) {
		
		// If so select event data from database and set to array.
		$event_data = get_event();
	}
	
}

// Function to determine default month selection in forms.
function month_selected( $event_month, $option_month ) {
			
	if( $event_month == $option_month ) {
				
		echo 'selected="selected"';
	}
}
?>