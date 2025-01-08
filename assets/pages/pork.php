<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pork Menu</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f8f8f8;
            padding: 20px;
        }

        .menu-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .menu-item {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
        }

        .menu-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .menu-item-details {
            padding: 15px;
        }

        .menu-item-details h3 {
            margin: 0;
        }

        .menu-item-details p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h1>Pork Menu</h1>
    <main class="menu-container">
    <?php
        require_once(__DIR__ . '/../../config.php'); // Database connection

        // SQL query to fetch only pork category items
        $sql = "SELECT * FROM menu WHERE category = 'pork' ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<article class="menu-item">';

                if (!empty($row['image'])) {
                    echo '<figure class="menu-item-image">';
                    echo '<img src="' . $row['image'] . '" alt="' . htmlspecialchars($row['menu_name']) . '">';
                    echo '</figure>';
                }

                echo '<div class="menu-item-details">';
                echo '<h3>' . htmlspecialchars($row['menu_name']) . '</h3>';
                echo '<p>' . nl2br(htmlspecialchars($row['description'])) . '</p>';
                echo '<p><strong>Price:</strong> $' . htmlspecialchars($row['price']) . '</p>';
                echo '<p class="category">Category: ' . htmlspecialchars($row['category']) . '</p>';
                echo '</div>';

                echo '</article>';
            }
        } else {
            echo '<p class="no-items">No pork found.</p>';
        }

        $conn->close();
    ?>
    </main>
</body>

</html>
