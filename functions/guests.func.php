<?php
/**
 * Guests.Func
 * 
 * Defines functions relating to the 'guests' database.
 */

function add_guest( $name, $plus1, $event_id ) {
	
	$name = mysql_real_escape_string( $name );
	$plus1 = ( $plus1 === true ) ? '' : 'F';
	
	mysql_query( "INSERT INTO `guests` VALUES ('', '" . $_SESSION['user_id'] . "', '$event_id', '$name', '', '', '$plus1')" );
}

function delete_guests( $id_type, $id ) {
	
	$id_type = ( $id_type == 'event' ) ? 'event_id' : 'guest_id';
	$id = (int)$id;
	
	mysql_query( "DELETE FROM `guests` WHERE `$id_type`=$id AND `user_id`=". $_SESSION['user_id'] );
}

function edit_guest( $id, $name, $plus1 ) {
	
	$id = (int)$id;
	$name = mysql_real_escape_string($name);
	$plus1 = mysql_real_escape_string($plus1);
	
	mysql_query( "UPDATE `guests` SET `guest_name`='$name', `guest_plus1`='$plus1' WHERE `guest_id`=$id AND `user_id`=". $_SESSION['user_id'] );
}

function get_guests( $event_id ) {
	
	$guests = array();
	
	$query = mysql_query( "SELECT `guest_id`, `guest_name`, `guest_attending`, `guest_vegetarian`, `guest_plus1` FROM `guests` WHERE `event_id`=$event_id" );
	
	while( $guests_row = mysql_fetch_assoc( $query )) {
		
		$guests[] = array(
			'id' 			=> 	$guests_row['guest_id'],
			'name' 			=> 	$guests_row['guest_name'],
			'attending' 	=> 	$guests_row['guest_attending'],
			'vegetarian' 	=> 	$guests_row['guest_vegetarian'],
			'plus1' 		=> 	$guests_row['guest_plus1']
		);
	}
	
	return $guests;
}

function get_guest_by_id( $id ) {
	
	$id = (int)$id;
	
	$query = mysql_query("
		SELECT `guests`.`guest_name`, `guests`.`guest_attending`, `guests`.`guest_vegetarian`, `guests`.`guest_plus1`,
		`users`.`user_name_1`, `users`.`user_name_2`,
		`events`.`event_name`, `events`.`event_date`
		FROM `guests`
		LEFT JOIN `users`
		ON `guests`.`user_id` = `users`.`user_id`
		LEFT JOIN `events`
		ON `guests`.`user_id` = `events`.`user_id`
		WHERE `guests`.`guest_id`=$id
	");
		
	return mysql_fetch_assoc( $query );
}

function guest_response( $id, $attending, $vegetarian, $plus1 ) {
	
	$id = (int)$id;
	$attending = mysql_real_escape_string( $attending );
	$vegetarian = mysql_real_escape_string( $vegetarian );
	$plus1 = mysql_real_escape_string( $plus1 );
	
	mysql_query( "UPDATE `guests` SET `guest_attending`='$attending', `guest_vegetarian`='$vegetarian', `guest_plus1`='$plus1' WHERE `guest_id`=$id" ); 
}
?>