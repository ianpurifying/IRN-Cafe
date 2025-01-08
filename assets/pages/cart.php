<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        header {
            color: black;
            padding: 1rem 2rem;
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        .cart-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 1rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        .cart-table th, .cart-table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .cart-table th {
            background-color: #f2f2f2;
        }

        .cart-table tr:hover {
            background-color: #f9f9f9;
        }

        .cart-summary {
            text-align: right;
            margin-top: 1rem;
        }

        .cart-summary p {
            font-size: 1.2rem;
            margin: 0.5rem 0;
        }

        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            color: white;
            background-color: #28a745;
            text-decoration: none;
            border-radius: 4px;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #218838;
        }

        footer {
            text-align: center;
            padding: 1rem 0;
            background-color: #f2f2f2;
            color: #666;
            margin-top: 2rem;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php
    require_once(__DIR__ . '/../../config.php');

    // Start the session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Check if user is logged in
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?page=login");
        exit;
    }

    $email = $_SESSION['user']['email'];

    // Fetch cart items for the logged-in user
    $sql = "SELECT menu.menu_name, menu.price, cart.quantity 
            FROM cart 
            JOIN menu ON cart.menu_id = menu.id 
            WHERE cart.email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>

    <header>
        <h1>Your Cart</h1>
    </header>

    <main>
        <section class="cart-container">
            <?php if ($result->num_rows > 0): ?>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $grandTotal = 0;
                        while ($row = $result->fetch_assoc()): 
                            $itemTotal = $row['price'] * $row['quantity'];
                            $grandTotal += $itemTotal;
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['menu_name']); ?></td>
                                <td>$<?php echo number_format($row['price'], 2); ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td>$<?php echo number_format($itemTotal, 2); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <div class="cart-summary">
                    <p><strong>Total:</strong> $<?php echo number_format($grandTotal, 2); ?></p>
                    <a href="index.php?page=checkout" class="btn">Checkout</a>
                </div>
            <?php else: ?>
                <p>Your cart is empty. <a href="index.php?#menu">Start shopping</a>.</p>
            <?php endif; ?>
            <?php 
            $stmt->close();
            $conn->close();
            ?>
        </section>
    </main>
</body>
</html>
