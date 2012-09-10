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
      <div id="menu">
           
           <?php include 'widgets/menu.php'; ?>
      
      </div>
      
      <div id="container">
           
           <!--<img src="#"> Logo image to go in here. -->
           
           <span class="right"><!-- Currently displays content on right side of page. It would be better to find a more semantic class name. -->
                 
                 <?php include 'widgets/login.php'; ?>
                 
           </span>

           <div id="main">