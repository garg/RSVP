<?php
/*
 * Events.Func
 * 
 * Defines functions relating to the 'events' database.
 */

function create_event( $name, $date ) {
	
	$name = mysql_real_escape_string( $name );
	$date = (int)$date;
	
	mysql_query( "INSERT INTO `events` VALUES ('', '" . $_SESSION['user_id'] . "', '$name', '$date')" );
}

function delete_event( $id ) {

	$id = (int)$id;
	
	mysql_query( "DELETE FROM `events` WHERE `event_id`=$id AND `user_id`=" . $_SESSION['user_id'] );
}

function edit_event( $id, $name, $date ) {

	$id 	= 	(int)$id;
	$name 	= 	mysql_real_escape_string($name);
	$date 	= 	(int)$date;
	
	mysql_query( "UPDATE `events` SET `event_name`='$name', `event_date`='$date' WHERE `event_id`=$id AND `user_id`=" . $_SESSION['user_id'] );
}

function event_exists() {
	
	if( !empty( $event_data ) ) {
		
		return true;
	} else {
		
		$query = mysql_query( "SELECT COUNT(`event_id`) FROM `events` WHERE `user_id`=" . $_SESSION['user_id'] );
		
		return ( mysql_result( $query, 0 ) == 0) ? false : true;
	}
}

function get_event() {
	
	$query = mysql_query( "SELECT `event_id`, `event_name`, `event_date` FROM `events` WHERE `user_id`=" . $_SESSION['user_id'] );
	
	$query_result = mysql_fetch_assoc( $query );
	return $query_result;
}
?>