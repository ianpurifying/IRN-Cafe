<?php
// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the configuration file
require 'database/config.php'; 

// Check if the user is an admin (replace with your admin verification logic)
if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin' || $_SESSION['user']['email'] !== 'admin@irncafe.com') {
    echo "<script>window.location.href = '../index.php?page=login';</script>";
    exit;
}

// Fetch completed orders
$sql = "SELECT order_details, total_amount, created_at FROM checkouts WHERE status = 'completed'";
$result = $conn->query($sql);

// Initialize variables for sales calculations
$completedOrders = [];
$totalSales = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $completedOrders[] = $row;
        $totalSales += $row['total_amount'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Dashboard</title>
    <!-- Local Bootstrap CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }
        header {
            color: black;
            padding: 1rem;
            text-align: center;
        }
        .saleDashboard {
            margin: 2rem auto;
            padding: 1.5rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 0.75rem;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        
        .total-sales {
            font-size: 1.25rem;
            font-weight: bold;
            color: #28a745;
        }
    </style>
</head>
<body>
    <header>
        <h1>Sales Dashboard</h1>
    </header>
    <div class="saleDashboard">
        <h2>Sales Overview</h2>
        <?php if (!empty($completedOrders)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order Date</th>
                        <th>Order Details</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($completedOrders as $order): ?>
                        <tr>
                            <td><?php echo date("F d, Y h:i A", strtotime($order['created_at'])); ?></td>
                            <td>
                                <?php
                                $orderDetails = json_decode($order['order_details'], true);
                                foreach ($orderDetails as $item) {
                                    echo htmlspecialchars($item['item']) . ' x ' . $item['quantity'] . ' @ ₱' . number_format($item['price'], 2) . '<br>';
                                }
                                ?>
                            </td>
                            <td>₱<?php echo number_format($order['total_amount'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p class="total-sales">Overall Total Sales: $<?php echo number_format($totalSales, 2); ?></p>
        <?php else: ?>
            <p>No completed sales found.</p>
        <?php endif; ?>
        <?php $conn->close(); ?>
    </div>

</body>
</html>
