<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "irn_cafe";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
