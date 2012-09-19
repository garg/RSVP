<?php
/**
 * Delete Guest
 *
 * Deletes guest based on supplied GET value.
 */

// Include core settings file.
include 'init.php';

// Is user logged in?
// If not redirect to index.php.
if(!logged_in()) {

	header('Location: index.php');
	exit();
}

// Has GET value 'guest_id' been supplied?
if( isset( $_GET['guest_id'] )) {
	
	// Delete guest with that ID.
	delete_guests( 'guest', $_GET['guest_id'] );
}
	
// Redirect to View Event.
header('Location: view_event.php');
exit();

?>