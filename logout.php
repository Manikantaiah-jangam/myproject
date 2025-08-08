<?php
// Start the session
session_start();

// Destroy all session data (logging out)
session_destroy();

// Redirect to the login page
header("Location: login.php");
exit();
?>
