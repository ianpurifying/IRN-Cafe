<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include 'navbar.php'; // Include the navbar

// Simple router logic
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'about':
        include 'assets/pages/about.php';
        break;
    case 'account':
        include 'assets/pages/account.php';
        break;
    case 'cart':
        include 'assets/pages/cart.php';
        break;
    case 'chicken':
        include 'assets/pages/chicken.php';
        break;
    case 'pork':
        include 'assets/pages/pork.php';
        break;
    case 'desserts':
        include 'assets/pages/desserts.php';
        break;
    case 'drinks':
        include 'assets/pages/drinks.php';
        break;
    case 'contact':
        include 'assets/pages/contact.php';
        break;
    case 'login':
        include 'assets/pages/login.php';
        break;
    case 'registration':
        include 'assets/pages/registration.php';
        break;
    case 'confirmation':
        include 'assets/pages/confirmation.php';
        break;
    case 'history':
            include 'assets/pages/history.php';
        break;
    default:
        include 'assets/pages/home.php'; 
    
}

include 'footer.php';
?>
</body>
</html>