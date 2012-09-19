<?php
/**
 * Edit guest
 * 
 * Allows user to edit details of one of their guests.
 */

// Include core settings file.
include 'init.php';

// Is user logged in?
// If not redirect to index.php.
if( !logged_in() ) {

	header( 'Location: index.php' );
	exit();
}

// Include header file.
include 'template/header.php';
?>

<h3>Add Guests</h3>

<?php
// Has GET value been supplied?
if( isset( $_GET['guest_id'] ) ) {
	
	$guest_id = $_GET['guest_id'];
	
	// Has POST form data also been received?
	if( isset( $_POST['guest_name'] ) ) {
	
		$guest_name 	= $_POST['guest_name'];
		
		// Has user checked the 'plus1' checkbox?
		if ( $_POST['guest_plus1'] == 'on' ) {
			
			// If 'plus1' was originally set as 'F' (forbidden) set it as a blank field.
			// Otherwise set it as its original setting ( 'Y' / 'N' / '' ).
			$guest_plus1 = ( $_POST['original_plus1'] == 'F' ) ? '' : $_POST['original_plus1'];
		} else {
			
			// If 'plus1' is checked set it as 'F'.
			$guest_plus1 = 'F';
		}
		
		$errors = array();
		
		// Does $guest_name contain data?
		if( !empty( $guest_name )) {
			
			// Is $guest_name longer than 35 characters?
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
			
			// Edit 'guests' table and redirect to View Event.
			edit_guest( $guest_id, $guest_name, $guest_plus1 );
			
			header('Location: view_event.php');
			exit();
		}
	} else {
	
		// If POST data is not available use GET supplied $guest_id to obtain data.
		$guest_data = get_guest_by_id( $guest_id );
		
		$guest_name = $guest_data['guest_name'];
		$guest_plus1 = $guest_data['guest_plus1'];
	}
} else {
	
	// If no GET data has been supplied redirect back to View Event.
	header('Location: view_event.php');
	exit();
}
?>

<form action="" method="post">
	<p>
		Guest Name: <input type="text" name="guest_name" value="<?php echo $guest_name; ?>" maxlength="35"><br />
		Allow Additional Guest? <input type="checkbox" name="guest_plus1" <?php if( $guest_plus1 != 'F' ) echo 'checked'; ?> /><br />
		<input type="hidden" name="original_plus1" value="<?php echo $guest_plus1; ?>">
		<input type="submit" value="Update">
	</p>
</form>

<?php 
// Include footer file.
include 'template/footer.php';
?>