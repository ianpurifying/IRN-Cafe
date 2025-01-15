<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session only if not already started
}

require 'config.php'; // Database connection

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
                echo "<script>window.location.href = 'admin/index.php';</script>";
            } else {
                echo "<script>window.location.href = 'index.php?page=account';</script>";
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
<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(to bottom, #ffefba, #ffffff);
        margin: 0;
        padding: 0;
        
    }
    
    .login-main {
        display: grid;
        place-items: center;
        height: 88vh;
    }

    .login-con {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        max-width: 600px;
        height: 42vh;
        width: 100%;
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }
    .form-label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 14px;
    }
    .btn {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .btn:hover {
        background-color: #0056b3;
    }
    .alert {
        margin-top: 15px;
        padding: 10px;
        background-color: #f8d7da;
        color: #842029;
        border: 1px solid #f5c2c7;
        border-radius: 5px;
        font-size: 14px;
    }
</style>
<div class="login-main">
    <div class="login-con">
        <h2>User Login</h2>
        <form method="POST" autocomplete="off">
            <label for="username_or_email" class="form-label">Username or Email</label>
            <input type="text" class="form-control" id="username_or_email" name="username_or_email" placeholder="Enter your username or email" required>

            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit" name="submit" class="btn">Login</button>
            
            <div style="margin-top: 10px; text-align: center;">
                <span>Don't have an account? </span>
                <a href="index.php?page=registration" class="signup-link">Sign Up</a>
            </div>
        </form>

        <?php if (isset($errorMessage)) : ?>
            <div class="alert" role="alert" id="alertMessage">
                <?php echo $errorMessage; ?>
            </div>
            <script>
                // Remove the alert message after 500 milliseconds
                setTimeout(() => {
                    const alertElement = document.getElementById('alertMessage');
                    if (alertElement) { 
                        alertElement.style.transition = 'opacity 3s ease';
                        alertElement.style.opacity = '0';
                    }
                }, 500);
            </script>
        <?php endif; ?>
    </div>
</div>
