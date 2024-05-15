<?php
require 'vendor/autoload.php';
require '/home/u813203284/domains/webyu.online/public_html/PHPMailer/src/PHPMailer.php';
require '/home/u813203284/domains/webyu.online/public_html/PHPMailer/src/SMTP.php';
require '/home/u813203284/domains/webyu.online/public_html/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

include('classes/staff.class.php');
include('classes/resident.class.php');

function generateRandomPassword($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function sendEmail($email, $password) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com'; // Hostinger's SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'rafaeltosper@gmail.com'; // SMTP username
        $mail->Password   = 'Tosperjr@092103'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port       = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom('rafaeltosper@gmail.com', 'WebYu');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Welcome to Our Service';
        $mail->Body    = "Dear user,<br><br>Your account has been created. Here are your login details:<br>Email: $email<br>Password: $password<br><br>Please change your password after logging in for the first time.<br><br>Best regards,<br>Your Company";

        $mail->send();
        echo "Message has been sent to $email<br>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}<br>";
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }
}

if (isset($_POST['import'])) {
    $fileName = $_FILES['file']['tmp_name'];
    $fileType = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    if ($_FILES['file']['size'] > 0) {
        echo "File uploaded successfully.<br>";
        if ($fileType == 'csv') {
            $file = fopen($fileName, "r");
            fgetcsv($file);
            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                $password = generateRandomPassword();
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $data = [
                    'email' => $column[0],
                    'lname' => $column[1],
                    'fname' => $column[2],
                    'mi' => $column[3],
                    'age' => $column[4],
                    'sex' => $column[5],
                    'status' => $column[6],
                    'houseno' => $column[7],
                    'street' => $column[8],
                    'brgy' => $column[9],
                    'contact' => $column[10],
                    'bdate' => $column[11],
                    'bplace' => $column[12],
                    'nationality' => $column[13],
                    'voter' => $column[14],
                    'password' => $hashedPassword,
                    'family_role' => 'member',
                    'role' => 'resident',
                    'request_status' => 'approved'
                ];

                if ($residentbmis->create_resident($data)) {
                    var_dump($column[0], $password); // Check the values
                    sendEmail($column[0], $password);
                    die(); // Stop further execution to see the output
                } else {
                    echo "Failed to create resident record.<br>";
                }
            }

            fclose($file);
        } else if (in_array($fileType, ['xls', 'xlsx'])) {
            $spreadsheet = IOFactory::load($fileName);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            array_shift($rows);

            foreach ($rows as $row) {
                $password = generateRandomPassword();
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $data = [
                    'email' => $row[0],
                    'lname' => $row[1],
                    'fname' => $row[2],
                    'mi' => $row[3],
                    'age' => $row[4],
                    'sex' => $row[5],
                    'status' => $row[6],
                    'houseno' => $row[7],
                    'street' => $row[8],
                    'brgy' => $row[9],
                    'contact' => $row[10],
                    'bdate' => $row[11],
                    'bplace' => $row[12],
                    'nationality' => $row[13],
                    'voter' => $row[14],
                    'password' => $hashedPassword,
                    'family_role' => 'member',
                    'role' => 'resident',
                    'request_status' => 'approved'
                ];

                if ($residentbmis->create_resident($data)) {
                    echo "Resident record created successfully for email: {$data['email']}<br>";
                    sendEmail($data['email'], $password);
                } else {
                    echo "Failed to create resident record for email: {$data['email']}<br>";
                }
            }
        } else {
            echo "<script>alert('Invalid file format'); window.location.href = 'admn_resident_crud.php';</script>";
            exit;
        }

        echo "<script>alert('Residents imported successfully. You will receive an email shortly!'); window.location.href = 'admn_resident_crud.php';</script>";
    } else {
        echo "<script>alert('Invalid file size or format'); window.location.href = 'admn_resident_crud.php';</script>";
    }
}

?>
