<?php
// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the configuration file
require 'database/config.php'; 

// Check if the user is an admin
if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin' || $_SESSION['user']['email'] !== 'admin@irncafe.com') {
    echo "<script>window.location.href = '../index.php?page=login';</script>";
    exit;
}

// Handle status updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $orderId = intval($_POST['order_id']);
    $newStatus = $_POST['status'];

    if (in_array($newStatus, ['pending', 'completed', 'canceled'])) {
        $updateSql = "UPDATE checkouts SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("si", $newStatus, $orderId);
        $stmt->execute();
        $stmt->close();
    }

    // Refresh the page to reflect updates
    echo "<script>window.location.href = '?tab=checkouts';</script>";
    exit;
}

// Fetch all pending orders
$sql = "SELECT id, email, order_details, total_amount, status, created_at FROM checkouts WHERE status = 'pending' ORDER BY created_at DESC";
$result = $conn->query($sql);

// Close connection
$conn->close();
?>

<title>Order Notification</title>
<style>
    .notification-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr); /* 4 cards per row */
        gap: 20px; /* Space between cards */
        padding: 60px;
        overflow-y: auto; /* Allow scrolling if there are many orders */
    }

    .notification-card {
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 1rem;
        max-width: 350px;
        z-index: 500;
    }

    .notification-card h3 {
        margin: 0;
        font-size: 1.2rem;
    }

    .notification-card p {
        margin: 0.5rem 0;
        font-size: 0.9rem;
    }

    .notification-card .details {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }

    .notification-card .status {
        background-color: #f39c12;
        color: #fff;
        padding: 0.3rem 0.6rem;
        border-radius: 4px;
    }

    .notification-card .btn {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
    }

    .notification-card .btn.accept {
        background-color: #2ecc71;
        color: white;
    }

    .notification-card .btn.decline {
        background-color: #e74c3c;
        color: white;
    }

    .order-details {
        margin-top: 1rem;
        font-size: 0.9rem;
        max-height: 250px; /* Increased max-height to allow for more items */
        overflow-y: scroll;  /* Enable vertical scrolling */
        scrollbar-width: thin; /* Firefox: thin scrollbar */
        scrollbar-color: #888 #f1f1f1; /* Firefox: thumb and track colors */
    }

/* Custom scrollbar for Webkit browsers (Chrome, Safari) */
    .order-details::-webkit-scrollbar {
        width: 8px; /* Set width of scrollbar */
    }

    .order-details::-webkit-scrollbar-track {
        background: #f1f1f1; /* Track background */
        border-radius: 10px;
    }

    .order-details::-webkit-scrollbar-thumb {
        background: #888; /* Thumb color */
        border-radius: 10px;
    }

    .order-details::-webkit-scrollbar-thumb:hover {
        background: #555; /* Thumb hover color */
    }


    .order-details table {
        width: 100%;
        border-collapse: collapse;
    }

    .order-details th, .order-details td {
        padding: 8px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .order-details th {
        background-color: #f4f4f4;
    }

    
</style>

<div class="notification-container">
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($order = $result->fetch_assoc()): ?>
            <div class="notification-card">
                <div class="header">
                    <h3>New Order Pending</h3>
                </div>
                <div class="content">
                    <div>
                        <p><strong>Buyer:</strong> <?php echo htmlspecialchars($order['email']); ?></p>
                        <p><strong>Total:</strong> ₱<?php echo number_format($order['total_amount'], 2); ?></p>
                        <p><strong>Status:</strong> <span class="status"><?php echo ucfirst($order['status']); ?></span></p>
                        <p><strong>Created At:</strong> <?php echo date("F d, Y h:i A", strtotime($order['created_at'])); ?></p>
                        <p><strong>Order Details:</strong></p>
                        <div class="order-details">
                        
                            <?php
                            // Decode the JSON data
                            $orderDetails = json_decode($order['order_details'], true);

                            // Check if JSON decoding was successful
                            if (json_last_error() !== JSON_ERROR_NONE) {
                                echo '<p>Error decoding JSON: ' . json_last_error_msg() . '</p>';
                            } else if ($orderDetails && is_array($orderDetails)) {
                                echo '<table>';
                                echo '<thead><tr><th>Item</th><th>Price</th><th>Quantity</th></tr></thead>';
                                echo '<tbody>';

                                // Limit to 3 items
                                $itemCount = 0;
                                foreach ($orderDetails as $item) {
                                    echo "<tr>";
                                    echo "<td>{$item['item']}</td>";
                                    echo "<td>₱" . number_format($item['price'], 2) . "</td>";
                                    echo "<td>{$item['quantity']}</td>";
                                    echo "</tr>";
                                }
                                

                                echo '</tbody></table>';
                            } else {
                                echo '<p>Invalid order details format or empty data.</p>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="details">
                        <form method="POST" style="display: inline-block;">
                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" name="update_status" class="btn accept">Accept</button>
                        </form>
                        <form method="POST" style="display: inline-block;">
                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                            <input type="hidden" name="status" value="canceled">
                            <button type="submit" name="update_status" class="btn decline">Decline</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="no-pending">
            <p>No pending orders at the moment.</p>
        </div>
    <?php endif; ?>
</div>
