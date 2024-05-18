<?php 
error_reporting(E_ALL ^ E_WARNING);
require('classes/resident.class.php');

if(isset($_POST['resident_changepass'])) {
    $oldpassword = $_POST['oldpassword'];
    $password1 = $_POST['password1'];
    $checkpassword = $_POST['checkpassword'];

    // Siguraduhing ang bagong password ay parehong sa confirm password
    if($password1 != $checkpassword) {
        echo "New password and confirm password do not match!";
    } else {
        // Kapag parehong sila, i-update ang password sa database
        $update_result = $residentbmis->update_password($oldpassword, $password1);
        
        if($update_result) {
            echo "Password successfully updated!";
            // Redirect or do something after successful password update
        } else {
            echo "Failed to update password. Please try again!";
        }
    }
}

$userdetails = $residentbmis->get_userdata();
?>

?>


<!DOCTYPE html> 
<html>

    <head> 
    <link rel="shortcut icon" href="icons/yuson1.png" type="">
    <title> Barangay Yuson Information Management System </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <!-- responsive tags for screen compatibility -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- custom css --> 
        <link href="customcss/pagestyle.css" rel="stylesheet" type="text/css">
        <!-- bootstrap css --> 
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
        <!-- fontawesome icons --> 
        <script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />

    <style>

        /* Back-to-Top */

        .top-link {
        transition: all 0.25s ease-in-out;
        position: fixed;
        bottom: 0;
        right: 0;
        display: inline-flex;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        margin: 0 3em 3em 0;
        border-radius: 50%;
        padding: 0.25em;
        width: 80px;
        height: 80px;
        background-color: #3661D5;
        }
        .top-link.show {
        visibility: visible;
        opacity: 1;
        }
        .top-link.hide {
        visibility: hidden;
        opacity: 0;
        }
        .top-link svg {
        fill: white;
        width: 24px;
        height: 12px;
        }
        .top-link:hover {
        background-color: #3498DB;
        }
        .top-link:hover svg {
        fill: #000000;
        }

        .screen-reader-text {
        position: absolute;
        clip-path: inset(50%);
        margin: -1px;
        border: 0;
        padding: 0;
        width: 1px;
        height: 1px;
        overflow: hidden;
        word-wrap: normal !important;
        clip: rect(1px, 1px, 1px, 1px);
        }
        .screen-reader-text:focus {
        display: block;
        top: 5px;
        left: 5px;
        z-index: 100000;
        clip-path: none;
        background-color: #eee;
        padding: 15px 23px 14px;
        width: auto;
        height: auto;
        text-decoration: none;
        line-height: normal;
        color: #444;
        font-size: 1em;
        clip: auto !important;
        }

        /* Navbar Buttons */

        .btn3 {
        border-radius: 20px;
        border: none; /* Remove borders */
        color: white; /* White text */
        font-size: 16px; /* Set a font size */
        cursor: pointer; /* Mouse pointer on hover */
        margin-left: 23%;
        padding: 8px 22px;
        }

        .btn4 {
        border-radius: 20px;
        border: none; /* Remove borders */
        color: white; /* White text */
        font-size: 16px; /* Set a font size */
        cursor: pointer; /* Mouse pointer on hover */
        padding: 8px 22px;
        margin-left: .1%;
        }

        .btn5 {
        border-radius: 20px;
        border: none; /* Remove borders */
        color: white; /* White text */
        font-size: 16px; /* Set a font size */
        cursor: pointer; /* Mouse pointer on hover */
        padding: 8px 22px;
        margin-left: .1%;
        }

        /* Darker background on mouse-over */
        .btn3:hover {
        background-color: RoyalBlue;
        color: black;
        }

        .btn4:hover {
        background-color: RoyalBlue;
        color: black;
        }

        .btn5:hover {
        background-color: RoyalBlue;
        color: black;
        }
    
      /* General Styles */
.input-container {
    display: flex;
    align-items: center;
    width: 100%;
    margin-bottom: 10px;
    position: relative;
}

.icon {
    padding: 15px;
    background: dodgerblue;
    color: white;
    min-width: 50px;
    text-align: center;
}

.input-field {
    width: 100%;
    padding: 10px;
    outline: none;
}

.input-field:focus {
    border: 2px solid dodgerblue;
}

.field-icon {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
}

.btn2 {
    color: white;
    padding: 10px 15px;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
    border-radius: 15px;
}

.btn2:hover {
    opacity: 1;
}

