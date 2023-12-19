<?php
// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Regenerate session ID to prevent session fixation attacks
session_regenerate_id(true);

// Redirect to login page
header("location: userlogin.php");
exit;
?>
