<?php
session_start();
require '../../config.php'; // Database connection

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Update query
        $query = "UPDATE users SET first_name = ?, last_name = ?, username = ?, email = ?";

        // Add password update if provided
        if (!empty($password)) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $query .= ", password = ?";
        }

        $query .= " WHERE id = ?";

        $stmt = $conn->prepare($query);
        
        if (!empty($password)) {
            $stmt->bind_param("sssssi", $firstName, $lastName, $username, $email, $passwordHash, $userId);
        } else {
            $stmt->bind_param("ssssi", $firstName, $lastName, $username, $email, $userId);
        }

        if ($stmt->execute()) {
            $_SESSION['user']['first_name'] = $firstName;
            $_SESSION['user']['last_name'] = $lastName;
            $_SESSION['user']['username'] = $username;
            $_SESSION['user']['email'] = $email;
            echo "<script>window.location.href = '../../index.php?page=account';</script>";
            exit;
        } else {
            echo "Error updating profile.";
        }
    }
}
?>
