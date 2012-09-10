<?php
/*
** Users.func.php
** Defines functions primarily relating to the 'users' database.
*/

/*
//	Function to check if a user is currently logged in.
//	Returns true if user logged in and false if not logged in.
*/
function logged_in() {
	return isset($_SESSION['user_id']);
}


/*
//	To write...
//	Sanitise registration data, register new user on database, create session.
*/
function register_user() {

}

/*
//	To write...
//	Log user in.
*/
function user_login() {

}

/*
//	To write...
//	Return data held for account connected to current session.
*/
function user_data() {

}

/*
//	To write...
//	Check supplied credentials against db to check if user is registered.
*/
function user_exists() {

}

function login_check( $email, $password ) {

	$email = mysql_real_escape_string( $email );
	$password = md5( $password );
	
	$login_query = mysql_query( "SELECT COUNT(`user_id`) AS `count`, `user_id` FROM `users` WHERE `user_email`='$email' AND `user_password`='$password'" );
	
	return (mysql_result( $login_query, 0 ) == 1 ) ? mysql_result( $login_query, 0, 'user_id' ) : false;

}

?>