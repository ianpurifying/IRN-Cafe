<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session only if not already started
}

session_unset();
session_destroy();

echo "<script>window.location.href = 'index.php?page=login';</script>";
exit;
?>
