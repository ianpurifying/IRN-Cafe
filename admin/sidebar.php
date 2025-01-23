<style>
    @font-face {
        font-family: "Rubik Vinyl";
        src: url("assets/fonts/RubikVinyl-Regular.woff") format("woff"),
             url("assets/fonts/RubikVinyl-Regular.ttf") format("truetype");
        font-weight: 400;
        font-style: normal;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        height: 100%;
        background-color: #4b3832;
        color: #f7f2e8;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 1rem;
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
        z-index: 1000;
    }

    .sidebar.open {
        transform: translateX(0);
    }

    .sidebar-brand {
        display: flex;
        align-items: center;
        margin-top: 0.8rem;
        text-decoration: none;
        color: #f7f2e8;
    }

    .sidebar-brand h2 {
        font-family: "Rubik Vinyl", Arial, sans-serif;
        font-size: 1.8rem;

        height: 30px;
        margin-left: 70px;
    }

    .sidebar-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-nav li {
        margin: 1rem 0;
    }

    .sidebar-nav a {
        color: #f7f2e8;
        font-size: 1.2rem;
        text-decoration: none;
        display: flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        transition: background-color 0.3s, transform 0.3s;
    }

    .sidebar-nav a:hover {
        background-color: #3a2e2b;
        transform: translateX(10px);
    }

    .sidebar-nav a.active {
        background-color: #ffd700;
        color: #4b3832;
        font-weight: bold;
    }

    .logout-btn {
        text-align: center;
        margin-top: auto;
    }

    .logout-btn a {
        color: #f7f2e8;
        font-size: 1.2rem;
        text-decoration: none;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        display: inline-block;
        background-color: #d9534f;
        transition: background-color 0.3s;
    }

    .logout-btn a:hover {
        background-color: #c9302c;
    }

    .sidebar-toggle {
        position: fixed;
        top: 1rem;
        left: 1rem;
        background-color: #4b3832;
        color: #f7f2e8;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        z-index: 1100;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        transition: background-color 0.3s;
    }

    .sidebar-toggle:hover {
        background-color: #3a2e2b;
    }
</style>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$userLoggedIn = $_SESSION['user'] ?? null;

function renderSidebar($currentPage) {
    $sidebarLinks = [
        'checkouts' => 'Checkouts',
        'sales' => 'Sales',
        'menu' => 'Menu',
        'users' => 'Users',
    ];

    foreach ($sidebarLinks as $page => $label) {
        $activeClass = $currentPage === $page ? 'active' : '';
        $href = "index.php?page=$page";
        echo "<li><a class='$activeClass' href='$href'>$label</a></li>";
    }
}

$currentPage = $_GET['page'] ?? 'checkouts';
?>

<div class="sidebar" id="sidebar">
    <a class="sidebar-brand" href="index.php">
        <h2>IRN Cafe</h2>
    </a>
    <ul class="sidebar-nav">
        <?php renderSidebar($currentPage); ?>
    </ul>
    <div class="logout-btn">
        <a href="logout.php">Logout</a>
    </div>
</div>
<button class="sidebar-toggle" id="sidebarToggle">&#9776;</button>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const sidebar = document.getElementById("sidebar");
        const sidebarToggle = document.getElementById("sidebarToggle");

        sidebarToggle.addEventListener("click", () => {
            sidebar.classList.toggle("open");
        });
    });
</script>

