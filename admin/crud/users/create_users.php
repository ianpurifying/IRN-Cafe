<?php
// Database connection
require_once '../../database/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = ['success' => false, 'message' => ''];

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate password confirmation
    if ($password !== $confirm_password) {
        $response['message'] = 'Passwords do not match.';
        echo json_encode($response);
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into the database
    $query = "INSERT INTO users (first_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        $response['message'] = 'Error preparing statement: ' . $conn->error;
        echo json_encode($response);
        exit;
    }

    $stmt->bind_param("sssss", $first_name, $last_name, $username, $email, $hashed_password);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'User registered successfully!';
    } else {
        if ($conn->errno === 1062) { // Duplicate entry error code
            if (strpos($conn->error, 'username') !== false) {
                $response['message'] = 'Username already exists.';
            } elseif (strpos($conn->error, 'email') !== false) {
                $response['message'] = 'Email already exists.';
            }
        } else {
            $response['message'] = 'Error: ' . $conn->error;
        }
    }

    $stmt->close();
    $conn->close();

    echo json_encode($response);
    exit;
}
?>
