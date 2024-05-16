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
ini_set('display_errors', 1);
error_reporting(E_ALL); 

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
    // Send email with basic PHP mail function
    $to = $email;
    $subject = 'Welcome to Our Service';
    $message = "Dear user,\n\nYour account has been created. Here are your login details:\n\nEmail: $email\nPassword: $password\n\nPlease change your password after logging in for the first time.\n\nBest regards,\nYour Company";
    $headers = 'From: rafaeltosper@gmail.com' . "\r\n" .
               'Reply-To: rafaeltosper@gmail.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    if (mail($to, $subject, $message, $headers)) {
        echo "Message has been sent to $email<br>";
    } else {
        echo "Message could not be sent to $email<br>";
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
                    'lname' => $column[0],
                    'fname' => $column[1],
                    'mi' => $column[2],
                    'contact' => $column[3],
                    'email' => $column[4],
                    'password' => $hashedPassword,
                    'houseno' => $column[5],
                    'street' => $column[6],
                    'brgy' => $column[7],
                    'municipal' => $column[8],
                    'bdate' => $column[9],
                    'bplace' => $column[10],
                    'nationality' => $column[11],
                    'status' => $column[12],
                    'age' => $column[13],
                    'sex' => $column[14],
                    'voter' => $column[15],
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
                    'lname' => $column[0],
                    'fname' => $column[1],
                    'mi' => $column[2],
                    'contact' => $column[3],
                    'email' => $column[4],
                    'password' => $hashedPassword,
                    'houseno' => $column[5],
                    'street' => $column[6],
                    'brgy' => $column[7],
                    'municipal' => $column[8],
                    'bdate' => $column[9],
                    'bplace' => $column[10],
                    'nationality' => $column[11],
                    'status' => $column[12],
                    'age' => $column[13],
                    'sex' => $column[14],
                    'voter' => $column[15],
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
