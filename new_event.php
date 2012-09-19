<?php
/**
 * New Event
 */

// Include core settings file.
include 'init.php';

// Is user logged in?
if( !logged_in() ) {
	
	// If not redirect to index.php.
	header( 'Location: index.php' );
	exit();
} elseif( event_exists() ) {
	
	header( 'Location: view_event.php' );
	exit();
}

// Include template file.
include 'template/header.php';
?>

<h3>Create a New Event</h3>

<?php

// Has POST data been received?
if( isset( $_POST['new_event_name'], $_POST['new_event_day'], $_POST['new_event_month'], $_POST['new_event_year'] ) ) {
	
	$new_event_name 	=	$_POST['new_event_name'];
	$new_event_day 		=	(int)$_POST['new_event_day'];
	$new_event_month 	=	(int)$_POST['new_event_month'];
	$new_event_year 	=	(int)$_POST['new_event_year'];
	
	$errors = array();
	
	// Do all variables contain data?
	if( empty( $new_event_name ) || empty( $new_event_day ) || empty( $new_event_year )) {
		
		$errors[] = 'Please supply all requested information.';
	} else {
		
		// Is date supplied valid?
		if( checkdate( $new_event_month, $new_event_day, $new_event_year ) === false ) {
			 
			$errors[] = 'Please supply a valid date.';

		} else {
			
			// Convert date to timestamp
			$new_event_timestamp = mktime( 0, 0, 0, $new_event_month, $new_event_day, $new_event_year );
			
			// Is supplied date in the future?
			if( $new_event_timestamp < time() ) {
	
				$errors[] = 'Please supply a date in the future.';
			}
		}
	}
	
	// Have any errors been returned?
	if( !empty( $errors )) {
	
		foreach( $errors as $error ) {
		
			echo '<span class="error">' . $error . '</span><br />';
		}
	} else {
		
		// Create entry for this event on 'events' table and redirect to View Event.
		create_event( $new_event_name, $new_event_timestamp );
		
		header( 'Location: view_event.php' );
		exit();
	}	
}
?>

<form action="" method="post">
	<p>
		Event Name:<br />
		<input type="text" maxlength="35" name="new_event_name" value="<?php echo $new_event_name; ?>" />
	</p>
	<p>
		Event date:<br />
		<input type="text" maxlength="2" size="2" name="new_event_day" value="<?php echo $new_event_day; ?>" />
		<select name="new_event_month">
			<option value="1" <?php month_selected( $new_event_month, 1 ); ?>>January</option>
			<option value="2" <?php month_selected( $new_event_month, 2 ); ?>>February</option>
			<option value="3" <?php month_selected( $new_event_month, 3 ); ?>>March</option>
			<option value="4" <?php month_selected( $new_event_month, 4 ); ?>>April</option>
			<option value="5" <?php month_selected( $new_event_month, 5 ); ?>>May</option>
			<option value="6" <?php month_selected( $new_event_month, 6 ); ?>>June</option>
			<option value="7" <?php month_selected( $new_event_month, 7 ); ?>>July</option>
			<option value="8" <?php month_selected( $new_event_month, 8 ); ?>>August</option>
			<option value="9" <?php month_selected( $new_event_month, 9 ); ?>>September</option>
			<option value="10" <?php month_selected( $new_event_month, 10 ); ?>>October</option>
			<option value="11" <?php month_selected( $new_event_month, 11 ); ?>>November</option>
			<option value="12" <?php month_selected( $new_event_month, 12 ); ?>>December</option>
		</select>
		<input type="text" maxlength="4" size="4" name="new_event_year" value="<?php echo $new_event_year; ?>" />
	</p>
	<p>
		<input type="submit" value="Create Event" />
	</p>
</form>

<?php include 'template/footer.php'; ?>