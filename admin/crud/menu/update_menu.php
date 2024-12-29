<?php
include('../../database/db_conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $menu_name = $_POST['menu_name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $imagePath = null;

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imagePath = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], '../../' . $imagePath);
    }

    // Update the database
    $sql = "UPDATE menu SET menu_name=?, description=?, category=?, image=COALESCE(?, image) WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $menu_name, $description, $category, $imagePath, $id);

    if ($stmt->execute()) {
        echo "Menu item updated successfully.";
    } else {
        echo "Error updating menu item: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
