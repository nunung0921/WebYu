<?php 
    error_reporting(E_ALL ^ E_WARNING);
    
    if(!isset($_SESSION)) {
        $showdate = date("Y-m-d");
        date_default_timezone_set('Asia/Manila');
        $showtime = date("h:i:a");
        $_SESSION['storedate'] = $showdate;
        $_SESSION['storetime'] = $showdate;
        session_start();
    }

    //include('autoloader.php');
    require('classes/main.class.php');
    $bmis->login();

   // Function to generate OTP
function generateOTP() {
    // Generate a random 6-digit OTP
    $otp = rand(100000, 999999);
    return $otp;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Barangay Yuson Information Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index1.css" type="text/css">
    <script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
    <script src="customjs/main.js" type="text/javascript"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="shortcut icon" href="icons/yuson1.png" type="">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        body {
            background: url('icons/bgg.jpg') fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .logo-container {
            text-align: center;
            margin-top: 30px;
            border-radius: 10px;
        }

        .logo {
            max-width: 80%;
            height: auto;
        }

        .title-text {
            font-size: 24px;
            color: #000000;
            margin-top: 10px;
            font-weight: bold;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
        }

        .input-container .icon {
            padding: 10px;
            background: dodgerblue;
            color: white;
            min-width: 50px;
            text-align: center;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }

  .input-container .input-field {
    width: 85%;
    height: 40px;
    padding: 10px;
    outline: none;
    border: 1px solid #ccc;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
}

        .login-button {
            margin-top: 20px;
            width: 100%;
        }

        .registration-section {
            text-align: center;
            margin-top: 20px;
        }

        .create-button {
            background-color: #28a745;
            border: none;
        }

        .create-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<section class="main-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 logo-container">
                <img src="icons/yuson1.png" alt="Logo" class="logo">
            </div>
            <div class="col-md-6 form-container">
                <div class="card main-card mt-3">
                    <div class="card-body">
                        <form method="post" class="input-container">
                            <div class="mb-3">
                            <center><p class="title-text">Barangay Yuson Information Management System</p></center>
                            <label for="email" class="form-label"><b>Email:</b></label>
                            <div class="input-container">
                                <i class="fa fa-envelope icon"></i>
                                <input class="input-field" type="email" id="email" placeholder="Enter Email" name="email" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label"><b>Password:</b></label>
                            <div class="input-container">
                                <i class="fa fa-key icon"></i>
                                <input class="input-field" type="password" id="password" placeholder="Enter Password" name="password" required>
                            </div>
                        </div>
                     
                            <div class="mb-3">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" onclick="myFunction()" class="custom-control-input" id="switch1">
                                    <label class="custom-control-label" for="switch1">Show Password</label>
                                </div>
                            </div>
                            <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6LfHLcApAAAAAKyOyOJFNkXUBEuFLxx6qn8DbnHT"></div>
                </div>
                            <button class="btn btn-primary login-button" type="submit" name="login">Log-in</button>
                        </form>

                        <hr>

                        <div class="registration-section">
                            <p1><strong>Haven't registered yet?</strong></p1><br>
                            <p1>Hindi ka pa rehistrado?</p1><br>
                            <button class="btn btn-success create-button" onclick="trying();">Create Account</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    function trying() {
        window.location.href = "resident_registration.php";
    }
</script>
<script>
    $(document).ready(function(){
        end_loader();
    });

    $(document).on('click', '.login-button', function(e){
        var response = grecaptcha.getResponse();
        if(response.length === 0) {
            alert("Please verify that you are not a robot");
            e.preventDefault(); // Prevent form submission if reCAPTCHA is not checked
        }
    });
</script>

</body>
</html>
