<?php
// Include PHPMailer
require 'vendor/autoload.php';  

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$response = ""; // Response message to display

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    // Set the recipient email address (your Gmail address)
    $to = "sacredmind2002@gmail.com";  // Change this to your Gmail address
    
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Use Gmail's SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'sacredmind2002@gmail.com';  // Your Gmail address
        $mail->Password = 'gqfy uugq yvie nzxi';  // Your Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($email, $name);  // Sender's email address
        $mail->addAddress($to);  // Recipient's email address

        // Content
        $mail->isHTML(false);  // Set email format to plain text
        $mail->Subject = 'New Message from Contact Form';
        $mail->Body    = "You have received a new message from the contact form on your website.\n\n" .
                         "Name: $name\n" .
                         "Email: $email\n" .
                         "Message:\n$message\n";

        // Send the email
        $mail->send();
        $response = "success"; // Mark as success
    } catch (Exception $e) {
        $response = "error"; // Mark as error
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      margin: 0;
      padding: 0;
    }

    .contact-container {
      max-width: 600px;
      margin: 50px auto;
      padding: 20px;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #333;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }

    input[type="text"], input[type="email"], textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
    }

    textarea {
      resize: vertical;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      font-size: 18px;
      cursor: pointer;
    }

    button:hover {
      background-color: #45a049;
    }

    .message {
      text-align: center;
      margin-top: 20px;
      padding: 10px;
      font-size: 16px;
      border-radius: 5px;
      display: none; /* Hidden by default */
    }

    .message.success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }

    .message.error {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
  </style>
</head>
<body>

  <div class="contact-container">
    <h1>Contact Us</h1>
    <form method="post" id="contactForm">
      <label for="name">Your Name</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Your Email</label>
      <input type="email" id="email" name="email" required>

      <label for="message">Your Message</label>
      <textarea id="message" name="message" rows="5" required></textarea>

      <button type="submit">Send Message</button>
    </form>

    <!-- Success or Error Message -->
    <div id="messageBox" class="message"></div>
  </div>

  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("contactForm");
    const messageBox = document.getElementById("messageBox");

    <?php if ($response == "success") { ?>
      messageBox.textContent = "Thank you for contacting us! Your message has been sent successfully. We will get back to you soon.";
      messageBox.className = "message success";
      messageBox.style.display = "block";
      form.reset();
    <?php } elseif ($response == "error") { ?>
      messageBox.textContent = "Oops! Something went wrong while sending your message. Please try again later.";
      messageBox.className = "message error";
      messageBox.style.display = "block";
    <?php } ?>

    // Hide the message after 5 seconds
    setTimeout(() => {
      messageBox.style.display = "none";
    }, 5000);
  });
</script>


</body>
</html>
