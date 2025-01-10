<?php
// Database connection
include('../../database/config.php');

// Fetch all users including hashed password and created_at
$query = "SELECT id, first_name, last_name, username, email, password, created_at FROM users";
$result = $conn->query($query);

$response = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
}

$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
