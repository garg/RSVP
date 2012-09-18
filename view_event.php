<?php
include 'init.php';

if( !logged_in() ) {

	header( 'Location: index.php' );
	exit();
}

include 'template/header.php';
?>

<h3><?php echo $event_data['event_name']; ?></h3>

<p>Date: <?php echo date( 'd F Y', $event_data['event_date'] ); ?></p>

<?php $guests = get_guests( $event_data['event_id'] ); ?>


<?php if( !empty( $guests )) : ?>

	<ul>
	
	<?php foreach( $guests as $guest ) : ?>
		
		<li>
		<strong><?php echo $guest['id']; ?></strong> |
		<a href="edit_guest.php?guest_id=<?php echo $guest['id']; ?>"><?php echo $guest['name']; ?></a> |
		
		<?php
		if( $guest['attending'] == '' ) {
			
			echo 'No Response';
			
		} elseif( $guest['attending'] == 'N' ) {
			
			echo 'Not Attending';
			
		} elseif( $guest['attending'] == 'Y' ) {
			
			echo 'Attending';
			
			if( $guest['vegetarian'] == 'Y' ) echo ' | Vegetarian';
			
			if( $guest['plus1'] == 'Y' ) echo ' | +1';
		}
		?>
		<a href="delete_guest.php?guest_id=<?php echo $guest['id']; ?>">[x]</a>
		</li>
	
	<?php endforeach; ?>
	
	<p>
		<a href="edit_event.php">Edit Event</a><br />
		<a href="delete_event.php">Cancel Event</a>
	</p>
	
	</ul>
	
<?php else : ?>

	<p>You have not invited any guests. <a href="add_guests.php">Add Guests</a></p>

<?php 
endif;

include 'template/footer.php'; ?>