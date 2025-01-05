<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session only if not already started
}

// Redirect if the user is already logged in
if (isset($_SESSION['user'])) {
    header("Location: account.php");
    exit;
}

require_once(__DIR__ . '/../../config.php'); // Database connection

if (isset($_POST["submit"])) {
    // Sanitize and validate form data
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $errorMessage = "Passwords do not match.";
    } else {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Check if the username or email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errorMessage = "Username or email already exists.";
        } else {
            // Insert user data into the database
            $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $firstName, $lastName, $username, $email, $hashedPassword);

            if ($stmt->execute()) {
                // Fetch the inserted user ID
                $userId = $conn->insert_id;

                // Set session data for auto-login
                $_SESSION['user'] = [
                    'id' => $userId,
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'username' => $username,
                    'email' => $email
                ];

                // Redirect to account.php
                header("Location: index.php?page=account");
                exit;
            } else {
                $errorMessage = "There was an error registering your account.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminPanel</title>
    <title>Registration form</title>
</head>
<body>
   <div>
   <h2 class="modal-title" id="registerModalLabel">User Registration</h2>
    <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>

    <!-- Registration Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="feedbackMessage" class="alert <?php echo isset($errorMessage) ? 'alert-danger' : 'alert-success'; ?>" role="alert">
                        <?php echo isset($errorMessage) ? $errorMessage : (isset($successMessage) ? $successMessage : ''); ?>
                    </div>
                    <form method="POST" autocomplete="off" id="registrationForm">
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required minlength="3" maxlength="15">
                            <div class="invalid-feedback">Invalid username: must be 3-15 characters and unique.</div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">Invalid email: must be a valid format and unique.</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required minlength="8" maxlength="49">
                            <div class="invalid-feedback">
                                Password must be 8-49 characters long, include uppercase, lowercase, numbers, and special characters.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                            <div class="invalid-feedback">Passwords do not match.</div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
   </div>
</body>
</html>
