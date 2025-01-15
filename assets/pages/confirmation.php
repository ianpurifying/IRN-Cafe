<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$message = isset($_SESSION['message']) ? $_SESSION['message'] : "Purchase something";
unset($_SESSION['message']);
?>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(to bottom, #ffefba, #ffffff);
        height: 100vh;
        color: #333;
    }

    .con-area {
        height: 88vh;
        display: grid;
        place-items: center;
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
    .con:a {
        display: inline-block;
        text-decoration: none;
        color: #ffffff;
        background: #007BFF;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        transition: background 0.3s ease;
    }
    con:a:hover {
        background: #0056b3;
    }
</style>
<div class="con-area">
    <div class="con">
        <h1><?php echo htmlspecialchars($message); ?></h1>
        <a href="index.php?#menu">Continue Shopping</a>
    </div>
</div>