<?php
session_start();

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'] ?? '';

if (empty($email)) {
    echo json_encode(['success' => false, 'message' => 'Email is required.']);
    exit;
}

$otp = rand(100000, 999999); // Generate a 6-digit OTP
$_SESSION['otp'] = $otp; // Set the OTP in session variable

// Send OTP to email
$subject = "Your OTP Code";
$message = "Your OTP code is $otp";
$headers = "From: rafaeltosper@gmail.com"; // Update with your email address

if (mail($email, $subject, $message, $headers)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error sending OTP. Please try again.']);
}
?>