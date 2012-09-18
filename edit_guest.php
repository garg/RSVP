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
if( isset( $_GET['guest_id'] ) ) {
	
	$guest_id = $_GET['guest_id'];
	
	if( isset( $_POST['guest_name'] ) ) {
	
		$guest_name 	= $_POST['guest_name'];
		
		if ( $_POST['guest_plus1'] == 'on' ) {
		
			$guest_plus1 = ( $_POST['original_plus1'] == 'F' ) ? '' : $_POST['original_plus1'];
		} else {
			
			$guest_plus1 = 'F';
		}
		
		$errors = array();
		
		if( !empty( $guest_name )) {
			if( strlen( $guest_name ) > 35 ) {
				$errors[] = 'Must be less than 35 characters.';
			}
		} else {
			$errors[] = 'Please supply all required information.';
		}
		
		if( !empty( $errors )) {
		
			foreach( $errors as $error ) {
			
				echo '<span class="error">' . $error . '</span><br />';
			}
		} else {
			edit_guest( $guest_id, $guest_name, $guest_plus1 );
			header('Location: view_event.php');
			exit();
		}
	} else {
	
		$guest_data = get_guest_by_id( $guest_id );
		
		$guest_name = $guest_data['guest_name'];
		$guest_plus1 = $guest_data['guest_plus1'];
	}
} else {

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

<?php include 'template/footer.php'; ?>