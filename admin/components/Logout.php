<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin' || $_SESSION['user']['email'] !== 'admin@irncafe.com') {
    header("Location: ../index.php?page=login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Destroy session
    session_unset();
    session_destroy();

    // Redirect to login page
    header("Location: ../index.php?page=login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
    <?php
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
        
            echo "<h3>Admin Details</h3>";
            echo "<p>Username: {$user['username']}</p>";
            echo "<p>Email: {$user['email']}</p>";
        }        
    ?>
    <form method="POST">
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</body>
</html>
