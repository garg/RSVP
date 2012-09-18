<?php
include 'init.php';

if( !logged_in() ) {

	header( 'Location: index.php' );
	exit();
}

include 'template/header.php';
?>

<h3>Edit Event</h3>

<?php

if( isset( $_POST['edit_event_name'], $_POST['edit_event_day'], $_POST['edit_event_month'], $_POST['edit_event_year'] ) ) {
	
	$edit_event_name 	=	$_POST['edit_event_name'];
	$edit_event_day 	=	(int)$_POST['edit_event_day'];
	$edit_event_month 	=	(int)$_POST['edit_event_month'];
	$edit_event_year 	=	(int)$_POST['edit_event_year'];
	
	$errors = array();
	
	if( empty( $edit_event_name ) || empty( $edit_event_day ) || empty( $edit_event_year )) {
		
		$errors[] = 'Please supply all requested information.';
	} else {
		
		if( checkdate( $edit_event_month, $edit_event_day, $edit_event_year ) == false ) {
			 
			// Why does this keep returning false for valid dates?
			$errors[] = 'Please supply a valid date.';

		} else {
		
			$edit_event_date = mktime( 0, 0, 0, $edit_event_month, $edit_event_day, $edit_event_year );
		
			if( $edit_event_date < time() ) {
	
				$errors[] = 'Please supply a date in the future.';
			}
		}
	}
	
	if( !empty( $errors )) {
	
		foreach( $errors as $error ) {
		
			echo '<span class="error">' . $error . '</span><br />';
		}
	} else {
	
		edit_event( $event_data['event_id'], $edit_event_name, $edit_event_date );
		header( 'Location: view_event.php' );
		exit();
	}	
} else {

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
		
		<?php 
		function month_selected( $event_month, $option_month ) {
			if( $event_month == $option_month ) {
				echo 'selected="selected"';
			}
		}
		?>
		
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

<?php include 'template/footer.php'; ?>