<?
/**
 * Guest Response
 *
 * Allows guest to respond to invitation.
 */

// Include core settings file. 
include 'init.php';
include 'template/header.php';

// Has form data been received?
if( isset( $_POST['response_id'] ) ) {

	$response_id = $_POST['response_id'];
	$response_attending = ( $_POST['response_attending'] == 'on' ) ? 'Y' : 'N';
	$response_vegetarian = ( $_POST['response_vegetarian'] == 'on' ) ? 'Y' : 'N';
	
	// Has hidden 'response_plus1' value of 'F' been received?
	if( $_POST['response_plus1'] != 'F' ) {
		
		// If 'F' has not been received set $response_plus1 to 'Y' or 'N' depending on whether checkbox has been ticked.
		$response_plus1 = ( $_POST['response_plus1'] == 'on' ) ? 'Y' : 'N';
	} else {
		
		// If 'F' has been received set $response_plus1 to 'F'.
		$response_plus1 = 'F';
	}
	
	// Update 'guests' table with guest response data and redirect to index.php.
	guest_response( $response_id, $response_attending, $response_vegetarian, $response_plus1 );
	
	header('Location: index.php');
	exit();

// Has GET data been received?
} elseif( isset( $_GET['guest_id'] ) ) {

	$guest_id = $_GET['guest_id'];
	
	$errors = array();
	
	// Does $guest_id contain data?
	if( empty( $guest_id ) ) {
	
		$errors[] = 'Please supply invitation number';
	} else {
	
		// Has user manually supplied a value that is too long?
		if( strlen( $guest_id ) > 11 ) $errors[] = 'String length must be less than 11';
		
		// Has user supplied string data rather than numeric?
		if( is_numeric( $guest_id ) === false ) $errors[] = 'Numbers only';
	}
	
	// Have any errors been returned?
	if( !empty( $errors )) {
	
		foreach( $errors as $error ) {
		
			echo '<span class="error">' . $error . '</span><br />';
		}
		
	} else {
		
		// Obtain full guest data.
		$guest_data = get_guest_by_id( $guest_id );
		
		// If no data returned id is incorrect, supply form to correct data.
		if( empty( $guest_data ) ) {
			?>
			
			<p>Invitation number not recognised.</p>
			<form action="" method="get">
				<p>
					<input type="text" name="guest_id" maxlength="11" value="<?php echo $guest_id; ?>" /><br />
					<input type="submit" name="Respond" />
				</p>
			</form>
			
			<?php
		} else {
			
			// Set variables for all data returned from SQL query.
			
			$guest_name = $guest_data['guest_name'];
			$guest_attending = $guest_data['guest_attending'];
			$guest_vegetarian = $guest_data['guest_vegetarian'];
			$guest_plus1 = $guest_data['guest_plus1'];
			
			$user_name_1 = $guest_data['user_name_1'];
			$user_name_2 = $guest_data['user_name_2'];
			
			$event_name = $guest_data['event_name'];
			$event_date = $guest_data['event_date'];
			?>
			
			<h3><?php echo $guest_name; ?></h3>
			<p><?php echo $user_name_1; ?> and <?php echo $user_name_2; ?> invite you to <?php echo $event_name; ?> on <?php echo date( 'd F Y', $event_date ); ?></p>
			
			<form action="" method="post">
				<input type="hidden" name="response_id" value="<?php echo $guest_id; ?>">
				<input type="checkbox" name="response_attending" <?php if( $guest_attending == 'Y' ) echo 'checked'; ?> /> I will be attending.
				<input type="checkbox" name="response_vegetarian" <?php if( $guest_vegetarian == 'Y' ) echo 'checked'; ?> /> I require vegetarian food.
				<?php if( $guest_plus1 != 'F' ) : ?>
					<input type="checkbox" name="response_plus1" <?php if( $guest_plus1 == 'Y' ) echo 'checked'; ?> /> I will be bringing a guest.
				<?php else : ?>
					<input type="hidden" name="response_plus1" value="F" />
				<?php endif; ?>
				<br />
				<input type="submit" value="Respond" />
			</form>
			<?php
		}
	}
}

// Include footer file.
include 'template/footer.php';
?>