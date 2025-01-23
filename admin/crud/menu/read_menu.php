<link href="../modules/bootstrap/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="../modules/bootstrap/node_modules/jquery/dist/jquery.min.js"></script>
<script src="../modules/bootstrap/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .menu-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        justify-content: center;
        padding: 2rem;
    }

    .menu-item {
        background-color: #ffffff;
        border: 1px solid #dee2e6;
        border-radius: 0.75rem;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        width: 100%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .menu-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    .menu-item img {
        width: 100%;
        aspect-ratio: 16/9; /* Ensures consistent image size */
        object-fit: cover;
    }

    .menu-item-body {
        padding: 1rem;
    }

    .menu-item-body h5 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .menu-item-body p {
        font-size: 0.95rem;
        color: #6c757d;
        margin-bottom: 0.5rem;
    }

    .menu-item-body p strong {
        color: #000;
    }

    .dropdown-menu {
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .btn-outline-secondary {
        font-size: 0.875rem;
    }
</style>
<main class="container my-4">
    <div class="row g-4"> <!-- g-4 adds spacing between columns -->
        <?php
        include('../../database/config.php');
        $sql = "SELECT * FROM menu ORDER BY id DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center"> <!-- Centering cards for better alignment -->
                    <div class="menu-item card shadow-sm h-100">
                        <?php if ($row['image']) { ?>
                            <img src="<?= $row['image'] ?>" alt="<?= htmlspecialchars($row['menu_name']) ?>">
                        <?php } ?>
                        <div class="menu-item-body">
                            <h5><?= htmlspecialchars($row['menu_name']) ?></h5>
                            <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
                            <p><strong>Price:</strong> ₱<?= htmlspecialchars($row['price']) ?></p>
                            <p class="text-muted"><small>Category: <?= htmlspecialchars($row['category']) ?></small></p>
                            <div class="dropdown mt-2">
                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                    Actions
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item edit-link" href="#" 
                                           data-id="<?= $row['id'] ?>" 
                                           data-name="<?= htmlspecialchars($row['menu_name']) ?>" 
                                           data-description="<?= htmlspecialchars($row['description']) ?>" 
                                           data-price="<?= htmlspecialchars($row['price']) ?>" 
                                           data-category="<?= htmlspecialchars($row['category']) ?>" 
                                           data-image="<?= $row['image'] ?>">Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item delete-link" href="#" data-id="<?= $row['id'] ?>">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
        ?>
            <p class="text-center text-muted">No menu items found.</p>
        <?php
        }
        $conn->close();
        ?>
    </div>
</main>

<!-- Edit Modal -->
<div class="modal fade" id="editMenuModal" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Menu Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editMenuForm">
                <div class="modal-body">
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
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="chicken">Chicken</option>
                            <option value="pork">Pork</option>
                            <option value="dessert">Dessert</option>
                            <option value="drinks">Drinks</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.edit-link').click(function(e) {
            e.preventDefault();
            const data = $(this).data();
            $('#menuId').val(data.id);
            $('#menuName').val(data.name);
            $('#description').val(data.description);
            $('#price').val(data.price);
            $('#category').val(data.category);
            $('#editMenuModal').modal('show');
        });

        $('.delete-link').click(function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this menu item?')) {
                $.post('crud/menu/delete_menu.php', { id: $(this).data('id') }, function(response) {
                    alert(response);
                    location.reload();
                });
            }
        });

        $('#editMenuForm').submit(function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                url: 'crud/menu/update_menu.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert(response);
                    location.reload();
                }
            });
        });
    });
</script>
