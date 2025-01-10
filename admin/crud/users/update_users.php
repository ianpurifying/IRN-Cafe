<?php
// Database connection
include('../../database/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password before storing it in the database
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Update user details
    $query = "UPDATE users SET first_name=?, last_name=?, username=?, email=?, password=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $first_name, $last_name, $username, $email, $hashedPassword, $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "User updated successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error updating user."]);
    }

    $stmt->close();
    $conn->close();
}
?>
