<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./modules/bootstrap/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./modules/bootstrap/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./modules/bootstrap/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <title>Navbar</title>
    <style>
        body {
            background-color: #f7f2e8;
            font-family: 'Caveat', cursive, sans-serif;
            margin: 0;
        }
        .navbar {
            background-color: #4b3832;
            padding: 1rem;
            position: sticky;
            top: 0;
            z-index: 1000; 
        }

        .navbar-brand {
            display: flex;
            align-items: center;
        }
        .navbar-brand img {
            height: 50px;
            width: auto;
            margin-right: 10px;
        }
        .navbar-brand span {
            color: #f7f2e8;
            font-size: 2rem;
        }
        .nav-link {
            color: #f7f2e8 !important;
            font-size: 1.5rem;
            margin-right: 1rem;
        }
        .nav-link.active {
            text-decoration: underline;
            font-weight: bold;
        }
        .navbar-toggler {
            border-color: #f7f2e8;
        }
        .dropdown-menu {
            background-color: #4b3832;
        }
        .dropdown-item {
            color: #f7f2e8 !important;
        }
        .dropdown-item:hover {
            background-color: #f7f2e8;
            color: #4b3832 !important;
        }
    </style>
</head>
<body>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session only if not already started
}
$userLoggedIn = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="assets/img/logo.jpg" alt="IRN Cafe Logo">
            <span>IRN Cafe</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'home' ? 'active' : '' ?>" href="index.php?page=home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'about' ? 'active' : '' ?>" href="index.php?page=about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'menu' ? 'active' : '' ?>" href="index.php?#menu">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'contact' ? 'active' : '' ?>" href="index.php?page=contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'cart' ? 'active' : '' ?>" href="index.php?page=cart">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'history' ? 'active' : '' ?>" href="index.php?page=history">History</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= in_array($currentPage, ['account', 'login', 'registration']) ? 'active' : '' ?>" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profile
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                        <?php if ($userLoggedIn): ?>
                            <li><a class="dropdown-item" href="index.php?page=account">My Account</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        <?php else: ?>
                            <li><a class="dropdown-item" href="index.php?page=login">Login</a></li>
                            <li><a class="dropdown-item" href="index.php?page=registration">Register</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

</body>
</html>
