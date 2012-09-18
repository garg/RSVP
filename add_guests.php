<?php
include 'init.php';

if( !logged_in() ) {

	header( 'Location: index.php' );
	exit();
}

include 'template/header.php';
?>

<h3>Add Guests</h3>

<?php
if( isset( $_POST['guest_name'] ) ) {

	$guest_name 	= $_POST['guest_name'];
	$guest_plus1 	= ( $_POST['guest_plus1'] == 'on' ) ? true : false;
	
	$errors = array();
	
	if( !empty( $guest_name)) {
		if( strlen( $guest_name ) > 35 ) {
			$errors[] = 'Must be less than 35 characters.';
		}
	} else {
		$errors[] = 'Please supply all required information.';
	}
	
	if( !empty( $errors )) {
	
		foreach( $errors as $error ) {
		
			echo $error . '<br />';
		}
	} else {
		add_guest( $guest_name, $guest_plus1, $event_data['event_id'] );
		header('Location: index.php');
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

<?php include 'template/footer.php'; ?>