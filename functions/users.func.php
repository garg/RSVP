<?php
function logged_in() {
	
	return isset($_SESSION['user_id']);
}


function user_register( $name_1, $name_2, $email, $password ) {
	
	$name_1 	= 	mysql_real_escape_string( $name_1 );
	$name_2 	= 	mysql_real_escape_string( $name_2 );
	$email 		= 	mysql_real_escape_string( $email );
	$password 	= 	md5( $password );
	
	mysql_query( "INSERT INTO `users` VALUES ('', '$name_1', '$name_2', '$email', '$password')" );
	
	return mysql_insert_id();
}


function user_login() {

}


function user_data() {

}

function user_exists( $email ) {

	$email = mysql_real_escape_string( $email );
	
	$query = mysql_query( "SELECT COUNT(`user_id`) FROM `users` WHERE `user_email`='$email'" );
	
	return ( mysql_result( $query, 0 ) == 1 ) ? true : false;
}


function login_check( $email, $password ) {

	$email = mysql_real_escape_string( $email );
	$password = md5( $password );
	
	$login_query = mysql_query( "SELECT COUNT(`user_id`) AS `count`, `user_id` FROM `users` WHERE `user_email`='$email' AND `user_password`='$password'" );
	
	return (mysql_result( $login_query, 0 ) == 1 ) ? mysql_result( $login_query, 0, 'user_id' ) : false;
}

?>