<?php
include('../../database/config.php'); // Ensure the database connection is included

// Check if connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $id = $_POST['id'];
    $menu_name = $_POST['menu_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $adminImagePath = null; // Default image path for admin-side

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Admin-side upload directory
        $adminImagePath = 'uploads/' . basename($_FILES['image']['name']);
        $adminFullPath = '../../' . $adminImagePath; // Full path for admin-side

        // Client-side upload directory
        $clientImagePath = '../../../uploads/' . basename($_FILES['image']['name']); // Full path for client-side

        // Move the file to the admin-side directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $adminFullPath)) {
            // Copy the file to the client-side directory
            if (!copy($adminFullPath, $clientImagePath)) {
                echo "Error: Failed to copy the image to the client-side directory.";
                exit();
            }
        } else {
            echo "Error: Failed to upload the image to the admin-side directory.";
            exit();
        }
    }

    // Prepare the SQL statement for updating the menu
    $sql = "UPDATE menu SET menu_name=?, description=?, price=?, category=?, image=COALESCE(?, image) WHERE id=?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssdssi", $menu_name, $description, $price, $category, $adminImagePath, $id);
    
    // Execute the query
    if ($stmt->execute()) {
        echo "Menu item updated successfully.";
    } else {
        echo "Error updating menu item: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection after use (at the end of the script)
$conn->close();
?>
