<link href="./modules/bootstrap/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="./modules/bootstrap/node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<script src="./modules/bootstrap/node_modules/jquery/dist/jquery.min.js"></script>
<script src="./modules/bootstrap/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<style>
    body {
        background-color: #f7f2e8;
        font-family: 'Arial', sans-serif;
        margin: 0;
    }

    .navbar {
        background-color: #4b3832;
        padding: 1rem;
        position: sticky;
        top: 0;
        z-index: 1000;
        transition: background-color 0.3s ease, transform 0.3s ease-in-out;
    }

    .navbar.hidden {
        transform: translateY(-100%); /* Smoothly move the navbar off-screen */
    }

    .navbar:hover {
        background-color: #3a2e2b;
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
        font-weight: bold;
    }

    .nav-link {
        color: #f7f2e8 !important;
        font-size: 1.2rem;
        margin-right: 1rem;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .nav-link:hover {
        color: #ffd700 !important;
        transform: scale(1.1);
    }

    .nav-link.active {
        text-decoration: underline;
        font-weight: bold;
    }

    .navbar-toggler {
        border: none;
    }

    .navbar-toggler-icon {
        background-image: url('data:image/svg+xml;charset=UTF8,%3csvg xmlns%3d"http://www.w3.org/2000/svg" width%3d"30" height%3d"30" fill%3d"white" viewBox%3d"0 0 30 30"%3e%3cpath stroke%3d"rgba%280, 0, 0, 0.5%29" stroke-linecap%3d"round" stroke-miterlimit%3d"10" stroke-width%3d"2" d%3d"M4 7h22M4 15h22M4 23h22"/%3e%3c/svg%3e');
    }

    .dropdown-menu {
        background-color: #4b3832;
        border: none;
        border-radius: 0.5rem;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }

    .dropdown-item {
        color: #f7f2e8 !important;
        font-size: 1rem;
        padding: 0.5rem 1.5rem;
        transition: background-color 0.3s ease;
    }

    .dropdown-item:hover {
        background-color: #f7f2e8;
        color: #4b3832 !important;
    }

    @media (max-width: 992px) {
        .nav-link {
            margin-right: 0;
            text-align: center;
        }
    }

    @media (max-width: 768px) {
        .navbar-brand span {
            font-size: 1.5rem;
        }
    }
</style>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$userLoggedIn = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const navbar = document.querySelector(".navbar");
        let lastScrollY = window.scrollY;

        window.addEventListener("scroll", () => {
            if (window.scrollY > lastScrollY && window.scrollY > 50) {
                navbar.classList.add("hidden"); // Hide navbar when scrolling down
            } else {
                navbar.classList.remove("hidden"); // Show navbar when scrolling up
            }
            lastScrollY = window.scrollY;
        });
    });
</script>

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
                    <a class="nav-link <?= $currentPage === 'history' ? 'active' : '' ?>" href="index.php?page=history">History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'cart' ? 'active' : '' ?>" href="index.php?page=cart"><i class="bi bi-cart"></i></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= in_array($currentPage, ['account', 'login', 'registration']) ? 'active' : '' ?>" 
                        href="#" 
                        id="profileDropdown" 
                        role="button" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
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