/* Back-to-Top Button */
.top-link {
    transition: all 0.25s ease-in-out;
    position: fixed;
    bottom: 0;
    right: 0;
    display: inline-flex;
    cursor: pointer;
    align-items: center;
    justify-content: center;
    margin: 0 3em 3em 0;
    border-radius: 50%;
    padding: 0.25em;
    width: 80px;
    height: 80px;
    background-color: #3661D5;
}

.top-link.show {
    visibility: visible;
    opacity: 1;
}

.top-link.hide {
    visibility: hidden;
    opacity: 0;
}

.top-link svg {
    fill: white;
    width: 24px;
    height: 12px;
}

.top-link:hover {
    background-color: #3498DB;
}

.top-link:hover svg {
    fill: #000000;
}

.screen-reader-text {
    position: absolute;
    clip-path: inset(50%);
    margin: -1px;
    border: 0;
    padding: 0;
    width: 1px;
    height: 1px;
    overflow: hidden;
    word-wrap: normal !important;
    clip: rect(1px, 1px, 1px, 1px);
}

.screen-reader-text:focus {
    display: block;
    top: 5px;
    left: 5px;
    z-index: 100000;
    clip-path: none;
    background-color: #eee;
    padding: 15px 23px 14px;
    width: auto;
    height: auto;
    text-decoration: none;
    line-height: normal;
    color: #444;
    font-size: 1em;
    clip: auto !important;
}

/* Navbar Buttons */
.btn3, .btn4, .btn5 {
    border-radius: 20px;
    border: none;
    color: white;
    font-size: 16px;
    cursor: pointer;
    padding: 8px 22px;
    margin-left: 0.1%;
}

.btn3 {
    margin-left: 23%;
}

.btn3:hover, .btn4:hover, .btn5:hover {
    background-color: RoyalBlue;
    color: black;
}

/* Responsive Footer */
.shfooter .collapse {
    display: inherit;
}

@media (max-width: 767px) {
    .shfooter ul {
        margin-bottom: 0;
    }

    .shfooter .collapse {
        display: none;
    }

    .shfooter .collapse.show {
        display: block;
    }

    .shfooter .title .fa-angle-up,
    .shfooter .title[aria-expanded=true] .fa-angle-down {
        display: none;
    }

    .shfooter .title[aria-expanded=true] .fa-angle-up {
        display: block;
    }

    .shfooter .navbar-toggler {
        display: inline-block;
        padding: 0;
    }
}

/* Other Styles */
.resize {
    text-align: center;
    margin-top: 3rem;
    font-size: 1.25rem;
}

/* Resizing Animation */
.fa-angle-double-right {
    animation: rightanime 1s linear infinite;
}

.fa-angle-double-left {
    animation: leftanime 1s linear infinite;
}

@keyframes rightanime {
    50% {
        transform: translateX(10px);
        opacity: 0.5;
    }

    100% {
        transform: translateX(10px);
        opacity: 0;
    }
}

@keyframes leftanime {
    50% {
        transform: translateX(-10px);
        opacity: 0.5;
    }

    100% {
        transform: translateX(-10px);
        opacity: 0;
    }
}

/* Contact Chip */
.chip {
    display: inline-block;
    padding: 0 25px;
    height: 50px;
    line-height: 50px;
    border-radius: 25px;
    background-color: #2C54C1;
    margin-top: 5px;
}

.chip img {
    float: left;
    margin: 0 10px 0 -25px;
    height: 50px;
    width: 50px;
    border-radius: 50%;
}

.zoom {
    transition: transform .3s;
}

.zoom:hover {
    transform: scale(1.4);
}

.info_section .info_col {
    height: 200px; /* Set a fixed height for each row */
    overflow-y: auto; /* Add vertical scrollbars if content exceeds the height */
}

.dropdown-menu {
    min-width: 15rem;
}

