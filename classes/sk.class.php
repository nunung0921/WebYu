<?php 

require_once('main.class.php');

class SkClass extends BMISClass {

    public function create_activity() {
        if(isset($_POST['add_activity'])) {
            $name = $_POST['name'];
            $date = ($_POST['date']);

            if (!empty($_FILES["image"]["name"])) {
            $target_dir = "icons/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if file is an actual image
            $check = @getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $message2 = "File is not an image.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["image"]["size"] > 500000) {
                $message2 = "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow only certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $message2 = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 1) {
                // Try to move the uploaded file
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $message2 = "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
                } else {
                    $message2 = "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            $message2 = "No file uploaded.";
            $uploadOk = 0;
        }
        if($uploadOk == 1) {
            $image = $target_file;
            $connection = $this->openConn();
            $stmt = $connection->prepare("INSERT INTO tbl_act_sk (`name`,`date`,`image`) VALUES (?, ?, ?)");


            $stmt->Execute([$name, $date, $image]);
            $message2 = "New Activity Added";

            if ($stmt->rowCount() > 0) {
                $message2 = "New Service Added";
            } else {
                $message2 = "Failed to add service";
            }
        }

            echo "<script type='text/javascript'>alert('$message2');</script>";
            header('refresh:0');
        }
    }

    public function view_activity() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_act_sk");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function update_activity() {
    if (isset($_POST['update_activity'])) {
        $id_activity = $_GET['id_activity'];
        $name = $_POST['name'];
        $date = $_POST['date'];
        
        // Handle image upload
        $image = ''; // Default empty filename
        
        // Check if a file was uploaded and there are no errors
        if ($_FILES['image']['error'] == UPLOAD_ERR_OK && !empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name']; // Get the filename
            
            // Move the uploaded file to a permanent location
            $target_dir = 'icons/'; // Directory where uploaded images will be stored
            
            // Ensure the directory exists
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0755, true);
            }
            
            // Check file size
            if ($_FILES['image']['size'] > 500000) {
                echo "Error: File size too large.";
                return;
            }
            
            // Check file type
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (!in_array($file_extension, $allowed_extensions)) {
                echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
                return;
            }
            
            // Move the uploaded file to the desired location
            $target_file = $target_dir . basename($_FILES['image']['name']);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                // File upload successful
                $image = $target_file;
            } else {
                // Error moving uploaded file
                echo "Error moving uploaded file.";
                return;
            }
        } else {
            // No file uploaded or error occurred
            $image = $_POST['image'];
            return;
        }

        // Update service in the database
        $connection = $this->openConn();
        $stmt = $connection->prepare("UPDATE tbl_act_sk SET name = ?, date = ?, image = ? WHERE id_activity = ?");
        $stmt->execute([$name, $date, $image, $id_activity]);
        
        $message = "Activity Updated";
        echo "<script type='text/javascript'>alert('$message');</script>";
        header('Location: activities.php');
        exit;
    }
}


    public function delete_activity() {
        $id_activity = $_POST['id_activity'];
        if(isset($_POST['delete_activity'])) {
            
            $connection = $this->openConn();
            $stmt = $connection->prepare("DELETE FROM tbl_act_sk WHERE id_activity = ?");
            $stmt->execute([$id_activity]);
            
            $message2 = "Barangay Activity Deleted";
            
            echo "<script type='text/javascript'>alert('$message2');</script>";
        }
    }


    public function get_single_activity($id_activity){

        $id_activity = $_GET['id_activity'];
        
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_act_sk where id_activity = ?");
        $stmt->execute([$id_activity]);
        $activity = $stmt->fetch();
        $total = $stmt->rowCount();

        if($total > 0 )  {
            return $activity;
        }
        else{
            return false;
        }
    }

}

$infobmis = new InfoClass();

?>
