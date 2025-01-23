<style>
    @font-face {
        font-family: "Rubik Vinyl";
        src: url("assets/fonts/RubikVinyl-Regular.woff") format("woff"),
                url("assets/fonts/RubikVinyl-Regular.ttf") format("truetype");
        font-weight: 400;
        font-style: normal;
    }

    .navbar {
        background-color: #4b3832;
        padding: 1rem;
        position: sticky;
        top: 0;
        z-index: 1000;
        transition: background-color 0.3s, transform 0.3s;

    }

    .navbar.hidden {
        transform: translateY(-100%);
    }

    .navbar:hover {
        background-color: #3a2e2b;
    }

    .navbar-brand {
        display: flex;
        align-items: center;
        color: #f7f2e8;
        font-size: 1.8rem;
        font-weight: bold;
        text-decoration: none;
    }

    .navbar-brand img {
        height: 50px;
        margin-right: 10px;
    }

    .navbar-brand h2 {
        font-family: "Rubik Vinyl", Arial, sans-serif !important;
    }

    .nav-link {
        color: #f7f2e8 !important;
        font-size: 1.1rem;
        margin-right: 1rem;
        transition: color 0.3s, transform 0.3s;
    }

    .nav-link:hover {
        color: #ffd700 !important;
        transform: scale(1.1);
    }

    .nav-link.active {
        font-weight: bold;
        text-decoration: underline;
    }

    .dropdown-menu {
        background-color: #4b3832;
        border-radius: 0.5rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .dropdown-item {
        color: #f7f2e8 !important;
        font-size: 1rem;
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
        .navbar-brand {
            font-size: 1.5rem;
        }
    }
</style>
<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $userLoggedIn = $_SESSION['user'] ?? null;

    function renderNavbar($currentPage) {
        $navLinks = [
            'home' => 'Home',
            'about' => 'About',
            'menu' => 'Menu',
            'contact' => 'Contact',
            'history' => 'History',
            'cart' => '<i class="bi bi-cart"></i>',
        ];

        foreach ($navLinks as $page => $label) {
            $activeClass = $currentPage === $page ? 'active' : '';
            if ($page !== 'about') {  
                $href = "index.php?page=$page";
            } else {
                $href = "index.php?#$page";
            }

            echo "<li class='nav-item'><a class='nav-link $activeClass' href='$href'>$label</a></li>";
        }
    }

    $currentPage = $_GET['page'] ?? 'home';
?>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        const navbar = document.querySelector(".navbar");
        let lastScrollY = window.scrollY;

        window.addEventListener("scroll", () => {
            if (window.scrollY > lastScrollY && window.scrollY > 50) {
                navbar.classList.add("hidden");
            } else {
                navbar.classList.remove("hidden");
            }
            lastScrollY = window.scrollY;
        });
    });
</script>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="<?= ASSET_PATH ?>img/logo.jpg" alt="IRN Cafe Logo">
            <h2>IRN Cafe</h2>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php renderNavbar($currentPage); ?>

                <!-- Profile Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= in_array($currentPage, ['account', 'login', 'registration']) ? 'active' : '' ?>" 
                        href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