.logo {
    max-height: 70px;
    margin-right: 5px;
}


    </style>

    <body> 

        <!-- Back-to-Top and Back Button -->

       

        <!-- Eto yung navbar -->

        
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="logo">
        <a href="#"><img src="icons/yuson1.png" alt="logo" height="60px" /></a>
    </div>
    <a class="navbar-brand" href="resident_homepage.php"><b> WebYu </b></a>
                <a href="resident_homepage.php" class="nav-link" style="color: white;">HOME</a>
    </div>

    <div class="dropdown ml-auto">
        <button title="Your Account" class="btn btn-primary dropdown-toggle" style="margin-right: 2px;" type="button" data-toggle="dropdown"><?= $userdetails['surname'];?>, <?= $userdetails['firstname'];?>
            <span class="caret" style="margin-left: 2px;"></span>
        </button>
        <ul class="dropdown-menu" style="width: 175px;">
            <li><a class="dropdown-item" href="resident_profile.php?id_resident=<?= $userdetails['id_resident'];?>"> <i class="fas fa-user"></i> &nbsp; Personal Profile</a></li>
            <li><a class="dropdown-item" href="resident_changepass.php?id_resident=<?= $userdetails['id_resident'];?>"> <i class="fas fa-lock"></i>&nbsp; Change Password</a></li>
            <li><a class="dropdown-item" href="logout.php"> <i class="fas fa-sign-out-alt"></i>&nbsp; Logout</a></li>
        </ul>
    </div>
</nav>

        <div id="down1"></div>

        <br>

        <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="card card-custom-width mb-4">
                <div class="card-header bg-primary text-white text-center" style="font-size: 30px">Change Password</div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="current-password">Current Password:</label>
                            <div class="input-container">
                                <i class="fa fa-lock icon"></i>
                                <input type="password" id="current-password" name="oldpassword password" class="form-control" placeholder="Enter Current Password" required>
                                <input type="hidden" name="oldpasswordverify password" value="<?= $userdetails['password'] ?>">
                                <span toggle="#current-password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new-password">New Password:</label>
                            <div class="input-container">
                                <i class="fa fa-key icon"></i>
                                <input type="password" id="new-password" name="password1 newpassword" class="form-control" placeholder="Enter New Password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Verify Password:</label>
                            <div class="input-container">
                                <i class="fa fa-user-lock icon"></i>
                                <input type="password" id="confirm-password" name="checkpassword confirm_password" class="form-control" placeholder="Enter Verify Password" required>
                            </div>
                        </div>
                        <span id="message"></span>
                        <button type="submit" name="resident_changepass" class="btn btn-primary btn-block mt-3">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

        <br>
        <br>
        <br>
        <br>

 <!-- Footer -->

 <footer id="footer" class="bg-primary text-white d-flex-column text-center">
            <hr class="mt-0">

            
                    <!--/.Third column-->

                    <hr class="clearfix w-100 d-md-none mb-0">
 
                    <!--Fourth column-->

                    <div class="col-md-3 mx-auto shfooter" id="down">
                        <div class="d-md-none title" data-target="#Contact-Us" data-toggle="collapse">
                        <div class="mt-3 font-weight-bold">Contact Us:
                            <div class="float-right navbar-toggler">
                            <i class="fas fa-angle-down"></i>
                            <i class="fas fa-angle-up"></i>
                            </div>
                        </div>
                        </div>
                        <ul class="list-unstyled collapse" id="Contact-Us">
                            <li>
                                <div class="zoom">
                                    <div class="chip" style="font-size:10px;">
                                            <img src="icons/yuson1.png" alt="Person" width="96" height="96">
                                        Barangay Yuson | 041-526-7382
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

             <!--/.Footer Links-->

            <hr class="mb-0">

            <!--Copyright-->

            <div class="py-3 text-center">
            Copyright 2023 
            <script>
            document.write(new Date().getFullYear())
            </script> 
              | <a href="dev.html" style="color:white;">WebYu Team</a>
        </div>
            
           
            </footer>

            <script>
      // Function to scroll to the top of the page
      function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }

      // Show or hide the scroll to top button based on scroll position
      window.onscroll = function () {
        var scrollTopBtn = document.getElementById("scrollTopBtn");
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          scrollTopBtn.style.display = "block";
        } else {
          scrollTopBtn.style.display = "none";
        }
      };
    </script>

        <script>
            $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>

        <script>
            $(document).ready(function(){
            // Add smooth scrolling to all links
            $("a").on('click', function(event) {

                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function(){

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
                } // End if
            });
            });
        </script>

        <script src="bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>
        <script>

        document.addEventListener("DOMContentLoaded", function () {
    var togglePassword = document.querySelectorAll('.toggle-password');
    togglePassword.forEach(function (toggle) {
        toggle.addEventListener('click', function () {
            var input = document.querySelector(this.getAttribute('toggle'));
            if (input.getAttribute('type') === 'password') {
                input.setAttribute('type', 'text');
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                input.setAttribute('type', 'password');
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    });
});
</script>

    </body>
</html>