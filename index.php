<?php
/*
** Index Page
** Main landing page for the site.
***
**** To Do:
**** * Replace 'lorem ipsum' with proper text.
**** * Add central graphic.
*/


include 'init.php';
$inline_login = true;
include 'template/header.php';
?>

<h3>RSVP</h3>

<?php if( !logged_in()) : ?>

	<p>Welcome.</p>
	<!-- <img src="#"> Graphic to go in here -->
	
	<h4>Respond</h4>
	<form action="guest_response.php" method="get">
		<p>
			<input type="text" name="guest_id" maxlength="11" value="<?php $_GET['guest_id']; ?>" /><br />
			<input type="submit" name="Respond" />
		</p>
	</form>

<?php else : ?>

	<p>Welcome back <?php echo $user_data['user_name_1']?> and <?php echo $user_data['user_name_2']?>.</p>
	
	<?php if( event_exists()) : ?>
		<ul>
			<li><a href="view_event.php">View <?php echo $event_data['event_name']; ?></a></li>
			<li><a href="add_guests.php">Add Guests</a></li>
			<li><a href="edit_account.php">Edit Account</a></li>
			<li><a href="edit_event.php">Edit <?php echo $event_data['event_name']; ?></a></li>
		</ul>
	<?php else : ?>
	
		<p>At the moment you have no event registered. <a href="new_event.php">Create an Event</a>.</p>
	
	<?php endif; ?>

<?php endif; ?>

<?php
include 'template/footer.php';
?>