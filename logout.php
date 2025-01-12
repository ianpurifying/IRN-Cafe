<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session only if not already started
}

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the home page after logging out
header("Location: index.php?page=login");
exit;
?>
