<?php
include 'init.php';

if(!logged_in()) {

	header('Location: index.php');
	exit();
}

if( isset( $_GET['guest_id'] )) {

	delete_guests( 'guest', $_GET['guest_id'] );
}
	
header('Location: view_event.php');
exit();

?>