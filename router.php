<?php
// Define routes
const ROUTES = [
    'home' => 'pages/home.php',
    'about' => 'pages/about.php',
    'contact' => 'pages/contact.php',
    'cart' => 'pages/cart.php',
    'account' => 'pages/account.php',
    'chicken' => 'pages/chicken.php',
    'pork' => 'pages/pork.php',
    'desserts' => 'pages/desserts.php',
    'drinks' => 'pages/drinks.php',
    'login' => 'pages/login.php',
    'registration' => 'pages/registration.php',
    'confirmation' => 'pages/confirmation.php',
    'history' => 'pages/history.php'
];

// Function to handle routing
function route($page) {
    if (isset(ROUTES[$page])) {
        include ROUTES[$page];
    } else {
        render404();
    }
}

// 404 handler
function render404() {
    echo '<h1>404 - Page Not Found</h1>';
    echo '<p>The page you are looking for does not exist.</p>';
}
?>
