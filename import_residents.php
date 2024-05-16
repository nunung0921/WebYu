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
    $to = $email;
    $subject = 'Welcome to Our Service';
    $message = "Dear user,\n\nYour account has been created. Here are your login details:\n\nEmail: $email\nPassword: $password\n\nPlease change your password after logging in for the first time.\n\nBest regards,\nWebYu";
    $headers = 'From: rafaeltosper@gmail.com' . "\r\n" .
               'Reply-To: rafaeltosper@gmail.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    // Attempt to send the email
    if (mail($to, $subject, $message, $headers)) {
        echo "Message has been sent!";
    } else {
        echo "Message could not be sent to $email<br>";
        // Log the error for debugging purposes
        error_log("Failed to send email to $email", 0);
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
                $hashedPassword = md5($password);

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
                    'municipal' => $column[10],
                    'contact' => $column[11],
                    'bdate' => $column[12],
                    'bplace' => $column[13],
                    'nationality' => $column[14],
                    'voter' => $column[15],
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
                $hashedPassword = md5($password);

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
                    'municipal' => 'Guimba',
                    'family_role' => 'Yes',
                    'role' => 'resident',
                    'request_status' => 'approved'
                ];

                if ($residentbmis->create_resident($data)) {
                    echo "Resident record created successfully for email: {$data['email']}<br>";
                    sendEmail($data['email'], $password);
                } else {
                    sendEmail($data['email'], $password);
                }
            }
        } else {
            echo "<script>alert('Invalid file format'); window.location.href = 'admn_resident_crud.php';</script>";
            exit;
        }

        echo "<script>alert('Residents imported successfully. You will receive an email shortly!');</script>";
    } else {
        echo "<script>alert('Invalid file size or format'); window.location.href = 'admn_resident_crud.php';</script>";
    }
}

?>
