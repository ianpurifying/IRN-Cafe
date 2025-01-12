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
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #ffefba, #ffffff);
            color: #333;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 1rem 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        .history-area {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 80vh;
            padding: 2rem 1rem;
        }

        .historyBox {
            max-width: 800px;
            width: 100%;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .order {
            border-bottom: 1px solid #e0e0e0;
            padding: 1.5rem 0;
        }

        .order:last-child {
            border-bottom: none;
        }

        .order h3 {
            margin: 0 0 0.5rem;
            color: #333;
            font-size: 1.2rem;
        }

        .order p {
            margin: 0.25rem 0;
            line-height: 1.5;
            color: #555;
        }

        .order-details {
            background: #f8f9fa;
            padding: 0.75rem;
            border-radius: 6px;
            margin-top: 1rem;
            font-size: 0.9rem;
            border-left: 4px solid #4CAF50;
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

        .no-history {
            text-align: center;
            color: #888;
            font-size: 1.1rem;
        }

        .no-history a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }

        .no-history a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Order History</h1>
    </header>
    <div class="history-area">
        <div class="historyBox">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="order">
                        <h3>Order Date: <?php echo date("F d, Y h:i A", strtotime($row['created_at'])); ?></h3>
                        <p><strong>Total Amount:</strong> $<?php echo number_format($row['total_amount'], 2); ?></p>
                        <p><strong>Status:</strong> <span class="status <?php echo htmlspecialchars($row['status']); ?>"><?php echo htmlspecialchars($row['status']); ?></span></p>
                        <div class="order-details">
                            <p><strong>Order Details:</strong></p>
                            <?php
                            $orderDetails = json_decode($row['order_details'], true);
                            foreach ($orderDetails as $item): ?>
                                <p>
                                    <?php echo htmlspecialchars($item['item']); ?> 
                                    x <?php echo $item['quantity']; ?> 
                                    @ $<?php echo number_format($item['price'], 2); ?> 
                                    = $<?php echo number_format($item['total'], 2); ?>
                                </p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-history">
                    <p>No order history available. <a href="index.php?#menu">Place your first order!</a></p>
                </div>
            <?php endif; ?>
            <?php 
            $stmt->close();
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>

