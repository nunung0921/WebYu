<?php 

class BMISClass {
    
    protected $server = "localhost";
    protected $dbname = "u813203284_bmis";
    protected $user = "u813203284_webyu";
    protected $pass = "Webyu@2023";
    protected $conn;

    // Database connection
    public function openConn() {
        try {
            $this->conn = new PDO("mysql:host={$this->server};dbname={$this->dbname}", $this->user, $this->pass);
            // Set PDO to throw exceptions on error
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch(PDOException $e) {
            echo "Database Connection Error! ", $e->getMessage();
        }
    }

    public function closeConn() {
        $this->conn = null;
    }

    //------------------------------------------ AUTHENTICATION & SESSION HANDLING --------------------------------------------
        //authentication function para sa sa tatlong type ng accounts
        public function login() {
            if(isset($_POST['login'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
        
                // Verify the reCAPTCHA response
                if (isset($_POST['g-recaptcha-response'])) {
                    $captchaResponse = $_POST['g-recaptcha-response'];
        
                    // Your secret key provided by reCAPTCHA
                    $secretKey = '6LfIv9gpAAAAAHwR0o653AnIc7cobvtQ6tRQTs0H';
        
                    // Send a POST request to Google's reCAPTCHA verification endpoint
                    $url = 'https://www.google.com/recaptcha/api/siteverify';
                    $data = [
                        'secret' => $secretKey,
                        'response' => $captchaResponse
                    ];
        
                    $options = [
                        'http' => [
                            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                            'method' => 'POST',
                            'content' => http_build_query($data)
                        ]
                    ];
        
                    $context = stream_context_create($options);
                    $response = file_get_contents($url, false, $context);
        
                    if ($response !== false) {
                        $responseData = json_decode($response, true);
        
                        // Check if reCAPTCHA verification was successful
                        if ($responseData && $responseData['success']) {
                            // reCAPTCHA verification passed, continue with login
                            $connection = $this->openConn();
        
                            // Hash the entered password for comparison with the stored hashed password
                            $hashed_password = md5($password);
        
                            // Check if the user is an administrator
                            $stmt_admin = $connection->prepare("SELECT * FROM tbl_admin WHERE email = ? AND password = ?");
                            $stmt_admin->execute([$email, $hashed_password]);
                            $admin = $stmt_admin->fetch();
        
                            if($admin) {
                                // Redirect the admin to the admin dashboard
                                $this->set_userdata($admin);
                                header('Location: admin_dashboard.php');
                                exit;
                            }
        
                            // Check if the user is a regular user
                $stmt_user = $connection->prepare("SELECT * FROM tbl_user WHERE email = ? AND password = ?");
                $stmt_user->execute([$email, $hashed_password]);
                $user = $stmt_user->fetch();
                
                if($user) {
                    // Redirect the user to the staff dashboard
                    $this->set_userdata($user);
                    header('Location: staff_dashboard.php');
                    exit;
                }
                
                // Check if the user is a resident with an approved request_status
                $stmt_resident = $connection->prepare("SELECT * FROM tbl_resident WHERE email = ? AND password = ?");
                $stmt_resident->execute([$email, $hashed_password]);
                $resident = $stmt_resident->fetch();
                
                if($resident) {
                    if ($resident['request_status'] === 'pending') {
                        $message = "Your account is pending approval by the admin. Please wait for the admin to approve your request.";
                        echo <<<EOT
                        <div id="pendingApprovalModal" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); z-index: 9999;">
                            <h5 style="margin: 0; font-weight: bold; color: red; display: flex; justify-content: space-between; align-items: center;">
                                <span style="color: #000; font-size: 30px;">Account Pending Approval</span>
                                <div style="background-color: red; padding: 5px; border-radius: 50%; cursor: pointer;">
                                    <button onclick="closeModal()" style="background: none; border: none; font-size: 20px; color: white;">&times;</button>
                                </div>
                            </h5>
                            <p style="margin-bottom: 10px; font-size: 20px;">$message</p>
                        </div>
        
                        <script type="text/javascript">
                            function closeModal() {
                                var modal = document.getElementById('pendingApprovalModal');
                                modal.style.display = 'none';
                                window.location.href = 'index.php';
                            }
        
                            document.addEventListener('DOMContentLoaded', function() {
                                var modal = document.getElementById('pendingApprovalModal');
                                modal.style.display = 'block';
        
                                setTimeout(function() {
                                    modal.style.display = 'none';
                                    window.location.href = 'index.php'; // Redirect to index.php
                                }, 60000); // Adjust the delay time (in milliseconds) as needed
                            });
                        </script>
                        EOT;
                        exit;
                    } elseif ($resident['request_status'] === 'approved') {
                        // Redirect the resident to their homepage
                        $this->set_userdata($resident);
                        $message = "Successfully logged in!";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                        header('Location: resident_homepage.php');
                        exit;
                    }
                }
                            $message = "Invalid Email or Password";
                            echo "<script type='text/javascript'>alert('$message');</script>";
                        } else {
                            // reCAPTCHA verification failed, show an error message
                            $message = "reCAPTCHA verification failed. Please try again.";
                            echo "<script type='text/javascript'>alert('$message');</script>";
                        }
                    } else {
                        // Unable to contact Google's reCAPTCHA verification endpoint
                        $message = "Unable to verify reCAPTCHA. Please try again later.";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                } else {
                    // reCAPTCHA response not found, show an error message
                    $message = "reCAPTCHA response not found. Please complete the reCAPTCHA challenge.";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            }
        }



    //eto yung function na mag e end ng session tas i l logout ka 
    public function logout(){
        if(!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['userdata'] = null;
        unset($_SESSION['userdata']); 
        
    }

    // etong method na get_userdata() kukuha ng session mo na 'userdata' mo na i identify sino yung naka login sa site 
    public function get_userdata(){
    
        //i ch check niya ulit kung naka start na ba session o hindi, kapag hindi pa ay i s start niya para surebol
        if(!isset($_SESSION)) {
            session_start();
        }

        return $_SESSION['userdata'];

        //eto naman i ch check niya kung yung 'userdata' naka set na ba sa session natin
        if(!isset($_SESSION['userdata'])) {
            return $_SESSION['userdata'];
        } 

        else {
            return null;
        }
    }

    //eto yung condition na mag s set userdata na gagamiting pagkakakilala sayo sa buong session kapag nag login in ka
    public function set_userdata($array) {

        //i ch check nito kung naka set naba yung session, kapag hindi pa naka set i r run niya yung session_start();
        if(!isset($_SESSION)) {
            session_start();
        }

        //eto si userdata yung mag s set ng name mo tsaka role/access habang ikaw ay nag b browse at gumagamit ng store management
        $_SESSION['userdata'] = array(
            "id_admin" => $array['id_admin'],
            "id_resident" => $array['id_resident'],
            "id_user" => $array['id_user'],
            "emailadd" => $array['email'],
            "password" => $array['password'],
            //"fullname" => $array['lname']. " ".$array['fname']. " ".$array['mi'],
            "surname" => $array['lname'],
            "firstname" => $array['fname'],
            "mname" => $array['mi'],
            "age" => $array['age'],
            "sex" => $array['sex'],
            "status" => $array['status'],
            "address" => $array['address'],
            "contact" => $array['contact'],
            "bdate" => $array['bdate'],
            "bplace" => $array['bplace'],
            "nationality" => $array['nationality'],
            "family_role" => $array['family_role'],
            "role" => $array['role'],
            "houseno" => $array['houseno'],
            "street" => $array['street'],
            "brgy" => $array['brgy'],
            "municipal" => $array['municipal']
        );
        return $_SESSION['userdata'];
    }



 //----------------------------------------------------- ADMIN CRUD ---------------------------------------------------------
    public function create_admin() {

        if(isset($_POST['add_admin'])) {
        
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mi = $_POST['mi'];
            $role = $_POST['role'];
    
                if ($this->check_admin($email) == 0 ) {
        
                    $connection = $this->openConn();
                    $stmt = $connection->prepare("INSERT INTO tbl_admin (`email`,`password`,`lname`,`fname`,
                    `mi`, `role` ) VALUES (?, ?, ?, ?, ?, ?)");
                    
                    $stmt->Execute([$email, $password, $lname, $fname, $mi, $role]);
                    
                    $message2 = "Administrator account added, you can now continue logging in";
                    echo "<script type='text/javascript'>alert('$message2');</script>";
                }
            }
    
            else {
                echo "<script type='text/javascript'>alert('Account already exists');</script>";
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

    public function admin_changepass() {
        $id_admin = $_GET['id_admin'];
        $oldpassword = ($_POST['oldpassword']);
        $oldpasswordverify = ($_POST['oldpasswordverify']);
        $newpassword = ($_POST['newpassword']);
        $checkpassword = $_POST['checkpassword'];

        if(isset($_POST['admin_changepass'])) {

            $connection = $this->openConn();
            $stmt = $connection->prepare("SELECT `password` FROM tbl_admin WHERE id_admin = ?");
            $stmt->execute([$id_admin]);
            $result = $stmt->fetch();

            if($result == 0) {
                
                echo "Old Password is Incorrect";
            }

            elseif ($oldpassword != $oldpasswordverify) {
            }

            elseif ($newpassword != $checkpassword){
                echo "New Password and Verification Password does not Match";
            }

            else {
                $connection = $this->openConn();
                $stmt = $connection->prepare("UPDATE tbl_admin SET password =? WHERE id_admin = ?");
                $stmt->execute([$newpassword, $id_admin]);
                
                $message2 = "Password Updated";
                echo "<script type='text/javascript'>alert('$message2');</script>";
                header("refresh: 0");
            }


        }
    }



 //  ----------------------------------------------- ANNOUNCEMENT CRUD ---------------------------------------------------------


    public function create_announcement() {
        if(isset($_POST['create_announce'])) {
            $id_announcement = $_POST['id_announcement'];
            $event = $_POST['event'];
            $start_date = $_POST['start_date'];
            $addedby = $_POST['addedby'];

            $connection = $this->openConn();
            $stmt = $connection->prepare("INSERT INTO tbl_announcement (`id_announcement`, 
            `event`, `start_date`, `addedby`) VALUES ( ?, ?, ?, ?)");
            $stmt->execute([$id_announcement, $event, $start_date, $addedby]);

            $message2 = "Announcement Added";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header('refresh:0');
        }

        else {
        }
    }

    public function view_announcement(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_announcement");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function update_announcement() {
        if (isset($_POST['update_announce'])) {
            $id_announcement = $_GET['id_announcement'];
            $event = $_POST['event'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $addedby = $_POST['addedby'];

            $connection = $this->openConn();
            $stmt = $connection->prepare("UPDATE tbl_announcement SET event =?, start_date =?, 
            end_date = ?, addedby =? WHERE id_announcement = ?");
            $stmt->execute([ $event, $start_date, $end_date, $addedby, $id_announcement]);
               
            $message2 = "Announcement Updated";
            echo "<script type='text/javascript'>alert('$message2');</script>";
             header("refresh: 0");
        }

        else {
        }
    }

    public function delete_announcement(){
        $id_announcement = $_POST['id_announcement'];

        if(isset($_POST['delete_announcement'])) {
            $connection = $this->openConn();
            $stmt = $connection->prepare("DELETE FROM tbl_announcement where id_announcement = ?");
            $stmt->execute([$id_announcement]);

            header("Refresh:0");
        }
    }

    public function count_announcement() {
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_announcement");
        $stmt->execute();
        $ancount = $stmt->fetchColumn();
        return $ancount;
    }

    //------------------------------------------ Animal Welfare CRUD -----------------------------------------------


    public function create_animal() {
        $id_resident = $_POST['id_resident'];
        $pettype = $_POST['pettype'];
        $breed = $_POST['breed'];
        $sex = $_POST['sex'];
        $age = $_POST['age'];
        $purpose = $_POST['purpose'];
        $vaccination = $_POST['vaccination'];
        $owner = $_POST['owner'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $dateapply = $_POST['dateapply'];
        $addedby = $_POST['addedby'];


        $connection = $this->openConn();
        $stmt = $connection->prepare("INSERT INTO tbl_animal (`id_resident`, 
        `pettype`, `breed`, `sex`, `age`, `purpose`, `vaccination`, `owner`, `address`,
        `contact`, `dateapply`, `addedby`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([$id_resident, $pettype, $breed, $sex, $age, $purpose, $vaccination,
        $owner, $address,  $contact, $dateapply,  $addedby]);

        $message2 = "Application Applied, you will be receive our text message for further details";
        echo "<script type='text/javascript'>alert('$message2');</script>";
        header("refresh: 0");
        
    }

    public function view_animal(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_animal");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function update_animal() {
        if (isset($_POST['update_animal'])) {
            $id_animal = $_GET['id_animal'];
            $pettype = $_POST['pettype'];
            $breed = $_POST['breed'];
            $sex = $_POST['sex'];
            $age = $_POST['age'];
            $purpose = $_POST['purpose'];
            $vaccination = $_POST['vaccination'];
            $owner = $_POST['owner'];
            $address = $_POST['address'];
            $contact = $_POST['contact'];
            $dateapply = $_POST['dateapply'];
            $addedby = $_POST['addedby'];

            $connection = $this->openConn();
            $stmt = $connection->prepare("UPDATE tbl_animal SET pettype = ?, breed = ?, sex = ?, 
            age = ?, purpose = ?, vaccination = ?, owner = ?, address = ?, contact = ?, dateapply = ?,
            addedby = ? WHERE id_animal = ?");
            $stmt->execute([ $pettype, $breed, $sex, $age, $purpose, $vaccination, $owner, 
            $address, $contact, $dateapply, $addedby, $id_animal]);
            
            $message2 = "Animal Registry & Welfare Data Updated";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("refresh: 0");
        }
    }

    public function delete_animal(){
        $id_animal = $_POST['id_animal'];

        if(isset($_POST['delete_animal'])) {
            $connection = $this->openConn();
            $stmt = $connection->prepare("DELETE FROM tbl_animal where id_animal = ?");
            $stmt->execute([$id_animal]);

            header("Refresh:0");
        }
    }

    public function get_single_animal(){

        $id_animal = $_GET['id_animal'];

        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_animal where id_animal = ?");
        $stmt->execute([$id_animal]);
        $animal = $stmt->fetch();
        $total = $stmt->rowCount();

        if($total > 0 )  {
            return $animal;
        }
        else{
            return false;
        }
    }

    public function count_animal() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_animal");
        $stmt->execute();
        $animalcount = $stmt->fetchColumn();

        return $animalcount;
    }

    public function count_animal_dogs() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_animal where pettype = 'dog'");
        $stmt->execute();
        $animalcount = $stmt->fetchColumn();

        return $animalcount;
    }

    public function count_animal_cats() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_animal where pettype = 'cat'");
        $stmt->execute();
        $animalcount = $stmt->fetchColumn();

        return $animalcount;
    }

    public function count_animals() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_animal");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }

    public function count_female_animals() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_animal where sex = 'female'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }

    public function count_male_animals() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_animal where sex = 'male'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }
    


    //  --------------------------------------------------------- MEDICINE CRUD ---------------------------------------------------------


    public function create_medicine() {
        if(isset($_POST['create_medicine'])) {

            $id_medicine = $_POST['id_medicine'];
            $item = $_POST['item'];
            $dateman = $_POST['dateman'];
            $origin = $_POST['origin'];
            $datein = $_POST['datein'];
            $dateout = $_POST['dateout'];
            $stocks = $_POST['stocks'];
            $remarks = $_POST['remarks'];
            $addedby = $_POST['addedby'];

            $connection = $this->openConn();
            $stmt = $connection->prepare("INSERT INTO tbl_medicine (`id_medicine`, 
            `item`, `dateman`, `origin`, `datein`, `dateout`, `stocks`, `remarks`, `addedby`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->execute([$id_medicine, $item, $dateman, $origin, $datein, $dateout, $stocks, $remarks, $addedby]);

            $message2 = "Medicine Added";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            
            header('refresh:0');
        }
    }


    public function view_medicine(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_medicine");
        $stmt->execute();
        $view = $stmt->fetchAll();

        return $view;
    }

    public function update_medicine() {
        if (isset($_POST['update_medicine'])) {
            $id_medicine = $_GET['id_medicine'];
            $item = $_POST['item'];
            $dateman = $_POST['dateman'];
            $origin = $_POST['origin'];
            $datein = $_POST['datein'];
            $dateout = $_POST['dateout'];
            $stocks = $_POST['stocks'];
            $remarks = $_POST['remarks'];
            $addedby = $_POST['addedby'];


            $connection = $this->openConn();
            $stmt = $connection->prepare("UPDATE tbl_medicine SET item =?, dateman =?, 
            origin = ?, datein = ?, dateout = ?, stocks = ?, remarks =?, addedby = ?
            WHERE id_medicine = ?");
            $stmt->execute([ $item, $dateman, $origin, $datein, $dateout, $stocks, $remarks, $addedby, $id_medicine]);
            
            $message2 = "Medicine Item Updated";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("refresh: 0");

        }
    }

    public function delete_medicine(){
        $id_medicine = $_POST['id_medicine'];

        if(isset($_POST['delete_medicine'])) {
            $connection = $this->openConn();
            $stmt = $connection->prepare("DELETE FROM tbl_medicine where id_medicine = ?");
            $stmt->execute([$id_medicine]);

            header("Refresh:0");
        }
    }

    public function get_single_medicine(){

        $id_medicine = $_GET['id_medicine'];

        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_medicine where id_medicine = ?");
        $stmt->execute([$id_medicine]);
        $medicine = $stmt->fetch();
        $total = $stmt->rowCount();

        if($total > 0 )  {
            return $medicine;
        }
        else{
            return false;
        }
    }

    public function count_medicine() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_medicine");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }

    //------------------------------------------ TB DOTS CRUD -----------------------------------------------


    public function create_tbdots() {
        if(isset($_POST['create_tbdots'])) {
            $id_tbdots = $_POST['id_tbdots'];
            $id_resident = $_POST['id_resident'];
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mi = $_POST['mi'];
            $age = $_POST['age'];
            $sex = $_POST['sex'];
            $address = $_POST['address'];
            $occupation = $_POST['occupation'];
            $contact = $_POST['contact'];
            $bdate = $_POST['bdate'];
            $height = $_POST['height'];
            $weight = $_POST['weight'];
            $philhealth = $_POST['philhealth'];
            $date_applied = $_POST['date_applied'];
            $addedby = $_POST['addedby'];



            $connection = $this->openConn();
            $stmt = $connection->prepare("INSERT INTO tbl_tbdots (`id_tbdots`, `id_resident`, 
            `lname`, `fname`, `mi`, `age`, `sex`, `address`, `occupation`, `contact`, `bdate`, `height`, 
            `weight`, `philhealth`, `date_applied`, `addedby`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->execute([$id_tbdots, $id_resident, $lname, $fname, $mi, $age, $sex, 
            $address, $occupation, $contact, $bdate, $height, $weight, $philhealth, $date_applied, $addedby]);

            $message2 = "Application Applied";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header('refresh:0');
        }
    }

    public function view_tbdots(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_tbdots");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function update_tbdots() {
        if (isset($_POST['update_tbdots'])) {
            $id_tbdots = $_GET['id_tbdots'];
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mi = $_POST['mi'];
            $age = $_POST['age'];
            $sex = $_POST['sex'];
            $address = $_POST['address'];
            $occupation = $_POST['occupation'];
            $contact = $_POST['contact'];
            $bdate = $_POST['bdate'];
            $height = $_POST['height'];
            $weight = $_POST['weight'];
            $philhealth = $_POST['philhealth'];
            $remarks = $_POST['remarks'];
            $addedby = $_POST['addedby'];


            $connection = $this->openConn();
            $stmt = $connection->prepare("UPDATE tbl_tbdots SET lname =?, fname =?, 
            mi = ?, age = ?, sex = ?, `address` = ?, occupation = ?, contact = ?,
            bdate = ?, height = ?, `weight` = ?, philhealth = ? remarks =?, addedby = ?
            WHERE id_tbdots = ?");
            $stmt->execute([ $lname, $fname, $mi, $age, $sex, $address, $occupation, $contact, 
            $bdate, $height, $weight, $philhealth, $remarks, $addedby, $id_tbdots]);
            
            $message2 = "TB DOTS Data Updated";
            echo "<script type='text/javascript'>alert('$message2');</script>";
             header("refresh: 0");
        }

        else {
            $message2 = "There was a problem in updating this data";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("refresh: 0");
        }
    }

    public function delete_tbdots(){
        $id_tbdots = $_POST['id_tbdots'];

        if(isset($_POST['delete_tbdots'])) {
            $connection = $this->openConn();
            $stmt = $connection->prepare("DELETE FROM tbl_tbdots where id_tbdots = ?");
            $stmt->execute([$id_tbdots]);

            header("Refresh:0");
        }
    }

    public function get_single_tbdots(){

        $id_tbdots = $_GET['id_tbdots'];

        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_tbdots where id_tbdots = ?");
        $stmt->execute([$id_tbdots]);
        $tbdots = $stmt->fetch();
        $total = $stmt->rowCount();

        if($total > 0 )  {
            return $tbdots;
        }
        else{
            return false;
        }
    }

    public function count_tbdots() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_tbdots");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }

    
    public function count_male_tbdots() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) FROM tbl_tbdots WHERE sex = 'Male'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }

    public function count_female_tbdots() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) FROM tbl_tbdots WHERE sex = 'Female'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }


    //------------------------------------------ MOTHER CHILD CHECKUP CRUD -----------------------------------------------


    public function create_motherchild() {
        $id_resident = $_POST['id_resident'];
        $lname = $_POST['lname'];
        $fname = $_POST['fname'];
        $mi = $_POST['mi'];
        $age = $_POST['age'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $remarks = $_POST['remarks'];
        $dateapply = $_POST['dateapply'];
        $addedby = $_POST['addedby'];


        $connection = $this->openConn();
        $stmt = $connection->prepare("INSERT INTO tbl_motherchild (`id_resident`, 
        `lname`, `fname`, `mi`, `age`, `contact`, `address`, `remarks`, `dateapply`, `addedby`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([$id_resident, $lname, $fname, $mi, $age, 
        $contact, $address,  $remarks, $dateapply,  $addedby]);

        $message2 = "Application Applied, you will be receive our text message for further details";
        echo "<script type='text/javascript'>alert('$message2');</script>";
        header("refresh: 0");
        
    }

    public function view_motherchild(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_motherchild");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function update_motherchild() {
        if (isset($_POST['update_motherchild'])) {
            $id_motherchild = $_GET['id_motherchild'];
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mi = $_POST['mi'];
            $age = $_POST['age'];
            $contact = $_POST['contact'];
            $address = $_POST['address'];
            $remarks = $_POST['remarks'];
            $addedby = $_POST['addedby'];

            $connection = $this->openConn();
            $stmt = $connection->prepare("UPDATE tbl_motherchild SET lname = ?, fname = ?, mi = ?, 
            age = ?, contact = ?, address = ?, remarks = ?, addedby = ? WHERE id_motherchild = ?");
            $stmt->execute([ $lname, $fname, $mi, $age, $address, $contact, $remarks, $addedby, $id_motherchild]);
            
            $message2 = "Mother & Child Check-up Data Updated";
            echo "<script type='text/javascript'>alert('$message2');</script>";
             header("refresh: 0");
        }
    }

    public function delete_motherchild(){
        $id_motherchild = $_POST['id_motherchild'];

        if(isset($_POST['delete_motherchild'])) {
            $connection = $this->openConn();
            $stmt = $connection->prepare("DELETE FROM tbl_motherchild where id_motherchild = ?");
            $stmt->execute([$id_motherchild]);

            header("Refresh:0");
        }
    }

    public function get_single_motherchild(){

        $id_motherchild = $_GET['id_motherchild'];

        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_motherchild where id_motherchild = ?");
        $stmt->execute([$id_motherchild]);
        $motherchild = $stmt->fetch();
        $total = $stmt->rowCount();

        if($total > 0 )  {
            return $motherchild;
        }
        else{
            return false;
        }
    }

    public function count_motherchild() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_motherchild");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }

    //------------------------------------------------------- FAMILY PLAN CRUD ----------------------------------------------------------------------


    public function create_familyplan() {
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mi = $_POST['mi'];
            $age = $_POST['age'];
            $contact = $_POST['contact'];
            $address = $_POST['address'];
            $occupation = $_POST['occupation'];
            $status = $_POST['status'];
            $bdate = $_POST['bdate'];

            $spouse = $_POST['sp_lname']. " ". $_POST['sp_fname']. " ". $_POST['sp_mi'];
            $sp_age = $_POST['sp_age'];
            $sp_bdate = $_POST['sp_bdate'];
            $sp_occupation = $_POST['sp_occupation'];
            $children = $_POST['children'];
            $income = $_POST['income'];
            $id_resident = $_POST['id_resident'];
            $dateapply = $_POST['dateapply'];
            $addedby = $_POST['addedby'];

                $connection = $this->openConn();
                $stmt = $connection->prepare("INSERT INTO tbl_familyplan (`id_resident`, 
                `lname`, `fname`, `mi`, `age`, `contact`, `address`, `occupation`, `status`, `bdate`, 
                `spouse`, `sp_age`, `sp_bdate`, `sp_occupation`, `children`, `income`, `dateapply`, 
                `addedby`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                $stmt->execute([$id_resident, $lname, $fname, $mi, $age,
                $contact, $address, $occupation, $status, $bdate, $spouse, $sp_age, $sp_bdate, $sp_occupation,
                $children, $income, $dateapply,  $addedby]);

                $message2 = "Application Applied, you will be receive our text message for further details";
                echo "<script type='text/javascript'>alert('$message2');</script>";
                header('refresh:0');
    }

    public function view_familyplan(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_familyplan");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function update_familyplan() {
        if (isset($_POST['update_familyplan'])) {
            $id_familyplan = $_GET['id_familyplan'];
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mi = $_POST['mi'];
            $age = $_POST['age'];
            $contact = $_POST['contact'];
            $address = $_POST['address'];
            $occupation = $_POST['occupation'];
            $status = $_POST['status'];
            $bdate = $_POST['bdate'];

            $spouse = $_POST['sp_lname']. " ". $_POST['sp_fname']. " ". $_POST['sp_mi'];
            $sp_age = $_POST['sp_age'];
            $sp_bdate = $_POST['sp_bdate'];
            $sp_occupation = $_POST['sp_occupation'];
            $children = $_POST['children'];
            $income = $_POST['income'];
            $addedby = $_POST['addedby'];

            $connection = $this->openConn();
            $stmt = $connection->prepare("UPDATE tbl_familyplan SET lname = ?, fname = ?, mi = ?, 
            age = ?, contact = ?, address = ?, occupation = ?, status = ?, bdate =?, spouse = ?,
            sp_age = ?, sp_bdate = ?, sp_occupation = ?, children = ?, income = ?, addedby = ? WHERE id_familyplan = ?");
            $stmt->execute([ $lname, $fname, $mi, $age,  $contact, $address, $occupation, $status, $bdate,
            $spouse, $sp_age, $sp_bdate, $sp_occupation, $children, $income, $addedby, $id_familyplan]);
            
            $message2 = "Family Plan Data Updated";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("refresh: 0");
        }
    }

    public function delete_familyplan(){
        $id_familyplan = $_POST['id_familyplan'];

        if(isset($_POST['delete_familyplan'])) {
            $connection = $this->openConn();
            $stmt = $connection->prepare("DELETE FROM tbl_familyplan where id_familyplan = ?");
            $stmt->execute([$id_familyplan]);

            header("Refresh:0");
        }
    }

    public function get_single_familyplan(){

        $id_familyplan = $_GET['id_familyplan'];

        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_familyplan where id_familyplan = ?");
        $stmt->execute([$id_familyplan]);
        $familyplan = $stmt->fetch();
        $total = $stmt->rowCount();

        if($total > 0 )  {
            return $familyplan;
        }
        else{
            return false;
        }
    }

    public function count_familyplan() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) from tbl_familyplan");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }

    //------------------------------------------ VACCINATION PROGRAM CRUD -----------------------------------------------


    public function create_vaccine() {

        if(isset($_POST['create_vaccine'])) {
            $id_resident = $_POST['id_resident'];
            $child = $_POST['child'];
            $age = $_POST['age'];
            $sex = $_POST['sex'];
            $bdate = $_POST['bdate'];
            $bplace = $_POST['bplace'];
            $address = $_POST['address'];
            $height = $_POST['height'];
            $weight = $_POST['weight'];
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mi = $_POST['mi'];
            $vaccine = $_POST['vaccine'];
            $vaccdate = $_POST['vaccdate'];
            $addedby = $_POST['addedby'];


            $connection = $this->openConn();
            $stmt = $connection->prepare("INSERT INTO tbl_vaccine (`id_resident`, 
            `child`, `age`, `sex`, `bdate`, `bplace`, `address`, `height`,  `weight`,
            `lname`, `fname`, `mi`, `vaccine`, `vaccdate`, `addedby`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->execute([$id_resident, $child, $age, $sex, $bdate, $bplace, $address, $height, $weight,
            $lname, $fname, $mi, $vaccine, $vaccdate, $addedby]);

            $message2 = "Application Applied, you will receive our text message for further details";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("refresh: 0");
        }
        
        
    }

    public function view_vaccine(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_vaccine");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function update_vaccine() {
        if (isset($_POST['update_vaccine'])) {
            $id_vaccine = $_GET['id_vaccine'];
            $child = $_POST['child'];
            $age = $_POST['age'];
            $sex = $_POST['sex'];
            $bdate = $_POST['bdate'];
            $bplace = $_POST['bplace'];
            $address = $_POST['address'];
            $height = $_POST['height'];
            $weight = $_POST['weight'];
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mi = $_POST['mi'];
            $vaccine = $_POST['vaccine'];
            $vaccdate = $_POST['vaccdate'];
            $addedby = $_POST['addedby'];


            $connection = $this->openConn();
            $stmt = $connection->prepare("UPDATE tbl_vaccine SET child = ?, age = ?, sex = ?,
            bdate = ?, bplace= ?, address = ?, height = ?, weight = ?, lname = ?, fname = ?, mi = ?, 
            vaccine = ?, vaccdate = ?, addedby = ? WHERE id_vaccine = ?");
            $stmt->execute([$child, $age, $sex, $bdate, $bplace, $address, $height, $weight,
            $lname, $fname, $mi, $vaccine, $vaccdate, $addedby, $id_vaccine]);
            
            $message2 = "Vaccination Program Data Updated";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("refresh: 0");
        }
    }

    public function delete_vaccine(){
        $id_vaccine = $_POST['id_vaccine'];

        if(isset($_POST['delete_vaccine'])) {
            $connection = $this->openConn();
            $stmt = $connection->prepare("DELETE FROM tbl_vaccine where id_vaccine = ?");
            $stmt->execute([$id_vaccine]);

            header("Refresh:0");
        }
    }

    public function get_single_vaccine(){

        $id_vaccine = $_GET['id_vaccine'];

        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_vaccine where id_vaccine = ?");
        $stmt->execute([$id_vaccine]);
        $vaccine = $stmt->fetch();
        $total = $stmt->rowCount();

        if($total > 0 )  {
            return $vaccine;
        }
        else{
            return false;
        }
    }

    public function count_vacc() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) FROM tbl_vaccine");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }

    public function count_male_vacc() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) FROM tbl_vaccine WHERE sex = 'Male'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }

    public function count_female_vacc() {
        $connection = $this->openConn();

        $stmt = $connection->prepare("SELECT COUNT(*) FROM tbl_vaccine WHERE sex = 'Female'");
        $stmt->execute();
        $rescount = $stmt->fetchColumn();

        return $rescount;
    }

    //------------------------------------------ Certificate of Residency CRUD -----------------------------------------------
    public function get_single_certofres($id_resident){

        $id_resident = $_GET['id_resident'];
        
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_rescert where id_resident = ?");
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

    public function create_certofres() {

        if(isset($_POST['create_certofres'])) {
            $id_resident = $_POST['id_resident'];
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mi = $_POST['mi'];
            $age = $_POST['age'];
            $nationality = $_POST['nationality']; 
            $houseno = $_POST['houseno'];
            $street = $_POST['street'];
            $brgy = $_POST['brgy'];
            $municipal = $_POST['municipal'];
            $date = $_POST['date'];
            $purpose = $_POST['purpose'];
            


            $connection = $this->openConn();
            $stmt = $connection->prepare("INSERT INTO tbl_rescert ( `id_resident`, `lname`, `fname`, `mi`,
             `age`,`nationality`, `houseno`, `street`,`brgy`, `municipal`, `date`,`purpose`)
            VALUES (?,?, ?, ?, ?, ?, ?, ?, ?,?,?,?)");

            $stmt->execute([$id_resident, $lname, $fname, $mi,  $age, $nationality, $houseno,  $street, $brgy,$municipal, $date,$purpose]);

            $message2 = "Application Applied, you will receive our text message for further details";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("refresh: 0");
        }
        
        
    }

    public function create_certofres_walkin() {

        if(isset($_POST['create_certofres_walkin'])) {
            $id_rescert = $_POST['id_rescert'];
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mi = $_POST['mi'];
            $age = $_POST['age'];
            $nationality = $_POST['nationality']; 
            $houseno = $_POST['houseno'];
            $street = $_POST['street'];
            $brgy = $_POST['brgy'];
            $municipal = $_POST['municipal'];
            //$date = $_POST['date'];
            //$purpose = $_POST['purpose'];
            


            $connection = $this->openConn();
            $stmt = $connection->prepare("INSERT INTO tbl_rescert (`req_status`, `lname`, `fname`, `mi`, `age`, `nationality`, `houseno`, `street`, `brgy`, `municipal`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


            $stmt->execute(['approved',$lname, $fname, $mi, $age, $nationality, $houseno, $street, $brgy, $municipal]);


            $message2 = "Application Applied!";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("refresh: 0");
        }
        
        
    }


    public function view_certofres(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_rescert");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }


    public function delete_certofres(){
        $id_rescert = $_POST['id_rescert'];

        if(isset($_POST['delete_certofres'])) {
            $connection = $this->openConn();
            $stmt = $connection->prepare("DELETE FROM tbl_rescert where id_rescert = ?");
            $stmt->execute([$id_rescert]);

            header("Refresh:0");
        }
    }

    //----------TRAVEL PERMIT CRUD-------------

    public function get_single_travelpermit($id_resident){

        $id_resident = $_GET['id_resident'];
        
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_travelpermit where id_resident = ?");
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

public function create_travelpermit() {
    if(isset($_POST['create_travelpermit'])) {
        $id_resident = $_POST['id_resident'];
        $full_name = $_POST['prev_owner']; // Assuming you named the combined field as 'fullname'
        list($surname, $firstname) = explode(', ', $full_name);
        $prev_owner = $surname . ' ' . $firstname;

        $breed = $_POST['breed'];
        $gender = $_POST['gender'];
        $color = $_POST['color'];
        $destination = $_POST['destination']; 
        $brgy = $_POST['brgy'];
        $municipal = $_POST['municipal'];
        $buyers_name = $_POST['buyers_name'];
        $purpose = $_POST['purpose'];
        
        try {
            $connection = $this->openConn();
            $current_date = date('Y-m-d H:i:s'); // Get current date and time
            $stmt = $connection->prepare("INSERT INTO tbl_travelpermit (`id_travel`, `id_resident`, `prev_owner`, `breed`, `gender`,
             `color`, `destination`, `date`, `brgy`, `municipal`, `buyers_name`, `purpose`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([null, $id_resident, $prev_owner, $breed, $gender, $color, $destination, $current_date, $brgy, $municipal, $buyers_name, $purpose]);

            $message2 = "Application Applied, you will receive our text message for further details";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("refresh: 0");
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}


    public function view_travelpermit(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_travelpermit");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }


    public function delete_travelpermit(){
        $id_travel = $_POST['id_travel'];

        if(isset($_POST['delete_travelpermit'])) {
            $connection = $this->openConn();
            $stmt = $connection->prepare("DELETE FROM tbl_travelpermit where id_travel = ?");
            $stmt->execute([$id_travel]);

            header("Refresh:0");
        }
    }

     //------------------------------------------ CERT OF INIDIGENCY CRUD -----------------------------------------------

     public function create_certofindigency() {

        if(isset($_POST['create_certofindigency'])) {
            $id_resident = $_POST['id_resident'];
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mi = $_POST['mi'];
            $nationality = $_POST['nationality']; 
            $houseno = $_POST['houseno'];
            $street = $_POST['street'];
            $brgy = $_POST['brgy'];
            $municipal = $_POST['municipal'];
            $purpose = $_POST['purpose'];
            $date = $_POST['date'];

            $connection = $this->openConn();
            $stmt = $connection->prepare("INSERT INTO tbl_indigency (`id_resident`, `lname`, `fname`, `mi`,
             `nationality`, `houseno`, `street`,`brgy`, `municipal`,`purpose`, `date`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");

            $stmt->execute([$id_resident, $lname, $fname, $mi,  $nationality, $houseno,  $street, $brgy, $municipal,$purpose, $date]);

            $message2 = "Application Applied, you will receive our text message for further details";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("refresh: 0");
        }
        
        
    }


    

    public function view_certofindigency(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_indigency");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }


    public function delete_certofindigency(){
        $id_indigency = $_POST['id_indigency'];

        if(isset($_POST['delete_certofindegency'])) {
            $connection = $this->openConn();
            $stmt = $connection->prepare("DELETE FROM tbl_indigince where id_indigency = ?");
            $stmt->execute([$id_indigency]);

            header("Refresh:0");
        }
    }

    public function get_single_certofindigency($id_resident){

        $id_resident = $_GET['id_resident'];
        
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_indigency where id_resident = ?");
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


     //------------------------------------------ BRGY CLEARANCE CRUD -----------------------------------------------

     public function create_brgyclearance() {

        if(isset($_POST['create_brgyclearance'])) {
            $id_resident = $_POST['id_resident'];
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mi = $_POST['mi'];
            $purpose = $_POST['purpose'];
            $houseno = $_POST['houseno'];
            $street = $_POST['street'];
            $brgy = $_POST['brgy'];
            $municipal = $_POST['municipal'];
            $status = $_POST['status'];
            $age = $_POST['age'];
            
            $connection = $this->openConn();
            $stmt = $connection->prepare("INSERT INTO tbl_clearance (`id_resident`, `lname`, `fname`, `mi`,
             `purpose`, `houseno`, `street`,`brgy`, `municipal`, `status`, `age`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->execute([$id_resident, $lname, $fname, $mi,  $purpose, 
            $houseno,  $street, $brgy,   $municipal, $status, $age]);

            $message2 = "Application Applied, you will receive our text message for further details";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("refresh: 0");
        }
        
        
    }

    public function get_single_clearance($id_resident){

        $id_resident = $_GET['id_resident'];
        
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_clearance where id_resident = ?");
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


    public function view_clearance(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_clearance");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }


    public function delete_clearance(){
        $id_clearance = $_POST['id_clearance'];

        if(isset($_POST['delete_clearance'])) {
            $connection = $this->openConn();
            $stmt = $connection->prepare("DELETE FROM tbl_clearance where id_clearance = ?");
            $stmt->execute([$id_clearance]);

            header("Refresh:0");
        }
    }

    





    
    //------------------------------------------ EXTRA FUNCTIONS ----------------------------------------------

    public function check_admin($email) {

        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_admin WHERE email = ?");
        $stmt->Execute([$email]);
        $total = $stmt->rowCount(); 

        return $total;
    }

    //eto yung function na mag bibigay restriction sa mga admin pages
    public function validate_admin(){
        $userdetails = $this->get_userdata();

        if (isset($userdetails)) {
            
            if($userdetails['role'] != "administrator") {
                $this->show_404();
            }

            else {
                return $userdetails;
            }
        }
    }

    public function validate_staff() {

        if(isset($userdetails)) {
            if($userdetails['role'] != "administrator" || $userdetails['role'] != "user") {
                $this->show_404();
            }

            else {
                return $userdetails;
            }
        }
    }


    //----------------------------------------- DOCUMENT PROCESSING FUNCTIONS -------------------------------------
    //-------------------------------------------------------------------------------------------------------------

    public function create_bspermit() {

        if(isset($_POST['create_bspermit'])) {
            $id_resident = $_POST['id_resident'];
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mi = $_POST['mi'];
            $age = $_POST['age'];
            $bsname = $_POST['bsname']; 
            $houseno = $_POST['houseno'];
            $street = $_POST['street'];
            $brgy = $_POST['brgy'];
            $municipal = $_POST['municipal'];
            $bsindustry = $_POST['bsindustry'];
            $aoe = $_POST['aoe'];


            $connection = $this->openConn();
            $stmt = $connection->prepare("INSERT INTO tbl_bspermit (`id_resident`, `req_status`, `lname`, `fname`, `mi`, `age`,
             `bsname`, `houseno`, `street`,`brgy`, `municipal`, `bsindustry`, `aoe`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->execute([$id_resident, 'approved', $lname, $fname, $mi, $age, $bsname, $houseno,  $street, $brgy, $municipal, $bsindustry, $aoe]);

            $message2 = "Application Applied, you will receive our text message for further details";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("refresh: 0");
        }
        
        
    }

    public function create_bspermit_walkin() {

        if(isset($_POST['create_bspermit_walkin'])) {
            $id_bspermit = $_POST['id_bspermit'];
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mi = $_POST['mi'];
            $age = $_POST['age'];
            $status = $_POST['status'];
            $bsname = $_POST['bsname']; 
            //$houseno = $_POST['houseno'];
            //$street = $_POST['street'];
            $brgy = $_POST['brgy'];
            $municipal = $_POST['municipal'];
            $bsindustry = $_POST['bsindustry'];
            //$aoe = $_POST['aoe'];


            $connection = $this->openConn();
            $stmt = $connection->prepare("INSERT INTO tbl_bspermit (`req_status`, `lname`, `fname`, `mi`, `age`, `status`,
             `bsname`, `brgy`, `municipal`, `bsindustry`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->execute(['approved', $lname, $fname, $mi, $age, $status, $bsname, $brgy, $municipal, $bsindustry]);

            $message2 = "Application Applied!";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("refresh: 0");
        }
        
        
    }


    public function get_single_bspermit($id_resident){

        $id_resident = $_GET['id_resident'];
        
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_bspermit where id_resident = ?");
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

    public function get_single_bspermit_walkin($id_bspermit){

        $id_bspermit = $_GET['id_bspermit'];
        
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_bspermit where id_bspermit = ?");
        $stmt->execute([$id_bspermit]);
        $resident = $stmt->fetch();
        $total = $stmt->rowCount();

        if($total > 0 )  {
            return $resident;
        }
        else{
            return false;
        }
    }

    public function view_bspermit(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_bspermit WHERE req_status = 'approved'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }

    public function view_bspermit_archive(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_bspermit WHERE req_status = 'archived'");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }


    public function delete_bspermit(){
        $id_bspermit = $_POST['id_bspermit'];

        if(isset($_POST['delete_bspermit'])) {
            $connection = $this->openConn();
            $stmt = $connection->prepare("DELETE FROM tbl_bspermit where id_bspermit = ?");
            $stmt->execute([$id_bspermit]);

            header("Refresh:0");
        }
    }

    public function archive_bspermit(){
        $id_bspermit = $_POST['id_bspermit'];

        if(isset($_POST['archive_bspermit'])) {
            $connection = $this->openConn();
            $stmt = $connection->prepare("UPDATE tbl_bspermit SET req_status = 'archived' where id_bspermit = ?");
            $stmt->execute([$id_bspermit]);

            $message2 = "Barangay Business Permit Data Archived";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("Refresh:0");
        }
    }

    public function approve_bspermit(){
        $id_bspermit = $_POST['id_bspermit'];

        if(isset($_POST['approve_bspermit'])) {
            $connection = $this->openConn();
            $stmt = $connection->prepare("UPDATE tbl_bspermit SET req_status = 'approved' where id_bspermit = ?");
            $stmt->execute([$id_bspermit]);

            $message2 = "Restored Successfully";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("Refresh:0");
        }
    }

    public function update_bspermit() {
        if (isset($_POST['update_bspermit'])) {
            $id_bspermit = $_GET['id_bspermit'];
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mi = $_POST['mi'];
            $bsname = $_POST['bsname']; 
            $houseno = $_POST['houseno'];
            $street = $_POST['street'];
            $brgy = $_POST['brgy'];
            $municipal = $_POST['municipal'];
            $bsindustry = $_POST['bsindustry'];
            $aoe = $_POST['aoe'];


            $connection = $this->openConn();
            $stmt = $connection->prepare("UPDATE tbl_bspermit SET lname = ?, fname = ?,
            mi = ?, bsname = ?, houseno = ?, street = ?, brgy = ?, municipal = ?,
            bsindustry = ?, aoe = ? WHERE id_bspermit = ?");
            $stmt->execute([$id_bspermit, $lname, $fname, $mi,  $bsname, $houseno,  $street, $brgy, $municipal, $bsindustry, $aoe]);
            
            $message2 = "Barangay Business Permit Data Updated";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("refresh: 0");
        }
    }




    public function create_brgyid() {
        if(isset($_POST['create_brgyid'])) {
            
            $res_photo_path = '';
            $inc_municipal_path = ''; 
            
            if(isset($_FILES['res_photo']['tmp_name']) && !empty($_FILES['res_photo']['tmp_name'])) {
                $res_photo_path = $_SERVER['DOCUMENT_ROOT'] . '/gallery_photo/' . $_FILES['res_photo']['name'];
                move_uploaded_file($_FILES['res_photo']['tmp_name'], $res_photo_path);
            }
            
            if(isset($_FILES['inc_municipal']['tmp_name']) && !empty($_FILES['inc_municipal']['tmp_name'])) {
                $inc_municipal_path = $_SERVER['DOCUMENT_ROOT'] . '/gallery_photo/' . $_FILES['inc_municipal']['name'];
                move_uploaded_file($_FILES['inc_municipal']['tmp_name'], $inc_municipal_path);
            }
            
            
            $id_resident = $_POST['id_resident'];
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mi = $_POST['mi']; 
            $houseno = $_POST['houseno'];
            $street = $_POST['street'];
            $brgy = $_POST['brgy'];
            $municipal = $_POST['municipal'];
            $bplace = $_POST['bplace'];
            $bdate = $_POST['bdate'];
            $res_photo = $_FILES['res_photo'];

            $inc_lname = $_POST['inc_lname']; 
            $inc_fname = $_POST['inc_fname'];
            $inc_mi = $_POST['inc_mi'];
            $inc_contact = $_POST['inc_contact'];
            $inc_houseno = $_POST['municipal'];
            $inc_street = $_POST['bplace'];
            $inc_brgy = $_POST['bdate'];
            $inc_municipal = $_FILES['res_photo'];

            $connection = $this->openConn();
            $stmt = $connection->prepare("INSERT INTO tbl_brgyid (`id_resident`, `lname`, `fname`, `mi`,
            `houseno`, `street`,`brgy`, `municipal`, `bplace`, `bdate`, `res_photo`, `inc_lname`,
            `inc_fname`, `inc_mi`, `inc_contact`, `inc_houseno`, `inc_street`, `inc_brgy`, `inc_municipal`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->execute([$id_resident, $lname, $fname, $mi, $houseno, $street, $brgy, $municipal, 
            $bplace, $bdate, $res_photo_path, $inc_lname, $inc_fname, $inc_mi, $inc_contact, 
            $inc_houseno, $inc_street, $inc_brgy, $inc_municipal_path ]);


            $message2 = "Application Applied, you will receive our text message for further details";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("refresh: 0");
        }  
    }

    public function get_single_brgyid($id_resident){

        $id_resident = $_GET['id_resident'];
        
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_brgyid where id_resident = ?");
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


    public function view_brgyid(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_brgyid");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }


    public function delete_brgyid(){
        $id_bspermit = $_POST['id_brgyid'];

        if(isset($_POST['delete_brgyid'])) {
            $connection = $this->openConn();
            $stmt = $connection->prepare("DELETE FROM tbl_brgyid where id_brgyid = ?");
            $stmt->execute([$id_bspermit]);

            header("Refresh:0");
        }
    }







    public function create_blotter() {
        if (isset($_POST['create_blotter'])) {
            
            $blot_photo = null;
            if (isset($_FILES['blot_photo']['tmp_name']) && !empty($_FILES['blot_photo']['tmp_name'])) {
                // Get the image data
                $blot_photo = file_get_contents($_FILES['blot_photo']['tmp_name']);
            }
    
            $id_blotter = isset($_POST['id_blotter']) ? $_POST['id_blotter'] : null;
            $id_resident = $_POST['id_resident'];
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mi = $_POST['mi'];
            $houseno = $_POST['houseno'];
            $street = $_POST['street'];
            $brgy = $_POST['brgy'];
            $municipal = $_POST['municipal'];
            $contact = $_POST['contact'];
            $narrative = $_POST['narrative'];
            
            $connection = $this->openConn();
            $stmt = $connection->prepare("INSERT INTO tbl_blotter (`id_blotter`, `id_resident`, `lname`, `fname`, `mi`,
                `houseno`, `street`, `brgy`, `municipal`, `blot_photo`, `contact`, `narrative`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            // Bind parameters, using PDO::PARAM_LOB for the BLOB data
            $stmt->bindParam(1, $id_blotter);
            $stmt->bindParam(2, $id_resident);
            $stmt->bindParam(3, $lname);
            $stmt->bindParam(4, $fname);
            $stmt->bindParam(5, $mi);
            $stmt->bindParam(6, $houseno);
            $stmt->bindParam(7, $street);
            $stmt->bindParam(8, $brgy);
            $stmt->bindParam(9, $municipal);
            $stmt->bindParam(10, $blot_photo, PDO::PARAM_LOB);
            $stmt->bindParam(11, $contact);
            $stmt->bindParam(12, $narrative);
            
            // Execute statement
            $stmt->execute();
    
            $message2 = "Application Applied, you will receive our text message for further details";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("refresh: 0");
        }
    }
    

    public function get_single_blotter($id_resident){

        $id_resident = $_GET['id_resident'];
        
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * FROM tbl_blotter where id_resident = ?");
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
   

    public function view_blotter(){
        $connection = $this->openConn();
        $stmt = $connection->prepare("SELECT * from tbl_blotter");
        $stmt->execute();
        $view = $stmt->fetchAll();
        return $view;
    }


    public function delete_blotter(){
        $id_blotter = $_POST['id_blotter'];

        if(isset($_POST['delete_blotter'])) {
            $connection = $this->openConn();
            $stmt = $connection->prepare("DELETE FROM tbl_blotter where id_blotter = ?");
            $stmt->execute([$id_blotter]);

            header("Refresh:0");
        }
    }

    public function update_blotter() {
        if (isset($_POST['update_bspermit'])) {
            $id_bspermit = $_GET['id_bspermit'];
            $lname = $_POST['lname'];
            $fname = $_POST['fname'];
            $mi = $_POST['mi'];
            $houseno = $_POST['houseno'];
            $street = $_POST['street'];
            $brgy = $_POST['brgy'];
            $municipal = $_POST['municipal'];
            $blot_photo = $_POST['blot_photo'];
            $contact = $_POST['contact'];
            $narrative = $_POST['narrative'];


            $connection = $this->openConn();
            $stmt = $connection->prepare("UPDATE tbl_blotter SET lname = ?, fname = ?,
            mi = ?, bsname = ?, houseno = ?, street = ?, brgy = ?, municipal = ?,
            bsindustry = ?, aoe = ? WHERE id_blotter = ?");
            $stmt->execute([$id_bspermit, $lname, $fname, $mi, $houseno,  
            $street, $brgy, $municipal, $blot_photo, $contact, $narrative]);
            
            $message2 = "Complain/Blotter Data Updated";
            echo "<script type='text/javascript'>alert('$message2');</script>";
            header("refresh: 0");
        }
    }

    

}

    

$bmis = new BMISClass(); //variable to call outside of its class

?>
