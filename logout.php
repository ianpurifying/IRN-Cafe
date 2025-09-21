<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}

session_unset();
session_destroy();

echo "<script>window.location.href = 'index.php?page=login';</script>";
exit;
?>
