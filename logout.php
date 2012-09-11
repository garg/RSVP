<?php
/*
** Logout.php
** Destroys session data and then redirects back to homepage.
*/

session_start();
session_destroy();
header('Location: index.php');
exit();
?>