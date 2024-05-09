<?php 
require('classes/resident.class.php');
$residentbmis = new ResidentClass(); // Instantiate the ResidentClass object

// Assuming $addedby contains the appropriate value
$addedby = ''; // Add your value here

// Call the create_resident() method with the $addedby parameter
$residentbmis->create_resident($addedby);
//$data = $bms->get_userdata();

if(isset($_POST['add_resident']) && isset($_POST['email'])) {
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
}
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

    
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center">Registration Form</h1>
                    <br>
                </div>
            </div>

            <div class="row margin mtop"> 
                <div class="col-sm"> </div>

                <div class="col-sm-8">   
                    <div class="card mbottom" style="margin-bottom: 3em;">
                        <div class="card-body" >
                            <form method="post" enctype='multipart/form-data' class="was-validated">

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label> Last Name: </label>
                                            <input type="text" class="form-control" name="lname"  placeholder="Enter Last Name" pattern="[A-Za-z ]{2,}" title="Please enter at least 2 letters, and only use letters." required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="mtop" >First Name: </label>
                                            <input type="text" class="form-control" name="fname"  placeholder="Enter First Name" pattern="[A-Za-z ]{4,}" title="Please enter at least 2 letters, and only use letters." required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col"> 
                                        <div class="form-group">
                                            <label class="mtop"> Middle Name: </label>
                                            <input type="text" class="form-control" name="mi" placeholder="Enter Middle Name" pattern="[A-Za-z ]{2,}" title="Please enter at least 2 letters, and only use letters." required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row"> 
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="mtop">Contact Number:</label>
                                            <input type="tel" class="form-control" name="contact" maxlength="11" pattern="09[0-9]{9}" placeholder="Enter Contact Number" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
    <div class="form-group">
        <label>Email: </label>
        <input type="email" class="form-control" name="email" placeholder="Enter Email" required oninput="validateEmail()">
        <div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please enter a valid email address ending with '@gmail.com'.</div>
    </div>
</div>
                                    
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Password:</label>
                                            <input type="password" class="form-control" id="password-field" name="password" placeholder="Enter Password" minlength="8" maxlength="16" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@_#*])[A-Za-z\d@_#*]{8,16}$" required>
                                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label> House No: </label>
                                            <input type="text" class="form-control" name="houseno"  placeholder="Enter House No." maxlength="3" pattern="\d{3}" title="Please enter exactly 3 numbers." required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label> Street: </label>
                                            <select class="form-control" name="street" placeholder="Enter Purok" required>
                                            <option value="">Select Purok</option>
                                                <option value="Purok 1">Purok 1</option>
                                                <option value="Purok 2">Purok 2</option>
                                                <option value="Purok 3">Purok 3</option>
                                                <option value="Purok 4">Purok 4</option>
                                                <option value="Purok 5">Purok 5</option>
                                                <option value="Purok 6">Purok 6</option>
                                                <option value="Purok 7">Purok 7</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label> Barangay: </label>
                                            <input type="text" class="form-control" name="brgy"  value="Yuson" readonly required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label> Municipality: </label>
                                            <input type="text" class="form-control" name="municipal" value="Guimba" readonly required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                    <div class="form-group">
        <label class="mtop">Birth Date: </label>
        <input type="date" class="form-control" name="bdate" id="birthdate" oninput="calculateAge()" required>
        <div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label class="mtop">Birth Place </label>
                                            <input type="text" class="form-control" name="bplace"  placeholder="Enter Birth Place" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label class="mtop">Nationality:</label>
                                            <select class="form-control" name="nationality" onchange="updateNationality(this.value)" required>
                                                <option value="American">American</option>
                                                <option value="Australian">Australian</option>
                                                <option value="Brazilian">Brazilian</option>
                                                <option value="British">British</option>
                                                <option value="Canadian">Canadian</option>
                                                <option value="Chinese">Chinese</option>
                                                <option value="Filipino" selected>Filipino</option>
                                                <option value="French">French</option>
                                                <option value="German">German</option>
                                                <option value="Indian">Indian</option>
                                                <option value="Indonesian">Indonesian</option>
                                                <option value="Italian">Italian</option>
                                                <option value="Japanese">Japanese</option>
                                                <option value="Korean">Korean</option>
                                                <option value="Malaysian">Malaysian</option>
                                                <option value="Russian">Russian</option>
                                                <option value="Spanish">Spanish</option>
                                                <option value="Thai">Thai</option>
                                                <option value="Vietnamese">Vietnamese</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col"> 
                                        <div class="form-group">
                                            <label>Status: </label>
                                            <select class="form-control" name="status" id="status" required>
                                                <option value="">Choose your Status</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Widowed">Widowed</option>
                                                <option value="Divorced">Divorced</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                    <div class="form-group">
        <label>Age</label>
        <input class="form-control" name="age" id="age"  required readonly>
                                        </div>
                                    </div>

                                    <div class="col rb">
                                        <div class="form-group">
                                            <label class="mtop">Sex</label>
                                            <select class="form-control" name="sex" id="sex" required>
                                                <option value="">Choose your Sex</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>         
                                </div>

                                <div class="row">
                                  
                                    <div class="col"> 
                                        <div class="form-group">
                                            <label>Are you a registered voter? </label>
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
                                            <label>Are you head of the family? </label>
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
                                <div class="form-group">

                                </div>
                                <br>
                                
                                <input type="hidden" class="form-control" name="role" value="resident">
                                <a style="width: 130px; margin-left:35%;" class="btn btn-danger" href="index_login.php"> Back to Login</a>
                                <form action="index.php" method="post">
                                <button style="width: 130px;" class="btn btn-primary" type="submit" name="add_resident" href="login.php"> Submit  </button>
                                
                            </form>
                        </div>
                    </div> 
                </div>
                <div class="col-sm"> </div>
            </div>
        </div>

        <!-- Footer -->

        <footer id="footer" class="bg-primary text-white d-flex-column text-center">

            <!--Copyright-->

            <div class="py-3 text-center">
              2023 - 
                <script>
                document.write(new Date().getFullYear())
                </script> 
                | Barangay Yuson Information Management System
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

