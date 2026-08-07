```php
<?php

// --------------------------------------------------
// CONTACT FORM EMAIL SETTINGS
// --------------------------------------------------

$to = "nstco29@gmail.com";

// Only accept POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Method Not Allowed");
}


// --------------------------------------------------
// GET FORM DATA
// --------------------------------------------------

$name = trim($_POST["name"] ?? "");
$company = trim($_POST["company"] ?? "");
$email = trim($_POST["email"] ?? "");
$phone = trim($_POST["phone"] ?? "");
$message = trim($_POST["message"] ?? "");


// --------------------------------------------------
// VALIDATION
// --------------------------------------------------

if (
    empty($name) ||
    empty($company) ||
    empty($email) ||
    empty($phone) ||
    empty($message)
) {
    http_response_code(400);
    exit("Please complete all required fields.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    exit("Invalid email address.");
}


// --------------------------------------------------
// PROTECT EMAIL HEADERS
// --------------------------------------------------

$name = str_replace(["\r", "\n"], "", $name);
$company = str_replace(["\r", "\n"], "", $company);
$email = str_replace(["\r", "\n"], "", $email);
$phone = str_replace(["\r", "\n"], "", $phone);


// --------------------------------------------------
// EMAIL SUBJECT
// --------------------------------------------------

$subject = "New Website Contact Form Submission";


// --------------------------------------------------
// EMAIL BODY
// --------------------------------------------------

$emailBody = "You have received a new message from your website contact form.\n\n";

$emailBody .= "----------------------------------------\n";
$emailBody .= "CONTACT INFORMATION\n";
$emailBody .= "----------------------------------------\n\n";

$emailBody .= "Full Name: " . $name . "\n";
$emailBody .= "Company: " . $company . "\n";
$emailBody .= "Email: " . $email . "\n";
$emailBody .= "Phone: " . $phone . "\n\n";

$emailBody .= "----------------------------------------\n";
$emailBody .= "MESSAGE\n";
$emailBody .= "----------------------------------------\n\n";

$emailBody .= $message . "\n\n";

$emailBody .= "----------------------------------------\n";
$emailBody .= "This message was submitted through your website.\n";


// --------------------------------------------------
// EMAIL HEADERS
// --------------------------------------------------

$headers = "From: Website Contact Form <noreply@" . $_SERVER["HTTP_HOST"] . ">\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";


// --------------------------------------------------
// SEND EMAIL
// --------------------------------------------------

if (mail($to, $subject, $emailBody, $headers)) {

    // Successful submission
    header("Location: thank-you.html");
    exit;

} else {

    // Email failed
    http_response_code(500);
    exit("There was a problem sending your message. Please try again later.");
}

?>
```
