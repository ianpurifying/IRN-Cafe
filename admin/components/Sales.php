<?php
// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the configuration file
require 'database/config.php'; 

// Include Dompdf for PDF generation
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Check if the user is an admin
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

// Generate PDF if the "Download PDF" button is clicked
if (isset($_POST['download_pdf'])) {
    ob_start(); // Start output buffering
    ?>
    <style>
        .report-container {
            width: 100%;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .report-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .report-header h2 {
            font-size: 24px;
            color: #007bff;
            margin: 0;
            padding-bottom: 10px;
            border-bottom: 2px solid #007bff;
        }
        .sales-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .sales-table th, .sales-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .sales-table th {
            background-color: #007bff;
            color: #fff;
            font-size: 14px;
        }
        .sales-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .sales-table tr:hover {
            background-color: #f1f1f1;
        }
        .total-sales {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            color: #28a745;
        }
        .no-sales {
            text-align: center;
            color: #dc3545;
            font-size: 16px;
            margin-top: 20px;
        }
    </style>
    <div class="report-container">
        <div class="report-header">
            <h2>IRN Cafe Sales Report</h2>
        </div>
        <?php if (!empty($completedOrders)): ?>
            <table class="sales-table">
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
                                    echo htmlspecialchars($item['item']) . ' x ' . $item['quantity'] . ' @ ' . number_format($item['price'], 2) . '<br>';
                                }
                                ?>
                            </td>
                            <td><?php echo number_format($order['total_amount'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p class="total-sales">Overall Sales: <?php echo number_format($totalSales, 2); ?></p>
        <?php else: ?>
            <p class="no-sales">No completed sales found.</p>
        <?php endif; ?>
    </div>
    <?php
    $html = ob_get_clean(); // Get the output and clean the buffer

    // Setup Dompdf
    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Get the generated PDF as a base64 string
    $pdfOutput = $dompdf->output();
    $pdfBase64 = base64_encode($pdfOutput);

    // Store the base64 string in a session variable for use in JavaScript
    $_SESSION['pdf_base64'] = $pdfBase64;

    // Redirect to the same page to reload and trigger the download
    echo "<script>window.location.href = window.location.href;</script>";
    exit;
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

    .download-btn {
        padding: 10px 20px;
        font-size: 14px;
        background-color: #007bff; /* Primary blue color */
        color: white;
        border: none;
        border-radius: 5px; /* Rounded corners */
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        text-transform: uppercase;
    }

    .download-btn:hover {
        background-color: #0056b3; /* Darker blue on hover */
        transform: translateY(-2px); /* Slight upward movement */
    }

    .download-btn:active {
        background-color: #004085; /* Even darker blue on active click */
        transform: translateY(0); /* Return to original position */
    }

    .download-btn:focus {
        outline: none; /* Remove outline on focus */
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
        <form method="post">
                <button type="submit" name="download_pdf" class="download-btn">Download PDF</button>
        </form>
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
            <p class="total-sales">Overall Sales: ₱<?php echo number_format($totalSales, 2); ?></p>
        <?php else: ?>
            <p>No completed sales found.</p>
        <?php endif; ?>
        <?php $conn->close(); ?>
    </div>
</div>

<!-- Add this JavaScript to trigger the download -->
<?php if (isset($_SESSION['pdf_base64'])): ?>
    <script>
        const pdfBase64 = '<?php echo $_SESSION['pdf_base64']; ?>';
        const link = document.createElement('a');
        link.href = 'data:application/pdf;base64,' + pdfBase64;
        link.download = 'Sales_Report_<?php echo date('Y-m-d'); ?>.pdf';
        link.click();
        <?php unset($_SESSION['pdf_base64']); // Clear the session variable after download ?>
    </script>
<?php endif; ?>
