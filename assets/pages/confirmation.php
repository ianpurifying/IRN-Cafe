<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$message = isset($_SESSION['message']) ? $_SESSION['message'] : "Purchase something";
unset($_SESSION['message']);
?>
<style>
    /* Centering the .con-area using Flexbox */
    .con-area {
        display: flex;
        justify-content: center; /* Centers horizontally */
        align-items: center;     /* Centers vertically */
        height: 80vh;           /* Full viewport height */
    }

    .con {
        text-align: center;
        background: #ffffff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 20px 40px;
        max-width: 500px;
        width: 100%;
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #444;
    }

    .con a {
        display: inline-block;
        text-decoration: none;
        color: #ffffff;
        background: #007BFF;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        transition: background 0.3s ease;
    }

    .con a:hover {
        background: #0056b3;
    }
</style>

<div class="con-area">
    <div class="con">
        <h1><?php echo htmlspecialchars($message); ?></h1>
        <a href="index.php">Continue Shopping</a>
    </div>
</div>
