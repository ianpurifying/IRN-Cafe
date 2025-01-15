<?php
require '../../config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['menu_id'])) {
    $menu_id = intval($_POST['menu_id']);

    // Check if the user is logged in
    if (!isset($_SESSION['user']) || !isset($_SESSION['user']['email'])) {
        // Redirect to login page or display an error
        echo "<script>window.location.href = '../../index.php?page=login';</script>";
        exit;
    }

    // Get the user's email
    $email = $_SESSION['user']['email'];

    // Check if the item is already in the cart
    $check_sql = "SELECT * FROM cart WHERE email = ? AND menu_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("si", $email, $menu_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update quantity if already in the cart
        $update_sql = "UPDATE cart SET quantity = quantity + 1 WHERE email = ? AND menu_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("si", $email, $menu_id);
        $update_stmt->execute();
    } else {
        // Insert new item
        $insert_sql = "INSERT INTO cart (email, menu_id) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("si", $email, $menu_id);
        $insert_stmt->execute();
    }

    // Redirect to cart page
    echo "<script>window.location.href = '../../index.php?page=cart';</script>";
    exit;
}
?>
