<?php
/*
** Menu.php
** Supplies relevant links depending on whether a user is currently logged in.
***
**** To Do:
**** * Highlight current page and render it unclickable.
*/

if ( !logged_in() ) {

	?>
	
	<a href="index.php">Home</a>
	|
	<a href="register.php">Create an Account</a>
	
	<?php

} else {

	?>
	
	<a href="index.php">My Event</a>
	|
	<a href="#">Add Guests</a>
	|
	<a href="logout.php">Log Out</a>
	
	
	<?php
}
?>