<?php
include 'init.php';

if(!logged_in()) {

	header('Location: index.php');
	exit();
}

delete_event( $event_data['event_id'] );
delete_guests( 'event', $event_data['event_id'] );
header('Location: index.php');
exit();
?>