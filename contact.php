<?php
// contact.php - Basic contact form handler
// IMPORTANT: For production, validate and sanitize inputs properly.

// Recipient email
$to = 'jipo2410@gmail.com';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    if (!$name || !$email || !$message) {
        http_response_code(400);
        echo 'Please complete the form and try again.';
        exit;
    }

    $subject = "New message from Ayaanle Show website: " . $name;
    $body = "Name: $name\n";
    $body .= "Email: $email\n\n";
    $body .= "Message:\n$message\n";

    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send email (requires server mail configured)
    if (mail($to, $subject, $body, $headers)) {
        echo 'Thank you — your message has been sent.';
    } else {
        http_response_code(500);
        echo 'Sorry — there was an error sending your message. Please try again later.';
    }
} else {
    http_response_code(405);
    echo 'Method not allowed';
}
?>
