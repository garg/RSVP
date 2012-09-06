<?php

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

?>