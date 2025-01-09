<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$message = isset($_SESSION['message']) ? $_SESSION['message'] : "Purchase something";
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1><?php echo htmlspecialchars($message); ?></h1>
    <a href="index.php?#menu">Continue Shopping</a>
</body>
</html>
