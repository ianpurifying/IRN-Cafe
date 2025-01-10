<?php
// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the configuration file
require 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit;
}

// Fetch user email
$email = $_SESSION['user']['email'];

// Fetch order history from the `checkouts` table
$sql = "SELECT order_details, total_amount, status, created_at FROM checkouts WHERE email = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
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
            padding: 1rem;
            text-align: center;
        }
        .historyBox {
            max-width: 800px;
            margin: 2rem auto;
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .order {
            border-bottom: 1px solid #ddd;
            padding: 1rem 0;
        }
        .order:last-child {
            border-bottom: none;
        }
        .order h3 {
            margin: 0 0 0.5rem;
            color: #4CAF50;
        }
        .order p {
            margin: 0.25rem 0;
            line-height: 1.6;
        }
        .order-details {
            background: #f4f4f4;
            padding: 0.5rem;
            border-radius: 4px;
            margin-top: 0.5rem;
            font-size: 0.9rem;
        }
        .status {
            font-weight: bold;
            text-transform: capitalize;
        }
        .status.pending {
            color: #f39c12;
        }
        .status.completed {
            color: #2ecc71;
        }
        .status.canceled {
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <header>
        <h1>Order History</h1>
    </header>
    <div class="historyBox">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="order">
                    <h3>Order Date: <?php echo date("F d, Y h:i A", strtotime($row['created_at'])); ?></h3>
                    <p><strong>Total Amount:</strong> $<?php echo number_format($row['total_amount'], 2); ?></p>
                    <p><strong>Status:</strong> <span class="status <?php echo $row['status']; ?>"><?php echo $row['status']; ?></span></p>
                    <div class="order-details">
                        <p><strong>Order Details:</strong></p>
                        <?php
                        $orderDetails = json_decode($row['order_details'], true);
                        foreach ($orderDetails as $item) {
                            echo '<p>' . htmlspecialchars($item['item']) . ' x ' . $item['quantity'] . ' @ $' . number_format($item['price'], 2) . ' = $' . number_format($item['total'], 2) . '</p>';
                        }
                        ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No order history available. <a href="index.php?#menu">Place your first order!</a></p>
        <?php endif; ?>
        <?php 
        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
