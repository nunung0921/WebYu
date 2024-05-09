<?php 

    require_once('main.class.php');
    

    class ResidentClass extends BMISClass {
        //------------------------------------ RESIDENT CRUD FUNCTIONS ----------------------------------------

public function create_resident() {
    if (isset($_POST['add_resident'])) {
        // Retrieve form data
        $lname = $_POST['lname'];
        $fname = $_POST['fname'];
        $mi = $_POST['mi'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $password = md5($_POST['password']); // Hash the password
        $houseno = $_POST['houseno'];
        $street = $_POST['street'];
        $brgy = $_POST['brgy'];
        $municipal = $_POST['municipal'];
        $bdate = $_POST['bdate'];
        $bplace = $_POST['bplace'];
        $nationality = $_POST['nationality'];
        $status = $_POST['status'];
        $age = $_POST['age'];
        $sex = $_POST['sex'];
        $voter = $_POST['voter'];
        //$family_role = $_POST['family_role'];
        $pwd = $_POST['pwd'];
        $indigent = $_POST['indigent'];
        $single_parent = $_POST['single_parent'];
        $malnourished = $_POST['malnourished'];
        $four_ps = $_POST['four_ps'];
        $role = $_POST['role'];


        if ($_SERVER['PHP_SELF'] === '/resident_registration.php' && $_SERVER['HTTP_HOST'] === 'biclataninfosystem.com') {
            $request_status = 'pending';

            // Open the database connection
            $connection = $this->openConn();

            try {
                // Prepare the SQL query
                $stmt = $connection->prepare("INSERT INTO tbl_resident (lname, fname, mi, contact, email, password, houseno, street, brgy, municipal, bdate, bplace, nationality, status, age, sex, voter, pwd, indigent, single_parent, malnourished, four_ps, role, request_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                // Bind parameters and execute the query
                $stmt->execute([$lname, $fname, $mi, $contact, $email, $password, $houseno, $street, $brgy, $municipal, $bdate, $bplace, $nationality, $status, $age, $sex, $voter, $pwd, $indigent, $single_parent, $malnourished, $four_ps, $role, $request_status]);

                // Provide feedback to the user
                $message = "Thanks for signing up. Your account has been created!";
                echo "<script type='text/javascript'>alert('$message'); window.location.href = 'index_login.php';</script>";
                
                // Redirect the user
                //header("Location: index_login.php");
                exit;
            } catch (PDOException $e) {
                // Handle any potential errors
                echo "Error: " . $e->getMessage();
            }
        }

            else{
                $request_status = 'approved';

                // Open the database connection
                $connection = $this->openConn();

                try {
                    // Prepare the SQL query
                    $stmt = $connection->prepare("INSERT INTO tbl_resident (lname, fname, mi, contact, email, password, houseno, street, brgy, municipal, bdate, bplace, nationality, status, age, sex, voter, pwd, indigent, single_parent, malnourished, four_ps, role, request_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                    // Bind parameters and execute the query
                    $stmt->execute([$lname, $fname, $mi, $contact, $email, $password, $houseno, $street, $brgy, $municipal, $bdate, $bplace, $nationality, $status, $age, $sex, $voter, $pwd, $indigent, $single_parent, $malnourished, $four_ps, $role, $request_status]);

                    // Provide feedback to the user
                    $message = "Resident account added successfully!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                            header("Refresh:0;");
                            exit;
                }
                catch (PDOException $e) {
                    // Handle any potential errors
                    echo "Error: " . $e->getMessage();
                }
            } 
        // Close the database connection
        $connection = null;
    }
}



        public function view_resident(){
            $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT * from tbl_resident WHERE request_status = 'approved'");
            $stmt->execute();
            $view = $stmt->fetchAll();
            return $view;
        }

        public function update_resident() {
            if (isset($_POST['update_resident'])) {
                $id_resident = $_GET['id_resident'];
                $email = $_POST['email'];
                $password = ($_POST['password']);
                $lname = $_POST['lname'];
                $fname = $_POST['fname'];
                $mi = $_POST['mi'];
                $age = $_POST['age'];
                $sex = $_POST['sex'];
                $status = $_POST['status'];
                $houseno = $_POST['houseno'];
                $street = $_POST['street'];
                $brgy = $_POST['brgy'];
                $municipal = $_POST['municipal'];
                $contact = $_POST['contact'];
                $bdate = $_POST['bdate'];
                $bplace = $_POST['bplace'];
                $nationality = $_POST['nationality'];
                $voter = $_POST['voter'];
                $familyrole = $_POST['family_role'];
                $role = $_POST['role'];
                $pwd = $_POST['pwd'];
                $indigent = $_POST['indigent'];
                $single_parent = $_POST['single_parent'];
                $malnourished = $_POST['malnourished'];
                $four_ps = $_POST['four_ps'];

                $connection = $this->openConn();
                $stmt = $connection->prepare("UPDATE tbl_resident SET `password` =?, `lname` =?, 
                `fname` = ?, `mi` =?, `age` =?, `sex` =?, `status` =?, `email` =?, `houseno` =?, `street` =?, `brgy` =?, `municipal` =?, `contact` =?, `bdate` =?, `bplace` =?, `nationality` =?, `voter` =?, `family_role` =?, `role` =?, `pwd` =?, `indigent` =?, `single_parent` =?, `malnourished` =?, `four_ps` =?, `addedby` =? WHERE `id_resident` = ?");
                $stmt->execute([$password, $lname, $fname, $mi, $age, $sex, $status,$email, $houseno, 
                $street, $brgy, $municipal, $contact, $bdate, $bplace, $nationality, $voter, $familyrole, $role, $pwd, $indigent, $single_parent, $malnourshed, $four_ps, $addedby, $id_resident]);
                    
                $message2 = "Resident Data Updated";
                echo "<script type='text/javascript'>alert('$message2');</script>";
                header("refresh: 0");
            }
        }

        public function delete_resident(){
            $id_resident = $_POST['id_resident'];

            if(isset($_POST['delete_resident'])) {
                $connection = $this->openConn();
                $stmt = $connection->prepare("DELETE FROM tbl_resident where id_resident = ?");
                $stmt->execute([$id_resident]);

                $message2 = "Resident Data Deleted";
                
                echo "<script type='text/javascript'>alert('$message2');</script>";
                header("Refresh:0");
            }
        }

    //-------------------------------- EXTRA FUNCTIONS FOR RESIDENT CLASS ---------------------------------

    


    public function get_single_resident($id_resident){

        $id_resident = $_GET['id_resident'];
        
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_resident where id_resident = ?");
        $stmt->execute([$id_resident]);
        $resident = $stmt->fetch();
        $total = $stmt->rowCount();

        if($total > 0 )  {
            return $resident;
        }
        else{
            return false;
        }
    }

    public function get_single_admin($id_admin){

        $id_admin = $_GET['id_admin'];
        
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_admin where id_admin = ?");
        $stmt->execute([$id_admin]);
        $admin = $stmt->fetch();
        $total = $stmt->rowCount();

        if($total > 0 )  {
            return $admin;
        }
        else{
            return false;
        }
    }
   
    public function check_resident($email) {

        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_resident WHERE email = ?");
        $stmt->Execute([$email]);
        $total = $stmt->rowCount(); 

        return $total;
    }

    public function count_resident() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_resident WHERE request_status = 'approved'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();
        return $rescount;
    }

    public function check_household($lname, $mi) {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_resident WHERE lname = ? AND mi = ?");
        $stmt->Execute([$lname, $mi]);
        $total = $stmt->rowCount(); 
        return $total;
    }

    public function view_household_list() {
        $lname = $_POST['lname'];
        $mi = $_POST['mi'];

        if(isset($_POST['search_household'])) {
            $connection = $this->openConn();
            $stmt1 = $connection->prepare("SELECT * FROM `tbl_resident` WHERE `lname` LIKE '%$lname%' and  `mi` LIKE '%$mi%'");
            $stmt1->execute();
        }
    }

    public function count_male_resident() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_resident where sex = 'male' ");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }

    public function count_female_resident() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_resident where sex = 'female' and request_status = 'approved'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }

    public function count_head_resident() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_resident where family_role = 'Yes'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }

    public function count_member_resident() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_resident where family_role = 'Family Member'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }

    public function profile_update() {
        $id_resident = $_GET['id_resident'];
        $age = $_POST['age'];
        $status = $_POST['status'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];

        if (isset($_POST['profile_update'])) {
           
            $connection = $this->openConn();
            $stmt = $connection->prepare("UPDATE tbl_resident SET  `age` = ?,  `status` = ?, 
            `address` = ?, `contact` = ? WHERE id_resident = ?");
            $stmt->execute([ $age, $status, $address,
            $contact, $id_resident]);
               
            $message2 = "Resident Profile Updated";
                
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("Refresh:0");

        }

    }

public function profile_update_admin() {
    $id_admin = $_GET['id_admin'];
    $email = $_POST['email'];
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $mi = $_POST['mi'];

    if (isset($_POST['profile_update_admin'])) {
        $connection = $this->openConn();
        $stmt = $connection->prepare("UPDATE tbl_admin SET `email` = ?, `lname` = ?, `fname` = ?, `mi` = ? WHERE id_admin = ?");
        $stmt->execute([$email, $lname, $fname, $mi, $id_admin]);
           
        $message2 = "Profile Updated";
            
        echo "<script type='text/javascript'>alert('$message2');</script>";
        // Redirect the user to a specific page after updating the profile
        header("Refresh:0");
        exit();
    }
}


    

    //------------------------------------- RESIDENT FILTERING QUERIES --------------------------------------

    public function view_resident_minor(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_resident WHERE `age` <= 17 and request_status = 'approved'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function view_resident_adult(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_resident WHERE `age` >= 18 AND `age` <= 59 and request_status = 'approved'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function view_resident_senior(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_resident WHERE `age` >= 60 and request_status = 'approved'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function count_resident_senior() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) FROM tbl_resident WHERE `age` >= 60 and request_status = 'approved'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }

    public function view_pwd(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_resident WHERE `pwd` = 'Yes' and request_status = 'approved'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function view_sp(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_resident WHERE `single_parent` = 'Yes' and request_status = 'approved'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function view_4ps(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_resident WHERE `four_ps` = 'Yes' and request_status = 'approved'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function view_resident_indigent(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_resident WHERE `indigent` = 'Yes' and request_status = 'approved'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function view_malnourished(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_resident WHERE `malnourished` = 'Yes' and request_status = 'approved'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }





    //-------------------------------------- EXTRA FUNCTIONS ------------------------------------------------

    public function resident_changepass() {
        $id_resident = $_GET['id_resident'];
        $oldpassword = ($_POST['oldpassword']);
        $oldpasswordverify = ($_POST['oldpasswordverify']);
        $newpassword = ($_POST['newpassword']);
        $checkpassword = $_POST['checkpassword'];

        if(isset($_POST['resident_changepass'])) {

            $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT `password` FROM tbl_resident WHERE id_resident = ?");
            $stmt->execute([$id_resident]);
            $result = $stmt->fetch();

            if($result == 0) {
                
                echo "Old Password is Incorrect";
            }

            elseif ($oldpassword != $oldpasswordverify) {
                echo "Old Password is Incorrect";
            }

            elseif ($newpassword != $checkpassword){
                echo "New Password and Verification Password does not Match";
            }

            else {
                $connection = $this->openConn();
                $stmt = $connection->prepare("UPDATE tbl_resident SET password =? WHERE id_resident = ?");
                $stmt->execute([$newpassword, $id_resident]);
                
                $message2 = "Password Updated";
                echo "<script type='text/javascript'>alert('$message2');</script>";
                header("refresh: 0");
            }


        }
    }


public function admin_changepass() {
    $id_admin = $_GET['id_admin'];
    if(isset($_POST['oldpassword'], $_POST['oldpasswordverify'], $_POST['newpassword'], $_POST['confirm_password'])) {
        $oldpassword = $_POST['oldpassword'];
        $oldpasswordverify = $_POST['oldpasswordverify'];
        $newpassword = $_POST['newpassword'];
        $checkpassword = $_POST['confirm_password'];

        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT `password` FROM tbl_admin WHERE id_admin = ?");
        $stmt->execute([$id_admin]);
        $result = $stmt->fetch();

        $hashed_old_password = md5($oldpassword);

if($hashed_old_password !== $result['password']) {
    echo "Old Password is Incorrect";
} elseif ($oldpassword != $oldpasswordverify) {
            echo "Old Password is Incorrect";
        } elseif ($newpassword != $checkpassword){
            echo "New Password and Verification Password does not Match";
        } else {
            // Hash the new password using MD5
            $hashed_password = md5($newpassword);
            
            // Update the password in the database
            $stmt = $connection->prepare("UPDATE tbl_admin SET password = ? WHERE email = ?");
            $stmt->execute([$hashed_password, $id_admin]);
            
            $message2 = "Password Updated";
            echo "<script type='text/javascript'>alert('$message2');</script>";
        }
    } else {
        echo "All password fields are required";
    }
}






    //========================================== SCOPE CHANGED FUNCTIONS ===========================================

    public function view_resident_household(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_resident WHERE `family_role` = 'Yes'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function view_resident_voters(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_resident WHERE `voter` = 'Yes'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function view_unregistered(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_resident WHERE `voter` = 'No'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function view_resident_male(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_resident WHERE `sex` = 'Male' and request_status = 'approved'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function view_resident_female(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_resident WHERE `sex` = 'Female' and request_status = 'approved'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function count_voters() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_resident where `voter` = 'Yes' and request_status = 'approved'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }

//========================= SEARCH =====================================
    public function search_admn_voter() {
        
        $search = $_GET['search'];

        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_resident WHERE `fname` = '$search'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function search_official() {
        
        $search = $_POST['search'];

        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_officials WHERE `fname` = '$search'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    //--------------------------------REQUEST--//
        public function get_pending_requests() {
            $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT * FROM approval WHERE status = 'pending'");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        // Function to approve a pending request
    public function approve_request() {
    if (isset($_POST['approve_request'])) {
        // Retrieve the resident ID from the form submission
        $id_resident = $_POST['id_resident'];
        // Open the database connection
        $connection = $this->openConn();

            // Prepare and execute the SQL query to update the request status
            $stmt = $connection->prepare("UPDATE tbl_resident SET request_status = 'approved' WHERE id_resident = ?");
            $stmt->execute([$id_resident]);


                $message = "Request status updated successfully.";


        // Close the database connection
        $connection = null;

        // Display the message using JavaScript
        echo "<script type='text/javascript'>alert('$message');</script>";

        header("Refresh:0");
    }
}



        // Function to reject a pending request
        public function reject_request() {

            if(isset($_POST['reject_request'])) {
                $id_resident = $_POST['id_resident'];
                $connection = $this->openConn();
                $stmt = $connection->prepare("DELETE FROM tbl_resident where id_resident = ?");
                $stmt->execute([$id_resident]);

                $message2 = "Resident Request Rejected";
                
                echo "<script type='text/javascript'>alert('$message2');</script>";
                header("Refresh:0");
            }
            // Optionally, you can perform additional actions here, such as notifying the user of the rejection.
        }

    public function count_request() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from approval WHERE apstatus = 'pending' ");
        $stmt->execute();
        $reqscount = $stmt->fetchColumn();
        return $reqscount;
    }

    // Function to view requests with user information
        // Function to view requests with user information
    public function view_request() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_resident WHERE request_status='pending'");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function delete_approval(){
        $id_announcement = $_POST['id_approval'];

        if(isset($_POST['delete_announcement'])) {
            $connection = $this->openConn();
            $stmt = $connection->prepare("DELETE FROM approval where id_approval = ?");
            $stmt->execute([$id_approval]);

            header("Refresh:0");
        }
    }

    public function count_approval() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_resident WHERE request_status='pending'");
        $stmt->execute();
        $reqscount = $stmt->fetchColumn();
        return $reqscount;
    }

        public function get_single_request($id_resident){
            $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT * FROM tbl_resident WHERE id_resident = ? AND request_status = 'pending'");
            $stmt->execute([$id_resident]);
            $resident = $stmt->fetch();
            $total = $stmt->rowCount();

            if($total > 0 )  {
                return $resident;
            } else {
                return false;
            }
        }



    //======================= COUNTS ==============================

    public function count_minor() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_resident WHERE age <= 17 ");
        $stmt->execute();
        $minorcount = $stmt->fetchColumn();
        return $minorcount;
    }

    public function count_pwd() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_resident WHERE pwd = 'yes' and request_status = 'approved'");
        $stmt->execute();
        $pwdcount = $stmt->fetchColumn();
        return $pwdcount;
    }
    public function count_single_parent() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_resident WHERE single_parent = 'yes' and request_status = 'approved'");
        $stmt->execute();
        $spcount = $stmt->fetchColumn();
        return $spcount;
    }

    public function count_fourps() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_resident WHERE four_ps = 'yes' and request_status = 'approved' ");
        $stmt->execute();
        $fourpscount = $stmt->fetchColumn();
        return $fourpscount;
    }

    public function count_indigent() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_resident WHERE indigent = 'yes' and request_status = 'approved'");
        $stmt->execute();
        $indigentcount = $stmt->fetchColumn();
        return $indigentcount;
    }

    public function count_malnourished() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_resident WHERE malnourished = 'yes' and request_status = 'approved'");
        $stmt->execute();
        $malcount = $stmt->fetchColumn();
        return $malcount;
    }

    public function count_vaccinated() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_resident WHERE vaccinated = 'yes' and request_status = 'approved' ");
        $stmt->execute();
        $vacxcount = $stmt->fetchColumn();
        return $vacxcount;
    }

    public function count_pregnancy() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_resident WHERE pregnancy = 'yes' ");
        $stmt->execute();
        $pregnancycount = $stmt->fetchColumn();
        return $pregnancycount;
    }
    public function count_residency() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_rescert");
        $stmt->execute();
        $residencycount = $stmt->fetchColumn();
        
        $color = ($residencycount > 0) ? "crimson" : "black";
        
        return array(
            "count" => $residencycount,
            "color" => $color
        );
    }

    public function count_bspermit() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_bspermit");
        $stmt->execute();
        $bspermitcount = $stmt->fetchColumn();
        
        $color = ($bspermitcount > 0) ? "crimson" : "black";
        
        return array(
            "count" => $bspermitcount,
            "color" => $color
        );
    }

    public function count_blotter() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_blotter");
        $stmt->execute();
        $blottercount = $stmt->fetchColumn();
        
        $color = ($blottercount > 0) ? "crimson" : "black";
        
        return array(
            "count" => $blottercount,
            "color" => $color
        );
    }

    public function count_clearance() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_clearance");
        $stmt->execute();
        $clearancecount = $stmt->fetchColumn();
        
        $color = ($clearancecount > 0) ? "crimson" : "black";
        
        return array(
            "count" => $clearancecount,
            "color" => $color
        );
    }

    public function count_indigency() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_indigency");
        $stmt->execute();
        $indigencycount = $stmt->fetchColumn();
        
        $color = ($indigencycount > 0) ? "crimson" : "black";
        
        return array(
            "count" => $indigencycount,
            "color" => $color
        );
    }


 public function view_logs(){
    $connection = $this->openConn();
    $stmt = $connection->prepare("SELECT activity_log.*, tbl_admin.lname as admin_lname
                                  FROM activity_log
                                  JOIN tbl_admin ON activity_log.id_resident = tbl_admin.id_admin
                                  WHERE activity_log.id_resident IS NOT NULL");
    $stmt->execute();
    $view = $stmt->fetchAll();
    return $view;
}

  public function update_system_info() {
    // Fetch the values from $_POST
    $name = $_POST['name'];
    $acronym = $_POST['acronym'];
    $poweredBy = $_POST['poweredBy'];

    if (isset($_POST['update_system_info'])) {
        // Prepare the SQL query with placeholders
        $sql = "UPDATE system_info SET `name` = ?, `acronym` = ?, `poweredBy` = ? WHERE id_system = 1";
        
        // Open database connection
        $connection = $this->openConn();

        // Prepare the statement
        $stmt = $connection->prepare($sql);

        // Bind parameters and execute the statement
        $stmt->execute([$name, $acronym, $poweredBy]);

        // Check if update was successful
        if ($stmt->rowCount() > 0) {
            $message2 = "System Information Updated";
        } else {
            $message2 = "No changes were made to system information";
        }

        // Display message
        echo "<script type='text/javascript'>alert('$message2');</script>";

        // Redirect to a new page after update
        header("Location: chairman_modal.php?id_system=1");
        exit(); // Terminate script execution after redirection
    }
}




    public function view_system(){

            $connection = $this->openConn();

            $stmt = $connection->prepare("SELECT * from system_info");
            $stmt->execute();
            $view = $stmt->fetchAll();

            //$rows = $stmt->
            return $view;
           
    }


        public function get_single_system($id_system){
            // Remove the following line, as $id_system is already passed as a parameter
            // $id_system = $_GET['id_system'];
            
            $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT * FROM system_info WHERE id_system = ?");
            $stmt->execute([$id_system]); // Remove $id_system from here
            $system = $stmt->fetch();
            $total = $stmt->rowCount();

            if($total > 0 )  {
                return $system;
            }
            else {
                return false;
            }
        }


        public function create_system() {

            if(isset($_POST['add_system'])) {
                $name = $_POST['name'];
                $acronym = ($_POST['acronym']);
                $poweredBy = $_POST['poweredBy'];

                    $connection = $this->openConn();
                    $stmt = $connection->prepare("INSERT INTO system_info (`name`,`acronym`,`poweredBy`) VALUES (?, ?, ?)");
    
                    $stmt->Execute([$name, $acronym, $poweredBy]);
                    $message2 = "New System Information Adedd";
    
                    echo "<script type='text/javascript'>alert('$message2');</script>";
                    header('refresh:0');

            }
        }

public function update_blotter() {
    if (isset($_POST['update_blotter'])) {
        $id_blotter = $_POST['id_blotter'];
        $lname = $_POST['lname'];
        $fname = $_POST['fname'];
        $mi = $_POST['mi'];
        $contact = $_POST['contact'];
        $houseno = $_POST['houseno'];
        $street = $_POST['street'];
        $brgy = $_POST['brgy'];
        $municipal = $_POST['municipal'];
        $narrative = $_POST['narrative'];

        // Open database connection
        $connection = $this->openConn();
        
        // Prepare and execute the update query
        $stmt = $connection->prepare("UPDATE tbl_blotter SET lname = ?, fname = ?, mi = ?, contact = ?, houseno = ?, street = ?, brgy = ?, municipal = ?, narrative = ?, timeapplied = NOW() WHERE id_blotter = ?");
        $stmt->execute([$lname, $fname, $mi, $contact, $houseno, $street, $brgy, $municipal, $narrative, $id_blotter]);
        
        // Check if the update was successful
        if ($stmt->rowCount() > 0) {
            $message2 = "Complain/Blotter Data Updated";
        } else {
            $message2 = "Error updating data";
        }
        
        // Redirect to the form page after update
        header("Location: update_blotter_form.php?id_blotter=$id_blotter");
        exit(); // Terminate script execution after redirection
    }
}



    public function get_single_blotter($id_blotter){
        
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_blotter where id_blotter = ?");
        $stmt->execute([$id_blotter]);
        $resident = $stmt->fetch();
        $total = $stmt->rowCount();

        if($total > 0 )  {
            return $resident;
        }
        else{
            return false;
        }
    }

    }

    $residentbmis = new ResidentClass();
?>