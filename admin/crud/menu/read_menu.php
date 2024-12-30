<!DOCTYPE html>
<html>
<head>
    <link href="/projects/_college/final/bootstrap_modules/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="/projects/_college/final/bootstrap_modules/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/projects/_college/final/bootstrap_modules/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f8f8f8;
        }

        .menu-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: start;
            padding: 30px;
        }

        .menu-item {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 10px;
            overflow: hidden;
            width: 300px;
            position: relative;
        }

        .menu-item-image {
            height: 200px;
            overflow: hidden;
        }

        .menu-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .menu-item-details {
            padding: 15px;
        }

        .category {
            color: #777;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <main class="menu-container">
        <?php
        include('../../database/db_conn.php');
        $sql = "SELECT * FROM menu ORDER BY id DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<article class="menu-item">';
                if ($row['image']) {
                    echo '<figure class="menu-item-image">';
                    echo '<img src="' . $row['image'] . '" alt="' . htmlspecialchars($row['menu_name']) . '">';
                    echo '</figure>';
                }
                echo '<div class="menu-item-details">';
                echo '<h3>' . htmlspecialchars($row['menu_name']) . '</h3>';
                echo '<p>' . nl2br(htmlspecialchars($row['description'])) . '</p>';
                echo '<p class="category">Category: ' . htmlspecialchars($row['category']) . '</p>';

                // Bootstrap Dropdown Menu
                echo '<div class="dropdown">';
                echo '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton' . $row['id'] . '" data-bs-toggle="dropdown" aria-expanded="false">';
                echo 'Actions';
                echo '</button>';
                echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton' . $row['id'] . '">';
                echo '<li><a class="dropdown-item edit-link" href="#" data-id="' . $row['id'] . '" data-name="' . htmlspecialchars($row['menu_name']) . '" data-description="' . htmlspecialchars($row['description']) . '" data-category="' . htmlspecialchars($row['category']) . '" data-image="' . $row['image'] . '">Edit</a></li>';
                echo '<li><a class="dropdown-item delete-link" href="#" data-id="' . $row['id'] . '">Delete</a></li>';
                echo '</ul>';
                echo '</div>';

                echo '</div>';
                echo '</article>';
            }
        } else {
            echo '<p class="no-items">No menu items found.</p>';
        }
        $conn->close();
        ?>
    </main>

    <!-- Edit Modal -->
    <div class="modal fade" id="editMenuModal" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMenuModalLabel">Edit Menu Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editMenuForm">
                        <input type="hidden" id="menuId" name="id">
                        <div class="mb-3">
                            <label for="menuName" class="form-label">Menu Name</label>
                            <input type="text" class="form-control" id="menuName" name="menu_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="chicken">Chicken</option>
                                <option value="pasta">Pasta</option>
                                <option value="dessert">Dessert</option>
                                <option value="drinks">Drinks</option>
                            </select>
                        </div>
                        <div class="mb-3">
                        <label for="image" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script for Modal and Actions -->
    <script>
    $(document).ready(function() {
        // Handle Edit button click
        $('.edit-link').click(function(e) {
            e.preventDefault();
            const menuId = $(this).data('id');
            const menuName = $(this).data('name');
            const description = $(this).data('description');
            const category = $(this).data('category');
            const image = $(this).data('image');

            // Populate the modal fields
            $('#menuId').val(menuId);
            $('#menuName').val(menuName);
            $('#description').val(description);
            $('#category').val(category);

            // Show current image (if exists)
            if (image) {
                $('#currentImageContainer').html('<img src="' + image + '" class="img-fluid" alt="Current Image" />');
            } else {
                $('#currentImageContainer').html('<p>No image available.</p>');
            }

            // Show the modal
            $('#editMenuModal').modal('show');
        });

        // Submit the Edit form (including the image)
        $('#editMenuForm').submit(function(e) {
            e.preventDefault();
            const formData = new FormData(this); // Use FormData to handle file upload

            $.ajax({
                url: 'crud/menu/update_menu.php',
                type: 'POST',
                data: formData,
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Prevent jQuery from setting the content type
                success: function(response) {
                    alert(response);
                    location.reload();
                },
                error: function() {
                    alert('Failed to update menu item.');
                }
            });
        });
    });

    // Handle Delete button click
    $('.delete-link').click(function(e) {
        e.preventDefault();
        if (confirm('Are you sure you want to delete this menu item?')) {
            const menuId = $(this).data('id');
            $.ajax({
                url: 'crud/menu/delete_menu.php', // Ensure this is the correct path for your delete script
                type: 'POST',
                data: { id: menuId },
                success: function(response) {
                    alert(response);
                    location.reload();
                },
                error: function() {
                    alert('Failed to delete menu item.');
                }
            });
        }
    });
    </script>
</body>
</html>
