<?php
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize inputs
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['contact_error'] = "Invalid email format";
        header("Location: contact us.php#contactForm");
        exit;
    }
    
    // Validate phone (basic validation)
    if (empty($phone)) {
        $_SESSION['contact_error'] = "Phone number is required";
        header("Location: contact us.php#contactForm");
        exit;
    }
    
    // Prepare email content
    $to = "karanattri022@gmail.com";
    $subject = "New Contact Form Submission from Web-Nexus";
    
    // Create HTML content for better formatting
    $email_content = "<html><body>";
    $email_content .= "<h2>New Contact Form Submission</h2>";
    $email_content .= "<p><strong>From:</strong> $email</p>";
    $email_content .= "<p><strong>Phone:</strong> $phone</p>";
    $email_content .= "<p><strong>Message:</strong><br>" . nl2br($message) . "</p>";
    $email_content .= "<p>This message was sent from the Web-Nexus contact form.</p>";
    $email_content .= "</body></html>";
    
    // Set additional headers for HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: $email" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";
    
    // Send email
    if (mail($to, $subject, $email_content, $headers)) {
        // Success
        $_SESSION['contact_success'] = "Thank you for contacting us! We'll get back to you soon.";
    } else {
        // Failure
        $_SESSION['contact_error'] = "Sorry, there was an error sending your message. Please try again later.";
        
        // Log the error for debugging (optional)
        error_log("Failed to send email from contact form. From: $email, To: $to");
    }
    
    // Redirect back to the contact page
    header("Location: contact us.php#contactForm");
    exit;
} else {
    // If someone tries to access this file directly
    header("Location: contact us.php");
    exit;
}