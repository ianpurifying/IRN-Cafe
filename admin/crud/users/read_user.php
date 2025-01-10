<?php
// Database connection
include('../../database/config.php');

$id = $_GET['id'];

$query = "SELECT id, first_name, last_name, username, email, password FROM users WHERE id=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo json_encode($user);
} else {
    echo json_encode(["error" => "User not found."]);
}

$stmt->close();
$conn->close();
?>
