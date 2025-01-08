<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drinks Menu</title>
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
    <h1>Drinks Menu</h1>
    <main class="menu-container">
    <?php
        require_once(__DIR__ . '/../../config.php');

        $sql = "SELECT * FROM menu WHERE category = 'drinks' ORDER BY id DESC";
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
                echo '</div>';
                echo '<form class="add-to-cart-form" action="assets/handlers/add_to_cart.php" method="POST">'; // Updated action URL
                echo '<input type="hidden" name="menu_id" value="' . $row['id'] . '">';
                echo '<button type="submit">Add to Cart</button>';
                echo '</form>';
                echo '</article>';
            }
        } else {
            echo '<p class="no-items">No drinks found.</p>';
        }

        $conn->close();
    ?>
    </main>
</body>

</html>
