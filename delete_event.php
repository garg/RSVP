<?php
/**
 * Delete Event
 *
 * Deletes event tied to currently logged in account.
 */

// Include core settings file.
include 'init.php';

// Is user logged in?
// If not redirect back to index.php.
if(logged_in()) {

	// Delete event.
	delete_event( $event_data['event_id'] );
	
	// Delete all guests associated with this event.
	delete_guests( 'event', $event_data['event_id'] );	
}

// Redirect back to index.php
header('Location: index.php');
exit();
?>