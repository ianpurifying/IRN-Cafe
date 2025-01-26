<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session only if not already started
}

require 'config.php';  

// Get the category from the URL
$category = $_GET['category'] ?? '';  // Default to empty if no category is provided

// Fetch all categories if no specific category is requested
if (empty($category)) {
    $sql = "SELECT DISTINCT category FROM menu ORDER BY category ASC";
    $result = $conn->query($sql);
    $categories = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row['category'];
        }
    }
} else {
    // Fetch menu items for the specific category using prepared statements
    $stmt = $conn->prepare("SELECT * FROM menu WHERE category = ? ORDER BY id DESC");
    $stmt->bind_param("s", $category);  // Bind the category parameter securely
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
}

// Handle add to cart action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['menu_id'])) {

    $menu_id = intval($_POST['menu_id']);

    // Check if the user is logged in
    if (!isset($_SESSION['user']) || !isset($_SESSION['user']['email'])) {
        // Redirect to login page if not logged in
        echo "<script>window.location.href = 'index.php?page=login';</script>";
        exit;
    } else {
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
            $success_message = "Item quantity updated in your cart!";
        } else {
            // Insert new item
            $insert_sql = "INSERT INTO cart (email, menu_id) VALUES (?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("si", $email, $menu_id);
            $insert_stmt->execute();
            $success_message = "Item added to your cart!";
        }
    }

    // Set a flag to display success message and avoid infinite reload
    $_SESSION['added_to_cart'] = true;
    // Refresh the page after handling the action
    echo "<script>window.location.href = window.location.href;</script>";
    exit;
}

// Display the success message if set, and clear the session flag
if (isset($_SESSION['added_to_cart'])) {
    $success_message = "Item added to your cart!";
    unset($_SESSION['added_to_cart']);
}
?>

<script>
    // JavaScript to handle displaying the success message after page reload
    document.addEventListener("DOMContentLoaded", function() {
        const successMessage = "<?= $success_message ?>";
        if (successMessage !== "") {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('success-message');
            messageDiv.innerText = successMessage;

            // Insert the message before the first article element
            const menuItems = document.querySelector('.menu-each-cat');
            if (menuItems) {
                menuItems.insertAdjacentElement('beforebegin', messageDiv);
            }

            // Remove the message after 3 seconds
            setTimeout(() => {
                messageDiv.remove();
            }, 3000);
        }
    });
</script>

<style>
    .menu-con {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        height: 88vh;
    }

    .menu-area h1 {
        text-align: center;
        padding: 20px 0;
        margin: 0;
        font-size: 2.5rem;
    }

    
    .back-button {
        color: #fff;
        background-color: #ff6600;
        padding: 10px 10px;
        border-radius: 8px;
        font-size: 1.2rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .back-button i {
        margin-right: 8px;
    }

    .back-button:hover {
        background-color: #e65c00;
        transform: translateX(-5px);
    }

    .back-button:active {
        background-color: #cc5200;
        transform: translateX(0);
    }

    .category-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
    }

    .category-buttons .btn {
        background-color: #ff6600;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        cursor: pointer;
        font-size: 1rem;
    }

    .category-buttons .btn:disabled {
        background-color: #e65c00;
        cursor: not-allowed;
    }

    .menu-each-cat {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        padding: 20px;
        width: 100%;
    }

    .menu-item {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        width: 100%;
    }

    .menu-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    }

    .menu-item img {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .menu-item-details {
        padding: 20px;
        color: #333;
    }

    .menu-item-details h3 {
        font-size: 1.6rem;
        margin-bottom: 10px;
        color: #ff6600;
    }

    .menu-item-details p {
        margin-bottom: 10px;
        font-size: 1rem;
        color: #555;
    }

    .menu-item-details p strong {
        font-weight: bold;
    }

    .add-to-cart-form {
        display: flex;
        justify-content: start;
        margin-top: 10px;
        padding: 10px;
    }

    .add-to-cart-form button {
        background-color: #ff6600;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.3s;
    }

    .add-to-cart-form button:hover {
        background-color: #e65c00;
    }

    .no-items {
        text-align: center;
        color: #ff6600;
        font-size: 1.2rem;
    }


    .success-message {
        margin-top: 10px;
        background-color: #e7f9e7;
        color: #28a745;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        font-size: 1.2rem;
    }
</style>

<div class="menu-area">
    <main class="menu-con">
        <?php if (empty($category)): ?>
            <h1>All Categories</h1>
            <div class="category-buttons">
                <?php foreach ($categories as $cat): ?>
                    <button class="btn" 
                            onclick="location.href='index.php?page=menu&category=<?= $cat ?>'" 
                            <?= $cat === $category ? 'disabled' : '' ?>>
                        <?= ucfirst($cat) ?>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php else: ?>

            <h1>
                <a href="index.php?page=menu" class="back-button">
                    <i class="bi bi-arrow-return-left"></i>
                </a>
                <?= ucfirst($category) ?> Menu
            </h1>

            <div class="menu-each-cat">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <article class="menu-item">
                            <?php if (!empty($row['image'])): ?>
                                <figure class="menu-item-image">
                                    <img src="<?= $row['image'] ?>" alt="<?= htmlspecialchars($row['menu_name']) ?>">
                                </figure>
                            <?php endif; ?>
                            <div class="menu-item-details">
                                <h3><?= htmlspecialchars($row['menu_name']) ?></h3>
                                <p><?= nl2br(htmlspecialchars($row['description'])) ?></p>
                                <p><strong>Price:</strong> ₱<?= htmlspecialchars($row['price']) ?></p>
                            </div>
                            <form class="add-to-cart-form" method="POST">
                                <input type="hidden" name="menu_id" value="<?= $row['id'] ?>">
                                <button type="submit">Add to Cart</button>
                            </form>
                        </article>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="no-items">No items found for <?= htmlspecialchars($category) ?>.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </main>
</div>

<?php
$conn->close();
?>