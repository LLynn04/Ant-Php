<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Make sure this points to your correct path

$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host       = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth   = true;
    $mail->Port       = 2525;
    $mail->Username   = 'e408205160dae0'; // Your Mailtrap username
    $mail->Password   = '4cbfe42e2bb3f6'; // Your Mailtrap password

    // Sender and recipient
    $mail->setFrom('noreply@example.com', 'MyApp');
    $mail->addAddress('test@demo.com', 'Test User'); // Fake email, just for Mailtrap

    // Email content
    $mail->isHTML(true);
    $mail->Subject = '✅ Mailtrap Test';
    $mail->Body    = '<h3>Hello!</h3><p>This is a test email sent using <strong>PHPMailer</strong> and <em>Mailtrap</em>.</p>';
    $mail->AltBody = 'Hello! This is a plain text version of the Mailtrap test email.';

    $mail->send();
    echo "✅ Test email sent successfully!";
} catch (Exception $e) {
    echo "❌ Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
