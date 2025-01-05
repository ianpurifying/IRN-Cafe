<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session only if not already started
}

require_once(__DIR__ . '/../../config.php'); // Database connection

// Check if the user is logged in
if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];

    // Prepare SQL query to fetch user details by user id
    $stmt = $conn->prepare("SELECT first_name, last_name, username, email, created_at FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId); // Bind the user id parameter
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();
    } else {
        $errorMessage = "User not found.";
    }
} else {
    // If user is not logged in, redirect to login page
    header("Location: index.php?page=login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <style>


        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        h2 {
            font-size: 28px;
            font-weight: 600;
            color: #333;
        }

        .user-info p {
            font-size: 16px;
            line-height: 1.8;
            color: #555;
        }

        .user-info strong {
            font-weight: 600;
            color: #333;
        }

        .btn-logout {
            display: block;
            width: 100%;
            padding: 12px;
            margin-top: 30px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-logout:hover {
            background-color: #0056b3;
        }
    </style>
    <title>User Dashboard</title>
</head>

<body>
    <div class="container">
        <?php if (isset($user)): ?>
            <div class="header">
                <h2>Welcome, <?php echo htmlspecialchars($user['first_name']) . " " . htmlspecialchars($user['last_name']); ?>!</h2>
            </div>
            <div class="user-info">
                <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Account Created:</strong> <?php echo date("F j, Y", strtotime($user['created_at'])); ?></p>
            </div>
            <a href="./logout.php" class="btn-logout">Logout</a>
        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                <?php echo isset($errorMessage) ? $errorMessage : 'Something went wrong!'; ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
