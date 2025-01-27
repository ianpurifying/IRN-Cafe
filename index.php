<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/logo.jpg" type="image/jpeg">
    <title>IRN Cafe</title>
    <!-- Dependencies -->
    <link href="./modules/bootstrap/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./modules/bootstrap/node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="./modules/bootstrap/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./modules/bootstrap/node_modules//jquery/dist/jquery.min.js"></script>
    
    <style>
    @font-face {
        font-family: "Sour Gummy";
        src: url("assets/fonts/Sour_Gummy/static/SourGummy-Bold.woff2") format("woff2"),
            url("assets/fonts/Sour_Gummy/static/SourGummy-Bold.woff") format("woff"),
            url("assets/fonts/Sour_Gummy/static/SourGummy-Bold.ttf") format("truetype");
        font-weight: 400;
        font-style: normal;
    }

    /* Base body style */
    body {
        font-family: "Sour Gummy", Arial, sans-serif !important;
        font-size: 16px;
        line-height: 1.5;
        color: #333;
        background: linear-gradient(to bottom, #ffefba, #ffffff);
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    /* Main content style */
    main {
        flex-grow: 1;
    }

    </style>
</head>
<body>
    <?php
        define('ASSET_PATH', 'assets/');
        define('PAGE_PATH', __DIR__ . '/assets/pages/');

        include 'route.php'; // Dynamic Router
        include 'navbar.php'; // Navigation bar
    ?>

    <!-- Main content section -->
    <main>
            <?php
                $page = $_GET['page'] ?? 'home'; // Default page
                $category = $_GET['category'] ?? ''; // Default category is empty

                route($page); // Include the main content
            ?>
    </main>

    <?php
        $excluded_categories = ['chicken', 'pork', 'drinks', 'dessert']; // Conditional logic for showing/hiding footer

        if (!($page === 'menu' && in_array($category, $excluded_categories))) {
            include 'footer.php'; // Show footer if the page is not 'menu'
        }
    ?>
</body>
</html>
