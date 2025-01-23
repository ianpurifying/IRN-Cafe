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
<title>Sales Dashboard</title>
<style>
    .sales-con {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    /* Header Styles */
    .sales-con header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .sales-con header h1 {
        color: #007bff;
        font-size: 2.5rem;
    }

    /* Table Styles */
    .saleDashboard table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 2rem;
    }

    .saleDashboard th,
    .saleDashboard td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .saleDashboard th {
        background-color: #007bff;
        color: white;
        font-size: 1.1rem;
    }

    .saleDashboard tr:hover {
        background-color: #f1f1f1;
    }

    /* Sales Summary Styles */
    .total-sales {
        font-size: 1.5rem;
        font-weight: bold;
        color: #28a745;
        text-align: right;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .sales-con {
            padding: 1.5rem;
        }

        .saleDashboard table {
            font-size: 0.9rem;
        }

        .total-sales {
            font-size: 1.2rem;
        }
    }
</style>
<div class="sales-con">
    <header>
        <h1>Sales Dashboard</h1>
    </header>
    <div class="saleDashboard">
        <h2>Sales Overview</h2>
        <?php if (!empty($completedOrders)): ?>
            <table>
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
            <p class="total-sales">Overall Total Sales: ₱<?php echo number_format($totalSales, 2); ?></p>
        <?php else: ?>
            <p>No completed sales found.</p>
        <?php endif; ?>
        <?php $conn->close(); ?>
    </div>
</div>
