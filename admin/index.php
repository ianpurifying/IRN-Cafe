<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin' || $_SESSION['user']['email'] !== 'admin@gmail.com') {
        echo "<script>window.location.href = '../index.php?page=login';</script>";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../modules/bootstrap/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../modules/bootstrap/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../modules/bootstrap/node_modules/jquery/dist/jquery.min.js"></script>
    <title>AdminPanel</title>
    <style>

    body{
        margin: 20px;
    }
        .admin-con {
            display: flex;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>
<body>

<?php
    define('PAGE_PATH', __DIR__ . '/components/');
    include 'route.php'; 
    include 'sidebar.php'; 
?>

    <!-- Main content section -->
<main>
    <?php
        $page = $_GET['page'] ?? 'checkouts'; // Default page
        route($page); // Load the appropriate page
    ?>
</main>


</body>
</html>
