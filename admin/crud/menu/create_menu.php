<?php
include('../../database/db_conn.php'); // Ensure the database connection is included

// Check if connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $menu_name = $_POST['menu_name'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imagePath = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], '../../' . $imagePath);
    } else {
        $imagePath = null;
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO menu (menu_name, description, category, image) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        // Check if the statement preparation fails
        die('MySQL prepare error: ' . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssss", $menu_name, $description, $category, $imagePath);
    
    // Execute the query
    if ($stmt->execute()) {
        // Redirect back to the Menu tab after saving the menu item
        header('Location: ../../index.php?tab=menu');
        exit(); // Always call exit() after a header redirect to ensure the script stops executing
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection after use (at the end of the script)
$conn->close();
?>
