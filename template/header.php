<?php
/*
** Header.php
** Contains HTML head and information for site header.
*/
?>

<!DOCTYPE html>

<html lang="en">
<head>
      <title>RSVP</title>
      <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body> 
      
	<div id="container">
           
		<!--<img src="#"> Logo image to go in here. -->
           
		<?php 
		if( !logged_in() ) {
			include 'widgets/login.php'; 
		}
		?>

        <div id="main">