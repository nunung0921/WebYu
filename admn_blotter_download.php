<?php

require_once("classes/conn.php");

try {
    // Get the blot_photo identifier from GET
    if (isset($_GET["blot_photo"])) {
        $blot_photo = $_GET["blot_photo"];
    } else {
        echo "Wrong input";
        exit;
    }

    // Prepare PDO SQL
    $connection = new PDO("mysql:host=localhost;dbname=u813203284_bmis","u813203284_webyu","Webyu@2023");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL statement
    $stmt = $connection->prepare("SELECT * FROM `tbl_blotter` WHERE `blot_photo`=:blot_photo");
    $stmt->bindParam(":blot_photo", $blot_photo);

    // Execute the query
    $stmt->execute();

    // Check if something is found
    if ($stmt->rowCount() == 1) {
        // Fetch the record
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Get the image blob data
        $image = $row['blot_photo'];

        // Send the appropriate headers
        header("Content-type: image/jpeg");
        header('Content-Disposition: attachment; filename="downloaded_image.jpg"');
        header("Content-Transfer-Encoding: binary");
        header('Expires: 0');
        header('Pragma: no-cache');
        header("Content-Length: " . strlen($image));

        // Output the image data
        echo $image;
    } else {
        echo "No image found";
    }
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}

// Ensure no further output
exit();
?>
