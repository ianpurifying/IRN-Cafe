<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session only if not already started
}

require_once(__DIR__ . '/../../config.php'); // Database connection

if (isset($_POST["submit"])) {
    // Sanitize and validate form data
    $usernameOrEmail = trim($_POST['username_or_email']);
    $password = $_POST['password'];

    // Check if the username/email exists in the database
    $stmt = $conn->prepare("SELECT id, first_name, last_name, username, email, password FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Password is correct, store user info in session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'username' => $user['username'],
                'email' => $user['email']
            ];
        
            // Check if admin
            if ($user['username'] === 'admin' && $user['email'] === 'admin@irncafe.com') {
                header("Location: admin/index.php");
            } else {
                header("Location: index.php?page=account");
            }
            exit;
        }
         else {
            $errorMessage = "Incorrect password.";
        }
    } else {
        $errorMessage = "No user found with that username or email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="container mt-5">
        <h2>User Login</h2>
        <form method="POST" autocomplete="off">
            <div class="mb-3">
                <label for="username_or_email" class="form-label">Username or Email</label>
                <input type="text" class="form-control" id="username_or_email" name="username_or_email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Login</button>
        </form>

        <?php if (isset($errorMessage)) : ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
