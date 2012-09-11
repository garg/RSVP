<?php
include 'init.php';

if( logged_in() ) {

	header( 'Location: index.php' );
	exit();
}

include 'template/header.php';
?>

<h3>Register an Account</h3>

<?php

if( isset( $_POST['register_name_1'], $_POST['register_name_2'], $_POST['register_email'], $_POST['register_password'] )) {

	$register_name_1 	= 	$_POST['register_name_1'];
	$register_name_2 	= 	$_POST['register_name_2'];
	$register_email 	= 	$_POST['register_email'];
	$register_password 	= 	$_POST['register_password'];
	
	$errors = array();
	
	if( empty( $register_name_1 ) || empty( $register_name_2 ) || empty( $register_email ) || empty( $register_password )) {
	
		$errors[] = 'Please supply all of the requested information.';
	} else {
	
		if( filter_var( $register_email, FILTER_VALIDATE_EMAIL ) === false ) {
		
			$errors[] = 'The email address you have supplied is invalid.';
		}
		
		if( strlen( $register_name_1 ) > 35 || strlen( $register_name_2 ) > 35 || strlen( $register_email ) > 50 || strlen( $register_password ) > 35 ) {
		
			$errors[] = 'Not enough characters.';
		}
		
		if(  user_exists( $register_email ) === true ) {
		
			$errors[] = 'An account with that email address already exists.';
		}
	}
	
	if( !empty( $errors )) {
	
		foreach( $errors as $error ) {
		
			echo '<span class="error">' . $error . '</span><br />';
		}
	} else {
	
		$register = user_register( $register_name_1, $register_name_2, $register_email, $register_password );
		
		$_SESSION['user_id'] = $register;
		
		header('Location: index.php');
		exit();

	}
}

?>

<form action="" method="post">
	<p>Name of Partner One:<br /><input type="text" maxlength="35" name="register_name_1" value="<?php echo $register_name_1; ?>" /></p>
	<p>Name of Partner Two:<br /><input type="text" maxlength="35" name="register_name_2" value="<?php echo $register_name_2; ?>" /></p>
	<p>Email:<br /><input type="email" maxlength="50" name="register_email" value="<?php echo $register_email; ?>" /></p>
	<p>Password:<br /><input type="password" maxlength="35" name="register_password"></p>
	<p><input type="submit" value="Register"></p>
</form>

<?php
include 'template/footer.php';
?>