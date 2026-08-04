<?php
if($_POST) {
    $to = "nstco29@gmail.com"; // Set your email address here
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $subject = "Contact Form Submission from " . $name;
    $body = "Name: $name\nEmail: $email\nMessage:\n$message";
    $headers = "From: $email";

    if(mail($to, $subject, $body, $headers)) {
        echo "Email successfully sent.";
    } else {
        echo "Email delivery failed.";
    }
}
?>