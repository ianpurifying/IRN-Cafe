<?php
require '../../config.php';
session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>window.location.href = 'index.php?page=login';</script>";
    exit;
}

$email = $_SESSION['user']['email'];

// Check if a button was clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menu_name = $_POST['increase'] ?? $_POST['decrease'] ?? null;

    if ($menu_name) {
        // Fetch the current quantity of the item
        $sql = "SELECT cart.quantity, menu.id 
                FROM cart 
                JOIN menu ON cart.menu_id = menu.id 
                WHERE cart.email = ? AND menu.menu_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $menu_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentQuantity = $row['quantity'];
            $menu_id = $row['id'];

            if (isset($_POST['increase'])) {
                // Increase the quantity
                $newQuantity = $currentQuantity + 1;
                $updateSql = "UPDATE cart SET quantity = ? WHERE email = ? AND menu_id = ?";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bind_param("isi", $newQuantity, $email, $menu_id);
                $updateStmt->execute();
            } elseif (isset($_POST['decrease'])) {
                if ($currentQuantity > 1) {
                    // Decrease the quantity
                    $newQuantity = $currentQuantity - 1;
                    $updateSql = "UPDATE cart SET quantity = ? WHERE email = ? AND menu_id = ?";
                    $updateStmt = $conn->prepare($updateSql);
                    $updateStmt->bind_param("isi", $newQuantity, $email, $menu_id);
                    $updateStmt->execute();
                } else {
                    // Delete the item if quantity is 1
                    $deleteSql = "DELETE FROM cart WHERE email = ? AND menu_id = ?";
                    $deleteStmt = $conn->prepare($deleteSql);
                    $deleteStmt->bind_param("si", $email, $menu_id);
                    $deleteStmt->execute();
                }
            }
        }
    }
}

// Redirect back to the cart page
echo "<script>window.location.href = '../../index.php?page=cart';</script>";
exit;
?>
