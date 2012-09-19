<?php
/**
 * Logout
 *
 * Destroys session data and then redirects back to Index.
 */

session_start();
session_destroy();
header('Location: index.php');
exit();
?>