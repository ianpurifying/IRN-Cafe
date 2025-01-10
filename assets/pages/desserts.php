<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desserts Menu</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            padding: 20px 0;
            background-color: #ffcc00;
            margin: 0;
            font-size: 2.5rem;
        }

        .menu-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            padding: 20px;
            justify-items: center;
        }

        .menu-item {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
        }

        .menu-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .menu-item img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .menu-item-details {
            padding: 20px;
            color: #333;
        }

        .menu-item-details h3 {
            font-size: 1.6rem;
            margin-bottom: 10px;
            color: #ff6600;
        }

        .menu-item-details p {
            margin-bottom: 10px;
            font-size: 1rem;
            color: #555;
        }

        .menu-item-details p strong {
            font-weight: bold;
        }

        .add-to-cart-form {
            display: flex;
            justify-content: start;
            margin-top: 10px;
            padding: 10px;
        }

        .add-to-cart-form button {
            background-color: #ff6600;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .add-to-cart-form button:hover {
            background-color: #e65c00;
        }

        .no-items {
            text-align: center;
            color: #ff6600;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <h1>Desserts Menu</h1>
    <main class="menu-container">
        <?php
            require 'config.php';

            $sql = "SELECT * FROM menu WHERE category = 'dessert' ORDER BY id DESC";
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
                    echo '<p><strong>Price:</strong> ₱' . htmlspecialchars($row['price']) . '</p>';
                    echo '</div>';
                    echo '<form class="add-to-cart-form" action="assets/handlers/add_to_cart.php" method="POST">';
                    echo '<input type="hidden" name="menu_id" value="' . $row['id'] . '">';
                    echo '<button type="submit">Add to Cart</button>';
                    echo '</form>';
                    echo '</article>';
                }
            } else {
                echo '<p class="no-items">No dessert found.</p>';
            }

            $conn->close();
        ?>
    </main>
</body>
</html>
