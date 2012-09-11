<?php
/*
** Login.php
** Contains login form and code for processing form data.
*/
?>

<form action="" method="post" id="inline_login">

	<p>
		Email: <input type="email" name="login_email" />
		Password: <input type="password" name="login_password" />
		<input type="submit" value="Log In" />
	</p>

</form>
	
<?php
//Has POST data been received?
if( isset( $_POST['login_email'], $_POST['login_password'] )) {
	
	$login_email = $_POST['login_email'];
	$login_password = $_POST['login_password'];

	$errors = array();
	
	//Has user supplied all required data?
	if( empty( $login_email ) || empty( $login_password )) {
		
		$errors[] = 'Email and Password are required to log in.';
	} else {
	
		$login = login_check( $login_email, $login_password );
		
		//Has MySQL query failed?
		if( $login === false ) {
		
			$errors[] = 'Unable to log you in at this time. Please try again later.';
		}
	} 

	//Are there any error messages to display?
	if( !empty( $errors )) {
	
		foreach( $errors as $error ) {
		
			echo '<span class="error">' . $error . '</span>';
	
		}
	} else {
		
		//Create session.
		$_SESSION['user_id'] = $login;
		
		//Redirect back to homepage.
		header('Location: index.php');
		exit();
	}
}
?>