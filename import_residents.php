<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

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

if (isset($_POST['import'])) {
    $fileName = $_FILES['file']['tmp_name'];
    $fileType = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    if ($_FILES['file']['size'] > 0) {
        if ($fileType == 'csv') {
            // Handle CSV file
            $file = fopen($fileName, "r");

            // Skip the first line (header)
            fgetcsv($file);

            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                $password = generateRandomPassword();
                $hashedPassword = md5($password); // Hash the password

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
                    'family_role' => 'member', // Default or retrieved value
                    'role' => 'resident', // Default or retrieved value
                    'request_status' => 'approved' // Default or retrieved value
                ];

                $residentbmis->create_resident($data);
            }

            fclose($file);
        } else if (in_array($fileType, ['xls', 'xlsx'])) {
            // Handle Excel file
            $spreadsheet = IOFactory::load($fileName);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            // Skip the first row (header)
            array_shift($rows);

            foreach ($rows as $row) {
                $password = generateRandomPassword();
                $hashedPassword = md5($password); // Hash the password

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
                    'family_role' => 'member', // Default or retrieved value
                    'role' => 'resident', // Default or retrieved value
                    'request_status' => 'approved' // Default or retrieved value
                ];

                $residentbmis->create_resident($data);
            }
        } else {
            echo "<script>alert('Invalid file format'); window.location.href = 'admn_resident_crud.php';</script>";
            exit;
        }

        echo "<script>alert('Residents imported successfully'); window.location.href = 'admn_resident_crud.php';</script>";
    } else {
        echo "<script>alert('Invalid file size or format'); window.location.href = 'admn_resident_crud.php';</script>";
    }
}
?>
