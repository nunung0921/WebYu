<?php
session_start();
include 'classes/conn.php';

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'] ?? '';

if (empty($email)) {
    echo json_encode(['success' => false, 'message' => 'Email is required.']);
    exit;
}

if (isset($data['email'])) {
    $email = $data['email'];
    $otp = rand(100000, 999999); // Generate a 6-digit OTP
    $_SESSION['otp'] = $otp;

    // Send OTP to email
    // You can use mail() function or a library like PHPMailer to send the OTP
    $subject = "Your OTP Code";
    $message = "Your OTP code is $otp";
    $headers = "From: rafaeltosper@gmail.com";

    if (mail($email, $subject, $message, $headers)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
