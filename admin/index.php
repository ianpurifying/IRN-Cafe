<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/projects/_college/final/bootstrap_modules/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="/projects/_college/final/bootstrap_modules/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/projects/_college/final/bootstrap_modules/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <title>AdminPanel</title>
    <style>
        .container-fluid {
            display: flex;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="list-group">
            <button class="list-group-item list-group-item-action <?php echo (!isset($_GET['tab']) || $_GET['tab'] == 'dashboard') ? 'active' : ''; ?>" id="dashboardTab" onclick="changeTab('dashboard')">Dashboard</button>
            <button class="list-group-item list-group-item-action <?php echo (isset($_GET['tab']) && $_GET['tab'] == 'sales') ? 'active' : ''; ?>" id="salesTab" onclick="changeTab('sales')">Sales</button>
            <button class="list-group-item list-group-item-action <?php echo (isset($_GET['tab']) && $_GET['tab'] == 'menu') ? 'active' : ''; ?>" id="menuTab" onclick="changeTab('menu')">Menu</button>
            <button class="list-group-item list-group-item-action <?php echo (isset($_GET['tab']) && $_GET['tab'] == 'users') ? 'active' : ''; ?>" id="usersTab" onclick="changeTab('users')">Users</button>
            <button class="list-group-item list-group-item-action <?php echo (isset($_GET['tab']) && $_GET['tab'] == 'logout') ? 'active' : ''; ?>" id="logoutTab" onclick="changeTab('logout')">Logout</button>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <?php
        // Default Tab (Dashboard)
        if (!isset($_GET['tab']) || $_GET['tab'] == 'dashboard') {
            include('components/Dashboard.php');
        } elseif ($_GET['tab'] == 'sales') {
            include('components/Sales.php');
        } elseif ($_GET['tab'] == 'menu') {
            include('components/Menu.php');
        } elseif ($_GET['tab'] == 'users') {
            include('components/Users.php');
        } elseif ($_GET['tab'] == 'logout') {
            include('components/logout.php');
        }
        
        ?>
        
    </div>
</div>

<!-- Bootstrap JS (Optional) -->
<script>
    // JavaScript to switch between tabs
    function changeTab(tab) {
        // Update the URL to reflect the current tab
        window.location.href = "?tab=" + tab;
    }
</script>

</body>
</html>
