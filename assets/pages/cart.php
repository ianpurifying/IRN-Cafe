<?php
// Include the configuration file
require 'config.php'; 

// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    echo "<script>window.location.href = 'index.php?page=login';</script>";
    exit;
}

// Check for Checkout Request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    $email = $_SESSION['user']['email'];

    // Fetch Cart Items
    $sql = "SELECT menu.menu_name, menu.price, menu.image, cart.quantity 
            FROM cart 
            JOIN menu ON cart.menu_id = menu.id 
            WHERE cart.email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $orderDetails = [];
        $totalAmount = 0;

        while ($row = $result->fetch_assoc()) {
            $itemTotal = $row['price'] * $row['quantity'];
            $totalAmount += $itemTotal;
            $orderDetails[] = [
                'item' => $row['menu_name'],
                'price' => $row['price'],
                'quantity' => $row['quantity'],
                'total' => $itemTotal
            ];
        }

        // Convert order details to JSON
        $orderDetailsJson = json_encode($orderDetails);

        // Insert Order into `checkouts` Table
        $insertSql = "INSERT INTO checkouts (email, order_details, total_amount, status) 
                      VALUES (?, ?, ?, 'pending')";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("ssd", $email, $orderDetailsJson, $totalAmount);
        $insertStmt->execute();

        // Clear the Cart
        $deleteSql = "DELETE FROM cart WHERE email = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("s", $email);
        $deleteStmt->execute();

        // Close Statements
        $insertStmt->close();
        $deleteStmt->close();

        // Display Confirmation Message
        $_SESSION['message'] = "Thank you for purchasing!";
        echo "<script>window.location.href = 'index.php?page=confirmation';</script>";
        exit;
    } else {
        $_SESSION['message'] = "Your cart is empty!";
        echo "<script>window.location.href = 'index.php?page=cart';</script>";
        exit;
    }
}

// Fetch cart items for display
$email = $_SESSION['user']['email'];
$sql = "SELECT menu.menu_name, menu.price, menu.image, cart.quantity 
        FROM cart 
        JOIN menu ON cart.menu_id = menu.id 
        WHERE cart.email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
?>

<style>
    .cart-area {
        display: grid;
    }

    .cart-zone header {
        color: black;
        padding: 1rem 2rem;
        text-align: center;
    }

    .cart-zone header h1 {
        margin: 0;
        font-size: 1.8rem;
    }

    .cart-con {
        max-width: 500px;
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

    .image-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .cart-item-image {
        max-width: 70px; /* Adjust this value as needed */
        max-height: 70px; /* Adjust this value as needed */
        object-fit: contain;
    }

    .menu-name {
        font-size: 0.9rem; /* Adjust this value as needed */
        text-align: center;
        margin-top: 5px; /* Adds some space between the image and the menu name */
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
</style>
<div class="cart-zone">
    <header>
        <h1>Your Cart</h1>
    </header>
    <div class="cart-area">
    <main>
        <section class="cart-con">
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
                            <td>
                                <?php if (!empty($row['image'])): ?>
                                    <div class="image-container">
                                        <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['menu_name']) ?>" class="cart-item-image">
                                        <p class="menu-name"><?= htmlspecialchars($row['menu_name']) ?></p>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>₱<?php echo number_format($row['price'], 2); ?></td>
                            <td>
                                <form method="POST" action="assets/handlers/update_cart.php" style="display: flex; align-items: center; gap: 8px;">
                                    <button type="submit" name="decrease" value="<?= htmlspecialchars($row['menu_name']) ?>" style="border: none; background: none; font-size: 1.2rem; cursor: pointer;">-</button>
                                    <span><?= $row['quantity']; ?></span>
                                    <button type="submit" name="increase" value="<?= htmlspecialchars($row['menu_name']) ?>" style="border: none; background: none; font-size: 1.2rem; cursor: pointer;">+</button>
                                </form>
                            </td>
                            <td>₱<?php echo number_format($itemTotal, 2); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>

                </table>
                <div class="cart-summary">
                    <p><strong>Total:</strong> ₱<?php echo number_format($grandTotal, 2); ?></p>
                    <form method="POST">
                        <button type="submit" name="checkout" class="btn">Checkout</button>
                    </form>
                </div>
            <?php else: ?>
                <p>Your cart is empty. <a href="index.php">Start shopping</a>.</p>
            <?php endif; ?>
            <?php 
            $stmt->close();
            $conn->close();
            ?>
        </section>
    </main>
</div>
