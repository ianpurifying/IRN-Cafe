<?php
// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the configuration file
require 'database/config.php'; 

// Check if the user is an admin (replace with your admin verification logic)
if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin' || $_SESSION['user']['email'] !== 'admin@irncafe.com') {
    header("Location: ../index.php?page=login");
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
    header("Location: ?tab=checkouts");
    exit;
}

// Fetch all orders
$sql = "SELECT id, email, order_details, total_amount, status, created_at FROM checkouts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkouts Management</title>
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
        .checkoutManagement {
            margin: 2rem auto;
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 0.75rem;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .status {
            text-transform: capitalize;
            font-weight: bold;
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
        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn.update {
            background-color: #4CAF50;
            color: white;
        }
        .btn.cancel {
            background-color: #e74c3c;
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <h1>Checkouts</h1>
    </header>
    <div class="checkoutManagement">
        <h2>All Orders</h2>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Order Details</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td>
                                <div>
                                    <?php
                                    $orderDetails = json_decode($row['order_details'], true);
                                    foreach ($orderDetails as $item) {
                                        echo '<p>' . htmlspecialchars($item['item']) . ' x ' . $item['quantity'] . 
                                             ' @ $' . number_format($item['price'], 2) . ' = $' . number_format($item['total'], 2) . '</p>';
                                    }
                                    ?>
                                </div>
                            </td>
                            <td>$<?php echo number_format($row['total_amount'], 2); ?></td>
                            <td><span class="status <?php echo $row['status']; ?>"><?php echo $row['status']; ?></span></td>
                            <td><?php echo date("F d, Y h:i A", strtotime($row['created_at'])); ?></td>
                            <td>
                                <form method="POST" style="display: inline-block;">
                                    <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                    <select name="status">
                                        <option value="pending" <?php echo $row['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                        <option value="completed" <?php echo $row['status'] === 'completed' ? 'selected' : ''; ?>>Completed</option>
                                        <option value="canceled" <?php echo $row['status'] === 'canceled' ? 'selected' : ''; ?>>Canceled</option>
                                    </select>
                                    <button type="submit" name="update_status" class="btn update">Update</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No orders found.</p>
        <?php endif; ?>
        <?php 
        $conn->close();
        ?>
    </div>
</body>
</html>
