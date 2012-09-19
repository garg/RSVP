<?php
/**
 * Edit Event
 *
 * Allows user to edit name and date details of a previously added event.
 */

// Include core settings file.
include 'init.php';

// Is user logged in?
// If not redirect to index.php.
if( !logged_in() ) {

	header( 'Location: index.php' );
	exit();
}

// Include header file
include 'template/header.php';
?>

<h3>Edit Event</h3>

<?php
// Has POST form data been received?
if( isset( $_POST['edit_event_name'], $_POST['edit_event_day'], $_POST['edit_event_month'], $_POST['edit_event_year'] ) ) {
	
	$edit_event_name 	=	$_POST['edit_event_name'];
	$edit_event_day 	=	(int)$_POST['edit_event_day'];
	$edit_event_month 	=	(int)$_POST['edit_event_month'];
	$edit_event_year 	=	(int)$_POST['edit_event_year'];
	
	$errors = array();
	
	// Do all the form fields contain data?
	if( empty( $edit_event_name ) || empty( $edit_event_day ) || empty( $edit_event_year )) {
		
		$errors[] = 'Please supply all requested information.';
	} else {
		
		// Has a valid date been supplied?
		if( checkdate( $edit_event_month, $edit_event_day, $edit_event_year ) == false ) {
			 
			$errors[] = 'Please supply a valid date.';

		} else {
		
			// Convert date to timestamp.
			$edit_event_date = $edit_event_year . '-' . $edit_event_month . '-' . $edit_event_day;
			$edit_event_timestamp = strtotime( $edit_event_date );
		
			// Is the date supplied in the future?
			if( $edit_event_timestamp < time() ) {
	
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
		
		// Edit 'events' table then redirect to View Event.
		edit_event( $event_data['event_id'], $edit_event_name, $edit_event_timestamp );
		
		header( 'Location: view_event.php' );
		exit();
	}	
} else {
	
	// If POST data has not been received set variables based on init.php's $event_data array.
	
	$edit_event_name 	=	$event_data['event_name'];
	$edit_event_day 	=	date( 'j', $event_data['event_date'] );
	$edit_event_month 	=	date( 'n', $event_data['event_date'] );
	$edit_event_year 	=	date( 'Y', $event_data['event_date'] );
}
?>

<form action="" method="post">
	<p>
		Event Name:<br />
		<input type="text" maxlength="35" name="edit_event_name" value="<?php echo $edit_event_name; ?>" />
	</p>
	<p>
		Event date:<br />
		<input type="text" maxlength="2" size="2" name="edit_event_day" value="<?php echo $edit_event_day; ?>" />
		
		<select name="edit_event_month">
			<option value="1" <?php month_selected( $edit_event_month, 1 ); ?>>January</option>
			<option value="2" <?php month_selected( $edit_event_month, 2 ); ?>>February</option>
			<option value="3" <?php month_selected( $edit_event_month, 3 ); ?>>March</option>
			<option value="4" <?php month_selected( $edit_event_month, 4 ); ?>>April</option>
			<option value="5" <?php month_selected( $edit_event_month, 5 ); ?>>May</option>
			<option value="6" <?php month_selected( $edit_event_month, 6 ); ?>>June</option>
			<option value="7" <?php month_selected( $edit_event_month, 7 ); ?>>July</option>
			<option value="8" <?php month_selected( $edit_event_month, 8 ); ?>>August</option>
			<option value="9" <?php month_selected( $edit_event_month, 9 ); ?>>September</option>
			<option value="10" <?php month_selected( $edit_event_month, 10 ); ?>>October</option>
			<option value="11" <?php month_selected( $edit_event_month, 11 ); ?>>November</option>
			<option value="12" <?php month_selected( $edit_event_month, 12 ); ?>>December</option>
		</select>
		
		<input type="text" maxlength="4" size="4" name="edit_event_year" value="<?php echo $edit_event_year; ?>" />
	</p>
	<p>
		<input type="submit" value="Edit Event" />
	</p>
</form>

<?php 
// Include footer file.
include 'template/footer.php';
?>