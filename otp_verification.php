<!-- otp_verification.php -->
<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
    <style>
        .center {
            text-align: center;
            margin-top: 20px; /* Add margin to center the container vertically */
        }

        .container {
            width: 300px; /* Adjust the width of the container as needed */
            margin: 0 auto; /* Center the container horizontally */
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Style for the form */
        form {
            margin-top: 20px; /* Add margin to separate the form from the heading */
        }

        /* Style for form inputs */
        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        /* Style for the submit button */
        form button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Style for the submit button on hover */
        form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="center">
        <div class="container">
            <h2>Enter OTP:</h2>
            <form method="post">
                <div>
                    
                    <input type="text" id="otp" name="otp" required placeholder="Enter OTP">
                </div>
                <br>
                <button type="submit" name="verify_otp">Verify OTP</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php
require('classes/resident.class.php');
$residentbmis->create_resident();
session_start();

// Check if OTP verification is successful
if(isset($_POST['verify_otp'])) {
    if(isset($_SESSION['otp']) && $_POST['otp'] == $_SESSION['otp']) {
        // OTP matched, proceed with registration
        // Clear session variables
        unset($_SESSION['otp']);
        unset($_SESSION['email']);
        
        // JavaScript code to show custom alert dialog
      echo '<script>
                // Define a function to show the custom alert
                function showAlert() {
                    // Create a div element for the alert
                    var alertBox = document.createElement("div");
                    alertBox.innerHTML = "<p style=\"text-align: center;\">OTP verification successful!</p><button onclick=\"continueToLogin()\" name="add_resident">Continue to Login</button>";
                    alertBox.style.position = "fixed";
                    alertBox.style.top = "50%";
                    alertBox.style.left = "50%";
                    alertBox.style.transform = "translate(-50%, -50%)";
                    alertBox.style.background = "#f5f5f5";
                    alertBox.style.padding = "20px";
                    alertBox.style.border = "1px solid #ccc";
                    alertBox.style.borderRadius = "5px";
                    document.body.appendChild(alertBox);
                }

                // Define a function to redirect to login.php
                function continueToLogin() {
                    window.location.href = "index_login.php";
                }

                // Call the function to show the custom alert
                showAlert();
            </script>';
    } else {
        // OTP did not match
        echo 'Invalid OTP. Please try again.';
    }
}
?>
