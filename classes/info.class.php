<?php 

require_once('main.class.php');

class InfoClass extends BMISClass {

    public function create_brgy_info() {
        if(isset($_POST['add_brgy_info'])) {
            $brgy = $_POST['brgy'];
            $municipal = ($_POST['municipal']);
            $province = $_POST['province'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
            $openhours = $_POST['openhours'];
            $background = $_POST['background'];
            $vision = $_POST['vision'];
            $mission = $_POST['mission'];

            $connection = $this->openConn();
            $stmt = $connection->prepare("INSERT INTO brgy_info (`brgy`,`municipal`,`province`,`email`, `contact`,`openhours`,`background`, `vision`,`mission`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->Execute([$brgy, $municipal, $province, $email, $contact, $openhours, $background, $vision, $mission]);
            $message2 = "New Barangay Information Added";

            echo "<script type='text/javascript'>alert('$message2');</script>";
            header('refresh:0');
        }
    }

    public function view_brgy_info() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from brgy_info");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function get_brgy_info() {
        $id_brgy_info = $_GET['id_brgy_info'];
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM brgy_info where id_brgy_info = 1");
        $stmt->execute();
        $view = $stmt->fetch(); 
        $total = $stmt->rowCount();
        if($total > 0 )  {
            return $view;
        } else {
            return false;
        }
    }

public function update_brgy_info() {
    if (isset($_POST['update_brgy_info'])) {
        try {
            $id_brgy_info = $_POST['id_brgy_info'];
            $brgy = $_POST['brgy'];
            $municipal = $_POST['municipal'];
            $province = $_POST['province'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
            $openhours = $_POST['openhours'];
            $background = $_POST['background'];
            $vision = $_POST['vision'];
            $mission = $_POST['mission'];

            // Update service in the database
            $connection = $this->openConn();
            $stmt = $connection->prepare("UPDATE brgy_info SET brgy = ?, municipal = ?, province = ?, email = ?, contact = ?, openhours = ?, background = ?, vision = ?, mission = ? WHERE id_brgy_info = ?");
            $stmt->execute([$brgy, $municipal, $province, $email, $contact, $openhours, $background, $vision, $mission, $id_brgy_info]);
        
            $message = "Barangay information updated";
            echo "<script type='text/javascript'>alert('$message');</script>";
            header('refresh:0'); // This refreshes the page, consider using AJAX for a smoother update experience
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
        }
    }
}




    public function delete_brgy_info() {
        $id_brgy_info = $_POST['id_brgy_info'];

        if(isset($_POST['delete_services'])) {
            $connection = $this->openConn();
            $stmt = $connection->prepare("DELETE FROM brgy_info where id_brgy_info = ?");
            $stmt->execute([$id_brgy_info]);
            
            $message2 = "Barangay Information Deleted";
            
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header('refresh:0');
        }
    }


    public function search_brgy_info() {
        $search = $_POST['search'];

        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from brgy_info WHERE `background` = '$search'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function create_activity() {
        if(isset($_POST['add_activity'])) {
            $name = $_POST['name'];
            $date = ($_POST['date']);

            if (!empty($_FILES["image"]["name"])) {
            $target_dir = "uploads/";
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
            $stmt = $connection->prepare("INSERT INTO tbl_activities (`name`,`date`,`image`) VALUES (?, ?, ?)");


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
        $stmt = $connection->prepare("SELECT * from tbl_activities");
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
            $target_dir = 'uploads/'; // Directory where uploaded images will be stored
            
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
        $stmt = $connection->prepare("UPDATE tbl_activities SET name = ?, date = ?, image = ? WHERE id_activity = ?");
        $stmt->execute([$name, $date, $image, $id_activity]);
        
        $message = "Activity Updated";
        echo "<script type='text/javascript'>alert('$message');</script>";
        header('refresh:0');
    }
}


    public function delete_activity() {
        $id_activity = $_POST['id_activity'];
        if(isset($_POST['delete_activity'])) {
            
            $connection = $this->openConn();
            $stmt = $connection->prepare("DELETE FROM tbl_activities WHERE id_activity = ?");
            $stmt->execute([$id_activity]);
            
            $message2 = "Barangay Activity Deleted";
            
            echo "<script type='text/javascript'>alert('$message2');</script>";
        }
    }


    public function get_single_activity($id_activity){

        $id_activity = $_GET['id_activity'];
        
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_activities where id_activity = ?");
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
