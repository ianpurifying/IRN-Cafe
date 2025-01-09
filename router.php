<?php
function route($page) {
    $pages = [
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

    if (array_key_exists($page, $pages)) {
        include $pages[$page];
    } else {
        echo '<h1>404 - Page Not Found</h1>';
    }
}
?>
