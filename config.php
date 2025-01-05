<?php
// Create connection
$conn = new mysqli('localhost', 'root', '', 'irn_cafe', 3306);

// Check connection
if ($conn->connect_error) {
    // For production, log the error instead of just dying
    error_log("Connection failed: " . $conn->connect_error); 
    die("Oops! Something went wrong connecting to the database."); 
}

// Declare $conn as global to make it accessible in other files
global $conn;
?>
