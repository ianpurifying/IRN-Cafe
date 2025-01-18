<?php
// Include PHPMailer
require './modules/php_emailer/vendor/autoload.php';  

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$response = ""; // Response message to display

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    // Set the recipient email address (your Gmail address)
    $to = "sacredmind2002@gmail.com";  
    
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Use Gmail's SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'sacredmind2002@gmail.com';
        $mail->Password = 'gqfy uugq yvie nzxi'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($email, $name);  // Sender's email address
        $mail->addAddress($to);  // Recipient's email address

        // Content
        $mail->isHTML(false);  // Set email format to plain text
        $mail->Subject = 'New Message from IRN Cafe';
        $mail->Body = "
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f5f5f5;
                    color: #444;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    max-width: 600px;
                    margin: 40px auto;
                    padding: 20px;
                    background: #ffffff;
                    border-radius: 8px;
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
                    border: 1px solid #eaeaea;
                }
                .header {
                    background-color: #6a4a0a;
                    color: #ffffff;
                    padding: 15px;
                    text-align: center;
                    border-radius: 8px 8px 0 0;
                    font-size: 24px;
                    font-weight: bold;
                }
                .content {
                    font-size: 16px;
                    line-height: 1.6;
                    padding: 20px;
                }
                .content p {
                    margin: 0 0 10px;
                }
                .footer {
                    text-align: center;
                    font-size: 12px;
                    color: #999;
                    margin-top: 20px;
                    padding-top: 10px;
                    border-top: 1px solid #eaeaea;
                }
                .footer a {
                    color: #6a4a0a;
                    text-decoration: none;
                    font-weight: bold;
                }
                .footer a:hover {
                    text-decoration: underline;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>New Message from IRN Cafe</div>
                <div class='content'>
                    <p><strong>Name:</strong> $name</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Message:</strong></p>
                    <p>$message</p>
                </div>
                <div class='footer'>
                    IRN Cafe | © " . date('Y') . " | <a href='https://web.facebook.com/ianpurifying'>Visit Our Website</a>
                </div>
            </div>
        </body>
        </html>";
    $mail->AltBody = "New Contact Form Message\n\nName: $name\nEmail: $email\nMessage:\n$message";

    // Send the email
    $mail->send();
    $response = "success";
} catch (Exception $e) {
    error_log("Email could not be sent. Error: {$mail->ErrorInfo}");
    $response = "error";
}
}
?>
<style>
  .contact-area {
    height: 88vh; 
  }
  .contact-con {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    height: 60vh;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  h1 {
    text-align: center;
    color: #333;
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

  .contact-con button {
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
<div class="contact-area">
  <div class="contact-con">
    <h1>Contact Us</h1>
    <form method="post" id="contactForm">
      <input type="text" id="name" name="name" placeholder="Your Name" required>
      <input type="email" id="email" name="email" placeholder="Your Email" required>
      <textarea id="message" name="message" rows="5" placeholder="Your Message" required></textarea>

      <button type="submit">Send Message</button>
    </form>

    <!-- Success or Error Message -->
    <div id="messageBox" class="message"></div>
  </div>
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

