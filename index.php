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
include 'template/header.php';
?>

<h3>RSVP</h3>

<?php if( !logged_in()) : ?>

	<p>Welcome.</p>
	<!-- <img src="#"> Graphic to go in here -->

<?php else : ?>

	<p>Welcome back <?php echo $user_data['user_name_1']?> and <?php echo $user_data['user_name_2']?>.</p>
	
	<?php if( event_exists()) : ?>
	
		<p><?php echo $event_data['event_name']; ?></p>
	
	<?php endif; ?>

<?php endif; ?>

<?php
include 'template/footer.php';
?>