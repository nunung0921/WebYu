<?php 

ini_set('display_errors', 1);
error_reporting(E_ALL);
require('classes/resident.class.php');
$residentbmis->create_resident();
/*$residentbmis = new ResidentClass(); // Instantiate the ResidentClass object

// Assuming $addedby contains the appropriate value
$addedby = ''; // Add your value here

// Call the create_resident() method with the $addedby parameter
$residentbmis->create_resident($addedby);
//$data = $bms->get_userdata();

/*if(isset($_POST['add_resident']) && isset($_POST['email'])) {
    // Generate OTP
    $otp = rand(100000, 999999); // Generate a 6-digit OTP

    // Send OTP via email
    $to = $_POST['email'];
    $subject = 'OTP for Registration';
    $message = 'Your OTP for registration is: ' . $otp;
    $headers = 'From: webyu@webyu.online'; // Replace with your email address

    if(mail($to, $subject, $message, $headers)) {
        // Set OTP in session to verify later
        session_start();
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $_POST['email'];

        // Redirect user to OTP verification page
        header('Location: otp_verification.php');
        exit();
    } else {
        echo 'Failed to send OTP. Please try again.';
    }
}*/
?>

<!DOCTYPE html> 
<html> 
    <head> 
        <link rel="shortcut icon" href="icons/yuson1.png" type="">
        <title> Barangay Yuson Information Management System </title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous"></script>
        <!-- responsive tags for screen compatibility -->
        <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
        <!-- bootstrap css --> 
        <link href="design.css" rel="stylesheet" type="text/css"> 
        
        <!-- fontawesome icons -->
        <script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>

    <style>
        
        .field-icon {
        margin-left: 74%;
        margin-top: -8%;
        position: absolute;
        z-index: 2;
        }
        
        .navbar-brand img {
            max-height: 40px; /* Adjust the maximum height of the logo */
            margin-right: 5px; /* Adjust margin to separate logo from text */
              body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    #footer {
        margin-top: auto;
    }
    </style>
    
    <body >

        <!-- eto yung navbar -->
      <nav class="navbar navbar-dark bg-primary sticky-top">
            <a class="navbar-brand" href="login.php">
                <img src="icons/yuson1.png" alt="Yuson Logo"> <!-- Add your logo here -->
                Barangay Yuson Information Management System
            </a>
        </nav>

    
        <div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Registration Form</h1>
            <br>
        </div>
    </div>

    <div class="row margin mtop"> 
        <div class="col-sm"></div>

        <div class="col-sm-8">   
            <div class="card mbottom" style="margin-bottom: 3em;">
                <div class="card-body" >
                    <form method="post" enctype='multipart/form-data' class="was-validated">

                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label>Last Name:</label>
                                    <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" pattern="[A-Za-z ]{2,}" title="Please enter at least 2 letters, and only use letters." required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="form-group">
                                    <label>First Name:</label>
                                    <input type="text" class="form-control" name="fname" placeholder="Enter First Name" pattern="[A-Za-z ]{4,}" title="Please enter at least 2 letters, and only use letters." required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="form-group">
                                    <label>Middle Name:</label>
                                    <input type="text" class="form-control" name="mi" placeholder="Enter Middle Name" pattern="[A-Za-z ]{2,}" title="Please enter at least 2 letters, and only use letters." required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                        </div>

                        <div class="row"> 
                            <div class="col-md">
                                <div class="form-group">
                                    <label>Contact Number:</label>
                                    <input type="tel" class="form-control" name="contact" maxlength="11" pattern="09[0-9]{9}" placeholder="Enter Contact Number" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter Email" required oninput="validateEmail()">
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please enter a valid email address ending with '@gmail.com'.</div>
                                </div>
                            </div>

                            <div class="col-md">
                                <div class="form-group">
                                    <label>Password:</label>
                                    <input type="password" class="form-control" id="password-field" name="password" placeholder="Enter Password" minlength="8" maxlength="16" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@_#*])[A-Za-z\d@_#*]{8,16}$" title="Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, one number, and one special character (!@#$%^&*()_+)" required>
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                        </div>

                        <!-- Repeat the responsive row and column structure for the remaining form fields -->

                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Are you a registered voter?</label>
                                    <select class="form-control" name="voter" id="regvote" required>
                                        <option value="">...</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Are you head of the family?</label>
                                    <select class="form-control" name="family_role" id="famhead" required>
                                        <option value="">...</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" class="form-control" name="role" value="resident">
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-primary btn-block" type="submit" name="add_resident">Submit</button>
                            </div>
                            <div class="col">
                                <a class="btn btn-danger btn-block" href="index_login.php">Back to Login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
        <div class="col-sm"></div>
    </div>
</div>


        <!-- Footer -->

        <footer id="footer" class="bg-primary text-white d-flex-column text-center">

            <!--Copyright-->

            <div class="py-3 text-center" style="color:white;">
            Copyright 2023 
            <script>
            document.write(new Date().getFullYear())
            </script> 
              | <a href="dev.html" style="color:white;">WebYu Team</a>
        </div>

        </footer>

        <script>
            $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
            input.attr("type", "text");
            } else {
            input.attr("type", "password");
            }
            });

            function calculateAge() {
        var birthdate = document.getElementById('birthdate').value;
        var today = new Date();
        var birthdateObj = new Date(birthdate);
        var age = today.getFullYear() - birthdateObj.getFullYear();

        // Check if the birthday has occurred this year
        if (today.getMonth() < birthdateObj.getMonth() || (today.getMonth() === birthdateObj.getMonth() && today.getDate() < birthdateObj.getDate())) {
            age--;
        }

        // Update the "Age" input field
        document.getElementById('age').value = age;
    }
        </script>
        <script>
    function validateEmail() {
        var input = document.getElementsByName('email')[0];
        var pattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
        if (pattern.test(input.value)) {
            input.setCustomValidity('');
        } else {
            input.setCustomValidity("Please enter a valid email address ending with '@gmail.com'.");
        }
    }
</script>
        <script src="bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>
    </body>
</html>