<?php
/*
** Events.func.php
** Defines functions primarily relating to the 'events' database.
*/

function event_exists() {
	
	if(!empty( $event_data)) {
		
		return true;
	} else {
		
		$query = mysql_query( "SELECT COUNT(`event_id`) FROM `events` WHERE `user_id`=" . $_SESSION['user_id'] );
		
		return ( mysql_result( $query, 0 ) == 0) ? false : true;
	}
}

function get_event() {
	
	$query = mysql_query( "SELECT `event_name`, `event_date` FROM `events` WHERE `user_id`=" . $_SESSION['user_id'] );
	
	$query_result = mysql_fetch_assoc( $query );
	return $query_result;
}

function create_event( $name, $date ) {
	
	$name = mysql_real_escape_string( $name );
	$date = (int)$date;
	
	mysql_query( "INSERT INTO `events` VALUES ('', '" . $_SESSION['user_id'] . "', '$name', '$date')" );
}

?>