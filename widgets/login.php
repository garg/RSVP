<?php
/*
** Login.php
** Contains login form and code for processing form data.
*/
?>

<form action="" method="post">

	<p>
		<input type="submit" value="Log In" />
		Email: <input type="email" name="login_email" />
		Password: <input type="password" name="login_password" />
	</p>

</form>

<?php
if( isset( $_POST['login_email'], $_POST['login_password'] )) {
	
	$login_email = $_POST['login_email'];
	$login_password = $_POST['login_password'];

	$errors = array();
	
	if( empty( $login_email ) || empty( $login_password )) {
		
		$errors[] = 'Email and Password are required to log in.';
	
	} else {
	
		$login = login_check( $login_email, $login_password );
		
		if( $login === false ) {
		
			$errors[] = 'Unable to log you in at this time. Please try again later.';
		
		}
	} 


	if( !empty( $errors )) {
	
		foreach( $errors as $error ) {
		
			echo '<span class="error">' . $error . '</span>';
	
		}
	} else {
	
		$_SESSION['user_id'] = $login;
		
		header('Location: index.php');
		exit();
	}
}