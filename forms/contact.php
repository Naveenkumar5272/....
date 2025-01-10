<?php
  $receiving_email_address = 'vnaveenkumar527@example.com';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    
    if (empty($name) || empty($email) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "Invalid input. Please check your details and try again.";
      exit;
    }

        $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    
    $full_message = "Name: $name\n";
    $full_message .= "Email: $email\n\n";
    $full_message .= "Message:\n$message\n";

    
    if (mail($receiving_email_address, $subject, $full_message, $headers)) {
      echo "Message sent successfully!";
    } else {
      echo "Failed to send the message. Please try again later.";
    }
  } else {
    echo "Invalid request method.";
  }

