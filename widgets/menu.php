<?php
/*
** Menu.php
** Supplies relevant links depending on whether a user is currently logged in.
***
**** To Do:
**** * Highlight current page and render it unclickable.
*/
?>
	
<a href="index.php">Home</a>

<?php if ( !logged_in() ) : ?>

	|
	<a href="register.php">Create an Account</a>
	
<?php else : ?>
	|
	<?php if( !event_exists() ) : ?>
		<a href="new_event.php">Create New Event</a>
	<?php else : ?>
		<a href="view_event.php"><?php echo $event_data['event_name']; ?></a>
		|
		<a href="add_guests.php">Add Guests</a>
	<?php endif; ?>
	|
	<a href="logout.php">Log Out</a>
	
<?php endif; ?>