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

<p>Lorem ipsum.</p>

<?php if( !logged_in()) : ?>

	<!-- <img src="#"> Graphic to go in here -->

<?php endif; ?>

<?php
include 'template/footer.php';
?>