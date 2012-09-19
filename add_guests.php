<?php
/**
 * Add Guests
 *
 * This page allows registered users to add guests to their event.
 * At present the form only allows one name to be added at a time.
 * This page needs to be updated with a better way of adding names on bulk,
 * possibly using AJAX.
 */

// Include core settings file
include 'init.php';

// Is user logged in?
// If not redirect back to index.php
if( !logged_in() ) {

	header( 'Location: index.php' );
	exit();
}

// Include header file.
include 'template/header.php';
?>

<h3>Add Guests</h3>

<?php
// Has POST form data been received?
if( isset( $_POST['guest_name'] ) ) {

	$guest_name 	= $_POST['guest_name'];
	$guest_plus1 	= ( $_POST['guest_plus1'] == 'on' ) ? true : false;
	
	$errors = array();
	
	// Is there data in $guest_name?
	if( !empty( $guest_name )) {
		
		// Has the user circumvented maxlength and included an name longer than 35 characters?
		if( strlen( $guest_name ) > 35 ) {
			
			$errors[] = 'Must be less than 35 characters.';
		}
	} else {
		
		$errors[] = 'Please supply all required information.';
	}
	
	// Have any errors been returned?
	if( !empty( $errors )) {
	
		foreach( $errors as $error ) {
		
			echo '<span class="error">' . $error . '</span><br />';
		}
	} else {
		
		// Add guest details to guests table then redirect to View Event.
		add_guest( $guest_name, $guest_plus1, $event_data['event_id'] );
		
		header('Location: view_event.php');
		exit();
	}
}
?>

<form action="" method="post">
	<p>
		Guest Name: <input type="text" name="guest_name" maxlength="35"><br />
		Allow Additional Guest? <input type="checkbox" name="guest_plus1"><br />
		<input type="submit" value="Invite">
	</p>
</form>

<?php

// Include footer file.
include 'template/footer.php';
?>