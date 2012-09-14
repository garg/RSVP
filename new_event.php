<?php
include 'init.php';

if( !logged_in() ) {

	header( 'Location: index.php' );
	exit();
}

include 'template/header.php';
?>

<h3>Create a New Event</h3>

<?php

if( isset( $_POST['new_event_name'], $_POST['new_event_day'], $_POST['new_event_month'], $_POST['new_event_year'] ) ) {
	
	$new_event_name 	=	$_POST['new_event_name'];
	$new_event_day 		=	(int)$_POST['new_event_day'];
	$new_event_month 	=	(int)$_POST['new_event_month'];
	$new_event_year 	=	(int)$_POST['new_event_year'];
	
	$errors = array();
	
	if( empty( $new_event_name ) || empty( $new_event_day ) || empty( $new_event_year )) {
		
		$errors[] = 'Please supply all requested information.';
	} else {
		
		if( checkdate( $new_event_month, $new_event_day, $new_event_year ) == false ) {
			 
			// Why does this keep returning false for valid dates?
			$errors[] = 'Please supply a valid date.';

		} else {
		
			$new_event_date = mktime( 0, 0, 0, $new_event_month, $new_event_day, $new_event_year );
		
			if( $new_event_date < time() ) {
	
				$errors[] = 'Please supply a date in the future.';
			}
		}
	}
	
	if( !empty( $errors )) {
	
		foreach( $errors as $error ) {
		
			echo '<span class="error">' . $error . '</span><br />';
		}
	} else {
	
		create_event( $new_event_name, $new_event_date );
		header( 'Location: index.php' );
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
			<option value="1" <?php if( $new_event_month == 1 ) echo 'selected="selected"'; ?>>January</option>
			<option value="2" <?php if( $new_event_month == 2 ) echo 'selected="selected"'; ?>>February</option>
			<option value="3" <?php if( $new_event_month == 3 ) echo 'selected="selected"'; ?>>March</option>
			<option value="4" <?php if( $new_event_month == 4 ) echo 'selected="selected"'; ?>>April</option>
			<option value="5" <?php if( $new_event_month == 5 ) echo 'selected="selected"'; ?>>May</option>
			<option value="6" <?php if( $new_event_month == 6 ) echo 'selected="selected"'; ?>>June</option>
			<option value="7" <?php if( $new_event_month == 7 ) echo 'selected="selected"'; ?>>July</option>
			<option value="8" <?php if( $new_event_month == 8 ) echo 'selected="selected"'; ?>>August</option>
			<option value="9" <?php if( $new_event_month == 9 ) echo 'selected="selected"'; ?>>September</option>
			<option value="10" <?php if( $new_event_month == 10 ) echo 'selected="selected"'; ?>>October</option>
			<option value="11" <?php if( $new_event_month == 11 ) echo 'selected="selected"'; ?>>November</option>
			<option value="12" <?php if( $new_event_month == 12 ) echo 'selected="selected"'; ?>>December</option>
		</select>
		<input type="text" maxlength="4" size="4" name="new_event_year" value="<?php echo $new_event_year; ?>" />
	</p>
	<p>
		<input type="submit" value="Create Event" />
	</p>
</form>

<?php include 'template/footer.php'; ?>