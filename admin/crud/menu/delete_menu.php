<?php
include('../../database/db_conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Delete the menu item
    $sql = "DELETE FROM menu WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Menu item deleted successfully.";
    } else {
        echo "Failed to delete menu item.";
    }

    $stmt->close();
}
$conn->close();
?>
