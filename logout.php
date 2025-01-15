<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session only if not already started
}

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

echo "<script>window.location.href = 'index.php?page=login';</script>";
exit;
?>
