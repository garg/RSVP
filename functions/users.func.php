<?php
//Check if user is logged in.
function logged_in() {
	
	return isset($_SESSION['user_id']);
}

//Register new user in the database.
function user_register( $name_1, $name_2, $email, $password ) {
	
	$name_1 	= 	mysql_real_escape_string( $name_1 );
	$name_2 	= 	mysql_real_escape_string( $name_2 );
	$email 		= 	mysql_real_escape_string( $email );
	$password 	= 	md5( $password );
	
	mysql_query( "INSERT INTO `users` VALUES ('', '$name_1', '$name_2', '$email', '$password')" );
	
	return mysql_insert_id();
}

//Return data for a specific user
function user_data() {

	$query = mysql_query( "SELECT `user_name_1`, `user_name_2`, `user_email` FROM `users` WHERE `user_id`=" . $_SESSION['user_id']);
	$query_result = mysql_fetch_assoc( $query );
	return $query_result;
}

//Check if supplied email address is already listed in the database.
function user_exists( $email ) {

	$email = mysql_real_escape_string( $email );
	
	$query = mysql_query( "SELECT COUNT(`user_id`) FROM `users` WHERE `user_email`='$email'" );
	
	return ( mysql_result( $query, 0 ) == 1 ) ? true : false;
}

//Check supplied email address and password against database to see if they match an account.
function login_check( $email, $password ) {

	$email = mysql_real_escape_string( $email );
	$password = md5( $password );
	
	$login_query = mysql_query( "SELECT COUNT(`user_id`) AS `count`, `user_id` FROM `users` WHERE `user_email`='$email' AND `user_password`='$password'" );
	
	return (mysql_result( $login_query, 0 ) == 1 ) ? mysql_result( $login_query, 0, 'user_id' ) : false;
}
?>