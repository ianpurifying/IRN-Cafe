<div>
    <h2>Menu Management</h2>
    <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addMenuModal">Add Menu</button>
    
    <!-- Modal for Adding Menu -->
    <div class="modal fade" id="addMenuModal" tabindex="-1" aria-labelledby="addMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMenuModalLabel">Add New Menu Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form id="addMenuForm" action="crud/menu/create_menu.php" method="POST" enctype="multipart/form-data">
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
                    <button type="submit" class="btn btn-primary">Save Menu</button>
                </form>

                </div>
            </div>
        </div>
    </div>

<!-- Menu List Section -->
<div id="menuList" class="row">
    <!-- Menu items will be loaded here dynamically -->
</div>

<!-- Local jQuery -->
<script src="../bootstrap_modules/node_modules/jquery/dist/jquery.min.js"></script>
<!-- Local Bootstrap CSS -->
<link href="../bootstrap_modules/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

<script>
$(document).ready(function() {
    // When the page is loaded, make an AJAX request to get the menu data
    $.ajax({
        url: 'crud/menu/read_menu.php',  // Path to your get_menu.php file
        type: 'GET',
        success: function(response) {
            // Insert the fetched menu data into the 'menuList' div
            $('#menuList').html(response);
        },
        error: function() {
            // Handle error (optional)
            $('#menuList').html('<p>Sorry, we couldn\'t load the menu items. Please try again later.</p>');
        }
    });
});
</script>
</div>