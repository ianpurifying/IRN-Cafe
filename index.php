<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    @font-face {
        font-family: "Sour Gummy";
        src: url("assets/fonts/Sour_Gummy/static/SourGummy-Bold.woff2") format("woff2"),
            url("assets/fonts/Sour_Gummy/static/SourGummy-Bold.woff") format("woff"),
            url("assets/fonts/Sour_Gummy/static/SourGummy-Bold.ttf") format("truetype");
        font-weight: 400;
        font-style: normal;
    }

    body {
        font-family: "Sour Gummy", Arial, sans-serif !important;
        font-size: 16px; /* Ensures consistent font size */
        line-height: 1.5; /* Improves readability */
        color: #333; /* A neutral text color */
        background: linear-gradient(to bottom, #ffefba, #ffffff); /* Light gradient for a soft effect */
        margin: 0;
        padding: 0;
        -webkit-font-smoothing: antialiased; /* Smoothens font rendering */
        -moz-osx-font-smoothing: grayscale; /* For better font appearance */
    }

    </style>
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