<?php 

require_once('main.class.php');

class ServicesClass extends BMISClass {

public function create_service() {
    if(isset($_POST['add_service'])) {
        // Retrieve form data
        $title = $_POST['title'];
        $description = $_POST['description'];
        $fees = $_POST['fees'];
        $requires = $_POST['requires'];

        // Handle image upload
        if (!empty($_FILES["image_service"]["name"])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["image_service"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if file is an actual image
            $check = @getimagesize($_FILES["image_service"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $message2 = "File is not an image.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["image_service"]["size"] > 500000) {
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
                if (move_uploaded_file($_FILES["image_service"]["tmp_name"], $target_file)) {
                    $message2 = "The file " . htmlspecialchars(basename($_FILES["image_service"]["name"])) . " has been uploaded.";
                } else {
                    $message2 = "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            $message2 = "No file uploaded.";
            $uploadOk = 0;
        }

        // Insert service into the database
        if($uploadOk == 1) {
            $image_service = $target_file;
            $connection = $this->openConn();
            $stmt = $connection->prepare("INSERT INTO tbl_services (`title`, `description`, `fees`, `requires`, `image_service`) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $description, $fees, $requires, $image_service]);

            // Check if the insertion was successful
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


    public function view_service() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_services");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function view_single_service() {
        $id_services = $_GET['id_services'];
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_services where id_services = '$id_services'");
        $stmt->execute();
        $view = $stmt->fetch(); 
        $total = $stmt->rowCount();
        if($total > 0 )  {
            return $view;
        } else {
            return false;
        }
    }

public function update_service() {
    if (isset($_POST['update_service'])) {
        $id_services = $_GET['id_services'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $fees = $_POST['fees'];
        $requires = $_POST['requires'];
        
        // Handle image upload
        $image_filename = ''; // Default empty filename
        
        // Check if a file was uploaded and there are no errors
        if ($_FILES['image_service']['error'] == UPLOAD_ERR_OK && !empty($_FILES['image_service']['name'])) {
            $image_filename = $_FILES['image_service']['name']; // Get the filename
            
            // Move the uploaded file to a permanent location
            $target_dir = 'uploads/'; // Directory where uploaded images will be stored
            
            // Ensure the directory exists
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0755, true);
            }
            
            // Check file size
            if ($_FILES['image_service']['size'] > 500000) {
                echo "Error: File size too large.";
                return;
            }
            
            // Check file type
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            $file_extension = strtolower(pathinfo($_FILES['image_service']['name'], PATHINFO_EXTENSION));
            if (!in_array($file_extension, $allowed_extensions)) {
                echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
                return;
            }
            
            // Move the uploaded file to the desired location
            $target_file = $target_dir . basename($_FILES['image_service']['name']);
            if (move_uploaded_file($_FILES['image_service']['tmp_name'], $target_file)) {
                // File upload successful
                $image_filename = $target_file;
            } else {
                // Error moving uploaded file
                $image_filename = $_POST['image_service'];
                return;
            }
        } else {
            // No file uploaded or error occurred
            echo "Error: No file uploaded or file upload error.";
            return;
        }

        // Update service in the database
        $connection = $this->openConn();
        $stmt = $connection->prepare("UPDATE tbl_services SET title = ?, description = ?, fees = ?, requires = ?, image_service = ? WHERE id_services = ?");
        $stmt->execute([$title, $description, $fees, $requires, $image_filename, $id_services]);
        
        $message = "Service Updated";
        echo "<script type='text/javascript'>alert('$message');</script>";
        header('refresh:0');
    }
}



    public function delete_service() {
        $id_services = $_POST['id_services'];

        if(isset($_POST['delete_services'])) {
            $connection = $this->openConn();
            $stmt = $connection->prepare("DELETE FROM tbl_services where id_services = ?");
            $stmt->execute([$id_services]);
            
            $message2 = "Service Deleted";
            
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header('refresh:0');
        }
    }

    public function get_single_service($id_services) {
        $id_services = $_GET['id_services'];
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_services where id_services = ?");
        $stmt->execute([$id_services]);
        $user = $stmt->fetch();
        $total = $stmt->rowCount();

        if($total > 0 )  {
            return $user;
        } else {
            return false;
        }
    }

    public function count_services() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_services");
        $stmt->execute();
        $servicescount = $stmt->fetchColumn();
        return $servicescount;
    }

    public function search_services() {
        $search = $_POST['search'];

        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_services WHERE `title` = '$search'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }
}

$servicesbmis = new ServicesClass();

?>
