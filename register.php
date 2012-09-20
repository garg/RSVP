<?php
/**
 * Register
 *
 * Takes user registration details via form, validates them, then creates database entry creates session data.
 */

// Include core site settings and functions.
include 'init.php';

// Is user already logged in?
if( logged_in() ) {

	header( 'Location: index.php' );
	exit();
}

// Include site header.
include 'template/header.php';
?>

<h3>Register an Account</h3>

<?php

// Has POST data been received?
if( isset( $_POST['register_name_1'], $_POST['register_name_2'], $_POST['register_email'], $_POST['register_password'] )) {

	$register_name_1 	= 	$_POST['register_name_1'];
	$register_name_2 	= 	$_POST['register_name_2'];
	$register_email 	= 	$_POST['register_email'];
	$register_password 	= 	$_POST['register_password'];
	
	$validate = new form_validator();
	
	if( $validate->empty_field( $register_name_1 ) == false && $validate->empty_field( $register_name_2 ) == false && $validate->empty_field( $register_email ) && $validate->empty_field( $register_password ) {
	
		$validate->check_email( $register_email );
		
		$validate->string_length( 'Name ' );
		$validate->string_length(  );
		$validate->string_length(  );
		$validate->string_length(  );
	}
	
	// Are any of the required fields empty?
	if( empty( $register_name_1 ) || empty( $register_name_2 ) || empty( $register_email ) || empty( $register_password )) {
	
		$errors[] = 'Please supply all of the requested information.';
	} else {
		
		// Is the supplied email address valid?
		if( filter_var( $register_email, FILTER_VALIDATE_EMAIL ) === false ) {
		
			$errors[] = 'The email address you have supplied is invalid.';
		}
		
		// Has the user circumvented maxlength settings?
		if( strlen( $register_name_1 ) > 35 || strlen( $register_name_2 ) > 35 || strlen( $register_email ) > 50 || strlen( $register_password ) > 35 ) {
		
			$errors[] = 'Too many characters.';
		}
		
		// Is this email address already in the database?
		if(  user_exists( $register_email ) === true ) {
		
			$errors[] = 'An account with that email address already exists.';
		}
	}
	
	// Are there any error messages to display?
	if( !empty( $errors )) {
	
		foreach( $errors as $error ) {
		
			echo '<span class="error">' . $error . '</span><br />';
		}
	} else {
		
		// Add user data to database.
		$register = user_register( $register_name_1, $register_name_2, $register_email, $register_password );
		
		// Create session.
		$_SESSION['user_id'] = $register;
		
		// Redirect to Create Event.
		header('Location: new_event.php');
		exit();
	}
}
?>

<form action="" method="post">
	<p>Name of Partner One:<br />
	<input type="text" maxlength="35" name="register_name_1" value="<?php echo $register_name_1; ?>" /></p>
	<p>Name of Partner Two:<br />
	<input type="text" maxlength="35" name="register_name_2" value="<?php echo $register_name_2; ?>" /></p>
	<p>Email:<br />
	<input type="email" maxlength="50" name="register_email" value="<?php echo $register_email; ?>" /></p>
	<p>Password:<br />
	<input type="password" maxlength="35" name="register_password"></p>
	<p><input type="submit" value="Register"></p>
</form>

<?php
// Include site footer.
include 'template/footer.php';
?>