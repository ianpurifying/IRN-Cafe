<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session only if not already started
}

require 'config.php'; // Database connection

if ($_SESSION['user']['username'] === 'admin' && $_SESSION['user']['email'] === 'admin@irncafe.com') {
    echo "<script>window.location.href = 'admin/';</script>";
    exit;
}

// Check if the user is logged in
if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];

    // Prepare SQL query to fetch user details by user id
    $stmt = $conn->prepare("SELECT first_name, last_name, username, email, created_at FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId); // Bind the user id parameter
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();
    } else {
        $errorMessage = "User not found.";
    }
} else {
    // If user is not logged in, redirect to login page
    echo "<script>window.location.href = 'index.php?page=login';</script>";
    exit;
}
?>
<style>

    .account-area {
        height: 88vh;
    }

    .accountManage {
        max-width: 900px;
        margin: 40px auto;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .user-info p {
        font-size: 18px;
        line-height: 1.8;
        color: #555;
        margin-bottom: 10px;
    }

    .user-info strong {
        font-weight: 600;
        color: #333;
    }

    .btn-logout,
    .btn-edit {
        width: 48%;
        padding: 12px;
        margin-top: 20px;
        background-color: rgb(255, 0, 0);
        color: white;
        border: none;
        border-radius: 5px;
        text-align: center;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: inline-block;
    }

    .btn-logout:hover {
        background-color: rgb(93, 16, 16);
    }

    .btn-edit {
        background-color: rgb(0, 123, 255);
    }

    .btn-edit:hover {
        background-color: rgb(0, 86, 179);
    }

    .alert {
        margin-top: 20px;
        padding: 15px;
        background-color: #f8d7da;
        color: #721c24;
        border-radius: 5px;
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
        padding-top: 60px;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .btn-save {
        background-color: rgb(0, 123, 255);
        color: white;
        padding: 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
    }

    .btn-save:hover {
        background-color: rgb(0, 86, 179);
    }
</style>
<div class="account-area">
    <div class="accountManage">
        <?php if (isset($user)): ?>
            <div class="header">
                <h2>Welcome, <?php echo htmlspecialchars($user['first_name']) . " " . htmlspecialchars($user['last_name']); ?>!</h2>
            </div>
            <div class="user-info">
                <p><strong>First Name:</strong> <?php echo htmlspecialchars($user['first_name']); ?></p>
                <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user['last_name']); ?></p>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Account Created:</strong> <?php echo date("F j, Y", strtotime($user['created_at'])); ?></p>
            </div>

            <!-- Edit Profile Button -->
            <button class="btn-edit" id="editProfileBtn">Edit Profile</button>
            <a href="./logout.php" class="btn-logout">Logout</a>
        <?php else: ?>
            <div class="alert" role="alert">
                <?php echo isset($errorMessage) ? $errorMessage : 'Something went wrong!'; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Modal for Editing Profile -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Edit Profile</h2>
            <form action="assets/handlers/edit_profile.php" method="POST">
                <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" placeholder="First Name" required>
                <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" placeholder="Last Name" required>
                <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" placeholder="Username" required>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" placeholder="Email" required>
                <input type="password" name="password" placeholder="New Password (Leave empty to keep current)">
                <button type="submit" class="btn-save">Save Changes</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Get modal and buttons
    var modal = document.getElementById("editModal");
    var editProfileBtn = document.getElementById("editProfileBtn");
    var closeModal = document.getElementById("closeModal");

    // When the user clicks on the button, open the modal
    editProfileBtn.onclick = function () {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    closeModal.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
