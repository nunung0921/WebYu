<?php  
    ini_set('display_errors', 1);
    error_reporting(E_ALL ^ E_WARNING);

    require_once('main.class.php');

    class StaffClass extends BMISClass {

        /*
        //authentication method for residents to enter
        public function residentlogin() {
        if(isset($_POST['residentlogin'])) {

            $username = $_POST['email'];
            $password = $_POST['password']; 
        
            $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT * FROM tbl_residents WHERE email = ? AND password = ?");
            $stmt->Execute([$username, $password]);
            $user = $stmt->fetch();
            $total = $stmt->rowCount();
            
                //calls the set_userdata function 
                if($total > 0) {
                    $this->set_userdata($user);
                    header('Location: resident_homepage.php');
                }
                
                else {
                    echo '<script>alert("Email or Password is Invalid")</script>';
                }
            }
        }
        */

    
    //------------------------------------- CRUD FUNCTIONS FOR STAFF -----------------------------------------------

        public function create_staff() {

            if(isset($_POST['add_staff'])) {
                $email = $_POST['email'];
                $password = ($_POST['password']);
                $lname = $_POST['lname'];
                $fname = $_POST['fname'];
                $mi = $_POST['mi'];
                $age = $_POST['age'];
                $sex = $_POST['sex'];
                $houseno = $_POST['houseno'];
                $street = $_POST['street'];
                $brgy = $_POST['brgy'];
                $municipal = $_POST['municipal'];
                $address = "$houseno, $street, $brgy, $municipal";
                $contact = $_POST['contact'];
                $position = $_POST['position'];
                $role = $_POST['role'];
                $addedby = $_POST['addedby'];

                if ($this->check_staff($email) == 0 ) {

                    $connection = $this->openConn();
                    $stmt = $connection->prepare("INSERT INTO tbl_user (`email`,`password`,`lname`,`fname`,
                    `mi`, `age`, `sex`, `address`, `contact`, `position` , `role`, `addedby`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
                    $stmt->Execute([$email, $password, $lname, $fname, $mi, $age, $sex, 
                    $address, $contact, $position, $role, $addedby]);
                    $message2 = "New Staff Adedd";
    
                    echo "<script type='text/javascript'>alert('$message2');</script>";
                    header('refresh:0');
    
                }

                else {
                    echo "<script type='text/javascript'>alert('Email Account already exists');</script>";
                }
            }
        }


        public function view_staff(){

            $connection = $this->openConn();

            $stmt = $connection->prepare("SELECT * from tbl_user");
            $stmt->execute();
            $view = $stmt->fetchAll();
            //$rows = $stmt->
            return $view;
           
        }

        public function view_single_staff(){

            $id_staff = $_GET['id_staff'];
            
            $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT * FROM tbl_user where id_user = '$id_staff'");
            $stmt->execute();
            $view = $stmt->fetch(); 
            $total = $stmt->rowCount();
 
            //eto yung condition na i ch check kung may laman si products at i re return niya kapag meron
            if($total > 0 )  {
                return $view;
            }
            else{
                return false;
            }
        }

        public function update_staff() {
            if (isset($_POST['update_staff'])) {
                $id_user = $_GET['id_user'];
                $password = ($_POST['password']);
                $lname = $_POST['lname'];
                $fname = $_POST['fname'];
                $mi = $_POST['mi'];
                $age = $_POST['age'];
                $sex = $_POST['sex'];
                $address = $_POST['address'];
                $contact = $_POST['contact'];
                $position = $_POST['position'];
                $role = $_POST['role'];
                $addedby = $_POST['addedby'];
                
                    $connection = $this->openConn();
                    $stmt = $connection->prepare("UPDATE tbl_user SET `password` =?, lname =?, 
                    fname = ?, mi =?, age =?, sex =?, `address` =?, contact =?, position =?, 
                    `role` =?, addedby =? WHERE id_user = ?");
                    $stmt->execute([ $password, $lname, $fname, $mi, $age, $sex, $address,
                    $contact, $position,$role, $addedby, $id_user]);
                   
                    $message2 = "Staff Account Updated";
    
                    echo "<script type='text/javascript'>alert('$message2');</script>";
                    header('refresh:0');

            }
        }

        public function delete_staff(){

            $id_user = $_POST['id_user'];

            if(isset($_POST['delete_staff'])) {
                $connection = $this->openConn();
                $stmt = $connection->prepare("DELETE FROM tbl_user where id_user = ?");
                $stmt->execute([$id_user]);
                
                $message2 = "Staff Account Deleted";
                
                echo "<script type='text/javascript'>alert('$message2');</script>";
                 header('refresh:0');
            }
        }

    //--------------------------------------------- EXTRA FUNCTIONS FOR STAFF -------------------------------------------------

            public function get_single_staff($id_user){

                $id_user = $_GET['id_user'];
                
                $connection = $this->openConn();
                $stmt = $connection->prepare("SELECT * FROM tbl_user where id_user = ?");
                $stmt->execute([$id_user]);
                $user = $stmt->fetch();
                $total = $stmt->rowCount();

                if($total > 0 )  {
                    return $user;
                }
                else{
                    return false;
                }
            }


        public function check_staff($id_user) {

            $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT * FROM tbl_user WHERE id_user = ?");
            $stmt->Execute([$id_user]);
            $total = $stmt->rowCount(); 

            return $total;
        }

        public function count_staff() {
            $connection = $this->openConn();

            $stmt = $connection->prepare("SELECT COUNT(*) from tbl_user");
            $stmt->execute();
            $staffcount = $stmt->fetchColumn();

            return $staffcount;
        }

        public function count_mstaff() {
            $connection = $this->openConn();

            $stmt = $connection->prepare("SELECT COUNT(*) from tbl_user where sex = 'male'");
            $stmt->execute();
            $staffcount = $stmt->fetchColumn();

            return $staffcount;
        }

        public function count_fstaff() {
            $connection = $this->openConn();

            $stmt = $connection->prepare("SELECT COUNT(*) from tbl_user where sex = 'female'");
            $stmt->execute();
            $staffcount = $stmt->fetchColumn();

            return $staffcount;
        }


        //===================================== SCOPE CHANGED FEATURES =======================================

        public function view_staff_male(){
            $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT * from tbl_user WHERE `sex` = 'Male'");
            $stmt->execute();   
            $view = $stmt->fetchAll();
            return $view;
        }
    
        public function view_staff_female(){
            $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT * from tbl_user WHERE `sex` = 'Female'");
            $stmt->execute();
            $view = $stmt->fetchAll();
            return $view;
        }


        //================ OFFICIALS ===============


        public function create_official() {

            if(isset($_POST['add_official'])) {
                $name = $_POST['name'];
                $position = ($_POST['position']);
                $termstart = $_POST['termstart'];
                $termend = $_POST['termend'];

                    $connection = $this->openConn();
                    $stmt = $connection->prepare("INSERT INTO tbl_officials (`name`,`position`,`termstart`,`termend`) VALUES (?, ?, ?, ?)");
    
                    $stmt->Execute([$name, $position, $termstart, $termend]);
                    $message2 = "New Official Adedd";
    
                    echo "<script type='text/javascript'>alert('$message2');</script>";
                    header('refresh:0');

            }
        }


        public function view_official(){

            $connection = $this->openConn();

            $stmt = $connection->prepare("SELECT * from tbl_officials");
            $stmt->execute();
            $view = $stmt->fetchAll();

            //$rows = $stmt->
            return $view;
           
        }


        public function update_official() {
            if (isset($_POST['update_official'])) {
                $id_official = $_GET['id_official'];
                $lname = $_POST['lname']; // Assuming these are the values from the form
                $fname = $_POST['fname'];
                $mi = $_POST['mi'];
                $name = $fname . ' ' . $mi . ' ' . $lname;
                $position = $_POST['position'];
                $termstart = $_POST['termstart'];
                $termend = $_POST['termend'];
                
                    $connection = $this->openConn();
                    $stmt = $connection->prepare("UPDATE tbl_officials SET name =?, 
                    position = ?, termstart =?, termend =? WHERE id_official = ?");
                    $stmt->execute([ $name, $position, $termstart, $termend, $id_official]);
                   
                    $message2 = "Official's Information Updated";
    
                    echo "<script type='text/javascript'>alert('$message2');</script>";
                    header('refresh:0');

            }
        }

        public function delete_official(){

            $id_official = $_POST['id_official'];

            if(isset($_POST['delete_official'])) {
                $connection = $this->openConn();
                $stmt = $connection->prepare("DELETE FROM tbl_officials where id_official = ?");
                $stmt->execute([$id_official]);
                
                $message2 = "Official Account Deleted";
                
                echo "<script type='text/javascript'>alert('$message2');</script>";
                 header('refresh:0');
            }
        }

        public function get_single_official($id_official){

                $id_official = $_GET['id_official'];
                
                $connection = $this->openConn();
                $stmt = $connection->prepare("SELECT * FROM tbl_officials where id_official = ?");
                $stmt->execute([$id_official]);
                $user = $stmt->fetch();
                $total = $stmt->rowCount();

                if($total > 0 )  {
                    return $user;
                }
                else{
                    return false;
                }
        }

        //========================== POSITION ==========================================

        public function create_position() {

            if(isset($_POST['add_position'])) {
                $position = ($_POST['position']);
                $pos_order = $_POST['pos_order'];

                    $connection = $this->openConn();
                    $stmt = $connection->prepare("INSERT INTO position (`position`,`pos_order`) VALUES (?, ?)");
    
                    $stmt->Execute([$position, $pos_order]);
                    $message2 = "New Position Adedd";
    
                    echo "<script type='text/javascript'>alert('$message2');</script>";
                    header('refresh:0');

            }
        }

         public function view_position(){

            $connection = $this->openConn();

            $stmt = $connection->prepare("SELECT * from position");
            $stmt->execute();
            $view = $stmt->fetchAll();

            //$rows = $stmt->
            return $view;
           
        }


        public function update_position() {
            if (isset($_POST['update_position'])) {
                $id_position = $_GET['id_position'];
                $position = $_POST['position']; // Assuming these are the values from the form
                $pos_order = $_POST['pos_order'];
                
                    $connection = $this->openConn();
                    $stmt = $connection->prepare("UPDATE position SET position = ?, pos_order =? WHERE id_position = ?");
                    $stmt->execute([$position, $pos_order, $id_position]);
                   
                    $message2 = "Position Information Updated Successfully!";
    
                    echo "<script type='text/javascript'>alert('$message2');</script>";
                    header('refresh:0');

            }
        }

        public function delete_position(){

            $id_position = $_POST['id_position'];

            if(isset($_POST['delete_position'])) {
                $connection = $this->openConn();
                $stmt = $connection->prepare("DELETE FROM position where id_position = ?");
                $stmt->execute([$id_position]);
                
                $message2 = "Position Deleted";
                
                echo "<script type='text/javascript'>alert('$message2');</script>";
                 header('refresh:0');
            }
        }

        public function get_single_position($id_position){

                $id_position = $_GET['id_position'];
                
                $connection = $this->openConn();
                $stmt = $connection->prepare("SELECT * FROM position where id_position = ?");
                $stmt->execute([$id_position]);
                $user = $stmt->fetch();
                $total = $stmt->rowCount();

                if($total > 0 )  {
                    return $user;
                }
                else{
                    return false;
                }
        }

    }
    $staffbmis = new StaffClass();
?>